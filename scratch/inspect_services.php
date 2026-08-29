<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\ServiceCategory;
use App\Models\Service;

echo "--- SERVICE CATEGORIES ---\n";
$cats = ServiceCategory::orderBy('sort_order')->get();
foreach ($cats as $c) {
    echo "ID: {$c->id} | Name: {$c->name} | Slug: {$c->slug} | Sort: {$c->sort_order}\n";
}

echo "\n--- SERVICES ---\n";
$srvs = Service::orderBy('sort_order')->get();
foreach ($srvs as $s) {
    echo "ID: {$s->id} | Name: {$s->name} | Slug: {$s->slug} | CatID: {$s->service_category_id} | Sort: {$s->sort_order}\n";
}
