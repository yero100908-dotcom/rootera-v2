<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $seo = [
            'title'       => 'Hubungi Rootera Plumbing | Pelancar Pipa Mampet 24 Jam',
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
        // 1. Honeypot check (bot trap)
        if ($request->filled('website_url_hp')) {
            return redirect()->back()->with('success', 'Pesan Anda telah kami terima.');
        }

        // 2. Strict Input Validation & Format Regex
        $validated = $request->validate([
            'name'         => 'required|string|max:100',
            'email'        => 'nullable|email:rfc,dns|max:150',
            'phone'        => ['required', 'string', 'max:20', 'regex:/^(\+62|62|0)8[1-9][0-9]{6,11}$/'],
            'service_type' => 'nullable|string|max:100',
            'area'         => 'nullable|string|max:100',
            'message'      => 'required|string|max:1000',
        ], [
            'name.required'    => 'Nama wajib diisi.',
            'phone.required'   => 'Nomor telepon WhatsApp wajib diisi.',
            'phone.regex'      => 'Format nomor WhatsApp tidak valid (Contoh: 08123456789).',
            'message.required' => 'Pesan wajib diisi.',
        ]);

        // 3. Stored XSS Prevention: Strip all HTML tags
        $sanitized = [
            'name'         => strip_tags(trim($validated['name'])),
            'email'        => !empty($validated['email']) ? filter_var(trim($validated['email']), FILTER_SANITIZE_EMAIL) : null,
            'phone'        => preg_replace('/[^0-9]/', '', $validated['phone']),
            'service_type' => strip_tags(trim($validated['service_type'] ?? 'Umum')),
            'area'         => strip_tags(trim($validated['area'] ?? 'Jabodetabek')),
            'message'      => strip_tags(trim($validated['message'])),
            'status'       => 'new',
            'source'       => 'kontak_resmi_web',
        ];

        Contact::create($sanitized);

        return redirect()->back()->with('success', 'Terima kasih! Pesan Anda telah kami terima. Tim Rootera akan segera menghubungi Anda.');
    }
}
