@extends('layouts.app')
@section('title', 'Daftar Tenant Mini Expo — JAPLO')

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
                🏪
            </div>
            <div>
                <h1>Daftar Tenant Mini Expo</h1>
                <p class="mb-0" style="font-size:.85rem;color:rgba(255,255,255,.8)">Tampilkan usaha Anda di event Mini Expo JAPLO</p>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container">

        @if($existing)
            {{-- Already registered --}}
            <div class="jp-card">
                <div class="jp-card-body text-center" style="padding:3rem 2rem">
                    @php
                        $statusConfig = match($existing->status) {
                            'pending'  => ['icon' => 'clock', 'color' => '#D97706', 'bg' => '#FEF3C7', 'text' => 'Menunggu Verifikasi'],
                            'approved' => ['icon' => 'circle-check', 'color' => '#15803D', 'bg' => '#DCFCE7', 'text' => 'Pendaftaran Disetujui'],
                            'rejected' => ['icon' => 'circle-xmark', 'color' => '#DC2626', 'bg' => '#FEE2E2', 'text' => 'Pendaftaran Ditolak'],
                            default    => ['icon' => 'circle-question', 'color' => '#6B7280', 'bg' => '#F3F4F6', 'text' => 'Status Tidak Diketahui'],
                        };
                    @endphp

                    <div style="width:80px;height:80px;border-radius:50%;background:{{ $statusConfig['bg'] }};display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;font-size:2rem">
                        <i class="fas fa-{{ $statusConfig['icon'] }}" style="color:{{ $statusConfig['color'] }}"></i>
                    </div>
                    <h2 style="font-size:1.25rem;color:var(--jp-gray-900);margin-bottom:.5rem">{{ $statusConfig['text'] }}</h2>
                    <p style="font-size:.9rem;color:var(--jp-gray-500);margin-bottom:1.5rem">
                        Pendaftaran booth Anda untuk <strong>{{ $existing->expo_name }}</strong>
                        sedang dalam proses.
                    </p>

                    @if($existing->status === 'rejected' && $existing->admin_notes)
                        <div class="alert alert-danger" style="text-align:left;max-width:480px;margin:0 auto 1.5rem">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <strong>Alasan Penolakan:</strong> {{ $existing->admin_notes }}
                        </div>
                    @endif

                    <a href="{{ route('customer.expo.status') }}" class="btn btn-jp-primary">
                        <i class="fas fa-eye me-2"></i> Lihat Status Detail
                    </a>
                </div>
            </div>

        @else
            {{-- Expo Info --}}
            <div class="expo-info-card">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div style="width:36px;height:36px;background:var(--jp-green);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1rem;color:#fff">
                        🏪
                    </div>
                    <div class="fw-700" style="font-size:1rem;color:var(--jp-green-dark)">
                        {{ $expoInfo['name'] ?? 'Mini Expo JAPLO 2025' }}
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="expo-info-item">
                            <i class="fas fa-location-dot"></i>
                            <span>{{ $expoInfo['location'] ?? 'Lokasi menyusul' }}</span>
                        </div>
                        <div class="expo-info-item">
                            <i class="fas fa-calendar"></i>
                            <span>{{ $expoInfo['date'] ?? 'Tanggal menyusul' }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="expo-info-item">
                            <i class="fas fa-store"></i>
                            <span><strong>{{ $expoInfo['booths'] ?? '??' }}</strong> booth tersedia</span>
                        </div>
                        <div class="expo-info-item">
                            <i class="fas fa-users"></i>
                            <span>Terbuka untuk semua jenis usaha</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Registration Form --}}
            <form action="{{ route('customer.expo.store') }}" method="POST" enctype="multipart/form-data" id="expoForm">
                @csrf

                {{-- Info Pendaftar & Usaha --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header">
                        <span><i class="fas fa-store me-2 text-jp-green"></i>Informasi Usaha</span>
                    </div>
                    <div class="jp-card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Nama Expo <span class="text-danger">*</span></label>
                                <input type="text" name="expo_name" class="form-control @error('expo_name') is-invalid @enderror"
                                       value="{{ old('expo_name', $expoInfo['name'] ?? '') }}"
                                       placeholder="{{ $expoInfo['name'] ?? 'Mini Expo JAPLO 2025' }}" required>
                                @error('expo_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Usaha <span class="text-danger">*</span></label>
                                <input type="text" name="business_name" class="form-control @error('business_name') is-invalid @enderror"
                                       value="{{ old('business_name') }}" placeholder="Nama stand / usaha Anda" required>
                                @error('business_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenis Usaha <span class="text-danger">*</span></label>
                                <select name="business_type" class="form-select @error('business_type') is-invalid @enderror" required>
                                    <option value="">-- Pilih Jenis Usaha --</option>
                                    @foreach($businessTypes as $key => $label)
                                        <option value="{{ $key }}" {{ old('business_type') == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('business_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Pemilik <span class="text-danger">*</span></label>
                                <input type="text" name="owner_name" class="form-control @error('owner_name') is-invalid @enderror"
                                       value="{{ old('owner_name', auth()->user()->name) }}" required>
                                @error('owner_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nomor HP <span class="text-danger">*</span></label>
                                <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ old('phone', auth()->user()->phone ?? '') }}"
                                       placeholder="08xx-xxxx-xxxx" required>
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email', auth()->user()->email) }}">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Deskripsi Produk / Layanan <span class="text-danger">*</span></label>
                                <textarea name="product_description" class="form-control @error('product_description') is-invalid @enderror"
                                          rows="3" placeholder="Ceritakan produk/layanan yang akan Anda tampilkan di expo..." required>{{ old('product_description') }}</textarea>
                                @error('product_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pilih Ukuran Booth --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header">
                        <span><i class="fas fa-ruler-combined me-2 text-jp-green"></i>Pilih Ukuran Booth</span>
                    </div>
                    <div class="jp-card-body">
                        <input type="hidden" name="booth_size" id="boothSizeInput" value="{{ old('booth_size', '') }}">
                        <input type="hidden" name="booth_price" id="boothPriceInput" value="{{ old('booth_price', '0') }}">
                        <div class="row g-3">
                            @php
                                $boothOptions = [
                                    ['size' => 2, 'label' => '2×2 m', 'desc' => 'Booth mini, cocok untuk 1 produk', 'price' => 500000],
                                    ['size' => 3, 'label' => '3×3 m', 'desc' => 'Booth standar, cocok untuk 2–3 produk', 'price' => 1000000],
                                    ['size' => 4, 'label' => '4×4 m', 'desc' => 'Booth besar, display lengkap', 'price' => 2000000],
                                    ['size' => 6, 'label' => '4×6 m', 'desc' => 'Booth premium, cocok untuk brand', 'price' => 3500000],
                                ];
                            @endphp
                            @foreach($boothOptions as $booth)
                                <div class="col-6 col-md-3">
                                    <div class="booth-card {{ old('booth_size') == $booth['size'] ? 'selected' : '' }}"
                                         id="booth-{{ $booth['size'] }}"
                                         onclick="selectBooth({{ $booth['size'] }}, {{ $booth['price'] }})">
                                        <div class="booth-size">{{ $booth['size'] }}m²</div>
                                        <div class="fw-600" style="font-size:.875rem;margin:.25rem 0">{{ $booth['label'] }}</div>
                                        <div class="booth-label">{{ $booth['desc'] }}</div>
                                        <div class="booth-price">Rp {{ number_format($booth['price'], 0, ',', '.') }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('booth_size')<div class="text-danger mt-2" style="font-size:.8rem">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Permintaan Khusus & Dokumen --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header">
                        <span><i class="fas fa-file-alt me-2 text-jp-green"></i>Dokumen & Permintaan</span>
                    </div>
                    <div class="jp-card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Permintaan Khusus</label>
                                <textarea name="special_request" class="form-control" rows="2"
                                          placeholder="Misal: butuh listrik 3 titik, lokasi dekat pintu masuk, dll">{{ old('special_request') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Foto KTP <span class="text-danger">*</span></label>
                                <input type="file" name="ktp_photo" class="form-control @error('ktp_photo') is-invalid @enderror"
                                       accept="image/*,application/pdf" required>
                                <div style="font-size:.75rem;color:var(--jp-gray-400);margin-top:4px">Format: JPG, PNG, PDF. Maks 2MB</div>
                                @error('ktp_photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Foto Usaha <span style="color:var(--jp-gray-400);font-weight:400">(Opsional)</span></label>
                                <input type="file" name="business_photo" class="form-control @error('business_photo') is-invalid @enderror"
                                       accept="image/*">
                                <div style="font-size:.75rem;color:var(--jp-gray-400);margin-top:4px">Foto produk / stand sebelumnya. Maks 5MB</div>
                                @error('business_photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Booth Price Summary --}}
                <div id="boothSummary" class="jp-card mb-4" style="display:none;border-color:var(--jp-green)">
                    <div class="jp-card-body d-flex justify-content-between align-items-center">
                        <div>
                            <div style="font-size:.8rem;color:var(--jp-gray-500)">Biaya Booth yang Dipilih</div>
                            <div id="boothSummaryText" style="font-size:1.2rem;font-weight:800;color:var(--jp-green)"></div>
                        </div>
                        <div style="font-size:2rem;opacity:.5">🏪</div>
                    </div>
                </div>

                <button type="submit" class="btn btn-jp-primary w-100" style="padding:.85rem;font-size:1rem">
                    <i class="fas fa-store me-2"></i> Kirim Pendaftaran Tenant
                </button>
            </form>
        @endif

    </div>
</div>
@endsection

@push('scripts')
<script>
function selectBooth(size, price) {
    document.getElementById('boothSizeInput').value = size;
    document.getElementById('boothPriceInput').value = price;
    document.querySelectorAll('.booth-card').forEach(c => c.classList.remove('selected'));
    document.getElementById('booth-' + size).classList.add('selected');

    // Show summary
    const summary = document.getElementById('boothSummary');
    const summaryText = document.getElementById('boothSummaryText');
    summary.style.display = '';
    summaryText.textContent = 'Rp ' + price.toLocaleString('id-ID');
}

// Init from old()
@if(old('booth_size'))
    document.addEventListener('DOMContentLoaded', function () {
        selectBooth({{ old('booth_size') }}, {{ old('booth_price', 0) }});
    });
@endif
</script>
@endpush

