@extends('layouts.app')

@section('title', 'Kuliner - JAPLO')

@section('content')
<div class="hero-section" style="padding: 40px 0; background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm mb-3">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <h2 class="fw-bold mb-2 text-white">Kuliner</h2>
        <p class="mb-0 text-white">Pesan makanan favoritmu dengan mudah</p>
    </div>
</div>

<div class="container py-4">
    <!-- Search Bar -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="input-group input-group-lg">
                <span class="input-group-text">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" class="form-control" placeholder="Cari restoran atau makanan favorit...">
                <button class="btn btn-danger">
                    <i class="fas fa-filter me-2"></i> Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Categories -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Kategori</h5>
            <div class="row text-center">
                <div class="col-4 col-md-2 mb-3">
                    <button class="btn btn-outline-danger w-100">
                        <i class="fas fa-hamburger fa-2x mb-2"></i>
                        <br><small>Fast Food</small>
                    </button>
                </div>
                <div class="col-4 col-md-2 mb-3">
                    <button class="btn btn-outline-danger w-100">
                        <i class="fas fa-drumstick-bite fa-2x mb-2"></i>
                        <br><small>Ayam & Bebek</small>
                    </button>
                </div>
                <div class="col-4 col-md-2 mb-3">
                    <button class="btn btn-outline-danger w-100">
                        <i class="fas fa-bowl-rice fa-2x mb-2"></i>
                        <br><small>Nasi</small>
                    </button>
                </div>
                <div class="col-4 col-md-2 mb-3">
                    <button class="btn btn-outline-danger w-100">
                        <i class="fas fa-coffee fa-2x mb-2"></i>
                        <br><small>Minuman</small>
                    </button>
                </div>
                <div class="col-4 col-md-2 mb-3">
                    <button class="btn btn-outline-danger w-100">
                        <i class="fas fa-ice-cream fa-2x mb-2"></i>
                        <br><small>Dessert</small>
                    </button>
                </div>
                <div class="col-4 col-md-2 mb-3">
                    <button class="btn btn-outline-danger w-100">
                        <i class="fas fa-ellipsis-h fa-2x mb-2"></i>
                        <br><small>Lainnya</small>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Promo Banner -->
    <div class="card mb-4" style="background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%); border: none;">
        <div class="card-body text-center text-white py-4">
            <h4 class="fw-bold mb-2">
                <i class="fas fa-gift me-2"></i>
                Promo Spesial Hari Ini!
            </h4>
            <p class="mb-2">Gratis Ongkir untuk pembelian minimal Rp 50.000</p>
            <span class="badge bg-light text-dark">Kode: GRATISONGKIR</span>
        </div>
    </div>

    <!-- Restaurant List -->
    <h5 class="fw-bold mb-3">Restoran Terdekat</h5>
    <div class="row">
        @foreach($restaurants as $restaurant)
        <div class="col-md-6 mb-4">
            <div class="card hover-card h-100">
                <div class="position-relative">
                    <img src="{{ $restaurant['image'] }}" class="card-img-top" alt="{{ $restaurant['name'] }}" style="height: 200px; object-fit: cover;">
                    @if($restaurant['promo'])
                    <span class="badge bg-danger position-absolute" style="top: 10px; left: 10px;">
                        <i class="fas fa-tag me-1"></i> {{ $restaurant['promo'] }}
                    </span>
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="fw-bold mb-2">{{ $restaurant['name'] }}</h5>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-light text-dark">{{ $restaurant['category'] }}</span>
                        <span class="text-warning fw-bold">
                            <i class="fas fa-star"></i> {{ $restaurant['rating'] }}
                        </span>
                    </div>
                    <p class="text-secondary mb-3">
                        <i class="fas fa-map-marker-alt me-1"></i>
                        {{ $restaurant['distance'] }} km dari lokasi Anda
                    </p>
                    <button class="btn btn-danger w-100" onclick="openRestaurant({{ $restaurant['id'] }})">
                        <i class="fas fa-shopping-cart me-2"></i> Pesan Sekarang
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Popular Items -->
    <h5 class="fw-bold mb-3 mt-4">Makanan Populer</h5>
    <div class="row">
        <div class="col-md-3 col-6 mb-3">
            <div class="card hover-card">
                <img src="https://via.placeholder.com/200x200?text=Nasi+Goreng" class="card-img-top" alt="Nasi Goreng">
                <div class="card-body">
                    <h6 class="fw-bold mb-1">Nasi Goreng Spesial</h6>
                    <p class="text-danger fw-bold mb-2">Rp 25.000</p>
                    <button class="btn btn-sm btn-outline-danger w-100">
                        <i class="fas fa-plus me-1"></i> Tambah
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="card hover-card">
                <img src="https://via.placeholder.com/200x200?text=Ayam+Geprek" class="card-img-top" alt="Ayam Geprek">
                <div class="card-body">
                    <h6 class="fw-bold mb-1">Ayam Geprek Jumbo</h6>
                    <p class="text-danger fw-bold mb-2">Rp 30.000</p>
                    <button class="btn btn-sm btn-outline-danger w-100">
                        <i class="fas fa-plus me-1"></i> Tambah
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="card hover-card">
                <img src="https://via.placeholder.com/200x200?text=Mie+Ayam" class="card-img-top" alt="Mie Ayam">
                <div class="card-body">
                    <h6 class="fw-bold mb-1">Mie Ayam Bakso</h6>
                    <p class="text-danger fw-bold mb-2">Rp 20.000</p>
                    <button class="btn btn-sm btn-outline-danger w-100">
                        <i class="fas fa-plus me-1"></i> Tambah
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="card hover-card">
                <img src="https://via.placeholder.com/200x200?text=Es+Teh" class="card-img-top" alt="Es Teh">
                <div class="card-body">
                    <h6 class="fw-bold mb-1">Es Teh Manis</h6>
                    <p class="text-danger fw-bold mb-2">Rp 5.000</p>
                    <button class="btn btn-sm btn-outline-danger w-100">
                        <i class="fas fa-plus me-1"></i> Tambah
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cart Button (Floating) -->
<button class="btn btn-danger btn-lg position-fixed" style="bottom: 20px; right: 20px; border-radius: 50px; padding: 15px 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.3);" onclick="openCart()">
    <i class="fas fa-shopping-cart me-2"></i>
    Keranjang <span class="badge bg-light text-danger ms-2">0</span>
</button>

<style>
    .hover-card {
        transition: all 0.3s ease;
        border: 1px solid #e0e0e0;
    }
    .hover-card:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        transform: translateY(-4px);
    }
</style>

<script>
function openRestaurant(id) {
    alert('Membuka menu restoran ID: ' + id + '\n\nFitur detail restoran dan menu akan segera hadir!');
}

function openCart() {
    alert('Keranjang belanja Anda masih kosong.\n\nSilakan tambahkan makanan terlebih dahulu!');
}
</script>
@endsection
