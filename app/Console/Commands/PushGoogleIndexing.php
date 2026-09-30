<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\City;
use App\Models\District;
use App\Models\ServiceSector;
use App\Models\PropertyType;
use App\Models\FaqCategory;
use App\Models\Faq;
use App\Models\ServiceCategory;
use App\Models\Article;
use App\Models\ProjectGallery;
use App\Models\Gallery;
use App\Models\IndexingLog;
use Carbon\Carbon;
use Exception;

class PushGoogleIndexing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:push-indexing 
                            {--limit=150 : Maximum number of URLs to push (default 150)} 
                            {--dry-run : Simulate URL collection & priority selection without calling API} 
                            {--type= : Filter specific URL type: article, gallery, pseo, static, b2b, property, faq} 
                            {--action=URL_UPDATED : Action type: URL_UPDATED or URL_DELETED} 
                            {--force : Force submission ignoring the 14-day skip guard}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Smart quota-guarded Google Search Indexing API submission engine with audit trail';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $limit  = max(1, (int) $this->option('limit'));
        $dryRun = (bool) $this->option('dry-run');
        $filterType = $this->option('type') ? strtolower(trim($this->option('type'))) : null;
        $action = strtoupper($this->option('action') ?: 'URL_UPDATED');
        $force  = (bool) $this->option('force');

        if (!in_array($action, ['URL_UPDATED', 'URL_DELETED'])) {
            $this->error("❌ Invalid action type '{$action}'. Allowed: URL_UPDATED, URL_DELETED");
            return 1;
        }

        $this->info("🚀 Starting Google Indexing Engine (Limit: {$limit}, Action: {$action}" . ($dryRun ? ", DRY RUN" : "") . ($force ? ", FORCE" : "") . ")...");

        // 1. Gather Prioritized Candidate URLs
        $candidates = $this->selectPrioritizedUrls($limit, $filterType, $force);
        $totalCount = count($candidates);

        if ($totalCount === 0) {
            $this->warn("⚠️ No eligible URLs found to submit. All target URLs may be up to date within the 14-day window.");
            return 0;
        }

        // 2. Handle Dry Run Mode
        if ($dryRun) {
            $this->newLine();
            $this->info("🧪 DRY RUN MODE: Gathered {$totalCount} prioritized URLs ready for submission:");
            $displayTable = [];
            foreach (array_slice($candidates, 0, 20) as $i => $item) {
                $displayTable[] = [
                    '#'           => $i + 1,
                    'Priority'    => $item['priority'],
                    'Type'        => $item['type'],
                    'Last Pushed' => $item['last_pushed'] ?: 'Never',
                    'URL'         => $item['url'],
                ];
            }
            $this->table(['#', 'Priority', 'Type', 'Last Pushed', 'Canonical URL'], $displayTable);
            if ($totalCount > 20) {
                $this->line("... and " . ($totalCount - 20) . " more candidate URLs in queue.");
            }
            $this->newLine();
            $this->info("✅ Dry Run Completed Successfully! No Google API calls were executed.");
            return 0;
        }

        // 3. Locate & Verify Credentials File
        $keyPath = config('services.google.indexing_credentials_json');
        if (!$keyPath || !file_exists($keyPath)) {
            $keyPath = storage_path('app/google-indexing-key.json');
        }
        if (!file_exists($keyPath)) {
            $matchingFiles = glob(storage_path('app/rootera-indexing-*.json'));
            if (!empty($matchingFiles)) {
                $keyPath = $matchingFiles[0];
            }
        }

        if (!file_exists($keyPath)) {
            $this->error("❌ Google Indexing credentials JSON file not found at: {$keyPath}");
            $this->line("Tip: Run with '--dry-run' option to test candidate selection without credentials.");
            return 1;
        }

        $this->line("🔑 Using Service Account Key: <comment>{$keyPath}</comment>");

        // 4. Initialize Google Client
        if (!class_exists('Google_Client') && class_exists('Google\Client')) {
            class_alias('Google\Client', 'Google_Client');
        }

        try {
            $client = new \Google_Client();
            $client->setAuthConfig($keyPath);
            $client->addScope('https://www.googleapis.com/auth/indexing');
            $httpClient = $client->authorize();
        } catch (Exception $e) {
            $this->error("❌ Failed to initialize Google Client: " . $e->getMessage());
            return 1;
        }

        $endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';
        $this->info("📋 Submitting {$totalCount} URLs to Google Indexing API...");
        $this->newLine();

        $progressBar = $this->output->createProgressBar($totalCount);
        $progressBar->start();

        $results = [];
        $successCount = 0;
        $failCount = 0;
        $quotaReached = false;

        // 5. Batch Push with Micro-throttling and Quota Guard
        foreach ($candidates as $item) {
            $url = $item['url'];
            $urlType = $item['type'];

            // Throttling: 150ms delay per request to avoid API bursts
            usleep(150000);

            try {
                $response = $httpClient->post($endpoint, [
                    'json' => [
                        'url'  => $url,
                        'type' => $action,
                    ],
                    'http_errors' => false,
                ]);

                $statusCode = $response->getStatusCode();
                $body = json_decode((string) $response->getBody(), true);
                $errorMsg = $body['error']['message'] ?? null;

                // Quota Detection Guard (HTTP 429 or Quota Exceeded error message)
                if ($statusCode === 429 || ($errorMsg && (str_contains(strtolower($errorMsg), 'quota') || str_contains(strtolower($errorMsg), 'rate limit')))) {
                    $quotaReached = true;
                    $failCount++;
                    
                    IndexingLog::recordAttempt(
                        $url,
                        $urlType,
                        $action,
                        'failed',
                        $statusCode,
                        $errorMsg ?: 'Quota Exceeded (HTTP 429)'
                    );

                    $results[] = [
                        'url'    => $url,
                        'status' => "HTTP {$statusCode}",
                        'detail' => 'Quota Exceeded - Execution Paused Safely',
                    ];

                    $progressBar->advance();
                    break;
                }

                if ($statusCode === 200) {
                    $successCount++;
                    IndexingLog::recordAttempt($url, $urlType, $action, 'success', 200, 'Success');
                    $results[] = [
                        'url'    => $url,
                        'status' => '200 OK',
                        'detail' => 'Success',
                    ];
                } else {
                    $failCount++;
                    IndexingLog::recordAttempt($url, $urlType, $action, 'failed', $statusCode, $errorMsg ?: "HTTP {$statusCode}");
                    $results[] = [
                        'url'    => $url,
                        'status' => "HTTP {$statusCode}",
                        'detail' => $errorMsg ?: 'Request Failed',
                    ];
                }
            } catch (Exception $e) {
                $failCount++;
                IndexingLog::recordAttempt($url, $urlType, $action, 'failed', 500, $e->getMessage());
                $results[] = [
                    'url'    => $url,
                    'status' => 'ERROR',
                    'detail' => $e->getMessage(),
                ];
            }

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine(2);

        if ($quotaReached) {
            $this->warn("⚠️ GOOGLE INDEXING API QUOTA LIMIT DETECTED!");
            $this->warn("Paused batch execution safely. Remaining URLs in queue will be processed in the next scheduled run.");
            $this->newLine();
        }

        // 6. Summary Output
        $this->info("📊 Google Indexing Push Execution Summary:");
        $displayResults = [];
        foreach (array_slice($results, 0, 15) as $r) {
            $displayResults[] = [
                'URL'      => $r['url'],
                'Status'   => $r['status'],
                'Detail'   => $r['detail'],
            ];
        }
        $this->table(['URL', 'Status', 'Response Detail'], $displayResults);

        if (count($results) > 15) {
            $this->line("... and " . (count($results) - 15) . " more URLs logged in database.");
        }

        $this->newLine();
        $this->info("✅ Successfully Pushed: <comment>{$successCount}</comment> | ❌ Failed/Quota Paused: <comment>{$failCount}</comment>");

        return 0;
    }

    /**
     * Smart Priority Selector for Target URLs
     */
    protected function selectPrioritizedUrls(int $limit, ?string $filterType, bool $force): array
    {
        $baseUrl = config('app.url');
        if (str_contains($baseUrl, 'localhost') || str_contains($baseUrl, '127.0.0.1') || str_contains($baseUrl, '.test') || str_contains($baseUrl, '.local')) {
            $baseUrl = 'https://rooteraplumbing.id';
        }
        $baseUrl = rtrim($baseUrl, '/');

        // Fetch logs for skip-guard (pushed in last 14 days) and freshness check
        $recentlyPushed = IndexingLog::pushedRecently(14)->pluck('pushed_at', 'url')->toArray();
        $allPushed = IndexingLog::pluck('pushed_at', 'url')->toArray();

        $priority1 = []; // High: New/updated articles & galleries (last 7 days)
        $priority2 = []; // Medium: pSEO Cities & Districts never pushed before
        $priority3 = []; // Maintenance: pSEO Cities & Districts last pushed > 30 days ago
        $priority4 = []; // Other: Static pillars, B2B sectors, Property Types, FAQs, older content

        $aliasSlugs = [
            'tangerang-kota', 'kab-tangerang', 'cikarang', 'karawang',
            'sleman', 'sidoarjo', 'gresik', 'solo'
        ];

        // -------------------------------------------------------------
        // PRIORITAS 1: Artikel Blog & Galeri Proyek Baru/Updated (7 Hari)
        // -------------------------------------------------------------
        if (!$filterType || $filterType === 'article') {
            $articles = Article::published()
                ->where('updated_at', '>=', Carbon::now()->subDays(7))
                ->get();

            foreach ($articles as $art) {
                $url = "{$baseUrl}/blog/{$art->slug}";
                $priority1[] = [
                    'url'         => $url,
                    'type'        => 'article',
                    'priority'    => 'P1 (High)',
                    'last_pushed' => isset($allPushed[$url]) ? $allPushed[$url]->format('Y-m-d') : null,
                ];
            }
        }

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
                        'priority'    => 'P1 (High)',
                        'last_pushed' => isset($allPushed[$url]) ? $allPushed[$url]->format('Y-m-d') : null,
                    ];
                }
            }

            $galleries = Gallery::where('is_active', true)
                ->where('updated_at', '>=', Carbon::now()->subDays(7))
                ->get();

            foreach ($galleries as $gal) {
                if ($gal->slug) {
                    $url = "{$baseUrl}/galeri/{$gal->slug}";
                    $priority1[] = [
                        'url'         => $url,
                        'type'        => 'gallery',
                        'priority'    => 'P1 (High)',
                        'last_pushed' => isset($allPushed[$url]) ? $allPushed[$url]->format('Y-m-d') : null,
                    ];
                }
            }
        }

        // -------------------------------------------------------------
        // PRIORITAS 2 & 3: Halaman pSEO Kota & Kecamatan
        // -------------------------------------------------------------
        if (!$filterType || str_contains($filterType, 'pseo') || $filterType === 'city' || $filterType === 'district') {
            $cities = City::where('is_active', true)
                ->whereNotIn('slug', $aliasSlugs)
                ->with(['districts' => function ($q) {
                    $q->where('is_active', true);
                }])->get();

            foreach ($cities as $city) {
                $cityUrl = "{$baseUrl}/jasa-saluran-mampet/{$city->slug}";
                $this->categorizePseoUrl($cityUrl, 'pseo_city', $allPushed, $priority2, $priority3, $priority4);

                foreach ($city->districts as $district) {
                    $distUrl = "{$baseUrl}/jasa-saluran-mampet/{$city->slug}/{$district->slug}";
                    $this->categorizePseoUrl($distUrl, 'pseo_district', $allPushed, $priority2, $priority3, $priority4);
                }
            }
        }

        // -------------------------------------------------------------
        // PRIORITAS 4: Core Static Pillars, B2B, Property Types, FAQs
        // -------------------------------------------------------------
        if (!$filterType || $filterType === 'static') {
            $staticUrls = [
                "{$baseUrl}",
                "{$baseUrl}/jasa-saluran-mampet",
                "{$baseUrl}/layanan",
                "{$baseUrl}/faq",
                "{$baseUrl}/layanan-b2b",
                "{$baseUrl}/solusi-properti",
                "{$baseUrl}/blog",
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

        if (!$filterType || $filterType === 'b2b') {
            $sectors = ServiceSector::where('is_active', true)->get();
            foreach ($sectors as $sec) {
                $b2bUrl = "{$baseUrl}/layanan-b2b/{$sec->slug}";
                $priority4[] = [
                    'url'         => $b2bUrl,
                    'type'        => 'b2b_sector',
                    'priority'    => 'P4 (B2B)',
                    'last_pushed' => isset($allPushed[$b2bUrl]) ? $allPushed[$b2bUrl]->format('Y-m-d') : null,
                ];
            }
        }

        if (!$filterType || $filterType === 'property') {
            $propertyTypes = PropertyType::where('is_active', true)->get();
            foreach ($propertyTypes as $prop) {
                $propUrl = "{$baseUrl}/solusi-properti/{$prop->slug}";
                $priority4[] = [
                    'url'         => $propUrl,
                    'type'        => 'property_type',
                    'priority'    => 'P4 (Property)',
                    'last_pushed' => isset($allPushed[$propUrl]) ? $allPushed[$propUrl]->format('Y-m-d') : null,
                ];
            }
        }

        if (!$filterType || $filterType === 'faq') {
            $faqCats = FaqCategory::where('is_active', true)->get();
            foreach ($faqCats as $fCat) {
                $catUrl = "{$baseUrl}/faq/kategori/{$fCat->slug}";
                $priority4[] = [
                    'url'         => $catUrl,
                    'type'        => 'faq_category',
                    'priority'    => 'P4 (FAQ)',
                    'last_pushed' => isset($allPushed[$catUrl]) ? $allPushed[$catUrl]->format('Y-m-d') : null,
                ];
            }

            $faqs = Faq::where('is_active', true)->get();
            foreach ($faqs as $faq) {
                $faqUrl = "{$baseUrl}/faq/{$faq->slug}";
                $priority4[] = [
                    'url'         => $faqUrl,
                    'type'        => 'faq_item',
                    'priority'    => 'P4 (FAQ)',
                    'last_pushed' => isset($allPushed[$faqUrl]) ? $allPushed[$faqUrl]->format('Y-m-d') : null,
                ];
            }
        }

        // Include older articles and galleries in P4 fallback
        if (!$filterType || $filterType === 'article') {
            $olderArticles = Article::published()->get();
            foreach ($olderArticles as $art) {
                $url = "{$baseUrl}/blog/{$art->slug}";
                $priority4[] = [
                    'url'         => $url,
                    'type'        => 'article',
                    'priority'    => 'P4 (Article)',
                    'last_pushed' => isset($allPushed[$url]) ? $allPushed[$url]->format('Y-m-d') : null,
                ];
            }
        }

        // Assemble ordered queue: P1 -> P2 -> P3 -> P4
        $combined = array_merge($priority1, $priority2, $priority3, $priority4);

        // Deduplicate by URL (keep highest priority occurrence)
        $uniqueList = [];
        $seen = [];
        foreach ($combined as $item) {
            $u = $item['url'];
            if (isset($seen[$u])) continue;
            $seen[$u] = true;

            // Apply 14-day Skip Guard (unless --force is active)
            if (!$force && isset($recentlyPushed[$u])) {
                continue;
            }

            $uniqueList[] = $item;
        }

        return array_slice($uniqueList, 0, $limit);
    }

    /**
     * Categorize pSEO URLs into Never-Pushed (P2) vs Re-index Maintenance (P3) vs Standard (P4)
     */
    protected function categorizePseoUrl(string $url, string $type, array $allPushed, array &$p2, array &$p3, array &$p4)
    {
        if (!isset($allPushed[$url])) {
            // P2: Never pushed before
            $p2[] = [
                'url'         => $url,
                'type'        => $type,
                'priority'    => 'P2 (Never Pushed)',
                'last_pushed' => null,
            ];
        } else {
            $lastPushedDate = Carbon::parse($allPushed[$url]);
            if ($lastPushedDate->lt(Carbon::now()->subDays(30))) {
                // P3: Maintenance cycle (> 30 days old)
                $p3[] = [
                    'url'         => $url,
                    'type'        => $type,
                    'priority'    => 'P3 (> 30 Days)',
                    'last_pushed' => $lastPushedDate->format('Y-m-d'),
                ];
            } else {
                // P4: Pushed between 14 to 30 days ago
                $p4[] = [
                    'url'         => $url,
                    'type'        => $type,
                    'priority'    => 'P4 (Maintenance)',
                    'last_pushed' => $lastPushedDate->format('Y-m-d'),
                ];
            }
        }
    }
}
