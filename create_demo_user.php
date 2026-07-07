<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "=== MEMBUAT USER DEMO ===\n\n";

// Cek apakah user demo sudah ada
$existingUser = User::where('email', 'demo@japlo.com')->first();

if ($existingUser) {
    echo "User demo sudah ada! Menghapus user lama...\n";
    $existingUser->delete();
}

// Buat user demo customer
$customer = User::create([
    'name' => 'Demo Customer',
    'email' => 'demo@japlo.com',
    'phone' => '081234567890',
    'password' => Hash::make('password123'),
    'role' => 'user',
]);

echo "✅ User Customer berhasil dibuat!\n";
echo "Email: demo@japlo.com\n";
echo "Password: password123\n";
echo "Role: Customer (Penumpang)\n\n";

// Buat user demo driver
$driver = User::create([
    'name' => 'Demo Driver',
    'email' => 'driver@japlo.com',
    'phone' => '081234567891',
    'password' => Hash::make('password123'),
    'role' => 'driver',
]);

// Buat profil driver
$driver->driver()->create([
    'vehicle_type' => 'motor',
    'vehicle_brand' => 'Honda Beat',
    'license_plate' => 'B 1234 XYZ',
    'license_number' => 'SIM123456789',
    'address' => 'Jakarta',
    'is_available' => true,
    'rating' => 4.5,
    'total_rides' => 100,
    'total_earnings' => 5000000,
]);

echo "✅ User Driver berhasil dibuat!\n";
echo "Email: driver@japlo.com\n";
echo "Password: password123\n";
echo "Role: Driver\n\n";

echo "=== CARA LOGIN ===\n";
echo "1. Akses: http://localhost:8000/login\n";
echo "2. Login sebagai Customer:\n";
echo "   - Email: demo@japlo.com\n";
echo "   - Password: password123\n\n";
echo "3. Atau login sebagai Driver:\n";
echo "   - Email: driver@japlo.com\n";
echo "   - Password: password123\n\n";

echo "Setelah login, Anda akan melihat dashboard dengan 8 icon menu layanan!\n";
