<?php

namespace App\Services;

use App\Models\City;
use App\Models\District;

class PhysicalHubResolver
{
    /**
     * Resolve responsible physical hub pool based on City & District.
     */
    public static function resolveHub(?City $city, ?District $district = null): array
    {
        $cityName = strtolower($city->name ?? '');
        $provinceName = strtolower($city->province->name ?? '');
        $citySlug = $city->slug ?? '';

        // Default: Hub 1 - Jakarta Timur (Pusat Jabodetabek & West Java)
        $hub = [
            'name'             => 'Pool Armada Pusat Cijantung',
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
            'coverage_region'  => 'DKI Jakarta, Depok, Bogor, Tangerang, Bekasi, & Jawa Barat',
        ];

        // Hub 3 - Bandar Lampung (Sumatera)
        if (str_contains($cityName, 'lampung') || str_contains($provinceName, 'lampung') || str_contains($citySlug, 'lampung') || str_contains($citySlug, 'metro')) {
            $hub = [
                'name'             => 'Pool Armada Cabang Kedaton',
                'code'             => 'HUB-LMP-03',
                'street_address'   => 'Jl. ZA. Pagar Alam No. 45',
                'locality'         => 'Kedaton',
                'city_name'        => 'Bandar Lampung',
                'province_name'    => 'Lampung',
                'postal_code'      => '35141',
                'full_address'     => 'Jl. ZA. Pagar Alam No. 45, Kedaton, Kota Bandar Lampung, Lampung 35141',
                'telephone'        => '+6281385404000',
                'display_phone'    => '0813-8540-4000',
                'radius_km'        => 45,
                'latitude'         => -5.3812,
                'longitude'        => 105.2581,
                'coverage_region'  => 'Bandar Lampung, Metro, & Provinsi Lampung',
            ];
        } 
        // Hub 2 - Semarang (Jawa Tengah, DIY, Jawa Timur)
        elseif (
            str_contains($cityName, 'semarang') || 
            str_contains($cityName, 'surakarta') || 
            str_contains($cityName, 'solo') || 
            str_contains($cityName, 'yogyakarta') || 
            str_contains($cityName, 'sleman') || 
            str_contains($cityName, 'surabaya') || 
            str_contains($cityName, 'sidoarjo') || 
            str_contains($provinceName, 'jawa tengah') || 
            str_contains($provinceName, 'yogyakarta') || 
            str_contains($provinceName, 'jawa timur')
        ) {
            $hub = [
                'name'             => 'Pool Armada Cabang Semarang',
                'code'             => 'HUB-SMG-02',
                'street_address'   => 'Jl. Pemuda No. 88',
                'locality'         => 'Semarang Tengah',
                'city_name'        => 'Semarang',
                'province_name'    => 'Jawa Tengah',
                'postal_code'      => '50139',
                'full_address'     => 'Jl. Pemuda No. 88, Pandansari, Semarang Tengah, Kota Semarang, Jawa Tengah 50139',
                'telephone'        => '+6281385404000',
                'display_phone'    => '0813-8540-4000',
                'radius_km'        => 50,
                'latitude'         => -6.9744,
                'longitude'        => 110.4208,
                'coverage_region'  => 'Semarang, Surakarta, DIY, & Jawa Timur',
            ];
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
