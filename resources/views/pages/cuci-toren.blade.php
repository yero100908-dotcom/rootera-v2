@extends('layouts.app')

@section('schema-markup')
<?php
$schemaData = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'WebPage',
            '@id' => url('/jasa-cuci-toren-air') . '#webpage',
            'url' => url('/jasa-cuci-toren-air'),
            'name' => $seo['title'] ?? 'Jasa Cuci Toren & Sterilisasi Tandon Air Bersih | Rootera Plumbing',
            'description' => $seo['description'] ?? '',
            'breadcrumb' => [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Layanan', 'item' => url('/layanan')],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => 'Cuci Toren & Tandon Air', 'item' => url('/jasa-cuci-toren-air')]
                ]
            ]
        ],
        [
            '@type' => 'Service',
            '@id' => url('/jasa-cuci-toren-air') . '#service',
            'name' => 'Jasa Cuci Toren & Sterilisasi Tandon Air Bersih',
            'provider' => [
                '@type' => 'LocalBusiness',
                'name' => 'Rootera Plumbing',
                'url' => url('/'),
                'telephone' => '+6281385404000'
            ],
            'areaServed' => ['Jabodetabek', 'Bandung', 'Semarang', 'Yogyakarta', 'Solo', 'Surabaya', 'Lampung'],
            'termsOfService' => url('/tentang-kami/garansi-layanan'),
            'hasOfferCatalog' => [
                '@type' => 'OfferCatalog',
                'name' => 'Layanan Perawatan Tangki Air',
                'itemListElement' => [
                    ['@type' => 'Offer', 'name' => 'Cuci Toren Air PE / Stainless Steel'],
                    ['@type' => 'Offer', 'name' => 'Kuras Endapan Lumpur Tandon Bawah (Ground Tank)'],
                    ['@type' => 'Offer', 'name' => 'Paket Kombo Pelancaran Pipa + Cuci Toren']
                ]
            ]
        ],
        [
            '@type' => 'FAQPage',
            'mainEntity' => [
                [
                    '@type' => 'Question',
                    'name' => 'Berapa bulan sekali toren air idealnya dicuci?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Toren air rumah tinggal dan ruko idealnya dikuras dan dicuci rutin setiap 3 hingga 6 bulan sekali untuk mencegah gumpalan lumut tebal, endapan pasir, dan cacing air.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Apakah proses pengurasan mematikan aliran air rumah dalam waktu lama?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Sama sekali tidak. Pengerjaan teknisi Rootera hanya membutuhkan waktu sekitar 45 hingga 60 menit dengan Jet Washer mini presisi.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Apakah bahan pembersih aman untuk air minum dan memasak?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Ya, 100% Food-Grade Safety. Kami mengutamakan metode dorongan air tekanan tinggi (mechanical jet cleaner) tanpa menggunakan asam korosif cair berbahaya.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Bisakah teknisi mencuci toren air di posisi dak atap yang tinggi?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Bisa. Teknisi Rootera dibekali peralatan keselamatan tinggi (safety harness) dan perlengkapan fleksibel untuk menjangkau toren di atap gedung maupun dak rumah.'
                    ]
                ]
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
{{-- 1. HERO SECTION --}}
<div class="relative bg-gradient-to-b from-slate-900 via-[#070F1E] to-slate-900 text-white pt-20 pb-16 sm:pt-24 sm:pb-20 overflow-hidden border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex justify-center items-center gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <span class="text-slate-500">/</span>
            <a href="{{ route('layanan') }}" class="hover:text-emerald-400 transition-colors">Layanan</a>
            <span class="text-slate-500">/</span>
            <span class="text-emerald-400 font-semibold">Cuci Toren &amp; Tandon Air</span>
        </nav>

        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 mb-4 backdrop-blur-md">
                🚰 HYGIENIC WATER SANITATION &amp; TANK CLEANING
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-5 font-['Plus_Jakarta_Sans',sans-serif] leading-tight">
                Spesialis Cuci Toren &amp; <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">Sterilisasi Tandon Air</span> Bebas Lumut
            </h1>
            <p class="text-slate-300 text-xs sm:text-base leading-relaxed max-w-2xl mx-auto mb-8">
                Layanan pengurasan dan pembersihan higienis toren air rumah, ruko, restoran, dan gedung menggunakan High-Pressure Jet Cleaner 100% food-grade safety tanpa bahan kimia korosif.
            </p>

            {{-- Action Buttons --}}
            <div class="flex flex-col sm:flex-row justify-center gap-3">
                <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya ingin pesan Jasa Cuci Toren & Kuras Tandon Air') }}" target="_blank" rel="noopener" class="bg-[#25D366] hover:bg-[#1EBE5A] text-white font-bold text-xs sm:text-sm py-3.5 px-8 rounded-full flex items-center justify-center gap-2 shadow-lg hover:-translate-y-0.5 transition-all">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    <span>Pesan Cuci Toren via WhatsApp</span>
                </a>
                <a href="{{ route('kontak') }}" class="bg-slate-800 hover:bg-slate-700 text-slate-200 font-bold text-xs sm:text-sm py-3.5 px-6 rounded-full border border-slate-700 transition-all flex items-center justify-center gap-2">
                    📋 Form Jadwal Pemesanan
                </a>
            </div>
        </div>
    </div>
</div>

<section class="py-12 sm:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- 2. SECTION 1: 5 KOMITMEN HIGIENIS (PILLAR VALUE) --}}
        <div class="mb-16 sm:mb-20">
            <div class="text-center max-w-2xl mx-auto mb-8 sm:mb-12">
                <span class="text-emerald-600 font-bold text-xs uppercase tracking-wider">Standar Kebersihan Tangki</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mt-1">5 Pilar Jaminan Cuci Toren Rootera</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Pilar 1 --}}
                <div class="bg-slate-50 p-6 rounded-3xl border border-slate-200/90 space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-extrabold text-xl mb-2">
                        💧
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-base font-['Plus_Jakarta_Sans',sans-serif]">1. 100% Food-Grade Safety</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        Pengurasan tanpa menggunakan asam korosif atau bahan kimia beracun. Air tetap 100% aman untuk kebutuhan memasak dan mandi.
                    </p>
                </div>

                {{-- Pilar 2 --}}
                <div class="bg-slate-50 p-6 rounded-3xl border border-slate-200/90 space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center font-extrabold text-xl mb-2">
                        🧼
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-base font-['Plus_Jakarta_Sans',sans-serif]">2. Rontokkan Lumut &amp; Kerak</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        Sikat rotasi khusus dan semprotan jet washer membersihkan lapisan lumut membandel di dinding tangki PE &amp; Stainless Steel.
                    </p>
                </div>

                {{-- Pilar 3 --}}
                <div class="bg-slate-50 p-6 rounded-3xl border border-slate-200/90 space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-purple-100 text-purple-700 flex items-center justify-center font-extrabold text-xl mb-2">
                        🌪️
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-base font-['Plus_Jakarta_Sans',sans-serif]">3. Kuras Lumpur Dasar Tangki</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        Penyedotan dan pengurasan total endapan lumpur, pasir, serta serangga mati yang mengendap di dasar tandon air.
                    </p>
                </div>

                {{-- Pilar 4 --}}
                <div class="bg-slate-50 p-6 rounded-3xl border border-slate-200/90 space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center font-extrabold text-xl mb-2">
                        ⚡
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-base font-['Plus_Jakarta_Sans',sans-serif]">4. Cek Radar &amp; Pelampung</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        Pengecekan otomatisasi switch pelampung otomatis (radar toren) agar pompa pengisi bekerja normal tanpa berisiko meluap.
                    </p>
                </div>

                {{-- Pilar 5 --}}
                <div class="bg-slate-50 p-6 rounded-3xl border border-slate-200/90 space-y-3 sm:col-span-2 lg:col-span-2">
                    <div class="w-12 h-12 rounded-2xl bg-teal-100 text-teal-700 flex items-center justify-center font-extrabold text-xl mb-2">
                        📜
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-base font-['Plus_Jakarta_Sans',sans-serif]">5. Garansi Air Jernih Higienis</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        Kami menjamin pasokan air kembali jernih bebas bau apek. Dilengkapi garansi pengerjaan jika terdapat kendala pasca pembersihan.
                    </p>
                </div>
            </div>
        </div>

        {{-- 3. SECTION 2: SKEMA CROSS-SELLING & BUNDLING BANNER (PAKET HEMAT KOMBO) --}}
        <div class="mb-16 sm:mb-20 bg-gradient-to-r from-slate-900 via-slate-950 to-slate-900 text-white rounded-3xl p-8 sm:p-12 border border-slate-800 shadow-2xl relative overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-8 space-y-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-500/20 text-amber-400 border border-amber-500/30">
                        🎁 PAKET HEMAT BUNDLING KOMBO
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white font-['Plus_Jakarta_Sans',sans-serif]">
                        Pipa Saluran Sekalian Mau Dilancarkan?
                    </h2>
                    <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                        Ambil <strong>Paket Hemat Kombo (Pelancaran Pipa Mampet + Cuci Toren Air)</strong> untuk mendapatkan diskon khusus pengerjaan gabungan dalam satu kali kunjungan teknisi!
                    </p>
                </div>

                <div class="lg:col-span-4 flex justify-start lg:justify-end">
                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya ingin pesan Paket Hemat Kombo (Pelancaran Pipa + Cuci Toren Air)') }}" target="_blank" rel="noopener" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-extrabold text-xs sm:text-sm rounded-full shadow-lg transition-all hover:-translate-y-0.5">
                        <span>Ambil Paket Kombo Hemat →</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- 4. SECTION 3: FAQ AKORDEON CUCI TOREN --}}
        <div class="mb-16 sm:mb-20 max-w-4xl mx-auto">
            <div class="text-center mb-10">
                <span class="text-emerald-600 font-bold text-xs uppercase tracking-wider">Pertanyaan Teknis</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mt-1">FAQ Pembersihan &amp; Cuci Toren</h2>
            </div>

            <div class="space-y-4" x-data="{ activeFaq: null }">
                {{-- FAQ 1 --}}
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button type="button" @click="activeFaq = (activeFaq === 1 ? null : 1)" class="w-full p-5 sm:p-6 text-left font-bold text-slate-900 text-sm sm:text-base flex justify-between items-center gap-4 hover:bg-slate-50/80 transition-colors focus:outline-none min-h-[48px]">
                        <span>Berapa bulan sekali toren air idealnya dicuci?</span>
                        <span class="text-emerald-600 font-extrabold text-lg shrink-0" x-text="activeFaq === 1 ? '−' : '+'">+</span>
                    </button>
                    <div x-show="activeFaq === 1" x-collapse class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-4">
                        Toren air rumah tinggal dan ruko idealnya dikuras dan dicuci rutin setiap 3 hingga 6 bulan sekali untuk mencegah gumpalan lumut tebal, endapan pasir, dan cacing air.
                    </div>
                </div>

                {{-- FAQ 2 --}}
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button type="button" @click="activeFaq = (activeFaq === 2 ? null : 2)" class="w-full p-5 sm:p-6 text-left font-bold text-slate-900 text-sm sm:text-base flex justify-between items-center gap-4 hover:bg-slate-50/80 transition-colors focus:outline-none min-h-[48px]">
                        <span>Apakah proses pengurasan mematikan aliran air rumah dalam waktu lama?</span>
                        <span class="text-emerald-600 font-extrabold text-lg shrink-0" x-text="activeFaq === 2 ? '−' : '+'">+</span>
                    </button>
                    <div x-show="activeFaq === 2" x-collapse class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-4">
                        Sama sekali tidak. Pengerjaan teknisi Rootera hanya membutuhkan waktu sekitar 45 hingga 60 menit dengan Jet Washer mini presisi.
                    </div>
                </div>

                {{-- FAQ 3 --}}
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button type="button" @click="activeFaq = (activeFaq === 3 ? null : 3)" class="w-full p-5 sm:p-6 text-left font-bold text-slate-900 text-sm sm:text-base flex justify-between items-center gap-4 hover:bg-slate-50/80 transition-colors focus:outline-none min-h-[48px]">
                        <span>Apakah bahan pembersih aman untuk air minum dan memasak?</span>
                        <span class="text-emerald-600 font-extrabold text-lg shrink-0" x-text="activeFaq === 3 ? '−' : '+'">+</span>
                    </button>
                    <div x-show="activeFaq === 3" x-collapse class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-4">
                        Ya, 100% Food-Grade Safety. Kami mengutamakan metode dorongan air tekanan tinggi (mechanical jet cleaner) tanpa menggunakan asam korosif cair berbahaya.
                    </div>
                </div>

                {{-- FAQ 4 --}}
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button type="button" @click="activeFaq = (activeFaq === 4 ? null : 4)" class="w-full p-5 sm:p-6 text-left font-bold text-slate-900 text-sm sm:text-base flex justify-between items-center gap-4 hover:bg-slate-50/80 transition-colors focus:outline-none min-h-[48px]">
                        <span>Bisakah teknisi mencuci toren air di posisi dak atap yang tinggi?</span>
                        <span class="text-emerald-600 font-extrabold text-lg shrink-0" x-text="activeFaq === 4 ? '−' : '+'">+</span>
                    </button>
                    <div x-show="activeFaq === 4" x-collapse class="px-5 pb-5 sm:px-6 sm:pb-6 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-4">
                        Bisa. Teknisi Rootera dibekali peralatan keselamatan tinggi (safety harness) dan perlengkapan fleksibel untuk menjangkau toren di atap gedung maupun dak rumah.
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
