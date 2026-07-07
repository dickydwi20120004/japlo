<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Buat pesanan baru
     */
    public function createOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pickup_address' => 'required|string',
            'pickup_latitude' => 'required|numeric|between:-90,90',
            'pickup_longitude' => 'required|numeric|between:-180,180',
            'destination_address' => 'required|string',
            'destination_latitude' => 'required|numeric|between:-90,90',
            'destination_longitude' => 'required|numeric|between:-180,180',
            'distance' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,ewallet',
            'customer_notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        // Calculate price
        $price = Order::calculatePrice($request->distance);

        // Estimate time (average 30 km/h)
        $estimatedTime = round(($request->distance / 30) * 60); // dalam menit

        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => Order::generateOrderNumber(),
            'pickup_address' => $request->pickup_address,
            'pickup_latitude' => $request->pickup_latitude,
            'pickup_longitude' => $request->pickup_longitude,
            'destination_address' => $request->destination_address,
            'destination_latitude' => $request->destination_latitude,
            'destination_longitude' => $request->destination_longitude,
            'distance' => $request->distance,
            'estimated_time' => $estimatedTime,
            'price' => $price,
            'payment_method' => $request->payment_method,
            'customer_notes' => $request->customer_notes,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'data' => $order
        ], 201);
    }

    /**
     * Get user orders
     */
    public function getUserOrders(Request $request)
    {
        $user = $request->user();
        $status = $request->query('status');

        $query = Order::where('user_id', $user->id)
            ->with(['driver.driver', 'rating'])
            ->orderBy('created_at', 'desc');

        if ($status) {
            $query->where('status', $status);
        }

        $orders = $query->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }

    /**
     * Get order detail
     */
    public function getOrderDetail(Request $request, $orderId)
    {
        $user = $request->user();

        $order = Order::where('id', $orderId)
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere('driver_id', $user->id);
            })
            ->with(['user', 'driver.driver', 'rating'])
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $order
        ], 200);
    }

    /**
     * Cancel order
     */
    public function cancelOrder(Request $request, $orderId)
    {
        $validator = Validator::make($request->all(), [
            'reason' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        $order = Order::where('id', $orderId)
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhere('driver_id', $user->id);
            })
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        if (!in_array($order->status, ['pending', 'accepted'])) {
            return response()->json([
                'success' => false,
                'message' => 'Order cannot be cancelled'
            ], 400);
        }

        $cancelledBy = $order->user_id === $user->id ? 'user' : 'driver';
        $order->cancel($cancelledBy, $request->reason);

        // If driver cancels, set driver availability to true
        if ($cancelledBy === 'driver' && $user->driver) {
            $user->driver->setAvailability(true);
        }

        return response()->json([
            'success' => true,
            'message' => 'Order cancelled successfully',
            'data' => $order
        ], 200);
    }

    /**
     * Get nearby available drivers
     */
    public function getNearbyDrivers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'radius' => 'nullable|numeric|min:1|max:50', // radius dalam KM, default 10 KM
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $radius = $request->radius ?? 10; // default 10 KM

        // Haversine formula untuk menghitung jarak
        $drivers = Driver::select('drivers.*')
            ->selectRaw(
                '( 6371 * acos( cos( radians(?) ) * cos( radians( current_latitude ) ) * cos( radians( current_longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( current_latitude ) ) ) ) AS distance',
                [$latitude, $longitude, $latitude]
            )
            ->with('user')
            ->where('is_available', true)
            ->where('is_verified', true)
            ->whereNotNull('current_latitude')
            ->whereNotNull('current_longitude')
            ->having('distance', '<=', $radius)
            ->orderBy('distance', 'asc')
            ->limit(20)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $drivers
        ], 200);
    }

    /**
     * Get active order for user
     */
    public function getActiveOrder(Request $request)
    {
        $user = $request->user();

        $order = Order::where(function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->orWhere('driver_id', $user->id);
        })
            ->active()
            ->with(['user', 'driver.driver'])
            ->first();

        if (!$order) {
            return response()->json([
                'success' => true,
                'data' => null,
                'message' => 'No active order'
            ], 200);
        }

        return response()->json([
            'success' => true,
            'data' => $order
        ], 200);
    }

    /**
     * Get available pending orders for drivers
     */
    public function getPendingOrders(Request $request)
    {
        $user = $request->user();

        if (!$user->isDriver()) {
            return response()->json([
                'success' => false,
                'message' => 'User is not a driver'
            ], 403);
        }

        $driver = $user->driver;

        if (!$driver || !$driver->current_latitude || !$driver->current_longitude) {
            return response()->json([
                'success' => false,
                'message' => 'Driver location not available'
            ], 400);
        }

        $latitude = $driver->current_latitude;
        $longitude = $driver->current_longitude;
        $radius = 15; // radius 15 KM

        // Get pending orders nearby
        $orders = Order::select('orders.*')
            ->selectRaw(
                '( 6371 * acos( cos( radians(?) ) * cos( radians( pickup_latitude ) ) * cos( radians( pickup_longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( pickup_latitude ) ) ) ) AS distance',
                [$latitude, $longitude, $latitude]
            )
            ->with('user')
            ->where('status', 'pending')
            ->having('distance', '<=', $radius)
            ->orderBy('distance', 'asc')
            ->limit(10)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }
}
