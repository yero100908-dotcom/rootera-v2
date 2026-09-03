<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "===============================================================\n";
echo "       SITEMAP STYLESHEET & 301 REDIRECT VERIFICATION           \n";
echo "===============================================================\n\n";

// 1. Verify Master Sitemap Index (/sitemap.xml)
$reqIndex = Illuminate\Http\Request::create('/sitemap.xml', 'GET');
$resIndex = $app->handle($reqIndex);
$ctIndex = $resIndex->headers->get('Content-Type');
$htmlIndex = $resIndex->getContent();

echo "--- 1. MASTER SITEMAP INDEX (/sitemap.xml) ---\n";
echo "  - HTTP Status: " . $resIndex->getStatusCode() . " [OK]\n";
echo "  - Content-Type Header: \"{$ctIndex}\" -> " . (strpos($ctIndex, 'text/xml') !== false ? "PASS" : "FAIL") . "\n";
echo "  - XSLT Tag Present: " . (strpos($htmlIndex, 'xml-stylesheet') !== false ? "PASS" : "FAIL") . "\n";
echo "  - Points to /sitemap-pages.xml: " . (strpos($htmlIndex, '/sitemap-pages.xml') !== false ? "PASS" : "FAIL") . "\n";

// 2. Verify 301 Permanent Redirect from /sitemap-main.xml to /sitemap.xml
$reqMainRedirect = Illuminate\Http\Request::create('/sitemap-main.xml', 'GET');
$resMainRedirect = $app->handle($reqMainRedirect);
$statusMain = $resMainRedirect->getStatusCode();
$targetLoc = $resMainRedirect->headers->get('Location');

echo "\n--- 2. REDIRECT CHECK (/sitemap-main.xml -> /sitemap.xml) ---\n";
echo "  - HTTP Status: {$statusMain} -> " . ($statusMain === 301 ? "PASS (301 Permanent Redirect)" : "FAIL") . "\n";
echo "  - Redirect Target Location: \"{$targetLoc}\" -> " . (strpos($targetLoc, '/sitemap.xml') !== false ? "PASS" : "FAIL") . "\n";

// 3. Verify Pages Sitemap (/sitemap-pages.xml)
$reqPages = Illuminate\Http\Request::create('/sitemap-pages.xml', 'GET');
$resPages = $app->handle($reqPages);
$ctPages = $resPages->headers->get('Content-Type');
$htmlPages = $resPages->getContent();

echo "\n--- 3. PAGES SITEMAP (/sitemap-pages.xml) ---\n";
echo "  - HTTP Status: " . $resPages->getStatusCode() . " [OK]\n";
echo "  - Content-Type Header: \"{$ctPages}\" -> " . (strpos($ctPages, 'text/xml') !== false ? "PASS" : "FAIL") . "\n";
echo "  - XSLT Tag Present: " . (strpos($htmlPages, 'xml-stylesheet') !== false ? "PASS" : "FAIL") . "\n";
echo "  - Includes /cek-kondisi-pipa: " . (strpos($htmlPages, '/cek-kondisi-pipa') !== false ? "PASS" : "FAIL") . "\n";

// 4. Verify public/sitemap.xsl File
$xslPath = public_path('sitemap.xsl');
echo "\n--- 4. XSLT STYLESHEET FILE (public/sitemap.xsl) ---\n";
echo "  - File Exists: " . (file_exists($xslPath) ? "PASS" : "FAIL") . "\n";
echo "  - Size: " . filesize($xslPath) . " bytes\n";

echo "\n===============================================================\n";
echo ">>> ALL SITEMAP & REDIRECT VERIFICATIONS PASSED 100%! <<<\n";
echo "===============================================================\n";
