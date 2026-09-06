@if($latestArticles->isNotEmpty())
<section id="edukasi-tips-section" class="relative pt-12 sm:pt-16 pb-24 sm:pb-20 md:pb-24 bg-slate-50/60 border-t border-slate-200/60 scroll-mt-24 sm:scroll-mt-28" aria-labelledby="articles-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        {{-- Section Header --}}
        <div class="text-center mb-8 sm:mb-12">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-blue-50 text-blue-700 text-[11px] sm:text-xs font-bold uppercase tracking-wider mb-2.5 border border-blue-100/80 shadow-xs">
                📹 VIDEO EDUKASI &amp; PANDUAN PIPA
            </span>
            <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight font-['Plus_Jakarta_Sans',sans-serif]" id="articles-heading">
                Solusi Cerdas &amp; Tips <span class="bg-gradient-to-r from-blue-600 via-indigo-600 to-teal-600 bg-clip-text text-transparent">Rawat Saluran Air</span>
            </h2>
            <p class="text-xs sm:text-base text-slate-600 mt-2 max-w-2xl mx-auto leading-relaxed">
                Panduan praktis mencegah saluran mampet, merawat pipa, dan menjaga sanitasi rumah dari tim teknisi Rootera.
            </p>
        </div>

        {{-- Mobile Horizontal Scroll Slider / Tablet & Desktop 4-Col Grid --}}
        <div class="flex overflow-x-auto snap-x snap-mandatory gap-4 pb-3 no-scrollbar sm:grid sm:grid-cols-2 lg:grid-cols-4 sm:gap-5 sm:pb-0 px-1" style="touch-action: pan-y;">
            @foreach($latestArticles as $i => $article)
            @php
                $readingTime = $article->reading_time ?? 1;
                $authorName = $article->author ?: 'Rootera Plumbing';
            @endphp
            <article class="blog-card fade-in w-[80vw] max-w-[285px] sm:w-auto shrink-0 snap-start flex flex-col justify-between bg-white rounded-2xl border border-slate-200/80 shadow-xs hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden group" style="animation-delay:{{ $i * 0.1 }}s">
                
                {{-- Card Thumbnail Container --}}
                <div class="blog-card-img aspect-video w-full overflow-hidden bg-slate-900 relative">
                    <img src="{{ $article->thumbnail_url }}" 
                         alt="{{ $article->title }}" 
                         loading="lazy" 
                         width="400" 
                         height="225" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         onerror="this.onerror=null;this.src='{{ asset('images/JnJ.webp') }}';">
                    
                    {{-- Top Left Category Badge (Navy Solid Style) --}}
                    <div class="absolute top-2.5 left-2.5 z-10">
                        <span class="bg-[#0b2b64] text-white font-extrabold text-[10px] uppercase tracking-wider px-2.5 py-1 rounded-md shadow-xs">
                            EDUKASI &amp; VIDEO PANDUAN
                        </span>
                    </div>

                    {{-- Bottom Right Duration Badge --}}
                    <div class="absolute bottom-2.5 right-2.5 z-10">
                        <span class="bg-slate-900/80 backdrop-blur-xs text-white font-semibold text-[10px] px-2 py-0.5 rounded-md flex items-center gap-1 shadow-xs">
                            ⏱️ {{ $readingTime }} mnt
                        </span>
                    </div>

                    {{-- Center Red Play Button Overlay --}}
                    <div class="absolute inset-0 bg-black/25 flex items-center justify-center z-10 transition-opacity">
                        <div class="w-11 h-11 rounded-full bg-red-600/90 text-white flex items-center justify-center shadow-lg shadow-red-600/40 group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-0.5 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                </div>

                {{-- Card Body --}}
                <div class="blog-card-body flex flex-col flex-grow p-4 sm:p-4.5">
                    {{-- Meta Info (Date & Views) --}}
                    <div class="blog-card-date text-[11px] font-medium text-slate-500 mb-2 flex items-center gap-1.5">
                        <span class="flex items-center gap-1">
                            <svg class="w-3 h-3 text-slate-400 fill-none stroke-current" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            {{ $article->published_at?->translatedFormat('d F Y') ?? $article->created_at->translatedFormat('d F Y') }}
                        </span>
                        <span>•</span>
                        <span class="flex items-center gap-1">
                            👁 {{ number_format($article->views ?? 0) }} views
                        </span>
                    </div>

                    {{-- Title (Min-height for uniform alignment) --}}
                    <h3 class="text-sm sm:text-base font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors mb-1.5 line-clamp-2 min-h-[3rem] leading-snug font-['Plus_Jakarta_Sans',sans-serif]">
                        <a href="{{ route('blog.show', $article->slug) }}" class="text-decoration-none text-slate-900 group-hover:text-blue-600">
                            {{ $article->title }}
                        </a>
                    </h3>

                    {{-- Excerpt --}}
                    <p class="text-xs text-slate-500 line-clamp-2 mb-3 leading-relaxed flex-grow">
                        {{ Str::limit($article->excerpt, 85) }}
                    </p>

                    {{-- Card Footer --}}
                    <div class="border-t border-slate-100 pt-2.5 mt-auto flex justify-between items-center w-full">
                        <span class="text-[11px] font-semibold text-slate-500 truncate max-w-[120px]" title="{{ $authorName }}">
                            ✍️ {{ $authorName }}
                        </span>
                        <a href="{{ route('blog.show', $article->slug) }}" class="blog-card-link text-xs font-bold text-blue-600 hover:text-blue-700 shrink-0 inline-flex items-center gap-1 text-decoration-none">
                            <span>Baca Selengkapnya</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform fill-none stroke-current" stroke-width="2" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </a>
                    </div>
                </div>

            </article>
            @endforeach
        </div>

        <div class="text-center mt-8 sm:mt-10 pb-4 sm:pb-0">
            <a href="{{ route('blog') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 sm:px-8 sm:py-3.5 rounded-full bg-white hover:bg-slate-100 text-slate-800 font-extrabold text-xs sm:text-sm transition-all border border-slate-300/80 shadow-xs hover:shadow-sm text-decoration-none max-w-full">
                <span>Lihat Semua Artikel &amp; Video Panduan Rawat Saluran →</span>
            </a>
        </div>
    </div>
</section>
@endif
