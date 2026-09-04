<?php
$ctx = stream_context_create(['http' => ['timeout' => 5]]);
$urls = ['http://127.0.0.1:8000', 'http://localhost:8000', 'http://rooteraplumbing.test'];
$html = false;

foreach ($urls as $url) {
    $res = @file_get_contents($url, false, $ctx);
    if ($res !== false) {
        echo "Successfully fetched local server from: " . $url . " (" . strlen($res) . " bytes)\n";
        $html = $res;
        file_put_contents(__DIR__ . '/live_homepage.html', $res);
        break;
    }
}

if (!$html) {
    echo "Could not connect to dev server on 8000. Compiling view using Blade/Laravel CLI if possible or checking files directly.\n";
    exit;
}

require __DIR__ . '/parse_homepage.php';
