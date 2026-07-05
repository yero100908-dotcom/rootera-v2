<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceArea;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceAreaController extends Controller
{
    public function index()
    {
        $areas = ServiceArea::orderBy('sort_order')->paginate(15);
        return view('admin.areas.index', compact('areas'));
    }

    public function create()
    {
        return view('admin.areas.form', ['area' => new ServiceArea(), 'mode' => 'create']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:150',
            'slug'             => 'nullable|string|unique:service_areas,slug|max:150',
            'description'      => 'nullable|string',
            'province'         => 'nullable|string|max:100',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'google_maps_embed'=> 'nullable|string',
            'sort_order'       => 'nullable|integer',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('areas', 'public');
        }

        ServiceArea::create($validated);

        return redirect()->route('admin.service-areas.index')
            ->with('success', 'Area layanan berhasil ditambahkan.');
    }

    public function edit(ServiceArea $serviceArea)
    {
        return view('admin.areas.form', ['area' => $serviceArea, 'mode' => 'edit']);
    }

    public function update(Request $request, ServiceArea $serviceArea)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:150',
            'slug'             => 'nullable|string|unique:service_areas,slug,' . $serviceArea->id . '|max:150',
            'description'      => 'nullable|string',
            'province'         => 'nullable|string|max:100',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'google_maps_embed'=> 'nullable|string',
            'is_active'        => 'boolean',
            'sort_order'       => 'nullable|integer',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            if ($serviceArea->image) Storage::disk('public')->delete($serviceArea->image);
            $validated['image'] = $request->file('image')->store('areas', 'public');
        }

        $serviceArea->update($validated);

        return redirect()->route('admin.service-areas.index')
            ->with('success', 'Area layanan berhasil diperbarui.');
    }

    public function destroy(ServiceArea $serviceArea)
    {
        if ($serviceArea->image) Storage::disk('public')->delete($serviceArea->image);
        $serviceArea->delete();

        return redirect()->route('admin.service-areas.index')
            ->with('success', 'Area layanan berhasil dihapus.');
    }
}
