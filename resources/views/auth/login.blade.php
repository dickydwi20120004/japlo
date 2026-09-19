@extends('layouts.app')
@section('title', 'Masuk — JAPLO')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')
<div class="min-vh-100 d-flex align-items-center auth-page">
    <div class="container-fluid">
        <div class="row g-0 min-vh-100">

            {{-- Kiri: Ilustrasi --}}
            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center auth-left">
                <div class="auth-circles">
                    <div class="circle circle-1"></div>
                    <div class="circle circle-2"></div>
                    <div class="circle circle-3"></div>
                </div>
                <div class="text-center text-white position-relative px-5" style="z-index:2">
                    <i class="fas fa-motorcycle mb-4" style="font-size:7rem;text-shadow:0 10px 30px rgba(0,0,0,.3)"></i>
                    <h1 class="fw-800 mb-2" style="font-size:3rem;letter-spacing:-.04em">JAPLO</h1>
                    <h4 class="mb-4 fw-500">Jelajahi hal-hal yang Anda sukai</h4>
                    <p class="mb-5" style="font-size:1rem;opacity:.85;line-height:1.65">
                        Platform jasa pengantar lokal untuk<br>masyarakat Bintan
                    </p>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="auth-feature-pill">
                                <i class="fas fa-users"></i>
                                <div>Order langsung</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="auth-feature-pill">
                                <i class="fas fa-clock"></i>
                                <div>Bekerja kapan saja</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="auth-feature-pill">
                                <i class="fas fa-motorcycle"></i>
                                <div>Jasa transportasi</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="auth-feature-pill">
                                <i class="fas fa-wallet"></i>
                                <div>Penghasilan langsung</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kanan: Form --}}
            <div class="col-lg-6 d-flex align-items-center justify-content-center py-5">
                <div class="w-100" style="max-width:440px;padding:0 2rem">

                    {{-- Logo mobile --}}
                    <div class="text-center mb-4 d-lg-none">
                        <i class="fas fa-motorcycle" style="font-size:2.5rem;color:#16A34A"></i>
                        <h3 class="fw-800 mt-2" style="color:#16A34A">JAPLO</h3>
                    </div>

                    <div class="card auth-card">
                        <div class="card-body">
                            <h3 class="fw-700 mb-1 text-center">Selamat Datang Kembali</h3>
                            <p class="text-center mb-4" style="color:#666;font-size:.9rem">
                                Masuk ke akun JAPLO Anda
                            </p>

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

                            <form action="{{ route('login.post') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" id="email" name="email"
                                           class="form-control auth-input @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}" placeholder="email@contoh.com" required>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" id="password" name="password"
                                               class="form-control auth-input @error('password') is-invalid @enderror"
                                               placeholder="••••••••"
                                               style="border-radius:12px 0 0 12px;border-right:none" required>
                                        <button type="button" class="btn btn-outline-secondary btn-eye"
                                                onclick="togglePassword('password', this)">
                                            <i class="fas fa-eye text-secondary"></i>
                                        </button>
                                    </div>
                                    @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>

                                <div class="mb-4 d-flex align-items-center justify-content-between">
                                    <div class="form-check mb-0">
                                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                        <label class="form-check-label" for="remember" style="font-size:.875rem">
                                            Ingat saya
                                        </label>
                                    </div>
                                    <a href="{{ route('password.request') }}" class="auth-link" style="font-size:.875rem">
                                        Lupa kata sandi?
                                    </a>
                                </div>

                                <button type="submit" class="btn-auth-submit">
                                    <i class="fas fa-sign-in-alt me-2"></i>Masuk
                                </button>

                                <div class="text-center mt-3" style="font-size:.875rem;color:#666">
                                    Belum punya akun?
                                    <a href="{{ route('register') }}" class="auth-link ms-1">Daftar</a>
                                </div>
                            </form>

                            {{-- Demo akun --}}
                            <div class="mt-4 pt-4 border-top">
                                <p class="text-center mb-2" style="font-size:.8rem;color:#999">Akun Demo:</p>
                                <div class="d-flex gap-2 justify-content-center flex-wrap">
                                    <button type="button" class="btn btn-sm btn-demo-user" onclick="fillDemo('user')">
                                        <i class="fas fa-user me-1"></i>Customer
                                    </button>
                                    <button type="button" class="btn btn-sm btn-demo-driver" onclick="fillDemo('driver')">
                                        <i class="fas fa-motorcycle me-1"></i>Driver
                                    </button>
                                    <button type="button" class="btn btn-sm btn-demo-admin" onclick="fillDemo('admin')">
                                        <i class="fas fa-shield-alt me-1"></i>Admin
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
@endsection

@push('scripts')
    <script src="{{ asset('js/auth.js') }}"></script>
@endpush
