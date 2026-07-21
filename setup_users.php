<?php
/**
 * Setup Demo Users - JAPLO App
 * Jalankan: php setup_users.php
 */

echo "================================================\n";
echo "   SETUP DEMO USERS - JAPLO APP\n";
echo "================================================\n\n";

// Load Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

try {
    echo "[1] Testing database connection...\n";
    DB::connection()->getPdo();
    echo "    ✓ Connected to database: " . DB::connection()->getDatabaseName() . "\n\n";
    
    // Demo users data
    $demoUsers = [
        [
            'name' => 'Admin JAPLO',
            'email' => 'admin@japlo.com',
            'password' => 'admin123',
            'phone' => '089999999999',
            'role' => 'admin',
        ],
        [
            'name' => 'Demo User',
            'email' => 'demo@japlo.com',
            'password' => 'password123',
            'phone' => '081234567890',
            'role' => 'user',
        ],
        [
            'name' => 'Demo Driver',
            'email' => 'driver@japlo.com',
            'password' => 'password123',
            'phone' => '081234567891',
            'role' => 'driver',
        ],
    ];
    
    echo "[2] Creating/Updating demo users...\n";
    
    foreach ($demoUsers as $userData) {
        try {
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']),
                    'phone' => $userData['phone'],
                    'role' => $userData['role'],
                ]
            );
            
            echo "    ✓ " . strtoupper($userData['role']) . ": {$userData['email']}\n";
            echo "      → Password: {$userData['password']}\n";
            
        } catch (\Exception $e) {
            echo "    ✗ Error creating {$userData['email']}: " . $e->getMessage() . "\n";
        }
    }
    
    echo "\n[3] Verifying users...\n";
    $users = User::whereIn('email', ['admin@japlo.com', 'demo@japlo.com', 'driver@japlo.com'])->get();
    
    if ($users->count() === 3) {
        echo "    ✓ All 3 demo users created successfully!\n\n";
    } else {
        echo "    ⚠ Warning: Only {$users->count()} users found\n\n";
    }
    
    echo "================================================\n";
    echo "   SETUP COMPLETED!\n";
    echo "================================================\n\n";
    
    echo "LOGIN CREDENTIALS:\n";
    echo "------------------\n\n";
    
    echo "ADMIN:\n";
    echo "  URL     : http://localhost:8000/login\n";
    echo "  Email   : admin@japlo.com\n";
    echo "  Password: admin123\n";
    echo "  Phone   : 089999999999\n\n";
    
    echo "PENUMPANG:\n";
    echo "  URL     : http://localhost:8000/login\n";
    echo "  Email   : demo@japlo.com\n";
    echo "  Password: password123\n";
    echo "  Phone   : 081234567890\n\n";
    
    echo "DRIVER:\n";
    echo "  URL     : http://localhost:8000/login\n";
    echo "  Email   : driver@japlo.com\n";
    echo "  Password: password123\n";
    echo "  Phone   : 081234567891\n\n";
    
    echo "================================================\n";
    echo "NEXT STEPS:\n";
    echo "1. Jalankan server: php artisan serve\n";
    echo "   atau klik 2x: 1_JALANKAN_INI.bat\n";
    echo "2. Buka browser: http://localhost:8000/login\n";
    echo "3. Login dengan kredensial di atas\n";
    echo "================================================\n\n";
    
} catch (\Exception $e) {
    echo "\n❌ ERROR: " . $e->getMessage() . "\n\n";
    
    if (strpos($e->getMessage(), 'refused') !== false) {
        echo "SOLUSI:\n";
        echo "  MySQL belum running!\n";
        echo "  1. Buka XAMPP Control Panel\n";
        echo "  2. Start MySQL (tunggu hijau)\n";
        echo "  3. Jalankan script ini lagi\n\n";
    } elseif (strpos($e->getMessage(), 'Unknown database') !== false) {
        echo "SOLUSI:\n";
        echo "  Database 'japlo_db' belum ada!\n";
        echo "  1. Buka: http://localhost/phpmyadmin\n";
        echo "  2. Klik 'New'\n";
        echo "  3. Database name: japlo_db\n";
        echo "  4. Klik 'Create'\n";
        echo "  5. Run: php artisan migrate\n";
        echo "  6. Jalankan script ini lagi\n\n";
    } elseif (strpos($e->getMessage(), "doesn't exist") !== false || strpos($e->getMessage(), 'no such table') !== false) {
        echo "SOLUSI:\n";
        echo "  Table 'users' belum ada!\n";
        echo "  1. Run: php artisan migrate\n";
        echo "  2. Jalankan script ini lagi\n\n";
    }
    
    exit(1);
}
