<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Elektronik
            ['name' => 'Powerbank 20000mAh',    'category' => 'Elektronik', 'price' => 185000, 'original_price' => 220000, 'stock' => 15, 'weight' => 350, 'rating' => 4.5, 'sold_count' => 32, 'description' => 'Powerbank kapasitas besar dengan 2 port USB, cocok untuk perjalanan'],
            ['name' => 'Kabel Data Type-C 2m',  'category' => 'Elektronik', 'price' => 25000,  'original_price' => 35000,  'stock' => 50, 'weight' => 80,  'rating' => 4.3, 'sold_count' => 78, 'description' => 'Kabel data Type-C panjang 2 meter, fast charging support'],
            ['name' => 'Earphone Bluetooth',    'category' => 'Elektronik', 'price' => 95000,  'original_price' => 120000, 'stock' => 20, 'weight' => 120, 'rating' => 4.4, 'sold_count' => 45, 'description' => 'Earphone bluetooth TWS dengan case charging'],
            // Fashion
            ['name' => 'Kaos Polo Polos',       'category' => 'Fashion',    'price' => 75000,  'original_price' => 95000,  'stock' => 30, 'weight' => 200, 'rating' => 4.6, 'sold_count' => 56, 'description' => 'Kaos polo bahan lacoste, tersedia berbagai warna'],
            ['name' => 'Celana Pendek Santai',  'category' => 'Fashion',    'price' => 65000,  'original_price' => 85000,  'stock' => 25, 'weight' => 250, 'rating' => 4.5, 'sold_count' => 34, 'description' => 'Celana pendek bahan katun nyaman untuk santai'],
            // Kebutuhan Rumah
            ['name' => 'Sabun Cuci Piring 500ml','category' => 'Rumah Tangga','price' => 12000, 'original_price' => 15000,  'stock' => 100,'weight' => 550, 'rating' => 4.7, 'sold_count' => 120,'description' => 'Sabun cuci piring cair pembersih lemak membandel'],
            ['name' => 'Detergen Bubuk 1kg',    'category' => 'Rumah Tangga','price' => 18000, 'original_price' => 22000,  'stock' => 80, 'weight' => 1100,'rating' => 4.6, 'sold_count' => 95, 'description' => 'Detergen bubuk harum untuk cuci tangan atau mesin'],
            // Sembako
            ['name' => 'Beras Premium 5kg',     'category' => 'Sembako',    'price' => 72000, 'original_price' => 78000,   'stock' => 40, 'weight' => 5100,'rating' => 4.8, 'sold_count' => 88, 'description' => 'Beras premium pulen wangi kualitas terbaik'],
            ['name' => 'Minyak Goreng 2L',      'category' => 'Sembako',    'price' => 32000, 'original_price' => 36000,   'stock' => 60, 'weight' => 2100,'rating' => 4.5, 'sold_count' => 110,'description' => 'Minyak goreng kelapa sawit jernih berkualitas'],
            // Kesehatan & Kecantikan
            ['name' => 'Masker Kain 3pcs',      'category' => 'Kesehatan',  'price' => 15000, 'original_price' => 20000,   'stock' => 200,'weight' => 50,  'rating' => 4.4, 'sold_count' => 150,'description' => 'Masker kain 3 lapis isi 3 pcs, dapat dicuci ulang'],
            ['name' => 'Hand Sanitizer 250ml',  'category' => 'Kesehatan',  'price' => 22000, 'original_price' => 28000,   'stock' => 75, 'weight' => 280, 'rating' => 4.6, 'sold_count' => 67, 'description' => 'Hand sanitizer gel 70% alkohol dengan pelembab'],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['name' => $product['name']],
                array_merge($product, ['is_active' => true])
            );
        }

        $this->command->info('✓ Product data seeded (' . Product::count() . ' products)');
    }
}
