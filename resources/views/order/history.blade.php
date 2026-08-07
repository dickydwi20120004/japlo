@extends('layouts.app')

@section('title', 'Riwayat Pesanan - JAPLO')

@section('content')
<div class="hero-section" style="padding: 40px 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm mb-3" style="border-radius: 25px; padding: 8px 16px;">
            <i class="fas fa-arrow-left me-1"></i> Dashboard
        </a>
        <h2 class="fw-bold mb-2 text-white display-5">
            <i class="fas fa-history me-2"></i> Riwayat Pesanan
        </h2>
        <p class="mb-0 text-white fs-5">Lihat semua pesanan Anda di sini</p>
    </div>
</div>

<div class="container py-5">
    <!-- Filter Tabs -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
        <div class="card-body p-4">
            <div class="nav nav-pills" role="tablist">
                <button class="nav-link active" onclick="filterOrders('all')" style="border-radius: 20px; margin-right: 10px; margin-bottom: 10px;">
                    <i class="fas fa-list me-1"></i> Semua
                </button>
                <button class="nav-link" onclick="filterOrders('in_progress')" style="border-radius: 20px; margin-right: 10px; margin-bottom: 10px;">
                    <i class="fas fa-truck me-1"></i> Sedang Diproses
                </button>
                <button class="nav-link" onclick="filterOrders('completed')" style="border-radius: 20px; margin-right: 10px; margin-bottom: 10px;">
                    <i class="fas fa-check-circle me-1"></i> Selesai
                </button>
                <button class="nav-link" onclick="filterOrders('cancelled')" style="border-radius: 20px;">
                    <i class="fas fa-times-circle me-1"></i> Dibatalkan
                </button>
            </div>
        </div>
    </div>

    <!-- Orders List -->
    <div class="row">
        @forelse($orders as $order)
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm hover-order" style="border-radius: 20px; overflow: hidden; transition: all 0.3s; cursor: pointer;" onclick="goToTracking({{ $order->id }})">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <!-- Order Info -->
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="d-flex align-items-start gap-3">
                                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-shopping-bag text-white fa-2x"></i>
                                </div>
                                <div style="flex: 1;">
                                    <h6 class="fw-bold mb-1">{{ $order->order_number }}</h6>
                                    <p class="text-muted small mb-1">{{ $order->created_at->format('d M Y H:i') }}</p>
                                    <p class="small mb-0">
                                        {{ $order->items->count() }} item(s) • 
                                        <span class="fw-bold">Rp {{ number_format($order->price, 0, ',', '.') }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Status & Actions -->
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Status Badge -->
                                <div>
                                    @switch($order->status)
                                        @case('pending')
                                            <span class="badge bg-warning" style="border-radius: 20px; padding: 8px 12px;">
                                                <i class="fas fa-clock me-1"></i> Menunggu
                                            </span>
                                            @break
                                        @case('confirmed')
                                            <span class="badge bg-info" style="border-radius: 20px; padding: 8px 12px;">
                                                <i class="fas fa-check me-1"></i> Dikonfirmasi
                                            </span>
                                            @break
                                        @case('accepted')
                                        @case('picked_up')
                                        @case('in_progress')
                                            <span class="badge bg-primary" style="border-radius: 20px; padding: 8px 12px;">
                                                <i class="fas fa-truck me-1"></i> Dalam Perjalanan
                                            </span>
                                            @break
                                        @case('completed')
                                            <span class="badge bg-success" style="border-radius: 20px; padding: 8px 12px;">
                                                <i class="fas fa-check-circle me-1"></i> Selesai
                                            </span>
                                            @break
                                        @case('cancelled')
                                            <span class="badge bg-danger" style="border-radius: 20px; padding: 8px 12px;">
                                                <i class="fas fa-times-circle me-1"></i> Dibatalkan
                                            </span>
                                            @break
                                    @endswitch
                                </div>

                                <!-- Actions -->
                                <div class="d-flex gap-2">
                                    <a href="{{ route('order.track', $order->id) }}" class="btn btn-outline-primary btn-sm rounded-2" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button class="btn btn-outline-secondary btn-sm rounded-2" title="Ulang Pesanan" onclick="repeatOrder(event, {{ $order->id }})">
                                        <i class="fas fa-redo"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Items Preview -->
                    <div class="mt-3 pt-3 border-top">
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($order->items->take(3) as $item)
                            <small class="badge bg-light text-dark" style="border-radius: 15px; padding: 6px 10px;">
                                {{ $item->quantity }}x {{ $item->item_name }}
                            </small>
                            @endforeach
                            @if($order->items->count() > 3)
                            <small class="badge bg-light text-dark" style="border-radius: 15px; padding: 6px 10px;">
                                +{{ $order->items->count() - 3 }} lainnya
                            </small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-body p-5 text-center">
                    <i class="fas fa-inbox fa-4x text-secondary mb-3 d-block"></i>
                    <h5 class="fw-bold mb-2">Belum Ada Pesanan</h5>
                    <p class="text-muted mb-4">Anda belum memiliki riwayat pesanan. Mulai pesan sekarang!</p>
                    <a href="{{ route('customer.kuliner') }}" class="btn btn-primary btn-lg rounded-3 px-5">
                        <i class="fas fa-shopping-cart me-2"></i> Mulai Belanja
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($orders->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $orders->links() }}
    </div>
    @endif
</div>

<style>
    .hover-order {
        transition: all 0.3s ease;
    }

    .hover-order:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(102, 126, 234, 0.15) !important;
    }

    .nav-link {
        border-radius: 20px !important;
        padding: 8px 16px !important;
        color: #999 !important;
        transition: all 0.3s;
    }

    .nav-link.active {
        background-color: #667eea !important;
        color: white !important;
    }

    .nav-link:hover {
        background-color: rgba(102, 126, 234, 0.1);
        color: #667eea !important;
    }
</style>

<script>
function filterOrders(status) {
    // Update active button
    document.querySelectorAll('.nav-link').forEach(btn => btn.classList.remove('active'));
    event.target.closest('.nav-link')?.classList.add('active');

    // In real app, filter orders via AJAX
    // fetch(`?status=${status}`).then(...);
}

function goToTracking(orderId) {
    window.location.href = `/order/track/${orderId}`;
}

function repeatOrder(event, orderId) {
    event.stopPropagation();
    alert('Fitur ulangi pesanan akan menambahkan item yang sama ke keranjang baru.');
    // In real app: 
    // fetch(`/order/${orderId}/repeat`, {method: 'POST'})
}
</script>
@endsection
