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
        $this->pingIndexNow($gallery);
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

    private function pingIndexNow(ProjectGallery $gallery): void
    {
        if (!$gallery->is_active || empty($gallery->slug)) {
            return;
        }

        $baseUrl = config('app.url', 'https://rooteraplumbing.id');
        if (str_contains($baseUrl, 'localhost') || str_contains($baseUrl, '127.0.0.1') || str_contains($baseUrl, '.test') || str_contains($baseUrl, '.local')) {
            $baseUrl = 'https://rooteraplumbing.id';
        }
        $url = rtrim($baseUrl, '/') . "/galeri/{$gallery->slug}";

        dispatch(function () use ($url) {
            /** @var \App\Services\Seo\IndexNowService $indexNowService */
            $indexNowService = app(\App\Services\Seo\IndexNowService::class);
            $res = $indexNowService->submitUrl($url);

            \App\Models\IndexingLog::recordAttempt(
                url: $url,
                urlType: 'gallery',
                action: 'URL_UPDATED',
                status: $res['success'] ? 'success' : 'failed',
                httpStatus: $res['status_code'],
                responseMessage: "Real-time observer: " . $res['message'],
                engine: 'indexnow'
            );
        })->afterResponse();
    }
}
