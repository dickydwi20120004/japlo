<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\HealthService;
use App\Models\Article;
use App\Models\SocialPost;
use App\Models\Tariff;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ─── Ojek / Taksi ─────────────────────────────────
    public function ojek()
    {
        $tariffMotor = Tariff::getActive('ojek_motor');
        $tariffMobil = Tariff::getActive('ojek_mobil');

        return view('customer.services.ojek', compact('tariffMotor', 'tariffMobil'));
    }

    // ─── Kuliner ──────────────────────────────────────
    public function kuliner(Request $request)
    {
        $query = Restaurant::active();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $restaurants = $query->orderByDesc('rating')->paginate(12);
        $categories  = Restaurant::active()->distinct()->pluck('category');

        return view('customer.services.kuliner', compact('restaurants', 'categories'));
    }

    public function kulinerDetail(Restaurant $restaurant)
    {
        abort_if(!$restaurant->is_active, 404);
        $menus = $restaurant->activeMenus()->orderBy('category')->get()->groupBy('category');

        return view('customer.services.kuliner_detail', compact('restaurant', 'menus'));
    }

    // ─── Iklan & Promosi ──────────────────────────────
    public function promosi()
    {
        $promos = Promotion::active()->latest()->get();

        return view('customer.services.promosi', compact('promos'));
    }

    // ─── Kesehatan ────────────────────────────────────
    public function kesehatan()
    {
        $healthServices = HealthService::available()->get();

        return view('customer.services.kesehatan', compact('healthServices'));
    }

    public function kesehatanDetail(HealthService $healthService)
    {
        abort_if(!$healthService->is_available, 404);

        return view('customer.services.kesehatan_detail', compact('healthService'));
    }

    // ─── Produk ───────────────────────────────────────
    public function produk(Request $request)
    {
        $query = Product::active();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $products   = $query->orderByDesc('sold_count')->paginate(12);
        $categories = Product::active()->distinct()->pluck('category')->filter();

        return view('customer.services.produk', compact('products', 'categories'));
    }

    public function produkDetail(Product $product)
    {
        abort_if(!$product->is_active, 404);
        $related = Product::active()
            ->where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('customer.services.produk_detail', compact('product', 'related'));
    }

    // ─── Percetakan ───────────────────────────────────
    public function pencetakan()
    {
        $tariff = Tariff::getActive('percetakan');

        return view('customer.services.pencetakan', compact('tariff'));
    }

    public function pencetakanOrder(Request $request)
    {
        $request->validate([
            'service_type' => 'required|string',
            'quantity'     => 'required|integer|min:1',
            'notes'        => 'nullable|string|max:500',
        ]);

        // Simpan order percetakan — dikembangkan di fase berikutnya
        return back()->with('success', 'Permintaan percetakan berhasil dikirim. Admin akan menghubungi Anda segera.');
    }

    // ─── Trending (Artikel / Komunitas Info) ──────────
    public function trending(Request $request)
    {
        $query = Article::published();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $articles   = $query->orderByDesc('published_at')->paginate(9);
        $categories = Article::published()->distinct()->pluck('category')->filter();

        return view('customer.services.trending', compact('articles', 'categories'));
    }

    public function trendingDetail(string $slug)
    {
        $article = Article::published()->where('slug', $slug)->firstOrFail();

        // Increment views
        $article->increment('views');

        $related = Article::published()
            ->where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->limit(3)
            ->get();

        return view('customer.services.trending_detail', compact('article', 'related'));
    }

    // ─── Sosial (Feed Komunitas) ──────────────────────
    public function sosial()
    {
        $posts = \App\Models\SocialPost::with('user')
            ->where('status', 'active')
            ->latest()
            ->paginate(10);

        return view('customer.services.sosial', compact('posts'));
    }

    public function sosialPost(Request $request)
    {
        $request->validate([
            'content'  => 'required|string|min:5|max:1000',
            'category' => 'nullable|string',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'user_id'  => auth()->id(),
            'content'  => $request->input('content'),
            'category' => $request->input('category'),
            'status'   => 'active',
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('social', 'public');
        }

        \App\Models\SocialPost::create($data);

        return back()->with('success', 'Postingan berhasil dibuat!');
    }
}
