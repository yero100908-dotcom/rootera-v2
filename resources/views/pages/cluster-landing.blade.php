@extends('layouts.app')

{{--
    cluster-landing.blade.php
    ==========================
    Hyper-local pSEO landing page for elite residential clusters.
    Route: /area-perumahan/{clusterSlug}
    Variables:
      $cluster        — ResidentialCluster model (with city, district, projectGalleries)
      $categories     — Collection<ServiceCategory>
      $faqs           — Collection<Faq>
      $schemas        — array of JSON-LD schema arrays
      $canonicalUrl   — string
      $metaTitle      — string
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
/* ── Cluster Landing Page Styles ─────────────────────────────────────── */
.cl-hero {
    background: linear-gradient(145deg, #0A1628 0%, #0B2545 45%, #0F3D5C 75%, #169F81 100%);
    color: #fff;
    padding: 5.5rem 1.5rem 7rem;
    position: relative;
    overflow: hidden;
}
.cl-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse at 70% 30%, rgba(22,159,129,0.25) 0%, transparent 60%),
        url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='60'%3E%3Cg fill='none'%3E%3Ccircle cx='30' cy='30' r='1' fill='%23ffffff' fill-opacity='0.06'/%3E%3C/g%3E%3C/svg%3E");
    opacity: 1;
    pointer-events: none;
}
.cl-hero::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    height: 70px;
    background: #F8FAFC;
    clip-path: ellipse(55% 100% at 50% 100%);
}
.cl-tier-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    background: rgba(22,159,129,0.25);
    border: 1px solid rgba(22,159,129,0.6);
    backdrop-filter: blur(10px);
    padding: 0.35rem 1.1rem;
    border-radius: 50px;
    font-size: 0.78rem;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #6EE7C7;
    margin-bottom: 1.2rem;
}
.cl-hero-title {
    font-size: clamp(2rem, 4.5vw, 3.6rem);
    font-weight: 900;
    line-height: 1.12;
    letter-spacing: -0.03em;
    margin-bottom: 1.25rem;
}
.cl-hero-title span {
    background: linear-gradient(90deg, #6EE7C7 0%, #38BDF8 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.cl-hero-desc {
    font-size: 1.1rem;
    color: rgba(255,255,255,0.82);
    max-width: 760px;
    line-height: 1.65;
    margin-bottom: 2.5rem;
}
.cl-cta-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    background: #22C55E;
    color: #fff;
    font-weight: 800;
    font-size: 1rem;
    padding: 0.95rem 2.2rem;
    border-radius: 50px;
    box-shadow: 0 4px 25px rgba(34,197,94,0.45);
    transition: all 0.25s ease;
    text-decoration: none;
}
.cl-cta-primary:hover {
    background: #16A34A;
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(34,197,94,0.5);
    color: #fff;
}
.cl-cta-secondary {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    background: rgba(255,255,255,0.12);
    border: 2px solid rgba(255,255,255,0.4);
    color: #fff;
    font-weight: 700;
    font-size: 0.95rem;
    padding: 0.85rem 1.8rem;
    border-radius: 50px;
    transition: all 0.25s ease;
    text-decoration: none;
    backdrop-filter: blur(8px);
}
.cl-cta-secondary:hover {
    background: rgba(255,255,255,0.22);
    color: #fff;
}
.cl-meta-strip {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    margin-top: 2.75rem;
    font-size: 0.88rem;
    color: rgba(255,255,255,0.75);
}
.cl-meta-item {
    display: flex;
    align-items: center;
    gap: 0.45rem;
    font-weight: 600;
}
/* ── Sections ──────────────────────────────────────────────────────── */
.cl-section { padding: 4.5rem 0; }
.cl-section-alt { background: #F1F5F9; }
.cl-section-title {
    font-size: clamp(1.5rem, 3vw, 2.2rem);
    font-weight: 800;
    color: #0B2545;
    letter-spacing: -0.02em;
    margin-bottom: 0.6rem;
}
.cl-section-subtitle {
    color: #64748B;
    font-size: 1.05rem;
    margin-bottom: 2.5rem;
    max-width: 600px;
}
/* ── Landmark Chips ──────────────────────────────────────────────── */
.cl-landmark-list {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    margin-top: 1.5rem;
}
.cl-landmark-chip {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: #fff;
    border: 1.5px solid #E2E8F0;
    border-radius: 50px;
    padding: 0.45rem 1.1rem;
    font-size: 0.88rem;
    font-weight: 600;
    color: #334155;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    transition: all 0.2s ease;
}
.cl-landmark-chip:hover {
    border-color: #169F81;
    color: #169F81;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(22,159,129,0.15);
}
/* ── Issue Cards ────────────────────────────────────────────────── */
.cl-issues-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-top: 2rem;
}
.cl-issue-card {
    background: #fff;
    border-radius: 18px;
    padding: 1.75rem;
    border-left: 4px solid #EF4444;
    box-shadow: 0 4px 20px rgba(0,0,0,0.055);
    transition: transform 0.25s, box-shadow 0.25s;
}
.cl-issue-card.severity-medium { border-left-color: #F59E0B; }
.cl-issue-card.severity-low    { border-left-color: #22C55E; }
.cl-issue-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.09);
}
.cl-issue-tag {
    display: inline-block;
    font-size: 0.72rem;
    font-weight: 800;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    padding: 0.2rem 0.7rem;
    border-radius: 50px;
    margin-bottom: 0.75rem;
    background: #FEE2E2;
    color: #B91C1C;
}
.cl-issue-tag.medium { background: #FEF3C7; color: #92400E; }
.cl-issue-tag.low    { background: #DCFCE7; color: #166534; }
.cl-issue-name {
    font-size: 1rem;
    font-weight: 700;
    color: #1E293B;
    margin-bottom: 0.6rem;
}
.cl-issue-detail {
    font-size: 0.9rem;
    color: #64748B;
    line-height: 1.6;
}
/* ── Services Grid ──────────────────────────────────────────────── */
.cl-services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 1.25rem;
    margin-top: 1.5rem;
}
.cl-service-card {
    background: #fff;
    border-radius: 16px;
    padding: 1.5rem 1.25rem;
    text-align: center;
    border: 1.5px solid #E2E8F0;
    text-decoration: none;
    transition: all 0.25s ease;
    display: block;
    color: inherit;
}
.cl-service-card:hover {
    border-color: #169F81;
    box-shadow: 0 8px 25px rgba(22,159,129,0.15);
    transform: translateY(-4px);
    color: #0B2545;
}
.cl-service-icon {
    font-size: 2rem;
    margin-bottom: 0.75rem;
    display: block;
}
.cl-service-name {
    font-weight: 700;
    font-size: 0.92rem;
    color: #1E293B;
    margin-bottom: 0.35rem;
}
.cl-service-desc {
    font-size: 0.8rem;
    color: #94A3B8;
    line-height: 1.5;
}
/* ── Gallery ────────────────────────────────────────────────────── */
.cl-gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
}
.cl-gallery-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.06);
    border: 1px solid #E5E7EB;
    transition: transform 0.3s, box-shadow 0.3s;
}
.cl-gallery-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.1);
}
.cl-gallery-img {
    width: 100%;
    aspect-ratio: 4/3;
    object-fit: cover;
    background: #F1F5F9;
}
.cl-gallery-body { padding: 1.25rem; }
.cl-gallery-title {
    font-weight: 700;
    font-size: 0.92rem;
    color: #1E293B;
    margin-bottom: 0.4rem;
}
.cl-gallery-desc {
    font-size: 0.82rem;
    color: #94A3B8;
    line-height: 1.5;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
/* ── FAQ ────────────────────────────────────────────────────────── */
.cl-faq-item {
    border: 1.5px solid #E2E8F0;
    border-radius: 14px;
    background: #fff;
    margin-bottom: 0.85rem;
    overflow: hidden;
    transition: box-shadow 0.2s;
}
.cl-faq-item:hover { box-shadow: 0 4px 15px rgba(0,0,0,0.06); }
.cl-faq-trigger {
    width: 100%;
    text-align: left;
    background: none;
    border: none;
    padding: 1.2rem 1.5rem;
    cursor: pointer;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 1rem;
    font-size: 0.97rem;
    font-weight: 700;
    color: #1E293B;
    line-height: 1.4;
}
.cl-faq-trigger .cl-faq-icon {
    flex-shrink: 0;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #F1F5F9;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    transition: transform 0.25s, background 0.2s;
    color: #64748B;
}
.cl-faq-item.open .cl-faq-trigger .cl-faq-icon {
    transform: rotate(45deg);
    background: #169F81;
    color: #fff;
}
.cl-faq-answer {
    display: none;
    padding: 0 1.5rem 1.25rem;
    font-size: 0.92rem;
    color: #475569;
    line-height: 1.7;
}
.cl-faq-item.open .cl-faq-answer { display: block; }
/* ── Sub-clusters Mosaic ─────────────────────────────────────────── */
.cl-sub-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 0.6rem;
    margin-top: 1.25rem;
}
.cl-sub-tag {
    background: #EFF6FF;
    border: 1px solid #BFDBFE;
    color: #1D4ED8;
    padding: 0.4rem 1rem;
    border-radius: 50px;
    font-size: 0.83rem;
    font-weight: 600;
}
/* ── CTA Box ─────────────────────────────────────────────────────── */
.cl-cta-box {
    background: linear-gradient(135deg, #0B2545 0%, #169F81 100%);
    border-radius: 24px;
    padding: 3.5rem 2rem;
    text-align: center;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.cl-cta-box::before {
    content: '';
    position: absolute;
    top: -40px;
    right: -40px;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
    pointer-events: none;
}
.cl-cta-box-title {
    font-size: clamp(1.5rem, 3vw, 2.2rem);
    font-weight: 900;
    margin-bottom: 0.75rem;
    letter-spacing: -0.02em;
}
.cl-cta-box-sub {
    color: rgba(255,255,255,0.8);
    font-size: 1rem;
    margin-bottom: 2rem;
}
@media (max-width: 640px) {
    .cl-hero { padding: 4rem 1rem 5rem; }
    .cl-issues-grid { grid-template-columns: 1fr; }
    .cl-services-grid { grid-template-columns: repeat(2, 1fr); }
}
</style>
@endpush

@section('content')

{{-- ══ HERO ══════════════════════════════════════════════════════════════ --}}
<section class="cl-hero" itemscope itemtype="https://schema.org/Service">
    <div class="container" style="max-width:1100px; margin:0 auto; position:relative; z-index:1;">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" style="margin-bottom:1.5rem; font-size:0.83rem; color:rgba(255,255,255,0.6);">
            <a href="{{ route('home') }}" style="color:rgba(255,255,255,0.6); text-decoration:none;">Beranda</a>
            <span style="margin:0 0.5rem;">›</span>
            <a href="{{ url('/area-perumahan') }}" style="color:rgba(255,255,255,0.6); text-decoration:none;">Area Perumahan</a>
            <span style="margin:0 0.5rem;">›</span>
            <span style="color:#fff; font-weight:700;">{{ $cluster->name }}</span>
        </nav>

        {{-- Tier badge --}}
        <div class="cl-tier-badge">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            Kawasan {{ ucfirst($cluster->tier) }} · {{ $cluster->city->name ?? 'Jabodetabek' }}
        </div>

        <h1 class="cl-hero-title" itemprop="name">
            Jasa Tukang Pipa &amp; Plumbing<br>
            <span>{{ $cluster->name }}</span>
        </h1>

        <p class="cl-hero-desc" itemprop="description">
            @if($cluster->intro_override)
                {{ Str::words($cluster->intro_override, 35, '…') }}
            @else
                Rootera Plumbing melayani seluruh kebutuhan plumbing di kawasan {{ $cluster->name }},
                {{ $cluster->city->name ?? '' }}. Teknisi bersertifikat, respons cepat, harga transparan.
            @endif
        </p>

        <div style="display:flex; flex-wrap:wrap; gap:1rem; align-items:center;">
            <a href="https://wa.me/6281385404000?text=Halo+Rootera%2C+saya+butuh+jasa+plumbing+di+{{ urlencode($cluster->name) }}"
               class="cl-cta-primary"
               target="_blank" rel="noopener noreferrer"
               id="cluster-hero-wa-cta">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.115.554 4.1 1.523 5.82L.057 23.857l6.225-1.434A11.938 11.938 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.001-1.367l-.36-.214-3.694.851.876-3.593-.236-.369A9.818 9.818 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z"/></svg>
                Chat WhatsApp Sekarang
            </a>
            <a href="tel:+6281385404000" class="cl-cta-secondary" id="cluster-hero-call-cta">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                0813-8540-4000
            </a>
        </div>

        <div class="cl-meta-strip">
            @if($cluster->estimated_arrival)
            <span class="cl-meta-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/></svg>
                Estimasi Tiba: {{ $cluster->estimated_arrival }}
            </span>
            @endif
            <span class="cl-meta-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                Rating 5.0 (120+ Ulasan)
            </span>
            <span class="cl-meta-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                Garansi Pengerjaan 30 Hari
            </span>
            <span class="cl-meta-item">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 1l3.18 6.45L23 8.76l-5.73 5.58 1.35 7.87L12 19 5.38 22.21l1.35-7.87L1 8.76l7.82-1.31z"/></svg>
                Layanan 24 Jam / 7 Hari
            </span>
        </div>

    </div>
</section>

{{-- ══ INTRO & LANDMARKS ══════════════════════════════════════════════════ --}}
<section class="cl-section" style="background:#F8FAFC;">
    <div class="container" style="max-width:1100px; margin:0 auto; padding:0 1.5rem;">
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:3rem; align-items:start;">

            {{-- Left: Full intro --}}
            <div>
                <p class="cl-section-title">Tentang Layanan di {{ $cluster->name }}</p>
                <div style="color:#475569; line-height:1.8; font-size:1rem;">
                    {!! nl2br(e($cluster->intro_override ?? "Rootera Plumbing melayani seluruh kawasan {$cluster->name} dengan layanan plumbing profesional 24 jam. Tim teknisi berpengalaman kami siap menangani pipa mampet, kebocoran, instalasi, hingga cuci toren kapan pun Anda membutuhkan.")) !!}
                </div>

                @if(!empty($cluster->sub_clusters) && count($cluster->sub_clusters) > 0)
                <div style="margin-top:2rem;">
                    <p style="font-size:0.85rem; font-weight:700; color:#94A3B8; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:0.75rem;">Sub-Cluster yang Dilayani</p>
                    <div class="cl-sub-grid">
                        @foreach($cluster->sub_clusters as $sub)
                        <span class="cl-sub-tag">{{ $sub }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Right: Landmarks + Developer info --}}
            <div>
                <p class="cl-section-title" style="font-size:1.25rem;">Landmark Terdekat</p>
                <p style="color:#64748B; font-size:0.9rem; margin-bottom:1rem;">Area jangkauan teknisi kami di {{ $cluster->name }}:</p>

                @if(!empty($cluster->landmarks) && count($cluster->landmarks) > 0)
                <div class="cl-landmark-list">
                    @foreach($cluster->landmarks as $lm)
                    <div class="cl-landmark-chip">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" style="color:#169F81;"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/></svg>
                        {{ $lm['name'] ?? $lm }}
                        @if(!empty($lm['distance_km']))
                        <span style="color:#94A3B8; font-weight:500;">{{ $lm['distance_km'] }} km</span>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Quick facts --}}
                <div style="margin-top:2rem; display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                    @if($cluster->developer)
                    <div style="background:#fff; border-radius:14px; padding:1.2rem; border:1px solid #E2E8F0;">
                        <div style="font-size:0.75rem; color:#94A3B8; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:0.4rem;">Developer</div>
                        <div style="font-weight:700; color:#1E293B; font-size:0.9rem;">{{ $cluster->developer }}</div>
                    </div>
                    @endif
                    @if($cluster->built_year)
                    <div style="background:#fff; border-radius:14px; padding:1.2rem; border:1px solid #E2E8F0;">
                        <div style="font-size:0.75rem; color:#94A3B8; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; margin-bottom:0.4rem;">Dibangun</div>
                        <div style="font-weight:700; color:#1E293B; font-size:0.9rem;">{{ $cluster->built_year }}</div>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══ TYPICAL PLUMBING ISSUES ═══════════════════════════════════════════ --}}
@if(!empty($cluster->typical_issues) && count($cluster->typical_issues) > 0)
<section class="cl-section">
    <div class="container" style="max-width:1100px; margin:0 auto; padding:0 1.5rem;">

        <div style="text-align:center; margin-bottom:2.5rem;">
            <p class="cl-section-title">Masalah Plumbing Umum di {{ $cluster->short_name ?? $cluster->name }}</p>
            <p class="cl-section-subtitle" style="margin:0 auto;">
                Berdasarkan pengalaman ratusan pengerjaan di kawasan ini, inilah tantangan plumbing paling sering kami temui:
            </p>
        </div>

        <div class="cl-issues-grid">
            @foreach($cluster->typical_issues as $issue)
            @php
                $severity = $issue['severity'] ?? 'high';
                $severityLabel = match($severity) { 'high' => 'Risiko Tinggi', 'medium' => 'Risiko Sedang', default => 'Risiko Rendah' };
            @endphp
            <div class="cl-issue-card severity-{{ $severity }}">
                <div class="cl-issue-tag {{ $severity === 'medium' ? 'medium' : ($severity === 'low' ? 'low' : '') }}">
                    {{ $severityLabel }}
                </div>
                <div class="cl-issue-name">{{ $issue['issue'] ?? '' }}</div>
                <div class="cl-issue-detail">{{ $issue['detail'] ?? $issue['solution'] ?? '' }}</div>
                @if(!empty($issue['frequency']))
                <div style="margin-top:0.85rem; font-size:0.78rem; font-weight:700; color:#94A3B8; text-transform:uppercase; letter-spacing:0.05em;">
                    {{ match($issue['frequency']) {
                        'very_common' => '🔴 Sangat Sering Ditemui',
                        'common'      => '🟡 Sering Ditemui',
                        'seasonal'    => '🟢 Musiman',
                        'occasional'  => '🔵 Kadang-Kadang',
                        default       => ''
                    } }}
                </div>
                @endif
            </div>
            @endforeach
        </div>

    </div>
</section>
@endif

{{-- ══ SERVICES GRID ════════════════════════════════════════════════════ --}}
<section class="cl-section cl-section-alt">
    <div class="container" style="max-width:1100px; margin:0 auto; padding:0 1.5rem;">

        <div style="text-align:center; margin-bottom:0.5rem;">
            <p class="cl-section-title">Layanan Plumbing di {{ $cluster->name }}</p>
            <p class="cl-section-subtitle" style="margin:0 auto;">
                Klik kategori layanan untuk melihat informasi spesifik di kawasan {{ $cluster->name }}:
            </p>
        </div>

        <div class="cl-services-grid">
            @foreach($categories as $cat)
            <a href="{{ url("/area-perumahan/{$cluster->slug}/{$cat->slug}") }}"
               class="cl-service-card"
               id="cluster-service-{{ $cat->slug }}">
                <span class="cl-service-icon">{{ $cat->icon ?? '🔧' }}</span>
                <div class="cl-service-name">{{ $cat->name }}</div>
                <div class="cl-service-desc">{{ Str::limit($cat->description, 60) }}</div>
            </a>
            @endforeach
        </div>

    </div>
</section>

{{-- ══ PROJECT GALLERY ══════════════════════════════════════════════════ --}}
@if($cluster->projectGalleries->count() > 0)
<section class="cl-section">
    <div class="container" style="max-width:1100px; margin:0 auto; padding:0 1.5rem;">

        <p class="cl-section-title">Portofolio Pengerjaan di {{ $cluster->name }}</p>
        <p class="cl-section-subtitle">Bukti nyata kepercayaan penghuni kawasan ini kepada Rootera Plumbing:</p>

        <div class="cl-gallery-grid">
            @foreach($cluster->projectGalleries->take(6) as $gallery)
            <div class="cl-gallery-card">
                <img src="{{ $gallery->after_image_url }}"
                     alt="{{ $gallery->image_alt }}"
                     class="cl-gallery-img"
                     loading="lazy"
                     onerror="this.src='{{ asset('images/ridgid.jpeg') }}'">
                <div class="cl-gallery-body">
                    <div class="cl-gallery-title">{{ $gallery->title }}</div>
                    @if($gallery->tool_used)
                    <div style="font-size:0.75rem; color:#169F81; font-weight:700; margin-bottom:0.4rem;">⚙️ {{ $gallery->tool_used }}</div>
                    @endif
                    <div class="cl-gallery-desc">{{ $gallery->description }}</div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
@endif

{{-- ══ FAQ ══════════════════════════════════════════════════════════════ --}}
@if($faqs->count() > 0)
<section class="cl-section cl-section-alt">
    <div class="container" style="max-width:800px; margin:0 auto; padding:0 1.5rem;">

        <div style="text-align:center; margin-bottom:2.5rem;">
            <p class="cl-section-title">Pertanyaan Umum Seputar Plumbing di {{ $cluster->name }}</p>
        </div>

        <div id="cl-faq-list">
            @foreach($faqs as $i => $faq)
            <div class="cl-faq-item {{ $i === 0 ? 'open' : '' }}" id="cl-faq-{{ $i }}">
                <button class="cl-faq-trigger" onclick="clToggleFaq({{ $i }})" aria-expanded="{{ $i === 0 ? 'true' : 'false' }}">
                    <span>{{ $faq->question }}</span>
                    <span class="cl-faq-icon">+</span>
                </button>
                <div class="cl-faq-answer">
                    {!! nl2br(e(strip_tags($faq->answer))) !!}
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
@endif

{{-- ══ CTA BOX ════════════════════════════════════════════════════════ --}}
<section class="cl-section" style="background:#fff;">
    <div class="container" style="max-width:900px; margin:0 auto; padding:0 1.5rem;">
        <div class="cl-cta-box">
            <div class="cl-cta-box-title">
                Butuh Teknisi Pipa di {{ $cluster->name }}?
            </div>
            <div class="cl-cta-box-sub">
                Tim Rootera siap tiba dalam {{ $cluster->estimated_arrival ?? '30–45 menit' }}.
                Chat WhatsApp sekarang untuk konsultasi gratis dan estimasi biaya.
            </div>
            <div style="display:flex; flex-wrap:wrap; gap:1rem; justify-content:center;">
                <a href="https://wa.me/6281385404000?text=Halo+Rootera%2C+saya+di+kawasan+{{ urlencode($cluster->name) }}+butuh+bantuan+plumbing"
                   class="cl-cta-primary"
                   target="_blank" rel="noopener noreferrer"
                   id="cluster-bottom-wa-cta"
                   style="background:#fff; color:#169F81; box-shadow:0 4px 20px rgba(0,0,0,0.15);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.115.554 4.1 1.523 5.82L.057 23.857l6.225-1.434A11.938 11.938 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.001-1.367l-.36-.214-3.694.851.876-3.593-.236-.369A9.818 9.818 0 012.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z"/></svg>
                    Chat WhatsApp
                </a>
                <a href="tel:+6281385404000" class="cl-cta-secondary" id="cluster-bottom-call-cta">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                    0813-8540-4000
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
function clToggleFaq(idx) {
    const items = document.querySelectorAll('.cl-faq-item');
    items.forEach((item, i) => {
        if (i === idx) {
            item.classList.toggle('open');
            const btn = item.querySelector('.cl-faq-trigger');
            btn.setAttribute('aria-expanded', item.classList.contains('open') ? 'true' : 'false');
        } else {
            item.classList.remove('open');
            item.querySelector('.cl-faq-trigger').setAttribute('aria-expanded', 'false');
        }
    });
}
</script>
@endpush
