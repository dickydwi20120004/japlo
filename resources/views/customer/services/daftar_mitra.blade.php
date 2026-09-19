@extends('layouts.app')
@section('title', 'Daftar Mitra Usaha — JAPLO')

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
                🤝
            </div>
            <div>
                <h1>Daftar Mitra Usaha</h1>
                <p class="mb-0" style="font-size:.85rem;color:rgba(255,255,255,.8)">Bergabung dan kembangkan bisnis Anda bersama JAPLO</p>
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
                        Pendaftaran Anda sebagai mitra <strong>{{ $existing->business_name }}</strong>
                        sedang dalam proses.
                    </p>

                    @if($existing->status === 'rejected' && $existing->admin_notes)
                        <div class="alert alert-danger" style="text-align:left;max-width:480px;margin:0 auto 1.5rem">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <strong>Alasan Penolakan:</strong> {{ $existing->admin_notes }}
                        </div>
                    @endif

                    <a href="{{ route('customer.mitra.status') }}" class="btn btn-jp-primary">
                        <i class="fas fa-eye me-2"></i> Lihat Status Detail
                    </a>
                </div>
            </div>

        @else
            {{-- Registration Form --}}
            <form action="{{ route('customer.mitra.store') }}" method="POST" enctype="multipart/form-data" id="mitraForm">
                @csrf

                {{-- Info Usaha --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header">
                        <span><i class="fas fa-briefcase me-2 text-jp-green"></i>Informasi Usaha</span>
                    </div>
                    <div class="jp-card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Usaha <span class="text-danger">*</span></label>
                                <input type="text" name="business_name" class="form-control @error('business_name') is-invalid @enderror"
                                       value="{{ old('business_name') }}" placeholder="Contoh: Warung Makan Bu Siti" required>
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
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email', auth()->user()->email) }}"
                                       placeholder="email@domain.com">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Alamat Usaha <span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror"
                                          rows="2" placeholder="Alamat lengkap tempat usaha..." required>{{ old('address') }}</textarea>
                                @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Deskripsi Usaha <span class="text-danger">*</span></label>
                                <textarea name="business_description" class="form-control @error('business_description') is-invalid @enderror"
                                          rows="3" placeholder="Ceritakan tentang produk/layanan yang Anda tawarkan..." required>{{ old('business_description') }}</textarea>
                                @error('business_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pilih Tier Kemitraan --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header">
                        <span><i class="fas fa-star me-2 text-jp-green"></i>Pilih Tier Kemitraan</span>
                    </div>
                    <div class="jp-card-body">
                        <input type="hidden" name="membership_tier" id="tierInput" value="{{ old('membership_tier', 'reguler') }}">
                        <div class="row g-3">
                            @foreach($membershipTiers as $key => $tier)
                                <div class="col-6 col-md-4 col-lg">
                                    <div class="tier-card {{ old('membership_tier', 'reguler') == $key ? 'selected' : '' }}"
                                         id="tier-{{ $key }}"
                                         onclick="selectTier('{{ $key }}')">
                                        <div class="tier-icon">
                                            @switch($key)
                                                @case('reguler')  ⭐ @break
                                                @case('perunggu') 🥉 @break
                                                @case('perak')    🥈 @break
                                                @case('emas')     🥇 @break
                                                @case('platinum') 💎 @break
                                                @default ⭐
                                            @endswitch
                                        </div>
                                        <div class="tier-name" style="color:{{ $tier['color'] }}">
                                            {{ $tier['label'] }}
                                        </div>
                                        <div class="tier-price {{ $tier['price'] == 0 ? 'free' : '' }}">
                                            {{ $tier['price'] == 0 ? 'GRATIS' : 'Rp ' . number_format($tier['price'], 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('membership_tier')<div class="text-danger mt-2" style="font-size:.8rem">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Upload Dokumen --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header">
                        <span><i class="fas fa-file-image me-2 text-jp-green"></i>Upload Dokumen</span>
                    </div>
                    <div class="jp-card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Foto KTP <span class="text-danger">*</span></label>
                                <input type="file" name="ktp_photo" class="form-control @error('ktp_photo') is-invalid @enderror"
                                       accept="image/*,application/pdf" required>
                                <div style="font-size:.75rem;color:var(--jp-gray-400);margin-top:4px">
                                    Format: JPG, PNG, atau PDF. Maks 2MB
                                </div>
                                @error('ktp_photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Foto Usaha <span style="color:var(--jp-gray-400);font-weight:400">(Opsional)</span></label>
                                <input type="file" name="business_photo" class="form-control @error('business_photo') is-invalid @enderror"
                                       accept="image/*">
                                <div style="font-size:.75rem;color:var(--jp-gray-400);margin-top:4px">
                                    Foto tempat usaha / produk. Maks 5MB
                                </div>
                                @error('business_photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Benefits Info --}}
                <div class="jp-card mb-4" style="border-color:var(--jp-green);background:var(--jp-green-light)">
                    <div class="jp-card-body">
                        <div class="d-flex align-items-start gap-3">
                            <i class="fas fa-circle-info" style="color:var(--jp-green);font-size:1.25rem;margin-top:2px;flex-shrink:0"></i>
                            <div>
                                <div class="fw-700" style="color:var(--jp-green-dark);margin-bottom:.5rem">Keuntungan menjadi Mitra JAPLO:</div>
                                <ul class="benefit-list">
                                    <li><i class="fas fa-check"></i> Promosi usaha di platform JAPLO</li>
                                    <li><i class="fas fa-check"></i> Akses ke ribuan pelanggan di Bintan</li>
                                    <li><i class="fas fa-check"></i> Dukungan layanan pengiriman terintegrasi</li>
                                    <li><i class="fas fa-check"></i> Laporan penjualan & analitik</li>
                                    <li><i class="fas fa-check"></i> Prioritas tampil di halaman utama (Tier Emas & Platinum)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-jp-primary w-100" style="padding:.85rem;font-size:1rem">
                    <i class="fas fa-handshake me-2"></i> Kirim Pendaftaran Mitra
                </button>
            </form>
        @endif

    </div>
</div>
@endsection

@push('scripts')
<script>
function selectTier(key) {
    document.getElementById('tierInput').value = key;
    document.querySelectorAll('.tier-card').forEach(card => card.classList.remove('selected'));
    document.getElementById('tier-' + key).classList.add('selected');
}
</script>
@endpush

