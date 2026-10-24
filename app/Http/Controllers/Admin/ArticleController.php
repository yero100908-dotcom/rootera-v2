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
    public function index(Request $request)
    {
        $currentType = $request->query('type', 'all');
        $query = Article::orderBy('created_at', 'desc');

        if ($currentType !== 'all' && in_array($currentType, array_keys(Article::POST_TYPES))) {
            $query->where('post_type', $currentType);
        }

        $articles = $query->paginate(15)->withQueryString();

        $counts = [
            'all'           => Article::count(),
            'article'       => Article::where('post_type', Article::TYPE_ARTICLE)->count(),
            'promo'         => Article::where('post_type', Article::TYPE_PROMO)->count(),
            'news'          => Article::where('post_type', Article::TYPE_NEWS)->count(),
            'case_study'    => Article::where('post_type', Article::TYPE_CASE_STUDY)->count(),
            'press_release' => Article::where('post_type', Article::TYPE_PRESS_RELEASE)->count(),
            'video_guide'   => Article::where('post_type', Article::TYPE_VIDEO_GUIDE)->count(),
        ];

        return view('admin.articles.index', compact('articles', 'currentType', 'counts'));
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
            'post_type'        => 'required|in:' . implode(',', array_keys(Article::POST_TYPES)),
            'promo_end_date'   => 'nullable|required_if:post_type,promo|date',
            'location_geo'     => 'nullable|string|max:255',
            'client_name'      => 'nullable|string|max:255',
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
        ], [
            'promo_end_date.required_if' => 'Batas waktu promo wajib diisi jika tipe konten adalah Promo Khusus.',
            'post_type.required'         => 'Tipe postingan wajib dipilih.',
            'post_type.in'               => 'Tipe postingan yang dipilih tidak valid.',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['is_headline'] = $request->boolean('is_headline');
        $validated['is_featured'] = $request->boolean('is_featured');

        // Sanitasi field komersial / video sesuai post_type yang aktif
        if ($validated['post_type'] !== Article::TYPE_PROMO) {
            $validated['promo_end_date'] = null;
        }
        if ($validated['post_type'] !== Article::TYPE_CASE_STUDY) {
            $validated['location_geo'] = null;
            $validated['client_name'] = null;
        }
        if ($validated['post_type'] !== Article::TYPE_VIDEO_GUIDE) {
            $validated['youtube_video_id'] = null;
        } elseif (!empty($validated['youtube_video_id'])) {
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
            'post_type'        => 'required|in:' . implode(',', array_keys(Article::POST_TYPES)),
            'promo_end_date'   => 'nullable|required_if:post_type,promo|date',
            'location_geo'     => 'nullable|string|max:255',
            'client_name'      => 'nullable|string|max:255',
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
        ], [
            'promo_end_date.required_if' => 'Batas waktu promo wajib diisi jika tipe konten adalah Promo Khusus.',
            'post_type.required'         => 'Tipe postingan wajib dipilih.',
            'post_type.in'               => 'Tipe postingan yang dipilih tidak valid.',
        ]);

        $oldSlug = $article->slug;

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['is_headline'] = $request->boolean('is_headline');
        $validated['is_featured'] = $request->boolean('is_featured');

        // Sanitasi field komersial / video sesuai post_type yang aktif
        if ($validated['post_type'] !== Article::TYPE_PROMO) {
            $validated['promo_end_date'] = null;
        }
        if ($validated['post_type'] !== Article::TYPE_CASE_STUDY) {
            $validated['location_geo'] = null;
            $validated['client_name'] = null;
        }
        if ($validated['post_type'] !== Article::TYPE_VIDEO_GUIDE) {
            $validated['youtube_video_id'] = null;
        } elseif (!empty($validated['youtube_video_id'])) {
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

