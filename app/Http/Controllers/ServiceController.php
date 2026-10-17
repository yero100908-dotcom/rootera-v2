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
            'og_image'    => secure_url('images/og/rootera-default.jpg'),
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
            ->first();

        $alias = null;
        if (! $category) {
            $alias = \App\Models\ServiceAlias::active()
                ->landingPage()
                ->where('slug', $slug)
                ->with(['serviceCategory' => function ($q) {
                    $q->with(['services' => function ($q2) {
                        $q2->where('is_active', true)->orderBy('sort_order');
                    }]);
                }])
                ->first();

            if (! $alias || ! $alias->serviceCategory || ! $alias->serviceCategory->is_active) {
                abort(404);
            }

            $category = $alias->serviceCategory;
        }

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

        $catSlug = strtolower($category->slug ?? '');
        $isCctv = str_contains($catSlug, 'cctv') || str_contains($catSlug, 'inspeksi') || str_contains($catSlug, 'deteksi');

        if ($alias) {
            $keywordTitle = ucwords($alias->keyword);
            $title = Str::limit("Jasa {$keywordTitle} 24 Jam Bergaransi Tanpa Bongkar - Rootera", 60, '');
            if ($alias->intro_override) {
                $description = Str::limit(strip_tags($alias->intro_override), 150, '');
            } else {
                $description = Str::limit("Layanan {$alias->keyword} profesional, cepat, tanpa bongkar dari Rootera. Teknisi bergaransi 30 hari di Jabodetabek, Bandung, Semarang, Lampung, Jogja, Solo.", 150, '');
            }
            $ogImage = $category->image ? secure_url('storage/' . $category->image) : secure_url('images/og/pipamampet.jpg');
            $canonical = url('/layanan/' . $alias->slug);
            $aliasFaqs = (!empty($alias->faq_overrides) && is_array($alias->faq_overrides)) ? $alias->faq_overrides : null;
        } elseif ($isCctv) {
            $title = "Jasa Inspeksi Kamera Pipa CCTV & Pelacak Saluran Air | Rootera";
            $description = "Layanan inspeksi visual kamera pipa CCTV, deteksi pipa bocor/pecah & pelacak letak septic tank tersembunyi tanpa bongkar. Bukti rekaman video HD.";
            $ogImage = secure_url('images/og/cctv.jpeg');
            $canonical = url('/layanan/' . $category->slug);
            $aliasFaqs = null;
        } elseif (str_contains($catSlug, 'wastafel') || str_contains($catSlug, 'sink')) {
            $title = Str::limit($category->meta_title ?? "Jasa {$category->name} Pelancar Pipa Mampet - Rootera", 60, '');
            $description = Str::limit($category->meta_description ?? "Layanan {$category->name} profesional, cepat, tanpa bongkar. Atasi sumbatan pipa air & wastafel di Jabodetabek, Bandung, Semarang, Lampung, Jogja, Solo.", 150, '');
            $ogImage = secure_url('images/og/wastafel.jpg');
            $canonical = url('/layanan/' . $category->slug);
            $aliasFaqs = null;
        } elseif (str_contains($catSlug, 'wc') || str_contains($catSlug, 'kloset') || str_contains($catSlug, 'toilet')) {
            $title = Str::limit($category->meta_title ?? "Jasa {$category->name} Pelancar Pipa Mampet - Rootera", 60, '');
            $description = Str::limit($category->meta_description ?? "Layanan {$category->name} profesional, cepat, tanpa bongkar. Atasi sumbatan pipa air & WC di Jabodetabek, Bandung, Semarang, Lampung, Jogja, Solo.", 150, '');
            $ogImage = secure_url('images/og/kloset.jpeg');
            $canonical = url('/layanan/' . $category->slug);
            $aliasFaqs = null;
        } elseif (str_contains($catSlug, 'kamar-mandi') || str_contains($catSlug, 'floor-drain')) {
            $title = Str::limit($category->meta_title ?? "Jasa {$category->name} Pelancar Pipa Mampet - Rootera", 60, '');
            $description = Str::limit($category->meta_description ?? "Layanan {$category->name} profesional, cepat, tanpa bongkar. Atasi sumbatan floor drain kamar mandi di Jabodetabek, Bandung, Semarang, Lampung, Jogja, Solo.", 150, '');
            $ogImage = secure_url('images/og/floor-drain.jpeg');
            $canonical = url('/layanan/' . $category->slug);
            $aliasFaqs = null;
        } elseif (str_contains($catSlug, 'got') || str_contains($catSlug, 'saluran-pembuangan') || str_contains($catSlug, 'bak-kontrol')) {
            $title = Str::limit($category->meta_title ?? "Jasa {$category->name} Pelancar Pipa Mampet - Rootera", 60, '');
            $description = Str::limit($category->meta_description ?? "Layanan {$category->name} profesional, cepat, tanpa bongkar. Atasi sumbatan got & bak kontrol di Jabodetabek, Bandung, Semarang, Lampung, Jogja, Solo.", 150, '');
            $ogImage = secure_url('images/og/gutter.jpg');
            $canonical = url('/layanan/' . $category->slug);
            $aliasFaqs = null;
        } elseif (str_contains($catSlug, 'industri') || str_contains($catSlug, 'b2b') || str_contains($catSlug, 'pabrik')) {
            $title = Str::limit($category->meta_title ?? "Jasa {$category->name} Pelancar Pipa Mampet - Rootera", 60, '');
            $description = Str::limit($category->meta_description ?? "Layanan {$category->name} profesional, cepat, tanpa bongkar. Atasi sumbatan pipa industri & gedung di Jabodetabek, Bandung, Semarang, Lampung, Jogja, Solo.", 150, '');
            $ogImage = secure_url('images/og/industri.jpeg');
            $canonical = url('/layanan/' . $category->slug);
            $aliasFaqs = null;
        } else {
            $title = Str::limit($category->meta_title ?? "Jasa {$category->name} Pelancar Pipa Mampet - Rootera", 60, '');
            $description = Str::limit($category->meta_description ?? "Layanan {$category->name} profesional, cepat, tanpa bongkar. Atasi sumbatan pipa air & wastafel di Jabodetabek, Bandung, Semarang, Lampung, Jogja, Solo.", 150, '');
            $ogImage = $category->image ? secure_url('storage/' . $category->image) : secure_url('images/og/pipamampet.jpg');
            $canonical = url('/layanan/' . $category->slug);
            $aliasFaqs = null;
        }

        $seo = [
            'title'       => $title,
            'description' => $description,
            'canonical'   => $canonical,
            'og_image'    => $ogImage,
        ];

        return view('pages.layanan-detail', compact(
            'category',
            'alias',
            'aliasFaqs',
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

    public function cuciToren()
    {
        return response()->view('errors.410', [
            'title'   => 'Layanan Cuci Toren Telah Dinonaktifkan Permanen',
            'message' => 'Layanan Cuci Toren & Kuras Tandon Air telah dihentikan secara permanen.',
        ], 410);
    }
}
