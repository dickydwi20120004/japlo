# 🔐 PANDUAN LOGIN & REGISTRASI - JAPLO APP v2.0

**Date:** 4 Agustus 2026  
**Status:** ✅ Complete  
**Update:** Database seeded dengan demo users

---

## 📌 QUICK START

### **Akses Aplikasi:**
```
URL: http://localhost:8000
Status: Server running
Database: Seeded dengan demo users
```

---

## 👥 DEMO USERS (SUDAH TERSEDIA)

Berikut adalah 3 demo users yang sudah dibuat dalam database:

### **1. 👨‍💼 ADMIN**
```
Email:    admin@japlo.com
Password: admin123
Role:     Admin
Access:   Admin Dashboard (/admin/dashboard)
```

**Fitur Admin:**
- ✅ Dashboard admin
- ✅ User management
- ✅ Driver management
- ✅ Order management
- ✅ Analytics & reports

---

### **2. 👤 CUSTOMER (Penumpang)**
```
Email:    demo@japlo.com
Password: password123
Role:     Customer/Penumpang
Access:   Customer Dashboard + 8 Services
```

**Fitur Customer:**
- ✅ Dashboard dengan 8 layanan
- ✅ Ojek/Taxi booking
- ✅ Kuliner (food delivery)
- ✅ Promosi & rewards
- ✅ Kesehatan (healthcare)
- ✅ E-commerce (produk)
- ✅ Pencetakan (printing)
- ✅ Trending content
- ✅ Social community

---

### **3. 🏍️ DRIVER**
```
Email:    driver@japlo.com
Password: password123
Role:     Driver
Access:   Driver Dashboard
Vehicle:  Honda Beat (Motor)
Status:   Verified & Available
```

**Info Driver:**
- ✅ Vehicle: Honda Beat (Motor)
- ✅ License Plate: B 1234 ABC
- ✅ Rating: 4.8/5.0
- ✅ Total Rides: 156
- ✅ Total Earnings: Rp 4.680.000
- ✅ Status: Verified & Available

**Fitur Driver:**
- ✅ Driver dashboard
- ✅ Order management
- ✅ Location tracking
- ✅ Availability toggle
- ✅ Statistics & earnings
- ✅ Profile management

---

## 🔐 CARA LOGIN

### **Langkah-langkah:**

1. **Buka Browser**
   ```
   URL: http://localhost:8000
   ```

2. **Klik "Masuk" atau "Login"**
   ```
   Atau langsung: http://localhost:8000/login
   ```

3. **Isi Email & Password**
   ```
   Email: demo@japlo.com
   Password: password123
   ```

4. **Centang "Ingat Saya" (Optional)**
   ```
   Untuk tetap login di kunjungan berikutnya
   ```

5. **Klik "Masuk" Button**
   ```
   Akan redirect ke dashboard sesuai role
   ```

6. **Berhasil! 🎉**
   ```
   Lihat dashboard dengan 8 icon services
   ```

---

## 📝 CARA REGISTRASI (DAFTAR SENDIRI)

**Jawaban:** YA, Anda bisa daftar sendiri sebagai customer atau driver!

### **Langkah Registrasi:**

1. **Buka Halaman Register**
   ```
   URL: http://localhost:8000/register
   ```

2. **Pilih Role**
   - ✅ **Penumpang** (Customer)
   - ✅ **Driver** (Sopir)

---

### **Option A: Daftar sebagai PENUMPANG**

**Langkah:**

1. Klik tombol "Daftar sebagai Penumpang"
2. Isi form:
   ```
   Nama Lengkap: ___________________
   Email: ___________________
   Nomor Telepon: ___________________
   Password: ___________________
   Konfirmasi Password: ___________________
   ```
3. Klik tombol "Daftar"
4. Akan otomatis login dan redirect ke dashboard

**Requirements:**
- ✅ Nama: minimum 1 karakter
- ✅ Email: harus valid & belum terdaftar
- ✅ Telepon: belum terdaftar
- ✅ Password: minimum 8 karakter
- ✅ Konfirmasi password harus cocok

**Setelah Berhasil:**
- ✅ Account dibuat dengan role: "user" (penumpang)
- ✅ Otomatis login
- ✅ Dapat akses 8 layanan customer

---

### **Option B: Daftar sebagai DRIVER**

**Langkah:**

1. Klik tombol "Daftar sebagai Driver"
2. Isi form personal:
   ```
   Nama Lengkap: ___________________
   Email: ___________________
   Nomor Telepon: ___________________
   Password: ___________________
   Konfirmasi Password: ___________________
   ```
3. Isi form data kendaraan:
   ```
   Jenis Kendaraan: [Motor / Mobil] ← pilih salah satu
   Merk Kendaraan: ___________________
   Nomor Plat: ___________________
   Nomor SIM: ___________________
   Alamat (optional): ___________________
   ```
4. Klik tombol "Daftar sebagai Driver"
5. Account dibuat dengan driver profile

**Requirements:**
- ✅ Personal data sama seperti penumpang
- ✅ Jenis kendaraan: Motor atau Mobil (required)
- ✅ Merk kendaraan: Harus diisi
- ✅ Nomor plat: Harus diisi (format: B 1234 ABC)
- ✅ Nomor SIM: Harus diisi

**Setelah Berhasil:**
- ✅ Account dibuat dengan role: "driver"
- ✅ Driver profile otomatis dibuat
- ✅ Status: Not Verified (perlu approval admin)
- ✅ Status: Not Available (default)
- ✅ Dapat akses driver dashboard

---

## 🔄 PERBANDINGAN LOGIN vs REGISTRASI

### **LOGIN (User sudah ada)**
```
Sudah punya akun?
  ↓
Buka: /login
  ↓
Isi email & password
  ↓
Klik "Masuk"
  ↓
Langsung ke dashboard
```

### **REGISTRASI (Daftar baru)**
```
Belum punya akun?
  ↓
Buka: /register
  ↓
Pilih role: Penumpang / Driver
  ↓
Isi form registrasi
  ↓
Klik "Daftar"
  ↓
Account dibuat
  ↓
Otomatis login
  ↓
Ke dashboard
```

---

## 🎯 TESTING SEMUA ROLE

### **Test 1: Login sebagai ADMIN**

```
1. Go to: http://localhost:8000/login
2. Email: admin@japlo.com
3. Password: admin123
4. Klik "Masuk"
5. Expected: Redirect ke /admin/dashboard
6. Lihat: Admin menu di navbar
```

**Admin Dashboard Features:**
- ✅ User Management (lihat semua users)
- ✅ Driver Management (lihat semua drivers)
- ✅ Order Management (lihat semua orders)
- ✅ Dashboard dengan analytics

---

### **Test 2: Login sebagai CUSTOMER**

```
1. Go to: http://localhost:8000/login
2. Email: demo@japlo.com
3. Password: password123
4. Klik "Masuk"
5. Expected: Redirect ke /dashboard
6. Lihat: 8 icon services
```

**Customer Dashboard Features:**
- ✅ Greeting: "Halo, Budi Penumpang! 👋"
- ✅ Stats: Total pesanan, perjalanan selesai
- ✅ 8 Service icons (clickable)
- ✅ Recent orders table

**Services Available:**
1. 🏍️ OJEK/TAXI
2. 🍽️ KULINER
3. 📢 PROMOSI
4. 🏥 KESEHATAN
5. 🛍️ PRODUK
6. 🖨️ PENCETAKAN
7. 🔥 TRENDING
8. 👥 SOSIAL

---

### **Test 3: Login sebagai DRIVER**

```
1. Go to: http://localhost:8000/login
2. Email: driver@japlo.com
3. Password: password123
4. Klik "Masuk"
5. Expected: Redirect ke /dashboard (driver view)
6. Lihat: Driver-specific dashboard
```

**Driver Dashboard Features:**
- ✅ Greeting: "Halo, Ahmad Driver! 👋"
- ✅ Vehicle info: Honda Beat
- ✅ Stats: Rating, total rides, earnings
- ✅ Available orders
- ✅ Recent trips
- ✅ Earnings summary

---

### **Test 4: Daftar Akun Baru sebagai PENUMPANG**

```
1. Go to: http://localhost:8000/register
2. Klik tombol "Daftar sebagai Penumpang"
3. Isi form:
   - Nama: "Siti Pelanggan"
   - Email: "siti@example.com"
   - Telepon: "082123456789"
   - Password: "password123"
   - Konfirmasi: "password123"
4. Klik "Daftar"
5. Expected: Login otomatis, redirect ke dashboard
6. Peran: Customer baru berhasil dibuat
```

**Verification:**
- ✅ Email harus unik (tidak bisa pakai email sudah terdaftar)
- ✅ Telepon harus unik
- ✅ Password minimum 8 karakter
- ✅ Account dibuat dengan role: "user"

---

### **Test 5: Daftar Akun Baru sebagai DRIVER**

```
1. Go to: http://localhost:8000/register
2. Klik tombol "Daftar sebagai Driver"
3. Isi form personal:
   - Nama: "Rudi Pengendara"
   - Email: "rudi@example.com"
   - Telepon: "083987654321"
   - Password: "password123"
   - Konfirmasi: "password123"
4. Isi form kendaraan:
   - Jenis: Motor
   - Merk: Yamaha Nmax
   - Plat: B 5678 XYZ
   - SIM: 1234567890123456
5. Klik "Daftar sebagai Driver"
6. Expected: Driver account created, login otomatis
7. Role: Driver baru berhasil dibuat
```

**Verification:**
- ✅ Data personal validated
- ✅ Data kendaraan tersimpan
- ✅ Driver profile otomatis dibuat
- ✅ Status: Not verified (needs admin approval)
- ✅ Status: Not available (default)

---

## 🔑 PASSWORD RULES

### **Password Requirements:**

**Minimum 8 Karakter:**
```
✅ Benar: "password123", "japan2024", "japlo@123"
❌ Salah: "pass", "123", "abc"
```

**Boleh mengandung:**
- ✅ Huruf (a-z, A-Z)
- ✅ Angka (0-9)
- ✅ Symbol (!@#$%^&*)
- ✅ Spasi

**Tidak ada restrictions lain:**
- ✅ Tidak perlu uppercase
- ✅ Tidak perlu special characters
- ✅ Tidak perlu angka
- ✅ Bisa semua lowercase

---

## 📋 FIELD VALIDATION

### **Registrasi Penumpang:**

| Field | Requirement | Contoh |
|-------|-------------|--------|
| Nama | Required | Budi Santoso |
| Email | Required, unique, valid format | budi@example.com |
| Telepon | Required, unique | 081234567890 |
| Password | Required, min 8 chars | password123 |
| Konfirmasi | Must match password | password123 |

### **Registrasi Driver (Added):**

| Field | Requirement | Contoh |
|-------|-------------|--------|
| Jenis Kendaraan | Required | Motor / Mobil |
| Merk Kendaraan | Required | Honda Beat |
| Nomor Plat | Required | B 1234 ABC |
| Nomor SIM | Required | 1234567890987654 |
| Alamat | Optional | Jl. Merdeka No. 123 |

---

## ⚠️ ERROR MESSAGES

### **Login Errors:**

```
❌ "Email atau password salah!"
   → Email atau password tidak sesuai
   → Solution: Check huruf besar/kecil, spasi

❌ "Email harus diisi"
   → Field email kosong
   → Solution: Isi email

❌ "Password harus diisi"
   → Field password kosong
   → Solution: Isi password
```

### **Registrasi Errors:**

```
❌ "Email sudah terdaftar"
   → Email sudah dipakai user lain
   → Solution: Gunakan email yang berbeda

❌ "Nomor telepon sudah terdaftar"
   → Telepon sudah dipakai user lain
   → Solution: Gunakan telepon yang berbeda

❌ "Password minimal 8 karakter"
   → Password kurang dari 8 karakter
   → Solution: Gunakan password minimal 8 karakter

❌ "Konfirmasi password tidak cocok"
   → Password dan konfirmasi password berbeda
   → Solution: Pastikan password sama

❌ "Jenis kendaraan harus dipilih"
   → Belum pilih motor atau mobil
   → Solution: Pilih salah satu jenis kendaraan
```

---

## 🔐 LUPA PASSWORD

### **Cara Reset Password:**

1. **Buka halaman forgot password**
   ```
   URL: http://localhost:8000/forgot-password
   ```

2. **Masukkan email Anda**
   ```
   Email: email@example.com
   ```

3. **Klik "Kirim Link Reset"**
   ```
   Link akan dikirim ke email Anda
   (Demo mode: langsung ke reset page)
   ```

4. **Buka link dari email**
   ```
   Akan redirect ke password reset page
   ```

5. **Isi password baru**
   ```
   Password baru: _______________
   Konfirmasi: _______________
   ```

6. **Klik "Reset Password"**
   ```
   Password berhasil direset
   Redirect ke login page
   ```

7. **Login dengan password baru**
   ```
   Email: email@example.com
   Password: (password yang baru)
   ```

---

## 📱 MULTI-DEVICE LOGIN

### **Bisa Login di Multiple Devices:**

- ✅ Login di laptop
- ✅ Logout dari laptop
- ✅ Login di mobile
- ✅ Logout dari mobile
- ✅ Kembali login di laptop

**Catatan:**
- ✅ Session per device (tidak conflict)
- ✅ Bisa multiple sessions jika diinginkan
- ✅ Logout hanya dari device itu sendiri

---

## 🔄 LOGOUT

### **Cara Logout:**

1. **Klik nama user** (top-right navbar)
2. **Pilih "Logout"** dari dropdown
3. **Akan redirect ke home page**
4. **Session dihapus**
5. **Harus login lagi untuk akses**

---

## 🎯 SUMMARY

### **Quick Reference:**

| Action | URL | Steps |
|--------|-----|-------|
| Login | `/login` | Email → Password → Submit |
| Register (Customer) | `/register` | Nama, Email, Telepon, Password → Submit |
| Register (Driver) | `/register` | +Jenis, Merk, Plat, SIM → Submit |
| Lupa Password | `/forgot-password` | Email → Link → New Password → Submit |
| Logout | (dari dashboard) | Menu → Logout |

---

## 🧪 TESTING CHECKLIST

- [ ] Login dengan admin@japlo.com / admin123
- [ ] Login dengan demo@japlo.com / password123
- [ ] Login dengan driver@japlo.com / password123
- [ ] Daftar akun baru sebagai penumpang
- [ ] Daftar akun baru sebagai driver
- [ ] Test error messages (email sudah terdaftar)
- [ ] Test password validation (< 8 chars)
- [ ] Test logout functionality
- [ ] Test multi-device login
- [ ] Test forgot password flow
- [ ] Test "Remember Me" checkbox
- [ ] Test responsive design (mobile)

---

## 💡 TIPS

### **Login Tips:**
- ✅ Gunakan demo account untuk testing cepat
- ✅ Jangan lupa check "Remember Me" jika ingin tetap login
- ✅ Gunakan incognito mode untuk clear cache

### **Registrasi Tips:**
- ✅ Email harus unik (beda dengan user lain)
- ✅ Gunakan telepon yang unik juga
- ✅ Password minimal 8 karakter untuk security
- ✅ Catat password Anda di tempat aman

### **Multi-Role Testing:**
- ✅ Admin: Gunakan untuk manage users & orders
- ✅ Customer: Gunakan untuk test 8 services
- ✅ Driver: Gunakan untuk test driver features
- ✅ Bisa buat akun baru untuk testing

---

## 🚀 NEXT STEPS

1. **Test login** dengan salah satu demo account
2. **Explore dashboard** sesuai role
3. **Daftar akun baru** untuk test registrasi
4. **Test semua features** di setiap role
5. **Report bugs** jika ada issues

---

## 📞 SUPPORT

Jika ada pertanyaan:

1. Check ini file dulu
2. Lihat error messages
3. Check browser console (F12)
4. Check Laravel logs

---

**Created by:** Kiro AI Assistant  
**Date:** 4 Agustus 2026  
**Last Updated:** 4 Agustus 2026  
**Status:** ✅ Complete

Made with ❤️ for easy onboarding
