@extends('layouts.app')

@section('title', $service['name'] . ' - JAPLO')

@section('content')
<div class="hero-section" style="padding: 40px 0; background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);">
    <div class="container">
        <a href="{{ route('customer.kesehatan') }}" class="btn btn-light btn-sm mb-3" style="border-radius: 25px; padding: 8px 16px;">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Kesehatan
        </a>
        <h2 class="fw-bold mb-2 text-white display-5">
            <i class="fas {{ $service['icon'] }} me-2"></i>{{ $service['name'] }}
        </h2>
        <p class="mb-0 text-white fs-5">Layanan kesehatan terpercaya untuk Anda dan keluarga</p>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8 mb-4">
            <!-- Service Description -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-lightbulb text-warning me-2"></i> Tentang Layanan
                    </h5>
                    <p class="text-muted mb-0" style="line-height: 1.8;">
                        {{ $service['full_description'] }}
                    </p>
                </div>
            </div>

            <!-- Benefits -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-check-circle text-success me-2"></i> Keuntungan Layanan
                    </h5>
                    <div class="row g-3">
                        @foreach($service['benefits'] as $benefit)
                        <div class="col-12">
                            <div class="d-flex gap-3">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-success fa-lg mt-1"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted">{{ $benefit }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- How It Works -->
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-tasks text-primary me-2"></i> Cara Menggunakan
                    </h5>
                    <div class="row g-3">
                        @foreach($service['how_it_works'] as $index => $step)
                        <div class="col-12">
                            <div class="d-flex gap-3">
                                <div class="flex-shrink-0">
                                    <div class="badge bg-primary rounded-circle p-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                        {{ $index + 1 }}
                                    </div>
                                </div>
                                <div style="flex: 1;">
                                    <p class="mb-0">{{ $step }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Booking Card -->
        <div class="col-lg-4">
            <!-- Price Card -->
            <div class="card border-0 shadow-sm sticky-top mb-4" style="border-radius: 20px; top: 20px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-calendar-check text-danger me-2"></i> Pesan Layanan
                    </h5>

                    <!-- Price -->
                    @if($service['price'] > 0)
                    <div class="card bg-light mb-4" style="border-radius: 15px; border: none;">
                        <div class="card-body text-center">
                            <small class="text-muted d-block mb-1">Harga Mulai dari</small>
                            <h3 class="fw-bold text-danger mb-0">Rp {{ number_format($service['price'], 0, ',', '.') }}</h3>
                        </div>
                    </div>
                    @else
                    <div class="card bg-light mb-4" style="border-radius: 15px; border: none;">
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-success mb-1">Harga Bervariasi</h5>
                            <small class="text-muted">Sesuai dengan produk/layanan yang dipilih</small>
                        </div>
                    </div>
                    @endif

                    <!-- Booking Form -->
                    <form id="bookingForm" onsubmit="submitBooking(event)">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama Anda" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">No. Telepon</label>
                            <input type="tel" class="form-control" placeholder="08xx xxxx xxxx" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Pilih Tanggal</label>
                            <input type="date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Pilih Jam</label>
                            <select class="form-select" required>
                                <option value="">-- Pilih Jam --</option>
                                <option value="08:00">08:00 - 09:00</option>
                                <option value="09:00">09:00 - 10:00</option>
                                <option value="10:00">10:00 - 11:00</option>
                                <option value="14:00">14:00 - 15:00</option>
                                <option value="15:00">15:00 - 16:00</option>
                                <option value="16:00">16:00 - 17:00</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Catatan (Opsional)</label>
                            <textarea class="form-control" rows="3" placeholder="Tuliskan catatan atau pertanyaan Anda..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-danger w-100 fw-bold py-3" style="border-radius: 12px;">
                            <i class="fas fa-check-circle me-2"></i> Pesan Sekarang
                        </button>
                    </form>

                    <hr class="my-3">

                    <!-- Additional Info -->
                    <div class="alert alert-info" style="border-radius: 12px;">
                        <small class="d-block mb-2">
                            <i class="fas fa-info-circle me-1"></i> <strong>Informasi:</strong>
                        </small>
                        <small class="text-muted">
                            Tim kami akan menghubungi Anda dalam 15 menit untuk konfirmasi booking.
                        </small>
                    </div>

                    <!-- Contact Support -->
                    <a href="tel:1500123" class="btn btn-outline-danger w-100 fw-bold py-2" style="border-radius: 12px;">
                        <i class="fas fa-phone me-2"></i> Hubungi Support
                    </a>
                </div>
            </div>

            <!-- Info Box -->
            <div class="card border-0" style="border-radius: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body p-4 text-white text-center">
                    <i class="fas fa-shield-alt fa-3x mb-3"></i>
                    <h6 class="fw-bold mb-2">Terpercaya & Aman</h6>
                    <p class="small mb-0">Semua dokter dan perawat telah tersertifikasi dan terverifikasi oleh otoritas kesehatan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="card border-0 shadow-sm mt-5" style="border-radius: 20px;">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-4">
                <i class="fas fa-question-circle text-primary me-2"></i> Pertanyaan Umum
            </h5>

            <div class="accordion" id="faqAccordion">
                <div class="accordion-item border-0 mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            Apakah layanan ini tersedia 24/7?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-body bg-light">
                        Ya, layanan kesehatan kami tersedia 24/7 untuk melayani kebutuhan Anda kapan saja.
                    </div>
                </div>

                <div class="accordion-item border-0 mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Berapa lama waktu respons dari tim medis?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-body bg-light">
                        Tim medis kami akan merespons dalam waktu maksimal 15 menit setelah Anda melakukan booking.
                    </div>
                </div>

                <div class="accordion-item border-0 mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            Apakah privasi data saya terjamin?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-body bg-light">
                        Privasi dan kerahasiaan data Anda adalah prioritas utama kami. Semua data dienkripsi dengan standar internasional.
                    </div>
                </div>

                <div class="accordion-item border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                            Metode pembayaran apa saja yang tersedia?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-body bg-light">
                        Kami menerima berbagai metode pembayaran: Transfer Bank, e-Wallet, Kartu Kredit, dan Cicilan.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .accordion-button:not(.collapsed) {
        background-color: #f8f9fa !important;
        color: #333 !important;
    }

    .accordion-button:focus {
        box-shadow: none !important;
        border-color: #dee2e6 !important;
    }
</style>

<script>
function submitBooking(event) {
    event.preventDefault();
    
    const form = event.target;
    const name = form.querySelector('input[type="text"]').value;
    const phone = form.querySelector('input[type="tel"]').value;
    const date = form.querySelector('input[type="date"]').value;
    const time = form.querySelectorAll('select')[0].value;
    const notes = form.querySelector('textarea').value;

    if (!name || !phone || !date || !time) {
        showNotification('⚠️ Harap lengkapi semua data yang diperlukan!', 'warning');
        return;
    }

    showNotification('✅ Booking berhasil! Tim medis akan menghubungi Anda dalam 15 menit.', 'success');
    form.reset();
}

function showNotification(message, type = 'info') {
    const toast = document.createElement('div');
    const bgColor = type === 'success' ? '#28a745' : type === 'warning' ? '#ffc107' : '#17a2b8';
    const textColor = type === 'warning' ? '#333' : '#fff';
    
    toast.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: ${bgColor};
        color: ${textColor};
        padding: 16px 20px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 9999;
        animation: slideIn 0.3s ease;
        max-width: 300px;
    `;
    toast.textContent = message;
    document.body.appendChild(toast);

    setTimeout(() => {
        toast.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
</script>
@endsection
