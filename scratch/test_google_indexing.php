<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

if (!class_exists('Google_Client') && class_exists('Google\Client')) {
    class_alias('Google\Client', 'Google_Client');
}

$keyPath = storage_path('app/google-indexing-key.json');
if (!file_exists($keyPath)) {
    $files = glob(storage_path('app/rootera-indexing-*.json'));
    if (!empty($files)) {
        $keyPath = $files[0];
    }
}

echo "Using key file: " . $keyPath . PHP_EOL;

$client = new \Google\Client();
$client->setAuthConfig($keyPath);
$client->addScope('https://www.googleapis.com/auth/indexing');

$httpClient = $client->authorize();

$testUrl = 'https://rooteraplumbing.id/jasa-saluran-mampet';
$endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';

try {
    $response = $httpClient->post($endpoint, [
        'json' => [
            'url' => $testUrl,
            'type' => 'URL_UPDATED'
        ]
    ]);

    echo "HTTP Status Code: " . $response->getStatusCode() . PHP_EOL;
    echo "Response Body: " . $response->getBody()->getContents() . PHP_EOL;
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
