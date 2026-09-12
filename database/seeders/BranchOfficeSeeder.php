<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class BranchOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Reset all cities to non-branch SAB default
        City::query()->update([
            'has_physical_branch' => false,
            'street_address'      => null,
            'district_locality'   => null,
            'postal_code'         => null,
            'branch_phone'        => null,
        ]);

        // 2. Cabang Utama Kantor Pusat (Jakarta Timur - Cijantung)
        City::where('slug', 'jakarta-timur')->update([
            'has_physical_branch' => true,
            'street_address'      => 'Gg. Mawar No.6B.1, RT.7/RW.1, Cijantung, Kec. Ps. Rebo',
            'district_locality'   => 'Jakarta Timur',
            'postal_code'         => '13770',
            'branch_phone'        => '6281385404000',
            'rating_value'        => 5.00,
            'review_count'        => 120,
        ]);

        // Cabang Fisik Satelit Jabodetabek (Menginduk ke Workshop Utama Cijantung)
        $jabodetabekSlugs = [
            'jakarta-selatan', 'jakarta-barat', 'jakarta-pusat', 'jakarta-utara',
            'bogor', 'depok', 'tangerang', 'tangerang-selatan', 'bekasi', 'kabupaten-bekasi'
        ];

        foreach ($jabodetabekSlugs as $slug) {
            City::where('slug', $slug)->update([
                'has_physical_branch' => true,
                'street_address'      => 'Gg. Mawar No.6B.1, RT.7/RW.1, Cijantung, Kec. Ps. Rebo',
                'district_locality'   => 'Jakarta Timur (Hub Utama Jabodetabek)',
                'postal_code'         => '13770',
                'branch_phone'        => '6281385404000',
                'latitude'            => -6.3275975,
                'longitude'           => 106.8627125,
                'rating_value'        => 4.95,
                'review_count'        => 95,
            ]);
        }

        // 3. Cabang Fisik Riil Luar Jabodetabek (Kota-Kota Cabang Utama)
        $externalBranches = [
            'semarang' => [
                'street_address'    => 'Jl. Simpang Lima No. 12, Pleburan, Kec. Semarang Selatan',
                'district_locality' => 'Kota Semarang',
                'postal_code'       => '50241',
                'branch_phone'      => '6281385404000',
                'latitude'          => -6.9902958,
                'longitude'         => 110.4227318,
                'rating_value'      => 4.90,
                'review_count'      => 88,
            ],
            'tegal' => [
                'street_address'    => 'Jl. Ahmad Yani No. 45, Mangkukusuman, Kec. Tegal Timur',
                'district_locality' => 'Kota Tegal',
                'postal_code'       => '52121',
                'branch_phone'      => '6281385404000',
                'latitude'          => -6.8675,
                'longitude'         => 109.1378,
                'rating_value'      => 4.88,
                'review_count'      => 76,
            ],
            'surabaya' => [
                'street_address'    => 'Jl. Raya Darmo No. 88, Darmo, Kec. Wonokromo',
                'district_locality' => 'Kota Surabaya',
                'postal_code'       => '60241',
                'branch_phone'      => '6281385404000',
                'latitude'          => -7.28917,
                'longitude'         => 112.7344,
                'rating_value'      => 4.92,
                'review_count'      => 105,
            ],
            'bandar-lampung' => [
                'street_address'    => 'Jl. Danau Towuti No. 9',
                'district_locality' => 'Kedaton, Surabaya, Kota Bandar Lampung',
                'postal_code'       => '35148',
                'branch_phone'      => '6281385404000',
                'latitude'          => -5.388639,
                'longitude'         => 105.265417,
                'rating_value'      => 4.95,
                'review_count'      => 125,
            ],
            'bandung' => [
                'street_address'    => 'Jl. Asia Afrika No. 102, Kebon Pisang, Kec. Sumur Bandung',
                'district_locality' => 'Kota Bandung',
                'postal_code'       => '40112',
                'branch_phone'      => '6281385404000',
                'latitude'          => -6.9211,
                'longitude'         => 107.6111,
                'rating_value'      => 4.91,
                'review_count'      => 90,
            ],
            'yogyakarta' => [
                'street_address'    => 'Jl. Malioboro No. 65, Sosromenduran, Kec. Gedongtengen',
                'district_locality' => 'Kota Yogyakarta',
                'postal_code'       => '55271',
                'branch_phone'      => '6281385404000',
                'latitude'          => -7.7956,
                'longitude'         => 110.3695,
                'rating_value'      => 4.93,
                'review_count'      => 98,
            ],
        ];

        foreach ($externalBranches as $slug => $data) {
            City::where('slug', $slug)->update([
                'has_physical_branch' => true,
                'street_address'      => $data['street_address'],
                'district_locality'   => $data['district_locality'],
                'postal_code'         => $data['postal_code'],
                'branch_phone'        => $data['branch_phone'],
                'latitude'            => $data['latitude'],
                'longitude'           => $data['longitude'],
                'rating_value'        => $data['rating_value'],
                'review_count'        => $data['review_count'],
            ]);
        }
    }
}
