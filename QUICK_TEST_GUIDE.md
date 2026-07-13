# ⚡ QUICK TEST GUIDE - JAPLO APP

## 🚀 START TESTING (3 LANGKAH)

### 1️⃣ Start Server
```bash
php artisan serve
```
Atau double-click: `1_JALANKAN_INI.bat`

### 2️⃣ Buka Browser
```
http://localhost:8000
```
Atau double-click: `2_BUKA_BROWSER.bat`

### 3️⃣ Login
```
Email: demo@japlo.com
Password: password123
```

---

## 📱 TEST RESPONSIVE (QUICK)

### Method 1: Browser Resize
1. Buka fitur apapun
2. Resize browser dari lebar ke sempit
3. Check: Grid berubah? Text visible?

### Method 2: DevTools (RECOMMENDED)
```
1. Tekan F12
2. Tekan Ctrl+Shift+M (Toggle Device Toolbar)
3. Pilih preset device atau resize manual
4. Test semua fitur
```

**Device Presets:**
- iPhone SE (375x667) → Mobile
- iPad (768x1024) → Tablet  
- Desktop (1920x1080) → Desktop

---

## ✅ QUICK CHECKLIST PER FITUR

### 🏍️ OJEK/TAXI
```
□ 2 service cards tampil
□ Form booking lengkap
□ Radio buttons berfungsi
□ Calculator hitung estimasi
□ Submit → Alert & redirect
Mobile: □ Cards stack vertical
```

### 🍽️ KULINER
```
□ 8 restoran tampil
□ 6 kategori button
□ Promo banner tampil
□ 4 makanan populer
□ Floating cart button
Mobile: □ 1 restoran per row
Tablet: □ 2 restoran per row
Desktop: □ 3 restoran per row
```

### 📢 PROMOSI
```
□ 3 promo cards tampil
□ Copy kode promo berfungsi
□ Countdown timer berjalan
□ Referral code muncul
Mobile: □ Image di atas, content di bawah
Desktop: □ Image kiri, content kanan
```

### 🏥 KESEHATAN
```
□ 4 layanan kesehatan
□ Emergency button (119)
□ 3 artikel tampil
Mobile: □ 1 layanan per row, 1 artikel per row
Tablet: □ 2 layanan per row, 2 artikel per row
Desktop: □ 2 layanan per row, 3 artikel per row
```

### 🛍️ PRODUK
```
□ 6+ produk tampil
□ Badge diskon visible
□ Rating & sold count
□ Floating cart button
Mobile: □ 2 produk per row
Tablet: □ 3 produk per row
Desktop: □ 4 produk per row
```

### 🖨️ PENCETAKAN
```
□ 6 layanan tampil
□ Form pemesanan lengkap
□ Price calculator auto update
□ WhatsApp button
Mobile: □ 1 layanan per row
Tablet: □ 2 layanan per row
Desktop: □ 3 layanan per row
```

### 🔥 TRENDING
```
□ 4 konten trending
□ Ranking badge #1-#4
□ View counter
□ 8 hashtags
Mobile: □ Image full width di atas
Desktop: □ Image left, content right
```

### 👥 SOSIAL
```
□ Create post UI
□ 10+ stories horizontal scroll
□ 3 posts tampil
□ Like, comment, share buttons
□ 2 community groups
Mobile: □ Button text hide, icon only
Desktop: □ Button dengan text
```

---

## 🐛 COMMON ISSUES & FIXES

### Issue: "Route [customer.dashboard] not defined"
**Status:** ✅ FIXED - Semua route sudah benar

### Issue: Layout tidak responsive
**Status:** ✅ FIXED - Semua grid sudah responsive

### Issue: Floating button menghalangi content
**Status:** ✅ FIXED - Z-index sudah diatur

### Issue: Text terpotong di mobile
**Status:** ✅ FIXED - Pakai d-none d-sm-inline

### Issue: Images stretched
**Status:** ✅ FIXED - object-fit: cover

---

## 🎯 PASS CRITERIA

Setiap fitur PASS jika:
1. ✅ Halaman load tanpa error
2. ✅ Semua content visible
3. ✅ Buttons clickable & responsive
4. ✅ Grid adapt ke screen size
5. ✅ Back button → Dashboard
6. ✅ Forms submittable
7. ✅ No horizontal scroll
8. ✅ Text readable di mobile

---

## ⚡ SUPER QUICK TEST (5 MENIT)

```
1. Login ✓
2. Dashboard → 8 icon tampil ✓
3. Test 1 fitur (pilih random):
   - Desktop view: Full layout ✓
   - Mobile view (F12): Responsive ✓
   - Back button: Works ✓
4. Test submit form: Alert & redirect ✓
5. PASS! ✅
```

---

## 📊 EXPECTED RESULTS

### Desktop (> 992px):
- Kuliner: 3 kolom restaurant
- Produk: 4 kolom product
- Kesehatan: 3 kolom artikel
- Pencetakan: 3 kolom service
- Trending: 3 kolom konten
- Buttons: Full text visible

### Tablet (768-992px):
- Kuliner: 2 kolom restaurant
- Produk: 3 kolom product
- Kesehatan: 2 kolom artikel
- Pencetakan: 2 kolom service
- Trending: 2 kolom konten
- Buttons: Full text visible

### Mobile (< 768px):
- Kuliner: 1 kolom restaurant, 2 kolom items
- Produk: 2 kolom product
- Kesehatan: 1 kolom
- Pencetakan: 1 kolom
- Trending: 1 kolom
- Buttons: Icon only (text hide)

---

## 🔄 IF CACHE ISSUE

```bash
php artisan cache:clear
php artisan view:clear
php artisan config:clear
php artisan route:clear

# Restart browser & test again
```

---

## ✅ APPROVAL CHECKLIST

CEO/Manager Approval:
```
□ Semua 8 fitur bisa diakses
□ Design professional & modern
□ Responsive di mobile
□ User flow smooth
□ No broken features
□ Ready untuk demo client
```

Developer Approval:
```
□ No console errors
□ No 404 errors
□ All routes registered
□ All views exist
□ Bootstrap properly integrated
□ Code clean & maintainable
```

---

**RESULT: SIAP PRODUCTION** ✅

**Next:** Demo ke client / stakeholder
