<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResidentialClusterRequest;
use App\Models\City;
use App\Models\District;
use App\Models\ResidentialCluster;
use App\Services\Seo\ContentScoreCalculator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ResidentialClusterController extends Controller
{
    public function index(Request $request): View
    {
        $clusters = ResidentialCluster::query()
            ->with(['city:id,name,slug', 'district:id,name'])
            ->withCount(['districts', 'projectGalleries'])
            ->when($request->filled('city_id'), fn ($q) => $q->where('city_id', (int) $request->input('city_id')))
            ->when($request->filled('q'), fn ($q) => $q->where('name', 'like', '%' . $request->input('q') . '%'))
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        $cities = $this->cityOptions();
        $threshold = ContentScoreCalculator::THRESHOLD;

        return view('admin.clusters.index', compact('clusters', 'cities', 'threshold'));
    }

    public function create(): View
    {
        return view('admin.clusters.form', $this->formData(new ResidentialCluster([
            'tier' => 'premium',
            'estimated_arrival' => '30-45 Menit',
            'is_active' => true,
        ]), 'create'));
    }

    public function store(ResidentialClusterRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $districtIds = $data['district_ids'] ?? [];
        unset($data['district_ids']);

        $cluster = DB::transaction(function () use ($data, $districtIds) {
            $cluster = ResidentialCluster::create($data);
            $cluster->districts()->sync($this->withPrimary($districtIds, $cluster->district_id));
            return $cluster;
        });

        return redirect()->route('admin.clusters.edit', $cluster)
            ->with('success', "Cluster {$cluster->name} dibuat. Skor konten: {$cluster->content_score}/100.");
    }

    public function edit(ResidentialCluster $cluster): View
    {
        $cluster->load(['districts:id', 'projectGalleries' => fn ($q) => $q->select('id', 'residential_cluster_id', 'title', 'is_active')]);

        return view('admin.clusters.form', $this->formData($cluster, 'edit'));
    }

    public function update(ResidentialClusterRequest $request, ResidentialCluster $cluster): RedirectResponse
    {
        $data = $request->validated();
        $districtIds = $data['district_ids'] ?? [];
        unset($data['district_ids']);

        DB::transaction(function () use ($cluster, $data, $districtIds) {
            $cluster->update($data);
            $cluster->districts()->sync($this->withPrimary($districtIds, $cluster->district_id));
        });

        $cluster->refresh();
        $msg = "Cluster {$cluster->name} diperbarui. Skor konten: {$cluster->content_score}/100.";
        if ($request->boolean('is_indexable') && !$cluster->is_indexable) {
            $msg .= ' Indexing dinonaktifkan otomatis karena skor < ' . ContentScoreCalculator::THRESHOLD . '.';
        }

        return redirect()->route('admin.clusters.edit', $cluster)->with('success', $msg);
    }

    public function destroy(ResidentialCluster $cluster): RedirectResponse
    {
        $name = $cluster->name;
        $cluster->delete();

        return redirect()->route('admin.clusters.index')->with('success', "Cluster {$name} dihapus.");
    }

    public function toggleIndexable(ResidentialCluster $cluster): RedirectResponse
    {
        $cluster->is_indexable = !$cluster->is_indexable;
        $cluster->save();

        $msg = $cluster->is_indexable
            ? "{$cluster->name} sekarang INDEX."
            : "{$cluster->name} NOINDEX" . ($cluster->content_score < ContentScoreCalculator::THRESHOLD
                ? " (skor {$cluster->content_score} di bawah ambang " . ContentScoreCalculator::THRESHOLD . ').'
                : '.');

        return back()->with('success', $msg);
    }

    public function preview(ResidentialCluster $cluster): RedirectResponse
    {
        return redirect()->route('cluster.show', $cluster->slug);
    }

    /* ── Helpers ─────────────────────────────────────────────────────── */

    private function formData(ResidentialCluster $cluster, string $mode): array
    {
        $cityId = old('city_id', $cluster->city_id);

        $districts = District::query()
            ->select('id', 'city_id', 'name')
            ->with('city:id,name')
            ->when($cityId, fn ($q) => $q->where('city_id', $cityId), fn ($q) => $q->whereRaw('1 = 0'))
            ->orderBy('name')
            ->get();

        return [
            'cluster'   => $cluster,
            'mode'      => $mode,
            'cities'    => $this->cityOptions(),
            'districts' => $districts,
            'threshold' => ContentScoreCalculator::THRESHOLD,
            'selectedDistrictIds' => old('district_ids', $cluster->exists ? $cluster->districts->pluck('id')->all() : []),
        ];
    }

    private function cityOptions()
    {
        return City::query()->where('is_active', true)->orderBy('name')->get(['id', 'name']);
    }

    /** Ensure the primary district is always part of the pivot. */
    private function withPrimary(array $ids, ?int $primaryId): array
    {
        if ($primaryId) {
            $ids[] = $primaryId;
        }

        return array_values(array_unique(array_map('intval', $ids)));
    }
}
