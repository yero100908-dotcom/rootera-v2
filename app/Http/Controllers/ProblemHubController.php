<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\ServiceCategory;
use App\Models\Article;
use App\Models\ProjectGallery;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ProblemHubController extends Controller
{
    public function show(string $problemSlug, ?string $citySlug = null)
    {
        $cacheKey = "problem_hub_v3_{$problemSlug}_" . ($citySlug ?? 'all');

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
                    'price_home' => 'Rp 350.000',
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

            $problemInfo = $isPredefinedProblem ? $problems[$problemSlug] : [
                'name' => Str::title(str_replace('-', ' ', $problemSlug)),
                'category_slug' => 'pipa-mampet',
                'description' => 'Solusi pelancaran pipa mampet profesional 24 jam tanpa merusak struktur bangunan.',
                'price_home' => 'Rp 350.000',
                'price_corporate' => 'Hubungi CS',
            ];

            $category = ServiceCategory::where('slug', $problemInfo['category_slug'])
                ->with(['services' => function ($q) {
                    $q->where('is_active', true)->orderBy('sort_order');
                }])
                ->first();

            $city = null;
            if ($citySlug) {
                $city = City::where('slug', $citySlug)
                    ->where('is_active', true)
                    ->with(['province', 'districts'])
                    ->first();
            }

            $allCities = City::where('is_active', true)
                ->with('province')
                ->orderBy('sort_order')
                ->get();

            $allCategories = ServiceCategory::where('is_active', true)
                ->orderBy('sort_order')
                ->get();

            $articles = Article::published()
                ->latest('published_at')
                ->take(3)
                ->get();

            $showcases = ProjectGallery::where('is_active', true)
                ->with(['district', 'city'])
                ->take(6)
                ->get();

            $cityName = $city ? $city->full_name : 'Jabodetabek, Bandung, Semarang & Indonesia';

            // Clean up name by removing repetitive prefixes ("Jasa", "Pelancar", etc.)
            $cleanName = preg_replace('/^(jasa|pelancar|tukang|service)\s+/i', '', $problemInfo['name']);
            if ($city && Str::endsWith(strtolower($cleanName), strtolower($city->name))) {
                $cleanName = trim(substr($cleanName, 0, -strlen($city->name)));
            }

            $title = "Solusi " . (str_starts_with(strtolower($cleanName), 'jasa') ? $cleanName : "Jasa " . $cleanName) . " Terdekat di {$cityName} - Rootera";
            $metaDescription = "Solusi {$cleanName} di {$cityName}. Garansi tuntas 100% tanpa bongkar ubin oleh teknisi bersertifikat Rootera (J&J Group). Hubungi 24 Jam!";
            // Canonical consolidation: pointing problem hub city pages to single source of truth City Pillar Page
            $canonical = $city 
                ? url('/jasa-saluran-mampet/' . $city->slug)
                : url('/solusi/' . $problemSlug);

            $seo = [
                'title'        => $title,
                'description'  => $metaDescription,
                'canonical'    => $canonical,
                'og_image'     => asset('images/JnJ.webp'),
                'is_indexable' => $isPredefinedProblem, // Safe fallback: auto-generated dynamic tag URLs use noindex
            ];

            return view('pages.problem-hub', compact(
                'problemSlug',
                'problemInfo',
                'category',
                'city',
                'allCities',
                'allCategories',
                'articles',
                'showcases',
                'title',
                'metaDescription',
                'canonical',
                'seo'
            ))->render();
        });

        return response($html);
    }
}
