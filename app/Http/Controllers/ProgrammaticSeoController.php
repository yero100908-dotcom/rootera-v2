<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Models\City;
use App\Models\District;
use App\Models\Faq;
use App\Models\Technology;
use App\Models\ProjectGallery;
use App\Models\Article;
use App\Services\SpintaxService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ProgrammaticSeoController extends Controller
{
    protected SpintaxService $spintaxService;

    public function __construct(SpintaxService $spintaxService)
    {
        $this->spintaxService = $spintaxService;
    }

    /**
     * Display programmatic landing page for Service Category + City OR Service Category + City + District.
     */
    public function show(string $categorySlug, string $citySlug, ?string $districtSlug = null)
    {
        $cacheKey = "prog_seo_v3_{$categorySlug}_{$citySlug}_" . ($districtSlug ?? 'all');

        // Cache rendered HTML string for 24 Hours (86400s) to prevent any model unserialization errors & provide instant responses
        $html = Cache::remember($cacheKey, 86400, function () use ($categorySlug, $citySlug, $districtSlug) {
            $category = ServiceCategory::where('slug', $categorySlug)
                ->where('is_active', true)
                ->firstOrFail();

            $city = City::where('slug', $citySlug)
                ->where('is_active', true)
                ->with(['province', 'districts' => function ($q) {
                    $q->where('is_active', true)->orderBy('sort_order')->orderBy('name');
                }])
                ->firstOrFail();

            $district = null;
            if ($districtSlug) {
                $district = District::where('city_id', $city->id)
                    ->where('slug', $districtSlug)
                    ->where('is_active', true)
                    ->firstOrFail();
            }

            // Neighboring districts in the same city for spoke linking
            $siblingDistricts = $city->districts->filter(function ($d) use ($district) {
                return !$district || $d->id !== $district->id;
            })->take(12)->values();

            // Neighboring cities in the same province for regional linking
            $siblingCities = City::where('province_id', $city->province_id)
                ->where('id', '!=', $city->id)
                ->where('is_active', true)
                ->get();

            // All active service categories for cross-service linking
            $allCategories = ServiceCategory::where('is_active', true)
                ->where('id', '!=', $category->id)
                ->orderBy('sort_order')
                ->get();

            $projectShowcases = ProjectGallery::where('is_active', true)
                ->where(function ($q) use ($city) {
                    $q->where('city_id', $city->id)->orWhereNull('city_id');
                })
                ->with(['district', 'city'])
                ->take(6)
                ->get();

            $relatedArticles = \App\Models\Article::published()
                ->latest('published_at')
                ->take(3)
                ->get();

            $faqs = Faq::where('is_active', true)->orderBy('sort_order')->get();
            $technologies = Technology::where('is_active', true)->orderBy('sort_order')->get();

            $locationName = $district ? "{$district->name}, {$city->full_name}" : $city->full_name;
            $locationShort = $district ? $district->name : $city->name;
            $estimatedArrival = $district ? ($district->estimated_arrival ?? "30–45 Menit") : ($city->estimated_arrival ?? "30–45 Menit");
            $dispatchHub = $district ? "Pos Hub Armada Kecamatan {$district->name}" : "Pos Hub Armada Utama {$city->name}";
            $travelTime = $estimatedArrival;
            $nearbyLandmarks = $siblingDistricts->pluck('name')->filter()->take(6)->values()->toArray();

            $localFaqs = [
                [
                    'question' => "Berapa lama estimasi waktu kedatangan teknisi Rootera di area {$locationShort}?",
                    'answer' => "Teknisi terdekat kami disiagakan di {$dispatchHub} dengan estimasi waktu tempuh rata-rata {$travelTime} setelah jadwal pemesanan dikonfirmasi tim WhatsApp 24 jam."
                ],
                [
                    'question' => "Apakah pengerjaan pipa mampet di wilayah {$locationShort} membutuhkan pembongkaran lantai?",
                    'answer' => "Tidak ada pembongkaran. Kami menggunakan teknologi spiral rotary cable & Hydro Jetting tekanan tinggi yang melancarkan saluran mampet 100% tanpa merusak keramik atau dinding di {$locationShort}."
                ],
                [
                    'question' => "Apakah pengerjaan jasa {$category->name} di {$locationShort} dilengkapi garansi?",
                    'answer' => "Ya, seluruh penanganan pelancaran saluran pipa air di area {$locationShort} dilengkapi garansi resmi 30 hari pasca pengerjaan demi jaminan tuntas."
                ]
            ];

            // Generate Dynamic Transactional SEO Metadata
            $title = $district
                ? "Jasa Pipa Mampet {$district->name}, {$city->name} - Cepat 24 Jam Bergaransi | Rootera"
                : "Jasa Saluran Pipa Mampet {$city->full_name} - Respon Cepat 30 Menit Bergaransi | Rootera";

            $description = $district
                ? "Tukang saluran air tersumbat & jasa {$category->name} di {$district->name}, {$city->name}. Respon cepat ({$travelTime}), pengerjaan mekanis rotasi spiral tanpa bongkar pipa & bergaransi 30 hari. Hubungi WhatsApp 24 Jam!"
                : "Spesialis jasa {$category->name} terpercaya di {$city->full_name}. Pengerjaan cepat ({$travelTime}), profesional tanpa bongkar paksa, dan bergaransi resmi PT/CV J&J Group. Hubungi WhatsApp 24 Jam!";

            if (!$district && $category->slug === 'pipa-mampet') {
                $canonical = url("/jasa-saluran-mampet/{$city->slug}");
            } else {
                $canonical = $district
                    ? url("/layanan-pipa-mampet/{$category->slug}/{$city->slug}/{$district->slug}")
                    : url("/layanan-pipa-mampet/{$category->slug}/{$city->slug}");
            }

            $ogImage = $category->image ? asset('storage/' . $category->image) : asset('images/JnJ.webp');

            $seo = [
                'title'       => $title,
                'description' => $description,
                'canonical'   => $canonical,
                'og_image'    => $ogImage,
            ];

            // Generate Spintax Variations for Anti-Duplicate Content Engine
            $seedKey = "spintax_" . md5($canonical);
            $heroHeadline = $this->spintaxService->generateHeroHeadline($category->name, $locationName, $seedKey);
            $heroSubtitle = $this->spintaxService->generateHeroSubtitle($category->name, $locationName, $estimatedArrival, $seedKey);
            $valueProps = $this->spintaxService->generateValueProps($locationShort, $seedKey);
            $areaTechnicalIntro = $this->spintaxService->generateAreaTechnicalIntro($category->name, $locationName, $seedKey);

            return view('pages.programmatic-landing', compact(
                'category',
                'city',
                'district',
                'siblingDistricts',
                'siblingCities',
                'allCategories',
                'projectShowcases',
                'relatedArticles',
                'faqs',
                'technologies',
                'locationName',
                'locationShort',
                'estimatedArrival',
                'dispatchHub',
                'travelTime',
                'nearbyLandmarks',
                'localFaqs',
                'title',
                'description',
                'canonical',
                'ogImage',
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
     * Display programmatic Cuci Toren City Hub landing page (/jasa-cuci-toren/{citySlug})
     */
    public function cuciTorenCity(string $citySlug)
    {
        return $this->renderCuciTorenPage($citySlug, null);
    }

    /**
     * Display programmatic Cuci Toren District Spoke landing page (/layanan-cuci-toren/{citySlug}/{districtSlug})
     */
    public function cuciTorenDistrict(string $citySlug, string $districtSlug)
    {
        return $this->renderCuciTorenPage($citySlug, $districtSlug);
    }

    protected function renderCuciTorenPage(string $citySlug, ?string $districtSlug = null)
    {
        $cacheKey = "pseo_cuci_toren_v1_{$citySlug}_" . ($districtSlug ?? 'all');

        $html = Cache::remember($cacheKey, 86400, function () use ($citySlug, $districtSlug) {
            $city = City::where('slug', $citySlug)
                ->where('is_active', true)
                ->with(['province', 'districts' => function ($q) {
                    $q->where('is_active', true)->orderBy('sort_order')->orderBy('name');
                }])
                ->firstOrFail();

            $district = null;
            if ($districtSlug) {
                $district = District::where('city_id', $city->id)
                    ->where('slug', $districtSlug)
                    ->where('is_active', true)
                    ->firstOrFail();
            }

            // Neighboring districts in the same city for spoke linking
            $siblingDistricts = $city->districts->filter(function ($d) use ($district) {
                return !$district || $d->id !== $district->id;
            })->take(12)->values();

            // Neighboring cities in the same province for regional linking
            $siblingCities = City::where('province_id', $city->province_id)
                ->where('id', '!=', $city->id)
                ->where('is_active', true)
                ->get();

            $locationName = $district ? "{$district->name}, {$city->full_name}" : $city->full_name;
            $locationShort = $district ? $district->name : $city->name;
            $estimatedArrival = $district ? ($district->estimated_arrival ?? "25–40 Menit") : ($city->estimated_arrival ?? "30–45 Menit");
            $dispatchHub = $district ? "Pos Armada Sanitasi Kecamatan {$district->name}" : "Pos Armada Sanitasi Utama {$city->name}";

            $title = $district
                ? "Jasa Cuci Toren {$district->name}, {$city->name} | Kuras Tandon Air Bersih Bergaransi - Rootera"
                : "Jasa Cuci Toren & Kuras Tandon Air {$city->full_name} | Air Jernih Higienis - Rootera";

            $description = $district
                ? "Layanan cuci toren dan kuras tandon air profesional di {$district->name}, {$city->name}. Sterilisasi kerak lumut, pasir & endapan lumpur menggunakan High-Pressure Jet Cleaner. Respon cepat!"
                : "Spesialis jasa cuci toren air & kuras tandon terpercaya di {$city->full_name}. Pengurasan higienis tanpa bahan kimia korosif, garansi air jernih bebas bau. Hubungi WhatsApp 24 Jam!";

            $canonical = $district
                ? url("/layanan-cuci-toren/{$city->slug}/{$district->slug}")
                : url("/jasa-cuci-toren/{$city->slug}");

            $ogImage = asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp');

            $seo = [
                'title'       => $title,
                'description' => $description,
                'canonical'   => $canonical,
                'og_image'    => $ogImage,
            ];

            $localFaqs = [
                [
                    'question' => "Berapa estimasi waktu teknisi cuci toren tiba di wilayah {$locationShort}?",
                    'answer' => "Teknisi disiagakan dari {$dispatchHub} dengan estimasi waktu tiba rata-rata {$estimatedArrival} setelah jadwal pemesanan dikonfirmasi via WhatsApp."
                ],
                [
                    'question' => "Mengapa air tanah / toren di kawasan {$locationShort} sering berlumut dan kuning?",
                    'answer' => "Endapan pasir, zat besi tinggi, dan paparan sinar matahari memicu timbulnya lumut tebal & sisa karat di dinding toren area {$locationShort}. Pengurasan rutin 3-6 bulan sekali sangat disarankan."
                ],
                [
                    'question' => "Apakah proses cuci toren di {$locationShort} menggunakan cairan kimia keras?",
                    'answer' => "Tidak. Kami menggunakan 100% mechanical cleaning dengan High-Pressure Jet Washer mini food-grade safety tanpa asam korosif cair berbahaya."
                ]
            ];

            return view('pages.programmatic-cuci-toren', compact(
                'city',
                'district',
                'siblingDistricts',
                'siblingCities',
                'locationName',
                'locationShort',
                'estimatedArrival',
                'dispatchHub',
                'title',
                'description',
                'canonical',
                'ogImage',
                'seo',
                'localFaqs'
            ))->render();
        });

        return response($html);
    }
}
