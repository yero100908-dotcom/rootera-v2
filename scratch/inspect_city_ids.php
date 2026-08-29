<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Province;
use App\Models\City;

$cities = City::with('province')->orderBy('province_id')->orderBy('name')->get();

echo "ID  | TYPE | NAME | SLUG | PROVINCE\n";
echo "--------------------------------------------------------\n";
foreach ($cities as $c) {
    echo sprintf("%3d | %-9s | %-25s | %-25s | %s\n", $c->id, $c->type ?? 'Kota', $c->name, $c->slug, $c->province ? $c->province->name : 'N/A');
}
