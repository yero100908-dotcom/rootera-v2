<?php

declare(strict_types=1);

namespace App\Observers;

use App\Http\Controllers\SitemapController;
use App\Models\ResidentialCluster;
use App\Services\Seo\ContentScoreCalculator;

class ResidentialClusterObserver
{
    public function __construct(private readonly ContentScoreCalculator $calculator)
    {
    }

    public function saving(ResidentialCluster $cluster): void
    {
        $galleryCount = $cluster->exists
            ? $cluster->projectGalleries()->where('is_active', true)->count()
            : 0;

        $this->calculator->apply($cluster, $galleryCount);
    }

    public function saved(ResidentialCluster $cluster): void
    {
        $this->flushCaches();
    }

    public function deleted(ResidentialCluster $cluster): void
    {
        $this->flushCaches();
    }

    private function flushCaches(): void
    {
        SitemapController::clearCache();
    }
}
