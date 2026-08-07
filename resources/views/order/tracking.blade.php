@extends('layouts.app')

@section('title', 'Tracking Pesanan - JAPLO')

@section('content')
<div class="hero-section" style="padding: 40px 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <a href="{{ route('order.history') }}" class="btn btn-light btn-sm mb-3" style="border-radius: 25px; padding: 8px 16px;">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <h2 class="fw-bold mb-2 text-white display-5">
            <i class="fas fa-box me-2"></i> Tracking Pesanan
        </h2>
        <p class="mb-0 text-white fs-5">{{ $order->order_number }}</p>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <!-- Tracking Map & Status -->
        <div class="col-lg-8 mb-4">
            <!-- Map Placeholder -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px; overflow: hidden;">
                <div style="height: 400px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                    <div class="text-center text-white">
                        <i class="fas fa-map fa-4x mb-3"></i>
                        <h5>Peta Tracking Real-time</h5>
                        <p class="small">Integrasi dengan Google Maps akan ditambahkan</p>
                    </div>
                </div>
            </div>

            <!-- Order Status Timeline -->
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-tasks text-primary me-2"></i> Status Pesanan
                    </h5>

                    <div class="timeline">
                        <!-- Step 1: Confirmed -->
                        <div class="timeline-item {{ in_array($order->status, ['confirmed', 'accepted', 'picked_up', 'in_progress', 'completed']) ? 'active' : '' }}">
                            <div class="timeline-marker completed">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="fw-bold mb-1">Pesanan Dikonfirmasi</h6>
                                <p class="text-muted small mb-0">{{ $order->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>

                        <!-- Step 2: Processing -->
                        <div class="timeline-item {{ in_array($order->status, ['accepted', 'picked_up', 'in_progress', 'completed']) ? 'active' : '' }}">
                            <div class="timeline-marker {{ in_array($order->status, ['accepted', 'picked_up', 'in_progress', 'completed']) ? 'completed' : ($order->status === 'confirmed' ? 'current' : '') }}">
                                <i class="fas fa-{{ in_array($order->status, ['accepted', 'picked_up', 'in_progress', 'completed']) ? 'check' : 'clock' }}"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="fw-bold mb-1">Sedang Diproses</h6>
                                <p class="text-muted small mb-0">Restoran menyiapkan pesanan Anda</p>
                            </div>
                        </div>

                        <!-- Step 3: Picked Up -->
                        <div class="timeline-item {{ in_array($order->status, ['picked_up', 'in_progress', 'completed']) ? 'active' : '' }}">
                            <div class="timeline-marker {{ in_array($order->status, ['picked_up', 'in_progress', 'completed']) ? 'completed' : ($order->status === 'accepted' ? 'current' : '') }}">
                                <i class="fas fa-{{ in_array($order->status, ['picked_up', 'in_progress', 'completed']) ? 'check' : 'clock' }}"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="fw-bold mb-1">Pesanan Diambil Driver</h6>
                                <p class="text-muted small mb-0">Driver dalam perjalanan ke lokasi Anda</p>
                            </div>
                        </div>

                        <!-- Step 4: In Transit -->
                        <div class="timeline-item {{ in_array($order->status, ['in_progress', 'completed']) ? 'active' : '' }}">
                            <div class="timeline-marker {{ in_array($order->status, ['in_progress', 'completed']) ? 'completed' : ($order->status === 'picked_up' ? 'current' : '') }}">
                                <i class="fas fa-{{ in_array($order->status, ['in_progress', 'completed']) ? 'check' : 'clock' }}"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="fw-bold mb-1">Dalam Perjalanan</h6>
                                <p class="text-muted small mb-0">Pesanan Anda sedang dalam perjalanan</p>
                            </div>
                        </div>

                        <!-- Step 5: Completed -->
                        <div class="timeline-item {{ $order->status === 'completed' ? 'active' : '' }}">
                            <div class="timeline-marker {{ $order->status === 'completed' ? 'completed' : ($order->status === 'in_progress' ? 'current' : '') }}">
                                <i class="fas fa-{{ $order->status === 'completed' ? 'check' : 'clock' }}"></i>
                            </div>
                            <div class="timeline-content">
                                <h6 class="fw-bold mb-1">Pesanan Diterima</h6>
                                <p class="text-muted small mb-0">{{ $order->completed_at ? $order->completed_at->format('d M Y H:i') : 'Menunggu pengiriman' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Details & Driver Info -->
        <div class="col-lg-4">
            <!-- Order Summary -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-receipt text-primary me-2"></i> Ringkasan Pesanan
                    </h5>

                    <div class="mb-4">
                        <small class="text-muted d-block mb-1">Nomor Pesanan</small>
                        <h6 class="fw-bold">{{ $order->order_number }}</h6>
                    </div>

                    <div class="mb-4">
                        <small class="text-muted d-block mb-1">Status</small>
                        <div>
                            <span class="badge bg-primary" style="border-radius: 20px; padding: 8px 12px; font-size: 12px;">
                                @switch($order->status)
                                    @case('pending')
                                        <i class="fas fa-clock me-1"></i> Menunggu Konfirmasi
                                        @break
                                    @case('confirmed')
                                        <i class="fas fa-check me-1"></i> Dikonfirmasi
                                        @break
                                    @case('accepted')
                                        <i class="fas fa-check-double me-1"></i> Diterima Driver
                                        @break
                                    @case('picked_up')
                                        <i class="fas fa-box me-1"></i> Diambil
                                        @break
                                    @case('in_progress')
                                        <i class="fas fa-truck me-1"></i> Dalam Perjalanan
                                        @break
                                    @case('completed')
                                        <i class="fas fa-check-circle me-1"></i> Selesai
                                        @break
                                @endswitch
                            </span>
                        </div>
                    </div>

                    <hr>

                    <!-- Order Items -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">
                            <i class="fas fa-shopping-bag me-2 text-success"></i> Items
                        </h6>
                        @forelse($order->items as $item)
                        <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                            <div>
                                <p class="small fw-bold mb-0">{{ $item->item_name }}</p>
                                <small class="text-muted">{{ $item->quantity }}x Rp {{ number_format($item->price, 0, ',', '.') }}</small>
                            </div>
                            <span class="fw-bold small">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                        @empty
                        <p class="text-muted small">Tidak ada item</p>
                        @endforelse
                    </div>

                    <hr>

                    <!-- Price Breakdown -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2 small">
                            <span>Subtotal</span>
                            <span class="fw-bold">Rp {{ number_format($order->price * 0.826, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 small">
                            <span>Ongkir</span>
                            <span class="fw-bold">Rp 10.000</span>
                        </div>
                        <div class="d-flex justify-content-between small">
                            <span>Pajak</span>
                            <span class="fw-bold">Rp {{ number_format($order->price * 0.09, 0, ',', '.') }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">Total</span>
                            <span class="fw-bold text-primary display-6">Rp {{ number_format($order->price, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Payment Status -->
                    <div class="alert alert-success" style="border-radius: 12px;">
                        <small>
                            <i class="fas fa-check-circle me-1"></i>
                            <strong>Pembayaran Berhasil</strong>
                            <br>
                            {{ $order->payment ? $order->payment->transaction_id : 'Transaction ID' }}
                        </small>
                    </div>
                </div>
            </div>

            <!-- Driver Info (if assigned) -->
            @if($order->driver)
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-user-circle text-primary me-2"></i> Info Driver
                    </h5>

                    <div class="text-center mb-4">
                        <img src="https://ui-avatars.com/api/?name={{ $order->driver->name }}&size=100&background=random" 
                             class="rounded-circle mb-3" style="width: 100px; height: 100px;">
                        <h6 class="fw-bold">{{ $order->driver->name }}</h6>
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <span class="small fw-bold">4.8 (245 ulasan)</span>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="tel:08123456789" class="btn btn-outline-primary btn-sm rounded-2">
                            <i class="fas fa-phone me-1"></i> Hubungi Driver
                        </a>
                        <a href="https://api.whatsapp.com/send?phone=628123456789" target="_blank" class="btn btn-outline-success btn-sm rounded-2">
                            <i class="fab fa-whatsapp me-1"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-info" style="border-radius: 15px;">
                <i class="fas fa-info-circle me-1"></i>
                Driver akan ditentukan segera setelah restoran mengkonfirmasi pesanan.
            </div>
            @endif

            <!-- Shipping Address -->
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-map-marker-alt text-danger me-2"></i> Alamat Pengiriman
                    </h5>
                    <p class="small mb-0">{{ $order->destination_address }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="row mt-5">
        <div class="col-lg-8">
            <div class="d-grid gap-2 d-md-flex">
                @if(in_array($order->status, ['pending', 'confirmed', 'accepted']))
                <button class="btn btn-outline-danger btn-lg fw-bold" style="border-radius: 12px;" onclick="cancelOrder()">
                    <i class="fas fa-times me-2"></i> Batalkan Pesanan
                </button>
                @endif
                <a href="{{ route('order.history') }}" class="btn btn-outline-secondary btn-lg fw-bold" style="border-radius: 12px;">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Riwayat
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .timeline {
        position: relative;
        padding: 20px 0;
    }

    .timeline-item {
        display: flex;
        gap: 20px;
        position: relative;
        margin-bottom: 30px;
    }

    .timeline-item:not(:last-child)::after {
        content: '';
        position: absolute;
        left: 19px;
        top: 60px;
        width: 2px;
        height: 40px;
        background-color: #e0e0e0;
    }

    .timeline-item.active:not(:last-child)::after {
        background-color: #667eea;
    }

    .timeline-marker {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #f0f0f0;
        border: 2px solid #e0e0e0;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #999;
        font-size: 18px;
    }

    .timeline-marker.completed {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
    }

    .timeline-marker.current {
        background-color: #667eea;
        border-color: #667eea;
        color: white;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7); }
        50% { box-shadow: 0 0 0 10px rgba(102, 126, 234, 0); }
    }

    .timeline-item.active .timeline-marker {
        background-color: #667eea;
        border-color: #667eea;
        color: white;
    }
</style>

<script>
function cancelOrder() {
    if (confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')) {
        alert('Pesanan dibatalkan.\n\nRefund akan diproses dalam 1-2 hari kerja.');
    }
}

// Auto-refresh tracking status every 5 seconds
setInterval(() => {
    // In real app, fetch updated status from server
    // fetch('{{ route("order.track", $order->id) }}')
}, 5000);
</script>
@endsection
