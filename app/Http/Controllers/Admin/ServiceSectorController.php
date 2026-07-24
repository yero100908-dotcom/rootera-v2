<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceSector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceSectorController extends Controller
{
    public function index()
    {
        $sectors = ServiceSector::orderBy('sort_order')->orderBy('created_at')->get();
        return view('admin.service-sectors.index', compact('sectors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sector_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'icon'        => 'nullable|string|max:50',
            'image_path'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order'  => 'nullable|integer',
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('sectors', 'public');
        }

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        ServiceSector::create($validated);

        return redirect()->route('admin.service-sectors.index')
            ->with('success', 'Sektor berhasil ditambahkan.');
    }

    public function update(Request $request, ServiceSector $serviceSector)
    {
        $validated = $request->validate([
            'sector_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'icon'        => 'nullable|string|max:50',
            'image_path'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_path')) {
            if ($serviceSector->image_path) {
                Storage::disk('public')->delete($serviceSector->image_path);
            }
            $validated['image_path'] = $request->file('image_path')->store('sectors', 'public');
        }

        $validated['is_active']  = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $serviceSector->update($validated);

        return redirect()->route('admin.service-sectors.index')
            ->with('success', 'Sektor berhasil diperbarui.');
    }

    public function toggleActive(ServiceSector $serviceSector)
    {
        $serviceSector->update(['is_active' => !$serviceSector->is_active]);

        return response()->json([
            'success'   => true,
            'is_active' => $serviceSector->is_active,
            'message'   => $serviceSector->is_active ? 'Sektor diaktifkan.' : 'Sektor dinonaktifkan.',
        ]);
    }

    public function destroy(ServiceSector $serviceSector)
    {
        if ($serviceSector->image_path) {
            Storage::disk('public')->delete($serviceSector->image_path);
        }
        $serviceSector->delete();

        return redirect()->route('admin.service-sectors.index')
            ->with('success', 'Sektor berhasil dihapus.');
    }
}
