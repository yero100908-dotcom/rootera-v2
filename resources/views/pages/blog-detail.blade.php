@extends('layouts.app')

@section('schema-markup')
<?php
$blogPostingSchema = [
  "@context" => "https://schema.org",
  "@type" => "BlogPosting",
  "headline" => $article->title,
  "description" => $article->excerpt,
  "image" => $article->thumbnail_url ?: asset('images/logo-final.webp'),
  "author" => [
    "@type" => "Person",
    "name" => $article->author ?: "Tim Ahli Rootera Plumbing"
  ],
  "datePublished" => $article->published_at?->toIso8601String() ?: now()->toIso8601String(),
  "dateModified" => $article->updated_at->toIso8601String(),
  "publisher" => [
    "@type" => "Organization",
    "name" => "Rootera Plumbing",
    "url" => url('/'),
    "logo" => [
      "@type" => "ImageObject",
      "url" => asset('images/logo-final.webp')
    ]
  ],
  "mainEntityOfPage" => [
    "@type" => "WebPage",
    "@id" => url()->current()
  ]
];

$wordCount = str_word_count(strip_tags($article->content));
$readTimeMinutes = max(2, ceil($wordCount / 180));
?>
<script type="application/ld+json">
{!! json_encode($blogPostingSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@push('styles')
<style>
/* Editorial Typography & Layout */
.article-header { padding: 3rem 1.5rem 2rem; max-width: 900px; margin: 0 auto; text-align: center; }
.article-category { display: inline-block; background: rgba(16,185,129,.1); color: #10B981; border: 1px solid rgba(16,185,129,.3); font-weight: 700; font-size: 0.82rem; padding: 0.3rem 1rem; border-radius: 50px; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 1rem; }
.article-title { color: #0B2545; font-size: clamp(1.6rem, 4.5vw, 2.75rem); font-weight: 800; line-height: 1.25; margin-bottom: 1.25rem; letter-spacing: -0.02em; font-family: 'Plus Jakarta Sans', sans-serif; }
.article-meta { display: flex; align-items: center; justify-content: center; gap: 1.5rem; color: #64748B; font-size: 0.9rem; flex-wrap: wrap; }
.article-meta-item { display: flex; align-items: center; gap: 0.4rem; }

.article-hero-img { max-width: 1000px; margin: 0 auto 2.5rem; padding: 0 1.5rem; }
.article-hero-img figure { position: relative; margin: 0; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,.08); }
.article-hero-img img { width: 100%; height: auto; display: block; object-fit: cover; max-height: 550px; }
.article-hero-img figcaption { text-align: center; font-size: 0.85rem; color: #94A3B8; margin-top: 0.75rem; font-style: italic; }

.article-layout { max-width: 1140px; margin: 0 auto; padding: 0 1.5rem; display: grid; grid-template-columns: 1fr 320px; gap: 3.5rem; align-items: start; }

.article-body-content { font-size: 1.05rem; line-height: 1.8; color: #334155; }
.article-body-content p { margin-bottom: 1.5rem; }
.article-body-content h2 { color: #0B2545; font-size: 1.65rem; margin: 2.5rem 0 1rem; font-weight: 800; font-family: 'Plus Jakarta Sans', sans-serif; scroll-margin-top: 100px; }
.article-body-content h3 { color: #0B2545; font-size: 1.3rem; margin: 2rem 0 0.85rem; font-weight: 700; font-family: 'Plus Jakarta Sans', sans-serif; scroll-margin-top: 100px; }
.article-body-content ul, .article-body-content ol { padding-left: 1.5rem; margin-bottom: 1.5rem; }
.article-body-content li { margin-bottom: 0.5rem; }
.article-body-content img { border-radius: 16px; margin: 2rem 0; width: 100%; height: auto; box-shadow: 0 4px 20px rgba(0,0,0,.05); }

/* Table of Contents Container */
.toc-container { background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 16px; padding: 1.5rem; margin-bottom: 2.5rem; }
.toc-title { font-size: 1rem; font-weight: 800; color: #0B2545; font-family: 'Plus Jakarta Sans', sans-serif; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem; }
.toc-list { list-style: none; padding: 0; margin: 0; space-y: 0.5rem; }
.toc-list a { color: #475569; font-size: 0.9rem; text-decoration: none; font-weight: 600; transition: color 0.2s; }
.toc-list a:hover { color: #10B981; }

/* Pull Quote Styling */
.article-body-content blockquote { margin: 2.5rem 0; padding: 1.5rem 2rem; background: rgba(16,185,129,.05); border-left: 5px solid #10B981; border-radius: 0 16px 16px 0; font-size: 1.15rem; font-style: italic; color: #0B2545; line-height: 1.6; font-weight: 600; }

.article-cta-box { background: linear-gradient(135deg, #0B2545, #134074); border-radius: 24px; padding: 2.5rem 2rem; color: #fff; text-align: center; margin-top: 3rem; margin-bottom: 3rem; position: relative; overflow: hidden; box-shadow: 0 20px 40px rgba(11,37,69,.2); }
.article-cta-box h3 { color: #fff; font-size: 1.5rem; margin-bottom: 0.75rem; font-family: 'Plus Jakarta Sans', sans-serif; position: relative; z-index: 1; font-weight: 800; }
.article-cta-box p { color: rgba(255,255,255,.85); font-size: 0.95rem; margin-bottom: 1.5rem; max-width: 500px; margin-left: auto; margin-right: auto; position: relative; z-index: 1; }

/* Floating Sticky Sidebar CTA */
.sidebar-sticky { position: sticky; top: 100px; space-y: 2rem; }
.sidebar-cta-card { background: linear-gradient(135deg, #061434, #0A2E78); border: 1px solid rgba(255,255,255,0.1); border-radius: 24px; padding: 1.75rem; color: #ffffff; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.08); }

@media(max-width: 1024px) {
    .article-layout { grid-template-columns: 1fr; }
    .article-sidebar { display: none; }
}
</style>
@endpush

@section('content')

{{-- Header & Breadcrumbs --}}
<header class="article-header">
    <nav class="flex items-center justify-center gap-2 text-xs text-slate-500 mb-4" aria-label="Breadcrumb">
        <a href="{{ url('/') }}" class="hover:text-emerald-600 transition">Beranda</a>
        <span>›</span>
        <a href="{{ route('blog') }}" class="hover:text-emerald-600 transition">Pengetahuan</a>
        <span>›</span>
        <span class="text-slate-900 font-semibold">{{ Str::limit($article->title, 35) }}</span>
    </nav>

    <span class="article-category">{{ $article->category ?? 'Edukasi Plumbing' }}</span>
    <h1 class="article-title">{{ $article->title }}</h1>
    
    <div class="article-meta">
        <div class="article-meta-item">
            <span>✍️</span> {{ $article->author ?: 'Tim Ahli Rootera' }}
        </div>
        <div class="article-meta-item">
            <span>📅</span> {{ $article->published_at?->translatedFormat('d F Y') ?: now()->translatedFormat('d F Y') }}
        </div>
        <div class="article-meta-item">
            <span>⏱️</span> Estimasi Baca {{ $readTimeMinutes }} Menit
        </div>
    </div>
</header>

{{-- Featured Video or Image --}}
@if($article->youtube_video_id)
<div class="article-hero-img">
    <div style="width:100%; aspect-ratio:16/9; border-radius:20px; overflow:hidden; background:#000; box-shadow: 0 20px 40px rgba(0,0,0,.08);">
        <iframe style="width:100%; height:100%; border:0;" src="https://www.youtube-nocookie.com/embed/{{ $article->youtube_video_id }}" title="{{ $article->title }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</div>
@elseif($article->thumbnail_url)
<div class="article-hero-img">
    <figure>
        <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}" width="1000" height="550" loading="eager" decoding="async">
    </figure>
</div>
@endif

{{-- Main Article Content Layout --}}
<section class="pb-20">
    <div class="article-layout">
        
        {{-- Article Content Column --}}
        <article class="article-body-content">
            
            {{-- Dynamic Table of Contents (TOC) --}}
            <div id="tableOfContents" class="toc-container hidden">
                <div class="toc-title">
                    <span>📑</span> Daftar Isi Artikel
                </div>
                <ol id="tocList" class="toc-list space-y-1 text-sm list-decimal pl-5"></ol>
            </div>

            {{-- Main Article HTML Content --}}
            <div id="articleBody">
                {!! $article->content !!}
            </div>

            {{-- High Conversion WhatsApp CTA Box --}}
            <div class="article-cta-box">
                <h3>Masalah Saluran Pipa Anda Belum Tuntas?</h3>
                <p>Jangan biarkan air meluap dan merusak properti Anda. Panggil teknisi Rootera Plumbing sekarang untuk penanganan cepat tanpa bongkar bergaransi 30 hari.</p>
                <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya ingin konsultasi panggil teknisi pipa mampet setelah membaca: ' . $article->title) }}" target="_blank" class="inline-flex items-center gap-2 bg-[#10B981] hover:bg-[#059669] text-white font-extrabold px-6 py-3.5 rounded-full transition-all shadow-lg text-sm text-decoration-none">
                    <span>📱 Konsultasi WhatsApp 24 Jam (Fast Response)</span>
                </a>
            </div>

            {{-- Contextual B2B Corporate Retainer Callout --}}
            <div class="bg-gradient-to-br from-[#0B2545] to-[#134074] rounded-3xl p-6 sm:p-8 text-white my-8 shadow-lg border border-white/10">
                <span class="inline-block bg-emerald-500/20 text-emerald-400 border border-emerald-500/40 text-[11px] font-extrabold px-3 py-1 rounded-full uppercase tracking-wider mb-3">
                    Layanan Komersial &amp; Industri B2B (J&amp;J Group)
                </span>
                <h4 class="text-xl font-bold font-['Plus_Jakarta_Sans',sans-serif] text-white mb-2">Pipa Tempat Usaha Anda Bermasalah?</h4>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed mb-4">
                    Rootera Plumbing (J&amp;J Group) menyediakan layanan Kontrak Maintenance Perawatan Pipa Berkala untuk Restoran, Hotel, Apartemen, Mall, &amp; Pabrik dengan SLA Response Cepat &amp; Faktur Pajak PPN.
                </p>
                <a href="{{ route('b2b.contract', 'restoran-cafe') }}" class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs py-3 px-5 rounded-xl transition text-decoration-none">
                    <span>📄 Pengajuan Kontrak Maintenance B2B &rarr;</span>
                </a>
            </div>

            {{-- Dynamic Spoke Links to City Hubs --}}
            @if(isset($cities) && $cities->isNotEmpty())
            <div class="bg-slate-50 border border-slate-200 rounded-3xl p-6 my-8">
                <h4 class="text-base font-bold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mb-1">📍 Navigator Layanan Pipa Mampet Terdekat</h4>
                <p class="text-xs text-slate-500 mb-4">Pilih kota operasional terdekat untuk reservasi kedatangan armada teknisi Rootera:</p>
                <div class="flex flex-wrap gap-2">
                    @foreach($cities as $c)
                        <a href="{{ url('/jasa-saluran-mampet/' . $c->slug) }}" class="bg-white border border-slate-300 text-slate-700 hover:border-emerald-500 hover:text-emerald-600 px-3 py-1.5 rounded-full text-xs font-semibold transition text-decoration-none shadow-2xs">
                            📍 Jasa Pipa {{ $c->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

        </article>

        {{-- Floating Sticky Sidebar --}}
        <aside class="article-sidebar">
            <div class="sidebar-sticky">
                
                {{-- Sticky WhatsApp Emergency Callout --}}
                <div class="sidebar-cta-card">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-2xl mx-auto mb-3 border border-emerald-500/40">
                        ⚡
                    </div>
                    <h3 class="text-lg font-bold text-white font-['Plus_Jakarta_Sans',sans-serif] mb-2">Butuh Bantuan Darurat?</h3>
                    <p class="text-xs text-slate-300 mb-4 leading-relaxed">
                        Teknisi Rootera standby 24 jam dengan estimasi tiba 30-45 menit. Pengerjaan 100% tanpa bongkar pipa &amp; bergaransi 30 hari.
                    </p>
                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya mau panggil teknisi pipa mampet sekarang.') }}" target="_blank" class="w-full inline-flex items-center justify-center gap-2 bg-[#10B981] hover:bg-[#059669] text-white text-xs font-extrabold py-3 px-4 rounded-xl transition text-decoration-none">
                        <span>📱 Panggil Teknisi WA 24Jam</span>
                    </a>
                </div>

                {{-- Related Articles List --}}
                @if($relatedArticles->isNotEmpty())
                <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm">
                    <h3 class="text-base font-bold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mb-4 pb-2 border-b border-slate-100">
                        Rekomendasi Panduan Artikel
                    </h3>
                    <div class="space-y-4">
                        @foreach($relatedArticles as $rel)
                        <a href="{{ route('blog.show', $rel->slug) }}" class="flex items-center gap-3 group text-decoration-none">
                            <img src="{{ $rel->thumbnail_url ?: asset('images/logo-final.webp') }}" alt="{{ $rel->title }}" class="w-16 h-16 rounded-xl object-cover flex-shrink-0 border border-slate-100">
                            <div>
                                <h4 class="text-xs font-bold text-slate-900 group-hover:text-emerald-600 transition leading-snug line-clamp-2">{{ $rel->title }}</h4>
                                <span class="text-[10px] text-slate-400 mt-1 block">{{ $rel->published_at?->translatedFormat('d M Y') }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
        </aside>

    </div>
</section>

@push('scripts')
<script>
// Auto Generate Table of Contents (TOC) from H2 & H3 headings
document.addEventListener("DOMContentLoaded", function() {
    const articleBody = document.getElementById('articleBody');
    const tocContainer = document.getElementById('tableOfContents');
    const tocList = document.getElementById('tocList');
    
    if (!articleBody || !tocList) return;

    const headings = articleBody.querySelectorAll('h2, h3');
    if (headings.length < 2) return;

    headings.forEach((heading, index) => {
        const id = 'heading-' + index;
        heading.setAttribute('id', id);

        const li = document.createElement('li');
        li.className = heading.tagName.toLowerCase() === 'h3' ? 'ml-4 list-disc text-slate-500' : 'font-bold text-slate-800';

        const link = document.createElement('a');
        link.setAttribute('href', '#' + id);
        link.textContent = heading.textContent;
        link.className = 'hover:text-emerald-600 transition';

        li.appendChild(link);
        tocList.appendChild(li);
    });

    tocContainer.classList.remove('hidden');
});
</script>
@endpush
@endsection
