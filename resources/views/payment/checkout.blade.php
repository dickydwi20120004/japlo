@extends('layouts.app')

@section('title', 'Pembayaran - JAPLO')

@section('content')
<div class="hero-section" style="padding: 40px 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <a href="javascript:history.back()" class="btn btn-light btn-sm mb-3" style="border-radius: 25px; padding: 8px 16px;">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <h2 class="fw-bold mb-2 text-white display-5">
            <i class="fas fa-credit-card me-2"></i> Pembayaran
        </h2>
        <p class="mb-0 text-white fs-5">Selesaikan pembayaran Anda dengan aman</p>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <!-- Payment Form -->
        <div class="col-lg-8 mb-4">
            <form id="paymentForm" method="POST" action="{{ route('payment.process') }}">
                @csrf
                <input type="hidden" name="orderId" value="{{ $orderId }}">

                <!-- Payment Method Selection -->
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">
                            <i class="fas fa-wallet text-primary me-2"></i> Pilih Metode Pembayaran
                        </h5>

                        <div class="row g-3">
                            <!-- Credit Card -->
                            <div class="col-12 col-md-6">
                                <label class="card border-0" style="cursor: pointer; border-radius: 15px; padding: 20px; transition: all 0.3s; border: 2px solid #ddd;">
                                    <input type="radio" name="paymentMethod" value="credit_card" class="payment-method" checked>
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="fas fa-credit-card fa-2x text-primary"></i>
                                        <div>
                                            <h6 class="fw-bold mb-1">Kartu Kredit/Debit</h6>
                                            <small class="text-muted">Visa, Mastercard, AmEx</small>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- Bank Transfer -->
                            <div class="col-12 col-md-6">
                                <label class="card border-0" style="cursor: pointer; border-radius: 15px; padding: 20px; transition: all 0.3s; border: 2px solid #ddd;">
                                    <input type="radio" name="paymentMethod" value="bank_transfer" class="payment-method">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="fas fa-university fa-2x text-success"></i>
                                        <div>
                                            <h6 class="fw-bold mb-1">Transfer Bank</h6>
                                            <small class="text-muted">Semua bank lokal</small>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- E-Wallet -->
                            <div class="col-12 col-md-6">
                                <label class="card border-0" style="cursor: pointer; border-radius: 15px; padding: 20px; transition: all 0.3s; border: 2px solid #ddd;">
                                    <input type="radio" name="paymentMethod" value="ewallet" class="payment-method">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="fas fa-mobile-alt fa-2x text-warning"></i>
                                        <div>
                                            <h6 class="fw-bold mb-1">E-Wallet</h6>
                                            <small class="text-muted">GoPay, OVO, DANA, etc</small>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- Cash on Delivery -->
                            <div class="col-12 col-md-6">
                                <label class="card border-0" style="cursor: pointer; border-radius: 15px; padding: 20px; transition: all 0.3s; border: 2px solid #ddd;">
                                    <input type="radio" name="paymentMethod" value="cod" class="payment-method">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="fas fa-money-bill fa-2x text-danger"></i>
                                        <div>
                                            <h6 class="fw-bold mb-1">Bayar di Tempat (COD)</h6>
                                            <small class="text-muted">Bayar saat barang tiba</small>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Information -->
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i> Alamat Pengiriman
                        </h5>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nama Depan</label>
                                <input type="text" class="form-control form-control-lg" name="firstName" placeholder="Masukkan nama depan" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nama Belakang</label>
                                <input type="text" class="form-control form-control-lg" name="lastName" placeholder="Masukkan nama belakang" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control form-control-lg" name="email" value="{{ auth()->user()->email }}" placeholder="Email Anda" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nomor Telepon</label>
                                <input type="tel" class="form-control form-control-lg" name="phone" placeholder="08xx xxxx xxxx" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold">Alamat Lengkap</label>
                                <textarea class="form-control" rows="3" name="address" placeholder="Jalan, nomor, blok, unit" required></textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Kota/Kabupaten</label>
                                <input type="text" class="form-control form-control-lg" name="city" placeholder="Masukkan kota" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Provinsi</label>
                                <input type="text" class="form-control form-control-lg" name="province" placeholder="Masukkan provinsi" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Kode Pos</label>
                                <input type="text" class="form-control form-control-lg" name="postalCode" placeholder="Kode pos" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Notice -->
                <div class="alert alert-info" style="border-radius: 15px;">
                    <i class="fas fa-shield-alt me-2"></i>
                    <strong>Keamanan Terjamin</strong>
                    <p class="mb-0 small mt-2">Semua transaksi dienkripsi dengan standar keamanan internasional SSL 256-bit. Data Anda aman bersama kami.</p>
                </div>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm sticky-top" style="border-radius: 20px; top: 20px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-receipt text-primary me-2"></i> Ringkasan Pesanan
                    </h5>

                    <!-- Cart Items -->
                    <div style="max-height: 300px; overflow-y: auto; margin-bottom: 20px;">
                        @foreach($cart as $item)
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                            <div>
                                <h6 class="fw-bold small mb-1">{{ $item['name'] }}</h6>
                                <small class="text-muted">{{ $item['quantity'] }}x Rp {{ number_format($item['price'], 0, ',', '.') }}</small>
                            </div>
                            <div class="text-end">
                                <h6 class="fw-bold small text-danger">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</h6>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <hr>

                    <!-- Pricing Breakdown -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span class="fw-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Ongkir</span>
                            <span class="fw-bold text-success">Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Pajak (10%)</span>
                            <span class="fw-bold">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                        </div>

                        <div class="p-3 rounded" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <div class="d-flex justify-content-between text-white">
                                <span class="fw-bold">Total Pembayaran</span>
                                <span class="fw-bold display-6">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Button -->
                    <button type="submit" form="paymentForm" class="btn btn-primary btn-lg w-100 fw-bold" style="border-radius: 12px; padding: 15px;">
                        <i class="fas fa-lock me-2"></i> Lanjutkan Pembayaran
                    </button>

                    <!-- Info Text -->
                    <p class="text-center text-muted small mt-3 mb-0">
                        <i class="fas fa-info-circle me-1"></i>
                        Dengan mengklik tombol di atas, Anda setuju dengan syarat & ketentuan kami
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .payment-method:checked + .card {
        border-color: #667eea !important;
        background-color: rgba(102, 126, 234, 0.05) !important;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15) !important;
    }

    .card label {
        margin-bottom: 0;
    }

    .card input[type="radio"] {
        margin-right: 10px;
        cursor: pointer;
    }
</style>

<script>
// Handle payment method selection styling
document.querySelectorAll('.payment-method').forEach(radio => {
    radio.addEventListener('change', function() {
        document.querySelectorAll('.payment-method + .card').forEach(card => {
            card.style.borderColor = '#ddd';
            card.style.backgroundColor = '';
            card.style.boxShadow = '';
        });
        this.parentElement.style.borderColor = '#667eea';
        this.parentElement.style.backgroundColor = 'rgba(102, 126, 234, 0.05)';
        this.parentElement.style.boxShadow = '0 4px 12px rgba(102, 126, 234, 0.15)';
    });
});

// Form submission handler
document.getElementById('paymentForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const button = this.querySelector('button[type="submit"]');
    const originalText = button.innerHTML;
    button.disabled = true;
    button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Memproses pembayaran...';

    // Simulate payment processing
    setTimeout(() => {
        this.submit();
    }, 1500);
});
</script>
@endsection
