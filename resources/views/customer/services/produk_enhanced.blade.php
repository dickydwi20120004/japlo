@extends('layouts.app')

@section('title', 'Produk - JAPLO')

@section('content')
<div class="hero-section" style="padding: 50px 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm mb-3" style="border-radius: 25px; padding: 8px 16px;">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <h2 class="fw-bold mb-2 text-white display-5">
            <i class="fas fa-shopping-bag me-2"></i> Belanja Produk
        </h2>
        <p class="mb-0 text-white fs-5">Ribuan produk pilihan dengan harga terbaik hanya untuk Anda!</p>
    </div>
</div>

<div class="container py-5">
    <!-- Search & Filter Section -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body p-4">
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-light border-0">
                            <i class="fas fa-search text-primary"></i>
                        </span>
                        <input type="text" class="form-control border-0" placeholder="Cari produk...">
                    </div>
                </div>
                <div class="col-md-6">
                    <select class="form-select form-select-lg border-0 bg-light">
                        <option>Urutkan Berdasarkan</option>
                        <option>Paling Populer</option>
                        <option>Harga Terendah</option>
                        <option>Harga Tertinggi</option>
                        <option>Terbaru</option>
                    </select>
                </div>
            </div>

            <!-- Filter Chips -->
            <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-sm btn-outline-primary rounded-pill active" style="border-radius: 20px;">
                    <i class="fas fa-star me-1"></i> Rating Tinggi
                </button>
                <button class="btn btn-sm btn-outline-primary rounded-pill" style="border-radius: 20px;">
                    <i class="fas fa-tag me-1"></i> Diskon
                </button>
                <button class="btn btn-sm btn-outline-primary rounded-pill" style="border-radius: 20px;">
                    <i class="fas fa-fire me-1"></i> Flash Sale
                </button>
                <button class="btn btn-sm btn-outline-primary rounded-pill" style="border-radius: 20px;">
                    <i class="fas fa-truck me-1"></i> Gratis Ongkir
                </button>
            </div>
        </div>
    </div>

    <!-- Category Section -->
    <h4 class="fw-bold mb-4">
        <i class="fas fa-th-large me-2 text-primary"></i> Kategori Produk
    </h4>

    <div class="row mb-5">
        <div class="col-6 col-md-3 col-lg-2 mb-3">
            <div class="card border-0 text-center p-4 hover-category" style="border-radius: 15px; cursor: pointer; transition: all 0.3s;">
                <i class="fas fa-mobile fa-3x text-primary mb-3"></i>
                <h6 class="fw-bold small">Elektronik</h6>
                <p class="text-muted small mb-0">2,450 produk</p>
            </div>
        </div>
        <div class="col-6 col-md-3 col-lg-2 mb-3">
            <div class="card border-0 text-center p-4 hover-category" style="border-radius: 15px; cursor: pointer; transition: all 0.3s;">
                <i class="fas fa-shoe-prints fa-3x text-danger mb-3"></i>
                <h6 class="fw-bold small">Fashion</h6>
                <p class="text-muted small mb-0">5,120 produk</p>
            </div>
        </div>
        <div class="col-6 col-md-3 col-lg-2 mb-3">
            <div class="card border-0 text-center p-4 hover-category" style="border-radius: 15px; cursor: pointer; transition: all 0.3s;">
                <i class="fas fa-home fa-3x text-success mb-3"></i>
                <h6 class="fw-bold small">Rumah Tangga</h6>
                <p class="text-muted small mb-0">3,890 produk</p>
            </div>
        </div>
        <div class="col-6 col-md-3 col-lg-2 mb-3">
            <div class="card border-0 text-center p-4 hover-category" style="border-radius: 15px; cursor: pointer; transition: all 0.3s;">
                <i class="fas fa-dumbbell fa-3x text-warning mb-3"></i>
                <h6 class="fw-bold small">Olahraga</h6>
                <p class="text-muted small mb-0">1,560 produk</p>
            </div>
        </div>
        <div class="col-6 col-md-3 col-lg-2 mb-3">
            <div class="card border-0 text-center p-4 hover-category" style="border-radius: 15px; cursor: pointer; transition: all 0.3s;">
                <i class="fas fa-book fa-3x text-info mb-3"></i>
                <h6 class="fw-bold small">Buku & Media</h6>
                <p class="text-muted small mb-0">4,230 produk</p>
            </div>
        </div>
        <div class="col-6 col-md-3 col-lg-2 mb-3">
            <div class="card border-0 text-center p-4 hover-category" style="border-radius: 15px; cursor: pointer; transition: all 0.3s;">
                <i class="fas fa-ellipsis-h fa-3x text-secondary mb-3"></i>
                <h6 class="fw-bold small">Lainnya</h6>
                <p class="text-muted small mb-0">8,950 produk</p>
            </div>
        </div>
    </div>

    <!-- Flash Sale Banner -->
    <div class="card mb-5 border-0 overflow-hidden" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
        <div class="card-body p-5 text-center text-white">
            <h3 class="fw-bold mb-3">
                <i class="fas fa-bolt me-2"></i> FLASH SALE - DISKON HINGGA 80%
            </h3>
            <p class="mb-4 fs-6">Promo terbatas hanya untuk 24 jam ke depan!</p>
            <div class="d-flex justify-content-center gap-2 mb-4">
                <div class="bg-white rounded p-2" style="min-width: 50px;">
                    <h5 class="fw-bold text-danger mb-0" id="hours">00</h5>
                    <small class="text-muted">Jam</small>
                </div>
                <div class="align-self-center mx-2 fw-bold">:</div>
                <div class="bg-white rounded p-2" style="min-width: 50px;">
                    <h5 class="fw-bold text-danger mb-0" id="minutes">00</h5>
                    <small class="text-muted">Menit</small>
                </div>
                <div class="align-self-center mx-2 fw-bold">:</div>
                <div class="bg-white rounded p-2" style="min-width: 50px;">
                    <h5 class="fw-bold text-danger mb-0" id="seconds">00</h5>
                    <small class="text-muted">Detik</small>
                </div>
            </div>
            <button class="btn btn-light btn-lg fw-bold px-5" style="border-radius: 30px;">
                <i class="fas fa-rocket me-2"></i> Lihat Flash Sale
            </button>
        </div>
    </div>

    <!-- Products Grid -->
    <h4 class="fw-bold mb-4">
        <i class="fas fa-star me-2 text-warning"></i> Produk Pilihan & Terlaris
    </h4>

    <div class="row">
        @foreach($products as $product)
        <div class="col-12 col-md-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm hover-product" style="border-radius: 15px; overflow: hidden; transition: all 0.3s ease;">
                <!-- Product Image -->
                <div class="position-relative" style="height: 220px; overflow: hidden;">
                    <img src="{{ $product['image'] }}" class="w-100 h-100" alt="{{ $product['name'] }}" style="object-fit: cover;">
                    
                    <!-- Discount Badge -->
                    @php
                        $discount = (($product['original_price'] - $product['price']) / $product['original_price'] * 100);
                    @endphp
                    <div class="position-absolute top-0 start-0 m-2">
                        <span class="badge bg-danger shadow-lg" style="padding: 8px 12px; border-radius: 20px; font-size: 14px; font-weight: bold;">
                            -{{ round($discount) }}%
                        </span>
                    </div>

                    <!-- Wishlist Button -->
                    <button class="btn btn-light position-absolute top-0 end-0 m-2 rounded-circle" style="width: 40px; height: 40px; padding: 0; border: none;" onclick="toggleWishlist(event)">
                        <i class="fas fa-heart text-danger"></i>
                    </button>

                    <!-- Category Badge -->
                    <div class="position-absolute bottom-0 start-0 m-2">
                        <span class="badge bg-dark" style="border-radius: 20px; padding: 6px 12px;">{{ $product['category'] }}</span>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="card-body p-3">
                    <!-- Product Name -->
                    <h6 class="fw-bold mb-2" style="font-size: 14px; line-height: 1.3; height: 36px; overflow: hidden;">
                        {{ $product['name'] }}
                    </h6>

                    <!-- Rating & Sold -->
                    <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                        <div>
                            <i class="fas fa-star text-warning"></i>
                            <span class="small fw-bold">{{ $product['rating'] }}</span>
                        </div>
                        <small class="text-muted">{{ $product['sold'] }} terjual</small>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <h5 class="fw-bold text-danger mb-1">Rp {{ number_format($product['price'], 0, ',', '.') }}</h5>
                        <del class="text-muted small">Rp {{ number_format($product['original_price'], 0, ',', '.') }}</del>
                    </div>

                    <!-- Add to Cart Button -->
                    <button class="btn btn-danger w-100 fw-bold" style="border-radius: 12px; padding: 8px;" onclick="goToDetail({{ $product['id'] }})">
                        <i class="fas fa-shopping-cart me-2"></i> Beli Sekarang
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Load More Button -->
    <div class="text-center mb-5">
        <button class="btn btn-outline-primary btn-lg px-5" style="border-radius: 30px;">
            <i class="fas fa-redo me-2"></i> Tampilkan Lebih Banyak
        </button>
    </div>

    <!-- Benefits Section -->
    <h4 class="fw-bold mb-4 mt-5">
        <i class="fas fa-check-circle me-2 text-success"></i> Keuntungan Belanja di JAPLO
    </h4>

    <div class="row">
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 p-4 text-center hover-card" style="border-radius: 15px;">
                <i class="fas fa-percent fa-3x text-danger mb-3"></i>
                <h6 class="fw-bold">Harga Terjangkau</h6>
                <p class="small text-muted">Bandingkan harga termurah se-Indonesia</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 p-4 text-center hover-card" style="border-radius: 15px;">
                <i class="fas fa-box fa-3x text-primary mb-3"></i>
                <h6 class="fw-bold">Pengiriman Cepat</h6>
                <p class="small text-muted">Gratis ongkir pembelian min. Rp 100k</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 p-4 text-center hover-card" style="border-radius: 15px;">
                <i class="fas fa-shield-alt fa-3x text-success mb-3"></i>
                <h6 class="fw-bold">Transaksi Aman</h6>
                <p class="small text-muted">Enkripsi tingkat bank & privasi terjamin</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 p-4 text-center hover-card" style="border-radius: 15px;">
                <i class="fas fa-undo-alt fa-3x text-warning mb-3"></i>
                <h6 class="fw-bold">30 Hari Garansi</h6>
                <p class="small text-muted">Jaminan uang kembali 100% tanpa ribet</p>
            </div>
        </div>
    </div>
</div>

<!-- Floating Cart Button -->
<button class="btn btn-danger btn-lg position-fixed shadow-lg" 
        style="bottom: 20px; right: 20px; border-radius: 50px; padding: 12px 24px; z-index: 1000;" 
        onclick="openCart()"
        id="cartButton">
    <i class="fas fa-shopping-cart me-2"></i>
    <span class="badge bg-light text-danger ms-2" id="cartCount">0</span>
</button>

<!-- Wishlist Notification -->
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 11;">
    <div class="toast" id="wishlistToast" role="alert">
        <div class="toast-body bg-success text-white">
            <i class="fas fa-heart me-2"></i> <span id="wishlistMessage">Produk ditambahkan ke wishlist!</span>
        </div>
    </div>
</div>

<style>
    .hover-product {
        transition: all 0.3s ease;
    }
    
    .hover-product:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(102, 126, 234, 0.2) !important;
    }

    .hover-category {
        transition: all 0.3s ease;
    }

    .hover-category:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1) !important;
    }

    .hover-card {
        transition: all 0.3s ease;
    }

    .hover-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1) !important;
    }

    #cartButton {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
</style>

<script>
let cartCount = 0;
let wishlistItems = [];

function addToCart(name, price) {
    window.location.href = '/customer/produk/' + getProductIdByName(name);
}

function goToDetail(productId) {
    window.location.href = '/customer/produk/' + productId;
}

function toggleWishlist(event) {
    event.preventDefault();
    event.stopPropagation();
    
    const btn = event.target.closest('button');
    const icon = btn.querySelector('i');
    
    if (icon.classList.contains('fas')) {
        icon.classList.remove('fas');
        icon.classList.add('far');
        document.getElementById('wishlistMessage').textContent = 'Produk dihapus dari wishlist!';
    } else {
        icon.classList.remove('far');
        icon.classList.add('fas');
        document.getElementById('wishlistMessage').textContent = 'Produk ditambahkan ke wishlist!';
    }
    
    const toast = new bootstrap.Toast(document.getElementById('wishlistToast'));
    toast.show();
}

function openCart() {
    if (cartCount === 0) {
        alert('🛒 Keranjang belanja kosong.\n\nSilakan tambahkan produk terlebih dahulu!');
    } else {
        alert('🛒 Total Items: ' + cartCount + '\n\nFitur checkout akan segera hadir!');
    }
}

// Flash Sale Countdown
function updateCountdown() {
    const now = new Date();
    const endTime = new Date();
    endTime.setDate(endTime.getDate() + 1); // Flash sale berakhir besok
    
    const diff = endTime - now;
    const hours = Math.floor(diff / (1000 * 60 * 60));
    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((diff % (1000 * 60)) / 1000);
    
    document.getElementById('hours').textContent = String(hours).padStart(2, '0');
    document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
    document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
}

setInterval(updateCountdown, 1000);
updateCountdown();
</script>
@endsection
