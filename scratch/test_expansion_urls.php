<?php

$urlsToTest = [
    // New Cities
    '/jasa-saluran-mampet/metro',
    '/jasa-saluran-mampet/kabupaten-lampung-selatan',

    // Jabodetabek Hotspots
    '/layanan-pipa-mampet/pipa-mampet/jakarta-utara/pantai-indah-kapuk-pik',
    '/layanan-pipa-mampet/pipa-mampet/jakarta-selatan/senopati-scbd',
    '/layanan-pipa-mampet/pipa-mampet/jakarta-selatan/kemang-raya',
    '/layanan-pipa-mampet/pipa-mampet/bekasi/harapan-indah',
    '/layanan-pipa-mampet/pipa-mampet/bekasi/summarecon-bekasi',
    '/layanan-pipa-mampet/pipa-mampet/kabupaten-bekasi/lippo-cikarang',
    '/layanan-pipa-mampet/pipa-mampet/kabupaten-bekasi/jababeka-cikarang',
    '/layanan-pipa-mampet/pipa-mampet/kabupaten-bogor/cibubur-transyogi',
    '/layanan-pipa-mampet/pipa-mampet/kabupaten-bogor/kota-wisata-cibubur',
    '/layanan-pipa-mampet/pipa-mampet/depok/margonda-raya',
    '/layanan-pipa-mampet/pipa-mampet/depok/cinere-gandul',

    // Semarang Hotspots
    '/layanan-pipa-mampet/pipa-mampet/semarang/ngaliyan',
    '/layanan-pipa-mampet/pipa-mampet/semarang/tugu',
    '/layanan-pipa-mampet/pipa-mampet/semarang/pedurungan',
    '/layanan-pipa-mampet/pipa-mampet/semarang/tembalang',
    '/layanan-pipa-mampet/pipa-mampet/semarang/bsb-city-mijen',

    // Lampung Hotspots
    '/layanan-pipa-mampet/pipa-mampet/bandar-lampung/panjang',
    '/layanan-pipa-mampet/pipa-mampet/bandar-lampung/enggal',
    '/layanan-pipa-mampet/pipa-mampet/kabupaten-lampung-selatan/natar',
    '/layanan-pipa-mampet/pipa-mampet/kabupaten-lampung-selatan/jati-agung',
    '/layanan-pipa-mampet/pipa-mampet/metro/metro-pusat',

    // Sitemaps
    '/sitemap-cities.xml',
    '/sitemap-districts.xml',
];

echo "=======================================================\n";
echo "    TESTING EXPANDED LOCATION HOTSPOTS & SITEMAP XML    \n";
echo "=======================================================\n\n";

$allPassed = true;

foreach ($urlsToTest as $path) {
    $ch = curl_init("http://127.0.0.1:8000{$path}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $html = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        echo "✅ [200 OK] {$path}\n";
    } else {
        echo "❌ [{$httpCode}] {$path}\n";
        $allPassed = false;
    }
}

echo "\n=======================================================\n";
if ($allPassed) {
    echo "🎉 ALL EXPANDED LOCATION HOTSPOTS RETURNED 200 OK!\n";
} else {
    echo "⚠️ SOME EXPANDED URLS FAILED!\n";
}
