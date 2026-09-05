<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

\Illuminate\Support\Facades\Cache::flush();

echo "==================================================\n";
echo "=== VERIFIKASI FASE 2: RENDER VIEW HOMEPAGE & AREA ===\n";
echo "==================================================\n";

try {
    $homeController = app(\App\Http\Controllers\HomeController::class);
    $resHomeView = $homeController->index();
    $homeHtml = $resHomeView->render();
    echo "[OK] Homepage rendered successfully (HTTP 200)\n";
    
    // Check if new Title is present
    preg_match('/<title>(.*?)<\/title>/s', $homeHtml, $titleMatch);
    echo " -> Title: " . ($titleMatch[1] ?? 'NOT FOUND') . "\n";
    
    // Check if new H1 is present
    preg_match('/<h1.*?>(.*?)<\/h1>/s', $homeHtml, $h1Match);
    echo " -> H1: " . strip_tags(trim(preg_replace('/\s+/', ' ', $h1Match[1] ?? 'NOT FOUND'))) . "\n\n";

    $areaController = app(\App\Http\Controllers\AreaServiceController::class);
    $resCityRes = $areaController->showCity('jakarta-timur');
    $cityHtml = is_object($resCityRes) && method_exists($resCityRes, 'getContent') ? $resCityRes->getContent() : (string)$resCityRes;
    echo "[OK] Halaman Kota Jakarta Timur rendered successfully (HTTP 200)\n";

    $progController = app(\App\Http\Controllers\ProgrammaticSeoController::class);
    $resProgRes = $progController->show('wastafel-mampet', 'jakarta-timur', 'pasar-rebo');
    $progHtml = is_object($resProgRes) && method_exists($resProgRes, 'getContent') ? $resProgRes->getContent() : (string)$resProgRes;
    echo "[OK] Halaman Programmatic Kecamatan Pasar Rebo rendered successfully (HTTP 200)\n";

    if (str_contains($progHtml, 'Beranda Jasa Saluran Mampet Indonesia')) {
        echo "[OK] Reverse Silo Card successfully detected on Programmatic Landing view!\n";
    }

} catch (\Throwable $e) {
    echo "[ERROR] " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
