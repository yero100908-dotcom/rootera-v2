<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Models\City;
use App\Models\District;
use App\Models\Faq;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ProgrammaticSeoController extends Controller
{
    /**
     * Display programmatic landing page for Service Category + City OR Service Category + City + District.
     */
    public function show(string $categorySlug, string $citySlug, ?string $districtSlug = null)
    {
        $category = ServiceCategory::where('slug', $categorySlug)
            ->where('is_active', true)
            ->firstOrFail();

        $city = City::where('slug', $citySlug)
            ->where('is_active', true)
            ->with(['province', 'districts' => function ($q) {
                $q->where('is_active', true)->orderBy('sort_order');
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
        })->take(12);

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

        // Project Showcase Portfolio
        $projectShowcases = \App\Models\ProjectGallery::where('is_active', true)
            ->where(function ($q) use ($city) {
                $q->where('city_id', $city->id)->orWhereNull('city_id');
            })
            ->with(['district', 'city'])
            ->take(6)
            ->get();

        $faqs = Faq::where('is_active', true)->orderBy('sort_order')->get();
        $technologies = Technology::where('is_active', true)->orderBy('sort_order')->get();

        $locationName = $district ? "{$district->name}, {$city->full_name}" : $city->full_name;
        $locationShort = $district ? $district->name : $city->name;
        $estimatedArrival = $district ? $district->estimated_arrival : $city->estimated_arrival;

        // Generate Dynamic Transactional SEO Metadata
        $title = $district
            ? "Jasa Pipa Mampet {$district->name}, {$city->name} - Cepat 24 Jam Bergaransi | Rootera"
            : "Jasa Saluran Pipa Mampet {$city->full_name} - Respon Cepat 30 Menit Bergaransi | Rootera";

        $description = $district
            ? "Tukang saluran air tersumbat & jasa {$category->name} di {$district->name}, {$city->name}. Respon cepat ({$estimatedArrival}), pengerjaan mekanis rotasi spiral tanpa bongkar pipa & bergaransi 30 hari. Hubungi WhatsApp 24 Jam!"
            : "Spesialis jasa {$category->name} terpercaya di {$city->full_name}. Pengerjaan cepat ({$estimatedArrival}), profesional tanpa bongkar paksa, dan bergaransi resmi PT/CV J&J Group. Hubungi WhatsApp 24 Jam!";

        $canonical = $district
            ? url("/layanan-pipa-mampet/{$category->slug}/{$city->slug}/{$district->slug}")
            : url("/layanan-pipa-mampet/{$category->slug}/{$city->slug}");

        $ogImage = $category->image ? asset('storage/' . $category->image) : asset('images/JnJ.jpeg');

        $seo = [
            'title'       => $title,
            'description' => $description,
            'canonical'   => $canonical,
            'og_image'    => $ogImage,
        ];

        return view('pages.programmatic-landing', compact(
            'category',
            'city',
            'district',
            'siblingDistricts',
            'siblingCities',
            'allCategories',
            'projectShowcases',
            'faqs',
            'technologies',
            'locationName',
            'locationShort',
            'estimatedArrival',
            'title',
            'description',
            'canonical',
            'ogImage',
            'seo'
        ));
    }
}
