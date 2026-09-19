<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        if (!$admin) {
            $this->command->warn('No admin user found, skipping ArticleSeeder');
            return;
        }

        $articles = [
            [
                'title'        => 'JAPLO Hadir untuk Warga Bintan: Platform Lokal Pertama yang Terintegrasi',
                'slug'         => 'japlo-hadir-untuk-warga-bintan',
                'excerpt'      => 'JAPLO kini hadir sebagai platform digital pertama yang melayani kebutuhan warga Bintan secara menyeluruh, dari transportasi hingga belanja kebutuhan sehari-hari.',
                'content'      => '<p>JAPLO (Jasa Pengantar Lokal) hadir sebagai solusi digital terpadu untuk warga Kabupaten Bintan. Platform ini memungkinkan Anda memesan ojek, kuliner, produk, hingga layanan kesehatan dalam satu aplikasi.</p><p>Dengan lebih dari 48.000 pengguna aktif di tiga kecamatan, JAPLO terus berkembang untuk melayani kebutuhan masyarakat lokal yang belum terlayani platform nasional.</p><p>Bergabunglah bersama kami dan rasakan kemudahan layanan lokal yang cepat, transparan, dan terpercaya.</p>',
                'category'     => 'Berita',
                'views'        => 1250,
                'status'       => 'published',
                'published_at' => now()->subDays(7),
            ],
            [
                'title'        => '5 Tips Hemat Belanja di Pasar Tradisional Bintan',
                'slug'         => '5-tips-hemat-belanja-pasar-bintan',
                'excerpt'      => 'Belanja di pasar tradisional bisa lebih hemat dan efisien. Simak tips dari tim JAPLO untuk mendapatkan produk terbaik dengan harga terjangkau.',
                'content'      => '<p>Pasar tradisional Bintan menyimpan banyak pilihan produk segar dengan harga yang lebih terjangkau. Berikut 5 tips belanja hemat yang bisa Anda terapkan:</p><ol><li>Datang atau pesan di pagi hari untuk mendapatkan produk paling segar</li><li>Bandingkan harga dari beberapa penjual</li><li>Beli dalam jumlah yang sesuai kebutuhan</li><li>Manfaatkan promo JAPLO untuk belanja titip pasar</li><li>Pilih produk musiman yang sedang panen untuk harga terbaik</li></ol>',
                'category'     => 'Tips',
                'views'        => 890,
                'status'       => 'published',
                'published_at' => now()->subDays(5),
            ],
            [
                'title'        => 'Cara Daftar Jadi Mitra JAPLO dan Keuntungannya',
                'slug'         => 'cara-daftar-mitra-japlo',
                'excerpt'      => 'Ingin bisnis Anda menjangkau lebih banyak pelanggan di Bintan? Daftarkan usaha Anda sebagai mitra JAPLO dan nikmati berbagai keuntungannya.',
                'content'      => '<p>Menjadi mitra JAPLO membuka peluang bisnis yang lebih luas. Dengan bergabung, usaha Anda akan dijangkau oleh puluhan ribu pengguna aktif JAPLO di Bintan.</p><h3>Keuntungan Mitra JAPLO:</h3><ul><li>Promosi gratis di platform JAPLO</li><li>Akses ke sistem pemesanan online</li><li>Dashboard pengelolaan pesanan</li><li>Laporan penjualan terperinci</li></ul><p>Daftar sekarang melalui fitur Pendaftaran Mitra di aplikasi JAPLO.</p>',
                'category'     => 'Komunitas',
                'views'        => 670,
                'status'       => 'published',
                'published_at' => now()->subDays(3),
            ],
            [
                'title'        => 'Mini Expo JAPLO: Kesempatan UMKM Bintan Tampil di Panggung Digital',
                'slug'         => 'mini-expo-japlo-umkm-bintan',
                'excerpt'      => 'JAPLO mengadakan Mini Expo untuk UMKM Bintan. Daftarkan booth Anda sekarang dan perkenalkan produk Anda kepada ribuan pengunjung.',
                'content'      => '<p>JAPLO kembali menggelar Mini Expo untuk mendukung UMKM lokal Bintan. Event ini merupakan kesempatan emas bagi pelaku usaha kecil dan menengah untuk memperkenalkan produk mereka kepada masyarakat luas.</p><p>Pendaftaran tenant Mini Expo dapat dilakukan langsung melalui platform JAPLO. Tersedia berbagai pilihan booth dengan harga terjangkau.</p><p>Segera daftarkan usaha Anda sebelum tempat habis!</p>',
                'category'     => 'Promo',
                'views'        => 445,
                'status'       => 'published',
                'published_at' => now()->subDays(1),
            ],
        ];

        foreach ($articles as $article) {
            Article::firstOrCreate(
                ['slug' => $article['slug']],
                array_merge($article, ['user_id' => $admin->id])
            );
        }

        $this->command->info('✓ Article data seeded (' . Article::count() . ' articles)');
    }
}
