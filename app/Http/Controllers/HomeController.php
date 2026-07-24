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

        $latestArticles = Article::published()
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $faqs = Faq::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $technologies = Technology::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $serviceSectors = ServiceSector::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $partners = Partner::all();

        $galleryPhotos = GalleryPhoto::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        $seo = [
            'title'       => 'Rooterin – Jasa Cleaning Service Pipa & Wastafel Mampet Profesional',
            'description' => 'Rooterin solusi terpercaya untuk saluran pipa dan wastafel mampet. Layanan profesional, cepat, dan bergaransi. Melayani Jabodetabek, Cirebon, Semarang, Yogyakarta, Lampung.',
            'canonical'   => url('/'),
            'og_image'    => asset('images/og-home.jpg'),
        ];

        return view('pages.home', compact(
            'serviceCategories',
            'serviceAreas',
            'latestArticles',
            'faqs',
            'technologies',
            'serviceSectors',
            'partners',
            'galleryPhotos',
            'seo'
        ));
    }
}
