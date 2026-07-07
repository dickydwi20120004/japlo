@extends('layouts.app')

@section('title', 'Dashboard Customer - JAPLO')

@section('content')
<div class="hero-section" style="padding: 40px 0;">
    <div class="container">
        <h2 class="fw-bold mb-2">Halo, {{ auth()->user()->name }}! 👋</h2>
        <p class="mb-0">Mau kemana hari ini?</p>
    </div>
</div>

<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Statistics -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                        <i class="fas fa-receipt fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">{{ $totalOrders }}</h3>
                        <p class="text-secondary mb-0">Total Pesanan</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                        <i class="fas fa-check-circle fa-2x text-success"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">{{ $completedOrders }}</h3>
                        <p class="text-secondary mb-0">Perjalanan Selesai</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Order -->
    @if($activeOrder)
        <div class="card mb-4" style="border-left: 4px solid var(--primary-color);">
            <div class="card-body">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-motorcycle me-2 text-primary"></i>
                    Pesanan Aktif
                </h5>
                <div class="row">
                    <div class="col-md-8">
                        <p class="mb-2"><strong>Nomor Pesanan:</strong> {{ $activeOrder->order_number }}</p>
                        <p class="mb-2"><strong>Dari:</strong> {{ $activeOrder->pickup_address }}</p>
                        <p class="mb-2"><strong>Ke:</strong> {{ $activeOrder->destination_address }}</p>
                        <p class="mb-2"><strong>Harga:</strong> Rp {{ number_format($activeOrder->price, 0, ',', '.') }}</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <span class="badge badge-{{ strtolower($activeOrder->status) }} mb-2">
                            {{ ucfirst($activeOrder->status) }}
                        </span>
                        <br>
                        @if($activeOrder->driver)
                            <small class="text-secondary">Driver: {{ $activeOrder->driver->name }}</small>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);">
                <div class="card-body text-center text-white py-4">
                    <h5 class="fw-bold mb-3">Pesan Ojek Sekarang</h5>
                    <button class="btn btn-light btn-lg px-5" onclick="alert('Fitur booking akan segera hadir! Silakan gunakan API endpoint untuk testing.')">
                        <i class="fas fa-motorcycle me-2"></i> Mulai Pesan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="card">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Riwayat Pesanan Terakhir</h5>
            
            @if($recentOrders->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No. Pesanan</th>
                                <th>Tujuan</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                                <tr>
                                    <td><strong>{{ $order->order_number }}</strong></td>
                                    <td>{{ Str::limit($order->destination_address, 40) }}</td>
                                    <td>Rp {{ number_format($order->price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge badge-{{ strtolower($order->status) }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-secondary mb-3"></i>
                    <p class="text-secondary">Belum ada pesanan</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
