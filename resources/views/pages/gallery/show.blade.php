@extends('layouts.app')

@php
    $plumbingSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'PlumbingService',
        'name' => 'Rootera Plumbing',
        'image' => $project->display_thumbnail,
        'url' => route('galeri.show', $project->slug),
        'telephone' => '+6281385404000',
        'priceRange' => '$$',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'Gg. Mawar No.6B.1, Cijantung',
            'addressLocality' => 'Jakarta Timur',
            'addressRegion' => 'DKI Jakarta',
            'postalCode' => '13770',
            'addressCountry' => 'ID',
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => -6.3134,
            'longitude' => 106.8625,
        ],
        'areaServed' => $project->related_area_name,
        'description' => $seo['description'] ?? $project->title,
    ];

    $breadcrumbSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Beranda',
                'item' => route('home'),
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Galeri & Dokumentasi',
                'item' => route('galeri'),
            ],
            [
                '@type' => 'ListItem',
                'position' => 3,
                'name' => $project->title,
                'item' => route('galeri.show', $project->slug),
            ],
        ],
    ];

    $faqSchema = [];
    if (!empty($project->faq_items)) {
        $mainEntity = [];
        foreach ($project->faq_items as $faq) {
            $mainEntity[] = [
                '@type' => 'Question',
                'name' => $faq['q'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['a'],
                ],
            ];
        }
        $faqSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $mainEntity,
        ];
    }

    $videoSchema = [];
    if ($project->media_type === 'video' && $project->display_media) {
        $videoSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'VideoObject',
            'name' => $project->title,
            'description' => $project->problem_statement ?? $project->title,
            'thumbnailUrl' => [$project->display_thumbnail],
            'contentUrl' => $project->display_media,
            'embedUrl' => route('galeri.show', $project->slug),
            'uploadDate' => $project->created_at ? $project->created_at->toIso8601String() : '2026-08-25T08:00:00+07:00',
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Rootera Plumbing',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp')
                ]
            ]
        ];
    }

    $imageSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'ImageObject',
        'name' => $project->title,
        'description' => $seo['description'] ?? $project->title,
        'contentUrl' => $project->display_thumbnail,
        'url' => route('galeri.show', $project->slug),
        'author' => [
            '@type' => 'Organization',
            'name' => 'Rootera Plumbing'
        ]
    ];
@endphp

@push('head')
<script type="application/ld+json">
{!! json_encode($plumbingSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

<script type="application/ld+json">
{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

<script type="application/ld+json">
{!! json_encode($imageSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

@if(!empty($faqSchema))
<script type="application/ld+json">
{!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endif

@if(!empty($videoSchema))
<script type="application/ld+json">
{!! json_encode($videoSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endif
@endpush

@section('content')
{{-- FIELD ENGINEERING REPORT HERO HEADER --}}
<div class="relative overflow-hidden bg-slate-950 text-white py-10 sm:py-16 border-b border-slate-800">
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container max-w-6xl mx-auto px-4 sm:px-6 relative z-10">
        {{-- BREADCRUMBS --}}
        <nav class="text-xs sm:text-sm text-slate-400 mb-4 sm:mb-6 flex flex-wrap items-center gap-2 font-medium" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors no-underline">Beranda</a>
            <span class="text-slate-600">/</span>
            <a href="{{ route('galeri') }}" class="hover:text-emerald-400 transition-colors no-underline">Galeri Studi Kasus</a>
            <span class="text-slate-600">/</span>
            <span class="text-slate-200 font-semibold truncate max-w-[200px] sm:max-w-md">{{ $project->title }}</span>
        </nav>

        {{-- ENGINEERING HUD STATUS BADGES --}}
        <div class="flex flex-wrap items-center gap-2 mb-4">
            <span class="bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 text-xs font-black px-3 py-1 rounded-full uppercase tracking-wider shadow-sm flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Laporan Inspeksi &amp; Pelancaran Resmi</span>
            </span>
            <span class="bg-slate-900 border border-slate-800 text-slate-300 text-xs font-extrabold px-3 py-1 rounded-full">
                🏷️ {{ $project->category_label }}
            </span>
            <span class="bg-emerald-500/20 border border-emerald-400/40 text-emerald-300 text-xs font-bold px-3 py-1 rounded-full">
                🛡️ Garansi {{ $project->warranty_days ?? 30 }} Hari Active
            </span>
            <span class="bg-slate-900 border border-slate-800 text-slate-200 text-xs font-medium px-3 py-1 rounded-full flex items-center gap-1">
                📍 {{ $project->related_area_name }}
            </span>
            <span class="bg-cyan-500/15 border border-cyan-400/30 text-cyan-300 text-xs font-medium px-3 py-1 rounded-full">
                🏢 Tipe: {{ $project->project_client_type }}
            </span>
        </div>

        {{-- TITLE & METADATA --}}
        <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-4">
            {{ $project->title }}
        </h1>

        <div class="text-xs sm:text-sm text-slate-400 flex flex-wrap items-center gap-4 sm:gap-6 font-medium">
            <span class="flex items-center gap-1.5 text-slate-300">
                📅 Tanggal Pengerjaan: <strong class="text-white">{{ $project->created_at ? $project->created_at->format('d F Y') : 'Terbaru' }}</strong>
            </span>
            <span class="flex items-center gap-1.5 text-slate-300">
                🛡️ Verifikasi: <strong class="text-emerald-400">Tim Teknik Rootera Plumbing</strong>
            </span>
        </div>
    </div>
</div>

{{-- MAIN CONTENT SECTION --}}
<section class="py-8 sm:py-14 bg-slate-50 min-h-screen">
    <div class="container max-w-6xl mx-auto px-4 sm:px-6">
        
        {{-- VISUAL HUB: INTERACTIVE BEFORE-AFTER SLIDER / VIDEO PLAYER / FEATURED PHOTO --}}
        <div class="mb-8 sm:mb-12">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-2">
                    <span class="text-lg">👁️</span>
                    <h2 class="text-base sm:text-xl font-extrabold text-slate-900">Visual Evidence &amp; Komparasi Pengerjaan</h2>
                </div>
                <span class="text-xs text-slate-500 font-semibold hidden sm:block">
                    ✓ Terverifikasi Tanpa Merusak Keramik
                </span>
            </div>

            @if($project->media_type === 'video' && $project->display_media)
                <div class="relative aspect-video max-h-[540px] bg-slate-950 rounded-2xl sm:rounded-3xl overflow-hidden border border-slate-800 shadow-2xl flex items-center justify-center">
                    <video controls playsinline preload="metadata" poster="{{ $project->display_thumbnail }}" title="{{ $project->title }} - Rootera Plumbing" class="w-full h-full object-contain">
                        <source src="{{ $project->display_media }}" type="video/mp4">
                        Browser Anda tidak mendukung pemutaran video.
                    </video>
                </div>
            @elseif($project->display_before_image)
                {{-- PURE ALPINE.JS INTERACTIVE BEFORE-AFTER SLIDER --}}
                <x-before-after-slider 
                    :beforeImage="$project->display_before_image" 
                    :afterImage="$project->display_thumbnail" 
                    :title="$project->title"
                    aspectRatio="aspect-[16/10] sm:aspect-[16/9] max-h-[540px]" />
            @else
                <div class="relative aspect-[16/9] max-h-[540px] overflow-hidden bg-slate-950 rounded-2xl sm:rounded-3xl border border-slate-800 shadow-2xl flex items-center justify-center">
                    <img src="{{ $project->display_thumbnail }}" alt="Dokumentasi Pekerjaan - {{ $project->title }}" title="{{ $project->title }} - Rootera Plumbing" class="w-full h-full object-cover">
                </div>
            @endif
        </div>

        {{-- TECHNICAL PARAMETERS HUD BOX (GRID METRICS) --}}
        <div class="mb-8 sm:mb-12">
            <div class="bg-slate-950 text-white p-6 sm:p-8 rounded-2xl sm:rounded-3xl border border-slate-800 shadow-2xl">
                <div class="flex flex-wrap items-center justify-between gap-2 mb-6 pb-4 border-b border-slate-800">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
                        <h3 class="text-base sm:text-xl font-extrabold text-white">Parameter Lapangan &amp; Spesifikasi Teknik</h3>
                    </div>
                    <span class="text-xs text-slate-400 font-semibold">
                        Kode Proyek: #RT-{{ str_pad($project->id, 5, '0', STR_PAD_LEFT) }}
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    {{-- METRIC 1: ALAT UTAMA --}}
                    <div class="bg-slate-900 border border-slate-800 p-4 rounded-xl flex items-start gap-3">
                        <div class="w-10 h-10 rounded-lg bg-blue-500/15 border border-blue-500/30 text-blue-400 flex items-center justify-center text-lg shrink-0">
                            🛠️
                        </div>
                        <div>
                            <div class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Peralatan Utama</div>
                            <div class="text-xs sm:text-sm font-extrabold text-blue-300 mt-0.5">
                                {{ $project->tool_used ?: 'Mesin Spiral Rotary Ridgid' }}
                            </div>
                        </div>
                    </div>

                    {{-- METRIC 2: SPESIFIKASI PIPA & PANJANG --}}
                    <div class="bg-slate-900 border border-slate-800 p-4 rounded-xl flex items-start gap-3">
                        <div class="w-10 h-10 rounded-lg bg-indigo-500/15 border border-indigo-500/30 text-indigo-400 flex items-center justify-center text-lg shrink-0">
                            📏
                        </div>
                        <div>
                            <div class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Spesifikasi Pipa</div>
                            <div class="text-xs sm:text-sm font-extrabold text-indigo-300 mt-0.5">
                                {{ $project->pipe_specs ?: 'Pipa PVC Standard' }}
                                @if($project->pipe_length)
                                    <span class="block text-[11px] text-slate-400 font-normal">Panjang: {{ $project->pipe_length }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- METRIC 3: DURASI PENGERJAAN --}}
                    <div class="bg-slate-900 border border-slate-800 p-4 rounded-xl flex items-start gap-3">
                        <div class="w-10 h-10 rounded-lg bg-purple-500/15 border border-purple-500/30 text-purple-400 flex items-center justify-center text-lg shrink-0">
                            ⏱️
                        </div>
                        <div>
                            <div class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Durasi Pengerjaan</div>
                            <div class="text-xs sm:text-sm font-extrabold text-purple-300 mt-0.5">
                                {{ $project->completion_time ?: '30-45 Menit' }}
                            </div>
                        </div>
                    </div>

                    {{-- METRIC 4: GARANSI TERTULIS --}}
                    <div class="bg-slate-900 border border-slate-800 p-4 rounded-xl flex items-start gap-3">
                        <div class="w-10 h-10 rounded-lg bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 flex items-center justify-center text-lg shrink-0">
                            🛡️
                        </div>
                        <div>
                            <div class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Garansi Resmi</div>
                            <div class="text-xs sm:text-sm font-extrabold text-emerald-400 mt-0.5">
                                Garansi {{ $project->warranty_days ?? 30 }} Hari
                            </div>
                        </div>
                    </div>
                </div>

                @if($project->cost_estimate)
                <div class="mt-4 pt-4 border-t border-slate-800 flex items-center justify-between text-xs sm:text-sm">
                    <span class="text-slate-400 font-medium">💰 Estimasi Biaya Pengerjaan Transparan:</span>
                    <span class="font-extrabold text-emerald-400 text-sm sm:text-base">Rp {{ number_format($project->cost_estimate, 0, ',', '.') }}</span>
                </div>
                @endif
            </div>
        </div>

        {{-- ENGINEERING BREAKDOWN: PROBLEM vs SOLUTION --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8 sm:mb-12">
            {{-- ANALISIS PENYEBAB & KENDALA SUMBATAN --}}
            <div class="bg-white p-6 sm:p-8 rounded-2xl sm:rounded-3xl border border-slate-200/90 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="inline-flex items-center gap-2 text-rose-600 font-bold text-xs uppercase tracking-wider mb-2">
                        <span class="w-2 h-2 rounded-full bg-rose-600"></span>
                        Tantangan &amp; Kendala Lapangan
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-3">Diagnosa Kasus Sumbatan Pipa</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed whitespace-pre-line mb-4">
                        {{ $project->problem_statement }}
                    </p>

                    @if($project->technical_diagnosis)
                    <div class="bg-amber-50 border border-amber-200 p-3.5 rounded-xl text-xs text-amber-900 leading-relaxed mb-4">
                        <span class="font-extrabold block mb-1">🔬 Diagnosa Inspeksi CCTV &amp; Lapangan:</span>
                        {{ $project->technical_diagnosis }}
                    </div>
                    @endif
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center gap-2 text-xs text-rose-700 bg-rose-50 p-3.5 rounded-xl font-semibold">
                    <span>⚠️ Risiko Jika Dibiarkan:</span>
                    <span>Meluap ke area lantai, merusak plafon/ubin, &amp; memicu bau tak sedap.</span>
                </div>
            </div>

            {{-- METODOLOGI SOLUSI & EKSEKUSI TANPA BONGKAR --}}
            <div class="bg-white p-6 sm:p-8 rounded-2xl sm:rounded-3xl border border-slate-200/90 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="inline-flex items-center gap-2 text-emerald-600 font-bold text-xs uppercase tracking-wider mb-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                        Metodologi &amp; Solusi Rekayasa
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-3">Tindakan Pelancaran Tanpa Bongkar</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed whitespace-pre-line mb-4">
                        {{ $project->solution_and_action }}
                    </p>

                    <div class="bg-emerald-50 border border-emerald-200 p-3.5 rounded-xl text-xs text-emerald-900 leading-relaxed mb-4">
                        <span class="font-extrabold block mb-1">✅ Hasil Pembersihan:</span>
                        Endapan lemak beku &amp; kotoran berhasil dihancurkan 100%. Saluran pipa kembali mengalir lancar dengan debit penuh.
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center gap-2 text-xs text-emerald-700 bg-emerald-50 p-3.5 rounded-xl font-semibold">
                    <span>🛡️ Jaminan Mutu:</span>
                    <span>Bergaransi tertulis 30 hari. Bebas biaya panggil ulang jika pipa kembali mampet.</span>
                </div>
            </div>
        </div>

        {{-- CONTEXTUAL WHATSAPP BOOKING CTA BOX --}}
        <div class="bg-slate-950 text-white p-6 sm:p-10 rounded-2xl sm:rounded-3xl border border-slate-800 shadow-2xl mb-8 sm:mb-12 flex flex-col lg:flex-row items-center justify-between gap-6 relative overflow-hidden">
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="max-w-2xl relative z-10">
                <div class="inline-flex items-center gap-2 bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 text-xs font-bold px-3 py-1 rounded-full uppercase mb-3">
                    💬 Konsultasi &amp; Penanganan Cepat 24 Jam
                </div>
                <h3 class="text-xl sm:text-3xl font-extrabold text-white leading-tight mb-2">
                    Mengalami Masalah Saluran Pipa Serupa di {{ $project->related_area_name }}?
                </h3>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                    Hubungi tim teknisi profesional Rootera Plumbing. Konsultasi gratis, tanpa bongkar ubin, &amp; garansi pengerjaan 30 hari pasca pelancaran.
                </p>
            </div>

            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya membaca laporan studi kasus [' . $project->title . ']. Saya memiliki masalah saluran pipa serupa dan ingin konsultasi/panggil teknisi.') }}" 
               target="_blank" 
               rel="noopener noreferrer" 
               class="relative z-10 shrink-0 bg-emerald-500 hover:bg-emerald-600 text-white font-black text-xs sm:text-sm px-6 py-4 rounded-full shadow-xl shadow-emerald-500/25 transition-all hover:scale-105 active:scale-95 flex items-center gap-2 no-underline">
                <span class="text-lg">💬</span>
                <span>Panggil Teknisi Kasus Serupa →</span>
            </a>
        </div>

        {{-- STANDAR TEKNOLOGI & PERALATAN CANGGIH COMPONENT --}}
        <x-equipment-showcase class="mb-8 sm:mb-12" />

        {{-- INTERNAL LINK AREA - PANGGIL TEKNISI TERDEKAT --}}
        <div class="bg-blue-50 border border-blue-200/80 p-6 sm:p-8 rounded-2xl mb-8 sm:mb-12 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-600 text-white flex items-center justify-center text-2xl shrink-0 shadow-md">
                    📍
                </div>
                <div>
                    <h3 class="text-base sm:text-lg font-extrabold text-slate-900 mb-1">
                        Butuh Teknisi Pelancar Pipa di Area {{ $project->related_area_name }}?
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Tim teknisi Rootera Plumbing siap meluncur ke lokasi Anda di {{ $project->related_area_name }} dengan respon cepat 24 jam &amp; garansi resmi 30 hari.
                    </p>
                </div>
            </div>
            <a href="{{ $project->related_area_url }}" class="shrink-0 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs sm:text-sm px-5 py-3 rounded-xl transition-all shadow-md flex items-center gap-1.5 no-underline">
                <span>Lihat Area {{ $project->related_area_name }}</span> →
            </a>
        </div>

        {{-- TAG WILAYAH & KATA KUNCI TERKAIT --}}
        <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/90 shadow-sm mb-8 sm:mb-12">
            <div class="flex items-center gap-2 mb-3">
                <span class="text-xl">🏷️</span>
                <h3 class="text-base sm:text-lg font-extrabold text-slate-900">Tag Wilayah &amp; Kata Kunci Pencarian Populer</h3>
            </div>
            <p class="text-xs sm:text-sm text-slate-500 mb-4 leading-relaxed">
                Eksplorasi jangkauan area &amp; kata kunci terkait di kawasan <span class="font-bold text-slate-700">{{ $project->related_area_name }}</span>:
            </p>
            <div class="flex flex-wrap gap-2">
                @foreach($project->popular_tags as $tag)
                <a href="{{ $tag['url'] }}" class="rounded-full border border-slate-200 bg-white text-slate-700 text-xs sm:text-sm font-medium px-3.5 py-1.5 shadow-xs hover:border-emerald-500 hover:text-emerald-600 hover:bg-emerald-50/50 transition-all duration-200 inline-flex items-center gap-1 no-underline">
                    <span>📍</span> {{ $tag['label'] }}
                </a>
                @endforeach
            </div>
        </div>

        {{-- FAQ RELEVAN ACCORDION --}}
        <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/90 shadow-sm mb-8 sm:mb-12">
            <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 mb-4">❓ Pertanyaan Sering Diajukan (FAQ)</h3>
            <div class="space-y-3" id="faq-accordion">
                @foreach($project->faq_items as $index => $faq)
                <div class="border border-slate-200 rounded-xl overflow-hidden transition-colors">
                    <button type="button" onclick="toggleFaq({{ $index }})" class="w-full p-4 text-left font-bold text-xs sm:text-sm text-slate-800 flex items-center justify-between bg-slate-50 hover:bg-slate-100 transition-colors">
                        <span>{{ $faq['q'] }}</span>
                        <span id="faq-icon-{{ $index }}" class="text-base font-semibold text-slate-500 ml-2">+</span>
                    </button>
                    <div id="faq-body-{{ $index }}" class="hidden p-4 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 bg-white">
                        {{ $faq['a'] }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- RELATED PROJECTS --}}
        @if($relatedProjects->isNotEmpty())
        <div>
            <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 mb-4">📸 Dokumentasi Proyek Terkait Lainnya</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedProjects as $rel)
                <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/90 shadow-sm hover:shadow-lg transition-all flex flex-col h-full group">
                    <a href="{{ route('galeri.show', $rel->slug) }}" class="block aspect-[16/10] overflow-hidden relative bg-slate-950 no-underline">
                        <img src="{{ $rel->display_thumbnail }}" alt="{{ $rel->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </a>
                    <div class="p-4 flex flex-col flex-grow justify-between">
                        <h4 class="text-xs sm:text-sm font-bold text-slate-900 line-clamp-2 mb-2 leading-snug group-hover:text-emerald-600 transition-colors">
                            <a href="{{ route('galeri.show', $rel->slug) }}" class="text-inherit no-underline">
                                {{ $rel->title }}
                            </a>
                        </h4>
                        <a href="{{ route('galeri.show', $rel->slug) }}" class="text-xs font-bold text-slate-700 hover:text-emerald-600 flex items-center gap-1 mt-auto no-underline">
                            <span>Laporan Teknis</span> →
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>

{{-- STICKY FLOATING CTA (MOBILE-FRIENDLY) --}}
<div class="fixed bottom-4 left-4 right-4 z-50 md:hidden">
    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya membaca laporan studi kasus [' . $project->title . ']. Saya memiliki masalah saluran pipa serupa dan ingin konsultasi/panggil teknisi.') }}" 
       target="_blank" 
       rel="noopener noreferrer" 
       class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-black text-xs sm:text-sm py-3.5 px-4 rounded-full shadow-2xl flex items-center justify-center gap-2 backdrop-blur-md no-underline active:scale-95 transition-all">
        <span class="text-lg">💬</span>
        <span>Konsultasi Kasus Serupa via WhatsApp</span>
    </a>
</div>
@endsection

@push('scripts')
<script>
function toggleFaq(index) {
    const body = document.getElementById(`faq-body-${index}`);
    const icon = document.getElementById(`faq-icon-${index}`);
    
    if (body.classList.contains('hidden')) {
        body.classList.remove('hidden');
        icon.textContent = '−';
    } else {
        body.classList.add('hidden');
        icon.textContent = '+';
    }
}
</script>
@endpush
