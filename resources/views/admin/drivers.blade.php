@extends('layouts.app')

@section('title', 'Kelola Driver - Admin JAPLO')

@section('content')
<div class="hero-background" style="padding: 40px 0;">
    <div class="container hero-background-overlay">
        <h2 class="fw-bold text-white mb-2">
            <i class="fas fa-motorcycle me-2"></i> Kelola Driver
        </h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-white">Dashboard</a></li>
                <li class="breadcrumb-item active text-white">Driver</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="fw-bold mb-0">Daftar Driver</h5>
                </div>
                <div class="col-auto">
                    <span class="badge bg-success px-3 py-2">Total: {{ $drivers->total() }}</span>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4">ID</th>
                            <th>Nama</th>
                            <th>Kendaraan</th>
                            <th>Plat</th>
                            <th>Rating</th>
                            <th>Total Rides</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($drivers as $driver)
                        <tr>
                            <td class="px-4 fw-bold">#{{ $driver->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-circle fa-2x text-success me-2"></i>
                                    <div>
                                        <div class="fw-bold">{{ $driver->name }}</div>
                                        <small class="text-secondary">{{ $driver->phone }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($driver->driver)
                                    <span class="badge bg-primary">{{ ucfirst($driver->driver->vehicle_type) }}</span><br>
                                    <small class="text-secondary">{{ $driver->driver->vehicle_brand }}</small>
                                @else
                                    <span class="text-secondary">-</span>
                                @endif
                            </td>
                            <td>
                                @if($driver->driver)
                                    <span class="fw-bold">{{ $driver->driver->license_plate }}</span>
                                @else
                                    <span class="text-secondary">-</span>
                                @endif
                            </td>
                            <td>
                                @if($driver->driver)
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-star text-warning me-1"></i>
                                        <span class="fw-bold">{{ number_format($driver->driver->rating, 1) }}</span>
                                    </div>
                                @else
                                    <span class="text-secondary">-</span>
                                @endif
                            </td>
                            <td>
                                @if($driver->driver)
                                    <span class="badge bg-info">{{ $driver->driver->total_rides }} rides</span>
                                @else
                                    <span class="text-secondary">-</span>
                                @endif
                            </td>
                            <td>
                                @if($driver->driver && $driver->driver->is_available)
                                    <span class="badge bg-success">Available</span>
                                @else
                                    <span class="badge bg-secondary">Offline</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-success" onclick="alert('Detail driver #{{ $driver->id }}')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-secondary">
                                <i class="fas fa-motorcycle fa-3x mb-3 d-block"></i>
                                Belum ada driver terdaftar
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($drivers->hasPages())
        <div class="card-footer bg-white">
            {{ $drivers->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
