# 📱 Fitur Order via WhatsApp & QRIS

## ✨ Deskripsi Fitur

Fitur pemesanan makanan/produk dengan 2 metode pembayaran:
1. **Via WhatsApp** - Pesan langsung ke admin via WhatsApp untuk konfirmasi
2. **Transfer QRIS** - Bayar langsung menggunakan scan QRIS (GoPay, OVO, Dana, dll)

---

## 🎯 Fitur Utama

### 1. Modal Order Detail
- Tampilan foto produk
- Input jumlah pesanan (quantity)
- Catatan pesanan (opsional)
- Kalkulasi total otomatis
- Pilihan metode pemesanan

### 2. Order Via WhatsApp
**Cara Kerja:**
- User klik tombol "Via WhatsApp"
- Aplikasi otomatis membuka WhatsApp dengan pesan yang sudah terformat
- Pesan berisi: nama produk, jumlah, harga, total, dan catatan
- Admin menerima pesan dan melakukan konfirmasi manual
- User menunggu balasan konfirmasi dari admin

**Format Pesan:**
```
*PESANAN JAPLO KULINER*

📦 *Pesanan:*
Nasi Goreng Spesial

📊 *Detail:*
Jumlah: 2x
Harga: Rp 25.000
Total: Rp 50.000

📝 *Catatan:*
Pedas level 5, tanpa sayuran

💳 *Metode:* Via WhatsApp

Mohon konfirmasi pesanan ini. Terima kasih! 🙏
```

### 3. Order Via QRIS
**Cara Kerja:**
- User klik tombol "Transfer QRIS"
- Modal QRIS terbuka dengan QR Code
- User scan QR Code menggunakan e-wallet
- User konfirmasi pembayaran di aplikasi
- User klik "Saya Sudah Bayar"
- Pesanan otomatis diproses

**Supported E-Wallet:**
- GoPay
- OVO
- Dana
- LinkAja
- ShopeePay
- Dan e-wallet lainnya yang support QRIS

---

## ⚙️ Konfigurasi

### 1. Setting Nomor WhatsApp Admin

Edit file `.env`:
```env
WHATSAPP_ADMIN_NUMBER=6281234567890
```

**Format Nomor:**
- Gunakan kode negara tanpa tanda `+`
- Indonesia: `62` + nomor (tanpa 0 di depan)
- Contoh: 
  - Nomor: 0812-3456-7890
  - Format: 6281234567890

### 2. Ganti Nomor di Kode

Buka file: `resources/views/customer/services/kuliner.blade.php`

Cari baris:
```javascript
const phoneNumber = '6281234567890'; // Ganti dengan nomor admin
```

Ganti dengan nomor WhatsApp admin yang sebenarnya.

### 3. Ganti QR Code QRIS

Buka file yang sama, cari:
```html
<img src="https://via.placeholder.com/250x250?text=QRIS+CODE" alt="QRIS">
```

Ganti dengan URL QR Code QRIS asli dari payment gateway Anda.

---

## 🚀 Cara Penggunaan

### Untuk User (Pelanggan):

1. **Buka halaman Kuliner** dari dashboard
2. **Klik tombol "Tambah"** pada makanan yang ingin dipesan
3. **Modal order terbuka** dengan detail:
   - Foto makanan
   - Nama makanan
   - Harga
   - Input jumlah (+ / -)
   - Textarea catatan
4. **Pilih metode pemesanan:**
   
   **A. Via WhatsApp:**
   - Klik tombol "Via WhatsApp"
   - Aplikasi WhatsApp terbuka otomatis
   - Pesan sudah terformat otomatis
   - Kirim pesan ke admin
   - Tunggu konfirmasi

   **B. Transfer QRIS:**
   - Klik tombol "Transfer QRIS"
   - Modal QRIS terbuka
   - Scan QR Code dengan e-wallet
   - Bayar sesuai total
   - Klik "Saya Sudah Bayar"
   - Pesanan diproses

### Untuk Admin:

**Order Via WhatsApp:**
1. Terima pesan order dari user di WhatsApp
2. Cek detail pesanan (nama, jumlah, total, catatan)
3. Balas dengan konfirmasi atau pertanyaan
4. Proses pesanan setelah konfirmasi

**Order Via QRIS:**
1. Cek notifikasi pembayaran dari payment gateway
2. Verifikasi pembayaran masuk
3. Proses pesanan otomatis
4. Kirim notifikasi ke user (opsional)

---

## 📋 Checklist Testing

### Test Order Via WhatsApp:
- [ ] Klik tombol "Tambah" pada makanan
- [ ] Modal order terbuka dengan benar
- [ ] Ubah quantity (tambah/kurang)
- [ ] Total harga update otomatis
- [ ] Isi catatan pesanan
- [ ] Klik "Via WhatsApp"
- [ ] WhatsApp terbuka dengan pesan terformat
- [ ] Pesan berisi data lengkap dan benar
- [ ] Nomor admin tujuan benar

### Test Order Via QRIS:
- [ ] Klik tombol "Tambah" pada makanan
- [ ] Modal order terbuka
- [ ] Klik "Transfer QRIS"
- [ ] Modal QRIS terbuka
- [ ] QR Code tampil
- [ ] Total harga benar
- [ ] Instruksi jelas
- [ ] Tombol "Kembali" berfungsi
- [ ] Tombol "Saya Sudah Bayar" berfungsi
- [ ] Alert konfirmasi muncul

### Test Responsiveness:
- [ ] Desktop (> 992px)
- [ ] Tablet (768px - 991px)
- [ ] Mobile (< 768px)
- [ ] Modal centered di semua ukuran
- [ ] Tombol accessible
- [ ] Teks terbaca dengan jelas

---

## 🎨 Customisasi

### Mengubah Warna Tema:

**WhatsApp Button (Hijau):**
```html
<button class="btn btn-outline-success">
```

**QRIS Button (Biru):**
```html
<button class="btn btn-outline-primary">
```

### Menambah Metode Pembayaran Lain:

Edit modal `orderModal`, tambah button baru:
```html
<div class="col-4">
    <button type="button" class="btn btn-outline-warning w-100 py-3" onclick="orderViaCOD()">
        <i class="fas fa-money-bill-wave fa-2x d-block mb-2"></i>
        <span class="fw-bold">COD</span>
        <small class="d-block text-muted">Bayar di tempat</small>
    </button>
</div>
```

Tambah fungsi JavaScript:
```javascript
function orderViaCOD() {
    // Logika order COD
    alert('Pesanan dengan metode COD berhasil!');
}
```

---

## 🔧 Troubleshooting

### WhatsApp tidak terbuka:
1. Pastikan format nomor benar (62xxx)
2. Pastikan browser support `window.open()`
3. Cek pop-up blocker browser
4. Test di device lain

### QRIS tidak scan:
1. Pastikan QR Code image valid
2. Pastikan URL image accessible
3. Test dengan QR Code asli dari payment gateway
4. Cek ukuran image (minimal 200x200px)

### Modal tidak muncul:
1. Cek console browser untuk error
2. Pastikan Bootstrap JS terload
3. Cek ID modal sesuai
4. Clear browser cache

---

## 📱 Fitur Tambahan (Opsional)

### 1. Integrasi Payment Gateway
- Midtrans
- Xendit
- Doku
- OY! Indonesia

### 2. Notifikasi Email
- Kirim email konfirmasi ke user
- Kirim email notifikasi ke admin

### 3. SMS Notification
- Kirim SMS konfirmasi order
- SMS update status pengiriman

### 4. Push Notification
- Real-time notification untuk admin
- Update status untuk user

---

## 📞 Kontak Support

Jika ada pertanyaan atau masalah:
- Email: support@japlo.com
- WhatsApp: 0812-3456-7890
- Website: https://japlo.com

---

**Dibuat untuk:** JAPLO App  
**Versi:** 1.0  
**Tanggal:** 15 Juli 2026  
**Update Terakhir:** 15 Juli 2026
