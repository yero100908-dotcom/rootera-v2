<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\City;
use App\Models\ServiceCategory;
use App\Models\ResidentialCluster;
use App\Http\Controllers\ProgrammaticSeoController;
use App\Http\Controllers\AreaServiceController;
use App\Http\Controllers\ClusterSeoController;
use Exception;

class WarmupCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:warmup-cache {--limit=1000 : Maximum number of URLs to warmup in one run}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pre-render and cache programmatic landing pages (Services, Cities, Districts, Clusters) for <100ms TTFB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $limit = (int) $this->option('limit');
        $this->info("🔥 Memulai Cache Warmup Programmatic SEO (Limit: {$limit})...");

        $aliasSlugs = [
            'tangerang-kota', 'kab-tangerang', 'cikarang', 'karawang',
            'sleman', 'sidoarjo', 'gresik', 'solo',
        ];

        $categories = ServiceCategory::where('is_active', true)->orderBy('sort_order')->get();
        $cities = City::where('is_active', true)
            ->whereNotIn('slug', $aliasSlugs)
            ->with(['districts' => fn($q) => $q->where('is_active', true)->where('is_indexable', true)])
            ->get();

        $clusters = class_exists(ResidentialCluster::class)
            ? ResidentialCluster::indexable()->take(100)->get()
            : collect();

        $progController    = app(ProgrammaticSeoController::class);
        $areaController    = app(AreaServiceController::class);
        $clusterController = app(ClusterSeoController::class);

        $totalProcessed = 0;
        $successCount   = 0;
        $failCount      = 0;

        $bar = $this->output->createProgressBar($limit);
        $bar->start();

        // 1. Warmup Canonical Service × City Hub (/layanan/{service}/{city})
        foreach ($categories as $category) {
            foreach ($cities as $city) {
                if ($totalProcessed >= $limit) break 2;
                $totalProcessed++;
                try {
                    $progController->showService($category->slug, $city->slug);
                    $successCount++;
                } catch (Exception $e) {
                    $failCount++;
                }
                $bar->advance();
            }
        }

        // 2. Warmup City Hubs (/jasa-saluran-mampet/{city})
        foreach ($cities as $city) {
            if ($totalProcessed >= $limit) break;
            $totalProcessed++;
            try {
                $areaController->showCity($city->slug);
                $successCount++;
            } catch (Exception $e) {
                $failCount++;
            }
            $bar->advance();
        }

        // 3. Warmup District Spokes (/jasa-saluran-mampet/{city}/{district})
        foreach ($cities as $city) {
            foreach ($city->districts as $district) {
                if ($totalProcessed >= $limit) break 2;
                $totalProcessed++;
                try {
                    $areaController->showDistrict($city->slug, $district->slug);
                    $successCount++;
                } catch (Exception $e) {
                    $failCount++;
                }
                $bar->advance();
            }
        }

        // 4. Warmup Hyper-Local Residential Clusters (/area-perumahan/{cluster})
        foreach ($clusters as $cluster) {
            if ($totalProcessed >= $limit) break;
            $totalProcessed++;
            try {
                $clusterController->show($cluster->slug);
                $successCount++;
            } catch (Exception $e) {
                $failCount++;
            }
            $bar->advance();

            // Intersect dengan Top 2 Category
            foreach ($categories->take(2) as $category) {
                if ($totalProcessed >= $limit) break 2;
                $totalProcessed++;
                try {
                    $clusterController->service($cluster->slug, $category->slug);
                    $successCount++;
                } catch (Exception $e) {
                    $failCount++;
                }
                $bar->advance();
            }
        }

        // Garbage collection untuk mencegah memory leak
        if (function_exists('gc_collect_cycles')) {
            gc_collect_cycles();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("✅ Cache Warmup Berhasil Diselesaikan!");
        $this->info("📊 Berhasil Dipanaskan: {$successCount}/{$totalProcessed} Halaman (Gagal: {$failCount})");

        return Command::SUCCESS;
    }
}
