<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DriverController extends Controller
{
    /**
     * Register driver (lengkapi data driver)
     */
    public function registerDriver(Request $request)
    {
        $user = $request->user();

        // Check if user role is driver
        if (!$user->isDriver()) {
            return response()->json([
                'success' => false,
                'message' => 'User is not registered as driver'
            ], 403);
        }

        // Check if driver already exists
        if ($user->driver) {
            return response()->json([
                'success' => false,
                'message' => 'Driver profile already exists'
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'vehicle_type' => 'required|string',
            'vehicle_brand' => 'required|string',
            'vehicle_number' => 'required|string|unique:drivers',
            'vehicle_color' => 'required|string',
            'license_number' => 'required|string|unique:drivers',
            'identity_number' => 'required|string|unique:drivers',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $driver = Driver::create([
            'user_id' => $user->id,
            'vehicle_type' => $request->vehicle_type,
            'vehicle_brand' => $request->vehicle_brand,
            'vehicle_number' => $request->vehicle_number,
            'vehicle_color' => $request->vehicle_color,
            'license_number' => $request->license_number,
            'identity_number' => $request->identity_number,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Driver registered successfully',
            'data' => $driver
        ], 201);
    }

    /**
     * Update driver profile
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $driver = $user->driver;

        if (!$driver) {
            return response()->json([
                'success' => false,
                'message' => 'Driver profile not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'vehicle_brand' => 'sometimes|string',
            'vehicle_number' => 'sometimes|string|unique:drivers,vehicle_number,' . $driver->id,
            'vehicle_color' => 'sometimes|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $driver->update($request->only([
            'vehicle_brand',
            'vehicle_number',
            'vehicle_color'
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Driver profile updated successfully',
            'data' => $driver
        ], 200);
    }

    /**
     * Update lokasi driver
     */
    public function updateLocation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();
        $driver = $user->driver;

        if (!$driver) {
            return response()->json([
                'success' => false,
                'message' => 'Driver profile not found'
            ], 404);
        }

        $driver->updateLocation($request->latitude, $request->longitude);

        return response()->json([
            'success' => true,
            'message' => 'Location updated successfully',
            'data' => $driver
        ], 200);
    }

    /**
     * Toggle driver availability
     */
    public function toggleAvailability(Request $request)
    {
        $user = $request->user();
        $driver = $user->driver;

        if (!$driver) {
            return response()->json([
                'success' => false,
                'message' => 'Driver profile not found'
            ], 404);
        }

        $driver->setAvailability(!$driver->is_available);

        return response()->json([
            'success' => true,
            'message' => 'Availability updated successfully',
            'data' => [
                'is_available' => $driver->is_available
            ]
        ], 200);
    }

    /**
     * Get driver orders
     */
    public function getOrders(Request $request)
    {
        $user = $request->user();
        $status = $request->query('status');

        $query = Order::where('driver_id', $user->id)
            ->with(['user', 'rating'])
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
     * Accept order
     */
    public function acceptOrder(Request $request, $orderId)
    {
        $user = $request->user();
        $driver = $user->driver;

        if (!$driver) {
            return response()->json([
                'success' => false,
                'message' => 'Driver profile not found'
            ], 404);
        }

        if (!$driver->is_available) {
            return response()->json([
                'success' => false,
                'message' => 'Driver is not available'
            ], 400);
        }

        $order = Order::find($orderId);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        if ($order->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Order is not available'
            ], 400);
        }

        $order->assignDriver($user->id);
        $driver->setAvailability(false);

        return response()->json([
            'success' => true,
            'message' => 'Order accepted successfully',
            'data' => $order->load('user')
        ], 200);
    }

    /**
     * Update order status
     */
    public function updateOrderStatus(Request $request, $orderId)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:picked_up,in_progress,completed',
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
            ->where('driver_id', $user->id)
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        $order->updateStatus($request->status);

        // If completed, update driver stats and set availability to true
        if ($request->status === 'completed') {
            $driver = $user->driver;
            $driver->incrementRides();
            $driver->addEarnings($order->price);
            $driver->setAvailability(true);
        }

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully',
            'data' => $order
        ], 200);
    }

    /**
     * Get driver statistics
     */
    public function getStatistics(Request $request)
    {
        $user = $request->user();
        $driver = $user->driver;

        if (!$driver) {
            return response()->json([
                'success' => false,
                'message' => 'Driver profile not found'
            ], 404);
        }

        $today = now()->startOfDay();
        $thisMonth = now()->startOfMonth();

        $todayOrders = Order::where('driver_id', $user->id)
            ->where('status', 'completed')
            ->whereDate('completed_at', $today)
            ->count();

        $todayEarnings = Order::where('driver_id', $user->id)
            ->where('status', 'completed')
            ->whereDate('completed_at', $today)
            ->sum('price');

        $monthlyOrders = Order::where('driver_id', $user->id)
            ->where('status', 'completed')
            ->where('completed_at', '>=', $thisMonth)
            ->count();

        $monthlyEarnings = Order::where('driver_id', $user->id)
            ->where('status', 'completed')
            ->where('completed_at', '>=', $thisMonth)
            ->sum('price');

        return response()->json([
            'success' => true,
            'data' => [
                'total_rides' => $driver->total_rides,
                'total_earnings' => $driver->total_earnings,
                'rating' => $driver->rating,
                'today' => [
                    'orders' => $todayOrders,
                    'earnings' => $todayEarnings,
                ],
                'monthly' => [
                    'orders' => $monthlyOrders,
                    'earnings' => $monthlyEarnings,
                ]
            ]
        ], 200);
    }
}
