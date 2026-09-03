@if($latestArticles->isNotEmpty())
<section class="section py-10 sm:py-16 bg-slate-50/50" aria-labelledby="articles-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-6 sm:mb-10">
            <span class="inline-block px-3.5 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold uppercase tracking-wider mb-2 border border-blue-100">
                📰 Blog &amp; Tips
            </span>
            <h2 class="section-title text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight font-['Plus_Jakarta_Sans',sans-serif]" id="articles-heading">
                Pengetahuan <span class="text-blue-600">Terbaru</span>
            </h2>
            <p class="section-sub text-xs sm:text-base text-slate-600 mt-1.5 max-w-2xl mx-auto">
                Panduan dan tips seputar perawatan pipa, saluran air, dan sanitasi rumah dari para ahli Rootera.
            </p>
        </div>

        {{-- Mobile Horizontal Scroll Slider / Desktop 3-Col Grid --}}
        <div class="flex overflow-x-auto snap-x snap-mandatory gap-4 sm:gap-5 pb-4 no-scrollbar md:grid md:grid-cols-3 md:gap-6 md:pb-0">
            @foreach($latestArticles as $i => $article)
            <article class="blog-card fade-in w-[280px] sm:w-[320px] md:w-auto shrink-0 snap-start flex flex-col justify-between bg-white rounded-2xl border border-slate-200/90 shadow-2xs hover:shadow-md transition-all overflow-hidden" style="animation-delay:{{ $i * 0.1 }}s">
                <div class="blog-card-img h-44 sm:h-48 w-full overflow-hidden bg-slate-900 relative">
                    <img src="{{ $article->thumbnail_url }}" 
                         alt="{{ $article->title }}" 
                         loading="lazy" 
                         width="400" 
                         height="225" 
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                         onerror="this.onerror=null;this.src='{{ asset('images/JnJ.webp') }}';">
                </div>
                <div class="blog-card-body flex flex-col flex-grow p-4 sm:p-5">
                    <div class="blog-card-date text-xs text-slate-400 mb-2 flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        {{ $article->published_at?->translatedFormat('d M Y') ?? $article->created_at->translatedFormat('d M Y') }}
                    </div>
                    <h3 class="text-sm sm:text-base font-extrabold text-slate-900 hover:text-blue-600 transition-colors mb-1.5 line-clamp-2 leading-snug">{{ $article->title }}</h3>
                    <p class="text-xs text-slate-600 line-clamp-3 mb-4 flex-grow leading-relaxed">{{ Str::limit($article->excerpt, 90) }}</p>
                    <a href="{{ route('blog.show', $article->slug) }}" class="blog-card-link text-xs font-bold text-blue-600 hover:text-blue-700 inline-flex items-center gap-1.5 mt-auto">
                        <span>Baca Selengkapnya</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        <div class="text-center mt-6 sm:mt-8">
            <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs sm:text-sm transition-all border border-slate-200">
                <span>Lihat Semua Artikel</span>
                <span>&rarr;</span>
            </a>
        </div>
    </div>
</section>
@endif
