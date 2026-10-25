<?php

namespace App\Services;

use App\Models\City;
use App\Models\District;

class PhysicalHubResolver
{
    /**
     * Determine if a given city belongs to Jabodetabek (DKI Jakarta, Bogor, Depok, Tangerang, Bekasi).
     */
    public static function isJabodetabek(?City $city): bool
    {
        if (!$city) {
            return false;
        }

        $citySlug = strtolower($city->slug ?? '');
        $cityName = strtolower($city->name ?? '');
        $provinceId = $city->province_id ?? null;
        $provinceName = strtolower($city->province->name ?? '');

        // 1. DKI Jakarta (Province ID 1 or name/slug)
        if ($provinceId === 1 || str_contains($provinceName, 'jakarta') || str_contains($citySlug, 'jakarta') || str_contains($cityName, 'jakarta')) {
            return true;
        }

        // 2. Bodetabek (Bogor, Depok, Tangerang, Bekasi)
        $jabodetabekKeywords = ['bogor', 'depok', 'tangerang', 'bekasi'];
        foreach ($jabodetabekKeywords as $keyword) {
            if (str_contains($citySlug, $keyword) || str_contains($cityName, $keyword)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Resolve responsible physical hub pool based on City & District.
     *
     * Rules:
     * 1. Jabodetabek: Detail pool armada lokal di kota/wilayah tersebut + Keterangan wajib Kantor Pusat Operasional di Cijantung, Jakarta Timur.
     * 2. Luar Jabodetabek (Semarang, Lampung, dll): HANYA menampilkan detail pool lokal di kota tersebut tanpa referensi Kantor Pusat Cijantung.
     */
    public static function resolveHub(?City $city, ?District $district = null): array
    {
        $cityName = $city->name ?? '';
        $cityNameLower = strtolower($cityName);
        $provinceName = strtolower($city->province->name ?? '');
        $citySlug = strtolower($city->slug ?? '');
        $isJabodetabek = self::isJabodetabek($city);

        $headquartersInfo = [
            'name'           => 'Kantor Pusat Operasional & Workshop Rootera',
            'short_name'     => 'Kantor Pusat Cijantung',
            'street_address' => 'Gg. Mawar No.6B.1, Cijantung',
            'locality'       => 'Pasar Rebo',
            'city_name'      => 'Jakarta Timur',
            'province_name'  => 'DKI Jakarta',
            'postal_code'    => '13770',
            'full_address'   => 'Gg. Mawar No.6B.1, Cijantung, Pasar Rebo, Jakarta Timur, DKI Jakarta 13770',
            'note'           => 'Kantor Pusat Operasional berada di Cijantung, Pasar Rebo, Jakarta Timur.',
        ];

        // ---------------------------------------------------------------------
        // 1. WILAYAH JABODETABEK (DKI Jakarta, Bogor, Depok, Tangerang, Bekasi)
        // ---------------------------------------------------------------------
        if ($isJabodetabek) {
            $isJakartaTimur = str_contains($citySlug, 'jakarta-timur') || str_contains($cityNameLower, 'timur');

            if ($isJakartaTimur) {
                // Hub Pusat Utama di Cijantung, Jakarta Timur
                $hub = [
                    'name'             => 'Pool Armada Pusat & Workshop Cijantung',
                    'code'             => 'HUB-JGT-01',
                    'street_address'   => 'Gg. Mawar No.6B.1, Cijantung',
                    'locality'         => 'Pasar Rebo',
                    'city_name'        => 'Jakarta Timur',
                    'province_name'    => 'DKI Jakarta',
                    'postal_code'      => '13770',
                    'full_address'     => 'Gg. Mawar No.6B.1, Cijantung, Pasar Rebo, Jakarta Timur, DKI Jakarta 13770',
                    'telephone'        => '+6281385404000',
                    'display_phone'    => '0813-8540-4000',
                    'radius_km'        => 60,
                    'latitude'         => -6.3134,
                    'longitude'        => 106.8625,
                    'coverage_region'  => 'Jakarta Timur, DKI Jakarta, & Seluruh Jabodetabek',
                    'is_jabodetabek'   => true,
                    'is_headquarters'  => true,
                    'headquarters'     => $headquartersInfo,
                ];
            } else {
                // Hub Pool Armada Lokal di Kota Tersebut (dengan status is_jabodetabek = true)
                $hubName = "Pool Armada Respons {$cityName}";
                $hubCode = 'HUB-JBD-01';
                $locality = $cityName;
                $radius = 30;
                $coverageRegion = "Wilayah {$cityName} & Area Sekitarnya";
                $lat = $city->latitude ? (float) $city->latitude : -6.2088;
                $lng = $city->longitude ? (float) $city->longitude : 106.8456;

                if (str_contains($citySlug, 'jakarta-selatan')) {
                    $hubCode = 'HUB-JKS-01';
                    $hubName = 'Pool Armada Respons Jakarta Selatan';
                    $locality = 'Jakarta Selatan';
                    $radius = 25;
                    $coverageRegion = 'Cilandak, Kebayoran, Jagakarsa, Tebet, & Seluruh Jakarta Selatan';
                    $lat = -6.2615;
                    $lng = 106.8106;
                } elseif (str_contains($citySlug, 'jakarta-barat')) {
                    $hubCode = 'HUB-JKB-01';
                    $hubName = 'Pool Armada Respons Jakarta Barat';
                    $locality = 'Jakarta Barat';
                    $radius = 25;
                    $coverageRegion = 'Kebon Jeruk, Kembangan, Cengkareng, & Seluruh Jakarta Barat';
                    $lat = -6.1683;
                    $lng = 106.7589;
                } elseif (str_contains($citySlug, 'jakarta-pusat')) {
                    $hubCode = 'HUB-JKP-01';
                    $hubName = 'Pool Armada Respons Jakarta Pusat';
                    $locality = 'Jakarta Pusat';
                    $radius = 20;
                    $coverageRegion = 'Tanah Abang, Menteng, Kemayoran, Gambir, & Seluruh Jakarta Pusat';
                    $lat = -6.1805;
                    $lng = 106.8284;
                } elseif (str_contains($citySlug, 'jakarta-utara')) {
                    $hubCode = 'HUB-JKU-01';
                    $hubName = 'Pool Armada Respons Jakarta Utara';
                    $locality = 'Jakarta Utara';
                    $radius = 25;
                    $coverageRegion = 'Kelapa Gading, Pluit, Sunter, Tanjung Priok, & Seluruh Jakarta Utara';
                    $lat = -6.1384;
                    $lng = 106.8640;
                } elseif (str_contains($citySlug, 'depok')) {
                    $hubCode = 'HUB-DPK-01';
                    $hubName = 'Pool Armada Respons Depok';
                    $locality = 'Kota Depok';
                    $radius = 30;
                    $coverageRegion = 'Margonda, Cimanggis, Cinere, Sawangan, & Seluruh Kota Depok';
                    $lat = -6.4025;
                    $lng = 106.7942;
                } elseif (str_contains($citySlug, 'bogor')) {
                    $hubCode = 'HUB-BGR-01';
                    $hubName = 'Pool Armada Respons Bogor';
                    $locality = 'Bogor';
                    $radius = 35;
                    $coverageRegion = 'Kota Bogor, Cibinong, Sentul, Bojonggede, & Sekitarnya';
                    $lat = -6.5971;
                    $lng = 106.8060;
                } elseif (str_contains($citySlug, 'tangerang')) {
                    $hubCode = 'HUB-TNG-01';
                    $hubName = str_contains($citySlug, 'selatan') ? 'Pool Armada Respons Tangerang Selatan' : 'Pool Armada Respons Tangerang';
                    $locality = str_contains($citySlug, 'selatan') ? 'Tangerang Selatan' : 'Tangerang';
                    $radius = 35;
                    $coverageRegion = 'BSD, Serpong, Bintaro, Karawaci, Ciputat, & Tangerang Raya';
                    $lat = -6.1783;
                    $lng = 106.6319;
                } elseif (str_contains($citySlug, 'bekasi')) {
                    $hubCode = 'HUB-BKS-01';
                    $hubName = 'Pool Armada Respons Bekasi';
                    $locality = 'Bekasi';
                    $radius = 35;
                    $coverageRegion = 'Bekasi Barat, Bekasi Timur, Cikarang, Tambun, & Sekitarnya';
                    $lat = -6.2383;
                    $lng = 106.9756;
                }

                $hub = [
                    'name'             => $hubName,
                    'code'             => $hubCode,
                    'street_address'   => "Pos Siaga Armada Reaksi Cepat {$cityName}",
                    'locality'         => $locality,
                    'city_name'        => $cityName,
                    'province_name'    => $city->province->name ?? 'Jawa Barat',
                    'postal_code'      => $city->postal_code ?? '10000',
                    'full_address'     => "Pos Siaga Armada Reaksi Cepat {$cityName} (Siaga Unit Layanan Wilayah {$cityName} & Sekitarnya)",
                    'telephone'        => '+6281385404000',
                    'display_phone'    => '0813-8540-4000',
                    'radius_km'        => $radius,
                    'latitude'         => $lat,
                    'longitude'        => $lng,
                    'coverage_region'  => $coverageRegion,
                    'is_jabodetabek'   => true,
                    'is_headquarters'  => false,
                    'headquarters'     => $headquartersInfo,
                ];
            }
        } 
        // ---------------------------------------------------------------------
        // 2. WILAYAH LUAR JABODETABEK (Semarang, Lampung, Surabaya, Bandung, dll)
        // ---------------------------------------------------------------------
        else {
            // Bandar Lampung & Provinsi Lampung
            if (str_contains($cityNameLower, 'lampung') || str_contains($provinceName, 'lampung') || str_contains($citySlug, 'lampung') || str_contains($citySlug, 'metro')) {
                $hub = [
                    'name'             => 'Pool Armada Cabang Kedaton',
                    'code'             => 'HUB-LMP-03',
                    'street_address'   => 'Jl. Danau Towuti No. 9',
                    'locality'         => 'Kedaton',
                    'city_name'        => 'Bandar Lampung',
                    'province_name'    => 'Lampung',
                    'postal_code'      => '35148',
                    'full_address'     => 'Jl. Danau Towuti No. 9, Kedaton, Kota Bandar Lampung, Lampung 35148',
                    'telephone'        => '+6281385404000',
                    'display_phone'    => '0813-8540-4000',
                    'radius_km'        => 45,
                    'latitude'         => -5.388639,
                    'longitude'        => 105.265417,
                    'coverage_region'  => 'Bandar Lampung, Metro, & Seluruh Provinsi Lampung',
                    'is_jabodetabek'   => false,
                    'is_headquarters'  => false,
                    'headquarters'     => null,
                ];
            } 
            // Semarang & Jawa Tengah (Semarang, Surakarta, Salatiga, Kudus, dll)
            elseif (
                str_contains($cityNameLower, 'semarang') || 
                str_contains($cityNameLower, 'surakarta') || 
                str_contains($cityNameLower, 'solo') || 
                str_contains($cityNameLower, 'salatiga') || 
                str_contains($cityNameLower, 'kudus') || 
                str_contains($cityNameLower, 'demak') || 
                str_contains($cityNameLower, 'kendal') || 
                str_contains($provinceName, 'jawa tengah')
            ) {
                $hub = [
                    'name'             => 'Pool Armada Cabang Semarang',
                    'code'             => 'HUB-SMG-02',
                    'street_address'   => 'Jl. Simpang Lima No. 12, Pleburan',
                    'locality'         => 'Semarang Selatan',
                    'city_name'        => 'Semarang',
                    'province_name'    => 'Jawa Tengah',
                    'postal_code'      => '50241',
                    'full_address'     => 'Jl. Simpang Lima No. 12, Pleburan, Kec. Semarang Selatan, Kota Semarang, Jawa Tengah 50241',
                    'telephone'        => '+6281385404000',
                    'display_phone'    => '0813-8540-4000',
                    'radius_km'        => 50,
                    'latitude'         => -6.9902958,
                    'longitude'        => 110.4227318,
                    'coverage_region'  => 'Kota Semarang, Surakarta, Salatiga, & Seluruh Jawa Tengah',
                    'is_jabodetabek'   => false,
                    'is_headquarters'  => false,
                    'headquarters'     => null,
                ];
            }
            // Surabaya & Jawa Timur
            elseif (
                str_contains($cityNameLower, 'surabaya') || 
                str_contains($cityNameLower, 'sidoarjo') || 
                str_contains($cityNameLower, 'gresik') || 
                str_contains($cityNameLower, 'malang') || 
                str_contains($provinceName, 'jawa timur')
            ) {
                $hub = [
                    'name'             => 'Pool Armada Cabang Surabaya',
                    'code'             => 'HUB-SBY-04',
                    'street_address'   => 'Jl. Raya Darmo No. 88, Darmo',
                    'locality'         => 'Wonokromo',
                    'city_name'        => 'Surabaya',
                    'province_name'    => 'Jawa Timur',
                    'postal_code'      => '60241',
                    'full_address'     => 'Jl. Raya Darmo No. 88, Darmo, Kec. Wonokromo, Kota Surabaya, Jawa Timur 60241',
                    'telephone'        => '+6281385404000',
                    'display_phone'    => '0813-8540-4000',
                    'radius_km'        => 50,
                    'latitude'         => -7.28917,
                    'longitude'        => 112.7344,
                    'coverage_region'  => 'Kota Surabaya, Sidoarjo, Gresik, & Jawa Timur',
                    'is_jabodetabek'   => false,
                    'is_headquarters'  => false,
                    'headquarters'     => null,
                ];
            }
            // Bandung & Sekitarnya
            elseif (
                str_contains($cityNameLower, 'bandung') || 
                str_contains($cityNameLower, 'cimahi')
            ) {
                $hub = [
                    'name'             => 'Pool Armada Cabang Bandung',
                    'code'             => 'HUB-BDG-05',
                    'street_address'   => 'Jl. Asia Afrika No. 102, Kebon Pisang',
                    'locality'         => 'Sumur Bandung',
                    'city_name'        => 'Bandung',
                    'province_name'    => 'Jawa Barat',
                    'postal_code'      => '40112',
                    'full_address'     => 'Jl. Asia Afrika No. 102, Kebon Pisang, Kec. Sumur Bandung, Kota Bandung, Jawa Barat 40112',
                    'telephone'        => '+6281385404000',
                    'display_phone'    => '0813-8540-4000',
                    'radius_km'        => 40,
                    'latitude'         => -6.9211,
                    'longitude'        => 107.6111,
                    'coverage_region'  => 'Kota Bandung, Cimahi, & Bandung Raya',
                    'is_jabodetabek'   => false,
                    'is_headquarters'  => false,
                    'headquarters'     => null,
                ];
            }
            // Yogyakarta / D.I. Yogyakarta
            elseif (
                str_contains($cityNameLower, 'yogyakarta') || 
                str_contains($cityNameLower, 'jogja') || 
                str_contains($cityNameLower, 'sleman') || 
                str_contains($cityNameLower, 'bantul') || 
                str_contains($provinceName, 'yogyakarta')
            ) {
                $hub = [
                    'name'             => 'Pool Armada Cabang Yogyakarta',
                    'code'             => 'HUB-YOG-06',
                    'street_address'   => 'Jl. Malioboro No. 65, Sosromenduran',
                    'locality'         => 'Gedongtengen',
                    'city_name'        => 'Yogyakarta',
                    'province_name'    => 'D.I. Yogyakarta',
                    'postal_code'      => '55271',
                    'full_address'     => 'Jl. Malioboro No. 65, Sosromenduran, Kec. Gedongtengen, Kota Yogyakarta, D.I. Yogyakarta 55271',
                    'telephone'        => '+6281385404000',
                    'display_phone'    => '0813-8540-4000',
                    'radius_km'        => 40,
                    'latitude'         => -7.7956,
                    'longitude'        => 110.3695,
                    'coverage_region'  => 'Kota Yogyakarta, Sleman, Bantul, & D.I. Yogyakarta',
                    'is_jabodetabek'   => false,
                    'is_headquarters'  => false,
                    'headquarters'     => null,
                ];
            }
            // Kota Cabang / Luar Jabodetabek Lainnya
            else {
                $hasBranch = $city && $city->has_physical_branch && !empty($city->street_address);
                $hub = [
                    'name'             => $hasBranch ? "Pool Armada Cabang {$cityName}" : "Pool Armada Siaga {$cityName}",
                    'code'             => 'HUB-LOK-09',
                    'street_address'   => $hasBranch ? $city->street_address : "Pos Siaga Armada Reaksi Cepat {$cityName}",
                    'locality'         => $city->district_locality ?? $cityName,
                    'city_name'        => $cityName,
                    'province_name'    => $city->province->name ?? 'Indonesia',
                    'postal_code'      => $city->postal_code ?? '50000',
                    'full_address'     => $hasBranch 
                        ? "{$city->street_address}, {$city->district_locality}, {$cityName}" 
                        : "Pos Siaga Armada Reaksi Cepat {$cityName} (Layanan Siaga Wilayah {$cityName} & Sekitarnya)",
                    'telephone'        => '+6281385404000',
                    'display_phone'    => '0813-8540-4000',
                    'radius_km'        => 40,
                    'latitude'         => $city->latitude ? (float) $city->latitude : -7.0,
                    'longitude'        => $city->longitude ? (float) $city->longitude : 110.0,
                    'coverage_region'  => "Wilayah {$cityName} & Area Sekitarnya",
                    'is_jabodetabek'   => false,
                    'is_headquarters'  => false,
                    'headquarters'     => null,
                ];
            }
        }

        // Calculate estimated arrival time to target district/city
        $locationLabel = $district ? $district->name : ($city ? $city->name : 'wilayah Anda');
        $estimatedArrival = $district->estimated_arrival ?? ($city->estimated_arrival ?? "30–60 Menit");

        $hub['target_location'] = $locationLabel;
        $hub['estimated_arrival'] = $estimatedArrival;
        $hub['dispatch_callout'] = "Armada disiagakan dari {$hub['name']} ({$hub['locality']}) — estimasi waktu tempuh {$estimatedArrival} ke area {$locationLabel}.";

        return $hub;
    }
}
