<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$deleted = App\Models\Faq::whereNull('slug')->orWhere('slug', '')->delete();
echo "DELETED STALE RECORDS: " . $deleted . PHP_EOL;
