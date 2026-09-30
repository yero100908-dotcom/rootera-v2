@extends('layouts.app')

@php
    $galleryVideoSchemas = [];
    if (isset($featuredProject) && $featuredProject && $featuredProject->media_type === 'video' && $featuredProject->display_media) {
        $galleryVideoSchemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'VideoObject',
            'name' => $featuredProject->title,
            'description' => $featuredProject->description ?? $featuredProject->title,
            'thumbnailUrl' => [$featuredProject->display_thumbnail],
            'contentUrl' => $featuredProject->display_media,
            'embedUrl' => route('galeri.show', $featuredProject->slug),
            'uploadDate' => $featuredProject->created_at ? $featuredProject->created_at->toIso8601String() : '2026-08-25T08:00:00+07:00',
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
    if (isset($galleries)) {
        foreach ($galleries as $item) {
            if ($item->media_type === 'video' && $item->display_media) {
                $galleryVideoSchemas[] = [
                    '@context' => 'https://schema.org',
                    '@type' => 'VideoObject',
                    'name' => $item->title,
                    'description' => $item->description ?? $item->title,
                    'thumbnailUrl' => [$item->display_thumbnail],
                    'contentUrl' => $item->display_media,
                    'embedUrl' => route('galeri.show', $item->slug),
                    'uploadDate' => $item->created_at ? $item->created_at->toIso8601String() : '2026-08-25T08:00:00+07:00',
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
        }
    }
    $galleryCollectionParts = [];
    if (isset($galleries)) {
        foreach ($galleries as $gItem) {
            if ($gItem->media_type === 'video' && $gItem->display_media) {
                $galleryCollectionParts[] = [
                    '@type' => 'VideoObject',
                    'name' => $gItem->title,
                    'description' => $gItem->description ?? $gItem->title,
                    'thumbnailUrl' => $gItem->display_thumbnail,
                    'contentUrl' => $gItem->display_media,
                    'url' => route('galeri.show', $gItem->slug),
                ];
            } else {
                $galleryCollectionParts[] = [
                    '@type' => 'ImageObject',
                    'name' => $gItem->title,
                    'description' => $gItem->description ?? $gItem->title,
                    'contentUrl' => $gItem->display_thumbnail,
                    'url' => route('galeri.show', $gItem->slug),
                ];
            }
        }
    }

    $imageGallerySchema = [
        '@context' => 'https://schema.org',
        '@type' => 'ImageGallery',
        'name' => 'Galeri Dokumentasi Riil Rootera Plumbing',
        'description' => 'Kumpulan foto & video riil aksi teknisi pelancaran pipa mampet tanpa bongkar di Jabodetabek.',
        'url' => route('galeri'),
        'hasPart' => $galleryCollectionParts,
    ];
@endphp

@push('head')
@if(!empty($seo['prev_page_url']))
<link rel="prev" href="{{ $seo['prev_page_url'] }}">
@endif
@if(!empty($seo['next_page_url']))
<link rel="next" href="{{ $seo['next_page_url'] }}">
@endif

<script type="application/ld+json">
{!! json_encode($imageGallerySchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

@foreach($galleryVideoSchemas as $vSchema)
<script type="application/ld+json">
{!! json_encode($vSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endforeach
@endpush

@section('content')
{{-- LUXURY ENGINEERING HERO & HUD STATS SECTION --}}
<div class="relative overflow-hidden bg-slate-950 text-white py-12 sm:py-20 border-b border-slate-800">
    {{-- Ambient Lighting Orbs --}}
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
            <div class="inline-flex items-center gap-2 bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 px-3.5 py-1 rounded-full text-xs font-extrabold uppercase tracking-widest mb-3 shadow-md">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                <span>Dokumentasi Rekayasa Pipa Lapangan</span>
            </div>
            <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight mb-4 text-white">
                Arsip Dokumentasi & <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400">Studi Kasus Rekayasa Pipa</span>
            </h1>
            <p class="text-slate-300 text-xs sm:text-base leading-relaxed max-w-2xl mx-auto">
                Pembuktian teknis riil pelancaran saluran tersumbat 100% tanpa bongkar ubin menggunakan mesin spiral rotary Ridgid, kamera CCTV fiber optic HD, &amp; Hydro Jetting bertekanan tinggi.
            </p>
        </div>

        {{-- METRICS HUD BAR --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4 max-w-4xl mx-auto mb-10 sm:mb-14">
            <div class="bg-slate-900/80 border border-slate-800 p-4 rounded-2xl backdrop-blur-md flex items-center gap-3.5 shadow-lg">
                <div class="w-11 h-11 rounded-xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 flex items-center justify-center text-xl shrink-0">
                    📁
                </div>
                <div>
                    <div class="text-lg font-extrabold text-white">90+ Proyek</div>
                    <div class="text-[11px] text-slate-400 font-medium">Dokumentasi Riil Terverifikasi</div>
                </div>
            </div>

            <div class="bg-slate-900/80 border border-slate-800 p-4 rounded-2xl backdrop-blur-md flex items-center gap-3.5 shadow-lg">
                <div class="w-11 h-11 rounded-xl bg-cyan-500/15 border border-cyan-500/30 text-cyan-400 flex items-center justify-center text-xl shrink-0">
                    🛡️
                </div>
                <div>
                    <div class="text-lg font-extrabold text-white">Garansi 30 Hari</div>
                    <div class="text-[11px] text-slate-400 font-medium">Jaminan Callback Gratis</div>
                </div>
            </div>

            <div class="bg-slate-900/80 border border-slate-800 p-4 rounded-2xl backdrop-blur-md flex items-center gap-3.5 shadow-lg">
                <div class="w-11 h-11 rounded-xl bg-amber-500/15 border border-amber-500/30 text-amber-400 flex items-center justify-center text-xl shrink-0">
                    🚫
                </div>
                <div>
                    <div class="text-lg font-extrabold text-white">Tanpa Bongkar</div>
                    <div class="text-[11px] text-slate-400 font-medium">Aman untuk Keramik &amp; Pipa</div>
                </div>
            </div>
        </div>

        @if($featuredProject)
        {{-- FEATURED SHOWCASE CARD WITH INTERACTIVE SLIDER OR VIDEO --}}
        <div class="bg-slate-900/90 border border-slate-800 rounded-2xl sm:rounded-3xl overflow-hidden backdrop-blur-md shadow-2xl grid grid-cols-1 lg:grid-cols-2 gap-0 w-full max-w-7xl mx-auto">
            <div class="lg:col-span-1 relative bg-slate-950 flex items-center justify-center min-h-[260px] sm:min-h-[340px] lg:min-h-[400px]">
                @if($featuredProject->media_type === 'video' && $featuredProject->display_media)
                    <video autoplay muted loop playsinline poster="{{ $featuredProject->display_thumbnail }}" title="{{ $featuredProject->title }} - Rootera Plumbing" class="w-full h-full object-cover max-h-[440px]">
                        <source src="{{ $featuredProject->display_media }}" type="video/mp4">
                        Browser Anda tidak mendukung video tag.
                    </video>
                @elseif($featuredProject->display_before_image)
                    <x-before-after-slider 
                        :beforeImage="$featuredProject->display_before_image" 
                        :afterImage="$featuredProject->display_thumbnail" 
                        :title="$featuredProject->title"
                        aspectRatio="aspect-[4/3] max-h-[440px]" />
                @else
                    <img src="{{ $featuredProject->display_thumbnail }}" alt="Proyek Unggulan - {{ $featuredProject->title }}" title="{{ $featuredProject->title }} - Rootera Plumbing" class="w-full h-full object-cover max-h-[440px]">
                @endif
                <div class="absolute top-3 left-3 flex flex-wrap gap-1.5 z-10">
                    <span class="bg-amber-400 text-slate-950 text-xs font-black px-2.5 py-1 rounded-md uppercase tracking-wide shadow-md">⭐ Studi Kasus Unggulan</span>
                    <span class="bg-slate-900/90 backdrop-blur-md text-emerald-400 border border-emerald-500/30 text-xs font-bold px-2.5 py-1 rounded-md shadow-md">{{ $featuredProject->category_label }}</span>
                </div>
            </div>

            <div class="lg:col-span-1 p-6 sm:p-8 flex flex-col justify-between bg-slate-900/95 border-t lg:border-t-0 lg:border-l border-slate-800">
                <div>
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                        @if($featuredProject->location_tag)
                        <span class="text-emerald-400 text-xs font-bold flex items-center gap-1">
                            📍 {{ $featuredProject->location_tag }}
                        </span>
                        @endif
                        <span class="text-slate-400 text-xs font-medium">
                            🏢 {{ $featuredProject->project_client_type }}
                        </span>
                    </div>

                    <h2 class="text-lg sm:text-2xl font-bold text-white leading-snug mb-3 hover:text-emerald-400 transition-colors">
                        <a href="{{ route('galeri.show', $featuredProject->slug) }}">
                            {{ $featuredProject->title }}
                        </a>
                    </h2>
                    
                    {{-- Technical Badges --}}
                    <div class="flex flex-wrap gap-1.5 mb-4">
                        @if($featuredProject->tool_used)
                        <span class="bg-blue-500/20 border border-blue-400/30 text-blue-300 text-[11px] font-semibold px-2 py-0.5 rounded-md">
                            🛠️ {{ $featuredProject->tool_used }}
                        </span>
                        @endif
                        @if($featuredProject->pipe_specs)
                        <span class="bg-indigo-500/20 border border-indigo-400/30 text-indigo-300 text-[11px] font-semibold px-2 py-0.5 rounded-md">
                            📏 {{ $featuredProject->pipe_specs }} @if($featuredProject->pipe_length)({{ $featuredProject->pipe_length }})@endif
                        </span>
                        @endif
                        @if($featuredProject->completion_time)
                        <span class="bg-purple-500/20 border border-purple-400/30 text-purple-300 text-[11px] font-semibold px-2 py-0.5 rounded-md">
                            ⏱️ {{ $featuredProject->completion_time }}
                        </span>
                        @endif
                        <span class="bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 text-[11px] font-bold px-2 py-0.5 rounded-md">
                            🛡️ Garansi {{ $featuredProject->warranty_days ?? 30 }} Hari
                        </span>
                    </div>

                    <p class="text-slate-300 text-xs sm:text-sm leading-relaxed mb-6 line-clamp-3">
                        {{ $featuredProject->description }}
                    </p>
                </div>

                <div class="flex flex-wrap items-center justify-between gap-3 pt-4 border-t border-slate-800">
                    <a href="{{ route('galeri.show', $featuredProject->slug) }}" class="bg-emerald-500 hover:bg-emerald-600 text-white text-xs sm:text-sm font-extrabold px-5 py-2.5 rounded-xl transition-all shadow-md shadow-emerald-500/20 flex items-center gap-1.5 no-underline">
                        <span>Baca Laporan Teknis</span> →
                    </a>
                    
                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya membaca laporan proyek unggulan [' . $featuredProject->title . ']. Saya ingin konsultasi masalah serupa.') }}" target="_blank" rel="noopener noreferrer" class="bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs sm:text-sm font-bold px-4 py-2.5 rounded-xl transition-all border border-slate-700 flex items-center gap-1.5 no-underline">
                        💬 Konsultasi Kasus Ini
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

{{-- DYNAMIC FILTER BAR & HYBRID MEDIA GRID SECTION --}}
<section class="py-8 sm:py-14 bg-slate-50 min-h-screen">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- ALPINE.JS RECOVERY TABS / FILTER PILLS --}}
        <div class="relative mb-6 sm:mb-10">
            <div class="flex items-center gap-2 overflow-x-auto no-scrollbar scroll-smooth py-2 px-1 text-xs sm:text-sm font-semibold" id="filter-bar">
                @php
                    $currentCat = request('category', 'all');
                    $currentMedia = request('media_type', 'all');
                    $activeKey = ($currentMedia === 'video') ? 'video' : $currentCat;
                @endphp

                <button type="button" onclick="applyGalleryFilter('all', 'all')" class="filter-pill shrink-0 flex items-center gap-1.5 px-4 py-2 rounded-full border transition-all duration-200 {{ $activeKey === 'all' ? 'active-pill' : 'inactive-pill' }}">
                    <span>✨ Semua Proyek</span>
                    <span class="pill-badge">{{ $counts['all'] ?? 0 }}</span>
                </button>

                <button type="button" onclick="applyGalleryFilter('commercial_resto', 'all')" class="filter-pill shrink-0 flex items-center gap-1.5 px-4 py-2 rounded-full border transition-all duration-200 {{ $activeKey === 'commercial_resto' ? 'active-pill' : 'inactive-pill' }}">
                    <span>🍽️ Komersial &amp; Restoran (B2B)</span>
                    <span class="pill-badge">{{ $counts['commercial_resto'] ?? 0 }}</span>
                </button>

                <button type="button" onclick="applyGalleryFilter('residential', 'all')" class="filter-pill shrink-0 flex items-center gap-1.5 px-4 py-2 rounded-full border transition-all duration-200 {{ $activeKey === 'residential' ? 'active-pill' : 'inactive-pill' }}">
                    <span>🏠 Residensial &amp; Kamar Mandi</span>
                    <span class="pill-badge">{{ $counts['residential'] ?? 0 }}</span>
                </button>

                <button type="button" onclick="applyGalleryFilter('commercial_b2b', 'all')" class="filter-pill shrink-0 flex items-center gap-1.5 px-4 py-2 rounded-full border transition-all duration-200 {{ $activeKey === 'commercial_b2b' ? 'active-pill' : 'inactive-pill' }}">
                    <span>🏢 Hydro Jetting Bertekanan</span>
                    <span class="pill-badge">{{ $counts['commercial_b2b'] ?? 0 }}</span>
                </button>

                <button type="button" onclick="applyGalleryFilter('cctv_inspection', 'all')" class="filter-pill shrink-0 flex items-center gap-1.5 px-4 py-2 rounded-full border transition-all duration-200 {{ $activeKey === 'cctv_inspection' ? 'active-pill' : 'inactive-pill' }}">
                    <span>📹 Inspeksi CCTV Pipa</span>
                    <span class="pill-badge">{{ $counts['cctv_inspection'] ?? 0 }}</span>
                </button>

                <button type="button" onclick="applyGalleryFilter('before_after', 'all')" class="filter-pill shrink-0 flex items-center gap-1.5 px-4 py-2 rounded-full border transition-all duration-200 {{ $activeKey === 'before_after' ? 'active-pill' : 'inactive-pill' }}">
                    <span>⚖️ Before &amp; After</span>
                    <span class="pill-badge">{{ $counts['before_after'] ?? 0 }}</span>
                </button>

                <button type="button" onclick="applyGalleryFilter('all', 'video')" class="filter-pill shrink-0 flex items-center gap-1.5 px-4 py-2 rounded-full border transition-all duration-200 {{ $activeKey === 'video' ? 'active-pill' : 'inactive-pill' }}">
                    <span>▶️ Video Pengerjaan</span>
                    <span class="pill-badge">{{ $counts['video'] ?? 0 }}</span>
                </button>
            </div>
        </div>

        {{-- SKELETON LOADING GRID --}}
        <div id="skeleton-grid" class="hidden grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 mb-8">
            @for($i = 0; $i < 8; $i++)
            <div class="bg-white rounded-2xl p-3.5 border border-slate-200 animate-pulse space-y-3">
                <div class="aspect-[16/10] bg-slate-200 rounded-xl w-full"></div>
                <div class="h-4 bg-slate-200 rounded w-3/4"></div>
                <div class="h-3 bg-slate-200 rounded w-1/2"></div>
            </div>
            @endfor
        </div>

        {{-- HYBRID MEDIA GRID CARDS CONTAINER --}}
        <div id="gallery-grid-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 mb-8 transition-opacity duration-300">
            @include('pages.gallery.partials.gallery_grid', ['galleries' => $galleries])
        </div>

        {{-- LOAD MORE BUTTON & PAGINATION WRAPPER --}}
        <div class="flex flex-col items-center justify-center mt-8 gap-3" id="pagination-wrapper">
            @if($galleries->hasMorePages())
            <button type="button" id="btn-load-more" onclick="loadMoreGalleryItems()" data-next-url="{{ $galleries->nextPageUrl() }}" class="inline-flex items-center gap-2 px-6 py-3.5 bg-slate-900 hover:bg-emerald-600 text-white text-xs sm:text-sm font-extrabold rounded-full shadow-lg transition-all hover:scale-105 active:scale-95">
                <span id="load-more-text">Muat Lebih Banyak Dokumentasi</span>
                <svg id="load-more-spinner" class="hidden animate-spin w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
            @endif

            <div class="text-xs text-slate-500 font-medium" id="gallery-count-info">
                Menampilkan <span id="current-loaded-count" class="font-bold text-slate-800">{{ count($galleries) }}</span> dari <span id="total-gallery-count" class="font-bold text-slate-800">{{ $galleries->total() }}</span> laporan proyek
            </div>
        </div>

        {{-- INSTAGRAM LIVE REELS & FEED SHOWCASE SECTION --}}
        <div class="mt-12 md:mt-16 p-6 sm:p-8 bg-slate-950 text-white rounded-3xl border border-slate-800 shadow-2xl relative overflow-hidden">
            <div class="absolute -top-24 -right-24 w-72 h-72 bg-pink-500/10 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 pb-6 border-b border-slate-800 relative z-10">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-rose-500/20 text-rose-300 border border-rose-400/30 mb-2">
                        <span>📸 INSTAGRAM OFFICIAL REELS &amp; UPDATES</span>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-extrabold text-white">
                        Dokumentasi Harian di <span class="bg-gradient-to-r from-purple-400 via-pink-400 to-rose-400 bg-clip-text text-transparent">@rootera_plumbing</span>
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-300 mt-1 max-w-xl">
                        Ikuti unggahan Reels aksi penanganan pipa tersumbat, inspeksi CCTV, dan edukasi cuci toren terbaru langsung dari feed Instagram kami.
                    </p>
                </div>
                <a href="https://www.instagram.com/rootera_plumbing/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-full bg-gradient-to-r from-purple-600 via-pink-600 to-rose-600 hover:from-purple-500 hover:to-rose-500 text-white font-extrabold text-xs sm:text-sm shadow-lg shadow-pink-500/20 transition-all hover:scale-105 shrink-0 no-underline">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    <span>Follow @rootera_plumbing</span>
                </a>
            </div>

            {{-- Instagram Embedded Post Showcase --}}
            <div class="flex justify-center items-center w-full py-4 relative z-10">
                <div class="w-full max-w-[480px] rounded-2xl overflow-hidden shadow-2xl bg-white">
                    <blockquote class="instagram-media" 
                                data-instgrm-permalink="https://www.instagram.com/p/Dcsf15yj0ZG/" 
                                data-instgrm-version="14" 
                                style="background:#FFF; border:0; margin:0 auto; padding:0; width:100%; max-width:480px;">
                    </blockquote>
                </div>
            </div>
        </div>
        <script async src="//www.instagram.com/embed.js" onload="if(window.instgrm?.Embeds?.process){window.instgrm.Embeds.process();}"></script>

    </div>
</section>

{{-- MODAL LIGHTBOX VIEWER FOR PHOTO & VIDEO --}}
<div id="mediaModal" class="fixed inset-0 bg-slate-950/90 backdrop-blur-md z-[99999] hidden items-center justify-center p-3 sm:p-6" onclick="closeMediaModal(event)">
    <div class="relative w-full max-w-4xl bg-slate-900 rounded-3xl overflow-hidden border border-slate-700 shadow-2xl animate-in fade-in zoom-in-95 duration-200" onclick="event.stopPropagation()">
        
        {{-- Modal Header --}}
        <div class="flex justify-between items-center px-5 py-3.5 bg-slate-950 border-b border-slate-800">
            <h4 id="modalMediaTitle" class="text-white font-bold text-xs sm:text-base truncate max-w-[80%]"></h4>
            <button type="button" onclick="forceCloseMediaModal()" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white flex items-center justify-center text-xl transition-colors">&times;</button>
        </div>

        {{-- Modal Content Area --}}
        <div id="modalMediaContainer" class="relative w-full min-h-[250px] sm:min-h-[380px] max-h-[75vh] flex items-center justify-center bg-black overflow-hidden">
            {{-- Injected dynamically --}}
        </div>

        {{-- Modal Footer --}}
        <div class="p-4 bg-slate-950 border-t border-slate-800 flex flex-wrap items-center justify-between gap-3 text-xs">
            <span class="text-slate-400 flex items-center gap-1 font-medium">
                🛡️ Dokumen Resmi Rootera Plumbing Indonesia
            </span>
            <a id="modalWaBtn" href="#" target="_blank" rel="noopener noreferrer" class="bg-emerald-500 hover:bg-emerald-600 text-white font-extrabold px-5 py-2.5 rounded-full transition-colors flex items-center gap-1.5 no-underline shadow-md">
                💬 Konsultasi Kasus Ini via WA
            </a>
        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
.no-scrollbar::-webkit-scrollbar {
    display: none;
}
.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.filter-pill .pill-badge {
    font-size: 0.7rem;
    padding: 0.15rem 0.45rem;
    border-radius: 9999px;
    font-weight: 700;
}
.active-pill {
    background-color: #0b132b;
    color: #34d399;
    border-color: #10b981;
    box-shadow: 0 4px 14px rgba(16, 185, 129, 0.2);
    transform: scale(1.02);
}
.active-pill .pill-badge {
    background-color: rgba(16, 185, 129, 0.2);
    color: #34d399;
}
.inactive-pill {
    background-color: #ffffff;
    color: #475569;
    border-color: #cbd5e1;
}
.inactive-pill:hover {
    background-color: #f8fafc;
    color: #0b132b;
    border-color: #10b981;
}
.inactive-pill .pill-badge {
    background-color: #f1f5f9;
    color: #64748b;
}
</style>
@endpush

@push('scripts')
<script>
let currentCategory = '{{ $category ?? "all" }}';
let currentMediaType = '{{ $mediaType ?? "all" }}';
let currentPage = 1;
let hasMorePages = {{ $galleries->hasMorePages() ? 'true' : 'false' }};
let isLoading = false;

function applyGalleryFilter(category, mediaType) {
    if (isLoading) return;
    
    currentCategory = category;
    currentMediaType = mediaType;
    currentPage = 1;

    updateActivePills(category, mediaType);

    const gridContainer = document.getElementById('gallery-grid-container');
    const skeletonGrid = document.getElementById('skeleton-grid');
    gridContainer.classList.add('hidden');
    skeletonGrid.classList.remove('hidden');

    const params = new URLSearchParams();
    if (category !== 'all') params.set('category', category);
    if (mediaType !== 'all') params.set('media_type', mediaType);

    const newUrl = `${window.location.pathname}?${params.toString()}`;
    window.history.pushState({}, '', newUrl);

    fetch(`${newUrl}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        gridContainer.innerHTML = data.html;
        skeletonGrid.classList.add('hidden');
        gridContainer.classList.remove('hidden');
        
        hasMorePages = data.hasMore;
        updateLoadMoreButton(data.nextPageUrl, data.total, document.querySelectorAll('.gallery-card').length);
    })
    .catch(err => {
        console.error('Failed to load gallery items:', err);
        skeletonGrid.classList.add('hidden');
        gridContainer.classList.remove('hidden');
    });
}

function loadMoreGalleryItems() {
    const btn = document.getElementById('btn-load-more');
    if (!btn || isLoading || !hasMorePages) return;

    const nextUrl = btn.getAttribute('data-next-url');
    if (!nextUrl) return;

    isLoading = true;
    document.getElementById('load-more-text').textContent = 'Memuat...';
    document.getElementById('load-more-spinner').classList.remove('hidden');

    fetch(nextUrl, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        const gridContainer = document.getElementById('gallery-grid-container');
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = data.html;
        
        const newCards = tempDiv.querySelectorAll('.gallery-card');
        newCards.forEach(card => gridContainer.appendChild(card));

        hasMorePages = data.hasMore;
        const totalCardsNow = document.querySelectorAll('.gallery-card').length;
        updateLoadMoreButton(data.nextPageUrl, data.total, totalCardsNow);

        isLoading = false;
        document.getElementById('load-more-text').textContent = 'Muat Lebih Banyak Dokumentasi';
        document.getElementById('load-more-spinner').classList.add('hidden');
    })
    .catch(err => {
        console.error('Failed loading more gallery items:', err);
        isLoading = false;
        document.getElementById('load-more-text').textContent = 'Coba Lagi';
        document.getElementById('load-more-spinner').classList.add('hidden');
    });
}

function updateLoadMoreButton(nextPageUrl, total, currentLoaded) {
    const btn = document.getElementById('btn-load-more');
    const countInfo = document.getElementById('gallery-count-info');

    if (btn) {
        if (hasMorePages && nextPageUrl) {
            btn.classList.remove('hidden');
            btn.setAttribute('data-next-url', nextPageUrl);
        } else {
            btn.classList.add('hidden');
        }
    }

    if (countInfo) {
        document.getElementById('current-loaded-count').textContent = currentLoaded;
        document.getElementById('total-gallery-count').textContent = total;
    }
}

function updateActivePills(category, mediaType) {
    const pills = document.querySelectorAll('.filter-pill');

    pills.forEach(pill => {
        pill.classList.remove('active-pill');
        pill.classList.add('inactive-pill');
    });

    const onclickAttr = (mediaType === 'video') 
        ? `applyGalleryFilter('all', 'video')` 
        : `applyGalleryFilter('${category}', 'all')`;

    pills.forEach(pill => {
        if (pill.getAttribute('onclick') === onclickAttr) {
            pill.classList.remove('inactive-pill');
            pill.classList.add('active-pill');
        }
    });
}

function resetGalleryFilter() {
    applyGalleryFilter('all', 'all');
}

// MODAL LIGHTBOX CONTROLS
function openMediaModal(type, url, title, beforeUrl, encodedTitle) {
    const modal = document.getElementById('mediaModal');
    const container = document.getElementById('modalMediaContainer');
    const titleEl = document.getElementById('modalMediaTitle');
    const waBtn = document.getElementById('modalWaBtn');
    
    titleEl.textContent = title;
    container.innerHTML = '';
    
    if (waBtn) {
        waBtn.href = `https://wa.me/6281385404000?text=Halo%20Rootera%20Plumbing%2C%20saya%20membaca%20laporan%20studi%20kasus%20%5B${encodedTitle}%5D.%20Saya%20memiliki%20masalah%20serupa%20dan%20ingin%20konsultasi%2Fpanggil%20teknisi.`;
    }

    if (type === 'video') {
        container.innerHTML = `
            <video id="galleryVideoPlayer" controls playsinline preload="metadata" autoplay class="w-full max-h-[70vh] object-contain rounded-b-xl">
                <source src="${url}" type="video/mp4">
                Browser Anda tidak mendukung pemutaran video.
            </video>
        `;
        const player = document.getElementById('galleryVideoPlayer');
        if (player) {
            player.load();
            player.play().catch(err => console.log('Autoplay handled by browser:', err));
        }
    } else if (beforeUrl && beforeUrl !== 'null' && beforeUrl !== '') {
        container.innerHTML = `
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 p-3 w-full max-h-[70vh] overflow-y-auto">
                <div class="text-center bg-slate-950 p-2 rounded-xl border border-red-500/30">
                    <span class="bg-red-600 text-white text-[10px] font-extrabold px-2 py-0.5 rounded uppercase mb-2 inline-block shadow">SEBELUM (BEFORE)</span>
                    <img src="${beforeUrl}" class="w-full h-48 sm:h-64 object-cover rounded-lg" onerror="this.onerror=null;this.src='{{ asset('images/JnJ.jpeg') }}';">
                </div>
                <div class="text-center bg-slate-950 p-2 rounded-xl border border-emerald-500/30">
                    <span class="bg-emerald-600 text-white text-[10px] font-extrabold px-2 py-0.5 rounded uppercase mb-2 inline-block shadow">SESUDAH (AFTER)</span>
                    <img src="${url}" class="w-full h-48 sm:h-64 object-cover rounded-lg" onerror="this.onerror=null;this.src='{{ asset('images/JnJ.jpeg') }}';">
                </div>
            </div>
        `;
    } else {
        container.innerHTML = `
            <img src="${url}" class="w-full max-h-[70vh] object-contain p-2" onerror="this.onerror=null;this.src='{{ asset('images/JnJ.jpeg') }}';">
        `;
    }

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeMediaModal(e) {
    if (e.target.id === 'mediaModal') {
        forceCloseMediaModal();
    }
}

function forceCloseMediaModal() {
    const modal = document.getElementById('mediaModal');
    const container = document.getElementById('modalMediaContainer');
    const player = document.getElementById('galleryVideoPlayer');
    
    if (player) {
        player.pause();
        player.currentTime = 0;
    }
    
    container.innerHTML = '';
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        forceCloseMediaModal();
    }
});
</script>
@endpush
