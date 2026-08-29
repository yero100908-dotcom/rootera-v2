<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Partner;
use App\Models\SeoPage;
use App\Models\GalleryPhoto;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create admin user
        User::updateOrCreate(
            ['email' => 'admin@rootera.id'],
            [
                'name'     => 'Admin ROOTERA',
                'email'    => 'admin@rootera.id',
                'password' => Hash::make('rootera2025'),
            ]
        );

        // 2. Call Taxonomies & Seeders
        $this->call([
            ServiceCategorySeeder::class,
            CommercialSectorSeeder::class,
            PropertyTypeSeeder::class,
            GeoDatabaseSeeder::class,
            KeywordDirectorySeeder::class,
            ProjectGallerySeeder::class,
            GallerySeeder::class,
            BlogSeeder::class,
            FaqSeeder::class,
        ]);

        // 3. Gallery Photos
        $photos = [
            ['title' => 'Pembersihan Saluran Kamar Mandi', 'image' => 'images/dokumentasi/pelancar-floor-drain-kamar-mandi-rumah.webp', 'category' => 'after', 'sort_order' => 1],
            ['title' => 'Alat Profesional Hydrojet',       'image' => 'images/dokumentasi/mesin-drain-cleaner-pelancar-pipa.webp', 'category' => 'tools',  'sort_order' => 2],
            ['title' => 'Tim Teknisi ROOTERA',             'image' => 'images/dokumentasi/teknisi-rootera-stasiun-kai-jateng.webp',  'category' => 'team',   'sort_order' => 3],
            ['title' => 'Pelancaran Wastafel Rumah',       'image' => 'images/dokumentasi/pelancaran-wastafel-mampet-rumah-warga.webp',  'category' => 'after',  'sort_order' => 4],
            ['title' => 'Pembersihan Grease Trap Resto',   'image' => 'images/dokumentasi/pembersihan-grease-trap-restoran.webp',  'category' => 'after',  'sort_order' => 5],
            ['title' => 'Penanganan Pipa Tersumbat',        'image' => 'images/dokumentasi/kondisi-pipa-lemak-resto-mall-tersumbat.webp',  'category' => 'before', 'sort_order' => 6],
        ];

        foreach ($photos as $photo) {
            GalleryPhoto::updateOrCreate(['title' => $photo['title']], array_merge($photo, ['is_active' => true]));
        }

        // 4. Partners
        $seedPartners = [
            ['nama_mitra' => 'Pertamina', 'logo' => 'partners/pertamina.svg'],
            ['nama_mitra' => 'PLN', 'logo' => 'partners/pln.svg'],
            ['nama_mitra' => 'Telkom Indonesia', 'logo' => 'partners/telkom.svg'],
            ['nama_mitra' => 'Bank Mandiri', 'logo' => 'partners/mandiri.svg'],
            ['nama_mitra' => 'BCA', 'logo' => 'partners/bca.svg'],
            ['nama_mitra' => 'Indofood', 'logo' => 'partners/indofood.svg'],
        ];

        foreach ($seedPartners as $p) {
            Partner::updateOrCreate(['nama_mitra' => $p['nama_mitra']], $p);
        }

        // 5. SEO Pages
        $seedSeo = [
            [
                'page_name' => 'Beranda',
                'route_name' => 'home',
                'meta_title' => 'ROOTERA – Jasa Pipa Mampet & Saluran Tersumbat No. 1',
                'meta_description' => 'Atasi saluran mampet tanpa bongkar! Garansi bersih, pengerjaan cepat menggunakan hydro-jetting modern 24/7 di Jabodetabek & Bandung. Hubungi kami.',
                'canonical_url' => url('/'),
                'is_indexable' => true
            ],
            [
                'page_name' => 'Layanan',
                'route_name' => 'layanan',
                'meta_title' => 'Layanan ROOTERA – Solusi Pipa Mampet & Instalasi Sanitary',
                'meta_description' => 'Temukan semua layanan ROOTERA: pembersihan saluran mampet, cuci toren, dan instalasi pipa profesional menggunakan alat modern tanpa bongkar bangunan.',
                'canonical_url' => url('/layanan'),
                'is_indexable' => true
            ],
            [
                'page_name' => 'Tentang Kami',
                'route_name' => 'tentang-kami',
                'meta_title' => 'Tentang Kami – Tim Plumbing Profesional ROOTERA',
                'meta_description' => 'Mengenal ROOTERA lebih dekat. Penyedia jasa plumbing profesional dengan peralatan modern, bergaransi, dan didukung teknisi berpengalaman.',
                'canonical_url' => url('/tentang-kami'),
                'is_indexable' => true
            ],
            [
                'page_name' => 'Area Layanan',
                'route_name' => 'area-layanan',
                'meta_title' => 'Area Jangkauan Layanan Plumbing ROOTERA',
                'meta_description' => 'ROOTERA melayani perbaikan pipa air & saluran mampet di Jabodetabek, Bandung, Cirebon, Semarang, Yogyakarta, dan Lampung. Hubungi kami terdekat.',
                'canonical_url' => url('/area-layanan'),
                'is_indexable' => true
            ],
            [
                'page_name' => 'Blog Artikel',
                'route_name' => 'blog',
                'meta_title' => 'Blog & Tips Perawatan Pipa Air – ROOTERA',
                'meta_description' => 'Tips mengatasi wastafel mampet, cuci toren air, dan informasi penting seputar saluran pembuangan serta instalasi plumbing rumah Anda.',
                'canonical_url' => url('/blog'),
                'is_indexable' => true
            ],
            [
                'page_name' => 'Hubungi Kontak',
                'route_name' => 'kontak',
                'meta_title' => 'Hubungi ROOTERA – Layanan Darurat Saluran Air Mampet',
                'meta_description' => 'Hubungi tim sales/support ROOTERA untuk respon cepat darurat pipa mampet, kran bocor, cuci toren air, atau konsultasi gratis.',
                'canonical_url' => url('/kontak'),
                'is_indexable' => true
            ]
        ];

        foreach ($seedSeo as $s) {
            SeoPage::updateOrCreate(['route_name' => $s['route_name']], $s);
        }
    }
}
