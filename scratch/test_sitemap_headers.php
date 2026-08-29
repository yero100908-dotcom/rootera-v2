<?php

$sitemaps = [
    '/sitemap.xml',
    '/sitemap-cuci-toren-cities.xml',
    '/sitemap-cuci-toren-districts.xml',
];

echo "=====================================================\n";
echo "   TESTING SITEMAP HTTP HEADERS & XML PARSING VALIDITY\n";
echo "=====================================================\n\n";

$allPassed = true;

foreach ($sitemaps as $path) {
    $url = "http://127.0.0.1:8000{$path}";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    $response = curl_exec($ch);
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $headerText = substr($response, 0, $headerSize);
    $body = substr($response, $headerSize);

    // Extract Content-Type
    preg_match('/Content-Type:\s*(.+)/i', $headerText, $matches);
    $contentType = isset($matches[1]) ? trim($matches[1]) : 'N/A';

    // Validate XML Parsing
    libxml_use_internal_errors(true);
    $xmlDoc = simplexml_load_string($body);
    $xmlErrors = libxml_get_errors();
    libxml_clear_errors();

    if ($httpCode === 200 && empty($xmlErrors)) {
        echo "✅ [200 OK] {$path}\n";
        echo "   - Content-Type: {$contentType}\n";
        echo "   - XML Parsing: VALID XML (0 Errors)\n\n";
    } else {
        echo "❌ [{$httpCode}] {$path}\n";
        echo "   - Content-Type: {$contentType}\n";
        if (!empty($xmlErrors)) {
            echo "   - XML Errors: " . count($xmlErrors) . " error(s) found:\n";
            foreach ($xmlErrors as $err) {
                echo "     * Line {$err->line}: {$err->message}";
            }
        }
        echo "\n";
        $allPassed = false;
    }
}

echo "=====================================================\n";
if ($allPassed) {
    echo "🎉 ALL SITEMAPS PASSED 200 OK & 100% VALID XML PARSING!\n";
} else {
    echo "⚠️ SOME SITEMAPS FAILED VALIDATION!\n";
}
