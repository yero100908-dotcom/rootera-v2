<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Models\Service;
use App\Models\Technology;
use App\Models\Faq;

class ServiceController extends Controller
{
    public function index()
    {
        $serviceCategories = ServiceCategory::with('services')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $seo = [
            'title'       => 'Layanan ROOTERA – Solusi Pipa Mampet & Instalasi Sanitary Profesional',
            'description' => 'Temukan semua layanan ROOTERA: pembersihan saluran mampet, cuci toren, dan instalasi pipa profesional menggunakan alat modern tanpa bongkar bangunan.',
            'canonical'   => url('/layanan'),
            'og_image'    => asset('images/og-layanan.jpg'),
        ];

        // Ambil teknologi dari database (dinamis)
        $tools = Technology::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Ambil FAQ dari database
        $faqs = Faq::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('pages.layanan', compact('serviceCategories', 'tools', 'faqs', 'seo'));
    }
}
