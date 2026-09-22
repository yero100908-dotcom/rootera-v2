<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\City;
use App\Models\ServiceCategory;
use App\Http\Controllers\ProgrammaticSeoController;
use App\Http\Controllers\AreaServiceController;
use Exception;

class WarmupCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:warmup-cache {--limit=500 : Maximum number of URLs to warmup in one run}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pre-render and cache programmatic landing pages to ensure <100ms TTFB for search engines';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $limit = (int) $this->option('limit');
        $this->info("🔥 Starting Programmatic SEO Cache Warmup (Limit: {$limit})...");

        $aliasSlugs = [
            'tangerang-kota', 'kab-tangerang', 'cikarang', 'karawang',
            'sleman', 'sidoarjo', 'gresik', 'solo'
        ];

        $categories = ServiceCategory::where('is_active', true)->get();
        $cities = City::where('is_active', true)
            ->whereNotIn('slug', $aliasSlugs)
            ->with(['districts' => function ($q) {
                $q->where('is_active', true);
            }])
            ->get();

        $progController = app(ProgrammaticSeoController::class);
        $areaController = app(AreaServiceController::class);

        $totalProcessed = 0;
        $successCount = 0;
        $failCount = 0;

        $this->line("📍 Found " . $cities->count() . " active cities and " . $categories->count() . " service categories.");

        // 1. Warmup City Hub Pages
        foreach ($cities as $city) {
            if ($totalProcessed >= $limit) break;
            $totalProcessed++;
            try {
                $areaController->showCity($city->slug);
                $successCount++;
            } catch (Exception $e) {
                $failCount++;
            }
        }

        // 2. Warmup Category + City + District Pages
        foreach ($cities as $city) {
            if ($totalProcessed >= $limit) break;

            foreach ($categories as $category) {
                if ($totalProcessed >= $limit) break;

                // City level spoke
                $totalProcessed++;
                try {
                    $progController->show($category->slug, $city->slug);
                    $successCount++;
                } catch (Exception $e) {
                    $failCount++;
                }

                // District level spokes
                foreach ($city->districts as $district) {
                    if ($totalProcessed >= $limit) break;
                    $totalProcessed++;
                    try {
                        $progController->show($category->slug, $city->slug, $district->slug);
                        $successCount++;
                    } catch (Exception $e) {
                        $failCount++;
                    }
                }
            }
        }

        $this->newLine();
        $this->info("✅ Cache Warmup Completed!");
        $this->info("📊 Total Pages Warmed Up: <comment>{$successCount}/{$totalProcessed}</comment> (Failures: {$failCount})");

        return 0;
    }
}
