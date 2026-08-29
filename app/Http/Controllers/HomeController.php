<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Models\ServiceArea;
use App\Models\Article;
use App\Models\Faq;
use App\Models\Technology;
use App\Models\ServiceSector;
use App\Models\Partner;
use App\Models\GalleryPhoto;
use App\Models\Gallery;
use App\Models\City;

class HomeController extends Controller
{
    public function index()
    {
        $serviceCategories = ServiceCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $serviceAreas = ServiceArea::where('is_active', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $cities = City::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $latestArticles = Article::published()
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $faqs = Faq::where('is_active', true)
            ->where('is_featured_home', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        if ($faqs->isEmpty()) {
            $faqs = Faq::where('is_active', true)->orderBy('sort_order')->take(4)->get();
        }

        $technologies = Technology::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $serviceSectors = ServiceSector::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $partners = Partner::all();

        $hybridGalleries = Gallery::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $galleryPhotos = GalleryPhoto::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        $seo = [
            'title'       => 'Rootera Plumbing – Jasa Pelancar Pipa Mampet & Hydro-Jetting No. 1 Indonesia',
            'description' => 'Jasa pelancaran saluran pipa mampet, wastafel, toilet, dan drainase bergaransi 30 hari tanpa bongkar. Melayani juga cuci toren & kuras tandon air higienis di Jabodetabek, Jabar, Jateng, DIY, Jatim, & Lampung.',
            'canonical'   => url('/'),
            'og_image'    => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
        ];

        return view('pages.home', compact(
            'serviceCategories',
            'serviceAreas',
            'cities',
            'latestArticles',
            'faqs',
            'technologies',
            'serviceSectors',
            'partners',
            'hybridGalleries',
            'galleryPhotos',
            'seo'
        ));
    }
}
