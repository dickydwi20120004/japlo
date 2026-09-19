@extends('layouts.app')
@section('title', 'Pengiriman Paket — JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/services.css') }}">
@endpush

@section('content')
<div class="jp-page-top">
    <div class="container">
        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ route('dashboard') }}" class="btn btn-sm"
               style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);color:#fff;border-radius:8px">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div style="width:48px;height:48px;background:rgba(255,255,255,.2);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.5rem">
                📦
            </div>
            <div>
                <h1>Pengiriman Paket</h1>
                <p class="mb-0" style="font-size:.85rem;color:rgba(255,255,255,.8)">Kirim paket ke seluruh wilayah Bintan</p>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container">
        <div class="row g-4">

            {{-- Form Order --}}
            <div class="col-lg-7">
                <form action="{{ route('customer.paket.store') }}" method="POST" id="paketForm">
                    @csrf

                    {{-- Info Pengirim --}}
                    <div class="jp-card mb-4">
                        <div class="jp-card-header">
                            <span><i class="fas fa-circle" style="color:var(--jp-green);font-size:.6rem;margin-right:6px"></i> Info Pengirim</span>
                        </div>
                        <div class="jp-card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Pengirim <span class="text-danger">*</span></label>
                                    <input type="text" name="sender_name" class="form-control @error('sender_name') is-invalid @enderror"
                                           value="{{ old('sender_name', auth()->user()->name) }}" required>
                                    @error('sender_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nomor HP Pengirim <span class="text-danger">*</span></label>
                                    <input type="tel" name="sender_phone" class="form-control @error('sender_phone') is-invalid @enderror"
                                           value="{{ old('sender_phone', auth()->user()->phone ?? '') }}"
                                           placeholder="08xx-xxxx-xxxx" required>
                                    @error('sender_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Alamat Jemput <span class="text-danger">*</span></label>
                                    <textarea name="pickup_address" class="form-control @error('pickup_address') is-invalid @enderror"
                                              rows="2" placeholder="Alamat lengkap jemput paket..." required>{{ old('pickup_address') }}</textarea>
                                    @error('pickup_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Info Penerima --}}
                    <div class="jp-card mb-4">
                        <div class="jp-card-header">
                            <span><i class="fas fa-circle" style="color:var(--jp-red);font-size:.6rem;margin-right:6px"></i> Info Penerima</span>
                        </div>
                        <div class="jp-card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Penerima <span class="text-danger">*</span></label>
                                    <input type="text" name="recipient_name" class="form-control @error('recipient_name') is-invalid @enderror"
                                           value="{{ old('recipient_name') }}" required>
                                    @error('recipient_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nomor HP Penerima <span class="text-danger">*</span></label>
                                    <input type="tel" name="recipient_phone" class="form-control @error('recipient_phone') is-invalid @enderror"
                                           value="{{ old('recipient_phone') }}" placeholder="08xx-xxxx-xxxx" required>
                                    @error('recipient_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Alamat Tujuan <span class="text-danger">*</span></label>
                                    <textarea name="destination_address" class="form-control @error('destination_address') is-invalid @enderror"
                                              rows="2" placeholder="Alamat lengkap tujuan pengiriman..." required>{{ old('destination_address') }}</textarea>
                                    @error('destination_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Detail Paket --}}
                    <div class="jp-card mb-4">
                        <div class="jp-card-header">
                            <span><i class="fas fa-box me-2 text-jp-green"></i>Detail Paket</span>
                        </div>
                        <div class="jp-card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Jenis Paket <span class="text-danger">*</span></label>
                                    <select name="package_type" class="form-select @error('package_type') is-invalid @enderror" required>
                                        <option value="">-- Pilih Jenis --</option>
                                        @foreach($packageTypes as $key => $label)
                                            <option value="{{ $key }}" {{ old('package_type') == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('package_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Berat Estimasi (kg)</label>
                                    <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror"
                                           value="{{ old('weight', '0.5') }}" min="0.1" step="0.1">
                                    @error('weight')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jarak Estimasi (km) <span class="text-danger">*</span></label>
                                    <input type="number" name="distance" id="distanceInput"
                                           class="form-control @error('distance') is-invalid @enderror"
                                           value="{{ old('distance', '') }}" min="1" step="0.5"
                                           placeholder="Misal: 5" required>
                                    @error('distance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <div style="font-size:.75rem;color:var(--jp-gray-400);margin-top:4px">
                                        <i class="fas fa-info-circle me-1"></i>Perkiraan jarak titik jemput ke tujuan
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Deskripsi Isi Paket</label>
                                    <input type="text" name="package_description" class="form-control"
                                           value="{{ old('package_description') }}" placeholder="Contoh: Buku, Pakaian...">
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fragile" id="fragileCheck"
                                               value="1" {{ old('fragile') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="fragileCheck" style="font-weight:500;font-size:.875rem">
                                            <i class="fas fa-fragile me-1" style="color:var(--jp-amber)"></i>
                                            Paket mudah pecah / rapuh
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Catatan Khusus</label>
                                    <textarea name="special_notes" class="form-control" rows="2"
                                              placeholder="Instruksi tambahan untuk driver...">{{ old('special_notes') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Pilih Kendaraan --}}
                    <div class="jp-card mb-4">
                        <div class="jp-card-header">
                            <span><i class="fas fa-motorcycle me-2 text-jp-green"></i>Pilih Kendaraan</span>
                        </div>
                        <div class="jp-card-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="vehicle-card" id="cardMotor" onclick="selectVehicle('motor')">
                                        <input type="radio" name="vehicle_type" value="motor" style="display:none"
                                               {{ old('vehicle_type', 'motor') == 'motor' ? 'checked' : '' }}>
                                        <div class="vehicle-icon">🏍️</div>
                                        <div class="vehicle-name">Motor</div>
                                        @if($tariffMotor)
                                            <div class="vehicle-tariff">
                                                Rp {{ number_format($tariffMotor->base_fare, 0, ',', '.') }} +
                                                Rp {{ number_format($tariffMotor->per_km, 0, ',', '.') }}/km
                                            </div>
                                        @endif
                                    </label>
                                </div>
                                <div class="col-6">
                                    <label class="vehicle-card" id="cardMobil" onclick="selectVehicle('mobil')">
                                        <input type="radio" name="vehicle_type" value="mobil" style="display:none"
                                               {{ old('vehicle_type') == 'mobil' ? 'checked' : '' }}>
                                        <div class="vehicle-icon">🚗</div>
                                        <div class="vehicle-name">Mobil</div>
                                        @if($tariffMobil)
                                            <div class="vehicle-tariff">
                                                Rp {{ number_format($tariffMobil->base_fare, 0, ',', '.') }} +
                                                Rp {{ number_format($tariffMobil->per_km, 0, ',', '.') }}/km
                                            </div>
                                        @endif
                                    </label>
                                </div>
                            </div>

                            {{-- Pilih Pembayaran --}}
                            <div class="mt-3">
                                <label class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                                <select name="payment_method" class="form-select" required>
                                    <option value="cash" {{ old('payment_method', 'cash') == 'cash' ? 'selected' : '' }}>💵 Tunai (Cash)</option>
                                    <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }}>🏦 Transfer Bank</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Estimasi Harga --}}
                    <div class="price-estimate-box mb-4">
                        <div class="price-label mb-1">Estimasi Biaya Pengiriman</div>
                        <div class="price-value" id="priceEstimate">Rp —</div>
                        <div style="font-size:.75rem;color:var(--jp-green-dark);margin-top:.25rem">
                            Masukkan jarak dan pilih kendaraan untuk kalkulasi otomatis
                        </div>
                    </div>
                    <input type="hidden" name="estimated_price" id="estimatedPriceInput" value="0">

                    <button type="submit" class="btn btn-jp-primary w-100" style="padding:.85rem;font-size:1rem">
                        <i class="fas fa-paper-plane me-2"></i> Buat Pesanan
                    </button>
                </form>
            </div>

            {{-- Sidebar: Riwayat --}}
            <div class="col-lg-5">
                <div class="jp-card">
                    <div class="jp-card-header">
                        <span><i class="fas fa-clock-rotate-left me-2 text-jp-green"></i>Pengiriman Saya</span>
                    </div>
                    <div class="jp-card-body p-0">
                        @if($myDeliveries->count() > 0)
                            <div class="table-responsive">
                                <table class="jp-table">
                                    <thead>
                                        <tr>
                                            <th>No. Kirim</th>
                                            <th>Penerima</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($myDeliveries as $delivery)
                                            <tr>
                                                <td>
                                                    <span style="font-family:monospace;font-size:.8rem;font-weight:600">
                                                        {{ $delivery->delivery_number }}
                                                    </span>
                                                </td>
                                                <td style="font-size:.8375rem">{{ $delivery->recipient_name }}</td>
                                                <td>
                                                    <span class="jp-badge status-badge-{{ str_replace('_', '_', $delivery->status) }}"
                                                          style="{{ 'background:' . match($delivery->status) {
                                                            'pending'    => '#FEF3C7;color:#D97706',
                                                            'accepted'   => '#DBEAFE;color:#2563EB',
                                                            'picked_up'  => '#EDE9FE;color:#7C3AED',
                                                            'in_transit' => '#FEF9C3;color:#A16207',
                                                            'delivered'  => '#DCFCE7;color:#15803D',
                                                            'cancelled'  => '#FEE2E2;color:#DC2626',
                                                            default      => '#F3F4F6;color:#6B7280',
                                                          } }}">
                                                        {{ ucfirst(str_replace('_', ' ', $delivery->status)) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('customer.paket.show', $delivery) }}"
                                                       class="btn btn-sm btn-jp-ghost">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="jp-empty">
                                <div class="empty-icon"><i class="fas fa-box-open"></i></div>
                                <p>Belum ada pengiriman paket</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const tariffs = {
    motor: {
        base: {{ $tariffMotor ? $tariffMotor->base_fare : 8000 }},
        perKm: {{ $tariffMotor ? $tariffMotor->per_km : 3000 }},
        min: {{ $tariffMotor ? $tariffMotor->minimum_fare : 8000 }},
    },
    mobil: {
        base: {{ $tariffMobil ? $tariffMobil->base_fare : 15000 }},
        perKm: {{ $tariffMobil ? $tariffMobil->per_km : 5000 }},
        min: {{ $tariffMobil ? $tariffMobil->minimum_fare : 15000 }},
    }
};

let selectedVehicle = '{{ old('vehicle_type', 'motor') }}';

function selectVehicle(type) {
    selectedVehicle = type;
    document.getElementById('cardMotor').classList.toggle('selected', type === 'motor');
    document.getElementById('cardMobil').classList.toggle('selected', type === 'mobil');
    document.querySelector(`input[value="${type}"]`).checked = true;
    calculatePrice();
}

function calculatePrice() {
    const dist = parseFloat(document.getElementById('distanceInput').value) || 0;
    if (!dist || dist <= 0) {
        document.getElementById('priceEstimate').textContent = 'Rp —';
        document.getElementById('estimatedPriceInput').value = '0';
        return;
    }
    const t = tariffs[selectedVehicle];
    let price = t.base + (dist * t.perKm);
    price = Math.max(price, t.min);
    price = Math.round(price / 100) * 100;
    document.getElementById('priceEstimate').textContent = 'Rp ' + price.toLocaleString('id-ID');
    document.getElementById('estimatedPriceInput').value = price;
}

document.getElementById('distanceInput').addEventListener('input', calculatePrice);

document.addEventListener('DOMContentLoaded', function () {
    selectVehicle(selectedVehicle);
});
</script>
@endpush

