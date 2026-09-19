@extends('layouts.app')

@section('title', 'Driver Dashboard — JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard-driver.css') }}">
@endpush

@section('content')

{{-- Driver Header --}}
<div class="jp-driver-header">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3">
                <div style="width:54px;height:54px;border-radius:50%;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;font-size:1.4rem;font-weight:700;color:#fff;flex-shrink:0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="driver-name">{{ auth()->user()->name }}</div>
                    <div class="driver-sub">
                        @if($driver)
                            {{ ucfirst($driver->vehicle_type) }} · {{ $driver->vehicle_brand ?? 'Kendaraan' }}
                        @else
                            Driver JAPLO
                        @endif
                    </div>
                </div>
            </div>
            {{-- Online / Offline toggle --}}
            @if($driver)
                <div class="status-toggle-wrap">
                    <span class="status-dot {{ $driver->is_available ? 'online' : 'offline' }}"></span>
                    <span style="font-size:.875rem;color:#fff;font-weight:600">
                        {{ $driver->is_available ? 'Online' : 'Offline' }}
                    </span>
                    <form method="POST" action="{{ route('api.orders.create') }}" id="toggleForm">
                        {{-- Menggunakan route sementara. Idealnya ada route khusus toggle --}}
                    </form>
                    <button type="button"
                            style="background:rgba(255,255,255,.15);border:1.5px solid rgba(255,255,255,.4);color:#fff;font-size:.8rem;font-weight:600;padding:.4rem 1rem;border-radius:20px;cursor:pointer"
                            onclick="JapToast.info('Fitur toggle status akan segera tersedia.')">
                        {{ $driver->is_available ? 'Set Offline' : 'Set Online' }}
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="jp-dash-body">
    <div class="container">

        {{-- Stats --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="jp-stat-card">
                    <div class="stat-icon icon-green"><i class="fas fa-motorcycle"></i></div>
                    <div>
                        <div class="stat-value">{{ $totalRides }}</div>
                        <div class="stat-label">Total Perjalanan</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="jp-stat-card">
                    <div class="stat-icon icon-amber"><i class="fas fa-coins"></i></div>
                    <div>
                        <div class="stat-value" style="font-size:1.1rem">Rp {{ number_format($totalEarnings, 0, ',', '.') }}</div>
                        <div class="stat-label">Total Penghasilan</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="jp-stat-card">
                    <div class="stat-icon icon-blue"><i class="fas fa-calendar-day"></i></div>
                    <div>
                        <div class="stat-value">{{ $todayOrders }}</div>
                        <div class="stat-label">Hari Ini</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="jp-stat-card">
                    <div class="stat-icon icon-amber"><i class="fas fa-star"></i></div>
                    <div>
                        <div class="stat-value">{{ number_format($rating, 1) }}</div>
                        <div class="stat-label">Rating</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">

            {{-- Pending orders nearby --}}
            <div class="col-lg-6">
                <div class="jp-card h-100">
                    <div class="jp-card-header">
                        <span>Order Tersedia</span>
                        @if($driver && $driver->is_available)
                            <span class="jp-badge jp-badge-accepted">Online</span>
                        @else
                            <span class="jp-badge jp-badge-cancelled">Offline</span>
                        @endif
                    </div>
                    <div class="jp-card-body">
                        @if($pendingOrders->count() > 0)
                            <div class="d-flex flex-column gap-2">
                                @foreach($pendingOrders as $order)
                                    <div class="pending-order-item">
                                        <div class="flex-grow-1">
                                            <div class="fw-600" style="font-size:.875rem">{{ Str::limit($order->destination_address, 30) }}</div>
                                            <div class="route-mini">
                                                <i class="fas fa-location-dot" style="color:var(--jp-green)"></i>
                                                {{ Str::limit($order->pickup_address, 28) }}
                                            </div>
                                            <div class="d-flex gap-3 mt-1">
                                                <span style="font-size:.75rem;color:var(--jp-gray-400)">
                                                    <i class="fas fa-road me-1"></i>{{ $order->distance }} km
                                                </span>
                                                <span style="font-size:.75rem;font-weight:600;color:var(--jp-green)">
                                                    Rp {{ number_format($order->price, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                        <button class="btn btn-jp-primary btn-sm" onclick="JapToast.info('Fitur terima order akan segera tersedia.')">
                                            Ambil
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="jp-empty" style="padding:2rem 1rem">
                                <div class="empty-icon"><i class="fas fa-inbox"></i></div>
                                <p>
                                    @if(!$driver || !$driver->is_available)
                                        Aktifkan status Online untuk melihat order
                                    @else
                                        Tidak ada order tersedia di sekitar kamu
                                    @endif
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Recent orders --}}
            <div class="col-lg-6">
                <div class="jp-card h-100">
                    <div class="jp-card-header">
                        <span>Perjalanan Terakhir</span>
                    </div>
                    <div class="jp-card-body p-0">
                        @if($recentOrders->count() > 0)
                            <div class="table-responsive">
                                <table class="jp-table">
                                    <thead>
                                        <tr>
                                            <th>No. Order</th>
                                            <th>Pengguna</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentOrders as $order)
                                            <tr>
                                                <td style="font-family:monospace;font-size:.8rem">{{ $order->order_number }}</td>
                                                <td>{{ $order->user->name ?? '—' }}</td>
                                                <td class="fw-600">Rp {{ number_format($order->price, 0, ',', '.') }}</td>
                                                <td>
                                                    <span class="jp-badge jp-badge-{{ strtolower($order->status) }}">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="jp-empty" style="padding:2rem 1rem">
                                <div class="empty-icon"><i class="fas fa-clock-rotate-left"></i></div>
                                <p>Belum ada riwayat perjalanan</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
