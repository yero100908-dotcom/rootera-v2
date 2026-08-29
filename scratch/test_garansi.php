<?php

$ch = curl_init("http://127.0.0.1:8000/tentang-kami/garansi-layanan");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$html = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "=== TESTING GARANSI LAYANAN ROUTE ===\n";
echo "HTTP Code: {$httpCode}\n";

if ($httpCode === 200) {
    echo "✅ [200 OK] /tentang-kami/garansi-layanan rendered cleanly!\n";
    if (strpos($html, 'Garansi Resmi Hingga 30 Hari') !== false) {
        echo "✅ Headline check PASSED!\n";
    }
    if (strpos($html, '100% No Result No Pay') !== false) {
        echo "✅ 4 Pilar check PASSED!\n";
    }
    if (strpos($html, 'FAQPage') !== false) {
        echo "✅ JSON-LD FAQPage Schema check PASSED!\n";
    }
} else {
    echo "❌ Failed to render /tentang-kami/garansi-layanan\n";
}
