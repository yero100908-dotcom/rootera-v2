@extends('layouts.app')

@push('styles')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "{{ $article->title }}",
  "description": "{{ $article->excerpt }}",
  "author": {"@type":"Person","name":"{{ $article->author }}"},
  "datePublished": "{{ $article->published_at?->toIso8601String() }}",
  "dateModified": "{{ $article->updated_at->toIso8601String() }}",
  "publisher": {"@type":"Organization","name":"ROOTERA","logo":{"@type":"ImageObject","url":"{{ asset('images/logo.png') }}"}},
  "mainEntityOfPage": {"@type":"WebPage","@id":"{{ url()->current() }}"}
}
</script>
@endpush

@section('content')
<div style="background:linear-gradient(135deg,#0A2E78,#0d3a94);padding:5rem 0 4rem">
    <div class="container" style="position:relative;z-index:1">
        <div style="max-width:800px;margin:0 auto">
            <a href="{{ route('blog') }}" style="display:inline-flex;align-items:center;gap:.4rem;color:rgba(255,255,255,.7);font-size:.88rem;margin-bottom:1.5rem;transition:color .2s" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,.7)'">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Kembali ke Blog
            </a>
            <h1 style="color:#fff;font-size:clamp(1.6rem,3.5vw,2.4rem);margin-bottom:1rem;line-height:1.2">{{ $article->title }}</h1>
            <div style="display:flex;align-items:center;gap:1.5rem;color:rgba(255,255,255,.7);font-size:.88rem;flex-wrap:wrap">
                <span>✍️ {{ $article->author }}</span>
                <span>📅 {{ $article->published_at?->translatedFormat('d F Y') }}</span>
                <span>👁️ {{ number_format($article->views) }} kali dibaca</span>
            </div>
        </div>
    </div>
</div>

<section class="section" aria-label="Konten artikel">
    <div class="container">
        <div class="article-body">
            @if($article->thumbnail)
            <figure style="margin-bottom:2.5rem;border-radius:16px;overflow:hidden">
                <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" style="width:100%;height:auto" loading="eager">
            </figure>
            @endif
            <div style="color:#374151">
                {!! $article->content !!}
            </div>
            <div style="margin-top:3rem;padding:2rem;background:#f0fdf4;border-radius:16px;border:1px solid #bbf7d0">
                <p style="font-size:.92rem;color:#166534;margin:0">
                    <strong>💡 Butuh bantuan profesional?</strong> Jika masalah pipa Anda tidak bisa diatasi sendiri, jangan ragu hubungi tim ROOTERA.
                    <a href="https://wa.me/6281385404000" style="color:#169F81;font-weight:600" target="_blank" rel="noopener">Chat WhatsApp sekarang →</a>
                </p>
            </div>
        </div>
    </div>
</section>

@if($relatedArticles->isNotEmpty())
<section class="section bg-offwhite" aria-labelledby="related-heading">
    <div class="container">
        <h2 id="related-heading" class="section-title text-center" style="margin-bottom:2.5rem">Artikel <span>Terkait</span></h2>
        <div class="cards-grid">
            @foreach($relatedArticles as $rel)
            <article class="blog-card">
                <div class="blog-card-img">
                    @if($rel->thumbnail)
                        <img src="{{ Storage::url($rel->thumbnail) }}" alt="{{ $rel->title }}" loading="lazy" width="400" height="225">
                    @else
                        <div style="background:linear-gradient(135deg,#0A2E78,#169F81);height:180px;display:flex;align-items:center;justify-content:center;font-size:2.5rem">📰</div>
                    @endif
                </div>
                <div class="blog-card-body">
                    <div class="blog-card-date">{{ $rel->published_at?->translatedFormat('d M Y') }}</div>
                    <h3>{{ $rel->title }}</h3>
                    <a href="{{ route('blog.show', $rel->slug) }}" class="blog-card-link">Baca →</a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
