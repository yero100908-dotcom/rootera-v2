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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:150',
            'slug'             => 'nullable|string|unique:service_categories,slug|max:150',
            'description'      => 'nullable|string',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order'       => 'nullable|integer',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        ServiceCategory::create($validated);

        return redirect()->route('admin.service-categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, ServiceCategory $serviceCategory)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:150',
            'slug'             => 'nullable|string|unique:service_categories,slug,' . $serviceCategory->id . '|max:150',
            'description'      => 'nullable|string',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active'        => 'boolean',
            'sort_order'       => 'nullable|integer',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            if ($serviceCategory->image) Storage::disk('public')->delete($serviceCategory->image);
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $serviceCategory->update($validated);

        return redirect()->route('admin.service-categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(ServiceCategory $serviceCategory)
    {
        if ($serviceCategory->image) Storage::disk('public')->delete($serviceCategory->image);
        $serviceCategory->delete();

        return redirect()->route('admin.service-categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
