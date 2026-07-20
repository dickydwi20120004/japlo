<?php
/**
 * Script untuk test login functionality
 * Jalankan: php test_login.php
 */

echo "================================================\n";
echo "   TEST LOGIN - JAPLO APP\n";
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
    // Test koneksi database
    echo "[1] Testing database connection...\n";
    DB::connection()->getPdo();
    echo "    ✓ Database connected!\n\n";
    
    // Demo accounts to test
    $demoAccounts = [
        [
            'name' => 'Demo User',
            'email' => 'demo@japlo.com',
            'password' => 'password123',
            'role' => 'user',
            'phone' => '081234567890',
        ],
        [
            'name' => 'Demo Driver',
            'email' => 'driver@japlo.com',
            'password' => 'password123',
            'role' => 'driver',
            'phone' => '081234567891',
        ],
        [
            'name' => 'Admin JAPLO',
            'email' => 'admin@japlo.com',
            'password' => 'admin123',
            'role' => 'admin',
            'phone' => '089999999999',
        ],
    ];
    
    echo "[2] Checking/Creating demo accounts...\n";
    foreach ($demoAccounts as $account) {
        $user = User::where('email', $account['email'])->first();
        
        if ($user) {
            echo "    ✓ {$account['email']} - EXISTS\n";
            
            // Verify password
            if (Hash::check($account['password'], $user->password)) {
                echo "      → Password is CORRECT\n";
            } else {
                echo "      → Password MISMATCH! Updating...\n";
                $user->password = Hash::make($account['password']);
                $user->save();
                echo "      → Password UPDATED\n";
            }
        } else {
            echo "    ✗ {$account['email']} - NOT FOUND. Creating...\n";
            
            try {
                $newUser = User::create([
                    'name' => $account['name'],
                    'email' => $account['email'],
                    'password' => Hash::make($account['password']),
                    'phone' => $account['phone'],
                    'role' => $account['role'],
                ]);
                echo "      → CREATED with ID: {$newUser->id}\n";
            } catch (\Exception $e) {
                echo "      → ERROR: " . $e->getMessage() . "\n";
            }
        }
    }
    echo "\n";
    
    // Test authentication
    echo "[3] Testing authentication for each account...\n";
    foreach ($demoAccounts as $account) {
        $user = User::where('email', $account['email'])->first();
        
        if (!$user) {
            echo "    ✗ {$account['email']} - USER NOT FOUND\n";
            continue;
        }
        
        if (Hash::check($account['password'], $user->password)) {
            echo "    ✓ {$account['email']} - AUTH SUCCESS\n";
            echo "      → Role: " . strtoupper($user->role) . "\n";
            echo "      → Name: {$user->name}\n";
            echo "      → Phone: {$user->phone}\n";
        } else {
            echo "    ✗ {$account['email']} - AUTH FAILED (Wrong password)\n";
        }
    }
    echo "\n";
    
    // Summary
    echo "[4] Summary...\n";
    $totalUsers = User::count();
    $userCount = User::where('role', 'user')->count();
    $driverCount = User::where('role', 'driver')->count();
    $adminCount = User::where('role', 'admin')->count();
    
    echo "    Total users: {$totalUsers}\n";
    echo "    - USER: {$userCount}\n";
    echo "    - DRIVER: {$driverCount}\n";
    echo "    - ADMIN: {$adminCount}\n";
    echo "\n";
    
    echo "================================================\n";
    echo "   TEST COMPLETED\n";
    echo "================================================\n\n";
    
    echo "LOGIN CREDENTIALS:\n";
    echo "------------------\n";
    foreach ($demoAccounts as $account) {
        echo "Role: " . strtoupper($account['role']) . "\n";
        echo "Email: {$account['email']}\n";
        echo "Pass : {$account['password']}\n";
        echo "\n";
    }
    
    echo "TEST LOGIN:\n";
    echo "-----------\n";
    echo "1. Buka: http://localhost:8000/login\n";
    echo "2. Gunakan salah satu kredensial di atas\n";
    echo "3. Klik tombol demo atau isi manual\n";
    echo "4. Login harus berhasil!\n\n";
    
    if ($totalUsers === 0) {
        echo "⚠ WARNING: No users in database!\n";
        echo "   Run this script again or run seeder.\n\n";
    }
    
} catch (\Exception $e) {
    echo "\n❌ ERROR: " . $e->getMessage() . "\n\n";
    echo $e->getTraceAsString() . "\n\n";
    
    if (strpos($e->getMessage(), 'refused') !== false) {
        echo "SOLUTION:\n";
        echo "  1. Buka XAMPP Control Panel\n";
        echo "  2. Start MySQL\n";
        echo "  3. Jalankan script ini lagi\n\n";
    } elseif (strpos($e->getMessage(), 'Unknown database') !== false) {
        echo "SOLUTION:\n";
        echo "  1. Buat database 'japlo_db' di phpMyAdmin\n";
        echo "  2. Run: php artisan migrate\n";
        echo "  3. Jalankan script ini lagi\n\n";
    } elseif (strpos($e->getMessage(), "doesn't exist") !== false) {
        echo "SOLUTION:\n";
        echo "  1. Run migrations: php artisan migrate\n";
        echo "  2. Jalankan script ini lagi\n\n";
    }
}
