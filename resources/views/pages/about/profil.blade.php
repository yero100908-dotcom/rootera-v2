@extends('layouts.app')

@section('schema-markup')
<?php
$schemaData = [
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => $seo['title'] ?? 'Profil Perusahaan & Standar K3 - Rootera Plumbing',
    'description' => $seo['description'] ?? '',
    'breadcrumb' => [
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Tentang Kami', 'item' => url('/tentang-kami')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => 'Profil & K3', 'item' => url('/tentang-kami/profil')]
        ]
    ]
];
?>
<script type="application/ld+json">
{!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
<div class="relative bg-gradient-to-b from-slate-900 via-[#0B2545] to-slate-900 text-white pt-24 pb-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex justify-center items-center gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <span class="text-slate-500">/</span>
            <a href="{{ route('tentang-kami') }}" class="hover:text-emerald-400 transition-colors">Tentang Kami</a>
            <span class="text-slate-500">/</span>
            <span class="text-emerald-400 font-semibold">Profil &amp; Standar K3</span>
        </nav>

        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 mb-4">
                🏢 Profil Perusahaan &amp; Safety K3
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-6 font-['Plus_Jakarta_Sans',sans-serif]">
                Profil Resmi &amp; Komitmen <span class="text-emerald-400">Keselamatan K3 Rootera</span>
            </h1>
            <p class="text-slate-300 text-base sm:text-lg leading-relaxed">
                Rootera Plumbing (di bawah naungan J&amp;J Group) beroperasi secara sah dengan legalitas lengkap, menerapkan standar Keselamatan &amp; Kesehatan Kerja (K3) industri, serta menjamin sterilitas area pengerjaan.
            </p>
        </div>
    </div>
</div>

{{-- Main Profile Content --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Grid Legalitas & Profile --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-16">
            <div>
                <span class="text-emerald-600 font-bold text-xs tracking-wider uppercase">Standar Keamanan &amp; Legalitas</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2 mb-4 font-['Plus_Jakarta_Sans',sans-serif]">
                    Mitra Terpercaya Properti Residensial &amp; Sektor Komersial B2B
                </h2>
                <p class="text-slate-600 mb-6 leading-relaxed text-sm sm:text-base">
                    Sejak berdiri, Rootera berkomitmen menggantikan metode perbaikan pipa konvensional yang merusak menjadi metode mekanis tanpa bongkar. Kami memiliki legalitas usaha yang sah untuk melayani pengadaan B2B, penawaran harga resmi (SPK/Faktur PPN), dan integrasi SLA gedung.
                </p>

                <div class="space-y-4">
                    <div class="flex items-start gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-200/80 shadow-xs">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-lg shrink-0">📋</div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm sm:text-base">Legalitas Usaha Complete (NIB &amp; PPN)</h4>
                            <p class="text-xs sm:text-sm text-slate-600 mt-1">Terdaftar resmi dengan dokumen badan usaha, SiUP, NPWP, NIB, dan kesiapan penerbitan faktur pajak PPN untuk kebutuhan korporasi.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-200/80 shadow-xs">
                        <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-lg shrink-0">🦺</div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm sm:text-base">Protokol Kesehatan &amp; APD K3 Lapangan</h4>
                            <p class="text-xs sm:text-sm text-slate-600 mt-1">Setiap teknisi wajib mengenakan helm proyek K3, sepatu boot safety, sarung tangan anti-slip heavy duty, dan masker pernapasan di area kerja.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-200/80 shadow-xs">
                        <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center font-bold text-lg shrink-0">✨</div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm sm:text-base">SOP Sterilisasi &amp; Pembersihan Kerja</h4>
                            <p class="text-xs sm:text-sm text-slate-600 mt-1">Seluruh peralatan dibersihkan dan disterilkan secara berkala. Area pengerjaan dibersihkan total pasca pelancaran agar kembali rapi &amp; harum.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="rounded-3xl overflow-hidden shadow-2xl border-4 border-slate-100">
                    <img src="{{ asset('images/dokumentasi/teknisi-rootera-plumbing-bekerja-lapangan.webp') }}" 
                         alt="Teknisi Rootera Plumbing Bekerja dengan APD K3" 
                         class="w-full h-[480px] object-cover">
                </div>
                <div class="absolute -bottom-6 -left-6 bg-slate-900 text-white p-5 rounded-2xl shadow-xl max-w-xs border border-slate-700">
                    <div class="text-emerald-400 font-bold text-xs uppercase">Komitmen Keselamatan</div>
                    <div class="text-sm font-semibold mt-1">"Zero Accident &amp; 100% Kebersihan Properti Terjaga"</div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- CTA Section --}}
<section class="py-12 bg-emerald-600 text-white text-center">
    <div class="max-w-4xl mx-auto px-4">
        <h3 class="text-2xl font-bold mb-3 font-['Plus_Jakarta_Sans',sans-serif]">Butuh Penawaran Resmi / SPK Layanan K3 untuk Perusahaan Anda?</h3>
        <p class="text-emerald-100 mb-6 text-sm sm:text-base">Tim tim admin &amp; dispatch B2B kami siap menerbitkan surat penawaran harga &amp; faktur PPN resmi.</p>
        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya ingin konsultasi penawaran resmi B2B dan profil K3') }}" 
           target="_blank" rel="noopener" 
           class="inline-flex items-center gap-2 px-8 py-3.5 bg-white text-emerald-800 font-bold rounded-xl shadow-lg hover:bg-slate-100 transition-all text-sm">
            <span>💬 Hubungi Customer Care B2B (WA 24 Jam)</span>
        </a>
    </div>
</section>
@endsection
