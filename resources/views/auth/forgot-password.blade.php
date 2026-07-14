@extends('layouts.app')

@section('title', 'Lupa Kata Sandi - JAPLO')

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
                        <i class="fas fa-lock" style="font-size: 8rem; text-shadow: 0 10px 30px rgba(0,0,0,0.3);"></i>
                    </div>
                    <h1 class="fw-bold mb-3" style="font-size: 3rem; text-shadow: 0 4px 10px rgba(0,0,0,0.2);">Reset Password</h1>
                    <h3 class="mb-4" style="text-shadow: 0 2px 8px rgba(0,0,0,0.2);">Kami siap membantu Anda</h3>
                    <p class="lead" style="font-size: 1.2rem; text-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                        Jangan khawatir, kami akan mengirimkan link untuk reset password ke email Anda
                    </p>
                    
                    <!-- Features -->
                    <div class="row g-3 mt-4">
                        <div class="col-6">
                            <div class="p-3 rounded" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px);">
                                <i class="fas fa-shield-alt fa-2x mb-2"></i>
                                <div class="fw-bold">Proses aman</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px);">
                                <i class="fas fa-clock fa-2x mb-2"></i>
                                <div class="fw-bold">Link berlaku 60 menit</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px);">
                                <i class="fas fa-envelope fa-2x mb-2"></i>
                                <div class="fw-bold">Cek email Anda</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 rounded" style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px);">
                                <i class="fas fa-key fa-2x mb-2"></i>
                                <div class="fw-bold">Password baru siap</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Forgot Password Form -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center py-5">
                <div class="w-100" style="max-width: 450px; padding: 0 2rem;">
                    <!-- Logo for Mobile -->
                    <div class="text-center mb-4 d-lg-none">
                        <i class="fas fa-motorcycle" style="font-size: 3rem; color: #00A859;"></i>
                        <h3 class="fw-bold mt-2" style="color: #00A859;">JAPLO</h3>
                    </div>

                    <div class="card border-0 shadow-lg" style="border-radius: 20px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                        <div class="card-body p-5">
                            <!-- Header -->
                            <div class="text-center mb-4">
                                <div class="mb-3">
                                    <i class="fas fa-lock text-warning" style="font-size: 3.5rem;"></i>
                                </div>
                                <h3 class="fw-bold mb-2" style="color: #212121;">Lupa Kata Sandi?</h3>
                                <p class="mb-0" style="color: #666;">Masukkan email Anda dan kami akan mengirimkan link reset password</p>
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
                                <label for="email" class="form-label fw-bold small" style="color: #444;">Email</label>
                                <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" 
                                       placeholder="email@contoh.com"
                                       style="border-radius: 12px; background: rgba(255, 255, 255, 0.8); border: 1px solid rgba(0, 0, 0, 0.1);" required>
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
                        <div class="mt-4 p-3 rounded" style="background: rgba(0, 168, 89, 0.1);">
                            <h6 class="fw-bold mb-2" style="color: #00A859;">
                                <i class="fas fa-info-circle me-2"></i> Informasi
                            </h6>
                            <ul class="small mb-0 ps-3" style="color: #666;">
                                <li>Link reset akan dikirim ke email Anda</li>
                                <li>Link berlaku selama 60 menit</li>
                                <li>Cek folder spam jika tidak menerima email</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Demo Note -->
                <div class="text-center mt-3">
                    <small style="color: #666;">
                        <i class="fas fa-info-circle me-1"></i>
                        Demo: Gunakan email demo (demo@japlo.com) untuk testing
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
