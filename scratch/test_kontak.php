<?php

echo "=== TESTING CONTACT PAGE & FORM SUBMISSION ===\n\n";

// 1. Test GET /kontak
$ch = curl_init("http://127.0.0.1:8000/kontak");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$html = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode === 200) {
    echo "✅ [200 OK] /kontak rendered cleanly!\n";
    if (strpos($html, 'Pusat Bantuan') !== false) {
        echo "✅ Hero title check PASSED!\n";
    }
    if (strpos($html, 'Plumber') !== false && strpos($html, 'ContactPage') !== false) {
        echo "✅ JSON-LD Plumber & ContactPage schema check PASSED!\n";
    }
} else {
    echo "❌ GET /kontak failed with code {$httpCode}\n";
}

// 2. Test POST /kontak
$ch = curl_init("http://127.0.0.1:8000/kontak");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'name' => 'Budi Test Automated',
    'phone' => '081234567890',
    'email' => 'budi.test@example.com',
    'service_type' => 'Pelancaran Wastafel Dapur',
    'area' => 'Jakarta',
    'message' => 'Test pesan otomatis untuk pengujian form kontak.',
    '_token' => 'dummy' // Laravel test
]));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$postHtml = curl_exec($ch);
$postCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "\nPOST /kontak HTTP Status: {$postCode}\n";
echo "===============================================\n";
