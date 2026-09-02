<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use App\Models\ServiceCategory;
use App\Models\ProjectGallery;
use App\Models\Article;
use App\Models\Faq;
use App\Services\SpintaxService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AreaServiceController extends Controller
{
    protected SpintaxService $spintaxService;

    public function __construct(SpintaxService $spintaxService)
    {
        $this->spintaxService = $spintaxService;
    }

    /**
     * Master Index Directory Page (/jasa-saluran-mampet)
     */
    public function indexDirectory()
    {
        $html = Cache::remember('area_directory_index_v3', 86400, function () {
            $provinces = Province::where('is_active', true)
                ->with(['cities' => function ($q) {
                    $q->where('is_active', true)->with(['districts' => function ($dq) {
                        $dq->where('is_active', true)->orderBy('name');
                    }])->orderBy('sort_order')->orderBy('name');
                }])
                ->orderBy('sort_order')
                ->get();

            $services = ServiceCategory::where('is_active', true)
                ->orderBy('sort_order')
                ->get();

            $propertyTypes = class_exists('\App\Models\PropertyType')
                ? \App\Models\PropertyType::where('is_active', true)->orderBy('sort_order')->get()
                : collect();

            $seo = [
                'title'       => 'Jasa Saluran Pipa Mampet Terdekat di Seluruh Indonesia - 24 Jam Bergaransi | Rootera Plumbing',
                'description' => 'Direktori resmi wilayah operasional Rootera Plumbing (J&J Group). Layanan pelancaran pipa mampet tanpa bongkar di Jabodetabek, Banten, Jawa Barat, Jawa Tengah, DIY, Jawa Timur, dan Lampung.',
                'canonical'   => route('area-layanan'),
                'og_image'    => asset('images/JnJ.webp'),
            ];

            return view('pages.area.index-directory', compact('provinces', 'services', 'propertyTypes', 'seo'))->render();
        });

        return response($html);
    }

    /**
     * Display City Hub page (/jasa-saluran-mampet/{city:slug})
     */
    public function showCity(string $citySlug)
    {
        $html = Cache::remember("area_city_v3_{$citySlug}", 86400, function () use ($citySlug) {
            $city = City::where('slug', $citySlug)
                ->where('is_active', true)
                ->with(['province', 'districts' => function ($q) {
                    $q->where('is_active', true)->orderBy('sort_order')->orderBy('name');
                }])
                ->first();

            if (!$city) {
                $aliasMap = [
                    'tangerang-kota'   => 'tangerang',
                    'kab-tangerang'    => 'kabupaten-tangerang',
                    'cikarang'         => 'kabupaten-bekasi',
                    'karawang'         => 'kabupaten-karawang',
                    'sleman'           => 'kabupaten-sleman',
                    'sidoarjo'         => 'kabupaten-sidoarjo',
                    'gresik'           => 'surabaya',
                ];

                if (isset($aliasMap[$citySlug])) {
                    $targetSlug = $aliasMap[$citySlug];
                    $city = City::where('slug', $targetSlug)->where('is_active', true)->first();
                }
            }

            if (!$city) {
                $city = City::where('slug', 'like', "%{$citySlug}%")->where('is_active', true)->first()
                     ?? City::where('is_active', true)->firstOrFail();
            }

            $siblingCities = City::where('province_id', $city->province_id)
                ->where('id', '!=', $city->id)
                ->where('is_active', true)
                ->orderBy('name')
                ->take(8)
                ->get();

            $allCategories = ServiceCategory::where('is_active', true)
                ->orderBy('sort_order')
                ->get();

            $projectShowcases = ProjectGallery::where('is_active', true)
                ->where(function ($q) use ($city) {
                    $q->where('city_id', $city->id)->orWhereNull('city_id');
                })
                ->with(['district', 'city'])
                ->take(6)
                ->get();

            $relatedArticles = Article::published()
                ->latest('published_at')
                ->take(3)
                ->get();

            $faqs = Faq::where('is_active', true)->orderBy('sort_order')->get();

            // Priority Custom DB Meta Tags with Dynamic Fallback
            $title = !empty($city->meta_title)
                ? $city->meta_title
                : "Jasa Saluran Pipa Mampet {$city->full_name} 24 Jam Bergaransi | Rootera (J&J Group)";

            $description = !empty($city->meta_description)
                ? $city->meta_description
                : "Solusi jasa perbaikan pipa mampet, wastafel tersumbat, kran air, & toilet di {$city->full_name}. Pengerjaan cepat tanpa bongkar ({$city->estimated_arrival}) oleh Rootera Plumbing.";

            $canonical = url("/jasa-saluran-mampet/{$city->slug}");

            $seo = [
                'title'       => $title,
                'description' => $description,
                'canonical'   => $canonical,
                'og_image'    => asset('images/JnJ.webp'),
            ];

            // Spintax Dynamic Text Generation for Anti-Duplicate Content Engine
            $seedKey = "city_hub_" . md5($canonical);
            $heroHeadline = $this->spintaxService->generateHeroHeadline("Saluran Pipa Mampet", $city->full_name, $seedKey);
            $heroSubtitle = $this->spintaxService->generateHeroSubtitle("Saluran Pipa Mampet", $city->full_name, $city->estimated_arrival ?? "25–40 Menit", $seedKey);
            $valueProps = $this->spintaxService->generateValueProps($city->name, $seedKey);
            $areaTechnicalIntro = $this->spintaxService->generateAreaTechnicalIntro("pipa mampet", $city->full_name, $seedKey);

            return view('pages.area-city', compact(
                'city',
                'siblingCities',
                'allCategories',
                'projectShowcases',
                'relatedArticles',
                'faqs',
                'seo',
                'heroHeadline',
                'heroSubtitle',
                'valueProps',
                'areaTechnicalIntro'
            ))->render();
        });

        return response($html);
    }

    /**
     * Display Province Region Hub page (/area-jasa-pipa-mampet/{region:slug})
     */
    public function showRegion(string $regionSlug)
    {
        $html = Cache::remember("area_region_v3_{$regionSlug}", 86400, function () use ($regionSlug) {
            $province = Province::where('slug', $regionSlug)
                ->where('is_active', true)
                ->with(['cities' => function ($q) {
                    $q->where('is_active', true)->with(['districts' => function ($dq) {
                        $dq->where('is_active', true)->orderBy('sort_order')->orderBy('name');
                    }])->orderBy('sort_order')->orderBy('name');
                }])
                ->firstOrFail();

            $allCategories = ServiceCategory::where('is_active', true)->orderBy('sort_order')->get();

            $canonical = url("/area-jasa-pipa-mampet/{$province->slug}");

            $seo = [
                'title'       => "Jasa Pipa Mampet Wilayah {$province->name} - 24 Jam | Rootera Plumbing",
                'description' => "Layanan panggil teknisi pipa mampet profesional untuk seluruh kota & kabupaten di provinsi {$province->name}. Pengerjaan tanpa bongkar & bergaransi.",
                'canonical'   => $canonical,
                'og_image'    => asset('images/JnJ.webp'),
            ];

            $seedKey = "region_hub_" . md5($canonical);
            $heroHeadline = $this->spintaxService->generateHeroHeadline("Pipa Mampet", "Provinsi " . $province->name, $seedKey);
            $heroSubtitle = $this->spintaxService->generateHeroSubtitle("Pipa Mampet", "Provinsi " . $province->name, "25–45 Menit", $seedKey);

            return view('pages.area-region', compact('province', 'allCategories', 'seo', 'heroHeadline', 'heroSubtitle'))->render();
        });

        return response($html);
    }
}

