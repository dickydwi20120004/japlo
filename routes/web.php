<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\TrackingController;
use App\Http\Controllers\Web\PaymentController;
use App\Http\Controllers\Web\PackageController;
use App\Http\Controllers\Web\MarketController;
use App\Http\Controllers\Web\MitraController;
use App\Http\Controllers\Web\ExpoController;
use App\Http\Controllers\Web\NotificationController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Support\Facades\Route;

// ═══════════════════════════════════════════
// PUBLIC
// ═══════════════════════════════════════════
Route::get('/', fn() => view('welcome'))->name('home');

// ═══════════════════════════════════════════
// AUTH (guest only)
// ═══════════════════════════════════════════
Route::middleware('guest')->group(function () {
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    Route::get('/forgot-password',         [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password',        [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}',  [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password',         [AuthController::class, 'resetPassword'])->name('password.update');
});

// ═══════════════════════════════════════════
// AUTHENTICATED
// ═══════════════════════════════════════════
Route::middleware('auth')->group(function () {

    // Logout & Dashboard
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile',                  [DashboardController::class, 'profile'])->name('profile');
    Route::put('/profile',                  [DashboardController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/photo',           [DashboardController::class, 'updatePhoto'])->name('profile.update.photo');
    Route::post('/profile/password',        [DashboardController::class, 'changePassword'])->name('profile.change.password');

    // Notifications
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/',               [NotificationController::class, 'index'])->name('index');
        Route::post('/{id}/read',     [NotificationController::class, 'markRead'])->name('read');
        Route::post('/read-all',      [NotificationController::class, 'markAllRead'])->name('read.all');
        Route::get('/count',          [NotificationController::class, 'unreadCount'])->name('count');
    });

    // ─── CUSTOMER SERVICES ─────────────────────────────
    Route::prefix('customer')->name('customer.')->middleware('customer')->group(function () {

        // Ojek / Taksi
        Route::get('/ojek', [ServiceController::class, 'ojek'])->name('ojek');

        // Kuliner
        Route::get('/kuliner',                   [ServiceController::class, 'kuliner'])->name('kuliner');
        Route::get('/kuliner/{restaurant}',      [ServiceController::class, 'kulinerDetail'])->name('kuliner.detail');

        // Iklan & Promosi
        Route::get('/promosi', [ServiceController::class, 'promosi'])->name('promosi');

        // Kesehatan
        Route::get('/kesehatan',                 [ServiceController::class, 'kesehatan'])->name('kesehatan');
        Route::get('/kesehatan/{healthService}', [ServiceController::class, 'kesehatanDetail'])->name('kesehatan.detail');

        // Produk
        Route::get('/produk',            [ServiceController::class, 'produk'])->name('produk');
        Route::get('/produk/{product}',  [ServiceController::class, 'produkDetail'])->name('produk.detail');

        // Percetakan
        Route::get('/pencetakan',        [ServiceController::class, 'pencetakan'])->name('pencetakan');
        Route::post('/pencetakan',       [ServiceController::class, 'pencetakanOrder'])->name('pencetakan.order');

        // Trending (Komunitas Info / Artikel)
        Route::get('/trending',          [ServiceController::class, 'trending'])->name('trending');
        Route::get('/trending/{slug}',   [ServiceController::class, 'trendingDetail'])->name('trending.detail');

        // Sosial (Feed Komunitas)
        Route::get('/sosial',            [ServiceController::class, 'sosial'])->name('sosial');
        Route::post('/sosial',           [ServiceController::class, 'sosialPost'])->name('sosial.post');

        // Pengiriman Paket (BARU)
        Route::get('/paket',             [PackageController::class, 'index'])->name('paket');
        Route::post('/paket',            [PackageController::class, 'store'])->name('paket.store');
        Route::get('/paket/{delivery}',  [PackageController::class, 'show'])->name('paket.show');

        // Belanja Pasar (BARU)
        Route::get('/pasar',                   [MarketController::class, 'index'])->name('pasar');
        Route::post('/pasar',                  [MarketController::class, 'store'])->name('pasar.store');
        Route::get('/pasar/{marketOrder}',     [MarketController::class, 'show'])->name('pasar.show');

        // Pendaftaran Mitra Usaha (BARU)
        Route::get('/daftar-mitra',    [MitraController::class, 'index'])->name('mitra');
        Route::post('/daftar-mitra',   [MitraController::class, 'store'])->name('mitra.store');
        Route::get('/mitra/status',    [MitraController::class, 'status'])->name('mitra.status');

        // Pendaftaran Tenant Mini Expo (BARU)
        Route::get('/daftar-expo',     [ExpoController::class, 'index'])->name('expo');
        Route::post('/daftar-expo',    [ExpoController::class, 'store'])->name('expo.store');
        Route::get('/expo/status',     [ExpoController::class, 'status'])->name('expo.status');
    });

    // ─── ORDER & TRACKING ──────────────────────────────
    Route::prefix('order')->name('order.')->group(function () {
        Route::get('/history',              [DashboardController::class, 'orderHistory'])->name('history');
        Route::get('/track/{orderId}',      [TrackingController::class, 'track'])->name('track');
        Route::get('/location/{orderId}',   [TrackingController::class, 'getLocationUpdate'])->name('location');
        Route::post('/location/update',     [TrackingController::class, 'updateLocation'])->name('location.update');
        Route::get('/poll/{orderId}',       [TrackingController::class, 'pollLocation'])->name('poll');
    });

    // ─── PAYMENT ───────────────────────────────────────
    Route::prefix('payment')->name('payment.')->group(function () {
        Route::get('/checkout',                 [PaymentController::class, 'checkout'])->name('checkout');
        Route::post('/process',                 [PaymentController::class, 'processPayment'])->name('process');
        Route::get('/success/{orderId}',        [PaymentController::class, 'paymentSuccess'])->name('success');
        Route::get('/failed/{orderId}',         [PaymentController::class, 'paymentFailed'])->name('failed');
    });

    // ─── ADMIN ─────────────────────────────────────────
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Users & Drivers
        Route::get('/users',          [AdminController::class, 'users'])->name('users');
        Route::get('/drivers',        [AdminController::class, 'drivers'])->name('drivers');
        Route::post('/drivers/{id}/verify',  [AdminController::class, 'verifyDriver'])->name('drivers.verify');
        Route::post('/drivers/{id}/suspend', [AdminController::class, 'suspendDriver'])->name('drivers.suspend');

        // Orders
        Route::get('/orders',         [AdminController::class, 'orders'])->name('orders');
        Route::get('/orders/{id}',    [AdminController::class, 'orderDetail'])->name('orders.detail');

        // Restaurants & Menus
        Route::get('/restaurants',              [AdminController::class, 'restaurants'])->name('restaurants');
        Route::post('/restaurants',             [AdminController::class, 'restaurantStore'])->name('restaurants.store');
        Route::put('/restaurants/{id}',         [AdminController::class, 'restaurantUpdate'])->name('restaurants.update');
        Route::delete('/restaurants/{id}',      [AdminController::class, 'restaurantDelete'])->name('restaurants.delete');
        Route::get('/restaurants/{id}/menus',   [AdminController::class, 'menus'])->name('menus');
        Route::post('/menus',                   [AdminController::class, 'menuStore'])->name('menus.store');
        Route::put('/menus/{id}',               [AdminController::class, 'menuUpdate'])->name('menus.update');
        Route::delete('/menus/{id}',            [AdminController::class, 'menuDelete'])->name('menus.delete');

        // Products
        Route::get('/products',          [AdminController::class, 'products'])->name('products');
        Route::post('/products',         [AdminController::class, 'productStore'])->name('products.store');
        Route::put('/products/{id}',     [AdminController::class, 'productUpdate'])->name('products.update');
        Route::delete('/products/{id}',  [AdminController::class, 'productDelete'])->name('products.delete');

        // Promotions
        Route::get('/promotions',         [AdminController::class, 'promotions'])->name('promotions');
        Route::post('/promotions',        [AdminController::class, 'promotionStore'])->name('promotions.store');
        Route::put('/promotions/{id}',    [AdminController::class, 'promotionUpdate'])->name('promotions.update');
        Route::delete('/promotions/{id}', [AdminController::class, 'promotionDelete'])->name('promotions.delete');

        // Health Services
        Route::get('/health-services',         [AdminController::class, 'healthServices'])->name('health_services');
        Route::post('/health-services',        [AdminController::class, 'healthServiceStore'])->name('health_services.store');
        Route::put('/health-services/{id}',    [AdminController::class, 'healthServiceUpdate'])->name('health_services.update');
        Route::delete('/health-services/{id}', [AdminController::class, 'healthServiceDelete'])->name('health_services.delete');

        // Articles / Trending
        Route::get('/articles',         [AdminController::class, 'articles'])->name('articles');
        Route::post('/articles',        [AdminController::class, 'articleStore'])->name('articles.store');
        Route::put('/articles/{id}',    [AdminController::class, 'articleUpdate'])->name('articles.update');
        Route::delete('/articles/{id}', [AdminController::class, 'articleDelete'])->name('articles.delete');

        // Tariffs
        Route::get('/tariffs',         [AdminController::class, 'tariffs'])->name('tariffs');
        Route::post('/tariffs',        [AdminController::class, 'tariffStore'])->name('tariffs.store');
        Route::put('/tariffs/{id}',    [AdminController::class, 'tariffUpdate'])->name('tariffs.update');

        // Mitra & Expo Registrations
        Route::get('/mitra-registrations',         [AdminController::class, 'mitraRegistrations'])->name('mitra_registrations');
        Route::post('/mitra-registrations/{id}/approve', [AdminController::class, 'mitraApprove'])->name('mitra_registrations.approve');
        Route::post('/mitra-registrations/{id}/reject',  [AdminController::class, 'mitraReject'])->name('mitra_registrations.reject');

        Route::get('/expo-registrations',          [AdminController::class, 'expoRegistrations'])->name('expo_registrations');
        Route::post('/expo-registrations/{id}/approve', [AdminController::class, 'expoApprove'])->name('expo_registrations.approve');
        Route::post('/expo-registrations/{id}/reject',  [AdminController::class, 'expoReject'])->name('expo_registrations.reject');

        // Package & Market Orders
        Route::get('/packages',      [AdminController::class, 'packages'])->name('packages');
        Route::get('/market-orders', [AdminController::class, 'marketOrders'])->name('market_orders');
    });

    // ─── WEB ORDER API (session auth) ──────────────────
    Route::prefix('api')->name('api.')->group(function () {
        Route::post('/orders', [OrderController::class, 'createOrder'])->name('orders.create');
    });

});
