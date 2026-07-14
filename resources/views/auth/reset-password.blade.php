@extends('layouts.app')

@section('title', 'Reset Password - JAPLO')

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
                                <i class="fas fa-key text-success" style="font-size: 3.5rem;"></i>
                            </div>
                            <h3 class="fw-bold mb-2">Reset Password</h3>
                            <p class="text-secondary mb-0">Masukkan password baru Anda</p>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">
                            
                            <!-- Email (readonly) -->
                            <div class="mb-3">
                                <label for="email_display" class="form-label fw-bold small text-secondary">Email</label>
                                <input type="email" class="form-control form-control-lg" 
                                       id="email_display" value="{{ $email }}" 
                                       readonly style="border-radius: 12px; background: #f8f9fa;">
                            </div>

                            <!-- New Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold small text-secondary">Password Baru <span class="text-danger">*</span></label>
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
                                <small class="text-secondary">Minimal 8 karakter</small>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-bold small text-secondary">Konfirmasi Password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control form-control-lg" 
                                           id="password_confirmation" name="password_confirmation" 
                                           placeholder="••••••••"
                                           style="border-radius: 12px 0 0 12px; border-right: none;" required>
                                    <button type="button" class="btn btn-outline-secondary" 
                                            style="border-radius: 0 12px 12px 0; border-left: none; background: white;"
                                            onclick="togglePassword('password_confirmation', this)">
                                        <i class="fas fa-eye text-secondary"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-lg w-100 fw-bold mb-3" style="background: #00A859; color: white; border: none; border-radius: 12px; padding: 14px;">
                                <i class="fas fa-check-circle me-2"></i> Reset Password
                            </button>

                            <!-- Back to Login Link -->
                            <div class="text-center">
                                <a href="{{ route('login') }}" class="text-decoration-none d-flex align-items-center justify-content-center" style="color: #00A859;">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Login
                                </a>
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
</script>
@endpush
@endsection
