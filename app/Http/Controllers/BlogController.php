<?php

namespace App\Http\Controllers;

use App\Models\Article;

class BlogController extends Controller
{
    public function index()
    {
        $articles = Article::published()
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $seo = [
            'title'       => 'Blog & Tips Pipa – ROOTERA | Panduan Saluran Air & Sanitasi',
            'description' => 'Baca artikel dan tips terbaru dari ROOTERA seputar cara mengatasi pipa mampet, merawat saluran air, dan panduan sanitasi rumah untuk keluarga sehat.',
            'canonical'   => url('/blog'),
            'og_image'    => asset('images/og-blog.jpg'),
        ];

        return view('pages.blog', compact('articles', 'seo'));
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

        $seo = [
            'title'       => ($article->meta_title ?? $article->title) . ' | ROOTERA',
            'description' => $article->meta_description ?? $article->excerpt,
            'canonical'   => $article->canonical_url ?? url('/blog/' . $article->slug),
            'og_image'    => $article->og_image ? asset('storage/' . $article->og_image) : asset('storage/' . $article->thumbnail),
        ];

        return view('pages.blog-detail', compact('article', 'relatedArticles', 'seo'));
    }
}
