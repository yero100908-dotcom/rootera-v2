<?php

$routesToTest = [
    '/tentang-kami/peralatan-teknologi',
    '/peralatan-teknologi/mesin-rooter-ridgid-k50-cable-spiral',
    '/peralatan-teknologi/inspeksi-kamera-cctv-pipa-saluran',
    '/peralatan-teknologi/high-pressure-hydro-jetting-unit',
    '/sitemap-main.xml',
];

echo "=== TESTING EQUIPMENT PAGES & DETAIL ROUTES ===\n\n";

$allPassed = true;

foreach ($routesToTest as $path) {
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

echo "\n===============================================\n";
if ($allPassed) {
    echo "🎉 ALL EQUIPMENT ROUTES RETURNED 200 OK!\n";
} else {
    echo "⚠️ SOME ROUTES FAILED!\n";
}
