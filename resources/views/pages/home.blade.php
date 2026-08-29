@extends('layouts.app')

@section('schema-markup')
<?php
$homeSchema = [
  "@context" => "https://schema.org",
  "@graph" => [
    [
      "@type" => "Plumber",
      "@id" => url('/') . '#organization',
      "name" => "Rootera Plumbing",
      "url" => url('/'),
      "telephone" => "+6281385404000",
      "priceRange" => "Rp 150.000 - Rp 1.500.000",
      "address" => [
        "@type" => "PostalAddress",
        "streetAddress" => "Gg. Mawar No.6B.1, RT.7/RW.1, Cijantung",
        "addressLocality" => "Pasar Rebo, Jakarta Timur",
        "addressRegion" => "DKI Jakarta",
        "postalCode" => "13770",
        "addressCountry" => "ID"
      ],
      "hasOfferCatalog" => [
        "@type" => "OfferCatalog",
        "name" => "Katalog Layanan Sanitasi & Pipa Rootera",
        "itemListElement" => [
          [
            "@type" => "Offer",
            "itemOffered" => [
              "@type" => "Service",
              "name" => "Jasa Pelancar Pipa Mampet Tanpa Bongkar",
              "description" => "Pelancaran wastafel, kloset, floor drain, dan got tersumbat bergaransi 30 hari."
            ]
          ],
          [
            "@type" => "Offer",
            "itemOffered" => [
              "@type" => "Service",
              "name" => "Jasa Hydro-Jetting High-Pressure Cleaning",
              "description" => "Semprotan air tekanan tinggi 300 Bar pengikis lemak padat industri & restoran."
            ]
          ],
          [
            "@type" => "Offer",
            "itemOffered" => [
              "@type" => "Service",
              "name" => "Cuci Toren & Kuras Tandon Air",
              "description" => "Pengurasan lumut, endapan lumpur, dan sterilisasi tangki air bersih food-grade safety."
            ]
          ]
        ]
      ]
    ],
    [
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
    ]
  ]
];
?>
<script type="application/ld+json">
{!! json_encode($homeSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')

{{-- ========================================================================= --}}
{{-- 1. ULTRA MODERN HIGH-IMPACT HERO SECTION --}}
{{-- ========================================================================= --}}
<section style="background: linear-gradient(135deg, #0b132b 0%, #0f172a 50%, #061434 100%); color: #ffffff; padding: 6.5rem 0 4.5rem; position: relative; overflow: hidden;" class="pt-28 lg:pt-32 pb-16" aria-label="Hero Section">
    
    {{-- Dynamic Ambient Light Orbs --}}
    <div style="position: absolute; top: -150px; left: 50%; transform: translateX(-50%); width: 900px; height: 500px; background: radial-gradient(circle, rgba(16, 185, 129, 0.16) 0%, rgba(6, 20, 52, 0) 70%); pointer-events: none;"></div>
    <div style="position: absolute; bottom: 0; right: 0; width: 500px; height: 500px; background: radial-gradient(circle, rgba(6, 182, 212, 0.14) 0%, rgba(6, 20, 52, 0) 70%); pointer-events: none;"></div>

    <div class="container" style="position: relative; z-index: 2;">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            {{-- HERO LEFT: TEXT & CTA --}}
            <div class="lg:col-span-7">
                {{-- Glowing Capsule Badge --}}
                <div style="display: inline-flex; align-items: center; gap: 0.6rem; background: rgba(255, 255, 255, 0.06); border: 1px solid rgba(16, 185, 129, 0.3); padding: 0.45rem 1.1rem; border-radius: 9999px; font-size: 0.82rem; font-weight: 700; color: #10b981; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 1.5rem; backdrop-filter: blur(10px);">
                    <span style="width: 8px; height: 8px; border-radius: 50%; background: #10b981; box-shadow: 0 0 12px #10b981;" class="animate-pulse"></span>
                    ✨ JASA PELANCAR PIPA &amp; KAMERA CCTV INSPEKSI NO. 1
                </div>

                {{-- Dual-tone Headline --}}
                <h1 style="font-size: clamp(2.1rem, 4.5vw, 3.3rem); font-weight: 800; line-height: 1.18; margin-bottom: 1.25rem; color: #ffffff; letter-spacing: -0.02em;">
                    Atasi Saluran Pipa Mampet Total<br>
                    <span style="background: linear-gradient(90deg, #10b981, #06b6d4, #f59e0b); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Tanpa Bongkar Keramik &amp; Bergaransi</span>
                </h1>

                {{-- Subheadline --}}
                <p style="color: rgba(255, 255, 255, 0.85); font-size: 1.08rem; line-height: 1.65; margin-bottom: 2rem; max-width: 630px;">
                    Solusi cepat pelancaran pipa tersumbat menggunakan <strong>Mesin Spiral Drain Cleaner Modern (Ridgid System)</strong> &amp; <strong>Kamera CCTV Inspeksi Digital</strong>. Metode Hydro-Jetting 300 Bar siap melayani kerak lemak ekstrem industri B2B. Respon cepat dengan garansi tuntas 30 hari!
                </p>

                {{-- CTA Action Buttons --}}
                <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 2.5rem;">
                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya butuh bantuan darurat pelancaran pipa mampet.') }}" target="_blank" rel="noopener noreferrer" style="background: #10b981; color: #ffffff; text-decoration: none; padding: 1rem 1.85rem; border-radius: 14px; font-weight: 800; font-size: 0.98rem; display: inline-flex; align-items: center; gap: 0.6rem; box-shadow: 0 10px 30px rgba(16, 185, 129, 0.35); transition: all 0.25s ease;" class="hover:bg-emerald-600 hover:scale-105 min-h-[48px]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                        Hubungi Teknisi WA 24 Jam
                    </a>
                    <a href="{{ route('layanan') }}" style="background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.2); color: #ffffff; text-decoration: none; padding: 1rem 1.75rem; border-radius: 14px; font-weight: 700; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.5rem; backdrop-filter: blur(10px); transition: all 0.2s ease;" class="hover:bg-white/20 min-h-[48px]">
                        Lihat Katalog Layanan &amp; Tarif →
                    </a>
                </div>
            </div>

            {{-- HERO RIGHT: FLOATING VISUAL CARD & TRUST BADGES --}}
            <div class="lg:col-span-5 relative">
                <div style="position: relative; border-radius: 24px; overflow: hidden; border: 2px solid rgba(255,255,255,0.18); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5); background: #0f172a; cursor: pointer;" onclick="openHomeMediaModal('video', '{{ asset('videos/dokumentasi/video-inspeksi-cctv-wastafel.mp4') }}', 'Inspeksi Kamera CCTV Saluran Wastafel Mampet')">
                    <picture>
                        <source srcset="{{ asset('images/dokumentasi/teknisi-apd-lengkap-sink-pabrik-makanan.webp') }}" type="image/webp">
                        <img src="{{ asset('images/dokumentasi/teknisi-apd-lengkap-sink-pabrik-makanan.webp') }}" alt="Teknisi APD Lengkap Rootera Plumbing Penanganan Saluran Sink Mampet" style="width: 100%; height: 380px; object-fit: cover; display: block;" />
                    </picture>
                    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(6,20,52,0.85) 0%, rgba(6,20,52,0.3) 60%); display: flex; flex-direction: column; justify-content: flex-end; padding: 1.5rem;">
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <div style="width: 48px; height: 48px; border-radius: 50%; background: #dc2626; color: #fff; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 20px rgba(220, 38, 38, 0.7);" class="animate-pulse">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" style="margin-left: 2px;"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                            <div>
                                <span style="background: #dc2626; color: #fff; font-size: 0.7rem; font-weight: 800; padding: 0.15rem 0.5rem; border-radius: 4px; text-transform: uppercase;">▶ VIDEO INSPEKSI CCTV</span>
                                <p style="color: #fff; font-size: 0.88rem; font-weight: 700; margin: 0.15rem 0 0;">Klik Putar Bukti Inspeksi CCTV Saluran</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Floating Badge 1 --}}
                <div style="position: absolute; top: -1rem; right: -1rem; background: rgba(15, 23, 42, 0.92); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.2); padding: 0.75rem 1.1rem; border-radius: 16px; box-shadow: 0 15px 30px rgba(0,0,0,0.3); display: flex; align-items: center; gap: 0.6rem; z-index: 3;" class="hidden sm:flex">
                    <span style="font-size: 1.25rem;">⭐</span>
                    <div>
                        <div style="font-weight: 800; font-size: 0.9rem; color: #fff;">5.0 / 5.0 Rating</div>
                        <div style="font-size: 0.72rem; color: #94a3b8;">120+ Ulasan Asli Google Maps</div>
                    </div>
                </div>

                {{-- Floating Badge 2 --}}
                <div style="position: absolute; bottom: -1.25rem; left: -1rem; background: rgba(15, 23, 42, 0.92); backdrop-filter: blur(12px); border: 1px solid rgba(16, 185, 129, 0.4); padding: 0.75rem 1.1rem; border-radius: 16px; box-shadow: 0 15px 30px rgba(0,0,0,0.3); display: flex; align-items: center; gap: 0.6rem; z-index: 3;" class="hidden sm:flex">
                    <span style="font-size: 1.25rem;">⏱️</span>
                    <div>
                        <div style="font-weight: 800; font-size: 0.9rem; color: #10b981;">Respon &lt; 30 Menit</div>
                        <div style="font-size: 0.72rem; color: #94a3b8;">Teknisi Standby Jabodetabek</div>
                    </div>
                </div>
            </div>

        </div>

        {{-- LIVE COUNTER METRIC BAR --}}
        <div style="margin-top: 4rem; padding-top: 2.5rem; border-top: 1px solid rgba(255,255,255,0.12);" class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); padding: 1.25rem; border-radius: 16px;">
                <div style="font-size: 2.2rem; font-weight: 800; color: #10b981; line-height: 1;">15.000+</div>
                <div style="font-size: 0.85rem; color: rgba(255,255,255,0.75); margin-top: 0.4rem; font-weight: 600;">Saluran Mampet Selesai Ditolong</div>
            </div>
            <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); padding: 1.25rem; border-radius: 16px;">
                <div style="font-size: 2.2rem; font-weight: 800; color: #fbbf24; line-height: 1;">30 Hari</div>
                <div style="font-size: 0.85rem; color: rgba(255,255,255,0.75); margin-top: 0.4rem; font-weight: 600;">Garansi Resmi Bebas Sumbatan Ulang</div>
            </div>
            <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); padding: 1.25rem; border-radius: 16px;">
                <div style="font-size: 2.2rem; font-weight: 800; color: #06b6d4; line-height: 1;">Tanpa Bongkar</div>
                <div style="font-size: 0.85rem; color: rgba(255,255,255,0.75); margin-top: 0.4rem; font-weight: 600;">Mesin Drain Cleaner &amp; Kamera CCTV</div>
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

{{-- ========================================================================= --}}
{{-- STICKY FLOATING CTA BAR (MOBILE ONLY - THUMB-ZONE FRIENDLY) --}}
{{-- ========================================================================= --}}
<div class="fixed bottom-0 inset-x-0 z-50 p-3 bg-[#0b132b]/95 backdrop-blur-lg border-t border-slate-700/60 md:hidden flex items-center gap-2 shadow-2xl">
    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya butuh jasa pelancaran pipa mampet.') }}" target="_blank" rel="noopener noreferrer" class="flex-1 bg-[#10b981] hover:bg-emerald-600 text-white font-extrabold text-xs sm:text-sm py-3 px-3 rounded-xl flex items-center justify-center gap-2 shadow-lg shadow-emerald-500/20 active:scale-95 transition-all text-decoration-none min-h-[48px]">
        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.669-.699c.969.53 1.951.815 2.791.815 3.182 0 5.768-2.587 5.768-5.767 0-3.18-2.586-5.766-5.768-5.766z"/></svg>
        <span>Hubungi Teknisi (WA)</span>
    </a>
    <a href="tel:+6281385404000" class="flex-1 bg-gradient-to-r from-cyan-600 to-blue-700 text-white font-extrabold text-xs sm:text-sm py-3 px-3 rounded-xl flex items-center justify-center gap-2 shadow-lg shadow-cyan-500/20 active:scale-95 transition-all text-decoration-none min-h-[48px]">
        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
        <span>Pesan Cepat (Call)</span>
    </a>
</div>

@endsection
