@extends('layouts.app')

@section('title', $product['name'] . ' - JAPLO')

@section('content')
<div class="hero-section" style="padding: 40px 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <a href="{{ route('customer.produk') }}" class="btn btn-light btn-sm mb-3" style="border-radius: 25px; padding: 8px 16px;">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Produk
        </a>
        <h2 class="fw-bold mb-2 text-white display-5">
            {{ $product['name'] }}
        </h2>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <!-- Left: Product Images -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden; margin-bottom: 20px;">
                <div style="height: 400px; background: #f5f5f5; display: flex; align-items: center; justify-content: center;">
                    <img id="mainImage" src="{{ $product['image'] }}" class="w-100 h-100" style="object-fit: cover;" alt="{{ $product['name'] }}">
                </div>
            </div>

            <!-- Image Thumbnails -->
            <div class="row g-2">
                <div class="col-4">
                    <div class="card border-0 shadow-sm" style="border-radius: 12px; cursor: pointer; overflow: hidden;" onclick="changeImage(this)">
                        <img src="{{ $product['image'] }}" class="w-100" style="height: 100px; object-fit: cover;" alt="Thumb 1">
                    </div>
                </div>
                @foreach($product['images'] as $img)
                <div class="col-4">
                    <div class="card border-0 shadow-sm" style="border-radius: 12px; cursor: pointer; overflow: hidden;" onclick="changeImage(this)">
                        <img src="{{ $img }}" class="w-100" style="height: 100px; object-fit: cover;" alt="Thumb">
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Right: Product Details -->
        <div class="col-lg-6">
            <!-- Product Name & Rating -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <span class="badge bg-primary mb-2" style="border-radius: 20px; padding: 6px 12px;">{{ $product['category'] }}</span>
                        <h3 class="fw-bold mb-2">{{ $product['name'] }}</h3>
                    </div>
                    <button class="btn btn-light" style="border-radius: 50%; width: 45px; height: 45px; padding: 0;" onclick="toggleWishlist()">
                        <i class="fas fa-heart text-danger"></i>
                    </button>
                </div>

                <!-- Rating & Reviews -->
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div>
                        <i class="fas fa-star text-warning me-1"></i>
                        <span class="fw-bold">{{ $product['rating'] }}</span>
                        <span class="text-muted">(245 ulasan)</span>
                    </div>
                    <span class="text-muted">|</span>
                    <span class="text-muted">{{ $product['sold'] }} terjual</span>
                </div>
            </div>

            <!-- Price Section -->
            <div class="card bg-light mb-4 border-0" style="border-radius: 15px; padding: 20px;">
                <h5 class="text-danger fw-bold mb-2">Harga</h5>
                <div class="d-flex align-items-baseline gap-3">
                    <h2 class="fw-bold text-danger mb-0">Rp {{ number_format($product['price'], 0, ',', '.') }}</h2>
                    <del class="text-muted fs-5">Rp {{ number_format($product['original_price'], 0, ',', '.') }}</del>
                    @php
                        $discount = (($product['original_price'] - $product['price']) / $product['original_price'] * 100);
                    @endphp
                    <span class="badge bg-danger">-{{ round($discount) }}%</span>
                </div>
                <small class="text-muted mt-2 d-block">Harga sudah termasuk pajak</small>
            </div>

            <!-- Quantity & Actions -->
            <div class="row g-3 mb-4">
                <div class="col-6">
                    <label class="fw-bold mb-2 d-block">Jumlah</label>
                    <div class="input-group" style="border: 2px solid #ddd; border-radius: 10px; width: fit-content;">
                        <button class="btn btn-light" onclick="decreaseQty()" style="border: none;">−</button>
                        <input type="number" id="quantity" value="1" min="1" class="form-control border-0" style="width: 60px; text-align: center;">
                        <button class="btn btn-light" onclick="increaseQty()" style="border: none;">+</button>
                    </div>
                </div>
                <div class="col-6">
                    <label class="fw-bold mb-2 d-block">Stok</label>
                    <div class="alert alert-success mb-0" style="border-radius: 10px;">
                        <strong>Tersedia (50+)</strong>
                    </div>
                </div>
            </div>

            <!-- Main Buttons -->
            <div class="d-grid gap-2 mb-4">
                <button class="btn btn-primary btn-lg fw-bold" style="border-radius: 12px; padding: 12px;" onclick="addToCart()">
                    <i class="fas fa-shopping-cart me-2"></i> Beli Sekarang
                </button>
                <button class="btn btn-outline-primary btn-lg fw-bold" style="border-radius: 12px; padding: 12px;" onclick="addToWishlist()">
                    <i class="fas fa-heart me-2"></i> Simpan untuk Nanti
                </button>
            </div>

            <!-- Additional Info -->
            <div class="card border-0" style="border-radius: 15px; background: #f8f9fa; padding: 15px;">
                <div class="row text-center g-3">
                    <div class="col-4">
                        <i class="fas fa-truck text-primary fa-2x mb-2"></i>
                        <p class="small fw-bold mb-0">Pengiriman Gratis</p>
                        <small class="text-muted">Min. Rp 100.000</small>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-shield-alt text-success fa-2x mb-2"></i>
                        <p class="small fw-bold mb-0">Garansi</p>
                        <small class="text-muted">Sesuai produk</small>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-undo-alt text-warning fa-2x mb-2"></i>
                        <p class="small fw-bold mb-0">Pengembalian</p>
                        <small class="text-muted">30 Hari</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Specifications -->
    <div class="card border-0 shadow-sm mt-5" style="border-radius: 15px;">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-4">
                <i class="fas fa-info-circle text-primary me-2"></i> Spesifikasi Produk
            </h5>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                        @foreach($product['specs'] as $key => $value)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td class="fw-bold" style="width: 30%;">{{ $key }}</td>
                            <td>{{ $value }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="card border-0 shadow-sm mt-4" style="border-radius: 15px;">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-4">
                <i class="fas fa-comments text-primary me-2"></i> Ulasan Pembeli (245)
            </h5>

            <!-- Review Stats -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="text-center">
                        <h3 class="fw-bold text-warning">{{ $product['rating'] }}</h3>
                        <div class="mb-2">
                            @for($i = 0; $i < 5; $i++)
                                <i class="fas fa-star text-warning"></i>
                            @endfor
                        </div>
                        <small class="text-muted">Dari 245 ulasan</small>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <span class="small" style="width: 30px;">5 ⭐</span>
                            <div class="progress" style="flex: 1; height: 8px; border-radius: 10px;">
                                <div class="progress-bar bg-warning" style="width: 70%;"></div>
                            </div>
                            <span class="small">171</span>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <span class="small" style="width: 30px;">4 ⭐</span>
                            <div class="progress" style="flex: 1; height: 8px; border-radius: 10px;">
                                <div class="progress-bar bg-warning" style="width: 20%;"></div>
                            </div>
                            <span class="small">49</span>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <span class="small" style="width: 30px;">3 ⭐</span>
                            <div class="progress" style="flex: 1; height: 8px; border-radius: 10px;">
                                <div class="progress-bar bg-warning" style="width: 5%;"></div>
                            </div>
                            <span class="small">12</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sample Reviews -->
            <hr>
            <div class="mt-4">
                <div class="d-flex gap-3 mb-4">
                    <img src="https://ui-avatars.com/api/?name=Budi+Rahman&background=random" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                    <div style="flex: 1;">
                        <div class="d-flex justify-content-between mb-1">
                            <h6 class="fw-bold mb-0">Budi Rahman</h6>
                            <small class="text-muted">2 hari lalu</small>
                        </div>
                        <div class="mb-2">
                            @for($i = 0; $i < 5; $i++)
                                <i class="fas fa-star text-warning"></i>
                            @endfor
                        </div>
                        <p class="mb-0 text-muted">Produk sangat memuaskan, sesuai deskripsi, pengiriman cepat, terima kasih JAPLO!</p>
                    </div>
                </div>

                <div class="d-flex gap-3">
                    <img src="https://ui-avatars.com/api/?name=Siti+Nurhaliza&background=random" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                    <div style="flex: 1;">
                        <div class="d-flex justify-content-between mb-1">
                            <h6 class="fw-bold mb-0">Siti Nurhaliza</h6>
                            <small class="text-muted">1 minggu lalu</small>
                        </div>
                        <div class="mb-2">
                            @for($i = 0; $i < 4; $i++)
                                <i class="fas fa-star text-warning"></i>
                            @endfor
                            <i class="fas fa-star text-secondary"></i>
                        </div>
                        <p class="mb-0 text-muted">Bagus banget kualitasnya, hanya saja packaging bisa lebih rapi. Overall puas lah!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .progress {
        background-color: #e9ecef !important;
    }
</style>

<script>
let wishlistAdded = false;

function changeImage(element) {
    const img = element.querySelector('img').src;
    document.getElementById('mainImage').src = img;
}

function increaseQty() {
    const qty = document.getElementById('quantity');
    qty.value = parseInt(qty.value) + 1;
}

function decreaseQty() {
    const qty = document.getElementById('quantity');
    if (parseInt(qty.value) > 1) {
        qty.value = parseInt(qty.value) - 1;
    }
}

function addToCart() {
    const qty = parseInt(document.getElementById('quantity').value);
    const price = {{ $product['price'] }};
    const total = qty * price;
    
    showNotification('✅ {{ $product['name'] }} (' + qty + 'x) ditambahkan ke keranjang!\nTotal: Rp ' + total.toLocaleString('id-ID'));
}

function addToWishlist() {
    wishlistAdded = !wishlistAdded;
    if (wishlistAdded) {
        showNotification('❤️ Produk disimpan ke wishlist!');
    } else {
        showNotification('🗑️ Produk dihapus dari wishlist!');
    }
}

function toggleWishlist() {
    wishlistAdded = !wishlistAdded;
    if (wishlistAdded) {
        showNotification('❤️ Produk disimpan ke wishlist!');
    } else {
        showNotification('🗑️ Produk dihapus dari wishlist!');
    }
}

function showNotification(message) {
    const toast = document.createElement('div');
    toast.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: white;
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
