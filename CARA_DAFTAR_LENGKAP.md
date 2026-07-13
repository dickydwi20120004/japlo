# 📝 CARA DAFTAR - JAPLO APP

## ✅ PANDUAN LENGKAP REGISTRASI

Berikut cara daftar sebagai **Penumpang** atau **Driver** di aplikasi Japlo.

---

## 🔗 AKSES HALAMAN DAFTAR

### Method 1: Dari Welcome Page
```
1. Buka: http://localhost:8000
2. Klik tombol "Daftar Jadi Driver" (kuning)
   ATAU
3. Klik tombol "Daftar sebagai Penumpang" (biru)
```

### Method 2: Direct URL
```
Penumpang: http://localhost:8000/register?role=user
Driver:    http://localhost:8000/register?role=driver
```

### Method 3: Dari Login Page
```
1. Buka: http://localhost:8000/login
2. Klik link "Daftar di sini" di bawah form
```

---

## 👤 DAFTAR SEBAGAI PENUMPANG

### Form yang Perlu Diisi:

1. **Pilih Role:** 
   - Klik icon **Penumpang** (user icon)

2. **Nama Lengkap** ⭐ Required
   - Contoh: `Ahmad Rizki`

3. **Email** ⭐ Required
   - Contoh: `ahmad@example.com`
   - Harus unik (belum terdaftar)

4. **Nomor Telepon** ⭐ Required
   - Contoh: `08123456789`
   - Harus unik (belum terdaftar)

5. **Password** ⭐ Required
   - Minimal 8 karakter
   - Contoh: `password123`

6. **Konfirmasi Password** ⭐ Required
   - Harus sama dengan password

7. **Klik tombol "Daftar"**

### Setelah Daftar:
```
✅ Akun dibuat otomatis
✅ Login otomatis
✅ Redirect ke Dashboard
✅ Bisa langsung pesan ojek/taxi
```

---

## 🏍️ DAFTAR SEBAGAI DRIVER

### Form yang Perlu Diisi:

1. **Pilih Role:**
   - Klik icon **Driver** (motorcycle icon)

2. **Nama Lengkap** ⭐ Required
   - Contoh: `Budi Santoso`

3. **Email** ⭐ Required
   - Contoh: `budi.driver@example.com`
   - Harus unik

4. **Nomor Telepon** ⭐ Required
   - Contoh: `08198765432`
   - Harus unik

5. **INFORMASI DRIVER** (Otomatis muncul)

6. **Jenis Kendaraan** ⭐ Required
   - Pilihan: Motor atau Mobil
   - Contoh: `Motor`

7. **Merk Kendaraan** ⭐ Required
   - Contoh: `Honda Vario`

8. **Nomor Plat Kendaraan** ⭐ Required
   - Contoh: `B 1234 XYZ`

9. **Nomor SIM** ⭐ Required
   - Contoh: `1234567890123`

10. **Alamat Lengkap** (Optional)
    - Contoh: `Jl. Kebon Jeruk No. 123, Jakarta Barat`

11. **Password** ⭐ Required
    - Minimal 8 karakter

12. **Konfirmasi Password** ⭐ Required
    - Harus sama dengan password

13. **Klik tombol "Daftar"**

### Setelah Daftar:
```
✅ Akun driver dibuat
✅ Profile driver dibuat di tabel drivers
✅ Login otomatis
✅ Redirect ke Dashboard
✅ Status: Tidak Tersedia (default)
✅ Bisa toggle ketersediaan di dashboard
```

---

## ✅ VALIDASI FORM

### Yang Divalidasi:

**Semua User:**
- ✅ Nama: Wajib diisi
- ✅ Email: Format email valid & unik
- ✅ Telepon: Wajib diisi & unik
- ✅ Password: Min 8 karakter
- ✅ Konfirmasi: Harus match dengan password
- ✅ Role: Harus dipilih (user/driver)

**Khusus Driver:**
- ✅ Jenis Kendaraan: Motor atau Mobil
- ✅ Merk: Wajib diisi
- ✅ Plat Nomor: Wajib diisi
- ✅ Nomor SIM: Wajib diisi

---

## 🚨 ERROR HANDLING

### Error yang Mungkin Muncul:

**1. Email sudah terdaftar**
```
Error: "Email sudah terdaftar"
Solusi: Gunakan email lain atau login jika sudah punya akun
```

**2. Nomor telepon sudah terdaftar**
```
Error: "Nomor telepon sudah terdaftar"
Solusi: Gunakan nomor lain
```

**3. Password tidak cocok**
```
Error: "Konfirmasi password tidak cocok"
Solusi: Ketik ulang password di kedua field
```

**4. Password terlalu pendek**
```
Error: "Password minimal 8 karakter"
Solusi: Buat password lebih panjang
```

**5. Field driver kosong**
```
Error: "Jenis kendaraan harus dipilih"
Solusi: Isi semua field driver yang required
```

---

## 🎯 TESTING REGISTRASI

### Test Case 1: Daftar Penumpang
```
URL: http://localhost:8000/register

Data:
- Role: Penumpang
- Nama: Test User
- Email: testuser@test.com
- Phone: 081234567890
- Password: test1234
- Confirm: test1234

Expected:
✅ Redirect ke /dashboard
✅ Login otomatis
✅ Alert success: "Registrasi berhasil!"
```

### Test Case 2: Daftar Driver
```
URL: http://localhost:8000/register?role=driver

Data:
- Role: Driver
- Nama: Test Driver
- Email: testdriver@test.com
- Phone: 081298765432
- Vehicle Type: Motor
- Vehicle Brand: Honda Beat
- License Plate: B 5678 ABC
- License Number: 9876543210123
- Password: test1234
- Confirm: test1234

Expected:
✅ Redirect ke /dashboard
✅ Login otomatis
✅ Driver profile created
✅ Alert success
```

### Test Case 3: Email Duplicate
```
Data:
- Email: demo@japlo.com (already exists)

Expected:
❌ Error: "Email sudah terdaftar"
⏪ Stay on register page
📝 Form inputs retained (except password)
```

---

## 🔒 SECURITY FEATURES

### Implemented:
- ✅ Password hashing (bcrypt)
- ✅ CSRF protection
- ✅ Input validation server-side
- ✅ Unique email & phone check
- ✅ Password confirmation required
- ✅ Auto login after register
- ✅ Session regeneration

---

## 📊 DATABASE TABLES

### Table: users
```sql
- id
- name
- email (unique)
- phone (unique)
- password (hashed)
- role (user/driver)
- created_at
- updated_at
```

### Table: drivers (if role=driver)
```sql
- id
- user_id (foreign key)
- vehicle_type (motor/mobil)
- vehicle_brand
- license_plate
- license_number
- address (nullable)
- is_available (default: false)
- rating (default: 0)
- total_rides (default: 0)
- total_earnings (default: 0)
- latitude (nullable)
- longitude (nullable)
- created_at
- updated_at
```

---

## 🔄 FLOW DIAGRAM

### Penumpang Flow:
```
1. Akses /register
2. Pilih "Penumpang"
3. Isi form (5 fields)
4. Submit
5. Validation ✅
6. Create user
7. Auto login
8. Redirect /dashboard
9. Ready to order!
```

### Driver Flow:
```
1. Akses /register?role=driver
2. Pilih "Driver"
3. Isi form basic (4 fields)
4. Form driver muncul (5 fields tambahan)
5. Submit
6. Validation ✅
7. Create user
8. Create driver profile
9. Auto login
10. Redirect /dashboard
11. Toggle availability
12. Ready to accept orders!
```

---

## 💡 TIPS

### Untuk Penumpang:
- ✅ Gunakan email aktif (untuk notifikasi)
- ✅ Nomor telepon aktif (driver akan hubungi)
- ✅ Password mudah diingat tapi aman

### Untuk Driver:
- ✅ Isi data kendaraan dengan benar
- ✅ Nomor plat sesuai STNK
- ✅ Nomor SIM yang valid
- ✅ Alamat lengkap untuk verifikasi

---

## 🐛 TROUBLESHOOTING

### Problem: Form tidak bisa submit
**Solusi:**
1. Check console (F12) untuk JavaScript errors
2. Pastikan semua field required terisi
3. Check password confirmation match

### Problem: Redirect ke halaman error
**Solusi:**
1. Check Laravel logs: `storage/logs/laravel.log`
2. Pastikan database running
3. Check .env configuration

### Problem: Driver fields tidak muncul
**Solusi:**
1. Click ulang radio button "Driver"
2. Check JavaScript toggleDriverFields()
3. Clear browser cache

### Problem: Email/phone already exists
**Solusi:**
1. Gunakan data baru
2. Atau login dengan akun existing
3. Check database: users table

---

## 📞 DEMO ACCOUNTS

Untuk testing, gunakan akun demo:

### Penumpang:
```
Email: demo@japlo.com
Password: password123
```

### Driver:
```
Email: driver@japlo.com
Password: password123
```

---

## ✅ SUCCESS INDICATORS

Registrasi berhasil jika:
- ✅ Redirect ke /dashboard
- ✅ Navbar shows user name
- ✅ Alert success muncul
- ✅ Bisa logout & login ulang
- ✅ Data tersimpan di database

---

## 📝 NEXT STEPS AFTER REGISTER

### Untuk Penumpang:
1. Complete profile (optional)
2. Set alamat favorit
3. Pesan ojek/taxi pertama
4. Rate driver

### Untuk Driver:
1. Toggle availability ON
2. Wait for orders
3. Accept order
4. Complete ride
5. Get rating

---

**Last Updated:** 13 Juli 2026  
**Status:** ✅ Fully Functional  
**Testing:** ✅ All cases passed

**Created by:** Kiro AI Assistant
