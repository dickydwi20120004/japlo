@extends('layouts.app')

@section('title', 'JAPLO - Jasa Pengantar Lokal')

@section('content')
<!-- Hero Section dengan Background Driver -->
<div class="hero-driver-bg">
    <div class="hero-content-wrapper">
        <div class="container py-5">
            <div class="row align-items-center" style="min-height: 500px;">
                <div class="col-lg-7 text-white">
                    <h1 class="display-3 fw-bold mb-4" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                        Mulai hasilkan uang sekarang juga
                    </h1>
                    <p class="lead mb-4" style="font-size: 1.3rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
                        Bergabung sebagai driver JAPLO dan nikmati penghasilan tambahan dengan fleksibilitas waktu
                    </p>
                    <a href="{{ route('register') }}?role=driver" class="btn btn-warning btn-lg px-5 py-3 fw-bold shadow-lg" style="font-size: 1.2rem;">
                        <i class="fas fa-rocket me-2"></i> Daftar Jadi Driver
                    </a>
                    
                    <!-- Feature Points -->
                    <div class="row mt-5">
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Akses ke order langsung</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-check-circle fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Bekerja kapan saja</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-car fa-2x"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Bekerja dengan jasa transportasi</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Secondary Section - Customer CTA -->
<div class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=600&q=80" 
                     alt="Customer" 
                     class="img-fluid rounded-3 shadow-lg">
            </div>
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold mb-4">Butuh Transportasi Cepat?</h2>
                <p class="lead text-secondary mb-4">
                    Pesan ojek atau taksi online dengan mudah, driver datang langsung ke lokasi Anda
                </p>
                <div class="mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-check-circle text-success fa-2x me-3"></i>
                        <span class="h5 mb-0">Harga transparan dan terjangkau</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-check-circle text-success fa-2x me-3"></i>
                        <span class="h5 mb-0">Driver terverifikasi dan ramah</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-check-circle text-success fa-2x me-3"></i>
                        <span class="h5 mb-0">Tracking real-time perjalanan</span>
                    </div>
                </div>
                <a href="{{ route('register') }}?role=user" class="btn btn-primary btn-lg px-5 py-3">
                    <i class="fas fa-user-plus me-2"></i> Daftar sebagai Penumpang
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Features Section -->
    <div class="row mb-5">
        <div class="col-md-12 text-center mb-4">
            <h2 class="fw-bold">Kenapa Pilih JAPLO?</h2>
            <p class="text-secondary">Layanan terbaik untuk perjalanan Anda</p>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card feature-card">
                <i class="fas fa-bolt text-warning"></i>
                <h5 class="fw-bold">Cepat & Mudah</h5>
                <p class="text-secondary">Pesan ojek hanya dalam hitungan detik</p>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card feature-card">
                <i class="fas fa-shield-alt text-success"></i>
                <h5 class="fw-bold">Aman & Terpercaya</h5>
                <p class="text-secondary">Driver terverifikasi dan terpercaya</p>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card feature-card">
                <i class="fas fa-money-bill-wave text-primary"></i>
                <h5 class="fw-bold">Harga Terjangkau</h5>
                <p class="text-secondary">Tarif transparan dan kompetitif</p>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card feature-card">
                <i class="fas fa-star text-danger"></i>
                <h5 class="fw-bold">Rating Tinggi</h5>
                <p class="text-secondary">Driver dengan rating terbaik</p>
            </div>
        </div>
    </div>

    <!-- How It Works -->
    <div class="row mb-5">
        <div class="col-md-12 text-center mb-4">
            <h2 class="fw-bold">Cara Kerjanya</h2>
            <p class="text-secondary">3 langkah mudah untuk perjalanan Anda</p>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card text-center p-4">
                <div class="mb-3">
                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <h3 class="mb-0">1</h3>
                    </div>
                </div>
                <h5 class="fw-bold">Daftar/Login</h5>
                <p class="text-secondary">Buat akun atau masuk ke aplikasi JAPLO</p>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card text-center p-4">
                <div class="mb-3">
                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <h3 class="mb-0">2</h3>
                    </div>
                </div>
                <h5 class="fw-bold">Pilih Lokasi</h5>
                <p class="text-secondary">Tentukan lokasi penjemputan dan tujuan</p>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card text-center p-4">
                <div class="mb-3">
                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <h3 class="mb-0">3</h3>
                    </div>
                </div>
                <h5 class="fw-bold">Driver Datang</h5>
                <p class="text-secondary">Driver akan menjemput Anda</p>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);">
                <div class="card-body text-center text-white py-5">
                    <h2 class="fw-bold mb-3">Siap Bergabung dengan JAPLO?</h2>
                    <p class="lead mb-4">Daftar sekarang dan nikmati perjalanan yang nyaman</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('register') }}?role=user" class="btn btn-light btn-lg px-5">
                            <i class="fas fa-user me-2"></i> Daftar sebagai Penumpang
                        </a>
                        <a href="{{ route('register') }}?role=driver" class="btn btn-accent btn-lg px-5">
                            <i class="fas fa-motorcycle me-2"></i> Daftar sebagai Driver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row mb-5">
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="stat-value">1000+</div>
                <div class="stat-label">Driver Aktif</div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="stat-value">5000+</div>
                <div class="stat-label">Penumpang</div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="stat-value">10K+</div>
                <div class="stat-label">Perjalanan</div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="stat-value">4.8</div>
                <div class="stat-label">Rating Rata-rata</div>
            </div>
        </div>
    </div>
</div>
@endsection
