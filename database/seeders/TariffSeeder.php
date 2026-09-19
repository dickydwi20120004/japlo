<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tariff;

class TariffSeeder extends Seeder
{
    public function run(): void
    {
        $tariffs = [
            [
                'service_type' => 'ojek_motor',
                'label'        => 'Ojek Motor',
                'base_fare'    => 5000,
                'per_km'       => 3000,
                'minimum_fare' => 8000,
                'platform_fee' => 1000,
                'is_active'    => true,
            ],
            [
                'service_type' => 'ojek_mobil',
                'label'        => 'Taksi / Mobil',
                'base_fare'    => 10000,
                'per_km'       => 6000,
                'minimum_fare' => 15000,
                'platform_fee' => 2000,
                'is_active'    => true,
            ],
            [
                'service_type' => 'paket_motor',
                'label'        => 'Kirim Paket Motor',
                'base_fare'    => 7000,
                'per_km'       => 3500,
                'minimum_fare' => 10000,
                'platform_fee' => 1000,
                'is_active'    => true,
            ],
            [
                'service_type' => 'paket_mobil',
                'label'        => 'Kirim Paket Mobil',
                'base_fare'    => 12000,
                'per_km'       => 6000,
                'minimum_fare' => 18000,
                'platform_fee' => 2000,
                'is_active'    => true,
            ],
            [
                'service_type' => 'belanja_pasar',
                'label'        => 'Titip Belanja Pasar',
                'base_fare'    => 8000,
                'per_km'       => 3000,
                'minimum_fare' => 10000,
                'platform_fee' => 2000,
                'is_active'    => true,
            ],
        ];

        foreach ($tariffs as $tariff) {
            Tariff::firstOrCreate(
                ['service_type' => $tariff['service_type']],
                $tariff
            );
        }

        $this->command->info('✓ Tariff data seeded');
    }
}
