<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('media_type')) {
            $query->where('media_type', $request->media_type);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $galleries = $query->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.gallery.index', compact('galleries'));
    }

    public function store(Request $request, \App\Services\WebpConverterService $webpService)
    {
        $validated = $request->validate([
            'title'               => 'required|string|max:200',
            'category'            => 'required|string',
            'media_type'          => 'required|in:image,video',
            'thumbnail_file'      => 'nullable|image|max:5120',
            'thumbnail_path'      => 'nullable|string',
            'media_file'          => 'nullable|file|mimes:mp4,webm,mov,jpg,jpeg,png,webp,bmp,gif,svg|max:30720',
            'external_media_url'  => 'nullable|url',
            'before_image_file'   => 'nullable|image|max:5120',
            'location_tag'        => 'nullable|string|max:100',
            'related_service_url' => 'nullable|string|max:255',
            'description'         => 'nullable|string',
            'is_featured'         => 'nullable|boolean',
            'sort_order'          => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail_file')) {
            $validated['thumbnail_path'] = $webpService->convertAndStore($request->file('thumbnail_file'), 'galleries/thumbnails');
        } elseif (empty($validated['thumbnail_path'])) {
            $validated['thumbnail_path'] = 'images/JnJ.jpeg';
        }

        // Handle main media file upload (Image converted to WebP, Video saved as-is)
        if ($request->hasFile('media_file')) {
            $file = $request->file('media_file');
            $mime = $file->getMimeType();
            if (Str::startsWith($mime, 'image/')) {
                $validated['media_file_path'] = $webpService->convertAndStore($file, 'galleries/media');
            } else {
                $validated['media_file_path'] = $file->store('galleries/media', 'public');
            }
        }

        // Handle before image upload
        if ($request->hasFile('before_image_file')) {
            $validated['before_image_path'] = $webpService->convertAndStore($request->file('before_image_file'), 'galleries/before');
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = true;
        $validated['published_at'] = now();

        Gallery::create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Dokumentasi proyek galeri baru berhasil ditambahkan.');
    }

    public function update(Request $request, Gallery $gallery, \App\Services\WebpConverterService $webpService)
    {
        $validated = $request->validate([
            'title'               => 'required|string|max:200',
            'category'            => 'required|string',
            'media_type'          => 'required|in:image,video',
            'thumbnail_file'      => 'nullable|image|max:5120',
            'thumbnail_path'      => 'nullable|string',
            'media_file'          => 'nullable|file|mimes:mp4,webm,mov,jpg,jpeg,png,webp,bmp,gif,svg|max:30720',
            'external_media_url'  => 'nullable|url',
            'before_image_file'   => 'nullable|image|max:5120',
            'location_tag'        => 'nullable|string|max:100',
            'related_service_url' => 'nullable|string|max:255',
            'description'         => 'nullable|string',
            'is_featured'         => 'nullable|boolean',
            'sort_order'          => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('thumbnail_file')) {
            $webpService->deleteIfExists($gallery->thumbnail_path);
            $validated['thumbnail_path'] = $webpService->convertAndStore($request->file('thumbnail_file'), 'galleries/thumbnails');
        }

        if ($request->hasFile('media_file')) {
            $webpService->deleteIfExists($gallery->media_file_path);
            $file = $request->file('media_file');
            $mime = $file->getMimeType();
            if (Str::startsWith($mime, 'image/')) {
                $validated['media_file_path'] = $webpService->convertAndStore($file, 'galleries/media');
            } else {
                $validated['media_file_path'] = $file->store('galleries/media', 'public');
            }
        }

        if ($request->hasFile('before_image_file')) {
            $webpService->deleteIfExists($gallery->before_image_path);
            $validated['before_image_path'] = $webpService->convertAndStore($request->file('before_image_file'), 'galleries/before');
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Data galeri proyek berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery, \App\Services\WebpConverterService $webpService)
    {
        $webpService->deleteIfExists($gallery->thumbnail_path);
        $webpService->deleteIfExists($gallery->media_file_path);
        $webpService->deleteIfExists($gallery->before_image_path);

        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Data galeri berhasil dihapus.');
    }

    public function toggleActive(Gallery $gallery)
    {
        $gallery->update(['is_active' => !$gallery->is_active]);
        return redirect()->back()->with('success', 'Status visibilitas galeri diperbarui.');
    }

    public function toggleFeatured(Gallery $gallery)
    {
        $gallery->update(['is_featured' => !$gallery->is_featured]);
        return redirect()->back()->with('success', 'Status proyek unggulan diperbarui.');
    }
}
