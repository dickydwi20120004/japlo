<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Ojek/Taxi Service
    public function ojek()
    {
        return view('customer.services.ojek');
    }

    // Kuliner Service
    public function kuliner()
    {
        // Sample restaurant data
        $restaurants = [
            [
                'id' => 1,
                'name' => 'Ayam Geprek Bensu',
                'category' => 'Makanan',
                'rating' => 4.5,
                'distance' => 2.3,
                'image' => 'https://via.placeholder.com/300x200?text=Ayam+Geprek',
                'promo' => 'Diskon 20%',
            ],
            [
                'id' => 2,
                'name' => 'Bakso President',
                'category' => 'Makanan',
                'rating' => 4.7,
                'distance' => 1.5,
                'image' => 'https://via.placeholder.com/300x200?text=Bakso',
                'promo' => null,
            ],
            [
                'id' => 3,
                'name' => 'Kopi Kenangan',
                'category' => 'Minuman',
                'rating' => 4.8,
                'distance' => 0.8,
                'image' => 'https://via.placeholder.com/300x200?text=Kopi',
                'promo' => 'Beli 2 Gratis 1',
            ],
            [
                'id' => 4,
                'name' => 'Nasi Goreng Kambing',
                'category' => 'Makanan',
                'rating' => 4.6,
                'distance' => 3.2,
                'image' => 'https://via.placeholder.com/300x200?text=Nasi+Goreng',
                'promo' => null,
            ],
        ];

        return view('customer.services.kuliner', compact('restaurants'));
    }

    // Iklan Promosi Service
    public function promosi()
    {
        // Sample promo data
        $promos = [
            [
                'id' => 1,
                'title' => 'Flash Sale! Diskon 50%',
                'description' => 'Dapatkan diskon hingga 50% untuk semua layanan Japlo hari ini!',
                'image' => 'https://via.placeholder.com/800x400?text=Flash+Sale+50%',
                'valid_until' => '2026-07-15',
                'category' => 'Transportasi',
            ],
            [
                'id' => 2,
                'title' => 'Gratis Ongkir Kuliner',
                'description' => 'Pesan makanan sekarang, gratis ongkir untuk pembelian min. Rp 50.000',
                'image' => 'https://via.placeholder.com/800x400?text=Gratis+Ongkir',
                'valid_until' => '2026-07-20',
                'category' => 'Kuliner',
            ],
            [
                'id' => 3,
                'title' => 'Cashback 100%',
                'description' => 'Berkesempatan mendapatkan cashback 100% untuk 10 pengguna beruntung!',
                'image' => 'https://via.placeholder.com/800x400?text=Cashback+100%',
                'valid_until' => '2026-07-31',
                'category' => 'Semua Layanan',
            ],
        ];

        return view('customer.services.promosi', compact('promos'));
    }

    // Kesehatan Service
    public function kesehatan()
    {
        // Sample health services
        $healthServices = [
            [
                'id' => 1,
                'name' => 'Konsultasi Dokter Online',
                'description' => 'Konsultasi dengan dokter profesional via chat atau video call',
                'icon' => 'fa-user-md',
                'price' => 50000,
            ],
            [
                'id' => 2,
                'name' => 'Apotek & Obat',
                'description' => 'Pesan obat dan produk kesehatan dengan resep dokter',
                'icon' => 'fa-pills',
                'price' => 0,
            ],
            [
                'id' => 3,
                'name' => 'Tes Lab & Kesehatan',
                'description' => 'Pemeriksaan lab dan medical check-up di rumah',
                'icon' => 'fa-flask',
                'price' => 150000,
            ],
            [
                'id' => 4,
                'name' => 'Panggil Perawat',
                'description' => 'Layanan perawat profesional datang ke rumah Anda',
                'icon' => 'fa-briefcase-medical',
                'price' => 100000,
            ],
        ];

        return view('customer.services.kesehatan', compact('healthServices'));
    }

    // Produk Service
    public function produk()
    {
        // Sample products
        $products = [
            [
                'id' => 1,
                'name' => 'Smartphone Samsung Galaxy A54',
                'price' => 5499000,
                'original_price' => 5999000,
                'rating' => 4.5,
                'sold' => 150,
                'image' => 'https://via.placeholder.com/300x300?text=Samsung+A54',
                'category' => 'Elektronik',
            ],
            [
                'id' => 2,
                'name' => 'Sepatu Nike Air Max',
                'price' => 1299000,
                'original_price' => 1699000,
                'rating' => 4.7,
                'sold' => 89,
                'image' => 'https://via.placeholder.com/300x300?text=Nike+Air+Max',
                'category' => 'Fashion',
            ],
            [
                'id' => 3,
                'name' => 'Laptop ASUS ROG',
                'price' => 15999000,
                'original_price' => 17999000,
                'rating' => 4.8,
                'sold' => 45,
                'image' => 'https://via.placeholder.com/300x300?text=ASUS+ROG',
                'category' => 'Elektronik',
            ],
            [
                'id' => 4,
                'name' => 'Tas Ransel Eiger',
                'price' => 359000,
                'original_price' => 499000,
                'rating' => 4.6,
                'sold' => 234,
                'image' => 'https://via.placeholder.com/300x300?text=Tas+Eiger',
                'category' => 'Fashion',
            ],
        ];

        return view('customer.services.produk', compact('products'));
    }

    // Pencetakan Service
    public function pencetakan()
    {
        // Sample printing services
        $printServices = [
            [
                'id' => 1,
                'name' => 'Print Dokumen',
                'description' => 'Cetak dokumen hitam putih atau berwarna',
                'price_start' => 500,
                'icon' => 'fa-file-alt',
            ],
            [
                'id' => 2,
                'name' => 'Fotocopy',
                'description' => 'Layanan fotocopy cepat dan berkualitas',
                'price_start' => 200,
                'icon' => 'fa-copy',
            ],
            [
                'id' => 3,
                'name' => 'Scan Dokumen',
                'description' => 'Scan dokumen dengan kualitas tinggi',
                'price_start' => 1000,
                'icon' => 'fa-scanner',
            ],
            [
                'id' => 4,
                'name' => 'Cetak Foto',
                'description' => 'Cetak foto berbagai ukuran dengan kualitas terbaik',
                'price_start' => 2000,
                'icon' => 'fa-image',
            ],
            [
                'id' => 5,
                'name' => 'Jilid & Laminating',
                'description' => 'Jilid dokumen dan laminating berbagai ukuran',
                'price_start' => 5000,
                'icon' => 'fa-book',
            ],
            [
                'id' => 6,
                'name' => 'Cetak Banner & Spanduk',
                'description' => 'Cetak banner, spanduk, dan baliho untuk promosi',
                'price_start' => 50000,
                'icon' => 'fa-flag',
            ],
        ];

        return view('customer.services.pencetakan', compact('printServices'));
    }

    // Trending Service
    public function trending()
    {
        // Sample trending content
        $trending = [
            [
                'id' => 1,
                'title' => 'Cafe Aesthetic Terbaru di Jakarta',
                'category' => 'Kuliner',
                'views' => 15420,
                'image' => 'https://via.placeholder.com/400x300?text=Cafe+Aesthetic',
                'trending_rank' => 1,
            ],
            [
                'id' => 2,
                'title' => 'Tips Hemat Transportasi Online',
                'category' => 'Tips & Trik',
                'views' => 12850,
                'image' => 'https://via.placeholder.com/400x300?text=Tips+Hemat',
                'trending_rank' => 2,
            ],
            [
                'id' => 3,
                'title' => 'Promo Spesial 7.7 Shopping Day',
                'category' => 'Promosi',
                'views' => 11230,
                'image' => 'https://via.placeholder.com/400x300?text=7.7+Shopping',
                'trending_rank' => 3,
            ],
            [
                'id' => 4,
                'title' => 'Restoran Viral dengan View Keren',
                'category' => 'Kuliner',
                'views' => 9560,
                'image' => 'https://via.placeholder.com/400x300?text=Restoran+Viral',
                'trending_rank' => 4,
            ],
        ];

        return view('customer.services.trending', compact('trending'));
    }

    // Sosial Service
    public function sosial()
    {
        // Sample social posts
        $posts = [
            [
                'id' => 1,
                'user_name' => 'Ahmad Rizki',
                'user_avatar' => 'https://ui-avatars.com/api/?name=Ahmad+Rizki&background=random',
                'content' => 'Baru aja nyoba fitur ojek online Japlo, cepat banget! Driver ramah dan harga bersaing 👍',
                'image' => null,
                'likes' => 45,
                'comments' => 12,
                'time' => '2 jam yang lalu',
            ],
            [
                'id' => 2,
                'user_name' => 'Siti Nurhaliza',
                'user_avatar' => 'https://ui-avatars.com/api/?name=Siti+Nurhaliza&background=random',
                'content' => 'Pesan makanan di Japlo enak banget! Cepat sampai dan masih hangat 🍜',
                'image' => 'https://via.placeholder.com/600x400?text=Makanan+Enak',
                'likes' => 128,
                'comments' => 34,
                'time' => '5 jam yang lalu',
            ],
            [
                'id' => 3,
                'user_name' => 'Budi Santoso',
                'user_avatar' => 'https://ui-avatars.com/api/?name=Budi+Santoso&background=random',
                'content' => 'Ada yang udah coba fitur kesehatan di Japlo? Konsultasi dokter online nya recommended ga?',
                'image' => null,
                'likes' => 23,
                'comments' => 8,
                'time' => '1 hari yang lalu',
            ],
        ];

        return view('customer.services.sosial', compact('posts'));
    }
}
