<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;
use App\Models\Service;
use Illuminate\Support\Str;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds for Service Taxonomy and Sub-Services.
     */
    public function run(): void
    {
        $categories = [
            [
                'name'              => 'Saluran Pipa Mampet',
                'slug'              => 'pipa-mampet',
                'description'       => 'Pelancaran jasa pipa pembuangan air tersumbat menggunakan mesin spiral fleksibel tanpa bongkar keramik.',
                'icon'              => 'pipe',
                'sort_order'        => 1,
                'is_active'         => true,
                'meta_title'        => 'Jasa Pelancar Pipa Mampet Tanpa Bongkar 24 Jam | Rootera',
                'meta_description'  => 'Jasa pelancar pipa mampet profesional tanpa bongkar lantai. Menggunakan rooter spiral cable modern bergaransi tuntas.',
                'price_home'        => 'Mulai Rp 350.000',
                'price_corporate'   => 'Hubungi CS',
                'price_description' => 'Bergaransi tuntas 100% tanpa bongkar paksa',
                'sub_services'      => [
                    ['name' => 'Pelancaran Pipa Paralon Utama (Main Pipe)', 'short_description' => 'Pembersihan pipa pembuangan utama rumah dari endapan sisa kotoran tanpa bongkar ubin.'],
                    ['name' => 'Pembersihan Kerak Lemak Pipa Rotary Spiral', 'short_description' => 'Pengikisan kerak minyak & lemak mengeras menggunakan kawat fleksibel putar berkecepatan tinggi.'],
                    ['name' => 'Deteksi Endapan Sedimen & Pasir Dalam Pipa', 'short_description' => 'Pengurasan sedimen pasir & tanah yang menyumbat alur pembuangan di bawah tanah.'],
                    ['name' => 'Pencegahan Pipa Mampet Berulang Tanpa Bongkar', 'short_description' => 'Teknik pembersihan menyeluruh dinding pipa agar aliran lancar dalam jangka panjang.'],
                ],
            ],
            [
                'name'              => 'Wastafel & Sink Mampet',
                'slug'              => 'wastafel-mampet',
                'description'       => 'Pembersihan endapan lemak membeku dan sisa makanan pada cuci piring dapur rumah & restoran.',
                'icon'              => 'sink',
                'sort_order'        => 2,
                'is_active'         => true,
                'meta_title'        => 'Jasa Wastafel & Sink Mampet Berlemak | Rootera',
                'meta_description'  => 'Spesialis pembersih wastafel dapur & bak cuci piring mampet akibat lemak mengeras. Cepat dan bersih bergaransi.',
                'price_home'        => 'Mulai Rp 300.000',
                'price_corporate'   => 'Hubungi CS',
                'price_description' => 'Garansi bebas bau & bebas minyak',
                'sub_services'      => [
                    ['name' => 'Pelancaran Leher Angsa Wastafel Dapur', 'short_description' => 'Pembersihan saringan & p-trap wastafel dapur dari tumpukan sisa bahan makanan.'],
                    ['name' => 'Pengikisan Kerak Lemak Membeku Sink Restoran', 'short_description' => 'Penanganan khusus lemak jenuh minyak goreng pada bak cuci komersial dapur restoran.'],
                    ['name' => 'Penggantian & Pembersihan Trap Saringan Cuci Piring', 'short_description' => 'Pembersihan dan pemasangan ulang komponen trap wastafel agar bebas bocor & bau.'],
                ],
            ],
            [
                'name'              => 'Kamar Mandi & Floor Drain Mampet',
                'slug'              => 'kamar-mandi-mampet',
                'description'       => 'Pelancaran saringan floor drain kamar mandi tersumbat rontokan rambut, sabun, dan kerak kapur.',
                'icon'              => 'shower',
                'sort_order'        => 3,
                'is_active'         => true,
                'meta_title'        => 'Jasa Saluran Kamar Mandi & Floor Drain Mampet | Rootera',
                'meta_description'  => 'Solusi floor drain kamar mandi menggenang dan mampet. Pengerjaan cepat tanpa merusak ubin rumah Anda.',
                'price_home'        => 'Mulai Rp 350.000',
                'price_corporate'   => 'Hubungi CS',
                'price_description' => 'Solusi cepat genangan air kamar mandi',
                'sub_services'      => [
                    ['name' => 'Pembersihan Floor Drain Kamar Mandi Menggenang', 'short_description' => 'Pelancaran saringan pembuangan lantai kamar mandi dari genangan air kotor.'],
                    ['name' => 'Pengambilan Rontokan Rambut & Gumpalan Sabun', 'short_description' => 'Penarikan gumpalan sisa rambut & kerak busa sabun yang menyumbat belokan pipa.'],
                    ['name' => 'Pembersihan Kerak Kapur Saluran Bathtub & Jacuzzi', 'short_description' => 'Pembersihan saluran buang bak mandi bathtub & jacuzzi dari endapan kapur keras.'],
                ],
            ],
            [
                'name'              => 'WC & Kloset Toilet Mampet',
                'slug'              => 'wc-toilet-mampet',
                'description'       => 'Penanganan kloset duduk atau jongkok tersumbat tisu, benda asing, atau leher angsa mampet.',
                'icon'              => 'toilet',
                'sort_order'        => 4,
                'is_active'         => true,
                'meta_title'        => 'Jasa Kloset & WC Toilet Mampet Meluap | Rootera',
                'meta_description'  => 'Jasa kloset toilet meluap dan mampet. Teknisi profesional datang cepat 24 jam solusi tuntas bergaransi.',
                'price_home'        => 'Mulai Rp 400.000',
                'price_corporate'   => 'Hubungi CS',
                'price_description' => 'Penanganan higienis & ramah lingkungan',
                'sub_services'      => [
                    ['name' => 'Pelancaran Kloset Duduk & Jongkok Tersumbat', 'short_description' => 'Penanganan leher angsa kloset meluap menggunakan pendorong vakum higienis.'],
                    ['name' => 'Pengambilan Benda Asing / Tisu Basah Tanpa Copot Kloset', 'short_description' => 'Evakuasi benda asing, mainan anak, atau tisu basah dari dalam lubang kloset.'],
                    ['name' => 'Penanganan Leher Angsa WC Meluap Higienis', 'short_description' => 'Sterilisasi & pelancaran saluran buang toilet rumah tangga dengan garansi tuntas.'],
                ],
            ],
            [
                'name'              => 'Got & Saluran Pembuangan',
                'slug'              => 'got-saluran-pembuangan',
                'description'       => 'Pembersihan talang air hujan, got perumahan, dan pipa induk pembuangan akhir meluap.',
                'icon'              => 'drain',
                'sort_order'        => 5,
                'is_active'         => true,
                'meta_title'        => 'Jasa Pelancar Got & Saluran Talang Hujan | Rootera',
                'meta_description'  => 'Atasi got tersumbat daun & pasir serta saluran talang air meluap saat hujan deras. Garansi aliran lancar.',
                'price_home'        => 'Mulai Rp 450.000',
                'price_corporate'   => 'Hubungi CS',
                'price_description' => 'Kapasitas alat berat fleksibel',
                'sub_services'      => [
                    ['name' => 'Pelancaran Saluran Got Utama Rumah Tangga', 'short_description' => 'Pembersihan pipa buang got lingkungan rumah dari tumpukan sampah & endapan.'],
                    ['name' => 'Pembersihan Talang Air Hujan & Roof Drain', 'short_description' => 'Pengurasan saluran talang atap rumah tersumbat daun kering & sarang burung.'],
                    ['name' => 'Kuras Endapan Pasir & Lumpur Bak Kontrol', 'short_description' => 'Pengangkatan sedimen lumpur padat & pasir di bak kontrol pembuangan air.'],
                    ['name' => 'Pemasangan Backwater Valve Anti-Banjir', 'short_description' => 'Pemasangan katup satu arah pencegah air got meluap kembali ke dalam kamar mandi.'],
                    ['name' => 'Saluran Pembuangan Air Cuci Piring (Sink)', 'short_description' => 'Pelancaran pipa buang outdoor penampung limbah dapur komersial & residensial.'],
                ],
            ],
            [
                'name'              => 'Inspeksi Pipa Kamera CCTV',
                'slug'              => 'inspeksi-pipa-kamera',
                'description'       => 'Deteksi titik sumbatan, kebocoran, atau pipa pecah di dalam dinding/lantai menggunakan kamera kabel beresolusi tinggi.',
                'icon'              => 'camera',
                'sort_order'        => 6,
                'is_active'         => true,
                'meta_title'        => 'Jasa Deteksi Kebocoran & Inspeksi Pipa CCTV | Rootera',
                'meta_description'  => 'Inspeksi pipa indoor/outdoor dengan kamera CCTV locator canggih. Akurat mengetahui posisi pipa rusak tanpa bongkar sebarangan.',
                'price_home'        => 'Mulai Rp 500.000',
                'price_corporate'   => 'Hubungi CS',
                'price_description' => 'Laporan visual kamera HD',
                'sub_services'      => [
                    ['name' => 'Inspeksi Visual Kamera CCTV Pipa Indoor/Outdoor', 'short_description' => 'Pemeriksaan kondisi bagian dalam pipa dengan kabel kamera mikro fleksibel.'],
                    ['name' => 'Locator Titik Pipa Pecah / Bocor Dalam Dinding', 'short_description' => 'Deteksi posisi presisi kebocoran pipa tersembunyi di dalam tembok beton.'],
                    ['name' => 'Laporan Video Inspeksi Pipa HD untuk Audit Gedung', 'short_description' => 'Penyediaan rekaman video HD & rekomendasi teknis perbaikan pipa gedung.'],
                ],
            ],
            [
                'name'              => 'Pipa Komersial & Industri',
                'slug'              => 'pipa-industri-pabrik',
                'description'       => 'Layanan pembersihan dan maintenance pipa skala besar untuk pabrik, hotel, restoran, gedung ruko, & mall.',
                'icon'              => 'factory',
                'sort_order'        => 7,
                'is_active'         => true,
                'meta_title'        => 'Jasa Maintenance Pipa Industri, Restoran & Pabrik | Rootera',
                'meta_description'  => 'Layanan kontrak pemeliharaan & pelancaran pipa komersial pabrik, mall, cafe, dan hotel di seluruh Indonesia.',
                'price_home'        => 'Custom Quote',
                'price_corporate'   => 'Penawaran Khusus',
                'price_description' => 'Tersedia Invoice & SPK Resmi PT/CV',
                'sub_services'      => [
                    ['name' => 'Hydro Jetting High-Pressure Cleaning', 'short_description' => 'Pembersihan pipa diameter besar (6-12 inci) dengan semprotan air tekanan tinggi 300 Bar.'],
                    ['name' => 'Pembersihan Grease Trap Skala Industri & Restoran', 'short_description' => 'Pengurasan & sterilisasi perangkap lemak dapur restoran & pabrik olahan makanan.'],
                    ['name' => 'Main Riser & Vertical Pipe Stack Maintenance Apartemen', 'short_description' => 'Pembersihan pipa tegak vertikal utama gedung bertingkat & apartemen.'],
                    ['name' => 'Drainase Lantai Pabrik & Gudang', 'short_description' => 'Pelancaran saluran air buang lantai produksi pabrik & kawasan industri.'],
                    ['name' => 'Kontrak Preventive Maintenance Bulanan B2B', 'short_description' => 'Paket pemeliharaan rutin sanitasi gedung berkala dengan SLA & Faktur Pajak Resmi.'],
                ],
            ],
        ];

        foreach ($categories as $catData) {
            $subServices = $catData['sub_services'] ?? [];
            unset($catData['sub_services']);

            $category = ServiceCategory::updateOrCreate(['slug' => $catData['slug']], $catData);

            foreach ($subServices as $idx => $sub) {
                Service::updateOrCreate(
                    [
                        'service_category_id' => $category->id,
                        'slug'                => Str::slug($sub['name']),
                    ],
                    [
                        'name'              => $sub['name'],
                        'short_description' => $sub['short_description'],
                        'is_active'         => true,
                        'sort_order'        => $idx + 1,
                    ]
                );
            }
        }
    }
}
