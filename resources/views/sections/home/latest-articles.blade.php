@if($latestArticles->isNotEmpty())
<section id="edukasi-tips-section" class="relative pt-12 sm:pt-16 pb-24 sm:pb-20 md:pb-24 bg-slate-50/60 border-t border-slate-200/60 scroll-mt-24 sm:scroll-mt-28" aria-labelledby="articles-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        {{-- Section Header --}}
        <div class="text-center mb-8 sm:mb-12">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-blue-50 text-blue-700 text-[11px] sm:text-xs font-bold uppercase tracking-wider mb-2.5 border border-blue-100/80 shadow-xs">
                📚 ARTIKEL EDUKASI &amp; PANDUAN PIPA
            </span>
            <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight font-['Plus_Jakarta_Sans',sans-serif]" id="articles-heading">
                Solusi Cerdas &amp; Tips <span class="bg-gradient-to-r from-blue-600 via-indigo-600 to-teal-600 bg-clip-text text-transparent">Rawat Saluran Air</span>
            </h2>
            <p class="text-xs sm:text-base text-slate-600 mt-2 max-w-2xl mx-auto leading-relaxed">
                Panduan praktis mencegah saluran mampet, merawat pipa, dan menjaga sanitasi rumah dari tim teknisi Rootera.
            </p>
        </div>

        {{-- Mobile Horizontal Scroll Slider / Desktop 3-Col Grid --}}
        <div id="articles-slider-container"
             class="flex overflow-x-auto snap-x snap-mandatory gap-4 pb-3 no-scrollbar touch-pan-x touch-pan-y md:grid md:grid-cols-3 md:gap-6 md:pb-0 px-1"
             style="touch-action: pan-x pan-y; overscroll-behavior-x: contain; -webkit-overflow-scrolling: touch;">
            @foreach($latestArticles as $i => $article)
            @php
                $readingTime = $article->reading_time ?? 1;
                $authorName = $article->author ?: 'Tim Rootera';
                $formattedViews = ($article->views >= 1000) ? round($article->views / 1000, 1) . 'k' : ($article->views ?? 0);
                $publishDate = $article->published_at?->translatedFormat('d M Y') ?? $article->created_at->translatedFormat('d M Y');
            @endphp
            <article class="blog-card fade-in w-[82vw] sm:w-[320px] md:w-auto shrink-0 snap-center flex flex-col justify-between bg-white rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden group h-full" style="animation-delay:{{ $i * 0.1 }}s">
                
                {{-- Card Thumbnail Container --}}
                <div class="blog-card-img aspect-[16/9] w-full overflow-hidden bg-slate-900 relative">
                    <img src="{{ $article->thumbnail_url }}" 
                         alt="{{ $article->title }}" 
                         loading="lazy" 
                         width="400" 
                         height="225" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         onerror="this.onerror=null;this.src='{{ asset('images/JnJ.webp') }}';">
                    
                    {{-- Top Left Category Badge --}}
                    <div class="absolute top-2.5 left-2.5 z-10">
                        <span class="bg-[#0b2b64] text-white font-extrabold text-[10px] uppercase tracking-wider px-2.5 py-1 rounded-md shadow-xs">
                            ARTIKEL &amp; PANDUAN
                        </span>
                    </div>
                </div>

                {{-- Card Body --}}
                <div class="blog-card-body flex flex-col flex-grow p-4 sm:p-5 justify-between">
                    <div>
                        {{-- Single Row Meta Info (Date on left, Views & Duration on right) --}}
                        <div class="flex items-center justify-between text-[11px] text-slate-500 mb-2 font-medium">
                            <span class="flex items-center gap-1 shrink-0">
                                📅 {{ $publishDate }}
                            </span>
                            <span class="flex items-center gap-1 truncate text-slate-400">
                                👁️ {{ $formattedViews }} views • ⏱️ {{ $readingTime }} mnt
                            </span>
                        </div>

                        {{-- Title --}}
                        <h3 class="text-base font-bold text-slate-900 group-hover:text-emerald-600 transition-colors mb-1.5 line-clamp-2 leading-snug font-['Plus_Jakarta_Sans',sans-serif]">
                            <a href="{{ route('blog.show', $article->slug) }}" class="text-decoration-none text-slate-900 group-hover:text-emerald-600">
                                {{ $article->title }}
                            </a>
                        </h3>

                        {{-- Excerpt --}}
                        <p class="text-xs text-slate-600 line-clamp-2 mb-3 leading-relaxed">
                            {{ Str::limit($article->excerpt, 85) }}
                        </p>
                    </div>

                    {{-- Card Footer --}}
                    <div class="pt-2.5 border-t border-slate-100 mt-auto flex items-center justify-between text-xs w-full">
                        <span class="text-slate-500 font-medium truncate max-w-[110px]" title="{{ $authorName }}">
                            ✍️ {{ $authorName }}
                        </span>
                        <a href="{{ route('blog.show', $article->slug) }}" class="blog-card-link text-xs font-bold text-emerald-600 hover:text-emerald-700 shrink-0 inline-flex items-center gap-1 text-decoration-none">
                            <span>Baca Selengkapnya</span>
                            <span class="group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                    </div>
                </div>

            </article>
            @endforeach
        </div>

        <!-- Mobile Dynamic Interactive Carousel Dots (Margin Bottom Safety) -->
        <div id="articles-dots-container" class="md:hidden flex items-center justify-center gap-1.5 mt-3 mb-4">
            @foreach($latestArticles as $index => $article)
                <button type="button" 
                        onclick="scrollToSliderItem('articles-slider-container', {{ $index }})" 
                        aria-label="Geser ke slide {{ $index + 1 }}" 
                        class="transition-all duration-300 rounded-full h-1.5 {{ $index === 0 ? 'w-6 bg-emerald-500' : 'w-1.5 bg-slate-300' }}">
                </button>
            @endforeach
        </div>

        <div class="text-center mt-6 sm:mt-10 pb-4 sm:pb-0">
            <a href="{{ route('blog') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 sm:px-8 sm:py-3.5 rounded-full bg-white hover:bg-slate-100 text-slate-800 font-extrabold text-xs sm:text-sm transition-all border border-slate-300/80 shadow-xs hover:shadow-sm text-decoration-none max-w-full">
                <span>Lihat Semua Artikel &amp; Panduan Rawat Saluran →</span>
            </a>
        </div>
    </div>
</section>
@endif
