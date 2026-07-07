<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

echo "╔══════════════════════════════════════════════════════════════════════════════╗\n";
echo "║             JAPLO APP - POPULATE SAMPLE DATA FOR DEMO                        ║\n";
echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

// Sample data arrays
$restaurants = [
    ['name' => 'Ayam Geprek Bensu', 'category' => 'Makanan', 'rating' => 4.5, 'distance' => 2.3, 'promo' => 'Diskon 20%'],
    ['name' => 'Bakso President', 'category' => 'Makanan', 'rating' => 4.7, 'distance' => 1.5, 'promo' => null],
    ['name' => 'Kopi Kenangan', 'category' => 'Minuman', 'rating' => 4.8, 'distance' => 0.8, 'promo' => 'Beli 2 Gratis 1'],
    ['name' => 'Nasi Goreng Kambing', 'category' => 'Makanan', 'rating' => 4.6, 'distance' => 3.2, 'promo' => null],
    ['name' => 'Burger King', 'category' => 'Fast Food', 'rating' => 4.4, 'distance' => 1.2, 'promo' => 'Diskon 15%'],
    ['name' => 'Sate Padang Ajo Ramon', 'category' => 'Makanan', 'rating' => 4.9, 'distance' => 2.8, 'promo' => null],
    ['name' => 'Es Teler 77', 'category' => 'Minuman & Dessert', 'rating' => 4.3, 'distance' => 1.8, 'promo' => null],
    ['name' => 'Mie Aceh Titi Bobrok', 'category' => 'Makanan', 'rating' => 4.7, 'distance' => 2.5, 'promo' => 'Diskon 10%'],
];

$products = [
    ['name' => 'Samsung Galaxy A54', 'category' => 'Elektronik', 'price' => 5499000, 'original' => 5999000, 'rating' => 4.5, 'sold' => 150],
    ['name' => 'Nike Air Max', 'category' => 'Fashion', 'price' => 1299000, 'original' => 1699000, 'rating' => 4.7, 'sold' => 89],
    ['name' => 'ASUS ROG Laptop', 'category' => 'Elektronik', 'price' => 15999000, 'original' => 17999000, 'rating' => 4.8, 'sold' => 45],
    ['name' => 'Tas Ransel Eiger', 'category' => 'Fashion', 'price' => 359000, 'original' => 499000, 'rating' => 4.6, 'sold' => 234],
    ['name' => 'iPhone 15 Pro', 'category' => 'Elektronik', 'price' => 18999000, 'original' => 19999000, 'rating' => 4.9, 'sold' => 78],
    ['name' => 'Adidas Ultraboost', 'category' => 'Fashion', 'price' => 2499000, 'original' => 2999000, 'rating' => 4.7, 'sold' => 156],
];

$promotions = [
    ['title' => 'Flash Sale! Diskon 50%', 'desc' => 'Diskon hingga 50% untuk semua layanan Japlo', 'valid_until' => '2026-07-15', 'category' => 'Transportasi'],
    ['title' => 'Gratis Ongkir Kuliner', 'desc' => 'Gratis ongkir untuk pembelian min. Rp 50.000', 'valid_until' => '2026-07-20', 'category' => 'Kuliner'],
    ['title' => 'Cashback 100%', 'desc' => 'Cashback 100% untuk 10 pengguna beruntung!', 'valid_until' => '2026-07-31', 'category' => 'Semua Layanan'],
    ['title' => 'Diskon Produk Elektronik', 'desc' => 'Diskon 30% untuk kategori elektronik', 'valid_until' => '2026-08-10', 'category' => 'Produk'],
];

$healthServices = [
    ['name' => 'Konsultasi Dokter Online', 'desc' => 'Konsultasi dengan dokter profesional', 'price' => 50000, 'icon' => 'user-md'],
    ['name' => 'Apotek & Obat', 'desc' => 'Pesan obat dan produk kesehatan', 'price' => 0, 'icon' => 'pills'],
    ['name' => 'Tes Lab & Kesehatan', 'desc' => 'Pemeriksaan lab dan medical check-up', 'price' => 150000, 'icon' => 'flask'],
    ['name' => 'Panggil Perawat', 'desc' => 'Layanan perawat profesional ke rumah', 'price' => 100000, 'icon' => 'briefcase-medical'],
];

$trending = [
    ['title' => 'Cafe Aesthetic Terbaru', 'category' => 'Kuliner', 'views' => 15420, 'rank' => 1],
    ['title' => 'Tips Hemat Transportasi', 'category' => 'Tips & Trik', 'views' => 12850, 'rank' => 2],
    ['title' => 'Promo Spesial 7.7', 'category' => 'Promosi', 'views' => 11230, 'rank' => 3],
    ['title' => 'Restoran Viral View Keren', 'category' => 'Kuliner', 'views' => 9560, 'rank' => 4],
];

$socialPosts = [
    ['user' => 'Ahmad Rizki', 'content' => 'Baru aja nyoba fitur ojek online Japlo, cepat banget! Driver ramah dan harga bersaing 👍', 'likes' => 45, 'comments' => 12],
    ['user' => 'Siti Nurhaliza', 'content' => 'Pesan makanan di Japlo enak banget! Cepat sampai dan masih hangat 🍜', 'likes' => 128, 'comments' => 34],
    ['user' => 'Budi Santoso', 'content' => 'Ada yang udah coba fitur kesehatan? Konsultasi dokter online nya recommended ga?', 'likes' => 23, 'comments' => 8],
];

echo "📊 SAMPLE DATA SUMMARY:\n\n";
echo "✅ Restaurants: " . count($restaurants) . " items\n";
echo "✅ Products: " . count($products) . " items\n";
echo "✅ Promotions: " . count($promotions) . " items\n";
echo "✅ Health Services: " . count($healthServices) . " items\n";
echo "✅ Trending: " . count($trending) . " items\n";
echo "✅ Social Posts: " . count($socialPosts) . " items\n\n";

echo "═══════════════════════════════════════════════════════════════════════════════\n\n";

echo "💡 SAMPLE DATA TERSEDIA!\n\n";
echo "Data di atas sudah digunakan di ServiceController.php\n";
echo "Untuk data real dari database, silakan:\n\n";
echo "1. Buat migrations untuk setiap fitur\n";
echo "2. Buat models\n";
echo "3. Buat seeders dengan data di atas\n";
echo "4. Run: php artisan migrate --seed\n\n";

echo "Atau ikuti panduan lengkap di: ROADMAP_ISI_FITUR_LENGKAP.md\n\n";

echo "═══════════════════════════════════════════════════════════════════════════════\n";
