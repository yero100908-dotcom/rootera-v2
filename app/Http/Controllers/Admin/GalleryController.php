<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $photos = GalleryPhoto::orderBy('sort_order')->paginate(20);
        return view('admin.gallery.index', compact('photos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:150',
            'youtube_url' => 'required|string',
            'description' => 'nullable|string|max:300',
            'category'    => 'nullable|string|max:50',
            'sort_order'  => 'nullable|integer',
        ]);

        $youtube_id = $this->extractYoutubeId($request->youtube_url);
        if (!$youtube_id) {
            return back()->withErrors(['youtube_url' => 'Format URL YouTube tidak valid.'])->withInput();
        }
        $validated['youtube_id'] = $youtube_id;
        $validated['image'] = '-'; // dummy data

        GalleryPhoto::create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Data galeri berhasil ditambahkan.');
    }

    public function update(Request $request, GalleryPhoto $galleryPhoto)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:150',
            'youtube_url' => 'required|string',
            'description' => 'nullable|string|max:300',
            'category'    => 'nullable|string|max:50',
            'sort_order'  => 'nullable|integer',
        ]);

        $youtube_id = $this->extractYoutubeId($request->youtube_url);
        if (!$youtube_id) {
            return back()->withErrors(['youtube_url' => 'Format URL YouTube tidak valid.'])->withInput();
        }
        $validated['youtube_id'] = $youtube_id;
        
        // Remove image if there was any file previously
        if ($galleryPhoto->image && $galleryPhoto->image !== '-') {
            Storage::disk('public')->delete($galleryPhoto->image);
        }
        $validated['image'] = '-';

        $galleryPhoto->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Data galeri berhasil diperbarui.');
    }

    public function destroy(GalleryPhoto $galleryPhoto)
    {
        if ($galleryPhoto->image && $galleryPhoto->image !== '-') {
            Storage::disk('public')->delete($galleryPhoto->image);
        }
        $galleryPhoto->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Data galeri berhasil dihapus.');
    }

    private function extractYoutubeId($url)
    {
        preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=|shorts\/))([\w-]{11})/', $url, $match);
        return $match[1] ?? null;
    }

    public function toggleActive(GalleryPhoto $galleryPhoto)
    {
        $galleryPhoto->update(['is_active' => !$galleryPhoto->is_active]);
        return redirect()->back()->with('success', 'Status foto diperbarui.');
    }
}
