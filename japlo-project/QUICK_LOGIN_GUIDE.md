# 🚀 QUICK LOGIN GUIDE - JAPLO

## ✅ APLIKASI SUDAH SIAP!

Server Laravel sedang berjalan di:
### 🌐 http://127.0.0.1:8000

---

## 🎯 CARA LOGIN - 3 LANGKAH MUDAH

### Step 1: Buka Browser
```
Ketik di address bar: http://127.0.0.1:8000
```

### Step 2: Pilih Action
Ada 3 pilihan:
1. **Daftar Sekarang** - Untuk pengguna baru (customer)
2. **Masuk** - Jika sudah punya akun
3. **Daftar sebagai Driver** - Untuk menjadi driver

### Step 3: Login/Register
**Jika Belum Punya Akun:**
- Klik "Daftar Sekarang"
- Isi form:
  - Nama: (nama lengkap Anda)
  - Email: (email valid)
  - Phone: (nomor telepon)
  - Password: (min 8 karakter)
  - Konfirmasi Password: (ulangi password)
  - Role: Pilih "Penumpang" atau "Driver"
- Klik "Daftar"

**Jika Sudah Punya Akun:**
- Klik "Masuk"
- Masukkan Email & Password
- Klik "Masuk"

---

## 📱 TEST ACCOUNT (Optional)

Anda bisa buat test account dengan data ini:

### Test Customer:
```
Nama: Test Customer
Email: customer@japlo.com
Phone: 081234567890
Password: password123
Role: user (Penumpang)
```

### Test Driver:
```
Nama: Test Driver
Email: driver@japlo.com
Phone: 081234567891
Password: password123
Role: driver
```

---

## 🎨 Tampilan Yang Akan Anda Lihat

### 1. Landing Page (Home)
- Hero section dengan welcome message
- Fitur-fitur JAPLO
- Cara kerja (3 langkah)
- Call to action buttons
- Statistik

### 2. Login Page (`/login`)
- Form email & password
- Remember me checkbox
- Link ke register page

### 3. Register Page (`/register`)
- Form lengkap untuk daftar
- Pilihan role (customer/driver)
- Validasi otomatis

### 4. Dashboard (`/dashboard`)
Setelah login, Anda akan masuk ke dashboard sesuai role:
- **Customer Dashboard**: Untuk pesan ojek
- **Driver Dashboard**: Untuk terima pesanan

---

## ✅ Checklist - Pastikan Semua Ini OK

- [x] XAMPP MySQL running (port 3306)
- [x] Database `japlo_db` created
- [x] Laravel server running (port 8000)
- [x] Browser ready (Chrome, Firefox, Edge, etc)

---

## 🔧 Troubleshooting

### Jika Server Tidak Jalan:
```bash
cd "c:\xampp\htdocs\Japlo App\Japlo Web\japlo-project\laravel-backend"
php artisan serve
```

### Jika Login Gagal:
1. Pastikan database running
2. Pastikan akun sudah terdaftar
3. Cek email & password benar
4. Clear browser cache

### Jika Page Tidak Muncul:
1. Pastikan server running
2. Cek URL: http://127.0.0.1:8000 (bukan localhost/japlo...)
3. Refresh browser (F5 atau Ctrl+R)

---

## 📍 URL Penting

```
Home Page:      http://127.0.0.1:8000
Login:          http://127.0.0.1:8000/login
Register:       http://127.0.0.1:8000/register
Dashboard:      http://127.0.0.1:8000/dashboard
```

---

## 🎉 SELAMAT MENCOBA!

Aplikasi JAPLO Anda sudah **100% SIAP DIGUNAKAN**!

**Langsung buka**: http://127.0.0.1:8000

---

## 💡 Tips

1. **First Time?** Daftar sebagai customer dulu untuk explore fitur
2. **Want to Test Driver?** Daftar akun kedua sebagai driver
3. **Forgot Password?** Fitur reset akan ditambahkan nanti
4. **Mobile Access?** Gunakan IP address komputer Anda dari HP

---

**Dibuat: 29 Juni 2026**
**Status: ✅ READY TO USE**

---

## 📞 Need Help?

Jika ada masalah:
1. Cek `SUMMARY_PERBAIKAN.md` untuk detail teknis
2. Cek `SIAP_DIGUNAKAN.md` untuk info lengkap
3. Cek terminal output untuk error messages

---

🎊 **SELAMAT! APLIKASI JAPLO SIAP DIGUNAKAN!** 🎊
