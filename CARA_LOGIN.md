# 🔐 Cara Login ke Japlo App

## 🚨 MASALAH: "Login di browser gabisa"

### Penyebab Umum:
1. ❌ Server Laravel belum dijalankan
2. ❌ Database belum di-migrate
3. ❌ XAMPP MySQL belum running
4. ❌ Tidak tahu kredensial login

## ✅ SOLUSI LENGKAP

### Step 1: Pastikan XAMPP MySQL Running

1. Buka **XAMPP Control Panel**
2. Klik **Start** pada **Apache** (opsional)
3. Klik **Start** pada **MySQL** (PENTING!)
4. Pastikan statusnya **Running** (hijau)

### Step 2: Start Laravel Server

Buka **Command Prompt** atau **PowerShell** dan jalankan:

```bash
cd "c:\xampp\htdocs\Japlo App"
php artisan serve
```

**Output yang benar:**
```
INFO  Server running on [http://127.0.0.1:8000].

Press Ctrl+C to stop the server
```

⚠️ **JANGAN TUTUP WINDOW INI!** Server harus tetap running.

### Step 3: Akses di Browser

Buka browser dan ketik:
```
http://localhost:8000
```

atau

```
http://127.0.0.1:8000
```

### Step 4: Klik "Login"

Di halaman home, klik tombol **"Masuk"** atau **"Login"**

Atau langsung akses:
```
http://localhost:8000/login
```

### Step 5: Login dengan Kredensial Demo

Saya sudah membuatkan 2 user demo untuk Anda:

#### 👤 Login sebagai CUSTOMER (Penumpang)
```
Email: demo@japlo.com
Password: password123
```

#### 🏍️ Login sebagai DRIVER
```
Email: driver@japlo.com
Password: password123
```

### Step 6: Setelah Login

Anda akan melihat **Dashboard** dengan **8 icon menu layanan**:
1. 🏍️ OJEK/TAXI
2. 🍽️ KULINER
3. 📢 PROMOSI
4. 🏥 KESEHATAN
5. 🛍️ PRODUK
6. 🖨️ PENCETAKAN
7. 🔥 TRENDING
8. 👥 SOSIAL

Klik salah satu icon untuk mengakses fitur tersebut!

---

## 🔧 Troubleshooting

### Problem 1: "Connection refused" atau "Unable to connect"

**Solusi:**
```bash
# Pastikan server Laravel running
cd "c:\xampp\htdocs\Japlo App"
php artisan serve
```

### Problem 2: "SQLSTATE[HY000] [2002] No connection could be made"

**Solusi:**
1. Buka XAMPP Control Panel
2. Start MySQL
3. Refresh browser

### Problem 3: "Email atau password salah"

**Solusi:**
Gunakan kredensial demo yang sudah dibuat:
- Email: `demo@japlo.com`
- Password: `password123`

Atau buat user baru di: `http://localhost:8000/register`

### Problem 4: "Page not found (404)"

**Solusi:**
```bash
# Clear cache
php artisan route:clear
php artisan config:clear
php artisan cache:clear

# Restart server
php artisan serve
```

### Problem 5: User lama tidak bisa login

**Solusi:**
Buat ulang user demo dengan menjalankan:
```bash
php create_demo_user.php
```

---

## 📝 Catatan Penting

### User yang Sudah Ada di Database:

1. **ID: 1**
   - Name: Dicky Dwi Hardana Putra
   - Email: Dickyputra@gmail.com
   - Role: user (customer)
   - Password: [password yang Anda buat saat registrasi]

2. **ID: 2**
   - Name: dicky dwi hardana putra
   - Email: Dickyputraa@gmail.com
   - Role: driver
   - Password: [password yang Anda buat saat registrasi]

3. **ID: 3**
   - Name: dicky dwi hardana putra
   - Email: Dickyputra1@gmail.com
   - Role: driver
   - Password: [password yang Anda buat saat registrasi]

4. **ID: 4 (DEMO)** ✅
   - Name: Demo Customer
   - Email: demo@japlo.com
   - Role: user (customer)
   - Password: **password123** ✅

5. **ID: 5 (DEMO)** ✅
   - Name: Demo Driver
   - Email: driver@japlo.com
   - Role: driver
   - Password: **password123** ✅

---

## 🎯 Quick Test

### Test 1: Cek Database
```bash
php check_users.php
```

### Test 2: Buat User Demo Baru
```bash
php create_demo_user.php
```

### Test 3: Start Server
```bash
php artisan serve
```

### Test 4: Login
```
URL: http://localhost:8000/login
Email: demo@japlo.com
Password: password123
```

---

## 🚀 Workflow Lengkap

```
1. Buka XAMPP → Start MySQL
   ↓
2. Buka CMD/PowerShell
   ↓
3. cd "c:\xampp\htdocs\Japlo App"
   ↓
4. php artisan serve
   ↓
5. Buka browser: http://localhost:8000
   ↓
6. Klik "Login"
   ↓
7. Email: demo@japlo.com
   Password: password123
   ↓
8. Dashboard → Klik salah satu dari 8 icon menu
   ↓
9. Explore fitur! 🎉
```

---

## 📞 Masih Bermasalah?

### Cek Log Error:
```bash
# Lihat error log
type storage\logs\laravel.log
```

### Enable Debug Mode:
Edit file `.env`:
```
APP_DEBUG=true
```

### Reset Database (Jika Perlu):
```bash
php artisan migrate:fresh
php create_demo_user.php
```

---

## ✅ Checklist Login

- [ ] XAMPP MySQL sudah running
- [ ] Laravel server sudah running (`php artisan serve`)
- [ ] Browser bisa akses `http://localhost:8000`
- [ ] Halaman login tampil
- [ ] Gunakan email: `demo@japlo.com`
- [ ] Gunakan password: `password123`
- [ ] Klik tombol "Masuk"
- [ ] Redirect ke dashboard
- [ ] Lihat 8 icon menu layanan

---

## 🎉 Berhasil Login!

Setelah berhasil login, Anda akan melihat:

### Dashboard Customer
```
Halo, Demo Customer! 👋
Mau kemana hari ini?

[8 Icon Menu Layanan]
🏍️ OJEK/TAXI  🍽️ KULINER  📢 PROMOSI  🏥 KESEHATAN
🛍️ PRODUK  🖨️ PENCETAKAN  🔥 TRENDING  👥 SOSIAL

[Statistik]
Total Pesanan: 0
Perjalanan Selesai: 0
```

Selamat menjelajah! 🚀

---

**Dokumentasi dibuat:** 7 Juli 2026  
**Status:** ✅ Working & Tested  
**Demo Credentials:** Ready to use
