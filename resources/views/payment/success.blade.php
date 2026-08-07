@extends('layouts.app')

@section('title', 'Pembayaran Berhasil - JAPLO')

@section('content')
<div class="container py-5" style="min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    <div class="col-lg-6">
        <!-- Success Icon -->
        <div class="text-center mb-5">
            <div style="width: 120px; height: 120px; margin: 0 auto; background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(40, 167, 69, 0.3);">
                <i class="fas fa-check fa-4x text-white"></i>
            </div>
        </div>

        <!-- Success Message -->
        <div class="card border-0 shadow-lg" style="border-radius: 20px;">
            <div class="card-body p-5">
                <h2 class="fw-bold text-center mb-2">Pembayaran Berhasil!</h2>
                <p class="text-center text-muted mb-4">Terima kasih telah berbelanja di JAPLO. Pesanan Anda sedang diproses.</p>

                <!-- Order Details -->
                <div class="card bg-light border-0 mb-4" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">
                            <i class="fas fa-receipt text-primary me-2"></i> Detail Pesanan
                        </h5>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-1">Nomor Pesanan</small>
                                <h6 class="fw-bold">{{ $order->order_number }}</h6>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-1">Metode Pembayaran</small>
                                <h6 class="fw-bold">
                                    @switch($payment->payment_method)
                                        @case('credit_card')
                                            Kartu Kredit/Debit
                                            @break
                                        @case('bank_transfer')
                                            Transfer Bank
                                            @break
                                        @case('ewallet')
                                            E-Wallet
                                            @break
                                        @case('cod')
                                            Bayar di Tempat
                                            @break
                                    @endswitch
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-1">Nama Penerima</small>
                                <h6 class="fw-bold">{{ $payment->customer_name }}</h6>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-1">Alamat Pengiriman</small>
                                <h6 class="fw-bold small">
                                    {{ $payment->shipping_address }}, {{ $payment->city }}, {{ $payment->province }}
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-1">No. Telepon</small>
                                <h6 class="fw-bold">{{ $payment->customer_phone }}</h6>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-1">Email Konfirmasi</small>
                                <h6 class="fw-bold small">{{ $payment->customer_email }}</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="alert alert-info" style="border-radius: 15px;">
                    <h6 class="fw-bold mb-2">
                        <i class="fas fa-info-circle me-2"></i> Langkah Selanjutnya:
                    </h6>
                    <ul class="mb-0 small">
                        <li>Konfirmasi pesanan akan dikirim ke email Anda</li>
                        <li>Barang akan diproses dalam 1-2 jam</li>
                        <li>Anda akan menerima update pengiriman real-time</li>
                        <li>Pantau status pesanan melalui "Riwayat Pesanan"</li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="d-grid gap-2">
                    <a href="{{ route('order.history') }}" class="btn btn-primary btn-lg fw-bold" style="border-radius: 12px; padding: 12px;">
                        <i class="fas fa-box me-2"></i> Lihat Status Pesanan
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-lg fw-bold" style="border-radius: 12px; padding: 12px;">
                        <i class="fas fa-home me-2"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>

        <!-- Security Badge -->
        <div class="text-center mt-4">
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <div class="text-center">
                    <i class="fas fa-shield-alt text-success fa-2x mb-2"></i>
                    <p class="small text-muted mb-0">Pembayaran Aman</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-lock text-success fa-2x mb-2"></i>
                    <p class="small text-muted mb-0">Terenkripsi 256-bit</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-check-double text-success fa-2x mb-2"></i>
                    <p class="small text-muted mb-0">Terjamin</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }
</style>

<script>
// Auto-redirect to order history after 5 seconds
setTimeout(() => {
    // Only show notification, don't auto-redirect
    // window.location.href = '{{ route("order.history") }}';
}, 5000);
</script>
@endsection
