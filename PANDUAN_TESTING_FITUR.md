# 📖 Panduan Testing Fitur Dashboard Japlo

## 🚀 Persiapan

### 1. Start Server Laravel
```bash
cd "c:\xampp\htdocs\Japlo App"
php artisan serve
```

### 2. Akses Aplikasi
Buka browser dan akses: `http://localhost:8000`

### 3. Login
- Jika sudah punya akun customer, login dengan email dan password
- Jika belum, register sebagai customer terlebih dahulu

## 🧪 Testing Step by Step

### Dashboard Utama
✅ **Checklist:**
- [ ] Lihat 8 icon menu layanan tampil dengan rapi
- [ ] Hover pada setiap icon untuk melihat efek shadow
- [ ] Icon responsive di mobile dan desktop
- [ ] Statistik pesanan tampil dengan benar

### 1. 🏍️ Testing Fitur OJEK/TAXI

**Langkah:**
1. Klik icon **OJEK/TAXI** di dashboard
2. Pilih antara **JaploRide** (Motor) atau **JaploCar** (Mobil)
3. Isi form pemesanan:
   - Lokasi penjemputan
   - Lokasi tujuan
   - Catatan untuk driver (opsional)
4. Klik **"Hitung Estimasi Biaya"**
5. Lihat estimasi jarak, waktu, dan biaya
6. Klik **"Konfirmasi Pesanan"**

**Expected Result:**
- ✅ Estimasi biaya muncul setelah klik hitung
- ✅ Alert konfirmasi muncul setelah submit
- ✅ Redirect kembali ke dashboard

### 2. 🍽️ Testing Fitur KULINER

**Langkah:**
1. Klik icon **KULINER** di dashboard
2. Lihat daftar restoran terdekat
3. Klik kategori makanan (Fast Food, Ayam & Bebek, dll)
4. Klik **"Pesan Sekarang"** pada salah satu restoran
5. Tambah makanan populer ke keranjang
6. Klik floating button **"Keranjang"**

**Expected Result:**
- ✅ Restoran tampil dengan gambar, rating, jarak
- ✅ Badge promo terlihat pada restoran yang ada promo
- ✅ Alert muncul saat klik pesan/keranjang

### 3. 📢 Testing Fitur PROMOSI

**Langkah:**
1. Klik icon **IKLAN PROMOSI** di dashboard
2. Lihat daftar promo aktif
3. Klik **"Salin Kode"** pada salah satu promo
4. Klik **"Gunakan Sekarang"**
5. Scroll ke bawah untuk lihat Flash Sale countdown
6. Lihat kode referral pribadi Anda
7. Klik **"Salin"** pada kode referral

**Expected Result:**
- ✅ Kode promo berhasil disalin
- ✅ Countdown timer flash sale berjalan
- ✅ Kode referral unik untuk user

### 4. 🏥 Testing Fitur KESEHATAN

**Langkah:**
1. Klik icon **KESEHATAN** di dashboard
2. Lihat 4 layanan kesehatan
3. Klik **"Pesan Sekarang"** pada salah satu layanan
4. Klik emergency button **"Hubungi 119"**
5. Scroll ke bawah untuk baca artikel kesehatan

**Expected Result:**
- ✅ 4 layanan tampil dengan icon dan harga
- ✅ Alert konfirmasi pemesanan
- ✅ Emergency button dengan link telp 119
- ✅ Artikel kesehatan tampil dengan preview

### 5. 🛍️ Testing Fitur PRODUK

**Langkah:**
1. Klik icon **PRODUK** di dashboard
2. Lihat grid produk dengan harga diskon
3. Filter produk berdasarkan kategori
4. Klik **"Beli"** pada salah satu produk
5. Klik floating button **"Keranjang"**
6. Klik **"Muat Lebih Banyak"**

**Expected Result:**
- ✅ Produk tampil dengan badge diskon
- ✅ Rating dan jumlah terjual terlihat
- ✅ Alert saat tambah ke keranjang
- ✅ Filter kategori berfungsi

### 6. 🖨️ Testing Fitur PENCETAKAN

**Langkah:**
1. Klik icon **PENCETAKAN** di dashboard
2. Lihat 6 jenis layanan pencetakan
3. Klik **"Pesan Sekarang"** pada salah satu layanan
4. Isi form pemesanan:
   - Pilih jenis layanan
   - Isi jumlah
   - Upload file (UI only)
   - Pilih ukuran kertas, warna, orientasi
   - Pilih jenis jilid
5. Lihat estimasi biaya berubah otomatis
6. Klik **"Buat Pesanan"**
7. Test quick order via WhatsApp

**Expected Result:**
- ✅ Harga otomatis dihitung saat input berubah
- ✅ Form lengkap dengan semua opsi
- ✅ WhatsApp link berfungsi
- ✅ Alert konfirmasi pesanan

### 7. 🔥 Testing Fitur TRENDING

**Langkah:**
1. Klik icon **TRENDING** di dashboard
2. Lihat top trending dengan ranking
3. Klik filter kategori (Kuliner, Tempat, dll)
4. Klik **"Lihat Detail"** pada trending item
5. Scroll ke bawah untuk lihat konten lainnya
6. Klik hashtag trending topics

**Expected Result:**
- ✅ Ranking badge tampil (#1, #2, dst)
- ✅ View counter terlihat
- ✅ Engagement metrics (likes, comments, shares)
- ✅ Filter kategori berfungsi
- ✅ Hashtag dapat diklik

### 8. 👥 Testing Fitur SOSIAL

**Langkah:**
1. Klik icon **SOSIAL** di dashboard
2. Klik input "Apa yang Anda pikirkan..." untuk create post
3. Klik button Foto/Video/Polling
4. Scroll horizontal untuk lihat Stories
5. Klik **"Tambah Story"**
6. Lihat feed posts dari user lain
7. Klik **"Suka"** pada post
8. Klik **"Komentar"** untuk buka comment section
9. Klik **"Bagikan"** untuk share post
10. Klik **"Gabung"** pada grup komunitas

**Expected Result:**
- ✅ Create post modal (alert untuk demo)
- ✅ Stories horizontal scrollable
- ✅ Post feed dengan avatar dan konten
- ✅ Like, comment, share interactive
- ✅ Comment section toggle on/off
- ✅ Grup komunitas tampil

## 📱 Testing Responsive

### Mobile View (< 576px)
1. Buka browser developer tools (F12)
2. Toggle device toolbar (Ctrl + Shift + M)
3. Pilih device: iPhone, Samsung, dll
4. Test semua fitur di mobile view

**Expected Result:**
- ✅ Icon menu 4 kolom di mobile (2 baris)
- ✅ Semua card responsive
- ✅ Form input mudah diakses
- ✅ Button tidak terpotong
- ✅ Image responsive

### Tablet View (576px - 991px)
1. Set viewport width: 768px
2. Test semua fitur

**Expected Result:**
- ✅ Layout menyesuaikan lebar tablet
- ✅ Grid 2-3 kolom
- ✅ Navigation tetap accessible

### Desktop View (> 991px)
1. Set viewport full screen
2. Test semua fitur

**Expected Result:**
- ✅ Icon menu 8 kolom dalam 1 baris
- ✅ Grid 4 kolom untuk produk
- ✅ Spacing optimal
- ✅ Hover effects smooth

## 🐛 Bug Testing Checklist

### Navigation
- [ ] Tombol "Kembali" di setiap halaman berfungsi
- [ ] Redirect ke dashboard setelah submit form
- [ ] URL routing benar
- [ ] Link antar halaman tidak broken

### Forms
- [ ] Input validation (required fields)
- [ ] Alert muncul saat submit
- [ ] Form reset setelah submit
- [ ] Dropdown berfungsi
- [ ] Radio button selectable

### UI/UX
- [ ] Hover effects smooth
- [ ] Transition tidak lag
- [ ] Icon Font Awesome muncul
- [ ] Warna sesuai tema
- [ ] Text readable
- [ ] No overflow/scroll horizontal

### Browser Compatibility
Test di browser:
- [ ] Google Chrome
- [ ] Mozilla Firefox
- [ ] Microsoft Edge
- [ ] Safari (jika ada Mac)

## 📊 Performance Testing

### Load Time
- [ ] Dashboard load < 2 detik
- [ ] Service pages load < 1 detik
- [ ] No console errors
- [ ] Images load properly

### Interaction
- [ ] Button click responsive
- [ ] Form submission instant
- [ ] Scroll smooth
- [ ] No freeze/hang

## ✅ Test Result Summary

Setelah testing, isi checklist:

| Fitur | Status | Notes |
|-------|--------|-------|
| Dashboard Menu Icons | ⬜ Pass / ⬜ Fail | |
| Ojek/Taxi | ⬜ Pass / ⬜ Fail | |
| Kuliner | ⬜ Pass / ⬜ Fail | |
| Promosi | ⬜ Pass / ⬜ Fail | |
| Kesehatan | ⬜ Pass / ⬜ Fail | |
| Produk | ⬜ Pass / ⬜ Fail | |
| Pencetakan | ⬜ Pass / ⬜ Fail | |
| Trending | ⬜ Pass / ⬜ Fail | |
| Sosial | ⬜ Pass / ⬜ Fail | |
| Responsive Mobile | ⬜ Pass / ⬜ Fail | |
| Responsive Tablet | ⬜ Pass / ⬜ Fail | |
| Responsive Desktop | ⬜ Pass / ⬜ Fail | |

## 🔧 Troubleshooting

### Issue: Icon tidak muncul
**Solution:** Pastikan Font Awesome CDN loaded di layouts/app.blade.php

### Issue: Route tidak ditemukan (404)
**Solution:** 
```bash
php artisan route:clear
php artisan route:cache
```

### Issue: Controller error
**Solution:**
```bash
composer dump-autoload
php artisan config:clear
```

### Issue: View tidak update
**Solution:**
```bash
php artisan view:clear
php artisan cache:clear
```

## 📞 Support

Jika menemukan bug atau ada pertanyaan:
1. Check error log di `storage/logs/laravel.log`
2. Enable debug mode di `.env`: `APP_DEBUG=true`
3. Clear semua cache Laravel

## 🎉 Happy Testing!

Semua fitur sudah siap digunakan. Selamat mencoba! 🚀
