@extends('layouts.app')

@section('title', 'Register - JAPLO')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Buat Akun Baru</h3>
                        <p class="text-secondary">Bergabung dengan JAPLO sekarang</p>
                    </div>

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('register.post') }}" method="POST" id="registerForm">
                        @csrf
                        
                        <!-- Role Selection -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Daftar sebagai:</label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="role" id="role_user" 
                                           value="user" {{ old('role', request('role', 'user')) == 'user' ? 'checked' : '' }}
                                           onchange="toggleDriverFields()">
                                    <label class="btn btn-outline-primary w-100 py-3" for="role_user">
                                        <i class="fas fa-user fa-2x mb-2 d-block"></i>
                                        Penumpang
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="role" id="role_driver" 
                                           value="driver" {{ old('role', request('role')) == 'driver' ? 'checked' : '' }}
                                           onchange="toggleDriverFields()">
                                    <label class="btn btn-outline-primary w-100 py-3" for="role_driver">
                                        <i class="fas fa-motorcycle fa-2x mb-2 d-block"></i>
                                        Driver
                                    </label>
                                </div>
                            </div>
                            @error('role')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" 
                                   placeholder="Masukkan nama lengkap" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" 
                                   placeholder="Masukkan email" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone') }}" 
                                   placeholder="08xxxxxxxxxx" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Driver-specific fields -->
                        <div id="driverFields" style="display: {{ old('role') == 'driver' ? 'block' : 'none' }};">
                            <hr class="my-4">
                            <h6 class="fw-bold mb-3 text-primary">
                                <i class="fas fa-motorcycle me-2"></i>Informasi Driver
                            </h6>

                            <div class="mb-3">
                                <label for="vehicle_type" class="form-label">Jenis Kendaraan <span class="text-danger">*</span></label>
                                <select class="form-select @error('vehicle_type') is-invalid @enderror" 
                                        id="vehicle_type" name="vehicle_type">
                                    <option value="">Pilih jenis kendaraan</option>
                                    <option value="motor" {{ old('vehicle_type') == 'motor' ? 'selected' : '' }}>Motor</option>
                                    <option value="mobil" {{ old('vehicle_type') == 'mobil' ? 'selected' : '' }}>Mobil</option>
                                </select>
                                @error('vehicle_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="vehicle_brand" class="form-label">Merk Kendaraan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('vehicle_brand') is-invalid @enderror" 
                                       id="vehicle_brand" name="vehicle_brand" value="{{ old('vehicle_brand') }}" 
                                       placeholder="Contoh: Honda, Toyota, Yamaha">
                                @error('vehicle_brand')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="license_plate" class="form-label">Nomor Plat Kendaraan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('license_plate') is-invalid @enderror" 
                                       id="license_plate" name="license_plate" value="{{ old('license_plate') }}" 
                                       placeholder="Contoh: B 1234 XYZ">
                                @error('license_plate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="license_number" class="form-label">Nomor SIM <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('license_number') is-invalid @enderror" 
                                       id="license_number" name="license_number" value="{{ old('license_number') }}" 
                                       placeholder="Nomor SIM Anda">
                                @error('license_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                          id="address" name="address" rows="3" 
                                          placeholder="Masukkan alamat lengkap">{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="mb-3">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" 
                                   placeholder="Minimal 8 karakter" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" 
                                   id="password_confirmation" name="password_confirmation" 
                                   placeholder="Ulangi password" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                            <i class="fas fa-user-plus me-2"></i> Daftar
                        </button>

                        <div class="text-center">
                            <p class="mb-0">Sudah punya akun? 
                                <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Masuk</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function toggleDriverFields() {
    const role = document.querySelector('input[name="role"]:checked').value;
    const driverFields = document.getElementById('driverFields');
    const driverInputs = driverFields.querySelectorAll('input, select, textarea');
    
    if (role === 'driver') {
        driverFields.style.display = 'block';
        // Make driver fields required
        driverInputs.forEach(input => {
            if (input.name !== 'address') { // address is optional for now
                input.required = true;
            }
        });
    } else {
        driverFields.style.display = 'none';
        // Remove required from driver fields
        driverInputs.forEach(input => {
            input.required = false;
        });
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleDriverFields();
});
</script>
@endpush
@endsection
