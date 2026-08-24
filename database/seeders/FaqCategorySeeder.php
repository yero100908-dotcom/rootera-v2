<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FaqCategory;
use Illuminate\Support\Str;

class FaqCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Biaya & Estimasi Harga',
                'slug' => 'biaya-dan-estimasi-harga',
                'description' => 'Informasi transparansi biaya pelancaran pipa, sistem garansi 30 hari, opsi pembayaran tunai/transfer, serta faktur pajak PPN untuk transaksi B2B.',
                'icon' => '💳',
                'sort_order' => 1,
            ],
            [
                'name' => 'Metode & Teknologi Alat',
                'slug' => 'metode-dan-teknologi-alat',
                'description' => 'Penjelasan teknologi pengerjaan pipa tanpa bongkar menggunakan mesin spiral rotary flex cable, hydro-jetting tekanan tinggi, dan inspeksi kamera CCTV.',
                'icon' => '🛠️',
                'sort_order' => 2,
            ],
            [
                'name' => 'Jaminan & Garansi Layanan',
                'slug' => 'jaminan-dan-garansi-layanan',
                'description' => 'Syarat dan ketentuan jaminan garansi resmi 30 hari Rootera Plumbing (J&J Group), prosedur pengerjaan ulang gratis, dan sertifikasi layanan.',
                'icon' => '🛡️',
                'sort_order' => 3,
            ],
            [
                'name' => 'Cakupan Wilayah & Respon',
                'slug' => 'cakupan-wilayah-dan-respon',
                'description' => 'Jangkauan panggil teknisi 24 jam nonstop untuk Jabodetabek, Banten, Jawa Barat, Jawa Tengah, DIY, Jawa Timur, dan Lampung dengan estimasi tiba 25-40 menit.',
                'icon' => '📍',
                'sort_order' => 4,
            ],
            [
                'name' => 'Layanan B2B & Kontrak Maintenance',
                'slug' => 'layanan-b2b-dan-kontrak-maintenance',
                'description' => 'Paket pemeliharaan berkala (PKS/Preventive Maintenance) untuk restoran, cafe, hotel, apartemen, mall, rumah sakit, dan kawasan industri pabrik.',
                'icon' => '🏢',
                'sort_order' => 5,
            ],
            [
                'name' => 'Masalah Saluran Spesifik',
                'slug' => 'masalah-saluran-spesifik',
                'description' => 'Solusi dan panduan teknis penanganan wastafel berlemak membeku, kloset toilet meluap, floor drain kamar mandi bau, dan backflow air got saat hujan.',
                'icon' => '💧',
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $cat) {
            FaqCategory::updateOrCreate(
                ['slug' => $cat['slug']],
                [
                    'name' => $cat['name'],
                    'description' => $cat['description'],
                    'icon' => $cat['icon'],
                    'sort_order' => $cat['sort_order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
