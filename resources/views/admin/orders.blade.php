@extends('layouts.app')

@section('title', 'Kelola Orders - Admin JAPLO')

@section('content')
<div class="hero-background" style="padding: 40px 0;">
    <div class="container hero-background-overlay">
        <h2 class="fw-bold text-white mb-2">
            <i class="fas fa-shopping-cart me-2"></i> Kelola Orders
        </h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-white">Dashboard</a></li>
                <li class="breadcrumb-item active text-white">Orders</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="fw-bold mb-0">Daftar Orders</h5>
                </div>
                <div class="col-auto">
                    <span class="badge bg-info px-3 py-2">Total: {{ $orders->total() }}</span>
                </div>
            </div>
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
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
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
                                <small class="text-secondary">{{ $order->created_at->format('d/m/Y H:i') }}</small><br>
                                <small class="text-secondary">{{ $order->created_at->diffForHumans() }}</small>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-info" onclick="alert('Detail order #{{ $order->id }}')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-secondary">
                                <i class="fas fa-shopping-cart fa-3x mb-3 d-block"></i>
                                Belum ada orders
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($orders->hasPages())
        <div class="card-footer bg-white">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
