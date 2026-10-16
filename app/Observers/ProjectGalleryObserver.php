<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\District;
use App\Models\ProjectGallery;
use App\Models\ResidentialCluster;

/**
 * Re-scores the parent cluster/district whenever portfolio evidence changes,
 * so adding/removing a ProjectGallery immediately moves the index gate.
 */
class ProjectGalleryObserver
{
    public function saved(ProjectGallery $gallery): void
    {
        $this->rescore($gallery);
    }

    public function deleted(ProjectGallery $gallery): void
    {
        $this->rescore($gallery);
    }

    private function rescore(ProjectGallery $gallery): void
    {
        $clusterIds  = array_filter([$gallery->residential_cluster_id, $gallery->getOriginal('residential_cluster_id')]);
        $districtIds = array_filter([$gallery->district_id, $gallery->getOriginal('district_id')]);

        ResidentialCluster::whereIn('id', array_unique($clusterIds))->get()->each->save();
        District::whereIn('id', array_unique($districtIds))->get()->each->save();
    }
}
