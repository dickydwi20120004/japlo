@extends('layouts.app')

@section('title', 'Pembayaran Gagal - JAPLO')

@section('content')
<div class="container py-5" style="min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    <div class="col-lg-6">
        <!-- Failed Icon -->
        <div class="text-center mb-5">
            <div style="width: 120px; height: 120px; margin: 0 auto; background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(220, 53, 69, 0.3);">
                <i class="fas fa-times fa-4x text-white"></i>
            </div>
        </div>

        <!-- Failed Message -->
        <div class="card border-0 shadow-lg" style="border-radius: 20px;">
            <div class="card-body p-5">
                <h2 class="fw-bold text-center mb-2 text-danger">Pembayaran Gagal!</h2>
                <p class="text-center text-muted mb-4">Terjadi kesalahan saat memproses pembayaran Anda. Silakan coba lagi atau gunakan metode pembayaran lain.</p>

                <!-- Error Details -->
                <div class="alert alert-danger" style="border-radius: 15px;">
                    <h6 class="fw-bold mb-2">
                        <i class="fas fa-exclamation-circle me-2"></i> Alasan Kemungkinan:
                    </h6>
                    <ul class="mb-0 small">
                        <li>Saldo kartu kredit/debit tidak mencukupi</li>
                        <li>Kartu telah kadaluarsa atau tidak aktif</li>
                        <li>Data pembayaran tidak sesuai</li>
                        <li>Koneksi internet terputus saat transaksi</li>
                        <li>Batas transaksi harian telah tercapai</li>
                    </ul>
                </div>

                <!-- Order Details -->
                <div class="card bg-light border-0 mb-4" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">
                            <i class="fas fa-receipt text-danger me-2"></i> Detail Pesanan
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
                                <small class="text-muted d-block mb-1">Email</small>
                                <h6 class="fw-bold small">{{ $payment->customer_email }}</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Troubleshooting -->
                <div class="card border-0" style="border-radius: 15px; background: rgba(255, 193, 7, 0.1); border: 2px solid #ffc107; margin-bottom: 20px;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3">
                            <i class="fas fa-lightbulb text-warning me-2"></i> Saran:
                        </h6>
                        <ul class="small mb-0">
                            <li class="mb-2">Periksa saldo atau limit kartu/e-wallet Anda</li>
                            <li class="mb-2">Coba gunakan metode pembayaran yang berbeda</li>
                            <li class="mb-2">Hubungi bank Anda jika transaksi terus ditolak</li>
                            <li>Jika masalah berlanjut, hubungi customer service kami</li>
                        </ul>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-grid gap-2">
                    <a href="{{ route('payment.checkout') }}" class="btn btn-danger btn-lg fw-bold" style="border-radius: 12px; padding: 12px;">
                        <i class="fas fa-redo me-2"></i> Coba Pembayaran Lagi
                    </a>
                    <a href="{{ route('customer.kuliner') }}" class="btn btn-outline-secondary btn-lg fw-bold" style="border-radius: 12px; padding: 12px;">
                        <i class="fas fa-shopping-cart me-2"></i> Kembali ke Belanja
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=628123456789&text=Halo%20JAPLO,%20saya%20memiliki%20masalah%20dengan%20pembayaran" target="_blank" class="btn btn-outline-primary btn-lg fw-bold" style="border-radius: 12px; padding: 12px;">
                        <i class="fab fa-whatsapp me-2"></i> Hubungi WhatsApp Support
                    </a>
                </div>
            </div>
        </div>

        <!-- Support Contact -->
        <div class="text-center mt-4">
            <p class="text-muted small">
                <i class="fas fa-question-circle me-1"></i>
                Butuh bantuan? Hubungi kami:
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="tel:1500123" class="btn btn-sm btn-outline-primary rounded-pill">
                    <i class="fas fa-phone me-1"></i> 1500123
                </a>
                <a href="mailto:support@japlo.com" class="btn btn-sm btn-outline-primary rounded-pill">
                    <i class="fas fa-envelope me-1"></i> support@japlo.com
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }
</style>
@endsection
