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
            'image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
            'description' => 'nullable|string|max:300',
            'category'    => 'nullable|string|max:50',
            'sort_order'  => 'nullable|integer',
        ]);

        $validated['image'] = $request->file('image')->store('gallery', 'public');

        GalleryPhoto::create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto berhasil ditambahkan.');
    }

    public function update(Request $request, GalleryPhoto $galleryPhoto)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:150',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'description' => 'nullable|string|max:300',
            'category'    => 'nullable|string|max:50',
            'sort_order'  => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($galleryPhoto->image);
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        $galleryPhoto->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Data foto berhasil diperbarui.');
    }

    public function destroy(GalleryPhoto $galleryPhoto)
    {
        Storage::disk('public')->delete($galleryPhoto->image);
        $galleryPhoto->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto berhasil dihapus.');
    }

    public function toggleActive(GalleryPhoto $galleryPhoto)
    {
        $galleryPhoto->update(['is_active' => !$galleryPhoto->is_active]);
        return redirect()->back()->with('success', 'Status foto diperbarui.');
    }
}
