<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\City;
use App\Models\District;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\Gallery;
use App\Models\IndexingLog;
use App\Models\ProjectGallery;
use App\Models\PropertyType;
use App\Models\ServiceCategory;
use App\Models\ServiceSector;
use App\Services\Seo\IndexNowService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Throwable;

class PushIndexNow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:push-indexnow 
                            {--url= : Submit a specific single URL directly to IndexNow} 
                            {--limit=500 : Maximum number of URLs to push (default 500, max 10000)} 
                            {--batch-size=200 : Batch chunk size for each POST payload (default 200)} 
                            {--dry-run : Simulate URL collection and show preview without calling IndexNow API} 
                            {--type= : Filter specific URL type: article, gallery, service, pseo, pseo_service, static, b2b, property, faq} 
                            {--force : Force submission ignoring the recent skip guard}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fast batch & single URL IndexNow submission engine for Bing, Yandex, Seznam, and Naver';

    public function handle(IndexNowService $indexNowService): int
    {
        $singleUrl = $this->option('url') ? trim((string) $this->option('url')) : null;
        $limit     = max(1, min(10000, (int) $this->option('limit')));
        $batchSize = max(1, min(10000, (int) $this->option('batch-size')));
        $dryRun    = (bool) $this->option('dry-run');
        $filterType = $this->option('type') ? strtolower(trim((string) $this->option('type'))) : null;
        $force     = (bool) $this->option('force');

        $this->info("⚡ Starting IndexNow Engine (Host: {$indexNowService->getHost()}, Key: " . substr($indexNowService->getKey(), 0, 8) . "...)" . ($dryRun ? " [DRY RUN]" : "") . "...");

        // 1. Single URL Mode
        if ($singleUrl) {
            return $this->handleSingleUrl($singleUrl, $indexNowService, $dryRun);
        }

        // 2. Batch Collection Mode
        $candidates = $this->selectPrioritizedUrls($limit, $filterType, $force);
        $totalCount = count($candidates);

        if ($totalCount === 0) {
            $this->warn("⚠️ No eligible URLs found to submit. All target URLs may be up to date within the skip window.");
            return 0;
        }

        // 3. Dry Run Preview
        if ($dryRun) {
            $this->newLine();
            $this->info("🧪 DRY RUN MODE: Gathered {$totalCount} candidate URLs for IndexNow submission:");
            $displayTable = [];
            foreach (array_slice($candidates, 0, 25) as $i => $item) {
                $displayTable[] = [
                    '#'           => $i + 1,
                    'Priority'    => $item['priority'],
                    'Type'        => $item['type'],
                    'Last Pushed' => $item['last_pushed'] ?: 'Never',
                    'URL'         => $item['url'],
                ];
            }
            $this->table(['#', 'Priority', 'Type', 'Last Pushed (IndexNow)', 'Canonical URL'], $displayTable);
            if ($totalCount > 25) {
                $this->line("... and " . ($totalCount - 25) . " more URLs in queue.");
            }
            $this->newLine();
            $this->info("✅ Dry Run Completed! No requests were sent to IndexNow.");
            return 0;
        }

        // 4. Batch Submission Execution
        $this->info("📋 Submitting {$totalCount} URLs to IndexNow in chunks of {$batchSize}...");
        $chunks = array_chunk($candidates, $batchSize);
        $totalSuccess = 0;
        $totalFailed = 0;

        $progressBar = $this->output->createProgressBar($totalCount);
        $progressBar->start();

        foreach ($chunks as $chunk) {
            $chunkUrls = array_column($chunk, 'url');
            $response = $indexNowService->submitBatch($chunkUrls);

            $status = $response['success'] ? 'success' : 'failed';
            $statusCode = $response['status_code'];
            $msg = $response['message'];

            foreach ($chunk as $item) {
                IndexingLog::recordAttempt(
                    url: $item['url'],
                    urlType: $item['type'],
                    action: 'URL_UPDATED',
                    status: $status,
                    httpStatus: $statusCode,
                    responseMessage: $msg,
                    engine: 'indexnow'
                );

                if ($response['success']) {
                    $totalSuccess++;
                } else {
                    $totalFailed++;
                }

                $progressBar->advance();
            }
        }

        $progressBar->finish();
        $this->newLine(2);

        $this->info("📊 IndexNow Submission Summary:");
        $this->table(
            ['Metric', 'Value'],
            [
                ['Total Target URLs', $totalCount],
                ['Successfully Submitted', $totalSuccess],
                ['Failed', $totalFailed],
                ['Host', $indexNowService->getHost()],
                ['Key Verification', $indexNowService->getKeyLocation()],
                ['Engines Notified', 'Bing, Yandex, Seznam, Naver'],
            ]
        );

        return $totalFailed > 0 ? 1 : 0;
    }

    /**
     * Handle single URL submission.
     */
    protected function handleSingleUrl(string $url, IndexNowService $indexNowService, bool $dryRun): int
    {
        $this->line("🎯 Target URL: <comment>{$url}</comment>");

        if ($dryRun) {
            $this->info("🧪 DRY RUN: URL is valid and would be submitted via POST to {$indexNowService->getEndpoint()}.");
            return 0;
        }

        $result = $indexNowService->submitUrl($url);

        IndexingLog::recordAttempt(
            url: $url,
            urlType: 'single_url',
            action: 'URL_UPDATED',
            status: $result['success'] ? 'success' : 'failed',
            httpStatus: $result['status_code'],
            responseMessage: $result['message'],
            engine: 'indexnow'
        );

        if ($result['success']) {
            $this->info("✅ Success (HTTP {$result['status_code']}): {$result['message']}");
            return 0;
        }

        $this->error("❌ Failed (HTTP {$result['status_code']}): {$result['message']}");
        return 1;
    }

    /**
     * Gather and prioritize candidate URLs for IndexNow submission.
     */
    protected function selectPrioritizedUrls(int $limit, ?string $filterType, bool $force): array
    {
        $baseUrl = config('app.url');
        if (str_contains($baseUrl, 'localhost') || str_contains($baseUrl, '127.0.0.1') || str_contains($baseUrl, '.test') || str_contains($baseUrl, '.local')) {
            $baseUrl = 'https://rooteraplumbing.id';
        }
        $baseUrl = rtrim($baseUrl, '/');

        // Fetch logs for IndexNow skip guard (7 days for IndexNow due to higher quotas)
        $recentlyPushed = IndexingLog::indexNow()->pushedRecently(7)->pluck('pushed_at', 'url')->toArray();
        $allPushed = IndexingLog::indexNow()->pluck('pushed_at', 'url')->toArray();

        $priority1 = []; // High: Fresh articles & galleries (< 7 days)
        $priority2 = []; // High: Service categories
        $priority3 = []; // Medium: pSEO Cities & Districts
        $priority4 = []; // Standard: Static pillars, B2B, Property, FAQs
        $priority5 = []; // Fallback: All remaining published articles & galleries

        $aliasSlugs = [
            'tangerang-kota', 'kab-tangerang', 'cikarang', 'karawang',
            'sleman', 'sidoarjo', 'gresik', 'solo',
        ];

        // 1. Articles (Fresh)
        if (!$filterType || $filterType === 'article') {
            $articles = Article::published()
                ->where('updated_at', '>=', Carbon::now()->subDays(7))
                ->get();

            foreach ($articles as $art) {
                $url = "{$baseUrl}/blog/{$art->slug}";
                $priority1[] = [
                    'url'         => $url,
                    'type'        => 'article',
                    'priority'    => 'P1 (Fresh Article)',
                    'last_pushed' => isset($allPushed[$url]) ? $allPushed[$url]->format('Y-m-d') : null,
                ];
            }
        }

        // 2. Galleries (Fresh)
        if (!$filterType || $filterType === 'gallery') {
            $projGalleries = ProjectGallery::where('is_active', true)
                ->where('updated_at', '>=', Carbon::now()->subDays(7))
                ->get();

            foreach ($projGalleries as $pg) {
                if ($pg->slug) {
                    $url = "{$baseUrl}/galeri/{$pg->slug}";
                    $priority1[] = [
                        'url'         => $url,
                        'type'        => 'gallery',
                        'priority'    => 'P1 (Fresh Gallery)',
                        'last_pushed' => isset($allPushed[$url]) ? $allPushed[$url]->format('Y-m-d') : null,
                    ];
                }
            }

            $galleries = Gallery::where('is_active', true)
                ->where('updated_at', '>=', Carbon::now()->subDays(7))
                ->get();

            foreach ($galleries as $gal) {
                if ($gal->slug) {
                    $url = "{$baseUrl}/galeri-dokumentasi/{$gal->slug}";
                    $priority1[] = [
                        'url'         => $url,
                        'type'        => 'gallery',
                        'priority'    => 'P1 (Fresh Gallery)',
                        'last_pushed' => isset($allPushed[$url]) ? $allPushed[$url]->format('Y-m-d') : null,
                    ];
                }
            }
        }

        // 3. Service Categories
        if (!$filterType || $filterType === 'service') {
            $categories = ServiceCategory::where('is_active', true)->get();
            foreach ($categories as $cat) {
                $url = "{$baseUrl}/layanan/{$cat->slug}";
                $priority2[] = [
                    'url'         => $url,
                    'type'        => 'service_category',
                    'priority'    => 'P2 (Service)',
                    'last_pushed' => isset($allPushed[$url]) ? $allPushed[$url]->format('Y-m-d') : null,
                ];
            }
        }

        // 4. pSEO Cities & Districts (Filter is_indexable)
        if (!$filterType || str_contains($filterType, 'pseo') || $filterType === 'city' || $filterType === 'district') {
            $cities = City::where('is_active', true)
                ->whereNotIn('slug', $aliasSlugs)
                ->with(['districts' => function ($q) {
                    $q->where('is_active', true)->where('is_indexable', true);
                }])->get();

            foreach ($cities as $city) {
                $cityUrl = "{$baseUrl}/jasa-saluran-mampet/{$city->slug}";
                $priority3[] = [
                    'url'         => $cityUrl,
                    'type'        => 'pseo_city',
                    'priority'    => 'P3 (pSEO City)',
                    'last_pushed' => isset($allPushed[$cityUrl]) ? $allPushed[$cityUrl]->format('Y-m-d') : null,
                ];

                foreach ($city->districts as $district) {
                    $distUrl = "{$baseUrl}/jasa-saluran-mampet/{$city->slug}/{$district->slug}";
                    $priority3[] = [
                        'url'         => $distUrl,
                        'type'        => 'pseo_district',
                        'priority'    => 'P3 (pSEO District)',
                        'last_pushed' => isset($allPushed[$distUrl]) ? $allPushed[$distUrl]->format('Y-m-d') : null,
                    ];
                }
            }
        }

        // 5. pSEO Services x Cities
        if (!$filterType || str_contains($filterType, 'pseo') || $filterType === 'pseo_service') {
            $serviceCategories = ServiceCategory::where('is_active', true)->orderBy('sort_order')->get();
            $serviceCities = City::where('is_active', true)->whereNotIn('slug', $aliasSlugs)->get();

            foreach ($serviceCategories as $cat) {
                foreach ($serviceCities as $city) {
                    $url = "{$baseUrl}/layanan/{$cat->slug}/{$city->slug}";
                    $priority3[] = [
                        'url'         => $url,
                        'type'        => 'pseo_service',
                        'priority'    => 'P3 (pSEO Service)',
                        'last_pushed' => isset($allPushed[$url]) ? $allPushed[$url]->format('Y-m-d') : null,
                    ];
                }
            }
        }

        // 6. Static Pillars
        if (!$filterType || $filterType === 'static') {
            $staticUrls = [
                "{$baseUrl}",
                "{$baseUrl}/jasa-saluran-mampet",
                "{$baseUrl}/layanan",
                "{$baseUrl}/faq",
                "{$baseUrl}/layanan-b2b-komersial",
                "{$baseUrl}/kategori-properti",
                "{$baseUrl}/blog",
                "{$baseUrl}/cek-kondisi-pipa",
            ];
            foreach ($staticUrls as $sUrl) {
                $priority4[] = [
                    'url'         => $sUrl,
                    'type'        => 'static',
                    'priority'    => 'P4 (Pillar)',
                    'last_pushed' => isset($allPushed[$sUrl]) ? $allPushed[$sUrl]->format('Y-m-d') : null,
                ];
            }
        }

        // 7. B2B, Property, FAQs
        if (!$filterType || $filterType === 'b2b') {
            $sectors = ServiceSector::where('is_active', true)->get();
            foreach ($sectors as $sec) {
                $url = "{$baseUrl}/sektor-plumbing/{$sec->slug}";
                $priority4[] = [
                    'url'         => $url,
                    'type'        => 'b2b_sector',
                    'priority'    => 'P4 (B2B)',
                    'last_pushed' => isset($allPushed[$url]) ? $allPushed[$url]->format('Y-m-d') : null,
                ];
            }
        }

        if (!$filterType || $filterType === 'property') {
            $propertyTypes = PropertyType::where('is_active', true)->get();
            foreach ($propertyTypes as $prop) {
                $url = "{$baseUrl}/solusi-properti/{$prop->slug}";
                $priority4[] = [
                    'url'         => $url,
                    'type'        => 'property_type',
                    'priority'    => 'P4 (Property)',
                    'last_pushed' => isset($allPushed[$url]) ? $allPushed[$url]->format('Y-m-d') : null,
                ];
            }
        }

        if (!$filterType || $filterType === 'faq') {
            $faqs = Faq::where('is_active', true)->get();
            foreach ($faqs as $faq) {
                $url = "{$baseUrl}/faq/{$faq->slug}";
                $priority4[] = [
                    'url'         => $url,
                    'type'        => 'faq_item',
                    'priority'    => 'P4 (FAQ)',
                    'last_pushed' => isset($allPushed[$url]) ? $allPushed[$url]->format('Y-m-d') : null,
                ];
            }
        }

        // 8. Older articles fallback
        if (!$filterType || $filterType === 'article') {
            $olderArticles = Article::published()->get();
            foreach ($olderArticles as $art) {
                $url = "{$baseUrl}/blog/{$art->slug}";
                $priority5[] = [
                    'url'         => $url,
                    'type'        => 'article',
                    'priority'    => 'P5 (Article Archive)',
                    'last_pushed' => isset($allPushed[$url]) ? $allPushed[$url]->format('Y-m-d') : null,
                ];
            }
        }

        // Combine priorities
        $combined = array_merge($priority1, $priority2, $priority3, $priority4, $priority5);

        // Deduplicate & apply skip-guard
        $uniqueList = [];
        $seen = [];
        foreach ($combined as $item) {
            $u = $item['url'];
            if (isset($seen[$u])) {
                continue;
            }
            $seen[$u] = true;

            if (!$force && isset($recentlyPushed[$u])) {
                continue;
            }

            $uniqueList[] = $item;
        }

        return array_slice($uniqueList, 0, $limit);
    }
}
