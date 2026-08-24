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
use Exception;

class PushGoogleIndexing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:push-index {--limit=100 : Maximum number of URLs to push (default 100)} {--type=URL_UPDATED : Action type: URL_UPDATED or URL_DELETED}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push active site URLs programmatically to Google Search Indexing API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $limit = (int) $this->option('limit');
        $type = strtoupper($this->option('type'));

        if (!in_array($type, ['URL_UPDATED', 'URL_DELETED'])) {
            $this->error("Invalid action type '{$type}'. Allowed values: URL_UPDATED, URL_DELETED");
            return 1;
        }

        $this->info("🚀 Starting Google Indexing API Push (Action: {$type}, Limit: {$limit})...");

        // 1. Locate Credentials File
        $keyPath = storage_path('app/google-indexing-key.json');
        if (!file_exists($keyPath)) {
            $matchingFiles = glob(storage_path('app/rootera-indexing-*.json'));
            if (!empty($matchingFiles)) {
                $keyPath = $matchingFiles[0];
            }
        }

        if (!file_exists($keyPath)) {
            $this->error("❌ Google Indexing credentials file not found at: {$keyPath}");
            $this->error("Please place your Service Account JSON file in storage/app/google-indexing-key.json");
            return 1;
        }

        $this->line("🔑 Using Service Account Key: <comment>{$keyPath}</comment>");

        // 2. Initialize Google Client
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

        // 3. Gather Active URLs
        $urls = $this->collectTargetUrls($limit);
        $totalCount = count($urls);

        if ($totalCount === 0) {
            $this->warn("⚠️ No active URLs found to submit.");
            return 0;
        }

        $this->info("📋 Prepared {$totalCount} active URLs for submission.");
        $this->newLine();

        $endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';
        $progressBar = $this->output->createProgressBar($totalCount);
        $progressBar->start();

        $results = [];
        $successCount = 0;
        $failCount = 0;

        // 4. Batch Push Requests
        foreach ($urls as $url) {
            try {
                $response = $httpClient->post($endpoint, [
                    'json' => [
                        'url' => $url,
                        'type' => $type,
                    ],
                    'http_errors' => false,
                ]);

                $statusCode = $response->getStatusCode();
                $body = json_decode((string) $response->getBody(), true);

                if ($statusCode === 200) {
                    $successCount++;
                    $results[] = [
                        'url' => $url,
                        'status' => '200 OK',
                        'detail' => 'Success',
                    ];
                } else {
                    $failCount++;
                    $errorMsg = $body['error']['message'] ?? "HTTP {$statusCode}";
                    $results[] = [
                        'url' => $url,
                        'status' => "HTTP {$statusCode}",
                        'detail' => $errorMsg,
                    ];
                }
            } catch (Exception $e) {
                $failCount++;
                $results[] = [
                    'url' => $url,
                    'status' => 'ERROR',
                    'detail' => $e->getMessage(),
                ];
            }

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine(2);

        // 5. Output Summary Table & Status
        $this->info("📊 Google Indexing Push Execution Summary:");
        $this->table(
            ['URL', 'Status', 'Response Detail'],
            array_slice($results, 0, 15) // Show top 15 in output table
        );

        if (count($results) > 15) {
            $this->line("... and " . (count($results) - 15) . " more URLs processed.");
        }

        $this->newLine();
        $this->info("✅ Successfully Pushed: <comment>{$successCount}</comment> | ❌ Failed/Denied: <comment>{$failCount}</comment>");

        return 0;
    }

    /**
     * Collect active website URLs prioritizing Cities, Districts, B2B, Property, FAQs & Content
     */
    protected function collectTargetUrls(int $limit): array
    {
        $baseUrl = config('app.url');
        if (str_contains($baseUrl, 'localhost') || str_contains($baseUrl, '127.0.0.1') || str_contains($baseUrl, '.test') || str_contains($baseUrl, '.local')) {
            $baseUrl = 'https://rooteraplumbing.id';
        }
        $baseUrl = rtrim($baseUrl, '/');

        $urls = [];

        // 1. Core Static Pillar URLs
        $urls[] = "{$baseUrl}";
        $urls[] = "{$baseUrl}/jasa-saluran-mampet";
        $urls[] = "{$baseUrl}/layanan";
        $urls[] = "{$baseUrl}/faq";
        $urls[] = "{$baseUrl}/layanan-b2b";
        $urls[] = "{$baseUrl}/solusi-properti";
        $urls[] = "{$baseUrl}/blog";

        // 2. City & District Landing Pages
        $cities = City::where('is_active', true)->with(['districts' => function ($q) {
            $q->where('is_active', true);
        }])->get();

        foreach ($cities as $city) {
            $urls[] = "{$baseUrl}/jasa-saluran-mampet/{$city->slug}";
            foreach ($city->districts as $district) {
                $urls[] = "{$baseUrl}/jasa-saluran-mampet/{$city->slug}/{$district->slug}";
            }
        }

        // 3. B2B Commercial Sectors
        $sectors = ServiceSector::where('is_active', true)->get();
        foreach ($sectors as $sector) {
            $urls[] = "{$baseUrl}/layanan-b2b/{$sector->slug}";
        }

        // 4. Property Types
        $propertyTypes = PropertyType::where('is_active', true)->get();
        foreach ($propertyTypes as $prop) {
            $urls[] = "{$baseUrl}/solusi-properti/{$prop->slug}";
        }

        // 5. FAQ Categories & FAQ Detail Pages
        $faqCats = FaqCategory::where('is_active', true)->get();
        foreach ($faqCats as $cat) {
            $urls[] = "{$baseUrl}/faq/kategori/{$cat->slug}";
        }

        $faqs = Faq::where('is_active', true)->get();
        foreach ($faqs as $faq) {
            $urls[] = "{$baseUrl}/faq/{$faq->slug}";
        }

        // 6. Service Categories
        $serviceCats = ServiceCategory::where('is_active', true)->get();
        foreach ($serviceCats as $serviceCat) {
            $urls[] = "{$baseUrl}/layanan/{$serviceCat->slug}";
        }

        // 7. Blog Articles
        if (class_exists(Article::class)) {
            $articles = Article::published()->get();
            foreach ($articles as $article) {
                $urls[] = "{$baseUrl}/blog/{$article->slug}";
            }
        }

        // Deduplicate & Limit
        $uniqueUrls = array_values(array_unique($urls));

        return array_slice($uniqueUrls, 0, $limit);
    }
}
