<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectGallery;
use App\Models\ServiceCategory;
use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ProjectGalleryController extends Controller
{
    public function index()
    {
        $projects = ProjectGallery::with(['serviceCategory', 'city', 'district'])
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $categories = ServiceCategory::where('is_active', true)->get();
        $cities = City::where('is_active', true)->with('districts')->get();

        return view('admin.project-galleries.index', compact('projects', 'categories', 'cities'));
    }

    public function store(Request $request, \App\Services\WebpConverterService $webpService)
    {
        $validated = $request->validate([
            'title'               => 'required|string|max:180',
            'service_category_id' => 'nullable|exists:service_categories,id',
            'city_id'             => 'nullable|exists:cities,id',
            'district_id'         => 'nullable|exists:districts,id',
            'client_type'         => 'required|string|max:60',
            'tool_used'           => 'nullable|string|max:150',
            'pipe_specs'          => 'nullable|string|max:150',
            'pipe_length'         => 'nullable|string|max:100',
            'completion_time'     => 'nullable|string|max:60',
            'warranty_days'       => 'nullable|integer|min:0',
            'cost_estimate'       => 'nullable|numeric|min:0',
            'description'         => 'nullable|string',
            'technical_diagnosis' => 'nullable|string',
            'before_image'        => 'nullable|image|mimes:jpeg,png,jpg,webp,bmp,gif,svg|max:5120',
            'after_image'         => 'nullable|image|mimes:jpeg,png,jpg,webp,bmp,gif,svg|max:5120',
            'sort_order'          => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);
        $validated['warranty_days'] = $validated['warranty_days'] ?? 30;

        if ($request->hasFile('before_image')) {
            $validated['before_image'] = $webpService->convertAndStore($request->file('before_image'), 'projects');
        }

        if ($request->hasFile('after_image')) {
            $validated['after_image'] = $webpService->convertAndStore($request->file('after_image'), 'projects');
        }

        ProjectGallery::create($validated);

        Cache::forget('home_page_html_v5');
        Cache::forget('gallery_projects_list');

        return redirect()->route('admin.project-galleries.index')
            ->with('success', 'Portofolio proyek berhasil ditambahkan.');
    }

    public function update(Request $request, ProjectGallery $projectGallery, \App\Services\WebpConverterService $webpService)
    {
        $validated = $request->validate([
            'title'               => 'required|string|max:180',
            'service_category_id' => 'nullable|exists:service_categories,id',
            'city_id'             => 'nullable|exists:cities,id',
            'district_id'         => 'nullable|exists:districts,id',
            'client_type'         => 'required|string|max:60',
            'tool_used'           => 'nullable|string|max:150',
            'pipe_specs'          => 'nullable|string|max:150',
            'pipe_length'         => 'nullable|string|max:100',
            'completion_time'     => 'nullable|string|max:60',
            'warranty_days'       => 'nullable|integer|min:0',
            'cost_estimate'       => 'nullable|numeric|min:0',
            'description'         => 'nullable|string',
            'technical_diagnosis' => 'nullable|string',
            'before_image'        => 'nullable|image|mimes:jpeg,png,jpg,webp,bmp,gif,svg|max:5120',
            'after_image'         => 'nullable|image|mimes:jpeg,png,jpg,webp,bmp,gif,svg|max:5120',
            'sort_order'          => 'nullable|integer',
        ]);

        if ($request->hasFile('before_image')) {
            $webpService->deleteIfExists($projectGallery->before_image);
            $validated['before_image'] = $webpService->convertAndStore($request->file('before_image'), 'projects');
        }

        if ($request->hasFile('after_image')) {
            $webpService->deleteIfExists($projectGallery->after_image);
            $validated['after_image'] = $webpService->convertAndStore($request->file('after_image'), 'projects');
        }

        $projectGallery->update($validated);

        Cache::forget('home_page_html_v5');
        Cache::forget('gallery_projects_list');

        return redirect()->route('admin.project-galleries.index')
            ->with('success', 'Portofolio proyek berhasil diperbarui.');
    }

    public function destroy(ProjectGallery $projectGallery, \App\Services\WebpConverterService $webpService)
    {
        $webpService->deleteIfExists($projectGallery->before_image);
        $webpService->deleteIfExists($projectGallery->after_image);

        $projectGallery->delete();

        Cache::forget('home_page_html_v5');
        Cache::forget('gallery_projects_list');

        return redirect()->route('admin.project-galleries.index')
            ->with('success', 'Portofolio proyek berhasil dihapus.');
    }

    public function toggleActive(ProjectGallery $projectGallery)
    {
        $projectGallery->update(['is_active' => !$projectGallery->is_active]);
        Cache::forget('home_page_html_v5');
        Cache::forget('gallery_projects_list');
        return redirect()->back()->with('success', 'Status proyek diperbarui.');
    }
}
