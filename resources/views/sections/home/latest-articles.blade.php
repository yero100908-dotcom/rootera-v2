@if($latestArticles->isNotEmpty())
<section class="section" aria-labelledby="articles-heading">
    <div class="container">
        <div class="text-center" style="margin-bottom:3rem">
            <span class="badge badge-blue">Blog & Tips</span>
            <h2 class="section-title" id="articles-heading" style="margin-top:.75rem">
                Pengetahuan <span>Terbaru</span>
            </h2>
            <p class="section-sub">Panduan dan tips seputar perawatan pipa, saluran air, dan sanitasi rumah dari para ahli ROOTERA.</p>
        </div>
        <div class="cards-grid">
            @foreach($latestArticles as $i => $article)
            <article class="blog-card fade-in" style="animation-delay:{{ $i * 0.1 }}s">
                <div class="blog-card-img">
                    @if($article->thumbnail)
                        <img src="{{ asset('storage/'.$article->thumbnail) }}" alt="{{ $article->title }}" loading="lazy" width="400" height="225">
                    @else
                        <div style="background:linear-gradient(135deg,#0A2E78,#169F81);height:180px;display:flex;align-items:center;justify-content:center;font-size:3rem">📰</div>
                    @endif
                </div>
                <div class="blog-card-body">
                    <div class="blog-card-date">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        {{ $article->published_at?->translatedFormat('d M Y') ?? $article->created_at->translatedFormat('d M Y') }}
                    </div>
                    <h3>{{ $article->title }}</h3>
                    <p>{{ Str::limit($article->excerpt, 100) }}</p>
                    <a href="{{ route('blog.show', $article->slug) }}" class="blog-card-link">
                        Baca Selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
        <div class="text-center" style="margin-top:2.5rem">
            <a href="{{ route('blog') }}" class="btn btn-secondary">Lihat Semua Artikel</a>
        </div>
    </div>
</section>
@endif
