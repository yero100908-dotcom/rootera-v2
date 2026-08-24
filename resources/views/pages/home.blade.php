@extends('layouts.app')

@section('schema-markup')
<?php
$homeFaqSchema = [
  "@context" => "https://schema.org",
  "@type" => "FAQPage",
  "mainEntity" => [
    [
      "@type" => "Question",
      "name" => "Berapa lama proses pengerjaan pelancar saluran mampet Rootera?",
      "acceptedAnswer" => [
        "@type" => "Answer",
        "text" => "Estimasi waktu pengerjaan pelancar saluran mampet berkisar antara 1 hingga 2 jam saja menggunakan teknologi rotasi mekanis modern tanpa membongkar struktur bangunan."
      ]
    ],
    [
      "@type" => "Question",
      "name" => "Apakah metode pembersihan Rootera aman untuk pipa PVC?",
      "acceptedAnswer" => [
        "@type" => "Answer",
        "text" => "Sangat aman. Kami menggunakan spiral mekanis (rotary cable) dan hydro-jetting bertekanan air tinggi 100% bebas dari cairan asam korosif berbahaya."
      ]
    ],
    [
      "@type" => "Question",
      "name" => "Apakah ada garansi untuk setiap pekerjaan?",
      "acceptedAnswer" => [
        "@type" => "Answer",
        "text" => "Ya, semua layanan pembersihan pipa dan saluran mampet di Rootera dilengkapi garansi resmi 30 hari. Jika sumbatan berulang dalam masa garansi, teknisi kami mengerjakan ulang tanpa biaya."
      ]
    ]
  ]
];
?>
<script type="application/ld+json">
{!! json_encode($homeFaqSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')

{{-- ========================================================================= --}}
{{-- 1. ULTRA MODERN HIGH-IMPACT HERO SECTION --}}
{{-- ========================================================================= --}}
<section style="background: linear-gradient(135deg, #061434 0%, #0b2b64 100%); color: #ffffff; padding: 6.5rem 0 4.5rem; position: relative; overflow: hidden;" class="pt-28 lg:pt-32 pb-16" aria-label="Hero Section">
    
    {{-- Dynamic Ambient Light Orbs --}}
    <div style="position: absolute; top: -150px; left: 50%; transform: translateX(-50%); width: 900px; height: 500px; background: radial-gradient(circle, rgba(45, 212, 191, 0.18) 0%, rgba(6, 20, 52, 0) 70%); pointer-events: none;"></div>
    <div style="position: absolute; bottom: 0; right: 0; width: 500px; height: 500px; background: radial-gradient(circle, rgba(16, 185, 129, 0.12) 0%, rgba(6, 20, 52, 0) 70%); pointer-events: none;"></div>

    <div class="container" style="position: relative; z-index: 2;">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            {{-- HERO LEFT: TEXT & CTA --}}
            <div class="lg:col-span-7">
                {{-- Glowing Capsule Badge --}}
                <div style="display: inline-flex; align-items: center; gap: 0.6rem; background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.2); padding: 0.45rem 1.1rem; border-radius: 9999px; font-size: 0.82rem; font-weight: 700; color: #2dd4bf; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 1.5rem; backdrop-filter: blur(10px);">
                    <span style="width: 8px; height: 8px; border-radius: 50%; background: #2dd4bf; box-shadow: 0 0 12px #2dd4bf;" class="animate-pulse"></span>
                    ✨ JASA SALURAN PIPA &amp; HYDRO-JETTING NO. 1 DI INDONESIA
                </div>

                {{-- Dual-tone Headline --}}
                <h1 style="font-size: clamp(2.2rem, 4.8vw, 3.4rem); font-weight: 800; line-height: 1.18; margin-bottom: 1.25rem; color: #ffffff; letter-spacing: -0.02em;">
                    Atasi Pipa Mampet Total<br>
                    <span style="background: linear-gradient(90deg, #2dd4bf, #6ee7cc, #fbbf24); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Tanpa Bongkar &amp; Tanpa Rusak Keramik</span>
                </h1>

                {{-- Subheadline --}}
                <p style="color: rgba(255, 255, 255, 0.85); font-size: 1.1rem; line-height: 1.65; margin-bottom: 2rem; max-width: 620px;">
                    Solusi pelancaran saluran air tersumbat menggunakan kombinasi <strong>Mesin Spiral Rotary K-50</strong> &amp; <strong>Hydro-Jetting 300 Bar</strong>. Respon cepat kurang dari 30 menit dengan garansi resmi 30 hari!
                </p>

                {{-- CTA Action Buttons --}}
                <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 2.5rem;">
                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya membutuhkan layanan darurat saluran mampet.') }}" target="_blank" rel="noopener noreferrer" style="background: #25D366; color: #ffffff; text-decoration: none; padding: 0.95rem 1.85rem; border-radius: 14px; font-weight: 800; font-size: 0.98rem; display: inline-flex; align-items: center; gap: 0.6rem; box-shadow: 0 10px 30px rgba(37, 211, 102, 0.4); transition: all 0.25 ease;" class="hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 24 24" class="animate-bounce"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                        WhatsApp Darurat 24 Jam
                    </a>
                    <a href="{{ route('layanan') }}" style="background: rgba(255, 255, 255, 0.12); border: 1px solid rgba(255, 255, 255, 0.25); color: #ffffff; text-decoration: none; padding: 0.95rem 1.75rem; border-radius: 14px; font-weight: 700; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.5rem; backdrop-filter: blur(10px); transition: all 0.2s ease;" class="hover:bg-white/20">
                        Lihat Estimasi Biaya &amp; Layanan →
                    </a>
                </div>
            </div>

            {{-- HERO RIGHT: FLOATING VISUAL CARD & TRUST BADGES --}}
            <div class="lg:col-span-5 relative">
                <div style="position: relative; border-radius: 24px; overflow: hidden; border: 2px solid rgba(255,255,255,0.18); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5); background: #0f172a;">
                    <picture>
                        <source srcset="{{ asset('images/JnJ.webp') }}" type="image/webp">
                        <img src="{{ asset('images/JnJ.jpeg') }}" alt="Tim Teknisi Rootera Plumbing Sedang Memperbaiki Saluran Mampet" style="width: 100%; height: 380px; object-fit: cover; display: block;" />
                    </picture>
                    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(6,20,52,0.8) 0%, transparent 60%);"></div>
                </div>

                {{-- Floating Badge 1 --}}
                <div style="position: absolute; top: -1rem; right: -1rem; background: rgba(15, 23, 42, 0.9); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.2); padding: 0.75rem 1.1rem; border-radius: 16px; box-shadow: 0 15px 30px rgba(0,0,0,0.3); display: flex; align-items: center; gap: 0.6rem; z-index: 3;" class="hidden sm:flex">
                    <span style="font-size: 1.25rem;">⭐</span>
                    <div>
                        <div style="font-weight: 800; font-size: 0.9rem; color: #fff;">5.0 / 5.0 Rating</div>
                        <div style="font-size: 0.72rem; color: #94a3b8;">500+ Ulasan Puas Google</div>
                    </div>
                </div>

                {{-- Floating Badge 2 --}}
                <div style="position: absolute; bottom: -1.25rem; left: -1rem; background: rgba(15, 23, 42, 0.9); backdrop-filter: blur(12px); border: 1px solid rgba(45, 212, 191, 0.4); padding: 0.75rem 1.1rem; border-radius: 16px; box-shadow: 0 15px 30px rgba(0,0,0,0.3); display: flex; align-items: center; gap: 0.6rem; z-index: 3;" class="hidden sm:flex">
                    <span style="font-size: 1.25rem;">⏱️</span>
                    <div>
                        <div style="font-weight: 800; font-size: 0.9rem; color: #2dd4bf;">Respon &lt; 30 Menit</div>
                        <div style="font-size: 0.72rem; color: #94a3b8;">Teknisi Standby Jabodetabek</div>
                    </div>
                </div>
            </div>

        </div>

        {{-- LIVE COUNTER METRIC BAR --}}
        <div style="margin-top: 4rem; padding-top: 2.5rem; border-top: 1px solid rgba(255,255,255,0.12);" class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); padding: 1.25rem; border-radius: 16px;">
                <div style="font-size: 2.2rem; font-weight: 800; color: #6ee7cc; line-height: 1;">15.000+</div>
                <div style="font-size: 0.85rem; color: rgba(255,255,255,0.75); margin-top: 0.4rem; font-weight: 600;">Saluran Mampet Selesai Ditolong</div>
            </div>
            <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); padding: 1.25rem; border-radius: 16px;">
                <div style="font-size: 2.2rem; font-weight: 800; color: #fbbf24; line-height: 1;">30 Hari</div>
                <div style="font-size: 0.85rem; color: rgba(255,255,255,0.75); margin-top: 0.4rem; font-weight: 600;">Garansi Resmi Bebas Sumbatan Ulang</div>
            </div>
            <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); padding: 1.25rem; border-radius: 16px;">
                <div style="font-size: 2.2rem; font-weight: 800; color: #38bdf8; line-height: 1;">100% Bebas Kimia</div>
                <div style="font-size: 0.85rem; color: rgba(255,255,255,0.75); margin-top: 0.4rem; font-weight: 600;">Metode Ramah Lingkungan &amp; Aman Pipa</div>
            </div>
        </div>

    </div>
</section>

{{-- ========================================================================= --}}
{{-- 2. INTERACTIVE SERVICE MATRIX (LAYANAN SOLUTIF) --}}
{{-- ========================================================================= --}}
@include('sections.home.services', ['serviceCategories' => $serviceCategories])

{{-- ========================================================================= --}}
{{-- 3. KEUNGGULAN TEKNOLOGI & PROTOKOL PENGERJAAN (WHY US) --}}
{{-- ========================================================================= --}}
@include('sections.home.why-us')

{{-- ========================================================================= --}}
{{-- 4. AREA JANGKAUAN LAYANAN (COVERAGE HUBS) --}}
{{-- ========================================================================= --}}
@include('sections.home.areas', ['serviceAreas' => $serviceAreas, 'cities' => $cities ?? null])

{{-- ========================================================================= --}}
{{-- 5. CLIENT & B2B PARTNER MARQUEE (ENTERPRISE TRUST) --}}
{{-- ========================================================================= --}}
@include('sections.home.partners', ['partners' => $partners])

{{-- ========================================================================= --}}
{{-- 6. VIDEO & BUKTI PENGERJAAN RIIL (INTERACTIVE SHOWCASE) --}}
{{-- ========================================================================= --}}
@include('sections.home.gallery-preview', ['hybridGalleries' => $hybridGalleries ?? null, 'galleryPhotos' => $galleryPhotos])

{{-- ========================================================================= --}}
{{-- 7. ARTIKEL & E-LEARNING TERBARU --}}
{{-- ========================================================================= --}}
@include('sections.home.latest-articles', ['latestArticles' => $latestArticles])

{{-- ========================================================================= --}}
{{-- 8. LIVE GOOGLE REVIEWS & SOCIAL PROOF --}}
{{-- ========================================================================= --}}
@include('sections.home.testimonials')

{{-- ========================================================================= --}}
{{-- 9. FAQ ACCORDION --}}
{{-- ========================================================================= --}}
@include('sections.home.faq', ['faqs' => $faqs])

{{-- ========================================================================= --}}
{{-- 10. FLOATING EMERGENCY CALL BANNER --}}
{{-- ========================================================================= --}}
@include('sections.home.cta-banner')

@endsection
