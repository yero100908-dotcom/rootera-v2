<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\ServiceCategory;
use App\Models\Contact;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

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

    /**
     * AJAX Endpoint: Capture Lead Data from Interactive Diagnostic Tool
     */
    public function captureLead(Request $request)
    {
        $validated = $request->validate([
            'city_name'       => 'nullable|string|max:100',
            'pipe_location'   => 'nullable|string|max:100',
            'flow_symptom'    => 'nullable|string|max:100',
            'duration'        => 'nullable|string|max:60',
            'severity_score'  => 'nullable|integer',
            'severity_label'  => 'nullable|string|max:50',
            'phone'           => 'nullable|string|max:30',
        ]);

        try {
            $cityName = $validated['city_name'] ?? 'Umum';
            $pipeLocation = $validated['pipe_location'] ?? 'Diagnosa Saluran';
            $flowSymptom = $validated['flow_symptom'] ?? '-';
            $duration = $validated['duration'] ?? '-';
            $severityLabel = $validated['severity_label'] ?? '-';
            $severityScore = $validated['severity_score'] ?? 0;

            $messageSummary = sprintf(
                "[LEAD DIAGNOSA ONLINE] Area: %s | Jalur: %s | Gejala: %s | Durasi: %s | Keparahan: %s (Skor: %d)",
                $cityName,
                $pipeLocation,
                $flowSymptom,
                $duration,
                $severityLabel,
                $severityScore
            );

            $contact = Contact::create([
                'name'         => 'Lead Diagnosa Online (' . $cityName . ')',
                'phone'        => $validated['phone'] ?? 'Belum terisi (Menunggu WA)',
                'area'         => $cityName,
                'service_type' => $pipeLocation,
                'message'      => $messageSummary,
                'status'       => 'new',
                'source'       => 'diagnostic_online',
            ]);

            return response()->json([
                'success' => true,
                'lead_id' => $contact->id,
                'message' => 'Data diagnosa berhasil disimpan.',
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan Diagnostic Lead: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem, namun diagnosa tetap dapat diteruskan ke WhatsApp.',
            ], 500);
        }
    }
}
