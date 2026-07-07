@extends('layouts.app')

@section('title', 'Profil - JAPLO')

@section('content')
<div class="hero-section" style="padding: 40px 0;">
    <div class="container">
        <h2 class="fw-bold mb-2">Profil Saya</h2>
        <p class="mb-0">Kelola informasi profil Anda</p>
    </div>
</div>

<div class="container py-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-user-circle me-2 text-primary"></i>
                        Informasi Pribadi
                    </h5>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nomor Telepon</label>
                        <input type="tel" class="form-control" value="{{ $user->phone }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Role</label>
                        <input type="text" class="form-control" value="{{ $user->role == 'driver' ? 'Driver' : 'Penumpang' }}" readonly>
                    </div>

                    @if($user->isDriver() && $user->driver)
                    <hr class="my-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-motorcycle me-2 text-primary"></i>
                        Informasi Driver
                    </h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jenis Kendaraan</label>
                            <input type="text" class="form-control" value="{{ ucfirst($user->driver->vehicle_type) }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Merk Kendaraan</label>
                            <input type="text" class="form-control" value="{{ $user->driver->vehicle_brand }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nomor Plat</label>
                            <input type="text" class="form-control" value="{{ $user->driver->license_plate }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nomor SIM</label>
                            <input type="text" class="form-control" value="{{ $user->driver->license_number }}" readonly>
                        </div>
                        @if($user->driver->address)
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Alamat</label>
                            <textarea class="form-control" rows="3" readonly>{{ $user->driver->address }}</textarea>
                        </div>
                        @endif
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Rating</label>
                            <input type="text" class="form-control" value="⭐ {{ number_format($user->driver->rating, 1) }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Total Perjalanan</label>
                            <input type="text" class="form-control" value="{{ $user->driver->total_rides }} perjalanan" readonly>
                        </div>
                    </div>
                    @endif

                    <hr class="my-4">

                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary" onclick="alert('Fitur edit profil akan segera hadir!')">
                            <i class="fas fa-edit me-2"></i> Edit Profil
                        </button>
                        <button class="btn btn-outline-danger" onclick="alert('Fitur ganti password akan segera hadir!')">
                            <i class="fas fa-key me-2"></i> Ganti Password
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
