@extends('layouts.app')

@section('title', 'Dashboard Driver - JAPLO')

@section('content')
<div class="hero-section" style="padding: 40px 0;">
    <div class="container">
        <h2 class="fw-bold mb-2">Dashboard Driver</h2>
        <p class="mb-0">Selamat datang, {{ auth()->user()->name }}! 🏍️</p>
    </div>
</div>

<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Driver Profile Card -->
    @if($driver)
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-id-card me-2 text-primary"></i>
                        Profil Driver
                    </h5>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <strong>Nama:</strong> {{ auth()->user()->name }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Email:</strong> {{ auth()->user()->email }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Telepon:</strong> {{ auth()->user()->phone }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Kendaraan:</strong> {{ ucfirst($driver->vehicle_type) }} - {{ $driver->vehicle_brand }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Plat:</strong> {{ $driver->license_plate }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>SIM:</strong> {{ $driver->license_number }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <div class="mb-3">
                        <h3 class="mb-0 text-warning">⭐ {{ number_format($driver->rating, 1) }}</h3>
                        <small class="text-secondary">Rating</small>
                    </div>
                    <div class="form-check form-switch d-inline-block">
                        <input class="form-check-input" type="checkbox" id="availabilitySwitch" 
                               {{ $driver->is_available ? 'checked' : '' }}
                               onchange="toggleAvailability()">
                        <label class="form-check-label" for="availabilitySwitch">
                            <span id="statusText">{{ $driver->is_available ? 'Tersedia' : 'Tidak Tersedia' }}</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Statistics -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-inline-block mb-3">
                        <i class="fas fa-route fa-2x text-primary"></i>
                    </div>
                    <h3 class="fw-bold mb-0">{{ $totalRides }}</h3>
                    <p class="text-secondary mb-0">Total Perjalanan</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 d-inline-block mb-3">
                        <i class="fas fa-money-bill-wave fa-2x text-success"></i>
                    </div>
                    <h3 class="fw-bold mb-0">Rp {{ number_format($totalEarnings, 0, ',', '.') }}</h3>
                    <p class="text-secondary mb-0">Total Pendapatan</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 d-inline-block mb-3">
                        <i class="fas fa-calendar-day fa-2x text-info"></i>
                    </div>
                    <h3 class="fw-bold mb-0">{{ $todayOrders }}</h3>
                    <p class="text-secondary mb-0">Perjalanan Hari Ini</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 d-inline-block mb-3">
                        <i class="fas fa-wallet fa-2x text-warning"></i>
                    </div>
                    <h3 class="fw-bold mb-0">Rp {{ number_format($todayEarnings, 0, ',', '.') }}</h3>
                    <p class="text-secondary mb-0">Pendapatan Hari Ini</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Orders -->
    @if($driver && $driver->is_available && $pendingOrders->count() > 0)
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">
                <i class="fas fa-bell me-2 text-warning"></i>
                Pesanan Menunggu ({{ $pendingOrders->count() }})
            </h5>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Penumpang</th>
                            <th>Dari</th>
                            <th>Ke</th>
                            <th>Jarak</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingOrders as $order)
                        <tr>
                            <td>
                                <strong>{{ $order->user->name }}</strong><br>
                                <small class="text-secondary">{{ $order->user->phone }}</small>
                            </td>
                            <td>{{ Str::limit($order->pickup_address, 30) }}</td>
                            <td>{{ Str::limit($order->destination_address, 30) }}</td>
                            <td>{{ number_format($order->distance ?? 0, 1) }} km</td>
                            <td class="fw-bold text-success">Rp {{ number_format($order->price, 0, ',', '.') }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="alert('Fitur terima pesanan akan segera hadir!')">
                                    <i class="fas fa-check me-1"></i> Terima
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @elseif($driver && $driver->is_available)
    <div class="card mb-4 text-center py-5">
        <div class="card-body">
            <i class="fas fa-search fa-3x text-secondary mb-3"></i>
            <h5 class="text-secondary">Menunggu Pesanan...</h5>
            <p class="text-secondary mb-0">Anda sudah online. Pesanan akan muncul di sini.</p>
        </div>
    </div>
    @elseif($driver && !$driver->is_available)
    <div class="card mb-4 text-center py-5" style="background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);">
        <div class="card-body">
            <i class="fas fa-toggle-off fa-3x text-secondary mb-3"></i>
            <h5 class="text-secondary">Status: Tidak Tersedia</h5>
            <p class="text-secondary mb-3">Aktifkan status Anda untuk menerima pesanan</p>
            <button class="btn btn-primary btn-lg" onclick="document.getElementById('availabilitySwitch').click()">
                <i class="fas fa-power-off me-2"></i>
                Aktifkan Sekarang
            </button>
        </div>
    </div>
    @endif

    <!-- Recent Orders -->
    <div class="card">
        <div class="card-body">
            <h5 class="fw-bold mb-3">
                <i class="fas fa-history me-2 text-primary"></i>
                Riwayat Pesanan
            </h5>
            
            @if($recentOrders->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Penumpang</th>
                                <th>Tujuan</th>
                                <th>Harga</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                                <tr>
                                    <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ Str::limit($order->destination_address, 40) }}</td>
                                    <td class="fw-bold">Rp {{ number_format($order->price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge badge-{{ strtolower($order->status) }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-secondary mb-3"></i>
                    <p class="text-secondary">Belum ada riwayat pesanan</p>
                    <p class="text-secondary mb-0">Pesanan yang Anda terima akan muncul di sini</p>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
function toggleAvailability() {
    const isChecked = document.getElementById('availabilitySwitch').checked;
    const statusText = document.getElementById('statusText');
    
    // Update UI immediately
    statusText.textContent = isChecked ? 'Tersedia' : 'Tidak Tersedia';
    
    // TODO: Send AJAX request to update availability
    // For now, just show alert
    if (isChecked) {
        alert('Status diubah menjadi TERSEDIA. Anda akan menerima notifikasi pesanan baru.');
    } else {
        alert('Status diubah menjadi TIDAK TERSEDIA. Anda tidak akan menerima pesanan baru.');
    }
    
    // Refresh page to show/hide pending orders
    setTimeout(() => {
        window.location.reload();
    }, 1000);
}
</script>
@endpush
@endsection
