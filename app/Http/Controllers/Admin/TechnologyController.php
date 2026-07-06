<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TechnologyController extends Controller
{
    public function index()
    {
        $technologies = Technology::orderBy('sort_order')->orderBy('created_at')->get();
        return view('admin.technologies.index', compact('technologies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tool_name'   => 'required|string|max:150',
            'description' => 'nullable|string',
            'image_path'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order'  => 'nullable|integer',
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('technologies', 'public');
        }

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        Technology::create($validated);

        return redirect()->route('admin.technologies.index')
            ->with('success', 'Teknologi berhasil ditambahkan.');
    }

    public function update(Request $request, Technology $technology)
    {
        $validated = $request->validate([
            'tool_name'   => 'required|string|max:150',
            'description' => 'nullable|string',
            'image_path'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_path')) {
            if ($technology->image_path) {
                Storage::disk('public')->delete($technology->image_path);
            }
            $validated['image_path'] = $request->file('image_path')->store('technologies', 'public');
        }

        $validated['is_active']  = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $technology->update($validated);

        return redirect()->route('admin.technologies.index')
            ->with('success', 'Teknologi berhasil diperbarui.');
    }

    public function toggleActive(Technology $technology)
    {
        $technology->update(['is_active' => !$technology->is_active]);

        return response()->json([
            'success'   => true,
            'is_active' => $technology->is_active,
            'message'   => $technology->is_active ? 'Teknologi diaktifkan.' : 'Teknologi dinonaktifkan.',
        ]);
    }

    public function destroy(Technology $technology)
    {
        if ($technology->image_path) {
            Storage::disk('public')->delete($technology->image_path);
        }
        $technology->delete();

        return redirect()->route('admin.technologies.index')
            ->with('success', 'Teknologi berhasil dihapus.');
    }
}
