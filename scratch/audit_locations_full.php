<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\ServiceArea;

echo "=================================================================\n";
echo "       AUDIT INVENTARISASI & SENSUS DATABASE WILAYAH ROOTERA     \n";
echo "=================================================================\n\n";

// 1. STATISTIK UTAMA
$totalProvinces = Province::count();
$activeProvinces = Province::where('is_active', true)->count();
$totalCities = City::count();
$activeCities = City::where('is_active', true)->count();
$totalDistricts = District::count();
$activeDistricts = District::where('is_active', true)->count();
$totalServiceAreas = ServiceArea::count();

echo "--- 1. RINGKASAN TOTAL DENGAN STATISTIK ACTIVE ---\n";
echo "Provinces      : Total {$totalProvinces} (Aktif: {$activeProvinces})\n";
echo "Cities/Kabs    : Total {$totalCities} (Aktif: {$activeCities})\n";
echo "Districts/Kec  : Total {$totalDistricts} (Aktif: {$activeDistricts})\n";
echo "ServiceAreas   : Total {$totalServiceAreas}\n\n";

// 2. MATRIKS REKAPITULASI PER PROVINSI
echo "--- 2. MATRIKS SEBARAN PER PROVINSI ---\n";
$provinces = Province::with(['cities.districts'])->orderBy('sort_order')->orderBy('name')->get();

foreach ($provinces as $prov) {
    $cityCount = $prov->cities->count();
    $activeCityCount = $prov->cities->where('is_active', true)->count();
    $districtCount = 0;
    $activeDistrictCount = 0;
    
    foreach ($prov->cities as $city) {
        $districtCount += $city->districts->count();
        $activeDistrictCount += $city->districts->where('is_active', true)->count();
    }
    
    echo sprintf(
        "PROVINSI: %-25s | ID: %2d | Status: %-8s | Kota/Kab: %2d (Aktif: %2d) | Kec: %3d (Aktif: %3d)\n",
        $prov->name,
        $prov->id,
        $prov->is_active ? 'AKTIF' : 'NONAKTIF',
        $cityCount,
        $activeCityCount,
        $districtCount,
        $activeDistrictCount
    );
}

// Check cities without province_id
$orphanCities = City::whereNull('province_id')->get();
if ($orphanCities->isNotEmpty()) {
    echo "\n⚠️ KOTA TANPA PROVINCE_ID (ORPHAN CITIES):\n";
    foreach ($orphanCities as $oc) {
        echo " - ID: {$oc->id} | Name: {$oc->name} | Type: {$oc->type} | Slug: {$oc->slug}\n";
    }
}

echo "\n=================================================================\n";
echo "--- 3. RINCIAN SEBARAN KOTA & KECAMATAN PER PROVINSI ---\n";
echo "=================================================================\n\n";

foreach ($provinces as $prov) {
    echo "====================================================\n";
    echo "PROVINSI: {$prov->name} (Slug: {$prov->slug})\n";
    echo "====================================================\n";
    
    if ($prov->cities->isEmpty()) {
        echo " (Belum ada kota/kabupaten terdaftar di provinsi ini)\n\n";
        continue;
    }

    foreach ($prov->cities as $city) {
        $districts = $city->districts;
        $kecNames = $districts->pluck('name')->toArray();
        $kecString = !empty($kecNames) ? implode(', ', array_slice($kecNames, 0, 10)) . (count($kecNames) > 10 ? ' ... (+ ' . (count($kecNames) - 10) . ' lainnya)' : '') : '(KOSONG - 0 KECAMATAN)';
        
        echo sprintf(
            "  ├─ [%s] %-25s (Slug: %-20s) | Status: %-7s | Total Kec: %2d\n",
            $city->type ?? 'Kota',
            $city->name,
            $city->slug,
            $city->is_active ? 'Aktif' : 'Nonaktif',
            $districts->count()
        );
        echo "     Sample Kec: {$kecString}\n";
        echo "     Canonical : " . url("/jasa-saluran-mampet/{$city->slug}") . "\n\n";
    }
}

// 4. DETEKSI TEMUAN MASALAH / GAP DATA
echo "=================================================================\n";
echo "--- 4. DETEKSI GAP, ANOMALI & DUPLIKASI DATA ---\n";
echo "=================================================================\n\n";

// A. Kota Tanpa Kecamatan
$citiesWithNoDistricts = City::has('districts', '=', 0)->get();
echo "A. Kota/Kabupaten Tanpa Kecamatan (0 Child Districts):\n";
if ($citiesWithNoDistricts->isEmpty()) {
    echo "   ✅ Semua Kota/Kabupaten memiliki minimal 1 kecamatan.\n";
} else {
    foreach ($citiesWithNoDistricts as $cnd) {
        $provName = $cnd->province ? $cnd->province->name : 'N/A';
        echo "   ❌ [{$provName}] {$cnd->type} {$cnd->name} (ID: {$cnd->id}, Slug: {$cnd->slug})\n";
    }
}
echo "\n";

// B. Duplikasi Slug Kota
$duplicateCitySlugs = City::select('slug', \DB::raw('count(*) as total'))
    ->groupBy('slug')
    ->having('total', '>', 1)
    ->get();

echo "B. Duplikasi Slug Kota:\n";
if ($duplicateCitySlugs->isEmpty()) {
    echo "   ✅ Tidak ditemukan slug kota ganda.\n";
} else {
    foreach ($duplicateCitySlugs as $dcs) {
        echo "   ⚠️ Slug duplikat: {$dcs->slug} (Total: {$dcs->total})\n";
        $cities = City::where('slug', $dcs->slug)->get();
        foreach ($cities as $c) {
            echo "      - ID: {$c->id} | Name: {$c->name} | Province: " . ($c->province ? $c->province->name : 'N/A') . "\n";
        }
    }
}
echo "\n";

// C. Duplikasi Slug Kecamatan dalam Kota yang sama
$duplicateDistrictSlugs = District::select('city_id', 'slug', \DB::raw('count(*) as total'))
    ->groupBy('city_id', 'slug')
    ->having('total', '>', 1)
    ->get();

echo "C. Duplikasi Slug Kecamatan dalam Kota Sama:\n";
if ($duplicateDistrictSlugs->isEmpty()) {
    echo "   ✅ Tidak ditemukan slug kecamatan ganda dalam 1 kota.\n";
} else {
    foreach ($duplicateDistrictSlugs as $dds) {
        $city = City::find($dds->city_id);
        echo "   ⚠️ City: " . ($city ? $city->name : "ID {$dds->city_id}") . " | Slug Kec Duplikat: {$dds->slug} (Total: {$dds->total})\n";
    }
}
echo "\n";

// D. Pengecekan Kawasan Komersial Non-Administratif Populer
$commercialHotspots = [
    'BSD City' => ['bsd', 'bsd-city'],
    'Gading Serpong' => ['gading-serpong', 'serpong'],
    'PIK (Pantai Indah Kapuk)' => ['pik', 'pantai-indah-kapuk'],
    'Grand Galaxy' => ['grand-galaxy', 'galaxy'],
    'Sentul City' => ['sentul', 'sentul-city'],
    'Lippo Karawaci' => ['lippo-karawaci', 'karawaci'],
    'Bintaro Jaya' => ['bintaro', 'bintaro-jaya'],
    'Kelapa Gading' => ['kelapa-gading'],
    'Pondok Indah' => ['pondok-indah'],
    'Alam Sutera' => ['alam-sutera'],
    'Harapan Indah' => ['harapan-indah'],
    'Summarecon Bekasi' => ['summarecon-bekasi'],
    'Cibubur' => ['cibubur'],
];

echo "D. Pengecekan Kawasan Komersial Non-Administratif di Database:\n";
foreach ($commercialHotspots as $name => $slugs) {
    $foundInCity = City::whereIn('slug', $slugs)->orWhere('name', 'LIKE', "%{$name}%")->first();
    $foundInDistrict = District::whereIn('slug', $slugs)->orWhere('name', 'LIKE', "%{$name}%")->first();
    $foundInServiceArea = ServiceArea::whereIn('slug', $slugs)->orWhere('name', 'LIKE', "%{$name}%")->first();
    
    $status = [];
    if ($foundInCity) $status[] = "City (ID: {$foundInCity->id})";
    if ($foundInDistrict) $status[] = "District (ID: {$foundInDistrict->id})";
    if ($foundInServiceArea) $status[] = "ServiceArea (ID: {$foundInServiceArea->id})";
    
    if (!empty($status)) {
        echo sprintf("   ✅ %-28s : Terdaftar di %s\n", $name, implode(', ', $status));
    } else {
        echo sprintf("   ❌ %-28s : Belum terdaftar (MISSING COMMERCIAL HOTSPOT)\n", $name);
    }
}

echo "\n=================================================================\n";
echo "--- 5. AUDIT DATA SERVICE_AREA (LEGACY / SPECIFIC HUBS) ---\n";
echo "=================================================================\n\n";

$serviceAreas = ServiceArea::orderBy('sort_order')->orderBy('name')->get();
echo "Total ServiceArea records: " . $serviceAreas->count() . "\n";
foreach ($serviceAreas as $sa) {
    echo sprintf(" - ID: %2d | Name: %-30s | Slug: %-25s | Province: %-15s | Active: %s\n",
        $sa->id,
        $sa->name,
        $sa->slug,
        $sa->province ?? 'N/A',
        $sa->is_active ? 'Ya' : 'Tidak'
    );
}

echo "\n=================================================================\n";
echo "AUDIT DATABASE SELESAI (100% READ-ONLY, ZERO MODIFICATION)\n";
echo "=================================================================\n";
