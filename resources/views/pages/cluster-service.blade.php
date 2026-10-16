@extends('layouts.app')

{{--
    cluster-service.blade.php
    ==========================
    Hyper-local pSEO intersection page: Cluster × ServiceCategory
    Route: /area-perumahan/{clusterSlug}/{categorySlug}
    Variables:
      $cluster         — ResidentialCluster
      $category        — ServiceCategory
      $projectShowcases — Collection<ProjectGallery>
      $allCategories   — Collection<ServiceCategory>
      $faqs            — Collection<Faq>
      $schemas         — array of JSON-LD arrays
      $canonicalUrl    — string
      $metaTitle       — string
      $metaDescription — string
--}}

@section('meta_title', $metaTitle)
@section('meta_description', $metaDescription)
@section('canonical', $canonicalUrl)
@section('og_image', secure_url('images/og/rootera-default.jpg'))

@section('structured_data')
    @foreach($schemas as $schema)
        @if(!empty($schema))
        <script type="application/ld+json">
            {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
        </script>
        @endif
    @endforeach
@endsection

@push('styles')
<style>
/* ── Cluster Service Page ───────────────────────────────────────── */
.cs-hero {
    background: linear-gradient(145deg, #0F2942 0%, #0B2545 40%, #1a5276 75%, #169F81 100%);
    color: #fff;
    padding: 5rem 1.5rem 6.5rem;
    position: relative;
    overflow: hidden;
}
.cs-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at 80% 20%, rgba(22,159,129,0.2) 0%, transparent 65%);
    pointer-events: none;
}
.cs-hero::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    height: 60px;
    background: #F8FAFC;
    clip-path: ellipse(55% 100% at 50% 100%);
}
.cs-category-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(22,159,129,0.3);
    border: 1px solid rgba(22,159,129,0.6);
    color: #6EE7C7;
    padding: 0.35rem 1.1rem;
    border-radius: 50px;
    font-size: 0.78rem;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    margin-bottom: 1.1rem;
}
.cs-title {
    font-size: clamp(1.9rem, 4vw, 3.2rem);
    font-weight: 900;
    line-height: 1.15;
    letter-spacing: -0.03em;
    margin-bottom: 1.2rem;
}
.cs-desc {
    color: rgba(255,255,255,0.82);
    font-size: 1.05rem;
    max-width: 720px;
    line-height: 1.65;
    margin-bottom: 2.5rem;
}
/* Layout */
.cs-layout {
    display: grid;
    grid-template-columns: 1fr 280px;
    gap: 2.5rem;
    align-items: start;
    padding: 4rem 0;
}
@media (max-width: 900px) {
    .cs-layout { grid-template-columns: 1fr; }
    .cs-sidebar { order: -1; }
}
/* Sidebar nav */
.cs-sidebar {
    position: sticky;
    top: 5rem;
}
.cs-sidebar-box {
    background: #fff;
    border-radius: 18px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.07);
    border: 1.5px solid #E2E8F0;
}
.cs-sidebar-title {
    font-size: 0.8rem;
    font-weight: 800;
    color: #94A3B8;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    margin-bottom: 1rem;
}
.cs-nav-link {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.65rem 0.9rem;
    border-radius: 10px;
    font-size: 0.88rem;
    font-weight: 600;
    color: #475569;
    text-decoration: none;
    margin-bottom: 0.25rem;
    transition: all 0.2s ease;
}
.cs-nav-link:hover, .cs-nav-link.active {
    background: #EFF6FF;
    color: #1D4ED8;
}
.cs-nav-link.active {
    background: linear-gradient(135deg, #169F81 0%, #0F7B64 100%);
    color: #fff;
}
/* Gallery */
.cs-gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 1.25rem;
    margin-top: 1.5rem;
}
.cs-gallery-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.06);
    border: 1px solid #E5E7EB;
    transition: transform 0.3s, box-shadow 0.3s;
}
.cs-gallery-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.1);
}
.cs-gallery-img {
    width: 100%;
    aspect-ratio: 4/3;
    object-fit: cover;
    background: #F1F5F9;
}
/* FAQ */
.cs-faq-item {
    background: #fff;
    border: 1.5px solid #E2E8F0;
    border-radius: 14px;
    margin-bottom: 0.75rem;
    overflow: hidden;
}
.cs-faq-trigger {
    width: 100%;
    text-align: left;
    background: none;
    border: none;
    padding: 1.1rem 1.4rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.75rem;
    font-size: 0.95rem;
    font-weight: 700;
    color: #1E293B;
}
.cs-faq-icon {
    flex-shrink: 0;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background: #F1F5F9;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    transition: transform 0.25s, background 0.2s;
    color: #64748B;
}
.cs-faq-item.open .cs-faq-icon {
    transform: rotate(45deg);
    background: #169F81;
    color: #fff;
}
.cs-faq-answer {
    display: none;
    padding: 0 1.4rem 1.1rem;
    font-size: 0.9rem;
    color: #475569;
    line-height: 1.7;
}
.cs-faq-item.open .cs-faq-answer { display: block; }
</style>
@endpush

@section('content')

{{-- ══ HERO ══════════════════════════════════════════════════════════════ --}}
<section class="cs-hero">
    <div class="container" style="max-width:1100px; margin:0 auto; position:relative; z-index:1;">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" style="margin-bottom:1.25rem; font-size:0.82rem; color:rgba(255,255,255,0.6);">
            <a href="{{ route('home') }}" style="color:rgba(255,255,255,0.55); text-decoration:none;">Beranda</a>
            <span style="margin:0 0.5rem;">›</span>
            <a href="{{ url('/area-perumahan/' . $cluster->slug) }}" style="color:rgba(255,255,255,0.55); text-decoration:none;">{{ $cluster->name }}</a>
            <span style="margin:0 0.5rem;">›</span>
            <span style="color:#fff; font-weight:700;">{{ $category->name }}</span>
        </nav>

        <div class="cs-category-badge">
            {{ $category->icon ?? '🔧' }} {{ $category->name }}
        </div>

        <h1 class="cs-title">
            Jasa {{ $category->name }}<br>
            di {{ $cluster->name }}
        </h1>

        <p class="cs-desc">
            Rootera Plumbing menyediakan layanan <strong>{{ $category->name }}</strong> khusus untuk kawasan
            <strong>{{ $cluster->name }}</strong>, {{ $cluster->city->name ?? '' }}.
            Teknisi berpengalaman, respons cepat {{ $cluster->estimated_arrival ?? '20–40 menit' }},
            garansi pengerjaan 30 hari.
        </p>

        <div style="display:flex; flex-wrap:wrap; gap:1rem;">
            <a href="https://wa.me/6281385404000?text=Halo+Rootera%2C+saya+butuh+{{ urlencode($category->name) }}+di+{{ urlencode($cluster->name) }}"
               target="_blank" rel="noopener noreferrer"
               style="display:inline-flex; align-items:center; gap:0.6rem; background:#22C55E; color:#fff; font-weight:800; padding:0.95rem 2rem; border-radius:50px; text-decoration:none; box-shadow:0 4px 20px rgba(34,197,94,0.4); transition:all 0.25s ease;"
               id="cs-hero-wa-cta"
               onmouseover="this.style.background='#16A34A'; this.style.transform='translateY(-2px)'"
               onmouseout="this.style.background='#22C55E'; this.style.transform='none'">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.115.554 4.1 1.523 5.82L.057 23.857l6.225-1.434A11.938 11.938 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.001-1.367l-.36-.214-3.694.851.876-3.593-.236-.369A9.818 9.818 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z"/></svg>
                Konsultasi Gratis Sekarang
            </a>
            <a href="tel:+6281385404000"
               style="display:inline-flex; align-items:center; gap:0.6rem; background:rgba(255,255,255,0.15); border:2px solid rgba(255,255,255,0.4); color:#fff; font-weight:700; padding:0.85rem 1.75rem; border-radius:50px; text-decoration:none;"
               id="cs-hero-call-cta">
                📞 0813-8540-4000
            </a>
        </div>

    </div>
</section>

{{-- ══ MAIN CONTENT + SIDEBAR ═══════════════════════════════════════════ --}}
<div style="background:#F8FAFC;">
    <div class="container" style="max-width:1100px; margin:0 auto; padding:0 1.5rem;">
        <div class="cs-layout">

            {{-- ── MAIN COLUMN ──────────────────────────────────────── --}}
            <main>

                {{-- Category Description --}}
                <div style="background:#fff; border-radius:20px; padding:2rem; box-shadow:0 4px 20px rgba(0,0,0,0.055); margin-bottom:2rem; border:1.5px solid #E2E8F0;">
                    <h2 style="font-size:1.3rem; font-weight:800; color:#0B2545; margin-bottom:0.75rem;">
                        {{ $category->name }} di {{ $cluster->name }}
                    </h2>
                    <p style="color:#475569; line-height:1.75; font-size:0.97rem;">
                        {{ $category->description ?? "Layanan {$category->name} profesional di kawasan {$cluster->name}. Tim Rootera siap menangani setiap permasalahan plumbing Anda dengan peralatan modern dan teknisi bersertifikat." }}
                    </p>

                    @if($category->price_description ?? $category->price_min ?? null)
                    <div style="margin-top:1.5rem; padding:1.25rem; background:#F0FDF4; border-radius:12px; border:1px solid #BBF7D0;">
                        <div style="font-size:0.8rem; font-weight:800; color:#15803D; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:0.4rem;">💰 Estimasi Biaya</div>
                        <div style="font-size:0.95rem; color:#166534; font-weight:600;">{{ $category->price_description ?? 'Harga sesuai survei teknisi. Konsultasi gratis.' }}</div>
                    </div>
                    @endif
                </div>

                {{-- Project Gallery --}}
                @if($projectShowcases->count() > 0)
                <div style="margin-bottom:2.5rem;">
                    <h2 style="font-size:1.2rem; font-weight:800; color:#0B2545; margin-bottom:0.5rem;">
                        Portofolio {{ $category->name }} di {{ $cluster->name }}
                    </h2>
                    <p style="color:#64748B; font-size:0.9rem; margin-bottom:1.25rem;">Bukti pengerjaan nyata dari teknisi kami:</p>
                    <div class="cs-gallery-grid">
                        @foreach($projectShowcases as $showcase)
                        <div class="cs-gallery-card">
                            <img src="{{ $showcase->after_image_url }}"
                                 alt="{{ $showcase->image_alt }}"
                                 class="cs-gallery-img"
                                 loading="lazy"
                                 onerror="this.src='{{ asset('images/ridgid.jpeg') }}'">
                            <div style="padding:1rem;">
                                <div style="font-weight:700; font-size:0.88rem; color:#1E293B; margin-bottom:0.35rem;">{{ $showcase->title }}</div>
                                @if($showcase->tool_used)
                                <div style="font-size:0.75rem; color:#169F81; font-weight:700; margin-bottom:0.35rem;">⚙️ {{ $showcase->tool_used }}</div>
                                @endif
                                <div style="font-size:0.8rem; color:#94A3B8; line-height:1.5; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                                    {{ $showcase->description }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- FAQ --}}
                @if($faqs->count() > 0)
                <div>
                    <h2 style="font-size:1.2rem; font-weight:800; color:#0B2545; margin-bottom:1.25rem;">
                        FAQ: {{ $category->name }} di {{ $cluster->name }}
                    </h2>
                    @foreach($faqs as $i => $faq)
                    <div class="cs-faq-item {{ $i === 0 ? 'open' : '' }}" id="cs-faq-{{ $i }}">
                        <button class="cs-faq-trigger" onclick="csToggleFaq({{ $i }})" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}">
                            <span>{{ $faq->question }}</span>
                            <span class="cs-faq-icon">+</span>
                        </button>
                        <div class="cs-faq-answer">
                            {!! nl2br(e(strip_tags($faq->answer))) !!}
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Bottom CTA --}}
                <div style="background:linear-gradient(135deg, #0B2545 0%, #169F81 100%); border-radius:20px; padding:2.5rem; text-align:center; color:#fff; margin-top:2.5rem;">
                    <div style="font-size:1.4rem; font-weight:900; margin-bottom:0.6rem;">
                        Siap Tangani {{ $category->name }} di {{ $cluster->name }}
                    </div>
                    <div style="color:rgba(255,255,255,0.8); font-size:0.95rem; margin-bottom:1.75rem;">
                        Respons {{ $cluster->estimated_arrival ?? '20–40 menit' }} · Garansi 30 Hari · Teknisi Tersertifikasi
                    </div>
                    <a href="https://wa.me/6281385404000?text=Halo+Rootera%2C+saya+butuh+{{ urlencode($category->name) }}+di+{{ urlencode($cluster->name) }}"
                       target="_blank" rel="noopener noreferrer"
                       style="display:inline-flex; align-items:center; gap:0.6rem; background:#fff; color:#169F81; font-weight:800; padding:1rem 2.5rem; border-radius:50px; text-decoration:none; box-shadow:0 4px 20px rgba(0,0,0,0.2);"
                       id="cs-bottom-wa-cta">
                        💬 Chat WhatsApp Sekarang
                    </a>
                </div>

            </main>

            {{-- ── SIDEBAR ───────────────────────────────────────────── --}}
            <aside class="cs-sidebar">

                {{-- Quick Contact --}}
                <div class="cs-sidebar-box" style="margin-bottom:1.25rem;">
                    <div class="cs-sidebar-title">Hubungi Kami</div>
                    <a href="https://wa.me/6281385404000?text=Halo+Rootera%2C+saya+di+{{ urlencode($cluster->name) }}+butuh+{{ urlencode($category->name) }}"
                       target="_blank" rel="noopener noreferrer"
                       style="display:block; background:#22C55E; color:#fff; text-align:center; font-weight:800; padding:0.9rem; border-radius:12px; text-decoration:none; margin-bottom:0.75rem; font-size:0.92rem;"
                       id="cs-sidebar-wa-cta">
                        📱 Chat WhatsApp
                    </a>
                    <a href="tel:+6281385404000"
                       style="display:block; background:#EFF6FF; color:#1D4ED8; text-align:center; font-weight:700; padding:0.85rem; border-radius:12px; text-decoration:none; font-size:0.9rem;"
                       id="cs-sidebar-call-cta">
                        📞 0813-8540-4000
                    </a>
                    <div style="margin-top:1rem; font-size:0.8rem; color:#94A3B8; text-align:center;">
                        Estimasi tiba: <strong style="color:#169F81;">{{ $cluster->estimated_arrival ?? '20-40 Menit' }}</strong>
                    </div>
                </div>

                {{-- Other Services in Cluster --}}
                <div class="cs-sidebar-box">
                    <div class="cs-sidebar-title">Layanan Lain di {{ $cluster->short_name ?? $cluster->name }}</div>
                    @foreach($allCategories->take(10) as $cat)
                    <a href="{{ url("/area-perumahan/{$cluster->slug}/{$cat->slug}") }}"
                       class="cs-nav-link {{ $cat->id === $category->id ? 'active' : '' }}"
                       id="cs-nav-{{ $cat->slug }}">
                        <span>{{ $cat->icon ?? '🔧' }}</span>
                        <span>{{ $cat->name }}</span>
                    </a>
                    @endforeach
                    <div style="margin-top:1rem; padding-top:1rem; border-top:1px solid #F1F5F9;">
                        <a href="{{ url('/area-perumahan/' . $cluster->slug) }}"
                           style="display:block; text-align:center; font-size:0.83rem; color:#169F81; font-weight:700; text-decoration:none;">
                            ← Kembali ke {{ $cluster->name }}
                        </a>
                    </div>
                </div>

            </aside>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function csToggleFaq(idx) {
    const items = document.querySelectorAll('.cs-faq-item');
    items.forEach((item, i) => {
        if (i === idx) {
            item.classList.toggle('open');
            item.querySelector('.cs-faq-trigger').setAttribute(
                'aria-expanded', item.classList.contains('open') ? 'true' : 'false'
            );
        } else {
            item.classList.remove('open');
            item.querySelector('.cs-faq-trigger').setAttribute('aria-expanded', 'false');
        }
    });
}
</script>
@endpush
