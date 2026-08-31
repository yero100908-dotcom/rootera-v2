<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    public function index()
    {
        $technologies = Technology::orderBy('order_priority')->orderBy('sort_order')->orderBy('created_at')->get();
        return view('admin.technologies.index', compact('technologies'));
    }

    public function create()
    {
        return view('admin.technologies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tool_name'             => 'required|string|max:150',
            'type_brand'            => 'nullable|string|max:150',
            'main_spec'             => 'nullable|string',
            'pipe_target'           => 'nullable|string|max:200',
            'main_advantage'         => 'nullable|string|max:255',
            'badge_text'            => 'nullable|string|max:50',
            'badge_color'           => 'nullable|string|max:50',
            'description'           => 'nullable|string',
            'feature_1_label'       => 'nullable|string|max:100',
            'feature_1_value'       => 'nullable|string|max:100',
            'feature_2_label'       => 'nullable|string|max:100',
            'feature_2_value'       => 'nullable|string|max:100',
            'image_path'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'order_priority'        => 'nullable|integer',
            'sort_order'            => 'nullable|integer',
            'is_active'             => 'nullable|boolean',
            'meta_title'            => 'nullable|string|max:180',
            'meta_description'      => 'nullable|string|max:300',
            'safety_guarantee_text' => 'nullable|string',
            'ideal_use_cases'       => 'nullable|array',
            'spec_sheet'            => 'nullable|array',
            'faqs'                  => 'nullable|array',
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = app(\App\Services\WebpConverterService::class)->convertAndStore($request->file('image_path'), 'technologies');
        }

        $validated['order_priority'] = $validated['order_priority'] ?? 0;
        $validated['sort_order']     = $validated['sort_order'] ?? $validated['order_priority'];
        $validated['is_active']      = $request->has('is_active') ? $request->boolean('is_active') : true;
        $validated['slug']           = Str::slug($validated['tool_name']);

        // Clean empty FAQ items if present
        if (!empty($validated['faqs']) && is_array($validated['faqs'])) {
            $validated['faqs'] = array_values(array_filter($validated['faqs'], fn($item) => !empty($item['question']) && !empty($item['answer'])));
        }

        Technology::create($validated);

        return redirect()->route('admin.technologies.index')
            ->with('success', 'Teknologi / Peralatan baru berhasil disimpan.');
    }

    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    public function update(Request $request, Technology $technology)
    {
        $validated = $request->validate([
            'tool_name'             => 'required|string|max:150',
            'type_brand'            => 'nullable|string|max:150',
            'main_spec'             => 'nullable|string',
            'pipe_target'           => 'nullable|string|max:200',
            'main_advantage'         => 'nullable|string|max:255',
            'badge_text'            => 'nullable|string|max:50',
            'badge_color'           => 'nullable|string|max:50',
            'description'           => 'nullable|string',
            'feature_1_label'       => 'nullable|string|max:100',
            'feature_1_value'       => 'nullable|string|max:100',
            'feature_2_label'       => 'nullable|string|max:100',
            'feature_2_value'       => 'nullable|string|max:100',
            'image_path'            => 'nullable|image|mimes:jpg,jpeg,png,webp,bmp,gif,svg|max:5120',
            'order_priority'        => 'nullable|integer',
            'sort_order'            => 'nullable|integer',
            'is_active'             => 'nullable|boolean',
            'meta_title'            => 'nullable|string|max:180',
            'meta_description'      => 'nullable|string|max:300',
            'safety_guarantee_text' => 'nullable|string',
            'ideal_use_cases'       => 'nullable|array',
            'spec_sheet'            => 'nullable|array',
            'faqs'                  => 'nullable|array',
        ]);

        if ($request->hasFile('image_path')) {
            app(\App\Services\WebpConverterService::class)->deleteIfExists($technology->image_path);
            $validated['image_path'] = app(\App\Services\WebpConverterService::class)->convertAndStore($request->file('image_path'), 'technologies');
        }

        $validated['is_active']      = $request->boolean('is_active');
        $validated['order_priority'] = $validated['order_priority'] ?? 0;
        $validated['sort_order']     = $validated['sort_order'] ?? $validated['order_priority'];
        $validated['slug']           = Str::slug($validated['tool_name']);

        // Clean empty FAQ items if present
        if (isset($validated['faqs']) && is_array($validated['faqs'])) {
            $validated['faqs'] = array_values(array_filter($validated['faqs'], fn($item) => !empty($item['question']) && !empty($item['answer'])));
        }

        $technology->update($validated);

        return redirect()->route('admin.technologies.index')
            ->with('success', 'Data Peralatan / Teknologi berhasil diperbarui.');
    }

    public function toggleActive(Technology $technology)
    {
        $technology->update(['is_active' => !$technology->is_active]);

        return response()->json([
            'success'   => true,
            'is_active' => $technology->is_active,
            'message'   => $technology->is_active ? 'Status diubah ke Aktif.' : 'Status diubah ke Nonaktif.',
        ]);
    }

    public function destroy(Technology $technology)
    {
        app(\App\Services\WebpConverterService::class)->deleteIfExists($technology->image_path);
        $technology->delete();

        return redirect()->route('admin.technologies.index')
            ->with('success', 'Data Peralatan berhasil dihapus.');
    }
}
