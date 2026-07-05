<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|unique:articles,slug|max:255',
            'excerpt'          => 'nullable|string|max:500',
            'content'          => 'required|string',
            'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'author'           => 'nullable|string|max:100',
            'status'           => 'required|in:draft,published',
            'published_at'     => 'nullable|date',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
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

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|unique:articles,slug,' . $article->id . '|max:255',
            'excerpt'          => 'nullable|string|max:500',
            'content'          => 'required|string',
            'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'author'           => 'nullable|string|max:100',
            'status'           => 'required|in:draft,published',
            'published_at'     => 'nullable|date',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);

        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail) Storage::disk('public')->delete($article->thumbnail);
            $validated['thumbnail'] = $request->file('thumbnail')->store('articles', 'public');
        }

        if ($validated['status'] === 'published' && empty($article->published_at) && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        if ($article->thumbnail) Storage::disk('public')->delete($article->thumbnail);
        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}
