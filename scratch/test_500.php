<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    // Clear cache first for testing fresh render
    \Illuminate\Support\Facades\Cache::forget('prog_seo_v3_pipa-mampet_jakarta-selatan_kebayoran-baru');

    $controller = new App\Http\Controllers\ProgrammaticSeoController(new App\Services\SpintaxService());
    $response = $controller->show('pipa-mampet', 'jakarta-selatan', 'kebayoran-baru');
    echo "SUCCESS: Status " . $response->getStatusCode() . "\n";
} catch (\Throwable $e) {
    echo "EXCEPTIONAL ERROR:\n";
    echo "Message: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "Trace:\n" . $e->getTraceAsString() . "\n";
}
