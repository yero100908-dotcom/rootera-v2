<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Models\City;
use App\Models\District;

return new class extends Migration
{
    public function up(): void
    {
        // 1. ADD NEW CITIES IN LAMPUNG (PROVINCE_ID: 7)
        $metroCity = City::firstOrCreate(
            ['slug' => 'metro'],
            [
                'province_id' => 7,
                'name' => 'Metro',
                'type' => 'Kota',
                'phone_number' => '0813-8540-4000',
                'whatsapp_number' => '6281385404000',
                'estimated_arrival' => '25-45 Menit',
                'meta_title' => 'Jasa Saluran Mampet Kota Metro | Pelancar Pipa Ridgid 24 Jam',
                'meta_description' => 'Jasa pelancaran pipa mampet di Kota Metro. Tanpa bongkar keramik, garansi 30 hari tuntas baru bayar.',
                'is_active' => true,
                'sort_order' => 10,
            ]
        );

        $lampungSelatanKab = City::firstOrCreate(
            ['slug' => 'kabupaten-lampung-selatan'],
            [
                'province_id' => 7,
                'name' => 'Lampung Selatan',
                'type' => 'Kabupaten',
                'phone_number' => '0813-8540-4000',
                'whatsapp_number' => '6281385404000',
                'estimated_arrival' => '30-50 Menit',
                'meta_title' => 'Jasa Saluran Mampet Kabupaten Lampung Selatan | Pelancar Pipa 24 Jam',
                'meta_description' => 'Jasa pelancaran saluran pipa mampet di Natar, Jati Agung & Lampung Selatan. Garansi 30 hari tanpa bongkar.',
                'is_active' => true,
                'sort_order' => 11,
            ]
        );

        // Fetch City IDs
        $jakut = City::where('slug', 'jakarta-utara')->first();
        $jaksel = City::where('slug', 'jakarta-selatan')->first();
        $kotaBekasi = City::where('slug', 'bekasi')->first();
        $kabBekasi = City::where('slug', 'kabupaten-bekasi')->first();
        $kabBogor = City::where('slug', 'kabupaten-bogor')->first();
        $kotaDepok = City::where('slug', 'depok')->first();
        $kotaSemarang = City::where('slug', 'semarang')->first();
        $bandarLampung = City::where('slug', 'bandar-lampung')->first();

        // 2. NEW HOTSPOTS & DISTRICTS DATA
        $districtsData = [];

        // A. DKI Jakarta
        if ($jakut) {
            $districtsData[] = [
                'city_id' => $jakut->id,
                'name' => 'Pantai Indah Kapuk (PIK)',
                'slug' => 'pantai-indah-kapuk-pik',
                'estimated_arrival' => '20-30 Menit',
                'meta_title' => 'Jasa Saluran Mampet Pantai Indah Kapuk (PIK) | Pelancar Pipa 24 Jam',
                'meta_description' => 'Layanan pelancaran pipa mampet ruko, perumahan & kuliner PIK. Tanpa bongkar garansi 30 hari.',
                'is_active' => true,
                'sort_order' => 1,
            ];
        }

        if ($jaksel) {
            $districtsData[] = [
                'city_id' => $jaksel->id,
                'name' => 'Senopati - SCBD',
                'slug' => 'senopati-scbd',
                'estimated_arrival' => '15-25 Menit',
                'meta_title' => 'Jasa Saluran Mampet Senopati SCBD | Pelancar Pipa Komersial 24 Jam',
                'meta_description' => 'Layanan pelancaran saluran mampet resto, kantor & ruko Senopati SCBD. Garansi 30 hari tuntas.',
                'is_active' => true,
                'sort_order' => 1,
            ];
            $districtsData[] = [
                'city_id' => $jaksel->id,
                'name' => 'Kemang Raya',
                'slug' => 'kemang-raya',
                'estimated_arrival' => '15-25 Menit',
                'meta_title' => 'Jasa Saluran Mampet Kemang Raya | Pelancar Pipa Modern 24 Jam',
                'meta_description' => 'Pelancaran pipa mampet restoran & hunian Kemang. Garansi 30 hari tanpa bongkar keramik.',
                'is_active' => true,
                'sort_order' => 2,
            ];
        }

        // B. Bekasi
        if ($kotaBekasi) {
            $districtsData[] = [
                'city_id' => $kotaBekasi->id,
                'name' => 'Harapan Indah',
                'slug' => 'harapan-indah',
                'estimated_arrival' => '20-35 Menit',
                'meta_title' => 'Jasa Saluran Mampet Harapan Indah Bekasi | Pelancar Pipa 24 Jam',
                'meta_description' => 'Layanan pelancaran wastafel, kran & kloset mampet Kota Harapan Indah Bekasi. Garansi 30 hari.',
                'is_active' => true,
                'sort_order' => 1,
            ];
            $districtsData[] = [
                'city_id' => $kotaBekasi->id,
                'name' => 'Summarecon Bekasi',
                'slug' => 'summarecon-bekasi',
                'estimated_arrival' => '20-30 Menit',
                'meta_title' => 'Jasa Saluran Mampet Summarecon Bekasi | Pelancar Pipa Ridgid 24 Jam',
                'meta_description' => 'Pelancaran saluran mampet perumahan & ruko Summarecon Bekasi. Tanpa bongkar garansi 30 hari.',
                'is_active' => true,
                'sort_order' => 2,
            ];
        }

        if ($kabBekasi) {
            $districtsData[] = [
                'city_id' => $kabBekasi->id,
                'name' => 'Lippo Cikarang',
                'slug' => 'lippo-cikarang',
                'estimated_arrival' => '25-40 Menit',
                'meta_title' => 'Jasa Saluran Mampet Lippo Cikarang | Hydro Jetting & Rooter 24 Jam',
                'meta_description' => 'Pelancaran pipa mampet pabrik, ruko & perumahan Lippo Cikarang. Garansi 30 hari tanpa bongkar.',
                'is_active' => true,
                'sort_order' => 1,
            ];
            $districtsData[] = [
                'city_id' => $kabBekasi->id,
                'name' => 'Jababeka Cikarang',
                'slug' => 'jababeka-cikarang',
                'estimated_arrival' => '25-40 Menit',
                'meta_title' => 'Jasa Saluran Mampet Jababeka Cikarang | Pelancar Pipa Industri 24 Jam',
                'meta_description' => 'Layanan pelancaran pipa mampet kawasan industri & perumahan Jababeka. Tuntas baru bayar.',
                'is_active' => true,
                'sort_order' => 2,
            ];
        }

        // C. Bogor
        if ($kabBogor) {
            $districtsData[] = [
                'city_id' => $kabBogor->id,
                'name' => 'Cibubur - Transyogi (Bogor)',
                'slug' => 'cibubur-transyogi',
                'estimated_arrival' => '20-35 Menit',
                'meta_title' => 'Jasa Saluran Mampet Cibubur Transyogi | Pelancar Pipa 24 Jam',
                'meta_description' => 'Pelancaran pipa mampet kawasan Cibubur Transyogi. Garansi 30 hari tanpa bongkar keramik.',
                'is_active' => true,
                'sort_order' => 1,
            ];
            $districtsData[] = [
                'city_id' => $kabBogor->id,
                'name' => 'Kota Wisata Cibubur',
                'slug' => 'kota-wisata-cibubur',
                'estimated_arrival' => '20-35 Menit',
                'meta_title' => 'Jasa Saluran Mampet Kota Wisata Cibubur | Pelancar Pipa 24 Jam',
                'meta_description' => 'Pelancaran pipa mampet perumahan Kota Wisata & Legend Wisata. Tuntas garansi 30 hari.',
                'is_active' => true,
                'sort_order' => 2,
            ];
        }

        // D. Depok
        if ($kotaDepok) {
            $districtsData[] = [
                'city_id' => $kotaDepok->id,
                'name' => 'Margonda Raya',
                'slug' => 'margonda-raya',
                'estimated_arrival' => '15-25 Menit',
                'meta_title' => 'Jasa Saluran Mampet Margonda Depok | Pelancar Pipa 24 Jam',
                'meta_description' => 'Pelancaran pipa mampet ruko, apartemen & kos Margonda Depok. Garansi 30 hari tanpa bongkar.',
                'is_active' => true,
                'sort_order' => 1,
            ];
            $districtsData[] = [
                'city_id' => $kotaDepok->id,
                'name' => 'Cinere - Gandul',
                'slug' => 'cinere-gandul',
                'estimated_arrival' => '15-25 Menit',
                'meta_title' => 'Jasa Saluran Mampet Cinere Gandul Depok | Pelancar Pipa 24 Jam',
                'meta_description' => 'Pelancaran Washtafel, floor drain & kloset mampet Cinere Gandul. Garansi 30 hari tuntas.',
                'is_active' => true,
                'sort_order' => 2,
            ];
        }

        // E. Semarang (Jawa Tengah)
        if ($kotaSemarang) {
            $semarangDistricts = [
                ['name' => 'Ngaliyan', 'slug' => 'ngaliyan', 'desc' => 'Kawasan Industri Candi & Perumahan Ngaliyan'],
                ['name' => 'Tugu', 'slug' => 'tugu', 'desc' => 'Kawasan Industri Wijayakusuma & Jatijajar Tugu'],
                ['name' => 'Pedurungan', 'slug' => 'pedurungan', 'desc' => 'Area Residensial Padat Pedurungan & Majapahit'],
                ['name' => 'Gunungpati', 'slug' => 'gunungpati', 'desc' => 'Area Kampus Unnes & Sekaran Gunungpati'],
                ['name' => 'Genuk', 'slug' => 'genuk', 'desc' => 'Kawasan Industri Terboyo & Kaligawe Genuk'],
                ['name' => 'Tembalang', 'slug' => 'tembalang', 'desc' => 'Hotspot Komersial & Kampus Undip Tembalang'],
                ['name' => 'BSB City Mijen', 'slug' => 'bsb-city-mijen', 'desc' => 'Kawasan Mandiri BSB City Mijen Semarang'],
            ];

            foreach ($semarangDistricts as $idx => $sd) {
                $districtsData[] = [
                    'city_id' => $kotaSemarang->id,
                    'name' => $sd['name'],
                    'slug' => $sd['slug'],
                    'estimated_arrival' => '20-35 Menit',
                    'meta_title' => "Jasa Saluran Mampet {$sd['name']} Semarang | Pelancar Pipa 24 Jam",
                    'meta_description' => "Pelancaran pipa mampet di {$sd['desc']}. Tanpa bongkar garansi 30 hari tuntas baru bayar.",
                    'is_active' => true,
                    'sort_order' => $idx + 1,
                ];
            }
        }

        // F. Lampung
        if ($bandarLampung) {
            $lampungDistricts = [
                ['name' => 'Panjang', 'slug' => 'panjang', 'desc' => 'Kawasan Pelabuhan & Industri Panjang'],
                ['name' => 'Enggal', 'slug' => 'enggal', 'desc' => 'Pusat Bisnis & Kuliner Enggal Bandar Lampung'],
                ['name' => 'Teluk Betung Selatan', 'slug' => 'teluk-betung-selatan', 'desc' => 'Area Perdagangan Teluk Betung'],
                ['name' => 'Tanjung Senang', 'slug' => 'tanjung-senang', 'desc' => 'Residensial & Komersial Tanjung Senang'],
            ];

            foreach ($lampungDistricts as $idx => $ld) {
                $districtsData[] = [
                    'city_id' => $bandarLampung->id,
                    'name' => $ld['name'],
                    'slug' => $ld['slug'],
                    'estimated_arrival' => '20-35 Menit',
                    'meta_title' => "Jasa Saluran Mampet {$ld['name']} Bandar Lampung | 24 Jam",
                    'meta_description' => "Layanan pelancaran pipa mampet di {$ld['desc']}. Garansi 30 hari tanpa bongkar.",
                    'is_active' => true,
                    'sort_order' => $idx + 1,
                ];
            }
        }

        // G. Lampung Selatan & Metro
        if ($lampungSelatanKab) {
            $districtsData[] = [
                'city_id' => $lampungSelatanKab->id,
                'name' => 'Natar',
                'slug' => 'natar',
                'estimated_arrival' => '25-40 Menit',
                'meta_title' => 'Jasa Saluran Mampet Natar Lampung Selatan | Pelancar Pipa 24 Jam',
                'meta_description' => 'Pelancaran saluran pipa mampet Natar & sekitar Bandara Radin Inten II. Garansi 30 hari.',
                'is_active' => true,
                'sort_order' => 1,
            ];
            $districtsData[] = [
                'city_id' => $lampungSelatanKab->id,
                'name' => 'Jati Agung',
                'slug' => 'jati-agung',
                'estimated_arrival' => '25-40 Menit',
                'meta_title' => 'Jasa Saluran Mampet Jati Agung Lampung Selatan | 24 Jam',
                'meta_description' => 'Pelancaran pipa mampet kawasan Itera & Jati Agung. Garansi 30 hari tuntas baru bayar.',
                'is_active' => true,
                'sort_order' => 2,
            ];
        }

        if ($metroCity) {
            $districtsData[] = [
                'city_id' => $metroCity->id,
                'name' => 'Metro Pusat',
                'slug' => 'metro-pusat',
                'estimated_arrival' => '20-30 Menit',
                'meta_title' => 'Jasa Saluran Mampet Metro Pusat Kota Metro | Pelancar Pipa 24 Jam',
                'meta_description' => 'Pelancaran pipa mampet ruko & rumah Metro Pusat. Tanpa bongkar garansi 30 hari.',
                'is_active' => true,
                'sort_order' => 1,
            ];
            $districtsData[] = [
                'city_id' => $metroCity->id,
                'name' => 'Metro Timur',
                'slug' => 'metro-timur',
                'estimated_arrival' => '20-30 Menit',
                'meta_title' => 'Jasa Saluran Mampet Metro Timur Kota Metro | Pelancar Pipa 24 Jam',
                'meta_description' => 'Pelancaran pipa mampet Metro Timur Kota Metro. Garansi 30 hari tuntas baru bayar.',
                'is_active' => true,
                'sort_order' => 2,
            ];
        }

        // Insert or Update All Districts
        foreach ($districtsData as $dData) {
            District::firstOrCreate(
                ['slug' => $dData['slug']],
                $dData
            );
        }
    }

    public function down(): void
    {
        // Revert expansion data if down is executed
        District::whereIn('slug', [
            'pantai-indah-kapuk-pik', 'senopati-scbd', 'kemang-raya',
            'harapan-indah', 'summarecon-bekasi', 'lippo-cikarang', 'jababeka-cikarang',
            'cibubur-transyogi', 'kota-wisata-cibubur', 'margonda-raya', 'cinere-gandul',
            'ngaliyan', 'tugu', 'pedurungan', 'gunungpati', 'genuk', 'tembalang', 'bsb-city-mijen',
            'panjang', 'enggal', 'teluk-betung-selatan', 'tanjung-senang', 'natar', 'jati-agung',
            'metro-pusat', 'metro-timur'
        ])->delete();

        City::whereIn('slug', ['metro', 'kabupaten-lampung-selatan'])->delete();
    }
};
