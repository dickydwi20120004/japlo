# ✅ CHECKLIST TESTING - JAPLO APP

## 🎯 QUICK TESTING GUIDE

Gunakan checklist ini untuk memastikan semua fitur berfungsi dengan baik.

---

## 📋 PRE-TESTING

### Setup:
- [ ] Server running: `1_JALANKAN_INI.bat` atau `php artisan serve`
- [ ] Browser terbuka: http://localhost:8000
- [ ] Login berhasil: demo@japlo.com / password123
- [ ] Dashboard tampil dengan 8 icon

---

## 🏍️ 1. OJEK/TAXI

**URL:** http://localhost:8000/customer/ojek

### Test Checklist:
- [ ] Halaman terbuka tanpa error
- [ ] Header "Ojek & Taxi Online" tampil
- [ ] Tombol "Kembali" ada dan berfungsi → Dashboard
- [ ] 2 Card service tampil: JaploRide & JaploCar
- [ ] Tarif tampil: Rp 5.000/km (motor), Rp 8.000/km (mobil)
- [ ] Tombol "Pesan Sekarang" ada di kedua card

### Form Booking:
- [ ] Radio button Motor/Mobil bisa diklik
- [ ] Input lokasi penjemputan bisa diisi
- [ ] Input lokasi tujuan bisa diisi
- [ ] Link "Gunakan lokasi saat ini" berfungsi (geolocation)
- [ ] Textarea catatan bisa diisi
- [ ] Estimasi awal: "- km", "- menit", "Rp 0"

### Calculator:
- [ ] Klik "Hitung Estimasi Biaya"
- [ ] Jarak random muncul (1-11 km)
- [ ] Waktu estimasi muncul
- [ ] Harga total muncul dan benar (jarak × tarif)

### Submit:
- [ ] Klik "Konfirmasi Pesanan"
- [ ] Alert success muncul
- [ ] Redirect ke Dashboard

### Responsive:
- [ ] Resize browser → layout menyesuaikan
- [ ] Card stack di mobile view

**RESULT:** ☐ PASS ☐ FAIL

---

## 🍽️ 2. KULINER

**URL:** http://localhost:8000/customer/kuliner

### Test Checklist:
- [ ] Halaman terbuka tanpa error
- [ ] Header "Kuliner & Makanan" tampil
- [ ] Tombol "Kembali" berfungsi → Dashboard
- [ ] Search bar tampil di atas
- [ ] Banner promo "Gratis Ongkir min. Rp 50.000" tampil

### Restaurant List:
- [ ] 8 restoran tampil:
  - [ ] Ayam Geprek Bensu (4.5⭐, 2.3km, Diskon 20%)
  - [ ] Bakso President (4.7⭐, 1.5km)
  - [ ] Kopi Kenangan (4.8⭐, 0.8km, Beli 2 Gratis 1)
  - [ ] Nasi Goreng Kambing (4.6⭐, 3.2km)
  - [ ] +4 restoran lainnya
- [ ] Rating bintang tampil
- [ ] Jarak tampil
- [ ] Badge promo tampil (jika ada)

### Categories:
- [ ] 6 Kategori tampil:
  - [ ] Fast Food
  - [ ] Ayam & Bebek
  - [ ] Nasi
  - [ ] Minuman
  - [ ] Dessert
  - [ ] Lainnya

### Makanan Populer:
- [ ] 4 makanan populer tampil dengan gambar
- [ ] Harga tampil
- [ ] Tombol "Pesan" berfungsi → Alert

### Floating Button:
- [ ] Shopping cart button di pojok kanan bawah
- [ ] Klik → Alert

**RESULT:** ☐ PASS ☐ FAIL

---

## 📢 3. IKLAN & PROMOSI

**URL:** http://localhost:8000/customer/promosi

### Test Checklist:
- [ ] Halaman terbuka tanpa error
- [ ] Header "Iklan & Promosi" tampil
- [ ] Tombol "Kembali" berfungsi → Dashboard

### Promo Cards:
- [ ] 3 Promo tampil:
  - [ ] Flash Sale! Diskon 50%
  - [ ] Gratis Ongkir Kuliner
  - [ ] Cashback 100%
- [ ] Banner gambar tampil
- [ ] Kategori badge tampil
- [ ] Valid until date tampil
- [ ] Tombol "Salin Kode" ada
- [ ] Tombol "Gunakan Sekarang" ada

### Copy Kode Promo:
- [ ] Klik "Salin Kode"
- [ ] Alert "Kode promo berhasil disalin" muncul
- [ ] Paste (Ctrl+V) → kode muncul

### Flash Sale Timer:
- [ ] Countdown timer tampil
- [ ] Format: HH:MM:SS
- [ ] Timer berjalan real-time (detik berkurang)
- [ ] Jika di luar jam 10:00-16:00 → "Flash Sale berakhir"

### Referral Program:
- [ ] Card "Ajak Teman" tampil
- [ ] Kode referral unik muncul: JAPLO{id}REF
- [ ] Tombol "Salin Kode Referral"
- [ ] Klik → Alert berhasil disalin
- [ ] Bonus Rp 50.000 info tampil

### Submit:
- [ ] Klik "Gunakan Sekarang"
- [ ] Alert success muncul

**RESULT:** ☐ PASS ☐ FAIL

---

## 🏥 4. KESEHATAN

**URL:** http://localhost:8000/customer/kesehatan

### Test Checklist:
- [ ] Halaman terbuka tanpa error
- [ ] Header "Kesehatan" tampil
- [ ] Tombol "Kembali" berfungsi → Dashboard
- [ ] Emergency call button (119) tampil merah di header

### Health Services:
- [ ] 4 Layanan tampil:
  - [ ] Konsultasi Dokter Online (Rp 50.000)
  - [ ] Apotek & Obat
  - [ ] Tes Lab & Kesehatan (Rp 150.000)
  - [ ] Panggil Perawat (Rp 100.000)
- [ ] Icon FontAwesome tampil
- [ ] Deskripsi lengkap
- [ ] Harga tampil
- [ ] Tombol "Pesan Layanan" berfungsi → Alert

### Emergency Button:
- [ ] Klik tombol "Darurat (119)"
- [ ] Alert konfirmasi muncul

### Artikel Kesehatan:
- [ ] 3 Artikel tampil:
  - [ ] "10 Tips Hidup Sehat di Era Modern"
  - [ ] "Pentingnya Vaksinasi untuk Keluarga"
  - [ ] "Panduan Nutrisi Seimbang"
- [ ] Tanggal publish tampil
- [ ] Views count tampil
- [ ] Tombol "Baca Selengkapnya" → Alert

**RESULT:** ☐ PASS ☐ FAIL

---

## 🛍️ 5. PRODUK (E-Commerce)

**URL:** http://localhost:8000/customer/produk

### Test Checklist:
- [ ] Halaman terbuka tanpa error
- [ ] Header "Produk & Belanja" tampil
- [ ] Tombol "Kembali" berfungsi → Dashboard
- [ ] Search bar tampil
- [ ] Flash sale banner tampil

### Product Grid:
- [ ] 6+ Produk tampil:
  - [ ] Samsung Galaxy A54 (Rp 5.499.000, -8%)
  - [ ] Nike Air Max (Rp 1.299.000, -24%)
  - [ ] ASUS ROG Laptop (Rp 15.999.000, -11%)
  - [ ] Tas Ransel Eiger (Rp 359.000, -28%)
  - [ ] +2 produk lainnya
- [ ] Gambar produk tampil
- [ ] Harga asli (coret) tampil
- [ ] Harga diskon tampil
- [ ] Badge diskon persentase tampil (merah)
- [ ] Rating bintang tampil
- [ ] Sold count tampil

### Categories:
- [ ] 5 Kategori tampil:
  - [ ] Elektronik
  - [ ] Fashion
  - [ ] Rumah Tangga
  - [ ] Buku
  - [ ] Olahraga
- [ ] Klik kategori → filter (UI ready)

### Features:
- [ ] 4 Keunggulan tampil:
  - [ ] 100% Aman & Terpercaya
  - [ ] Gratis Ongkir
  - [ ] Mudah Return 7 Hari
  - [ ] CS 24/7

### Floating Button:
- [ ] Shopping cart button pojok kanan bawah
- [ ] Badge counter "0" tampil
- [ ] Klik → Alert

### Submit:
- [ ] Klik "Beli Sekarang"
- [ ] Alert success muncul

**RESULT:** ☐ PASS ☐ FAIL

---

## 🖨️ 6. PENCETAKAN

**URL:** http://localhost:8000/customer/pencetakan

### Test Checklist:
- [ ] Halaman terbuka tanpa error
- [ ] Header "Layanan Pencetakan" tampil
- [ ] Tombol "Kembali" berfungsi → Dashboard

### Services List:
- [ ] 6 Layanan tampil:
  - [ ] Print Dokumen (Rp 500/lembar)
  - [ ] Fotocopy (Rp 200/lembar)
  - [ ] Scan Dokumen (Rp 1.000/lembar)
  - [ ] Cetak Foto (Rp 2.000/lembar)
  - [ ] Jilid & Laminating (Rp 5.000)
  - [ ] Cetak Banner & Spanduk (Rp 50.000)
- [ ] Icon tampil
- [ ] Harga start tampil
- [ ] Deskripsi tampil

### Form Pemesanan:
- [ ] Dropdown "Jenis Layanan" berfungsi (6 options)
- [ ] File upload button tampil
- [ ] Dropdown "Ukuran Kertas" (A4, A3, Letter, Legal)
- [ ] Input "Jumlah Halaman" bisa diisi
- [ ] Radio "Warna" (Hitam Putih / Berwarna)
- [ ] Radio "Orientasi" (Portrait / Landscape)
- [ ] Dropdown "Jilid" (None, Spiral, Hardcover, Softcover)
- [ ] Textarea "Catatan" bisa diisi
- [ ] Input "Nama" bisa diisi
- [ ] Input "No. HP" bisa diisi

### Price Calculator:
- [ ] Estimasi biaya: "Rp 0" saat awal
- [ ] Ubah jumlah halaman → harga update otomatis
- [ ] Ubah warna → harga update otomatis
- [ ] Pilih jilid → harga update otomatis
- [ ] Calculation logic benar:
  - Print Dokumen: jumlah × 500 (HitamPutih) atau × 1000 (Berwarna)
  - Fotocopy: jumlah × 200
  - Scan: jumlah × 1000
  - Cetak Foto: jumlah × 2000
  - Jilid: base + jilid price
  - Banner: base 50000

### WhatsApp Quick Order:
- [ ] Tombol WhatsApp hijau tampil
- [ ] Klik → Open WhatsApp (browser/app)

### Features:
- [ ] 4 Keunggulan tampil:
  - [ ] Cepat (15-30 menit)
  - [ ] Berkualitas Tinggi
  - [ ] Antar Jemput
  - [ ] Harga Terjangkau

### Submit:
- [ ] Klik "Pesan Sekarang"
- [ ] Validation bekerja (nama & HP required)
- [ ] Alert success muncul
- [ ] Redirect ke Dashboard

**RESULT:** ☐ PASS ☐ FAIL

---

## 🔥 7. TRENDING

**URL:** http://localhost:8000/customer/trending

### Test Checklist:
- [ ] Halaman terbuka tanpa error
- [ ] Header "Trending & Populer" tampil
- [ ] Tombol "Kembali" berfungsi → Dashboard

### Top Trending:
- [ ] 4 Konten trending tampil:
  - [ ] #1 - Cafe Aesthetic (15.420 views)
  - [ ] #2 - Tips Hemat Transportasi (12.850 views)
  - [ ] #3 - Promo 7.7 Shopping (11.230 views)
  - [ ] #4 - Restoran Viral (9.560 views)
- [ ] Ranking badge tampil (#1, #2, #3, #4)
- [ ] Gambar banner tampil
- [ ] Kategori badge tampil
- [ ] View counter tampil
- [ ] Tombol "Lihat Detail" → Alert

### Categories Filter:
- [ ] 4 Kategori tampil:
  - [ ] Kuliner
  - [ ] Tempat
  - [ ] Promosi
  - [ ] Tips & Trik
- [ ] Klik kategori (UI ready for filtering)

### Community Picks:
- [ ] 3 Konten community picks tampil
- [ ] Engagement metrics tampil (likes, comments, shares)
- [ ] Tombol social berfungsi

### Trending Hashtags:
- [ ] 8 Hashtags tampil:
  - #CafeAesthetic #PromoHariIni #MakananViral #TempatWisata 
  - #TipsHemat #JaploFood #JaploRide #FlashSale
- [ ] Hashtag clickable (UI ready)

### Konten Lainnya:
- [ ] 3 Konten grid tampil
- [ ] View count tampil

**RESULT:** ☐ PASS ☐ FAIL

---

## 👥 8. SOSIAL (Social Media)

**URL:** http://localhost:8000/customer/sosial

### Test Checklist:
- [ ] Halaman terbuka tanpa error
- [ ] Header "Sosial & Komunitas" tampil
- [ ] Tombol "Kembali" berfungsi → Dashboard

### Create Post:
- [ ] Card "Buat Postingan Baru" tampil
- [ ] Textarea "Apa yang Anda pikirkan?" ada
- [ ] 4 Tombol post type:
  - [ ] Text Post
  - [ ] Foto
  - [ ] Video
  - [ ] Polling
- [ ] Klik tombol → Alert "Fitur akan segera hadir"

### Stories Feed:
- [ ] Stories scroll horizontal
- [ ] 10+ Stories tampil:
  - [ ] "Tambah Story" (user sendiri) + button
  - [ ] 9+ User stories dengan avatar & nama
- [ ] Klik "Tambah Story" → Alert
- [ ] Klik user story → Alert preview

### Feed Posts:
- [ ] 3 Posts tampil:
  - [ ] Post 1: Ahmad Rizki (45 likes, 12 comments)
  - [ ] Post 2: Siti Nurhaliza (128 likes, 34 comments, dengan gambar)
  - [ ] Post 3: Budi Santoso (23 likes, 8 comments)
- [ ] Avatar user tampil (UI Avatars)
- [ ] Nama user tampil
- [ ] Waktu post tampil ("2 jam yang lalu", dll)
- [ ] Konten text tampil
- [ ] Gambar tampil (jika ada)

### Post Interactions:
- [ ] Tombol Like ❤️ ada
- [ ] Counter likes tampil
- [ ] Klik Like → Alert (UI ready for increment)
- [ ] Tombol Comment 💬 ada
- [ ] Counter comments tampil
- [ ] Klik Comment → Toggle comment section
- [ ] Comment section expand/collapse
- [ ] Tombol Share 🔄 ada
- [ ] Klik Share → Alert

### Comment Section (Post 2):
- [ ] 2 Sample comments tampil
- [ ] Avatar commenter tampil
- [ ] Nama & waktu tampil
- [ ] Konten comment tampil
- [ ] Input "Tulis komentar" ada
- [ ] Tombol "Kirim" berfungsi

### Community Groups:
- [ ] 2 Groups tampil:
  - [ ] Komunitas Driver Japlo (1.234 anggota)
  - [ ] Kuliner Lovers Japlo (5.678 anggota)
- [ ] Icon group tampil
- [ ] Member count tampil
- [ ] Tombol "Gabung" → Alert

**RESULT:** ☐ PASS ☐ FAIL

---

## 🎯 OVERALL TESTING

### Navigation:
- [ ] Dashboard → Semua fitur (8/8) berfungsi
- [ ] Semua fitur → Dashboard berfungsi
- [ ] No broken links
- [ ] No 404 errors

### UI/UX:
- [ ] Design konsisten di semua halaman
- [ ] Colors sesuai brand Japlo
- [ ] Icons FontAwesome load semua
- [ ] Spacing & padding rapi
- [ ] Typography readable

### Responsive:
- [ ] Desktop (1920×1080) ✓
- [ ] Laptop (1366×768) ✓
- [ ] Tablet (768×1024) ✓
- [ ] Mobile (375×667) ✓

### Performance:
- [ ] Loading time <2 detik
- [ ] No JavaScript errors (F12 console)
- [ ] No CSS errors
- [ ] Smooth scrolling
- [ ] Hover effects smooth

### Functionality:
- [ ] All forms submittable
- [ ] All buttons clickable
- [ ] All inputs fillable
- [ ] All alerts working
- [ ] All redirects working

---

## 📊 TESTING SUMMARY

```
Total Features:    8
Features Tested:   [ ]/8
Features Passed:   [ ]/8
Features Failed:   [ ]/8

Pass Rate:         [ ]%
```

### Issues Found:
1. ________________________________________________
2. ________________________________________________
3. ________________________________________________

### Notes:
________________________________________________
________________________________________________
________________________________________________

---

## ✅ FINAL VERDICT

☐ **READY FOR DEMO** - All features working perfectly  
☐ **MINOR ISSUES** - Some small bugs, but usable  
☐ **MAJOR ISSUES** - Significant problems found

**Tested By:** _______________________  
**Date:** _______________________  
**Browser:** _______________________  
**Device:** _______________________

---

**INSTRUKSI:**
1. Centang (✓) setiap item setelah di-test
2. Catat issues di bagian "Issues Found"
3. Isi testing summary
4. Tandai final verdict

**GOAL:** Minimal 95% pass rate untuk production ready!
