<?php

namespace App\Http\Controllers;

use App\Models\ServiceSector;

class AboutController extends Controller
{
    public function index()
    {
        $seo = [
            'title'       => 'Tentang Kami – ROOTERA | Tim Profesional Pipa & Sanitary',
            'description' => 'Kenali ROOTERA lebih dalam. Kami adalah tim profesional berpengalaman dalam layanan pembersihan pipa, saluran mampet, dan instalasi sanitary di Indonesia.',
            'canonical'   => url('/tentang-kami'),
            'og_image'    => asset('images/og-about.jpg'),
        ];

        $sectors = ServiceSector::where('is_active', true)->orderBy('sort_order', 'asc')->get();

        $advantages = [
            ['title' => 'Teknologi Tanpa Bongkar', 'description' => 'Menggunakan spiral cable modern dan Hydro-Jetting bertekanan tinggi untuk melancarkan saluran tumpat secara efektif tanpa proses pembongkaran lantai.', 'icon' => 'badge'],
            ['title' => 'Standar Higienitas Maksimal', 'description' => 'Teknisi profesional kami menjamin kebersihan area kerja. Bebas lumpur kotoran, bau, dan rapi setelah pengerjaan selesai.', 'icon' => 'clock'],
            ['title' => 'Aman & Ramah Lingkungan', 'description' => '100% bebas dari bahan kimia asam korosif. Sangat aman bagi integritas pipa jangka panjang, keluarga, serta kelestarian air tanah.', 'icon' => 'shield'],
        ];

        return view('pages.tentang-kami', compact('seo', 'sectors', 'advantages'));
    }
}
