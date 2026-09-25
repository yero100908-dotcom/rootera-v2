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
    protected \App\Services\DistrictVillageService $villageService;

    public function __construct(SpintaxService $spintaxService, \App\Services\DistrictVillageService $villageService)
    {
        $this->spintaxService = $spintaxService;
        $this->villageService = $villageService;
    }

    /**
     * Display programmatic landing page for Service Category + City OR Service Category + City + District.
     */
    public function show(string $categorySlug, string $citySlug, ?string $districtSlug = null)
    {
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
            $targetUrl = $districtSlug
                ? url("/layanan-pipa-mampet/{$categorySlug}/{$aliasMap[$citySlug]}/{$districtSlug}")
                : url("/layanan-pipa-mampet/{$categorySlug}/{$aliasMap[$citySlug]}");
            return redirect($targetUrl, 301);
        }

        if (!$districtSlug && $categorySlug === 'pipa-mampet') {
            return redirect(url("/jasa-saluran-mampet/{$citySlug}"), 301);
        }

        $cacheKey = "prog_seo_v8_{$categorySlug}_{$citySlug}_" . ($districtSlug ?? 'all');

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
                ->with(['district', 'city', 'serviceCategory'])
                ->latest()
                ->take(4)
                ->get();

            if ($projectShowcases->count() < 4) {
                $existingIds = $projectShowcases->pluck('id')->toArray();
                $moreShowcases = ProjectGallery::where('is_active', true)
                    ->whereNotIn('id', $existingIds)
                    ->with(['district', 'city', 'serviceCategory'])
                    ->latest()
                    ->take(4 - $projectShowcases->count())
                    ->get();
                $projectShowcases = $projectShowcases->concat($moreShowcases);
            }

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
            $nearbyLandmarks = $this->villageService->getVillagesForDistrict($district ? $district->slug : null, $city->slug, $locationShort);

            $firstLandmark = !empty($nearbyLandmarks) ? $nearbyLandmarks[0] : $locationShort;
            $secondLandmark = (count($nearbyLandmarks) > 1) ? $nearbyLandmarks[1] : $locationShort;

            $localFaqs = [
                [
                    'question' => "Berapa lama estimasi waktu kedatangan teknisi Rootera di area {$locationShort}?",
                    'answer' => "Teknisi terdekat kami disiagakan di {$dispatchHub} dengan estimasi waktu tempuh rata-rata {$travelTime} melayani seluruh area {$locationShort} hingga kawasan kelurahan {$firstLandmark}."
                ],
                [
                    'question' => "Apakah pengerjaan jasa {$category->name} di {$locationShort} membutuhkan pembongkaran lantai?",
                    'answer' => "Tidak ada pembongkaran. Kami menggunakan teknologi spiral rotary cable & Hydro Jetting tekanan tinggi yang melancarkan saluran {$category->name} 100% tanpa merusak keramik di {$locationShort}."
                ],
                [
                    'question' => "Apakah penanganan {$category->name} di area {$locationShort} dilengkapi garansi?",
                    'answer' => "Ya, seluruh pengerjaan di area {$locationShort} (termasuk kelurahan {$firstLandmark}, {$secondLandmark}, dan sekitarnya) dilengkapi garansi resmi 30 hari pasca pengerjaan (Tuntas Baru Bayar)."
                ]
            ];

            // Generate Dynamic Transactional SEO Metadata (Title: 50-60 chars, Meta Desc: 140-155 chars)
            $seedKey = "spintax_" . md5($district ? url("/layanan-pipa-mampet/{$category->slug}/{$city->slug}/{$district->slug}") : url("/layanan-pipa-mampet/{$category->slug}/{$city->slug}"));
            
            $title = $this->spintaxService->generateMetaTitle($category->name, $locationName, $district ? $district->name : null, $seedKey);
            $description = $this->spintaxService->generateMetaDescription($category->name, $locationName, $estimatedArrival, $seedKey);

            if ($district) {
                // Self-referencing canonical for district pages to index district landing pages individually in Google Search
                $canonical = url("/layanan-pipa-mampet/{$category->slug}/{$city->slug}/{$district->slug}");
            } else {
                if ($category->slug === 'pipa-mampet') {
                    $canonical = url("/jasa-saluran-mampet/{$city->slug}");
                } else {
                    $canonical = url("/layanan-pipa-mampet/{$category->slug}/{$city->slug}");
                }
            }

            $catSlug = strtolower($category->slug ?? '');
            if (str_contains($catSlug, 'cctv') || str_contains($catSlug, 'inspeksi') || str_contains($catSlug, 'deteksi')) {
                $ogImage = secure_url('images/og/cctv.jpeg');
            } elseif (str_contains($catSlug, 'wastafel') || str_contains($catSlug, 'sink')) {
                $ogImage = secure_url('images/og/wastafel.jpg');
            } elseif (str_contains($catSlug, 'wc') || str_contains($catSlug, 'kloset') || str_contains($catSlug, 'toilet')) {
                $ogImage = secure_url('images/og/kloset.jpeg');
            } elseif (str_contains($catSlug, 'kamar-mandi') || str_contains($catSlug, 'floor-drain')) {
                $ogImage = secure_url('images/og/floor-drain.jpeg');
            } elseif (str_contains($catSlug, 'got') || str_contains($catSlug, 'saluran-pembuangan') || str_contains($catSlug, 'bak-kontrol')) {
                $ogImage = secure_url('images/og/gutter.jpg');
            } elseif (str_contains($catSlug, 'industri') || str_contains($catSlug, 'b2b') || str_contains($catSlug, 'pabrik')) {
                $ogImage = secure_url('images/og/industri.jpeg');
            } elseif (str_contains($catSlug, 'pipa') || str_contains($catSlug, 'mampet')) {
                $ogImage = secure_url('images/og/pipamampet.jpg');
            } else {
                $ogImage = secure_url('images/og/rootera-default.jpg');
            }

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
            $areaTechnicalIntro = $this->spintaxService->generateAreaTechnicalIntro($category->name, $locationName, $seedKey, $nearbyLandmarks);
            $guaranteeCallout = $this->spintaxService->generateGuaranteeCallout($locationShort, $seedKey);
            $sectionOrder = $this->spintaxService->getSectionOrder($seedKey);
            $technicalContext = $this->getTechnicalContext($category->slug, $locationShort);

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
                'areaTechnicalIntro',
                'guaranteeCallout',
                'sectionOrder',
                'technicalContext'
            ))->render();
        });

        return response($html);
    }

    /**
     * Get Category-Specific Technical Context for pSEO pages.
     */
    protected function getTechnicalContext(string $categorySlug, string $locationShort): array
    {
        switch ($categorySlug) {
            case 'wastafel-mampet':
            case 'wastafel-cuci-piring':
                return [
                    'problem_causes' => [
                        'Penumpukan gumpalan lemak minyak goreng beku yang mengeras di dinding leher angsa (P-trap/S-trap).',
                        'Sisa akumulasi nasi, potongan sayuran, dan endapan organik yang membusuk di saluran buang.',
                        "Penyempitan lumen pipa PVC di kawasan {$locationShort} akibat pengerakan kerak sabun cuci piring bercampur minyak."
                    ],
                    'methodology' => [
                        'Pelancaran mekanis rotary spiral cable Ridgid yang memecahkan bekuan lemak tanpa bongkar pipa.',
                        'Pembersihan dinding pipa dengan mata pisau pemotong lemak khusus.',
                        'Flushing aliran air deras untuk memastikan kerak lemak terbuang tuntas ke bak kontrol.'
                    ],
                    'preventative_tip' => 'Hindari membuang minyak jelantah langsung ke bak cuci piring. Gunakan saringan lemak (grease trap) dan bilas dengan air hangat berkala.',
                    'risk_warning' => 'Menuangkan soda api cair berlebihan dapat membengkokkan pipa PVC tipis dan membekukan lemak menjadi seperti semen.'
                ];

            case 'kamar-mandi-mampet':
            case 'floor-drain-kamar-mandi':
                return [
                    'problem_causes' => [
                        'Rontokan helai rambut yang tersangkut dan menggumpal di saringan floor drain.',
                        'Residu kerak sabun mandi (soap scum) yang membeku bercampur endapan kapur air tanah.',
                        "Pasir, rontokan semen keramik, atau rontokan spons mandi di area {$locationShort} yang masuk ke perangkap bau (odor trap)."
                    ],
                    'methodology' => [
                        'Penarikan gumpalan rambut dan kerak dengan kabel fleksibel anti-lilit.',
                        'Pembersihan kerak kapur di siku leher angsa kamar mandi tanpa membongkar lantai ubin.',
                        'Pengujian debit alir penuh untuk memastikan tidak ada air menggenang saat mandi.'
                    ],
                    'preventative_tip' => 'Pasang saringan mesh halus di atas floor drain dan bersihkan gumpalan rambut setiap selesai mandi.',
                    'risk_warning' => 'Bongkar paksa floor drain berisiko merusak lapisan kedap air (waterproofing) dan memicu kebocoran ke lantai bawah.'
                ];

            case 'wc-toilet-mampet':
            case 'wc-kloset-toilet':
                return [
                    'problem_causes' => [
                        'Sumbatan benda asing seperti tisu basah, pembalut, pembersih telinga, atau mainan anak.',
                        'Penumpukan kerak kalsium/urin di saluran leher angsa mangkuk kloset (toilet bowl trap).',
                        "Penyempitan jalur pipa menuju septic tank hunian {$locationShort} akibat saluran udara bak kontrol tersumbat."
                    ],
                    'methodology' => [
                        'Pendorongan dan evakuasi benda asing dengan mesin spiral rotary berkepala kait khusus.',
                        'Pelancaran leher angsa kloset duduk/jongkok 100% tanpa melepas atau merusak mangkuk WC.',
                        'Uji siram (flushing test) dengan tekanan air penuh untuk memastikan sedot limbah lancar.'
                    ],
                    'preventative_tip' => 'Sediakan tempat sampah khusus di kamar mandi dan edukasi penghuni untuk tidak membuang tisu/pembalut ke dalam kloset.',
                    'risk_warning' => 'Menggunakan pemukul manual atau bahan kimia panas ekstrem dapat merekatkan sumbatan dan meretakkan keramik kloset.'
                ];

            case 'got-saluran-pembuangan':
            case 'got-saluran-pembuangan-utama':
                return [
                    'problem_causes' => [
                        "Sedimentasi endapan lumpur tebal dan pasir yang mengendap di bak kontrol kawasan {$locationShort}.",
                        'Sampah daun rontok, ranting, dan sampah plastik yang terbawa air hujan ke talang & got.',
                        'Pertumbuhan akar pohon yang menerobos sambungan pipa pembuangan luar.'
                    ],
                    'methodology' => [
                        'Pembersihan lumpur dan sampah menggunakan mesin pemutar kabel heavy-duty.',
                        'Hydro-jetting tekanan tinggi untuk merontokkan kerak sedimen di pipa drainase utama.',
                        'Pengurasan dan pemeriksaan kelancaran aliran bak kontrol hingga muara got kota.'
                    ],
                    'preventative_tip' => 'Lakukan pembersihan bak kontrol dan talang air hujan secara berkala setiap menyambut musim hujan.',
                    'risk_warning' => 'Got tersumbat yang dibiarkan dapat memicu luapan air kotor berbau ke dalam rumah saat curah hujan tinggi.'
                ];

            default: // pipa-mampet
                return [
                    'problem_causes' => [
                        "Akumulasi gabungan kerak minyak, sisa sabun, dan sedimen tanah di pipa utama area {$locationShort}.",
                        'Penyempitan diameter dalam pipa PVC akibat pengerakan bertahun-tahun.',
                        'Kemiringan (slope) instalasi pipa yang kurang curam sehingga aliran air lambat.'
                    ],
                    'methodology' => [
                        'Inspeksi titik sumbatan dan pendorongan spiral fleksibel Ridgid.',
                        'Pelancaran jalur pipa horizontal maupun vertikal tanpa membongkar tembok/lantai.',
                        'Verifikasi aliran lancar 100% dan garansi pengerjaan ulang 30 hari.'
                    ],
                    'preventative_tip' => 'Gunakan saringan di setiap afur buangan dan hindari membuang padatan ke saluran air.',
                    'risk_warning' => 'Pipa tersumbat total yang dipaksa dialiri air bertekanan tanpa pelancaran dapat memicu kebocoran sambungan pipa.'
                ];
        }
    }

    /**
     * Display programmatic Cuci Toren City Hub landing page (/jasa-cuci-toren/{citySlug}) -> 410 Gone
     */
    public function cuciTorenCity(string $citySlug)
    {
        return response()->view('errors.410', [
            'title'   => 'Layanan Cuci Toren Telah Dinonaktifkan Permanen',
            'message' => 'Layanan Cuci Toren & Kuras Tandon Air telah dihentikan secara permanen.',
        ], 410);
    }

    /**
     * Display programmatic Cuci Toren District Spoke landing page (/layanan-cuci-toren/{citySlug}/{districtSlug}) -> 410 Gone
     */
    public function cuciTorenDistrict(string $citySlug, string $districtSlug)
    {
        return response()->view('errors.410', [
            'title'   => 'Layanan Cuci Toren Telah Dinonaktifkan Permanen',
            'message' => 'Layanan Cuci Toren & Kuras Tandon Air telah dihentikan secara permanen.',
        ], 410);
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
                ? "Jasa Cuci Toren {$district->name}, {$city->name} | Rootera"
                : "Jasa Cuci Toren & Kuras Tandon {$city->name} | Rootera";

            if (mb_strlen($title) > 60) {
                $title = $district
                    ? "Jasa Cuci Toren {$district->name} | Rootera"
                    : "Jasa Cuci Toren {$city->name} | Rootera";
            }
            if (mb_strlen($title) > 60) {
                $title = mb_strimwidth($title, 0, 58, '..');
            }

            $description = $district
                ? "Jasa cuci toren & kuras tandon air di {$district->name}, {$city->name}. Sterilisasi lumut & lumpur jet washer food-grade. Garansi air jernih!"
                : "Spesialis jasa cuci toren air & kuras tandon terpercaya di {$city->name}. Pengurasan higienis tanpa kimia korosif. Garansi air jernih. WA 24 Jam!";

            if (mb_strlen($description) > 155) {
                $description = mb_strimwidth($description, 0, 152, '...');
            }

            $canonical = $district
                ? url("/layanan-cuci-toren/{$city->slug}/{$district->slug}")
                : url("/jasa-cuci-toren/{$city->slug}");

            $ogImage = secure_url('images/og/rootera-default.jpg');

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
