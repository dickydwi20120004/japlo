@extends('layouts.app')

@section('title', 'Daftar - JAPLO')

@section('content')
<div class="min-vh-100 d-flex align-items-center position-relative" style="background: linear-gradient(135deg, #00C16A 0%, #00A859 50%, #008F4A 100%); overflow: hidden;">
    <!-- Animated Background Shapes -->
    <div class="position-absolute w-100 h-100" style="top: 0; left: 0; opacity: 0.08; z-index: 0;">
        <div class="position-absolute rounded-circle" style="width: 400px; height: 400px; background: white; top: -150px; left: -150px;"></div>
        <div class="position-absolute rounded-circle" style="width: 250px; height: 250px; background: white; bottom: 30px; right: -80px;"></div>
        <div class="position-absolute rounded-circle" style="width: 180px; height: 180px; background: white; top: 40%; left: 8%;"></div>
    </div>
    
    <div class="container py-5 position-relative" style="z-index: 1;">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                    <div class="card-body p-5">
                        <!-- Header -->
                        <div class="text-center mb-4">
                            <h3 class="fw-bold mb-2">Buat Akun Baru</h3>
                            <p class="text-secondary mb-0">Bergabung dengan JAPLO sekarang</p>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('register.post') }}" method="POST" id="registerForm">
                            @csrf
                            
                            <!-- Role Selection -->
                            <div class="mb-4">
                                <label class="form-label fw-bold small text-secondary">Daftar sebagai:</label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input type="radio" class="btn-check" name="role" id="role_user" 
                                               value="user" {{ old('role', request('role', 'user')) == 'user' ? 'checked' : '' }}
                                               onchange="toggleDriverFields()">
                                        <label class="role-card role-user w-100 py-4 d-flex flex-column align-items-center position-relative overflow-hidden" for="role_user" style="border-radius: 12px; cursor: pointer; border: 3px solid #e0e0e0; transition: all 0.3s;">
                                            <div class="role-overlay"></div>
                                            <i class="fas fa-user fa-3x mb-2 position-relative" style="z-index: 2; color: white; text-shadow: 0 2px 4px rgba(0,0,0,0.3);"></i>
                                            <span class="fw-bold position-relative" style="z-index: 2; color: white; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">Penumpang</span>
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <input type="radio" class="btn-check" name="role" id="role_driver" 
                                               value="driver" {{ old('role', request('role')) == 'driver' ? 'checked' : '' }}
                                               onchange="toggleDriverFields()">
                                        <label class="role-card role-driver w-100 py-4 d-flex flex-column align-items-center position-relative overflow-hidden" for="role_driver" style="border-radius: 12px; cursor: pointer; border: 3px solid #e0e0e0; transition: all 0.3s;">
                                            <div class="role-overlay"></div>
                                            <i class="fas fa-motorcycle fa-3x mb-2 position-relative" style="z-index: 2; color: white; text-shadow: 0 2px 4px rgba(0,0,0,0.3);"></i>
                                            <span class="fw-bold position-relative" style="z-index: 2; color: white; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">Driver</span>
                                        </label>
                                    </div>
                                </div>
                                @error('role')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <style>
                                /* Role Card Backgrounds */
                                .role-user {
                                    background: linear-gradient(135deg, rgba(0, 168, 89, 0.85) 0%, rgba(0, 143, 74, 0.85) 100%), 
                                                url('https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&q=80');
                                    background-size: cover;
                                    background-position: center;
                                }
                                
                                .role-driver {
                                    background: linear-gradient(135deg, rgba(255, 193, 7, 0.9) 0%, rgba(255, 152, 0, 0.9) 100%), 
                                                url('https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&q=80');
                                    background-size: cover;
                                    background-position: center;
                                }
                                
                                .role-overlay {
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    right: 0;
                                    bottom: 0;
                                    background: linear-gradient(135deg, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.05) 100%);
                                    z-index: 1;
                                }
                                
                                .role-card:hover {
                                    transform: translateY(-4px);
                                    box-shadow: 0 8px 20px rgba(0,0,0,0.25);
                                }
                                
                                .btn-check:checked + .role-card {
                                    border-color: #00A859 !important;
                                    box-shadow: 0 0 0 4px rgba(0, 168, 89, 0.3);
                                }
                                
                                .btn-check:checked + .role-user {
                                    border-color: #00A859 !important;
                                    box-shadow: 0 0 0 4px rgba(0, 168, 89, 0.3);
                                }
                                
                                .btn-check:checked + .role-driver {
                                    border-color: #FFC107 !important;
                                    box-shadow: 0 0 0 4px rgba(255, 193, 7, 0.3);
                                }
                            </style>

                            <!-- Nama Lengkap -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold small text-secondary">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" 
                                       placeholder="Masukkan nama lengkap" 
                                       style="border-radius: 12px;" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold small text-secondary">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" 
                                       placeholder="email@contoh.com" 
                                       style="border-radius: 12px;" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="mb-3">
                                <label for="phone" class="form-label fw-bold small text-secondary">Nomor Telepon <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control form-control-lg @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone') }}" 
                                       placeholder="08xxxxxxxxxx" 
                                       pattern="[0-9]*"
                                       inputmode="numeric"
                                       onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                       oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                       style="border-radius: 12px;" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Driver Fields -->
                            <div id="driverFields" style="display: {{ old('role', request('role')) == 'driver' ? 'block' : 'none' }};">
                                <!-- Vehicle Type -->
                                <div class="mb-3">
                                    <label for="vehicle_type" class="form-label fw-bold small text-secondary">Jenis Kendaraan <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-lg @error('vehicle_type') is-invalid @enderror" 
                                            id="vehicle_type" name="vehicle_type" style="border-radius: 12px;">
                                        <option value="">Pilih jenis kendaraan</option>
                                        <option value="motor" {{ old('vehicle_type') == 'motor' ? 'selected' : '' }}>Motor</option>
                                        <option value="mobil" {{ old('vehicle_type') == 'mobil' ? 'selected' : '' }}>Mobil</option>
                                    </select>
                                    @error('vehicle_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Vehicle Brand -->
                                <div class="mb-3">
                                    <label for="vehicle_brand" class="form-label fw-bold small text-secondary">Merk Kendaraan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg @error('vehicle_brand') is-invalid @enderror" 
                                           id="vehicle_brand" name="vehicle_brand" value="{{ old('vehicle_brand') }}" 
                                           placeholder="Honda, Toyota, Yamaha" style="border-radius: 12px;">
                                    @error('vehicle_brand')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- License Plate -->
                                <div class="mb-3">
                                    <label for="license_plate" class="form-label fw-bold small text-secondary">Nomor Plat <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg @error('license_plate') is-invalid @enderror" 
                                           id="license_plate" name="license_plate" value="{{ old('license_plate') }}" 
                                           placeholder="1234567890" 
                                           pattern="[0-9]*"
                                           inputmode="numeric"
                                           onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                           style="border-radius: 12px;">
                                    @error('license_plate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- License Number -->
                                <div class="mb-3">
                                    <label for="license_number" class="form-label fw-bold small text-secondary">Nomor SIM <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg @error('license_number') is-invalid @enderror" 
                                           id="license_number" name="license_number" value="{{ old('license_number') }}" 
                                           placeholder="1234567890123456" 
                                           pattern="[0-9]*"
                                           inputmode="numeric"
                                           onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                           style="border-radius: 12px;">
                                    @error('license_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold small text-secondary">Password <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                           id="password" name="password" 
                                           placeholder="••••••••" 
                                           style="border-radius: 12px; padding-right: 50px;" required>
                                    <button type="button" class="btn position-absolute" 
                                            style="right: 10px; top: 50%; transform: translateY(-50%); border: none; background: transparent; padding: 0; z-index: 10;"
                                            onclick="togglePassword('password', this)">
                                        <i class="fas fa-eye text-secondary" style="font-size: 1.2rem;"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-bold small text-secondary">Konfirmasi Password <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input type="password" class="form-control form-control-lg" 
                                           id="password_confirmation" name="password_confirmation" 
                                           placeholder="••••••••" 
                                           style="border-radius: 12px; padding-right: 50px;" required>
                                    <button type="button" class="btn position-absolute" 
                                            style="right: 10px; top: 50%; transform: translateY(-50%); border: none; background: transparent; padding: 0; z-index: 10;"
                                            onclick="togglePassword('password_confirmation', this)">
                                        <i class="fas fa-eye text-secondary" style="font-size: 1.2rem;"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-lg w-100 fw-bold mb-3" style="background: #FFC107; color: #212121; border: none; border-radius: 12px; padding: 14px; transition: all 0.3s;" onmouseover="this.style.background='#FFB300'" onmouseout="this.style.background='#FFC107'">
                                <i class="fas fa-user-plus me-2"></i> Daftar
                            </button>

                            <!-- Login Link -->
                            <div class="text-center">
                                <p class="mb-0 text-secondary">
                                    Sudah punya akun? 
                                    <a href="{{ route('login') }}" class="fw-bold text-decoration-none" style="color: #00A859;">Masuk</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function togglePassword(inputId, button) {
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

function toggleDriverFields() {
    const role = document.querySelector('input[name="role"]:checked').value;
    const driverFields = document.getElementById('driverFields');
    const driverInputs = driverFields.querySelectorAll('input, select');
    
    if (role === 'driver') {
        driverFields.style.display = 'block';
        driverInputs.forEach(input => {
            input.required = true;
        });
    } else {
        driverFields.style.display = 'none';
        driverInputs.forEach(input => {
            input.required = false;
        });
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleDriverFields();
});
</script>
@endpush
@endsection
