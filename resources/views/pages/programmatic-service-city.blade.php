@extends('layouts.app')

{{--
    programmatic-service-city.blade.php
    =====================================
    Canonical pSEO view for route: /layanan/{service_slug}/{city_slug}
    Uses the new <x-seo-head> Blade component for structured meta + JSON-LD injection.
    Three JSON-LD scripts are injected: LocalBusiness, Service, FAQPage.
--}}

@section('meta_title', $metaTitle)
@section('meta_description', $metaDescription)
@section('og_image', $ogImage ?? secure_url('images/og/rootera-default.jpg'))
@section('canonical', $canonicalUrl)

@push('preloads')
@if(!empty($ogImage))
    <link rel="preload" as="image" href="{{ $ogImage }}" fetchpriority="high">
@endif
@endpush

{{-- ══ Inject the SEO head component with 3 JSON-LD schemas ══════════════ --}}
@section('structured_data')
    <x-seo-head
        :meta-title="$metaTitle"
        :meta-description="$metaDescription"
        :canonical-url="$canonicalUrl"
        :schemas="$schemas"
        :og-image="$ogImage ?? ''"
        og-type="website"
        robots="index, follow"
    />
@endsection

@push('styles')
<style>
/* ── Service City Page Styles ───────────────────────────────────────── */
.sc-hero {
    background: linear-gradient(145deg, #0B2545 0%, #13547a 55%, #169F81 100%);
    color: #fff;
    padding: 5rem 1.5rem 6rem;
    position: relative;
    overflow: hidden;
}
.sc-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 80 80'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M50 50c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10s-10-4.477-10-10 4.477-10 10-10zM10 10c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10S0 25.523 0 20s4.477-10 10-10z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    opacity: 1;
}
.sc-hero::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 100%;
    height: 60px;
    background: #fff;
    clip-path: ellipse(55% 100% at 50% 100%);
}
.sc-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,0.3);
    padding: 0.4rem 1.2rem;
    border-radius: 50px;
    font-size: 0.82rem;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    margin-bottom: 1.25rem;
    color: #fff;
}
.sc-title {
    font-size: clamp(2rem, 4.5vw, 3.5rem);
    font-weight: 900;
    line-height: 1.15;
    letter-spacing: -0.025em;
    margin-bottom: 1.25rem;
}
.sc-desc {
    font-size: 1.1rem;
    color: rgba(255,255,255,0.88);
    max-width: 780px;
    line-height: 1.65;
    margin-bottom: 2.5rem;
}
.sc-cta-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    background: #22C55E;
    color: #fff;
    font-weight: 800;
    font-size: 1rem;
    padding: 0.95rem 2rem;
    border-radius: 50px;
    box-shadow: 0 4px 20px rgba(34,197,94,0.4);
    transition: all 0.25s ease;
    text-decoration: none;
}
.sc-cta-primary:hover {
    background: #16A34A;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(34,197,94,0.45);
    color: #fff;
}
.sc-cta-secondary {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(8px);
    border: 2px solid rgba(255,255,255,0.5);
    color: #fff;
    font-weight: 700;
    font-size: 0.95rem;
    padding: 0.85rem 1.75rem;
    border-radius: 50px;
    transition: all 0.25s ease;
    text-decoration: none;
}
.sc-cta-secondary:hover {
    background: rgba(255,255,255,0.25);
    color: #fff;
}
.sc-trust-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    margin-top: 2.5rem;
    color: rgba(255,255,255,0.85);
    font-size: 0.9rem;
}
.sc-trust-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
}
/* Benefits */
.sc-benefits-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
    gap: 1.5rem;
    padding: 4rem 0;
}
.sc-benefit-card {
    background: #fff;
    border-radius: 18px;
    padding: 2rem 1.75rem;
    box-shadow: 0 8px 30px rgba(0,0,0,0.055);
    border: 1px solid #F1F5F9;
    transition: transform 0.3s, box-shadow 0.3s;
}
.sc-benefit-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(22,159,129,0.13);
}
.sc-benefit-icon {
    width: 54px;
    height: 54px;
    border-radius: 14px;
    background: linear-gradient(135deg, #169F81 0%, #0B7A60 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: #fff;
}
/* Gallery */
.sc-gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
}
.sc-gallery-card {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(0,0,0,0.07);
    border: 1px solid #E5E7EB;
    background: #fff;
    transition: transform 0.3s, box-shadow 0.3s;
}
.sc-gallery-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 35px rgba(0,0,0,0.11);
}
.sc-gallery-img {
    width: 100%;
    aspect-ratio: 4/3;
    object-fit: cover;
}
.sc-gallery-body {
    padding: 1.25rem;
}
/* FAQ */
.sc-faq-item {
    background: #fff;
    border: 1px solid #E5E7EB;
    border-radius: 14px;
    margin-bottom: 1rem;
    overflow: hidden;
}
.sc-faq-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.25rem 1.5rem;
    cursor: pointer;
    font-weight: 700;
    color: #0B2545;
    user-select: none;
    gap: 1rem;
}
.sc-faq-header:hover { background: #F8FAFC; }
.sc-faq-body { padding: 0 1.5rem 1.25rem; color: #4B5563; line-height: 1.65; }
/* Services grid */
.sc-services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1rem;
}
.sc-service-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    background: #fff;
    border: 1px solid #E5E7EB;
    border-radius: 12px;
    padding: 1rem 1.25rem;
    font-weight: 600;
    font-size: 0.9rem;
    color: #1F2937;
    transition: all 0.2s;
    text-decoration: none;
}
.sc-service-link:hover {
    border-color: #169F81;
    background: #F0FDF9;
    color: #169F81;
    transform: translateY(-2px);
}
</style>
@endpush

@section('content')

{{-- ═══════════════════════════════════════════════════════════════════════
     HERO SECTION
     ═══════════════════════════════════════════════════════════════════════ --}}
<section class="sc-hero">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="flex items-center gap-2 text-sm text-white/70 mb-5 flex-wrap">
            <a href="{{ url('/') }}" class="hover:text-white transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ url('/layanan') }}" class="hover:text-white transition-colors">Layanan</a>
            <span>/</span>
            <a href="{{ url('/jasa-saluran-mampet/' . $city->slug) }}" class="hover:text-white transition-colors">
                {{ $city->name }}
            </a>
            <span>/</span>
            <span class="text-white font-medium">{{ $category->name }}</span>
        </nav>

        <div class="sc-badge">
            <span>🔧</span>
            <span>Layanan Tersertifikasi — {{ $locationName }}</span>
        </div>

        <h1 class="sc-title">
            Jasa {{ $category->name }}<br>
            <span style="color: #34D399;">{{ $city->name }}</span> Profesional
        </h1>

        <p class="sc-desc">{{ $metaDescription }}</p>

        <div class="flex flex-wrap gap-4">
            <a href="https://wa.me/6281385404000?text=Halo+Rootera,+saya+butuh+jasa+{{ urlencode($category->name) }}+di+{{ urlencode($city->name) }}"
               class="sc-cta-primary"
               rel="noopener noreferrer"
               target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                </svg>
                WhatsApp Sekarang
            </a>
            <a href="tel:+6281385404000" class="sc-cta-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328z"/>
                </svg>
                0813-8540-4000
            </a>
        </div>

        <div class="sc-trust-bar">
            <span class="sc-trust-item">✅ Tanpa Bongkar Lantai</span>
            <span class="sc-trust-item">⏱ Respons 30–60 Menit</span>
            <span class="sc-trust-item">🛡 Garansi 30 Hari</span>
            <span class="sc-trust-item">📍 Teknisi di {{ $locationShort }}</span>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════
     BENEFITS
     ═══════════════════════════════════════════════════════════════════════ --}}
<section class="bg-slate-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="inline-block px-4 py-1 rounded-full bg-emerald-100 text-emerald-800 font-bold text-xs uppercase tracking-wider mb-3">Kenapa Rootera?</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                Standar Pelayanan Profesional di {{ $locationShort }}
            </h2>
        </div>

        <div class="sc-benefits-grid">
            @php
            $benefits = [
                ['icon' => '🔩', 'title' => 'Mesin Spiral Ridgid Pro',     'desc' => 'Teknologi rotary cable terbukti melancarkan pipa tanpa bongkar lantai atau tembok.'],
                ['icon' => '💧', 'title' => 'Hydro Jetting 4000 PSI',     'desc' => 'Pembersihan tekanan air super tinggi untuk pipa yang keras kerak dan sedimen tebal.'],
                ['icon' => '📷', 'title' => 'Inspeksi Kamera CCTV',       'desc' => 'Endoskopi kamera waterproof untuk diagnosis presisi titik sumbatan tanpa dugaan.'],
                ['icon' => '🛡', 'title' => 'Garansi Resmi 30 Hari',      'desc' => 'Tuntas Baru Bayar — jika berulang dalam 30 hari, kami kerjakan ulang tanpa biaya.'],
                ['icon' => '⚡', 'title' => 'Respons 24 Jam / 7 Hari',   'desc' => 'Teknisi stand-by aktif melayani darurat pipa mampet malam hari di ' . $locationShort . '.'],
                ['icon' => '📋', 'title' => 'Laporan Teknis Tertulis',    'desc' => 'Setiap pengerjaan disertai laporan kondisi pipa dan rekomendasi perawatan lanjutan.'],
            ];
            @endphp

            @foreach($benefits as $benefit)
            <div class="sc-benefit-card">
                <div class="sc-benefit-icon">{{ $benefit['icon'] }}</div>
                <h3 class="font-bold text-slate-900 mb-2 text-base">{{ $benefit['title'] }}</h3>
                <p class="text-slate-500 text-sm leading-relaxed">{{ $benefit['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════
     PROJECT GALLERY / PROOF OF WORK
     ═══════════════════════════════════════════════════════════════════════ --}}
@if($projectShowcases && $projectShowcases->count() > 0)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <span class="inline-block px-4 py-1 rounded-full bg-blue-100 text-blue-800 font-bold text-xs uppercase tracking-wider mb-3">Bukti Pengerjaan Nyata</span>
            <h2 class="text-3xl font-extrabold text-slate-900">
                Portofolio {{ $category->name }} di {{ $locationShort }}
            </h2>
        </div>

        <div class="sc-gallery-grid">
            @foreach($projectShowcases->take(3) as $project)
            <article class="sc-gallery-card">
                <img
                    src="{{ $project->display_thumbnail ?? $project->after_image_url ?? asset('images/JnJ.webp') }}"
                    alt="{{ $project->image_alt ?? 'Pengerjaan ' . $category->name . ' di ' . $locationShort }}"
                    class="sc-gallery-img"
                    loading="lazy"
                    width="560"
                    height="420"
                >
                <div class="sc-gallery-body">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-700">
                            {{ $project->category_label ?? $category->name }}
                        </span>
                        @if($project->warranty_days)
                        <span class="text-xs font-medium text-slate-500">🛡 Garansi {{ $project->warranty_days }} hari</span>
                        @endif
                    </div>
                    <h3 class="font-bold text-slate-900 text-sm mb-1">{{ $project->title }}</h3>
                    <p class="text-slate-500 text-xs">📍 {{ $project->related_area_name ?? $locationShort }}</p>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════════════════════
     FAQ SECTION
     ═══════════════════════════════════════════════════════════════════════ --}}
<section class="py-16 bg-slate-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <span class="inline-block px-4 py-1 rounded-full bg-amber-100 text-amber-800 font-bold text-xs uppercase tracking-wider mb-3">FAQ</span>
            <h2 class="text-3xl font-extrabold text-slate-900">
                Pertanyaan Umum — {{ $category->name }} {{ $locationShort }}
            </h2>
        </div>

        <div id="faq-container">
            @foreach($localFaqs as $index => $faq)
            <div class="sc-faq-item">
                <div class="sc-faq-header"
                     onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('.faq-icon').classList.toggle('rotate-45');"
                     role="button"
                     aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                     id="faq-q-{{ $index }}">
                    <span>{{ $faq['question'] }}</span>
                    <svg class="faq-icon flex-shrink-0 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                </div>
                <div class="sc-faq-body {{ $index === 0 ? '' : 'hidden' }}">
                    {{ $faq['answer'] }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════
     OTHER SERVICES INTERLINKING
     ═══════════════════════════════════════════════════════════════════════ --}}
@if($allCategories->count() > 0)
<section class="py-16 bg-white border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-extrabold text-slate-900 mb-6">
            Layanan Lain Rootera di {{ $locationShort }}
        </h2>
        <div class="sc-services-grid">
            @foreach($allCategories->take(12) as $cat)
            <a href="{{ url('/layanan/' . $cat->slug . '/' . $city->slug) }}"
               class="sc-service-link"
               title="Jasa {{ $cat->name }} {{ $locationShort }}">
                <span class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center flex-shrink-0 text-base">🔧</span>
                <span>{{ $cat->name }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════════════════════════
     EMERGENCY CTA BANNER
     ═══════════════════════════════════════════════════════════════════════ --}}
<section class="py-16" style="background: linear-gradient(135deg, #0B2545 0%, #169F81 100%);">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h2 class="text-3xl sm:text-4xl font-extrabold mb-4">
            Pipa Mampet Darurat di {{ $locationShort }}?
        </h2>
        <p class="text-white/85 text-lg mb-8 max-w-2xl mx-auto">
            Hubungi teknisi Rootera sekarang. Respons cepat 30–60 menit, 
            tanpa bongkar, garansi 30 hari.
        </p>
        <a href="https://wa.me/6281385404000?text=Halo+Rootera,+saya+butuh+jasa+{{ urlencode($category->name) }}+di+{{ urlencode($city->name) }}+segera!"
           class="inline-flex items-center gap-3 bg-white text-emerald-700 font-extrabold px-8 py-4 rounded-full text-lg shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300"
           rel="noopener noreferrer"
           target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326z"/>
            </svg>
            Chat WhatsApp Sekarang — Gratis!
        </a>
        <p class="text-white/60 text-sm mt-4">📞 atau telepon: 0813-8540-4000 (24 Jam)</p>
    </div>
</section>

@endsection
