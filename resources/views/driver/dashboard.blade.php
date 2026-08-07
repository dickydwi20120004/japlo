@extends('layouts.app')
@section('title', 'Driver Dashboard')
@section('content')
<div style="padding: 40px 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <h2 class="fw-bold text-white mb-0">
            <i class="fas fa-car me-2"></i> Driver Dashboard
        </h2>
    </div>
</div>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="fw-bold">{{ $totalRides }}</h3>
                    <p class="text-muted small">Total Perjalanan</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="fw-bold">Rp {{ number_format($totalEarnings, 0, ',', '.') }}</h3>
                    <p class="text-muted small">Total Penghasilan</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="fw-bold">{{ $todayOrders }}</h3>
                    <p class="text-muted small">Perjalanan Hari Ini</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="fw-bold">{{ $rating ?? 0 }}</h3>
                    <p class="text-muted small">Rating</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Pesanan Terbaru</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead style="background: #f8f9fa;">
                        <tr>
                            <th>Order</th>
                            <th>Pengguna</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                        <tr>
                            <td><strong>{{ $order->order_number }}</strong></td>
                            <td>{{ $order->user->name ?? '-' }}</td>
                            <td>Rp {{ number_format($order->price, 0, ',', '.') }}</td>
                            <td><span class="badge bg-info">{{ $order->status }}</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Tidak ada pesanan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
