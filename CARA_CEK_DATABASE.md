# 🔍 Cara Cek Database JAPLO App

## 📋 Informasi Role yang Ada

JAPLO App memiliki **3 role user**:
1. **USER** (Penumpang) - Role default untuk pelanggan
2. **DRIVER** - Role untuk driver ojek/taxi
3. **ADMIN** - Role untuk administrator sistem

---

## ✅ Cara Cek Database

### Metode 1: Menggunakan Script PHP (RECOMMENDED)

**Langkah:**

1. **Pastikan MySQL XAMPP running**
   - Buka XAMPP Control Panel
   - Klik "Start" pada MySQL
   - Tunggu hingga hijau/running

2. **Jalankan script cek database**
   ```bash
   php cek_database_users.php
   ```

3. **Output yang ditampilkan:**
   - ✓ Status koneksi database
   - ✓ Struktur table users
   - ✓ List semua user dengan role
   - ✓ Jumlah user per role
   - ✓ Status demo accounts
   - ✓ Role enum values yang tersedia

**Contoh Output Sukses:**
```
================================================
   CEK USERS & ROLES - JAPLO APP DATABASE
================================================

[1] Testing database connection...
    ✓ Database connected successfully!

[2] Checking users table structure...
    Columns in 'users' table:
    - id (bigint unsigned)
    - name (varchar(255))
    - email (varchar(255))
    - role (enum('user','driver','admin'))
      → Role enum values: enum('user','driver','admin')
    - phone (varchar(255))
    ...

[3] List all users in database...
    Total users: 3

    ID   Name                     Email                         Role        Phone
    ----------------------------------------------------------------------------------------
    1    Demo User                demo@japlo.com                USER        081234567890
    2    Demo Driver              driver@japlo.com              DRIVER      081234567891
    3    Admin JAPLO              admin@japlo.com               ADMIN       089999999999

[4] Users count by role...
    - USER: 1 user(s)
    - DRIVER: 1 user(s)
    - ADMIN: 1 user(s)

[5] Checking demo accounts...
    ✓ demo@japlo.com - Role: USER
    ✓ driver@japlo.com - Role: DRIVER
    ✓ admin@japlo.com - Role: ADMIN

[6] Checking role enum values in database...
    Current role enum: enum('user','driver','admin')
    ✓ 'user' role is available
    ✓ 'driver' role is available
    ✓ 'admin' role is available

================================================
   DATABASE CHECK COMPLETED
================================================
```

---

### Metode 2: Menggunakan Laravel Tinker

```bash
php artisan tinker
```

**Command di Tinker:**

1. **Cek semua users:**
   ```php
   DB::table('users')->select('id', 'name', 'email', 'role')->get();
   ```

2. **Cek jumlah per role:**
   ```php
   DB::table('users')->select('role', DB::raw('count(*) as total'))->groupBy('role')->get();
   ```

3. **Cek user spesifik:**
   ```php
   User::where('email', 'admin@japlo.com')->first();
   ```

4. **Cek role enum:**
   ```php
   DB::select("SHOW COLUMNS FROM users WHERE Field = 'role'");
   ```

5. **Keluar dari Tinker:**
   ```php
   exit
   ```

---

### Metode 3: Menggunakan phpMyAdmin

1. **Buka browser:** http://localhost/phpmyadmin
2. **Pilih database:** `japlo_db` di sidebar kiri
3. **Klik table:** `users`
4. **Tab "Browse":** Lihat semua data users
5. **Tab "Structure":** Lihat struktur table dan enum role

---

## 🚨 Troubleshooting

### Error: "No connection could be made"

**Penyebab:** MySQL XAMPP belum running

**Solusi:**
1. Buka XAMPP Control Panel
2. Klik "Start" di baris MySQL
3. Tunggu hingga status hijau
4. Coba lagi

---

### Error: "Access denied for user 'root'"

**Penyebab:** Password MySQL salah

**Solusi:**
1. Buka file `.env`
2. Cek dan sesuaikan:
   ```
   DB_USERNAME=root
   DB_PASSWORD=
   ```
3. Jika MySQL pakai password, isi `DB_PASSWORD`

---

### Error: "Unknown database 'japlo_db'"

**Penyebab:** Database belum dibuat

**Solusi:**
1. Buka phpMyAdmin: http://localhost/phpmyadmin
2. Klik "New" di sidebar
3. Nama database: `japlo_db`
4. Collation: `utf8mb4_unicode_ci`
5. Klik "Create"
6. Run migrations: `php artisan migrate`

---

### Database kosong / No users found

**Penyebab:** Belum run seeder

**Solusi:**
```bash
php artisan db:seed --class=AdminSeeder
```

Atau buat manual via register:
- User: http://localhost:8000/register
- Driver: http://localhost:8000/register?role=driver
- Admin: Run seeder

---

### Role 'admin' tidak tersedia

**Penyebab:** Migration add admin role belum dijalankan

**Solusi:**
```bash
php artisan migrate
```

Cek migration file:
- `2026_07_14_011159_add_admin_role_to_users_table.php`

---

## 📊 Expected Database Structure

### Table: users

| Column | Type | Description |
|--------|------|-------------|
| id | bigint unsigned | Primary key |
| name | varchar(255) | Nama lengkap user |
| email | varchar(255) | Email (unique) |
| password | varchar(255) | Password (hashed) |
| phone | varchar(255) | Nomor telepon (unique) |
| **role** | **enum('user','driver','admin')** | **Role user** |
| profile_photo | varchar(255) | Path foto profil (nullable) |
| address | text | Alamat (nullable) |
| email_verified_at | timestamp | Waktu verifikasi email (nullable) |
| remember_token | varchar(100) | Token remember me (nullable) |
| created_at | timestamp | Waktu dibuat |
| updated_at | timestamp | Waktu diupdate |

---

## 🔐 Demo Accounts

Setelah run seeder, akun berikut tersedia:

| Role | Email | Password | Phone |
|------|-------|----------|-------|
| USER | demo@japlo.com | password123 | 081234567890 |
| DRIVER | driver@japlo.com | password123 | 081234567891 |
| ADMIN | admin@japlo.com | admin123 | 089999999999 |

---

## 📝 Quick Commands

### Cek Database
```bash
php cek_database_users.php
```

### Reset Database & Seed
```bash
php artisan migrate:fresh --seed
```

### Run Seeder Only
```bash
php artisan db:seed --class=AdminSeeder
```

### Cek Migration Status
```bash
php artisan migrate:status
```

### Rollback Last Migration
```bash
php artisan migrate:rollback
```

### Fresh Start
```bash
php artisan migrate:fresh
php artisan db:seed --class=AdminSeeder
```

---

## 🎯 Checklist Role Database

Jalankan `php cek_database_users.php` dan pastikan:

- [ ] Database connection sukses
- [ ] Table users ada
- [ ] Kolom role bertipe `enum('user','driver','admin')`
- [ ] Minimal 1 user dengan role 'user'
- [ ] Minimal 1 user dengan role 'driver'
- [ ] Minimal 1 user dengan role 'admin'
- [ ] Demo accounts lengkap (3 akun)

---

**Dibuat untuk:** JAPLO App  
**Versi:** 1.0  
**Tanggal:** 15 Juli 2026
