<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Article;
use App\Models\IndexingLog;
use App\Services\Seo\IndexNowService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ArticleObserver
{
    public function saved(Article $article): void
    {
        $this->flushBlogCache($article->slug ?? '');

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

    public function deleted(Article $article): void
    {
        $this->flushBlogCache($article->slug ?? '');
    }

    protected function flushBlogCache(string $slug): void
    {
        Cache::forget('blog_hero_ids_v2');
        Cache::forget('blog_hero_headlines_v2');
        Cache::forget('blog_video_ids_v2');
        Cache::forget('blog_video_articles_v2');
        Cache::forget('blog_category_counts_v2');
        Cache::forget('home_page_html_v5');
        if (!empty($slug)) {
            Cache::forget("article_detail_trending_{$slug}");
        }
    }
}

