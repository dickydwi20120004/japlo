@extends('layouts.app')

@section('title', 'Admin Dashboard - JAPLO')

@section('content')
<div class="hero-background" style="padding: 60px 0 40px;">
    <div class="container hero-background-overlay">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold text-white mb-2">
                    <i class="fas fa-shield-alt me-2"></i> Admin Dashboard
                </h2>
                <p class="text-white mb-0">Kelola sistem JAPLO</p>
            </div>
            <div class="col-md-4 text-md-end">
                <span class="badge bg-white text-primary px-4 py-2" style="font-size: 1rem;">
                    <i class="fas fa-user-shield me-2"></i> Administrator
                </span>
            </div>
        </div>
    </div>
</div>

<div class="container py-4">
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                                <i class="fas fa-users fa-2x text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-secondary mb-0 small">Total Penumpang</h6>
                            <h3 class="fw-bold mb-0">{{ number_format($totalUsers) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle bg-success bg-opacity-10 p-3">
                                <i class="fas fa-motorcycle fa-2x text-success"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-secondary mb-0 small">Total Driver</h6>
                            <h3 class="fw-bold mb-0">{{ number_format($totalDrivers) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle bg-info bg-opacity-10 p-3">
                                <i class="fas fa-shopping-cart fa-2x text-info"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-secondary mb-0 small">Total Orders</h6>
                            <h3 class="fw-bold mb-0">{{ number_format($totalOrders) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                                <i class="fas fa-money-bill-wave fa-2x text-warning"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-secondary mb-0 small">Total Revenue</h6>
                            <h3 class="fw-bold mb-0">Rp {{ number_format($totalRevenue) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-bolt me-2 text-warning"></i> Quick Actions
                    </h5>
                    <div class="row g-2">
                        <div class="col-md-3 col-6">
                            <a href="{{ route('admin.users') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-users me-2"></i> Kelola Penumpang
                            </a>
                        </div>
                        <div class="col-md-3 col-6">
                            <a href="{{ route('admin.drivers') }}" class="btn btn-outline-success w-100">
                                <i class="fas fa-motorcycle me-2"></i> Kelola Driver
                            </a>
                        </div>
                        <div class="col-md-3 col-6">
                            <a href="{{ route('admin.orders') }}" class="btn btn-outline-info w-100">
                                <i class="fas fa-shopping-cart me-2"></i> Kelola Orders
                            </a>
                        </div>
                        <div class="col-md-3 col-6">
                            <a href="#" class="btn btn-outline-warning w-100">
                                <i class="fas fa-cog me-2"></i> Pengaturan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-history me-2 text-primary"></i> Recent Orders
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4">Order ID</th>
                                    <th>Penumpang</th>
                                    <th>Driver</th>
                                    <th>Layanan</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders as $order)
                                <tr>
                                    <td class="px-4 fw-bold">#{{ $order->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-user-circle fa-2x text-secondary me-2"></i>
                                            <div>
                                                <div class="fw-bold">{{ $order->user->name }}</div>
                                                <small class="text-secondary">{{ $order->user->phone }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($order->driver)
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-user-circle fa-2x text-success me-2"></i>
                                                <div>
                                                    <div class="fw-bold">{{ $order->driver->user->name }}</div>
                                                    <small class="text-secondary">{{ $order->driver->vehicle_type }}</small>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-secondary">Belum ada</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ ucfirst($order->service_type) }}</span>
                                    </td>
                                    <td class="fw-bold">Rp {{ number_format($order->price) }}</td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'pending' => 'warning',
                                                'accepted' => 'info',
                                                'ongoing' => 'primary',
                                                'completed' => 'success',
                                                'cancelled' => 'danger',
                                            ];
                                        @endphp
                                        <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-secondary">{{ $order->created_at->diffForHumans() }}</small>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-secondary">
                                        <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                        Belum ada order
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($recentOrders->count() > 0)
                <div class="card-footer bg-white border-0">
                    <a href="{{ route('admin.orders') }}" class="btn btn-sm btn-outline-primary">
                        Lihat Semua Orders <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Users & Drivers -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-users me-2 text-primary"></i> Penumpang Terbaru
                    </h5>
                </div>
                <div class="card-body">
                    @forelse($recentUsers as $user)
                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                        <i class="fas fa-user-circle fa-3x text-secondary me-3"></i>
                        <div class="flex-grow-1">
                            <div class="fw-bold">{{ $user->name }}</div>
                            <small class="text-secondary">{{ $user->email }}</small><br>
                            <small class="text-secondary">{{ $user->phone }}</small>
                        </div>
                        <div class="text-end">
                            <small class="text-secondary d-block">{{ $user->created_at->format('d/m/Y') }}</small>
                            <small class="text-secondary">{{ $user->created_at->format('H:i') }}</small>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-secondary mb-0">Belum ada penumpang</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0">
                        <i class="fas fa-motorcycle me-2 text-success"></i> Driver Terbaru
                    </h5>
                </div>
                <div class="card-body">
                    @forelse($recentDrivers as $driver)
                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                        <i class="fas fa-user-circle fa-3x text-success me-3"></i>
                        <div class="flex-grow-1">
                            <div class="fw-bold">{{ $driver->name }}</div>
                            <small class="text-secondary">{{ $driver->email }}</small><br>
                            @if($driver->driver)
                                <small class="badge bg-success">{{ ucfirst($driver->driver->vehicle_type) }} - {{ $driver->driver->license_plate }}</small>
                            @endif
                        </div>
                        <div class="text-end">
                            <small class="text-secondary d-block">{{ $driver->created_at->format('d/m/Y') }}</small>
                            <small class="text-secondary">{{ $driver->created_at->format('H:i') }}</small>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-secondary mb-0">Belum ada driver</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
