<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\District;
use App\Services\Seo\ContentScoreCalculator;

class DistrictObserver
{
    public function __construct(private readonly ContentScoreCalculator $calculator)
    {
    }

    public function saving(District $district): void
    {
        $galleryCount = $district->exists
            ? $district->projectGalleries()->where('is_active', true)->count()
            : 0;

        $this->calculator->apply($district, $galleryCount);
    }
}
