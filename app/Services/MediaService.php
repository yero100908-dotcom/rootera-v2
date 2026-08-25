<?php

namespace App\Services;

class MediaService
{
    /**
     * Folder mapping from province slug to public assets folder name
     */
    protected array $provinceFolderMap = [
        'dki-jakarta'    => 'jakarta',
        'jawa-barat'     => 'jawa-barat',
        'jawa-tengah'    => 'jawa-tengah',
        'jawa-timur'     => 'jawa-timur',
        'banten'         => 'banten',
        'di-yogyakarta'  => 'yogyakarta',
        'yogyakarta'     => 'yogyakarta',
        'lampung'        => 'lampung',
    ];

    /**
     * Folder mapping from property slug to public assets properti folder name
     */
    protected array $propertyFolderMap = [
        // DB Slugs
        'rumah-tinggal'               => 'rumah-tinggal',
        'cafe-restoran'               => 'cafe-restoran',
        'hotel-apartemen'             => 'apartemen-hotel',
        'apartemen-hotel'             => 'apartemen-hotel',
        'mall-shopping-center'        => 'mall-foodcourt',
        'mall-foodcourt'              => 'mall-foodcourt',
        'perkantoran'                 => 'kantor-ruko',
        'kantor-ruko'                 => 'kantor-ruko',
        'kawasan-ruko'                => 'kompleks-niaga',
        'kompleks-niaga'              => 'kompleks-niaga',
        'instansi-pemerintah-swasta'  => 'fasilitas-publik',
        'fasilitas-publik'            => 'fasilitas-publik',
        'industri-pergudangan'        => 'gudang-logistik',
        'gudang-logistik'             => 'gudang-logistik',
        // Long Verbose Slugs
        'cafe-restoran-cloud-kitchen' => 'cafe-restoran',
        'restoran-cafe'               => 'cafe-restoran',
        'gudang-logistik-workshop-bengkel' => 'gudang-logistik',
        'kantor-ruko-coworking-studio-kerja' => 'kantor-ruko',
        'kawasan-ruko-toko-kompleks-niaga' => 'kompleks-niaga',
        'kos-kosan-homestay-apartemen-hotel' => 'apartemen-hotel',
        'rumah-tinggal-cluster-perumahan' => 'rumah-tinggal',
        'sekolah-yayasan-klinik-pribadi-tempat-ibadah' => 'fasilitas-publik',
        'tenant-mall-kios-foodcourt'  => 'mall-foodcourt',
    ];

    /**
     * Get structured array of operational Toolkit Equipment WebP assets
     */
    public function getToolkitImages(): array
    {
        return [
            'ridgid_k50' => [
                'title' => 'Mesin Rooter Ridgid K-50 & Cable Spiral',
                'url' => asset('assets/TOOLKIT/mesin-rooter-ridgid-k50-spiral-baja.webp'),
                'alt' => 'Mesin Rooter Ridgid K-50 & Kabel Spiral Pembersih Pipa',
                'desc' => 'Mesin pembersih saluran mekanis fleksibel penggerek lemak & kerak tanpa bongkar pipa.'
            ],
            'cctv_camera' => [
                'title' => 'Inspeksi Kamera CCTV Pipa Air',
                'url' => asset('assets/TOOLKIT/inspeksi-cctv-set-lengkap-rootera.webp'),
                'alt' => 'Inspeksi Kamera CCTV Pipa Air Rootera Plumbing',
                'desc' => 'Deteksi visual presisi titik pipa tersumbat, retak, atau patah di balik dinding & lantai.'
            ],
            'hydro_jetting' => [
                'title' => 'High-Pressure Hydro Jetting 250 Bar',
                'url' => asset('assets/TOOLKIT/hydro-jetting-hose-reel-heavy-duty.webp'),
                'alt' => 'High-Pressure Hydro Jetting 250 Bar Rootera',
                'desc' => 'Semprotan air tekanan tinggi mengikis gumpalan lemak keras & kerak di saluran dapur/resto.'
            ],
            'cutter_heads' => [
                'title' => 'Mata Pisau Cutter Head Spiral',
                'url' => asset('assets/TOOLKIT/mata-pisau-cutter-head-spiral-baja.webp'),
                'alt' => 'Variasi Mata Pisau Cutter Head Pemotong Kerak',
                'desc' => 'Aksesoris pemotong akar pohon, endapan kapur, & rontokan sabun beku.'
            ],
            'rotary_cable' => [
                'title' => 'Kabel Spiral Flexible Rotary',
                'url' => asset('assets/TOOLKIT/kabel-spiral-baja-flexible-rotary.webp'),
                'alt' => 'Kabel Spiral Baja Fleksibel Rotary Rootera',
                'desc' => 'Spiral baja tahan korosi penembus belokan pipa leher angsa (P-trap/S-trap).'
            ],
            'heavy_duty' => [
                'title' => 'Mesin Rooter Komersial Heavy-Duty',
                'url' => asset('assets/TOOLKIT/mesin-rooter-komersial-heavy-duty.webp'),
                'alt' => 'Mesin Rooter Komersial Heavy Duty Rootera',
                'desc' => 'Unit pembersih pipa limbah industri diameter besar untuk restoran, hotel, & pabrik.'
            ]
        ];
    }

    /**
     * Get a single deterministically selected regional image based on province & city slug.
     */
    public function getRegionalImage(string $provinceSlug, ?string $citySlug = null, int $index = 0): string
    {
        $folderName = $this->provinceFolderMap[$provinceSlug] ?? 'jakarta';
        $directoryPath = public_path("assets/wilayah/{$folderName}");

        if (!is_dir($directoryPath)) {
            return asset('images/JnJ.webp');
        }

        $files = array_values(array_filter(scandir($directoryPath), function ($file) use ($directoryPath) {
            return !in_array($file, ['.', '..']) && !is_dir("{$directoryPath}/{$file}");
        }));

        if (empty($files)) {
            return asset('images/JnJ.webp');
        }

        $seedString = ($citySlug ?? $provinceSlug) . "_idx_{$index}";
        $hashIndex = abs(crc32($seedString)) % count($files);

        return asset("assets/wilayah/{$folderName}/" . $files[$hashIndex]);
    }

    /**
     * Get an array of multiple unique deterministically selected regional images.
     */
    public function getRegionalImages(string $provinceSlug, ?string $citySlug = null, int $count = 3): array
    {
        $images = [];
        for ($i = 0; $i < $count; $i++) {
            $images[] = $this->getRegionalImage($provinceSlug, $citySlug, $i);
        }
        return array_unique($images);
    }

    /**
     * Get a single deterministically selected property WebP asset
     */
    public function getPropertyImage(string $propertySlug, int $index = 0): string
    {
        $folderName = $this->propertyFolderMap[$propertySlug] ?? 'rumah-tinggal';
        $directoryPath = public_path("assets/properti/{$folderName}");

        if (!is_dir($directoryPath)) {
            return asset('images/JnJ.webp');
        }

        $files = array_values(array_filter(scandir($directoryPath), function ($file) use ($directoryPath) {
            return !in_array($file, ['.', '..']) && !is_dir("{$directoryPath}/{$file}");
        }));

        if (empty($files)) {
            return asset('images/JnJ.webp');
        }

        $seedString = "prop_{$propertySlug}_idx_{$index}";
        $hashIndex = abs(crc32($seedString)) % count($files);

        return asset("assets/properti/{$folderName}/" . $files[$hashIndex]);
    }

    /**
     * Get structured array of all 8 property types with WebP images
     */
    public function getPropertyImages(): array
    {
        return [
            'rumah-tinggal' => [
                'name' => 'Rumah Tinggal & Cluster Perumahan',
                'slug' => 'rumah-tinggal-cluster-perumahan',
                'url' => $this->getPropertyImage('rumah-tinggal', 0),
                'icon' => '🏡',
                'badge' => 'Respon 30-90 Menit'
            ],
            'cafe-restoran' => [
                'name' => 'Cafe, Restoran & Cloud Kitchen',
                'slug' => 'cafe-restoran-cloud-kitchen',
                'url' => $this->getPropertyImage('cafe-restoran', 0),
                'icon' => '🍽️',
                'badge' => 'Respon 30-90 Menit'
            ],
            'apartemen-hotel' => [
                'name' => 'Kos-Kosan, Apartemen & Hotel',
                'slug' => 'kos-kosan-homestay-apartemen-hotel',
                'url' => $this->getPropertyImage('apartemen-hotel', 0),
                'icon' => '🏨',
                'badge' => 'Respon 30-90 Menit'
            ],
            'kantor-ruko' => [
                'name' => 'Kantor Ruko & Coworking Space',
                'slug' => 'kantor-ruko-coworking-studio-kerja',
                'url' => $this->getPropertyImage('kantor-ruko', 0),
                'icon' => '🏢',
                'badge' => 'Respon 30-90 Menit'
            ],
            'kompleks-niaga' => [
                'name' => 'Kawasan Ruko & Kompleks Niaga',
                'slug' => 'kawasan-ruko-toko-kompleks-niaga',
                'url' => $this->getPropertyImage('kompleks-niaga', 0),
                'icon' => '🏬',
                'badge' => 'Respon 30-90 Menit'
            ],
            'mall-foodcourt' => [
                'name' => 'Tenant Mall & Kios Foodcourt',
                'slug' => 'tenant-mall-kios-foodcourt',
                'url' => $this->getPropertyImage('mall-foodcourt', 0),
                'icon' => '🍕',
                'badge' => 'Respon 30-90 Menit'
            ],
            'gudang-logistik' => [
                'name' => 'Gudang Logistik & Workshop Bengkel',
                'slug' => 'gudang-logistik-workshop-bengkel',
                'url' => $this->getPropertyImage('gudang-logistik', 0),
                'icon' => '🏭',
                'badge' => 'Respon 30-90 Menit'
            ],
            'fasilitas-publik' => [
                'name' => 'Sekolah, Klinik & Fasilitas Publik',
                'slug' => 'sekolah-yayasan-klinik-pribadi-tempat-ibadah',
                'url' => $this->getPropertyImage('fasilitas-publik', 0),
                'icon' => '🏫',
                'badge' => 'Respon 30-90 Menit'
            ],
        ];
    }
}
