<?php

namespace App\Services;

use App\Models\City;
use App\Models\District;

class RegionalAssetResolver
{
    /**
     * Resolve appropriate hero landmark/operational image based on City and District.
     */
    public function resolveHeroImage(City $city, ?District $district = null): string
    {
        $citySlug = strtolower($city->slug ?? '');
        $provSlug = strtolower($city->province->slug ?? '');
        $cityName = strtolower($city->name ?? '');

        // Determine target folder
        $folder = null;
        if (str_contains($provSlug, 'jakarta') || str_contains($citySlug, 'jakarta') || str_contains($cityName, 'jakarta')) {
            $folder = 'jakarta';
        } elseif (str_contains($provSlug, 'banten') || str_contains($citySlug, 'tangerang') || str_contains($citySlug, 'cilegon') || str_contains($citySlug, 'serang')) {
            $folder = 'banten';
        } elseif (str_contains($provSlug, 'jawa-barat') || str_contains($citySlug, 'bekasi') || str_contains($citySlug, 'bogor') || str_contains($citySlug, 'depok') || str_contains($citySlug, 'cikarang') || str_contains($citySlug, 'karawang') || str_contains($citySlug, 'bandung') || str_contains($citySlug, 'subang')) {
            $folder = 'jawa-barat';
        } elseif (str_contains($provSlug, 'jawa-tengah') || str_contains($citySlug, 'semarang') || str_contains($citySlug, 'surakarta') || str_contains($citySlug, 'solo') || str_contains($citySlug, 'kudus') || str_contains($citySlug, 'tegal') || str_contains($citySlug, 'brebes') || str_contains($citySlug, 'pati')) {
            $folder = 'jawa-tengah';
        } elseif (str_contains($provSlug, 'lampung') || str_contains($citySlug, 'lampung')) {
            $folder = 'lampung';
        } else {
            // Default region fallback
            $folder = 'jakarta';
        }

        $publicDir = public_path("assets/wilayah/{$folder}");
        if (file_exists($publicDir) && is_dir($publicDir)) {
            $files = scandir($publicDir);
            $validFiles = [];
            foreach ($files as $file) {
                if ($file === '.' || $file === '..') continue;
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($ext, ['webp', 'jpg', 'jpeg', 'png'])) {
                    $validFiles[] = $file;
                }
            }

            // Search Strategy 1: Match by City Slug or City Name
            $keywords = array_filter([
                $citySlug,
                str_replace('-', ' ', $citySlug),
                $cityName,
                str_replace(['kota-', 'kabupaten-', 'kab-'], '', $citySlug)
            ]);

            foreach ($keywords as $kw) {
                if (strlen($kw) < 3) continue;
                foreach ($validFiles as $file) {
                    if (str_contains(strtolower($file), strtolower($kw))) {
                        return asset("assets/wilayah/{$folder}/{$file}");
                    }
                }
            }

            // Search Strategy 2: Landmark / Province Default Image in folder
            if (!empty($validFiles)) {
                // Prefer clean representative images
                foreach ($validFiles as $file) {
                    if (str_contains($file, 'rootera') || str_contains($file, 'indonesia') || str_contains($file, 'city')) {
                        return asset("assets/wilayah/{$folder}/{$file}");
                    }
                }
                return asset("assets/wilayah/{$folder}/" . $validFiles[0]);
            }
        }

        // Final Operational Fallback (Real Sanitation Operations)
        return asset('images/dokumentasi/teknisi-rootera-stasiun-kai-jateng.webp');
    }
}
