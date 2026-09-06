<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $filterCategory = $request->query('category', 'all');
        $filterType     = $request->query('filter', 'all');
        $search         = $request->query('search') ?: $request->query('q');
        $tag            = $request->query('tag');

        // 1. Hero Headline (60% Slot)
        $headline = Article::published()
            ->headline()
            ->orderBy('published_at', 'desc')
            ->first();

        if (!$headline) {
            $headline = Article::published()
                ->orderBy('published_at', 'desc')
                ->first();
        }

        $excludedIds = $headline ? [$headline->id] : [];

        // 2. Side Headlines (40% Slot - 3 items)
        $sideHeadlines = Article::published()
            ->whereNotIn('id', $excludedIds)
            ->featured()
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        if ($sideHeadlines->count() < 3) {
            $existingSideIds = array_merge($excludedIds, $sideHeadlines->pluck('id')->toArray());
            $needed = 3 - $sideHeadlines->count();
            
            $additionalSides = Article::published()
                ->whereNotIn('id', $existingSideIds)
                ->orderBy('views', 'desc')
                ->orderBy('published_at', 'desc')
                ->take($needed)
                ->get();

            $sideHeadlines = $sideHeadlines->concat($additionalSides);
        }

        $heroExcludedIds = array_merge($excludedIds, $sideHeadlines->pluck('id')->toArray());

        // 3. Dedicated Video Guides (Rootera TV)
        $videoArticles = Article::published()
            ->where(function($q) {
                $q->where('post_type', 'video_guide')
                  ->orWhereNotNull('youtube_video_id');
            })
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get();

        // 4. Categories pillars & post counts (Single optimized aggregate query)
        $categories = Article::CATEGORIES;
        $countsRaw = Article::published()
            ->selectRaw('category, count(*) as total')
            ->groupBy('category')
            ->pluck('total', 'category');

        $categoryCounts = [];
        foreach ($categories as $catKey => $catLabel) {
            $categoryCounts[$catKey] = (int) ($countsRaw[$catKey] ?? 0);
        }

        // 5. Main Feed Query
        $query = Article::published();

        // Category Filter
        if ($filterCategory !== 'all' && isset($categories[$filterCategory])) {
            $query->where('category', $filterCategory);
        }

        // Type Filter (Article vs Video)
        if ($filterType === 'article') {
            $query->where(function($q) {
                $q->whereNull('post_type')
                  ->orWhere('post_type', 'article');
            })->whereNull('youtube_video_id');
        } elseif ($filterType === 'video') {
            $query->where(function($q) {
                $q->where('post_type', 'video_guide')
                  ->orWhereNotNull('youtube_video_id');
            });
        }

        // Search Filter
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Tag Filter
        if (!empty($tag)) {
            $query->where(function($q) use ($tag) {
                $q->where('title', 'like', "%{$tag}%")
                  ->orWhere('excerpt', 'like', "%{$tag}%")
                  ->orWhere('category', 'like', "%{$tag}%");
            });
        }

        // Exclude hero articles from main feed if default view without filters
        if ($filterCategory === 'all' && $filterType === 'all' && empty($search) && empty($tag)) {
            $query->whereNotIn('id', $heroExcludedIds);
        }

        $articles = $query->orderBy('published_at', 'desc')
            ->paginate(9);

        // Retain backward compatibility
        $featuredSpotlight = $headline;
        $filter = $filterType;

        $seo = [
            'title'       => 'Rootera News & Tech – Portal Berita Plumbing & Panduan Teknis Modern',
            'description' => 'Portal berita plumbing modern, artikel teknis sanitasi rumah & komersial B2B, komparasi material, serta video tutorial dari teknisi profesional Rootera.',
            'canonical'   => url('/blog'),
            'og_image'    => $headline ? $headline->thumbnail_url : asset('images/JnJ.jpeg'),
        ];

        return view('pages.blog', compact(
            'headline',
            'sideHeadlines',
            'videoArticles',
            'articles',
            'categories',
            'categoryCounts',
            'featuredSpotlight',
            'filterCategory',
            'filterType',
            'filter',
            'search',
            'tag',
            'seo'
        ));
    }

    public function show(string $slug)
    {
        $article = Article::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $article->incrementViews();

        $previousArticle = Article::published()
            ->where('id', '<', $article->id)
            ->orderBy('id', 'desc')
            ->first();

        $nextArticle = Article::published()
            ->where('id', '>', $article->id)
            ->orderBy('id', 'asc')
            ->first();

        $trendingArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->orderBy('views', 'desc')
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        $relatedArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $cities = \App\Models\City::where('is_active', true)
            ->with('province')
            ->orderBy('sort_order')
            ->take(12)
            ->get();

        $allCategories = \App\Models\ServiceCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $projectShowcases = \App\Models\ProjectGallery::where('is_active', true)
            ->with(['district', 'city'])
            ->take(3)
            ->get();

        $rawTitle = $article->meta_title ?: ($article->clean_title ?? $article->title);
        $seoTitle = (mb_strlen($rawTitle) > 65) ? mb_strimwidth($rawTitle, 0, 63, '..') : $rawTitle;

        $seo = [
            'title'          => $seoTitle,
            'description'    => $article->meta_description ?? $article->excerpt,
            'canonical'      => $article->canonical_url ?? url('/blog/' . $article->slug),
            'og_image'       => $article->og_image ? asset('storage/' . $article->og_image) : ($article->thumbnail_url ?? asset('images/JnJ.jpeg')),
            'og_type'        => 'article',
            'published_time' => $article->published_at?->toIso8601String(),
            'modified_time'  => $article->updated_at?->toIso8601String(),
            'section'        => $article->category ?? 'Tips Rumah',
        ];

        return view('pages.blog-detail', compact(
            'article',
            'previousArticle',
            'nextArticle',
            'trendingArticles',
            'relatedArticles',
            'cities',
            'allCategories',
            'projectShowcases',
            'seo'
        ));
    }
}
