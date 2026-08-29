<?php

$ch = curl_init("http://127.0.0.1:8000/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$html = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "=====================================================\n";
echo "    TESTING HOMEPAGE CUCI TOREN INTEGRATION & SCHEMA \n";
echo "=====================================================\n\n";

if ($code === 200) {
    echo "✅ [200 OK] Homepage accessible\n";
} else {
    echo "❌ [{$code}] Homepage returned error\n";
    exit(1);
}

$hasCuciTorenCard = str_contains($html, 'Cuci Toren &amp; Kuras Tandon Air') || str_contains($html, 'Cuci Toren & Kuras Tandon Air');
$hasCtaLink = str_contains($html, '/jasa-cuci-toren-air');
$hasSchema = str_contains($html, 'Plumber') && str_contains($html, 'Cuci Toren & Kuras Tandon Air');

echo $hasCuciTorenCard ? "✅ Card Cuci Toren found in catalog grid\n" : "❌ Card Cuci Toren NOT found\n";
echo $hasCtaLink ? "✅ Link CTA /jasa-cuci-toren-air found\n" : "❌ Link CTA NOT found\n";
echo $hasSchema ? "✅ JSON-LD Schema Plumber & Cuci Toren found\n" : "❌ Schema NOT found\n";

echo "\n=====================================================\n";
if ($hasCuciTorenCard && $hasCtaLink && $hasSchema) {
    echo "🎉 HOMEPAGE INTEGRATION PASSED 100% SUCCESSFULLY!\n";
} else {
    echo "⚠️ SOME HOMEPAGE CHECKS FAILED!\n";
}
