<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Users ──────────────────────────────────────────
        if (!User::where('email', 'admin@japlo.com')->exists()) {
            User::create([
                'name'               => 'Admin JAPLO',
                'email'              => 'admin@japlo.com',
                'password'           => Hash::make('admin123'),
                'phone'              => '089999999999',
                'role'               => 'admin',
                'email_verified_at'  => now(),
            ]);
            $this->command->info('✓ Admin user created');
        }

        if (!User::where('email', 'demo@japlo.com')->exists()) {
            User::create([
                'name'               => 'Budi Santoso',
                'email'              => 'demo@japlo.com',
                'password'           => Hash::make('password123'),
                'phone'              => '081234567890',
                'role'               => 'user',
                'email_verified_at'  => now(),
            ]);
            $this->command->info('✓ Customer user created');
        }

        if (!User::where('email', 'driver@japlo.com')->exists()) {
            $driverUser = User::create([
                'name'               => 'Ahmad Fauzi',
                'email'              => 'driver@japlo.com',
                'password'           => Hash::make('password123'),
                'phone'              => '081987654321',
                'role'               => 'driver',
                'email_verified_at'  => now(),
            ]);
            $driverUser->driver()->create([
                'vehicle_type'   => 'motor',
                'vehicle_brand'  => 'Honda Beat',
                'license_plate'  => 'BP 1234 AX',
                'license_number' => '1234567890987654',
                'address'        => 'Jl. Trikora No. 5, Tanjung Uban, Bintan',
                'is_available'   => true,
                'is_verified'    => true,
                'rating'         => 4.8,
                'total_rides'    => 156,
                'total_earnings' => 4680000,
            ]);
            $this->command->info('✓ Driver user created');
        }

        // ── Service Data ───────────────────────────────────
        $this->call([
            TariffSeeder::class,
            RestaurantSeeder::class,
            HealthServiceSeeder::class,
            ProductSeeder::class,
            PromotionSeeder::class,
            ArticleSeeder::class,
        ]);

        $this->command->newLine();
        $this->command->info('✅ Semua data berhasil di-seed!');
        $this->command->table(
            ['Role', 'Email', 'Password'],
            [
                ['Admin',    'admin@japlo.com',  'admin123'],
                ['Customer', 'demo@japlo.com',   'password123'],
                ['Driver',   'driver@japlo.com', 'password123'],
            ]
        );
    }
}

