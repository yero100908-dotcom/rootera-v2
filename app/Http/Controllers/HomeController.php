<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Models\ServiceArea;
use App\Models\Article;

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

        $seo = [
            'title'       => 'ROOTERA – Jasa Cleaning Service Pipa & Wastafel Mampet Profesional',
            'description' => 'ROOTERA solusi terpercaya untuk saluran pipa dan wastafel mampet. Layanan profesional, cepat, dan bergaransi. Melayani Jabodetabek, Cirebon, Semarang, Yogyakarta, Lampung.',
            'canonical'   => url('/'),
            'og_image'    => asset('images/og-home.jpg'),
        ];

        return view('pages.home', compact('serviceCategories', 'serviceAreas', 'latestArticles', 'seo'));
    }
}
