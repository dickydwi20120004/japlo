@extends('layouts.app')
@section('title', 'Reset Password — JAPLO')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
<div class="min-vh-100 d-flex align-items-center auth-page">
    <div class="container-fluid">
        <div class="row g-0 min-vh-100">

            {{-- Kiri --}}
            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center auth-left">
                <div class="auth-circles">
                    <div class="circle circle-1"></div>
                    <div class="circle circle-2"></div>
                    <div class="circle circle-3"></div>
                </div>
                <div class="text-center text-white position-relative px-5" style="z-index:2">
                    <i class="fas fa-key mb-4" style="font-size:7rem;text-shadow:0 10px 30px rgba(0,0,0,.3)"></i>
                    <h1 class="fw-700 mb-2" style="font-size:2.5rem">Password Baru</h1>
                    <p style="font-size:1rem;opacity:.85;line-height:1.65">Buat password yang kuat untuk melindungi akun Anda</p>
                    <div class="row g-3 mt-3">
                        <div class="col-6"><div class="auth-feature-pill"><i class="fas fa-lock"></i><div>Min. 8 karakter</div></div></div>
                        <div class="col-6"><div class="auth-feature-pill"><i class="fas fa-check-circle"></i><div>Password aman</div></div></div>
                        <div class="col-6"><div class="auth-feature-pill"><i class="fas fa-shield-alt"></i><div>Akun terlindungi</div></div></div>
                        <div class="col-6"><div class="auth-feature-pill"><i class="fas fa-thumbs-up"></i><div>Siap digunakan</div></div></div>
                    </div>
                </div>
            </div>

            {{-- Kanan --}}
            <div class="col-lg-6 d-flex align-items-center justify-content-center py-5">
                <div class="w-100" style="max-width:440px;padding:0 2rem">
                    <div class="text-center mb-4 d-lg-none">
                        <i class="fas fa-motorcycle" style="font-size:2.5rem;color:#16A34A"></i>
                        <h3 class="fw-700 mt-2" style="color:#16A34A">JAPLO</h3>
                    </div>
                    <div class="card auth-card">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <i class="fas fa-key" style="font-size:3rem;color:#16A34A"></i>
                                <h3 class="fw-700 mt-3 mb-1">Reset Password</h3>
                                <p style="font-size:.875rem;color:#666">Masukkan password baru Anda</p>
                            </div>

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form action="{{ route('password.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <input type="hidden" name="email" value="{{ $email }}">

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control auth-input"
                                           value="{{ $email }}" readonly
                                           style="opacity:.7;cursor:not-allowed">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password Baru <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" id="password" name="password"
                                               class="form-control auth-input @error('password') is-invalid @enderror"
                                               placeholder="Min. 8 karakter"
                                               style="border-radius:12px 0 0 12px;border-right:none"
                                               required minlength="8">
                                        <button type="button" class="btn btn-outline-secondary btn-eye"
                                                onclick="togglePassword('password', this)">
                                            <i class="fas fa-eye text-secondary"></i>
                                        </button>
                                    </div>
                                    @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                               class="form-control auth-input"
                                               placeholder="Ulangi password baru"
                                               style="border-radius:12px 0 0 12px;border-right:none"
                                               required>
                                        <button type="button" class="btn btn-outline-secondary btn-eye"
                                                onclick="togglePassword('password_confirmation', this)">
                                            <i class="fas fa-eye text-secondary"></i>
                                        </button>
                                    </div>
                                </div>

                                <button type="submit" class="btn-auth-submit">
                                    <i class="fas fa-check-circle me-2"></i>Simpan Password Baru
                                </button>

                                <div class="text-center mt-3">
                                    <a href="{{ route('login') }}" class="auth-link" style="font-size:.875rem">
                                        <i class="fas fa-arrow-left me-1"></i>Kembali ke Login
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/auth.js') }}"></script>
@endpush
