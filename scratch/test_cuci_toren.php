<?php

$urls = [
    '/jasa-cuci-toren-air',
    '/kontak',
    '/layanan',
    '/sitemap-main.xml'
];

echo "=====================================================\n";
echo "    TESTING CUCI TOREN LANDING PAGE & INTEGRATIONS   \n";
echo "=====================================================\n\n";

$allPassed = true;
foreach ($urls as $path) {
    $ch = curl_init("http://127.0.0.1:8000{$path}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $body = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($code === 200) {
        echo "✅ [200 OK] {$path}\n";
    } else {
        echo "❌ [{$code}] {$path}\n";
        $allPassed = false;
    }
}

if ($allPassed) {
    echo "\n🎉 ALL CUCI TOREN INTEGRATIONS RETURNED 200 OK!\n";
}
