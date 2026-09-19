<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HealthService;

class HealthServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name'             => 'Konsultasi Dokter Online',
                'description'      => 'Konsultasi dengan dokter profesional via chat atau video call',
                'full_description' => 'Layanan konsultasi dokter online tersedia untuk membantu Anda dan keluarga. Dokter bersertifikat siap menjawab berbagai pertanyaan kesehatan Anda dengan profesional.',
                'icon'             => 'fas fa-user-doctor',
                'price'            => 50000,
                'provider'         => 'JAPLO Health',
                'phone'            => '0811-2345-6789',
                'benefits'         => [
                    'Konsultasi tanpa perlu ke rumah sakit',
                    'Dokter bersertifikat dan berpengalaman',
                    'Resep digital yang valid',
                    'Privasi terjamin',
                ],
                'how_it_works' => [
                    '1. Pilih layanan konsultasi',
                    '2. Isi keluhan dan gejala Anda',
                    '3. Terhubung dengan dokter via chat/video',
                    '4. Terima resep dan saran pengobatan',
                ],
                'is_available' => true,
                'sort_order'   => 1,
            ],
            [
                'name'             => 'Apotek & Pesan Obat',
                'description'      => 'Pesan obat dan produk kesehatan, diantar ke rumah',
                'full_description' => 'Pesan obat-obatan dan produk kesehatan dengan mudah dan aman. Semua produk dijamin original dengan pengiriman cepat.',
                'icon'             => 'fas fa-pills',
                'price'            => 0,
                'provider'         => 'Apotek Mitra JAPLO',
                'phone'            => '0812-3456-7890',
                'benefits'         => [
                    'Obat original 100% bergaransi',
                    'Pengiriman cepat 1–2 jam',
                    'Apoteker siap membantu',
                    'Resep dokter diterima',
                ],
                'how_it_works' => [
                    '1. Upload resep atau pilih obat bebas',
                    '2. Masukkan ke keranjang',
                    '3. Pilih alamat pengiriman',
                    '4. Terima obat di rumah',
                ],
                'is_available' => true,
                'sort_order'   => 2,
            ],
            [
                'name'             => 'Tes Lab & Medical Check-Up',
                'description'      => 'Pemeriksaan laboratorium dan medical check-up di rumah',
                'full_description' => 'Layanan pemeriksaan laboratorium profesional yang dapat dilakukan di rumah Anda dengan peralatan modern.',
                'icon'             => 'fas fa-flask-vial',
                'price'            => 150000,
                'provider'         => 'Lab Mitra JAPLO',
                'phone'            => '0813-5678-9012',
                'benefits'         => [
                    'Pemeriksaan di rumah',
                    'Peralatan steril dan modern',
                    'Hasil dalam 24 jam',
                    'Dokter siap konsultasi hasil',
                ],
                'how_it_works' => [
                    '1. Pilih jenis pemeriksaan',
                    '2. Jadwalkan waktu kunjungan',
                    '3. Petugas lab datang ke rumah',
                    '4. Terima hasil dalam 24 jam',
                ],
                'is_available' => true,
                'sort_order'   => 3,
            ],
            [
                'name'             => 'Panggil Perawat ke Rumah',
                'description'      => 'Perawat profesional datang ke rumah untuk perawatan',
                'full_description' => 'Perawat profesional bersertifikat siap membantu perawatan kesehatan Anda di rumah.',
                'icon'             => 'fas fa-briefcase-medical',
                'price'            => 100000,
                'provider'         => 'Perawat Mitra JAPLO',
                'phone'            => '0814-6789-0123',
                'benefits'         => [
                    'Perawat bersertifikat',
                    'Layanan sesuai jadwal',
                    'Peralatan medis lengkap',
                    'Harga terjangkau',
                ],
                'how_it_works' => [
                    '1. Jelaskan kebutuhan perawatan',
                    '2. Pilih jadwal kunjungan',
                    '3. Perawat datang ke rumah',
                    '4. Lakukan tindakan perawatan',
                ],
                'is_available' => true,
                'sort_order'   => 4,
            ],
        ];

        foreach ($services as $service) {
            HealthService::firstOrCreate(
                ['name' => $service['name']],
                $service
            );
        }

        $this->command->info('✓ Health Service data seeded');
    }
}
