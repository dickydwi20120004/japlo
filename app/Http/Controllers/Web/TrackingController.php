<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    /**
     * Display tracking page for an order
     */
    public function track($orderId)
    {
        // In production: Get real order data from database
        $order = Order::find($orderId);

        if (!$order || ($order->user_id !== auth()->id() && $order->driver_id !== auth()->id())) {
            abort(403, 'Unauthorized');
        }

        return view('order.tracking', compact('order'));
    }

    /**
     * Get real-time tracking data (for AJAX)
     */
    public function getLocationUpdate($orderId)
    {
        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        return response()->json([
            'driver_lat' => $order->driver->current_latitude ?? 0,
            'driver_lng' => $order->driver->current_longitude ?? 0,
            'pickup_lat' => $order->pickup_latitude,
            'pickup_lng' => $order->pickup_longitude,
            'destination_lat' => $order->destination_latitude,
            'destination_lng' => $order->destination_longitude,
            'distance' => $order->distance,
            'estimated_time' => $order->estimated_time,
            'status' => $order->status,
        ]);
    }

    /**
     * Update driver location (from driver app)
     */
    public function updateLocation(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $order = Order::find($request->order_id);

        // Verify this is the driver's order
        if ($order->driver_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Update driver location
        $driver = auth()->user()->driver;
        if ($driver) {
            $driver->update([
                'current_latitude' => $request->latitude,
                'current_longitude' => $request->longitude,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Location updated',
        ]);
    }

    /**
     * Live polling location (every 5 seconds)
     */
    public function pollLocation($orderId)
    {
        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $driverLocation = null;
        if ($order->driver && $order->driver->user->driver) {
            $driverLocation = [
                'latitude' => $order->driver->user->driver->current_latitude ?? 0,
                'longitude' => $order->driver->user->driver->current_longitude ?? 0,
            ];
        }

        return response()->json([
            'driver_location' => $driverLocation,
            'status' => $order->status,
            'estimated_time' => $order->estimated_time,
        ]);
    }
}
