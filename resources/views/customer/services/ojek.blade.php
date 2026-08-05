@extends('layouts.app')

@section('title', 'Ojek/Taxi - JAPLO')

@section('content')

<div class="hero-section" style="padding: 40px 0; background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm mb-3">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
        <h2 class="fw-bold mb-2 text-white" style="font-size: 2.5rem;">🏍️ Ojek & Taxi Online</h2>
        <p class="mb-0 text-white" style="font-size: 1.1rem;">Perjalanan nyaman, harga terjangkau</p>
    </div>
</div>

<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card shadow" style="border-radius: 15px;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-motorcycle fa-4x text-primary"></i>
                    </div>
                    <h4 class="fw-bold mb-2">JaploRide</h4>
                    <p class="text-secondary mb-3">Ojek motor cepat dan praktis</p>
                    <div class="mb-3 p-3 rounded" style="background: rgba(0, 168, 89, 0.1);">
                        <h3 class="fw-bold text-primary mb-1">Rp 5.000/km</h3>
                    </div>
                    <button class="btn btn-primary btn-lg w-100" onclick="selectVehicle('motor')">
                        Pilih JaploRide
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card shadow" style="border-radius: 15px;">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-car fa-4x text-success"></i>
                    </div>
                    <h4 class="fw-bold mb-2">JaploCar</h4>
                    <p class="text-secondary mb-3">Mobil nyaman untuk perjalanan</p>
                    <div class="mb-3 p-3 rounded" style="background: rgba(76, 175, 80, 0.1);">
                        <h3 class="fw-bold text-success mb-1">Rp 8.000/km</h3>
                    </div>
                    <button class="btn btn-success btn-lg w-100" onclick="selectVehicle('mobil')">
                        Pilih JaploCar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-lg" style="border-radius: 15px;">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-4">
                <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                Detail Perjalanan
            </h5>
            
            <form id="bookingForm" novalidate>
                <input type="hidden" id="vehicle_type" name="vehicle_type" value="motor">

                <div class="mb-3">
                    <label class="form-label fw-bold">📍 Lokasi Penjemputan</label>
                    <input type="text" class="form-control form-control-lg" 
                           id="pickup" name="pickup" 
                           placeholder="Contoh: Jl. Merdeka No. 123"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">🎯 Lokasi Tujuan</label>
                    <input type="text" class="form-control form-control-lg" 
                           id="destination" name="destination" 
                           placeholder="Contoh: Jl. Sudirman No. 456"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">📝 Catatan (Opsional)</label>
                    <textarea class="form-control" rows="2" id="driver_notes" name="driver_notes"
                              placeholder="Contoh: Tolong bawa helm extra..."
                              maxlength="200"></textarea>
                </div>

                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">💰 Estimasi Biaya</h6>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <small class="text-secondary">Jarak</small>
                                <h5 class="fw-bold text-primary" id="estimatedDistance">- km</h5>
                            </div>
                            <div class="col-6 mb-3">
                                <small class="text-secondary">Waktu</small>
                                <h5 class="fw-bold text-primary" id="estimatedTime">- menit</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">Total Biaya</span>
                            <h4 class="fw-bold text-primary" id="estimatedPrice">Rp 0</h4>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-outline-primary btn-lg" onclick="calculatePrice()">
                        💰 Hitung Estimasi
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg">
                        ✓ Konfirmasi Pesanan
                    </button>
                    <a href="{{ route('order.history') }}" class="btn btn-info btn-lg">
                        📍 Lihat Riwayat
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function selectVehicle(type) {
    document.getElementById('vehicle_type').value = type;
    const text = type === 'motor' ? 'Motor (JaploRide)' : 'Mobil (JaploCar)';
    Toast.success('Kendaraan: ' + text);
    document.getElementById('bookingForm').scrollIntoView({ behavior: 'smooth' });
}

function calculatePrice() {
    const pickup = document.getElementById('pickup').value.trim();
    const destination = document.getElementById('destination').value.trim();
    
    if (!pickup || !destination) {
        Toast.warning('Isi lokasi penjemputan dan tujuan');
        return;
    }
    
    const baseDistance = Math.random() * 15 + 2;
    const distance = parseFloat(baseDistance.toFixed(1));
    const vehicleType = document.getElementById('vehicle_type').value;
    const baseFare = vehicleType === 'motor' ? 5000 : 8000;
    const pricePerKm = vehicleType === 'motor' ? 3000 : 4000;
    const totalPrice = Math.round(baseFare + (distance * pricePerKm));
    const estimatedTime = Math.round(distance * 4);

    document.getElementById('estimatedDistance').textContent = distance + ' km';
    document.getElementById('estimatedTime').textContent = estimatedTime + ' menit';
    document.getElementById('estimatedPrice').textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
    
    Toast.success('Estimasi biaya sudah dihitung!');
}

document.getElementById('bookingForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const pickup = document.getElementById('pickup').value.trim();
    const destination = document.getElementById('destination').value.trim();
    const estimatedPrice = document.getElementById('estimatedPrice').textContent;
    const vehicleType = document.getElementById('vehicle_type').value;
    const driverNotes = document.getElementById('driver_notes').value.trim();
    const estimatedDistance = document.getElementById('estimatedDistance').textContent;
    
    if (!pickup || !destination) {
        Toast.warning('Isi semua data yang diperlukan');
        return;
    }
    
    if (estimatedPrice === 'Rp 0') {
        Toast.warning('Hitung estimasi biaya terlebih dahulu');
        return;
    }
    
    const priceValue = parseInt(estimatedPrice.replace('Rp ', '').replace(/\./g, ''));
    const distanceValue = parseFloat(estimatedDistance.replace(' km', ''));
    
    const orderData = {
        pickup_address: pickup,
        destination_address: destination,
        distance: distanceValue,
        price: priceValue,
        vehicle_type: vehicleType,
        customer_notes: driverNotes,
        payment_method: 'cash'
    };
    
    const button = this.querySelector('button[type="submit"]');
    const originalText = button.innerHTML;
    button.disabled = true;
    button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Memproses...';
    
    fetch('{{ route("api.orders.create") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: JSON.stringify(orderData)
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                throw err;
            });
        }
        return response.json();
    })
    .then(data => {
        Toast.success('Pesanan berhasil dibuat! Order: ' + data.data.order_number);
        setTimeout(() => {
            window.location.href = '{{ route("order.history") }}';
        }, 1500);
    })
    .catch(error => {
        console.error('Error:', error);
        const errorMsg = error.message || 'Terjadi kesalahan';
        Toast.error('Gagal: ' + errorMsg);
        button.disabled = false;
        button.innerHTML = originalText;
    });
});
</script>

@endsection