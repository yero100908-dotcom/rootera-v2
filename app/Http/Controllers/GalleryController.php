<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of public hybrid gallery items.
     */
    public function index(Request $request)
    {
        $category = $request->query('category');
        $mediaType = $request->query('media_type');

        // Featured project for Hero Showcase
        $featuredProject = Gallery::where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->first();

        // Main Query
        $query = Gallery::where('is_active', true);

        if ($category && $category !== 'all') {
            $query->where('category', $category);
        }

        if ($mediaType && $mediaType !== 'all') {
            $query->where('media_type', $mediaType);
        }

        $galleries = $query->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        // SEO metadata
        $seo = [
            'title' => 'Galeri & Dokumentasi Pekerjaan Pipa Mampet Real',
            'description' => 'Dokumentasi riil video pengerjaan pelancaran pipa mampet, foto komparasi sebelum-sesudah (before-after), & aksi teknisi profesional Rootera Plumbing.',
            'canonical' => route('galeri'),
            'is_indexable' => true,
        ];

        return view('pages.gallery.index', compact('galleries', 'featuredProject', 'category', 'mediaType', 'seo'));
    }

    /**
     * Display a single gallery project case study detail page.
     */
    public function show($slug)
    {
        $project = Gallery::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedProjects = Gallery::where('is_active', true)
            ->where('id', '!=', $project->id)
            ->where('category', $project->category)
            ->take(3)
            ->get();

        $seo = [
            'title' => $project->title . ' | Dokumentasi Rootera Plumbing',
            'description' => Str::limit($project->description ?? 'Studi kasus dokumentasi pengerjaan pelancaran pipa mampet ' . $project->title . ' oleh tim teknisi profesional Rootera Plumbing.', 160),
            'canonical' => route('galeri.show', $project->slug),
            'og_image' => $project->display_thumbnail,
            'is_indexable' => true,
        ];

        return view('pages.gallery.show', compact('project', 'relatedProjects', 'seo'));
    }
}
