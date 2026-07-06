@extends('layouts.app')

@push('styles')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "Article",
  "headline": "{{ $article->title }}",
  "description": "{{ $article->excerpt }}",
  "author": {"@@type":"Person","name":"{{ $article->author }}"},
  "datePublished": "{{ $article->published_at?->toIso8601String() }}",
  "dateModified": "{{ $article->updated_at->toIso8601String() }}",
  "publisher": {"@@type":"Organization","name":"ROOTERA","logo":{"@@type":"ImageObject","url":"{{ asset('images/logo.png') }}"}},
  "mainEntityOfPage": {"@@type":"WebPage","@@id":"{{ url()->current() }}"}
}
</script>
<style>
/* Editorial Typography & Layout */
.article-header { padding: 4rem 1.5rem 2rem; max-width: 900px; margin: 0 auto; text-align: center; }
.article-category { display: inline-block; background: rgba(22,159,129,.1); color: var(--green); font-weight: 700; font-size: 0.85rem; padding: 0.3rem 1rem; border-radius: 50px; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 1rem; }
.article-title { color: var(--blue); font-size: clamp(1.5rem, 5vw, 2.75rem); font-weight: 800; line-height: 1.3; margin-bottom: 1.25rem; letter-spacing: -0.02em; }
.article-meta { display: flex; align-items: center; justify-content: center; gap: 1.5rem; color: var(--gray-600); font-size: 0.95rem; flex-wrap: wrap; }
.article-meta-item { display: flex; align-items: center; gap: 0.4rem; }

.article-hero-img { max-width: 1000px; margin: 0 auto 2.5rem; padding: 0 1.5rem; }
.article-hero-img figure { position: relative; margin: 0; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,.08); }
.article-hero-img img { width: 100%; height: auto; display: block; object-fit: cover; max-height: 600px; }
.article-hero-img figcaption { text-align: center; font-size: 0.85rem; color: var(--gray-400); margin-top: 0.75rem; font-style: italic; }

.article-layout { max-width: 1100px; margin: 0 auto; padding: 0 1.5rem; display: grid; grid-template-columns: 1fr 300px; gap: 4rem; align-items: start; }

.article-body-content { font-size: 18px; line-height: 1.8; color: #374151; }
.article-body-content p { margin-bottom: 1.5rem; }
.article-body-content h2 { color: var(--blue); font-size: 1.8rem; margin: 3rem 0 1rem; font-weight: 800; }
.article-body-content h3 { color: var(--blue); font-size: 1.4rem; margin: 2rem 0 1rem; font-weight: 700; }
.article-body-content ul, .article-body-content ol { padding-left: 1.5rem; margin-bottom: 1.5rem; }
.article-body-content li { margin-bottom: 0.5rem; }
.article-body-content img { border-radius: 12px; margin: 2rem 0; width: 100%; height: auto; box-shadow: 0 4px 20px rgba(0,0,0,.05); }

/* Pull Quote Styling */
.article-body-content blockquote { margin: 2.5rem 0; padding: 1.5rem 2rem; background: rgba(22,159,129,.05); border-left: 6px solid var(--green); border-radius: 0 12px 12px 0; font-size: 1.25rem; font-style: italic; color: var(--blue); line-height: 1.6; font-weight: 500; }

.article-cta-box { background: linear-gradient(135deg, var(--blue), #0d3a94); border-radius: 20px; padding: 2.5rem; color: #fff; text-align: center; margin-top: 3rem; margin-bottom: 3rem; position: relative; overflow: hidden; box-shadow: 0 20px 40px rgba(10,46,120,.2); }
.article-cta-box::before { content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: radial-gradient(circle, rgba(22,159,129,.2) 0%, transparent 60%); pointer-events: none; }
.article-cta-box h3 { color: #fff; font-size: 1.6rem; margin-bottom: 1rem; font-family: 'Plus Jakarta Sans', sans-serif; position: relative; z-index: 1; }
.article-cta-box p { color: rgba(255,255,255,.8); font-size: 1.05rem; margin-bottom: 2rem; max-width: 500px; margin-left: auto; margin-right: auto; position: relative; z-index: 1; }

.article-share { display: flex; flex-direction: row; justify-content: center; gap: 1.25rem; margin-top: 2rem; margin-bottom: 2rem; border-top: 1px solid var(--gray-200); padding-top: 2.5rem; }
.article-share-text { width: 100%; text-align: center; color: var(--gray-500); font-size: 0.9rem; font-weight: 600; margin-bottom: 1rem; text-transform: uppercase; letter-spacing: 0.05em; }
.share-btn { width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; transition: transform 0.3s ease; box-shadow: 0 4px 10px rgba(0,0,0,.1); }
.share-btn:hover { transform: translateY(-3px); }
.share-wa { background: #25D366; }
.share-fb { background: #1877F2; }
.share-ig { background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); }
.share-tt { background: #000000; }

.sidebar-related h3 { font-size: 1.2rem; color: var(--blue); font-family: 'Plus Jakarta Sans', sans-serif; margin-bottom: 1.5rem; padding-bottom: 0.5rem; border-bottom: 2px solid var(--gray-100); }
.sidebar-post { display: flex; gap: 1rem; margin-bottom: 1.5rem; align-items: center; }
.sidebar-post-img { width: 80px; height: 80px; border-radius: 12px; object-fit: cover; flex-shrink: 0; }
.sidebar-post-title { font-size: 0.95rem; font-weight: 700; color: var(--gray-800); line-height: 1.4; transition: color 0.2s; }
.sidebar-post-title:hover { color: var(--green); }
.sidebar-post-date { font-size: 0.75rem; color: var(--gray-400); margin-top: 0.3rem; }

@media(max-width: 1024px) {
    .article-layout { grid-template-columns: 1fr; }
    .article-sidebar { display: none; } /* Hide sidebar on tablet */
}
@media(max-width: 768px) {
    /* Responsive Spacing & Layout */
    .article-header { padding: 3rem 1rem 1.5rem; }
    .article-hero-img { padding: 0 1rem; margin-bottom: 1.5rem; }
    .article-layout { gap: 1.5rem; padding: 0 1rem; }
    
    /* Responsive Typography */
    .article-meta { font-size: 0.85rem; color: var(--gray-500); font-weight: 400; gap: 1rem; }
    .article-body-content { font-size: 16px; }
    .article-body-content h2 { font-size: 1.4rem; margin: 2rem 0 1rem; }
    .article-body-content h3 { font-size: 1.2rem; margin: 1.5rem 0 0.8rem; }
    .article-body-content blockquote { font-size: 1.1rem; padding: 1rem 1.2rem; margin: 1.5rem 0; }
    
    /* Responsive Share Buttons */
    .article-share { padding-top: 2rem; }
}
</style>
@endpush

@section('content')

<!-- Header -->
<header class="article-header">
    <span class="article-category">Blog & Pengetahuan</span>
    <h1 class="article-title">{{ $article->title }}</h1>
    <div class="article-meta">
        <div class="article-meta-item">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            {{ $article->author ?: 'Tim ROOTERA' }}
        </div>
        <div class="article-meta-item">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            {{ $article->published_at?->translatedFormat('d F Y') }}
        </div>
    </div>
</header>

<!-- Featured Image -->
@if($article->thumbnail)
<div class="article-hero-img">
    <figure>
        <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}">
    </figure>
    <figcaption>Ilustrasi: {{ $article->title }}</figcaption>
</div>
@endif

<!-- Main Content Layout -->
<section style="padding-bottom: 5rem;">
    <div class="article-layout">
        
        <!-- Article Content -->
        <article class="article-body-content">
            {!! $article->content !!}

            <!-- CTA Banner -->
            <div class="article-cta-box">
                <h3>Masalah pipa Anda belum tuntas?</h3>
                <p>Jangan biarkan saluran mampet mengganggu kenyamanan Anda. Panggil ROOTERA sekarang untuk solusi profesional menggunakan mesin spiral modern tanpa bongkar paksa.</p>
                <a href="https://wa.me/6281385404000" target="_blank" class="btn btn-primary" style="display:inline-flex; z-index:2; position:relative;">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                    Hubungi via WhatsApp
                </a>
            </div>

            <!-- Social Share (Moved to bottom) -->
            <div style="text-align:center;">
                <div class="article-share-text">Bagikan Artikel Ini</div>
                <div class="article-share">
                    <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . url()->current()) }}" target="_blank" class="share-btn share-wa" aria-label="Share ke WhatsApp">
                        <svg width="22" height="22" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="share-btn share-fb" aria-label="Share ke Facebook">
                        <svg width="22" height="22" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                    </a>
                    <a href="https://www.instagram.com/rootera_plumbing?igsh=c2NkbXA1b3h6MTVy" target="_blank" class="share-btn share-ig" aria-label="Instagram ROOTERA">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                    <a href="https://www.tiktok.com/@rootera_plumbing?_r=1&_t=ZS-97nM89aiu5h" target="_blank" class="share-btn share-tt" aria-label="TikTok ROOTERA">
                        <svg width="22" height="22" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.69a8.18 8.18 0 0 0 4.78 1.52V6.76a4.84 4.84 0 0 1-1.01-.07z"/></svg>
                    </a>
                </div>
            </div>
        </article>

        <!-- Right Sidebar (Related Posts) -->
        <aside class="article-sidebar">
            @if($relatedArticles->isNotEmpty())
            <div class="sidebar-related">
                <h3>Artikel Terkait</h3>
                @foreach($relatedArticles as $rel)
                <a href="{{ route('blog.show', $rel->slug) }}" class="sidebar-post">
                    @if($rel->thumbnail)
                        <img src="{{ Storage::url($rel->thumbnail) }}" alt="{{ $rel->title }}" class="sidebar-post-img">
                    @else
                        <div class="sidebar-post-img" style="background:#169F81; display:flex; align-items:center; justify-content:center; color:#fff; font-size:1.5rem;">📰</div>
                    @endif
                    <div>
                        <div class="sidebar-post-title">{{ Str::limit($rel->title, 55) }}</div>
                        <div class="sidebar-post-date">{{ $rel->published_at?->translatedFormat('d M Y') }}</div>
                    </div>
                </a>
                @endforeach
            </div>
            @endif
        </aside>

    </div>
</section>

@endsection
