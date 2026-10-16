<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

$tests = [
    'GET /area-perumahan/pantai-indah-kapuk-pik'   => '/area-perumahan/pantai-indah-kapuk-pik',
    'GET /area-perumahan/bsd-city'                 => '/area-perumahan/bsd-city',
    'GET /area-perumahan/pondok-indah/pipa-mampet' => '/area-perumahan/pondok-indah/pipa-mampet',
    'GET /sitemap-clusters.xml'                    => '/sitemap-clusters.xml',
];

foreach ($tests as $label => $path) {
    try {
        $req  = \Illuminate\Http\Request::create($path, 'GET');
        $resp = $kernel->handle($req);
        $code = $resp->getStatusCode();
        $mark = ($code >= 200 && $code < 400) ? 'PASS' : 'FAIL';
        echo "$mark [$code] $label\n";
        $kernel->terminate($req, $resp);
    } catch (\Throwable $e) {
        echo "FAIL [ERR] $label => " . get_class($e) . ': ' . $e->getMessage() . "\n";
    }
}
echo "Done.\n";
