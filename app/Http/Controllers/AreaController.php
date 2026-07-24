<?php

namespace App\Http\Controllers;

use App\Models\ServiceArea;

class AreaController extends Controller
{
    public function index()
    {
        $areas = ServiceArea::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $seo = [
            'title'       => 'Area Layanan Rooterin – Jabodetabek, Cirebon, Semarang, Yogyakarta, Lampung',
            'description' => 'Rooterin melayani berbagai kota di Indonesia. Temukan area layanan terdekat Anda dan hubungi tim kami untuk konsultasi gratis.',
            'canonical'   => url('/area-layanan'),
            'og_image'    => asset('images/og-area.jpg'),
        ];

        return view('pages.area-layanan', compact('areas', 'seo'));
    }

    public function show(string $slug)
    {
        $area = ServiceArea::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $seo = [
            'title'       => substr($area->meta_title ?? "Jasa Pipa Mampet {$area->name} Tanpa Bongkar - Rooterin", 0, 60),
            'description' => substr($area->meta_description ?? "Jasa pelancar saluran pipa mampet, kran air, cuci toren, dan instalasi sanitary di {$area->name} dan sekitarnya. Profesional, cepat, bergaransi.", 0, 150),
            'canonical'   => url('/area-layanan/' . $area->slug),
            'og_image'    => $area->image ? asset('storage/' . $area->image) : asset('images/og-area.jpg'),
        ];

        return view('pages.area-detail', compact('area', 'seo'));
    }
}
