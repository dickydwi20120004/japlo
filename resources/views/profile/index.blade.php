@extends('layouts.app')

@section('title', 'Profil - JAPLO')

@section('content')
<div class="hero-background" style="padding: 40px 0;">
    <div class="container hero-background-overlay">
        <h2 class="fw-bold text-white mb-2">
            <i class="fas fa-user-circle me-2"></i> Profil Saya
        </h2>
        <p class="text-white mb-0">Kelola informasi profil Anda</p>
    </div>
</div>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Profile Photo Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4 text-center">
                    <!-- Profile Photo Container -->
                    <div class="position-relative d-inline-block mb-3">
                        <div class="profile-photo-wrapper">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" 
                                     alt="Profile Photo" 
                                     class="profile-photo" 
                                     id="profilePhotoPreview">
                            @else
                                <div class="profile-photo profile-placeholder" id="profilePhotoPreview">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Edit Button (WhatsApp style) -->
                        <button type="button" class="btn-edit-photo" onclick="document.getElementById('photoInput').click()">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>

                    <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                    <p class="text-secondary mb-0">{{ $user->email }}</p>
                    <span class="badge bg-primary mt-2">
                        @if($user->isAdmin())
                            <i class="fas fa-shield-alt me-1"></i> Administrator
                        @elseif($user->isDriver())
                            <i class="fas fa-motorcycle me-1"></i> Driver
                        @else
                            <i class="fas fa-user me-1"></i> Penumpang
                        @endif
                    </span>

                    <!-- Hidden File Input -->
                    <form action="{{ route('profile.update.photo') }}" method="POST" enctype="multipart/form-data" id="photoForm">
                        @csrf
                        <input type="file" id="photoInput" name="profile_photo" accept="image/*" style="display: none;" onchange="previewAndUpload(this)">
                    </form>
                </div>
            </div>

            <!-- Profile Info Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-info-circle me-2 text-primary"></i> Informasi Pribadi
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-4 col-md-3">
                                    <small class="text-secondary">Nama Lengkap</small>
                                </div>
                                <div class="col-8 col-md-9">
                                    <span class="fw-bold">{{ $user->name }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-4 col-md-3">
                                    <small class="text-secondary">Email</small>
                                </div>
                                <div class="col-8 col-md-9">
                                    <span class="fw-bold">{{ $user->email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-4 col-md-3">
                                    <small class="text-secondary">Nomor Telepon</small>
                                </div>
                                <div class="col-8 col-md-9">
                                    <span class="fw-bold">{{ $user->phone }}</span>
                                </div>
                            </div>
                        </div>
                        @if($user->address)
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-4 col-md-3">
                                    <small class="text-secondary">Alamat</small>
                                </div>
                                <div class="col-8 col-md-9">
                                    <span>{{ $user->address }}</span>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-4 col-md-3">
                                    <small class="text-secondary">Bergabung</small>
                                </div>
                                <div class="col-8 col-md-9">
                                    <span>{{ $user->created_at->format('d F Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Driver Info Card (if driver) -->
            @if($user->isDriver() && $user->driver)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-motorcycle me-2 text-success"></i> Informasi Driver
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-4 col-md-3">
                                    <small class="text-secondary">Kendaraan</small>
                                </div>
                                <div class="col-8 col-md-9">
                                    <span class="fw-bold">{{ ucfirst($user->driver->vehicle_type) }} - {{ $user->driver->vehicle_brand }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-4 col-md-3">
                                    <small class="text-secondary">Nomor Plat</small>
                                </div>
                                <div class="col-8 col-md-9">
                                    <span class="fw-bold">{{ $user->driver->license_plate }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-4 col-md-3">
                                    <small class="text-secondary">Nomor SIM</small>
                                </div>
                                <div class="col-8 col-md-9">
                                    <span class="fw-bold">{{ $user->driver->license_number }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-4 col-md-3">
                                    <small class="text-secondary">Rating</small>
                                </div>
                                <div class="col-8 col-md-9">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-star text-warning me-1"></i>
                                        <span class="fw-bold">{{ number_format($user->driver->rating, 1) }}</span>
                                        <small class="text-secondary ms-2">({{ $user->driver->total_rides }} perjalanan)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-4 col-md-3">
                                    <small class="text-secondary">Status</small>
                                </div>
                                <div class="col-8 col-md-9">
                                    @if($user->driver->is_available)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i> Available
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-times-circle me-1"></i> Offline
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            <i class="fas fa-edit me-2"></i> Edit Profil
                        </button>
                        <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            <i class="fas fa-key me-2"></i> Ganti Password
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <i class="fas fa-edit text-primary me-2"></i> Edit Profil
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('profile.update') }}" method="POST" id="editProfileForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" id="edit_name" name="name" value="{{ $user->name }}" required style="border-radius: 12px;">
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control form-control-lg" id="edit_email" name="email" value="{{ $user->email }}" required style="border-radius: 12px;">
                    </div>
                    <div class="mb-3">
                        <label for="edit_phone" class="form-label fw-bold">Nomor Telepon <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control form-control-lg" id="edit_phone" name="phone" value="{{ $user->phone }}" required 
                               pattern="[0-9]*"
                               inputmode="numeric"
                               onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                               style="border-radius: 12px;">
                    </div>
                    <div class="mb-3">
                        <label for="edit_address" class="form-label fw-bold">Alamat</label>
                        <textarea class="form-control" id="edit_address" name="address" rows="3" style="border-radius: 12px;">{{ $user->address }}</textarea>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <i class="fas fa-key text-warning me-2"></i> Ganti Password
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('profile.change.password') }}" method="POST" id="changePasswordForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="current_password" class="form-label fw-bold">Password Lama <span class="text-danger">*</span></label>
                        <div class="position-relative">
                            <input type="password" class="form-control form-control-lg" id="current_password" name="current_password" required style="border-radius: 12px; padding-right: 50px;">
                            <button type="button" class="btn position-absolute" 
                                    style="right: 10px; top: 50%; transform: translateY(-50%); border: none; background: transparent; padding: 0; z-index: 10;"
                                    onclick="togglePasswordField('current_password', this)">
                                <i class="fas fa-eye text-secondary" style="font-size: 1.2rem;"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label fw-bold">Password Baru <span class="text-danger">*</span></label>
                        <div class="position-relative">
                            <input type="password" class="form-control form-control-lg" id="new_password" name="new_password" required style="border-radius: 12px; padding-right: 50px;">
                            <button type="button" class="btn position-absolute" 
                                    style="right: 10px; top: 50%; transform: translateY(-50%); border: none; background: transparent; padding: 0; z-index: 10;"
                                    onclick="togglePasswordField('new_password', this)">
                                <i class="fas fa-eye text-secondary" style="font-size: 1.2rem;"></i>
                            </button>
                        </div>
                        <small class="text-secondary">Minimal 8 karakter</small>
                    </div>
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label fw-bold">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                        <div class="position-relative">
                            <input type="password" class="form-control form-control-lg" id="new_password_confirmation" name="new_password_confirmation" required style="border-radius: 12px; padding-right: 50px;">
                            <button type="button" class="btn position-absolute" 
                                    style="right: 10px; top: 50%; transform: translateY(-50%); border: none; background: transparent; padding: 0; z-index: 10;"
                                    onclick="togglePasswordField('new_password_confirmation', this)">
                                <i class="fas fa-eye text-secondary" style="font-size: 1.2rem;"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-key me-2"></i> Ganti Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Photo Preview Modal -->
<div class="modal fade" id="photoModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Preview Foto Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalPhotoPreview" src="" alt="Preview" style="max-width: 100%; border-radius: 50%; max-height: 400px;">
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="uploadPhoto()">
                    <i class="fas fa-check me-2"></i> Simpan Foto
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .profile-photo-wrapper {
        width: 150px;
        height: 150px;
        position: relative;
    }

    .profile-photo {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #00A859;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .profile-placeholder {
        background: linear-gradient(135deg, #00A859 0%, #00C16A 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
    }

    .btn-edit-photo {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #00A859;
        color: white;
        border: 3px solid white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }

    .btn-edit-photo:hover {
        background: #008F4A;
        transform: scale(1.1);
    }

    .btn-edit-photo i {
        font-size: 1rem;
    }

    .list-group-item {
        padding: 1rem;
        transition: background-color 0.2s;
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
    }

    .card {
        transition: all 0.3s;
    }

    .card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.12) !important;
    }
</style>
@endpush

@push('scripts')
<script>
function togglePasswordField(inputId, button) {
    const input = document.getElementById(inputId);
    const icon = button.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

function previewAndUpload(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            // Show preview in modal
            document.getElementById('modalPhotoPreview').src = e.target.result;
            
            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('photoModal'));
            modal.show();
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

function uploadPhoto() {
    const form = document.getElementById('photoForm');
    const formData = new FormData(form);
    
    // Show loading
    const btn = event.target;
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Uploading...';
    btn.disabled = true;
    
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update profile photo
            const photoPreview = document.getElementById('profilePhotoPreview');
            
            if (photoPreview.tagName === 'IMG') {
                photoPreview.src = data.photo_url;
            } else {
                // Replace placeholder with img
                photoPreview.outerHTML = `<img src="${data.photo_url}" alt="Profile Photo" class="profile-photo" id="profilePhotoPreview">`;
            }
            
            // Close modal
            bootstrap.Modal.getInstance(document.getElementById('photoModal')).hide();
            
            // Show success message
            alert('Foto profil berhasil diupdate!');
        } else {
            alert('Gagal upload foto: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat upload foto');
    })
    .finally(() => {
        btn.innerHTML = originalText;
        btn.disabled = false;
    });
}

// Show success/error messages
@if(session('success'))
    alert('✅ {{ session('success') }}');
@endif

@if(session('error'))
    alert('❌ {{ session('error') }}');
@endif

@if($errors->any())
    let errorMsg = 'Terjadi kesalahan:\n';
    @foreach($errors->all() as $error)
        errorMsg += '- {{ $error }}\n';
    @endforeach
    alert(errorMsg);
@endif
</script>
@endpush
