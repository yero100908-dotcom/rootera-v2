<?php
/**
 * Deep sitemap audit:
 *  - Checks /sitemap.xml contains <sitemapindex> (not <urlset>, not HTML)
 *  - Checks /sitemap-clusters.xml contains <urlset>
 *  - Reads ALL <loc> entries from /sitemap.xml and verifies each sub-sitemap
 *    returns HTTP 200 with body > 200 bytes and valid XML
 *  - Reports whether public/sitemap.xml exists and its size (shadowing check)
 *  - Confirms Content-Type on every response
 */
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

// ── 1. Shadow check ──────────────────────────────────────────────────────────
$shadowFile = public_path('sitemap.xml');
echo "\n=== 1. FILE SHADOWING CHECK ===\n";
if (file_exists($shadowFile)) {
    $size = filesize($shadowFile);
    echo "  ⚠  public/sitemap.xml EXISTS ($size bytes) — may shadow the route!\n";
    if ($size === 0) {
        echo "  ✗  File is 0 bytes — THIS is the blank page cause!\n";
    }
} else {
    echo "  ✓  public/sitemap.xml does NOT exist — no shadowing.\n";
}

// All public XML files
echo "\n  Public XML files in public/:\n";
foreach (glob(public_path('*.xml')) as $f) {
    echo "    " . basename($f) . " (" . filesize($f) . " bytes)\n";
}

// ── 2. Master index structure check ──────────────────────────────────────────
echo "\n=== 2. MASTER /sitemap.xml STRUCTURE ===\n";
$req  = \Illuminate\Http\Request::create('/sitemap.xml', 'GET');
$resp = $kernel->handle($req);
$body = $resp->getContent();
$kernel->terminate($req, $resp);

echo "  HTTP Status : " . $resp->getStatusCode() . "\n";
echo "  Content-Type: " . $resp->headers->get('Content-Type') . "\n";
echo "  Size        : " . number_format(strlen($body)) . " bytes\n";

// Check root element
libxml_use_internal_errors(true);
$xml = simplexml_load_string($body);
if ($xml === false) {
    echo "  ✗ XML parse FAILED:\n";
    foreach (libxml_get_errors() as $e) echo "     " . trim($e->message) . "\n";
    libxml_clear_errors();
} else {
    $rootTag = $xml->getName();
    echo "  Root element: <$rootTag>\n";
    if ($rootTag === 'sitemapindex') {
        echo "  ✓ Correct: <sitemapindex>\n";
    } elseif ($rootTag === 'urlset') {
        echo "  ✗ Wrong root: <urlset> — should be <sitemapindex>!\n";
    } else {
        echo "  ✗ Unexpected root: <$rootTag>\n";
    }

    // Extract all <loc> from the sitemapindex
    $locs = [];
    foreach ($xml->sitemap as $sm) {
        $locs[] = (string)$sm->loc;
    }
    echo "  Sub-sitemaps listed: " . count($locs) . "\n";
    foreach ($locs as $loc) {
        echo "    - $loc\n";
    }

    // Check for sitemap-clusters.xml
    $hasClusters = count(array_filter($locs, fn($l) => str_contains($l, 'sitemap-clusters'))) > 0;
    echo "  sitemap-clusters.xml registered: " . ($hasClusters ? "✓ YES" : "✗ MISSING!") . "\n";
}

// ── 3. /sitemap-clusters.xml structure check ─────────────────────────────────
echo "\n=== 3. /sitemap-clusters.xml STRUCTURE ===\n";
$req2  = \Illuminate\Http\Request::create('/sitemap-clusters.xml', 'GET');
$resp2 = $kernel->handle($req2);
$body2 = $resp2->getContent();
$kernel->terminate($req2, $resp2);

echo "  HTTP Status : " . $resp2->getStatusCode() . "\n";
echo "  Content-Type: " . $resp2->headers->get('Content-Type') . "\n";
echo "  Size        : " . number_format(strlen($body2)) . " bytes\n";

$xml2 = simplexml_load_string($body2);
if ($xml2 === false) {
    echo "  ✗ XML parse FAILED\n";
} else {
    $rootTag2 = $xml2->getName();
    echo "  Root element: <$rootTag2>\n";
    echo "  " . ($rootTag2 === 'urlset' ? "✓ Correct: <urlset>" : "✗ Wrong root!") . "\n";
    $urlCount = count($xml2->url);
    echo "  URL entries: $urlCount\n";
}

// ── 4. Validate all sub-sitemaps from master index ───────────────────────────
echo "\n=== 4. SUB-SITEMAP VALIDATION ===\n";
if (!empty($locs)) {
    printf("  %-50s  %6s  %12s  %s\n", 'Sub-sitemap', 'HTTP', 'Size', 'XML');
    echo "  " . str_repeat('─', 80) . "\n";
    foreach ($locs as $loc) {
        // Extract path from full URL
        $parsed = parse_url($loc);
        $path = $parsed['path'] ?? $loc;
        $req3  = \Illuminate\Http\Request::create($path, 'GET');
        $resp3 = $kernel->handle($req3);
        $b3    = $resp3->getContent();
        $code3 = $resp3->getStatusCode();
        $size3 = strlen($b3);
        libxml_use_internal_errors(true);
        $xml3  = simplexml_load_string($b3);
        $valid = ($xml3 !== false) ? '✓ valid' : '✗ INVALID';
        libxml_clear_errors();
        $pass = ($code3 === 200 && $size3 > 200 && $xml3 !== false);
        $mark = $pass ? '✓' : '✗';
        printf("  %s %-48s  %6s  %12s  %s\n",
            $mark, basename($path), $code3, number_format($size3), $valid);
        $kernel->terminate($req3, $resp3);
    }
}

echo "\n=== 5. XSL STYLESHEET CHECK ===\n";
$req4  = \Illuminate\Http\Request::create('/sitemap.xsl', 'GET');
$resp4 = $kernel->handle($req4);
echo "  /sitemap.xsl HTTP: " . $resp4->getStatusCode() . "\n";
echo "  Content-Type: " . $resp4->headers->get('Content-Type') . "\n";
echo "  Size: " . number_format(strlen($resp4->getContent())) . " bytes\n";
$kernel->terminate($req4, $resp4);

echo "\nDone.\n";
