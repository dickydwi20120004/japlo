<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\RatingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes (tidak perlu authentication)
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// Protected routes (perlu authentication)
Route::middleware('auth:sanctum')->group(function () {
    
    // Auth routes
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::put('/profile', [AuthController::class, 'updateProfile']);
        Route::post('/change-password', [AuthController::class, 'changePassword']);
    });

    // Driver routes
    Route::prefix('driver')->group(function () {
        Route::post('/register', [DriverController::class, 'registerDriver']);
        Route::put('/profile', [DriverController::class, 'updateProfile']);
        Route::post('/location', [DriverController::class, 'updateLocation']);
        Route::post('/toggle-availability', [DriverController::class, 'toggleAvailability']);
        Route::get('/orders', [DriverController::class, 'getOrders']);
        Route::post('/orders/{id}/accept', [DriverController::class, 'acceptOrder']);
        Route::put('/orders/{id}/status', [DriverController::class, 'updateOrderStatus']);
        Route::get('/statistics', [DriverController::class, 'getStatistics']);
    });

    // Order routes
    Route::prefix('orders')->group(function () {
        Route::post('/', [OrderController::class, 'createOrder']);
        Route::get('/', [OrderController::class, 'getUserOrders']);
        Route::get('/pending', [OrderController::class, 'getPendingOrders']);
        Route::get('/active', [OrderController::class, 'getActiveOrder']);
        Route::get('/nearby-drivers', [OrderController::class, 'getNearbyDrivers']);
        Route::get('/{id}', [OrderController::class, 'getOrderDetail']);
        Route::post('/{id}/cancel', [OrderController::class, 'cancelOrder']);
    });

    // Rating routes
    Route::prefix('ratings')->group(function () {
        Route::post('/', [RatingController::class, 'createRating']);
        Route::get('/my-ratings', [RatingController::class, 'getUserRatings']);
        Route::get('/driver/{id}', [RatingController::class, 'getDriverRatings']);
        Route::get('/order/{id}', [RatingController::class, 'getOrderRating']);
    });
});

// Health check
Route::get('/health', function () {
    return response()->json([
        'success' => true,
        'message' => 'JAPLO API is running',
        'version' => '1.0.0',
        'timestamp' => now()
    ]);
});
