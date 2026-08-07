@extends('layouts.app')

@section('title', 'Kuliner - JAPLO')

@section('content')
<div class="hero-section" style="padding: 50px 0; background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm mb-3" style="border-radius: 25px; padding: 8px 16px;">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <h2 class="fw-bold mb-2 text-white display-5">
            <i class="fas fa-utensils me-2"></i> Kuliner
        </h2>
        <p class="mb-0 text-white fs-5">Pesan makanan lezat dari restoran pilihan dengan mudah dan cepat!</p>
    </div>
</div>

<div class="container py-5">
    <!-- Search Bar -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body p-4">
            <div class="input-group input-group-lg">
                <span class="input-group-text bg-light border-0">
                    <i class="fas fa-search text-danger"></i>
                </span>
                <input type="text" class="form-control border-0" id="searchRestoran" placeholder="Cari restoran atau makanan favorit...">
                <button class="btn btn-danger" onclick="openFilterModal()">
                    <i class="fas fa-filter me-2"></i> Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Categories -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-4">
                <i class="fas fa-th me-2"></i> Kategori Populer
            </h5>
            <div class="row text-center g-3">
                <div class="col-4 col-md-2">
                    <button class="btn btn-outline-danger w-100 py-3 rounded-3 hover-category" onclick="filterByCategory('fast-food')">
                        <i class="fas fa-hamburger fa-2x d-block mb-2"></i>
                        <small class="d-block fw-bold">Fast Food</small>
                    </button>
                </div>
                <div class="col-4 col-md-2">
                    <button class="btn btn-outline-danger w-100 py-3 rounded-3 hover-category" onclick="filterByCategory('ayam')">
                        <i class="fas fa-drumstick-bite fa-2x d-block mb-2"></i>
                        <small class="d-block fw-bold">Ayam</small>
                    </button>
                </div>
                <div class="col-4 col-md-2">
                    <button class="btn btn-outline-danger w-100 py-3 rounded-3 hover-category" onclick="filterByCategory('nasi')">
                        <i class="fas fa-bowl-rice fa-2x d-block mb-2"></i>
                        <small class="d-block fw-bold">Nasi</small>
                    </button>
                </div>
                <div class="col-4 col-md-2">
                    <button class="btn btn-outline-danger w-100 py-3 rounded-3 hover-category" onclick="filterByCategory('minuman')">
                        <i class="fas fa-coffee fa-2x d-block mb-2"></i>
                        <small class="d-block fw-bold">Minuman</small>
                    </button>
                </div>
                <div class="col-4 col-md-2">
                    <button class="btn btn-outline-danger w-100 py-3 rounded-3 hover-category" onclick="filterByCategory('dessert')">
                        <i class="fas fa-ice-cream fa-2x d-block mb-2"></i>
                        <small class="d-block fw-bold">Dessert</small>
                    </button>
                </div>
                <div class="col-4 col-md-2">
                    <button class="btn btn-outline-danger w-100 py-3 rounded-3 hover-category" onclick="showAllCategories()">
                        <i class="fas fa-ellipsis-h fa-2x d-block mb-2"></i>
                        <small class="d-block fw-bold">Lainnya</small>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Promo Banner -->
    <div class="card mb-5 border-0" style="background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);">
        <div class="card-body p-5 text-center text-white">
            <h3 class="fw-bold mb-3">
                <i class="fas fa-gift me-2"></i> Promo Spesial Hari Ini!
            </h3>
            <p class="mb-3 fs-5">Gratis Ongkir untuk pembelian minimal Rp 50.000</p>
            <span class="badge bg-light text-dark fs-6 px-3 py-2">Kode: GRATISONGKIR</span>
        </div>
    </div>

    <!-- Restaurant List -->
    <h4 class="fw-bold mb-4">
        <i class="fas fa-map-marker-alt me-2 text-danger"></i> Restoran Terdekat
    </h4>
    <div class="row">
        @foreach($restaurants as $restaurant)
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm hover-restaurant" style="border-radius: 20px; overflow: hidden; transition: all 0.3s ease;">
                <!-- Image Container -->
                <div class="position-relative" style="height: 200px; overflow: hidden;">
                    <img src="{{ $restaurant['image'] }}" class="w-100 h-100" alt="{{ $restaurant['name'] }}" style="object-fit: cover;">
                    
                    <!-- Promo Badge -->
                    @if($restaurant['promo'])
                    <span class="badge bg-danger position-absolute" style="top: 12px; left: 12px; padding: 8px 12px; border-radius: 20px; font-size: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                        <i class="fas fa-tag me-1"></i> {{ $restaurant['promo'] }}
                    </span>
                    @endif

                    <!-- Rating Badge -->
                    <div class="position-absolute top-0 end-0 m-3">
                        <div class="bg-white rounded-pill px-3 py-2 shadow-sm" style="display: flex; align-items: center; gap: 4px;">
                            <i class="fas fa-star text-warning"></i>
                            <span class="fw-bold text-dark">{{ $restaurant['rating'] }}</span>
                        </div>
                    </div>

                    <!-- Status Overlay -->
                    <div class="position-absolute bottom-0 start-0 end-0" style="background: linear-gradient(to top, rgba(0,0,0,0.6), transparent); padding: 20px 15px 15px;">
                        <p class="text-white fw-bold mb-0 small">
                            <i class="fas fa-map-marker-alt me-1"></i>
                            {{ $restaurant['distance'] }} km
                        </p>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-4">
                    <!-- Restaurant Name -->
                    <h5 class="fw-bold mb-2" style="font-size: 18px; line-height: 1.3;">{{ $restaurant['name'] }}</h5>
                    
                    <!-- Category & Info -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-light text-dark fw-bold" style="border-radius: 20px; padding: 6px 12px;">
                            {{ $restaurant['category'] }}
                        </span>
                    </div>

                    <!-- Order Button -->
                    <button class="btn btn-danger w-100 fw-bold" style="border-radius: 15px; padding: 12px; transition: all 0.3s;" onclick="orderRestaurant('{{ $restaurant['name'] }}', {{ $restaurant['id'] }})">
                        <i class="fas fa-shopping-cart me-2"></i> Lihat Menu
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Popular Items Section -->
    <h4 class="fw-bold mb-4 mt-5">
        <i class="fas fa-fire me-2 text-danger"></i> Makanan Populer
    </h4>
    <div class="row">
        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm hover-item" style="border-radius: 15px; overflow: hidden;">
                <div style="height: 160px; overflow: hidden;">
                    <img src="https://via.placeholder.com/300x200?text=Nasi+Goreng" class="w-100 h-100" alt="Nasi Goreng" style="object-fit: cover;">
                </div>
                <div class="card-body p-3">
                    <h6 class="fw-bold mb-2">Nasi Goreng Spesial</h6>
                    <p class="text-danger fw-bold mb-2">Rp 25.000</p>
                    <button class="btn btn-sm btn-outline-danger w-100 rounded-2" onclick="orderItem('Nasi Goreng Spesial', 25000)">
                        <i class="fas fa-plus me-1"></i> Pesan
                    </button>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm hover-item" style="border-radius: 15px; overflow: hidden;">
                <div style="height: 160px; overflow: hidden;">
                    <img src="https://via.placeholder.com/300x200?text=Ayam+Geprek" class="w-100 h-100" alt="Ayam Geprek" style="object-fit: cover;">
                </div>
                <div class="card-body p-3">
                    <h6 class="fw-bold mb-2">Ayam Geprek Jumbo</h6>
                    <p class="text-danger fw-bold mb-2">Rp 30.000</p>
                    <button class="btn btn-sm btn-outline-danger w-100 rounded-2" onclick="orderItem('Ayam Geprek Jumbo', 30000)">
                        <i class="fas fa-plus me-1"></i> Pesan
                    </button>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm hover-item" style="border-radius: 15px; overflow: hidden;">
                <div style="height: 160px; overflow: hidden;">
                    <img src="https://via.placeholder.com/300x200?text=Mie+Ayam" class="w-100 h-100" alt="Mie Ayam" style="object-fit: cover;">
                </div>
                <div class="card-body p-3">
                    <h6 class="fw-bold mb-2">Mie Ayam Bakso</h6>
                    <p class="text-danger fw-bold mb-2">Rp 20.000</p>
                    <button class="btn btn-sm btn-outline-danger w-100 rounded-2" onclick="orderItem('Mie Ayam Bakso', 20000)">
                        <i class="fas fa-plus me-1"></i> Pesan
                    </button>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm hover-item" style="border-radius: 15px; overflow: hidden;">
                <div style="height: 160px; overflow: hidden;">
                    <img src="https://via.placeholder.com/300x200?text=Es+Teh" class="w-100 h-100" alt="Es Teh" style="object-fit: cover;">
                </div>
                <div class="card-body p-3">
                    <h6 class="fw-bold mb-2">Es Teh Manis</h6>
                    <p class="text-danger fw-bold mb-2">Rp 5.000</p>
                    <button class="btn btn-sm btn-outline-danger w-100 rounded-2" onclick="orderItem('Es Teh Manis', 5000)">
                        <i class="fas fa-plus me-1"></i> Pesan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Why Order From JAPLO -->
    <h4 class="fw-bold mb-4 mt-5">
        <i class="fas fa-check-circle me-2 text-success"></i> Mengapa Pesan di JAPLO?
    </h4>
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card border-0 text-center p-4 hover-card" style="border-radius: 15px;">
                <i class="fas fa-clock fa-3x text-primary mb-3"></i>
                <h6 class="fw-bold">Cepat & Tepat Waktu</h6>
                <p class="small text-muted">Pengiriman dalam 30 menit</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 text-center p-4 hover-card" style="border-radius: 15px;">
                <i class="fas fa-shield-alt fa-3x text-success mb-3"></i>
                <h6 class="fw-bold">Higienis & Aman</h6>
                <p class="small text-muted">Makanan terjamin kualitasnya</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 text-center p-4 hover-card" style="border-radius: 15px;">
                <i class="fas fa-money-bill-wave fa-3x text-warning mb-3"></i>
                <h6 class="fw-bold">Harga Terjangkau</h6>
                <p class="small text-muted">Banyak promo dan diskon</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 text-center p-4 hover-card" style="border-radius: 15px;">
                <i class="fas fa-headset fa-3x text-danger mb-3"></i>
                <h6 class="fw-bold">Customer Support 24/7</h6>
                <p class="small text-muted">Siap membantu kapan saja</p>
            </div>
        </div>
    </div>
</div>

<!-- Floating Cart Button -->
<button class="btn btn-danger btn-lg position-fixed shadow-lg" 
        style="bottom: 20px; right: 20px; border-radius: 50px; padding: 12px 24px; z-index: 1000; transition: all 0.3s;" 
        onclick="openCart()"
        id="cartButton">
    <i class="fas fa-shopping-cart me-2"></i>
    <span class="badge bg-light text-danger ms-2" id="cartCount">0</span>
</button>

<style>
    .hover-restaurant {
        transition: all 0.3s ease;
    }
    
    .hover-restaurant:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(220, 53, 69, 0.2) !important;
    }

    .hover-item {
        transition: all 0.3s ease;
    }

    .hover-item:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15) !important;
    }

    .hover-category {
        transition: all 0.3s ease;
    }

    .hover-category:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2) !important;
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

function filterByCategory(category) {
    alert('✅ Filter kategori: ' + category + '\n\nRestoran ditampilkan sesuai kategori yang dipilih.');
}

function showAllCategories() {
    alert('📂 Kategori Lainnya:\n- Seafood\n- Vegetarian\n- Chinese Food\n- Cafe\n- Bakery');
}

function openFilterModal() {
    alert('🔧 Filter Restoran\n\nAnda dapat memfilter berdasarkan:\n- Rating\n- Jarak\n- Harga\n- Waktu pengiriman');
}

function orderRestaurant(name, id) {
    window.location.href = '/customer/kuliner/' + id;
}

function orderItem(name, price) {
    cartCount++;
    document.getElementById('cartCount').textContent = cartCount;
    alert('✅ ' + name + ' (Rp ' + price.toLocaleString() + ') ditambahkan ke keranjang!');
}

function openCart() {
    if (cartCount === 0) {
        alert('🛒 Keranjang belanja kosong.\n\nSilakan tambahkan makanan terlebih dahulu!');
    } else {
        alert('🛒 Total Items: ' + cartCount + '\n\nFitur checkout akan segera hadir!');
    }
}

// Search functionality
document.getElementById('searchRestoran')?.addEventListener('keyup', function(e) {
    if (e.target.value.length > 0) {
        console.log('Mencari: ' + e.target.value);
    }
});
</script>
@endsection
