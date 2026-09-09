@extends('layouts.app')

@section('meta_title', 'Standar SOP & Protokol K3 Pengerjaan Pipa Tanpa Bongkar | Rootera')
@section('meta_description', 'Standar operasional prosedur teknisi Rootera Plumbing: APD lengkap, sterilisasi mesin hydro jetting, tanpa zat kimia berbahaya, dan kebersihan pasca kerja.')
@section('meta_keywords', 'sop pelancaran pipa mampet, k3 teknisi plumbing, keselamatan kerja sanitasi, hydro jetting ramah lingkungan')
@section('canonical', url('/tentang-kami/sop-sanitasi-k3'))

@section('schema-markup')
<?php
$schemaData = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => ['Article', 'WebPage'],
            '@id' => url('/tentang-kami/sop-sanitasi-k3#article'),
            'headline' => 'Standar SOP & Protokol K3 Pengerjaan Pipa Tanpa Bongkar',
            'name' => 'Standar SOP & Protokol K3 Pengerjaan Pipa Tanpa Bongkar | Rootera',
            'description' => 'Standar operasional prosedur teknisi Rootera Plumbing: APD lengkap, sterilisasi mesin hydro jetting, tanpa zat kimia berbahaya, dan kebersihan pasca kerja.',
            'url' => url('/tentang-kami/sop-sanitasi-k3'),
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Rootera Plumbing (J&J Group)',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp')
                ]
            ],
            'author' => [
                '@type' => 'Organization',
                'name' => 'Rootera Plumbing (J&J Group)'
            ]
        ],
        [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Tentang Kami', 'item' => url('/tentang-kami')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'SOP & Protokol Sanitasi K3', 'item' => url('/tentang-kami/sop-sanitasi-k3')]
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
{{-- 1. HERO SECTION (DYNAMIC & CREDIBILITY-DRIVEN) --}}
<section class="relative bg-gradient-to-b from-[#0A2E78] via-[#0B2545] to-slate-900 text-white pt-24 pb-20 overflow-hidden">
    {{-- Glowing background accents --}}
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[350px] bg-[#169F81]/20 blur-[120px] rounded-full pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[400px] h-[300px] bg-blue-600/10 blur-[100px] rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex justify-center items-center gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <span class="text-slate-500">/</span>
            <a href="{{ route('tentang-kami') }}" class="hover:text-emerald-400 transition-colors">Tentang Kami</a>
            <span class="text-slate-500">/</span>
            <span class="text-emerald-400 font-semibold">SOP &amp; Protokol Sanitasi K3</span>
        </nav>

        <div class="text-center max-w-4xl mx-auto mb-12">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider bg-[#169F81]/20 text-emerald-300 border border-[#169F81]/40 mb-5 backdrop-blur-md shadow-lg shadow-emerald-950/40">
                🦺 Standard Operating Procedure &amp; Safety First
            </span>
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white mb-6 font-['Plus_Jakarta_Sans',sans-serif] leading-tight">
                Standar SOP &amp; Protokol <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-emerald-200">Sanitasi K3 Rootera</span>
            </h1>
            <p class="text-slate-300 text-base sm:text-xl leading-relaxed max-w-3xl mx-auto font-normal">
                Komitmen keselamatan teknisi, kebersihan properti hunian &amp; komersial, sterilisasi mesin Ridgid &amp; Hydro-jetting, serta penanganan limbah ramah lingkungan tanpa merusak lingkungan.
            </p>
        </div>

        {{-- Quick Stat Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 max-w-5xl mx-auto pt-4">
            <div class="bg-white/5 backdrop-blur-md border border-white/10 p-5 rounded-2xl flex items-center gap-4 hover:border-[#169F81]/50 hover:bg-white/10 transition-all group">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center font-extrabold text-2xl shrink-0 group-hover:scale-110 transition-transform">
                    🛡️
                </div>
                <div>
                    <div class="text-white font-extrabold text-base font-['Plus_Jakarta_Sans',sans-serif]">100% APD Compliance</div>
                    <div class="text-slate-300 text-xs mt-0.5">Teknisi bersertifikasi &amp; wajib mengenakan APD K3 lengkap</div>
                </div>
            </div>

            <div class="bg-white/5 backdrop-blur-md border border-white/10 p-5 rounded-2xl flex items-center gap-4 hover:border-[#169F81]/50 hover:bg-white/10 transition-all group">
                <div class="w-12 h-12 rounded-xl bg-teal-500/20 text-teal-400 border border-teal-500/30 flex items-center justify-center font-extrabold text-2xl shrink-0 group-hover:scale-110 transition-transform">
                    🌱
                </div>
                <div>
                    <div class="text-white font-extrabold text-base font-['Plus_Jakarta_Sans',sans-serif]">Zero Harsh Chemicals</div>
                    <div class="text-slate-300 text-xs mt-0.5">Bebas Soda Api &amp; Asam Sulfat. Aman untuk PVC &amp; tanah</div>
                </div>
            </div>

            <div class="bg-white/5 backdrop-blur-md border border-white/10 p-5 rounded-2xl flex items-center gap-4 hover:border-[#169F81]/50 hover:bg-white/10 transition-all group">
                <div class="w-12 h-12 rounded-xl bg-blue-500/20 text-blue-400 border border-blue-500/30 flex items-center justify-center font-extrabold text-2xl shrink-0 group-hover:scale-110 transition-transform">
                    💎
                </div>
                <div>
                    <div class="text-white font-extrabold text-base font-['Plus_Jakarta_Sans',sans-serif]">30-Day Flow Warranty</div>
                    <div class="text-slate-300 text-xs mt-0.5">Jaminan kebersihan &amp; pelancaran tuntas bergaransi resmi</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 2. INTERACTIVE APD & TECHNICIAN SHOWCASE (SPLIT 2-KOLOM) --}}
<section class="py-16 sm:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-[#169F81] font-bold text-xs tracking-widest uppercase bg-emerald-50 px-3.5 py-1.5 rounded-full border border-emerald-200/80">Standardisasi Proteksi Diri</span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 mt-3 font-['Plus_Jakarta_Sans',sans-serif]">
                Perlengkapan APD K3 Teknisi Lapangan Rootera
            </h2>
            <p class="text-slate-600 text-sm sm:text-base mt-3 leading-relaxed">
                Sebelum menginjakkan kaki di lokasi pelanggan (hunian, restoran, hotel, atau pabrik), teknisi Rootera Plumbing diwajibkan menerapkan standar proteksi K3 lengkap.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            {{-- Left Column: 4 APD Components --}}
            <div class="lg:col-span-7 space-y-4">
                {{-- APD Item 1 --}}
                <div class="p-5 bg-slate-50 hover:bg-emerald-50/40 rounded-2xl border border-slate-200/90 hover:border-[#169F81]/40 transition-all duration-300 flex items-start gap-4 group hover:shadow-md">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-[#169F81] flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="font-bold text-slate-900 text-base font-['Plus_Jakarta_Sans',sans-serif]">Sarung Tangan Heavy-Duty Anti-Slip</h3>
                            <span class="text-[10px] font-semibold bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-full">Proteksi Mekanis</span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                            Melindungi tangan teknisi dari gesekan kabel spiral baja Ridgid Amerika saat rotasi kecepatan tinggi serta mencegah kontak langsung dengan mikroba saluran.
                        </p>
                    </div>
                </div>

                {{-- APD Item 2 --}}
                <div class="p-5 bg-slate-50 hover:bg-emerald-50/40 rounded-2xl border border-slate-200/90 hover:border-[#169F81]/40 transition-all duration-300 flex items-start gap-4 group hover:shadow-md">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="font-bold text-slate-900 text-base font-['Plus_Jakarta_Sans',sans-serif]">Sepatu Boot Safety &amp; Pelindung Alas Footwear</h3>
                            <span class="text-[10px] font-semibold bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full">Higiene Lantai</span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                            Memastikan teknisi tidak membawa debu atau kotoran luar ke dalam area lantai bersih hunian, dapur restoran, maupun fasilitas steril.
                        </p>
                    </div>
                </div>

                {{-- APD Item 3 --}}
                <div class="p-5 bg-slate-50 hover:bg-emerald-50/40 rounded-2xl border border-slate-200/90 hover:border-[#169F81]/40 transition-all duration-300 flex items-start gap-4 group hover:shadow-md">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="font-bold text-slate-900 text-base font-['Plus_Jakarta_Sans',sans-serif]">Respirator Mask &amp; Safety Goggles</h3>
                            <span class="text-[10px] font-semibold bg-amber-100 text-amber-800 px-2 py-0.5 rounded-full">Proteksi Pernapasan</span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                            Melindungi teknisi dari cipratan air limbah serta uap gas amonia/asam yang terperangkap dalam saluran saat penghembusan Hydro-jetting.
                        </p>
                    </div>
                </div>

                {{-- APD Item 4 --}}
                <div class="p-5 bg-slate-50 hover:bg-emerald-50/40 rounded-2xl border border-slate-200/90 hover:border-[#169F81]/40 transition-all duration-300 flex items-start gap-4 group hover:shadow-md">
                    <div class="w-12 h-12 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="font-bold text-slate-900 text-base font-['Plus_Jakarta_Sans',sans-serif]">Seragam Kerja Khusus &amp; Identitas Resmi</h3>
                            <span class="text-[10px] font-semibold bg-teal-100 text-teal-800 px-2 py-0.5 rounded-full">Kredibilitas B2B</span>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                            Setiap personel menggunakan seragam kerja resmi berlogo Rootera Plumbing dan dibekali ID Card terverifikasi untuk keamanan &amp; ketenangan pelanggan.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Right Column: Image Showcase Container --}}
            <div class="lg:col-span-5">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-slate-100 group">
                    <img src="{{ asset('images/dokumentasi/teknisi-rootera-plumbing-bekerja-lapangan.webp') }}" 
                         alt="Protokol APD Teknisi Rootera Plumbing" 
                         class="w-full h-[460px] object-cover group-hover:scale-105 transition-transform duration-700">

                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent"></div>

                    <div class="absolute bottom-6 left-6 right-6 bg-slate-900/90 backdrop-blur-md p-4 rounded-2xl border border-white/20 text-white flex items-center justify-between shadow-xl">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 rounded-full bg-emerald-400 animate-ping"></div>
                            <div>
                                <div class="text-xs font-bold text-emerald-400">STATUS SEHAT &amp; STERIL</div>
                                <div class="text-xs text-slate-300 font-medium">Pemeriksaan Suhu &amp; APD Berkala</div>
                            </div>
                        </div>
                        <span class="text-xs bg-[#169F81] text-white px-3 py-1 rounded-lg font-semibold">Verified K3</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 3. 3-STEP STERILIZATION TIMELINE --}}
<section class="py-16 sm:py-24 bg-slate-50 border-y border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-[#169F81] font-bold text-xs tracking-widest uppercase bg-white px-3.5 py-1.5 rounded-full border border-slate-200 shadow-sm">Higiene &amp; Sterilitas Alat</span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 mt-3 font-['Plus_Jakarta_Sans',sans-serif]">
                Protokol Desinfeksi Mesin Ridgid &amp; Hydro-Jetting
            </h2>
            <p class="text-slate-600 text-sm sm:text-base mt-3 leading-relaxed">
                Kami menjamin unit mesin spiral baja Ridgid, selang hydro-jetting, dan head nozzle disterilkan secara disiplin sebelum dan sesudah masuk ke lokasi konsumen.
            </p>
        </div>

        {{-- Stepper Layout --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
            {{-- Step 1 --}}
            <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-lg shadow-slate-200/50 hover:border-[#169F81]/40 transition-all duration-300 relative group">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-[#169F81] to-emerald-400 text-white font-extrabold text-xl flex items-center justify-center shadow-lg shadow-emerald-500/30 mb-6 group-hover:scale-110 transition-transform">
                    01
                </div>
                <h3 class="font-bold text-slate-900 text-lg mb-2 font-['Plus_Jakarta_Sans',sans-serif]">Pre-Wash &amp; High Pressure Clean</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Pembersihan sisa endapan lemak dan tanah pada kabel spiral baja Ridgid menggunakan semprotan jet air bertekanan pasca pengerjaan di workshop pusat.
                </p>
                <div class="mt-6 pt-4 border-t border-slate-100 text-xs font-semibold text-emerald-600 flex items-center gap-1.5">
                    <span>✓ Tahap 1 Workshop Clearance</span>
                </div>
            </div>

            {{-- Step 2 --}}
            <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-lg shadow-slate-200/50 hover:border-[#169F81]/40 transition-all duration-300 relative group">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-[#0A2E78] to-blue-600 text-white font-extrabold text-xl flex items-center justify-center shadow-lg shadow-blue-500/30 mb-6 group-hover:scale-110 transition-transform">
                    02
                </div>
                <h3 class="font-bold text-slate-900 text-lg mb-2 font-['Plus_Jakarta_Sans',sans-serif]">Desinfeksi Cairan Antiseptik</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Perendaman dan pembilasan kabel spiral dengan cairan antiseptik ramah lingkungan untuk membasmi kuman, bakteri e-coli, dan bau tidak sedap secara tuntas.
                </p>
                <div class="mt-6 pt-4 border-t border-slate-100 text-xs font-semibold text-blue-600 flex items-center gap-1.5">
                    <span>✓ Tahap 2 Sterilisasi Kuman</span>
                </div>
            </div>

            {{-- Step 3 --}}
            <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-lg shadow-slate-200/50 hover:border-[#169F81]/40 transition-all duration-300 relative group">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-amber-500 to-amber-400 text-white font-extrabold text-xl flex items-center justify-center shadow-lg shadow-amber-500/30 mb-6 group-hover:scale-110 transition-transform">
                    03
                </div>
                <h3 class="font-bold text-slate-900 text-lg mb-2 font-['Plus_Jakarta_Sans',sans-serif]">Storage &amp; Sealed Box Container</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Penyimpanan mesin dan aksesori nozzle ke dalam wadah box tertutup rapat agar siap digunakan dengan kondisi 100% higienis di lokasi konsumen berikutnya.
                </p>
                <div class="mt-6 pt-4 border-t border-slate-100 text-xs font-semibold text-amber-600 flex items-center gap-1.5">
                    <span>✓ Tahap 3 Ready for Site Dispatch</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 4. SEKSI BARU: TABEL KOMPARASI (ROOTERA K3 vs TUKANG PIPA TRADISIONAL) --}}
<section class="py-16 sm:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-[#169F81] font-bold text-xs tracking-widest uppercase bg-emerald-50 px-3.5 py-1.5 rounded-full border border-emerald-200/80">Standar Kerja Berbeda</span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 mt-3 font-['Plus_Jakarta_Sans',sans-serif]">
                Komparasi Standar K3 Rootera vs Jasa Konvensional
            </h2>
            <p class="text-slate-600 text-sm sm:text-base mt-3 leading-relaxed">
                Mengapa memilih Rootera Plumbing memberikan ketenangan pikiran total untuk properti hunian dan komersial Anda.
            </p>
        </div>

        {{-- Comparison Table Card --}}
        <div class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[640px]">
                    <thead>
                        <tr class="bg-slate-900 text-white">
                            <th class="py-5 px-6 font-bold text-sm sm:text-base w-1/3 font-['Plus_Jakarta_Sans',sans-serif]">Aspek Penanganan</th>
                            <th class="py-5 px-6 font-bold text-sm sm:text-base w-1/3 bg-[#169F81] text-white font-['Plus_Jakarta_Sans',sans-serif]">
                                <div class="flex items-center gap-2">
                                    <span>🛡️ Rootera Plumbing (SOP K3)</span>
                                </div>
                            </th>
                            <th class="py-5 px-6 font-bold text-sm sm:text-base w-1/3 bg-slate-800 text-slate-300 font-['Plus_Jakarta_Sans',sans-serif]">Jasa Konvensional / Tradisional</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200/80 text-xs sm:text-sm">
                        {{-- Row 1 --}}
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-4 px-6 font-bold text-slate-900">
                                <div>Penggunaan Bahan Kimia</div>
                                <div class="text-[11px] text-slate-500 font-normal mt-0.5">Keamanan struktur pipa PVC &amp; lingkungan</div>
                            </td>
                            <td class="py-4 px-6 bg-emerald-50/60 font-semibold text-emerald-900 border-x border-emerald-100">
                                <div class="flex items-start gap-2">
                                    <span class="text-emerald-600 font-bold shrink-0 text-base">✓</span>
                                    <span><strong>100% Bebas Chemical Korosif</strong><br>Tanpa Soda Api / Asam Sulfat. Menggunakan metode mekanis fleksibel.</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-slate-600 bg-slate-50/40">
                                <div class="flex items-start gap-2">
                                    <span class="text-rose-500 font-bold shrink-0 text-base">✕</span>
                                    <span><strong>Sering Menggunakan Soda Api Pekat</strong><br>Berisiko melunakkan &amp; merusak sambungan pipa PVC.</span>
                                </div>
                            </td>
                        </tr>

                        {{-- Row 2 --}}
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-4 px-6 font-bold text-slate-900">
                                <div>Proteksi Lantai &amp; Properti</div>
                                <div class="text-[11px] text-slate-500 font-normal mt-0.5">Mencegah goresan keramik/marmer</div>
                            </td>
                            <td class="py-4 px-6 bg-emerald-50/60 font-semibold text-emerald-900 border-x border-emerald-100">
                                <div class="flex items-start gap-2">
                                    <span class="text-emerald-600 font-bold shrink-0 text-base">✓</span>
                                    <span><strong>Proteksi Alur Kerja Presisi</strong><br>Memasang pelindung footwear, matras kerja &amp; terpal pelindung areawas.</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-slate-600 bg-slate-50/40">
                                <div class="flex items-start gap-2">
                                    <span class="text-rose-500 font-bold shrink-0 text-base">✕</span>
                                    <span><strong>Tanpa Alas Pelindung</strong><br>Berisiko mengotori lantai &amp; menggores marmer/keramik.</span>
                                </div>
                            </td>
                        </tr>

                        {{-- Row 3 --}}
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-4 px-6 font-bold text-slate-900">
                                <div>Sterilisasi Mesin &amp; Alat</div>
                                <div class="text-[11px] text-slate-500 font-normal mt-0.5">Pembersihan kabel spiral &amp; nozzle</div>
                            </td>
                            <td class="py-4 px-6 bg-emerald-50/60 font-semibold text-emerald-900 border-x border-emerald-100">
                                <div class="flex items-start gap-2">
                                    <span class="text-emerald-600 font-bold shrink-0 text-base">✓</span>
                                    <span><strong>Desinfeksi 3-Step Berkala</strong><br>Kabel spiral &amp; selang hydro-jetting dicuci antiseptik pasca kerja.</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-slate-600 bg-slate-50/40">
                                <div class="flex items-start gap-2">
                                    <span class="text-rose-500 font-bold shrink-0 text-base">✕</span>
                                    <span><strong>Alat Langsung Dipakai antar-Lokasi</strong><br>Berisiko membawa kuman &amp; sisa kotoran lokasi sebelumnya.</span>
                                </div>
                            </td>
                        </tr>

                        {{-- Row 4 --}}
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-4 px-6 font-bold text-slate-900">
                                <div>Manajemen Bau &amp; Residu</div>
                                <div class="text-[11px] text-slate-500 font-normal mt-0.5">Penanganan kebersihan pasca kerja</div>
                            </td>
                            <td class="py-4 px-6 bg-emerald-50/60 font-semibold text-emerald-900 border-x border-emerald-100">
                                <div class="flex items-start gap-2">
                                    <span class="text-emerald-600 font-bold shrink-0 text-base">✓</span>
                                    <span><strong>Mopping &amp; Sanitasi Karbol</strong><br>Lantai dikeringkan, mengelap cipratan &amp; menyemprotkan pengharum.</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-slate-600 bg-slate-50/40">
                                <div class="flex items-start gap-2">
                                    <span class="text-rose-500 font-bold shrink-0 text-base">✕</span>
                                    <span><strong>Aroma Bau Dibiarkan Menyengat</strong><br>Sisa genangan air &amp; residu lemak tidak dibersihkan tuntas.</span>
                                </div>
                            </td>
                        </tr>

                        {{-- Row 5 --}}
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-4 px-6 font-bold text-slate-900">
                                <div>Jaminan &amp; Legitimasi</div>
                                <div class="text-[11px] text-slate-500 font-normal mt-0.5">Garansi resmi &amp; faktur legalitas</div>
                            </td>
                            <td class="py-4 px-6 bg-emerald-50/60 font-semibold text-emerald-900 border-x border-emerald-100">
                                <div class="flex items-start gap-2">
                                    <span class="text-emerald-600 font-bold shrink-0 text-base">✓</span>
                                    <span><strong>Garansi Resmi 30 Hari &amp; Invoice PPN</strong><br>Layanan klaim responsif &lt;24 jam via WhatsApp resmi.</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-slate-600 bg-slate-50/40">
                                <div class="flex items-start gap-2">
                                    <span class="text-rose-500 font-bold shrink-0 text-base">✕</span>
                                    <span><strong>Tanpa Garansi Resmi Written</strong><br>Bila mampet kembali dalam beberapa hari harus bayar ulang.</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

{{-- 5. SEKSI BARU: PROTOKOL AREA HIGIENIS KHUSUS (RESTO, RUMAH SAKIT & PABRIK) --}}
<section class="py-16 sm:py-24 bg-slate-50 border-t border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-[#169F81] font-bold text-xs tracking-widest uppercase bg-white px-3.5 py-1.5 rounded-full border border-slate-200 shadow-sm">Sektor Spesifik</span>
            <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 mt-3 font-['Plus_Jakarta_Sans',sans-serif]">
                Protokol Sanitasi Khusus Berdasarkan Sektor Properti
            </h2>
            <p class="text-slate-600 text-sm sm:text-base mt-3 leading-relaxed">
                Setiap tipe bangunan memiliki karakteristik dan sensitivitas berbeda. Teknisi Rootera menerapkan penanganan K3 yang disesuaikan khusus:
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Card 1: F&B & Restoran --}}
            <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-2xl mb-6 group-hover:scale-110 transition-transform">
                        🍽️
                    </div>
                    <span class="text-[11px] font-bold uppercase tracking-wider bg-amber-50 text-amber-800 px-3 py-1 rounded-full border border-amber-200">F&amp;B &amp; Restoran</span>
                    <h3 class="font-bold text-slate-900 text-xl mt-3 mb-3 font-['Plus_Jakarta_Sans',sans-serif]">Dapur Resto &amp; Grease Trap</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Prosedur pengurasan grease trap tanpa kontaminasi area penyajian makanan &amp; tanpa aroma residu minyak. Didukung opsi pengerjaan shift malam.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100 text-xs font-semibold text-slate-700">
                    <span class="text-emerald-600">✓</span> Higienis Standar BPOM &amp; Food Grade
                </div>
            </div>

            {{-- Card 2: Hunian & Apartemen --}}
            <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-[#169F81] flex items-center justify-center font-bold text-2xl mb-6 group-hover:scale-110 transition-transform">
                        🏠
                    </div>
                    <span class="text-[11px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-800 px-3 py-1 rounded-full border border-emerald-200">Hunian &amp; High-Rise</span>
                    <h3 class="font-bold text-slate-900 text-xl mt-3 mb-3 font-['Plus_Jakarta_Sans',sans-serif]">Hunian &amp; Apartemen Eksklusif</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Penggunaan matras protective sheet di bawah wastafel/lantai agar tidak mencoreng keramik/marmer. Metode mesin spiral fleksibel tanpa bising.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100 text-xs font-semibold text-slate-700">
                    <span class="text-emerald-600">✓</span> Proteksi Estetika Flooring 100%
                </div>
            </div>

            {{-- Card 3: Fasilitas Medis & Industri --}}
            <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-2xl mb-6 group-hover:scale-110 transition-transform">
                        🏥
                    </div>
                    <span class="text-[11px] font-bold uppercase tracking-wider bg-blue-50 text-blue-800 px-3 py-1 rounded-full border border-blue-200">Medis &amp; Industri</span>
                    <h3 class="font-bold text-slate-900 text-xl mt-3 mb-3 font-['Plus_Jakarta_Sans',sans-serif]">Rumah Sakit &amp; Kawasan Pabrik</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Penanganan limbah cair non-infeksius &amp; drainase medis dengan SOP higienis steril. Perlengkapan respirator APD &amp; kepatuhan regulasi lingkungan.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100 text-xs font-semibold text-slate-700">
                    <span class="text-emerald-600">✓</span> Kepatuhan Regulasi K3 Medis
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 6. SEKSI BARU: POST-WORK QUALITY & HYGIENE CHECKLIST --}}
<section class="py-16 sm:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto bg-gradient-to-br from-slate-900 via-[#0B2545] to-slate-900 rounded-3xl p-8 sm:p-12 text-white shadow-2xl border border-slate-800 relative overflow-hidden">
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-[#169F81]/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-10 pb-6 border-b border-slate-700/80">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-400 bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20">Quality Assurance Sheet</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white mt-2 font-['Plus_Jakarta_Sans',sans-serif]">
                        5-Point Checklist Verifikasi Pasca Kerja
                    </h2>
                </div>
                <div class="shrink-0 bg-white/10 backdrop-blur-md px-4 py-2 rounded-xl border border-white/10 text-xs text-emerald-300 font-semibold flex items-center gap-2">
                    <span>📋 Inspection Standard Rootera</span>
                </div>
            </div>

            <div class="space-y-4">
                {{-- Checklist Item 1 --}}
                <div class="flex items-start gap-4 p-4 bg-white/5 rounded-2xl border border-white/10 hover:border-emerald-400/40 transition-colors">
                    <div class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-400 font-extrabold flex items-center justify-center shrink-0 text-sm">
                        ✓
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-base font-['Plus_Jakarta_Sans',sans-serif]">01. Tes Alir Debit Air Maksimal (Drain Flow Test)</h3>
                        <p class="text-xs sm:text-sm text-slate-300 mt-0.5 leading-relaxed">
                            Pengujian alur pembuangan air secara berulang dengan volume tinggi untuk memastikan alur pipa lancar 100% tanpa adanya genangan tersisa.
                        </p>
                    </div>
                </div>

                {{-- Checklist Item 2 --}}
                <div class="flex items-start gap-4 p-4 bg-white/5 rounded-2xl border border-white/10 hover:border-emerald-400/40 transition-colors">
                    <div class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-400 font-extrabold flex items-center justify-center shrink-0 text-sm">
                        ✓
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-base font-['Plus_Jakarta_Sans',sans-serif]">02. Pembersihan &amp; Sanitasi Area Kerja (Mopping &amp; Wiping)</h3>
                        <p class="text-xs sm:text-sm text-slate-300 mt-0.5 leading-relaxed">
                            Teknisi mengelap cipratan air di sekitar area washbasin/floor drain dan mengepel lantai kerja agar kembali bersih &amp; kering.
                        </p>
                    </div>
                </div>

                {{-- Checklist Item 3 --}}
                <div class="flex items-start gap-4 p-4 bg-white/5 rounded-2xl border border-white/10 hover:border-emerald-400/40 transition-colors">
                    <div class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-400 font-extrabold flex items-center justify-center shrink-0 text-sm">
                        ✓
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-base font-['Plus_Jakarta_Sans',sans-serif]">03. Pembilasan Pipa &amp; Netralisir Bau Alami</h3>
                        <p class="text-xs sm:text-sm text-slate-300 mt-0.5 leading-relaxed">
                            Pemberian cairan karbol antiseptik penghilang aroma tak sedap di sekitar saluran pembuangan agar ruangan beraroma segar.
                        </p>
                    </div>
                </div>

                {{-- Checklist Item 4 --}}
                <div class="flex items-start gap-4 p-4 bg-white/5 rounded-2xl border border-white/10 hover:border-emerald-400/40 transition-colors">
                    <div class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-400 font-extrabold flex items-center justify-center shrink-0 text-sm">
                        ✓
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-base font-['Plus_Jakarta_Sans',sans-serif]">04. Pengemasan Limbah Kantong Anti-Bocor</h3>
                        <p class="text-xs sm:text-sm text-slate-300 mt-0.5 leading-relaxed">
                            Seluruh sisa endapan kerak/lumpur yang terangkat dikemas rapat ke dalam wadah plastik khusus anti-bocor untuk dibuang dengan aman.
                        </p>
                    </div>
                </div>

                {{-- Checklist Item 5 --}}
                <div class="flex items-start gap-4 p-4 bg-white/5 rounded-2xl border border-white/10 hover:border-emerald-400/40 transition-colors">
                    <div class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-400 font-extrabold flex items-center justify-center shrink-0 text-sm">
                        ✓
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-base font-['Plus_Jakarta_Sans',sans-serif]">05. Serah Terima Garansi 30 Hari &amp; Digital Invoice</h3>
                        <p class="text-xs sm:text-sm text-slate-300 mt-0.5 leading-relaxed">
                            Penyerahan bukti garansi pengerjaan 30 hari serta faktur digital invoice resmi yang terkonfirmasi ke WhatsApp pemesan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 7. CALL TO ACTION (CTA) BANNER TERINTEGRASI --}}
<section class="py-16 bg-gradient-to-r from-[#0A2E78] via-[#0B2545] to-[#0A2E78] text-white relative overflow-hidden">
    <div class="max-w-5xl mx-auto px-4 text-center relative z-10">
        <h2 class="text-2xl sm:text-4xl font-extrabold mb-4 font-['Plus_Jakarta_Sans',sans-serif] leading-tight">
            Percayakan Sanitasi Pipa Anda pada Teknisi Berstandar K3!
        </h2>
        <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto mb-8 leading-relaxed">
            Teknisi kami siap meluncur dengan perlengkapan APD lengkap, sterilisasi alat desinfeksi, tanpa pembongkaran &amp; jaminan garansi 30 hari.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya ingin order pelancaran pipa mampet berstandar K3 & higienis') }}" 
               target="_blank" rel="noopener" 
               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 bg-[#169F81] text-white font-bold rounded-2xl shadow-xl shadow-emerald-900/40 hover:bg-emerald-600 transition-all text-sm sm:text-base group">
                <span>💬 Hubungi Customer Care K3 (WA 24 Jam)</span>
                <span class="group-hover:translate-x-1 transition-transform">→</span>
            </a>

            <a href="{{ route('garansi') }}" 
               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 bg-white/10 text-white font-semibold rounded-2xl border border-white/20 hover:bg-white/20 transition-all text-sm sm:text-base">
                <span>🛡️ Pelajari Ketentuan Garansi 30 Hari</span>
            </a>
        </div>
    </div>
</section>
@endsection
