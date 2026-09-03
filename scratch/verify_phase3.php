<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "===============================================================\n";
echo "       PHASE 3 INTERNAL LINKING & LOCAL CRO VERIFICATION        \n";
echo "===============================================================\n\n";

$routesToTest = [
    '/layanan-pipa-mampet/pipa-mampet/jakarta-selatan/kebayoran-baru',
    '/jasa-saluran-mampet/jakarta-selatan',
    '/layanan-cuci-toren/jakarta-selatan/kebayoran-baru'
];

$failed = 0;

foreach ($routesToTest as $path) {
    echo "Testing Route: {$path}\n";
    $request = Illuminate\Http\Request::create($path, 'GET');
    try {
        $response = $app->handle($request);
        $html = $response->getContent();

        // 1. Check Visual Breadcrumb
        $hasBreadcrumbNav = (strpos($html, 'breadcrumb-nav') !== false || strpos($html, 'prog-breadcrumbs') !== false);
        echo "  - Visual HTML Breadcrumb: " . ($hasBreadcrumbNav ? "[OK]" : "[MISSING]") . "\n";
        if (!$hasBreadcrumbNav) $failed++;

        // 2. Check Local Micro Mesh Grid
        $hasMicroMesh = (strpos($html, 'local-mesh-section') !== false || strpos($html, 'spoke-grid') !== false);
        echo "  - Local Micro Mesh Grid: " . ($hasMicroMesh ? "[OK]" : "[MISSING]") . "\n";

        // 3. Check Floating WhatsApp & Sticky Mobile CTA Bar
        $hasWaFloat = (strpos($html, 'whatsapp-float') !== false);
        $hasStickyCta = (strpos($html, 'mobile-sticky-cta-bar') !== false);
        echo "  - Floating WhatsApp Component: " . ($hasWaFloat ? "[OK]" : "[MISSING]") . "\n";
        echo "  - Mobile Sticky CTA Bar Component: " . ($hasStickyCta ? "[OK]" : "[MISSING]") . "\n";
        if (!$hasWaFloat || !$hasStickyCta) $failed++;

        // 4. Extract WhatsApp Link Text Parameter
        preg_match('/wa\.me\/[0-9]+\?text=(.*?)"/s', $html, $waMatches);
        $waLinkParam = isset($waMatches[1]) ? urldecode($waMatches[1]) : 'N/A';
        echo "  - Dynamic WA Parameter: \"{$waLinkParam}\"\n\n";

    } catch (\Exception $e) {
        echo "  - Error: " . $e->getMessage() . "\n\n";
        $failed++;
    }
}

echo "===============================================================\n";
if ($failed === 0) {
    echo ">>> ALL PHASE 3 CRO & INTERNAL LINKING VERIFICATIONS PASSED 100%! <<<\n";
} else {
    echo ">>> SOME VERIFICATIONS FAILED ({$failed}) <<<\n";
}
echo "===============================================================\n";
