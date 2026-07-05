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
            'title'       => 'Area Layanan ROOTERA – Jabodetabek, Cirebon, Semarang, Yogyakarta, Lampung',
            'description' => 'ROOTERA melayani berbagai kota di Indonesia. Temukan area layanan terdekat Anda dan hubungi tim kami untuk konsultasi gratis.',
            'canonical'   => url('/area-layanan'),
            'og_image'    => asset('images/og-area.jpg'),
        ];

        return view('pages.area-layanan', compact('areas', 'seo'));
    }
}
