<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\IndexingLog;
use App\Models\ServiceCategory;
use App\Services\Seo\IndexNowService;
use Illuminate\Support\Facades\Log;

class ServiceCategoryObserver
{
    public function saved(ServiceCategory $serviceCategory): void
    {
        if (!$serviceCategory->is_active || empty($serviceCategory->slug)) {
            return;
        }

        $baseUrl = config('app.url', 'https://rooteraplumbing.id');
        if (str_contains($baseUrl, 'localhost') || str_contains($baseUrl, '127.0.0.1') || str_contains($baseUrl, '.test') || str_contains($baseUrl, '.local')) {
            $baseUrl = 'https://rooteraplumbing.id';
        }
        $url = rtrim($baseUrl, '/') . "/layanan/{$serviceCategory->slug}";

        dispatch(function () use ($url) {
            /** @var IndexNowService $indexNowService */
            $indexNowService = app(IndexNowService::class);
            $res = $indexNowService->submitUrl($url);

            IndexingLog::recordAttempt(
                url: $url,
                urlType: 'service_category',
                action: 'URL_UPDATED',
                status: $res['success'] ? 'success' : 'failed',
                httpStatus: $res['status_code'],
                responseMessage: "Real-time observer: " . $res['message'],
                engine: 'indexnow'
            );

            Log::info("ServiceCategoryObserver: IndexNow ping for '{$url}' - Status: {$res['status_code']}");
        })->afterResponse();
    }
}
