<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use App\Models\Gallery;
use App\Models\ServiceCategory;
use App\Models\Article;
use App\Services\MediaService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ProblemHubController extends Controller
{
    public function show(string $problemSlug, ?string $citySlug = null)
    {
        $cacheKey = "problem_hub_v5_{$problemSlug}_" . ($citySlug ?? 'all');

        $html = Cache::remember($cacheKey, 86400, function () use ($problemSlug, $citySlug) {
            $problems = [
                'wastafel-mampet-berlemak' => [
                    'name' => 'Wastafel & Sink Dapur Mampet Berlemak',
                    'category_slug' => 'wastafel-mampet',
                    'description' => 'Solusi cepat pelancaran leher angsa wastafel dapur & bak cuci piring berlemak membeku tanpa bongkar.',
                    'price_home' => 'Rp 300.000',
                    'price_corporate' => 'Hubungi CS',
                ],
                'floor-drain-kamar-mandi-menggenang' => [
                    'name' => 'Floor Drain Kamar Mandi Menggenang',
                    'category_slug' => 'kamar-mandi-mampet',
                    'description' => 'Pembersihan rontokan rambut, kerak sabun, dan kapur pada saringan floor drain kamar mandi.',
                    'price_home' => 'Rp 400.000',
                    'price_corporate' => 'Hubungi CS',
                ],
                'kloset-wc-meluap' => [
                    'name' => 'Kloset & WC Toilet Mampet Meluap',
                    'category_slug' => 'wc-toilet-mampet',
                    'description' => 'Pelancaran leher angsa WC meluap & evakuasi benda asing dari kloset duduk/jongkok secara higienis.',
                    'price_home' => 'Rp 400.000',
                    'price_corporate' => 'Hubungi CS',
                ],
                'got-saluran-pembuangan-tersumbat' => [
                    'name' => 'Got & Saluran Pembuangan Utama Tersumbat',
                    'category_slug' => 'got-saluran-pembuangan',
                    'description' => 'Pembersihan talang air hujan, got perumahan, dan pengurasan sedimen lumpur bak kontrol.',
                    'price_home' => 'Rp 450.000',
                    'price_corporate' => 'Hubungi CS',
                ],
                'inspeksi-pipa-kamera-cctv' => [
                    'name' => 'Inspeksi Kamera CCTV & Deteksi Pipa Pecah',
                    'category_slug' => 'inspeksi-pipa-kamera',
                    'description' => 'Deteksi visual lokasi titik pipa pecah/bocor tersembunyi di dalam lantai atau dinding beton.',
                    'price_home' => 'Rp 500.000',
                    'price_corporate' => 'Hubungi CS',
                ],
                'pipa-industri-pabrik-tersumbat' => [
                    'name' => 'Pipa Komersial Pabrik, Restoran & Gedung',
                    'category_slug' => 'pipa-industri-pabrik',
                    'description' => 'Hydro-jetting tekanan tinggi & kontrak preventive maintenance pipa berkala untuk B2B.',
                    'price_home' => 'Custom Quote',
                    'price_corporate' => 'Penawaran Khusus',
                ],
            ];

            $isPredefinedProblem = isset($problems[$problemSlug]);

            $city = null;
            if ($citySlug) {
                $city = City::where('slug', $citySlug)
                    ->where('is_active', true)
                    ->with(['province', 'districts'])
                    ->first();
            }

            // Detect if $problemSlug contains a district name
            $matchedDistrict = null;
            $rawProblemTitle = Str::title(str_replace('-', ' ', $problemSlug));

            if ($city && $city->districts) {
                foreach ($city->districts as $d) {
                    $dSlug = Str::slug($d->name);
                    if (Str::endsWith(strtolower($problemSlug), '-' . $dSlug) || strtolower($problemSlug) === $dSlug) {
                        $matchedDistrict = $d;
                        break;
                    }
                }
            }

            if (!$matchedDistrict) {
                $districts = District::all();
                foreach ($districts as $d) {
                    $dSlug = Str::slug($d->name);
                    if (Str::endsWith(strtolower($problemSlug), '-' . $dSlug)) {
                        $matchedDistrict = $d;
                        if (!$city && $d->city_id) {
                            $city = City::where('id', $d->city_id)->with(['province', 'districts'])->first();
                        }
                        break;
                    }
                }
            }

            // Sanitize title & location extraction
            $cleanName = $isPredefinedProblem ? $problems[$problemSlug]['name'] : $rawProblemTitle;
            $districtName = $matchedDistrict ? $matchedDistrict->name : null;

            if ($matchedDistrict) {
                $cleanName = preg_replace('/\b' . preg_quote($matchedDistrict->name, '/') . '\b/i', '', $cleanName);
            }
            if ($city) {
                $cleanName = preg_replace('/\b' . preg_quote($city->name, '/') . '\b/i', '', $cleanName);
                $cleanName = preg_replace('/\b' . preg_quote($city->type, '/') . '\b/i', '', $cleanName);
            }

            $cleanName = preg_replace('/^(solusi|jasa|pelancar|tukang|service)\s+/i', '', trim($cleanName));
            $cleanName = trim(preg_replace('/\s+/', ' ', $cleanName));

            if (empty($cleanName)) {
                $sanitizedTitle = 'Jasa Pipa Mampet';
            } else {
                $sanitizedTitle = 'Jasa ' . Str::title($cleanName);
            }

            $problemInfo = $isPredefinedProblem ? $problems[$problemSlug] : [
                'name' => $sanitizedTitle,
                'category_slug' => 'pipa-mampet',
                'description' => 'Solusi pelancaran pipa mampet profesional 24 jam tanpa merusak struktur bangunan.',
                'price_home' => 'Rp 400.000',
                'price_corporate' => 'Hubungi CS',
            ];

            $problemInfo['name'] = $sanitizedTitle;

            $category = ServiceCategory::where('slug', $problemInfo['category_slug'])
                ->with(['services' => function ($q) {
                    $q->where('is_active', true)->orderBy('sort_order');
                }])
                ->first();

            // Neighbor / Sibling Districts
            $neighborDistricts = collect();
            if ($city && $city->districts) {
                if ($matchedDistrict) {
                    $neighborDistricts = $city->districts->where('id', '!=', $matchedDistrict->id)->take(12);
                } else {
                    $neighborDistricts = $city->districts->take(12);
                }
            }

            // Data Enrichment: 8 Gallery Items, 3 Articles, Toolkit Images
            $galleries = Gallery::where('is_active', true)->latest()->take(8)->get();
            $relatedArticles = Article::published()->latest('published_at')->take(3)->get();
            
            $mediaService = app(MediaService::class);
            $toolkitImages = $mediaService->getToolkitImages();

            $allCities = City::where('is_active', true)
                ->with('province')
                ->orderBy('sort_order')
                ->get();

            $allCategories = ServiceCategory::where('is_active', true)
                ->orderBy('sort_order')
                ->get();

            $locationLabel = $matchedDistrict 
                ? "{$matchedDistrict->name}, {$city->full_name}" 
                : ($city ? $city->full_name : 'Jabodetabek & Indonesia');

            $title = "Solusi {$sanitizedTitle} Terdekat di {$locationLabel} - Rootera";
            $metaDescription = "Solusi {$sanitizedTitle} di {$locationLabel}. Garansi tuntas 100% tanpa bongkar ubin oleh teknisi bersertifikat Rootera (J&J Group). Hubungi 24 Jam!";
            $canonical = $city 
                ? url('/jasa-saluran-mampet/' . $city->slug)
                : url('/solusi/' . $problemSlug);

            $seo = [
                'title'        => $title,
                'description'  => $metaDescription,
                'canonical'    => $canonical,
                'og_image'     => asset('images/JnJ.webp'),
                'is_indexable' => $isPredefinedProblem,
            ];

            return view('pages.problem-hub', compact(
                'problemSlug',
                'problemInfo',
                'sanitizedTitle',
                'districtName',
                'category',
                'city',
                'matchedDistrict',
                'neighborDistricts',
                'allCities',
                'allCategories',
                'galleries',
                'relatedArticles',
                'toolkitImages',
                'locationLabel',
                'title',
                'metaDescription',
                'canonical',
                'seo'
            ))->render();
        });

        return response($html);
    }
}
