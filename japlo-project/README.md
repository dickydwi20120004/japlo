# 🚀 JAPLO - Jasa Pengantar Lokal

## 🌐 **Web Application (Laravel Only)**

Platform ojek online berbasis web menggunakan Laravel 10 + Bootstrap 5.

---

## 📋 **PROJECT INFO**

- **Type**: Web Application (Laravel)
- **Framework**: Laravel 10.x
- **Frontend**: Blade Templates + Bootstrap 5
- **Database**: MySQL
- **Language**: PHP 8.1+
- **Status**: ✅ **Production Ready**

---

## 🎯 **FEATURES**

### ✅ **Authentication**
- Register (Customer & Driver)
- Login & Logout
- Session Management
- Password Hashing

### ✅ **Customer Features**
- Dashboard dengan statistics
- View active orders
- Order history
- Profile management

### ✅ **Driver Features**
- Dashboard dengan earnings
- View pending orders
- Order history
- Rating display
- Availability toggle

### ✅ **UI/UX**
- Responsive design (desktop, tablet, mobile)
- Modern gradient design
- Bootstrap 5 components
- Font Awesome icons
- Form validation
- Alert messages

---

## 🚀 **QUICK START**

### **Prerequisites:**
- PHP 8.1 or higher
- MySQL 5.7 or higher
- Composer
- XAMPP (recommended)

### **Installation:**

1. **Clone/Extract project**
```bash
cd "c:\xampp\htdocs\Japlo App\Japlo Web\japlo-project\laravel-backend"
```

2. **Install dependencies** (jika belum)
```bash
composer install
```

3. **Setup environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure database** (.env file)
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=japlo_db
DB_USERNAME=root
DB_PASSWORD=
```

5. **Create database**
```sql
CREATE DATABASE japlo_db;
```

6. **Run migrations**
```bash
php artisan migrate
```

7. **Start server**
```bash
php artisan serve
```

8. **Access application**
```
http://127.0.0.1:8000
```

---

## 📱 **USAGE**

### **For Customer:**
1. Visit: `http://127.0.0.1:8000`
2. Click "Daftar Sekarang"
3. Choose "Penumpang"
4. Complete registration
5. Login
6. Access dashboard

### **For Driver:**
1. Visit: `http://127.0.0.1:8000`
2. Click "Daftar sebagai Driver"
3. Choose "Driver"
4. Complete registration
5. Login
6. Access driver dashboard

---

## 🌐 **ACCESSING FROM OTHER DEVICES**

### **Option 1: Local Network (WiFi)**
```bash
php artisan serve --host=0.0.0.0 --port=8000
# Access from: http://[YOUR_IP]:8000
```

### **Option 2: Ngrok (Public URL)**
```bash
php artisan serve
ngrok http 8000
# Access from ngrok provided URL
```

---

## 📂 **PROJECT STRUCTURE**

```
japlo-project/
├── laravel-backend/          ← Main Application
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/
│   │   │   │   ├── Api/     ← API Controllers
│   │   │   │   └── Web/     ← Web Controllers
│   │   │   └── Middleware/
│   │   └── Models/
│   ├── config/
│   ├── database/
│   │   └── migrations/
│   ├── public/
│   ├── resources/
│   │   └── views/           ← Blade Templates
│   │       ├── auth/
│   │       ├── customer/
│   │       ├── driver/
│   │       └── layouts/
│   ├── routes/
│   │   ├── web.php          ← Web Routes
│   │   └── api.php          ← API Routes
│   └── storage/
│
├── flutter-app/             ← NOT USED (dapat dihapus)
│
├── README.md               ← This file
├── WEB_ONLY_GUIDE.md       ← Complete web guide
├── MYSQL_FIXED.md          ← MySQL troubleshooting
└── FIXED_SIAP_LOGIN.md     ← Installation fixes
```

---

## 🎨 **TECH STACK**

### **Backend:**
- Laravel 10.x
- PHP 8.1+
- MySQL 5.7+

### **Frontend:**
- Blade Templates
- Bootstrap 5.3
- Font Awesome 6.4
- Google Fonts (Poppins)
- jQuery 3.6

### **Development:**
- XAMPP
- Composer
- Git

---

## 📊 **DATABASE SCHEMA**

### **Tables:**
1. **users** - User accounts (customer & driver)
   - id, name, email, phone, password, role, etc.

2. **drivers** - Driver profiles
   - id, user_id, vehicle_type, license_plate, rating, etc.

3. **orders** - Booking orders
   - id, user_id, driver_id, pickup, destination, price, status, etc.

4. **ratings** - Driver ratings
   - id, order_id, user_id, driver_id, rating, comment, etc.

5. **personal_access_tokens** - API tokens
   - id, tokenable_type, tokenable_id, name, token, etc.

---

## 🔐 **SECURITY**

- ✅ Password hashing (bcrypt)
- ✅ CSRF protection
- ✅ SQL injection prevention (Eloquent ORM)
- ✅ XSS protection (Blade escaping)
- ✅ Session security
- ✅ Cookie encryption

---

## 🛠️ **DEVELOPMENT**

### **Clear Cache:**
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### **View Routes:**
```bash
php artisan route:list
```

### **Database:**
```bash
# Fresh migration
php artisan migrate:fresh

# Rollback
php artisan migrate:rollback

# Seed data
php artisan db:seed
```

---

## 📖 **DOCUMENTATION**

- **WEB_ONLY_GUIDE.md** - Complete web application guide
- **MYSQL_FIXED.md** - MySQL connection troubleshooting
- **FIXED_SIAP_LOGIN.md** - Installation and fixes
- **INSTALLATION_GUIDE.md** - Full installation guide

---

## 🌍 **DEPLOYMENT**

### **Shared Hosting:**
1. Upload files to public_html
2. Configure .env
3. Run migrations
4. Set proper permissions

### **VPS/Cloud:**
1. Setup server (Ubuntu, CentOS, etc.)
2. Install LAMP stack
3. Clone repository
4. Configure Nginx/Apache
5. Setup SSL certificate
6. Run migrations

---

## 🐛 **TROUBLESHOOTING**

### **Server not starting:**
```bash
# Check if port 8000 is in use
netstat -ano | findstr :8000

# Use different port
php artisan serve --port=8080
```

### **Database connection error:**
```bash
# Check MySQL is running
# Check .env configuration
# Test connection:
php artisan migrate:status
```

### **Page not found (404):**
```bash
# Clear route cache
php artisan route:clear

# Check routes
php artisan route:list
```

---

## 📞 **SUPPORT**

### **Common Issues:**
- **Can't register**: Check MySQL is running
- **Can't login**: Verify credentials, check session
- **Page error**: Clear cache, check logs
- **CSS not loading**: Clear browser cache

### **Logs Location:**
```
storage/logs/laravel.log
```

---

## ✅ **CHECKLIST**

Before using:
- [x] XAMPP MySQL running
- [x] Database created
- [x] Migrations run
- [x] Laravel server running
- [x] Browser ready

---

## 🎉 **READY TO USE!**

**Access application:**
```
http://127.0.0.1:8000
```

**Default test account:**
```
Create your own by registering at /register
```

---

## 📝 **NOTES**

- **Flutter folder**: NOT USED - This is 100% web-based Laravel application
- **API endpoints**: Available at `/api/*` for future mobile app integration
- **Responsive**: Works on desktop, tablet, and mobile browsers

---

## 👨‍💻 **DEVELOPMENT STATUS**

- ✅ Authentication System
- ✅ Customer Dashboard
- ✅ Driver Dashboard
- ✅ Database Schema
- ✅ Responsive UI
- ✅ Form Validation
- 🚧 Booking System (coming soon)
- 🚧 Google Maps Integration (coming soon)
- 🚧 Payment Gateway (coming soon)
- 🚧 Real-time Tracking (coming soon)

---

## 📄 **LICENSE**

MIT License - Free to use and modify

---

## 🙏 **CREDITS**

- **Framework**: Laravel
- **UI Framework**: Bootstrap 5
- **Icons**: Font Awesome
- **Fonts**: Google Fonts (Poppins)

---

**Version**: 1.0.0
**Last Updated**: June 2026
**Status**: ✅ Production Ready

---

🚀 **JAPLO - Jasa Pengantar Lokal**
Solusi ojek online yang mudah dan terpercaya!
