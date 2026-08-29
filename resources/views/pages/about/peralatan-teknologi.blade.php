@extends('layouts.app')

@section('schema-markup')
<?php
$techItemList = [];
if (isset($technologies) && $technologies->isNotEmpty()) {
    foreach ($technologies as $index => $tech) {
        $techItemList[] = [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'url' => url('/peralatan-teknologi/' . $tech->slug),
            'name' => $tech->tool_name,
            'description' => $tech->main_advantage ?? $tech->description
        ];
    }
}

$schemaData = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'WebPage',
            '@id' => url('/tentang-kami/peralatan-teknologi') . '#webpage',
            'url' => url('/tentang-kami/peralatan-teknologi'),
            'name' => $seo['title'] ?? 'Armada Mesin Rooter & Hydro Jetting Modern | Rootera',
            'description' => $seo['description'] ?? '',
            'breadcrumb' => [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => url('/')],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => 'Tentang Kami', 'item' => url('/tentang-kami')],
                    ['@type' => 'ListItem', 'position' => 3, 'name' => 'Peralatan & Teknologi', 'item' => url('/tentang-kami/peralatan-teknologi')]
                ]
            ]
        ],
        [
            '@type' => 'ItemList',
            'name' => 'Daftar Armada Mesin & Alat Pelancar Pipa Rootera Plumbing',
            'itemListElement' => $techItemList
        ],
        [
            '@type' => 'FAQPage',
            'mainEntity' => [
                [
                    '@type' => 'Question',
                    'name' => 'Apakah Kabel Spiral Mesin Ridgid Berisiko Merusak Pipa PVC?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Tidak. Kabel spiral baja fleksibel kami dirancang khusus meliuk mengikuti lekukan pipa tanpa merusak atau mengikis lapisan dinding pipa PVC rumah tangga maupun pipa industri.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Kapan Hydro Jetting Diperlukan?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Hydro Jetting (tekanan air hingga 300 Bar) digunakan pada kasus lemak jenuh mengeras di restoran, sedimen pasir/lumpur padat, serta pipa pembuangan diameter besar (4-12 inci) agar bersih 100% seperti pipa baru.'
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
{{-- Hero Section --}}
<div class="relative bg-gradient-to-b from-slate-900 via-[#070F1E] to-slate-900 text-white pt-20 pb-16 sm:pt-24 sm:pb-20 overflow-hidden border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex justify-center items-center gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <span class="text-slate-500">/</span>
            <a href="{{ route('tentang-kami') }}" class="hover:text-emerald-400 transition-colors">Tentang Kami</a>
            <span class="text-slate-500">/</span>
            <span class="text-emerald-400 font-semibold">Peralatan &amp; Teknologi</span>
        </nav>

        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 mb-4 backdrop-blur-md">
                🛠️ STANDAR INTERNASIONAL TANPA BONGKAR
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white mb-5 font-['Plus_Jakarta_Sans',sans-serif] leading-tight">
                Armada Mesin Rooter &amp; <span class="bg-gradient-to-r from-emerald-400 to-cyan-400 bg-clip-text text-transparent">Hydro Jetting Modern</span>
            </h1>
            <p class="text-slate-300 text-xs sm:text-base leading-relaxed max-w-2xl mx-auto">
                Katalog spesifikasi resmi teknologi pelancaran pipa tersumbat berstandar internasional yang aman bagi saluran PVC, cast iron, dan struktur semen properti Anda.
            </p>
        </div>
    </div>
</div>

<section class="py-12 sm:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Section 1: Technical Specs Comparison Table --}}
        <div class="mb-14 sm:mb-20">
            <div class="text-center max-w-2xl mx-auto mb-6 sm:mb-10">
                <span class="text-emerald-600 font-bold text-xs uppercase tracking-wider">Tabel Komparasi Teknis</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mt-1">Spesifikasi Teknis Peralatan Rootera</h2>
            </div>

            {{-- Mobile Swipe Indicator Banner --}}
            <div class="block md:hidden mb-3 text-center">
                <span class="inline-flex items-center gap-1.5 text-[11px] font-bold text-slate-500 bg-slate-100 px-3 py-1 rounded-full border border-slate-200">
                    <span>←</span> Geser tabel untuk melihat spesifikasi lengkap <span>→</span>
                </span>
            </div>

            {{-- Responsive Table Container with Horizontal Scroll --}}
            <div class="overflow-x-auto rounded-2xl border border-slate-200 shadow-xs bg-white">
                <table class="w-full text-left text-xs sm:text-sm text-slate-700 border-collapse min-w-[700px]">
                    <thead class="bg-slate-900 text-white font-bold uppercase text-[11px] tracking-wider">
                        <tr>
                            <th class="p-4 sticky left-0 bg-slate-900 z-10 shadow-xs min-w-[180px]">Jenis Peralatan</th>
                            <th class="p-4 min-w-[150px]">Tipe &amp; Brand</th>
                            <th class="p-4 min-w-[200px]">Spesifikasi Utama</th>
                            <th class="p-4 min-w-[180px]">Peruntukan Utama</th>
                            <th class="p-4 min-w-[220px]">Keunggulan Utama</th>
                            <th class="p-4 text-center min-w-[100px]">Detail</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse($technologies as $tech)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="p-4 font-bold text-slate-900 sticky left-0 bg-white shadow-xs z-10">
                                <a href="{{ route('technologies.show', $tech->slug) }}" class="hover:text-emerald-600 flex items-center gap-2">
                                    <span>🛠️</span> {{ $tech->tool_name }}
                                </a>
                            </td>
                            <td class="p-4 font-semibold text-emerald-700">{{ $tech->type_brand ?? '-' }}</td>
                            <td class="p-4">{{ $tech->main_spec ?? '-' }}</td>
                            <td class="p-4">{{ $tech->pipe_target ?? '-' }}</td>
                            <td class="p-4 text-emerald-700 font-semibold">{{ $tech->main_advantage ?? '-' }}</td>
                            <td class="p-4 text-center">
                                <a href="{{ route('technologies.show', $tech->slug) }}" class="inline-flex items-center text-xs font-bold text-emerald-600 hover:text-emerald-800 bg-emerald-50 hover:bg-emerald-100 px-2.5 py-1 rounded-md transition-colors">
                                    Lihat →
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-slate-400 font-medium">Belum ada data spesifikasi peralatan terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Section 2: Equipment Showcase Grid Cards --}}
        <div>
            <div class="text-center max-w-2xl mx-auto mb-8 sm:mb-12">
                <span class="text-emerald-600 font-bold text-xs uppercase tracking-wider">Katalog Armada Mesin</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mt-1">Armada Alat Resmi Rootera Plumbing</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($technologies as $tech)
                <div class="group bg-white rounded-3xl border border-slate-200/90 overflow-hidden shadow-xs hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
                    {{-- Image Container --}}
                    <div class="relative aspect-[4/3] bg-slate-900 overflow-hidden">
                        <img src="{{ $tech->image_url }}" alt="{{ $tech->tool_name }} - Rootera Plumbing" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" decoding="async" width="400" height="300">
                        <div class="absolute top-3 left-3 z-10">
                            <span class="bg-emerald-600/95 backdrop-blur-md text-white text-[10px] sm:text-xs font-bold px-2.5 py-1 rounded-full shadow-xs uppercase">
                                ✓ {{ $tech->badge_text ?? 'ALAT RESMI' }}
                            </span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-5 sm:p-6 flex flex-col flex-grow justify-between">
                        <div>
                            <h3 class="text-base sm:text-lg font-extrabold text-slate-900 group-hover:text-emerald-600 transition-colors mb-2 font-['Plus_Jakarta_Sans',sans-serif] line-clamp-2">
                                <a href="{{ route('technologies.show', $tech->slug) }}">
                                    {{ $tech->tool_name }}
                                </a>
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-4 line-clamp-3">
                                {{ $tech->description ?? ($tech->main_advantage ?? 'Peralatan modern pelancar saluran mampet presisi.') }}
                            </p>
                        </div>

                        {{-- Action Link --}}
                        <div class="pt-4 border-t border-slate-100 mt-auto">
                            <a href="{{ route('technologies.show', $tech->slug) }}" class="inline-flex items-center justify-between w-full text-xs font-bold text-emerald-600 hover:text-emerald-800 transition-colors group-hover:translate-x-0.5">
                                <span>Pelajari Spesifikasi &amp; Cara Kerja</span>
                                <span class="text-sm">→</span>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>

{{-- Section 3: FAQ Peralatan --}}
<section class="py-12 sm:py-16 bg-slate-50 border-t border-slate-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-8 sm:mb-10">
            <span class="text-emerald-600 font-bold text-xs uppercase tracking-wider">Informasi Teknis</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mt-1">Keunggulan Metode Mekanis Modern</h2>
            <p class="text-slate-600 mt-2 text-xs sm:text-sm">Mengapa peralatan modern Rootera jauh lebih unggul dibandingkan metode manual atau cairan kimia korosif.</p>
        </div>
        <div class="space-y-4">
            <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200 shadow-xs">
                <h3 class="font-bold text-slate-900 text-sm sm:text-base">Apakah Kabel Spiral Mesin Ridgid Berisiko Merusak Pipa PVC?</h3>
                <p class="text-slate-600 mt-2 text-xs sm:text-sm leading-relaxed">Tidak. Kabel spiral baja fleksibel kami dirancang khusus meliuk mengikuti lekukan pipa tanpa merusak atau mengikis lapisan dinding pipa PVC rumah tangga maupun pipa industri.</p>
            </div>
            <div class="bg-white p-5 sm:p-6 rounded-2xl border border-slate-200 shadow-xs">
                <h3 class="font-bold text-slate-900 text-sm sm:text-base">Kapan Hydro Jetting Diperlukan?</h3>
                <p class="text-slate-600 mt-2 text-xs sm:text-sm leading-relaxed">Hydro Jetting (tekanan air hingga 300 Bar) digunakan pada kasus lemak jenuh mengeras di restoran, sedimen pasir/lumpur padat, serta pipa pembuangan diameter besar (4-12 inci) agar bersih 100% seperti pipa baru.</p>
            </div>
        </div>
    </div>
</section>
@endsection
