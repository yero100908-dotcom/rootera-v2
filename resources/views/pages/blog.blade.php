@extends('layouts.app')
@section('content')

<div style="background:linear-gradient(135deg,#0A2E78,#0d3a94);padding:5rem 0 4rem">
    <div class="container text-center" style="position:relative;z-index:1">
        <h1 style="color:#fff;margin-bottom:.75rem">Blog & <span style="color:#6ee7cc">Pengetahuan</span></h1>
        <p style="color:rgba(255,255,255,.8);font-size:1.05rem;max-width:550px;margin:0 auto">Tips dan panduan seputar perawatan pipa, saluran air, dan sanitasi rumah dari ahli ROOTERA.</p>
    </div>
</div>

<section class="section" aria-labelledby="blog-heading">
    <div class="container">
        <h2 id="blog-heading" class="sr-only">Daftar Artikel</h2>
        @if($articles->isEmpty())
            <div class="text-center" style="padding:4rem 0;color:#6b7280">
                <div style="font-size:3rem;margin-bottom:1rem">📝</div>
                <p>Belum ada artikel tersedia. Segera hadir!</p>
            </div>
        @else
        <div class="cards-grid">
            @foreach($articles as $article)
            <article class="blog-card fade-in" itemscope itemtype="https://schema.org/Article">
                <div class="blog-card-img">
                    @if($article->thumbnail)
                        <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" loading="lazy" width="400" height="225" itemprop="image">
                    @else
                        <div style="background:linear-gradient(135deg,#0A2E78,#169F81);height:200px;display:flex;align-items:center;justify-content:center;font-size:3rem">📰</div>
                    @endif
                </div>
                <div class="blog-card-body">
                    <div class="blog-card-date">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        <time itemprop="datePublished" datetime="{{ $article->published_at?->format('Y-m-d') }}">
                            {{ $article->published_at?->translatedFormat('d F Y') }}
                        </time>
                        <span style="margin-left:.5rem;color:#9ca3af">· {{ $article->views }} views</span>
                    </div>
                    <h3 itemprop="headline">{{ $article->title }}</h3>
                    <p itemprop="description">{{ Str::limit($article->excerpt, 110) }}</p>
                    <a href="{{ route('blog.show', $article->slug) }}" class="blog-card-link" itemprop="url">
                        Baca Selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
        <div class="pagination">
            {{ $articles->links() }}
        </div>
        @endif
    </div>
</section>
@endsection

@push('styles')
<style>.sr-only{position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0,0,0,0)}</style>
@endpush
