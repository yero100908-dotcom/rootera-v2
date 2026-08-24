<?php

namespace App\Http\Controllers;

use App\Models\ServiceSector;
use App\Models\City;
use App\Models\ServiceCategory;
use App\Models\ProjectGallery;
use App\Models\Article;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CommercialSectorController extends Controller
{
    /**
     * Master Hub B2B Commercial Sectors (/layanan-b2b-komersial)
     */
    public function index()
    {
        $sectors = ServiceSector::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $allCategories = ServiceCategory::where('is_active', true)->orderBy('sort_order')->get();

        $showcases = ProjectGallery::where('is_active', true)
            ->where('client_type', 'Komersial B2B')
            ->orWhereNull('client_type')
            ->take(6)
            ->get();

        $seo = [
            'title'       => 'Layanan B2B & Kontrak Maintenance Pipa Komersial - Rootera (J&J Group)',
            'description' => 'Spesialis pemeliharaan pipa komersial, grease trap restoran, riser apartemen, limbah industri pabrik, & instansi bergaransi resmi PT/CV J&J Group dengan SLA 24 jam.',
            'canonical'   => url('/layanan-b2b-komersial'),
            'og_image'    => asset('images/JnJ.jpeg'),
        ];

        return view('pages.b2b.index', compact('sectors', 'allCategories', 'showcases', 'seo'));
    }

    /**
     * Specific B2B Sector Landing Page (/sektor-plumbing/{sectorSlug})
     */
    public function showSector(string $sectorSlug)
    {
        $sector = ServiceSector::where('slug', $sectorSlug)
            ->where('is_active', true)
            ->firstOrFail();

        $allSectors = ServiceSector::where('is_active', true)
            ->where('id', '!=', $sector->id)
            ->orderBy('sort_order')
            ->get();

        $allCities = City::where('is_active', true)
            ->with('province')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->take(16)
            ->get();

        $allCategories = ServiceCategory::where('is_active', true)->orderBy('sort_order')->get();

        $showcases = ProjectGallery::where('is_active', true)
            ->take(6)
            ->get();

        $faqs = Faq::where('is_active', true)->take(4)->get();

        $seo = [
            'title'       => "Jasa Plumbing {$sector->sector_name} - Kontrak B2B & Hydro-Jetting | Rootera",
            'description' => "Solusi profesional perbaikan & maintenance pipa {$sector->sector_name}. SLA respon cepat, hydro-jetting high pressure, tanpa bongkar & bergaransi resmi J&J Group.",
            'canonical'   => url("/sektor-plumbing/{$sector->slug}"),
            'og_image'    => $sector->image_url,
        ];

        return view('pages.b2b.sector-detail', compact(
            'sector',
            'allSectors',
            'allCities',
            'allCategories',
            'showcases',
            'faqs',
            'seo'
        ));
    }

    /**
     * Programmatic B2B Sector x City Landing Page (/sektor-plumbing/{sectorSlug}/{citySlug})
     */
    public function showSectorCity(string $sectorSlug, string $citySlug)
    {
        $sector = ServiceSector::where('slug', $sectorSlug)
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

        $allCategories = ServiceCategory::where('is_active', true)->orderBy('sort_order')->get();

        $showcases = ProjectGallery::where('is_active', true)
            ->where(function ($q) use ($city) {
                $q->where('city_id', $city->id)->orWhereNull('city_id');
            })
            ->take(6)
            ->get();

        $faqs = Faq::where('is_active', true)->take(4)->get();

        $seo = [
            'title'       => "Jasa Plumbing {$sector->sector_name} di {$city->full_name} - Rootera B2B",
            'description' => "Spesialis pelancaran pipa tersumbat & kontrak maintenance {$sector->sector_name} di {$city->full_name}. Layanan darurat 24 Jam, Faktur Pajak PPN & garansi resmi.",
            'canonical'   => url("/sektor-plumbing/{$sector->slug}/{$city->slug}"),
            'og_image'    => $sector->image_url,
        ];

        return view('pages.b2b.sector-detail', compact(
            'sector',
            'city',
            'siblingCities',
            'allCategories',
            'showcases',
            'faqs',
            'seo'
        ));
    }

    /**
     * B2B Maintenance Contract & SLA Request Form (/kontrak-maintenance-saluran/{sectorSlug})
     */
    public function maintenanceContract(string $sectorSlug)
    {
        $sector = ServiceSector::where('slug', $sectorSlug)
            ->where('is_active', true)
            ->firstOrFail();

        $allSectors = ServiceSector::where('is_active', true)->orderBy('sort_order')->get();

        $seo = [
            'title'       => "Kontrak Preventive Maintenance Plumbing {$sector->sector_name} - Rootera",
            'description' => "Penawaran kontrak maintenance berkala (bulanan/tahunan) sistem pipa & drainase {$sector->sector_name}. Diskon paket B2B corporate & jaminan SLA 24 Jam.",
            'canonical'   => url("/kontrak-maintenance-saluran/{$sector->slug}"),
            'og_image'    => $sector->image_url,
        ];

        return view('pages.b2b.contract', compact('sector', 'allSectors', 'seo'));
    }
}
