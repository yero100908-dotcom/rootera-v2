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

        // Category counts for pill badges
        $counts = [
            'all' => Gallery::where('is_active', true)->count(),
            'residential' => Gallery::where('is_active', true)->where('category', 'residential')->count(),
            'commercial_resto' => Gallery::where('is_active', true)->where('category', 'commercial_resto')->count(),
            'commercial_b2b' => Gallery::where('is_active', true)->where('category', 'commercial_b2b')->count(),
            'cctv_inspection' => Gallery::where('is_active', true)->where('category', 'cctv_inspection')->count(),
            'before_after' => Gallery::where('is_active', true)->where('category', 'before_after')->count(),
            'video' => Gallery::where('is_active', true)->where('media_type', 'video')->count(),
        ];

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

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'html' => view('pages.gallery.partials.gallery_grid', compact('galleries'))->render(),
                'hasMore' => $galleries->hasMorePages(),
                'currentPage' => $galleries->currentPage(),
                'nextPageUrl' => $galleries->nextPageUrl(),
                'total' => $galleries->total(),
            ]);
        }

        // SEO metadata
        $seo = [
            'title' => 'Galeri & Dokumentasi Pekerjaan Pipa Mampet Real',
            'description' => 'Dokumentasi riil video pengerjaan pelancaran pipa mampet, foto komparasi sebelum-sesudah (before-after), & aksi teknisi profesional Rootera Plumbing.',
            'canonical' => $galleries->currentPage() > 1 ? $galleries->url($galleries->currentPage()) : route('galeri'),
            'is_indexable' => true,
            'prev_page_url' => $galleries->previousPageUrl(),
            'next_page_url' => $galleries->nextPageUrl(),
        ];

        return view('pages.gallery.index', compact('galleries', 'featuredProject', 'category', 'mediaType', 'counts', 'seo'));
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

        $seoTitle = $project->title . ($project->location_tag ? ' di ' . $project->location_tag : '') . ' | Dokumentasi Rootera';
        $seoDesc = Str::limit(($project->description ? $project->description . ' — ' : '') . 'Studi kasus pengerjaan pelancaran pipa mampet ' . $project->title . ' di ' . ($project->location_tag ?? 'Jabodetabek') . ' oleh teknisi profesional Rootera Plumbing tanpa bongkar & garansi 30 hari.', 160);

        $seo = [
            'title' => $seoTitle,
            'description' => $seoDesc,
            'canonical' => route('galeri.show', $project->slug),
            'og_image' => $project->display_thumbnail,
            'is_indexable' => true,
        ];

        return view('pages.gallery.show', compact('project', 'relatedProjects', 'seo'));
    }
}
