# ⚡ Tips Optimasi Kecepatan JAPLO App

## 🔍 Penyebab Lambat Loading

### 1. **Gambar dari Internet (via.placeholder.com)**
- Gambar di-load dari server eksternal
- Tergantung koneksi internet
- Solusi: Gunakan gambar lokal atau optimasi

### 2. **Cache Belum Optimal**
- Route cache belum di-set
- View cache belum di-set
- Config cache belum di-set

### 3. **Development Mode**
- APP_DEBUG=true (lebih lambat)
- Tidak ada cache optimization

---

## ✅ Solusi yang Sudah Diterapkan

### 1. **Lazy Loading Gambar**
Ditambahkan `loading="lazy"` pada semua tag `<img>`:
```html
<img src="..." loading="lazy">
```

**Manfaat:**
- Gambar di bawah layar tidak langsung di-load
- Prioritas loading konten yang terlihat dulu
- Hemat bandwidth

### 2. **Cache Optimization**
Command yang dijalankan:
```bash
php artisan optimize:clear  # Clear semua cache
php artisan config:cache    # Cache config
php artisan route:cache     # Cache routes
php artisan view:cache      # Cache views
```

### 3. **Server Restart**
Server di-restart ulang agar perubahan efektif.

---

## 🚀 Optimasi Tambahan (Opsional)

### 1. **Ganti Gambar dengan Local Files**

**Cara:**
1. Buat folder `public/images/kuliner/`
2. Simpan gambar makanan di sana
3. Update controller:

```php
'image' => asset('images/kuliner/ayam-geprek.jpg'),
```

**Keuntungan:**
- Loading super cepat
- Tidak tergantung internet
- Ukuran file bisa dikontrol

### 2. **Compress Gambar**

Gunakan tools:
- TinyPNG (https://tinypng.com)
- ImageOptim
- Squoosh (https://squoosh.app)

**Target:**
- Ukuran < 100KB per gambar
- Format: WebP atau JPEG optimized

### 3. **Enable PHP OpCache**

Edit `php.ini`:
```ini
opcache.enable=1
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=10000
opcache.revalidate_freq=2
```

Restart Apache/PHP-FPM setelah edit.

### 4. **Database Optimization**

Jalankan command:
```bash
php artisan db:seed --class=CacheSeeder  # Jika ada
php artisan migrate:fresh --seed         # Reset DB
```

### 5. **CDN untuk Assets**

Gunakan CDN untuk Bootstrap, Font Awesome:
```html
<!-- Bootstrap CSS dari CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<!-- Font Awesome dari CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
```

### 6. **Minify CSS & JS**

Install package:
```bash
npm install --save-dev laravel-mix
npm run production
```

Edit `webpack.mix.js`:
```javascript
mix.js('resources/js/app.js', 'public/js').minify('public/js/app.js');
mix.sass('resources/sass/app.scss', 'public/css').minify('public/css/app.css');
```

---

## 📊 Performance Checklist

### Cek di Browser (F12 → Network Tab):

- [ ] Total loading time < 3 detik
- [ ] Ukuran total < 2MB
- [ ] Gambar ter-compress baik
- [ ] CSS/JS di-minify
- [ ] No error 404
- [ ] No warning di console

### Cek di Server:

- [ ] PHP version ≥ 8.0
- [ ] OpCache enabled
- [ ] Memory limit ≥ 256M
- [ ] Max execution time ≥ 30s

### Cek di Database:

- [ ] Indexes ada di kolom yang sering di-query
- [ ] No N+1 query problem
- [ ] Connection pool optimal

---

## 🛠️ Command Quick Reference

### Development (Cepat tapi tanpa cache):
```bash
php artisan optimize:clear
php artisan serve
```

### Production-like (Lebih lambat tapi ada cache):
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan serve
```

### Reset Semua:
```bash
php artisan optimize:clear
composer dump-autoload
php artisan serve
```

---

## 🔧 Troubleshooting

### Masih Lambat Setelah Optimasi:

1. **Clear Browser Cache**
   - Chrome: Ctrl + Shift + Delete
   - Firefox: Ctrl + Shift + Delete
   - Edge: Ctrl + Shift + Delete

2. **Cek Koneksi Internet**
   ```bash
   ping google.com
   ```

3. **Cek PHP Memory**
   Edit `php.ini`:
   ```ini
   memory_limit = 512M
   ```

4. **Restart XAMPP**
   - Stop Apache
   - Stop MySQL
   - Start lagi

5. **Ganti Port**
   ```bash
   php artisan serve --port=8001
   ```

6. **Hard Refresh Browser**
   - Chrome/Edge: Ctrl + Shift + R
   - Firefox: Ctrl + F5

---

## 📈 Target Performance

### Loading Time:
- ✅ **Excellent**: < 2 detik
- ✅ **Good**: 2-3 detik
- ⚠️ **Average**: 3-5 detik
- ❌ **Poor**: > 5 detik

### Page Size:
- ✅ **Excellent**: < 500KB
- ✅ **Good**: 500KB - 1MB
- ⚠️ **Average**: 1MB - 2MB
- ❌ **Poor**: > 2MB

### Requests:
- ✅ **Excellent**: < 20 requests
- ✅ **Good**: 20-40 requests
- ⚠️ **Average**: 40-60 requests
- ❌ **Poor**: > 60 requests

---

## 💡 Pro Tips

1. **Gunakan Chrome DevTools**
   - F12 → Network → Disable cache
   - F12 → Performance → Record loading

2. **Test dengan Slow 3G**
   - F12 → Network → Throttling → Slow 3G
   - Lihat bagaimana loading di koneksi lambat

3. **Lighthouse Audit**
   - F12 → Lighthouse → Generate report
   - Follow rekomendasi yang diberikan

4. **Monitor dengan Laravel Telescope**
   ```bash
   composer require laravel/telescope
   php artisan telescope:install
   php artisan migrate
   ```

---

**Dibuat untuk:** JAPLO App  
**Versi:** 1.0  
**Tanggal:** 15 Juli 2026
