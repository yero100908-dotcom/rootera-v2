<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use Illuminate\Support\Str;

class GeoDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Delete legacy combined province if present
        $legacy = Province::where('name', 'Jawa Tengah & DIY')->first();
        if ($legacy) {
            City::where('province_id', $legacy->id)->delete();
            $legacy->delete();
        }

        $geoData = [
            [
                'province' => 'DKI Jakarta',
                'cities' => [
                    [
                        'name' => 'Jakarta Selatan',
                        'type' => 'Kota',
                        'districts' => [
                            'Kebayoran Baru', 'Kebayoran Lama', 'Pancoran', 'Cilandak', 'Pasar Minggu',
                            'Jagakarsa', 'Mampang Prapatan', 'Tebet', 'Setiabudi', 'Pesanggrahan',
                            'Kemang', 'Pondok Indah', 'Gandaria', 'Cipete'
                        ]
                    ],
                    [
                        'name' => 'Jakarta Timur',
                        'type' => 'Kota',
                        'districts' => [
                            'Matraman', 'Pulo Gadung', 'Jatinegara', 'Duren Sawit', 'Kramat Jati',
                            'Makasar', 'Ciracas', 'Cipayung', 'Cakung', 'Pasar Rebo', 'Cibubur', 'Cijantung'
                        ]
                    ],
                    [
                        'name' => 'Jakarta Barat',
                        'type' => 'Kota',
                        'districts' => [
                            'Cengkareng', 'Grogol Petamburan', 'Taman Sari', 'Tambora', 'Kebon Jeruk',
                            'Kalideres', 'Palmerah', 'Kembangan', 'Puri Indah', 'Meruya', 'Cengkareng Barat'
                        ]
                    ],
                    [
                        'name' => 'Jakarta Pusat',
                        'type' => 'Kota',
                        'districts' => [
                            'Gambir', 'Tanah Abang', 'Menteng', 'Senen', 'Cempaka Putih',
                            'Johar Baru', 'Kemayoran', 'Sawah Besar', 'Cikini', 'Sudirman'
                        ]
                    ],
                    [
                        'name' => 'Jakarta Utara',
                        'type' => 'Kota',
                        'districts' => [
                            'Penjaringan', 'Tanjung Priok', 'Koja', 'Cilincing', 'Pademangan',
                            'Kelapa Gading', 'Pantai Indah Kapuk (PIK)', 'Pluit', 'Sunter'
                        ]
                    ]
                ]
            ],
            [
                'province' => 'Banten',
                'cities' => [
                    [
                        'name' => 'Cilegon',
                        'type' => 'Kota',
                        'districts' => [
                            'Cibeber', 'Cilegon', 'Citangkil', 'Ciwandan', 'Gerogol', 'Jombang',
                            'Pulomerak', 'Purwakarta (Kawasan Pelabuhan Merak & Krakatau)'
                        ]
                    ],
                    [
                        'name' => 'Serang',
                        'type' => 'Kota',
                        'districts' => ['Cipocok Jaya', 'Curug', 'Kasemen', 'Serang', 'Taktakan', 'Walantaka']
                    ],
                    [
                        'name' => 'Serang',
                        'type' => 'Kabupaten',
                        'districts' => [
                            'Cikande (Kawasan Modern Cikande)', 'Jawilan', 'Kragilan', 'Kibin', 'Ciruas',
                            'Kramatwatu', 'Bojonegara', 'Anyar', 'Cinangka', 'Baros', 'Pamarayan'
                        ]
                    ],
                    [
                        'name' => 'Tangerang',
                        'type' => 'Kota',
                        'districts' => [
                            'Batuceper', 'Benda', 'Cibodas', 'Ciledug', 'Cipondoh', 'Jatiuwung',
                            'Karangtengah', 'Karawaci', 'Larangan', 'Neglasari', 'Periuk', 'Pinang', 'Tangerang'
                        ]
                    ],
                    [
                        'name' => 'Tangerang Selatan',
                        'type' => 'Kota',
                        'districts' => [
                            'Serpong (BSD City)', 'Serpong Utara (Alam Sutera)', 'Pondok Aren (Bintaro Jaya)',
                            'Ciputat', 'Ciputat Timur', 'Pamulang', 'Setu'
                        ]
                    ],
                    [
                        'name' => 'Tangerang',
                        'type' => 'Kabupaten',
                        'districts' => [
                            'Balaraja', 'Cikupa (Citra Raya Boulevard)', 'Curug', 'Pasar Kemis',
                            'Kelapa Dua (Gading Serpong)', 'Legok', 'Tigaraksa', 'Panongan',
                            'Teluknaga', 'Kosambi (Kawasan PIK 2 Banten)', 'Sepatan', 'Rajeg'
                        ]
                    ],
                    [
                        'name' => 'Lebak',
                        'type' => 'Kabupaten',
                        'districts' => ['Rangkasbitung', 'Cibadak']
                    ],
                    [
                        'name' => 'Pandeglang',
                        'type' => 'Kabupaten',
                        'districts' => ['Pandeglang Kota', 'Majasari', 'Labuan']
                    ]
                ]
            ],
            [
                'province' => 'Jawa Barat',
                'cities' => [
                    [
                        'name' => 'Bandung',
                        'type' => 'Kota',
                        'districts' => [
                            'Andir', 'Antapani', 'Arcamanik', 'Astanaanyar', 'Babakan Ciparay',
                            'Bandung Kidul', 'Bandung Kulon', 'Bandung Wetan', 'Batununggal',
                            'Bojongloa Kaler', 'Bojongloa Kidul', 'Buahbatu', 'Cibeunying Kaler',
                            'Cibeunying Kidul', 'Cibiru', 'Cicendo', 'Cidadap', 'Cinambo',
                            'Coblong (Dago)', 'Gedebage', 'Kiaracondong', 'Lengkong', 'Mandalajati',
                            'Panyileukan', 'Rancasari', 'Regol', 'Sukajadi (PVJ/Setiabudi)',
                            'Sukasari', 'Sumur Bandung', 'Ujungberung'
                        ]
                    ],
                    [
                        'name' => 'Cimahi',
                        'type' => 'Kota',
                        'districts' => ['Cimahi Selatan', 'Cimahi Tengah', 'Cimahi Utara']
                    ],
                    [
                        'name' => 'Bandung Barat',
                        'type' => 'Kabupaten',
                        'districts' => ['Lembang', 'Padalarang (Kota Baru Parahyangan)', 'Parongpong', 'Ngamprah']
                    ],
                    [
                        'name' => 'Bandung',
                        'type' => 'Kabupaten',
                        'districts' => ['Soreang', 'Dayeuhkolot', 'Bojongsoang (Telkom Area)', 'Baleendah', 'Banjaran', 'Cileunyi', 'Rancaekek']
                    ],
                    [
                        'name' => 'Bogor',
                        'type' => 'Kota',
                        'districts' => ['Bogor Barat', 'Bogor Selatan', 'Bogor Tengah', 'Bogor Timur', 'Bogor Utara', 'Tanah Sareal', 'Pajajaran', 'Baranangsiang']
                    ],
                    [
                        'name' => 'Bogor',
                        'type' => 'Kabupaten',
                        'districts' => [
                            'Cibinong', 'Sentul City (Babakan Madang)', 'Bojonggede', 'Cileungsi',
                            'Gunung Putri', 'Klapanunggal', 'Citeureup', 'Sukaraja', 'Parung',
                            'Kemang', 'Dramaga', 'Ciampea', 'Cisarua (Puncak)', 'Megamendung', 'Gadog'
                        ]
                    ],
                    [
                        'name' => 'Depok',
                        'type' => 'Kota',
                        'districts' => [
                            'Beji', 'Bojongsari', 'Cilodong', 'Cimanggis', 'Cinere', 'Cipayung',
                            'Limo', 'Pancoran Mas', 'Sawangan', 'Sukmajaya', 'Tapos (Margonda & GDC)'
                        ]
                    ],
                    [
                        'name' => 'Bekasi',
                        'type' => 'Kota',
                        'districts' => [
                            'Bantar Gebang', 'Bekasi Barat', 'Bekasi Selatan', 'Bekasi Timur',
                            'Bekasi Utara', 'Jatiasih', 'Jatisampurna', 'Medan Satria',
                            'Mustika Jaya', 'Pondok Gede', 'Pondok Melati', 'Rawalumbu (Grand Galaxy, Jatiwaringin, Jatiwarna, Summarecon)'
                        ]
                    ],
                    [
                        'name' => 'Bekasi',
                        'type' => 'Kabupaten',
                        'districts' => [
                            'Cikarang Pusat', 'Cikarang Barat', 'Cikarang Timur', 'Cikarang Utara',
                            'Cikarang Selatan (Kawasan MM2100, Jababeka, EJIP, Delta Silicon)',
                            'Tambun Selatan', 'Tambun Utara', 'Cibitung', 'Setu', 'Serang Baru'
                        ]
                    ],
                    [
                        'name' => 'Cirebon',
                        'type' => 'Kota',
                        'districts' => ['Kejaksan', 'Kesambi', 'Lemahwungkuk', 'Harjamukti', 'Pekalipan']
                    ],
                    [
                        'name' => 'Cirebon',
                        'type' => 'Kabupaten',
                        'districts' => ['Kedawung', 'Sumber', 'Weru', 'Plumbon', 'Palimanan']
                    ],
                    [
                        'name' => 'Karawang',
                        'type' => 'Kabupaten',
                        'districts' => ['Karawang Barat', 'Karawang Timur', 'Telukjambe Timur (KIIC)', 'Telukjambe Barat', 'Klari', 'Cikampek']
                    ],
                    [
                        'name' => 'Purwakarta',
                        'type' => 'Kabupaten',
                        'districts' => ['Purwakarta Kota', 'Jatiluhur', 'Campaka']
                    ],
                    [
                        'name' => 'Sukabumi',
                        'type' => 'Kota',
                        'districts' => ['Cikole', 'Citamiang', 'Gunungpuyuh', 'Warudoyong']
                    ],
                    [
                        'name' => 'Sukabumi',
                        'type' => 'Kabupaten',
                        'districts' => ['Cibadak', 'Cisaat', 'Cicurug']
                    ],
                    [
                        'name' => 'Cianjur',
                        'type' => 'Kabupaten',
                        'districts' => ['Cianjur Kota', 'Cipanas']
                    ]
                ]
            ],
            [
                'province' => 'Jawa Tengah',
                'cities' => [
                    [
                        'name' => 'Semarang',
                        'type' => 'Kota',
                        'districts' => [
                            'Banyumanik', 'Candisari', 'Gajahmungkur', 'Gayamsari', 'Genuk', 'Gunungpati',
                            'Mijen', 'Ngaliyan', 'Pedurungan', 'Semarang Barat', 'Semarang Selatan',
                            'Semarang Tengah', 'Semarang Timur', 'Semarang Utara', 'Tembalang', 'Tugu'
                        ]
                    ],
                    [
                        'name' => 'Surakarta',
                        'type' => 'Kota',
                        'districts' => ['Banjarsari', 'Jebres', 'Laweyan', 'Pasar Kliwon', 'Serengan', 'Solo Baru']
                    ],
                    [
                        'name' => 'Sukoharjo',
                        'type' => 'Kabupaten',
                        'districts' => ['Kartasura', 'Grogol', 'Sukoharjo Kota', 'Mojolaban']
                    ],
                    [
                        'name' => 'Karanganyar',
                        'type' => 'Kabupaten',
                        'districts' => ['Colomadu', 'Karanganyar Kota', 'Jaten', 'Palur']
                    ],
                    [
                        'name' => 'Magelang',
                        'type' => 'Kota',
                        'districts' => ['Magelang Utara', 'Magelang Tengah', 'Magelang Selatan']
                    ],
                    [
                        'name' => 'Magelang',
                        'type' => 'Kabupaten',
                        'districts' => ['Mertoyudan', 'Borobudur', 'Mungkid', 'Secang']
                    ],
                    [
                        'name' => 'Salatiga',
                        'type' => 'Kota',
                        'districts' => ['Sidomukti', 'Sidorejo', 'Tingkir', 'Argomulyo']
                    ],
                    [
                        'name' => 'Pekalongan',
                        'type' => 'Kota',
                        'districts' => ['Pekalongan Barat', 'Pekalongan Timur', 'Pekalongan Utara', 'Pekalongan Selatan']
                    ],
                    [
                        'name' => 'Pekalongan',
                        'type' => 'Kabupaten',
                        'districts' => ['Kedungwuni', 'Wiradesa', 'Kajen']
                    ],
                    [
                        'name' => 'Tegal',
                        'type' => 'Kota',
                        'districts' => ['Tegal Barat', 'Tegal Timur', 'Tegal Selatan', 'Margadana']
                    ],
                    [
                        'name' => 'Tegal',
                        'type' => 'Kabupaten',
                        'districts' => ['Slawi', 'Adiwerna', 'Kramat']
                    ],
                    [
                        'name' => 'Kudus',
                        'type' => 'Kabupaten',
                        'districts' => ['Kota Kudus', 'Jati', 'Bae', 'Gebog']
                    ],
                    [
                        'name' => 'Jepara',
                        'type' => 'Kabupaten',
                        'districts' => ['Jepara Kota', 'Tahunan', 'Batealit']
                    ],
                    [
                        'name' => 'Pati',
                        'type' => 'Kabupaten',
                        'districts' => ['Pati Kota', 'Juwana', 'Margorejo']
                    ],
                    [
                        'name' => 'Banyumas',
                        'type' => 'Kabupaten',
                        'districts' => ['Purwokerto Barat', 'Purwokerto Timur', 'Purwokerto Utara', 'Purwokerto Selatan', 'Sokaraja', 'Baturraden']
                    ],
                    [
                        'name' => 'Cilacap',
                        'type' => 'Kabupaten',
                        'districts' => ['Cilacap Selatan', 'Cilacap Tengah', 'Cilacap Utara', 'Majenang']
                    ]
                ]
            ],
            [
                'province' => 'D.I. Yogyakarta',
                'slug' => 'di-yogyakarta',
                'cities' => [
                    [
                        'name' => 'Yogyakarta',
                        'type' => 'Kota',
                        'districts' => [
                            'Kraton', 'Gondomanan', 'Danurejan', 'Gedongtengen', 'Gondokusuman',
                            'Jetis', 'Kotagede', 'Mantrijeron', 'Mergangsan', 'Ngampilan',
                            'Pakualaman', 'Tegalrejo', 'Umbulharjo', 'Wirobrajan', 'Malioboro'
                        ]
                    ],
                    [
                        'name' => 'Sleman',
                        'type' => 'Kabupaten',
                        'districts' => ['Depok', 'Gejayan', 'Seturan', 'Babarsari', 'Mlati', 'Ngaglik', 'Kaliurang', 'Palagan', 'Gamping', 'Godean', 'Kalasan', 'Berbah', 'Prambanan']
                    ],
                    [
                        'name' => 'Bantul',
                        'type' => 'Kabupaten',
                        'districts' => ['Banguntapan', 'Sewon', 'Kasihan', 'Bantul Kota', 'Piyungan', 'Sedayu']
                    ],
                    [
                        'name' => 'Kulon Progo',
                        'type' => 'Kabupaten',
                        'districts' => ['Wates', 'Sentolo', 'Pengasih']
                    ],
                    [
                        'name' => 'Gunungkidul',
                        'type' => 'Kabupaten',
                        'districts' => ['Wonosari', 'Semenyu']
                    ]
                ]
            ],
            [
                'province' => 'Jawa Timur',
                'cities' => [
                    [
                        'name' => 'Surabaya',
                        'type' => 'Kota',
                        'districts' => ['Tegalsari', 'Simokerto', 'Genteng', 'Bubutan', 'Gubeng', 'Wonokromo', 'Sukolilo', 'Rungkut', 'Wiyung']
                    ],
                    [
                        'name' => 'Sidoarjo',
                        'type' => 'Kabupaten',
                        'districts' => ['Sidoarjo Kota', 'Candi', 'Waru', 'Taman', 'Krian']
                    ],
                    [
                        'name' => 'Malang',
                        'type' => 'Kota',
                        'districts' => ['Klojen', 'Blimbing', 'Lowokwaru', 'Kedungkandang', 'Sukun']
                    ]
                ]
            ],
            [
                'province' => 'Lampung',
                'cities' => [
                    [
                        'name' => 'Bandar Lampung',
                        'type' => 'Kota',
                        'districts' => ['Kedaton', 'Rajabasa', 'Tanjung Karang', 'Teluk Betung', 'Sukabumi', 'Kemiling', 'Way Halim']
                    ]
                ]
            ]
        ];

        foreach ($geoData as $pIdx => $provItem) {
            $provSlug = $provItem['slug'] ?? Str::slug($provItem['province']);
            $province = Province::updateOrCreate(
                ['slug' => $provSlug],
                [
                    'name' => $provItem['province'],
                    'sort_order' => $pIdx + 1,
                    'is_active' => true
                ]
            );

            foreach ($provItem['cities'] as $cIdx => $cityItem) {
                $slugBase = $cityItem['name'];
                if (strtolower($cityItem['type']) === 'kabupaten') {
                    $slugBase = 'kabupaten-' . $cityItem['name'];
                }

                $city = City::updateOrCreate(
                    ['slug' => Str::slug($slugBase)],
                    [
                        'province_id' => $province->id,
                        'name' => $cityItem['name'],
                        'type' => $cityItem['type'],
                        'whatsapp_number' => '6281385404000',
                        'estimated_arrival' => '25-40 Menit',
                        'sort_order' => $cIdx + 1,
                        'is_active' => true
                    ]
                );

                foreach ($cityItem['districts'] as $dIdx => $districtName) {
                    District::updateOrCreate(
                        [
                            'city_id' => $city->id,
                            'slug' => Str::slug($districtName)
                        ],
                        [
                            'name' => $districtName,
                            'estimated_arrival' => '15-30 Menit',
                            'sort_order' => $dIdx + 1,
                            'is_active' => true
                        ]
                    );
                }
            }
        }
    }
}
