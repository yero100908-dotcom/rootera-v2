@extends('layouts.app')

@section('schema-markup')
<?php
$schemaFaqs = [];
foreach ($localFaqs as $faq) {
    $schemaFaqs[] = [
        '@type' => 'Question',
        'name' => $faq['question'],
        'acceptedAnswer' => [
            '@type' => 'Answer',
            'text' => $faq['answer']
        ]
    ];
}

$schemaData = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'WebPage',
            '@id' => $canonical . '#webpage',
            'url' => $canonical,
            'name' => $title,
            'description' => $description,
            'breadcrumb' => [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Cuci Toren', 'item' => url('/jasa-cuci-toren-air')],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => $locationName, 'item' => $canonical]
                ]
            ]
        ],
        [
            '@type' => 'Service',
            '@id' => $canonical . '#service',
            'name' => "Jasa Cuci Toren & Kuras Tandon Air {$locationName}",
            'serviceType' => 'Water Tank Cleaning Service',
            'provider' => [
                '@type' => 'LocalBusiness',
                'name' => 'Rootera Plumbing',
                'url' => url('/'),
                'telephone' => '+6281385404000'
            ],
            'areaServed' => $locationName,
            'termsOfService' => url('/tentang-kami/garansi-layanan')
        ],
        [
            '@type' => 'FAQPage',
            'mainEntity' => $schemaFaqs
        ]
    ]
];
?>
<script type="application/ld+json">
{!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
{{-- HERO HEADER --}}
<div class="relative bg-gradient-to-b from-slate-900 via-[#070F1E] to-slate-900 text-white pt-20 pb-16 sm:pt-24 sm:pb-20 overflow-hidden border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex justify-center items-center gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <span class="text-slate-500">/</span>
            <a href="{{ route('services.cuci-toren') }}" class="hover:text-emerald-400 transition-colors">Cuci Toren</a>
            <span class="text-slate-500">/</span>
            <span class="text-emerald-400 font-semibold">{{ $locationShort }}</span>
        </nav>

        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 mb-4 backdrop-blur-md">
                🚰 HYGIENIC WATER TANK CLEANING — {{ strtoupper($locationShort) }}
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-5 font-['Plus_Jakarta_Sans',sans-serif] leading-tight">
                Jasa Cuci Toren &amp; <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">Kuras Tandon Air Bersih</span> {{ $locationName }}
            </h1>
            <p class="text-slate-300 text-xs sm:text-base leading-relaxed max-w-2xl mx-auto mb-8">
                Penanganan cepat endapan lumut tebal, air tanah kuning, pasir halus, dan bau karat di toren air rumah, ruko, &amp; gedung wilayah {{ $locationName }}. Sterilisasi 100% food-grade safety tanpa bahan kimia korosif.
            </p>

            {{-- Dispatch & Arrival Metrics --}}
            <div class="inline-flex flex-wrap justify-center items-center gap-3 sm:gap-6 bg-slate-800/80 backdrop-blur-md px-5 py-3 rounded-2xl border border-slate-700/80 mb-8 text-xs font-semibold text-slate-200">
                <span class="flex items-center gap-1.5 text-emerald-400">
                    <span>🟢</span> Respon Cepat {{ $estimatedArrival }}
                </span>
                <span class="hidden sm:inline text-slate-600">•</span>
                <span class="flex items-center gap-1.5 text-cyan-300">
                    <span>📍</span> {{ $dispatchHub }}
                </span>
                <span class="hidden sm:inline text-slate-600">•</span>
                <span class="flex items-center gap-1.5 text-teal-300">
                    <span>🛡️</span> Garansi Air Jernih
                </span>
            </div>

            {{-- Action Buttons --}}
            <div class="flex flex-col sm:flex-row justify-center gap-3">
                <a href="https://wa.me/6281385404000?text={{ urlencode("Halo Rootera Plumbing, saya ingin pesan Jasa Cuci Toren & Kuras Tandon Air di area {$locationName}") }}" target="_blank" rel="noopener" class="bg-[#25D366] hover:bg-[#1EBE5A] text-white font-bold text-xs sm:text-sm py-3.5 px-8 rounded-full flex items-center justify-center gap-2 shadow-lg hover:-translate-y-0.5 transition-all">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    <span>Pesan Cuci Toren {{ $locationShort }}</span>
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

        {{-- MASALAH UTAMA TOREN & KUALITAS AIR LOKAL --}}
        <div class="mb-16">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-emerald-600 font-bold text-xs uppercase tracking-wider">Sanitasi Air Bersih {{ $locationShort }}</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mt-1">Masalah Toren Air yang Kami Atasi di {{ $locationShort }}</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-slate-50 p-6 rounded-3xl border border-slate-200/90 space-y-2">
                    <div class="text-2xl">🌿</div>
                    <h3 class="font-extrabold text-slate-900 text-base">Lumut Tebal &amp; Licin</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">Pembersihan sikat rotasi rontokkan lumut tebal yang menempel di dinding tangki PE &amp; Stainless Steel.</p>
                </div>
                <div class="bg-slate-50 p-6 rounded-3xl border border-slate-200/90 space-y-2">
                    <div class="text-2xl">🟡</div>
                    <h3 class="font-extrabold text-slate-900 text-base">Air Kuning &amp; Bau Karat</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">Pengurasan total zat besi dan endapan sedimen air tanah di kawasan {{ $locationShort }}.</p>
                </div>
                <div class="bg-slate-50 p-6 rounded-3xl border border-slate-200/90 space-y-2">
                    <div class="text-2xl">⏳</div>
                    <h3 class="font-extrabold text-slate-900 text-base">Lumpur &amp; Pasir Dasar</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">Penyedotan pasir halus &amp; lumpur mengendap yang sering menyumbat saringan filter toren.</p>
                </div>
                <div class="bg-slate-50 p-6 rounded-3xl border border-slate-200/90 space-y-2">
                    <div class="text-2xl">🦟</div>
                    <h3 class="font-extrabold text-slate-900 text-base">Jentik &amp; Cacing Air</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">Sterilisasi komprehensif membasmi jentik nyamuk dan sisa serangga mati penyebab air apek.</p>
                </div>
            </div>
        </div>

        {{-- SIBLING INTERNAL LINKING (SPOKE LINKS) --}}
        @if($siblingDistricts->isNotEmpty())
        <div class="mb-16 bg-slate-50 p-8 rounded-3xl border border-slate-200">
            <div class="mb-6">
                <span class="text-emerald-600 font-bold text-xs uppercase tracking-wider">Geotargeting Presisi {{ $city->name }}</span>
                <h3 class="text-xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mt-0.5">Area Jasa Cuci Toren Sekitar {{ $locationShort }}</h3>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                @foreach($siblingDistricts as $sib)
                <a href="{{ url("/layanan-cuci-toren/{$city->slug}/{$sib->slug}") }}" class="flex items-center gap-2 p-3 bg-white rounded-xl border border-slate-200 hover:border-emerald-500 hover:shadow-xs transition-all text-xs font-bold text-slate-800 hover:text-emerald-600">
                    <span class="text-emerald-500">🚰</span>
                    <span class="truncate">Cuci Toren {{ $sib->name }}</span>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- REGIONAL CITIES LINKING --}}
        @if($siblingCities->isNotEmpty())
        <div class="mb-16">
            <div class="mb-6">
                <span class="text-emerald-600 font-bold text-xs uppercase tracking-wider">Cakupan Wilayah {{ $city->province ? $city->province->name : 'Provinsi' }}</span>
                <h3 class="text-xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mt-0.5">Kota &amp; Kabupaten Terdekat</h3>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                @foreach($siblingCities as $sc)
                <a href="{{ url("/jasa-cuci-toren/{$sc->slug}") }}" class="flex items-center gap-2 p-3 bg-slate-50 rounded-xl border border-slate-200 hover:border-emerald-500 transition-all text-xs font-bold text-slate-800 hover:text-emerald-600">
                    <span class="text-cyan-500">📍</span>
                    <span class="truncate">Cuci Toren {{ $sc->name }}</span>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- LOCAL FAQ ACCORDION --}}
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-8">
                <span class="text-emerald-600 font-bold text-xs uppercase tracking-wider">FAQ Lokasi {{ $locationShort }}</span>
                <h3 class="text-2xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mt-1">Tanya-Jawab Cuci Toren {{ $locationName }}</h3>
            </div>

            <div class="space-y-4" x-data="{ activeFaq: null }">
                @foreach($localFaqs as $idx => $lf)
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button type="button" @click="activeFaq = (activeFaq === {{ $idx }} ? null : {{ $idx }})" class="w-full p-5 text-left font-bold text-slate-900 text-sm flex justify-between items-center gap-4 hover:bg-slate-50 transition-colors focus:outline-none min-h-[48px]">
                        <span>{{ $lf['question'] }}</span>
                        <span class="text-emerald-600 font-extrabold text-lg shrink-0" x-text="activeFaq === {{ $idx }} ? '−' : '+'">+</span>
                    </button>
                    <div x-show="activeFaq === {{ $idx }}" x-collapse class="px-5 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-4">
                        {{ $lf['answer'] }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>
@endsection
