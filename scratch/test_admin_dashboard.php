<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = \App\Models\User::first();
if ($user) {
    auth()->login($user);
    echo "Authenticated as: " . $user->name . "\n";
} else {
    echo "No user found in DB!\n";
}

$controller = new \App\Http\Controllers\Admin\DashboardController();
$response = $controller->index();
$html = $response->render();

echo "Dashboard HTML Length: " . strlen($html) . " bytes\n";
echo "Contains 'Pesanan / Kontak': " . (str_contains($html, 'Pesanan') ? 'YES' : 'NO') . "\n";
echo "Contains 'performanceChart': " . (str_contains($html, 'performanceChart') ? 'YES' : 'NO') . "\n";
echo "Contains 'realtime-clock': " . (str_contains($html, 'realtime-clock') ? 'YES' : 'NO') . "\n";
echo "Contains 'System Health': " . (str_contains($html, 'System Health') ? 'YES' : 'NO') . "\n";
echo "SUCCESS!\n";
