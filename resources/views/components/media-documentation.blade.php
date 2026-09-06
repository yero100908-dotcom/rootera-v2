{{-- 
  Komponen Media Dokumentasi Lapangan & Gallery Showcase Preview
  Style: Luxury, Modern, High-Trust (Deep Navy #0B192C, Emerald #10B981)
--}}
@props([
    'projectShowcases' => null,
    'relatedArticles' => null,
    'locationName' => null,
    'locationShort' => null
])

<?php
$locName = $locationName ?? $locationShort ?? 'Wilayah Layanan';
$locShort = $locationShort ?? $locationName ?? 'Area Layanan';
$mediaService = app(\App\Services\MediaService::class);
$toolkitImages = $mediaService->getToolkitImages();

// Fetch active gallery items (up to 4 items) from the active Gallery model (/galeri-dokumentasi)
try {
    $galleryShowcaseItems = \App\Models\Gallery::where('is_active', true)
        ->orderBy('sort_order', 'asc')
        ->orderBy('created_at', 'desc')
        ->take(4)
        ->get();
} catch (\Throwable $e) {
    $galleryShowcaseItems = collect();
}

// Fallback items if database gallery query is empty
if (!is_iterable($galleryShowcaseItems) || (is_countable($galleryShowcaseItems) && count($galleryShowcaseItems) === 0)) {
    $galleryShowcaseItems = [
        [
            'title' => 'Pelancaran Pipa Wastafel Dapur & Restoran',
            'category_label' => 'Restoran & Kafe',
            'display_thumbnail' => $toolkitImages['hydro_jetting']['url'],
            'slug' => null,
            'badge' => 'Restoran',
        ],
        [
            'title' => 'Pembersihan Floor Drain Kamar Mandi Mampet',
            'category_label' => 'Rumah Tinggal',
            'display_thumbnail' => $toolkitImages['ridgid_k50']['url'],
            'slug' => null,
            'badge' => 'Rumah Tinggal',
        ],
        [
            'title' => 'Pelancaran Saluran Pembuangan Kloset & WC',
            'category_label' => 'Gedung & Publik',
            'display_thumbnail' => asset('images/wc-mampet.jpg'),
            'slug' => null,
            'badge' => 'Gedung',
        ],
        [
            'title' => 'Inspeksi Kamera CCTV Pipa Pembuangan Utilitas',
            'category_label' => 'Inspeksi CCTV',
            'display_thumbnail' => $toolkitImages['cctv_camera']['url'],
            'slug' => null,
            'badge' => 'Inspeksi CCTV',
        ]
    ];
}

// Limit showcase items to max 4 items
if (is_countable($galleryShowcaseItems) && count($galleryShowcaseItems) > 4) {
    if ($galleryShowcaseItems instanceof \Illuminate\Support\Collection) {
        $galleryShowcaseItems = $galleryShowcaseItems->take(4);
    } else if (is_array($galleryShowcaseItems)) {
        $galleryShowcaseItems = array_slice($galleryShowcaseItems, 0, 4);
    }
}

// Specific target slugs for Section 3 video blog cards
$targetVideoSlugs = [
    'jangan-tunggu-mampet-total-bahaya-endapan-lemak-di-pipa-jasapipamampet-beritaterkini-fypyoutube',
    'nside-the-kai-misi-tim-rootera-jasapipamampetberitaterkini-fypyoutube-rooteraplumbing',
    'inspeksi-saluran-mampet-di-kantor-pertamina-sunter-jasapipamampet-fypyoutube-beritaterkini'
];

// Fallback Video / Article Cards if DB items missing
$fallbackArticles = [
    [
        'title' => 'Jangan Tunggu Mampet Total! Bahaya Endapan Lemak di Pipa🛑',
        'slug' => 'jangan-tunggu-mampet-total-bahaya-endapan-lemak-di-pipa-jasapipamampet-beritaterkini-fypyoutube',
        'category' => 'EDUKASI & VIDEO PANDUAN',
        'thumbnail' => 'https://i.ytimg.com/vi/dkbZNoaIT9w/hqdefault.jpg',
        'duration' => '⏱ 1 mnt',
        'youtube_id' => 'dkbZNoaIT9w',
        'published_at' => '13 Aug 2026',
        'views' => '1.2k',
        'author' => 'Rootera Plumbing',
        'excerpt' => 'Saluran mampet jangan cuma dilihat dari air yang nggak ngalir—bisa jadi ada masalah besar di dalam pipanya! Lemak, kotoran, dan endapan menumpuk mempersempit jalur pipa.',
    ],
    [
        'title' => 'NSIDE THE KAI - Misi Tim Rootera',
        'slug' => 'nside-the-kai-misi-tim-rootera-jasapipamampetberitaterkini-fypyoutube-rooteraplumbing',
        'category' => 'EDUKASI & VIDEO PANDUAN',
        'thumbnail' => 'https://i.ytimg.com/vi/2NN31lF2O40/hqdefault.jpg',
        'duration' => '⏱ 2 mnt',
        'youtube_id' => '2NN31lF2O40',
        'published_at' => '14 Aug 2026',
        'views' => '2.5k',
        'author' => 'Rootera Plumbing',
        'excerpt' => 'Pernah penasaran bagaimana perawatan fasilitas publik berjalan di balik sibuknya jadwal stasiun kereta api? Di video recap short movie ini, tim Rooterin membawa Anda melihat langsung prosesnya.',
    ],
    [
        'title' => 'Inspeksi SALURAN MAMPET di Kantor Pertamina Sunter 🏢🎥',
        'slug' => 'inspeksi-saluran-mampet-di-kantor-pertamina-sunter-jasapipamampet-fypyoutube-beritaterkini',
        'category' => 'EDUKASI & VIDEO PANDUAN',
        'thumbnail' => 'https://i.ytimg.com/vi/yvzZqMV6PKY/hqdefault.jpg',
        'duration' => '⏱ 1 mnt',
        'youtube_id' => 'yvzZqMV6PKY',
        'published_at' => '12 Aug 2026',
        'views' => '3.1k',
        'author' => 'Rootera Plumbing',
        'excerpt' => 'Kali ini tim Rootera dipercaya melakukan pengerjaan di Kantor Pertamina Sunter. Sebelum dieksekusi, teknisi kami melakukan inspeksi menggunakan Drain Camera (CCTV Pipa).',
    ]
];

try {
    $fetchedArticles = \App\Models\Article::whereIn('slug', $targetVideoSlugs)->get()->keyBy('slug');
    $orderedArticles = collect();

    foreach ($targetVideoSlugs as $slug) {
        if ($fetchedArticles->has($slug)) {
            $orderedArticles->push($fetchedArticles->get($slug));
        } else {
            $fb = collect($fallbackArticles)->firstWhere('slug', $slug);
            if ($fb) {
                $orderedArticles->push($fb);
            }
        }
    }

    $articlesToDisplay = $orderedArticles;
} catch (\Throwable $e) {
    $articlesToDisplay = $fallbackArticles;
}
?>

<!-- Section 1: Operational Toolkit Showcase Grid (High Trust Equipment) -->
<section class="py-8 px-4 md:py-16 md:px-6 bg-white border-t border-slate-200" id="teknologi-alat">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div class="text-center mb-6 md:mb-12">
            <span class="text-emerald-600 font-extrabold text-[11px] md:text-[0.85rem] uppercase tracking-wider">
                🛠️ Standar Teknologi &amp; Peralatan Canggih
            </span>
            <h2 class="text-[18px] sm:text-[20px] md:text-[2.4rem] font-extrabold text-slate-900 mt-1 leading-tight">
                Peralatan Modern Teknisi Rootera di {{ $locShort }}
            </h2>
            <p class="text-xs md:text-[1rem] text-slate-500 max-w-2xl md:max-w-[720px] mx-auto mt-1 md:mt-2 leading-relaxed md:leading-[1.6]">
                Seluruh armada penanganan pipa tersumbat di {{ $locName }} dibekali peralatan standar industri tanpa bongkar ubin/keramik.
            </p>
        </div>

        <!-- Section 1: Equipment Carousel/Grid -->
        <div class="flex overflow-x-auto snap-x snap-mandatory gap-3 pb-3 mobile-scrollbar touch-pan-x touch-pan-y md:grid md:grid-cols-2 lg:grid-cols-3 md:overflow-visible md:pb-0 md:gap-6" style="touch-action: pan-x pan-y; overscroll-behavior-x: contain; -webkit-overflow-scrolling: touch;">
            @foreach($toolkitImages as $key => $tool)
            <div class="w-[82vw] min-w-[82vw] sm:min-w-[280px] snap-center shrink-0 md:w-auto md:min-w-0 bg-slate-50 border border-slate-200 rounded-2xl overflow-hidden shadow-sm transition hover:-translate-y-1.5 hover:border-emerald-400 flex flex-col justify-between">
                <div class="h-[150px] md:h-[180px] bg-slate-100 overflow-hidden relative flex items-center justify-center p-2 md:p-0">
                    <img src="{{ $tool['url'] }}" alt="{{ $tool['alt'] }} - {{ $locName }}" class="w-full h-full object-contain md:object-cover rounded-lg md:rounded-none" loading="lazy" decoding="async" onerror="this.onerror=null;this.src='{{ asset('assets/TOOLKIT/mesin-rooter-ridgid-k50-spiral-baja.webp') }}';">
                    <span class="absolute top-2 right-2 md:top-2.5 md:right-2.5 bg-emerald-600/90 text-white text-[10px] md:text-[0.72rem] font-bold px-2 py-0.5 md:px-2.5 md:py-1 rounded-full uppercase z-10">
                        ✓ Alat Resmi
                    </span>
                </div>
                <div class="p-3 md:p-[1.25rem] flex flex-col justify-between flex-grow">
                    <h3 class="text-sm md:text-[1.05rem] font-extrabold text-slate-900 mb-1 md:mb-[0.35rem]">
                        {{ $tool['title'] }}
                    </h3>
                    <p class="text-xs md:text-[0.85rem] text-slate-500 line-clamp-2 md:line-clamp-none leading-relaxed md:leading-[1.5] margin-0">
                        {{ $tool['desc'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Mobile Visual Scroll Indicator -->
        <div class="md:hidden flex items-center justify-center gap-1.5 mt-2">
            <span class="w-6 h-1.5 rounded-full bg-emerald-500"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
        </div>
    </div>
</section>

<!-- Section 2: Gallery Showcase Preview Grid -->
<section class="py-8 px-4 md:py-[4.5rem] md:px-6 bg-gradient-to-b from-slate-50 to-blue-50/50 border-t border-b border-slate-200" id="dokumentasi-lapangan">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <!-- Section Header -->
        <div class="text-center mb-6 md:mb-14">
            <div class="inline-flex items-center gap-1.5 bg-emerald-500/10 border border-emerald-500/30 text-emerald-600 px-3 py-1 md:px-4 md:py-1.5 rounded-full text-[11px] md:text-[0.85rem] font-extrabold uppercase tracking-wider mb-1.5">
                <span class="inline-block w-1.5 h-1.5 rounded-full bg-emerald-500 shadow-sm"></span>
                PORTFOLIO &amp; DOKUMENTASI
            </div>
            <h2 class="text-[18px] sm:text-[20px] md:text-[2.5rem] font-extrabold text-slate-900 leading-tight mt-1">
                Hasil Kerja Teknisi Rootera
            </h2>
            <p class="text-xs md:text-[1.05rem] text-slate-500 max-w-2xl md:max-w-[780px] mx-auto mt-1 md:mt-2 leading-relaxed md:leading-[1.6]">
                Cuplikan pengerjaan nyata pelancaran saluran air, wastafel, kloset, dan got tanpa bongkar menggunakan mesin rotary spiral modern.
            </p>
        </div>

        <!-- Gallery Showcase Preview Carousel/Grid -->
        <div class="flex overflow-x-auto snap-x snap-mandatory gap-3 pb-3 mobile-scrollbar touch-pan-x touch-pan-y md:grid md:grid-cols-2 lg:grid-cols-4 md:overflow-visible md:pb-0 md:gap-6" style="touch-action: pan-x pan-y; overscroll-behavior-x: contain; -webkit-overflow-scrolling: touch;">
            @foreach($galleryShowcaseItems as $gItem)
            @php
                $gTitle = is_object($gItem) ? $gItem->title : ($gItem['title'] ?? 'Dokumentasi Pengerjaan Pipa');
                $gThumb = is_object($gItem) ? $gItem->display_thumbnail : ($gItem['display_thumbnail'] ?? asset('images/JnJ.jpeg'));
                $gCategory = is_object($gItem) ? $gItem->category_label : ($gItem['category_label'] ?? $gItem['badge'] ?? 'Portofolio');
                $gSlug = is_object($gItem) ? $gItem->slug : ($gItem['slug'] ?? null);
                $gUrl = $gSlug ? route('galeri.show', $gSlug) : route('galeri');
                $gMedia = is_object($gItem) ? $gItem->display_media : $gThumb;
                $gMediaType = is_object($gItem) ? $gItem->media_type : 'photo';
                $gBeforeImg = is_object($gItem) ? $gItem->display_before_image : null;
            @endphp
            <div class="w-[82vw] min-w-[82vw] sm:min-w-[260px] snap-center shrink-0 md:w-auto md:min-w-0 bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm transition hover:-translate-y-1 hover:shadow-lg hover:border-emerald-400/50 group flex flex-col justify-between">
                <!-- Image Container with Job Type Badge -->
                <div class="relative h-[150px] md:h-[210px] bg-slate-900 overflow-hidden cursor-pointer flex items-center justify-center" onclick="openMediaModal('{{ $gMediaType }}', '{{ $gMedia }}', '{{ addslashes($gTitle) }}', '{{ $gBeforeImg }}', '{{ urlencode($gTitle) }}')">
                    <img src="{{ $gThumb }}" alt="{{ $gTitle }} - Rootera Plumbing" class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-105" loading="lazy" decoding="async" onerror="this.src='/images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'">
                    
                    <!-- Job Type Badge Overlay -->
                    <span class="absolute top-2 left-2 md:top-3 md:left-3 bg-slate-900/85 text-emerald-400 border border-emerald-500/30 text-[10px] md:text-[0.72rem] font-bold px-2 py-0.5 md:px-3 md:py-1 rounded-full backdrop-blur-sm uppercase z-10">
                        🏷️ {{ $gCategory }}
                    </span>

                    <!-- Visual Zoom Icon Overlay -->
                    <div class="absolute inset-0 bg-slate-900/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center z-10">
                        <span class="bg-emerald-500 text-white w-8 h-8 md:w-11 md:h-11 rounded-full flex items-center justify-center shadow-md text-xs md:text-base">
                            🔍
                        </span>
                    </div>
                </div>

                <!-- Showcase Item Details -->
                <div class="p-3 md:p-[1.25rem] flex flex-col justify-between flex-grow">
                    <div>
                        <h3 class="text-xs md:text-[1.05rem] font-extrabold text-slate-900 mb-1 md:mb-2 leading-snug group-hover:text-emerald-600 transition-colors line-clamp-2">
                            <a href="{{ $gUrl }}" class="text-inherit text-decoration-none">
                                {{ $gTitle }}
                            </a>
                        </h3>
                    </div>

                    <div class="flex items-center justify-between border-t border-slate-100 pt-2 md:pt-3 mt-2 md:mt-3 text-[11px] md:text-[0.8rem]">
                        <span class="text-emerald-600 font-bold flex items-center gap-1">
                            ✓ Tanpa Bongkar
                        </span>
                        <a href="{{ $gUrl }}" class="text-sky-600 font-extrabold text-decoration-none hover:underline">
                            Detail →
                        </a>
                    </div>
                </div>

            </div>
            @endforeach
        </div>
        <!-- Mobile Visual Scroll Indicator -->
        <div class="md:hidden flex items-center justify-center gap-1.5 mt-2">
            <span class="w-6 h-1.5 rounded-full bg-emerald-500"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
        </div>

        <!-- Call-To-Action Button to Main Gallery Page -->
        <div class="text-center mt-6 md:mt-12">
            <a href="{{ route('galeri') }}" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-emerald-600 text-white px-5 py-3 md:px-9 md:py-3.5 rounded-full font-extrabold text-xs md:text-[0.95rem] text-decoration-none shadow-md transition-all">
                <span>Lihat Portofolio &amp; Dokumentasi Lengkap di Galeri Kami →</span>
            </a>
        </div>
    </div>
</section>

<!-- Section 3: Video Reels & Knowledge Guide Showcase (Clean Modern Card Style) -->
<section class="bg-slate-50 border-t border-slate-200/80 py-12 md:py-16 px-4 relative overflow-hidden" id="video-dokumentasi">
    <div class="max-w-6xl mx-auto relative z-10">
        
        <!-- Header Video Showcase -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8 md:mb-10">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-100 text-blue-950 font-bold text-xs uppercase tracking-wider mb-2">
                    🎬 EDUKASI & VIDEO PANDUAN
                </span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 leading-tight">
                    Lihat Aksi Teknisi Rootera Melancarkan Pipa
                </h2>
                <p class="text-slate-600 text-sm md:text-base max-w-2xl mt-2 leading-relaxed">
                    Video penanganan pengerjaan pipa tersumbat lemak beku &amp; kerak menggunakan mesin fleksibel Ridgid &amp; Hydro Jetting di {{ $locName }}.
                </p>
            </div>
            <div>
                <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya ingin pesan layanan pipa mampet untuk area ' . $locName) }}" target="_blank" class="inline-flex items-center justify-center gap-2 bg-[#0B192C] hover:bg-blue-900 text-white font-bold text-sm px-5 py-3 rounded-xl shadow-md transition-all duration-200">
                    <span>📞 Panggil Teknisi (24 Jam)</span>
                </a>
            </div>
        </div>

        <!-- Clean Modern Video Cards (Horizontal Snap Carousel on Mobile, Grid on Desktop) -->
        <div class="flex overflow-x-auto snap-x snap-mandatory gap-4 pb-4 mobile-scrollbar touch-pan-x touch-pan-y px-4 -mx-4 md:grid md:grid-cols-3 md:gap-6 md:pb-0 md:px-0 md:mx-0" style="touch-action: pan-x pan-y; overscroll-behavior-x: contain; -webkit-overflow-scrolling: touch;">
            @foreach($articlesToDisplay as $artIdx => $art)
            <?php
                $artTitle = is_object($art) ? $art->title : ($art['title'] ?? '');
                $artSlug = is_object($art) ? $art->slug : ($art['slug'] ?? '#');
                $artCategory = 'EDUKASI & VIDEO PANDUAN';
                $artUrl = ($artSlug !== '#') ? url('/blog/' . $artSlug) : route('blog');
                
                if (is_object($art)) {
                    $artThumb = $art->thumbnail ?: ($art->thumbnail_url ?: $toolkitImages['ridgid_k50']['url']);
                    $artDuration = $art->read_time ? ('⏱ ' . $art->read_time . ' mnt') : '⏱ 1 mnt';
                    $artDate = $art->published_at ? $art->published_at->format('d M Y') : 'Terbaru';
                    $artViews = number_format($art->views ?? 1250);
                    $artAuthor = $art->author ?: 'Rootera Plumbing';
                    $artExcerpt = $art->excerpt ?: 'Klik untuk menonton video panduan penanganan pipa mampet teknisi Rootera di lapangan.';
                } else {
                    $artThumb = $art['thumbnail'] ?? $toolkitImages['ridgid_k50']['url'];
                    $artDuration = $art['duration'] ?? '⏱ 1 mnt';
                    $artDate = $art['published_at'] ?? 'Terbaru';
                    $artViews = $art['views'] ?? '1.2k';
                    $artAuthor = $art['author'] ?? 'Rootera Plumbing';
                    $artExcerpt = $art['excerpt'] ?? 'Klik untuk menonton video panduan penanganan pipa mampet teknisi Rootera di lapangan.';
                }
            ?>
            <a href="{{ $artUrl }}" class="w-[82vw] max-w-[320px] flex-shrink-0 snap-center md:w-auto bg-white rounded-2xl shadow-sm hover:shadow-md border border-slate-100 overflow-hidden flex flex-col justify-between transition-all duration-300 group block text-left text-slate-800 no-underline">
                <!-- Thumbnail Container -->
                <div class="relative aspect-video w-full overflow-hidden bg-slate-100">
                    <img src="{{ $artThumb }}" alt="{{ $artTitle }} - Rootera Plumbing" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" loading="lazy" decoding="async" onerror="this.onerror=null;this.src='{{ asset('assets/TOOLKIT/mesin-rooter-ridgid-k50-spiral-baja.webp') }}';">
                    
                    <!-- Category Badge Top-Left -->
                    <span class="absolute top-3 left-3 bg-[#0B192C] text-white text-[10px] font-bold px-2.5 py-1 rounded-md uppercase tracking-wider shadow-sm z-10">
                        {{ $artCategory }}
                    </span>

                    <!-- Play Video Button Center -->
                    <div class="absolute inset-0 flex items-center justify-center z-10 pointer-events-none">
                        <div class="w-12 h-12 rounded-full bg-red-600 text-white flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:bg-red-500 transition-all duration-300">
                            <svg class="w-5 h-5 fill-current translate-x-0.5" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>

                    <!-- Duration Badge Bottom-Right -->
                    <span class="absolute bottom-3 right-3 bg-slate-900/80 text-white text-[11px] font-semibold px-2 py-0.5 rounded-md backdrop-blur-sm z-10 flex items-center gap-1">
                        {{ $artDuration }}
                    </span>
                </div>

                <!-- Card Content Body -->
                <div class="p-4 sm:p-5 flex-1 flex flex-col justify-between">
                    <div>
                        <!-- Metadata: Date & Views -->
                        <div class="flex items-center gap-3 text-xs text-slate-500 mb-2 font-medium">
                            <span class="flex items-center gap-1">📅 {{ $artDate }}</span>
                            <span class="flex items-center gap-1">👁 {{ $artViews }} views</span>
                        </div>

                        <!-- Article/Video Title -->
                        <h3 class="font-bold text-slate-900 text-base group-hover:text-blue-900 transition-colors line-clamp-2 leading-snug mb-2">
                            {{ $artTitle }}
                        </h3>

                        <!-- Excerpt / Snippet -->
                        <p class="line-clamp-2 text-slate-600 text-sm leading-relaxed mb-4">
                            {{ $artExcerpt }}
                        </p>
                    </div>

                    <!-- Card Footer -->
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs mt-auto">
                        <span class="font-medium text-slate-500">✍️ {{ $artAuthor }}</span>
                        <span class="font-bold text-[#0B192C] group-hover:text-blue-600 flex items-center gap-1 transition-colors">Tonton Video →</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <!-- Mobile Visual Scroll Indicator -->
        <div class="md:hidden flex items-center justify-center gap-1.5 mt-2">
            <span class="w-6 h-1.5 rounded-full bg-blue-600"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
        </div>

        <div class="text-center mt-10 md:mt-12">
            <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 border border-slate-300 text-slate-700 bg-white hover:bg-slate-100 hover:border-slate-400 px-6 py-3 rounded-full font-bold text-sm shadow-sm transition-all duration-200">
                <span>Lihat Semua Video &amp; Panduan Pengetahuan Lengkap →</span>
            </a>
        </div>

    </div>
</section>
