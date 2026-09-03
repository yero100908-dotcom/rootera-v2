<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Cache;

class DiagnosticController extends Controller
{
    /**
     * Display the Interactive Pipe Problem Diagnostic Tool page.
     */
    public function index()
    {
        $canonical = url('/cek-kondisi-pipa');

        $seo = [
            'title'       => 'Cek Kondisi Pipa Mampet Online (Gratis & Cepat) | Rootera',
            'description' => 'Diagnosa penyebab wastafel, WC, & got mampet dalam 30 detik. Dapatkan estimasi tingkat keparahan & rekomendasi solusi tanpa bongkar. Cek gratis!',
            'canonical'   => $canonical,
            'og_image'    => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
        ];

        $faqs = [
            [
                'category' => 'wastafel',
                'question' => 'Mengapa wastafel dapur sering mampet dan mengeluarkan suara gluk-gluk?',
                'answer' => 'Suara gluk-gluk (gurgling) terjadi karena adanya penyempitan rongga pipa akibat penumpukan kerak lemak. Udara terperangkap di dalam pipa saat air berusaha mengalir melewati celah yang sempit.'
            ],
            [
                'category' => 'kloset',
                'question' => 'Mengapa air kloset toilet meluap saat disiram dan bagaimana solusinya?',
                'answer' => 'Kloset meluap dipicu oleh gumpalan tisu/pembalut di leher angsa toilet atau pipa saluran udara (vent pipe) tersumbat. Rootera menggunakan mesin spiral rotary berujung fleksibel untuk menarik gumpalan tanpa melepas mangkuk kloset.'
            ],
            [
                'category' => 'greasetrap',
                'question' => 'Berapa sering Grease Trap Restoran / Kafe harus dibersihkan secara berkala?',
                'answer' => 'Grease trap restoran idealnya dibersihkan setiap 1–2 minggu. Penumpukan lemak jenuh melampaui sekat akan memicu bau busuk menyengat dan risiko sanksi inspeksi kebersihan lingkungan.'
            ],
            [
                'category' => 'talang',
                'question' => 'Mengapa pipa talang air hujan rooftop sering meluap saat hujan deras?',
                'answer' => 'Pipa talang hujan tersumbat oleh akumulasi daun kering, lumut atap, dan pasir halus. Pembersihan tekanan tinggi Hydro-Jetting merontokkan semua endapan hingga alirannya kembali deras.'
            ],
            [
                'category' => 'general',
                'question' => 'Mengapa dilarang keras menggunakan Soda Api untuk melancarkan pipa mampet?',
                'answer' => 'Soda api bereaksi eksotermis (menghasilkan panas tinggi hingga >90°C) yang dapat melunakkan dan membengkokkan pipa PVC. Reaksi kimia antara soda api dan lemak minyak dapur juga mengeras menjadi batuan padat seperti semen.'
            ],
            [
                'category' => 'general',
                'question' => 'Bagaimana cara Rootera melancarkan pipa mampet tanpa bongkar keramik?',
                'answer' => 'Rootera menggunakan mesin mekanis Ridgid Drain Cleaner berkabel spiral fleksibel dan hydro jetting tekanan tinggi yang memotong serta merontokkan kerak lemak tanpa merusak struktur lantai rumah Anda.'
            ]
        ];

        $categories = Cache::remember('active_service_categories', 86400, function () {
            return ServiceCategory::where('is_active', true)->orderBy('sort_order')->get();
        });

        return view('pages.diagnostic', compact('seo', 'faqs', 'categories', 'canonical'));
    }
}
