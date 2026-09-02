<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use Illuminate\Support\Str;

class LampungFullCoverageSeeder extends Seeder
{
    /**
     * Run database seed for all 15 Regencies/Cities and Districts in Lampung Province.
     */
    public function run(): void
    {
        // 1. Ensure Province Lampung exists
        $province = Province::updateOrCreate(
            ['slug' => 'lampung'],
            [
                'name'       => 'Lampung',
                'sort_order' => 7,
                'is_active'  => true,
            ]
        );

        $geoData = [
            [
                'name'              => 'Bandar Lampung',
                'type'              => 'Kota',
                'slug'              => 'bandar-lampung',
                'latitude'          => '-5.4292',
                'longitude'         => '105.2611',
                'whatsapp_number'   => '6281385404000',
                'estimated_arrival' => '25-40 Menit',
                'meta_title'        => 'Jasa Saluran Pipa Mampet Kota Bandar Lampung 24 Jam Bergaransi | Rootera (J&J Group)',
                'meta_description'  => 'Solusi jasa perbaikan pipa mampet, wastafel tersumbat, kran air, & toilet di Kota Bandar Lampung. Pengerjaan cepat tanpa bongkar oleh Rootera Plumbing.',
                'districts'         => [
                    'Bumi Waras', 'Enggal', 'Kedamaian', 'Kedaton', 'Kemiling',
                    'Labuhan Ratu', 'Langkapura', 'Panjang', 'Rajabasa', 'Sukabumi',
                    'Sukarame', 'Tanjung Karang Barat', 'Tanjung Karang Pusat', 'Tanjung Karang Timur', 'Tanjung Senang',
                    'Teluk Betung Barat', 'Teluk Betung Selatan', 'Teluk Betung Timur', 'Teluk Betung Utara', 'Way Halim'
                ]
            ],
            [
                'name'              => 'Metro',
                'type'              => 'Kota',
                'slug'              => 'metro',
                'latitude'          => '-5.1136',
                'longitude'         => '105.3069',
                'whatsapp_number'   => '6281385404000',
                'estimated_arrival' => '25-40 Menit',
                'meta_title'        => 'Jasa Saluran Pipa Mampet Kota Metro 24 Jam Bergaransi | Rootera (J&J Group)',
                'meta_description'  => 'Layanan pelancaran pipa mampet, wastafel tersumbat, & kloset WC di Kota Metro. Pengerjaan tanpa bongkar garansi 30 hari oleh Rootera Plumbing.',
                'districts'         => [
                    'Metro Barat', 'Metro Pusat', 'Metro Selatan', 'Metro Timur', 'Metro Utara'
                ]
            ],
            [
                'name'              => 'Lampung Selatan',
                'type'              => 'Kabupaten',
                'slug'              => 'kabupaten-lampung-selatan',
                'latitude'          => '-5.7122',
                'longitude'         => '105.5878',
                'whatsapp_number'   => '6281385404000',
                'estimated_arrival' => '30-50 Menit',
                'meta_title'        => 'Jasa Saluran Pipa Mampet Kabupaten Lampung Selatan | Rootera',
                'meta_description'  => 'Spesialis jasa pelancar pipa mampet Natar, Jati Agung, Kalianda & Lampung Selatan. Tanpa bongkar garansi tuntas 30 hari.',
                'districts'         => [
                    'Bakauheni', 'Candipuro', 'Jati Agung', 'Kalianda', 'Katibung',
                    'Ketapang', 'Merbau Mataram', 'Natar', 'Palas', 'Penengahan',
                    'Rajabasa (Lamsel)', 'Sidomulyo', 'Sragi', 'Tanjung Bintang', 'Tanjung Sari',
                    'Way Panji', 'Way Sulan'
                ]
            ],
            [
                'name'              => 'Lampung Tengah',
                'type'              => 'Kabupaten',
                'slug'              => 'kabupaten-lampung-tengah',
                'latitude'          => '-4.9540',
                'longitude'         => '105.2285',
                'whatsapp_number'   => '6281385404000',
                'estimated_arrival' => '30-50 Menit',
                'meta_title'        => 'Jasa Saluran Pipa Mampet Kabupaten Lampung Tengah | Rootera',
                'meta_description'  => 'Layanan perbaikan pipa mampet di Terbanggi Besar, Gunung Sugih & Lampung Tengah. Bergaransi resmi 30 hari tanpa bongkar.',
                'districts'         => [
                    'Anak Ratu Aji', 'Anak Tuha', 'Bandar Mataram', 'Bandar Surabaya', 'Bangun Rejo',
                    'Bekri', 'Bumi Nabung', 'Bumi Ratu Nuban', 'Dente Teladas', 'Gunung Sugih',
                    'Kalirejo', 'Kota Gajah', 'Padang Ratu', 'Pubian', 'Punggur',
                    'Putra Rumbia', 'Rumbia', 'Selagai Lingga', 'Sendang Agung', 'Seputih Agung',
                    'Seputih Banyak', 'Seputih Mataram', 'Seputih Raman', 'Seputih Surabaya', 'Terusan Nunyai',
                    'Terbanggi Besar', 'Trimurjo', 'Way Pengubuan', 'Way Seputih'
                ]
            ],
            [
                'name'              => 'Lampung Timur',
                'type'              => 'Kabupaten',
                'slug'              => 'kabupaten-lampung-timur',
                'latitude'          => '-5.1054',
                'longitude'         => '105.6811',
                'whatsapp_number'   => '6281385404000',
                'estimated_arrival' => '30-50 Menit',
                'meta_title'        => 'Jasa Saluran Pipa Mampet Kabupaten Lampung Timur | Rootera',
                'meta_description'  => 'Spesialis pelancar saluran pipa air mampet di Sukadana, Way Jepara & Lampung Timur. Garansi tuntas 100% tanpa bongkar.',
                'districts'         => [
                    'Bandar Sribhawono', 'Batanghari', 'Batanghari Nuban', 'Braja Selebah', 'Bumi Agung',
                    'Gunung Pelindung', 'Jabung', 'Labuhan Maringgai', 'Labuhan Ratu (Lamtim)', 'Marga Sekampung',
                    'Marga Tiga', 'Mataram Baru', 'Melinting', 'Metro Kibang', 'Pasir Sakti',
                    'Pekalongan', 'Purbolinggo', 'Raman Utara', 'Sekampung', 'Sekampung Udik',
                    'Sukadana', 'Waway Karya', 'Way Bungur', 'Way Jepara'
                ]
            ],
            [
                'name'              => 'Lampung Utara',
                'type'              => 'Kabupaten',
                'slug'              => 'kabupaten-lampung-utara',
                'latitude'          => '-4.8145',
                'longitude'         => '104.8872',
                'whatsapp_number'   => '6281385404000',
                'estimated_arrival' => '30-50 Menit',
                'meta_title'        => 'Jasa Saluran Pipa Mampet Kabupaten Lampung Utara | Rootera',
                'meta_description'  => 'Pelancaran pipa tersumbat di Kotabumi & Lampung Utara. Tanpa bongkar lantai, bergaransi 30 hari tuntas baru bayar.',
                'districts'         => [
                    'Abung Barat', 'Abung Kunang', 'Abung Selatan', 'Abung Semuli', 'Abung Surakarta',
                    'Abung Tengah', 'Abung Timur', 'Abung Tinggi', 'Bunga Mayang', 'Bukit Kemuning',
                    'Hulu Sungkai', 'Kotabumi', 'Kotabumi Selatan', 'Kotabumi Utara', 'Muara Sungkai',
                    'Sungkai Barat', 'Sungkai Jaya', 'Sungkai Selatan', 'Sungkai Tengah', 'Sungkai Utara',
                    'Tanjung Raja', 'Abung Pekurun', 'Blambangan Pagar'
                ]
            ],
            [
                'name'              => 'Tanggamus',
                'type'              => 'Kabupaten',
                'slug'              => 'kabupaten-tanggamus',
                'latitude'          => '-5.4855',
                'longitude'         => '104.6223',
                'whatsapp_number'   => '6281385404000',
                'estimated_arrival' => '30-50 Menit',
                'meta_title'        => 'Jasa Saluran Pipa Mampet Kabupaten Tanggamus | Rootera',
                'meta_description'  => 'Layanan pelancaran wastafel, floor drain, & pipa mampet di Kota Agung, Gisting & Tanggamus. Bergaransi tanpa bongkar.',
                'districts'         => [
                    'Air Naningan', 'Bandar Negeri Semuong', 'Bulok', 'Cukuh Balak', 'Gisting',
                    'Gunung Alip', 'Klumbayan', 'Klumbayan Barat', 'Kota Agung', 'Kota Agung Barat',
                    'Kota Agung Timur', 'Limau', 'Pematang Sawa', 'Pugung', 'Pulau Panggung',
                    'Semaka', 'Sumberejo', 'Talang Padang', 'Ulu Belu', 'Wonosobo'
                ]
            ],
            [
                'name'              => 'Pesawaran',
                'type'              => 'Kabupaten',
                'slug'              => 'kabupaten-pesawaran',
                'latitude'          => '-5.4287',
                'longitude'         => '105.1764',
                'whatsapp_number'   => '6281385404000',
                'estimated_arrival' => '30-50 Menit',
                'meta_title'        => 'Jasa Saluran Pipa Mampet Kabupaten Pesawaran | Rootera',
                'meta_description'  => 'Jasa pelancaran pipa tersumbat Gedong Tataan, Tegineneng & Pesawaran. Tanpa bongkar garansi 30 hari.',
                'districts'         => [
                    'Gedong Tataan', 'Kedondong', 'Negeri Katon', 'Padang Cermin', 'Punduh Pidada',
                    'Tegineneng', 'Teluk Pandan', 'Way Lima', 'Way Ratai', 'Way Khilau', 'Marga Punduh'
                ]
            ],
            [
                'name'              => 'Pringsewu',
                'type'              => 'Kabupaten',
                'slug'              => 'kabupaten-pringsewu',
                'latitude'          => '-5.3587',
                'longitude'         => '104.9744',
                'whatsapp_number'   => '6281385404000',
                'estimated_arrival' => '30-50 Menit',
                'meta_title'        => 'Jasa Saluran Pipa Mampet Kabupaten Pringsewu | Rootera',
                'meta_description'  => 'Solusi perbaikan pipa air & saluran mampet Pringsewu, Gadingrejo & sekitarnya. Garansi tuntas baru bayar.',
                'districts'         => [
                    'Adiluwih', 'Ambarawa', 'Banyumas', 'Gading Rejo', 'Pagelaran',
                    'Pagelaran Utara', 'Pardasuka', 'Pringsewu', 'Sukoharjo'
                ]
            ],
            [
                'name'              => 'Lampung Barat',
                'type'              => 'Kabupaten',
                'slug'              => 'kabupaten-lampung-barat',
                'latitude'          => '-5.1486',
                'longitude'         => '104.1923',
                'whatsapp_number'   => '6281385404000',
                'estimated_arrival' => '30-50 Menit',
                'meta_title'        => 'Jasa Saluran Pipa Mampet Kabupaten Lampung Barat | Rootera',
                'meta_description'  => 'Layanan pelancaran pipa tersumbat di Liwa, Balik Bukit & Lampung Barat. Bergaransi tanpa bongkar keramik.',
                'districts'         => [
                    'Air Hitam', 'Balik Bukit', 'Bandar Negeri Suoh', 'Batu Brak', 'Batu Ketulis',
                    'Belalau', 'Gedung Surian', 'Kebun Tebu', 'Lumbok Seminung', 'Pagar Dewa',
                    'Sekincau', 'Sukau', 'Sumber Jaya', 'Suoh', 'Way Tenong'
                ]
            ],
            [
                'name'              => 'Pesisir Barat',
                'type'              => 'Kabupaten',
                'slug'              => 'kabupaten-pesisir-barat',
                'latitude'          => '-5.1931',
                'longitude'         => '103.9388',
                'whatsapp_number'   => '6281385404000',
                'estimated_arrival' => '30-50 Menit',
                'meta_title'        => 'Jasa Saluran Pipa Mampet Kabupaten Pesisir Barat | Rootera',
                'meta_description'  => 'Pelancaran pipa mampet Krui & Pesisir Barat. Respon cepat tanpa bongkar keramik, bergaransi 30 hari.',
                'districts'         => [
                    'Bangkunat', 'Karya Penggawa', 'Krui Selatan', 'Lemong', 'Ngambur',
                    'Ngaras', 'Pesisir Selatan', 'Pesisir Tengah', 'Pesisir Utara', 'Pulau Pisang', 'Way Krui'
                ]
            ],
            [
                'name'              => 'Way Kanan',
                'type'              => 'Kabupaten',
                'slug'              => 'kabupaten-way-kanan',
                'latitude'          => '-4.5126',
                'longitude'         => '104.5298',
                'whatsapp_number'   => '6281385404000',
                'estimated_arrival' => '30-50 Menit',
                'meta_title'        => 'Jasa Saluran Pipa Mampet Kabupaten Way Kanan | Rootera',
                'meta_description'  => 'Jasa pelancar pipa mampet Blambangan Umpu, Baradatu & Way Kanan. Garansi tuntas 100% tanpa bongkar.',
                'districts'         => [
                    'Bahuga', 'Banjit', 'Baradatu', 'Blambangan Umpu', 'Buay Bahuga',
                    'Bumi Agung (WK)', 'Gunung Labuhan', 'Kasui', 'Negeri Agung', 'Negeri Besar',
                    'Pakuan Ratu', 'Rebang Tangkas', 'Umpu Semenguk', 'Way Tuba', 'Bumi Ramah'
                ]
            ],
            [
                'name'              => 'Tulang Bawang',
                'type'              => 'Kabupaten',
                'slug'              => 'kabupaten-tulang-bawang',
                'latitude'          => '-4.5422',
                'longitude'         => '105.2443',
                'whatsapp_number'   => '6281385404000',
                'estimated_arrival' => '30-50 Menit',
                'meta_title'        => 'Jasa Saluran Pipa Mampet Kabupaten Tulang Bawang | Rootera',
                'meta_description'  => 'Pelancaran pipa mampet Menggala, Banjar Agung & Tulang Bawang. Tanpa bongkar garansi 30 hari.',
                'districts'         => [
                    'Banjar Agung', 'Banjar Margo', 'Banjar Baru', 'Dente Teladas', 'Gedung Aji',
                    'Gedung Aji Baru', 'Gedung Meneng', 'Menggala', 'Menggala Timur', 'Merak Isa',
                    'Penawar Aji', 'Penawartama', 'Rawa Pitu', 'Rawajitu Selatan', 'Rawajitu Timur'
                ]
            ],
            [
                'name'              => 'Tulang Bawang Barat',
                'type'              => 'Kabupaten',
                'slug'              => 'kabupaten-tulang-bawang-barat',
                'latitude'          => '-4.4361',
                'longitude'         => '105.0441',
                'whatsapp_number'   => '6281385404000',
                'estimated_arrival' => '30-50 Menit',
                'meta_title'        => 'Jasa Saluran Pipa Mampet Kabupaten Tulang Bawang Barat | Rootera',
                'meta_description'  => 'Jasa pelancaran pipa tersumbat Tumijajar, Tulang Bawang Tengah & Tubaba. Tanpa bongkar bergaransi.',
                'districts'         => [
                    'Batu Putih', 'Gunung Agung', 'Gunung Terang', 'Lambu Kibang', 'Pagar Dewa (Tubaba)',
                    'Tulang Bawang Tengah', 'Tulang Bawang Udik', 'Tumijajar', 'Way Kenanga'
                ]
            ],
            [
                'name'              => 'Mesuji',
                'type'              => 'Kabupaten',
                'slug'              => 'kabupaten-mesuji',
                'latitude'          => '-4.0416',
                'longitude'         => '105.4116',
                'whatsapp_number'   => '6281385404000',
                'estimated_arrival' => '30-50 Menit',
                'meta_title'        => 'Jasa Saluran Pipa Mampet Kabupaten Mesuji | Rootera',
                'meta_description'  => 'Pelancaran pipa mampet Simpang Pematang & Kabupaten Mesuji. Garansi tuntas 30 hari tanpa bongkar.',
                'districts'         => [
                    'Mesuji', 'Mesuji Timur', 'Panca Jaya', 'Rawa Jitu Utara', 'Simpang Pematang',
                    'Tanjung Raya', 'Way Serdang'
                ]
            ],
        ];

        foreach ($geoData as $cIdx => $cItem) {
            $city = City::updateOrCreate(
                ['slug' => $cItem['slug']],
                [
                    'province_id'       => $province->id,
                    'name'              => $cItem['name'],
                    'type'              => $cItem['type'],
                    'whatsapp_number'   => $cItem['whatsapp_number'],
                    'estimated_arrival' => $cItem['estimated_arrival'],
                    'latitude'          => $cItem['latitude'],
                    'longitude'         => $cItem['longitude'],
                    'meta_title'        => $cItem['meta_title'],
                    'meta_description'  => $cItem['meta_description'],
                    'sort_order'        => $cIdx + 1,
                    'is_active'          => true,
                ]
            );

            foreach ($cItem['districts'] as $dIdx => $distName) {
                $distSlug = Str::slug($distName);
                District::updateOrCreate(
                    [
                        'city_id' => $city->id,
                        'slug'    => $distSlug,
                    ],
                    [
                        'name'              => $distName,
                        'estimated_arrival' => '20-35 Menit',
                        'meta_title'        => "Jasa Saluran Pipa Mampet {$distName}, {$city->name} | Rootera",
                        'meta_description'  => "Layanan pelancaran pipa mampet di {$distName}, {$city->full_name}. Respon cepat 24 jam bergaransi resmi tanpa bongkar.",
                        'sort_order'        => $dIdx + 1,
                        'is_active'         => true,
                    ]
                );
            }
        }
    }
}
