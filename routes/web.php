<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Controllers\Web\AdminController;
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
    Route::prefix('customer')->name('customer.')->group(function () {
        Route::get('/ojek', [ServiceController::class, 'ojek'])->name('ojek');
        Route::get('/kuliner', [ServiceController::class, 'kuliner'])->name('kuliner');
        Route::get('/promosi', [ServiceController::class, 'promosi'])->name('promosi');
        Route::get('/kesehatan', [ServiceController::class, 'kesehatan'])->name('kesehatan');
        Route::get('/produk', [ServiceController::class, 'produk'])->name('produk');
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
});
