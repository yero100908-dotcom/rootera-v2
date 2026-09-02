<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Helpers\YouTubeHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
            'excerpt'          => 'nullable|string|max:500',
            'content'          => 'required|string',
            'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png,webp,bmp,gif,svg|max:5120',
            'author'           => 'nullable|string|max:100',
            'status'           => 'required|in:draft,published',
            'published_at'     => 'nullable|date',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
            'youtube_video_id' => 'nullable|string|max:255',
            'category'         => 'nullable|string|max:100',
            'post_type'        => 'nullable|string|max:50',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);

        if (!empty($validated['youtube_video_id'])) {
            $extractedId = YouTubeHelper::extractId($validated['youtube_video_id']);
            $validated['youtube_video_id'] = $extractedId;
            $validated['video_embed_url'] = YouTubeHelper::getEmbedUrl($extractedId);
            if (empty($validated['post_type'])) {
                $validated['post_type'] = 'video_guide';
            }
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $webpService->convertAndStore($request->file('thumbnail'), 'articles');
        }

        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        Article::create($validated);

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
            'excerpt'          => 'nullable|string|max:500',
            'content'          => 'required|string',
            'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png,webp,bmp,gif,svg|max:5120',
            'author'           => 'nullable|string|max:100',
            'status'           => 'required|in:draft,published',
            'published_at'     => 'nullable|date',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
            'youtube_video_id' => 'nullable|string|max:255',
            'category'         => 'nullable|string|max:100',
            'post_type'        => 'nullable|string|max:50',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);

        if (!empty($validated['youtube_video_id'])) {
            $extractedId = YouTubeHelper::extractId($validated['youtube_video_id']);
            $validated['youtube_video_id'] = $extractedId;
            $validated['video_embed_url'] = YouTubeHelper::getEmbedUrl($extractedId);
            if (empty($validated['post_type'])) {
                $validated['post_type'] = 'video_guide';
            }
        } else {
            $validated['youtube_video_id'] = null;
            $validated['video_embed_url'] = null;
        }

        if ($request->hasFile('thumbnail')) {
            $webpService->deleteIfExists($article->thumbnail);
            $validated['thumbnail'] = $webpService->convertAndStore($request->file('thumbnail'), 'articles');
        }

        if ($validated['status'] === 'published' && empty($article->published_at) && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article, \App\Services\WebpConverterService $webpService)
    {
        $webpService->deleteIfExists($article->thumbnail);
        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}

