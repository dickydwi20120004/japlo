@extends('layouts.app')
@section('title', 'Lupa Kata Sandi — JAPLO')

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
                    <i class="fas fa-lock mb-4" style="font-size:7rem;text-shadow:0 10px 30px rgba(0,0,0,.3)"></i>
                    <h1 class="fw-700 mb-2" style="font-size:2.5rem">Reset Password</h1>
                    <p style="font-size:1rem;opacity:.85;line-height:1.65">
                        Kami akan mengirimkan link reset password ke email Anda
                    </p>
                    <div class="row g-3 mt-3">
                        <div class="col-6"><div class="auth-feature-pill"><i class="fas fa-shield-alt"></i><div>Proses aman</div></div></div>
                        <div class="col-6"><div class="auth-feature-pill"><i class="fas fa-clock"></i><div>Link 60 menit</div></div></div>
                        <div class="col-6"><div class="auth-feature-pill"><i class="fas fa-envelope"></i><div>Cek email</div></div></div>
                        <div class="col-6"><div class="auth-feature-pill"><i class="fas fa-key"></i><div>Password baru</div></div></div>
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
                                <i class="fas fa-lock" style="font-size:3rem;color:#F59E0B"></i>
                                <h3 class="fw-700 mt-3 mb-1">Lupa Kata Sandi?</h3>
                                <p style="font-size:.875rem;color:#666">
                                    Masukkan email Anda untuk mendapatkan link reset
                                </p>
                            </div>

                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form action="{{ route('password.email') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email"
                                           class="form-control auth-input @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}" placeholder="email@contoh.com" required>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <button type="submit" class="btn-auth-submit">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim Link Reset
                                </button>

                                <div class="text-center mt-3">
                                    <a href="{{ route('login') }}" class="auth-link" style="font-size:.875rem">
                                        <i class="fas fa-arrow-left me-1"></i>Kembali ke Login
                                    </a>
                                </div>
                            </form>

                            <div class="mt-4 p-3 rounded" style="background:rgba(22,163,74,.08)">
                                <p class="mb-2 fw-600" style="font-size:.8125rem;color:#16A34A">
                                    <i class="fas fa-info-circle me-1"></i>Informasi
                                </p>
                                <ul class="mb-0 ps-3" style="font-size:.8rem;color:#666;line-height:1.8">
                                    <li>Link berlaku selama 60 menit</li>
                                    <li>Cek folder spam jika tidak menerima email</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
