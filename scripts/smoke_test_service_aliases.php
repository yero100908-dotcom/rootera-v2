<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

echo "=== TEST 1: ServiceAlias Model & Scopes ===\n";
use App\Models\ServiceAlias;
use App\Models\ServiceCategory;
use App\Services\SpintaxService;
use App\Services\Seo\SchemaGeneratorService;
use Illuminate\Http\Request;

$landingCount = ServiceAlias::active()->landingPage()->count();
$copyCount    = ServiceAlias::active()->copyOnly()->count();
echo "Active Landing Page Aliases: {$landingCount}\n";
echo "Active Copy Only Aliases:    {$copyCount}\n";
if ($landingCount === 0 || $copyCount === 0) {
    throw new RuntimeException("Seeder did not populate aliases properly!");
}
echo "✓ Test 1 Passed.\n\n";

echo "=== TEST 2: Route /layanan/paralon-mampet (Landing Page via Alias) ===\n";
$req1 = Request::create('/layanan/paralon-mampet', 'GET');
$resp1 = $kernel->handle($req1);
echo "Status: " . $resp1->getStatusCode() . "\n";
if ($resp1->getStatusCode() !== 200) {
    throw new RuntimeException("Route /layanan/paralon-mampet failed with status {$resp1->getStatusCode()}");
}
$content1 = $resp1->getContent();
$hasIntro = str_contains($content1, 'pipa paralon PVC mampet');
$hasFaq   = str_contains($content1, 'Apakah pelancaran paralon mampet merusak pipa PVC?');
$hasCanonical = str_contains($content1, '/layanan/paralon-mampet');
echo "Has Intro Override: " . ($hasIntro ? "YES" : "NO") . "\n";
echo "Has FAQ Override:   " . ($hasFaq ? "YES" : "NO") . "\n";
echo "Has Canonical:      " . ($hasCanonical ? "YES" : "NO") . "\n";
if (!$hasIntro || !$hasFaq || !$hasCanonical) {
    throw new RuntimeException("Content verification failed for /layanan/paralon-mampet");
}
echo "✓ Test 2 Passed.\n\n";

echo "=== TEST 3: Route /layanan/pipa-mampet (Original Category Backward Compatibility) ===\n";
$req2 = Request::create('/layanan/pipa-mampet', 'GET');
$resp2 = $kernel->handle($req2);
echo "Status: " . $resp2->getStatusCode() . "\n";
if ($resp2->getStatusCode() !== 200) {
    throw new RuntimeException("Route /layanan/pipa-mampet failed with status {$resp2->getStatusCode()}");
}
echo "✓ Test 3 Passed.\n\n";

echo "=== TEST 4: SpintaxService Keyword Alias Injection ===\n";
$spintax = app(SpintaxService::class);
$cat = ServiceCategory::where('slug', 'pipa-mampet')->first();
$spunWord = $spintax->getCategoryKeywordSpintax($cat->id, $cat->name);
echo "Category Spintax Pattern / Result: {$spunWord}\n";
$headline = $spintax->generateHeroHeadline($cat->name, 'Jakarta Selatan', 'seed1', $cat->id);
echo "Generated Headline: {$headline}\n";
if (empty($headline)) {
    throw new RuntimeException("Spintax headline generation failed");
}
echo "✓ Test 4 Passed.\n\n";

echo "=== TEST 5: SchemaGeneratorService with Alias ===\n";
$schemaGen = app(SchemaGeneratorService::class);
$alias = ServiceAlias::where('slug', 'paralon-mampet')->first();
$svcSchema = $schemaGen->getServiceSchema($cat, null, $alias);
echo "Service Schema Name: " . ($svcSchema['name'] ?? 'N/A') . "\n";
echo "Service Schema URL:  " . ($svcSchema['@id'] ?? 'N/A') . "\n";
$faqSchema = $schemaGen->getServiceAliasFaqSchema($alias);
echo "FAQ Schema Question count: " . count($faqSchema['mainEntity'] ?? []) . "\n";
if (count($faqSchema['mainEntity'] ?? []) !== 3) {
    throw new RuntimeException("FAQ schema does not have 3 questions");
}
echo "✓ Test 5 Passed.\n\n";

echo "=== TEST 6: SitemapController & Service Sitemaps ===\n";
\App\Http\Controllers\SitemapController::clearCache();
$sitemapController = new \App\Http\Controllers\SitemapController();
$sitemapResp = $sitemapController->services();
echo "Sitemap Status: " . $sitemapResp->getStatusCode() . "\n";
$sitemapXml = $sitemapResp->getContent();
$hasAliasUrl = str_contains($sitemapXml, '/layanan/paralon-mampet');
echo "Has /layanan/paralon-mampet in Sitemap: " . ($hasAliasUrl ? "YES" : "NO") . "\n";
if (!$hasAliasUrl) {
    throw new RuntimeException("Sitemap XML does not contain alias URL");
}
echo "✓ Test 6 Passed.\n\n";

echo "ALL TESTS PASSED SUCCESSFULLY!\n";
