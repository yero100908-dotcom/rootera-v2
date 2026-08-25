<?php

namespace App\Http\Controllers;

use App\Models\PropertyType;
use App\Models\City;
use App\Models\ServiceCategory;
use App\Models\ProjectGallery;
use App\Models\Article;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PropertyTypeController extends Controller
{
    /**
     * Master Hub Tipe Properti Public (/kategori-properti)
     */
    public function index()
    {
        $html = Cache::remember('property_index_v3', 86400, function () {
            $properties = PropertyType::where('is_active', true)
                ->orderBy('sort_order')
                ->get();

            $allCategories = ServiceCategory::where('is_active', true)->orderBy('sort_order')->get();
            $cities = City::where('is_active', true)->orderBy('sort_order')->take(16)->get();

            $seo = [
                'title'       => 'Jasa Pipa Mampet Berdasarkan Kategori Properti - Rootera',
                'description' => 'Solusi tepat pelancaran saluran air tersumbat untuk rumah tinggal, cafe, kos-kosan, ruko, kantor, & pergudangan. Pengerjaan 1-2 jam bebas bongkar & garansi 30 hari.',
                'canonical'   => url('/kategori-properti'),
                'og_image'    => asset('images/JnJ.jpeg'),
            ];

            return view('pages.property.index', compact('properties', 'allCategories', 'cities', 'seo'))->render();
        });

        return response($html);
    }

    /**
     * Detail Tipe Properti Reguler (/solusi-properti/{propertyType:slug})
     */
    public function show(string $slug)
    {
        $html = Cache::remember("property_show_v3_{$slug}", 86400, function () use ($slug) {
            $property = PropertyType::where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();

            $allProperties = PropertyType::where('is_active', true)
                ->where('id', '!=', $property->id)
                ->orderBy('sort_order')
                ->get();

            $cities = City::where('is_active', true)
                ->with('province')
                ->orderBy('sort_order')
                ->orderBy('name')
                ->take(16)
                ->get();

            $allCategories = ServiceCategory::where('is_active', true)->orderBy('sort_order')->get();

            $relatedArticles = Article::published()
                ->latest('published_at')
                ->take(3)
                ->get();

            $showcases = ProjectGallery::where('is_active', true)
                ->take(6)
                ->get();

            $faqs = Faq::where('is_active', true)->take(4)->get();

            $seo = [
                'title'       => $property->meta_title ?? "Jasa Pipa Mampet {$property->name} - Rootera",
                'description' => $property->meta_description ?? "Solusi cepat pelancaran saluran mampet untuk {$property->name}. Pengerjaan 1-2 jam tanpa bongkar keramik, garansi 30 hari.",
                'canonical'   => url("/solusi-properti/{$property->slug}"),
                'og_image'    => asset('images/JnJ.jpeg'),
            ];

            return view('pages.property.show', compact(
                'property',
                'allProperties',
                'cities',
                'allCategories',
                'relatedArticles',
                'showcases',
                'faqs',
                'seo'
            ))->render();
        });

        return response($html);
    }

    /**
     * Programmatic Tipe Properti x Kota (/solusi-properti/{propertyType:slug}/{city:slug})
     */
    public function showCity(string $slug, string $citySlug)
    {
        $html = Cache::remember("property_city_v3_{$slug}_{$citySlug}", 86400, function () use ($slug, $citySlug) {
            $property = PropertyType::where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();

            $city = City::where('slug', $citySlug)
                ->where('is_active', true)
                ->with(['province', 'districts'])
                ->firstOrFail();

            $siblingCities = City::where('province_id', $city->province_id)
                ->where('id', '!=', $city->id)
                ->where('is_active', true)
                ->take(8)
                ->get();

            $allProperties = PropertyType::where('is_active', true)
                ->where('id', '!=', $property->id)
                ->orderBy('sort_order')
                ->get();

            $allCategories = ServiceCategory::where('is_active', true)->orderBy('sort_order')->get();

            $showcases = ProjectGallery::where('is_active', true)
                ->where(function ($q) use ($city) {
                    $q->where('city_id', $city->id)->orWhereNull('city_id');
                })
                ->take(6)
                ->get();

            $relatedArticles = Article::published()
                ->latest('published_at')
                ->take(3)
                ->get();

            $faqs = Faq::where('is_active', true)->take(4)->get();

            $seo = [
                'title'       => "Jasa Pelancaran Saluran Mampet {$property->name} di {$city->full_name} - Rootera",
                'description' => "Tukang pelancar saluran tersumbat terdekat untuk {$property->name} di {$city->full_name}. Respon cepat ({$city->estimated_arrival}), tanpa bongkar ubin, & garansi resmi 30 hari.",
                'canonical'   => url("/solusi-properti/{$property->slug}/{$city->slug}"),
                'og_image'    => asset('images/JnJ.jpeg'),
            ];

            return view('pages.property.show', compact(
                'property',
                'city',
                'siblingCities',
                'allProperties',
                'allCategories',
                'showcases',
                'relatedArticles',
                'faqs',
                'seo'
            ))->render();
        });

        return response($html);
    }
}
