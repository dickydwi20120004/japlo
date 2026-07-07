<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "=== TEST LOGIN CREDENTIALS ===\n\n";

// Test dengan user pertama
$user = User::where('email', 'Dickyputra@gmail.com')->first();

if ($user) {
    echo "User ditemukan!\n";
    echo "Email: {$user->email}\n";
    echo "Name: {$user->name}\n";
    echo "Role: {$user->role}\n\n";
    
    // Test password
    $testPasswords = ['password', '12345678', 'admin123', 'dickyputra'];
    
    echo "Testing beberapa password umum...\n";
    foreach ($testPasswords as $pass) {
        if (Hash::check($pass, $user->password)) {
            echo "✅ PASSWORD DITEMUKAN: {$pass}\n";
            break;
        } else {
            echo "❌ Bukan: {$pass}\n";
        }
    }
    
    echo "\n=== CARA LOGIN ===\n";
    echo "1. Akses: http://localhost:8000/login\n";
    echo "2. Email: {$user->email}\n";
    echo "3. Password: [gunakan password yang Anda buat saat registrasi]\n";
    echo "\nAtau buat user baru di: http://localhost:8000/register\n";
} else {
    echo "User tidak ditemukan!\n";
}
