@extends('layouts.app')

@section('title', 'Riwayat Pesanan - JAPLO')

@section('content')
<!-- Hero Section -->
<div class="hero-section" style="padding: 40px 0; background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm mb-3">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
        <h2 class="fw-bold mb-2 text-white" style="font-size: 2.5rem;">📋 Riwayat Pesanan</h2>
        <p class="mb-0 text-white" style="font-size: 1.1rem;">Lihat semua pesanan dan detail perjalanan Anda</p>
    </div>
</div>

<div class="container py-4">
    <!-- Statistics Row -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-0" style="border-left: 4px solid var(--primary-color);">
                <div class="card-body text-center p-4">
                    <h3 class="fw-bold text-primary mb-0">{{ $totalOrders }}</h3>
                    <small class="text-secondary">Total Pesanan</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-0" style="border-left: 4px solid #4CAF50;">
                <div class="card-body text-center p-4">
                    <h3 class="fw-bold text-success mb-0">{{ $completedOrders }}</h3>
                    <small class="text-secondary">Selesai</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-0" style="border-left: 4px solid #FF6B35;">
                <div class="card-body text-center p-4">
                    <h3 class="fw-bold text-danger mb-0">{{ $cancelledOrders }}</h3>
                    <small class="text-secondary">Dibatalkan</small>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-0" style="border-left: 4px solid #FFC107;">
                <div class="card-body text-center p-4">
                    <h3 class="fw-bold text-warning mb-0">Rp {{ number_format($totalSpent, 0, ',', '.') }}</h3>
                    <small class="text-secondary">Total Pengeluaran</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Buttons -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body p-3">
            <div class="d-flex flex-wrap gap-2 align-items-center">
                <small class="text-secondary fw-bold">Filter:</small>
                <a href="{{ route('order.history') }}" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-list me-1"></i> Semua
                </a>
                <a href="{{ route('order.history') }}?status=completed" class="btn btn-sm btn-outline-success">
                    <i class="fas fa-check-circle me-1"></i> Selesai
                </a>
                <a href="{{ route('order.history') }}?status=cancelled" class="btn btn-sm btn-outline-danger">
                    <i class="fas fa-times-circle me-1"></i> Dibatalkan
                </a>
            </div>
        </div>
    </div>

    <!-- Orders Table/List -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            @if($orders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background: #f8f9fa; border-bottom: 2px solid #e9ecef;">
                            <tr>
                                <th class="fw-bold text-secondary">No. Pesanan</th>
                                <th class="fw-bold text-secondary">Rute</th>
                                <th class="fw-bold text-secondary">Driver</th>
                                <th class="fw-bold text-secondary">Harga</th>
                                <th class="fw-bold text-secondary">Status</th>
                                <th class="fw-bold text-secondary">Tanggal</th>
                                <th class="fw-bold text-secondary">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr style="border-bottom: 1px solid #e9ecef;">
                                    <td>
                                        <strong class="text-primary">{{ $order->order_number }}</strong>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div>
                                                <small class="text-secondary">📍 {{ Str::limit($order->pickup_address, 30) }}</small>
                                                <br>
                                                <small class="text-secondary">🎯 {{ Str::limit($order->destination_address, 30) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($order->driver)
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="rounded-circle bg-light p-2" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-user text-secondary" style="font-size: 0.8rem;"></i>
                                                </div>
                                                <div>
                                                    <p class="mb-0 fw-500 small">{{ $order->driver->name }}</p>
                                                    <small class="text-secondary">⭐ {{ $order->driver->rating ?? 'N/A' }}</small>
                                                </div>
                                            </div>
                                        @else
                                            <span class="badge bg-secondary">Belum ada driver</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong class="text-primary">Rp {{ number_format($order->price, 0, ',', '.') }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ strtolower($order->status) }}">
                                            @switch($order->status)
                                                @case('pending')
                                                    <i class="fas fa-hourglass-half me-1"></i> Menunggu
                                                    @break
                                                @case('accepted')
                                                    <i class="fas fa-check me-1"></i> Diterima
                                                    @break
                                                @case('picked_up')
                                                    <i class="fas fa-location-arrow me-1"></i> Diambil
                                                    @break
                                                @case('in_progress')
                                                    <i class="fas fa-motorcycle me-1"></i> Berlangsung
                                                    @break
                                                @case('completed')
                                                    <i class="fas fa-check-circle me-1"></i> Selesai
                                                    @break
                                                @case('cancelled')
                                                    <i class="fas fa-times-circle me-1"></i> Dibatalkan
                                                    @break
                                                @default
                                                    {{ ucfirst($order->status) }}
                                            @endswitch
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-secondary d-block">{{ $order->created_at->format('d M Y') }}</small>
                                        <small class="text-secondary">{{ $order->created_at->format('H:i') }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            @if(in_array($order->status, ['in_progress', 'picked_up', 'accepted', 'pending']))
                                                <a href="{{ route('order.track', $order->id) }}" class="btn btn-info" title="Lihat Tracking">
                                                    <i class="fas fa-map-location-dot"></i> Tracking
                                                </a>
                                            @endif
                                            <button type="button" class="btn btn-outline-secondary" title="Lihat Detail" onclick="viewOrderDetail({{ $order->id }})">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center p-3">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-5x text-secondary mb-3" style="opacity: 0.3;"></i>
                    <h5 class="text-secondary fw-bold">Belum ada pesanan</h5>
                    <p class="text-secondary mb-4">Mulai perjalanan Anda dengan memilih layanan</p>
                    <a href="{{ route('customer.ojek') }}" class="btn btn-primary">
                        <i class="fas fa-motorcycle me-2"></i> Pesan Ojek Sekarang
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Order Detail Modal -->
<div class="modal fade" id="orderDetailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-receipt me-2"></i> Detail Pesanan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="orderDetailContent">
                <!-- Content akan diisi via JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a id="trackingLink" href="#" class="btn btn-primary">
                    <i class="fas fa-map-location-dot me-2"></i> Lihat Tracking
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .badge-pending {
        background: #FFC107;
        color: #333;
    }
    
    .badge-accepted {
        background: #17A2B8;
        color: white;
    }
    
    .badge-picked_up {
        background: #20C997;
        color: white;
    }
    
    .badge-in_progress {
        background: #FF6B35;
        color: white;
    }
    
    .badge-completed {
        background: #4CAF50;
        color: white;
    }
    
    .badge-cancelled {
        background: #E74C3C;
        color: white;
    }

    .table-hover tbody tr:hover {
        background: #f8f9fa;
    }

    @media (max-width: 768px) {
        .table-responsive table {
            font-size: 0.85rem;
        }
        
        .btn-group-sm > .btn {
            padding: 0.3rem 0.5rem;
            font-size: 0.75rem;
        }
    }
</style>

<script>
    function viewOrderDetail(orderId) {
        // In production, ini akan fetch dari API
        // Untuk sekarang, kita hanya redirect ke tracking jika status in progress
        const modal = new bootstrap.Modal(document.getElementById('orderDetailModal'));
        
        // Fetch order detail dari server
        fetch(`/order/${orderId}`)
            .then(response => response.json())
            .catch(() => {
                Toast.error('Tidak dapat memuat detail pesanan');
            });
        
        modal.show();
    }

    // Batch actions
    function rateOrder(orderId) {
        Toast.info('Fitur rating akan segera tersedia');
    }

    function shareTrip(orderId) {
        Toast.info('Bagikan perjalanan akan segera tersedia');
    }
</script>
@endsection
