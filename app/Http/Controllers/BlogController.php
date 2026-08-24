<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $search = $request->query('search') ?: $request->query('q');
        $tag = $request->query('tag');

        // Featured Spotlight (top 1 video or top published article)
        $featuredSpotlight = Article::published()
            ->whereNotNull('youtube_video_id')
            ->orderBy('published_at', 'desc')
            ->first();

        if (!$featuredSpotlight) {
            $featuredSpotlight = Article::published()
                ->orderBy('published_at', 'desc')
                ->first();
        }

        // Main Query
        $query = Article::published();

        if ($filter === 'article') {
            $query->where(function($q) {
                $q->whereNull('post_type')
                  ->orWhere('post_type', 'article');
            })->whereNull('youtube_video_id');
        } elseif ($filter === 'video') {
            $query->where(function($q) {
                $q->where('post_type', 'video_guide')
                  ->orWhereNotNull('youtube_video_id');
            });
        }

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if (!empty($tag)) {
            $query->where(function($q) use ($tag) {
                $q->where('title', 'like', "%{$tag}%")
                  ->orWhere('excerpt', 'like', "%{$tag}%")
                  ->orWhere('category', 'like', "%{$tag}%");
            });
        }

        $articles = $query->orderBy('published_at', 'desc')
            ->paginate(9);

        $seo = [
            'title'       => 'Blog & Knowledge Hub – Rootera | Panduan Pipa & Video Edukasi',
            'description' => 'Pusat edukasi visual, artikel teknis, & panduan video pelancaran pipa mampet, hydro-jetting, & sanitasi rumah dari tim ahli Rootera Plumbing.',
            'canonical'   => url('/blog'),
            'og_image'    => asset('images/JnJ.jpeg'),
        ];

        return view('pages.blog', compact('articles', 'featuredSpotlight', 'filter', 'search', 'tag', 'seo'));
    }

    public function show(string $slug)
    {
        $article = Article::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $article->incrementViews();

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

        $seo = [
            'title'       => ($article->meta_title ?? $article->clean_title) . ' | Rootera',
            'description' => $article->meta_description ?? $article->excerpt,
            'canonical'   => $article->canonical_url ?? url('/blog/' . $article->slug),
            'og_image'    => $article->og_image ? asset('storage/' . $article->og_image) : ($article->thumbnail_url ?? asset('images/JnJ.jpeg')),
        ];

        return view('pages.blog-detail', compact('article', 'relatedArticles', 'cities', 'allCategories', 'projectShowcases', 'seo'));
    }
}
