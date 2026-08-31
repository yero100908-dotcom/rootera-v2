<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::orderBy('created_at', 'desc')->get();
        return view('admin.partners.index', compact('partners'));
    }

    public function store(Request $request, \App\Services\WebpConverterService $webpService)
    {
        $validated = $request->validate([
            'nama_mitra' => 'required|string|max:150',
            'logo'       => 'required|file|mimes:jpg,jpeg,png,webp,svg,bmp,gif|max:5120',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $webpService->convertAndStore($request->file('logo'), 'partners');
        }

        Partner::create($validated);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Mitra berhasil ditambahkan.');
    }

    public function update(Request $request, Partner $partner, \App\Services\WebpConverterService $webpService)
    {
        $validated = $request->validate([
            'nama_mitra' => 'required|string|max:150',
            'logo'       => 'nullable|file|mimes:jpg,jpeg,png,webp,svg,bmp,gif|max:5120',
        ]);

        if ($request->hasFile('logo')) {
            $webpService->deleteIfExists($partner->logo);
            $validated['logo'] = $webpService->convertAndStore($request->file('logo'), 'partners');
        }

        $partner->update($validated);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Mitra berhasil diperbarui.');
    }

    public function destroy(Partner $partner, \App\Services\WebpConverterService $webpService)
    {
        $webpService->deleteIfExists($partner->logo);
        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Mitra berhasil dihapus.');
    }
}
