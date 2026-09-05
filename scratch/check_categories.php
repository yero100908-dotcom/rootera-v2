<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\ServiceCategory;

foreach (ServiceCategory::all() as $c) {
    $img = $c->image;
    $assetUrl = asset('storage/' . $img);
    $path = public_path('storage/' . $img);
    $exists = file_exists($path) ? 'EXISTS' : 'MISSING';
    echo "Slug: {$c->slug} | DB image: {$img} | Local Path: {$path} | {$exists}\n";
}
    