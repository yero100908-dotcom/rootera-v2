<?php

$urls = [
    // City Hubs
    '/jasa-cuci-toren/jakarta-selatan',
    '/jasa-cuci-toren/semarang',
    '/jasa-cuci-toren/bandar-lampung',
    '/jasa-cuci-toren/metro',
    '/jasa-cuci-toren/yogyakarta',

    // District Spokes
    '/layanan-cuci-toren/jakarta-selatan/senopati-scbd',
    '/layanan-cuci-toren/jakarta-utara/pantai-indah-kapuk-pik',
    '/layanan-cuci-toren/bekasi/harapan-indah',
    '/layanan-cuci-toren/semarang/tembalang',
    '/layanan-cuci-toren/semarang/bsb-city-mijen',
    '/layanan-cuci-toren/metro/metro-pusat',
    '/layanan-cuci-toren/kabupaten-lampung-selatan/natar',

    // Sitemaps
    '/sitemap.xml',
    '/sitemap-cuci-toren-cities.xml',
    '/sitemap-cuci-toren-districts.xml',
];

echo "=====================================================\n";
echo "    TESTING pSEO CUCI TOREN ROUTES & SITEMAPS XML   \n";
echo "=====================================================\n\n";

$allPassed = true;

foreach ($urls as $path) {
    $ch = curl_init("http://127.0.0.1:8000{$path}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $html = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($code === 200) {
        echo "✅ [200 OK] {$path}\n";
    } else {
        echo "❌ [{$code}] {$path}\n";
        $allPassed = false;
    }
}

echo "\n=====================================================\n";
if ($allPassed) {
    echo "🎉 ALL pSEO CUCI TOREN ROUTES RETURNED 200 OK!\n";
} else {
    echo "⚠️ SOME pSEO CUCI TOREN ROUTES FAILED!\n";
}
