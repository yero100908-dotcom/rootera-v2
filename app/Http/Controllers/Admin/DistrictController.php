<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DistrictRequest;
use App\Models\City;
use App\Models\District;
use App\Services\Seo\ContentScoreCalculator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DistrictController extends Controller
{
    public function index(Request $request): View
    {
        $districts = District::query()
            ->with('city:id,name,slug')
            ->withCount(['residentialClusters', 'projectGalleries'])
            ->when($request->filled('city_id'), fn ($q) => $q->where('city_id', (int) $request->input('city_id')))
            ->when($request->filled('q'), fn ($q) => $q->where('name', 'like', '%' . $request->input('q') . '%'))
            ->when($request->input('indexable') === '1', fn ($q) => $q->where('is_indexable', true))
            ->orderByDesc('content_score')
            ->orderBy('name')
            ->paginate(25)
            ->withQueryString();

        $cities = City::query()->orderBy('name')->get(['id', 'name']);
        $threshold = ContentScoreCalculator::THRESHOLD;

        return view('admin.districts.index', compact('districts', 'cities', 'threshold'));
    }

    public function create(): View
    {
        return view('admin.districts.form', [
            'district'  => new District(['estimated_arrival' => '20-35 Menit', 'is_active' => true]),
            'mode'      => 'create',
            'cities'    => City::query()->orderBy('name')->get(['id', 'name']),
            'threshold' => ContentScoreCalculator::THRESHOLD,
        ]);
    }

    public function store(DistrictRequest $request): RedirectResponse
    {
        $district = District::create($request->validated());

        return redirect()->route('admin.districts.edit', $district)
            ->with('success', "Kecamatan {$district->name} dibuat. Skor konten: {$district->content_score}/100.");
    }

    public function edit(District $district): View
    {
        return view('admin.districts.form', [
            'district'  => $district,
            'mode'      => 'edit',
            'cities'    => City::query()->orderBy('name')->get(['id', 'name']),
            'threshold' => ContentScoreCalculator::THRESHOLD,
        ]);
    }

    public function update(DistrictRequest $request, District $district): RedirectResponse
    {
        $district->update($request->validated());
        $district->refresh();

        return redirect()->route('admin.districts.edit', $district)
            ->with('success', "Kecamatan {$district->name} diperbarui. Skor konten: {$district->content_score}/100.");
    }

    public function destroy(District $district): RedirectResponse
    {
        $name = $district->name;
        $district->delete();

        return redirect()->route('admin.districts.index')->with('success', "Kecamatan {$name} dihapus.");
    }

    public function toggleIndexable(District $district): RedirectResponse
    {
        $district->is_indexable = !$district->is_indexable;
        $district->save();

        return back()->with('success', $district->is_indexable
            ? "{$district->name} sekarang INDEX."
            : "{$district->name} NOINDEX (skor {$district->content_score}).");
    }

    /** JSON endpoint used by the cluster form to load districts per city. */
    public function byCity(City $city)
    {
        return response()->json(
            $city->districts()->get(['id', 'name'])
        );
    }
}
