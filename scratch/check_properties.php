<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$properties = \App\Models\PropertyType::all(['id', 'name', 'slug']);
foreach ($properties as $p) {
    echo "ID: {$p->id} | Name: {$p->name} | Slug: {$p->slug}\n";
}
