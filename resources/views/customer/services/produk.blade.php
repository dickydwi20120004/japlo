@extends('layouts.app')
@section('title', 'Produk — JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/services.css') }}">
@endpush

@section('content')
<div class="jp-page-top">
    <div class="container">
        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ route('dashboard') }}" class="btn btn-sm"
               style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);color:#fff;border-radius:8px">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('images/icons/produk.svg') }}" width="40" height="40" alt="Produk">
            <div>
                <h1><i class="fas fa-bag-shopping me-2" style="color:rgba(255,255,255,.8)"></i>Produk</h1>
                <p class="mb-0" style="font-size:.85rem;color:rgba(255,255,255,.8)">Temukan produk terbaik dari penjual lokal Bintan</p>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container">

        {{-- Search & Filter --}}
        <div class="jp-card mb-4">
            <div class="jp-card-body">
                <form method="GET" action="{{ route('customer.produk') }}">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <input type="text" name="search" class="form-control"
                                   placeholder="Cari produk..."
                                   value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4">
                            <select name="category" class="form-select">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-jp-primary w-100">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Product Grid --}}
        @if($products->count() > 0)
            <div class="row g-3">
                @foreach($products as $product)
                    <div class="col-6 col-md-4 col-lg-3">
                        <a href="{{ route('customer.produk.detail', $product) }}" class="product-card">
                            <div style="position:relative">
                                @if($product->image)
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-img">
                                @else
                                    <div class="product-img-placeholder">📦</div>
                                @endif
                                @if($product->discount_percent > 0)
                                    <span class="discount-badge">-{{ $product->discount_percent }}%</span>
                                @endif
                            </div>
                            <div class="product-body">
                                <div class="product-name">{{ $product->name }}</div>

                                {{-- Rating --}}
                                @if($product->rating)
                                    <div class="d-flex align-items-center gap-1 mb-1">
                                        <span class="star-rating">
                                            @for($s = 1; $s <= 5; $s++)
                                                @if($s <= floor($product->rating))
                                                    <i class="fas fa-star"></i>
                                                @elseif($s - 0.5 <= $product->rating)
                                                    <i class="fas fa-star-half-stroke"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </span>
                                        <span style="font-size:.72rem;color:var(--jp-gray-500)">
                                            {{ number_format($product->rating, 1) }}
                                        </span>
                                    </div>
                                @endif

                                {{-- Price --}}
                                <div class="mt-auto">
                                    <div class="product-price">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </div>
                                    @if($product->original_price && $product->original_price > $product->price)
                                        <div class="product-original">
                                            Rp {{ number_format($product->original_price, 0, ',', '.') }}
                                        </div>
                                    @endif
                                    @if($product->sold_count > 0)
                                        <div style="font-size:.72rem;color:var(--jp-gray-400);margin-top:.2rem">
                                            {{ $product->sold_count > 1000
                                                ? number_format($product->sold_count / 1000, 1) . 'rb'
                                                : $product->sold_count }} terjual
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $products->withQueryString()->links() }}
            </div>

        @else
            <div class="jp-empty">
                <div class="empty-icon"><i class="fas fa-bag-shopping"></i></div>
                <p>Tidak ada produk ditemukan</p>
                @if(request('search') || request('category'))
                    <a href="{{ route('customer.produk') }}" class="btn btn-jp-ghost btn-sm">Reset Filter</a>
                @endif
            </div>
        @endif

    </div>
</div>
@endsection

