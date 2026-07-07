<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    /**
     * Create rating untuk driver setelah perjalanan selesai
     */
    public function createRating(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:500',
            'service_rating' => 'nullable|integer|min:1|max:5',
            'cleanliness_rating' => 'nullable|integer|min:1|max:5',
            'punctuality_rating' => 'nullable|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        // Check if order exists and belongs to user
        $order = Order::where('id', $request->order_id)
            ->where('user_id', $user->id)
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        // Check if order is completed
        if ($order->status !== 'completed') {
            return response()->json([
                'success' => false,
                'message' => 'Order is not completed yet'
            ], 400);
        }

        // Check if rating already exists
        if ($order->rating) {
            return response()->json([
                'success' => false,
                'message' => 'Order already rated'
            ], 400);
        }

        // Check if order has driver
        if (!$order->driver_id) {
            return response()->json([
                'success' => false,
                'message' => 'Order has no driver'
            ], 400);
        }

        $rating = Rating::create([
            'order_id' => $order->id,
            'user_id' => $user->id,
            'driver_id' => $order->driver_id,
            'rating' => $request->rating,
            'review' => $request->review,
            'service_rating' => $request->service_rating,
            'cleanliness_rating' => $request->cleanliness_rating,
            'punctuality_rating' => $request->punctuality_rating,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Rating submitted successfully',
            'data' => $rating
        ], 201);
    }

    /**
     * Get ratings untuk driver tertentu
     */
    public function getDriverRatings(Request $request, $driverId)
    {
        $ratings = Rating::where('driver_id', $driverId)
            ->with(['user', 'order'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $averageRating = Rating::where('driver_id', $driverId)->avg('rating');
        $totalRatings = Rating::where('driver_id', $driverId)->count();

        return response()->json([
            'success' => true,
            'data' => [
                'ratings' => $ratings,
                'average_rating' => round($averageRating, 2),
                'total_ratings' => $totalRatings,
            ]
        ], 200);
    }

    /**
     * Get rating untuk order tertentu
     */
    public function getOrderRating(Request $request, $orderId)
    {
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

        $rating = Rating::where('order_id', $orderId)
            ->with(['user', 'driver'])
            ->first();

        if (!$rating) {
            return response()->json([
                'success' => true,
                'data' => null,
                'message' => 'No rating found for this order'
            ], 200);
        }

        return response()->json([
            'success' => true,
            'data' => $rating
        ], 200);
    }

    /**
     * Get all ratings given by user
     */
    public function getUserRatings(Request $request)
    {
        $user = $request->user();

        $ratings = Rating::where('user_id', $user->id)
            ->with(['driver', 'order'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $ratings
        ], 200);
    }
}
