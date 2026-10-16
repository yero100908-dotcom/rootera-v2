<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Test 1: DB query — was it fixed?
try {
    $cats = \App\Models\ServiceCategory::where('is_active', true)
        ->orderBy('sort_order')
        ->get(['id', 'name', 'slug', 'icon', 'description']);
    echo "ServiceCategory query OK — " . $cats->count() . " categories\n";
} catch (\Throwable $e) {
    echo "ServiceCategory query FAILED: " . $e->getMessage() . "\n";
}

// Test 2: Cluster load
try {
    $cluster = \App\Models\ResidentialCluster::with([
        'city.province', 'district', 'districts',
        'projectGalleries' => fn($q) => $q->where('is_active', true)->latest()->take(6),
    ])->where('slug', 'pantai-indah-kapuk-pik')->where('is_active', true)->firstOrFail();
    echo "Cluster OK: {$cluster->name} | is_indexable=" . ($cluster->is_indexable ? 'true' : 'false') . "\n";
} catch (\Throwable $e) {
    echo "Cluster load FAILED: " . $e->getMessage() . "\n";
}

// Test 3: Full view render
try {
    $kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
    $req = \Illuminate\Http\Request::create('/area-perumahan/pantai-indah-kapuk-pik', 'GET');
    $resp = $kernel->handle($req);
    $code = $resp->getStatusCode();
    echo "Full route response: HTTP $code\n";
    if ($code >= 500) {
        // Grab error from exception handler
        $body = $resp->getContent();
        // Find the error message in the response
        preg_match('/<title>(.*?)<\/title>/s', $body, $m);
        echo "Title: " . ($m[1] ?? 'n/a') . "\n";
        preg_match('/Whoops.*?<\/p>/s', $body, $m2);
        if (!empty($m2)) echo "Error: " . strip_tags($m2[0]) . "\n";
        // Try to get exception from logs
        $logPath = storage_path('logs/laravel.log');
        if (file_exists($logPath)) {
            $lines = file($logPath);
            $last = array_slice($lines, -20);
            echo "Last log lines:\n" . implode('', $last);
        }
    }
    $kernel->terminate($req, $resp);
} catch (\Throwable $e) {
    echo "Route exception: " . get_class($e) . ": " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}

echo "Done.\n";
