<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CityManageController extends Controller
{
    public function index()
    {
        $cities = City::with(['province', 'districts'])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(20);

        $provinces = Province::where('is_active', true)->get();

        return view('admin.cities.index', compact('cities', 'provinces'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'province_id'       => 'required|exists:provinces,id',
            'name'              => 'required|string|max:120',
            'type'              => 'required|string|in:Kota,Kabupaten',
            'whatsapp_number'   => 'nullable|string|max:30',
            'estimated_arrival' => 'nullable|string|max:60',
            'meta_title'        => 'nullable|string|max:180',
            'meta_description'  => 'nullable|string|max:300',
        ]);

        $slugBase = $validated['type'] === 'Kabupaten' ? 'kabupaten-' . $validated['name'] : $validated['name'];
        $validated['slug'] = Str::slug($slugBase);
        $validated['whatsapp_number'] = $validated['whatsapp_number'] ?: '6281385404000';
        $validated['estimated_arrival'] = $validated['estimated_arrival'] ?: '25-40 Menit';

        City::create($validated);

        Cache::flush();

        return redirect()->route('admin.cities.index')
            ->with('success', 'Data kota berhasil ditambahkan.');
    }

    public function update(Request $request, City $city)
    {
        $validated = $request->validate([
            'province_id'       => 'required|exists:provinces,id',
            'name'              => 'required|string|max:120',
            'type'              => 'required|string|in:Kota,Kabupaten',
            'whatsapp_number'   => 'nullable|string|max:30',
            'estimated_arrival' => 'nullable|string|max:60',
            'meta_title'        => 'nullable|string|max:180',
            'meta_description'  => 'nullable|string|max:300',
        ]);

        $city->update($validated);

        Cache::flush();

        return redirect()->route('admin.cities.index')
            ->with('success', 'Data kota berhasil diperbarui.');
    }

    public function destroy(City $city)
    {
        $city->delete();
        Cache::flush();

        return redirect()->route('admin.cities.index')
            ->with('success', 'Data kota beserta kecamatan terkait berhasil dihapus.');
    }

    public function storeDistrict(Request $request, City $city)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:120',
            'estimated_arrival' => 'nullable|string|max:60',
        ]);

        $validated['city_id'] = $city->id;
        $validated['slug'] = Str::slug($validated['name']);
        $validated['estimated_arrival'] = $validated['estimated_arrival'] ?: '15-30 Menit';

        District::create($validated);

        Cache::flush();

        return redirect()->back()->with('success', 'Kecamatan berhasil ditambahkan ke ' . $city->name);
    }

    public function destroyDistrict(District $district)
    {
        $district->delete();
        Cache::flush();

        return redirect()->back()->with('success', 'Kecamatan berhasil dihapus.');
    }
}
