@extends('layouts.app')

@section('schema-markup')
<?php
$homeSchema = [
  "@context" => "https://schema.org",
  "@graph" => [
    [
      "@type" => ["Plumber", "LocalBusiness"],
      "@id" => url('/') . '#organization',
      "name" => "Rootera Plumbing",
      "alternateName" => ["Rootera", "Jasa Saluran Pipa Mampet Rootera"],
      "url" => url('/'),
      "telephone" => "+6281385404000",
      "priceRange" => "Rp 150.000 - Rp 1.500.000",
      "logo" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
      "image" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
      "address" => [
        "@type" => "PostalAddress",
        "streetAddress" => "Gg. Mawar No.6B.1, RT.7/RW.1, Cijantung",
        "addressLocality" => "Pasar Rebo, Jakarta Timur",
        "addressRegion" => "DKI Jakarta",
        "postalCode" => "13770",
        "addressCountry" => "ID"
      ],
      "aggregateRating" => [
        "@type" => "AggregateRating",
        "ratingValue" => "5.0",
        "reviewCount" => "120",
        "bestRating" => "5",
        "worstRating" => "1"
      ],
      "areaServed" => [
        "DKI Jakarta",
        "Jabodetabek",
        "Bandar Lampung",
        "Bandung",
        "Semarang",
        "Yogyakarta",
        "Surabaya",
        "Serang"
      ],
      "sameAs" => [
        "https://www.instagram.com/rootera_plumbing/",
        "https://www.facebook.com/Rootera.id",
        "https://www.tiktok.com/@rootera_plumbing"
      ],
      "hasOfferCatalog" => [
        "@type" => "OfferCatalog",
        "name" => "Katalog Layanan Jasa Saluran Pipa Mampet Rootera",
        "itemListElement" => [
          [
            "@type" => "Offer",
            "itemOffered" => [
              "@type" => "Service",
              "name" => "Jasa Saluran Pipa Mampet Tanpa Bongkar",
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
      "@type" => "Service",
      "serviceType" => "Jasa Saluran Pipa Mampet",
      "name" => "Jasa Saluran Pipa Mampet & Pelancar Wastafel WC Tersumbat",
      "provider" => [
        "@id" => url('/') . '#organization'
      ],
      "areaServed" => ["Jabodetabek", "Bandar Lampung", "Jawa Barat", "Jawa Tengah", "Jawa Timur"],
      "description" => "Layanan jasa pelancaran saluran pipa mampet cepat 24 jam tanpa bongkar keramik bergaransi tuntas 30 hari."
    ],
    [
      "@type" => "FAQPage",
      "mainEntity" => [
        [
          "@type" => "Question",
          "name" => "Berapa lama proses pengerjaan jasa saluran pipa mampet Rootera?",
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
<section class="relative overflow-hidden bg-[#0b132b] text-white pt-20 pb-8 md:pt-28 md:pb-16 lg:pt-32" aria-label="Hero Section">
    
    {{-- Responsive Hero Background Image Layer --}}
    <div style="position: absolute; inset: 0; z-index: 0; pointer-events: none;">
        <picture style="width: 100%; height: 100%; display: block;">
            <source media="(max-width: 767px)" srcset="{{ asset('assets/banners/rootera-plumbing-jasa-saluran-mampet-profesional-mobile.webp') }}" type="image/webp">
            <source media="(min-width: 768px)" srcset="{{ asset('assets/banners/rootera-plumbing-jasa-saluran-mampet-profesional-desktop.webp') }}" type="image/webp">
            <img src="{{ asset('assets/banners/rootera-plumbing-jasa-saluran-mampet-profesional-desktop.webp') }}" alt="Banner Jasa Saluran Pipa Mampet Profesional Rootera Plumbing" loading="eager" fetchpriority="high" style="width: 100%; height: 100%; object-fit: cover; object-position: center;" />
        </picture>
        {{-- High-Contrast Dark Gradient Overlay --}}
        <div style="position: absolute; inset: 0; background: linear-gradient(90deg, rgba(11, 19, 43, 0.94) 0%, rgba(15, 23, 42, 0.85) 45%, rgba(6, 20, 52, 0.70) 100%);"></div>
    </div>

    {{-- Dynamic Ambient Light Orbs --}}
    <div style="position: absolute; top: -150px; left: 50%; transform: translateX(-50%); width: 900px; height: 500px; background: radial-gradient(circle, rgba(16, 185, 129, 0.16) 0%, rgba(6, 20, 52, 0) 70%); pointer-events: none; z-index: 1;"></div>
    <div style="position: absolute; bottom: 0; right: 0; width: 500px; height: 500px; background: radial-gradient(circle, rgba(6, 182, 212, 0.14) 0%, rgba(6, 20, 52, 0) 70%); pointer-events: none; z-index: 1;"></div>

    <div class="container" style="position: relative; z-index: 2;">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-12 items-center">
            
            {{-- HERO LEFT: TEXT & CTA --}}
            <div class="lg:col-span-7">
                {{-- Glowing Capsule Badge --}}
                <div class="inline-flex items-center gap-1.5 bg-white/5 border border-emerald-500/30 text-emerald-400 px-3 py-1 md:px-4 md:py-1.5 rounded-full text-[11px] md:text-[0.82rem] font-bold uppercase tracking-wider mb-2.5 md:mb-6 backdrop-blur-md">
                    <span class="w-1.5 h-1.5 md:w-2 md:h-2 rounded-full bg-emerald-500 shadow-sm animate-pulse"></span>
                    <span>✨ JASA SALURAN MAMPET TANPA BONGKAR NO. 1 JAKARTA</span>
                </div>

                {{-- Dual-tone Headline --}}
                <h1 class="text-[22px] sm:text-2xl md:text-[clamp(2.1rem,4.5vw,3.3rem)] font-extrabold text-white leading-[1.25] md:leading-[1.18] mb-2.5 md:mb-5 tracking-tight">
                    Jasa Saluran Mampet &amp; Tukang Pipa Tersumbat Jakarta<br class="hidden sm:inline">
                    <span style="background: linear-gradient(90deg, #10b981, #06b6d4, #f59e0b); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Tanpa Bongkar Keramik &amp; Bergaransi</span>
                </h1>

                {{-- Subheadline --}}
                <p class="text-slate-200/90 text-xs sm:text-sm md:text-[1.08rem] leading-relaxed md:leading-[1.65] mb-4 md:mb-8 max-w-2xl">
                    Solusi profesional <strong>jasa saluran mampet</strong> tercepat di Jakarta &amp; Jabodetabek. Kami melayani perbaikan <strong>wastafel berlemak, WC kloset meluap, floor drain kamar mandi, dan got tersumbat</strong> menggunakan mesin <strong>Spiral Rotary Cable Rigid</strong> tanpa bongkar keramik &amp; bergaransi tuntas 30 hari.
                </p>

                {{-- CTA Action Buttons --}}
                <div class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4 mt-6 md:mt-0 mb-3 md:mb-10">
                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya butuh bantuan darurat pelancaran pipa mampet.') }}" target="_blank" rel="noopener noreferrer" class="hover:bg-emerald-600 hover:scale-105 min-h-[44px] md:min-h-[48px] bg-emerald-500 text-white font-extrabold text-xs sm:text-sm py-3 px-4 md:py-3.5 md:px-7 rounded-xl inline-flex items-center justify-center gap-2 shadow-lg shadow-emerald-500/25 transition-all text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                        Hubungi Teknisi WA 24 Jam
                    </a>
                    <a href="{{ route('layanan') }}" class="hover:bg-white/20 min-h-[44px] md:min-h-[48px] bg-white/10 border border-white/20 text-white font-bold text-xs sm:text-sm py-3 px-4 md:py-3.5 md:px-7 rounded-xl inline-flex items-center justify-center gap-2 backdrop-blur-md transition-all text-decoration-none">
                        Lihat Katalog Layanan &amp; Tarif →
                    </a>
                </div>
            </div>

            {{-- HERO RIGHT: FLOATING VISUAL CARD & TRUST BADGES --}}
            <div class="lg:col-span-5 relative hidden md:block">
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
                <div class="absolute -top-4 -right-4 bg-[#0B2545]/80 border border-white/15 backdrop-blur-md p-3 sm:px-4 sm:py-3 rounded-2xl shadow-2xl items-center gap-2.5 z-10 transform-gpu hidden sm:flex">
                    <span class="text-xl shrink-0">⭐</span>
                    <div>
                        <div class="font-extrabold text-xs sm:text-sm text-white">5.0 / 5.0 Rating</div>
                        <div class="text-[11px] text-slate-300 font-medium">120+ Ulasan Asli Google Maps</div>
                    </div>
                </div>

                {{-- Floating Badge 2 --}}
                <div class="absolute -bottom-5 -left-4 bg-[#0B2545]/80 border border-emerald-500/30 backdrop-blur-md p-3 sm:px-4 sm:py-3 rounded-2xl shadow-2xl items-center gap-2.5 z-10 transform-gpu hidden sm:flex">
                    <span class="text-xl shrink-0">⏱️</span>
                    <div>
                        <div class="font-extrabold text-xs sm:text-sm text-emerald-400">Respon &lt; 30 Menit</div>
                        <div class="text-[11px] text-slate-300 font-medium">Teknisi Standby Jabodetabek</div>
                    </div>
                </div>
            </div>

        </div>

        {{-- LIVE COUNTER METRIC BAR --}}
        <div class="mt-6 md:mt-16 pt-6 md:pt-10 border-t border-white/10 grid grid-cols-3 gap-2.5 sm:gap-6 text-center">
            <div class="py-3 px-2 sm:p-5 rounded-2xl bg-[#0B2545]/70 border border-white/15 backdrop-blur-md shadow-2xl transition-all duration-300 hover:border-emerald-400/40 hover:bg-[#0B2545]/90 transform-gpu">
                <div class="text-lg sm:text-2xl md:text-3xl font-extrabold text-emerald-400 leading-none mb-1">15.000+</div>
                <div class="text-[10px] sm:text-xs text-slate-200 font-semibold">Saluran Mampet Tuntas</div>
            </div>
            <div class="py-3 px-2 sm:p-5 rounded-2xl bg-[#0B2545]/70 border border-white/15 backdrop-blur-md shadow-2xl transition-all duration-300 hover:border-amber-400/40 hover:bg-[#0B2545]/90 transform-gpu">
                <div class="text-lg sm:text-2xl md:text-3xl font-extrabold text-amber-400 leading-none mb-1">30 Hari</div>
                <div class="text-[10px] sm:text-xs text-slate-200 font-semibold">Garansi Penuh</div>
            </div>
            <div class="py-3 px-2 sm:p-5 rounded-2xl bg-[#0B2545]/70 border border-white/15 backdrop-blur-md shadow-2xl transition-all duration-300 hover:border-cyan-400/40 hover:bg-[#0B2545]/90 transform-gpu">
                <div class="text-lg sm:text-2xl md:text-3xl font-extrabold text-cyan-400 leading-none mb-1">Tanpa Bongkar</div>
                <div class="text-[10px] sm:text-xs text-slate-200 font-semibold">Mesin Drain Cleaner</div>
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

<script>
window.scrollToSliderItem = function(containerId, index) {
    const container = document.getElementById(containerId);
    if (!container) return;
    const items = container.children;
    if (items && items[index]) {
        items[index].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
    }
};

window.initSliderSync = function(containerId, dotsContainerId, activeClass, inactiveClass) {
    const container = document.getElementById(containerId);
    const dotsContainer = document.getElementById(dotsContainerId);
    if (!container || !dotsContainer) return;

    const dots = dotsContainer.querySelectorAll('button');
    const items = container.children;
    if (!dots.length || !items.length) return;

    let ticking = false;
    container.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                const containerRect = container.getBoundingClientRect();
                const containerCenter = containerRect.left + containerRect.width / 2;
                let closestIndex = 0;
                let minDistance = Infinity;

                Array.from(items).forEach((item, idx) => {
                    const itemRect = item.getBoundingClientRect();
                    const itemCenter = itemRect.left + itemRect.width / 2;
                    const distance = Math.abs(containerCenter - itemCenter);
                    if (distance < minDistance) {
                        minDistance = distance;
                        closestIndex = idx;
                    }
                });

                dots.forEach((dot, idx) => {
                    if (idx === closestIndex) {
                        dot.className = `transition-all duration-300 rounded-full h-1.5 ${activeClass}`;
                    } else {
                        dot.className = `transition-all duration-300 rounded-full h-1.5 ${inactiveClass}`;
                    }
                });

                ticking = false;
            });
            ticking = true;
        }
    }, { passive: true });
};

document.addEventListener('DOMContentLoaded', function() {
    initSliderSync('services-slider-container', 'services-dots-container', 'w-6 bg-emerald-500', 'w-1.5 bg-slate-300');
    initSliderSync('whyus-slider-container', 'whyus-dots-container', 'w-6 bg-emerald-500', 'w-1.5 bg-slate-700');
    initSliderSync('areas-slider-container', 'areas-dots-container', 'w-5 bg-emerald-500', 'w-1.5 bg-slate-300');
    initSliderSync('articles-slider-container', 'articles-dots-container', 'w-6 bg-blue-600', 'w-1.5 bg-slate-300');
    initSliderSync('gallery-slider-container', 'gallery-dots-container', 'w-6 bg-emerald-500', 'w-1.5 bg-slate-300');
});
</script>

@endsection
