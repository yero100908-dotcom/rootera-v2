<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

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
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'sort_order'       => 'nullable|integer',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $validated['image'] = $webpService->convertAndStore($request->file('image'), 'services');
        }

        ServiceCategory::create($validated);
        $this->clearCategoryCache();

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
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'sort_order'       => 'nullable|integer',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        // Boolean handling agar status nonaktif tersimpan
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $webpService->deleteIfExists($serviceCategory->image);
            $validated['image'] = $webpService->convertAndStore($request->file('image'), 'services');
        }

        $serviceCategory->update($validated);
        $this->clearCategoryCache($serviceCategory->slug);

        return redirect()->route('admin.service-categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(ServiceCategory $serviceCategory, \App\Services\WebpConverterService $webpService)
    {
        $slug = $serviceCategory->slug;
        $webpService->deleteIfExists($serviceCategory->image);
        $serviceCategory->delete();
        $this->clearCategoryCache($slug);

        return redirect()->route('admin.service-categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }

    protected function clearCategoryCache(?string $slug = null): void
    {
        Cache::forget('active_service_categories');
        Cache::forget('sitemap_services_xml_v5');
        Cache::forget('sitemap_index_xml_v5');
        Cache::forget('home_page_html_v5');
    }
}
