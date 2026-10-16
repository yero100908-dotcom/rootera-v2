<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceAliasRequest;
use App\Models\ServiceAlias;
use App\Models\ServiceCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceAliasController extends Controller
{
    public function index(Request $request): View
    {
        $aliases = ServiceAlias::query()
            ->with('serviceCategory:id,name,slug')
            ->when($request->filled('service_category_id'), fn ($q) => $q->where('service_category_id', (int) $request->input('service_category_id')))
            ->when($request->filled('usage'), fn ($q) => $q->where('usage', $request->input('usage')))
            ->when($request->filled('q'), fn ($q) => $q->where('keyword', 'like', '%' . $request->input('q') . '%'))
            ->orderByDesc('search_volume')
            ->orderBy('keyword')
            ->paginate(30)
            ->withQueryString();

        $categories = $this->categoryOptions();

        return view('admin.service-aliases.index', compact('aliases', 'categories'));
    }

    public function create(): View
    {
        return view('admin.service-aliases.form', [
            'alias'      => new ServiceAlias(['intent' => 'transactional', 'usage' => 'copy_only', 'is_active' => true]),
            'mode'       => 'create',
            'categories' => $this->categoryOptions(),
        ]);
    }

    public function store(ServiceAliasRequest $request): RedirectResponse
    {
        $alias = ServiceAlias::create($request->validated());

        return redirect()->route('admin.service-aliases.index')
            ->with('success', "Alias \"{$alias->keyword}\" ditambahkan.");
    }

    public function edit(ServiceAlias $serviceAlias): View
    {
        return view('admin.service-aliases.form', [
            'alias'      => $serviceAlias,
            'mode'       => 'edit',
            'categories' => $this->categoryOptions(),
        ]);
    }

    public function update(ServiceAliasRequest $request, ServiceAlias $serviceAlias): RedirectResponse
    {
        $serviceAlias->update($request->validated());

        return redirect()->route('admin.service-aliases.index')
            ->with('success', "Alias \"{$serviceAlias->keyword}\" diperbarui.");
    }

    public function destroy(ServiceAlias $serviceAlias): RedirectResponse
    {
        $keyword = $serviceAlias->keyword;
        $serviceAlias->delete();

        return redirect()->route('admin.service-aliases.index')->with('success', "Alias \"{$keyword}\" dihapus.");
    }

    private function categoryOptions()
    {
        return ServiceCategory::query()->orderBy('sort_order')->orderBy('name')->get(['id', 'name']);
    }
}
