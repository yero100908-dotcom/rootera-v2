<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\ServiceCategory;
use App\Models\Service;

class ActiveAreasSeeder extends Seeder
{
    /**
     * Run the seeder to enforce Tahap 1 Soft Isolation:
     * - Whitelist only 15 active cities/regencies (Jabodetabek, Semarang, Bandar Lampung).
     * - Soft-deactivate all other cities, districts, and provinces.
     * - Soft-deactivate Cuci Toren services & categories.
     */
    public function run(): void
    {
        // 1. Target Operational Whitelist Cities (15 Cities/Regencies)
        $activeCitySlugs = [
            // Jabodetabek Hub (DKI Jakarta, Banten, Jawa Barat)
            'jakarta-selatan',
            'jakarta-timur',
            'jakarta-barat',
            'jakarta-pusat',
            'jakarta-utara',
            'bogor',
            'kabupaten-bogor',
            'depok',
            'tangerang',
            'tangerang-selatan',
            'kabupaten-tangerang',
            'bekasi',
            'kabupaten-bekasi',
            
            // Semarang Hub (Jawa Tengah)
            'semarang',
            
            // Bandar Lampung Hub (Lampung)
            'bandar-lampung',
        ];

        // 2. Soft-deactivate all locations first
        District::query()->update(['is_active' => false]);
        City::query()->update(['is_active' => false]);
        Province::query()->update(['is_active' => false]);

        // 3. Activate Whitelist Cities
        City::whereIn('slug', $activeCitySlugs)->update(['is_active' => true]);

        // Get IDs of active cities
        $activeCityIds = City::where('is_active', true)->pluck('id');

        // Activate districts belonging to active cities
        District::whereIn('city_id', $activeCityIds)->update(['is_active' => true]);

        // Activate parent provinces of active cities
        $activeProvinceIds = City::where('is_active', true)->pluck('province_id')->unique();
        Province::whereIn('id', $activeProvinceIds)->update(['is_active' => true]);

        // 4. Configure Physical Branch Offices vs SAB (Service Area Business) Locations
        City::query()->update([
            'has_physical_branch' => false,
            'street_address'      => null
        ]);

        // Physical Branch HQ & Regional Offices
        City::where('slug', 'jakarta-timur')->update([
            'has_physical_branch' => true,
            'street_address'      => 'Gg. Mawar No.6B.1, RT.7/RW.1, Cijantung, Kec. Ps. Rebo',
            'district_locality'   => 'Cijantung',
            'postal_code'         => '13770',
            'latitude'            => -6.3275975,
            'longitude'           => 106.8627125
        ]);

        City::where('slug', 'semarang')->update([
            'has_physical_branch' => true,
            'street_address'      => 'Jl. Simpang Lima No. 12, Pleburan, Kec. Semarang Selatan',
            'district_locality'   => 'Pleburan',
            'postal_code'         => '50241',
            'latitude'            => -6.9902958,
            'longitude'           => 110.4227318
        ]);

        City::where('slug', 'bandar-lampung')->update([
            'has_physical_branch' => true,
            'street_address'      => 'Jl. Raden Intan No. 54, Enggal, Kec. Enggal',
            'district_locality'   => 'Enggal',
            'postal_code'         => '35118',
            'latitude'            => -5.4285813,
            'longitude'           => 105.2600214
        ]);

        // 5. Soft-deactivate Cuci Toren Services, Categories & Articles
        ServiceCategory::where('slug', 'air-bersih-cuci-toren')->update(['is_active' => false]);
        Service::where('slug', 'cuci-toren-tandon-air')->update(['is_active' => false]);
        if (class_exists('\App\Models\Article')) {
            \App\Models\Article::where('slug', 'like', '%cuci-toren%')->update(['status' => 'draft']);
        }
    }
}
