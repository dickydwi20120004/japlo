<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Driver;
use App\Models\ExpoRegistration;
use App\Models\HealthService;
use App\Models\MarketOrder;
use App\Models\Menu;
use App\Models\MitraRegistration;
use App\Models\Order;
use App\Models\PackageDelivery;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Restaurant;
use App\Models\Tariff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    // ══════════════════════════════════════════
    // DASHBOARD
    // ══════════════════════════════════════════
    public function dashboard()
    {
        $totalUsers   = User::where('role', 'user')->count();
        $totalDrivers = User::where('role', 'driver')->count();
        $totalOrders  = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('price');

        $recentOrders  = Order::with(['user', 'driver'])->latest()->limit(10)->get();
        $recentUsers   = User::where('role', 'user')->latest()->limit(5)->get();
        $recentDrivers = User::where('role', 'driver')->with('driver')->latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalDrivers', 'totalOrders', 'totalRevenue',
            'recentOrders', 'recentUsers', 'recentDrivers'
        ));
    }

    // ══════════════════════════════════════════
    // USERS
    // ══════════════════════════════════════════
    public function users(Request $request)
    {
        $query = User::where('role', 'user');
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            });
        }
        $users = $query->latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    // ══════════════════════════════════════════
    // DRIVERS
    // ══════════════════════════════════════════
    public function drivers(Request $request)
    {
        $query = User::where('role', 'driver')->with('driver');
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }
        $drivers = $query->latest()->paginate(20);
        return view('admin.drivers', compact('drivers'));
    }

    public function verifyDriver(int $id)
    {
        $driverUser = User::findOrFail($id);
        $driver = $driverUser->driver;
        if ($driver) {
            $driver->update(['is_verified' => true]);
        }
        return back()->with('success', "Driver {$driverUser->name} berhasil diverifikasi.");
    }

    public function suspendDriver(int $id)
    {
        $driverUser = User::findOrFail($id);
        $driver = $driverUser->driver;
        if ($driver) {
            $driver->update(['is_verified' => false, 'is_available' => false]);
        }
        return back()->with('success', "Driver {$driverUser->name} berhasil disuspend.");
    }

    // ══════════════════════════════════════════
    // ORDERS
    // ══════════════════════════════════════════
    public function orders(Request $request)
    {
        $query = Order::with(['user', 'driver']);
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $query->where('order_number', 'like', "%{$request->search}%");
        }
        $orders = $query->latest()->paginate(20);
        return view('admin.orders', compact('orders'));
    }

    public function orderDetail(int $id)
    {
        $order = Order::with(['user', 'driver', 'items', 'payment', 'rating'])->findOrFail($id);
        return view('admin.order_detail', compact('order'));
    }

    // ══════════════════════════════════════════
    // RESTAURANTS
    // ══════════════════════════════════════════
    public function restaurants()
    {
        $restaurants = Restaurant::withCount('menus')->latest()->paginate(20);
        return view('admin.restaurants', compact('restaurants'));
    }

    public function restaurantStore(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:150',
            'category'      => 'required|string',
            'description'   => 'nullable|string',
            'address'       => 'nullable|string',
            'phone'         => 'nullable|string|max:20',
            'open_time'     => 'nullable|string',
            'close_time'    => 'nullable|string',
            'min_order'     => 'nullable|numeric|min:0',
            'delivery_time' => 'nullable|integer|min:1',
            'is_active'     => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);
        Restaurant::create($data);
        return back()->with('success', 'Restoran berhasil ditambahkan.');
    }

    public function restaurantUpdate(Request $request, int $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $data = $request->validate([
            'name'          => 'required|string|max:150',
            'category'      => 'required|string',
            'description'   => 'nullable|string',
            'address'       => 'nullable|string',
            'phone'         => 'nullable|string|max:20',
            'open_time'     => 'nullable|string',
            'close_time'    => 'nullable|string',
            'min_order'     => 'nullable|numeric',
            'delivery_time' => 'nullable|integer',
            'is_active'     => 'nullable|boolean',
            'is_open'       => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $data['is_open']   = $request->boolean('is_open');
        $restaurant->update($data);
        return back()->with('success', 'Restoran berhasil diperbarui.');
    }

    public function restaurantDelete(int $id)
    {
        Restaurant::findOrFail($id)->delete();
        return back()->with('success', 'Restoran berhasil dihapus.');
    }

    // ══════════════════════════════════════════
    // MENUS
    // ══════════════════════════════════════════
    public function menus(int $id)
    {
        $restaurant = Restaurant::with('menus')->findOrFail($id);
        return view('admin.menus', compact('restaurant'));
    }

    public function menuStore(Request $request)
    {
        $data = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'name'          => 'required|string|max:150',
            'description'   => 'nullable|string',
            'price'         => 'required|numeric|min:0',
            'category'      => 'nullable|string',
            'is_available'  => 'nullable|boolean',
        ]);
        $data['is_available'] = $request->boolean('is_available', true);
        Menu::create($data);
        return back()->with('success', 'Menu berhasil ditambahkan.');
    }

    public function menuUpdate(Request $request, int $id)
    {
        $menu = Menu::findOrFail($id);
        $data = $request->validate([
            'name'         => 'required|string|max:150',
            'description'  => 'nullable|string',
            'price'        => 'required|numeric|min:0',
            'category'     => 'nullable|string',
            'is_available' => 'nullable|boolean',
        ]);
        $data['is_available'] = $request->boolean('is_available');
        $menu->update($data);
        return back()->with('success', 'Menu berhasil diperbarui.');
    }

    public function menuDelete(int $id)
    {
        Menu::findOrFail($id)->delete();
        return back()->with('success', 'Menu berhasil dihapus.');
    }

    // ══════════════════════════════════════════
    // PRODUCTS
    // ══════════════════════════════════════════
    public function products(Request $request)
    {
        $query = Product::query();
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        $products   = $query->latest()->paginate(20);
        $categories = Product::distinct()->pluck('category')->filter();
        return view('admin.products', compact('products', 'categories'));
    }

    public function productStore(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:150',
            'description'    => 'nullable|string',
            'price'          => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'stock'          => 'required|integer|min:0',
            'category'       => 'nullable|string',
            'weight'         => 'nullable|numeric|min:0',
            'is_active'      => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);
        Product::create($data);
        return back()->with('success', 'Produk berhasil ditambahkan.');
    }

    public function productUpdate(Request $request, int $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validate([
            'name'           => 'required|string|max:150',
            'description'    => 'nullable|string',
            'price'          => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric',
            'stock'          => 'required|integer|min:0',
            'category'       => 'nullable|string',
            'weight'         => 'nullable|numeric',
            'is_active'      => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $product->update($data);
        return back()->with('success', 'Produk berhasil diperbarui.');
    }

    public function productDelete(int $id)
    {
        Product::findOrFail($id)->delete();
        return back()->with('success', 'Produk berhasil dihapus.');
    }

    // ══════════════════════════════════════════
    // PROMOTIONS
    // ══════════════════════════════════════════
    public function promotions()
    {
        $promotions = Promotion::latest()->paginate(20);
        return view('admin.promotions', compact('promotions'));
    }

    public function promotionStore(Request $request)
    {
        $data = $request->validate([
            'title'          => 'required|string|max:150',
            'description'    => 'nullable|string',
            'category'       => 'nullable|string',
            'type'           => 'required|in:discount,cashback,free_delivery,info',
            'discount_value' => 'nullable|numeric|min:0',
            'discount_type'  => 'nullable|in:percent,nominal',
            'promo_code'     => 'nullable|string|max:30|unique:promotions,promo_code',
            'quota'          => 'nullable|integer|min:1',
            'min_purchase'   => 'nullable|numeric|min:0',
            'start_date'     => 'nullable|date',
            'end_date'       => 'nullable|date|after_or_equal:start_date',
            'is_active'      => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);
        Promotion::create($data);
        return back()->with('success', 'Promosi berhasil ditambahkan.');
    }

    public function promotionUpdate(Request $request, int $id)
    {
        $promo = Promotion::findOrFail($id);
        $data  = $request->validate([
            'title'       => 'required|string|max:150',
            'description' => 'nullable|string',
            'is_active'   => 'nullable|boolean',
            'end_date'    => 'nullable|date',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $promo->update($data);
        return back()->with('success', 'Promosi berhasil diperbarui.');
    }

    public function promotionDelete(int $id)
    {
        Promotion::findOrFail($id)->delete();
        return back()->with('success', 'Promosi berhasil dihapus.');
    }

    // ══════════════════════════════════════════
    // HEALTH SERVICES
    // ══════════════════════════════════════════
    public function healthServices()
    {
        $services = HealthService::orderBy('sort_order')->paginate(20);
        return view('admin.health_services', compact('services'));
    }

    public function healthServiceStore(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:150',
            'description'  => 'nullable|string',
            'price'        => 'required|numeric|min:0',
            'provider'     => 'nullable|string|max:100',
            'phone'        => 'nullable|string|max:20',
            'is_available' => 'nullable|boolean',
            'sort_order'   => 'nullable|integer',
        ]);
        $data['is_available'] = $request->boolean('is_available', true);
        HealthService::create($data);
        return back()->with('success', 'Layanan kesehatan berhasil ditambahkan.');
    }

    public function healthServiceUpdate(Request $request, int $id)
    {
        $service = HealthService::findOrFail($id);
        $data = $request->validate([
            'name'         => 'required|string|max:150',
            'description'  => 'nullable|string',
            'price'        => 'required|numeric|min:0',
            'is_available' => 'nullable|boolean',
        ]);
        $data['is_available'] = $request->boolean('is_available');
        $service->update($data);
        return back()->with('success', 'Layanan kesehatan berhasil diperbarui.');
    }

    public function healthServiceDelete(int $id)
    {
        HealthService::findOrFail($id)->delete();
        return back()->with('success', 'Layanan kesehatan berhasil dihapus.');
    }

    // ══════════════════════════════════════════
    // ARTICLES / TRENDING
    // ══════════════════════════════════════════
    public function articles()
    {
        $articles = Article::with('author')->latest()->paginate(20);
        return view('admin.articles', compact('articles'));
    }

    public function articleStore(Request $request)
    {
        $data = $request->validate([
            'title'    => 'required|string|max:200',
            'excerpt'  => 'nullable|string|max:500',
            'content'  => 'required|string',
            'category' => 'nullable|string',
            'status'   => 'required|in:draft,published',
        ]);
        $data['user_id']      = auth()->id();
        $data['slug']         = Article::generateSlug($data['title']);
        $data['published_at'] = $data['status'] === 'published' ? now() : null;
        Article::create($data);
        return back()->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function articleUpdate(Request $request, int $id)
    {
        $article = Article::findOrFail($id);
        $data = $request->validate([
            'title'    => 'required|string|max:200',
            'excerpt'  => 'nullable|string|max:500',
            'content'  => 'required|string',
            'category' => 'nullable|string',
            'status'   => 'required|in:draft,published',
        ]);
        if ($data['status'] === 'published' && !$article->published_at) {
            $data['published_at'] = now();
        }
        $article->update($data);
        return back()->with('success', 'Artikel berhasil diperbarui.');
    }

    public function articleDelete(int $id)
    {
        Article::findOrFail($id)->delete();
        return back()->with('success', 'Artikel berhasil dihapus.');
    }

    // ══════════════════════════════════════════
    // TARIFFS
    // ══════════════════════════════════════════
    public function tariffs()
    {
        $tariffs = Tariff::all();
        return view('admin.tariffs', compact('tariffs'));
    }

    public function tariffStore(Request $request)
    {
        $data = $request->validate([
            'service_type' => 'required|string|unique:tariffs,service_type',
            'label'        => 'required|string|max:100',
            'base_fare'    => 'required|numeric|min:0',
            'per_km'       => 'required|numeric|min:0',
            'minimum_fare' => 'required|numeric|min:0',
            'platform_fee' => 'nullable|numeric|min:0',
            'is_active'    => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);
        Tariff::create($data);
        return back()->with('success', 'Tarif berhasil ditambahkan.');
    }

    public function tariffUpdate(Request $request, int $id)
    {
        $tariff = Tariff::findOrFail($id);
        $data   = $request->validate([
            'label'        => 'required|string|max:100',
            'base_fare'    => 'required|numeric|min:0',
            'per_km'       => 'required|numeric|min:0',
            'minimum_fare' => 'required|numeric|min:0',
            'platform_fee' => 'nullable|numeric|min:0',
            'is_active'    => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $tariff->update($data);
        return back()->with('success', 'Tarif berhasil diperbarui.');
    }

    // ══════════════════════════════════════════
    // MITRA REGISTRATIONS
    // ══════════════════════════════════════════
    public function mitraRegistrations(Request $request)
    {
        $query = MitraRegistration::with('user');
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $registrations = $query->latest()->paginate(20);
        return view('admin.mitra_registrations', compact('registrations'));
    }

    public function mitraApprove(int $id)
    {
        $reg = MitraRegistration::findOrFail($id);
        $reg->update(['status' => 'approved', 'approved_at' => now()]);
        return back()->with('success', "Pendaftaran mitra {$reg->business_name} disetujui.");
    }

    public function mitraReject(Request $request, int $id)
    {
        $reg = MitraRegistration::findOrFail($id);
        $reg->update([
            'status'      => 'rejected',
            'admin_notes' => $request->input('reason', 'Tidak memenuhi persyaratan.'),
        ]);
        return back()->with('success', "Pendaftaran mitra {$reg->business_name} ditolak.");
    }

    // ══════════════════════════════════════════
    // EXPO REGISTRATIONS
    // ══════════════════════════════════════════
    public function expoRegistrations(Request $request)
    {
        $query = ExpoRegistration::with('user');
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $registrations = $query->latest()->paginate(20);
        return view('admin.expo_registrations', compact('registrations'));
    }

    public function expoApprove(int $id)
    {
        $reg = ExpoRegistration::findOrFail($id);
        $reg->update(['status' => 'approved', 'approved_at' => now()]);
        return back()->with('success', "Pendaftaran expo {$reg->business_name} disetujui.");
    }

    public function expoReject(Request $request, int $id)
    {
        $reg = ExpoRegistration::findOrFail($id);
        $reg->update([
            'status'      => 'rejected',
            'admin_notes' => $request->input('reason', 'Tidak memenuhi persyaratan.'),
        ]);
        return back()->with('success', "Pendaftaran expo {$reg->business_name} ditolak.");
    }

    // ══════════════════════════════════════════
    // PACKAGE DELIVERIES
    // ══════════════════════════════════════════
    public function packages(Request $request)
    {
        $query = PackageDelivery::with(['customer', 'driver']);
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $deliveries = $query->latest()->paginate(20);
        return view('admin.packages', compact('deliveries'));
    }

    // ══════════════════════════════════════════
    // MARKET ORDERS
    // ══════════════════════════════════════════
    public function marketOrders(Request $request)
    {
        $query = MarketOrder::with(['customer', 'driver', 'items']);
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $orders = $query->latest()->paginate(20);
        return view('admin.market_orders', compact('orders'));
    }
}
