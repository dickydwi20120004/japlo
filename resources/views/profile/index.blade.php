@extends('layouts.app')
@section('title', 'Profil Saya — JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('content')

<div class="jp-profile-top">
    <div class="container">
        <h1><i class="fas fa-user-circle me-2"></i>Profil Saya</h1>
        <p style="font-size:.85rem;color:rgba(255,255,255,.8);margin:.25rem 0 0">
            Kelola informasi akun Anda
        </p>
    </div>
</div>

<div class="page-body">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-7">

                {{-- Avatar & Info Dasar --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-body">
                        <div class="d-flex align-items-center gap-4">
                            {{-- Avatar --}}
                            <div class="avatar-wrap" id="avatarWrap">
                                @if($user->profile_photo)
                                    <img src="{{ asset('storage/' . $user->profile_photo) }}"
                                         alt="{{ $user->name }}" id="avatarImg">
                                @else
                                    <span>{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                @endif
                                <div class="avatar-edit-btn"
                                     onclick="document.getElementById('photoInput').click()"
                                     title="Ganti foto">
                                    <i class="fas fa-camera"></i>
                                </div>
                                <form action="{{ route('profile.update.photo') }}" method="POST"
                                      enctype="multipart/form-data" id="photoForm">
                                    @csrf
                                    <input type="file" id="photoInput" name="profile_photo"
                                           accept="image/*" style="display:none"
                                           onchange="uploadPhoto(this)">
                                </form>
                            </div>
                            {{-- Nama & Role --}}
                            <div>
                                <div class="fw-700" style="font-size:1.1rem;color:var(--jp-gray-900)">
                                    {{ $user->name }}
                                </div>
                                <div style="font-size:.875rem;color:var(--jp-gray-400)">{{ $user->email }}</div>
                                <div class="mt-1">
                                    @if($user->isAdmin())
                                        <span class="jp-badge jp-badge-cancelled">
                                            <i class="fas fa-shield-halved me-1"></i> Admin
                                        </span>
                                    @elseif($user->isDriver())
                                        <span class="jp-badge jp-badge-accepted">
                                            <i class="fas fa-motorcycle me-1"></i> Driver
                                        </span>
                                    @else
                                        <span class="jp-badge jp-badge-completed">
                                            <i class="fas fa-user me-1"></i> Customer
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Informasi Pribadi --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header">
                        <span><i class="fas fa-circle-info me-2 text-jp-green"></i>Informasi Pribadi</span>
                        <button type="button" class="btn btn-sm btn-jp-outline"
                                data-bs-toggle="modal" data-bs-target="#editModal">
                            <i class="fas fa-pen me-1"></i> Edit
                        </button>
                    </div>
                    <div class="jp-card-body">
                        <div class="info-row">
                            <span class="info-label">Nama Lengkap</span>
                            <span class="info-value">{{ $user->name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Email</span>
                            <span class="info-value">{{ $user->email }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">No. Telepon</span>
                            <span class="info-value">{{ $user->phone ?? '—' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Alamat</span>
                            <span class="info-value" style="max-width:60%;text-align:right">
                                {{ $user->address ?: '—' }}
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Bergabung</span>
                            <span class="info-value">{{ $user->created_at->format('d F Y') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Info Driver (jika driver) --}}
                @if($user->isDriver() && $user->driver)
                    <div class="jp-card mb-4">
                        <div class="jp-card-header">
                            <span><i class="fas fa-motorcycle me-2 text-jp-green"></i>Info Driver</span>
                            <span class="jp-badge {{ $user->driver->is_verified ? 'jp-badge-completed' : 'jp-badge-pending' }}">
                                {{ $user->driver->is_verified ? 'Terverifikasi' : 'Belum Diverifikasi' }}
                            </span>
                        </div>
                        <div class="jp-card-body">
                            <div class="info-row">
                                <span class="info-label">Kendaraan</span>
                                <span class="info-value">
                                    {{ ucfirst($user->driver->vehicle_type) }} — {{ $user->driver->vehicle_brand }}
                                </span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Nomor Plat</span>
                                <span class="info-value" style="font-family:monospace">
                                    {{ $user->driver->license_plate }}
                                </span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Rating</span>
                                <span class="info-value">
                                    <i class="fas fa-star" style="color:#F59E0B;font-size:.8rem"></i>
                                    {{ number_format($user->driver->rating, 1) }}
                                    <span style="color:var(--jp-gray-400);font-weight:400">
                                        ({{ $user->driver->total_rides }} perjalanan)
                                    </span>
                                </span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Total Penghasilan</span>
                                <span class="info-value" style="color:var(--jp-green)">
                                    Rp {{ number_format($user->driver->total_earnings, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Status</span>
                                <span class="jp-badge {{ $user->driver->is_available ? 'jp-badge-completed' : 'jp-badge-cancelled' }}">
                                    {{ $user->driver->is_available ? 'Online' : 'Offline' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Keamanan --}}
                <div class="jp-card">
                    <div class="jp-card-header">
                        <span><i class="fas fa-lock me-2 text-jp-green"></i>Keamanan</span>
                    </div>
                    <div class="jp-card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="fw-600" style="font-size:.875rem">Password</div>
                                <div style="font-size:.8rem;color:var(--jp-gray-400)">
                                    Terakhir diubah: tidak diketahui
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-jp-ghost"
                                    data-bs-toggle="modal" data-bs-target="#pwdModal">
                                <i class="fas fa-key me-1"></i> Ganti Password
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Modal Edit Profil --}}
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;border:none">
            <div class="modal-header" style="border-bottom:1px solid var(--jp-gray-200)">
                <h5 class="modal-title fw-700">Edit Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control"
                               value="{{ old('email', $user->email) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
                        <input type="tel" name="phone" class="form-control"
                               value="{{ old('phone', $user->phone) }}"
                               pattern="[0-9]*" inputmode="numeric"
                               oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="address" class="form-control" rows="2">{{ old('address', $user->address) }}</textarea>
                    </div>
                </div>
                <div class="modal-footer" style="border-top:1px solid var(--jp-gray-200)">
                    <button type="button" class="btn btn-jp-ghost" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-jp-primary">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Ganti Password --}}
<div class="modal fade" id="pwdModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;border:none">
            <div class="modal-header" style="border-bottom:1px solid var(--jp-gray-200)">
                <h5 class="modal-title fw-700"><i class="fas fa-key me-2 text-jp-green"></i>Ganti Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('profile.change.password') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Password Lama <span class="text-danger">*</span></label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Baru <span class="text-danger">*</span></label>
                        <input type="password" name="new_password" class="form-control"
                               minlength="8" required>
                        <div style="font-size:.75rem;color:var(--jp-gray-400);margin-top:4px">Minimal 8 karakter</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                        <input type="password" name="new_password_confirmation" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer" style="border-top:1px solid var(--jp-gray-200)">
                    <button type="button" class="btn btn-jp-ghost" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-jp-primary">
                        <i class="fas fa-key me-1"></i> Ganti Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function uploadPhoto(input) {
    if (!input.files || !input.files[0]) return;

    const form = document.getElementById('photoForm');
    const formData = new FormData(form);

    JapToast.info('Mengupload foto...');

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            // Update avatar display
            const wrap = document.getElementById('avatarWrap');
            const existing = wrap.querySelector('img, span');
            if (existing && existing.tagName === 'SPAN') {
                const img = document.createElement('img');
                img.id = 'avatarImg';
                img.alt = 'Profile';
                img.style.cssText = 'width:100%;height:100%;object-fit:cover;border-radius:50%';
                img.src = data.photo_url;
                wrap.insertBefore(img, wrap.firstChild);
                existing.remove();
            } else if (existing && existing.tagName === 'IMG') {
                existing.src = data.photo_url;
            }
            JapToast.success('Foto profil berhasil diperbarui!');
        } else {
            JapToast.error(data.message || 'Gagal mengupload foto.');
        }
    })
    .catch(() => JapToast.error('Terjadi kesalahan saat upload.'));
}

// Auto open modal jika ada error validasi
@if($errors->any())
    document.addEventListener('DOMContentLoaded', function () {
        new bootstrap.Modal(document.getElementById('editModal')).show();
    });
@endif
</script>
@endpush

