# JAPLO Backend API

Backend API untuk aplikasi JAPLO (Jasa Pengantar Lokal) - Platform ojek online.

## Fitur Utama

- ✅ Autentikasi User & Driver (Laravel Sanctum)
- ✅ Manajemen Profil User & Driver
- ✅ Sistem Pemesanan Ojek (Booking)
- ✅ Real-time Tracking Lokasi Driver
- ✅ Sistem Rating & Review
- ✅ Riwayat Perjalanan
- ✅ Manajemen Pembayaran
- ✅ Notifikasi Push

## Teknologi

- Laravel 10.x
- MySQL Database
- Laravel Sanctum (API Authentication)
- RESTful API

## Instalasi

1. Clone repository
2. Install dependencies:
```bash
composer install
```

3. Copy file environment:
```bash
copy .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Buat database `japlo_db` di MySQL

6. Jalankan migrasi:
```bash
php artisan migrate
```

7. (Optional) Seed data dummy:
```bash
php artisan db:seed
```

8. Jalankan server:
```bash
php artisan serve
```

API akan berjalan di `http://localhost:8000`

## API Endpoints

### Authentication
- `POST /api/register` - Register user baru
- `POST /api/login` - Login user/driver
- `POST /api/logout` - Logout
- `GET /api/user` - Get user profile

### Driver
- `POST /api/driver/register` - Register driver baru
- `PUT /api/driver/profile` - Update profil driver
- `POST /api/driver/location` - Update lokasi driver
- `GET /api/driver/orders` - List pesanan driver
- `PUT /api/driver/order/{id}/accept` - Terima pesanan
- `PUT /api/driver/order/{id}/complete` - Selesaikan pesanan

### Booking/Orders
- `POST /api/orders` - Buat pesanan baru
- `GET /api/orders` - List pesanan user
- `GET /api/orders/{id}` - Detail pesanan
- `PUT /api/orders/{id}/cancel` - Cancel pesanan
- `GET /api/orders/nearby-drivers` - Cari driver terdekat

### Rating
- `POST /api/ratings` - Beri rating setelah perjalanan
- `GET /api/ratings/driver/{id}` - Rating driver

## Database Schema

### Users Table
- id, name, email, password, phone, role (user/driver), timestamps

### Drivers Table
- id, user_id, vehicle_type, vehicle_number, license_number, is_available, current_latitude, current_longitude, rating, total_rides, timestamps

### Orders Table
- id, user_id, driver_id, pickup_address, pickup_latitude, pickup_longitude, destination_address, destination_latitude, destination_longitude, distance, price, status (pending/accepted/completed/cancelled), payment_method, timestamps

### Ratings Table
- id, order_id, user_id, driver_id, rating, review, timestamps

## Status Pesanan

- `pending` - Menunggu driver
- `accepted` - Driver menerima pesanan
- `picked_up` - Driver sampai di lokasi pickup
- `in_progress` - Perjalanan berlangsung
- `completed` - Perjalanan selesai
- `cancelled` - Pesanan dibatalkan

## Lisensi

MIT License
