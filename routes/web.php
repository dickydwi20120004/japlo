<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\TrackingController;
use App\Http\Controllers\Web\PaymentController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home/Welcome Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    
    // Forgot Password Routes
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::post('/profile/photo', [DashboardController::class, 'updatePhoto'])->name('profile.update.photo');
    Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [DashboardController::class, 'changePassword'])->name('profile.change.password');
    
    // Service Routes - Customer
    Route::prefix('customer')->name('customer.')->middleware('customer')->group(function () {
        Route::get('/ojek', [ServiceController::class, 'ojek'])->name('ojek');
        Route::get('/kuliner', [ServiceController::class, 'kuliner'])->name('kuliner');
        Route::get('/kuliner/{restaurantId}', [ServiceController::class, 'kulinerDetail'])->name('kuliner.detail');
        Route::get('/promosi', [ServiceController::class, 'promosi'])->name('promosi');
        Route::get('/kesehatan', [ServiceController::class, 'kesehatan'])->name('kesehatan');
        Route::get('/kesehatan/{serviceId}', [ServiceController::class, 'kesehatanDetail'])->name('kesehatan.detail');
        Route::get('/produk', [ServiceController::class, 'produk'])->name('produk');
        Route::get('/produk/{productId}', [ServiceController::class, 'produkDetail'])->name('produk.detail');
        Route::get('/pencetakan', [ServiceController::class, 'pencetakan'])->name('pencetakan');
        Route::get('/trending', [ServiceController::class, 'trending'])->name('trending');
        Route::get('/sosial', [ServiceController::class, 'sosial'])->name('sosial');
    });
    
    // Admin Routes
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/drivers', [AdminController::class, 'drivers'])->name('drivers');
        Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    });

    // Order Tracking Routes
    Route::prefix('order')->name('order.')->group(function () {
        Route::get('/track/{orderId}', [TrackingController::class, 'track'])->name('track');
        Route::get('/location/{orderId}', [TrackingController::class, 'getLocationUpdate'])->name('location');
        Route::post('/location/update', [TrackingController::class, 'updateLocation'])->name('location.update');
        Route::get('/poll/{orderId}', [TrackingController::class, 'pollLocation'])->name('poll');
        Route::get('/history', [DashboardController::class, 'orderHistory'])->name('history');
    });

    // Payment Routes
    Route::prefix('payment')->name('payment.')->group(function () {
        Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
        Route::post('/process', [PaymentController::class, 'processPayment'])->name('process');
        Route::get('/success/{orderId}', [PaymentController::class, 'paymentSuccess'])->name('success');
        Route::get('/failed/{orderId}', [PaymentController::class, 'paymentFailed'])->name('failed');
    });
    
    // API Routes for Orders (Web Auth)
    Route::prefix('api')->name('api.')->group(function () {
        Route::post('/orders', [OrderController::class, 'createOrder'])->name('orders.create');
    });
});
