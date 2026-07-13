@extends('layouts.app')

@section('title', 'Produk - JAPLO')

@section('content')
<div class="hero-section" style="padding: 40px 0; background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm mb-3">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <h2 class="fw-bold mb-2 text-white">Belanja Produk</h2>
        <p class="mb-0 text-white">Temukan produk terbaik dengan harga terjangkau</p>
    </div>
</div>

<div class="container py-4">
    <!-- Search & Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-9 mb-3 mb-md-0">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Cari produk yang Anda inginkan...">
                        <button class="btn btn-info text-white">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-outline-info btn-lg w-100">
                        <i class="fas fa-filter me-2"></i> Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Kategori Produk</h5>
            <div class="d-flex overflow-auto pb-2" style="gap: 10px;">
                <button class="btn btn-info text-white">
                    <i class="fas fa-th-large me-2"></i> Semua
                </button>
                <button class="btn btn-outline-info">
                    <i class="fas fa-laptop me-2"></i> Elektronik
                </button>
                <button class="btn btn-outline-info">
                    <i class="fas fa-tshirt me-2"></i> Fashion
                </button>
                <button class="btn btn-outline-info">
                    <i class="fas fa-home me-2"></i> Rumah Tangga
                </button>
                <button class="btn btn-outline-info">
                    <i class="fas fa-book me-2"></i> Buku & Alat Tulis
                </button>
                <button class="btn btn-outline-info">
                    <i class="fas fa-football-ball me-2"></i> Olahraga
                </button>
            </div>
        </div>
    </div>

    <!-- Flash Sale Banner -->
    <div class="card mb-4" style="background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%); border: none;">
        <div class="card-body text-center text-white py-4">
            <h4 class="fw-bold mb-2">
                <i class="fas fa-bolt me-2"></i>
                FLASH SALE! Diskon hingga 70%
            </h4>
            <p class="mb-0">Buruan sebelum kehabisan!</p>
        </div>
    </div>

    <!-- Products Grid -->
    <h5 class="fw-bold mb-3">Produk Pilihan</h5>
    <div class="row">
        @foreach($products as $product)
        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="card hover-card h-100">
                <div class="position-relative">
                    <img src="{{ $product['image'] }}" class="card-img-top" alt="{{ $product['name'] }}" style="height: 200px; object-fit: cover;">
                    @php
                        $discount = round((($product['original_price'] - $product['price']) / $product['original_price']) * 100);
                    @endphp
                    @if($discount > 0)
                    <span class="badge bg-danger position-absolute" style="top: 10px; left: 10px;">
                        -{{ $discount }}%
                    </span>
                    @endif
                </div>
                <div class="card-body">
                    <small class="text-secondary">{{ $product['category'] }}</small>
                    <h6 class="fw-bold mb-2" style="height: 40px; overflow: hidden;">{{ $product['name'] }}</h6>
                    
                    @if($product['original_price'] > $product['price'])
                    <p class="text-decoration-line-through text-secondary small mb-1">
                        Rp {{ number_format($product['original_price'], 0, ',', '.') }}
                    </p>
                    @endif
                    <h5 class="fw-bold text-info mb-2">Rp {{ number_format($product['price'], 0, ',', '.') }}</h5>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-warning small">
                            <i class="fas fa-star"></i> {{ $product['rating'] }}
                        </span>
                        <span class="text-secondary small">Terjual {{ $product['sold'] }}</span>
                    </div>
                    
                    <button class="btn btn-info text-white w-100" onclick="addToCart({{ $product['id'] }}, '{{ $product['name'] }}')">
                        <i class="fas fa-shopping-cart me-2"></i> Beli
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Load More -->
    <div class="text-center mt-4">
        <button class="btn btn-outline-info btn-lg px-5">
            <i class="fas fa-sync-alt me-2"></i> Muat Lebih Banyak
        </button>
    </div>

    <!-- Features -->
    <div class="card mt-5">
        <div class="card-body">
            <h5 class="fw-bold mb-4 text-center">Kenapa Belanja di Japlo?</h5>
            <div class="row text-center">
                <div class="col-md-3 col-6 mb-3">
                    <i class="fas fa-shield-alt fa-3x text-info mb-3"></i>
                    <h6 class="fw-bold">100% Aman</h6>
                    <p class="text-secondary small">Transaksi dijamin aman</p>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <i class="fas fa-shipping-fast fa-3x text-info mb-3"></i>
                    <h6 class="fw-bold">Gratis Ongkir</h6>
                    <p class="text-secondary small">Untuk pembelian tertentu</p>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <i class="fas fa-undo-alt fa-3x text-info mb-3"></i>
                    <h6 class="fw-bold">Mudah Return</h6>
                    <p class="text-secondary small">30 hari pengembalian</p>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <i class="fas fa-headset fa-3x text-info mb-3"></i>
                    <h6 class="fw-bold">CS 24/7</h6>
                    <p class="text-secondary small">Siap membantu Anda</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Shopping Cart Button (Floating) -->
<button class="btn btn-info btn-lg position-fixed text-white shadow-lg" 
        style="bottom: 20px; right: 20px; border-radius: 50px; padding: 12px 24px; z-index: 1000;" 
        onclick="openCart()">
    <i class="fas fa-shopping-cart me-2"></i>
    <span class="d-none d-sm-inline">Keranjang</span>
    <span class="badge bg-light text-info ms-2">0</span>
</button>

<style>
    .hover-card {
        transition: all 0.3s ease;
        border: 2px solid #f0f0f0;
    }
    .hover-card:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        transform: translateY(-4px);
        border-color: #17a2b8;
    }
</style>

<script>
function addToCart(id, name) {
    alert('Produk "' + name + '" ditambahkan ke keranjang!\n\nFitur keranjang belanja lengkap akan segera hadir.');
}

function openCart() {
    alert('Keranjang belanja Anda masih kosong.\n\nSilakan tambahkan produk terlebih dahulu!');
}
</script>
@endsection
