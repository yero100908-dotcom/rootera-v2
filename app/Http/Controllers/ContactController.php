<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $seo = [
            'title'       => 'Kontak Rooterin – Hubungi Kami untuk Layanan Pipa Profesional',
            'description' => 'Hubungi Rooterin untuk konsultasi gratis dan pemesanan layanan pipa & saluran mampet. Tersedia via WhatsApp, email, dan formulir online.',
            'canonical'   => url('/kontak'),
            'og_image'    => asset('images/og-kontak.jpg'),
        ];

        return view('pages.kontak', compact('seo'));
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

        return redirect()->back()->with('success', 'Terima kasih! Pesan Anda telah kami terima. Tim Rooterin akan segera menghubungi Anda.');
    }
}
