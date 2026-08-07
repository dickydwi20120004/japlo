<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Allow customer, driver, and admin to access services
        // $this->middleware('customer'); // Removed to allow all authenticated users
    }

    // Ojek/Taxi Service
    public function ojek()
    {
        // Debug: Log that method was called
        Log::info('Ojek service method called', ['user_id' => auth()->id()]);
        
        try {
            return view('customer.services.ojek');
        } catch (\Exception $e) {
            Log::error('Ojek view render error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            throw $e;
        }
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

        return view('customer.services.kuliner_enhanced', compact('restaurants'));
    }

    // Kuliner Detail - Menu Restoran
    public function kulinerDetail($restaurantId)
    {
        // Data restoran dengan menu
        $restaurantData = [
            1 => [
                'id' => 1,
                'name' => 'Ayam Geprek Bensu',
                'category' => 'Makanan',
                'rating' => 4.5,
                'distance' => 2.3,
                'image' => 'https://via.placeholder.com/300x200?text=Ayam+Geprek',
                'promo' => 'Diskon 20%',
                'description' => 'Ayam geprek dengan sambal super pedas dan cita rasa autentik',
                'address' => 'Jl. Merdeka No. 45, Jakarta Pusat',
                'phone' => '021-1234567',
                'open_time' => '10:00 AM',
                'close_time' => '10:00 PM',
                'min_order' => 15000,
                'delivery_time' => '30-45 menit',
                'menus' => [
                    [
                        'id' => 1,
                        'name' => 'Ayam Geprek Biasa',
                        'price' => 25000,
                        'description' => 'Ayam geprek dengan sambal dan lalapan',
                        'image' => 'https://via.placeholder.com/300x200?text=Ayam+Geprek+Biasa',
                        'rating' => 4.6,
                    ],
                    [
                        'id' => 2,
                        'name' => 'Ayam Geprek Jumbo',
                        'price' => 35000,
                        'description' => 'Ayam geprek jumbo dengan porsi lebih besar',
                        'image' => 'https://via.placeholder.com/300x200?text=Ayam+Geprek+Jumbo',
                        'rating' => 4.7,
                    ],
                    [
                        'id' => 3,
                        'name' => 'Paket Nasi Kuning + Ayam Geprek',
                        'price' => 30000,
                        'description' => 'Nasi kuning dengan ayam geprek dan lalapan',
                        'image' => 'https://via.placeholder.com/300x200?text=Nasi+Kuning+Ayam',
                        'rating' => 4.5,
                    ],
                    [
                        'id' => 4,
                        'name' => 'Es Jeruk Segar',
                        'price' => 5000,
                        'description' => 'Minuman segar dari jeruk alami',
                        'image' => 'https://via.placeholder.com/300x200?text=Es+Jeruk',
                        'rating' => 4.4,
                    ],
                ]
            ],
            2 => [
                'id' => 2,
                'name' => 'Bakso President',
                'category' => 'Makanan',
                'rating' => 4.7,
                'distance' => 1.5,
                'image' => 'https://via.placeholder.com/300x200?text=Bakso',
                'promo' => null,
                'description' => 'Bakso berkualitas dengan kuah premium dan rasa autentik',
                'address' => 'Jl. Ahmad Yani No. 123, Jakarta Selatan',
                'phone' => '021-7654321',
                'open_time' => '08:00 AM',
                'close_time' => '11:00 PM',
                'min_order' => 20000,
                'delivery_time' => '20-30 menit',
                'menus' => [
                    [
                        'id' => 1,
                        'name' => 'Bakso Sapi Spesial',
                        'price' => 20000,
                        'description' => 'Bakso sapi berkualitas dengan kuah kaldu premium',
                        'image' => 'https://via.placeholder.com/300x200?text=Bakso+Sapi',
                        'rating' => 4.7,
                    ],
                    [
                        'id' => 2,
                        'name' => 'Bakso Urat Lengkap',
                        'price' => 25000,
                        'description' => 'Bakso urat dengan isi yang melimpah',
                        'image' => 'https://via.placeholder.com/300x200?text=Bakso+Urat',
                        'rating' => 4.6,
                    ],
                    [
                        'id' => 3,
                        'name' => 'Mie Bakso Goreng',
                        'price' => 22000,
                        'description' => 'Mie goreng dengan bakso dan sayuran',
                        'image' => 'https://via.placeholder.com/300x200?text=Mie+Bakso',
                        'rating' => 4.5,
                    ],
                    [
                        'id' => 4,
                        'name' => 'Tahu Goreng Isi',
                        'price' => 8000,
                        'description' => 'Tahu goreng isi daging empuk',
                        'image' => 'https://via.placeholder.com/300x200?text=Tahu+Goreng',
                        'rating' => 4.4,
                    ],
                    [
                        'id' => 5,
                        'name' => 'Sirop Manisan',
                        'price' => 5000,
                        'description' => 'Minuman tradisional sirop manisan',
                        'image' => 'https://via.placeholder.com/300x200?text=Sirop',
                        'rating' => 4.3,
                    ],
                ]
            ],
            3 => [
                'id' => 3,
                'name' => 'Kopi Kenangan',
                'category' => 'Minuman',
                'rating' => 4.8,
                'distance' => 0.8,
                'image' => 'https://via.placeholder.com/300x200?text=Kopi',
                'promo' => 'Beli 2 Gratis 1',
                'description' => 'Kedai kopi dengan berbagai pilihan menu minuman premium',
                'address' => 'Jl. Sudirman No. 78, Jakarta Pusat',
                'phone' => '021-5555666',
                'open_time' => '07:00 AM',
                'close_time' => '09:00 PM',
                'min_order' => 10000,
                'delivery_time' => '15-25 menit',
                'menus' => [
                    [
                        'id' => 1,
                        'name' => 'Kopi Arabika Specialty',
                        'price' => 35000,
                        'description' => 'Kopi arabika pilihan dengan cara penyajian specialty',
                        'image' => 'https://via.placeholder.com/300x200?text=Kopi+Arabika',
                        'rating' => 4.8,
                    ],
                    [
                        'id' => 2,
                        'name' => 'Americano Classic',
                        'price' => 18000,
                        'description' => 'Americano dengan espresso dan air panas',
                        'image' => 'https://via.placeholder.com/300x200?text=Americano',
                        'rating' => 4.6,
                    ],
                    [
                        'id' => 3,
                        'name' => 'Cappuccino Creamy',
                        'price' => 22000,
                        'description' => 'Cappuccino dengan susu yang lembut dan creamy',
                        'image' => 'https://via.placeholder.com/300x200?text=Cappuccino',
                        'rating' => 4.7,
                    ],
                    [
                        'id' => 4,
                        'name' => 'Iced Latte',
                        'price' => 20000,
                        'description' => 'Latte dingin dengan es batu dan susu segar',
                        'image' => 'https://via.placeholder.com/300x200?text=Iced+Latte',
                        'rating' => 4.7,
                    ],
                    [
                        'id' => 5,
                        'name' => 'Matcha Latte',
                        'price' => 25000,
                        'description' => 'Matcha hijau dengan susu dan es',
                        'image' => 'https://via.placeholder.com/300x200?text=Matcha+Latte',
                        'rating' => 4.9,
                    ],
                    [
                        'id' => 6,
                        'name' => 'Croissant Butter',
                        'price' => 15000,
                        'description' => 'Croissant lapis dengan mentega premium',
                        'image' => 'https://via.placeholder.com/300x200?text=Croissant',
                        'rating' => 4.8,
                    ],
                ]
            ],
            4 => [
                'id' => 4,
                'name' => 'Nasi Goreng Kambing',
                'category' => 'Makanan',
                'rating' => 4.6,
                'distance' => 3.2,
                'image' => 'https://via.placeholder.com/300x200?text=Nasi+Goreng',
                'promo' => null,
                'description' => 'Nasi goreng dengan daging kambing pilihan berkualitas tinggi',
                'address' => 'Jl. Gatot Subroto No. 456, Jakarta Selatan',
                'phone' => '021-8888999',
                'open_time' => '11:00 AM',
                'close_time' => '10:00 PM',
                'min_order' => 25000,
                'delivery_time' => '40-50 menit',
                'menus' => [
                    [
                        'id' => 1,
                        'name' => 'Nasi Goreng Kambing Spesial',
                        'price' => 45000,
                        'description' => 'Nasi goreng dengan daging kambing muda dan rempah pilihan',
                        'image' => 'https://via.placeholder.com/300x200?text=Nasi+Goreng+Kambing',
                        'rating' => 4.8,
                    ],
                    [
                        'id' => 2,
                        'name' => 'Nasi Goreng Kambing Medium',
                        'price' => 35000,
                        'description' => 'Nasi goreng kambing dengan porsi sedang',
                        'image' => 'https://via.placeholder.com/300x200?text=Nasi+Goreng+Medium',
                        'rating' => 4.6,
                    ],
                    [
                        'id' => 3,
                        'name' => 'Mie Goreng Kambing',
                        'price' => 30000,
                        'description' => 'Mie goreng dengan daging kambing empuk',
                        'image' => 'https://via.placeholder.com/300x200?text=Mie+Goreng+Kambing',
                        'rating' => 4.5,
                    ],
                    [
                        'id' => 4,
                        'name' => 'Soto Kambing Kuah Kuning',
                        'price' => 28000,
                        'description' => 'Soto tradisional dengan daging kambing berkuah nikmat',
                        'image' => 'https://via.placeholder.com/300x200?text=Soto+Kambing',
                        'rating' => 4.7,
                    ],
                    [
                        'id' => 5,
                        'name' => 'Es Cendol Hijau',
                        'price' => 8000,
                        'description' => 'Minuman tradisional cendol dengan santan',
                        'image' => 'https://via.placeholder.com/300x200?text=Es+Cendol',
                        'rating' => 4.4,
                    ],
                ]
            ],
        ];

        // Get restaurant data
        $restaurant = $restaurantData[$restaurantId] ?? null;

        if (!$restaurant) {
            return redirect()->route('customer.kuliner')->with('error', 'Restoran tidak ditemukan');
        }

        return view('customer.services.kuliner_detail', compact('restaurant'));
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

        return view('customer.services.promosi_enhanced', compact('promos'));
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

    // Kesehatan Detail
    public function kesehatanDetail($serviceId)
    {
        $servicesData = [
            1 => [
                'id' => 1,
                'name' => 'Konsultasi Dokter Online',
                'description' => 'Konsultasi dengan dokter profesional via chat atau video call',
                'icon' => 'fa-user-md',
                'price' => 50000,
                'full_description' => 'Layanan konsultasi dokter online tersedia 24/7 untuk membantu Anda dan keluarga. Dokter bersertifikat siap menjawab berbagai pertanyaan kesehatan Anda dengan profesional dan rahasia terjaga.',
                'benefits' => [
                    'Konsultasi 24/7 tanpa perlu ke rumah sakit',
                    'Dokter bersertifikat dan berpengalaman',
                    'Resep digital yang valid',
                    'Privasi dan kerahasiaan terjamin',
                    'Asuransi diterima',
                ],
                'how_it_works' => [
                    '1. Daftar dan verifikasi data pribadi Anda',
                    '2. Pilih dokter spesialis yang sesuai kebutuhan',
                    '3. Lakukan konsultasi via chat atau video call',
                    '4. Terima resep dan saran pengobatan',
                    '5. Pesan obat langsung dari aplikasi jika diperlukan'
                ]
            ],
            2 => [
                'id' => 2,
                'name' => 'Apotek & Obat',
                'description' => 'Pesan obat dan produk kesehatan dengan resep dokter',
                'icon' => 'fa-pills',
                'price' => 0,
                'full_description' => 'Pesan obat-obatan dan produk kesehatan dengan mudah dan aman. Semua produk dijamin original dan telah terdaftar di BPOM dengan pengiriman cepat ke rumah Anda.',
                'benefits' => [
                    'Obat original 100% bergaransi',
                    'Pengiriman cepat dalam 1-2 jam',
                    'Apoteker berpengalaman siap membantu',
                    'Harga terjangkau dan kompetitif',
                    'Resep digital diterima',
                ],
                'how_it_works' => [
                    '1. Upload resep dokter atau miliki resep dari Japlo',
                    '2. Pilih obat yang dibutuhkan dari katalog',
                    '3. Tambahkan ke keranjang dan checkout',
                    '4. Pilih metode pengiriman',
                    '5. Terima obat di rumah dengan aman'
                ]
            ],
            3 => [
                'id' => 3,
                'name' => 'Tes Lab & Kesehatan',
                'description' => 'Pemeriksaan lab dan medical check-up di rumah',
                'icon' => 'fa-flask',
                'price' => 150000,
                'full_description' => 'Layanan pemeriksaan laboratorium profesional yang dapat dilakukan di rumah Anda dengan peralatan modern dan tenaga medis terlatih.',
                'benefits' => [
                    'Pemeriksaan di rumah tanpa perlu ke lab',
                    'Teknologi modern dan alat steril',
                    'Hasil cepat dalam 24 jam',
                    'Harga lebih terjangkau dari lab biasa',
                    'Dokter siap konsultasi hasil',
                ],
                'how_it_works' => [
                    '1. Pilih jenis pemeriksaan yang diinginkan',
                    '2. Jadwalkan waktu kunjungan petugas lab',
                    '3. Petugas lab datang ke rumah dengan perlengkapan steril',
                    '4. Pengambilan sampel dilakukan oleh profesional',
                    '5. Terima hasil dalam 24 jam'
                ]
            ],
            4 => [
                'id' => 4,
                'name' => 'Panggil Perawat',
                'description' => 'Layanan perawat profesional datang ke rumah Anda',
                'icon' => 'fa-briefcase-medical',
                'price' => 100000,
                'full_description' => 'Perawat profesional bersertifikat siap membantu perawatan kesehatan Anda di rumah dengan standar keamanan dan kebersihan internasional.',
                'benefits' => [
                    'Perawat profesional dan bersertifikat',
                    'Layanan 24/7 sesuai jadwal Anda',
                    'Tindakan medis sesuai SOP',
                    'Peralatan medis steril dan lengkap',
                    'Harga terjangkau dengan kualitas terbaik',
                ],
                'how_it_works' => [
                    '1. Jelaskan kebutuhan perawatan Anda',
                    '2. Pilih jadwal kunjungan yang sesuai',
                    '3. Perawat datang dengan perlengkapan lengkap',
                    '4. Lakukan tindakan perawatan sesuai kebutuhan',
                    '5. Perawat memberikan edukasi perawatan lanjutan'
                ]
            ]
        ];

        $service = $servicesData[$serviceId] ?? null;

        if (!$service) {
            return redirect()->route('customer.kesehatan')->with('error', 'Layanan tidak ditemukan');
        }

        return view('customer.services.kesehatan_detail', compact('service'));
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

        return view('customer.services.produk_enhanced', compact('products'));
    }

    // Produk Detail
    public function produkDetail($productId)
    {
        $productsData = [
            1 => [
                'id' => 1,
                'name' => 'Smartphone Samsung Galaxy A54',
                'price' => 5499000,
                'original_price' => 5999000,
                'rating' => 4.5,
                'sold' => 150,
                'image' => 'https://via.placeholder.com/300x300?text=Samsung+A54',
                'category' => 'Elektronik',
                'description' => 'Samsung Galaxy A54 adalah smartphone flagship dengan teknologi terkini',
                'specs' => [
                    'Processor' => 'Snapdragon 888 5G',
                    'RAM' => '8GB',
                    'Storage' => '256GB',
                    'Display' => '6.4" AMOLED 120Hz',
                    'Camera' => '50MP + 12MP + 12MP + 32MP',
                    'Battery' => '5000mAh',
                    'Garansi' => '2 Tahun'
                ],
                'images' => [
                    'https://via.placeholder.com/600x600?text=Samsung+A54+1',
                    'https://via.placeholder.com/600x600?text=Samsung+A54+2',
                    'https://via.placeholder.com/600x600?text=Samsung+A54+3',
                ]
            ],
            2 => [
                'id' => 2,
                'name' => 'Sepatu Nike Air Max',
                'price' => 1299000,
                'original_price' => 1699000,
                'rating' => 4.7,
                'sold' => 89,
                'image' => 'https://via.placeholder.com/300x300?text=Nike+Air+Max',
                'category' => 'Fashion',
                'description' => 'Sepatu Nike Air Max dengan desain klasik dan kenyamanan maksimal',
                'specs' => [
                    'Brand' => 'Nike',
                    'Model' => 'Air Max 90',
                    'Ukuran' => '36-44',
                    'Warna' => 'Black, White, Red',
                    'Material' => 'Leather & Mesh',
                    'Teknologi' => 'Air Cushioning',
                    'Berat' => '340g'
                ],
                'images' => [
                    'https://via.placeholder.com/600x600?text=Nike+Air+Max+1',
                    'https://via.placeholder.com/600x600?text=Nike+Air+Max+2',
                    'https://via.placeholder.com/600x600?text=Nike+Air+Max+3',
                ]
            ],
            3 => [
                'id' => 3,
                'name' => 'Laptop ASUS ROG',
                'price' => 15999000,
                'original_price' => 17999000,
                'rating' => 4.8,
                'sold' => 45,
                'image' => 'https://via.placeholder.com/300x300?text=ASUS+ROG',
                'category' => 'Elektronik',
                'description' => 'ASUS ROG adalah gaming laptop dengan performa tinggi',
                'specs' => [
                    'Processor' => 'Intel Core i7-13700H',
                    'GPU' => 'NVIDIA RTX 4060 12GB',
                    'RAM' => '16GB DDR5',
                    'Storage' => '1TB SSD NVMe',
                    'Display' => '16" FHD 165Hz',
                    'Keyboard' => 'Mechanical RGB',
                    'Garansi' => '3 Tahun'
                ],
                'images' => [
                    'https://via.placeholder.com/600x600?text=ASUS+ROG+1',
                    'https://via.placeholder.com/600x600?text=ASUS+ROG+2',
                    'https://via.placeholder.com/600x600?text=ASUS+ROG+3',
                ]
            ],
            4 => [
                'id' => 4,
                'name' => 'Tas Ransel Eiger',
                'price' => 359000,
                'original_price' => 499000,
                'rating' => 4.6,
                'sold' => 234,
                'image' => 'https://via.placeholder.com/300x300?text=Tas+Eiger',
                'category' => 'Fashion',
                'description' => 'Tas ransel Eiger dengan desain ergonomis dan tahan lama',
                'specs' => [
                    'Brand' => 'Eiger',
                    'Kapasitas' => '40L',
                    'Material' => 'Nylon & Polyester',
                    'Kompartemen' => 'Multi-pocket',
                    'Ukuran' => '50 x 30 x 20 cm',
                    'Warna' => 'Black, Navy, Green',
                    'Garansi' => '1 Tahun'
                ],
                'images' => [
                    'https://via.placeholder.com/600x600?text=Tas+Eiger+1',
                    'https://via.placeholder.com/600x600?text=Tas+Eiger+2',
                    'https://via.placeholder.com/600x600?text=Tas+Eiger+3',
                ]
            ]
        ];

        $product = $productsData[$productId] ?? null;

        if (!$product) {
            return redirect()->route('customer.produk')->with('error', 'Produk tidak ditemukan');
        }

        return view('customer.services.produk_detail', compact('product'));
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
