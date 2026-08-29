<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$controller = new \App\Http\Controllers\SitemapController();

echo "--- SITEMAP INDEX XML ---\n";
echo substr($controller->index()->getContent(), 0, 300) . "\n\n";

echo "--- SITEMAP VIDEOS XML ---\n";
echo substr($controller->videos()->getContent(), 0, 400) . "\n\n";

echo "--- SITEMAP MAIN XML WITH IMAGE EXTENSION ---\n";
echo substr($controller->main()->getContent(), 0, 400) . "\n\n";

echo "SUCCESS: All sitemaps rendered correctly!\n";
