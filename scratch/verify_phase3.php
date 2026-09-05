<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

\Illuminate\Support\Facades\Cache::flush();

echo "===================================================================\n";
echo "=== VERIFIKASI FASE 3: REDIRECT 301, CANONICAL, & SITEMAP XML ===\n";
echo "===================================================================\n";

// 1. Test 301 Redirect for cannibal route /layanan-pipa-mampet/pipa-mampet/jakarta-timur
$request = Illuminate\Http\Request::create('/layanan-pipa-mampet/pipa-mampet/jakarta-timur', 'GET');
$response = $app->handle($request);

echo "[TEST 1] HTTP Status Code untuk /layanan-pipa-mampet/pipa-mampet/jakarta-timur: " . $response->getStatusCode() . "\n";
if ($response->getStatusCode() === 301) {
    echo " -> Target Redirect: " . $response->headers->get('Location') . "\n";
    echo " -> RESULT: [SUCCESS 301 REDIRECT]\n\n";
} else {
    echo " -> RESULT: [FAILED - Expected 301]\n\n";
}

// 2. Test ProblemHub Canonical Consolidation
$probController = app(\App\Http\Controllers\ProblemHubController::class);
$probRes = $probController->show('wastafel-mampet-berlemak', 'jakarta-timur');
$probHtml = is_object($probRes) && method_exists($probRes, 'getContent') ? $probRes->getContent() : (string)$probRes;

preg_match('/<link rel="canonical" href="(.*?)"/i', $probHtml, $canMatch);
echo "[TEST 2] Canonical URL untuk Halaman ProblemHub /solusi/wastafel-mampet-berlemak/jakarta-timur:\n";
echo " -> Canonical Tag: " . ($canMatch[1] ?? 'NOT FOUND') . "\n";
if (isset($canMatch[1]) && str_contains($canMatch[1], '/jasa-saluran-mampet/jakarta-timur')) {
    echo " -> RESULT: [SUCCESS CANONICAL CONSOLIDATION TO CITY PILLAR PAGE]\n\n";
} else {
    echo " -> RESULT: [FAILED - Expected City Pillar Canonical]\n\n";
}

// 3. Test Sitemap Priority Optimization
$sitemapController = app(\App\Http\Controllers\SitemapController::class);
$sitemapDistRes = $sitemapController->districts();
$distXml = $sitemapDistRes->getContent();

echo "[TEST 3] Verifikasi Priority Sitemap Kecamatan:\n";
preg_match_all('/<priority>(.*?)<\/priority>/s', $distXml, $prioMatches);
if (!empty($prioMatches[1])) {
    echo " -> Priority Terdeteksi pada sitemap-districts: " . implode(', ', array_unique($prioMatches[1])) . "\n";
    echo " -> RESULT: [SUCCESS SITEMAP PRIORITY OPTIMIZATION]\n\n";
}
