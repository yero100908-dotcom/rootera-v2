@if($latestArticles->isNotEmpty())
<section class="section bg-white" aria-labelledby="articles-heading">
    <div class="container">
        <div class="text-center mb-12">
            <span class="badge badge-blue">Pengetahuan & Edukasi</span>
            <h2 class="section-title" id="articles-heading">
                Tips & Artikel <span>Terbaru</span>
            </h2>
            <p class="section-sub">Panduan praktis merawat saluran air, mencegah mampet, dan menjaga kebersihan sanitasi dari tim ahli Rootera.</p>
        </div>

        <div class="cards-grid">
            @foreach($latestArticles as $i => $article)
            <article class="blog-card card-elevation group overflow-hidden flex flex-col h-full" style="animation-delay:{{ $i * 0.1 }}s">
                <div class="blog-card-img aspect-[16/9] overflow-hidden relative bg-slate-100">
                    @if($article->thumbnail)
                        <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy" width="400" height="225">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-slate-900 to-teal-900 flex items-center justify-center text-4xl">📰</div>
                    @endif
                    <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-xs font-bold text-slate-800 shadow-sm">
                        {{ $article->published_at?->translatedFormat('d M Y') ?? $article->created_at->translatedFormat('d M Y') }}
                    </div>
                </div>

                <div class="p-6 flex flex-col flex-1 justify-between">
                    <div>
                        <h3 class="text-slate-900 text-lg font-bold mb-3 leading-snug group-hover:text-teal-600 transition-colors">
                            <a href="{{ route('blog.show', $article->slug) }}">{{ $article->title }}</a>
                        </h3>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6">
                            {{ Str::limit($article->excerpt, 110) }}
                        </p>
                    </div>

                    <a href="{{ route('blog.show', $article->slug) }}" class="inline-flex items-center gap-2 text-sm font-bold text-teal-600 group-hover:text-teal-700 transition-all">
                        <span>Baca Selengkapnya</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('blog') }}" class="btn btn-secondary shadow-sm hover:shadow-md">
                <span>Lihat Seluruh Artikel & Tips</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>
@endif
