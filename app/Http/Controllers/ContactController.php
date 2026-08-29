<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $seo = [
            'title'       => 'Hubungi Rootera Plumbing | Layanan Pelancar Pipa Mampet 24 Jam & Emergency Call',
            'description' => 'Pusat bantuan Rootera Plumbing: Layanan darurat pelancaran pipa mampet 24 jam nonstop. Hubungi via WhatsApp atau form resmi untuk respon teknisi tercepat.',
            'canonical'   => url('/kontak'),
            'og_image'    => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
        ];

        $serviceCategories = \App\Models\ServiceCategory::where('is_active', true)->orderBy('sort_order')->get();
        $cities = \App\Models\City::where('is_active', true)->orderBy('name')->get();

        return view('pages.kontak', compact('seo', 'serviceCategories', 'cities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:100',
            'email'        => 'nullable|email|max:150',
            'phone'        => 'required|string|max:20',
            'service_type' => 'nullable|string|max:100',
            'area'         => 'nullable|string|max:100',
            'message'      => 'required|string|max:1000',
        ], [
            'name.required'    => 'Nama wajib diisi.',
            'phone.required'   => 'Nomor telepon wajib diisi.',
            'message.required' => 'Pesan wajib diisi.',
        ]);

        Contact::create($validated);

        return redirect()->back()->with('success', 'Terima kasih! Pesan Anda telah kami terima. Tim Rootera akan segera menghubungi Anda.');
    }
}
