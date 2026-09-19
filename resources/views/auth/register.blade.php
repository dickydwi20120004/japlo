@extends('layouts.app')
@section('title', 'Daftar — JAPLO')

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
                    <h4 class="mb-4 fw-500">Bergabung bersama kami</h4>
                    <div class="row g-3 mt-2">
                        <div class="col-6">
                            <div class="auth-feature-pill">
                                <i class="fas fa-bolt"></i>
                                <div>Pendaftaran cepat</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="auth-feature-pill">
                                <i class="fas fa-shield-alt"></i>
                                <div>Aman & terpercaya</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="auth-feature-pill">
                                <i class="fas fa-star"></i>
                                <div>Layanan premium</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="auth-feature-pill">
                                <i class="fas fa-headset"></i>
                                <div>Dukungan 24/7</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kanan: Form --}}
            <div class="col-lg-6 d-flex align-items-center justify-content-center py-5">
                <div class="w-100" style="max-width:480px;padding:0 2rem">

                    <div class="text-center mb-4 d-lg-none">
                        <i class="fas fa-motorcycle" style="font-size:2.5rem;color:#16A34A"></i>
                        <h3 class="fw-800 mt-2" style="color:#16A34A">JAPLO</h3>
                    </div>

                    <div class="card auth-card">
                        <div class="card-body">
                            <h3 class="fw-700 mb-1 text-center">Buat Akun Baru</h3>
                            <p class="text-center mb-4" style="color:#666;font-size:.9rem">
                                Bergabung dengan JAPLO sekarang
                            </p>

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form action="{{ route('register.post') }}" method="POST" id="registerForm">
                                @csrf

                                {{-- Role Selection --}}
                                <div class="mb-4">
                                    <label class="form-label">Daftar sebagai:</label>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <input type="radio" class="btn-check" name="role" id="role_user"
                                                   value="user" {{ old('role', request('role', 'user')) == 'user' ? 'checked' : '' }}>
                                            <label class="role-card role-user w-100 py-4 d-flex flex-column align-items-center position-relative overflow-hidden"
                                                   for="role_user">
                                                <div class="role-overlay"></div>
                                                <i class="fas fa-user fa-2x mb-2 position-relative" style="z-index:2;color:#fff;text-shadow:0 2px 4px rgba(0,0,0,.3)"></i>
                                                <span class="fw-700 position-relative" style="z-index:2;color:#fff">Penumpang</span>
                                            </label>
                                        </div>
                                        <div class="col-6">
                                            <input type="radio" class="btn-check" name="role" id="role_driver"
                                                   value="driver" {{ old('role', request('role')) == 'driver' ? 'checked' : '' }}>
                                            <label class="role-card role-driver w-100 py-4 d-flex flex-column align-items-center position-relative overflow-hidden"
                                                   for="role_driver">
                                                <div class="role-overlay"></div>
                                                <i class="fas fa-motorcycle fa-2x mb-2 position-relative" style="z-index:2;color:#fff;text-shadow:0 2px 4px rgba(0,0,0,.3)"></i>
                                                <span class="fw-700 position-relative" style="z-index:2;color:#fff">Driver</span>
                                            </label>
                                        </div>
                                    </div>
                                    @error('role')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>

                                {{-- Fields --}}
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control auth-input @error('name') is-invalid @enderror"
                                           value="{{ old('name') }}" placeholder="Nama lengkap" required>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control auth-input @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}" placeholder="email@contoh.com" required>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                    <input type="tel" name="phone" class="form-control auth-input @error('phone') is-invalid @enderror"
                                           value="{{ old('phone') }}" placeholder="08xxxxxxxxxx"
                                           inputmode="numeric" oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                {{-- Driver Fields --}}
                                <div id="driverFields" style="display:{{ old('role', request('role')) == 'driver' ? 'block' : 'none' }}">
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Kendaraan <span class="text-danger">*</span></label>
                                        <select name="vehicle_type" class="form-select auth-input @error('vehicle_type') is-invalid @enderror">
                                            <option value="">Pilih jenis kendaraan</option>
                                            <option value="motor" {{ old('vehicle_type') == 'motor' ? 'selected' : '' }}>Motor</option>
                                            <option value="mobil" {{ old('vehicle_type') == 'mobil' ? 'selected' : '' }}>Mobil</option>
                                        </select>
                                        @error('vehicle_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Merk Kendaraan <span class="text-danger">*</span></label>
                                        <input type="text" name="vehicle_brand" class="form-control auth-input @error('vehicle_brand') is-invalid @enderror"
                                               value="{{ old('vehicle_brand') }}" placeholder="Honda, Toyota, Yamaha">
                                        @error('vehicle_brand')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Plat <span class="text-danger">*</span></label>
                                        <input type="text" name="license_plate" class="form-control auth-input @error('license_plate') is-invalid @enderror"
                                               value="{{ old('license_plate') }}" placeholder="BP 1234 AX">
                                        @error('license_plate')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nomor SIM <span class="text-danger">*</span></label>
                                        <input type="text" name="license_number" class="form-control auth-input @error('license_number') is-invalid @enderror"
                                               value="{{ old('license_number') }}" placeholder="1234567890123456"
                                               inputmode="numeric" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                        @error('license_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" id="password" name="password"
                                               class="form-control auth-input @error('password') is-invalid @enderror"
                                               placeholder="Min. 8 karakter"
                                               style="border-radius:12px 0 0 12px;border-right:none" required minlength="8">
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
                                               placeholder="Ulangi password"
                                               style="border-radius:12px 0 0 12px;border-right:none" required>
                                        <button type="button" class="btn btn-outline-secondary btn-eye"
                                                onclick="togglePassword('password_confirmation', this)">
                                            <i class="fas fa-eye text-secondary"></i>
                                        </button>
                                    </div>
                                </div>

                                <button type="submit" class="btn-auth-submit">
                                    <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                                </button>

                                <div class="text-center mt-3" style="font-size:.875rem;color:#666">
                                    Sudah punya akun?
                                    <a href="{{ route('login') }}" class="auth-link ms-1">Masuk</a>
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
