@extends('layouts.app')

@section('title', 'Lupa Kata Sandi - JAPLO')

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
                                <i class="fas fa-lock text-warning" style="font-size: 3.5rem;"></i>
                            </div>
                            <h3 class="fw-bold mb-2">Lupa Kata Sandi?</h3>
                            <p class="text-secondary mb-0">Masukkan email Anda dan kami akan mengirimkan link reset password</p>
                        </div>

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

                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            
                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold small text-secondary">Email</label>
                                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" 
                                       placeholder="email@contoh.com"
                                       style="border-radius: 12px;" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-lg w-100 fw-bold mb-3" style="background: #00A859; color: white; border: none; border-radius: 12px; padding: 14px;">
                                <i class="fas fa-paper-plane me-2"></i> Kirim Link Reset
                            </button>

                            <!-- Back to Login Link -->
                            <div class="text-center">
                                <a href="{{ route('login') }}" class="text-decoration-none d-flex align-items-center justify-content-center" style="color: #00A859;">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Login
                                </a>
                            </div>
                        </form>

                        <!-- Info Box -->
                        <div class="mt-4 p-3 rounded" style="background: #f8f9fa;">
                            <h6 class="fw-bold mb-2">
                                <i class="fas fa-info-circle text-info me-2"></i> Informasi
                            </h6>
                            <ul class="small text-secondary mb-0 ps-3">
                                <li>Link reset akan dikirim ke email Anda</li>
                                <li>Link berlaku selama 60 menit</li>
                                <li>Cek folder spam jika tidak menerima email</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Demo Note -->
                <div class="text-center mt-3">
                    <small class="text-white">
                        <i class="fas fa-info-circle me-1"></i>
                        Demo: Gunakan email demo (demo@japlo.com) untuk testing
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
