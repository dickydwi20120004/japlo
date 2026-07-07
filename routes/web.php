<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\ServiceController;
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
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    
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
});
