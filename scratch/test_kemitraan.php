<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$controller = new \App\Http\Controllers\AboutController();
$response = $controller->portofolioKlien();

$html = $response->render();

echo "HTML Length: " . strlen($html) . " bytes\n";
echo "Contains 'Mie Gacoan': " . (str_contains($html, 'Mie Gacoan') ? 'YES' : 'NO') . "\n";
echo "Contains 'animate-marquee': " . (str_contains($html, 'animate-marquee') ? 'YES' : 'NO') . "\n";
echo "Contains 'Kemitraan & Portofolio': " . (str_contains($html, 'Kemitraan &amp; Portofolio') || str_contains($html, 'Kemitraan & Portofolio') ? 'YES' : 'NO') . "\n";
echo "SUCCESS!\n";
