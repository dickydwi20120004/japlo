<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== CEK DATABASE ===\n\n";

try {
    // Cek connection
    DB::connection()->getPdo();
    echo "✓ Database connected\n";
    
    // Cek database name
    $dbName = DB::connection()->getDatabaseName();
    echo "✓ Database: $dbName\n\n";
    
    // Cek table users
    $tables = DB::select("SHOW TABLES LIKE 'users'");
    if (count($tables) > 0) {
        echo "✓ Table 'users' exists\n\n";
        
        // Cek users
        $count = DB::table('users')->count();
        echo "Total users: $count\n\n";
        
        if ($count > 0) {
            echo "Users list:\n";
            $users = DB::table('users')->select('id', 'name', 'email', 'role')->get();
            foreach ($users as $u) {
                echo "  {$u->id}. {$u->email} ({$u->role})\n";
            }
        } else {
            echo "✗ NO USERS FOUND!\n";
            echo "Run: php setup_users.php\n";
        }
    } else {
        echo "✗ Table 'users' NOT FOUND!\n";
        echo "Run: php artisan migrate\n";
    }
    
} catch (\Exception $e) {
    echo "✗ ERROR: " . $e->getMessage() . "\n";
}
