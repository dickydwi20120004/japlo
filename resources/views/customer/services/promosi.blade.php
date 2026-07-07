@extends('layouts.app')

@section('title', 'Iklan & Promosi - JAPLO')

@section('content')
<div class="hero-section" style="padding: 40px 0; background: linear-gradient(135deg, #28a745 0%, #218838 100%);">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm mb-3">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <h2 class="fw-bold mb-2 text-white">Iklan & Promosi</h2>
        <p class="mb-0 text-white">Jangan lewatkan penawaran menarik untuk Anda!</p>
    </div>
</div>

<div class="container py-4">
    <!-- Active Promo Count -->
    <div class="card mb-4" style="background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%); border: none;">
        <div class="card-body text-center text-white py-4">
            <h1 class="fw-bold mb-2">
                <i class="fas fa-gift me-3"></i>
                {{ count($promos) }}
            </h1>
            <h5 class="mb-0">Promo Aktif Tersedia Untukmu!</h5>
        </div>
    </div>

    <!-- Promo Categories -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex overflow-auto pb-2" style="gap: 10px;">
                <button class="btn btn-primary">
                    <i class="fas fa-tags me-2"></i> Semua
                </button>
                <button class="btn btn-outline-primary">
                    <i class="fas fa-motorcycle me-2"></i> Transportasi
                </button>
                <button class="btn btn-outline-primary">
                    <i class="fas fa-utensils me-2"></i> Kuliner
                </button>
                <button class="btn btn-outline-primary">
                    <i class="fas fa-shopping-bag me-2"></i> Belanja
                </button>
                <button class="btn btn-outline-primary">
                    <i class="fas fa-hospital me-2"></i> Kesehatan
                </button>
            </div>
        </div>
    </div>

    <!-- Promo List -->
    @foreach($promos as $promo)
    <div class="card mb-4 hover-card">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ $promo['image'] }}" class="img-fluid rounded-start h-100" style="object-fit: cover;" alt="{{ $promo['title'] }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge bg-success">{{ $promo['category'] }}</span>
                        <span class="badge bg-danger">
                            <i class="fas fa-clock me-1"></i>
                            Berakhir: {{ \Carbon\Carbon::parse($promo['valid_until'])->format('d M Y') }}
                        </span>
                    </div>
                    <h4 class="fw-bold mb-2">{{ $promo['title'] }}</h4>
                    <p class="text-secondary mb-3">{{ $promo['description'] }}</p>
                    
                    <div class="card bg-light mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-secondary d-block mb-1">Kode Promo</small>
                                    <h5 class="fw-bold mb-0 text-primary">PROMO{{ $promo['id'] }}{{ date('md') }}</h5>
                                </div>
                                <button class="btn btn-primary" onclick="copyPromoCode('PROMO{{ $promo['id'] }}{{ date('md') }}')">
                                    <i class="fas fa-copy me-2"></i> Salin Kode
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-success flex-fill" onclick="usePromo({{ $promo['id'] }})">
                            <i class="fas fa-check-circle me-2"></i> Gunakan Sekarang
                        </button>
                        <button class="btn btn-outline-secondary" onclick="sharePromo({{ $promo['id'] }})">
                            <i class="fas fa-share-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Flash Sale Banner -->
    <div class="card mb-4" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); border: none;">
        <div class="card-body text-center text-white py-5">
            <h2 class="fw-bold mb-3">
                <i class="fas fa-bolt me-3"></i>
                FLASH SALE HARIAN!
            </h2>
            <p class="mb-3">Setiap hari jam 10:00 - 16:00 WIB</p>
            <div class="d-flex justify-content-center gap-3 mb-3">
                <div class="text-center">
                    <div class="bg-white text-dark rounded p-3" style="min-width: 60px;">
                        <h3 class="fw-bold mb-0" id="hours">00</h3>
                    </div>
                    <small class="mt-2 d-block">Jam</small>
                </div>
                <div class="text-center align-self-center">
                    <h3 class="fw-bold">:</h3>
                </div>
                <div class="text-center">
                    <div class="bg-white text-dark rounded p-3" style="min-width: 60px;">
                        <h3 class="fw-bold mb-0" id="minutes">00</h3>
                    </div>
                    <small class="mt-2 d-block">Menit</small>
                </div>
                <div class="text-center align-self-center">
                    <h3 class="fw-bold">:</h3>
                </div>
                <div class="text-center">
                    <div class="bg-white text-dark rounded p-3" style="min-width: 60px;">
                        <h3 class="fw-bold mb-0" id="seconds">00</h3>
                    </div>
                    <small class="mt-2 d-block">Detik</small>
                </div>
            </div>
            <button class="btn btn-light btn-lg px-5">
                <i class="fas fa-bell me-2"></i> Ingatkan Saya
            </button>
        </div>
    </div>

    <!-- Referral Program -->
    <div class="card">
        <div class="card-body">
            <h5 class="fw-bold mb-3">
                <i class="fas fa-user-friends me-2 text-primary"></i>
                Program Referral
            </h5>
            <p class="text-secondary mb-3">Ajak temanmu dan dapatkan bonus untuk setiap teman yang bergabung!</p>
            
            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <i class="fas fa-gift fa-3x text-success mb-3"></i>
                            <h4 class="fw-bold text-success">Rp 50.000</h4>
                            <p class="mb-0">Bonus untuk Anda</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <i class="fas fa-gift fa-3x text-primary mb-3"></i>
                            <h4 class="fw-bold text-primary">Rp 50.000</h4>
                            <p class="mb-0">Bonus untuk Teman</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card bg-light mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-secondary d-block mb-1">Kode Referral Anda</small>
                            <h5 class="fw-bold mb-0 text-primary">JAPLO{{ auth()->user()->id }}REF</h5>
                        </div>
                        <button class="btn btn-primary" onclick="copyPromoCode('JAPLO{{ auth()->user()->id }}REF')">
                            <i class="fas fa-copy me-2"></i> Salin
                        </button>
                    </div>
                </div>
            </div>

            <button class="btn btn-success btn-lg w-100">
                <i class="fas fa-share-alt me-2"></i> Bagikan ke Teman
            </button>
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
        border-color: var(--primary-color);
    }
</style>

<script>
function copyPromoCode(code) {
    navigator.clipboard.writeText(code).then(function() {
        alert('Kode "' + code + '" berhasil disalin!\n\nGunakan kode ini saat melakukan pemesanan.');
    }, function(err) {
        alert('Gagal menyalin kode. Silakan salin manual: ' + code);
    });
}

function usePromo(id) {
    alert('Promo ID: ' + id + ' akan digunakan.\n\nAnda akan diarahkan ke halaman layanan yang sesuai.');
    window.location.href = '{{ route("dashboard") }}';
}

function sharePromo(id) {
    if (navigator.share) {
        navigator.share({
            title: 'Promo Japlo',
            text: 'Cek promo menarik di Japlo App!',
            url: window.location.href
        }).then(() => {
            console.log('Berhasil dibagikan');
        }).catch((error) => {
            console.log('Gagal membagikan', error);
        });
    } else {
        alert('Fitur berbagi tidak didukung di browser ini.');
    }
}

// Flash Sale Countdown
function updateCountdown() {
    const now = new Date();
    const flashSaleStart = new Date();
    flashSaleStart.setHours(10, 0, 0, 0);
    
    const flashSaleEnd = new Date();
    flashSaleEnd.setHours(16, 0, 0, 0);
    
    let targetTime;
    if (now < flashSaleStart) {
        targetTime = flashSaleStart;
    } else if (now < flashSaleEnd) {
        targetTime = flashSaleEnd;
    } else {
        flashSaleStart.setDate(flashSaleStart.getDate() + 1);
        targetTime = flashSaleStart;
    }
    
    const diff = targetTime - now;
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
