@extends('layouts.app')

@section('title', 'Ojek/Taxi - JAPLO')

@section('content')
<div class="hero-section" style="padding: 40px 0; background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm mb-3">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <h2 class="fw-bold mb-2 text-white">Ojek & Taxi Online</h2>
        <p class="mb-0 text-white">Perjalanan nyaman, harga terjangkau</p>
    </div>
</div>

<div class="container py-4">
    <!-- Service Options -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card service-card hover-shadow h-100">
                <div class="card-body text-center p-4">
                    <div class="service-icon-lg mb-3">
                        <i class="fas fa-motorcycle fa-4x text-primary"></i>
                    </div>
                    <h4 class="fw-bold">JaploRide</h4>
                    <p class="text-secondary mb-3">Ojek motor cepat dan praktis</p>
                    <div class="mb-3">
                        <small class="text-secondary">Tarif mulai dari</small>
                        <h3 class="fw-bold text-primary mb-0">Rp 5.000</h3>
                        <small class="text-secondary">/km</small>
                    </div>
                    <button class="btn btn-primary btn-lg w-100" onclick="bookRide('motor')">
                        <i class="fas fa-motorcycle me-2"></i> Pesan Sekarang
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card service-card hover-shadow h-100">
                <div class="card-body text-center p-4">
                    <div class="service-icon-lg mb-3">
                        <i class="fas fa-car fa-4x text-success"></i>
                    </div>
                    <h4 class="fw-bold">JaploCar</h4>
                    <p class="text-secondary mb-3">Mobil nyaman untuk perjalanan jauh</p>
                    <div class="mb-3">
                        <small class="text-secondary">Tarif mulai dari</small>
                        <h3 class="fw-bold text-success mb-0">Rp 8.000</h3>
                        <small class="text-secondary">/km</small>
                    </div>
                    <button class="btn btn-success btn-lg w-100" onclick="bookRide('mobil')">
                        <i class="fas fa-car me-2"></i> Pesan Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Form -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-4">
                <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                Detail Perjalanan
            </h5>
            <form id="bookingForm">
                <div class="mb-3">
                    <label class="form-label fw-bold">Tipe Kendaraan</label>
                    <div class="btn-group w-100" role="group">
                        <input type="radio" class="btn-check" name="vehicle_type" id="motor" value="motor" checked>
                        <label class="btn btn-outline-primary" for="motor">
                            <i class="fas fa-motorcycle me-2"></i> Motor
                        </label>

                        <input type="radio" class="btn-check" name="vehicle_type" id="mobil" value="mobil">
                        <label class="btn btn-outline-success" for="mobil">
                            <i class="fas fa-car me-2"></i> Mobil
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Lokasi Penjemputan</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        <input type="text" class="form-control form-control-lg" placeholder="Masukkan alamat penjemputan" id="pickup">
                    </div>
                    <small class="text-secondary">
                        <i class="fas fa-location-arrow me-1"></i>
                        <a href="#" onclick="useCurrentLocation('pickup'); return false;">Gunakan lokasi saat ini</a>
                    </small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Lokasi Tujuan</label>
                    <div class="input-group">
                        <span class="input-group-text bg-danger text-white">
                            <i class="fas fa-flag-checkered"></i>
                        </span>
                        <input type="text" class="form-control form-control-lg" placeholder="Masukkan alamat tujuan" id="destination">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Catatan untuk Driver (Opsional)</label>
                    <textarea class="form-control" rows="3" placeholder="Contoh: Tolong bawa helm extra, saya sedang bawa barang besar"></textarea>
                </div>

                <div class="card bg-light mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-secondary">Jarak Estimasi</span>
                            <span class="fw-bold" id="estimatedDistance">- km</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-secondary">Waktu Estimasi</span>
                            <span class="fw-bold" id="estimatedTime">- menit</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Total Biaya</span>
                            <h4 class="fw-bold text-primary mb-0" id="estimatedPrice">Rp 0</h4>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-primary btn-lg w-100" onclick="calculatePrice()">
                    <i class="fas fa-calculator me-2"></i> Hitung Estimasi Biaya
                </button>
                <button type="submit" class="btn btn-success btn-lg w-100 mt-2">
                    <i class="fas fa-check-circle me-2"></i> Konfirmasi Pesanan
                </button>
            </form>
        </div>
    </div>

    <!-- Features -->
    <div class="card">
        <div class="card-body">
            <h5 class="fw-bold mb-4">Keunggulan Japlo Ride</h5>
            <div class="row">
                <div class="col-md-3 col-6 mb-3 text-center">
                    <div class="feature-icon mb-2">
                        <i class="fas fa-clock fa-3x text-primary"></i>
                    </div>
                    <p class="fw-bold mb-1">Cepat & Tepat</p>
                    <small class="text-secondary">Driver datang dalam hitungan menit</small>
                </div>
                <div class="col-md-3 col-6 mb-3 text-center">
                    <div class="feature-icon mb-2">
                        <i class="fas fa-shield-alt fa-3x text-success"></i>
                    </div>
                    <p class="fw-bold mb-1">Aman & Terpercaya</p>
                    <small class="text-secondary">Driver terverifikasi dan berpengalaman</small>
                </div>
                <div class="col-md-3 col-6 mb-3 text-center">
                    <div class="feature-icon mb-2">
                        <i class="fas fa-money-bill-wave fa-3x text-warning"></i>
                    </div>
                    <p class="fw-bold mb-1">Harga Transparan</p>
                    <small class="text-secondary">Tidak ada biaya tersembunyi</small>
                </div>
                <div class="col-md-3 col-6 mb-3 text-center">
                    <div class="feature-icon mb-2">
                        <i class="fas fa-star fa-3x text-danger"></i>
                    </div>
                    <p class="fw-bold mb-1">Rating Tinggi</p>
                    <small class="text-secondary">Driver dengan rating terbaik</small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-shadow:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        transform: translateY(-4px);
        transition: all 0.3s ease;
    }
    .service-card {
        transition: all 0.3s ease;
        border: 2px solid #f0f0f0;
    }
    .service-card:hover {
        border-color: var(--primary-color);
    }
</style>

<script>
function bookRide(type) {
    if (type === 'motor') {
        document.getElementById('motor').checked = true;
    } else {
        document.getElementById('mobil').checked = true;
    }
    window.scrollTo({ top: document.getElementById('bookingForm').offsetTop - 100, behavior: 'smooth' });
}

function useCurrentLocation(field) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            alert('Lokasi terdeteksi! Lat: ' + position.coords.latitude + ', Long: ' + position.coords.longitude);
            // TODO: Convert to address using reverse geocoding
            document.getElementById(field).value = 'Lokasi saat ini (Lat: ' + position.coords.latitude + ', Long: ' + position.coords.longitude + ')';
        }, function(error) {
            alert('Tidak dapat mengakses lokasi. Pastikan Anda memberikan izin lokasi.');
        });
    } else {
        alert('Browser Anda tidak mendukung Geolocation.');
    }
}

function calculatePrice() {
    const pickup = document.getElementById('pickup').value;
    const destination = document.getElementById('destination').value;
    const vehicleType = document.querySelector('input[name="vehicle_type"]:checked').value;

    if (!pickup || !destination) {
        alert('Mohon isi lokasi penjemputan dan tujuan terlebih dahulu!');
        return;
    }

    // Simulate calculation
    const randomDistance = (Math.random() * 10 + 1).toFixed(1);
    const pricePerKm = vehicleType === 'motor' ? 5000 : 8000;
    const totalPrice = Math.round(randomDistance * pricePerKm);
    const estimatedTime = Math.round(randomDistance * 4); // Assuming 15km/h average

    document.getElementById('estimatedDistance').textContent = randomDistance + ' km';
    document.getElementById('estimatedTime').textContent = estimatedTime + ' menit';
    document.getElementById('estimatedPrice').textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
}

document.getElementById('bookingForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const pickup = document.getElementById('pickup').value;
    const destination = document.getElementById('destination').value;
    
    if (!pickup || !destination) {
        alert('Mohon isi semua data yang diperlukan!');
        return;
    }
    
    alert('Pesanan berhasil dibuat! Driver akan segera menghubungi Anda.\n\nFitur pemesanan real-time akan segera hadir. Untuk testing, gunakan API endpoint.');
    window.location.href = '{{ route("dashboard") }}';
});
</script>
@endsection
