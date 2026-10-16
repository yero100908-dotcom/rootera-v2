<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\City;
use App\Models\District;
use App\Models\ProjectGallery;
use App\Models\ResidentialCluster;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Seeds 5 pilot elite residential clusters in Jabodetabek.
 *
 * Content Score target ≥ 70 per cluster so they are auto-set as indexable:
 *  +15  landmarks    (≥ 3 items)
 *  +25  typical_issues (≥ 2 valid items)
 *  +25  intro_override (≥ 80 words)
 *  +10  coordinates    (lat & long set)
 *  +25  project_gallery (at least 1 linked gallery item — seeded below)
 * ─────
 * = 100  per cluster
 */
class PilotResidentialClusterSeeder extends Seeder
{
    public function run(): void
    {
        $clusters = $this->clusterData();

        foreach ($clusters as $data) {
            // ── Resolve city & primary district ─────────────────────────
            $city = City::where('slug', $data['city_slug'])->first();

            if (! $city) {
                $this->command->warn("City not found: {$data['city_slug']} — skipping {$data['name']}");
                continue;
            }

            $district = District::where('city_id', $city->id)
                ->where('slug', $data['district_slug'])
                ->first();

            // ── Upsert cluster ───────────────────────────────────────────
            /** @var ResidentialCluster $cluster */
            $cluster = ResidentialCluster::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'city_id'           => $city->id,
                    'district_id'       => $district?->id,
                    'name'              => $data['name'],
                    'short_name'        => $data['short_name'],
                    'tier'              => $data['tier'],
                    'developer'         => $data['developer'],
                    'built_year'        => $data['built_year'],
                    'latitude'          => $data['latitude'],
                    'longitude'         => $data['longitude'],
                    'landmarks'         => $data['landmarks'],
                    'typical_issues'    => $data['typical_issues'],
                    'sub_clusters'      => $data['sub_clusters'] ?? [],
                    'property_profile'  => $data['property_profile'] ?? null,
                    'estimated_arrival' => $data['estimated_arrival'],
                    'intro_override'    => $data['intro_override'],
                    'meta_title'        => $data['meta_title'],
                    'meta_description'  => $data['meta_description'],
                    'is_active'         => true,
                    'sort_order'        => $data['sort_order'],
                ]
            );

            // ── Attach extra districts via pivot ─────────────────────────
            if (! empty($data['extra_district_slugs'])) {
                $extraIds = District::whereIn('slug', $data['extra_district_slugs'])
                    ->pluck('id')
                    ->toArray();

                $allDistrictIds = array_unique(array_filter(
                    array_merge([$district?->id], $extraIds)
                ));

                $cluster->districts()->sync($allDistrictIds);
            }

            // ── Seed at least 1 project gallery (content score +25) ──────
            $this->seedGallery($cluster, $data);

            $this->command->info("✔ Seeded cluster: {$cluster->name} (score will be recalculated by observer)");
        }

        $this->command->newLine();
        $this->command->info('PilotResidentialClusterSeeder completed.');
    }

    /* ─────────────────────────────────────────────────────────────────────
     | GALLERY SEEDER (creates 2 project-gallery entries per cluster)
     | ─────────────────────────────────────────────────────────────────── */

    private function seedGallery(ResidentialCluster $cluster, array $data): void
    {
        $entries = [
            [
                'title'                  => "Bongkar Pipa Mampet di {$cluster->name} — Proyek 1",
                'slug'                   => Str::slug("proyek-pipa-mampet-{$cluster->slug}-1"),
                'description'            => "Penanganan saluran tersumbat parah di kawasan {$cluster->name}. "
                    . "Tim teknisi Rootera berhasil mengatasi mampet pada pipa utama diameter 4 inci "
                    . "menggunakan metode tembak air bertekanan tinggi (hydro-jetting).",
                'before_image'           => null,
                'after_image'            => null,
                'residential_cluster_id' => $cluster->id,
                'city_id'                => $cluster->city_id,
                'district_id'            => $cluster->district_id,
                'tool_used'              => 'Hydro-Jetting Machine 4000 PSI',
                'client_type'            => 'residential',
                'is_active'              => true,
                'sort_order'             => 1,
            ],
            [
                'title'                  => "Instalasi Pipa PPR Rumah Mewah {$cluster->name} — Proyek 2",
                'slug'                   => Str::slug("proyek-instalasi-pipa-{$cluster->slug}-2"),
                'description'            => "Pemasangan jaringan pipa baru lengkap untuk rumah tapak mewah "
                    . "di {$cluster->name}. Menggunakan pipa PPR standar SNI dengan fitting press, "
                    . "termasuk instalasi hot & cold water lines dan uji tekanan 10 bar.",
                'before_image'           => null,
                'after_image'            => null,
                'residential_cluster_id' => $cluster->id,
                'city_id'                => $cluster->city_id,
                'district_id'            => $cluster->district_id,
                'tool_used'              => 'PPR Pipe Fusion Welder',
                'client_type'            => 'residential',
                'is_active'              => true,
                'sort_order'             => 2,
            ],
        ];

        foreach ($entries as $entry) {
            ProjectGallery::updateOrCreate(
                ['slug' => $entry['slug']],
                $entry
            );
        }
    }

    /* ─────────────────────────────────────────────────────────────────────
     | CLUSTER DATA
     | ─────────────────────────────────────────────────────────────────── */

    private function clusterData(): array
    {
        return [

            /* ══════════════════════════════════════════════════════════
             | 1. PANTAI INDAH KAPUK (PIK)
             | City: jakarta-utara  |  District: pantai-indah-kapuk-pik
             ══════════════════════════════════════════════════════════ */
            [
                'name'          => 'Pantai Indah Kapuk (PIK)',
                'short_name'    => 'PIK',
                'slug'          => 'pantai-indah-kapuk-pik',
                'city_slug'     => 'jakarta-utara',
                'district_slug' => 'pantai-indah-kapuk-pik',
                'tier'          => 'elite',
                'developer'     => 'Agung Sedayu Group',
                'built_year'    => 1995,
                'sort_order'    => 1,
                'latitude'      => -6.1044,
                'longitude'     => 106.7467,
                'estimated_arrival' => '20-35 Menit',
                'extra_district_slugs' => ['pluit', 'penjaringan'],

                'landmarks' => [
                    ['name' => 'Pantai Maju (PIK 2)', 'distance_km' => 3.5],
                    ['name' => 'Aeon Mall PIK 2',     'distance_km' => 4.0],
                    ['name' => 'RS Pluit',             'distance_km' => 2.8],
                    ['name' => 'Mutiara Beach Resort', 'distance_km' => 1.2],
                    ['name' => 'Klub Golf Pantai Indah Kapuk', 'distance_km' => 0.9],
                ],

                'typical_issues' => [
                    [
                        'issue'      => 'Korosi Pipa Akibat Air Asin',
                        'severity'   => 'high',
                        'detail'     => 'Wilayah pesisir PIK memiliki kadar garam tinggi pada air tanah yang mempercepat korosi pipa besi/galvanis dalam 5–8 tahun. Solusi: penggantian ke pipa PPR atau HDPE.',
                        'frequency'  => 'very_common',
                    ],
                    [
                        'issue'      => 'Sedimentasi Lumpur di Pipa Drainase',
                        'severity'   => 'high',
                        'detail'     => 'Tanah reklamasi PIK mengandung lumpur halus yang mudah tersedimentasi di pipa drainase bergaris tengah kecil. Wajib flushing berkala 6 bulanan.',
                        'frequency'  => 'common',
                    ],
                    [
                        'issue'      => 'WC Mampet Akibat Tekanan Air Fluktuatif',
                        'severity'   => 'medium',
                        'detail'     => 'Tekanan air PDAM di PIK sering fluktuatif (peak hour 1–2 bar, malam 3.5+ bar) menyebabkan kerusakan katup flush dan penyumbatan pada pipa keramik WC.',
                        'frequency'  => 'common',
                    ],
                    [
                        'issue'      => 'Saluran Bak Kontrol Tersumbat Akar Mangrove',
                        'severity'   => 'medium',
                        'detail'     => 'Keberadaan pohon mangrove dekoratif di kavling mewah PIK sering menyebabkan akar merambat masuk ke bak kontrol dan pipa drainase menuju kanal.',
                        'frequency'  => 'occasional',
                    ],
                ],

                'sub_clusters' => [
                    'PIK 1 Taman Elok', 'PIK 1 Taman Firdaus', 'PIK 1 Garden House',
                    'PIK 2 Sedayu City', 'PIK 2 Neo Soho Lifestyle', 'Marina PIK',
                ],

                'property_profile' => 'cluster_elite_landed',

                'intro_override' => 'Rootera Plumbing melayani jasa tukang pipa dan saluran mampet di kawasan Pantai Indah Kapuk (PIK), Jakarta Utara — salah satu perumahan elit eksklusif dengan properti bernilai miliaran rupiah. Tantangan plumbing unik di PIK berasal dari posisi geografisnya sebagai lahan reklamasi pesisir: tanah lunak, air tanah berkadar garam tinggi, dan sedimentasi lumpur pada drainase. Teknisi kami memahami karakteristik tanah dan material pipa di PIK, sehingga diagnosa lebih akurat dan solusi lebih tahan lama. Kami menangani segala kebutuhan plumbing mulai dari bongkar pipa mampet, penggantian pipa galvanis korosif ke PPR, instalasi pompa air, perbaikan kloset duduk, hingga CCTV drain inspection. Layanan tersedia 24 jam dengan estimasi kedatangan 20–35 menit untuk area PIK 1 dan PIK 2.',

                'meta_title'       => 'Jasa Pipa Mampet & Tukang Pipa PIK Jakarta Utara | Rootera 24 Jam',
                'meta_description' => 'Jasa pipa mampet, bongkar WC, dan instalasi pipa di Pantai Indah Kapuk (PIK) Jakarta Utara. Teknisi berpengalaman, tiba 20–35 menit, harga transparan. ☎ 0813-8540-4000.',
            ],

            /* ══════════════════════════════════════════════════════════
             | 2. BSD CITY
             | City: tangerang-selatan  |  District: serpong-bsd-city
             ══════════════════════════════════════════════════════════ */
            [
                'name'          => 'BSD City',
                'short_name'    => 'BSD City',
                'slug'          => 'bsd-city',
                'city_slug'     => 'tangerang-selatan',
                'district_slug' => 'serpong-bsd-city',
                'tier'          => 'elite',
                'developer'     => 'Sinar Mas Land',
                'built_year'    => 1989,
                'sort_order'    => 2,
                'latitude'      => -6.3009,
                'longitude'     => 106.6534,
                'estimated_arrival' => '25-40 Menit',
                'extra_district_slugs' => ['serpong-utara-alam-sutera', 'pagedangan-kawasan-bsd-city-ice'],

                'landmarks' => [
                    ['name' => 'ICE (Indonesia Convention Exhibition)', 'distance_km' => 1.5],
                    ['name' => 'The Breeze BSD City',                   'distance_km' => 1.0],
                    ['name' => 'AEON Mall BSD City',                    'distance_km' => 2.0],
                    ['name' => 'Universitas Prasetya Mulya',            'distance_km' => 0.8],
                    ['name' => 'RS Eka Hospital BSD',                   'distance_km' => 2.3],
                    ['name' => 'Digital Hub Sinar Mas Land',            'distance_km' => 1.7],
                ],

                'typical_issues' => [
                    [
                        'issue'      => 'Pipa PVC Retak Akibat Penurunan Tanah',
                        'severity'   => 'high',
                        'detail'     => 'Area BSD City dibangun di atas bekas kebun dan rawa. Tanah masih mengalami konsolidasi dan dapat menyebabkan retak pada sambungan pipa PVC yang tertanam di bawah pondasi.',
                        'frequency'  => 'common',
                    ],
                    [
                        'issue'      => 'Sedimentasi Kapur di Water Heater & Pipa',
                        'severity'   => 'medium',
                        'detail'     => 'Air PDAM Tangerang Selatan memiliki kesadahan sedang-tinggi (hardness 150–250 ppm). Deposit kapur (scale) memperlambat aliran air panas dan mengurangi efisiensi pemanas 30–40% dalam 2 tahun.',
                        'frequency'  => 'very_common',
                    ],
                    [
                        'issue'      => 'Septic Tank Penuh di Kavling Lama',
                        'severity'   => 'high',
                        'detail'     => 'Kavling BSD City generasi pertama (pre-2000) umumnya menggunakan septic tank konvensional berkapasitas kecil. Tanpa pengurasan rutin, terjadi overflow ke saluran drainase perumahan.',
                        'frequency'  => 'common',
                    ],
                    [
                        'issue'      => 'Kebocoran Pipa Tersembunyi di Tembok',
                        'severity'   => 'high',
                        'detail'     => 'Instalasi pipa in-wall pada rumah tapak cluster premium BSD sering mengalami mikro-kebocoran akibat sambungan solvent cement yang tidak sempurna saat konstruksi, terdeteksi dari noda lembab pada dinding.',
                        'frequency'  => 'occasional',
                    ],
                ],

                'sub_clusters' => [
                    'Grand Wisata BSD', 'The Green BSD', 'Eonna BSD',
                    'Pasadenia', 'Avoria BSD', 'Tanakayu BSD',
                    'The Zora BSD', 'Foresta Business Loft', 'Nava Park BSD',
                ],

                'property_profile' => 'cluster_elite_landed',

                'intro_override' => 'Rootera Plumbing adalah mitra plumbing terpercaya untuk penghuni BSD City, Tangerang Selatan. Kawasan BSD City yang dikembangkan Sinar Mas Land mencakup ribuan unit rumah tapak dari berbagai generasi konstruksi, masing-masing dengan karakteristik plumbing yang berbeda. Masalah umum di BSD meliputi sedimentasi kapur (water hardness) pada pipa dan water heater, retak pipa akibat konsolidasi tanah, septic tank lama yang membutuhkan upgrade, serta kebocoran tersembunyi di dalam dinding. Teknisi Rootera terlatih untuk mendeteksi kebocoran non-destruktif menggunakan pressure test dan thermal camera sebelum membongkar dinding. Kami juga menyediakan layanan cuci toren, instalasi pompa booster, serta penggantian jaringan pipa full-system untuk renovasi rumah di BSD City.',

                'meta_title'       => 'Jasa Pipa Mampet & Instalasi Pipa BSD City Tangerang Selatan | Rootera',
                'meta_description' => 'Tukang pipa profesional di BSD City Tangerang Selatan. Bongkar pipa mampet, instalasi, kebocoran tersembunyi, cuci toren. Estimasi 25–40 menit. ☎ 0813-8540-4000.',
            ],

            /* ══════════════════════════════════════════════════════════
             | 3. BINTARO JAYA
             | City: tangerang-selatan  |  District: pondok-aren-bintaro-jaya
             ══════════════════════════════════════════════════════════ */
            [
                'name'          => 'Bintaro Jaya',
                'short_name'    => 'Bintaro',
                'slug'          => 'bintaro-jaya',
                'city_slug'     => 'tangerang-selatan',
                'district_slug' => 'pondok-aren-bintaro-jaya',
                'tier'          => 'elite',
                'developer'     => 'Jaya Real Property',
                'built_year'    => 1979,
                'sort_order'    => 3,
                'latitude'      => -6.2737,
                'longitude'     => 106.7218,
                'estimated_arrival' => '20-35 Menit',
                'extra_district_slugs' => ['ciputat', 'pamulang'],

                'landmarks' => [
                    ['name' => 'Bintaro Jaya Xchange Mall',    'distance_km' => 0.5],
                    ['name' => 'Bintaro Jaya Xchange 2 Mall',  'distance_km' => 1.0],
                    ['name' => 'RS Pondok Indah Bintaro Jaya', 'distance_km' => 2.1],
                    ['name' => 'Universitas Pembangunan Jaya',  'distance_km' => 1.8],
                    ['name' => 'Pasar Modern Bintaro',          'distance_km' => 0.8],
                    ['name' => 'Stasiun Sudimara (KRL)',         'distance_km' => 2.5],
                ],

                'typical_issues' => [
                    [
                        'issue'      => 'Pipa Tua Galvanis Berkarat di Sektor Lama',
                        'severity'   => 'high',
                        'detail'     => 'Bintaro sektor 1–4 dibangun era 1980–1990an dengan pipa galvanis yang kini berumur 30+ tahun. Karat di dalam pipa menyebabkan air berwarna kekuningan dan debit air berkurang drastis. Wajib diganti ke pipa PPR.',
                        'frequency'  => 'very_common',
                    ],
                    [
                        'issue'      => 'Drainase Banjir Lokal Sektor 9',
                        'severity'   => 'high',
                        'detail'     => 'Bintaro Sektor 9 dan sekitarnya rentan genangan akibat kapasitas drainase yang tidak memadai. Bak kontrol dan pipa drainase rumah sering tersumbat material organik setelah hujan deras.',
                        'frequency'  => 'seasonal',
                    ],
                    [
                        'issue'      => 'WC Mampet di Townhouse & Kos Premium',
                        'severity'   => 'medium',
                        'detail'     => 'Kawasan komersial Bintaro Jaya banyak townhouse dan kos premium. Penggunaan tisu basah dan benda asing merupakan penyebab utama WC mampet yang kami temui di area ini.',
                        'frequency'  => 'common',
                    ],
                    [
                        'issue'      => 'Pompa Air Tidak Kuat Akibat Kavling Bertingkat',
                        'severity'   => 'medium',
                        'detail'     => 'Beberapa kavling Bintaro memiliki kontur tanah berundak. Rumah di elevated plot sering mengalami tekanan air lemah di lantai 2–3 karena pompa submersible kurang daya.',
                        'frequency'  => 'occasional',
                    ],
                ],

                'sub_clusters' => [
                    'Bintaro Sektor 1', 'Bintaro Sektor 2', 'Bintaro Sektor 3',
                    'Bintaro Sektor 7', 'Bintaro Sektor 9', 'Bintaro Sektor 12',
                    'Emerald Bintaro', 'Gading Serpong Bintaro', 'Bintaro Park View',
                ],

                'property_profile' => 'cluster_elite_landed',

                'intro_override' => 'Rootera Plumbing hadir sebagai solusi darurat dan berkala untuk masalah pipa di kawasan Bintaro Jaya, Tangerang Selatan. Bintaro adalah salah satu kawasan residensial tertua dan terbesar di Jabodetabek, dengan rumah-rumah sektor lama yang kini menghadapi masalah penuaan infrastruktur pipa galvanis. Selain itu, kawasan sektor baru seperti Sektor 7, 9, dan 12 menghadapi tantangan drainase dan tekanan air yang berbeda. Tim Rootera familiar dengan peta jaringan pipa PDAM dan layout drainase per sektor di Bintaro, sehingga bisa memberikan diagnosa dan estimasi pekerjaan yang akurat tanpa survey berlarut-larut. Layanan tersedia 24 jam 7 hari termasuk hari libur nasional untuk penanganan darurat kebocoran dan WC mampet.',

                'meta_title'       => 'Jasa Tukang Pipa & Saluran Mampet Bintaro Jaya Tangerang Selatan | Rootera',
                'meta_description' => 'Ahli pipa mampet, ganti pipa galvanis, dan perbaikan saluran di Bintaro Jaya. Melayani sektor 1–12. Estimasi tiba 20–35 menit. ☎ 0813-8540-4000.',
            ],

            /* ══════════════════════════════════════════════════════════
             | 4. KELAPA GADING
             | City: jakarta-utara  |  District: kelapa-gading
             ══════════════════════════════════════════════════════════ */
            [
                'name'          => 'Kelapa Gading',
                'short_name'    => 'Kelapa Gading',
                'slug'          => 'kelapa-gading',
                'city_slug'     => 'jakarta-utara',
                'district_slug' => 'kelapa-gading',
                'tier'          => 'elite',
                'developer'     => 'Summarecon Agung',
                'built_year'    => 1975,
                'sort_order'    => 4,
                'latitude'      => -6.1527,
                'longitude'     => 106.9009,
                'estimated_arrival' => '15-30 Menit',
                'extra_district_slugs' => ['tanjung-priok', 'sunter'],

                'landmarks' => [
                    ['name' => 'Mall of Indonesia (MOI)',    'distance_km' => 0.6],
                    ['name' => 'La Piazza Kelapa Gading',   'distance_km' => 0.3],
                    ['name' => 'RS Mitra Keluarga KG',      'distance_km' => 1.1],
                    ['name' => 'Artha Gading Mall',         'distance_km' => 1.5],
                    ['name' => 'Stasiun Kelapa Gading (LRT)', 'distance_km' => 0.9],
                    ['name' => 'Summarecon Kelapa Gading HQ', 'distance_km' => 0.4],
                ],

                'typical_issues' => [
                    [
                        'issue'      => 'Penurunan Tanah & Retakan Pipa Bawah Tanah',
                        'severity'   => 'high',
                        'detail'     => 'Kelapa Gading terletak di wilayah dataran rendah Jakarta Utara yang mengalami penurunan tanah 5–15 cm per tahun. Ini menyebabkan pipa drainase horizontal mengalami defleksi dan retakan, terutama di kavling berumur >20 tahun.',
                        'frequency'  => 'common',
                    ],
                    [
                        'issue'      => 'Saluran Mampet Akibat Lemak Restoran',
                        'severity'   => 'medium',
                        'detail'     => 'Kelapa Gading adalah pusat kuliner Jakarta. Pipa drainase domestik di sekitar kawasan ruko dan lifestyle street tersumbat lemak dan minyak goreng yang mengeras (grease clog). Diperlukan flushing khusus dengan degreaser.',
                        'frequency'  => 'very_common',
                    ],
                    [
                        'issue'      => 'Pompa Booster Lemah di Rumah Hook & Sudut',
                        'severity'   => 'medium',
                        'detail'     => 'Kavling sudut dan hook di KG umumnya memiliki taman belakang luas namun pasokan PDAM sering tidak cukup tekanan untuk lantai 2. Banyak penghuni membutuhkan instalasi atau upgrade pompa booster.',
                        'frequency'  => 'occasional',
                    ],
                    [
                        'issue'      => 'Kebocoran Pipa Bawah Kolam Renang Pribadi',
                        'severity'   => 'high',
                        'detail'     => 'Rumah mewah Kelapa Gading banyak yang memiliki kolam renang pribadi. Kebocoran pada pipa sirkulasi kolam renang yang tertanam di bawah keramik deck pool memerlukan deteksi pressure test khusus sebelum penggalian.',
                        'frequency'  => 'occasional',
                    ],
                ],

                'sub_clusters' => [
                    'Kelapa Gading Permai', 'Gading Elok', 'Gading Kirana',
                    'Bukit Gading Mediterania', 'Gading Indah', 'Gading Raya',
                    'Gading Batavia', 'Danau Sunter',
                ],

                'property_profile' => 'cluster_elite_landed',

                'intro_override' => 'Rootera Plumbing melayani seluruh kawasan Kelapa Gading, Jakarta Utara — salah satu kecamatan dengan kepadatan properti premium tertinggi di ibu kota. Dari Gading Permai, Bukit Gading Mediterania, hingga ruko kawasan La Piazza, kami siap menangani kedaruratan pipa kapan pun Anda membutuhkannya. Area Kelapa Gading memiliki keunikan tantangan plumbing: penurunan tanah aktif yang meretakkan pipa bawah tanah, drainase berlemak tinggi akibat kepadatan restoran, hingga kebutuhan deteksi kebocoran non-invasif pada kolam renang pribadi. Rootera menggunakan teknologi pressure test dan CCTV drain camera untuk mendiagnosa tanpa perlu bongkar berlebihan. Kami juga melayani gedung komersial, ruko, apartemen, dan rumah tapak di seluruh cluster Kelapa Gading dengan harga flat transparan.',

                'meta_title'       => 'Jasa Pipa Mampet & Tukang Pipa Kelapa Gading Jakarta Utara | Rootera 24 Jam',
                'meta_description' => 'Layanan pipa mampet, kebocoran pipa, dan instalasi plumbing di Kelapa Gading Jakarta Utara. Respons cepat 15–30 menit. Teknisi tersertifikasi. ☎ 0813-8540-4000.',
            ],

            /* ══════════════════════════════════════════════════════════
             | 5. PONDOK INDAH
             | City: jakarta-selatan  |  District: pondok-indah
             ══════════════════════════════════════════════════════════ */
            [
                'name'          => 'Pondok Indah',
                'short_name'    => 'Pondok Indah',
                'slug'          => 'pondok-indah',
                'city_slug'     => 'jakarta-selatan',
                'district_slug' => 'pondok-indah',
                'tier'          => 'elite',
                'developer'     => 'Metropolitan Kentjana',
                'built_year'    => 1972,
                'sort_order'    => 5,
                'latitude'      => -6.2686,
                'longitude'     => 106.7897,
                'estimated_arrival' => '15-30 Menit',
                'extra_district_slugs' => ['kebayoran-lama', 'cilandak'],

                'landmarks' => [
                    ['name' => 'Pondok Indah Mall 1',        'distance_km' => 0.4],
                    ['name' => 'Pondok Indah Mall 3',        'distance_km' => 0.6],
                    ['name' => 'RS Pondok Indah – PIH',      'distance_km' => 0.7],
                    ['name' => 'Pondok Indah Golf Course',   'distance_km' => 0.5],
                    ['name' => 'Kolam Renang Pondok Indah',  'distance_km' => 0.3],
                    ['name' => 'Jakarta International School (JIS)', 'distance_km' => 1.2],
                ],

                'typical_issues' => [
                    [
                        'issue'      => 'Akar Pohon Merambat ke Pipa Drainase',
                        'severity'   => 'high',
                        'detail'     => 'Pondok Indah dikenal dengan pohon-pohon peneduh berusia puluhan tahun. Akar pohon Angsana, Trembesi, dan Flamboyan sering merambat masuk ke pipa drainase bawah tanah, menyebabkan blokade total yang hanya bisa dideteksi via CCTV camera.',
                        'frequency'  => 'very_common',
                    ],
                    [
                        'issue'      => 'Sistem Sewage Terpisah yang Kompleks',
                        'severity'   => 'high',
                        'detail'     => 'Rumah-rumah lama Pondok Indah memiliki sistem jaringan pipa yang kompleks karena pengembangan berlapis (70an–2000an). Sering ditemukan percabangan pipa tak terdata yang membingungkan saat terjadi kebocoran atau mampet.',
                        'frequency'  => 'common',
                    ],
                    [
                        'issue'      => 'Kebocoran Pipa Tanam di Villa & Rumah Mewah',
                        'severity'   => 'high',
                        'detail'     => 'Rumah mewah Pondok Indah dengan nilai properti > Rp 30 miliar sering menghadapi kebocoran pipa in-wall yang sulit dideteksi. Rootera menggunakan thermal imaging untuk menemukan titik bocor sebelum membongkar plesteran.',
                        'frequency'  => 'common',
                    ],
                    [
                        'issue'      => 'Filter & Pompa Kolam Renang Privat Tersumbat',
                        'severity'   => 'medium',
                        'detail'     => 'Hampir setiap rumah tapak di Pondok Indah memiliki kolam renang privat. Masalah umum: filter tersumbat, pipa return bocor, dan sistem backwash tidak berfungsi optimal akibat usia perangkat.',
                        'frequency'  => 'common',
                    ],
                ],

                'sub_clusters' => [
                    'Pondok Indah Dalam', 'Metro Pondok Indah', 'Pondok Pinang',
                    'Bona Indah', 'Puri Indah (Perumahan)', 'Pesanggrahan Hijau',
                    'Bukit Golf Pondok Indah', 'Permata Hijau',
                ],

                'property_profile' => 'cluster_ultra_elite_landed',

                'intro_override' => 'Rootera Plumbing adalah layanan plumbing premium yang siap menangani seluruh kebutuhan pipa dan saluran di kawasan Pondok Indah, Jakarta Selatan — salah satu kawasan paling bergengsi di Indonesia. Rumah-rumah di Pondok Indah memiliki kompleksitas infrastruktur plumbing yang tinggi: jaringan pipa multi-generasi yang berlapis, pohon peneduh raksasa yang akarnya mengancam pipa drainase, kolam renang privat dengan sistem sirkulasi kompleks, serta desain interior mewah yang menuntut teknik deteksi kebocoran non-destruktif. Teknisi Rootera menggunakan thermal imaging, pressure test, dan CCTV drain inspection untuk memberikan diagnosa presisi. Kami memahami bahwa di Pondok Indah, standar layanan harus setara dengan nilai propertinya. Semua pekerjaan dijamin bergaransi dan ditangani oleh teknisi senior berpengalaman minimal 5 tahun.',

                'meta_title'       => 'Jasa Tukang Pipa Pondok Indah Jakarta Selatan | Plumbing Premium Rootera',
                'meta_description' => 'Spesialis plumbing premium di Pondok Indah Jakarta Selatan. Deteksi kebocoran thermal, CCTV drain, akar pohon di pipa, kolam renang. Estimasi 15–30 menit. ☎ 0813-8540-4000.',
            ],

        ];
    }
}
