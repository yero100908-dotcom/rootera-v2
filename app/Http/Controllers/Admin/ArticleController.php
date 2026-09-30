<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.form', ['article' => new Article(), 'mode' => 'create']);
    }

    public function store(Request $request, \App\Services\WebpConverterService $webpService)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|unique:articles,slug|max:255',
            'category'         => 'nullable|string|max:100',
            'post_type'        => 'required|in:article,video_guide',
            'youtube_video_id' => 'nullable|string|max:255',
            'excerpt'          => 'nullable|string|max:500',
            'content'          => 'required|string',
            'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png,webp,bmp,gif,svg|max:5120',
            'author'           => 'nullable|string|max:100',
            'status'           => 'required|in:draft,published',
            'published_at'     => 'nullable|date',
            'is_headline'      => 'nullable|boolean',
            'is_featured'      => 'nullable|boolean',
            'read_time'        => 'nullable|integer|min:1|max:300',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['is_headline'] = $request->boolean('is_headline');
        $validated['is_featured'] = $request->boolean('is_featured');

        // Extract YouTube Video ID if a full URL was pasted
        if (!empty($validated['youtube_video_id'])) {
            $rawVideo = trim($validated['youtube_video_id']);
            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $rawVideo, $matches)) {
                $validated['youtube_video_id'] = $matches[1];
            }
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $webpService->convertAndStore($request->file('thumbnail'), 'articles');
        }

        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $article = Article::create($validated);
        $this->clearArticleCache($article->slug);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.form', compact('article') + ['mode' => 'edit']);
    }

    public function update(Request $request, Article $article, \App\Services\WebpConverterService $webpService)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|unique:articles,slug,' . $article->id . '|max:255',
            'category'         => 'nullable|string|max:100',
            'post_type'        => 'required|in:article,video_guide',
            'youtube_video_id' => 'nullable|string|max:255',
            'excerpt'          => 'nullable|string|max:500',
            'content'          => 'required|string',
            'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png,webp,bmp,gif,svg|max:5120',
            'author'           => 'nullable|string|max:100',
            'status'           => 'required|in:draft,published',
            'published_at'     => 'nullable|date',
            'is_headline'      => 'nullable|boolean',
            'is_featured'      => 'nullable|boolean',
            'read_time'        => 'nullable|integer|min:1|max:300',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
        ]);

        $oldSlug = $article->slug;

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['is_headline'] = $request->boolean('is_headline');
        $validated['is_featured'] = $request->boolean('is_featured');

        // Extract YouTube Video ID if a full URL was pasted
        if (!empty($validated['youtube_video_id'])) {
            $rawVideo = trim($validated['youtube_video_id']);
            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $rawVideo, $matches)) {
                $validated['youtube_video_id'] = $matches[1];
            }
        }

        if ($request->hasFile('thumbnail')) {
            $webpService->deleteIfExists($article->thumbnail);
            $validated['thumbnail'] = $webpService->convertAndStore($request->file('thumbnail'), 'articles');
        }

        if ($validated['status'] === 'published' && empty($article->published_at) && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $article->update($validated);
        $this->clearArticleCache($article->slug, $oldSlug);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article, \App\Services\WebpConverterService $webpService)
    {
        $slug = $article->slug;
        $webpService->deleteIfExists($article->thumbnail);
        $article->delete();
        $this->clearArticleCache($slug);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }

    /**
     * Perform targeted cache invalidation when articles are mutated.
     */
    protected function clearArticleCache(string $slug, ?string $oldSlug = null)
    {
        Cache::forget('blog_index_page_v1');
        Cache::forget('blog_recent_articles');
        Cache::forget("article_show_{$slug}");
        if ($oldSlug && $oldSlug !== $slug) {
            Cache::forget("article_show_{$oldSlug}");
        }
        Cache::forget('home_page_html_v5');
    }
}

