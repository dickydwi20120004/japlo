<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        if (!User::where('email', 'admin@japlo.com')->exists()) {
            User::create([
                'name' => 'Admin JAPLO',
                'email' => 'admin@japlo.com',
                'password' => Hash::make('admin123'),
                'phone' => '089999999999',
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);
            echo "✓ Admin user created\n";
        }

        // Create Customer/Penumpang User
        if (!User::where('email', 'demo@japlo.com')->exists()) {
            User::create([
                'name' => 'Budi Penumpang',
                'email' => 'demo@japlo.com',
                'password' => Hash::make('password123'),
                'phone' => '081234567890',
                'role' => 'user',
                'email_verified_at' => now(),
            ]);
            echo "✓ Customer (Penumpang) user created\n";
        }

        // Create Driver User
        if (!User::where('email', 'driver@japlo.com')->exists()) {
            $driver = User::create([
                'name' => 'Ahmad Driver',
                'email' => 'driver@japlo.com',
                'password' => Hash::make('password123'),
                'phone' => '081987654321',
                'role' => 'driver',
                'email_verified_at' => now(),
            ]);

            // Create driver profile
            $driver->driver()->create([
                'vehicle_type' => 'motor',
                'vehicle_brand' => 'Honda Beat',
                'license_plate' => 'B 1234 ABC',
                'license_number' => '1234567890987654',
                'address' => 'Jl. Merdeka No. 123, Jakarta',
                'is_available' => true,
                'is_verified' => true,
                'rating' => 4.8,
                'total_rides' => 156,
                'total_earnings' => 4680000,
            ]);
            echo "✓ Driver user created\n";
        }

        echo "\n✅ Database seeded successfully!\n\n";
        echo "Demo Users Created:\n";
        echo "===================\n\n";
        echo "1. ADMIN:\n";
        echo "   Email: admin@japlo.com\n";
        echo "   Password: admin123\n";
        echo "   Role: Admin (dapat akses admin dashboard)\n\n";
        echo "2. CUSTOMER (Penumpang):\n";
        echo "   Email: demo@japlo.com\n";
        echo "   Password: password123\n";
        echo "   Role: Penumpang (dapat akses customer services)\n\n";
        echo "3. DRIVER:\n";
        echo "   Email: driver@japlo.com\n";
        echo "   Password: password123\n";
        echo "   Role: Driver (dapat akses driver dashboard)\n\n";
    }
}
