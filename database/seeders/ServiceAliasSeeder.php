<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ServiceAlias;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceAliasSeeder extends Seeder
{
    /**
     * Run the database seeds for Service Aliases.
     * Realistic keywords partitioned into 'landing_page' and 'copy_only'.
     */
    public function run(): void
    {
        $aliasDataset = [
            'pipa-mampet' => [
                [
                    'keyword'         => 'paralon mampet',
                    'slug'            => 'paralon-mampet',
                    'intent'          => 'transactional',
                    'usage'           => 'landing_page',
                    'search_volume'   => 2400,
                    'intro_override'  => 'Solusi cepat dan profesional mengatasi pipa paralon PVC mampet di rumah, ruko, maupun gedung kantor tanpa merusak keramik lantai atau dinding.',
                    'faq_overrides'   => [
                        [
                            'question' => 'Apakah pelancaran paralon mampet merusak pipa PVC?',
                            'answer'   => 'Tidak. Kami menggunakan mesin spiral baja fleksibel (Ridgid Drain Cleaner) yang berputar mengikuti liukan pipa tanpa mengikis atau memecahkan dinding paralon.',
                        ],
                        [
                            'question' => 'Berapa lama proses pelancaran paralon mampet?',
                            'answer'   => 'Rata-rata pengerjaan memerlukan waktu 30 hingga 60 menit tergantung tingkat keparahan sumbatan dan panjang bentang pipa.',
                        ],
                        [
                            'question' => 'Apakah ada garansi setelah paralon dilancarkan?',
                            'answer'   => 'Ya, Rootera Plumbing memberikan garansi pengerjaan 30 hari. Jika mampet kembali dalam masa garansi, kami servis ulang gratis.',
                        ],
                    ],
                    'is_active'       => true,
                ],
                [
                    'keyword'         => 'saluran air buntu',
                    'slug'            => 'saluran-air-buntu',
                    'intent'          => 'problem',
                    'usage'           => 'landing_page',
                    'search_volume'   => 1900,
                    'intro_override'  => 'Layanan darurat pelancaran saluran air buntu dan meluap 24 jam dengan teknisi berpengalaman dan peralatan spiral mekanik modern tanpa bongkar.',
                    'faq_overrides'   => [
                        [
                            'question' => 'Mengapa saluran air bisa tiba-tiba buntu total?',
                            'answer'   => 'Sumbatan biasanya disebabkan oleh akumulasi kerak lemak menahun, sisa rambut, kotoran pasir, atau benda asing yang terjepit di belokan pipa.',
                        ],
                        [
                            'question' => 'Apakah aman menggunakan bahan kimia untuk saluran buntu?',
                            'answer'   => 'Bahan kimia keras berisiko melunakkan pipa PVC tipis dan menimbulkan uap beracun. Solusi terbaik dan teraman adalah pembersihan mekanis menggunakan spiral cable.',
                        ],
                    ],
                    'is_active'       => true,
                ],
                [
                    'keyword'         => 'pipa air buang tersumbat',
                    'slug'            => 'pipa-air-buang-tersumbat',
                    'intent'          => 'problem',
                    'usage'           => 'copy_only',
                    'search_volume'   => 880,
                    'is_active'       => true,
                ],
                [
                    'keyword'         => 'tukang pipa buntu',
                    'slug'            => 'tukang-pipa-buntu',
                    'intent'          => 'transactional',
                    'usage'           => 'copy_only',
                    'search_volume'   => 1200,
                    'is_active'       => true,
                ],
            ],

            'wastafel-mampet' => [
                [
                    'keyword'         => 'cuci piring mampet',
                    'slug'            => 'cuci-piring-mampet',
                    'intent'          => 'transactional',
                    'usage'           => 'landing_page',
                    'search_volume'   => 1600,
                    'intro_override'  => 'Pelancaran saluran bak cuci piring (kitchen sink) dapur rumah dan restoran yang tersumbat gumpalan minyak serta sisa makanan membeku.',
                    'faq_overrides'   => [
                        [
                            'question' => 'Bagaimana cara Rootera membersihkan lemak membeku di sink dapur?',
                            'answer'   => 'Mata pisau spiral khusus kami memotong dan mengikis gumpalan lemak putih (soap scum & grease) yang menempel kuat di dinding dalam pipa sink dapur.',
                        ],
                        [
                            'question' => 'Apakah leher angsa wastafel perlu dibongkar?',
                            'answer'   => 'Sebagian besar kasus dapat langsung dilancarkan melalui akses pipa tanpa membongkar meja dapur atau kabinet kitchen set Anda.',
                        ],
                    ],
                    'is_active'       => true,
                ],
                [
                    'keyword'         => 'wastafel dapur buntu',
                    'slug'            => 'wastafel-dapur-buntu',
                    'intent'          => 'problem',
                    'usage'           => 'copy_only',
                    'search_volume'   => 720,
                    'is_active'       => true,
                ],
                [
                    'keyword'         => 'saluran sink dapur berlemak',
                    'slug'            => 'saluran-sink-dapur-berlemak',
                    'intent'          => 'problem',
                    'usage'           => 'copy_only',
                    'search_volume'   => 590,
                    'is_active'       => true,
                ],
            ],

            'wc-toilet-mampet' => [
                [
                    'keyword'         => 'kloset mampet',
                    'slug'            => 'kloset-mampet',
                    'intent'          => 'transactional',
                    'usage'           => 'landing_page',
                    'search_volume'   => 3200,
                    'intro_override'  => 'Solusi cepat kloset duduk dan jongkok mampet, air meluap, atau tersumbat tisu dan benda asing tanpa merusak mangkok kloset rumah Anda.',
                    'faq_overrides'   => [
                        [
                            'question' => 'Apakah kloset harus dicopot untuk dilancarkan?',
                            'answer'   => 'Lebih dari 90% kasus kloset tersumbat dapat diatasi langsung menggunakan closet auger profesional tanpa perlu mengangkat atau membongkar mangkok kloset.',
                        ],
                        [
                            'question' => 'Berapa lama teknisi bisa tiba di lokasi?',
                            'answer'   => 'Armada Rootera siaga di berbagai posko wilayah dengan estimasi tiba 20 hingga 40 menit setelah konfirmasi pesanan.',
                        ],
                    ],
                    'is_active'       => true,
                ],
                [
                    'keyword'         => 'wc buntu meluap',
                    'slug'            => 'wc-buntu-meluap',
                    'intent'          => 'problem',
                    'usage'           => 'copy_only',
                    'search_volume'   => 1400,
                    'is_active'       => true,
                ],
                [
                    'keyword'         => 'kloset tersumbat tisu',
                    'slug'            => 'kloset-tersumbat-tisu',
                    'intent'          => 'problem',
                    'usage'           => 'copy_only',
                    'search_volume'   => 650,
                    'is_active'       => true,
                ],
            ],

            'kamar-mandi-mampet' => [
                [
                    'keyword'         => 'floor drain mampet',
                    'slug'            => 'floor-drain-mampet',
                    'intent'          => 'transactional',
                    'usage'           => 'landing_page',
                    'search_volume'   => 1800,
                    'intro_override'  => 'Atasi genangan air di lantai kamar mandi akibat floor drain tersumbat rontokan rambut, kerak sabun, dan lumut tanpa membongkar keramik.',
                    'faq_overrides'   => [
                        [
                            'question' => 'Kenapa floor drain kamar mandi sering mampet berulang?',
                            'answer'   => 'Rontokan rambut manusia yang terperangkap bereaksi dengan lemak sabun mandi dan membentuk gumpalan padat berserat di belokan leher angsa pipa.',
                        ],
                        [
                            'question' => 'Apakah air kotor akan berceceran saat proses pengerjaan?',
                            'answer'   => 'Teknisi kami bekerja rapi dan higienis menggunakan pelindung area kerja sehingga kamar mandi Anda tetap bersih.',
                        ],
                    ],
                    'is_active'       => true,
                ],
                [
                    'keyword'         => 'saluran kamar mandi menggenang',
                    'slug'            => 'saluran-kamar-mandi-menggenang',
                    'intent'          => 'problem',
                    'usage'           => 'copy_only',
                    'search_volume'   => 820,
                    'is_active'       => true,
                ],
                [
                    'keyword'         => 'pembuangan air mandi buntu',
                    'slug'            => 'pembuangan-air-mandi-buntu',
                    'intent'          => 'problem',
                    'usage'           => 'copy_only',
                    'search_volume'   => 540,
                    'is_active'       => true,
                ],
            ],

            'inspeksi-pipa-kamera' => [
                [
                    'keyword'         => 'deteksi pipa bocor',
                    'slug'            => 'deteksi-pipa-bocor',
                    'intent'          => 'transactional',
                    'usage'           => 'landing_page',
                    'search_volume'   => 2100,
                    'intro_override'  => 'Deteksi kebocoran pipa air bersih dan saluran pembuangan di dalam dinding beton atau bawah lantai dengan sensor akustik dan kamera endoskopi presisi tinggi.',
                    'faq_overrides'   => [
                        [
                            'question' => 'Bagaimana cara mendeteksi pipa bocor tanpa membongkar dinding?',
                            'answer'   => 'Kami mengombinasikan electro-acoustic leak detector, thermal imaging scanner, dan push-rod camera untuk menemukan titik kebocoran dengan akurasi tinggi.',
                        ],
                        [
                            'question' => 'Berapa biaya jasa deteksi pipa bocor?',
                            'answer'   => 'Biaya disesuaikan dengan luas bangunan dan jalur instalasi pipa. Konsultasi dan estimasi awal gratis via WhatsApp.',
                        ],
                    ],
                    'is_active'       => true,
                ],
                [
                    'keyword'         => 'kamera endoskopi pipa',
                    'slug'            => 'kamera-endoskopi-pipa',
                    'intent'          => 'informational',
                    'usage'           => 'landing_page',
                    'search_volume'   => 1100,
                    'intro_override'  => 'Pemeriksaan visual saluran pipa indoor dan outdoor dengan rekaman video beresolusi HD untuk menemukan keretakan, sambungan lepas, atau sumbatan tersembunyi.',
                    'faq_overrides'   => [
                        [
                            'question' => 'Apakah pelanggan mendapatkan rekaman video inspeksi?',
                            'answer'   => 'Ya, kami menyediakan softcopy rekaman video inspeksi pipa HD beserta lembar rekomendasi teknis perbaikan.',
                        ],
                    ],
                    'is_active'       => true,
                ],
                [
                    'keyword'         => 'titik pipa air rembes',
                    'slug'            => 'titik-pipa-air-rembes',
                    'intent'          => 'problem',
                    'usage'           => 'copy_only',
                    'search_volume'   => 610,
                    'is_active'       => true,
                ],
            ],

            'got-saluran-pembuangan' => [
                [
                    'keyword'         => 'kuras toren air',
                    'slug'            => 'kuras-toren-air',
                    'intent'          => 'transactional',
                    'usage'           => 'landing_page',
                    'search_volume'   => 2600,
                    'intro_override'  => 'Layanan kuras toren penampungan air dan pembersihan endapan lumpur bak kontrol pembuangan rumah agar air kembali jernih, higienis, dan bebas lumut.',
                    'faq_overrides'   => [
                        [
                            'question' => 'Berapa kali sebaiknya toren air dikuras?',
                            'answer'   => 'Idealnya toren air dikuras secara berkala setiap 3 hingga 6 bulan sekali untuk mencegah lumut tebal, endapan karat pipa, dan bakteri kotor.',
                        ],
                        [
                            'question' => 'Apakah pembersihan toren menggunakan bahan kimia berbahaya?',
                            'answer'   => 'Tidak. Kami menggunakan pembersihan mekanis water jet bertekanan dan bahan pembersih ramah lingkungan yang aman untuk instalasi air bersih keluarga.',
                        ],
                    ],
                    'is_active'       => true,
                ],
                [
                    'keyword'         => 'talang air hujan meluap',
                    'slug'            => 'talang-air-hujan-meluap',
                    'intent'          => 'problem',
                    'usage'           => 'copy_only',
                    'search_volume'   => 480,
                    'is_active'       => true,
                ],
                [
                    'keyword'         => 'got pembuangan meluap',
                    'slug'            => 'got-pembuangan-meluap',
                    'intent'          => 'problem',
                    'usage'           => 'copy_only',
                    'search_volume'   => 790,
                    'is_active'       => true,
                ],
            ],
        ];

        foreach ($aliasDataset as $categorySlug => $aliases) {
            $category = ServiceCategory::where('slug', $categorySlug)->first();

            if (! $category) {
                continue;
            }

            foreach ($aliases as $aliasData) {
                ServiceAlias::updateOrCreate(
                    [
                        'service_category_id' => $category->id,
                        'slug'                => $aliasData['slug'],
                    ],
                    [
                        'keyword'        => $aliasData['keyword'],
                        'intent'         => $aliasData['intent'],
                        'usage'          => $aliasData['usage'],
                        'search_volume'  => $aliasData['search_volume'] ?? null,
                        'intro_override' => $aliasData['intro_override'] ?? null,
                        'faq_overrides'  => $aliasData['faq_overrides'] ?? null,
                        'is_active'      => $aliasData['is_active'] ?? true,
                    ]
                );
            }
        }
    }
}
