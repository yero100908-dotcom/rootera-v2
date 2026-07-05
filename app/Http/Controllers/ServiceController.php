<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Models\Service;

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

        $tools = [
            [
                'name'        => 'Hidrojet / Water Jetting',
                'icon'        => 'jet',
                'description' => 'Semprotan air bertekanan tinggi yang mampu menghancurkan dan membersihkan sumbatan berat seperti lemak, kerak mineral, dan akar pohon tanpa merusak pipa.',
                'benefit'     => 'Tekanan hingga 4000 PSI',
            ],
            [
                'name'        => 'Electric Drain Snake',
                'icon'        => 'snake',
                'description' => 'Alat mekanis bermotor yang mampu menerobos sumbatan padat di dalam pipa dengan rotasi presisi tinggi untuk membersihkan secara menyeluruh.',
                'benefit'     => 'Jangkauan hingga 30 meter',
            ],
            [
                'name'        => 'CCTV Camera Pipe Inspection',
                'icon'        => 'camera',
                'description' => 'Kamera miniatur yang dimasukkan ke dalam pipa untuk mendiagnosis secara akurat lokasi dan jenis kerusakan sebelum dilakukan tindakan.',
                'benefit'     => 'Diagnosa 100% akurat',
            ],
            [
                'name'        => 'Vacuum Pump Industrial',
                'icon'        => 'vacuum',
                'description' => 'Pompa vakum berkapasitas tinggi untuk menyedot dan membersihkan kotoran padat maupun cairan dari sistem saluran pembuangan secara efisien.',
                'benefit'     => 'Kapasitas 500 liter/menit',
            ],
        ];

        return view('pages.layanan', compact('serviceCategories', 'tools', 'seo'));
    }
}
