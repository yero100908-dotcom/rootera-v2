<?php

namespace App\Http\Controllers;

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

        $teamZones = [
            ['name' => 'Hunian Rumah',   'icon' => 'home',     'description' => 'Layanan untuk seluruh kebutuhan saluran dan pipa di rumah tinggal pribadi Anda.'],
            ['name' => 'Apartemen',      'icon' => 'building', 'description' => 'Penanganan cepat dan efisien untuk unit apartemen dan gedung bertingkat.'],
            ['name' => 'Ruko Bisnis',    'icon' => 'store',    'description' => 'Solusi tepat untuk ruko dan bangunan komersial tanpa mengganggu aktivitas bisnis.'],
            ['name' => 'Gedung Kantor',  'icon' => 'office',   'description' => 'Pemeliharaan sistem pipa untuk gedung perkantoran skala kecil hingga besar.'],
            ['name' => 'Area Industri',  'icon' => 'factory',  'description' => 'Penanganan saluran industri dengan kapasitas tinggi dan peralatan berat khusus.'],
            ['name' => 'Resto & Cafe',   'icon' => 'cafe',     'description' => 'Pembersihan saluran lemak dapur restoran dan cafe secara menyeluruh dan higienis.'],
        ];

        $advantages = [
            ['title' => 'Profesional & Berpengalaman', 'description' => 'Tim teknisi kami terlatih dan bersertifikat, dengan pengalaman menangani ribuan kasus saluran mampet di berbagai jenis bangunan.', 'icon' => 'badge'],
            ['title' => 'Respon Cepat 24 Jam',         'description' => 'Kami siap melayani panggilan darurat kapan saja. Tim kami berkomitmen tiba di lokasi dalam waktu yang telah disepakati.',             'icon' => 'clock'],
            ['title' => 'Bergaransi & Terpercaya',     'description' => 'Setiap pekerjaan yang kami selesaikan dilengkapi dengan garansi layanan, memastikan kepuasan dan ketenangan pikiran Anda.',           'icon' => 'shield'],
        ];

        return view('pages.tentang-kami', compact('seo', 'teamZones', 'advantages'));
    }
}
