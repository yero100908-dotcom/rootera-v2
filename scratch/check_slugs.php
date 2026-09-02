<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$emptySlugs = App\Models\Faq::whereNull('slug')->orWhere('slug', '')->get();
echo 'EMPTY SLUGS COUNT: ' . $emptySlugs->count() . PHP_EOL;

foreach ($emptySlugs as $f) {
    echo 'ID: ' . $f->id . ' Q: ' . $f->question . PHP_EOL;
    // Auto-fix slug
    $f->slug = \Illuminate\Support\Str::slug($f->question);
    $f->save();
    echo 'FIXED SLUG: ' . $f->slug . PHP_EOL;
}
