<?php

declare(strict_types=1);

/**
 * Rootera Sitemap Automated Compliance & Validation Test Script
 * ==============================================================
 * Validates Google Search Console compliance requirements:
 * 1. GET /sitemap.xml returns HTTP 200, Content-Type containing text/xml, and <sitemapindex>.
 * 2. GET /sitemap-clusters.xml returns HTTP 200, Content-Type containing xml, and <urlset>.
 * 3. Extracts ALL <sitemap><loc> referenced in master index and tests each:
 *    - HTTP 200
 *    - Byte length > 200
 *    - Valid XML parseable by simplexml_load_string() with zero errors
 * 4. Ensures sitemap-clusters.xml is explicitly present in the master index.
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

$colW = [38, 8, 30, 14, 12, 10];
$sep = str_repeat('─', array_sum($colW) + count($colW) * 2 + 2);

echo PHP_EOL . $sep . PHP_EOL;
echo "  Rootera Plumbing — Technical SEO Sitemap Compliance Test" . PHP_EOL;
echo "  Timestamp: " . date('Y-m-d H:i:s T') . PHP_EOL;
echo $sep . PHP_EOL;
printf("  %-{$colW[0]}s  %-{$colW[1]}s  %-{$colW[2]}s  %{$colW[3]}s  %-{$colW[4]}s  %-{$colW[5]}s\n",
    'Sitemap Route', 'HTTP', 'Content-Type', 'Bytes', 'Root Node', 'XML Valid');
echo $sep . PHP_EOL;

$allPass = true;
$failures = [];

// 1. Fetch Master Sitemap Index (/sitemap.xml)
$req = \Illuminate\Http\Request::create('/sitemap.xml', 'GET');
$resp = $kernel->handle($req);
$status = $resp->getStatusCode();
$ct = $resp->headers->get('Content-Type', '');
$content = $resp->getContent();
$len = strlen($content);
$kernel->terminate($req, $resp);

libxml_use_internal_errors(true);
$masterXml = simplexml_load_string($content);
$xmlErrors = libxml_get_errors();
libxml_clear_errors();

$isMasterValidXml = ($masterXml !== false && empty($xmlErrors));
$rootName = $masterXml ? $masterXml->getName() : '(invalid)';

$masterPass = ($status === 200) &&
              (str_contains(strtolower($ct), 'xml')) &&
              ($rootName === 'sitemapindex') &&
              ($len > 200) &&
              $isMasterValidXml;

if (!$masterPass) {
    $allPass = false;
    $failures[] = "Master /sitemap.xml failed checks (HTTP: $status, Root: $rootName, XML Valid: " . ($isMasterValidXml ? 'yes' : 'no') . ")";
}

printf("  %-{$colW[0]}s  %-{$colW[1]}s  %-{$colW[2]}s  %{$colW[3]}s  %-{$colW[4]}s  %-{$colW[5]}s\n",
    '/sitemap.xml [MASTER]',
    $status === 200 ? "✓ $status" : "✗ $status",
    str_contains(strtolower($ct), 'xml') ? '✓ ' . substr($ct, 0, 26) : "✗ $ct",
    '✓ ' . number_format($len),
    $rootName === 'sitemapindex' ? '✓ sitemapindex' : "✗ $rootName",
    $isMasterValidXml ? '✓ VALID' : '✗ INVALID'
);

// 2. Extract all sub-sitemaps from master index
$subSitemaps = [];
if ($masterXml && isset($masterXml->sitemap)) {
    foreach ($masterXml->sitemap as $sm) {
        $loc = (string) $sm->loc;
        $path = parse_url($loc, PHP_URL_PATH);
        if ($path) {
            $subSitemaps[] = $path;
        }
    }
}

// Check mandatory presence of sitemap-clusters.xml
$clustersIncludedInMaster = in_array('/sitemap-clusters.xml', $subSitemaps, true);
if (!$clustersIncludedInMaster) {
    $allPass = false;
    $failures[] = "MANDATORY: /sitemap-clusters.xml is MISSING from /sitemap.xml master index!";
}

echo $sep . PHP_EOL;
echo "  Discovered " . count($subSitemaps) . " sub-sitemaps in master index:" . PHP_EOL;
echo $sep . PHP_EOL;

// 3. Test each sub-sitemap
foreach ($subSitemaps as $path) {
    $subReq = \Illuminate\Http\Request::create($path, 'GET');
    $subResp = $kernel->handle($subReq);
    $subStatus = $subResp->getStatusCode();
    $subCt = $subResp->headers->get('Content-Type', '');
    $subBody = $subResp->getContent();
    $subLen = strlen($subBody);
    $kernel->terminate($subReq, $subResp);

    libxml_use_internal_errors(true);
    $subXml = simplexml_load_string($subBody);
    $subXmlErrs = libxml_get_errors();
    libxml_clear_errors();

    $isSubValid = ($subXml !== false && empty($subXmlErrs));
    $subRoot = $subXml ? $subXml->getName() : '(invalid)';

    $pass = ($subStatus === 200) &&
            (str_contains(strtolower($subCt), 'xml')) &&
            ($subLen > 200) &&
            $isSubValid &&
            ($subRoot === 'urlset');

    if (!$pass) {
        $allPass = false;
        $failures[] = "Sub-sitemap $path failed checks (HTTP: $subStatus, Bytes: $subLen, Root: $subRoot, Valid: " . ($isSubValid ? 'yes' : 'no') . ")";
    }

    $ctShort = strlen($subCt) > 28 ? substr($subCt, 0, 26) . '…' : $subCt;
    printf("  %-{$colW[0]}s  %-{$colW[1]}s  %-{$colW[2]}s  %{$colW[3]}s  %-{$colW[4]}s  %-{$colW[5]}s\n",
        $path,
        $subStatus === 200 ? "✓ $subStatus" : "✗ $subStatus",
        str_contains(strtolower($subCt), 'xml') ? "✓ $ctShort" : "✗ $ctShort",
        $subLen > 200 ? '✓ ' . number_format($subLen) : '✗ ' . number_format($subLen),
        $subRoot === 'urlset' ? '✓ urlset' : "✗ $subRoot",
        $isSubValid ? '✓ VALID' : '✗ INVALID'
    );
}

// 4. Parity test /sitemap-index.xml
$indexReq = \Illuminate\Http\Request::create('/sitemap-index.xml', 'GET');
$indexResp = $kernel->handle($indexReq);
$indexStatus = $indexResp->getStatusCode();
$indexCt = $indexResp->headers->get('Content-Type', '');
$indexBody = $indexResp->getContent();
$indexLen = strlen($indexBody);
$kernel->terminate($indexReq, $indexResp);

libxml_use_internal_errors(true);
$idxXml = simplexml_load_string($indexBody);
$idxXmlErrs = libxml_get_errors();
libxml_clear_errors();
$idxValid = ($idxXml !== false && empty($idxXmlErrs));
$idxRoot = $idxXml ? $idxXml->getName() : '(invalid)';

printf("  %-{$colW[0]}s  %-{$colW[1]}s  %-{$colW[2]}s  %{$colW[3]}s  %-{$colW[4]}s  %-{$colW[5]}s\n",
    '/sitemap-index.xml [ALIAS]',
    $indexStatus === 200 ? "✓ $indexStatus" : "✗ $indexStatus",
    str_contains(strtolower($indexCt), 'xml') ? '✓ ' . substr($indexCt, 0, 26) : "✗ $indexCt",
    $indexLen > 200 ? '✓ ' . number_format($indexLen) : '✗ ' . number_format($indexLen),
    $idxRoot === 'sitemapindex' ? '✓ sitemapindex' : "✗ $idxRoot",
    $idxValid ? '✓ VALID' : '✗ INVALID'
);

echo $sep . PHP_EOL;

if ($allPass && $clustersIncludedInMaster) {
    echo "  ✅  AUDIT RESULT: 100% PASS — ALL SITEMAPS FULLY COMPLIANT WITH GSC STANDARDS\n";
    echo "      • /sitemap.xml returns HTTP 200 with valid <sitemapindex>\n";
    echo "      • /sitemap-clusters.xml is registered in master index and returns valid <urlset>\n";
    echo "      • All " . count($subSitemaps) . " sub-sitemaps return HTTP 200, valid XML, and byte size > 200 bytes\n";
    echo "      • Zero XML syntax errors across all endpoints\n";
} else {
    echo "  ❌  AUDIT RESULT: FAILED CHECKS:\n";
    foreach ($failures as $f) {
        echo "      - $f\n";
    }
}
echo $sep . PHP_EOL . PHP_EOL;

exit($allPass ? 0 : 1);
