@extends('layouts.app')

@section('title', 'Masuk - JAPLO')

@section('content')
<div class="min-vh-100 d-flex align-items-center" style="background: #f0f2f5;">
    <div class="container-fluid">
        <div class="row g-0 min-vh-100">
            <!-- Left Side - Illustration -->
            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center position-relative" 
                 style="background: linear-gradient(135deg, #00C16A 0%, #00A859 50%, #008F4A 100%); overflow: hidden;">
                
                <!-- Decorative Shapes -->
                <div class="position-absolute w-100 h-100" style="opacity: 0.1;">
                    <div class="position-absolute rounded-circle" style="width: 400px; height: 400px; background: white; top: -100px; left: -100px;"></div>
                    <div class="position-absolute rounded-circle" style="width: 300px; height: 300px; background: white; bottom: -80px; right: -80px;"></div>
                    <div class="position-absolute rounded-circle" style="width: 200px; height: 200px; background: white; top: 40%; right: 10%;"></div>
                </div>

                <!-- Content -->
                <div class="text-center text-white position-relative px-5">
                    <div class="mb-4">
                        <i class="fas fa-motorcycle" style="font-size: 8rem; text-shadow: 0 10px 30px rgba(0,0,0,0.3);"></i>
                    </div>
                    <h1 class="fw-bold mb-3" style="font-size: 3rem; text-shadow: 0 4px 10px rgba(0,0,0,0.2);">JAPLO</h1>
                    <h3 class="mb-4" style="text-shadow: 0 2px 8px rgba(0,0,0,0.2);">Jelajahi hal-hal yang Anda sukai</h3>
                    <p class="lead" style="font-size: 1.2rem; text-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                        Bergabung sebagai driver JAPLO dan nikmati penghasilan tambahan dengan fleksibilitas waktu
                    </p>
                    
                    <!-- Features -->
                    <div class="row g-3 mt-4">
                        <div class="col-6">
                            <div class="p-3 rounded" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px);">
                                <i class="fas fa-users fa-2x mb-2"></i>
                                <div class="fw-bold">Akses ke order langsung</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px);">
                                <i class="fas fa-check-circle fa-2x mb-2"></i>
                                <div class="fw-bold">Bekerja kapan saja</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px);">
                                <i class="fas fa-car fa-2x mb-2"></i>
                                <div class="fw-bold">Bekerja dengan jasa transportasi</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px);">
                                <i class="fas fa-wallet fa-2x mb-2"></i>
                                <div class="fw-bold">Penghasilan langsung</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center py-5">
                <div class="w-100" style="max-width: 450px; padding: 0 2rem;">
                    <!-- Logo for Mobile -->
                    <div class="text-center mb-4 d-lg-none">
                        <i class="fas fa-motorcycle" style="font-size: 3rem; color: #00A859;"></i>
                        <h3 class="fw-bold mt-2" style="color: #00A859;">JAPLO</h3>
                    </div>

                    <div class="card border-0 shadow-lg" style="border-radius: 20px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                        <div class="card-body p-5">
                            <h3 class="fw-bold mb-2 text-center" style="color: #212121;">Selamat Datang Kembali</h3>
                            <p class="mb-4 text-center" style="color: #666;">Masuk ke akun JAPLO Anda</p>

                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form action="{{ route('login.post') }}" method="POST">
                                @csrf
                                
                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold small text-secondary">Email</label>
                                    <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email') }}" 
                                           placeholder="email@contoh.com"
                                           style="border-radius: 12px;" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-bold small text-secondary">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                               id="password" name="password" 
                                               placeholder="••••••••"
                                               style="border-radius: 12px 0 0 12px; border-right: none;" required>
                                        <button type="button" class="btn btn-outline-secondary" 
                                                style="border-radius: 0 12px 12px 0; border-left: none; background: white;"
                                                onclick="togglePassword('password', this)">
                                            <i class="fas fa-eye text-secondary"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Remember Me -->
                                <div class="mb-4 form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label text-secondary" for="remember">Ingat saya</label>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-lg w-100 fw-bold mb-3" style="background: #FFC107; color: #212121; border: none; border-radius: 12px; padding: 14px; transition: all 0.3s;" onmouseover="this.style.background='#FFB300'" onmouseout="this.style.background='#FFC107'">
                                    <i class="fas fa-sign-in-alt me-2"></i> Masuk
                                </button>

                                <!-- Forgot Password Link -->
                                <div class="text-center mb-3">
                                    <a href="{{ route('password.request') }}" class="text-decoration-none" style="color: #00A859; font-weight: 500;">
                                        Lupa kata sandi?
                                    </a>
                                </div>

                                <!-- Register Link -->
                                <div class="text-center">
                                    <p class="mb-0 text-secondary">
                                        Belum punya akun? 
                                        <a href="{{ route('register') }}" class="fw-bold text-decoration-none" style="color: #00A859;">Daftar</a>
                                    </p>
                                </div>
                            </form>

                            <!-- Demo Accounts Info -->
                            <div class="mt-4 pt-4 border-top">
                                <p class="text-center text-secondary small mb-2">Demo Akun:</p>
                                <div class="d-flex gap-2 justify-content-center flex-wrap">
                                    <button type="button" class="btn btn-sm" style="background: #00A859; color: white; border: none;" onclick="fillDemo('user')">
                                        <i class="fas fa-user me-1"></i> Penumpang
                                    </button>
                                    <button type="button" class="btn btn-sm" style="background: #FFC107; color: #212121; border: none;" onclick="fillDemo('driver')">
                                        <i class="fas fa-motorcycle me-1"></i> Driver
                                    </button>
                                    <button type="button" class="btn btn-sm" style="background: #DC3545; color: white; border: none;" onclick="fillDemo('admin')">
                                        <i class="fas fa-shield-alt me-1"></i> Admin
                                    </button>
                                </div>
                            </div>
                        </div>
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

function fillDemo(type) {
    if (type === 'user') {
        document.getElementById('email').value = 'demo@japlo.com';
        document.getElementById('password').value = 'password123';
    } else if (type === 'driver') {
        document.getElementById('email').value = 'driver@japlo.com';
        document.getElementById('password').value = 'password123';
    } else if (type === 'admin') {
        document.getElementById('email').value = 'admin@japlo.com';
        document.getElementById('password').value = 'admin123';
    }
}
</script>
@endpush
@endsection
