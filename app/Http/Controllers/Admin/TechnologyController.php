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
            'tool_name'       => 'required|string|max:150',
            'type_brand'      => 'nullable|string|max:150',
            'main_spec'       => 'nullable|string',
            'pipe_target'     => 'nullable|string|max:200',
            'main_advantage'   => 'nullable|string|max:255',
            'badge_text'      => 'nullable|string|max:50',
            'badge_color'     => 'nullable|string|max:50',
            'description'     => 'nullable|string',
            'feature_1_label' => 'nullable|string|max:100',
            'feature_1_value' => 'nullable|string|max:100',
            'feature_2_label' => 'nullable|string|max:100',
            'feature_2_value' => 'nullable|string|max:100',
            'image_path'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'order_priority'  => 'nullable|integer',
            'sort_order'      => 'nullable|integer',
            'is_active'       => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $this->processAndStoreWebp($request->file('image_path'));
        }

        $validated['order_priority'] = $validated['order_priority'] ?? 0;
        $validated['sort_order']     = $validated['sort_order'] ?? $validated['order_priority'];
        $validated['is_active']      = $request->has('is_active') ? $request->boolean('is_active') : true;
        $validated['slug']           = Str::slug($validated['tool_name']);

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
            'tool_name'       => 'required|string|max:150',
            'type_brand'      => 'nullable|string|max:150',
            'main_spec'       => 'nullable|string',
            'pipe_target'     => 'nullable|string|max:200',
            'main_advantage'   => 'nullable|string|max:255',
            'badge_text'      => 'nullable|string|max:50',
            'badge_color'     => 'nullable|string|max:50',
            'description'     => 'nullable|string',
            'feature_1_label' => 'nullable|string|max:100',
            'feature_1_value' => 'nullable|string|max:100',
            'feature_2_label' => 'nullable|string|max:100',
            'feature_2_value' => 'nullable|string|max:100',
            'image_path'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'order_priority'  => 'nullable|integer',
            'sort_order'      => 'nullable|integer',
            'is_active'       => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_path')) {
            if ($technology->image_path && Storage::disk('public')->exists($technology->image_path)) {
                Storage::disk('public')->delete($technology->image_path);
            }
            $validated['image_path'] = $this->processAndStoreWebp($request->file('image_path'));
        }

        $validated['is_active']      = $request->boolean('is_active');
        $validated['order_priority'] = $validated['order_priority'] ?? 0;
        $validated['sort_order']     = $validated['sort_order'] ?? $validated['order_priority'];
        $validated['slug']           = Str::slug($validated['tool_name']);

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
        if ($technology->image_path && Storage::disk('public')->exists($technology->image_path)) {
            Storage::disk('public')->delete($technology->image_path);
        }
        $technology->delete();

        return redirect()->route('admin.technologies.index')
            ->with('success', 'Data Peralatan berhasil dihapus.');
    }

    /**
     * Process uploaded file to WebP format if GD library available, or store safely.
     */
    private function processAndStoreWebp($file): string
    {
        $filename = 'tech_' . time() . '_' . Str::random(6) . '.webp';
        $destinationPath = storage_path('app/public/technologies');

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $targetFile = $destinationPath . '/' . $filename;

        if (function_exists('imagecreatefromstring') && function_exists('imagewebp')) {
            $img = @imagecreatefromstring(file_get_contents($file->getRealPath()));
            if ($img !== false) {
                // Preserving transparency for PNG/WebP if needed
                imagealphablending($img, true);
                imagesavealpha($img, true);
                imagewebp($img, $targetFile, 85);
                imagedestroy($img);
                return 'technologies/' . $filename;
            }
        }

        // Fallback standard storage
        return $file->store('technologies', 'public');
    }
}
