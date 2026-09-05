<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Province;
use App\Models\City;
use App\Models\District;

$totalActiveProvinces = Province::where('is_active', true)->count();
$totalProvinces = Province::count();

$totalActiveCities = City::where('is_active', true)->count();
$totalCities = City::count();

$totalActiveDistricts = District::where('is_active', true)->count();
$totalDistricts = District::count();

$branchCitiesCount = City::where('is_active', true)->where('has_physical_branch', true)->count();
$sabCitiesCount = City::where('is_active', true)->where('has_physical_branch', false)->count();

$cities = City::with(['province'])
    ->withCount(['districts' => function ($q) {
        $q->where('is_active', true);
    }])
    ->orderBy('province_id')
    ->orderBy('sort_order')
    ->orderBy('name')
    ->get();

$data = [
    'summary' => [
        'total_provinces'        => $totalProvinces,
        'active_provinces'       => $totalActiveProvinces,
        'total_cities'           => $totalCities,
        'active_cities'          => $totalActiveCities,
        'total_districts'        => $totalDistricts,
        'active_districts'       => $totalActiveDistricts,
        'branch_cities_count'    => $branchCitiesCount,
        'sab_cities_count'       => $sabCitiesCount,
    ],
    'cities' => [],
    'issues' => [],
];

foreach ($cities as $index => $c) {
    $statusText = $c->has_physical_branch ? 'Cabang Fisik Riil' : 'Area Jangkauan (SAB)';
    $addressText = $c->has_physical_branch && !empty($c->street_address) ? $c->street_address : '-';
    
    $data['cities'][] = [
        'no'             => $index + 1,
        'name'           => $c->full_name,
        'province'       => $c->province->name ?? 'N/A',
        'status'         => $statusText,
        'address'        => $addressText,
        'districts_cnt'  => $c->districts_count,
        'url'            => url('/jasa-saluran-mampet/' . $c->slug),
        'is_active'      => $c->is_active,
    ];

    if (!$c->is_active) {
        $data['issues'][] = "Kota {$c->full_name} ({$c->slug}) berstatus NON-AKTIF (is_active = false)";
    }
    if ($c->districts_count === 0) {
        $data['issues'][] = "Kota {$c->full_name} ({$c->slug}) TIDAK MEMILIKI KECAMATAN TERHUBUNG (districts_count = 0)";
    }
    if ($c->has_physical_branch && empty($c->street_address)) {
        $data['issues'][] = "Kota {$c->full_name} ({$c->slug}) berstatus Cabang Fisik tetapi ALAMAT SOKONGAN KOSONG";
    }
}

echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
