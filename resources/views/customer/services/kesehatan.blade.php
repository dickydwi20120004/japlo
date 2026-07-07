@extends('layouts.app')

@section('title', 'Kesehatan - JAPLO')

@section('content')
<div class="hero-section" style="padding: 40px 0; background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm mb-3">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <h2 class="fw-bold mb-2 text-white">Layanan Kesehatan</h2>
        <p class="mb-0 text-white">Kesehatan Anda adalah prioritas kami</p>
    </div>
</div>

<div class="container py-4">
    <!-- Emergency Banner -->
    <div class="card mb-4" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); border: none;">
        <div class="card-body text-center text-white py-4">
            <h4 class="fw-bold mb-2">
                <i class="fas fa-ambulance me-2"></i>
                Darurat Medis?
            </h4>
            <p class="mb-3">Hubungi layanan darurat 24/7</p>
            <a href="tel:119" class="btn btn-light btn-lg px-5">
                <i class="fas fa-phone me-2"></i> Hubungi 119
            </a>
        </div>
    </div>

    <!-- Health Services -->
    <h5 class="fw-bold mb-3">Layanan Kesehatan</h5>
    <div class="row">
        @foreach($healthServices as $service)
        <div class="col-md-6 mb-4">
            <div class="card hover-card h-100">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="icon-wrapper d-inline-block p-4 rounded-circle" style="background: rgba(220, 53, 69, 0.1);">
                            <i class="fas {{ $service['icon'] }} fa-3x text-danger"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold text-center mb-2">{{ $service['name'] }}</h5>
                    <p class="text-secondary text-center mb-3">{{ $service['description'] }}</p>
                    <div class="card bg-light mb-3">
                        <div class="card-body text-center">
                            @if($service['price'] > 0)
                                <small class="text-secondary d-block">Mulai dari</small>
                                <h4 class="fw-bold text-danger mb-0">Rp {{ number_format($service['price'], 0, ',', '.') }}</h4>
                            @else
                                <h5 class="fw-bold text-success mb-0">Harga Bervariasi</h5>
                                <small class="text-secondary">Sesuai produk yang dipilih</small>
                            @endif
                        </div>
                    </div>
                    <button class="btn btn-danger w-100" onclick="bookService({{ $service['id'] }}, '{{ $service['name'] }}')">
                        <i class="fas fa-calendar-check me-2"></i> Pesan Sekarang
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Health Articles -->
    <h5 class="fw-bold mb-3 mt-4">Artikel Kesehatan</h5>
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card hover-card">
                <img src="https://via.placeholder.com/400x250?text=Tips+Hidup+Sehat" class="card-img-top" alt="Article">
                <div class="card-body">
                    <span class="badge bg-danger mb-2">Tips Kesehatan</span>
                    <h6 class="fw-bold mb-2">10 Tips Hidup Sehat di Era Modern</h6>
                    <p class="text-secondary small mb-3">Pelajari kebiasaan sehat yang bisa Anda terapkan setiap hari...</p>
                    <a href="#" class="btn btn-outline-danger btn-sm">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card hover-card">
                <img src="https://via.placeholder.com/400x250?text=Vaksinasi" class="card-img-top" alt="Article">
                <div class="card-body">
                    <span class="badge bg-danger mb-2">Informasi</span>
                    <h6 class="fw-bold mb-2">Pentingnya Vaksinasi untuk Keluarga</h6>
                    <p class="text-secondary small mb-3">Vaksinasi melindungi Anda dan keluarga dari penyakit berbahaya...</p>
                    <a href="#" class="btn btn-outline-danger btn-sm">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card hover-card">
                <img src="https://via.placeholder.com/400x250?text=Nutrisi" class="card-img-top" alt="Article">
                <div class="card-body">
                    <span class="badge bg-danger mb-2">Nutrisi</span>
                    <h6 class="fw-bold mb-2">Panduan Nutrisi Seimbang</h6>
                    <p class="text-secondary small mb-3">Makanan bergizi adalah kunci hidup sehat dan produktif...</p>
                    <a href="#" class="btn btn-outline-danger btn-sm">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Health Check Reminder -->
    <div class="card mt-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5 class="fw-bold mb-2">
                        <i class="fas fa-heartbeat me-2 text-danger"></i>
                        Cek Kesehatan Rutin
                    </h5>
                    <p class="text-secondary mb-0">Lakukan pemeriksaan kesehatan rutin minimal 6 bulan sekali untuk deteksi dini masalah kesehatan</p>
                </div>
                <div class="col-md-4 text-end">
                    <button class="btn btn-danger btn-lg">
                        <i class="fas fa-calendar-alt me-2"></i> Jadwalkan
                    </button>
                </div>
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
        border-color: #dc3545;
    }
</style>

<script>
function bookService(id, name) {
    alert('Memesan layanan: ' + name + '\n\nAnda akan dihubungi oleh tim medis kami dalam 15 menit.\n\nFitur booking lengkap akan segera hadir!');
}
</script>
@endsection
