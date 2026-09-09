@extends('layouts.app')

@section('meta_title', 'Kontrak Perawatan Saluran Pipa Restoran & Gedung | Rootera B2B')
@section('meta_description', 'Program preventive maintenance plumbing berkala untuk restoran, mall, hotel, dan kawasan industri di Jabodetabek & sekitarnya. Bebas mampet darurat.')
@section('meta_keywords', 'kontrak perawatan plumbing, preventive maintenance grease trap, jasa saluran mampet restoran b2b, pembersihan pipa gedung bertingkat')
@section('canonical', url('/layanan-b2b/licensing'))

@section('schema-markup')
<?php
$schemaData = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Layanan B2B', 'item' => url('/layanan-b2b-komersial')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'B2B Licensing & Maintenance', 'item' => url('/layanan-b2b/licensing')]
            ]
        ],
        [
            '@type' => 'Service',
            '@id' => url('/layanan-b2b/licensing') . '#service',
            'name' => 'Kontrak Perawatan Saluran Pipa Restoran & Gedung',
            'serviceType' => 'B2B Preventive Plumbing Maintenance & Licensing',
            'description' => 'Program preventive maintenance plumbing berkala untuk restoran, mall, hotel, dan kawasan industri di Jabodetabek & sekitarnya.',
            'provider' => [
                '@type' => 'Organization',
                'name' => 'Rootera Plumbing (J&J Group)',
                'url' => url('/')
            ],
            'areaServed' => [
                'Jabodetabek',
                'Semarang',
                'Bandar Lampung'
            ]
        ]
    ]
];
?>
<script type="application/ld+json">
{!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
{{-- Hero Header --}}
<div class="relative bg-gradient-to-b from-slate-900 via-[#0B2545] to-slate-900 text-white pt-24 pb-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex justify-center items-center gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <span class="text-slate-500">/</span>
            <a href="{{ route('b2b.index') }}" class="hover:text-emerald-400 transition-colors">Layanan B2B</a>
            <span class="text-slate-500">/</span>
            <span class="text-emerald-400 font-semibold">Licensing &amp; Kontrak Maintenance</span>
        </nav>

        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 mb-4">
                📜 Corporate Licensing &amp; Contract Package
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-6 font-['Plus_Jakarta_Sans',sans-serif]">
                Licensing &amp; Kontrak <span class="text-emerald-400">Preventive Maintenance B2B</span>
            </h1>
            <p class="text-slate-300 text-base sm:text-lg leading-relaxed">
                Paket pemeliharaan berkala sistem saluran pipa, grease trap, &amp; riser vertikal untuk Mall, Gedung Bertingkat, Hotel, Restoran, &amp; Pabrik Industri dengan jaminan SLA 24 jam.
            </p>
        </div>
    </div>
</div>

<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Section 1: Package Tiers --}}
        <div class="mb-16">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-emerald-600 font-bold text-xs tracking-wider uppercase">Skema Perawatan Berkala</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1 font-['Plus_Jakarta_Sans',sans-serif]">
                    Paket Kontrak Maintenance Komersial Rootera
                </h2>
                <p class="text-slate-600 text-xs sm:text-sm mt-2">Pilih skema perawatan berkala yang dirancang sesuai skala operasional properti bisnis Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                {{-- Plan 1: Monthly Commercial --}}
                <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-lg hover:border-emerald-500/50 transition-all flex flex-col justify-between">
                    <div>
                        <span class="text-xs font-extrabold uppercase tracking-wider px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full">
                            Restoran &amp; Cafe
                        </span>
                        <h3 class="font-extrabold text-slate-900 text-xl mt-4 mb-2 font-['Plus_Jakarta_Sans',sans-serif]">Bulanan (Monthly Care)</h3>
                        <p class="text-xs text-slate-500 mb-6">Cocok untuk jaringan restoran, cloud kitchen, &amp; cafe F&amp;B yang membutuhkan pembersihan lemak intensif.</p>

                        <ul class="space-y-3 text-xs sm:text-sm text-slate-600 mb-8">
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">✓</span> <span>Pembersihan Grease Trap 1x / Bulan</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">✓</span> <span>Flushing Kitchen Sink Rotary Spiral</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">✓</span> <span>Priority Call Out Respon &lt; 2 Jam</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">✓</span> <span>Penerbitan e-Faktur PPN 11%</span>
                            </li>
                        </ul>
                    </div>

                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya tertarik konsultasi Paket Maintenance Bulanan Restoran') }}" 
                       target="_blank" rel="noopener" 
                       class="w-full py-3 bg-slate-900 hover:bg-emerald-600 text-white font-bold rounded-xl text-center text-xs sm:text-sm transition-colors block">
                        Minta Penawaran Bulanan &rarr;
                    </a>
                </div>

                {{-- Plan 2: Quarterly Building (Popular) --}}
                <div class="bg-gradient-to-b from-slate-900 via-[#0B2545] to-slate-900 text-white rounded-3xl p-8 border-2 border-emerald-500 shadow-2xl relative flex flex-col justify-between transform lg:-translate-y-2">
                    <div class="absolute -top-3.5 right-6 bg-emerald-500 text-slate-950 font-extrabold text-[10px] uppercase tracking-wider px-3 py-1 rounded-full shadow-md">
                        PALING POPULER B2B
                    </div>

                    <div>
                        <span class="text-xs font-extrabold uppercase tracking-wider px-3 py-1 bg-emerald-500/20 text-emerald-400 rounded-full border border-emerald-500/30">
                            Gedung &amp; Ruko
                        </span>
                        <h3 class="font-extrabold text-white text-xl mt-4 mb-2 font-['Plus_Jakarta_Sans',sans-serif]">Triwulan (Quarterly Care)</h3>
                        <p class="text-xs text-slate-300 mb-6">Pilihan utama untuk kompleks ruko, perkantoran, hotel bintang 3-5, &amp; apartemen bertingkat.</p>

                        <ul class="space-y-3 text-xs sm:text-sm text-slate-300 mb-8">
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-400 font-bold">✓</span> <span>Inspeksi Mikro Kamera CCTV 1080p</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-400 font-bold">✓</span> <span>Hydro-Jetting Air Tekanan Tinggi 300 Bar</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-400 font-bold">✓</span> <span>Maintenance Vertical Riser Stack</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-400 font-bold">✓</span> <span>Dedicated Account Manager &amp; SLA 24/7</span>
                            </li>
                        </ul>
                    </div>

                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya tertarik proposal Paket Triwulan Gedung/Ruko') }}" 
                       target="_blank" rel="noopener" 
                       class="w-full py-3.5 bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-extrabold rounded-xl text-center text-xs sm:text-sm transition-colors block shadow-lg">
                        Minta Proposal Triwulan &rarr;
                    </a>
                </div>

                {{-- Plan 3: Bi-Annual Industrial --}}
                <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-lg hover:border-emerald-500/50 transition-all flex flex-col justify-between">
                    <div>
                        <span class="text-xs font-extrabold uppercase tracking-wider px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full">
                            Pabrik &amp; Mall
                        </span>
                        <h3 class="font-extrabold text-slate-900 text-xl mt-4 mb-2 font-['Plus_Jakarta_Sans',sans-serif]">Semesteran (Bi-Annual)</h3>
                        <p class="text-xs text-slate-500 mb-6">Dirancang khusus untuk kawasan industri pabrik manufaktur, mall perbelanjaan, &amp; rumah sakit.</p>

                        <ul class="space-y-3 text-xs sm:text-sm text-slate-600 mb-8">
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">✓</span> <span>Cleaning Parit Drainase Utama &amp; Bak Kontrol</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">✓</span> <span>Penanganan Limbah Industri Non-Kimia Korosif</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">✓</span> <span>Sertifikat Audit Sanitasi Drainase Industri</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-emerald-600 font-bold">✓</span> <span>Termin Pembayaran SPK Korporasi</span>
                            </li>
                        </ul>
                    </div>

                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya ingin konsultasi Paket Industri/Mall Semesteran') }}" 
                       target="_blank" rel="noopener" 
                       class="w-full py-3 bg-slate-900 hover:bg-emerald-600 text-white font-bold rounded-xl text-center text-xs sm:text-sm transition-colors block">
                        Minta Penawaran Industri &rarr;
                    </a>
                </div>

            </div>
        </div>

        {{-- Section 2: Download Proposal & Consult --}}
        <div class="bg-slate-50 rounded-3xl p-8 sm:p-12 border border-slate-200 flex flex-col lg:flex-row items-center justify-between gap-8">
            <div class="space-y-3 max-w-2xl">
                <span class="text-emerald-600 font-bold text-xs uppercase tracking-wider">Proposal Kerjasama B2B</span>
                <h3 class="text-2xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif]">
                    Butuh Proposal Resmi &amp; Company Profile Cetak?
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Dapatkan proposal penawaran kerja sama lengkap berserta salinan NIB, NPWP, legalitas J&amp;J Group, dan sertifikat garansi pengerjaan untuk tim manajemen atau procurement gedung Anda.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 shrink-0 w-full lg:w-auto">
                <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, tolong kirimkan PDF Proposal B2B & Company Profile J&J Group') }}" 
                   target="_blank" rel="noopener" 
                   class="px-8 py-3.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl shadow-lg transition-all text-center text-sm">
                    📩 Unduh Proposal via WhatsApp
                </a>
            </div>
        </div>

    </div>
</section>

{{-- CTA --}}
<section class="py-12 bg-slate-900 text-white text-center">
    <div class="max-w-4xl mx-auto px-4">
        <h3 class="text-2xl font-bold mb-3 font-['Plus_Jakarta_Sans',sans-serif]">Jadwalkan Survey Lokasi Gratis oleh Engineer Rootera!</h3>
        <p class="text-slate-300 mb-6 text-sm sm:text-base">Tim teknis kami siap datang ke gedung/lokasi Anda untuk inspeksi jalur pipa dan konsultasi kontrak B2B.</p>
        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya ingin request Survey Lokasi Gratis untuk kontrak B2B gedung kami') }}" 
           target="_blank" rel="noopener" 
           class="inline-flex items-center gap-2 px-8 py-3.5 bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-extrabold rounded-xl shadow-lg transition-all text-sm">
            <span>📅 Booking Survey Lokasi Gratis (WA 24 Jam)</span>
        </a>
    </div>
</section>
@endsection
