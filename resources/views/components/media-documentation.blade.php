{{-- 
  Komponen Media Dokumentasi Lapangan & Gallery Showcase Preview
  Style: Luxury, Modern, High-Trust (Deep Navy #0B192C, Emerald #10B981)
--}}
@props([
    'projectShowcases' => null,
    'relatedArticles' => null,
    'locationName' => null,
    'locationShort' => null,
    'galleryShowcaseItems' => null,
    'articlesToDisplay' => null,
])

<?php
$locName = $locationName ?? $locationShort ?? 'Wilayah Layanan';
$locShort = $locationShort ?? $locationName ?? 'Area Layanan';
$mediaService = app(\App\Services\MediaService::class);
$toolkitImages = $mediaService->getToolkitImages();

// 4 Curated Real Portfolio Items with official /galeri-dokumentasi/{slug} URL structure
$fourPortfolioItems = [
    [
        'title'       => 'Pelancaran Drainase Kitchen Soichiro Japanese Steakhouse',
        'slug'        => 'pelancaran-drainase-kitchen-soichiro-japanese-steakhouse',
        'category'    => 'Restoran & Kafe',
        'location'    => 'Jakarta',
        'description' => 'Penanganan sumbatan pembekuan lemak pada saluran drainase dapur komersial restoran Soichiro Japanese Steakhouse menggunakan mesin spiral rotary tanpa merusak keramik.',
        'image'       => asset('images/dokumentasi/pelancaran-drainase-kitchen-soichiro-steakhouse-jakarta.webp'),
        'url'         => url('/galeri-dokumentasi/pelancaran-drainase-kitchen-soichiro-japanese-steakhouse'),
        'width'       => 600,
        'height'      => 375,
    ],
    [
        'title'       => 'Pelancaran Floor Drain Kamar Mandi Rumah Tinggal',
        'slug'        => 'pelancaran-floor-drain-kamar-mandi-rumah-tinggal',
        'category'    => 'Rumah Tinggal',
        'location'    => 'Jakarta',
        'description' => 'Proses pengerjaan pelancaran saringan dan pipa floor drain kamar mandi perumahan secara cepat tanpa membongkar ubin.',
        'image'       => asset('images/dokumentasi/pelancar-floor-drain-kamar-mandi-rumah.webp'),
        'url'         => url('/galeri-dokumentasi/pelancaran-floor-drain-kamar-mandi-rumah-tinggal'),
        'width'       => 600,
        'height'      => 375,
    ],
    [
        'title'       => 'Inspeksi Kamera CCTV Pipa Tersumbat Lemak',
        'slug'        => 'inspeksi-kamera-cctv-pipa-tersumbat-lemak',
        'category'    => 'Inspeksi CCTV',
        'location'    => 'Jabodetabek',
        'description' => 'Tampilan monitor kamera CCTV yang menampilkan akumulasi lemak membatu di dinding dalam pipa pembuangan.',
        'image'       => asset('images/dokumentasi/inspeksi-kamera-cctv-pipa-tersumbat.webp'),
        'url'         => url('/galeri-dokumentasi/inspeksi-kamera-cctv-pipa-tersumbat-lemak'),
        'width'       => 600,
        'height'      => 375,
    ],
    [
        'title'       => 'Proyek Pelancaran Saluran Mall Banjarmasin (Part 1)',
        'slug'        => 'proyek-pelancaran-saluran-mall-banjarmasin-part-1',
        'category'    => 'Gedung & Pabrik',
        'location'    => 'Banjarmasin, Kalsel',
        'description' => 'Ekspansi layanan nasional Rootera Plumbing menangani proyek pelancaran saluran pembuangan utama Mall Banjarmasin.',
        'image'       => asset('images/dokumentasi/pelancaran-saluran-mampet-mall-banjarmasin-1.webp'),
        'url'         => url('/galeri-dokumentasi/proyek-pelancaran-saluran-mall-banjarmasin-part-1'),
        'width'       => 600,
        'height'      => 375,
    ],
];

// Resolve articles to display from props or query DB directly
if (empty($articlesToDisplay) || (is_countable($articlesToDisplay) && count($articlesToDisplay) === 0)) {
    if (!empty($relatedArticles) && (is_countable($relatedArticles) && count($relatedArticles) > 0)) {
        $articlesToDisplay = $relatedArticles;
    } else {
        $articlesToDisplay = \App\Models\Article::published()
            ->latest('published_at')
            ->take(3)
            ->get();
    }
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
                    <img src="{{ $tool['url'] }}" alt="{{ $tool['alt'] }} - {{ $locName }}" width="400" height="250" class="w-full h-full object-contain md:object-cover rounded-lg md:rounded-none" loading="lazy" decoding="async" onerror="this.onerror=null;this.src='{{ asset('assets/TOOLKIT/mesin-rooter-ridgid-k50-spiral-baja.webp') }}';">
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

<!-- Section 2: Gallery Showcase Preview Grid with Lightbox Modal -->
<section class="py-8 px-4 md:py-[4.5rem] md:px-6 bg-gradient-to-b from-slate-50 to-blue-50/50 border-t border-b border-slate-200"
         id="dokumentasi-lapangan"
         x-data="{ openModal: false, modalImg: '', modalTitle: '', modalDesc: '', modalCategory: '', modalLocation: '', modalUrl: '' }">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <!-- Section Header -->
        <div class="text-center mb-6 md:mb-12">
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

        <!-- 4 Curated Real Gallery Cards (Mobile Horizontal Swipe Carousel, Grid on Desktop) -->
        <div class="flex overflow-x-auto snap-x snap-mandatory gap-3 sm:gap-4 lg:gap-6 pb-4 sm:pb-0 mobile-scrollbar touch-pan-x touch-pan-y sm:grid sm:grid-cols-2 lg:grid-cols-4 sm:overflow-visible -mx-4 px-4 sm:mx-0 sm:px-0" style="touch-action: pan-x pan-y; overscroll-behavior-x: contain; -webkit-overflow-scrolling: touch;">
            @foreach($fourPortfolioItems as $pIdx => $item)
            <div class="w-[82vw] min-w-[82vw] sm:w-auto sm:min-w-0 shrink-0 snap-center bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:border-emerald-400 transition-all duration-300 flex flex-col justify-between group">
                
                {{-- Image Box with Hover Overlay & Lightbox Click --}}
                <div class="relative aspect-[16/10] w-full overflow-hidden bg-slate-900 cursor-pointer"
                     @click="openModal = true; modalImg = '{{ $item['image'] }}'; modalTitle = '{{ addslashes($item['title']) }}'; modalDesc = '{{ addslashes($item['description']) }}'; modalCategory = '{{ $item['category'] }}'; modalLocation = '{{ $item['location'] }}'; modalUrl = '{{ $item['url'] }}'">
                    
                    <img src="{{ $item['image'] }}"
                         alt="{{ $item['title'] }} - Rootera Plumbing {{ $locName }}"
                         loading="lazy"
                         decoding="async"
                         width="{{ $item['width'] }}"
                         height="{{ $item['height'] }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                         onerror="this.onerror=null;this.src='/images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp';">

                    {{-- Badges --}}
                    <span class="absolute top-2 left-2 sm:top-2.5 sm:left-2.5 bg-slate-900/90 text-emerald-400 border border-emerald-500/30 text-[10px] sm:text-xs font-extrabold px-2 py-0.5 sm:px-2.5 sm:py-1 rounded-full backdrop-blur-sm uppercase z-10 shadow-sm">
                        🏷️ {{ $item['category'] }}
                    </span>
                    <span class="absolute top-2 right-2 sm:top-2.5 sm:right-2.5 bg-emerald-600/90 text-white text-[10px] sm:text-xs font-extrabold px-2 py-0.5 sm:px-2.5 sm:py-1 rounded-full backdrop-blur-sm z-10 shadow-sm">
                        📍 {{ $item['location'] }}
                    </span>

                    {{-- Hover Overlay & Eye Icon Button --}}
                    <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center z-20">
                        <span class="bg-emerald-500 hover:bg-emerald-400 text-white px-3 py-1.5 rounded-full font-extrabold text-xs flex items-center gap-1.5 shadow-lg transform group-hover:scale-105 transition-all">
                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                            <span>Pratinjau Foto</span>
                        </span>
                    </div>
                </div>

                {{-- Card Content Body --}}
                <div class="p-3.5 sm:p-4 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-sm sm:text-base font-bold text-slate-900 leading-snug group-hover:text-emerald-600 transition-colors line-clamp-2">
                            <a href="{{ $item['url'] }}" class="text-inherit no-underline">
                                {{ $item['title'] }}
                            </a>
                        </h3>
                        <p class="text-xs text-slate-600 mt-1.5 line-clamp-2 leading-relaxed">
                            {{ $item['description'] }}
                        </p>
                    </div>

                    {{-- Card Footer Action Buttons --}}
                    <div class="pt-3 border-t border-slate-100 mt-3 flex items-center justify-between gap-2">
                        <a href="{{ $item['url'] }}" class="text-xs font-bold text-slate-700 hover:text-emerald-600 transition-colors no-underline flex items-center gap-1">
                            <span>Studi Kasus</span><span>→</span>
                        </a>
                        <a href="https://wa.me/{{ $city->whatsapp_number ?? '6281385404000' }}?text={{ urlencode('Halo Rootera, saya ingin konsultasi penanganan seperti ' . $item['title'] . ' di area ' . $locName) }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="bg-emerald-100 hover:bg-emerald-500 text-emerald-800 hover:text-white text-xs font-bold px-2.5 py-1 rounded-full transition-all duration-200 no-underline shrink-0 flex items-center gap-1 shadow-sm">
                            <span>💬 Konsultasi</span>
                        </a>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

        {{-- Mobile Visual Scroll Indicator --}}
        <div class="sm:hidden flex items-center justify-center gap-1.5 mt-3 select-none">
            <span class="w-6 h-1.5 rounded-full bg-emerald-500"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
        </div>

        {{-- Call-To-Action Button to Main Gallery Page --}}
        <div class="text-center mt-6 md:mt-10">
            <a href="{{ route('galeri') }}" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-emerald-600 text-white px-6 py-3 rounded-full font-extrabold text-xs md:text-sm text-decoration-none shadow-md transition-all">
                <span>Lihat Portofolio &amp; Dokumentasi Lengkap di Galeri Kami →</span>
            </a>
        </div>

        {{-- Lightbox Modal Container (Alpine.js Responsive Overlay) --}}
        <div x-show="openModal" 
             x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @keydown.escape.window="openModal = false"
             class="fixed inset-0 z-[9999] flex items-center justify-center p-4 sm:p-6 bg-slate-950/85 backdrop-blur-md overflow-y-auto">
            
            <div @click.away="openModal = false" 
                 class="relative bg-white rounded-3xl max-w-3xl w-full overflow-hidden shadow-2xl border border-slate-200 transform transition-all my-8">
                
                {{-- Close Button X --}}
                <button @click="openModal = false" 
                        class="absolute top-4 right-4 z-30 w-10 h-10 rounded-full bg-slate-900/80 hover:bg-slate-900 text-white font-bold text-lg flex items-center justify-center transition-transform hover:scale-110 active:scale-95 shadow-md">
                    ✕
                </button>

                {{-- Modal Image Container --}}
                <div class="relative aspect-video w-full bg-slate-950 overflow-hidden flex items-center justify-center">
                    <img :src="modalImg" :alt="modalTitle" class="w-full h-full object-contain">
                    
                    <div class="absolute top-4 left-4 flex items-center gap-2">
                        <span class="bg-slate-900/90 text-emerald-400 border border-emerald-500/30 text-xs font-extrabold px-3 py-1 rounded-full uppercase shadow-md" x-text="'🏷️ ' + modalCategory"></span>
                        <span class="bg-emerald-600/90 text-white text-xs font-extrabold px-3 py-1 rounded-full shadow-md" x-text="'📍 ' + modalLocation"></span>
                    </div>
                </div>

                {{-- Modal Content Body --}}
                <div class="p-6 md:p-8 bg-white">
                    <h3 class="text-lg md:text-2xl font-extrabold text-slate-900 leading-tight" x-text="modalTitle"></h3>
                    <p class="text-xs md:text-sm text-slate-600 mt-3 leading-relaxed" x-text="modalDesc"></p>

                    <div class="mt-6 pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <a :href="modalUrl" class="text-xs md:text-sm font-bold text-slate-700 hover:text-emerald-600 underline">
                            Lihat Halaman Detail Portofolio →
                        </a>
                        <a :href="'https://wa.me/{{ $city->whatsapp_number ?? '6281385404000' }}?text=' + encodeURIComponent('Halo Rootera, saya ingin konsultasi penanganan seperti ' + modalTitle + ' di area {{ $locName }}')" 
                           target="_blank"
                           rel="noopener noreferrer" 
                           class="w-full sm:w-auto bg-emerald-500 hover:bg-emerald-600 text-white font-extrabold text-xs md:text-sm px-6 py-3 rounded-full shadow-md text-center transition-transform active:scale-95 flex items-center justify-center gap-2 no-underline">
                            <span>💬 Konsultasi Sekarang via WA</span>
                        </a>
                    </div>
                </div>

            </div>
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
                    🎬 EDUKASI &amp; VIDEO PANDUAN
                </span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 leading-tight">
                    Lihat Aksi Teknisi Rootera Melancarkan Pipa
                </h2>
                <p class="text-slate-600 text-sm md:text-base max-w-2xl mt-2 leading-relaxed">
                    Video penanganan pengerjaan pipa tersumbat lemak beku &amp; kerak menggunakan mesin fleksibel Ridgid &amp; Hydro Jetting di {{ $locName }}.
                </p>
            </div>
            <div>
                <a href="https://wa.me/{{ $city->whatsapp_number ?? '6281385404000' }}?text={{ urlencode('Halo Rootera, saya ingin pesan layanan pipa mampet untuk area ' . $locName) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 bg-[#0B192C] hover:bg-blue-900 text-white font-bold text-sm px-5 py-3 rounded-xl shadow-md transition-all duration-200 no-underline">
                    <span>📞 Panggil Teknisi (24 Jam)</span>
                </a>
            </div>
        </div>

        <!-- Clean Modern Video Cards (Horizontal Snap Carousel on Mobile, Grid on Desktop) -->
        <div class="flex overflow-x-auto snap-x snap-mandatory gap-4 pb-4 mobile-scrollbar touch-pan-x touch-pan-y px-4 -mx-4 md:grid md:grid-cols-3 md:gap-6 md:pb-0 md:px-0 md:mx-0" style="touch-action: pan-x pan-y; overscroll-behavior-x: contain; -webkit-overflow-scrolling: touch;">
            @foreach($articlesToDisplay as $artIdx => $art)
            <?php
                $isArtObj = is_object($art);
                $artTitle = $isArtObj ? ($art->clean_title ?: $art->title) : ($art['title'] ?? '');
                $artSlug = $isArtObj ? $art->slug : ($art['slug'] ?? '#');
                $artCategory = $isArtObj ? (strtoupper($art->category ?? 'EDUKASI & VIDEO PANDUAN')) : ($art['category'] ?? 'EDUKASI & VIDEO PANDUAN');
                $artUrl = ($artSlug && $artSlug !== '#') ? url('/blog/' . $artSlug) : route('blog');
                
                if ($isArtObj) {
                    $artThumb = $art->thumbnail_url;
                    $artDuration = '⏱ ' . ($art->reading_time ?? 1) . ' mnt';
                    $artDate = $art->published_at ? $art->published_at->format('d M Y') : 'Terbaru';
                    $artViews = number_format($art->views ?? 1250);
                    $artAuthor = $art->author ?: 'Rootera Plumbing';
                    $artExcerpt = $art->excerpt ?: 'Klik untuk membaca artikel panduan penanganan pipa mampet teknisi Rootera di lapangan.';
                } else {
                    $artThumb = $art['thumbnail'] ?? $toolkitImages['ridgid_k50']['url'];
                    $artDuration = $art['duration'] ?? '⏱ 1 mnt';
                    $artDate = $art['published_at'] ?? 'Terbaru';
                    $artViews = $art['views'] ?? '1.2k';
                    $artAuthor = $art['author'] ?? 'Rootera Plumbing';
                    $artExcerpt = $art['excerpt'] ?? 'Klik untuk membaca artikel panduan penanganan pipa mampet teknisi Rootera di lapangan.';
                }
            ?>
            <a href="{{ $artUrl }}" class="w-[82vw] max-w-[320px] flex-shrink-0 snap-center md:w-auto bg-white rounded-2xl shadow-sm hover:shadow-md border border-slate-100 overflow-hidden flex flex-col justify-between transition-all duration-300 group block text-left text-slate-800 no-underline">
                <!-- Thumbnail Container -->
                <div class="relative aspect-video w-full overflow-hidden bg-slate-100">
                    <img src="{{ $artThumb }}" alt="{{ $artTitle }} - Rootera Plumbing" width="480" height="270" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" loading="lazy" decoding="async" onerror="this.onerror=null;this.src='{{ asset('assets/TOOLKIT/mesin-rooter-ridgid-k50-spiral-baja.webp') }}';">
                    
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
            <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 border border-slate-300 text-slate-700 bg-white hover:bg-slate-100 hover:border-slate-400 px-6 py-3 rounded-full font-bold text-sm shadow-sm transition-all duration-200 no-underline">
                <span>Lihat Semua Video &amp; Panduan Pengetahuan Lengkap →</span>
            </a>
        </div>

    </div>
</section>
