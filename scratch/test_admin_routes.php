<?php

$baseUrl = 'http://127.0.0.1:8000';
$cookieFile = __DIR__ . '/cookie.txt';
if (file_exists($cookieFile)) unlink($cookieFile);

// 1. Get CSRF Token from login page
$ch = curl_init("{$baseUrl}/login");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
$loginPageHtml = curl_exec($ch);
curl_close($ch);

preg_match('/<input[^>]*name="_token"[^>]*value="([^"]+)"/', $loginPageHtml, $matches);
$csrfToken = $matches[1] ?? '';

// 2. Perform Login POST
$ch = curl_init("{$baseUrl}/login");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    '_token'   => $csrfToken,
    'email'    => 'admin@rootera.id',
    'password' => 'rootera2025',
]));
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$loginResult = curl_exec($ch);
curl_close($ch);

// 3. Test Admin Routes
$adminRoutes = [
    '/admin/dashboard',
    '/admin/technologies',
    '/admin/technologies/create',
    '/admin/articles',
    '/admin/service-categories',
    '/admin/service-areas',
    '/admin/gallery',
    '/admin/project-galleries',
    '/admin/contacts',
    '/admin/cities',
    '/admin/faqs',
    '/admin/partners',
    '/admin/service-sectors',
    '/admin/seo',
    '/admin/settings',
];

echo "=== RUNTIME SMOKE TESTING ADMIN ENDPOINTS (HTTP 200 OK) ===\n\n";

$allPassed = true;

foreach ($adminRoutes as $path) {
    $ch = curl_init("{$baseUrl}{$path}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $html = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        echo "✅ [200 OK] {$path}\n";
    } else {
        echo "❌ [{$httpCode}] {$path}\n";
        $allPassed = false;
    }
}

echo "\n=======================================================\n";
if ($allPassed) {
    echo "🎉 ALL " . count($adminRoutes) . " ADMIN ROUTES RETURNED STATUS 200 OK!\n";
} else {
    echo "⚠️ SOME ROUTES FAILED. CHECK CODES ABOVE.\n";
}

if (file_exists($cookieFile)) unlink($cookieFile);
