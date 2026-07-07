@extends('layouts.app')

@section('title', 'Trending - JAPLO')

@section('content')
<div class="hero-section" style="padding: 40px 0; background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);">
    <div class="container">
        <a href="{{ route('customer.dashboard') }}" class="btn btn-light btn-sm mb-3">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <h2 class="fw-bold mb-2 text-white">
            <i class="fas fa-fire me-2"></i> Trending
        </h2>
        <p class="mb-0 text-white">Konten populer dan viral saat ini</p>
    </div>
</div>

<div class="container py-4">
    <!-- Trending Categories -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex overflow-auto pb-2" style="gap: 10px;">
                <button class="btn btn-warning text-white">
                    <i class="fas fa-fire me-2"></i> Semua
                </button>
                <button class="btn btn-outline-warning">
                    <i class="fas fa-utensils me-2"></i> Kuliner
                </button>
                <button class="btn btn-outline-warning">
                    <i class="fas fa-map-marker-alt me-2"></i> Tempat
                </button>
                <button class="btn btn-outline-warning">
                    <i class="fas fa-tag me-2"></i> Promosi
                </button>
                <button class="btn btn-outline-warning">
                    <i class="fas fa-lightbulb me-2"></i> Tips & Trik
                </button>
            </div>
        </div>
    </div>

    <!-- Top Trending -->
    <h5 class="fw-bold mb-3">
        <i class="fas fa-chart-line me-2 text-warning"></i>
        Top Trending Hari Ini
    </h5>
    
    @foreach($trending as $item)
    <div class="card mb-4 hover-card">
        <div class="row g-0">
            <div class="col-md-5">
                <div class="position-relative">
                    <img src="{{ $item['image'] }}" class="img-fluid rounded-start h-100" style="object-fit: cover; min-height: 250px;" alt="{{ $item['title'] }}">
                    <span class="badge position-absolute" style="top: 15px; left: 15px; background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%); font-size: 1.2rem; padding: 10px 15px;">
                        <i class="fas fa-trophy me-2"></i>#{{ $item['trending_rank'] }}
                    </span>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-warning text-dark">{{ $item['category'] }}</span>
                        <span class="text-secondary">
                            <i class="fas fa-eye me-1"></i>
                            {{ number_format($item['views']) }} views
                        </span>
                    </div>
                    <h3 class="fw-bold mb-3">{{ $item['title'] }}</h3>
                    <p class="text-secondary mb-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.
                    </p>
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-4">
                            <i class="fas fa-heart text-danger me-2"></i>
                            <span class="fw-bold">{{ rand(100, 500) }}</span>
                        </div>
                        <div class="me-4">
                            <i class="fas fa-comment text-primary me-2"></i>
                            <span class="fw-bold">{{ rand(20, 150) }}</span>
                        </div>
                        <div>
                            <i class="fas fa-share text-success me-2"></i>
                            <span class="fw-bold">{{ rand(10, 80) }}</span>
                        </div>
                    </div>
                    
                    <button class="btn btn-warning text-white" onclick="openTrending({{ $item['id'] }})">
                        <i class="fas fa-external-link-alt me-2"></i> Lihat Detail
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Trending Categories Grid -->
    <h5 class="fw-bold mb-3 mt-5">Konten Lainnya</h5>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card hover-card h-100">
                <img src="https://via.placeholder.com/400x300?text=Tempat+Instagramable" class="card-img-top" alt="Tempat">
                <div class="card-body">
                    <span class="badge bg-warning text-dark mb-2">Tempat</span>
                    <h6 class="fw-bold mb-2">10 Spot Instagramable di Jakarta</h6>
                    <p class="text-secondary small mb-3">Temukan spot foto terbaik untuk feed Instagram kamu...</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-secondary small">
                            <i class="fas fa-eye me-1"></i> 8.5K views
                        </span>
                        <a href="#" class="btn btn-sm btn-outline-warning">Baca</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card hover-card h-100">
                <img src="https://via.placeholder.com/400x300?text=Menu+Viral" class="card-img-top" alt="Menu">
                <div class="card-body">
                    <span class="badge bg-warning text-dark mb-2">Kuliner</span>
                    <h6 class="fw-bold mb-2">Menu Viral yang Wajib Dicoba</h6>
                    <p class="text-secondary small mb-3">Jangan sampai ketinggalan menu viral yang lagi hits...</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-secondary small">
                            <i class="fas fa-eye me-1"></i> 7.2K views
                        </span>
                        <a href="#" class="btn btn-sm btn-outline-warning">Baca</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card hover-card h-100">
                <img src="https://via.placeholder.com/400x300?text=Tips+Hemat" class="card-img-top" alt="Tips">
                <div class="card-body">
                    <span class="badge bg-warning text-dark mb-2">Tips & Trik</span>
                    <h6 class="fw-bold mb-2">Cara Hemat Ongkos Transportasi</h6>
                    <p class="text-secondary small mb-3">Tips jitu untuk menghemat pengeluaran transportasi harian...</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-secondary small">
                            <i class="fas fa-eye me-1"></i> 6.8K views
                        </span>
                        <a href="#" class="btn btn-sm btn-outline-warning">Baca</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Community Picks -->
    <div class="card mt-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
        <div class="card-body text-center text-white py-5">
            <h3 class="fw-bold mb-3">
                <i class="fas fa-users me-2"></i>
                Pilihan Komunitas
            </h3>
            <p class="mb-4">Konten yang paling banyak disukai oleh pengguna Japlo</p>
            <button class="btn btn-light btn-lg px-5">
                <i class="fas fa-star me-2"></i> Lihat Semua
            </button>
        </div>
    </div>

    <!-- Trending Topics -->
    <h5 class="fw-bold mb-3 mt-5">Topik Trending</h5>
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-wrap gap-2">
                <a href="#" class="badge bg-light text-dark p-3" style="font-size: 1rem; text-decoration: none;">
                    <i class="fas fa-hashtag me-1"></i> CafeAesthetic
                </a>
                <a href="#" class="badge bg-light text-dark p-3" style="font-size: 1rem; text-decoration: none;">
                    <i class="fas fa-hashtag me-1"></i> PromoHariIni
                </a>
                <a href="#" class="badge bg-light text-dark p-3" style="font-size: 1rem; text-decoration: none;">
                    <i class="fas fa-hashtag me-1"></i> MakananViral
                </a>
                <a href="#" class="badge bg-light text-dark p-3" style="font-size: 1rem; text-decoration: none;">
                    <i class="fas fa-hashtag me-1"></i> TempatWisata
                </a>
                <a href="#" class="badge bg-light text-dark p-3" style="font-size: 1rem; text-decoration: none;">
                    <i class="fas fa-hashtag me-1"></i> TipsHemat
                </a>
                <a href="#" class="badge bg-light text-dark p-3" style="font-size: 1rem; text-decoration: none;">
                    <i class="fas fa-hashtag me-1"></i> JaploFood
                </a>
                <a href="#" class="badge bg-light text-dark p-3" style="font-size: 1rem; text-decoration: none;">
                    <i class="fas fa-hashtag me-1"></i> JaploRide
                </a>
                <a href="#" class="badge bg-light text-dark p-3" style="font-size: 1rem; text-decoration: none;">
                    <i class="fas fa-hashtag me-1"></i> FlashSale
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-card {
        transition: all 0.3s ease;
        border: 2px solid #f0f0f0;
    }
    .hover-card:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        transform: translateY(-4px);
        border-color: #ffc107;
    }
</style>

<script>
function openTrending(id) {
    alert('Membuka konten trending ID: ' + id + '\n\nFitur detail konten akan segera hadir!');
}
</script>
@endsection
