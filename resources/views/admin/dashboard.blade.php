@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<div style="padding: 40px 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <h2 class="fw-bold text-white mb-0">
            <i class="fas fa-tachometer-alt me-2"></i> Admin Dashboard
        </h2>
    </div>
</div>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="fw-bold">{{ $totalUsers }}</h3>
                    <p class="text-muted small">Total Pengguna</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="fw-bold">{{ $totalDrivers }}</h3>
                    <p class="text-muted small">Total Driver</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="fw-bold">{{ $totalOrders }}</h3>
                    <p class="text-muted small">Total Pesanan</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="fw-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                    <p class="text-muted small">Revenue</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body">
                    <i class="fas fa-users fa-3x text-primary mb-2"></i>
                    <h5 class="fw-bold">Pengguna</h5>
                    <a href="{{ route('admin.users') }}" class="btn btn-sm btn-primary">Kelola</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body">
                    <i class="fas fa-car fa-3x text-success mb-2"></i>
                    <h5 class="fw-bold">Driver</h5>
                    <a href="{{ route('admin.drivers') }}" class="btn btn-sm btn-success">Kelola</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body">
                    <i class="fas fa-shopping-cart fa-3x text-warning mb-2"></i>
                    <h5 class="fw-bold">Pesanan</h5>
                    <a href="{{ route('admin.orders') }}" class="btn btn-sm btn-warning">Kelola</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
