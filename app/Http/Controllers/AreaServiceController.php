<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use App\Models\ServiceCategory;
use App\Models\ProjectGallery;
use App\Models\Article;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AreaServiceController extends Controller
{
    /**
     * Master Index Directory Page (/jasa-saluran-mampet)
     */
    public function indexDirectory()
    {
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
            'og_image'    => asset('images/JnJ.jpeg'),
        ];

        return view('pages.area.index-directory', compact('provinces', 'services', 'propertyTypes', 'seo'));
    }
    /**
     * Display City Hub page (/jasa-saluran-mampet/{city:slug})
     */
    public function showCity(string $citySlug)
    {
        $city = City::where('slug', $citySlug)
            ->where('is_active', true)
            ->with(['province', 'districts' => function ($q) {
                $q->where('is_active', true)->orderBy('sort_order')->orderBy('name');
            }])
            ->firstOrFail();

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

        $seo = [
            'title'       => "Jasa Saluran Pipa Mampet {$city->full_name} 24 Jam Bergaransi | Rootera (J&J Group)",
            'description' => "Solusi jasa perbaikan pipa mampet, wastafel tersumbat, kran air, & toilet di {$city->full_name}. Pengerjaan cepat tanpa bongkar ({$city->estimated_arrival}) oleh Rootera Plumbing.",
            'canonical'   => url("/jasa-saluran-mampet/{$city->slug}"),
            'og_image'    => asset('images/JnJ.jpeg'),
        ];

        return view('pages.area-city', compact(
            'city',
            'siblingCities',
            'allCategories',
            'projectShowcases',
            'relatedArticles',
            'faqs',
            'seo'
        ));
    }

    /**
     * Display Province Region Hub page (/area-jasa-pipa-mampet/{region:slug})
     */
    public function showRegion(string $regionSlug)
    {
        $province = Province::where('slug', $regionSlug)
            ->where('is_active', true)
            ->with(['cities' => function ($q) {
                $q->where('is_active', true)->with(['districts' => function ($dq) {
                    $dq->where('is_active', true)->orderBy('sort_order')->orderBy('name');
                }])->orderBy('sort_order')->orderBy('name');
            }])
            ->firstOrFail();

        $allCategories = ServiceCategory::where('is_active', true)->orderBy('sort_order')->get();

        $seo = [
            'title'       => "Jasa Pipa Mampet Wilayah {$province->name} - 24 Jam | Rootera Plumbing",
            'description' => "Layanan panggil teknisi pipa mampet profesional untuk seluruh kota & kabupaten di provinsi {$province->name}. Pengerjaan tanpa bongkar & bergaransi.",
            'canonical'   => url("/area-jasa-pipa-mampet/{$province->slug}"),
            'og_image'    => asset('images/JnJ.jpeg'),
        ];

        return view('pages.area-region', compact('province', 'allCategories', 'seo'));
    }
}
