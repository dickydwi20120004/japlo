@extends('layouts.app')

@section('title', 'JAPLO - Jasa Pengantar Lokal')

@section('content')
<!-- Hero Section -->
<div class="hero-section">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">Selamat Datang di JAPLO</h1>
        <p class="lead mb-4">Platform Ojek Online Terpercaya dan Terjangkau</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5">
                <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
            </a>
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-5">
                <i class="fas fa-sign-in-alt me-2"></i> Masuk
            </a>
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
