<?php
/**
 * Check exact bytes at the start of each sitemap response.
 * Specifically detect BOM, leading whitespace, or wrong characters before <?xml
 */
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

$routes = ['/sitemap.xml', '/sitemap-clusters.xml', '/sitemap-pages.xml'];

foreach ($routes as $path) {
    $req  = \Illuminate\Http\Request::create($path, 'GET');
    $resp = $kernel->handle($req);
    $body = $resp->getContent();

    // Check for BOM
    $hasBom = (substr($body, 0, 3) === "\xEF\xBB\xBF");
    // Check bytes before <?xml
    $xmlPos = strpos($body, '<?xml');
    $leadingChars = ($xmlPos !== false && $xmlPos > 0) ? $xmlPos : 0;

    // Hex dump first 20 bytes
    $hex = '';
    for ($i = 0; $i < min(20, strlen($body)); $i++) {
        $hex .= sprintf('%02X ', ord($body[$i]));
    }

    echo "Route: $path\n";
    echo "  Length    : " . strlen($body) . " bytes\n";
    echo "  Has BOM   : " . ($hasBom ? 'YES ⚠' : 'No') . "\n";
    echo "  <?xml pos : $xmlPos" . ($leadingChars > 0 ? " ⚠ ($leadingChars chars before <?xml)" : ' (correct)') . "\n";
    echo "  First 20B : $hex\n";
    echo "  First 100 : " . addcslashes(substr($body, 0, 100), "\r\n\0") . "\n\n";

    $kernel->terminate($req, $resp);
}
echo "Done.\n";
