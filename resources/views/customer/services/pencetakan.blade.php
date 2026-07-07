@extends('layouts.app')

@section('title', 'Pencetakan - JAPLO')

@section('content')
<div class="hero-section" style="padding: 40px 0; background: linear-gradient(135deg, #343a40 0%, #212529 100%);">
    <div class="container">
        <a href="{{ route('customer.dashboard') }}" class="btn btn-light btn-sm mb-3">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <h2 class="fw-bold mb-2 text-white">Layanan Pencetakan</h2>
        <p class="mb-0 text-white">Print, Scan, Fotocopy & Jilid dengan mudah</p>
    </div>
</div>

<div class="container py-4">
    <!-- Quick Order -->
    <div class="card mb-4" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); border: none;">
        <div class="card-body text-center text-white py-4">
            <h4 class="fw-bold mb-2">
                <i class="fas fa-rocket me-2"></i>
                Pesan Cepat via WhatsApp
            </h4>
            <p class="mb-3">Kirim file Anda langsung dan kami akan proseskan segera!</p>
            <a href="https://wa.me/628123456789" target="_blank" class="btn btn-success btn-lg px-5">
                <i class="fab fa-whatsapp me-2"></i> Chat Sekarang
            </a>
        </div>
    </div>

    <!-- Services Grid -->
    <h5 class="fw-bold mb-3">Layanan Kami</h5>
    <div class="row">
        @foreach($printServices as $service)
        <div class="col-md-4 mb-4">
            <div class="card hover-card h-100">
                <div class="card-body text-center">
                    <div class="icon-wrapper d-inline-block p-4 rounded-circle mb-3" style="background: rgba(52, 58, 64, 0.1);">
                        <i class="fas {{ $service['icon'] }} fa-3x text-dark"></i>
                    </div>
                    <h5 class="fw-bold mb-2">{{ $service['name'] }}</h5>
                    <p class="text-secondary mb-3">{{ $service['description'] }}</p>
                    <div class="card bg-light mb-3">
                        <div class="card-body">
                            <small class="text-secondary d-block">Harga mulai dari</small>
                            <h4 class="fw-bold text-dark mb-0">Rp {{ number_format($service['price_start'], 0, ',', '.') }}</h4>
                            <small class="text-secondary">/lembar</small>
                        </div>
                    </div>
                    <button class="btn btn-dark w-100" onclick="orderService({{ $service['id'] }}, '{{ $service['name'] }}')">
                        <i class="fas fa-shopping-cart me-2"></i> Pesan Sekarang
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Order Form -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="fw-bold mb-4">
                <i class="fas fa-file-upload me-2 text-primary"></i>
                Form Pemesanan
            </h5>
            <form id="orderForm">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Jenis Layanan</label>
                        <select class="form-select form-select-lg" id="serviceType">
                            <option value="">Pilih Layanan</option>
                            @foreach($printServices as $service)
                            <option value="{{ $service['id'] }}">{{ $service['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Jumlah</label>
                        <input type="number" class="form-control form-control-lg" value="1" min="1" id="quantity">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Upload File</label>
                    <input type="file" class="form-control form-control-lg" multiple>
                    <small class="text-secondary">Format: PDF, DOC, DOCX, JPG, PNG. Maksimal 10MB per file</small>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Ukuran Kertas</label>
                        <select class="form-select form-select-lg">
                            <option value="a4">A4</option>
                            <option value="a3">A3</option>
                            <option value="letter">Letter</option>
                            <option value="legal">Legal</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Warna</label>
                        <select class="form-select form-select-lg">
                            <option value="bw">Hitam Putih</option>
                            <option value="color">Berwarna</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Orientasi</label>
                        <select class="form-select form-select-lg">
                            <option value="portrait">Portrait</option>
                            <option value="landscape">Landscape</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Jilid</label>
                        <select class="form-select form-select-lg">
                            <option value="none">Tidak Perlu</option>
                            <option value="spiral">Spiral</option>
                            <option value="hardcover">Hardcover</option>
                            <option value="softcover">Softcover</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Catatan Tambahan</label>
                    <textarea class="form-control" rows="3" placeholder="Contoh: Mohon dicetak 2 sisi, jangan terlalu gelap"></textarea>
                </div>

                <div class="card bg-light mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-secondary">Estimasi Biaya</span>
                            <h4 class="fw-bold text-dark mb-0" id="totalPrice">Rp 0</h4>
                        </div>
                        <small class="text-secondary">*Harga final akan dikonfirmasi setelah file diproses</small>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark btn-lg w-100">
                    <i class="fas fa-check-circle me-2"></i> Buat Pesanan
                </button>
            </form>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="row mt-4">
        <div class="col-md-3 col-6 mb-3 text-center">
            <div class="card h-100">
                <div class="card-body">
                    <i class="fas fa-clock fa-3x text-primary mb-3"></i>
                    <h6 class="fw-bold">Cepat</h6>
                    <small class="text-secondary">Proses 15-30 menit</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3 text-center">
            <div class="card h-100">
                <div class="card-body">
                    <i class="fas fa-medal fa-3x text-warning mb-3"></i>
                    <h6 class="fw-bold">Berkualitas</h6>
                    <small class="text-secondary">Hasil terbaik</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3 text-center">
            <div class="card h-100">
                <div class="card-body">
                    <i class="fas fa-shipping-fast fa-3x text-success mb-3"></i>
                    <h6 class="fw-bold">Antar Jemput</h6>
                    <small class="text-secondary">Gratis untuk area tertentu</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3 text-center">
            <div class="card h-100">
                <div class="card-body">
                    <i class="fas fa-money-bill-wave fa-3x text-info mb-3"></i>
                    <h6 class="fw-bold">Terjangkau</h6>
                    <small class="text-secondary">Harga bersaing</small>
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
        border-color: #343a40;
    }
</style>

<script>
function orderService(id, name) {
    document.getElementById('serviceType').value = id;
    window.scrollTo({ top: document.getElementById('orderForm').offsetTop - 100, behavior: 'smooth' });
}

document.getElementById('serviceType').addEventListener('change', calculatePrice);
document.getElementById('quantity').addEventListener('input', calculatePrice);

function calculatePrice() {
    const serviceType = document.getElementById('serviceType').value;
    const quantity = parseInt(document.getElementById('quantity').value) || 0;
    
    if (!serviceType || quantity === 0) {
        document.getElementById('totalPrice').textContent = 'Rp 0';
        return;
    }

    const prices = {
        @foreach($printServices as $service)
        '{{ $service["id"] }}': {{ $service["price_start"] }},
        @endforeach
    };

    const price = prices[serviceType] || 0;
    const total = price * quantity;
    
    document.getElementById('totalPrice').textContent = 'Rp ' + total.toLocaleString('id-ID');
}

document.getElementById('orderForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const serviceType = document.getElementById('serviceType').value;
    const quantity = document.getElementById('quantity').value;
    
    if (!serviceType || !quantity) {
        alert('Mohon lengkapi semua data yang diperlukan!');
        return;
    }
    
    alert('Pesanan berhasil dibuat!\n\nTim kami akan memproses pesanan Anda dalam 15 menit.\n\nFitur upload file dan tracking pesanan akan segera hadir.');
    window.location.href = '{{ route("customer.dashboard") }}';
});
</script>
@endsection
