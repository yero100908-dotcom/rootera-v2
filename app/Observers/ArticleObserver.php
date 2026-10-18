<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Article;
use App\Models\IndexingLog;
use App\Services\Seo\IndexNowService;
use Illuminate\Support\Facades\Log;

class ArticleObserver
{
    public function saved(Article $article): void
    {
        // Only trigger when published and has a valid slug
        if ($article->status !== 'published' || empty($article->slug)) {
            return;
        }

        $baseUrl = config('app.url', 'https://rooteraplumbing.id');
        if (str_contains($baseUrl, 'localhost') || str_contains($baseUrl, '127.0.0.1') || str_contains($baseUrl, '.test') || str_contains($baseUrl, '.local')) {
            $baseUrl = 'https://rooteraplumbing.id';
        }
        $url = rtrim($baseUrl, '/') . "/blog/{$article->slug}";

        // Execute right after the HTTP response is dispatched to browser
        dispatch(function () use ($url) {
            /** @var IndexNowService $indexNowService */
            $indexNowService = app(IndexNowService::class);
            $res = $indexNowService->submitUrl($url);

            IndexingLog::recordAttempt(
                url: $url,
                urlType: 'article',
                action: 'URL_UPDATED',
                status: $res['success'] ? 'success' : 'failed',
                httpStatus: $res['status_code'],
                responseMessage: "Real-time observer: " . $res['message'],
                engine: 'indexnow'
            );

            Log::info("ArticleObserver: IndexNow ping for '{$url}' - Status: {$res['status_code']}");
        })->afterResponse();
    }
}
