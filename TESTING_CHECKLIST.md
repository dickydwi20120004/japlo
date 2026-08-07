# 🧪 TESTING CHECKLIST - JAPLO APP

**Tanggal Testing**: _______________
**Tester**: _______________
**Status Overall**: ⏳ PENDING

---

## ✅ OPSI 1: DETAIL PAGES

### 1.1 Kuliner Detail Page
- [ ] URL `/customer/kuliner` menampilkan daftar restoran
- [ ] Klik "Lihat Menu" → membuka `/customer/kuliner/1` (atau ID lainnya)
- [ ] Halaman menampilkan:
  - [ ] Gambar restoran
  - [ ] Nama restoran
  - [ ] Rating & ulasan
  - [ ] Jam operasional
  - [ ] Minimal order
  - [ ] Daftar menu dengan harga
- [ ] Klik "Tambah ke Keranjang" pada menu:
  - [ ] Item ditambahkan ke keranjang
  - [ ] Notifikasi toast muncul
  - [ ] Keranjang update di sidebar
- [ ] Quantity control (+/-):
  - [ ] Tombol + meningkatkan quantity
  - [ ] Tombol - menurunkan quantity
  - [ ] Tidak bisa minus di bawah 1
- [ ] Keranjang summary:
  - [ ] Menampilkan semua items
  - [ ] Total harga calculate correctly
  - [ ] Subtotal + Ongkir + Pajak
- [ ] Klik "Lanjut ke Pembayaran":
  - [ ] Redirect ke `/payment/checkout`
  - [ ] Cart items tampil di checkout

### 1.2 Produk Detail Page
- [ ] URL `/customer/produk` menampilkan list produk
- [ ] Klik produk → membuka `/customer/produk/{id}`
- [ ] Halaman menampilkan:
  - [ ] Gallery foto dengan thumbnails
  - [ ] Tombol untuk ganti foto
  - [ ] Nama produk & kategori
  - [ ] Harga & diskon percentage
  - [ ] Rating dengan review count
  - [ ] Spesifikasi lengkap
  - [ ] Quantity selector
- [ ] Wishlist button:
  - [ ] Icon berubah saat di-klik
  - [ ] Toast notification muncul
- [ ] Add to cart:
  - [ ] Item ditambahkan dengan quantity
  - [ ] Toast notification
- [ ] Reviews section:
  - [ ] Tampil review dari pembeli lain
  - [ ] Rating breakdown (5/4/3 stars)
  - [ ] Foto review tampil

### 1.3 Kesehatan Detail Page
- [ ] URL `/customer/kesehatan` menampilkan list layanan
- [ ] Klik "Lihat Detail" → membuka `/customer/kesehatan/{id}`
- [ ] Halaman menampilkan:
  - [ ] Nama & deskripsi layanan
  - [ ] Keuntungan (dengan icon)
  - [ ] Cara penggunaan step-by-step
  - [ ] FAQ section
  - [ ] Harga atau "Harga Bervariasi"
- [ ] Booking form:
  - [ ] Nama Lengkap field
  - [ ] No. Telepon field
  - [ ] Tanggal picker
  - [ ] Jam picker
  - [ ] Catatan textarea
- [ ] Form submission:
  - [ ] Validasi jika ada field kosong
  - [ ] Alert ditampilkan
  - [ ] Toast notification saat sukses

---

## ✅ OPSI 2: PEMBAYARAN

### 2.1 Checkout Page
- [ ] URL `/payment/checkout` accessible setelah add to cart
- [ ] Payment method selection:
  - [ ] 4 metode tersedia: Kartu Kredit, Bank Transfer, E-Wallet, COD
  - [ ] Klik metode → highlight selected
  - [ ] Background color berubah saat selected
- [ ] Shipping form:
  - [ ] Nama Depan field
  - [ ] Nama Belakang field
  - [ ] Email pre-filled (dari user login)
  - [ ] No. Telepon field
  - [ ] Alamat textarea
  - [ ] Kota field
  - [ ] Provinsi field
  - [ ] Kode Pos field
- [ ] Order summary:
  - [ ] Semua items dari cart tampil
  - [ ] Subtotal calculate
  - [ ] Ongkir: Rp 10.000
  - [ ] Pajak: 10% dari subtotal
  - [ ] Total: Subtotal + Ongkir + Pajak
- [ ] Security badge:
  - [ ] "Pembayaran Aman" badge tampil
  - [ ] SSL 256-bit info tampil
- [ ] Submit button:
  - [ ] Disabled state saat submitting
  - [ ] Loading text: "Memproses pembayaran..."
  - [ ] Post to `/payment/process`

### 2.2 Payment Processing
- [ ] Form validation:
  - [ ] Error jika nama kosong
  - [ ] Error jika email invalid
  - [ ] Error jika alamat kosong
- [ ] Database entry:
  - [ ] Order created di database
  - [ ] OrderItem created untuk setiap item
  - [ ] Payment record created

### 2.3 Success Page
- [ ] URL `/payment/success/{orderId}`
- [ ] Halaman menampilkan:
  - [ ] Success icon dengan background hijau
  - [ ] "Pembayaran Berhasil!" message
  - [ ] Order number
  - [ ] Payment method
  - [ ] Customer name & address
  - [ ] Email & phone
  - [ ] Next steps (5 bullets)
- [ ] Buttons:
  - [ ] "Lihat Status Pesanan" → `/order/track/{orderId}`
  - [ ] "Kembali ke Dashboard" → dashboard
- [ ] Security badges tampil

### 2.4 Failed Page
- [ ] URL `/payment/failed/{orderId}`
- [ ] Halaman menampilkan:
  - [ ] Failed icon dengan background merah
  - [ ] "Pembayaran Gagal!" message
  - [ ] Order details
  - [ ] Alasan kemungkinan (5 bullets)
  - [ ] Troubleshooting tips
- [ ] Buttons:
  - [ ] "Coba Pembayaran Lagi" → `/payment/checkout`
  - [ ] "Kembali ke Belanja"
  - [ ] "Hubungi WhatsApp Support"
- [ ] Contact info tampil

---

## ✅ OPSI 3: DATABASE SAVING

### 3.1 Order Creation
- [ ] Setelah sukses payment, order ada di database
- [ ] Order fields:
  - [ ] order_number (unique, format: JPL-YYYYMMDDxxxx)
  - [ ] user_id (current user)
  - [ ] status = 'confirmed' atau 'pending'
  - [ ] payment_status = 'paid'
  - [ ] destination_address (dari form)
  - [ ] price (total amount)

### 3.2 Order Items
- [ ] OrderItems created untuk setiap item di cart
- [ ] Jumlah rows = jumlah unique items di cart
- [ ] Fields per item:
  - [ ] order_id (FK)
  - [ ] item_name
  - [ ] item_type ('food', 'product', dll)
  - [ ] quantity
  - [ ] price (per unit)
  - [ ] subtotal (qty * price)

### 3.3 Payment Record
- [ ] Payment created untuk order ini
- [ ] Fields:
  - [ ] order_id (FK)
  - [ ] user_id (FK)
  - [ ] transaction_id (unique)
  - [ ] payment_method (dari form)
  - [ ] payment_status = 'success'
  - [ ] subtotal, shipping, tax, total_amount
  - [ ] customer_name, email, phone
  - [ ] shipping address fields
  - [ ] paid_at timestamp

### 3.4 Database Relationships
- [ ] Order → has many OrderItems
- [ ] Order → has one Payment
- [ ] Payment → belongs to Order
- [ ] Payment → belongs to User

---

## ✅ OPSI 4: ORDER TRACKING

### 4.1 Tracking Page
- [ ] URL `/order/track/{orderId}` accessible
- [ ] Map section:
  - [ ] Placeholder map display
  - [ ] Ready untuk Google Maps integration
- [ ] Timeline:
  - [ ] 5 timeline items: Confirmed, Processing, Picked Up, In Transit, Completed
  - [ ] Current status highlighted dengan animasi pulse
  - [ ] Completed stages punya checkmark icon
  - [ ] Dashed line connecting stages
- [ ] Order summary:
  - [ ] Order number
  - [ ] Status badge (with color)
  - [ ] Items list dengan pricing
  - [ ] Subtotal + Ongkir + Pajak
  - [ ] Total amount
- [ ] Driver info (jika sudah assigned):
  - [ ] Driver avatar
  - [ ] Driver name
  - [ ] Rating & review count
  - [ ] Tombol "Hubungi Driver"
  - [ ] WhatsApp button
- [ ] Shipping address:
  - [ ] Alamat lengkap tampil
  - [ ] Kota & Provinsi

### 4.2 Order History Page
- [ ] URL `/order/history`
- [ ] Filter tabs:
  - [ ] "Semua" - show all orders
  - [ ] "Sedang Diproses" - show pending/in_progress
  - [ ] "Selesai" - show completed
  - [ ] "Dibatalkan" - show cancelled
- [ ] Order list:
  - [ ] Order number
  - [ ] Date/time created
  - [ ] Item count
  - [ ] Total price
  - [ ] Status badge (dengan warna berbeda)
- [ ] Actions per order:
  - [ ] Eye icon → View tracking
  - [ ] Redo icon → Repeat order (placeholder)
- [ ] Items preview:
  - [ ] First 3 items tampil sebagai badges
  - [ ] "+x lainnya" jika ada lebih dari 3 items
- [ ] Pagination:
  - [ ] 10 items per page
  - [ ] Pagination links tampil
- [ ] Empty state:
  - [ ] Message jika belum ada order
  - [ ] CTA button ke kuliner

---

## ✅ OPSI 5: FITUR TAMBAHAN

### 5.1 Review Page
- [ ] URL `/order/{orderId}/review`
- [ ] Halaman menampilkan:
  - [ ] Order summary card
  - [ ] Items list dari order
- [ ] Rating section:
  - [ ] 5 bintang clickable
  - [ ] Bintang berubah ke solid saat di-klik
  - [ ] Scale up animation
- [ ] Detailed ratings:
  - [ ] Kualitas Makanan (1-5 stars)
  - [ ] Kecepatan Pengiriman (1-5 stars)
  - [ ] Packaging (1-5 stars)
  - [ ] Pelayanan Driver (1-5 stars)
  - [ ] Bintang bisa diklik & berubah
- [ ] Review text:
  - [ ] Textarea untuk tulis review
  - [ ] Max 500 karakter
  - [ ] Character counter real-time
- [ ] Recommend checkbox:
  - [ ] "Saya merekomendasikan JAPLO..."
- [ ] Photo upload:
  - [ ] Drag & drop area
  - [ ] Click to browse
  - [ ] Image preview tampil
  - [ ] File input hidden
- [ ] Form validation:
  - [ ] Error jika rating belum dipilih
  - [ ] Submit button enable jika valid
- [ ] Tips section:
  - [ ] 4 tips tampil

### 5.2 Wishlist (Frontend)
- [ ] Product detail page:
  - [ ] Heart button tersedia
  - [ ] Icon: far (empty) → fas (filled)
  - [ ] Toast notification: "Disimpan ke wishlist"
  - [ ] Toggle works multiple times
- [ ] Kuliner/Produk list:
  - [ ] Wishlist button visible (jika ada di produk card)

### 5.3 Search & Filter
- [ ] Search bars:
  - [ ] Kuliner page: "Cari restoran atau makanan..."
  - [ ] Produk page: "Cari produk..."
- [ ] Filter buttons:
  - [ ] Kuliner: Category buttons (6 buttons)
  - [ ] Produk: Filter chips (Rating, Diskon, Flash Sale, Gratis Ongkir)
- [ ] Sort options:
  - [ ] "Urutkan Berdasarkan" dropdown
  - [ ] Options: Popular, Lowest, Highest, Newest
- [ ] Flash sale countdown:
  - [ ] Timer tampil dengan real-time update
  - [ ] Format: HH:MM:SS

---

## 🔧 TECHNICAL CHECKS

### Database
- [ ] Migrations run without error: `php artisan migrate`
- [ ] Tables created: orders, order_items, payments
- [ ] Indexes created correctly
- [ ] Foreign keys work properly

### Routes
- [ ] All routes registered in `routes/web.php`
- [ ] Route caching works: `php artisan route:cache`
- [ ] Route model binding works (if used)

### Controllers
- [ ] No PHP syntax errors
- [ ] All imports correct
- [ ] Methods match routes
- [ ] Error handling implemented

### Views
- [ ] All Blade templates render
- [ ] No undefined variables
- [ ] CSS classes exist (Bootstrap)
- [ ] Font Awesome icons load

### Performance
- [ ] Page load time < 2 seconds
- [ ] Images load properly
- [ ] No console errors
- [ ] Responsive on mobile (375px)
- [ ] Responsive on tablet (768px)
- [ ] Responsive on desktop (1200px)

---

## 🎯 BROWSER COMPATIBILITY

Test on:
- [ ] Chrome (latest)
- [ ] Firefox (latest)
- [ ] Safari (latest)
- [ ] Edge (latest)
- [ ] Mobile Safari (iOS)
- [ ] Chrome Mobile (Android)

---

## 📝 NOTES DURING TESTING

### Issues Found:
1. _________________________________
2. _________________________________
3. _________________________________

### Fixed:
1. _________________________________
2. _________________________________
3. _________________________________

### To Improve:
1. _________________________________
2. _________________________________
3. _________________________________

---

## ✅ FINAL SIGN OFF

**All Tests Passed**: [ ] YES [ ] NO

**Ready for Production**: [ ] YES [ ] NO

**Tested By**: _______________
**Date**: _______________
**Time Spent**: _______________

**Overall Status**: ⏳ PENDING → ✅ PASSED → ⚠️ NEEDS FIXES

---

## 🚀 NEXT STEPS

After testing:
1. [ ] Deploy to staging
2. [ ] Run load testing
3. [ ] Security audit
4. [ ] Performance optimization
5. [ ] Deploy to production
6. [ ] Monitor in production
7. [ ] Gather user feedback
8. [ ] Iterate based on feedback

---

**PENTING**: Setiap fitur harus di-test satu per satu sesuai checklist ini. Jika ada yang tidak sesuai, catat di bagian "Issues Found" dan segera perbaiki sebelum lanjut ke fitur berikutnya.
