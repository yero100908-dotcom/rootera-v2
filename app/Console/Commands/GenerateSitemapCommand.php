<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\City;
use App\Models\ResidentialCluster;
use App\Models\ServiceCategory;
use App\Models\Gallery;
use App\Models\District;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\SitemapController;

/**
 * GenerateSitemapCommand
 *
 * Regenerates the full multi-sitemap suite for Rootera Plumbing:
 *
 *   sitemap.xml          → Sitemap index (points to all sub-sitemaps)
 *   sitemap-static.xml   → Static / evergreen pages
 *   sitemap-services.xml → All active ServiceCategory pages
 *   sitemap-pseo.xml     → Dynamic pSEO routes (Service × City combinations)
 *   sitemap-articles.xml → All published blog articles
 *
 * The command also warms the existing SitemapController-driven sub-sitemaps
 * (cities, districts, gallery, videos, pages) so every cache key is fresh.
 *
 * Usage:
 *   php artisan sitemap:generate
 *   php artisan sitemap:generate --only=pseo
 *   php artisan sitemap:generate --dry-run
 */
class GenerateSitemapCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'sitemap:generate
                            {--only= : Generate only one specific sitemap: static|services|pseo|articles|clusters|all}
                            {--dry-run : Count URLs without writing any files}
                            {--chunk=500 : Max URLs per pseo sitemap chunk file}';

    /**
     * The console command description.
     */
    protected $description = 'Regenerate and cache multi-sitemap XML suite (index + static + services + pseo + articles)';

    /**
     * City slugs that are alias 301 redirects — excluded from sitemaps.
     */
    protected const ALIAS_SLUGS = [
        'tangerang-kota', 'kab-tangerang', 'cikarang', 'karawang',
        'sleman', 'sidoarjo', 'gresik', 'solo',
    ];

    /**
     * Canonical HTTPS base URL for all sitemap entries.
     */
    protected string $baseUrl;

    /**
     * Timestamp string for <lastmod> in sitemaps.
     */
    protected string $now;

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->prepareCanonicalUrl();
        $this->cleanupEmptyStaticSitemaps();
        $this->now = now()->tz('UTC')->toAtomString();

        $only   = $this->option('only') ? strtolower((string) $this->option('only')) : 'all';
        $dryRun = (bool) $this->option('dry-run');
        $chunk  = max(1, (int) $this->option('chunk'));

        if ($dryRun) {
            $this->info('🧪 DRY RUN — no files will be written.');
        }

        $this->info("🗺  Rootera Sitemap Generator — base URL: {$this->baseUrl}");
        $this->newLine();

        // ── Flush existing SitemapController cache (legacy endpoints) ───────
        $this->info('🗑  Flushing legacy sitemap cache...');
        SitemapController::clearCache();

        // ── Build the requested sitemap(s) ───────────────────────────────────
        $generatedFiles = [];

        if ($only === 'all' || $only === 'static') {
            $generatedFiles[] = $this->buildStaticSitemap($dryRun);
        }

        if ($only === 'all' || $only === 'services') {
            $generatedFiles[] = $this->buildServicesSitemap($dryRun);
        }

        if ($only === 'all' || $only === 'pseo') {
            $pseoFiles = $this->buildPseoSitemap($dryRun, $chunk);
            $generatedFiles = array_merge($generatedFiles, $pseoFiles);
        }

        if ($only === 'all' || $only === 'articles') {
            $generatedFiles[] = $this->buildArticlesSitemap($dryRun);
        }

        // ── Warm the SitemapController-managed sub-sitemaps ──────────────────
        if ($only === 'all') {
            $this->info('♨  Warming SitemapController sub-sitemaps (cities, districts, pages, gallery, videos, clusters)...');
            $controller = new SitemapController();
            $controller->index();
            $controller->pages();
            $controller->services();
            $controller->cities();
            $controller->districts();
            $controller->blog();
            $controller->gallery();
            $controller->videos();
            $controller->clusters();
            $this->line('   ✓ SitemapController cache warmed (including clusters).');
        }

        // ── Build sitemap-clusters.xml as a static file ──────────────────────
        if (($only === 'all' || $only === 'clusters') && !$dryRun) {
            $clusterFile = $this->buildClustersSitemapFile($dryRun);
            if ($clusterFile) {
                $generatedFiles[] = $clusterFile;
            }
        }

        // ── Write sitemap-index.xml to public/ ───────────────────────────────
        if (($only === 'all') && !$dryRun) {
            $this->buildSitemapIndex($generatedFiles);
        }

        $this->newLine();
        $this->info('✅ Sitemap generation complete!');

        return Command::SUCCESS;
    }

    // ════════════════════════════════════════════════════════════════════════
    //  SITEMAP BUILDERS
    // ════════════════════════════════════════════════════════════════════════

    /**
     * sitemap-static.xml — Home, Tentang, Kontak, Layanan root pages.
     *
     * @return string  Public path of written file.
     */
    protected function buildStaticSitemap(bool $dryRun): string
    {
        $entries = [
            ['loc' => $this->baseUrl . '/',                     'priority' => '1.0', 'changefreq' => 'daily'],
            [
                'loc'        => $this->baseUrl . '/layanan',
                'priority'   => '0.9',
                'changefreq' => 'weekly',
                'images'     => [
                    [
                        'loc'     => $this->baseUrl . '/assets/TOOLKIT/mesin-rooter-ridgid-k50-spiral-baja.webp',
                        'title'   => 'Mesin Rooter Ridgid Spiral Baja - Rootera Plumbing',
                        'caption' => 'Peralatan mekanik modern pelancar pipa mampet tanpa bongkar lantai.',
                    ],
                    [
                        'loc'     => $this->baseUrl . '/images/dokumentasi/after-gutter-resto-bersih-rootera.webp',
                        'title'   => 'Hasil Pengerjaan Pelancaran Pipa Mampet Rootera Plumbing',
                        'caption' => 'Dokumentasi hasil pembersihan pipa saluran air bersih 100% lancar.',
                    ],
                ],
            ],
            ['loc' => $this->baseUrl . '/jasa-saluran-mampet',  'priority' => '0.9', 'changefreq' => 'weekly'],
            [
                'loc'        => $this->baseUrl . '/tentang-kami',
                'priority'   => '0.7',
                'changefreq' => 'monthly',
                'images'     => [
                    [
                        'loc'     => $this->baseUrl . '/assets/staff/rafael-abimanyu-rootera-plumbing.webp',
                        'title'   => 'Rafael Abimanyu - Founder & Lead Director Rootera Plumbing',
                        'caption' => 'Profil Rafael Abimanyu pimpinan teknis dan founder Rootera Plumbing Indonesia.',
                    ],
                    [
                        'loc'     => $this->baseUrl . '/images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp',
                        'title'   => 'Logo Resmi Rootera Plumbing Jasa Saluran Pipa Mampet',
                        'caption' => 'Kantor pusat dan workshop resmi Rootera Plumbing di Cijantung, Jakarta Timur.',
                    ],
                    [
                        'loc'     => $this->baseUrl . '/images/dokumentasi/teknisi-apd-lengkap-sink-pabrik-makanan.webp',
                        'title'   => 'Tim Teknisi APD K3 Rootera Plumbing',
                        'caption' => 'Armada teknisi profesional Rootera Plumbing dengan standar keselamatan K3.',
                    ],
                ],
            ],
            ['loc' => $this->baseUrl . '/kontak',               'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => $this->baseUrl . '/faq',                  'priority' => '0.7', 'changefreq' => 'weekly'],
            ['loc' => $this->baseUrl . '/blog',                 'priority' => '0.8', 'changefreq' => 'daily'],
            ['loc' => $this->baseUrl . '/layanan-b2b-komersial','priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => $this->baseUrl . '/solusi-properti',      'priority' => '0.7', 'changefreq' => 'weekly'],
            ['loc' => $this->baseUrl . '/galeri-dokumentasi',   'priority' => '0.6', 'changefreq' => 'weekly'],
            ['loc' => $this->baseUrl . '/cek-kondisi-pipa',     'priority' => '0.7', 'changefreq' => 'monthly'],
        ];

        $this->info("📄 sitemap-static.xml — " . count($entries) . " URLs");

        return $this->writeXml('sitemap-static.xml', $entries, $dryRun);
    }

    /**
     * sitemap-services.xml — All active ServiceCategory hub pages.
     *
     * @return string  Public path of written file.
     */
    protected function buildServicesSitemap(bool $dryRun): string
    {
        $categories = ServiceCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $entries = [];
        foreach ($categories as $cat) {
            $entries[] = [
                'loc'        => $this->baseUrl . '/layanan/' . $cat->slug,
                'priority'   => '0.8',
                'changefreq' => 'weekly',
                'lastmod'    => $cat->updated_at?->tz('UTC')->toAtomString() ?? $this->now,
            ];
        }

        $sectors = \App\Models\ServiceSector::where('is_active', true)->get();
        foreach ($sectors as $sec) {
            $entries[] = [
                'loc'        => $this->baseUrl . '/sektor-plumbing/' . $sec->slug,
                'priority'   => '0.8',
                'changefreq' => 'weekly',
                'lastmod'    => $sec->updated_at?->tz('UTC')->toAtomString() ?? $this->now,
            ];
        }

        $this->info("📄 sitemap-services.xml — " . count($entries) . " service categories and commercial sectors");

        return $this->writeXml('sitemap-services.xml', $entries, $dryRun);
    }

    /**
     * sitemap-pseo.xml — All active Service × City combinations.
     * Chunked into sitemap-pseo-{n}.xml files when exceeding $chunkSize.
     *
     * @return array<int, string>  List of written public paths.
     */
    protected function buildPseoSitemap(bool $dryRun, int $chunkSize): array
    {
        $categories = ServiceCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $cities = City::where('is_active', true)
            ->whereNotIn('slug', self::ALIAS_SLUGS)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $entries = [];
        foreach ($categories as $cat) {
            foreach ($cities as $city) {
                $entries[] = [
                    'loc'        => $this->baseUrl . '/layanan/' . $cat->slug . '/' . $city->slug,
                    'priority'   => '0.75',
                    'changefreq' => 'weekly',
                    'lastmod'    => $this->now,
                ];
            }
        }

        $totalUrls   = count($entries);
        $chunks      = array_chunk($entries, $chunkSize);
        $totalChunks = count($chunks);

        $this->info("📄 sitemap-pseo.xml — {$totalUrls} URLs across {$totalChunks} chunk(s) (chunk size: {$chunkSize})");

        $writtenFiles = [];

        if ($totalChunks === 1) {
            // Single chunk — write as sitemap-pseo.xml
            $writtenFiles[] = $this->writeXml('sitemap-pseo.xml', $entries, $dryRun);
        } else {
            // Multiple chunks
            foreach ($chunks as $i => $chunk) {
                $filename = 'sitemap-pseo-' . ($i + 1) . '.xml';
                $this->line("   Chunk " . ($i + 1) . "/{$totalChunks} → {$filename} (" . count($chunk) . " URLs)");
                $writtenFiles[] = $this->writeXml($filename, $chunk, $dryRun);
            }
        }

        return $writtenFiles;
    }

    /**
     * sitemap-articles.xml — All published blog articles.
     *
     * @return string  Public path of written file.
     */
    protected function buildArticlesSitemap(bool $dryRun): string
    {
        $articles = Article::published()
            ->latest('published_at')
            ->get();

        $entries = [];
        foreach ($articles as $art) {
            $images = [];
            if (!empty($art->thumbnail_url)) {
                $thumbUrl = $art->thumbnail_url;
                if (str_starts_with($thumbUrl, 'http')) {
                    $parsedPath = parse_url($thumbUrl, PHP_URL_PATH) ?: '';
                    $thumbUrl   = $this->baseUrl . '/' . ltrim($parsedPath, '/');
                } else {
                    $thumbUrl   = $this->baseUrl . '/' . ltrim($thumbUrl, '/');
                }

                $images[] = [
                    'loc'     => $thumbUrl,
                    'title'   => $art->clean_title ?? $art->title,
                    'caption' => 'Panduan dan solusi sanitasi pipa drainase: ' . ($art->clean_title ?? $art->title),
                ];
            }

            $entries[] = [
                'loc'        => $this->baseUrl . '/blog/' . $art->slug,
                'priority'   => '0.7',
                'changefreq' => 'monthly',
                'lastmod'    => ($art->updated_at ?? $art->published_at)?->tz('UTC')->toAtomString() ?? $this->now,
                'images'     => $images,
            ];
        }

        $this->info("📄 sitemap-articles.xml — " . count($entries) . " articles");

        return $this->writeXml('sitemap-articles.xml', $entries, $dryRun);
    }

    /**
     * sitemap-clusters.xml — Indexable residential cluster landing pages +
     *                         cluster × service-category intersection pages.
     *
     * @return string  Public path of written file, or '' on dry-run.
     */
    protected function buildClustersSitemapFile(bool $dryRun): string
    {
        $clusters   = ResidentialCluster::indexable()->orderBy('sort_order')->get();
        $categories = ServiceCategory::where('is_active', true)->orderBy('sort_order')->get();

        $entries = [];

        // Cluster landing pages (/area-perumahan/{slug})
        foreach ($clusters as $cluster) {
            $entries[] = [
                'loc'        => $this->baseUrl . '/area-perumahan/' . $cluster->slug,
                'priority'   => '0.70',
                'changefreq' => 'monthly',
                'lastmod'    => ($cluster->updated_at ?? now())->tz('UTC')->toAtomString(),
            ];
        }

        // Cluster × Category intersection pages (/area-perumahan/{clusterSlug}/{categorySlug})
        foreach ($clusters as $cluster) {
            foreach ($categories as $cat) {
                $entries[] = [
                    'loc'        => $this->baseUrl . '/area-perumahan/' . $cluster->slug . '/' . $cat->slug,
                    'priority'   => '0.55',
                    'changefreq' => 'monthly',
                    'lastmod'    => ($cluster->updated_at ?? now())->tz('UTC')->toAtomString(),
                ];
            }
        }

        $this->info("📄 sitemap-clusters.xml — "
            . count($clusters) . " clusters × "
            . count($categories) . " categories = "
            . count($entries) . " total URLs");

        return $this->writeXml('sitemap-clusters.xml', $entries, $dryRun);
    }

    /**
     * sitemap-index.xml — Master index pointing to all generated sub-sitemaps.
     *
     * @param  array<int, string>  $files  Public paths relative to public/.
     */
    protected function buildSitemapIndex(array $files): void
    {
        // Collect filenames already included via generated $files to avoid duplicates
        $generatedFilenames = array_filter(array_map(
            fn($f) => $f ? basename((string) $f) : null,
            $files
        ));

        $hasArticlesStatic = in_array('sitemap-articles.xml', $generatedFilenames, true);

        // SitemapController-managed (dynamic) endpoints
        // — skip any whose filename is already covered by a generated static file,
        // and skip sitemap-blog.xml if sitemap-articles.xml is generated to avoid duplicate blog sitemaps.
        $controllerEndpoints = array_values(array_filter([
            $this->baseUrl . '/sitemap-pages.xml',
            $this->baseUrl . '/sitemap-services.xml',
            $this->baseUrl . '/sitemap-cities.xml',
            $this->baseUrl . '/sitemap-districts.xml',
            $this->baseUrl . '/sitemap-blog.xml',
            $this->baseUrl . '/sitemap-gallery.xml',
            $this->baseUrl . '/sitemap-videos.xml',
            $this->baseUrl . '/sitemap-clusters.xml',
        ], function($loc) use ($generatedFilenames, $hasArticlesStatic) {
            $base = basename($loc);
            if ($base === 'sitemap-blog.xml' && $hasArticlesStatic) {
                return false;
            }
            return !in_array($base, $generatedFilenames, true);
        }));

        $lines   = ['<?xml version="1.0" encoding="UTF-8"?>'];
        $lines[] = '<?xml-stylesheet type="text/xsl" href="/sitemap.xsl"?>';
        $lines[] = '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        $lines[] = '  <!-- Static sitemaps: generated by php artisan sitemap:generate -->';

        // Generated static/pseo/article/cluster sitemaps
        foreach ($files as $filepath) {
            if (empty($filepath)) continue;
            $filename = basename((string) $filepath);
            $loc      = $this->baseUrl . '/' . $filename;
            $lines[]  = "  <sitemap>";
            $lines[]  = "    <loc>{$loc}</loc>";
            $lines[]  = "    <lastmod>{$this->now}</lastmod>";
            $lines[]  = "  </sitemap>";
        }

        $lines[] = '  <!-- Dynamic sitemaps: served live by SitemapController -->';

        // Controller-generated sitemaps (deduplicated)
        foreach ($controllerEndpoints as $loc) {
            $lines[] = "  <sitemap>";
            $lines[] = "    <loc>{$loc}</loc>";
            $lines[] = "    <lastmod>{$this->now}</lastmod>";
            $lines[] = "  </sitemap>";
        }

        $lines[] = '</sitemapindex>';
        $xml     = implode("\n", $lines);

        $total  = count($generatedFilenames) + count($controllerEndpoints);
        $targetIndex = public_path('sitemap-index.xml');
        File::put($targetIndex, $xml);

        $targetSitemap = public_path('sitemap.xml');
        File::put($targetSitemap, $xml);

        $this->line("   ✓ sitemap-index.xml written to public/ ({$total} unique sub-sitemaps)");
        $this->line("   ✓ sitemap.xml written to public/ ({$total} unique sub-sitemaps)");
    }

    // ════════════════════════════════════════════════════════════════════════
    //  HELPERS
    // ════════════════════════════════════════════════════════════════════════

    /**
     * Render urlset XML and write to public/ or count in dry-run mode.
     *
     * @param  string                                                        $filename
     * @param  array<int, array{loc: string, priority?: string, changefreq?: string, lastmod?: string}>  $entries
     * @param  bool                                                          $dryRun
     * @return string  Absolute path of file (or empty string in dry-run).
     */
    protected function writeXml(string $filename, array $entries, bool $dryRun): string
    {
        $hasImages = false;
        foreach ($entries as $e) {
            if (!empty($e['images'])) {
                $hasImages = true;
                break;
            }
        }

        $lines   = ['<?xml version="1.0" encoding="UTF-8"?>'];
        $lines[] = '<?xml-stylesheet type="text/xsl" href="/sitemap.xsl"?>';
        if ($hasImages) {
            $lines[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'
                     . ' xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"'
                     . ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"'
                     . ' xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9'
                     . ' http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
        } else {
            $lines[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'
                     . ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"'
                     . ' xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9'
                     . ' http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
        }

        foreach ($entries as $entry) {
            $lines[] = '  <url>';
            $lines[] = '    <loc>' . htmlspecialchars($entry['loc'], ENT_XML1, 'UTF-8') . '</loc>';
            if (isset($entry['lastmod'])) {
                $lines[] = '    <lastmod>' . $entry['lastmod'] . '</lastmod>';
            }
            if (isset($entry['changefreq'])) {
                $lines[] = '    <changefreq>' . $entry['changefreq'] . '</changefreq>';
            }
            if (isset($entry['priority'])) {
                $lines[] = '    <priority>' . $entry['priority'] . '</priority>';
            }
            if (!empty($entry['images']) && is_array($entry['images'])) {
                foreach ($entry['images'] as $img) {
                    if (empty($img['loc'])) continue;
                    $lines[] = '    <image:image>';
                    $lines[] = '      <image:loc>' . htmlspecialchars($img['loc'], ENT_XML1, 'UTF-8') . '</image:loc>';
                    if (!empty($img['title'])) {
                        $lines[] = '      <image:title>' . htmlspecialchars($img['title'], ENT_XML1, 'UTF-8') . '</image:title>';
                    }
                    if (!empty($img['caption'])) {
                        $lines[] = '      <image:caption>' . htmlspecialchars($img['caption'], ENT_XML1, 'UTF-8') . '</image:caption>';
                    }
                    $lines[] = '    </image:image>';
                }
            }
            $lines[] = '  </url>';
        }

        $lines[] = '</urlset>';
        $xml     = implode("\n", $lines);

        if ($dryRun) {
            $this->line("   [DRY RUN] Would write {$filename} with " . count($entries) . " URLs.");
            return '';
        }

        $target = public_path($filename);
        File::put($target, $xml);
        $this->line("   ✓ Written: public/{$filename}");

        // Also store in cache so the SitemapController can serve it
        Cache::put("sitemap_file_{$filename}", $xml, 86400);

        return $target;
    }

    /**
     * Force canonical HTTPS URL for all sitemap entries.
     */
    protected function prepareCanonicalUrl(): void
    {
        $domain        = env('SITEMAP_CANONICAL_HOST', 'https://rooteraplumbing.id');
        $this->baseUrl = rtrim($domain, '/');

        URL::forceRootUrl($this->baseUrl);
        URL::forceScheme('https');
    }

    /**
     * Delete any 0-byte or corrupted static sitemap files from public/
     * to prevent web-server route shadowing.
     */
    protected function cleanupEmptyStaticSitemaps(): void
    {
        $patterns = [
            public_path('sitemap.xml'),
            public_path('sitemap-*.xml'),
        ];

        foreach ($patterns as $pattern) {
            $files = glob($pattern) ?: [];
            foreach ($files as $file) {
                if (file_exists($file) && filesize($file) === 0) {
                    @unlink($file);
                    $this->warn('   ⚠️  Deleted 0-byte static file: ' . basename($file));
                }
            }
        }
    }
}
