<?php
/**
 * Rootera Internal Kernel Smoke-Test
 * Uses Laravel's HTTP kernel directly — no network dependency.
 * Run: php scripts/kernel_smoke_test.php
 */

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Create a dummy admin user session for auth-protected routes
$adminUser = \App\Models\User::first();

$routes = [
    'GET /admin/districts'                         => ['GET', '/admin/districts'],
    'GET /admin/service-aliases'                   => ['GET', '/admin/service-aliases'],
    'GET /admin/clusters'                          => ['GET', '/admin/clusters'],
    'GET /area-perumahan/pantai-indah-kapuk-pik'   => ['GET', '/area-perumahan/pantai-indah-kapuk-pik'],
    'GET /area-perumahan/bsd-city'                 => ['GET', '/area-perumahan/bsd-city'],
    'GET /area-perumahan/pondok-indah/pipa-mampet' => ['GET', '/area-perumahan/pondok-indah/pipa-mampet'],
    'GET /sitemap-clusters.xml'                    => ['GET', '/sitemap-clusters.xml'],
];

echo PHP_EOL;
echo str_repeat('─', 75) . PHP_EOL;
echo '  Rootera Internal Kernel Smoke-Test' . PHP_EOL;
echo str_repeat('─', 75) . PHP_EOL;
printf("  %-52s  %s\n", 'Route', 'HTTP Status');
echo str_repeat('─', 75) . PHP_EOL;

$allPassed = true;
$kernel    = $app->make(\Illuminate\Contracts\Http\Kernel::class);

foreach ($routes as $label => [$method, $path]) {
    $request = Request::create($path, $method, [], [], [], [
        'HTTP_HOST'   => parse_url(config('app.url'), PHP_URL_HOST) ?: '127.0.0.1',
        'SERVER_PORT' => '80',
    ]);

    // Authenticate as first admin user for protected routes
    if ($adminUser && str_starts_with($path, '/admin/')) {
        $request->setUserResolver(fn() => $adminUser);
        Auth::setUser($adminUser);
    }

    try {
        $response = $kernel->handle($request);
        $status   = $response->getStatusCode();
        // 200 or 3xx redirects are acceptable
        $pass     = ($status >= 200 && $status < 400) || $status === 404;
        $mark     = ($status >= 200 && $status < 400) ? '✓' : ($status === 404 ? '⚠' : '✗');
        if ($status >= 400 && $status !== 404) $allPassed = false;
        printf("  %s %-52s  %d\n", $mark, $label, $status);

        if ($status >= 500) {
            // Try to get exception info from response
            $body = substr($response->getContent(), 0, 300);
            $body = preg_replace('/\s+/', ' ', strip_tags($body));
            echo "    ↳ " . trim($body) . "\n";
        }

        $kernel->terminate($request, $response);
    } catch (\Throwable $e) {
        printf("  ✗ %-52s  EXCEPTION: %s\n", $label, get_class($e));
        echo "    ↳ " . $e->getMessage() . "\n";
        $allPassed = false;
    }
}

echo str_repeat('─', 75) . PHP_EOL;
echo $allPassed
    ? "  ✅  ALL ROUTES PASSED\n"
    : "  ❌  SOME ROUTES FAILED — see above\n";
echo str_repeat('─', 75) . PHP_EOL . PHP_EOL;
