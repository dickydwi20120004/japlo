@extends('layouts.app')

@section('title', 'Kuliner - JAPLO')

@section('content')
<div class="hero-section" style="padding: 40px 0; background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm mb-3">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <h2 class="fw-bold mb-2 text-white">Kuliner</h2>
        <p class="mb-0 text-white">Pesan makanan favoritmu dengan mudah</p>
    </div>
</div>

<div class="container py-4">
    <!-- Search Bar -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="input-group input-group-lg">
                <span class="input-group-text">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" class="form-control" placeholder="Cari restoran atau makanan favorit...">
                <button class="btn btn-danger">
                    <i class="fas fa-filter me-2"></i> Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Categories -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Kategori</h5>
            <div class="row text-center g-2">
                <div class="col-4 col-md-2">
                    <button class="btn btn-outline-danger w-100 py-3">
                        <i class="fas fa-hamburger fa-2x d-block mb-2"></i>
                        <small class="d-block">Fast Food</small>
                    </button>
                </div>
                <div class="col-4 col-md-2">
                    <button class="btn btn-outline-danger w-100 py-3">
                        <i class="fas fa-drumstick-bite fa-2x d-block mb-2"></i>
                        <small class="d-block">Ayam & Bebek</small>
                    </button>
                </div>
                <div class="col-4 col-md-2">
                    <button class="btn btn-outline-danger w-100 py-3">
                        <i class="fas fa-bowl-rice fa-2x d-block mb-2"></i>
                        <small class="d-block">Nasi</small>
                    </button>
                </div>
                <div class="col-4 col-md-2">
                    <button class="btn btn-outline-danger w-100 py-3">
                        <i class="fas fa-coffee fa-2x d-block mb-2"></i>
                        <small class="d-block">Minuman</small>
                    </button>
                </div>
                <div class="col-4 col-md-2">
                    <button class="btn btn-outline-danger w-100 py-3">
                        <i class="fas fa-ice-cream fa-2x d-block mb-2"></i>
                        <small class="d-block">Dessert</small>
                    </button>
                </div>
                <div class="col-4 col-md-2">
                    <button class="btn btn-outline-danger w-100 py-3">
                        <i class="fas fa-ellipsis-h fa-2x d-block mb-2"></i>
                        <small class="d-block">Lainnya</small>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Promo Banner -->
    <div class="card mb-4" style="background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%); border: none;">
        <div class="card-body text-center text-white py-4">
            <h4 class="fw-bold mb-2">
                <i class="fas fa-gift me-2"></i>
                Promo Spesial Hari Ini!
            </h4>
            <p class="mb-2">Gratis Ongkir untuk pembelian minimal Rp 50.000</p>
            <span class="badge bg-light text-dark">Kode: GRATISONGKIR</span>
        </div>
    </div>

    <!-- Restaurant List -->
    <h5 class="fw-bold mb-3">Restoran Terdekat</h5>
    <div class="row">
        @foreach($restaurants as $restaurant)
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card hover-card h-100">
                <div class="position-relative">
                    <img src="{{ $restaurant['image'] }}" class="card-img-top" alt="{{ $restaurant['name'] }}" style="height: 200px; object-fit: cover;" loading="lazy">
                    @if($restaurant['promo'])
                    <span class="badge bg-danger position-absolute" style="top: 10px; left: 10px;">
                        <i class="fas fa-tag me-1"></i> {{ $restaurant['promo'] }}
                    </span>
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="fw-bold mb-2">{{ $restaurant['name'] }}</h5>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-light text-dark">{{ $restaurant['category'] }}</span>
                        <span class="text-warning fw-bold">
                            <i class="fas fa-star"></i> {{ $restaurant['rating'] }}
                        </span>
                    </div>
                    <p class="text-secondary mb-3">
                        <i class="fas fa-map-marker-alt me-1"></i>
                        {{ $restaurant['distance'] }} km dari lokasi Anda
                    </p>
                    <button class="btn btn-danger w-100" onclick="orderItem('{{ $restaurant['name'] }} - Menu Pilihan', 50000, '{{ $restaurant['image'] }}')">
                        <i class="fas fa-shopping-cart me-2"></i> Pesan Sekarang
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Popular Items -->
    <h5 class="fw-bold mb-3 mt-4">Makanan Populer</h5>
    <div class="row">
        <div class="col-6 col-md-3 mb-3">
            <div class="card hover-card h-100">
                <img src="https://via.placeholder.com/200x200?text=Nasi+Goreng" class="card-img-top" alt="Nasi Goreng" loading="lazy">
                <div class="card-body">
                    <h6 class="fw-bold mb-1">Nasi Goreng Spesial</h6>
                    <p class="text-danger fw-bold mb-2">Rp 25.000</p>
                    <button class="btn btn-sm btn-outline-danger w-100">
                        <i class="fas fa-plus me-1"></i> Tambah
                    </button>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <div class="card hover-card h-100">
                <img src="https://via.placeholder.com/200x200?text=Ayam+Geprek" class="card-img-top" alt="Ayam Geprek" loading="lazy">
                <div class="card-body">
                    <h6 class="fw-bold mb-1">Ayam Geprek Jumbo</h6>
                    <p class="text-danger fw-bold mb-2">Rp 30.000</p>
                    <button class="btn btn-sm btn-outline-danger w-100">
                        <i class="fas fa-plus me-1"></i> Tambah
                    </button>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <div class="card hover-card h-100">
                <img src="https://via.placeholder.com/200x200?text=Mie+Ayam" class="card-img-top" alt="Mie Ayam" loading="lazy">
                <div class="card-body">
                    <h6 class="fw-bold mb-1">Mie Ayam Bakso</h6>
                    <p class="text-danger fw-bold mb-2">Rp 20.000</p>
                    <button class="btn btn-sm btn-outline-danger w-100">
                        <i class="fas fa-plus me-1"></i> Tambah
                    </button>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <div class="card hover-card h-100">
                <img src="https://via.placeholder.com/200x200?text=Es+Teh" class="card-img-top" alt="Es Teh" loading="lazy">
                <div class="card-body">
                    <h6 class="fw-bold mb-1">Es Teh Manis</h6>
                    <p class="text-danger fw-bold mb-2">Rp 5.000</p>
                    <button class="btn btn-sm btn-outline-danger w-100">
                        <i class="fas fa-plus me-1"></i> Tambah
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cart Button (Floating) -->
<button class="btn btn-danger btn-lg position-fixed shadow-lg" 
        style="bottom: 20px; right: 20px; border-radius: 50px; padding: 12px 24px; z-index: 1000;" 
        onclick="openCart()"
        id="cartButton">
    <i class="fas fa-shopping-cart me-2"></i>
    <span class="d-none d-sm-inline">Keranjang</span>
    <span class="badge bg-light text-danger ms-2" id="cartCount">0</span>
</button>

<!-- Modal Order -->
<div class="modal fade" id="orderModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header border-0" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);">
                <h5 class="modal-title text-white fw-bold">
                    <i class="fas fa-shopping-cart me-2"></i>
                    <span id="modalItemName">Detail Pesanan</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Item Info -->
                <div class="text-center mb-4">
                    <img id="modalItemImage" src="" alt="" class="rounded mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <h4 class="fw-bold" id="modalItemTitle"></h4>
                    <h3 class="text-danger fw-bold" id="modalItemPrice"></h3>
                </div>

                <!-- Quantity -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Jumlah Pesanan</label>
                    <div class="input-group input-group-lg">
                        <button class="btn btn-outline-danger" type="button" onclick="decreaseQty()">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="number" class="form-control text-center fw-bold" id="quantity" value="1" min="1" readonly>
                        <button class="btn btn-outline-danger" type="button" onclick="increaseQty()">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>

                <!-- Notes -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Catatan (Opsional)</label>
                    <textarea class="form-control" id="orderNotes" rows="3" placeholder="Contoh: Pedas level 5, tanpa sayuran..."></textarea>
                </div>

                <!-- Total -->
                <div class="alert" style="background: #fff3cd; border: 2px dashed #ffc107;">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Total Pembayaran:</span>
                        <h4 class="fw-bold text-danger mb-0" id="totalPrice">Rp 0</h4>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Pilih Metode Pemesanan:</label>
                    <div class="row g-2">
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-success w-100 py-3" onclick="orderViaWhatsApp()" style="border-radius: 15px;">
                                <i class="fab fa-whatsapp fa-2x d-block mb-2"></i>
                                <span class="fw-bold">Via WhatsApp</span>
                                <small class="d-block text-muted">Pesan langsung</small>
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-primary w-100 py-3" onclick="orderViaQRIS()" style="border-radius: 15px;">
                                <i class="fas fa-qrcode fa-2x d-block mb-2"></i>
                                <span class="fw-bold">Transfer QRIS</span>
                                <small class="d-block text-muted">Bayar sekarang</small>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="alert alert-info mb-0">
                    <small>
                        <i class="fas fa-info-circle me-1"></i>
                        <strong>Via WhatsApp:</strong> Pesanan dikirim ke admin untuk konfirmasi<br>
                        <i class="fas fa-info-circle me-1"></i>
                        <strong>Transfer QRIS:</strong> Bayar langsung dan pesanan otomatis diproses
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal QRIS Payment -->
<div class="modal fade" id="qrisModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header border-0" style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);">
                <h5 class="modal-title text-white fw-bold">
                    <i class="fas fa-qrcode me-2"></i>
                    Pembayaran QRIS
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <h4 class="fw-bold mb-3">Scan QR Code untuk Bayar</h4>
                
                <!-- QRIS Code -->
                <div class="p-4 bg-light rounded mb-3" style="border: 3px dashed #007bff;">
                    <img src="https://via.placeholder.com/250x250?text=QRIS+CODE" alt="QRIS" class="img-fluid" style="max-width: 250px;">
                </div>

                <div class="alert alert-warning mb-3">
                    <h3 class="fw-bold text-danger mb-2" id="qrisTotalPrice">Rp 0</h3>
                    <small class="text-dark">Total yang harus dibayar</small>
                </div>

                <div class="alert alert-info mb-3">
                    <small>
                        <i class="fas fa-clock me-1"></i>
                        Kode QRIS berlaku selama <strong>15 menit</strong>
                    </small>
                </div>

                <div class="mb-3">
                    <p class="fw-bold mb-2">Langkah-langkah:</p>
                    <ol class="text-start small">
                        <li>Buka aplikasi e-wallet Anda (GoPay, OVO, Dana, dll)</li>
                        <li>Pilih menu "Scan QR" atau "QRIS"</li>
                        <li>Scan kode QR di atas</li>
                        <li>Konfirmasi pembayaran</li>
                        <li>Pesanan akan otomatis diproses</li>
                    </ol>
                </div>

                <button type="button" class="btn btn-success w-100 btn-lg" onclick="confirmQRISPayment()">
                    <i class="fas fa-check-circle me-2"></i>
                    Saya Sudah Bayar
                </button>

                <button type="button" class="btn btn-link" onclick="backToOrderModal()">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Metode Lain
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-card {
        transition: all 0.3s ease;
        border: 1px solid #e0e0e0;
    }
    .hover-card:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        transform: translateY(-4px);
    }
    
    #cartButton {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
</style>

<script>
let currentOrder = {
    name: '',
    price: 0,
    quantity: 1,
    image: '',
    notes: ''
};

function openRestaurant(id) {
    alert('Membuka menu restoran ID: ' + id + '\n\nFitur detail restoran dan menu akan segera hadir!');
}

function openCart() {
    alert('Keranjang belanja Anda masih kosong.\n\nSilakan tambahkan makanan terlebih dahulu!');
}

function orderItem(name, price, image) {
    currentOrder = {
        name: name,
        price: price,
        quantity: 1,
        image: image,
        notes: ''
    };
    
    document.getElementById('modalItemName').textContent = name;
    document.getElementById('modalItemTitle').textContent = name;
    document.getElementById('modalItemPrice').textContent = formatPrice(price);
    document.getElementById('modalItemImage').src = image;
    document.getElementById('quantity').value = 1;
    document.getElementById('orderNotes').value = '';
    updateTotal();
    
    const modal = new bootstrap.Modal(document.getElementById('orderModal'));
    modal.show();
}

function increaseQty() {
    let qty = parseInt(document.getElementById('quantity').value);
    qty++;
    document.getElementById('quantity').value = qty;
    currentOrder.quantity = qty;
    updateTotal();
}

function decreaseQty() {
    let qty = parseInt(document.getElementById('quantity').value);
    if (qty > 1) {
        qty--;
        document.getElementById('quantity').value = qty;
        currentOrder.quantity = qty;
        updateTotal();
    }
}

function updateTotal() {
    const total = currentOrder.price * currentOrder.quantity;
    document.getElementById('totalPrice').textContent = formatPrice(total);
    document.getElementById('qrisTotalPrice').textContent = formatPrice(total);
}

function formatPrice(price) {
    return 'Rp ' + price.toLocaleString('id-ID');
}

function orderViaWhatsApp() {
    const notes = document.getElementById('orderNotes').value;
    const total = currentOrder.price * currentOrder.quantity;
    
    // Format pesan WhatsApp
    const message = `*PESANAN JAPLO KULINER*%0A%0A` +
        `📦 *Pesanan:*%0A` +
        `${currentOrder.name}%0A%0A` +
        `📊 *Detail:*%0A` +
        `Jumlah: ${currentOrder.quantity}x%0A` +
        `Harga: ${formatPrice(currentOrder.price)}%0A` +
        `Total: ${formatPrice(total)}%0A%0A` +
        (notes ? `📝 *Catatan:*%0A${notes}%0A%0A` : '') +
        `💳 *Metode:* Via WhatsApp%0A%0A` +
        `Mohon konfirmasi pesanan ini. Terima kasih! 🙏`;
    
    // Nomor WhatsApp admin (ganti dengan nomor asli)
    const phoneNumber = '6281234567890'; // Ganti dengan nomor admin
    
    // Redirect ke WhatsApp
    window.open(`https://wa.me/${phoneNumber}?text=${message}`, '_blank');
    
    // Close modal
    bootstrap.Modal.getInstance(document.getElementById('orderModal')).hide();
    
    // Show success message
    setTimeout(() => {
        alert('✅ Pesanan Anda telah dikirim ke WhatsApp!\n\nSilakan tunggu konfirmasi dari admin.');
    }, 500);
}

function orderViaQRIS() {
    // Hide order modal
    bootstrap.Modal.getInstance(document.getElementById('orderModal')).hide();
    
    // Show QRIS modal
    setTimeout(() => {
        const qrisModal = new bootstrap.Modal(document.getElementById('qrisModal'));
        qrisModal.show();
    }, 300);
}

function backToOrderModal() {
    // Hide QRIS modal
    bootstrap.Modal.getInstance(document.getElementById('qrisModal')).hide();
    
    // Show order modal
    setTimeout(() => {
        const orderModal = new bootstrap.Modal(document.getElementById('orderModal'));
        orderModal.show();
    }, 300);
}

function confirmQRISPayment() {
    const total = currentOrder.price * currentOrder.quantity;
    const notes = document.getElementById('orderNotes').value;
    
    // Simulasi konfirmasi pembayaran
    if (confirm('Apakah Anda sudah menyelesaikan pembayaran QRIS sebesar ' + formatPrice(total) + '?')) {
        // Close modal
        bootstrap.Modal.getInstance(document.getElementById('qrisModal')).hide();
        
        // Show success message
        setTimeout(() => {
            alert('✅ Pembayaran berhasil dikonfirmasi!\n\n' +
                  '📦 Pesanan: ' + currentOrder.name + '\n' +
                  '💰 Total: ' + formatPrice(total) + '\n\n' +
                  'Pesanan Anda sedang diproses.\n' +
                  'Terima kasih telah berbelanja di JAPLO! 🙏');
            
            // Reset form
            document.getElementById('orderNotes').value = '';
        }, 300);
    }
}

// Update tombol "Tambah" pada makanan populer
document.addEventListener('DOMContentLoaded', function() {
    const addButtons = document.querySelectorAll('.btn-outline-danger');
    addButtons.forEach((btn, index) => {
        if (btn.querySelector('.fa-plus')) {
            const items = [
                { name: 'Nasi Goreng Spesial', price: 25000, image: 'https://via.placeholder.com/200x200?text=Nasi+Goreng' },
                { name: 'Ayam Geprek Jumbo', price: 30000, image: 'https://via.placeholder.com/200x200?text=Ayam+Geprek' },
                { name: 'Mie Ayam Bakso', price: 20000, image: 'https://via.placeholder.com/200x200?text=Mie+Ayam' },
                { name: 'Es Teh Manis', price: 5000, image: 'https://via.placeholder.com/200x200?text=Es+Teh' }
            ];
            
            if (items[index]) {
                btn.onclick = function() {
                    orderItem(items[index].name, items[index].price, items[index].image);
                };
            }
        }
    });
});
</script>
@endsection
