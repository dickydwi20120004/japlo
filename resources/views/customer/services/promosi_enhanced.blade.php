@extends('layouts.app')

@section('title', 'Promosi Spesial - JAPLO')

@section('content')
<div class="hero-section" style="padding: 50px 0; background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 50%, #c92a2a 100%);">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm mb-3" style="border-radius: 25px; padding: 8px 16px;">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <h2 class="fw-bold mb-2 text-white display-5">
            <i class="fas fa-gift me-2"></i> Promosi Spesial
        </h2>
        <p class="mb-0 text-white fs-5">Dapatkan penawaran terbaik dan hemat lebih banyak setiap hari!</p>
    </div>
</div>

<div class="container py-5">
    <!-- Search & Filter -->
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body p-4">
            <div class="row g-2">
                <div class="col-md-8">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-light border-0">
                            <i class="fas fa-search text-danger"></i>
                        </span>
                        <input type="text" class="form-control border-0" placeholder="Cari promo atau kategori..." id="searchPromo">
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-select form-select-lg border-0" id="filterCategory">
                        <option value="">Semua Kategori</option>
                        <option value="Transportasi">Transportasi</option>
                        <option value="Kuliner">Kuliner</option>
                        <option value="Produk">Produk</option>
                        <option value="Semua Layanan">Semua Layanan</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Promo Banner -->
    <div class="row mb-5">
        <div class="col-12 mb-4">
            <div class="card border-0 overflow-hidden" style="height: 300px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <img src="https://via.placeholder.com/1200x300?text=SUPER+PROMO+MINGGU+INI" 
                     class="position-absolute w-100 h-100" style="object-fit: cover; opacity: 0.3;" alt="">
                <div class="card-body d-flex align-items-center justify-content-center position-relative" style="z-index: 1;">
                    <div class="text-center text-white">
                        <p class="mb-2">🎉 PROMO UTAMA</p>
                        <h2 class="fw-bold mb-3 display-4">DISKON HINGGA 70%</h2>
                        <p class="fs-5 mb-3">Untuk Semua Kategori Layanan JAPLO</p>
                        <button class="btn btn-light btn-lg fw-bold px-5" style="border-radius: 30px;">
                            <i class="fas fa-rocket me-2"></i> Lihat Semua Penawaran
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Promos -->
    <h4 class="fw-bold mb-4">
        <i class="fas fa-fire me-2 text-danger"></i> Promosi Aktif Hari Ini
    </h4>

    <div class="row">
        @foreach($promos as $promo)
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm hover-promo" style="border-radius: 20px; overflow: hidden; transition: all 0.3s ease;">
                <!-- Promo Image -->
                <div class="position-relative" style="height: 200px; overflow: hidden;">
                    <img src="{{ $promo['image'] }}" class="card-img-top w-100 h-100" alt="{{ $promo['title'] }}" style="object-fit: cover;">
                    
                    <!-- Category Badge -->
                    <div class="position-absolute top-0 start-0 m-3">
                        <span class="badge bg-danger shadow-lg" style="padding: 8px 12px; font-size: 12px; border-radius: 20px;">
                            <i class="fas fa-tag me-1"></i> {{ $promo['category'] }}
                        </span>
                    </div>

                    <!-- Discount Badge -->
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-warning text-dark shadow-lg" style="padding: 8px 12px; font-size: 12px; border-radius: 20px;">
                            <i class="fas fa-percent"></i> FLASH SALE
                        </span>
                    </div>

                    <!-- Timer Badge -->
                    <div class="position-absolute bottom-0 start-0 end-0" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); padding: 20px 15px 15px;">
                        <p class="text-white fw-bold mb-0 small">
                            <i class="fas fa-hourglass-end me-1"></i>
                            Berakhir: {{ $promo['valid_until'] }}
                        </p>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-2" style="color: #212529; line-height: 1.4;">
                        {{ $promo['title'] }}
                    </h5>
                    
                    <p class="card-text text-muted small mb-4" style="line-height: 1.6;">
                        {{ $promo['description'] }}
                    </p>

                    <!-- Promo Code -->
                    <div class="bg-light p-3 rounded mb-3" style="border: 2px dashed #dc3545;">
                        <p class="mb-1 small text-muted">Kode Promo:</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <code class="fw-bold text-danger" id="promo-code-{{ $promo['id'] }}" style="font-size: 14px;">
                                PROMO{{ str_pad($promo['id'], 3, '0', STR_PAD_LEFT) }}
                            </code>
                            <button class="btn btn-sm btn-outline-danger" onclick="copyPromoCode('promo-code-{{ $promo['id'] }}')">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="d-grid gap-2">
                        <button class="btn btn-danger btn-lg fw-bold" style="border-radius: 15px; padding: 10px;" onclick="usePromo('{{ $promo['id'] }}', 'PROMO{{ str_pad($promo['id'], 3, '0', STR_PAD_LEFT) }}')">
                            <i class="fas fa-check-circle me-2"></i> Gunakan Sekarang
                        </button>
                        <button class="btn btn-outline-danger btn-sm" style="border-radius: 15px;" onclick="sharePromo('{{ $promo['title'] }}')">
                            <i class="fas fa-share-alt me-1"></i> Bagikan ke Teman
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Promo Categories Section -->
    <h4 class="fw-bold mb-4 mt-5">
        <i class="fas fa-th-large me-2"></i> Jenis-Jenis Promo
    </h4>

    <div class="row">
        <!-- Diskon Kategori -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm text-center p-4 hover-card" style="border-radius: 15px; cursor: pointer;">
                <div class="mb-3">
                    <i class="fas fa-percentage fa-3x text-danger"></i>
                </div>
                <h5 class="fw-bold mb-2">Diskon</h5>
                <p class="text-muted small mb-0">Hemat hingga 70% untuk berbagai layanan</p>
            </div>
        </div>

        <!-- Gratis Ongkos -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm text-center p-4 hover-card" style="border-radius: 15px; cursor: pointer;">
                <div class="mb-3">
                    <i class="fas fa-shipping-fast fa-3x text-success"></i>
                </div>
                <h5 class="fw-bold mb-2">Gratis Ongkir</h5>
                <p class="text-muted small mb-0">Bebas biaya pengiriman dengan pembelian tertentu</p>
            </div>
        </div>

        <!-- Cashback -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm text-center p-4 hover-card" style="border-radius: 15px; cursor: pointer;">
                <div class="mb-3">
                    <i class="fas fa-wallet fa-3x text-warning"></i>
                </div>
                <h5 class="fw-bold mb-2">Cashback</h5>
                <p class="text-muted small mb-0">Dapatkan kembali uang Anda hingga 100%</p>
            </div>
        </div>

        <!-- Beli Lebih Hemat -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card border-0 shadow-sm text-center p-4 hover-card" style="border-radius: 15px; cursor: pointer;">
                <div class="mb-3">
                    <i class="fas fa-gift fa-3x text-info"></i>
                </div>
                <h5 class="fw-bold mb-2">Beli 2 Gratis 1</h5>
                <p class="text-muted small mb-0">Bundle menarik dengan harga terjangkau</p>
            </div>
        </div>
    </div>

    <!-- Terms & Conditions -->
    <div class="card border-0 bg-light mt-5">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3">
                <i class="fas fa-info-circle me-2 text-info"></i> Syarat & Ketentuan
            </h5>
            <ul class="small mb-0">
                <li>Setiap kode promo hanya dapat digunakan sekali per pengguna</li>
                <li>Promosi tidak dapat dikombinasikan dengan penawaran lain</li>
                <li>Berlaku untuk minimal pembelian sesuai dengan ketentuan promo</li>
                <li>Dana cashback akan masuk dalam 24 jam setelah transaksi</li>
                <li>JAPLO berhak membatalkan promo kapan saja tanpa pemberitahuan</li>
            </ul>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 11;">
    <div class="toast" id="copyToast" role="alert">
        <div class="toast-body bg-success text-white">
            <i class="fas fa-check-circle me-2"></i> Kode promo berhasil disalin!
        </div>
    </div>
</div>

<style>
    .hover-promo {
        transition: all 0.3s ease;
    }
    
    .hover-promo:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(220, 53, 69, 0.2) !important;
    }

    .hover-card {
        transition: all 0.3s ease;
    }

    .hover-card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1) !important;
        transform: translateY(-4px);
    }
</style>

<script>
function copyPromoCode(elementId) {
    const codeElement = document.getElementById(elementId);
    const code = codeElement.textContent;
    
    navigator.clipboard.writeText(code).then(() => {
        // Show toast
        const toast = new bootstrap.Toast(document.getElementById('copyToast'));
        toast.show();
    });
}

function usePromo(promoId, promoCode) {
    alert('✅ Promo ' + promoCode + ' telah disimpan!\n\nGunakan kode ini saat checkout untuk mendapatkan diskon.\n\nDiklik tombol "Mulai Belanja" untuk melanjutkan.');
    // Redirect ke home atau layanan tertentu
    window.location.href = '{{ route("dashboard") }}';
}

function sharePromo(title) {
    const text = `Hei! Ada promo menarik di JAPLO: "${title}". Buruan manfaatkan sebelum habis! 🎉`;
    
    if (navigator.share) {
        navigator.share({
            title: 'JAPLO Promo',
            text: text,
            url: window.location.href
        });
    } else {
        // Fallback to WhatsApp
        const message = encodeURIComponent(text);
        window.open(`https://wa.me/?text=${message}`, '_blank');
    }
}

// Real-time search
document.getElementById('searchPromo')?.addEventListener('keyup', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    // Implementasi search filtering
    if (searchTerm.length > 0) {
        console.log('Mencari: ' + searchTerm);
    }
});

// Filter by category
document.getElementById('filterCategory')?.addEventListener('change', function(e) {
    const category = e.target.value;
    // Implementasi filter
    if (category) {
        console.log('Filter: ' + category);
    }
});
</script>
@endsection
