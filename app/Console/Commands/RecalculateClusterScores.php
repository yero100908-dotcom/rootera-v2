<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\ResidentialCluster;
use App\Services\Seo\ContentScoreCalculator;
use Illuminate\Console\Command;

/**
 * Recalculates ContentScore for all ResidentialCluster records.
 *
 * Usage:
 *   php artisan clusters:recalculate-scores
 *   php artisan clusters:recalculate-scores --dry-run   # show without saving
 */
class RecalculateClusterScores extends Command
{
    protected $signature   = 'clusters:recalculate-scores {--dry-run : Show scores without saving}';
    protected $description = 'Recalculate ContentScore for every ResidentialCluster and enforce the indexing gate.';

    public function __construct(private readonly ContentScoreCalculator $calculator)
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $dryRun   = $this->option('dry-run');
        $clusters = ResidentialCluster::with('projectGalleries')->get();

        $this->table(
            ['Name', 'Score', 'Indexable', 'Galleries'],
            $clusters->map(function (ResidentialCluster $cluster) use ($dryRun): array {
                $galleryCount = $cluster->projectGalleries->count();
                $result       = $this->calculator->calculate($cluster, $galleryCount);
                $score        = $result['score'];
                $indexable    = $score >= ContentScoreCalculator::THRESHOLD;

                if (! $dryRun) {
                    $cluster->content_score = $score;
                    $cluster->is_indexable  = $indexable;
                    // Save without firing observers to avoid re-triggering loop
                    $cluster->saveQuietly();
                }

                return [
                    $cluster->name,
                    $score,
                    $indexable ? '<fg=green>✔ YES</>' : '<fg=red>✘ NO</>',
                    $galleryCount,
                ];
            })->toArray()
        );

        $updated = $clusters->where('content_score', '>=', ContentScoreCalculator::THRESHOLD)->count();

        $this->info($dryRun
            ? "[DRY-RUN] No changes saved. {$updated}/{$clusters->count()} clusters would be indexable."
            : "Scores updated. {$updated}/{$clusters->count()} clusters are now indexable."
        );

        return self::SUCCESS;
    }
}
