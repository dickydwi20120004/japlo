<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\Menu;

class RestaurantSeeder extends Seeder
{
    public function run(): void
    {
        $restaurants = [
            [
                'name'          => 'Warung Mak Cik Siti',
                'category'      => 'Makanan',
                'description'   => 'Masakan rumahan khas Melayu Bintan, nasi dengan lauk pilihan',
                'address'       => 'Jl. Pantai Trikora, Tanjung Uban, Bintan',
                'phone'         => '0812-3456-7890',
                'rating'        => 4.7,
                'open_time'     => '07:00',
                'close_time'    => '21:00',
                'min_order'     => 15000,
                'delivery_time' => 20,
                'is_open'       => true,
                'is_active'     => true,
                'menus' => [
                    ['name' => 'Nasi Ayam Penyet',    'price' => 18000, 'category' => 'Makanan', 'description' => 'Ayam goreng penyet sambal terasi dengan nasi putih'],
                    ['name' => 'Nasi Ikan Bakar',     'price' => 22000, 'category' => 'Makanan', 'description' => 'Ikan bakar bumbu kecap dengan nasi dan lalapan'],
                    ['name' => 'Mie Goreng Spesial',  'price' => 15000, 'category' => 'Makanan', 'description' => 'Mie goreng dengan telur dan sayuran segar'],
                    ['name' => 'Es Teh Manis',        'price' => 5000,  'category' => 'Minuman', 'description' => 'Teh manis dingin segar'],
                    ['name' => 'Es Jeruk',             'price' => 6000,  'category' => 'Minuman', 'description' => 'Jeruk segar peras dengan es'],
                    ['name' => 'Jus Alpukat',          'price' => 12000, 'category' => 'Minuman', 'description' => 'Alpukat segar blended dengan susu'],
                ],
            ],
            [
                'name'          => 'Kedai Kopi Bintan',
                'category'      => 'Minuman',
                'description'   => 'Kopi lokal dan minuman premium, suasana santai tepi pantai',
                'address'       => 'Jl. Wisata Lagoi, Bintan Utara',
                'phone'         => '0813-5678-9012',
                'rating'        => 4.8,
                'open_time'     => '07:00',
                'close_time'    => '22:00',
                'min_order'     => 10000,
                'delivery_time' => 15,
                'is_open'       => true,
                'is_active'     => true,
                'menus' => [
                    ['name' => 'Kopi Tarik',           'price' => 8000,  'category' => 'Minuman', 'description' => 'Kopi susu tradisional cara tarik'],
                    ['name' => 'Kopi O',               'price' => 6000,  'category' => 'Minuman', 'description' => 'Kopi hitam pahit khas Melayu'],
                    ['name' => 'Teh Tarik',            'price' => 7000,  'category' => 'Minuman', 'description' => 'Teh susu kental cara tarik'],
                    ['name' => 'Milo Panas',           'price' => 8000,  'category' => 'Minuman', 'description' => 'Milo hangat dengan susu'],
                    ['name' => 'Roti Bakar Mentega',   'price' => 12000, 'category' => 'Makanan', 'description' => 'Roti bakar dengan mentega dan selai'],
                    ['name' => 'Kaya Toast',           'price' => 10000, 'category' => 'Makanan', 'description' => 'Roti bakar dengan kaya jam telur setengah matang'],
                ],
            ],
            [
                'name'          => 'Seafood Pak Haji',
                'category'      => 'Makanan',
                'description'   => 'Seafood segar langsung dari nelayan Bintan, dimasak bumbu khas',
                'address'       => 'Jl. Pelabuhan Tanjung Uban No. 5, Bintan',
                'phone'         => '0811-2345-6789',
                'rating'        => 4.9,
                'open_time'     => '11:00',
                'close_time'    => '22:00',
                'min_order'     => 30000,
                'delivery_time' => 35,
                'is_open'       => true,
                'is_active'     => true,
                'menus' => [
                    ['name' => 'Kepiting Saus Padang',  'price' => 65000, 'category' => 'Makanan', 'description' => 'Kepiting segar dengan saus padang pedas gurih'],
                    ['name' => 'Ikan Kakap Goreng',     'price' => 45000, 'category' => 'Makanan', 'description' => 'Kakap segar digoreng garing dengan sambal'],
                    ['name' => 'Udang Bakar Bumbu',     'price' => 55000, 'category' => 'Makanan', 'description' => 'Udang jumbo bakar bumbu rempah'],
                    ['name' => 'Cumi Goreng Tepung',    'price' => 35000, 'category' => 'Makanan', 'description' => 'Cumi segar goreng tepung renyah'],
                    ['name' => 'Nasi Putih',            'price' => 5000,  'category' => 'Makanan', 'description' => 'Nasi putih per porsi'],
                    ['name' => 'Air Mineral',           'price' => 5000,  'category' => 'Minuman', 'description' => 'Air mineral botol'],
                ],
            ],
            [
                'name'          => 'Bakso & Mie Ayam Pak Budi',
                'category'      => 'Makanan',
                'description'   => 'Bakso daging sapi pilihan dengan kuah kaldu gurih sejak 2010',
                'address'       => 'Jl. Ahmad Yani No. 12, Tanjung Uban',
                'phone'         => '0857-1234-5678',
                'rating'        => 4.6,
                'open_time'     => '09:00',
                'close_time'    => '21:00',
                'min_order'     => 12000,
                'delivery_time' => 20,
                'is_open'       => true,
                'is_active'     => true,
                'menus' => [
                    ['name' => 'Bakso Biasa',        'price' => 15000, 'category' => 'Makanan', 'description' => 'Bakso sapi dengan kuah kaldu dan mie'],
                    ['name' => 'Bakso Urat Spesial', 'price' => 20000, 'category' => 'Makanan', 'description' => 'Bakso urat besar dengan kuah spesial'],
                    ['name' => 'Mie Ayam Biasa',     'price' => 14000, 'category' => 'Makanan', 'description' => 'Mie ayam dengan topping daging ayam'],
                    ['name' => 'Mie Ayam Komplit',   'price' => 18000, 'category' => 'Makanan', 'description' => 'Mie ayam + bakso + pangsit goreng'],
                    ['name' => 'Es Teh',             'price' => 4000,  'category' => 'Minuman', 'description' => 'Teh manis es'],
                ],
            ],
        ];

        foreach ($restaurants as $data) {
            $menus = $data['menus'];
            unset($data['menus']);

            $restaurant = Restaurant::firstOrCreate(
                ['name' => $data['name']],
                $data
            );

            foreach ($menus as $menu) {
                Menu::firstOrCreate(
                    ['restaurant_id' => $restaurant->id, 'name' => $menu['name']],
                    array_merge($menu, ['is_available' => true])
                );
            }
        }

        $this->command->info('✓ Restaurant & Menu data seeded (' . Restaurant::count() . ' restaurants)');
    }
}
