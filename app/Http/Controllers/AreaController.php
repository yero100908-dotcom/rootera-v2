<?php

namespace App\Http\Controllers;

use App\Models\ServiceArea;
use Illuminate\Support\Str;

class AreaController extends Controller
{
    public function index()
    {
        $areas = ServiceArea::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $seo = [
            'title'       => 'Area Layanan Rootera – Jabodetabek, Cirebon, Semarang, Yogyakarta, Lampung',
            'description' => 'Rootera melayani berbagai kota di Indonesia. Temukan area layanan terdekat Anda dan hubungi tim kami untuk konsultasi gratis.',
            'canonical'   => url('/area-layanan'),
            'og_image'    => asset('images/JnJ.jpeg'),
        ];

        return view('pages.area-layanan', compact('areas', 'seo'));
    }

    public function show(string $slug)
    {
        $area = ServiceArea::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $seo = [
            'title'       => Str::limit($area->meta_title ?? "Jasa Pipa Mampet {$area->name} Tanpa Bongkar - Rootera", 60, ''),
            'description' => Str::limit($area->meta_description ?? "Jasa pelancar saluran pipa mampet, kran air, cuci toren, dan instalasi sanitary di {$area->name} dan sekitarnya. Profesional, cepat, bergaransi.", 150, ''),
            'canonical'   => url('/area-layanan/' . $area->slug),
            'og_image'    => $area->image ? asset('storage/' . $area->image) : asset('images/JnJ.jpeg'),
        ];

        return view('pages.area-detail', compact('area', 'seo'));
    }
}
