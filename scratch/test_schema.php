<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

\Illuminate\Support\Facades\Cache::flush();

$areaController = app(\App\Http\Controllers\AreaServiceController::class);
$progController = app(\App\Http\Controllers\ProgrammaticSeoController::class);

echo "=================================================================\n";
echo "=== TEST 1: SEMARANG (CABANG FISIK RIIL - LocalBusiness/Plumber) ===\n";
echo "=================================================================\n";
$res1 = $areaController->showCity('semarang');
preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $res1->getContent(), $matches1);
if (!empty($matches1[1])) {
    $schemaObj = json_decode($matches1[1][0]);
    echo json_encode($schemaObj, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n\n";
}

echo "=================================================================\n";
echo "=== TEST 2: SALATIGA (SAB / NON-BRANCH AREA - Service Schema) ===\n";
echo "=================================================================\n";
$res2 = $progController->show('wastafel-mampet', 'salatiga', null);
preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $res2->getContent(), $matches2);
if (!empty($matches2[1])) {
    $schemaObj2 = json_decode($matches2[1][0]);
    echo json_encode($schemaObj2, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n\n";
}
