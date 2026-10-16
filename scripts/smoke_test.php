<?php
/**
 * Rootera HTTP smoke-test
 * Run: php scripts/smoke_test.php
 *
 * Requires the local dev server to be accessible.
 */

$baseUrl = rtrim(env_base_url(), '/');

function env_base_url(): string
{
    // Read APP_URL from .env
    $envFile = __DIR__ . '/../.env';
    if (file_exists($envFile)) {
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (str_starts_with(trim($line), 'APP_URL=')) {
                return trim(substr($line, strpos($line, '=') + 1), " \t\n\r\0\x0B\"'");
            }
        }
    }
    return 'http://localhost';
}

$routes = [
    'GET /admin/districts'                              => '/admin/districts',
    'GET /admin/service-aliases'                        => '/admin/service-aliases',
    'GET /admin/clusters'                               => '/admin/clusters',
    'GET /area-perumahan/pantai-indah-kapuk-pik'        => '/area-perumahan/pantai-indah-kapuk-pik',
    'GET /area-perumahan/bsd-city'                      => '/area-perumahan/bsd-city',
    'GET /area-perumahan/pondok-indah/pipa-mampet'      => '/area-perumahan/pondok-indah/pipa-mampet',
    'GET /sitemap-clusters.xml'                         => '/sitemap-clusters.xml',
];

echo PHP_EOL;
echo str_repeat('─', 75) . PHP_EOL;
echo "  Rootera HTTP Smoke-Test  |  Base: {$baseUrl}" . PHP_EOL;
echo str_repeat('─', 75) . PHP_EOL;
printf("  %-52s  %s\n", 'Route', 'HTTP Status');
echo str_repeat('─', 75) . PHP_EOL;

$allPassed = true;

foreach ($routes as $label => $path) {
    $url = $baseUrl . $path;
    $ch  = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_MAXREDIRS      => 5,
        CURLOPT_TIMEOUT        => 15,
        CURLOPT_HTTPHEADER     => ['Accept: text/html'],
        CURLOPT_USERAGENT      => 'Rootera-SmokeTest/1.0',
        // Follow auth redirects but report the FINAL status
        CURLOPT_COOKIEJAR      => '',
    ]);
    curl_exec($ch);
    $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $final  = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    $err    = curl_error($ch);
    curl_close($ch);

    if ($err) {
        $statusStr = "ERR: {$err}";
        $mark = '✗';
        $allPassed = false;
    } else {
        $statusStr = (string) $status;
        // 200 = pass; 302/301 redirect to login counts as "accessible" (auth gate working as expected)
        $mark = ($status === 200 || $status === 302 || $status === 301) ? '✓' : '✗';
        if ($mark === '✗') $allPassed = false;
    }

    printf("  %s %-52s  %s\n", $mark, $label, $statusStr);
}

echo str_repeat('─', 75) . PHP_EOL;
echo $allPassed
    ? "  ✅  ALL ROUTES PASSED\n"
    : "  ❌  SOME ROUTES FAILED — see above\n";
echo str_repeat('─', 75) . PHP_EOL . PHP_EOL;
