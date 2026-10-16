<?php
/**
 * Rootera Sitemap Comprehensive Validation Suite
 * ================================================
 * Tests each sitemap route for:
 *  - HTTP 200 status
 *  - Content-Type containing 'xml'
 *  - Body length > 500 bytes (not blank)
 *  - Valid XML parseable by simplexml_load_string()
 *  - Correct starting bytes (no BOM, no leading whitespace before <?xml)
 */
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

$routes = [
    '/sitemap.xml',
    '/sitemap-index.xml',
    '/sitemap-clusters.xml',
    '/sitemap-pages.xml',
    '/sitemap-services.xml',
    '/sitemap-cities.xml',
    '/sitemap-districts.xml',
    '/sitemap-blog.xml',
    '/sitemap-gallery.xml',
    '/sitemap-videos.xml',
];

$colW = [38, 8, 32, 14, 10];

echo PHP_EOL;
$sep = str_repeat('─', array_sum($colW) + count($colW) * 3 + 1);
echo $sep . PHP_EOL;
echo '  Rootera Sitemap Validation — ' . date('Y-m-d H:i:s') . PHP_EOL;
echo $sep . PHP_EOL;
printf("  %-{$colW[0]}s  %-{$colW[1]}s  %-{$colW[2]}s  %-{$colW[3]}s  %-{$colW[4]}s\n",
    'URL', 'HTTP', 'Content-Type', 'Size (bytes)', 'XML Valid');
echo $sep . PHP_EOL;

$allPass    = true;
$results    = [];

foreach ($routes as $path) {
    $req  = \Illuminate\Http\Request::create($path, 'GET');
    $resp = $kernel->handle($req);

    $status  = $resp->getStatusCode();
    $ct      = $resp->headers->get('Content-Type', '(none)');
    $body    = $resp->getContent();
    $size    = strlen($body);

    // Test 1: HTTP 200
    $t1 = ($status === 200);

    // Test 2: Content-Type contains xml
    $t2 = (str_contains(strtolower($ct), 'xml'));

    // Test 3: Body > 500 bytes
    $t3 = ($size > 500);

    // Test 4: Valid XML
    libxml_use_internal_errors(true);
    $xml = simplexml_load_string($body);
    $t4  = ($xml !== false);
    libxml_clear_errors();

    // Test 5: No BOM, no leading chars before <?xml
    $t5 = ($size > 0 && str_starts_with(ltrim($body), '<?xml'));
    // Also strictly check position 0
    $xmlPos = strpos($body, '<?xml');
    $t5strict = ($xmlPos === 0);

    $pass = $t1 && $t2 && $t3 && $t4 && $t5strict;
    if (!$pass) $allPass = false;

    $statusStr = $t1 ? "✓ $status" : "✗ $status";
    $ctShort   = strlen($ct) > 30 ? substr($ct, 0, 28) . '…' : $ct;
    $ctStr     = $t2 ? "✓ $ctShort" : "✗ $ctShort";
    $sizeStr   = $t3 ? "✓ " . number_format($size) : "✗ " . number_format($size);
    $xmlStr    = ($t4 && $t5strict) ? '✓ VALID' : '✗ INVALID';

    printf("  %-{$colW[0]}s  %-{$colW[1]}s  %-{$colW[2]}s  %{$colW[3]}s  %-{$colW[4]}s\n",
        $path, $statusStr, $ctStr, $sizeStr, $xmlStr);

    if (!$pass) {
        if (!$t4) {
            $errs = libxml_get_errors();
            foreach (array_slice($errs, 0, 2) as $e) {
                echo "    ↳ XML error: " . trim($e->message) . " (line {$e->line})\n";
            }
        }
        if (!$t5strict) {
            echo "    ↳ <?xml not at position 0 (found at pos $xmlPos)\n";
        }
    }

    $kernel->terminate($req, $resp);
}

echo $sep . PHP_EOL;
if ($allPass) {
    echo "  ✅  ALL SITEMAP TESTS PASSED\n";
} else {
    echo "  ❌  SOME SITEMAP TESTS FAILED — see above\n";
}
echo $sep . PHP_EOL . PHP_EOL;
