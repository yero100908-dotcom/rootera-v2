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
        $slug = Str::slug($slugBase);

        // Check for slug duplication
        $count = City::where('slug', 'like', "{$slug}%")->count();
        $validated['slug'] = $count > 0 ? "{$slug}-" . ($count + 1) : $slug;
        $validated['whatsapp_number'] = $validated['whatsapp_number'] ?: '6281385404000';
        $validated['estimated_arrival'] = $validated['estimated_arrival'] ?: '25-40 Menit';

        $city = City::create($validated);
        $this->invalidateCityCache($city->slug);

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

        $oldSlug = $city->slug;
        $city->update($validated);
        $this->invalidateCityCache($city->slug, $oldSlug);

        return redirect()->route('admin.cities.index')
            ->with('success', 'Data kota berhasil diperbarui.');
    }

    public function destroy(City $city)
    {
        $slug = $city->slug;
        $city->delete();
        $this->invalidateCityCache($slug);

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

        $district = District::create($validated);
        $this->invalidateDistrictCache($city->slug, $district->slug);

        return redirect()->back()->with('success', 'Kecamatan berhasil ditambahkan ke ' . $city->name);
    }

    public function destroyDistrict(District $district)
    {
        $citySlug = $district->city?->slug;
        $districtSlug = $district->slug;
        $district->delete();

        if ($citySlug) {
            $this->invalidateDistrictCache($citySlug, $districtSlug);
        }

        return redirect()->back()->with('success', 'Kecamatan berhasil dihapus.');
    }

    /**
     * Invalidate target cache specifically without flushing the whole application cache.
     */
    protected function invalidateCityCache(string $slug, ?string $oldSlug = null): void
    {
        Cache::forget("pseo_city_show_v6_{$slug}");
        if ($oldSlug && $oldSlug !== $slug) {
            Cache::forget("pseo_city_show_v6_{$oldSlug}");
        }
        Cache::forget('area_directory_index_v3');
        Cache::forget('home_page_html_v5');
        Cache::forget('sitemap_cities_xml_v5');
        Cache::forget('sitemap_index_xml_v5');
    }

    /**
     * Invalidate district-specific cache keys.
     */
    protected function invalidateDistrictCache(string $citySlug, string $districtSlug): void
    {
        Cache::forget("pseo_district_show_v3_{$citySlug}_{$districtSlug}");
        Cache::forget("pseo_city_show_v6_{$citySlug}");
        Cache::forget('sitemap_districts_xml_v5');
    }
}
