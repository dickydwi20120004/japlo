<?php
/**
 * Script untuk cek users dan roles di database
 * Jalankan: php cek_database_users.php
 */

echo "================================================\n";
echo "   CEK USERS & ROLES - JAPLO APP DATABASE\n";
echo "================================================\n\n";

// Load Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    // Test koneksi database
    echo "[1] Testing database connection...\n";
    DB::connection()->getPdo();
    echo "    ✓ Database connected successfully!\n\n";
    
    // Cek struktur table users
    echo "[2] Checking users table structure...\n";
    $columns = DB::select("DESCRIBE users");
    echo "    Columns in 'users' table:\n";
    foreach ($columns as $column) {
        echo "    - {$column->Field} ({$column->Type})\n";
        if ($column->Field === 'role') {
            echo "      → Role enum values: {$column->Type}\n";
        }
    }
    echo "\n";
    
    // Cek semua users
    echo "[3] List all users in database...\n";
    $users = DB::table('users')
        ->select('id', 'name', 'email', 'role', 'phone')
        ->orderBy('role')
        ->orderBy('id')
        ->get();
    
    if ($users->isEmpty()) {
        echo "    ⚠ No users found in database!\n";
        echo "    → Run: php artisan db:seed --class=AdminSeeder\n\n";
    } else {
        echo "    Total users: " . $users->count() . "\n\n";
        echo "    " . str_pad("ID", 5) . str_pad("Name", 25) . str_pad("Email", 30) . str_pad("Role", 12) . "Phone\n";
        echo "    " . str_repeat("-", 95) . "\n";
        
        foreach ($users as $user) {
            echo "    " . 
                str_pad($user->id, 5) . 
                str_pad($user->name, 25) . 
                str_pad($user->email, 30) . 
                str_pad(strtoupper($user->role), 12) . 
                $user->phone . "\n";
        }
        echo "\n";
    }
    
    // Cek jumlah per role
    echo "[4] Users count by role...\n";
    $roleCounts = DB::table('users')
        ->select('role', DB::raw('count(*) as total'))
        ->groupBy('role')
        ->get();
    
    if ($roleCounts->isEmpty()) {
        echo "    ⚠ No users found!\n\n";
    } else {
        foreach ($roleCounts as $roleCount) {
            $roleLabel = strtoupper($roleCount->role);
            echo "    - {$roleLabel}: {$roleCount->total} user(s)\n";
        }
        echo "\n";
    }
    
    // Cek demo accounts
    echo "[5] Checking demo accounts...\n";
    $demoAccounts = [
        ['email' => 'demo@japlo.com', 'expected_role' => 'user'],
        ['email' => 'driver@japlo.com', 'expected_role' => 'driver'],
        ['email' => 'admin@japlo.com', 'expected_role' => 'admin'],
    ];
    
    foreach ($demoAccounts as $demo) {
        $user = DB::table('users')
            ->where('email', $demo['email'])
            ->first();
        
        if ($user) {
            $status = ($user->role === $demo['expected_role']) ? '✓' : '✗';
            echo "    {$status} {$demo['email']} - Role: " . strtoupper($user->role) . "\n";
        } else {
            echo "    ✗ {$demo['email']} - NOT FOUND\n";
        }
    }
    echo "\n";
    
    // Cek role enum values
    echo "[6] Checking role enum values in database...\n";
    $roleColumn = DB::select("SHOW COLUMNS FROM users WHERE Field = 'role'");
    if ($roleColumn) {
        $enumValues = $roleColumn[0]->Type;
        echo "    Current role enum: {$enumValues}\n";
        
        // Check if all required roles exist
        $requiredRoles = ['user', 'driver', 'admin'];
        foreach ($requiredRoles as $role) {
            if (strpos($enumValues, "'{$role}'") !== false) {
                echo "    ✓ '{$role}' role is available\n";
            } else {
                echo "    ✗ '{$role}' role is MISSING\n";
            }
        }
    }
    echo "\n";
    
    echo "================================================\n";
    echo "   DATABASE CHECK COMPLETED\n";
    echo "================================================\n\n";
    
    // Recommendations
    echo "RECOMMENDATIONS:\n";
    if ($users->isEmpty()) {
        echo "  1. Run seeder: php artisan db:seed --class=AdminSeeder\n";
        echo "  2. Or create demo users: php create_demo_user.php\n";
    }
    
    $hasAdmin = DB::table('users')->where('role', 'admin')->exists();
    if (!$hasAdmin) {
        echo "  • No admin user found! Run: php artisan db:seed --class=AdminSeeder\n";
    }
    
    $hasUser = DB::table('users')->where('role', 'user')->exists();
    if (!$hasUser) {
        echo "  • No regular user found! Register via: http://localhost:8000/register\n";
    }
    
    $hasDriver = DB::table('users')->where('role', 'driver')->exists();
    if (!$hasDriver) {
        echo "  • No driver found! Register as driver via: http://localhost:8000/register?role=driver\n";
    }
    
    echo "\n";
    
} catch (\Exception $e) {
    echo "\n❌ ERROR: " . $e->getMessage() . "\n\n";
    
    if (strpos($e->getMessage(), 'refused') !== false) {
        echo "SOLUTION:\n";
        echo "  1. Buka XAMPP Control Panel\n";
        echo "  2. Start MySQL (klik tombol 'Start' di baris MySQL)\n";
        echo "  3. Tunggu hingga status MySQL menjadi 'Running'\n";
        echo "  4. Jalankan script ini lagi\n\n";
    } elseif (strpos($e->getMessage(), 'Access denied') !== false) {
        echo "SOLUTION:\n";
        echo "  1. Cek file .env, pastikan:\n";
        echo "     DB_USERNAME=root\n";
        echo "     DB_PASSWORD=\n";
        echo "  2. Atau sesuaikan dengan kredensial MySQL Anda\n\n";
    } elseif (strpos($e->getMessage(), 'Unknown database') !== false) {
        echo "SOLUTION:\n";
        echo "  1. Buat database: php artisan db:create (jika ada command)\n";
        echo "  2. Atau manual via phpMyAdmin:\n";
        echo "     - Buka: http://localhost/phpmyadmin\n";
        echo "     - Create database: japlo_db\n";
        echo "  3. Run migrations: php artisan migrate\n\n";
    }
}
