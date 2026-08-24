<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use Illuminate\Support\Str;

class KeywordDirectorySeeder extends Seeder
{
    /**
     * Run database seeds for Keyword Cluster Directory & Territory Mapping.
     */
    public function run(): void
    {
        // 1. Jawa Tengah & Semarang (16 Districts)
        $jateng = Province::firstOrCreate(
            ['slug' => 'jawa-tengah'],
            ['name' => 'Jawa Tengah', 'is_active' => true]
        );

        $semarang = City::firstOrCreate(
            ['slug' => 'semarang'],
            [
                'province_id'       => $jateng->id,
                'name'              => 'Semarang',
                'type'              => 'Kota',
                'whatsapp_number'   => '6281385404000',
                'estimated_arrival' => '20-35 Menit',
                'is_active'         => true,
            ]
        );

        $semarangDistricts = [
            'Banyumanik', 'Candisari', 'Gajahmungkur', 'Gayamsari', 'Genuk',
            'Gunungpati', 'Mijen', 'Ngaliyan', 'Pedurungan', 'Semarang Barat',
            'Semarang Selatan', 'Semarang Tengah', 'Semarang Timur', 'Semarang Utara',
            'Tembalang', 'Tugu'
        ];

        foreach ($semarangDistricts as $idx => $distName) {
            District::firstOrCreate(
                ['city_id' => $semarang->id, 'slug' => Str::slug($distName)],
                [
                    'name'              => $distName,
                    'estimated_arrival' => '15-30 Menit',
                    'sort_order'        => $idx + 1,
                    'is_active'         => true,
                ]
            );
        }

        // 2. Banten & Serang
        $banten = Province::firstOrCreate(
            ['slug' => 'banten'],
            ['name' => 'Banten', 'is_active' => true]
        );

        $serang = City::firstOrCreate(
            ['slug' => 'serang'],
            [
                'province_id'       => $banten->id,
                'name'              => 'Serang',
                'type'              => 'Kota',
                'whatsapp_number'   => '6281385404000',
                'estimated_arrival' => '25-40 Menit',
                'is_active'         => true,
            ]
        );

        $serangDistricts = [
            'Cipocok Jaya', 'Curug Kota Serang', 'Kasemen', 'Taktakan', 'Walantaka',
            'Jawilan', 'Cikande', 'Balaraja', 'Cikupa', 'Citra Raya', 'Serpong', 'BSD'
        ];

        foreach ($serangDistricts as $idx => $distName) {
            District::firstOrCreate(
                ['city_id' => $serang->id, 'slug' => Str::slug($distName)],
                [
                    'name'              => $distName,
                    'estimated_arrival' => '20-35 Menit',
                    'sort_order'        => $idx + 1,
                    'is_active'         => true,
                ]
            );
        }
    }
}
