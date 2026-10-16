<?php
/**
 * Sitemap diagnostic: exactly what does each sitemap route return?
 */
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

$routes = [
    '/sitemap.xml',
    '/sitemap-index.xml',
    '/sitemap-clusters.xml',
    '/sitemap-pages.xml',
    '/sitemap-services.xml',
];

foreach ($routes as $path) {
    $req  = \Illuminate\Http\Request::create($path, 'GET');
    $resp = $kernel->handle($req);
    $code = $resp->getStatusCode();
    $ct   = $resp->headers->get('Content-Type', '(none)');
    $body = $resp->getContent();
    $len  = strlen($body);
    $first50 = addcslashes(substr($body, 0, 80), "\r\n\t");
    echo sprintf("[%d] %-35s  CT=%-30s  len=%d  body_start='%s'\n",
        $code, $path, $ct, $len, $first50);
    $kernel->terminate($req, $resp);
}
echo "Done.\n";
