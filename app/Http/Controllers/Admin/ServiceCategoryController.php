<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::withCount('services')->orderBy('sort_order')->get();
        return view('admin.services.categories', compact('categories'));
    }

    public function store(Request $request, \App\Services\WebpConverterService $webpService)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:150',
            'slug'             => 'nullable|string|unique:service_categories,slug|max:150',
            'description'      => 'nullable|string',
            'price_home'       => 'nullable|string|max:150',
            'price_corporate'  => 'nullable|string|max:150',
            'price_description'=> 'nullable|string',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp,bmp,gif,svg|max:5120',
            'sort_order'       => 'nullable|integer',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $webpService->convertAndStore($request->file('image'), 'services');
        }

        ServiceCategory::create($validated);

        return redirect()->route('admin.service-categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, ServiceCategory $serviceCategory, \App\Services\WebpConverterService $webpService)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:150',
            'slug'             => 'nullable|string|unique:service_categories,slug,' . $serviceCategory->id . '|max:150',
            'description'      => 'nullable|string',
            'price_home'       => 'nullable|string|max:150',
            'price_corporate'  => 'nullable|string|max:150',
            'price_description'=> 'nullable|string',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp,bmp,gif,svg|max:5120',
            'is_active'        => 'boolean',
            'sort_order'       => 'nullable|integer',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $webpService->deleteIfExists($serviceCategory->image);
            $validated['image'] = $webpService->convertAndStore($request->file('image'), 'services');
        }

        $serviceCategory->update($validated);

        return redirect()->route('admin.service-categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(ServiceCategory $serviceCategory, \App\Services\WebpConverterService $webpService)
    {
        $webpService->deleteIfExists($serviceCategory->image);
        $serviceCategory->delete();

        return redirect()->route('admin.service-categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
