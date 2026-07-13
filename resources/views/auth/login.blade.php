@extends('layouts.app')

@section('title', 'Masuk - JAPLO')

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
                            <div class="mb-3">
                                <i class="fas fa-motorcycle" style="font-size: 3.5rem; color: #00A859;"></i>
                            </div>
                            <h3 class="fw-bold mb-2">Selamat Datang Kembali</h3>
                            <p class="text-secondary mb-0">Masuk ke akun JAPLO Anda</p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
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

                            <!-- Remember Me -->
                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label text-secondary" for="remember">Ingat saya</label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-lg w-100 fw-bold mb-3" style="background: #FFC107; color: #212121; border: none; border-radius: 12px; padding: 14px; transition: all 0.3s;" onmouseover="this.style.background='#FFB300'" onmouseout="this.style.background='#FFC107'">
                                <i class="fas fa-sign-in-alt me-2"></i> Masuk
                            </button>

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
