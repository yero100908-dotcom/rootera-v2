<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$request = Illuminate\Http\Request::create('/cek-kondisi-pipa', 'GET');
$html = $app->handle($request)->getContent();

preg_match_all('/<link[^>]+>/i', $html, $matches);
echo "=== LINK TAGS IN HEAD ===\n";
foreach ($matches[0] as $link) {
    echo "  " . $link . "\n";
}

preg_match_all('/<script[^>]+>.*?<\/script>/is', $html, $scriptMatches);
echo "\n=== SCRIPT TAGS IN HEAD ===\n";
foreach ($scriptMatches[0] as $script) {
    if (strpos($script, 'build') !== false || strpos($script, 'vite') !== false || strpos($script, 'app') !== false) {
        echo "  " . substr($script, 0, 150) . "\n";
    }
}
