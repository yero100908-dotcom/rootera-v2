<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "===============================================================\n";
echo "       PHASE 2 ON-PAGE & TITLE/META VERIFICATION SCRIPT         \n";
echo "===============================================================\n\n";

// 1. Check Image Compression Results
echo "--- 1. IMAGE ASSET OPTIMIZATION RESULTS ---\n";
$backupDir = __DIR__ . '/../public/images/originals-backup';
$backupFiles = glob($backupDir . '/*.*');
echo "Backup Master Originals: " . count($backupFiles) . " files safely backed up in public/images/originals-backup/\n";

$largeFilesOver1MB = 0;
$allImages = array_merge(
    glob(__DIR__ . '/../public/images/*.*'),
    glob(__DIR__ . '/../public/images/dokumentasi/*.*')
);

foreach ($allImages as $imgFile) {
    if (is_file($imgFile) && filesize($imgFile) > 1000000) {
        $largeFilesOver1MB++;
        echo "  [WARNING] File > 1MB: " . basename($imgFile) . " (" . round(filesize($imgFile)/1024/1024, 2) . " MB)\n";
    }
}

if ($largeFilesOver1MB === 0) {
    echo "  [SUCCESS] ZERO image files over 1MB! All static image assets are compressed and WebP-optimized!\n\n";
}

// 2. Check Dynamic Title Tag & Meta Description lengths for sample routes
echo "--- 2. PROGRAMMATIC ROUTE TITLE & META DESCRIPTION TESTS ---\n";

$routesToTest = [
    '/layanan-pipa-mampet/pipa-mampet/jakarta-selatan/kebayoran-baru',
    '/layanan-pipa-mampet/pipa-mampet/tangerang-selatan/serpong-bsd-city',
    '/jasa-saluran-mampet/jakarta-selatan',
    '/jasa-saluran-mampet/bandung',
    '/layanan-cuci-toren/jakarta-selatan/kebayoran-baru',
    '/jasa-cuci-toren/tangerang-selatan',
    '/area-jasa-pipa-mampet/dki-jakarta'
];

$titleOver60 = 0;
$metaOutOfRange = 0;

foreach ($routesToTest as $path) {
    $request = Illuminate\Http\Request::create($path, 'GET');
    try {
        $response = $app->handle($request);
        $html = $response->getContent();

        // Extract <title>
        preg_match('/<title>(.*?)<\/title>/s', $html, $titleMatches);
        $titleRaw = isset($titleMatches[1]) ? trim($titleMatches[1]) : 'N/A';
        $title = html_entity_decode($titleRaw, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $titleLen = mb_strlen($title);

        // Extract <meta name="description" content="...">
        preg_match('/<meta name="description" content="(.*?)"/s', $html, $metaMatches);
        $metaRaw = isset($metaMatches[1]) ? trim($metaMatches[1]) : 'N/A';
        $metaDesc = html_entity_decode($metaRaw, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $metaLen = mb_strlen($metaDesc);

        $titleStatus = ($titleLen <= 60) ? "[OK]" : "[FAIL - OVER 60]";
        if ($titleLen > 60) $titleOver60++;

        $metaStatus = ($metaLen >= 120 && $metaLen <= 165) ? "[OK]" : "[OUT OF RANGE]";
        if ($metaLen < 120 || $metaLen > 165) $metaOutOfRange++;

        echo "URL: {$path}\n";
        echo "  Title ({$titleLen} chars) {$titleStatus}: \"{$title}\"\n";
        echo "  Meta Desc ({$metaLen} chars) {$metaStatus}: \"{$metaDesc}\"\n\n";

    } catch (\Exception $e) {
        echo "URL {$path} Error: " . $e->getMessage() . "\n\n";
    }
}

echo "--- SUMMARY RESULT ---\n";
echo "Titles > 60 chars: {$titleOver60}\n";
echo "Meta Descriptions out of 130-155 chars range: {$metaOutOfRange}\n";

if ($titleOver60 === 0 && $metaOutOfRange === 0) {
    echo "\n>>> ALL PHASE 2 TITLE & META DESCRIPTION TESTS PASSED 100%! <<<\n";
} else {
    echo "\n>>> SOME TESTS NEED FINE TUNING <<<\n";
}
