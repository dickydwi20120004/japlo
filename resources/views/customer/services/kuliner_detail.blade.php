@extends('layouts.app')

@section('title', $restaurant['name'] . ' - JAPLO')

@section('content')
<div class="hero-section" style="padding: 50px 0; background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);">
    <div class="container">
        <a href="{{ route('customer.kuliner') }}" class="btn btn-light btn-sm mb-3" style="border-radius: 25px; padding: 8px 16px;">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Restoran
        </a>
        <h2 class="fw-bold mb-2 text-white display-5">
            {{ $restaurant['name'] }}
        </h2>
        <p class="mb-0 text-white fs-5">Pesan makanan lezat sekarang juga!</p>
    </div>
</div>

<div class="container py-5">
    <!-- Restaurant Header -->
    <div class="card mb-5 border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
        <div class="position-relative" style="height: 300px; overflow: hidden;">
            <img src="{{ $restaurant['image'] }}" class="w-100 h-100" alt="{{ $restaurant['name'] }}" style="object-fit: cover;">
            
            @if($restaurant['promo'])
            <span class="badge bg-danger position-absolute" style="top: 20px; left: 20px; padding: 12px 16px; border-radius: 25px; font-size: 14px;">
                <i class="fas fa-tag me-1"></i> {{ $restaurant['promo'] }}
            </span>
            @endif

            <div class="position-absolute bottom-0 start-0 end-0" style="background: linear-gradient(to top, rgba(0,0,0,0.7), transparent); padding: 30px 20px 20px;">
                <div class="row text-white">
                    <div class="col-md-6">
                        <h4 class="fw-bold mb-2">{{ $restaurant['name'] }}</h4>
                        <div class="d-flex gap-3 flex-wrap">
                            <div>
                                <small class="text-white-50">Rating</small>
                                <div class="fw-bold">
                                    <i class="fas fa-star text-warning"></i> {{ $restaurant['rating'] }}
                                </div>
                            </div>
                            <div>
                                <small class="text-white-50">Jarak</small>
                                <div class="fw-bold">{{ $restaurant['distance'] }} km</div>
                            </div>
                            <div>
                                <small class="text-white-50">Pengiriman</small>
                                <div class="fw-bold">{{ $restaurant['delivery_time'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Info Restoran -->
        <div class="col-lg-8">
            <!-- Restaurant Details -->
            <div class="card mb-4 border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-info-circle text-danger me-2"></i> Informasi Restoran
                    </h5>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <small class="text-muted">Alamat</small>
                            <p class="fw-bold mb-0">{{ $restaurant['address'] }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <small class="text-muted">No. Telepon</small>
                            <p class="fw-bold mb-0">{{ $restaurant['phone'] }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <small class="text-muted">Jam Operasional</small>
                            <p class="fw-bold mb-0">{{ $restaurant['open_time'] }} - {{ $restaurant['close_time'] }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <small class="text-muted">Minimal Order</small>
                            <p class="fw-bold mb-0">Rp {{ number_format($restaurant['min_order'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <hr>
                    <p class="text-muted mb-0">{{ $restaurant['description'] }}</p>
                </div>
            </div>

            <!-- Menu Items -->
            <h4 class="fw-bold mb-4">
                <i class="fas fa-list me-2 text-danger"></i> Menu
            </h4>
            <div class="row" id="menuContainer">
                @foreach($restaurant['menus'] as $menu)
                <div class="col-12 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm hover-item" style="border-radius: 15px; overflow: hidden;">
                        <!-- Menu Image -->
                        <div style="height: 180px; overflow: hidden;">
                            <img src="{{ $menu['image'] }}" class="w-100 h-100" alt="{{ $menu['name'] }}" style="object-fit: cover;">
                        </div>

                        <!-- Menu Details -->
                        <div class="card-body p-3">
                            <!-- Name -->
                            <h6 class="fw-bold mb-2" style="font-size: 15px; line-height: 1.3;">{{ $menu['name'] }}</h6>
                            
                            <!-- Description -->
                            <p class="small text-muted mb-2">{{ $menu['description'] }}</p>

                            <!-- Rating -->
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-star text-warning me-1" style="font-size: 12px;"></i>
                                <small class="fw-bold">{{ $menu['rating'] }}</small>
                            </div>

                            <!-- Price -->
                            <p class="text-danger fw-bold mb-2" style="font-size: 16px;">Rp {{ number_format($menu['price'], 0, ',', '.') }}</p>

                            <!-- Add to Cart Button -->
                            <button class="btn btn-outline-danger w-100 rounded-2 fw-bold" 
                                    onclick="addToCart('{{ $menu['name'] }}', {{ $menu['price'] }}, '{{ $menu['image'] }}')">
                                <i class="fas fa-shopping-cart me-1"></i> Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Cart Summary -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm" style="border-radius: 15px; position: sticky; top: 20px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-shopping-cart text-danger me-2"></i> Keranjang Belanja
                    </h5>

                    <!-- Cart Items -->
                    <div id="cartItems" style="max-height: 400px; overflow-y: auto; margin-bottom: 20px;">
                        <p class="text-muted text-center py-4">
                            <i class="fas fa-inbox fa-2x mb-2 d-block text-secondary"></i>
                            Keranjang kosong
                        </p>
                    </div>

                    <hr id="cartDivider" style="display: none;">

                    <!-- Total -->
                    <div id="cartSummary" style="display: none;">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span id="subtotal" class="fw-bold">Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Ongkir</span>
                            <span id="shipping" class="fw-bold">Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 pt-3 border-top">
                            <span class="fw-bold">Total</span>
                            <span id="total" class="fw-bold text-danger" style="font-size: 18px;">Rp 0</span>
                        </div>

                        <!-- Checkout Button -->
                        <button class="btn btn-danger w-100 fw-bold py-3" style="border-radius: 15px;" onclick="checkout()">
                            <i class="fas fa-check-circle me-2"></i> Lanjut ke Pembayaran
                        </button>

                        <!-- Continue Shopping Button -->
                        <button class="btn btn-outline-secondary w-100 fw-bold mt-2 py-2" style="border-radius: 15px;" onclick="clearCart()">
                            <i class="fas fa-redo me-1"></i> Lanjut Belanja
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-item {
        transition: all 0.3s ease;
    }

    .hover-item:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 16px rgba(220, 53, 69, 0.15) !important;
    }

    .cart-item {
        padding: 12px;
        background: #f8f9fa;
        border-radius: 10px;
        margin-bottom: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .cart-item img {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        object-fit: cover;
    }

    .cart-item-info {
        flex: 1;
    }

    .cart-item-name {
        font-weight: bold;
        font-size: 13px;
    }

    .cart-item-price {
        color: #dc3545;
        font-weight: bold;
        font-size: 12px;
    }

    .cart-item-qty {
        display: flex;
        gap: 4px;
        align-items: center;
    }

    .qty-btn {
        width: 22px;
        height: 22px;
        padding: 0 !important;
        font-size: 11px;
        line-height: 1;
        border-radius: 4px;
    }

    .qty-display {
        font-weight: bold;
        min-width: 20px;
        text-align: center;
    }
</style>

<script>
let cart = [];
const restaurantId = {{ $restaurant['id'] }};

function addToCart(name, price, image) {
    // Check if item already in cart
    const existingItem = cart.find(item => item.name === name && item.price === price);
    
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            name: name,
            price: price,
            image: image,
            quantity: 1
        });
    }
    
    updateCartDisplay();
    showNotification('✅ ' + name + ' ditambahkan ke keranjang!');
}

function updateCartDisplay() {
    const cartContainer = document.getElementById('cartItems');
    const cartSummary = document.getElementById('cartSummary');
    const cartDivider = document.getElementById('cartDivider');

    if (cart.length === 0) {
        cartContainer.innerHTML = '<p class="text-muted text-center py-4"><i class="fas fa-inbox fa-2x mb-2 d-block text-secondary"></i>Keranjang kosong</p>';
        cartSummary.style.display = 'none';
        cartDivider.style.display = 'none';
        return;
    }

    let html = '';
    let subtotal = 0;

    cart.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        subtotal += itemTotal;
        
        html += `
            <div class="cart-item">
                <img src="${item.image}" alt="${item.name}">
                <div class="cart-item-info">
                    <div class="cart-item-name">${item.name}</div>
                    <div class="cart-item-price">Rp ${item.price.toLocaleString('id-ID')}</div>
                </div>
                <div class="cart-item-qty">
                    <button class="btn btn-danger qty-btn" onclick="decreaseQty(${index})">−</button>
                    <span class="qty-display">${item.quantity}</span>
                    <button class="btn btn-danger qty-btn" onclick="increaseQty(${index})">+</button>
                </div>
                <button class="btn btn-sm btn-light" onclick="removeFromCart(${index})" style="border-radius: 6px;">
                    <i class="fas fa-trash text-danger"></i>
                </button>
            </div>
        `;
    });

    cartContainer.innerHTML = html;
    
    // Update summary
    const shipping = 10000; // Fixed shipping
    const total = subtotal + shipping;
    
    document.getElementById('subtotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
    document.getElementById('shipping').textContent = 'Rp ' + shipping.toLocaleString('id-ID');
    document.getElementById('total').textContent = 'Rp ' + total.toLocaleString('id-ID');
    
    cartSummary.style.display = 'block';
    cartDivider.style.display = 'block';
}

function increaseQty(index) {
    cart[index].quantity += 1;
    updateCartDisplay();
}

function decreaseQty(index) {
    if (cart[index].quantity > 1) {
        cart[index].quantity -= 1;
    } else {
        removeFromCart(index);
    }
    updateCartDisplay();
}

function removeFromCart(index) {
    cart.splice(index, 1);
    updateCartDisplay();
    showNotification('❌ Item dihapus dari keranjang');
}

function clearCart() {
    cart = [];
    updateCartDisplay();
    showNotification('🛒 Keranjang dikosongkan');
}

function checkout() {
    if (cart.length === 0) {
        alert('Pilih menu terlebih dahulu!');
        return;
    }

    // Store cart to session via fetch
    const cartData = cart;
    localStorage.setItem('japlo_cart', JSON.stringify(cartData));
    
    // Redirect to checkout
    window.location.href = '/payment/checkout';
}

function showNotification(message) {
    // Create toast notification
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
    `;
    toast.textContent = message;
    document.body.appendChild(toast);

    setTimeout(() => {
        toast.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Add animations
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
