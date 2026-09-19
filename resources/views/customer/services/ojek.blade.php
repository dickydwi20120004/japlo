@extends('layouts.app')
@section('title', 'Ojek & Taksi — JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/services.css') }}">
@endpush

@section('content')

<div class="jp-page-top">
    <div class="container">
        <div class="mb-3">
            <a href="{{ route('dashboard') }}" class="btn btn-sm"
               style="background:rgba(255,255,255,.15);border:1.5px solid rgba(255,255,255,.35);color:#fff;border-radius:8px">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('images/icons/ojek.svg') }}" width="44" height="44" alt="Ojek">
            <div>
                <h1>Ojek & Taksi</h1>
                <p class="mb-0" style="font-size:.85rem;color:rgba(255,255,255,.8)">
                    Pesan kendaraan, pantau posisi, bayar langsung
                </p>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container">
        <div class="row g-4">

            {{-- ===== FORM ORDER ===== --}}
            <div class="col-lg-7">

                {{-- Pilih kendaraan --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header">
                        <span><i class="fas fa-car me-2 text-jp-green"></i>Pilih Kendaraan</span>
                    </div>
                    <div class="jp-card-body">
                        <div class="row g-3">

                            {{-- Motor --}}
                            <div class="col-6">
                                <div class="vehicle-card selected" id="cardMotor" onclick="selectVehicle('motor')">
                                    <div class="v-icon">🏍️</div>
                                    <div class="v-name">JaploRide</div>
                                    <p style="font-size:.8rem;color:var(--jp-gray-400);margin:.25rem 0">Motor cepat & praktis</p>
                                    <div class="v-tarif">
                                        @if($tariffMotor)
                                            Rp {{ number_format($tariffMotor->base_fare, 0, ',', '.') }} +
                                            Rp {{ number_format($tariffMotor->per_km, 0, ',', '.') }}/km
                                        @else
                                            Rp 5.000 + Rp 3.000/km
                                        @endif
                                    </div>
                                    <input type="radio" name="vehicle_type" value="motor"
                                           id="radioMotor" style="display:none" checked>
                                </div>
                            </div>

                            {{-- Mobil --}}
                            <div class="col-6">
                                <div class="vehicle-card" id="cardMobil" onclick="selectVehicle('mobil')">
                                    <div class="v-icon">🚗</div>
                                    <div class="v-name">JaploCar</div>
                                    <p style="font-size:.8rem;color:var(--jp-gray-400);margin:.25rem 0">Mobil nyaman & luas</p>
                                    <div class="v-tarif" style="background:#DBEAFE;color:#1D4ED8">
                                        @if($tariffMobil)
                                            Rp {{ number_format($tariffMobil->base_fare, 0, ',', '.') }} +
                                            Rp {{ number_format($tariffMobil->per_km, 0, ',', '.') }}/km
                                        @else
                                            Rp 10.000 + Rp 6.000/km
                                        @endif
                                    </div>
                                    <input type="radio" name="vehicle_type" value="mobil"
                                           id="radioMobil" style="display:none">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Form Order --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header">
                        <span><i class="fas fa-map-location-dot me-2 text-jp-green"></i>Isi Rute</span>
                    </div>
                    <div class="jp-card-body">
                        <form id="ojekForm" action="{{ route('api.orders.create') }}" method="POST">
                            @csrf

                            <input type="hidden" name="vehicle_type"          id="vehicleTypeInput" value="motor">
                            <input type="hidden" name="pickup_latitude"        id="pickupLat"  value="-1.0674">
                            <input type="hidden" name="pickup_longitude"       id="pickupLng"  value="104.0323">
                            <input type="hidden" name="destination_latitude"   id="destLat"    value="-1.0674">
                            <input type="hidden" name="destination_longitude"  id="destLng"    value="104.0323">

                            <div class="mb-3">
                                <label class="form-label">Alamat Jemput <span class="text-danger">*</span></label>
                                <div class="route-input-group">
                                    <span class="route-dot-start"></span>
                                    <input type="text" name="pickup_address" id="pickupAddress"
                                           class="form-control"
                                           placeholder="Masukkan alamat penjemputan..."
                                           required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat Tujuan <span class="text-danger">*</span></label>
                                <div class="route-input-group">
                                    <span class="route-dot-end"></span>
                                    <input type="text" name="destination_address" id="destAddress"
                                           class="form-control"
                                           placeholder="Masukkan alamat tujuan..."
                                           required>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Jarak Estimasi (km) <span class="text-danger">*</span></label>
                                    <input type="number" name="distance" id="distanceInput"
                                           class="form-control"
                                           placeholder="Contoh: 5" min="0.5" step="0.5" required>
                                    <div style="font-size:.75rem;color:var(--jp-gray-400);margin-top:4px">
                                        <i class="fas fa-info-circle me-1"></i>Perkiraan jarak tempuh
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Metode Bayar <span class="text-danger">*</span></label>
                                    <select name="payment_method" class="form-select" required>
                                        <option value="cash">💵 Tunai (Cash)</option>
                                        <option value="ewallet">💳 E-Wallet</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Catatan untuk Driver</label>
                                <input type="text" name="customer_notes" class="form-control"
                                       placeholder="Contoh: pakai helm, bawa barang besar...">
                            </div>

                            {{-- Estimasi Harga --}}
                            <div class="price-box mb-4" id="priceBox" style="display:none">
                                <div class="price-label">Estimasi Tarif</div>
                                <div class="price-value" id="priceValue">Rp —</div>
                                <div class="price-note">*Harga final dihitung saat order diterima driver</div>
                            </div>
                            <input type="hidden" name="price" id="priceInput" value="0">

                            <button type="submit" class="btn btn-jp-primary w-100"
                                    style="padding:.85rem;font-size:1rem" id="submitBtn" disabled>
                                <i class="fas fa-motorcycle me-2"></i>
                                <span id="submitText">Isi rute untuk memesan</span>
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            {{-- ===== SIDEBAR INFO ===== --}}
            <div class="col-lg-5">

                {{-- Tarif lengkap --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header">
                        <span><i class="fas fa-coins me-2 text-jp-green"></i>Rincian Tarif</span>
                    </div>
                    <div class="jp-card-body">

                        <div style="margin-bottom:1rem">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span style="font-size:1.3rem">🏍️</span>
                                <span class="fw-700">JaploRide (Motor)</span>
                            </div>
                            <div style="font-size:.8375rem;color:var(--jp-gray-600);padding-left:1.8rem;line-height:1.9">
                                <div>Biaya dasar: <strong>Rp {{ number_format($tariffMotor->base_fare ?? 5000, 0, ',', '.') }}</strong></div>
                                <div>Per km: <strong>Rp {{ number_format($tariffMotor->per_km ?? 3000, 0, ',', '.') }}</strong></div>
                                <div>Minimum: <strong>Rp {{ number_format($tariffMotor->minimum_fare ?? 8000, 0, ',', '.') }}</strong></div>
                            </div>
                        </div>

                        <hr style="border-color:var(--jp-gray-200)">

                        <div>
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span style="font-size:1.3rem">🚗</span>
                                <span class="fw-700">JaploCar (Mobil)</span>
                            </div>
                            <div style="font-size:.8375rem;color:var(--jp-gray-600);padding-left:1.8rem;line-height:1.9">
                                <div>Biaya dasar: <strong>Rp {{ number_format($tariffMobil->base_fare ?? 10000, 0, ',', '.') }}</strong></div>
                                <div>Per km: <strong>Rp {{ number_format($tariffMobil->per_km ?? 6000, 0, ',', '.') }}</strong></div>
                                <div>Minimum: <strong>Rp {{ number_format($tariffMobil->minimum_fare ?? 15000, 0, ',', '.') }}</strong></div>
                            </div>
                        </div>

                        <div style="background:var(--jp-gray-50);border-radius:10px;padding:.75rem;margin-top:1rem;font-size:.78rem;color:var(--jp-gray-500)">
                            <i class="fas fa-info-circle me-1" style="color:var(--jp-green)"></i>
                            Tarif sudah termasuk biaya platform. Tidak ada biaya tersembunyi.
                        </div>
                    </div>
                </div>

                {{-- Cara pesan --}}
                <div class="jp-card">
                    <div class="jp-card-header">
                        <span><i class="fas fa-circle-question me-2 text-jp-green"></i>Cara Pesan</span>
                    </div>
                    <div class="jp-card-body">
                        @php
                            $steps = [
                                ['n'=>'1', 'text'=>'Pilih jenis kendaraan (motor/mobil)'],
                                ['n'=>'2', 'text'=>'Isi alamat jemput dan tujuan'],
                                ['n'=>'3', 'text'=>'Masukkan estimasi jarak'],
                                ['n'=>'4', 'text'=>'Konfirmasi tarif dan pesan'],
                                ['n'=>'5', 'text'=>'Driver terdekat akan menerima ordermu'],
                                ['n'=>'6', 'text'=>'Pantau posisi driver secara real-time'],
                            ];
                        @endphp
                        <div class="d-flex flex-column gap-3">
                            @foreach($steps as $step)
                                <div class="d-flex align-items-start gap-3">
                                    <div style="width:28px;height:28px;border-radius:50%;background:var(--jp-green-light);color:var(--jp-green);font-weight:700;font-size:.8rem;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                                        {{ $step['n'] }}
                                    </div>
                                    <div style="font-size:.8375rem;color:var(--jp-gray-600);padding-top:5px">
                                        {{ $step['text'] }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Tarif dari DB
const tariffs = {
    motor: {
        base: {{ $tariffMotor->base_fare ?? 5000 }},
        perKm: {{ $tariffMotor->per_km ?? 3000 }},
        min: {{ $tariffMotor->minimum_fare ?? 8000 }},
    },
    mobil: {
        base: {{ $tariffMobil->base_fare ?? 10000 }},
        perKm: {{ $tariffMobil->per_km ?? 6000 }},
        min: {{ $tariffMobil->minimum_fare ?? 15000 }},
    }
};

let selectedVehicle = 'motor';

function selectVehicle(type) {
    selectedVehicle = type;
    document.getElementById('vehicleTypeInput').value = type;
    document.getElementById('cardMotor').classList.toggle('selected', type === 'motor');
    document.getElementById('cardMobil').classList.toggle('selected', type === 'mobil');
    calculatePrice();
}

function calculatePrice() {
    const pickup = document.getElementById('pickupAddress').value.trim();
    const dest   = document.getElementById('destAddress').value.trim();
    const dist   = parseFloat(document.getElementById('distanceInput').value) || 0;
    const btn    = document.getElementById('submitBtn');
    const btnTxt = document.getElementById('submitText');

    if (!pickup || !dest || dist <= 0) {
        document.getElementById('priceBox').style.display = 'none';
        btn.disabled = true;
        btnTxt.textContent = 'Isi rute untuk memesan';
        document.getElementById('priceInput').value = 0;
        return;
    }

    const t     = tariffs[selectedVehicle];
    let price   = t.base + (dist * t.perKm);
    price       = Math.max(price, t.min);
    price       = Math.round(price / 100) * 100;

    document.getElementById('priceValue').textContent = 'Rp ' + price.toLocaleString('id-ID');
    document.getElementById('priceInput').value = price;
    document.getElementById('priceBox').style.display = '';

    btn.disabled = false;
    const vehicle = selectedVehicle === 'motor' ? 'JaploRide' : 'JaploCar';
    btnTxt.textContent = `Pesan ${vehicle} — Rp ${price.toLocaleString('id-ID')}`;
}

['pickupAddress','destAddress','distanceInput'].forEach(id => {
    document.getElementById(id)?.addEventListener('input', calculatePrice);
});

document.getElementById('ojekForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const price = parseInt(document.getElementById('priceInput').value) || 0;
    if (price <= 0) {
        JapToast.error('Isi semua kolom terlebih dahulu.');
        return;
    }

    const btn    = document.getElementById('submitBtn');
    const btnTxt = document.getElementById('submitText');
    btn.disabled = true;
    btnTxt.textContent = 'Memproses...';

    const formData = new FormData(this);

    fetch(this.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            JapToast.success('Order berhasil dibuat! Mencari driver...');
            setTimeout(() => {
                window.location.href = '{{ route("order.history") }}';
            }, 2000);
        } else {
            const errs = data.errors ? Object.values(data.errors).flat().join(', ') : data.message;
            JapToast.error(errs || 'Gagal membuat order.');
            btn.disabled = false;
            btnTxt.textContent = 'Coba Lagi';
        }
    })
    .catch(() => {
        JapToast.error('Terjadi kesalahan. Coba lagi.');
        btn.disabled = false;
        btnTxt.textContent = 'Coba Lagi';
    });
});
</script>
@endpush

