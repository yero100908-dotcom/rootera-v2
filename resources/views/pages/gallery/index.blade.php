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
{{-- HERO & FEATURED SHOWCASE SECTION --}}
<div class="relative overflow-hidden bg-gradient-to-br from-[#061434] via-[#081d48] to-[#0b2b64] text-white py-10 sm:py-16">
    {{-- Background Glow Orbs --}}
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-12">
            <div class="inline-flex items-center gap-2 bg-teal-500/15 border border-teal-400/30 text-teal-300 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
                Dokumentasi Riil Tanpa Edit Rekayasa
            </div>
            <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight mb-3 text-white">
                Galeri Pekerjaan & <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-300 to-emerald-400">Bukti Pengerjaan Pipa</span>
            </h1>
            <p class="text-slate-300 text-xs sm:text-base leading-relaxed max-w-2xl mx-auto">
                Kumpulan video riil aksi teknisi, foto komparasi sebelum-sesudah (*Before & After*), serta performa mesin hydro-jetting & spiral rotary di lapangan.
            </p>
        </div>

        @if($featuredProject)
        {{-- FEATURED SHOWCASE CARD --}}
        <div class="bg-white/5 border border-white/15 rounded-2xl sm:rounded-3xl overflow-hidden backdrop-blur-md shadow-2xl grid grid-cols-1 lg:grid-cols-2 gap-0 w-full max-w-7xl mx-auto">
            <div class="lg:col-span-1 relative bg-slate-950 flex items-center justify-center min-h-[240px] sm:min-h-[320px] lg:min-h-[380px]">
                @if($featuredProject->media_type === 'video' && $featuredProject->display_media)
                    <video autoplay muted loop playsinline poster="{{ $featuredProject->display_thumbnail }}" title="{{ $featuredProject->title }} - Rootera Plumbing" class="w-full h-full object-cover max-h-[420px]">
                        <source src="{{ $featuredProject->display_media }}" type="video/mp4">
                        Browser Anda tidak mendukung video tag.
                    </video>
                @else
                    <img src="{{ $featuredProject->display_thumbnail }}" alt="Proyek Unggulan - {{ $featuredProject->title }}" title="{{ $featuredProject->title }} - Rootera Plumbing" class="w-full h-full object-cover max-h-[420px]">
                @endif
                <div class="absolute top-3 left-3 flex flex-wrap gap-1.5 z-10">
                    <span class="bg-amber-400 text-slate-950 text-xs font-black px-2.5 py-1 rounded-md uppercase tracking-wide shadow-md">⭐ Proyek Unggulan</span>
                    <span class="bg-slate-900/80 backdrop-blur-sm text-white text-xs font-bold px-2.5 py-1 rounded-md shadow-md">{{ $featuredProject->category_label }}</span>
                </div>
            </div>
            <div class="lg:col-span-1 p-5 sm:p-8 flex flex-col justify-between bg-slate-900/90 border-t lg:border-t-0 lg:border-l border-white/10">
                <div>
                    @if($featuredProject->location_tag)
                    <div class="text-teal-300 text-xs font-bold mb-2 flex items-center gap-1">
                        📍 {{ $featuredProject->location_tag }}
                    </div>
                    @endif
                    <h2 class="text-lg sm:text-xl font-bold text-white leading-snug mb-2 hover:text-teal-300 transition-colors">
                        <a href="{{ route('galeri.show', $featuredProject->slug) }}">
                            {{ $featuredProject->title }}
                        </a>
                    </h2>
                    <p class="text-slate-300 text-xs sm:text-sm leading-relaxed mb-6 line-clamp-3">
                        {{ $featuredProject->description }}
                    </p>
                </div>
                <div class="flex flex-wrap gap-2 pt-2">
                    @if($featuredProject->related_service_url)
                    <a href="{{ url($featuredProject->related_service_url) }}" class="bg-emerald-500 hover:bg-emerald-600 text-white text-xs sm:text-sm font-bold px-4 py-2.5 rounded-xl transition-all shadow-md shadow-emerald-500/20 flex items-center gap-1.5">
                        Lihat Layanan →
                    </a>
                    @endif
                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya tertarik dengan pengerjaan proyek: ' . $featuredProject->title) }}" target="_blank" rel="noopener noreferrer" class="bg-white/10 hover:bg-white/20 text-white text-xs sm:text-sm font-bold px-4 py-2.5 rounded-xl transition-all border border-white/20 flex items-center gap-1.5">
                        💬 Konsultasi Masalah Serupa
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
        
        {{-- MOBILE-FIRST HORIZONTAL SCROLLABLE FILTER PILLS --}}
        <div class="relative mb-6 sm:mb-10">
            <div class="flex items-center gap-2 overflow-x-auto no-scrollbar scroll-smooth py-2 px-1 text-xs sm:text-sm font-semibold" id="filter-bar">
                @php
                    $currentCat = request('category', 'all');
                    $currentMedia = request('media_type', 'all');
                    $activeKey = ($currentMedia === 'video') ? 'video' : $currentCat;
                @endphp

                <button type="button" onclick="applyGalleryFilter('all', 'all')" class="filter-pill shrink-0 flex items-center gap-1.5 px-3.5 py-2 rounded-full border transition-all duration-200 {{ $activeKey === 'all' ? 'active-pill' : 'inactive-pill' }}">
                    <span>✨ Semua</span>
                    <span class="pill-badge">{{ $counts['all'] ?? 0 }}</span>
                </button>

                <button type="button" onclick="applyGalleryFilter('residential', 'all')" class="filter-pill shrink-0 flex items-center gap-1.5 px-3.5 py-2 rounded-full border transition-all duration-200 {{ $activeKey === 'residential' ? 'active-pill' : 'inactive-pill' }}">
                    <span>🏠 Rumah Tinggal</span>
                    <span class="pill-badge">{{ $counts['residential'] ?? 0 }}</span>
                </button>

                <button type="button" onclick="applyGalleryFilter('commercial_resto', 'all')" class="filter-pill shrink-0 flex items-center gap-1.5 px-3.5 py-2 rounded-full border transition-all duration-200 {{ $activeKey === 'commercial_resto' ? 'active-pill' : 'inactive-pill' }}">
                    <span>🍽️ Resto & Kafe</span>
                    <span class="pill-badge">{{ $counts['commercial_resto'] ?? 0 }}</span>
                </button>

                <button type="button" onclick="applyGalleryFilter('commercial_b2b', 'all')" class="filter-pill shrink-0 flex items-center gap-1.5 px-3.5 py-2 rounded-full border transition-all duration-200 {{ $activeKey === 'commercial_b2b' ? 'active-pill' : 'inactive-pill' }}">
                    <span>🏢 Gedung & Pabrik</span>
                    <span class="pill-badge">{{ $counts['commercial_b2b'] ?? 0 }}</span>
                </button>

                <button type="button" onclick="applyGalleryFilter('cctv_inspection', 'all')" class="filter-pill shrink-0 flex items-center gap-1.5 px-3.5 py-2 rounded-full border transition-all duration-200 {{ $activeKey === 'cctv_inspection' ? 'active-pill' : 'inactive-pill' }}">
                    <span>📹 Inspeksi CCTV</span>
                    <span class="pill-badge">{{ $counts['cctv_inspection'] ?? 0 }}</span>
                </button>

                <button type="button" onclick="applyGalleryFilter('before_after', 'all')" class="filter-pill shrink-0 flex items-center gap-1.5 px-3.5 py-2 rounded-full border transition-all duration-200 {{ $activeKey === 'before_after' ? 'active-pill' : 'inactive-pill' }}">
                    <span>⚖️ Before & After</span>
                    <span class="pill-badge">{{ $counts['before_after'] ?? 0 }}</span>
                </button>

                <button type="button" onclick="applyGalleryFilter('all', 'video')" class="filter-pill shrink-0 flex items-center gap-1.5 px-3.5 py-2 rounded-full border transition-all duration-200 {{ $activeKey === 'video' ? 'active-pill' : 'inactive-pill' }}">
                    <span>▶️ Video Pengerjaan</span>
                    <span class="pill-badge">{{ $counts['video'] ?? 0 }}</span>
                </button>
            </div>
        </div>

        {{-- SKELETON LOADING GRID (HIDDEN BY DEFAULT) --}}
        <div id="skeleton-grid" class="hidden grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 mb-8">
            @for($i = 0; $i < 8; $i++)
            <div class="bg-white rounded-xl sm:rounded-2xl p-3 border border-slate-200 animate-pulse space-y-3">
                <div class="aspect-[4/3] bg-slate-200 rounded-lg w-full"></div>
                <div class="h-4 bg-slate-200 rounded w-3/4"></div>
                <div class="h-3 bg-slate-200 rounded w-1/2"></div>
            </div>
            @endfor
        </div>

        {{-- HYBRID MEDIA GRID CARDS CONTAINER --}}
        <div id="gallery-grid-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 mb-8 transition-opacity duration-300">
            @include('pages.gallery.partials.gallery_grid', ['galleries' => $galleries])
        </div>

        {{-- LOAD MORE BUTTON & PAGINATION CONTAINER --}}
        <div class="flex flex-col items-center justify-center mt-8 gap-3" id="pagination-wrapper">
            @if($galleries->hasMorePages())
            <button type="button" id="btn-load-more" onclick="loadMoreGalleryItems()" data-next-url="{{ $galleries->nextPageUrl() }}" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white text-xs sm:text-sm font-bold rounded-2xl shadow-lg transition-all hover:scale-105 active:scale-95">
                <span id="load-more-text">Muat Lebih Banyak Dokumentasi</span>
                <svg id="load-more-spinner" class="hidden animate-spin w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
            @endif

            <div class="text-xs text-slate-400 font-medium" id="gallery-count-info">
                Menampilkan <span id="current-loaded-count">{{ count($galleries) }}</span> dari <span id="total-gallery-count">{{ $galleries->total() }}</span> dokumentasi
            </div>
        </div>

    </div>
</section>

{{-- MODAL VIEWER FOR PHOTO LIGHTBOX & HTML5 VIDEO --}}
<div id="mediaModal" class="fixed inset-0 bg-slate-950/85 backdrop-blur-md z-[99999] hidden items-center justify-center p-3 sm:p-6" onclick="closeMediaModal(event)">
    <div class="relative w-full max-w-4xl bg-slate-900 rounded-2xl overflow-hidden border border-white/15 shadow-2xl animate-in fade-in zoom-in-95 duration-200" onclick="event.stopPropagation()">
        
        {{-- Modal Header --}}
        <div class="flex justify-between items-center px-4 py-3 bg-slate-950/80 border-b border-white/10">
            <h4 id="modalMediaTitle" class="text-white font-bold text-xs sm:text-base truncate max-w-[80%]"></h4>
            <button type="button" onclick="forceCloseMediaModal()" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-slate-300 hover:text-white flex items-center justify-center text-xl transition-colors">&times;</button>
        </div>

        {{-- Modal Content Area --}}
        <div id="modalMediaContainer" class="relative w-full min-h-[250px] sm:min-h-[380px] max-h-[75vh] flex items-center justify-center bg-black overflow-hidden">
            {{-- Injected dynamically --}}
        </div>

        {{-- Modal Footer with CTA --}}
        <div class="p-3 bg-slate-950/90 border-t border-white/10 flex flex-wrap items-center justify-between gap-2 text-xs">
            <span class="text-slate-400 flex items-center gap-1 font-medium">
                🛡️ Dokumen Resmi Rootera Plumbing
            </span>
            <a id="modalWaBtn" href="#" target="_blank" rel="noopener noreferrer" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold px-4 py-2 rounded-xl transition-colors flex items-center gap-1.5">
                💬 Konsultasi Kasus Ini via WhatsApp
            </a>
        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
/* Hide standard scrollbars for smooth filter navigation */
.no-scrollbar::-webkit-scrollbar {
    display: none;
}
.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

/* Active & Inactive Pill States */
.filter-pill .pill-badge {
    font-size: 0.7rem;
    padding: 0.15rem 0.45rem;
    border-radius: 9999px;
    font-weight: 700;
}
.active-pill {
    background-color: #0b2b64;
    color: #ffffff;
    border-color: #2dd4bf;
    box-shadow: 0 4px 14px rgba(11, 43, 100, 0.35);
    transform: scale(1.02);
}
.active-pill .pill-badge {
    background-color: rgba(45, 212, 191, 0.25);
    color: #2dd4bf;
}
.inactive-pill {
    background-color: #ffffff;
    color: #475569;
    border-color: #cbd5e1;
}
.inactive-pill:hover {
    background-color: #f1f5f9;
    color: #0b2b64;
    border-color: #94a3b8;
}
.inactive-pill .pill-badge {
    background-color: #f1f5f9;
    color: #64748b;
}

/* Shimmer Loading Animation */
@keyframes shimmer {
    0% { opacity: 0.6; }
    50% { opacity: 1; }
    100% { opacity: 0.6; }
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

    // Update active UI pills
    updateActivePills(category, mediaType);

    // Show Skeleton Loader
    const gridContainer = document.getElementById('gallery-grid-container');
    const skeletonGrid = document.getElementById('skeleton-grid');
    gridContainer.classList.add('hidden');
    skeletonGrid.classList.remove('hidden');

    // Build URL query params
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
    const wrapper = document.getElementById('pagination-wrapper');
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
    const targetKey = (mediaType === 'video') ? 'video' : category;

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
        waBtn.href = `https://wa.me/6281385404000?text=Halo%20Rootera%2C%20saya%20tertarik%20dengan%20dokumentasi%3A%20${encodedTitle}`;
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
