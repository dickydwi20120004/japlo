# 🌐 Panduan Instalasi JAPLO Web Application

Panduan lengkap untuk menjalankan JAPLO versi web menggunakan browser.

## 📋 Requirements

- XAMPP (PHP 8.1+, MySQL, Apache)
- Composer
- Browser (Chrome, Firefox, Edge, dll)

## 🚀 Langkah Instalasi

### 1. Pastikan XAMPP Sudah Terinstall

1. Download XAMPP dari https://www.apachefriends.org/
2. Install XAMPP
3. Buka XAMPP Control Panel
4. **Start Apache** dan **Start MySQL**

### 2. Setup Database

1. Buka browser, akses: http://localhost/phpmyadmin
2. Login (default: username=root, password=kosong)
3. Klik "New" untuk buat database baru
4. Nama database: **japlo_db**
5. Collation: **utf8mb4_unicode_ci**
6. Klik "Create"

### 3. Install Dependencies Laravel

Buka Command Prompt / Terminal:

```bash
# Masuk ke folder laravel-backend
cd "C:\xampp\htdocs\Japlo App\Japlo Web\japlo-project\laravel-backend"

# Install dependencies dengan Composer
composer install
```

**Note:** Jika belum install Composer, download dari: https://getcomposer.org/download/

### 4. Konfigurasi Environment

```bash
# Copy file .env.example menjadi .env
copy .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Edit File .env

Buka file `.env` dengan text editor dan pastikan konfigurasi database sudah benar:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=japlo_db
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Jalankan Migrasi Database

```bash
php artisan migrate
```

Output yang benar:
```
Migration table created successfully.
Migrating: 2024_01_01_000001_create_users_table
Migrated:  2024_01_01_000001_create_users_table
...
```

### 7. Jalankan Laravel Development Server

```bash
php artisan serve
```

Server akan berjalan di: **http://localhost:8000**

## 🌐 Akses Aplikasi Web

### Metode 1: Menggunakan php artisan serve (Recommended untuk Development)

1. Buka Command Prompt
2. Jalankan: `php artisan serve`
3. Buka browser dan akses: **http://localhost:8000**

### Metode 2: Menggunakan Apache XAMPP (Recommended untuk Production-like)

1. Copy/Pindahkan folder `laravel-backend` ke `C:\xampp\htdocs\`
2. Pastikan Apache di XAMPP sudah running
3. Buka browser dan akses: **http://localhost/laravel-backend/public**

**Atau buat Virtual Host (Optional):**

Edit file: `C:\xampp\apache\conf\extra\httpd-vhosts.conf`

Tambahkan:
```apache
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/Japlo App/Japlo Web/japlo-project/laravel-backend/public"
    ServerName japlo.test
    <Directory "C:/xampp/htdocs/Japlo App/Japlo Web/japlo-project/laravel-backend/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Edit file: `C:\Windows\System32\drivers\etc\hosts` (as Administrator)

Tambahkan:
```
127.0.0.1    japlo.test
```

Restart Apache, lalu akses: **http://japlo.test**

## 📱 Fitur Web Application

### Halaman Publik (Guest):
- ✅ **Landing Page** - Halaman utama dengan informasi JAPLO
- ✅ **Login** - Form login untuk customer & driver
- ✅ **Register** - Form registrasi dengan pilihan role (Customer/Driver)

### Dashboard Customer:
- ✅ **Home Dashboard** - Statistik pesanan
- ✅ **Active Order** - Lihat pesanan aktif
- ✅ **Order History** - Riwayat pesanan
- ✅ **Profile** - Manage profil user

### Dashboard Driver:
- ✅ **Driver Dashboard** - Statistik & pendapatan
- ✅ **Status Toggle** - Online/Offline status
- ✅ **Pending Orders** - Pesanan tersedia (jika online)
- ✅ **Order History** - Riwayat pesanan driver
- ✅ **Statistics** - Total trip, rating, earnings

## 🎯 Testing Flow

### 1. Test Register & Login

**Register Customer:**
1. Akses: http://localhost:8000/register
2. Pilih role: **Penumpang**
3. Isi form:
   - Nama: John Doe
   - Email: john@example.com
   - Phone: 081234567890
   - Password: password123
   - Konfirmasi Password: password123
4. Klik "Daftar"
5. Anda akan otomatis login dan redirect ke dashboard customer

**Register Driver:**
1. Logout dari customer account
2. Akses: http://localhost:8000/register
3. Pilih role: **Driver**
4. Isi form:
   - Nama: Driver Test
   - Email: driver@example.com
   - Phone: 081234567891
   - Password: password123
   - Konfirmasi Password: password123
5. Klik "Daftar"
6. Anda akan otomatis login dan redirect ke dashboard driver

### 2. Test Login

1. Akses: http://localhost:8000/login
2. Email: john@example.com
3. Password: password123
4. Klik "Masuk"
5. Akan redirect ke dashboard sesuai role

### 3. Explore Dashboard

**Customer Dashboard:**
- Lihat total pesanan
- Lihat riwayat pesanan (jika ada)
- Button "Pesan Ojek" (UI only, backend via API)

**Driver Dashboard:**
- Lihat statistik (trip, rating, earnings)
- Toggle status online/offline (UI only, backend via API)
- Lihat pesanan tersedia (jika online)
- Lihat riwayat pesanan

## 🔌 Integrasi dengan API

Web application ini menggunakan **session-based authentication** untuk web UI.
Untuk fitur real-time seperti booking, tracking, dll, gunakan **API endpoints** yang sudah dibuat.

### Endpoint API Tersedia:

Base URL: `http://localhost:8000/api`

**Authentication:**
- POST `/api/auth/register`
- POST `/api/auth/login`
- POST `/api/auth/logout`
- GET `/api/auth/profile`

**Orders:**
- POST `/api/orders` - Create order
- GET `/api/orders` - Get user orders
- GET `/api/orders/active` - Get active order
- POST `/api/orders/{id}/cancel` - Cancel order

**Driver:**
- POST `/api/driver/location` - Update location
- POST `/api/driver/toggle-availability` - Toggle status
- GET `/api/driver/orders` - Get driver orders

**Testing API:**
Gunakan Postman atau Insomnia untuk test API endpoints.

## 🎨 Design & UI

### Color Scheme:
- **Primary:** #00A859 (Hijau)
- **Accent:** #FF6B35 (Orange)
- **Success:** #4CAF50
- **Error:** #F44336

### Framework UI:
- Bootstrap 5.3
- Font Awesome 6.4
- Google Fonts (Poppins)
- Custom CSS

### Features:
- ✅ Responsive design (mobile, tablet, desktop)
- ✅ Modern gradient backgrounds
- ✅ Smooth animations
- ✅ Card-based layouts
- ✅ Beautiful forms with validation
- ✅ Status badges dengan warna
- ✅ Statistics cards
- ✅ Clean footer

## 📂 Struktur File Web

```
laravel-backend/
├── public/               # Document root
│   ├── index.php        # Entry point
│   ├── css/             # Custom CSS
│   ├── js/              # Custom JavaScript
│   └── images/          # Images
├── resources/
│   └── views/           # Blade templates
│       ├── layouts/
│       │   └── app.blade.php      # Main layout
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── customer/
│       │   └── dashboard.blade.php
│       ├── driver/
│       │   └── dashboard.blade.php
│       └── welcome.blade.php       # Landing page
├── app/
│   └── Http/Controllers/Web/
│       ├── AuthController.php
│       └── DashboardController.php
├── routes/
│   ├── web.php          # Web routes
│   └── api.php          # API routes
└── .env                 # Environment config
```

## ❗ Troubleshooting

### Issue: Page not found (404)

**Solution:**
- Pastikan Apache XAMPP running
- Pastikan mengakses `/public` jika tidak pakai `php artisan serve`
- Check file `.htaccess` ada di folder `public/`

### Issue: Database connection error

**Solution:**
```bash
# Check MySQL running
# Check .env configuration
# Check database japlo_db sudah dibuat
```

### Issue: Class not found

**Solution:**
```bash
composer dump-autoload
php artisan config:clear
php artisan cache:clear
```

### Issue: 500 Internal Server Error

**Solution:**
```bash
# Check file permissions
# Check .env file exists
# Check error logs di storage/logs/laravel.log
```

### Issue: CSRF Token Mismatch

**Solution:**
- Clear browser cookies
- Refresh halaman
- Pastikan session driver di .env sudah benar

## 🔐 Security Notes

Untuk production:
1. Set `APP_DEBUG=false` di .env
2. Generate new `APP_KEY`
3. Gunakan HTTPS
4. Set strong database password
5. Enable rate limiting
6. Setup proper CORS
7. Validate all inputs
8. Use CSRF protection (sudah built-in)

## 📞 Bantuan

Jika mengalami kesulitan:
1. Check Laravel logs: `storage/logs/laravel.log`
2. Check Apache logs: `C:\xampp\apache\logs\error.log`
3. Google error message
4. Read Laravel documentation: https://laravel.com/docs

## ✅ Checklist

- [ ] XAMPP installed & running (Apache + MySQL)
- [ ] Composer installed
- [ ] Database `japlo_db` created
- [ ] Laravel dependencies installed (`composer install`)
- [ ] .env file configured
- [ ] Database migrated (`php artisan migrate`)
- [ ] Laravel server running (`php artisan serve`)
- [ ] Can access landing page: http://localhost:8000
- [ ] Register works
- [ ] Login works
- [ ] Dashboard loads correctly

**Selamat! Web application JAPLO sudah berjalan! 🎉**

---

**JAPLO - Jasa Pengantar Lokal**  
*Platform Ojek Online Terpercaya* 🏍️💨
