# ⚡ Quick Start - JAPLO Web Application

Panduan cepat untuk menjalankan JAPLO di browser dalam 5 menit!

## 🚀 Langkah Cepat (Quick Setup)

### 1. Pastikan XAMPP Running
```
✅ Start Apache
✅ Start MySQL
```

### 2. Buat Database

Buka browser → http://localhost/phpmyadmin

```sql
CREATE DATABASE japlo_db;
```

### 3. Install Dependencies

```bash
cd "C:\xampp\htdocs\Japlo App\Japlo Web\japlo-project\laravel-backend"
composer install
copy .env.example .env
php artisan key:generate
```

### 4. Setup Database Config

Edit file `.env`:
```env
DB_DATABASE=japlo_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrate Database

```bash
php artisan migrate
```

### 6. Jalankan Server

```bash
php artisan serve
```

## 🌐 Akses Aplikasi

Buka browser: **http://localhost:8000**

## 📝 Test Account

### Register Baru:

1. Klik "Daftar"
2. Pilih role (Penumpang/Driver)
3. Isi form dan submit

### Atau gunakan data test:

Setelah register, gunakan credentials Anda untuk login.

## 🎯 URL Penting

| URL | Deskripsi |
|-----|-----------|
| http://localhost:8000 | Landing Page |
| http://localhost:8000/register | Register |
| http://localhost:8000/login | Login |
| http://localhost:8000/dashboard | Dashboard |
| http://localhost:8000/api/health | API Health Check |

## 🎨 Fitur Web

### ✅ Landing Page
- Hero section dengan CTA
- Fitur unggulan
- Cara kerja
- Statistik
- Call to action

### ✅ Authentication
- Register dengan role selection
- Login dengan remember me
- Session management
- Logout

### ✅ Customer Dashboard
- Statistik pesanan
- Active order display
- Riwayat pesanan
- Quick booking button

### ✅ Driver Dashboard
- Status online/offline
- Statistik trip & earnings
- Pending orders list
- Riwayat pesanan
- Daily & total earnings

## 🔥 Screenshot Flow

### 1. Landing Page
```
http://localhost:8000
- Hero dengan gradient hijau
- Features cards (4 fitur)
- How it works (3 steps)
- CTA section
- Statistics
```

### 2. Register
```
http://localhost:8000/register
- Role selection (Penumpang/Driver)
- Form fields:
  * Nama Lengkap
  * Email
  * Nomor Telepon
  * Password
  * Konfirmasi Password
- Auto login after register
```

### 3. Dashboard Customer
```
http://localhost:8000/dashboard
- Welcome message
- Statistics cards
- Active order (if any)
- Booking button
- Recent orders table
```

### 4. Dashboard Driver
```
http://localhost:8000/dashboard
- Status toggle (Online/Offline)
- 4 Statistics cards:
  * Total Trip
  * Rating
  * Total Pendapatan
  * Trip Hari Ini
- Today's earnings card
- Pending orders (if online)
- Recent orders
```

## 💡 Tips

1. **Untuk testing lengkap:**
   - Buat 2 akun: 1 customer + 1 driver
   - Test register & login
   - Lihat dashboard masing-masing

2. **Untuk development:**
   - Gunakan `php artisan serve`
   - Auto-reload on changes

3. **Untuk production:**
   - Setup virtual host Apache
   - Use .htaccess rewrite rules
   - Set APP_DEBUG=false

## 🐛 Troubleshooting Cepat

**Server tidak bisa start?**
```bash
# Port 8000 sudah dipakai, gunakan port lain
php artisan serve --port=8080
```

**Database error?**
```bash
# Check MySQL running & database sudah dibuat
# Cek .env configuration
```

**Class not found?**
```bash
composer dump-autoload
php artisan config:clear
```

**Page not found?**
```
# Pastikan akses ke /public atau gunakan php artisan serve
```

## 📞 Need Help?

Baca dokumentasi lengkap:
- **WEB_INSTALLATION_GUIDE.md** - Setup detail
- **README.md** - Project overview
- **INSTALLATION_GUIDE.md** - Full installation

## ✅ Quick Checklist

- [ ] XAMPP running
- [ ] Database created
- [ ] composer install done
- [ ] .env configured
- [ ] php artisan migrate done
- [ ] php artisan serve running
- [ ] Can access http://localhost:8000
- [ ] Can register new account
- [ ] Can login
- [ ] Dashboard works

**Done! Aplikasi JAPLO Web sudah jalan! 🎉**

Sekarang bisa test:
1. Register sebagai Customer
2. Register sebagai Driver (akun berbeda)
3. Explore dashboard masing-masing
4. Test logout & login

Untuk fitur booking & tracking real-time, gunakan API endpoints yang sudah tersedia!
