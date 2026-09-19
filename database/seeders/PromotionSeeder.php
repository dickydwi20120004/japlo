<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promotion;

class PromotionSeeder extends Seeder
{
    public function run(): void
    {
        $promos = [
            [
                'title'          => 'Gratis Ongkir Ojek',
                'description'    => 'Nikmati gratis ongkir untuk 3 perjalanan ojek pertama Anda di JAPLO!',
                'category'       => 'Transportasi',
                'type'           => 'free_delivery',
                'discount_value' => 100,
                'discount_type'  => 'percent',
                'promo_code'     => 'OJEKGRATIS',
                'quota'          => 500,
                'used_count'     => 127,
                'min_purchase'   => 0,
                'start_date'     => now()->startOfMonth(),
                'end_date'       => now()->endOfMonth(),
                'is_active'      => true,
            ],
            [
                'title'          => 'Diskon 20% Kuliner',
                'description'    => 'Pesan makanan dari semua restoran mitra JAPLO, diskon 20% untuk pembelian pertama.',
                'category'       => 'Kuliner',
                'type'           => 'discount',
                'discount_value' => 20,
                'discount_type'  => 'percent',
                'promo_code'     => 'MAKAN20',
                'quota'          => 200,
                'used_count'     => 45,
                'min_purchase'   => 25000,
                'start_date'     => now()->startOfMonth(),
                'end_date'       => now()->addMonths(2)->endOfMonth(),
                'is_active'      => true,
            ],
            [
                'title'          => 'Cashback Rp 5.000',
                'description'    => 'Dapatkan cashback Rp 5.000 untuk setiap belanja produk min. Rp 50.000.',
                'category'       => 'Produk',
                'type'           => 'cashback',
                'discount_value' => 5000,
                'discount_type'  => 'nominal',
                'promo_code'     => 'CASHBACK5K',
                'quota'          => 100,
                'used_count'     => 12,
                'min_purchase'   => 50000,
                'start_date'     => now()->startOfMonth(),
                'end_date'       => now()->endOfMonth(),
                'is_active'      => true,
            ],
            [
                'title'          => 'Promo HUT Bintan',
                'description'    => 'Rayakan HUT Kabupaten Bintan dengan promo spesial diskon 15% semua layanan!',
                'category'       => 'Semua Layanan',
                'type'           => 'discount',
                'discount_value' => 15,
                'discount_type'  => 'percent',
                'promo_code'     => 'HUTBINTAN',
                'quota'          => 1000,
                'used_count'     => 234,
                'min_purchase'   => 10000,
                'start_date'     => now()->startOfMonth(),
                'end_date'       => now()->addMonth()->endOfMonth(),
                'is_active'      => true,
            ],
        ];

        foreach ($promos as $promo) {
            Promotion::firstOrCreate(
                ['promo_code' => $promo['promo_code']],
                $promo
            );
        }

        $this->command->info('✓ Promotion data seeded');
    }
}
