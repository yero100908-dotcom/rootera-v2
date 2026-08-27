@extends('layouts.app')

@section('content')
<div class="relative bg-gradient-to-b from-slate-900 via-blue-950 to-slate-900 text-white pt-12 pb-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex justify-center items-center gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <span class="text-slate-500">/</span>
            <a href="{{ route('tentang-kami') }}" class="hover:text-emerald-400 transition-colors">Tentang Kami</a>
            <span class="text-slate-500">/</span>
            <span class="text-emerald-400">Profil & Komitmen K3</span>
        </nav>
        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 mb-4">
                🏢 Profil Perusahaan & Keselamatan Kerja
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-6">
                Pionir Pelancar Pipa & Drainase <span class="text-emerald-400">Standard K3 Nasional</span>
            </h1>
            <p class="text-slate-300 text-base sm:text-lg leading-relaxed">
                Rootera Plumbing (di bawah naungan J&J Group) berkomitmen menyajikan solusi sanitasi modern tanpa bongkar dengan mengutamakan standar Keselamatan dan Kesehatan Kerja (K3) serta sertifikasi teknisi profesional.
            </p>
        </div>
    </div>
</div>

<section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <span class="text-emerald-600 font-bold text-sm tracking-wider uppercase">Visi & Misi Kami</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2 mb-4">Menjadi Standar Utama Jasa Plumbing & Drainase Tanpa Bongkar di Indonesia</h2>
                <p class="text-slate-600 mb-6 leading-relaxed">
                    Rootera lahir dari kebutuhan solusi praktis dan higienis atas permasalahan pipa tersumbat tanpa membongkar keramik, ubin, maupun struktur bangunan. Kami menggabungkan peralatan teknologi tinggi dari Amerika & Jerman dengan teknisi yang dibekali pelatihan K3 ketat.
                </p>
                <div class="space-y-4">
                    <div class="flex items-start gap-4 p-4 bg-white rounded-xl border border-slate-200 shadow-sm">
                        <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-xl shrink-0">1</div>
                        <div>
                            <h4 class="font-bold text-slate-900">Sertifikasi & SOP Keselamatan Kerja (K3)</h4>
                            <p class="text-sm text-slate-600 mt-1">Setiap teknisi dilengkapi APD lengkap (helmet, safety boots, sarung tangan heavy-duty, respirator) saat bertugas di area komersial & industri.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-4 bg-white rounded-xl border border-slate-200 shadow-sm">
                        <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xl shrink-0">2</div>
                        <div>
                            <h4 class="font-bold text-slate-900">Legalitas & Kelengkapan Administrasi B2B</h4>
                            <p class="text-sm text-slate-600 mt-1">Legalitas lengkap PT/CV resmi, SIUP, NIB, Faktur Pajak PPN, dan kesiapan pengadaan SPK/Tender untuk instansi & Korporasi.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <img src="{{ asset('images/dokumentasi/teknisi-rootera-plumbing-bekerja-lapangan.webp') }}" alt="Teknisi Rootera Plumbing K3" class="rounded-2xl shadow-2xl w-full object-cover">
            </div>
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="py-12 bg-emerald-600 text-white text-center">
    <div class="max-w-4xl mx-auto px-4">
        <h3 class="text-2xl font-bold mb-3">Butuh Konsultasi Penanganan Pipa untuk Perusahaan atau Rumah Anda?</h3>
        <p class="text-emerald-100 mb-6">Tim teknisi bersertifikat K3 kami siap memberikan inspeksi awal dan penawaran transparan.</p>
        <a href="https://wa.me/628111922253?text=Halo%20Rootera,%20saya%20ingin%20konsultasi%20profil%20dan%20layanan%20k3" target="_blank" class="inline-flex items-center gap-2 px-8 py-3.5 bg-white text-emerald-700 font-bold rounded-full shadow-lg hover:bg-slate-100 transition-all">
            💬 Konsultasi via WhatsApp (Fast Response)
        </a>
    </div>
</section>
@endsection
