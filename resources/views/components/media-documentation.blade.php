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
<section style="background: #ffffff; padding: 4rem 1.5rem; border-top: 1px solid #E2E8F0;" id="teknologi-alat">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 3rem;">
            <span style="color: #10B981; font-weight: 800; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.05em;">
                🛠️ Standar Teknologi &amp; Peralatan Canggih
            </span>
            <h2 style="color: #0B192C; font-size: clamp(1.8rem, 3.5vw, 2.4rem); font-weight: 800; margin-top: 0.4rem;">
                Peralatan Modern Teknisi Rootera di {{ $locShort }}
            </h2>
            <p style="color: #64748B; max-width: 720px; margin: 0.5rem auto 0; font-size: 1rem; line-height: 1.6;">
                Seluruh armada penanganan pipa tersumbat di {{ $locName }} dibekali peralatan standar industri tanpa bongkar ubin/keramik.
            </p>
        </div>

        <!-- Section 1: Equipment Carousel/Grid -->
        <div class="flex overflow-x-auto snap-x snap-mandatory gap-4 pb-4 no-scrollbar touch-pan-x md:grid md:grid-cols-2 lg:grid-cols-3 md:overflow-visible md:pb-0 md:gap-6">
            @foreach($toolkitImages as $key => $tool)
            <div class="min-w-[82vw] sm:min-w-[300px] snap-center shrink-0 md:min-w-0 hover:-translate-y-1.5 hover:border-emerald-400" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.03); transition: transform 0.3s ease;">
                <div style="height: 180px; background: #F1F5F9; overflow: hidden; position: relative;">
                    <img src="{{ $tool['url'] }}" alt="{{ $tool['alt'] }} - {{ $locName }}" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy" decoding="async" onerror="this.onerror=null;this.src='{{ asset('assets/TOOLKIT/mesin-rooter-ridgid-k50-spiral-baja.webp') }}';">
                    <span style="position: absolute; top: 10px; right: 10px; background: rgba(16, 185, 129, 0.9); color: #ffffff; font-size: 0.72rem; font-weight: 800; padding: 0.2rem 0.6rem; border-radius: 50px; text-transform: uppercase;">
                        ✓ Alat Resmi
                    </span>
                </div>
                <div style="padding: 1.25rem;">
                    <h3 style="font-size: 1.05rem; font-weight: 800; color: #0B192C; margin-bottom: 0.35rem;">
                        {{ $tool['title'] }}
                    </h3>
                    <p style="color: #64748B; font-size: 0.85rem; line-height: 1.5; margin: 0;">
                        {{ $tool['desc'] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Section 2: Gallery Showcase Preview Grid -->
<section style="background: linear-gradient(180deg, #F8FAFC 0%, #EFF6FF 100%); padding: 4.5rem 1.5rem; border-top: 1px solid #E2E8F0; border-bottom: 1px solid #E2E8F0;" id="dokumentasi-lapangan">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <!-- Section Header -->
        <div style="text-align: center; margin-bottom: 3.5rem;">
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #059669; padding: 0.4rem 1.2rem; border-radius: 50px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.75rem;">
                <span style="display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: #10B981; box-shadow: 0 0 10px #10B981;"></span>
                PORTFOLIO &amp; DOKUMENTASI PENGERJAAN
            </div>
            <h2 style="color: #0B192C; font-size: clamp(1.8rem, 3.5vw, 2.5rem); font-weight: 800; margin-top: 0.4rem; letter-spacing: -0.02em;">
                Dokumentasi Lapangan &amp; Hasil Kerja Teknisi Rootera
            </h2>
            <p style="color: #64748B; max-width: 780px; margin: 0.6rem auto 0; font-size: 1.05rem; line-height: 1.6;">
                Cuplikan pengerjaan nyata pelancaran saluran air, wastafel, kloset, dan got tanpa bongkar menggunakan mesin rotary spiral modern.
            </p>
        </div>

        <!-- Gallery Showcase Preview Carousel/Grid -->
        <div class="flex overflow-x-auto snap-x snap-mandatory gap-4 pb-4 no-scrollbar touch-pan-x md:grid md:grid-cols-2 lg:grid-cols-4 md:overflow-visible md:pb-0 md:gap-6">
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
            <div class="min-w-[82vw] sm:min-w-[280px] snap-center shrink-0 md:min-w-0 hover:-translate-y-1.5 hover:shadow-xl hover:border-emerald-400/50 group flex flex-col justify-between" style="background: #ffffff; border-radius: 18px; border: 1px solid #E2E8F0; overflow: hidden; box-shadow: 0 4px 20px rgba(11, 25, 44, 0.04); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                <!-- Image Container with Job Type Badge -->
                <div style="position: relative; height: 210px; background: #F1F5F9; overflow: hidden; cursor: pointer;" onclick="openMediaModal('{{ $gMediaType }}', '{{ $gMedia }}', '{{ addslashes($gTitle) }}', '{{ $gBeforeImg }}', '{{ urlencode($gTitle) }}')">
                    <img src="{{ $gThumb }}" alt="{{ $gTitle }} - Rootera Plumbing" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" class="group-hover:scale-105" loading="lazy" decoding="async" onerror="this.src='/images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'">
                    
                    <!-- Job Type Badge Overlay -->
                    <span style="position: absolute; top: 12px; left: 12px; background: rgba(11, 25, 44, 0.85); color: #34D399; border: 1px solid rgba(52, 211, 153, 0.3); font-size: 0.72rem; font-weight: 800; padding: 0.25rem 0.75rem; border-radius: 50px; backdrop-filter: blur(4px); text-transform: uppercase;">
                        🏷️ {{ $gCategory }}
                    </span>

                    <!-- Visual Zoom Icon Overlay -->
                    <div style="position: absolute; inset: 0; background: rgba(11, 25, 44, 0.25); opacity: 0; transition: opacity 0.3s ease; display: flex; align-items: center; justify-content: center;" class="group-hover:opacity-100">
                        <span style="background: rgba(16, 185, 129, 0.95); color: #ffffff; width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(0,0,0,0.2); font-size: 1.2rem;">
                            🔍
                        </span>
                    </div>
                </div>

                <!-- Showcase Item Details -->
                <div style="padding: 1.25rem; display: flex; flex-direction: column; justify-content: space-between; flex-grow: 1;">
                    <div>
                        <h3 style="font-size: 1.05rem; font-weight: 800; color: #0B192C; margin: 0 0 0.5rem; line-height: 1.4;" class="group-hover:text-emerald-600 transition-colors">
                            <a href="{{ $gUrl }}" style="color: inherit; text-decoration: none;">
                                {{ $gTitle }}
                            </a>
                        </h3>
                    </div>

                    <div style="display: flex; align-items: center; justify-content: space-between; border-top: 1px solid #F1F5F9; padding-top: 0.75rem; margin-top: 0.75rem; font-size: 0.8rem;">
                        <span style="color: #10B981; font-weight: 700; display: inline-flex; align-items: center; gap: 0.25rem;">
                            ✓ Tanpa Bongkar
                        </span>
                        <a href="{{ $gUrl }}" style="color: #0284C7; font-weight: 800; text-decoration: none;" class="hover:underline">
                            Detail →
                        </a>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

        <!-- Call-To-Action Button to Main Gallery Page -->
        <div style="text-align: center; margin-top: 3rem;">
            <a href="{{ route('galeri') }}" style="display: inline-flex; align-items: center; gap: 0.6rem; background: #0B192C; color: #ffffff; padding: 0.95rem 2.25rem; border-radius: 50px; font-weight: 800; font-size: 0.95rem; text-decoration: none; box-shadow: 0 10px 25px rgba(11, 25, 44, 0.15); transition: all 0.25s ease;" class="hover:bg-emerald-600 hover:scale-105 active:scale-95">
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
        <div class="flex overflow-x-auto snap-x snap-mandatory gap-4 pb-4 no-scrollbar touch-pan-x px-4 -mx-4 md:grid md:grid-cols-3 md:gap-6 md:pb-0 md:px-0 md:mx-0">
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

        <div class="text-center mt-10 md:mt-12">
            <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 border border-slate-300 text-slate-700 bg-white hover:bg-slate-100 hover:border-slate-400 px-6 py-3 rounded-full font-bold text-sm shadow-sm transition-all duration-200">
                <span>Lihat Semua Video &amp; Panduan Pengetahuan Lengkap →</span>
            </a>
        </div>

    </div>
</section>
