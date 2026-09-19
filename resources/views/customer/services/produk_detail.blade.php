@extends('layouts.app')
@section('title', $product->name . ' — JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/services.css') }}">
@endpush

@section('content')
<div class="jp-page-top">
    <div class="container">
        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ route('customer.produk') }}" class="btn btn-sm"
               style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);color:#fff;border-radius:8px">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <h1>{{ $product->name }}</h1>
        @if($product->category)
            <span style="font-size:.78rem;color:rgba(255,255,255,.7)">
                <i class="fas fa-tag me-1"></i>{{ $product->category }}
            </span>
        @endif
    </div>
</div>

<div class="page-body">
    <div class="container">
        <div class="row g-4">

            {{-- Left: Product Detail --}}
            <div class="col-lg-8">

                {{-- Product Image & Price --}}
                <div class="jp-card mb-4 overflow-hidden">
                    @if($product->image)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-main-img">
                    @else
                        <div class="product-main-placeholder">📦</div>
                    @endif
                    <div class="jp-card-body">
                        <div class="d-flex align-items-start justify-content-between gap-3 flex-wrap">
                            <div>
                                <h2 style="font-size:1.2rem;font-weight:700;margin-bottom:.4rem">{{ $product->name }}</h2>
                                @if($product->category)
                                    <span class="jp-badge" style="background:var(--jp-green-light);color:var(--jp-green);font-size:.72rem">
                                        {{ $product->category }}
                                    </span>
                                @endif
                            </div>
                            <div style="text-align:right">
                                <div style="font-size:1.5rem;font-weight:800;color:var(--jp-green)">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </div>
                                @if($product->original_price && $product->original_price > $product->price)
                                    <div style="font-size:.875rem;color:var(--jp-gray-400);text-decoration:line-through">
                                        Rp {{ number_format($product->original_price, 0, ',', '.') }}
                                    </div>
                                    <div style="font-size:.78rem;font-weight:700;color:var(--jp-red)">
                                        Hemat {{ $product->discount_percent }}%
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Rating & Stats --}}
                        <div class="d-flex align-items-center gap-3 mt-3 flex-wrap" style="font-size:.8375rem">
                            @if($product->rating)
                                <div class="d-flex align-items-center gap-1">
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
                                    <span style="font-weight:600">{{ number_format($product->rating, 1) }}</span>
                                </div>
                            @endif
                            @if($product->sold_count > 0)
                                <span style="color:var(--jp-gray-400)">
                                    <i class="fas fa-shopping-bag me-1"></i>
                                    {{ $product->sold_count }} terjual
                                </span>
                            @endif
                            <span style="color:{{ $product->stock > 10 ? 'var(--jp-green)' : ($product->stock > 0 ? 'var(--jp-amber)' : 'var(--jp-red)') }};font-weight:600">
                                <i class="fas fa-box me-1"></i>
                                @if($product->stock > 0)
                                    Stok: {{ $product->stock }}
                                @else
                                    Stok Habis
                                @endif
                            </span>
                        </div>

                        <hr style="border-color:var(--jp-gray-200);margin:1rem 0">

                        {{-- Description --}}
                        @if($product->description)
                            <div style="font-size:.9rem;color:var(--jp-gray-700);line-height:1.75">
                                {{ $product->description }}
                            </div>
                        @endif

                        {{-- Product Info --}}
                        <div style="margin-top:1rem">
                            @if($product->weight)
                                <div class="info-row">
                                    <span class="info-label">Berat</span>
                                    <span class="info-value">{{ $product->weight }} kg</span>
                                </div>
                            @endif
                            @if($product->seller)
                                <div class="info-row">
                                    <span class="info-label">Penjual</span>
                                    <span class="info-value">{{ $product->seller->name }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- Add to Cart --}}
                        <div class="mt-3 d-flex gap-2">
                            @if($product->stock > 0)
                                <button class="btn btn-jp-primary flex-grow-1"
                                        onclick="JapToast.info('Fitur keranjang segera hadir! 🛒')">
                                    <i class="fas fa-cart-plus me-2"></i> Tambah ke Keranjang
                                </button>
                                <button class="btn btn-jp-outline"
                                        onclick="JapToast.info('Fitur beli langsung segera hadir!')">
                                    <i class="fas fa-bolt"></i>
                                </button>
                            @else
                                <button class="btn btn-jp-ghost flex-grow-1" disabled>
                                    <i class="fas fa-times me-2"></i> Stok Habis
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right: Related & Seller --}}
            <div class="col-lg-4">
                {{-- Seller Info --}}
                @if($product->seller)
                    <div class="jp-card mb-4">
                        <div class="jp-card-header">
                            <span><i class="fas fa-store me-2 text-jp-green"></i>Penjual</span>
                        </div>
                        <div class="jp-card-body d-flex align-items-center gap-3">
                            <div style="width:44px;height:44px;border-radius:50%;background:var(--jp-green);display:flex;align-items:center;justify-content:center;font-size:1.1rem;font-weight:700;color:#fff;flex-shrink:0">
                                {{ strtoupper(substr($product->seller->name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight:700;font-size:.875rem">{{ $product->seller->name }}</div>
                                <div style="font-size:.75rem;color:var(--jp-gray-400)">Penjual Terverifikasi</div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Related Products --}}
                @if($related->count() > 0)
                    <div class="jp-card">
                        <div class="jp-card-header">
                            <span><i class="fas fa-bag-shopping me-2 text-jp-green"></i>Produk Terkait</span>
                        </div>
                        <div class="jp-card-body p-2">
                            @foreach($related as $rel)
                                <a href="{{ route('customer.produk.detail', $rel) }}" class="related-card">
                                    @if($rel->image)
                                        <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}"
                                             style="width:60px;height:60px;border-radius:8px;object-fit:cover;flex-shrink:0">
                                    @else
                                        <div class="rel-placeholder">📦</div>
                                    @endif
                                    <div>
                                        <div class="rel-name">{{ $rel->name }}</div>
                                        <div class="rel-price">Rp {{ number_format($rel->price, 0, ',', '.') }}</div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection

