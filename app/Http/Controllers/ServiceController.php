<?php

namespace App\Http\Controllers;

use App\Services\ServiceCategoryService;
use App\Models\Technology;
use App\Models\Faq;

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
            'title'       => 'Layanan Rooterin – Solusi Pipa Mampet & Instalasi Sanitary Profesional',
            'description' => 'Temukan semua layanan Rooterin: pembersihan saluran mampet, cuci toren, dan instalasi pipa profesional menggunakan alat modern tanpa bongkar bangunan.',
            'canonical'   => url('/layanan'),
            'og_image'    => asset('images/og-layanan.jpg'),
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
            ->with('services')
            ->firstOrFail();

        $seo = [
            'title'       => substr($category->meta_title ?? "Jasa {$category->name} Pelancar Pipa Mampet - Rooterin", 0, 60),
            'description' => substr($category->meta_description ?? "Layanan {$category->name} profesional, cepat, tanpa bongkar. Atasi sumbatan pipa air & wastafel di Jabodetabek, Bandung, Semarang, Lampung, Jogja, Solo.", 0, 150),
            'canonical'   => url('/layanan/' . $category->slug),
            'og_image'    => $category->image ? asset('storage/' . $category->image) : asset('images/og-layanan.jpg'),
        ];

        return view('pages.layanan-detail', compact('category', 'seo'));
    }
}
