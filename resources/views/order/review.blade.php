@extends('layouts.app')

@section('title', 'Beri Rating & Review - JAPLO')

@section('content')
<div class="hero-section" style="padding: 40px 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <h2 class="fw-bold mb-2 text-white display-5">
            <i class="fas fa-star me-2"></i> Beri Rating & Review
        </h2>
        <p class="mb-0 text-white fs-5">Bagikan pengalaman Anda berbelanja di JAPLO</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if($order)
            <!-- Order Summary -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-shopping-bag text-white fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">{{ $order->order_number }}</h6>
                            <p class="text-muted small mb-0">{{ $order->created_at->format('d M Y H:i') }}</p>
                            <span class="badge bg-success mt-1">
                                <i class="fas fa-check-circle me-1"></i> Selesai
                            </span>
                        </div>
                    </div>

                    <!-- Items List -->
                    <div class="border-top pt-3">
                        <h6 class="fw-bold small mb-3">Pesanan Anda:</h6>
                        @foreach($order->items as $item)
                        <div class="d-flex justify-content-between align-items-center mb-2 small">
                            <span>{{ $item->quantity }}x {{ $item->item_name }}</span>
                            <span class="fw-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Rating Form -->
            <form id="reviewForm" method="POST" action="{{ route('order.submitReview', $order->id) }}">
                @csrf

                <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">
                            <i class="fas fa-star text-warning me-2"></i> Beri Rating
                        </h5>

                        <!-- Overall Rating -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Rating Keseluruhan</label>
                            <div class="d-flex gap-3">
                                @for($i = 1; $i <= 5; $i++)
                                <label class="star-rating" style="cursor: pointer; font-size: 40px;">
                                    <input type="radio" name="rating" value="{{ $i }}" style="display: none;">
                                    <i class="far fa-star text-warning" style="transition: all 0.3s; cursor: pointer;"></i>
                                </label>
                                @endfor
                            </div>
                            <small class="text-muted d-block mt-2">Berapa bintang untuk pesanan ini?</small>
                        </div>

                        <!-- Detailed Ratings -->
                        <h6 class="fw-bold mb-3">Rating Terperinci</h6>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Kualitas Makanan</label>
                                <div class="rating-small">
                                    @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star text-warning" style="cursor: pointer; margin-right: 5px; font-size: 18px;" onclick="rateDetail(this, 'food_quality', {{ $i }})"></i>
                                    @endfor
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Kecepatan Pengiriman</label>
                                <div class="rating-small">
                                    @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star text-warning" style="cursor: pointer; margin-right: 5px; font-size: 18px;" onclick="rateDetail(this, 'delivery_speed', {{ $i }})"></i>
                                    @endfor
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Packaging</label>
                                <div class="rating-small">
                                    @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star text-warning" style="cursor: pointer; margin-right: 5px; font-size: 18px;" onclick="rateDetail(this, 'packaging', {{ $i }})"></i>
                                    @endfor
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Pelayanan Driver</label>
                                <div class="rating-small">
                                    @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star text-warning" style="cursor: pointer; margin-right: 5px; font-size: 18px;" onclick="rateDetail(this, 'driver_service', {{ $i }})"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <!-- Review Text -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Review (Opsional)</label>
                            <textarea class="form-control" name="review" rows="5" placeholder="Bagikan pengalaman Anda berbelanja di JAPLO... (Minimal 20 karakter)" maxlength="500"></textarea>
                            <small class="text-muted d-block mt-2"><span id="charCount">0</span>/500 karakter</small>
                        </div>

                        <!-- Recommend Checkbox -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" name="recommend" id="recommend">
                            <label class="form-check-label" for="recommend">
                                <i class="fas fa-heart text-danger me-1"></i>
                                Saya merekomendasikan JAPLO kepada teman/keluarga
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Photo Upload (Optional) -->
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">
                            <i class="fas fa-image text-primary me-2"></i> Upload Foto (Opsional)
                        </h5>
                        <p class="text-muted small mb-3">Tambahkan foto untuk mendapatkan reward poin!</p>

                        <div class="upload-area border-2 border-dashed rounded-3 p-4 text-center" style="background: #f8f9fa; border-color: #ddd; cursor: pointer; transition: all 0.3s;">
                            <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3 d-block"></i>
                            <p class="fw-bold mb-1">Drag & drop foto di sini</p>
                            <p class="text-muted small mb-0">atau klik untuk memilih file</p>
                            <input type="file" name="photo" accept="image/*" style="display: none;" onchange="handleFileUpload(event)">
                        </div>

                        <div id="photoPreview" style="display: none; margin-top: 20px;">
                            <img id="previewImage" style="max-width: 100%; max-height: 200px; border-radius: 10px;">
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="d-grid gap-2 d-md-flex justify-content-center">
                    <button type="submit" class="btn btn-primary btn-lg fw-bold" style="border-radius: 12px; min-width: 200px;">
                        <i class="fas fa-paper-plane me-2"></i> Kirim Review
                    </button>
                    <a href="{{ route('order.history') }}" class="btn btn-outline-secondary btn-lg fw-bold" style="border-radius: 12px; min-width: 200px;">
                        <i class="fas fa-times me-2"></i> Batal
                    </a>
                </div>
            </form>

            <!-- Helpful Tips -->
            <div class="alert alert-info mt-4" style="border-radius: 15px;">
                <h6 class="fw-bold mb-2">
                    <i class="fas fa-lightbulb me-2"></i> Tips Memberikan Review:
                </h6>
                <ul class="small mb-0">
                    <li>Berikan rating yang jujur dan adil</li>
                    <li>Review yang detail membantu seller & pembeli lain</li>
                    <li>Hindari spam, konten porno, atau SARA</li>
                    <li>Setiap review yang berguna akan mendapat reward poin!</li>
                </ul>
            </div>

            @else
            <div class="alert alert-warning" style="border-radius: 15px;">
                <i class="fas fa-exclamation-circle me-2"></i>
                Order tidak ditemukan atau belum selesai
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .star-rating i {
        transition: all 0.3s;
    }

    .star-rating:hover i,
    .star-rating input:checked ~ i {
        color: #ffc107 !important;
        transform: scale(1.2);
    }

    .upload-area:hover {
        background: #f0f0f0 !important;
        border-color: #667eea !important;
    }
</style>

<script>
function rateDetail(element, type, rating) {
    const container = element.parentElement;
    const stars = container.querySelectorAll('i');

    stars.forEach((star, index) => {
        if (index < rating) {
            star.classList.remove('far');
            star.classList.add('fas');
        } else {
            star.classList.remove('fas');
            star.classList.add('far');
        }
    });
}

function handleFileUpload(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImage').src = e.target.result;
            document.getElementById('photoPreview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}

// Update character count
document.querySelector('textarea[name="review"]').addEventListener('keyup', function() {
    document.getElementById('charCount').textContent = this.value.length;
});

// Star rating click handler
document.querySelectorAll('.star-rating').forEach((label, index) => {
    label.addEventListener('click', function() {
        document.querySelectorAll('.star-rating i').forEach((star, i) => {
            if (i <= index) {
                star.classList.remove('far');
                star.classList.add('fas');
            } else {
                star.classList.remove('fas');
                star.classList.add('far');
            }
        });
    });
});

// File upload click
document.querySelector('.upload-area').addEventListener('click', function() {
    this.nextElementSibling.click();
});

// Form submit
document.getElementById('reviewForm').addEventListener('submit', function(e) {
    const rating = document.querySelector('input[name="rating"]:checked');
    if (!rating) {
        e.preventDefault();
        alert('Silakan berikan rating terlebih dahulu!');
    }
});
</script>
@endsection
