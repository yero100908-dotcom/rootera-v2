<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Total Technologies in DB: " . \App\Models\Technology::count() . "\n\n";

foreach (\App\Models\Technology::all() as $t) {
    echo "ID: {$t->id}\n";
    echo "Nama: {$t->tool_name}\n";
    echo "Brand: {$t->type_brand}\n";
    echo "Image Path: {$t->image_path}\n";
    echo "Image URL: {$t->image_url}\n";
    echo "----------------------------------------\n";
}
