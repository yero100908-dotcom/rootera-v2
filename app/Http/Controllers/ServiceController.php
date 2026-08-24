<?php

namespace App\Http\Controllers;

use App\Services\ServiceCategoryService;
use App\Models\Technology;
use App\Models\Faq;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * @var ServiceCategoryService
     */
    protected $serviceCategoryService;

    /**
     * ServiceController constructor.
     *
     * @param ServiceCategoryService $serviceCategoryService
     */
    public function __construct(ServiceCategoryService $serviceCategoryService)
    {
        $this->serviceCategoryService = $serviceCategoryService;
    }

    public function index()
    {
        // Fetch service categories with relations loaded and cached via Service class
        $serviceCategories = $this->serviceCategoryService->getActiveServicesWithRelations();

        $seo = [
            'title'       => 'Layanan Rootera – Solusi Pipa Mampet & Instalasi Sanitary Profesional',
            'description' => 'Temukan semua layanan Rootera: pembersihan saluran mampet, cuci toren, dan instalasi pipa profesional menggunakan alat modern tanpa bongkar bangunan.',
            'canonical'   => url('/layanan'),
            'og_image'    => asset('images/JnJ.jpeg'),
        ];

        // Ambil teknologi dari database (dinamis)
        $tools = Technology::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Ambil FAQ dari database
        $faqs = Faq::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('pages.layanan', compact('serviceCategories', 'tools', 'faqs', 'seo'));
    }

    public function show(string $slug)
    {
        $category = \App\Models\ServiceCategory::where('slug', $slug)
            ->where('is_active', true)
            ->with(['services' => function ($q) {
                $q->where('is_active', true)->orderBy('sort_order');
            }])
            ->firstOrFail();

        $allCategories = \App\Models\ServiceCategory::where('is_active', true)
            ->where('id', '!=', $category->id)
            ->orderBy('sort_order')
            ->get();

        $cities = \App\Models\City::where('is_active', true)
            ->with('province')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->take(12)
            ->get();

        $relatedArticles = \App\Models\Article::published()
            ->latest('published_at')
            ->take(3)
            ->get();

        $projectShowcases = \App\Models\ProjectGallery::where('is_active', true)
            ->with(['district', 'city'])
            ->take(6)
            ->get();

        $title = Str::limit($category->meta_title ?? "Jasa {$category->name} Pelancar Pipa Mampet - Rootera", 60, '');
        $description = Str::limit($category->meta_description ?? "Layanan {$category->name} profesional, cepat, tanpa bongkar. Atasi sumbatan pipa air & wastafel di Jabodetabek, Bandung, Semarang, Lampung, Jogja, Solo.", 150, '');
        $canonical = url('/layanan/' . $category->slug);
        $ogImage = $category->image ? asset('storage/' . $category->image) : asset('images/JnJ.jpeg');

        $seo = [
            'title'       => $title,
            'description' => $description,
            'canonical'   => $canonical,
            'og_image'    => $ogImage,
        ];

        return view('pages.layanan-detail', compact(
            'category',
            'allCategories',
            'cities',
            'relatedArticles',
            'projectShowcases',
            'title',
            'description',
            'canonical',
            'ogImage',
            'seo'
        ));
    }
}
