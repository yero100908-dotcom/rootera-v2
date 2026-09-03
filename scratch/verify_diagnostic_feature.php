<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "===============================================================\n";
echo "      DIAGNOSTIC FEATURE & ON-PAGE VERIFICATION SCRIPT          \n";
echo "===============================================================\n\n";

$failed = 0;

// 1. Test Route GET /cek-kondisi-pipa
echo "--- 1. ROUTE & HTML RENDERING TEST ---\n";
$request = Illuminate\Http\Request::create('/cek-kondisi-pipa', 'GET');
try {
    $response = $app->handle($request);
    $status = $response->getStatusCode();
    echo "  - GET /cek-kondisi-pipa HTTP Status: {$status} " . ($status === 200 ? "[OK]" : "[FAIL]") . "\n";
    if ($status !== 200) $failed++;

    $html = $response->getContent();

    // Title Check
    preg_match('/<title>(.*?)<\/title>/s', $html, $titleMatches);
    $titleRaw = isset($titleMatches[1]) ? trim($titleMatches[1]) : 'N/A';
    $title = html_entity_decode($titleRaw, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $titleLen = mb_strlen($title);
    echo "  - Title Tag ({$titleLen} chars): \"{$title}\" " . ($titleLen <= 60 ? "[OK]" : "[OVER 60]") . "\n";
    if ($titleLen > 60) $failed++;

    // Meta Description Check
    preg_match('/<meta name="description" content="(.*?)"/s', $html, $metaMatches);
    $metaRaw = isset($metaMatches[1]) ? trim($metaMatches[1]) : 'N/A';
    $metaDesc = html_entity_decode($metaRaw, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $metaLen = mb_strlen($metaDesc);
    echo "  - Meta Desc ({$metaLen} chars): \"{$metaDesc}\" " . ($metaLen >= 120 && $metaLen <= 165 ? "[OK]" : "[OUT OF RANGE]") . "\n";
    if ($metaLen < 120 || $metaLen > 165) $failed++;

    // Alpine.js Quiz Widget Check
    $hasAlpineQuiz = (strpos($html, 'x-data') !== false && strpos($html, 'totalScore') !== false);
    echo "  - Alpine.js Quiz Widget Component: " . ($hasAlpineQuiz ? "[OK]" : "[MISSING]") . "\n";
    if (!$hasAlpineQuiz) $failed++;

    // JSON-LD Schema Check
    $hasSchemaWebApp = (strpos($html, 'WebApplication') !== false && strpos($html, 'FAQPage') !== false);
    echo "  - JSON-LD WebApplication & FAQPage Schema: " . ($hasSchemaWebApp ? "[OK]" : "[MISSING]") . "\n";
    if (!$hasSchemaWebApp) $failed++;

} catch (\Exception $e) {
    echo "  - Error: " . $e->getMessage() . "\n";
    $failed++;
}

echo "\n--- 2. NAVIGATION & SITEMAP INTEGRATION TEST ---\n";

// Test Navbar link
$homeRequest = Illuminate\Http\Request::create('/', 'GET');
$homeHtml = $app->handle($homeRequest)->getContent();
$hasNavbarLink = (strpos($homeHtml, '/cek-kondisi-pipa') !== false);
echo "  - Navbar Link to /cek-kondisi-pipa: " . ($hasNavbarLink ? "[OK]" : "[MISSING]") . "\n";
if (!$hasNavbarLink) $failed++;

// Test Sitemap XML
$sitemapRequest = Illuminate\Http\Request::create('/sitemap-main.xml', 'GET');
$sitemapHtml = $app->handle($sitemapRequest)->getContent();
$hasSitemapUrl = (strpos($sitemapHtml, '/cek-kondisi-pipa') !== false);
echo "  - Sitemap XML Registration in sitemap-main.xml: " . ($hasSitemapUrl ? "[OK]" : "[MISSING]") . "\n";
if (!$hasSitemapUrl) $failed++;

echo "\n===============================================================\n";
if ($failed === 0) {
    echo ">>> ALL DIAGNOSTIC TOOL FEATURE TESTS PASSED 100%! <<<\n";
} else {
    echo ">>> SOME VERIFICATIONS FAILED ({$failed}) <<<\n";
}
echo "===============================================================\n";
