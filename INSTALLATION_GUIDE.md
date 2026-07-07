# 📘 Panduan Instalasi JAPLO - Step by Step

Panduan lengkap instalasi aplikasi JAPLO dari awal sampai aplikasi berjalan.

## 📋 Kebutuhan Sistem

### Untuk Backend (Laravel)
- Windows 10/11 atau Linux atau macOS
- XAMPP 8.1 atau lebih tinggi (sudah include PHP & MySQL)
- Composer (PHP Package Manager)
- Text Editor (VS Code, Sublime, PHPStorm, dll)

### Untuk Mobile App (Flutter)
- Flutter SDK 3.x
- Android Studio (untuk Android development)
- Xcode (untuk iOS development - hanya macOS)
- Google Maps API Key

## 🔧 Instalasi Prerequisites

### 1. Install XAMPP

1. Download XAMPP dari https://www.apachefriends.org/
2. Install XAMPP dengan default settings
3. Buka XAMPP Control Panel
4. Start Apache dan MySQL

### 2. Install Composer

1. Download Composer dari https://getcomposer.org/download/
2. Install dengan mengikuti wizard
3. Verify instalasi:
```bash
composer --version
```

### 3. Install Flutter

1. Download Flutter SDK dari https://flutter.dev/docs/get-started/install
2. Extract ke folder (misal: C:\src\flutter)
3. Tambahkan Flutter ke PATH environment variable:
   - Path: `C:\src\flutter\bin`
4. Buka Command Prompt dan run:
```bash
flutter doctor
```
5. Follow instruksi untuk install dependencies yang missing

### 4. Install Android Studio (untuk Android development)

1. Download dari https://developer.android.com/studio
2. Install dengan default settings
3. Buka Android Studio
4. Go to: File > Settings > Plugins
5. Install plugin: Flutter & Dart
6. Setup Android SDK dan emulator

### 5. Dapatkan Google Maps API Key

1. Buka https://console.cloud.google.com/
2. Buat project baru atau pilih existing
3. Go to: APIs & Services > Library
4. Enable APIs berikut:
   - Maps SDK for Android
   - Maps SDK for iOS
   - Directions API
   - Distance Matrix API
   - Geocoding API
   - Places API
5. Go to: APIs & Services > Credentials
6. Create credentials > API Key
7. Copy API Key yang dihasilkan
8. (Recommended) Restrict API Key untuk security

## 🚀 Setup Backend Laravel

### Step 1: Persiapan Database

1. Buka browser dan akses: http://localhost/phpmyadmin
2. Login (default: username=root, password=kosong)
3. Klik "New" untuk buat database baru
4. Nama database: `japlo_db`
5. Collation: `utf8mb4_unicode_ci`
6. Klik "Create"

### Step 2: Setup Laravel Project

1. Buka Command Prompt atau Terminal
2. Navigate ke folder backend:
```bash
cd "C:\xampp\htdocs\Japlo App\Japlo Web\japlo-project\laravel-backend"
```

3. Install dependencies:
```bash
composer install
```

4. Copy file .env.example menjadi .env:
```bash
copy .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Edit file .env dengan text editor, update:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=japlo_db
DB_USERNAME=root
DB_PASSWORD=
```

7. Jalankan migrasi database:
```bash
php artisan migrate
```

Output yang benar:
```
Migration table created successfully.
Migrating: 2024_01_01_000001_create_users_table
Migrated:  2024_01_01_000001_create_users_table
Migrating: 2024_01_01_000002_create_drivers_table
Migrated:  2024_01_01_000002_create_drivers_table
...
```

8. (Optional) Seed database dengan data dummy:
```bash
php artisan db:seed
```

### Step 3: Jalankan Backend Server

```bash
php artisan serve
```

Output:
```
Starting Laravel development server: http://127.0.0.1:8000
```

Server backend sekarang berjalan di: **http://localhost:8000**

### Step 4: Test API

Buka browser dan akses: http://localhost:8000/api/health

Response yang benar:
```json
{
  "success": true,
  "message": "JAPLO API is running",
  "version": "1.0.0",
  "timestamp": "2024-01-01T12:00:00.000000Z"
}
```

✅ **Backend sudah siap!**

## 📱 Setup Flutter Mobile App

### Step 1: Install Dependencies

1. Buka Command Prompt baru (jangan tutup yang backend)
2. Navigate ke folder flutter:
```bash
cd "C:\xampp\htdocs\Japlo App\Japlo Web\japlo-project\flutter-app"
```

3. Install dependencies:
```bash
flutter pub get
```

Output akan menampilkan list packages yang terinstall.

### Step 2: Konfigurasi API Base URL

1. Buka file: `lib/config/api_config.dart`
2. Update baseUrl:
```dart
static const String baseUrl = 'http://10.0.2.2:8000/api'; // untuk Android Emulator
// atau
static const String baseUrl = 'http://localhost:8000/api'; // untuk iOS Simulator
// atau
static const String baseUrl = 'http://192.168.1.x:8000/api'; // untuk real device
```

**Note:** 
- `10.0.2.2` adalah alias untuk localhost di Android Emulator
- Untuk real device, gunakan IP komputer di network yang sama

### Step 3: Setup Google Maps API Key

#### Untuk Android:

1. Buka file: `android/app/src/main/AndroidManifest.xml`
2. Tambahkan di dalam tag `<application>`:
```xml
<meta-data
    android:name="com.google.android.geo.API_KEY"
    android:value="YOUR_GOOGLE_MAPS_API_KEY_HERE"/>
```

#### Untuk iOS:

1. Buka file: `ios/Runner/AppDelegate.swift`
2. Tambahkan import dan konfigurasi:
```swift
import UIKit
import Flutter
import GoogleMaps

@UIApplicationMain
@objc class AppDelegate: FlutterAppDelegate {
  override func application(
    _ application: UIApplication,
    didFinishLaunchingWithOptions launchOptions: [UIApplication.LaunchOptionsKey: Any]?
  ) -> Bool {
    GMSServices.provideAPIKey("YOUR_GOOGLE_MAPS_API_KEY_HERE")
    GeneratedPluginRegistrant.register(with: self)
    return super.application(application, didFinishLaunchingWithOptions: launchOptions)
  }
}
```

3. Juga update file: `lib/config/api_config.dart`
```dart
static const String googleMapsApiKey = 'YOUR_GOOGLE_MAPS_API_KEY_HERE';
```

### Step 4: Jalankan Aplikasi

#### Menggunakan Emulator/Simulator:

1. Buka Android Studio
2. Start Android Emulator (AVD Manager)
3. Atau untuk iOS: buka Simulator dari Xcode

4. Check device tersedia:
```bash
flutter devices
```

5. Run aplikasi:
```bash
flutter run
```

#### Menggunakan Real Device:

**Android:**
1. Enable Developer Options di Android device
2. Enable USB Debugging
3. Connect device via USB
4. Run: `flutter run`

**iOS:**
1. Connect iPhone via USB
2. Trust computer di iPhone
3. Open project di Xcode
4. Run dari Xcode atau `flutter run`

### Step 5: Build APK untuk Production

```bash
# Build APK
flutter build apk --release

# Output ada di:
# build/app/outputs/flutter-apk/app-release.apk
```

```bash
# Build App Bundle (untuk Google Play Store)
flutter build appbundle --release

# Output ada di:
# build/app/outputs/bundle/release/app-release.aab
```

✅ **Mobile App sudah siap!**

## 🧪 Testing Aplikasi

### Test Flow Customer:

1. **Register Customer**
   - Buka aplikasi
   - Tap "Daftar"
   - Pilih "Penumpang"
   - Isi form registrasi
   - Tap "Daftar"

2. **Login**
   - Email & password yang didaftarkan
   - Tap "Masuk"

3. **Home Screen**
   - Lihat dashboard customer
   - Tap "Pesan Ojek Sekarang"

### Test Flow Driver:

1. **Register Driver**
   - Buka aplikasi di device lain atau logout
   - Tap "Daftar"
   - Pilih "Driver"
   - Isi form registrasi
   - Tap "Daftar"

2. **Complete Driver Profile**
   - Lengkapi data kendaraan
   - Upload dokumen (SIM, STNK, dll)

3. **Toggle Status**
   - Go to Home tab
   - Toggle switch ke "Online"
   - Mulai terima pesanan

## ❗ Troubleshooting Common Issues

### Backend Issues

**Issue: Migration Failed**
```
SQLSTATE[HY000] [1045] Access denied for user 'root'@'localhost'
```
**Solution:** 
- Pastikan MySQL di XAMPP sudah running
- Cek username & password di .env file
- Cek apakah database `japlo_db` sudah dibuat

**Issue: Class not found**
```
Class 'App\Http\Controllers\Api\AuthController' not found
```
**Solution:**
```bash
composer dump-autoload
php artisan config:clear
php artisan cache:clear
```

### Flutter Issues

**Issue: Pub get failed**
```
pub get failed
```
**Solution:**
```bash
flutter clean
flutter pub get
```

**Issue: Google Maps tidak muncul**
```
Map shows blank/grey screen
```
**Solution:**
- Cek API Key sudah benar
- Pastikan semua Maps APIs sudah di-enable
- Cek API Key tidak ter-restrict

**Issue: Cannot connect to API**
```
SocketException: Failed host lookup
```
**Solution:**
- Cek backend server masih running
- Update base URL di api_config.dart
- Untuk Android Emulator gunakan `10.0.2.2` bukan `localhost`
- Untuk real device gunakan IP lokal komputer (192.168.x.x)

**Issue: Build failed Android**
```
Execution failed for task ':app:processDebugResources'
```
**Solution:**
```bash
cd android
./gradlew clean
cd ..
flutter clean
flutter pub get
flutter run
```

## 🔒 Security Tips untuk Production

1. **Backend:**
   - Ubah `APP_DEBUG=false` di .env
   - Generate new `APP_KEY`
   - Gunakan HTTPS dengan SSL certificate
   - Restrict database access
   - Enable rate limiting
   - Setup CORS dengan benar

2. **Mobile App:**
   - Restrict Google Maps API Key
   - Obfuscate code saat build
   - Enable ProGuard untuk Android
   - Setup SSL pinning
   - Validate all user inputs

3. **Database:**
   - Gunakan strong password
   - Backup database secara rutin
   - Limit database user permissions

## 📞 Butuh Bantuan?

Jika mengalami kesulitan:
1. Cek dokumentasi resmi Laravel: https://laravel.com/docs
2. Cek dokumentasi Flutter: https://flutter.dev/docs
3. Search di Stack Overflow
4. Baca error message dengan teliti

## ✅ Checklist Instalasi

- [ ] XAMPP terinstall dan running
- [ ] Composer terinstall
- [ ] Flutter SDK terinstall
- [ ] Android Studio/Xcode setup
- [ ] Database `japlo_db` dibuat
- [ ] Backend dependencies terinstall
- [ ] Backend migration berhasil
- [ ] Backend server running di localhost:8000
- [ ] API health check berhasil
- [ ] Flutter dependencies terinstall
- [ ] Google Maps API Key dikonfigurasi
- [ ] API base URL dikonfigurasi
- [ ] Aplikasi berhasil dijalankan
- [ ] Register & login berhasil

**Selamat! Aplikasi JAPLO sudah siap digunakan! 🎉**
