@extends('layouts.app')

@section('schema-markup')
<?php
$propSlug = (isset($property) && is_object($property) && isset($property->slug)) ? $property->slug : '';
$propName = (isset($property) && is_object($property) && isset($property->name)) ? $property->name : 'Properti';
$propDesc = (isset($property) && is_object($property) && isset($property->meta_description)) ? $property->meta_description : "Jasa pelancaran saluran pipa mampet untuk {$propName} pengerjaan tanpa bongkar keramik bergaransi 30 hari.";
$propCityName = (isset($city) && is_object($city)) ? (" di " . ($city->full_name ?? $city->name)) : "";
$propCanonical = url("/solusi-properti/{$propSlug}" . (isset($city) && is_object($city) && isset($city->slug) ? "/{$city->slug}" : ""));

$propOffers = [
    [
        "@type" => "Offer",
        "price" => "400000",
        "priceCurrency" => "IDR",
        "priceValidUntil" => date('Y-12-31'),
        "availability" => "https://schema.org/InStock",
        "itemOffered" => [
            "@type" => "Service",
            "name" => "Jasa Pelancaran Pipa Mampet " . $propName . $propCityName,
            "description" => "Pengerjaan cepat tanpa bongkar keramik, respon 30-45 menit, garansi 30 hari."
        ]
    ]
];

$areaServedList = [];
if (isset($city) && is_object($city)) {
    $areaServedList[] = [
        "@type" => "City",
        "name" => $city->full_name ?? $city->name
    ];
    if (isset($city->districts)) {
        foreach ($city->districts->take(10) as $dist) {
            $areaServedList[] = [
                "@type" => "AdministrativeArea",
                "name" => "Kecamatan " . $dist->name . ", " . $city->name
            ];
        }
    }
} else {
    $areaServedList[] = [
        "@type" => "Country",
        "name" => "Indonesia"
    ];
}

$mainPropEntity = [
    "@type" => ["PlumbingService", "LocalBusiness", "EmergencyService"],
    "@id" => $propCanonical . "#property-service",
    "name" => "Jasa Pelancaran Saluran Mampet " . $propName . $propCityName,
    "serviceType" => "Emergency Drain Cleaning",
    "description" => $propDesc,
    "url" => $propCanonical,
    "telephone" => "+6281385404000",
    "priceRange" => "Rp 400.000 - Rp 1.500.000",
    "image" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
    "logo" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
    "provider" => [
        "@type" => "Organization",
        "name" => "Rootera Plumbing (J&J Group)",
        "url" => url('/'),
        "logo" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
        "telephone" => "+6281385404000"
    ],
    "areaServed" => $areaServedList,
    "hasOfferCatalog" => [
        "@type" => "OfferCatalog",
        "name" => "Katalog Layanan Pipa Mampet " . $propName,
        "itemListElement" => $propOffers
    ]
];

$breadcrumbItems = [
    [
        "@type" => "ListItem",
        "position" => 1,
        "name" => "Beranda",
        "item" => url('/')
    ],
    [
        "@type" => "ListItem",
        "position" => 2,
        "name" => "Solusi Properti",
        "item" => route('property.index')
    ],
    [
        "@type" => "ListItem",
        "position" => 3,
        "name" => $propName,
        "item" => url("/solusi-properti/{$propSlug}")
    ]
];

if (isset($city) && is_object($city)) {
    if (isset($city->province)) {
        $breadcrumbItems[] = [
            "@type" => "ListItem",
            "position" => 4,
            "name" => $city->province->name,
            "item" => url("/solusi-properti/{$propSlug}")
        ];
        $breadcrumbItems[] = [
            "@type" => "ListItem",
            "position" => 5,
            "name" => $city->full_name ?? $city->name,
            "item" => $propCanonical
        ];
    } else {
        $breadcrumbItems[] = [
            "@type" => "ListItem",
            "position" => 4,
            "name" => $city->full_name ?? $city->name,
            "item" => $propCanonical
        ];
    }
}

$propGraph = [
    "@context" => "https://schema.org",
    "@graph" => [
        $mainPropEntity,
        [
            "@type" => "BreadcrumbList",
            "@id" => $propCanonical . "#breadcrumb",
            "itemListElement" => $breadcrumbItems
        ],
        [
            "@type" => "FAQPage",
            "@id" => $propCanonical . "#faq",
            "mainEntity" => [
                [
                    "@type" => "Question",
                    "name" => "Berapa lama estimasi teknisi pelancar pipa mampet tiba di lokasi " . $propName . $propCityName . "?",
                    "acceptedAnswer" => [
                        "@type" => "Answer",
                        "text" => "Teknisi siaga terdekat disiagakan dengan estimasi waktu tiba rata-rata 30-45 menit setelah konfirmasi jadwal pemesanan via WhatsApp."
                    ]
                ],
                [
                    "@type" => "Question",
                    "name" => "Apakah pengerjaan saluran mampet di " . $propName . " membutuhkan pembongkaran lantai?",
                    "acceptedAnswer" => [
                        "@type" => "Answer",
                        "text" => "Tidak ada pembongkaran keramik. Kami menggunakan teknologi mesin spiral rotary Ridgid yang melancarkan saluran mampet 100% tanpa membongkar lantai atau ubin Anda."
                    ]
                ]
            ]
        ]
    ]
];
?>
<script type="application/ld+json">
{!! json_encode($propGraph, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
<?php
  $mediaService = app(\App\Services\MediaService::class);
  $activePropImg = $mediaService->getPropertyImage($property->slug, 0);
  $toolkitImages = $mediaService->getToolkitImages();
?>

{{-- Dynamic Breadcrumbs Bar --}}
<div class="bg-[#0B192C] border-b border-white/10 py-3 px-4 text-xs text-slate-300">
    <div class="max-w-7xl mx-auto flex items-center gap-2 flex-wrap">
        <a href="{{ url('/') }}" class="text-slate-400 hover:text-white transition">Beranda</a>
        <span class="text-slate-600">/</span>
        <a href="{{ route('property.index') }}" class="text-slate-400 hover:text-white transition">Solusi Properti</a>
        <span class="text-slate-600">/</span>
        <a href="{{ url('/solusi-properti/' . $propSlug) }}" class="text-slate-400 hover:text-white transition">{{ $propName }}</a>
        @if(isset($city) && is_object($city))
            @if(isset($city->province))
                <span class="text-slate-600">/</span>
                <span class="text-slate-400">{{ $city->province->name }}</span>
            @endif
            <span class="text-slate-600">/</span>
            <span class="text-emerald-400 font-semibold">{{ $city->full_name ?? $city->name }}</span>
        @endif
    </div>
</div>

{{-- 1. Hero Emergency Split Layout (Fast On-Demand Focus) --}}
<section class="relative bg-gradient-to-br from-[#0B2545] via-[#081C38] to-[#040D21] text-white pt-8 pb-14 md:pt-14 md:pb-20 overflow-hidden border-b-4 border-emerald-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <div class="lg:col-span-7">
                <div class="inline-flex items-center gap-2 bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 px-3.5 py-1.5 rounded-full text-xs font-extrabold tracking-wide uppercase mb-4 shadow-sm">
                    <span class="relative flex h-2 w-2 shrink-0">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span>⚡ On-Demand Emergency 24 Jam</span>
                    <span>•</span>
                    <span>{{ $property->icon }} {{ $propName }}</span>
                    @if(isset($city))
                        <span>•</span>
                        <span class="text-white">📍 {{ $city->full_name }}</span>
                    @endif
                </div>

                <h1 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white leading-tight tracking-tight mb-4">
                    Jasa Pelancaran Saluran Mampet <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-200">{{ $propName }}</span> @if(isset($city)) di {{ $city->full_name }} @endif
                </h1>

                <p class="text-sm sm:text-base text-slate-300 leading-relaxed mb-6">
                    Pengerjaan cepat {{ $property->estimated_time ?? '1-2 Jam Selesai' }} melancarkan wastafel, kloset, dan floor drain. <strong>Tanpa bongkar keramik</strong>, bergaransi 30 hari resmi, & teknisi siaga meluncur 24 jam ke lokasi Anda.
                </p>

                <div class="flex flex-wrap gap-2 sm:gap-3 mb-8">
                    <div class="bg-white/10 backdrop-blur border border-white/15 text-white px-3 py-1.5 rounded-lg text-xs font-bold flex items-center gap-1.5">
                        <span>⚡</span> Tiba 30-45 Menit
                    </div>
                    <div class="bg-white/10 backdrop-blur border border-white/15 text-white px-3 py-1.5 rounded-lg text-xs font-bold flex items-center gap-1.5">
                        <span>🚫</span> Tanpa Bongkar Keramik
                    </div>
                    <div class="bg-white/10 backdrop-blur border border-white/15 text-white px-3 py-1.5 rounded-lg text-xs font-bold flex items-center gap-1.5">
                        <span>🛡️</span> Garansi 30 Hari Resmi
                    </div>
                    <div class="bg-white/10 backdrop-blur border border-white/15 text-white px-3 py-1.5 rounded-lg text-xs font-bold flex items-center gap-1.5">
                        <span>💰</span> Mulai Rp 400rb
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya butuh panggil teknisi darurat pipa mampet untuk ' . $propName . (isset($city) ? ' di ' . $city->full_name : '')) }}" target="_blank" rel="noopener" class="bg-[#25D366] hover:bg-[#1EBE5A] active:scale-95 text-white font-extrabold text-sm sm:text-base px-6 py-3.5 rounded-xl text-center shadow-lg shadow-green-500/25 flex items-center justify-center gap-2 transition-all">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                        <span>Panggil Teknisi WA (24 Jam Nonstop)</span>
                    </a>
                    <a href="tel:081385404000" class="bg-rose-600 hover:bg-rose-700 active:scale-95 text-white font-bold text-sm sm:text-base px-6 py-3.5 rounded-xl text-center flex items-center justify-center gap-2 transition-all border border-rose-400/30">
                        <span>📞 Telepon Siaga (0813-8540-4000)</span>
                    </a>
                </div>
            </div>

            {{-- Emergency Fast Quote / Action Card --}}
            <div class="lg:col-span-5">
                <div class="bg-white text-slate-900 rounded-3xl p-6 shadow-2xl border-2 border-emerald-500/30">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-4">
                        <div>
                            <span class="text-xs font-black text-emerald-600 uppercase tracking-wider">Pesan Instan</span>
                            <h3 class="text-lg font-black text-slate-900">Estimasi Biaya & Booking</h3>
                        </div>
                        <span class="bg-emerald-100 text-emerald-800 text-[10px] font-extrabold px-2.5 py-1 rounded-full">
                            Respon &lt; 3 Mnt
                        </span>
                    </div>

                    <div class="space-y-3 text-xs mb-5">
                        <div class="bg-slate-50 p-3 rounded-xl border border-slate-100 flex items-center justify-between">
                            <span class="text-slate-600 font-medium">📍 Area Layanan:</span>
                            <span class="font-bold text-slate-900">{{ $city->full_name ?? 'Jabodetabek & Kota Besar' }}</span>
                        </div>
                        <div class="bg-slate-50 p-3 rounded-xl border border-slate-100 flex items-center justify-between">
                            <span class="text-slate-600 font-medium">⏱️ Estimasi Tiba:</span>
                            <span class="font-bold text-emerald-600">30 – 45 Menit</span>
                        </div>
                        <div class="bg-slate-50 p-3 rounded-xl border border-slate-100 flex items-center justify-between">
                            <span class="text-slate-600 font-medium">🛡️ Jaminan Garansi:</span>
                            <span class="font-bold text-slate-900">30 Hari Resmi (Lancar Baru Bayar)</span>
                        </div>
                    </div>

                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo CS Rootera, saya butuh jadwal pemanggilan teknisi pipa mampet untuk ' . $propName . (isset($city) ? ' di ' . $city->full_name : '')) }}" target="_blank" rel="noopener" class="w-full bg-[#25D366] hover:bg-[#1EBE5A] text-white font-black text-sm py-3.5 rounded-xl text-center shadow-lg shadow-green-500/20 flex items-center justify-center gap-2">
                        <span>💬 Klik Chat WA Siaga 24 Jam</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- 2. Visual Problem vs Fast Solution Compact Cards --}}
<section class="py-12 md:py-16 bg-slate-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="text-emerald-600 font-extrabold text-xs uppercase tracking-widest">Penanganan Spesifik</span>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">Kendala Saluran Mampet di {{ $propName }}</h2>
            <p class="text-slate-600 text-sm sm:text-base mt-2">Pilih jenis kendala yang Anda alami untuk penanganan teknisi instan hari ini:</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 bg-rose-100 text-rose-600 rounded-xl flex items-center justify-center font-black text-lg mb-3">🍳</div>
                    <h3 class="font-bold text-base text-slate-900 mb-1">Wastafel & Sink Lemak Beku</h3>
                    <p class="text-slate-600 text-xs leading-relaxed mb-4">Sumbatan gumpalan minyak goreng membeku pada leher angsa P-trap dapur {{ $propName }}.</p>
                </div>
                <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, wastafel dapur di ' . $propName . ' mampet. Mohon panggil teknisi.') }}" target="_blank" class="bg-slate-100 hover:bg-emerald-600 hover:text-white text-slate-800 font-bold text-xs py-2.5 px-4 rounded-xl text-center transition">
                    Panggil Teknisi Wastafel →
                </a>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 bg-rose-100 text-rose-600 rounded-xl flex items-center justify-center font-black text-lg mb-3">🚽</div>
                    <h3 class="font-bold text-base text-slate-900 mb-1">Kloset & WC Meluap</h3>
                    <p class="text-slate-600 text-xs leading-relaxed mb-4">Air WC meluap lambat turun akibat penumpukan kotoran keras atau isu paking kloset.</p>
                </div>
                <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, kloset WC di ' . $propName . ' mampet meluap. Mohon teknisi darurat.') }}" target="_blank" class="bg-slate-100 hover:bg-emerald-600 hover:text-white text-slate-800 font-bold text-xs py-2.5 px-4 rounded-xl text-center transition">
                    Panggil Teknisi WC →
                </a>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 bg-rose-100 text-rose-600 rounded-xl flex items-center justify-center font-black text-lg mb-3">🚿</div>
                    <h3 class="font-bold text-base text-slate-900 mb-1">Floor Drain & Got Mampet</h3>
                    <p class="text-slate-600 text-xs leading-relaxed mb-4">Saluran pembuangan kamar mandi menggenang akibat gumpalan rontokan rambut & pasir.</p>
                </div>
                <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, floor drain kamar mandi di ' . $propName . ' mampet. Mohon teknisi datang.') }}" target="_blank" class="bg-slate-100 hover:bg-emerald-600 hover:text-white text-slate-800 font-bold text-xs py-2.5 px-4 rounded-xl text-center transition">
                    Panggil Teknisi Floor Drain →
                </a>
            </div>
        </div>
    </div>
</section>

{{-- 3. Live Action Field Gallery (Specification Card Design & Mobile Horizontal Swipe) --}}
@if(isset($galleries) && $galleries->isNotEmpty())
<section class="py-12 md:py-16 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <span class="text-emerald-600 font-extrabold text-xs uppercase tracking-widest">📸 Action Field Proof</span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">Dokumentasi Aksi Teknisi di {{ $propName }}</h2>
            </div>
            <a href="{{ route('galeri') }}" class="text-emerald-600 hover:text-emerald-700 font-bold text-xs flex items-center gap-1">
                <span>Lihat Foto Lainnya</span>
                <span>→</span>
            </a>
        </div>

        {{-- Mobile: Horizontal Swipe / Desktop: Grid 4 Columns (2 Rows x 4 Cards = Max 8 Cards) --}}
        <div class="flex md:grid flex-nowrap overflow-x-auto md:overflow-x-visible sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5 pb-4 md:pb-0 snap-x snap-mandatory scrollbar-none -mx-4 px-4 md:mx-0 md:px-0">
            @foreach($galleries as $gal)
                <?php
                    $galTitle = $gal->title ?? ('Pengerjaan Pipa ' . $propName);
                    $galCategory = $gal->category_label ?? ($property->name ?? 'Properti');
                    $galLoc = $gal->location_tag ?? ($city->full_name ?? ($city->name ?? 'Jabodetabek'));
                    $galDesc = $gal->description ?? 'Pelancaran saluran mampet 100% tuntas tanpa membongkar keramik lantai lokasi Anda.';
                    $galImg = $gal->display_thumbnail ?? ($gal->image_url ?? asset('images/JnJ.webp'));
                    $galDetailUrl = !empty($gal->slug) ? route('galeri.show', $gal->slug) : route('galeri');
                    $waText = "Halo Rootera, saya ingin konsultasi pengerjaan serupa: " . $galTitle . " di " . $galLoc;
                ?>
                <div class="flex-shrink-0 w-[82vw] sm:w-[280px] md:w-auto snap-center bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition group flex flex-col justify-between">
                    <div>
                        {{-- Image Container & Overlay Badges --}}
                        <div class="relative aspect-[4/3] bg-slate-900 overflow-hidden rounded-t-2xl">
                            <img src="{{ $galImg }}" alt="Dokumentasi Pengerjaan {{ $galTitle }} di {{ $city->name ?? 'Jabodetabek' }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" loading="lazy" decoding="async">
                            
                            {{-- Top-Left Category Badge (Orange Ticket Icon) --}}
                            <span class="absolute top-3 left-3 bg-slate-950/85 backdrop-blur border border-white/20 text-white text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider shadow flex items-center gap-1">
                                <span>🏷️</span>
                                <span>{{ mb_strtoupper($galCategory) }}</span>
                            </span>

                            {{-- Top-Right Location Badge (Emerald/Tosca Pill with Red Pin Icon) --}}
                            <span class="absolute top-3 right-3 bg-emerald-600/90 backdrop-blur text-white text-[10px] font-extrabold px-2.5 py-1 rounded-full flex items-center gap-1 shadow border border-emerald-400/30">
                                <span class="text-red-300">📍</span>
                                <span class="truncate max-w-[120px]">{{ $galLoc }}</span>
                            </span>
                        </div>

                        {{-- Card Body --}}
                        <div class="p-4">
                            <h3 class="font-extrabold text-sm sm:text-base text-slate-900 line-clamp-2 mb-1.5 group-hover:text-emerald-600 transition leading-snug">
                                {{ $galTitle }}
                            </h3>
                            <p class="text-slate-600 text-xs line-clamp-2 leading-relaxed">
                                {{ $galDesc }}
                            </p>
                        </div>
                    </div>

                    {{-- Dual Action Footer --}}
                    <div class="p-4 pt-0">
                        <div class="flex items-center justify-between border-t border-slate-100 pt-3">
                            <a href="{{ $galDetailUrl }}" class="text-slate-700 hover:text-emerald-600 font-extrabold text-xs flex items-center gap-1 transition">
                                <span>Studi Kasus</span>
                                <span>→</span>
                            </a>
                            <a href="https://wa.me/6281385404000?text={{ urlencode($waText) }}" target="_blank" rel="noopener" class="bg-emerald-500 hover:bg-emerald-600 active:scale-95 text-white font-extrabold text-[11px] px-3 py-1.5 rounded-full flex items-center gap-1 shadow-sm transition">
                                <span>💬 Konsultasi</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- 4. Interactive FAQ Accordion --}}
<section class="py-12 md:py-16 bg-slate-50 border-b border-slate-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-10">
            <span class="text-emerald-600 font-extrabold text-xs uppercase tracking-widest">FAQ Pemilik & Penyewa</span>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">Pertanyaan Umum Pipa Mampet {{ $propName }}</h2>
        </div>

        <div class="space-y-4">
            <details class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm group">
                <summary class="font-bold text-slate-900 text-sm sm:text-base cursor-pointer flex justify-between items-center list-none">
                    <span>Berapa estimasi waktu teknisi tiba di {{ $propName }}?</span>
                    <span class="text-emerald-600 font-bold transition group-open:rotate-180">↓</span>
                </summary>
                <p class="text-slate-600 text-xs sm:text-sm mt-3 leading-relaxed border-t border-slate-100 pt-3">
                    Teknisi terdekat disiagakan dari posko armada utama dengan estimasi waktu tiba rata-rata 30-45 menit setelah konfirmasi jadwal via WhatsApp.
                </p>
            </details>

            <details class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm group">
                <summary class="font-bold text-slate-900 text-sm sm:text-base cursor-pointer flex justify-between items-center list-none">
                    <span>Apakah ada garansi pengerjaan?</span>
                    <span class="text-emerald-600 font-bold transition group-open:rotate-180">↓</span>
                </summary>
                <p class="text-slate-600 text-xs sm:text-sm mt-3 leading-relaxed border-t border-slate-100 pt-3">
                    Ya, seluruh pengerjaan dilengkapi garansi resmi 30 hari. Jika saluran mampet kembali dalam masa garansi, teknisi kami akan datang melakukan perbaikan ulang gratis!
                </p>
            </details>

            <details class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm group">
                <summary class="font-bold text-slate-900 text-sm sm:text-base cursor-pointer flex justify-between items-center list-none">
                    <span>Apakah pengerjaan merusak lantai keramik?</span>
                    <span class="text-emerald-600 font-bold transition group-open:rotate-180">↓</span>
                </summary>
                <p class="text-slate-600 text-xs sm:text-sm mt-3 leading-relaxed border-t border-slate-100 pt-3">
                    Sama sekali tidak. Kami menggunakan mesin spiral rotary Ridgid modern yang dimasukkan langsung ke lubang saluran tanpa perlu membongkar lantai keramik Anda.
                </p>
            </details>
        </div>
    </div>
</section>

{{-- 5. Emergency Tips & Blog Articles Section --}}
@if(isset($relatedArticles) && $relatedArticles->isNotEmpty())
<section class="py-12 md:py-16 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <span class="text-emerald-600 font-extrabold text-xs uppercase tracking-widest">💡 Tips & Panduan Darurat</span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">Artikel Edukasi Pipa Mampet</h2>
            </div>
            <a href="{{ route('blog') }}" class="text-emerald-600 hover:text-emerald-700 font-bold text-xs flex items-center gap-1">
                <span>Lihat Artikel Panduan</span>
                <span>→</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($relatedArticles as $art)
                <div class="bg-slate-50 border border-slate-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition flex flex-col">
                    <div class="h-44 bg-slate-900 overflow-hidden relative">
                        <img src="{{ $art->thumbnail_url ?? asset('images/JnJ.jpeg') }}" alt="{{ $art->title }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" loading="lazy" decoding="async">
                        <span class="absolute top-3 left-3 bg-emerald-600 text-white font-bold text-[10px] uppercase px-2.5 py-1 rounded-md shadow">
                            {{ $art->category ?? 'Tips Darurat' }}
                        </span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="text-slate-400 text-[11px] font-semibold">{{ $art->published_at ? $art->published_at->format('d M Y') : 'Terbaru' }}</span>
                            <h3 class="font-bold text-base text-slate-900 mt-1 mb-2 line-clamp-2">{{ $art->title }}</h3>
                            <p class="text-slate-600 text-xs line-clamp-3 leading-relaxed mb-4">{{ Str::limit(strip_tags($art->content), 120) }}</p>
                        </div>
                        <a href="{{ route('blog.show', $art->slug) }}" class="text-emerald-600 hover:text-emerald-700 font-bold text-xs flex items-center gap-1 mt-auto">
                            <span>Baca Panduan Selengkapnya</span>
                            <span>→</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- 6. Sub-District Geo Mesh (Internal Links ke Tingkat Kecamatan) --}}
@if(isset($city) && isset($city->districts) && $city->districts->isNotEmpty())
<section class="py-12 md:py-16 bg-slate-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="mb-6">
            <span class="text-emerald-600 font-extrabold text-xs uppercase tracking-widest">📍 Sub-District Geo Mesh</span>
            <h3 class="text-xl sm:text-2xl font-black text-slate-900 mt-1">Cakupan Layanan {{ $propName }} di Kecamatan {{ $city->name }}</h3>
            <p class="text-slate-600 text-sm">Pilih lokasi kecamatan Anda untuk kedatangan teknisi siaga terdekat (30–45 Menit):</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
            @foreach($city->districts as $dist)
                <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/' . $city->slug . '/' . $dist->slug) }}" class="bg-white border border-slate-200 hover:border-emerald-500 hover:text-emerald-700 text-slate-700 font-bold text-xs p-3 rounded-xl shadow-sm transition flex items-center justify-between group">
                    <span class="truncate">📍 {{ $dist->name }}</span>
                    <span class="text-slate-400 group-hover:text-emerald-500 text-sm">→</span>
                </a>
            @endforeach
        </div>
    </div>
</section>
@elseif(isset($cities) && $cities->isNotEmpty())
<section class="py-12 md:py-16 bg-slate-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="mb-6">
            <span class="text-emerald-600 font-extrabold text-xs uppercase tracking-widest">📍 Network Coverage</span>
            <h3 class="text-xl sm:text-2xl font-black text-slate-900 mt-1">Cakupan Layanan {{ $propName }} di Kota Lainnya</h3>
            <p class="text-slate-600 text-sm">Pilih kota lokasi properti Anda untuk kedatangan teknisi darurat 25-40 Menit:</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
            @foreach($cities as $c)
                <a href="{{ url('/solusi-properti/' . $propSlug . '/' . $c->slug) }}" class="bg-white border border-slate-200 hover:border-emerald-500 hover:text-emerald-700 text-slate-700 font-bold text-xs p-3.5 rounded-xl shadow-sm transition flex items-center justify-between group">
                    <span>📍 {{ $propName }} {{ $c->name }}</span>
                    <span class="text-slate-400 group-hover:text-emerald-500">→</span>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- 7. Emergency Callout CTA Banner --}}
<section class="bg-gradient-to-r from-[#0B2545] to-[#061434] text-white py-14 px-4 text-center border-t-4 border-emerald-500">
    <div class="max-w-4xl mx-auto space-y-4">
        <h2 class="text-2xl sm:text-4xl font-black">Butuh Panggil Teknisi Sekarang?</h2>
        <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto">
            Tim teknisi berpengalaman Rootera siap meluncur ke {{ $propName }} @if(isset($city)) di {{ $city->full_name }} @endif dengan jaminan garansi 30 hari & ketentuan lancar baru bayar.
        </p>
        <div class="pt-4 flex flex-col sm:flex-row gap-3 justify-center items-center">
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saluran mampet di ' . $propName . (isset($city) ? ' di ' . $city->full_name : '') . ' butuh penanganan sekarang.') }}" target="_blank" rel="noopener" class="bg-[#25D366] hover:bg-[#1EBE5A] active:scale-95 text-white font-black text-sm sm:text-base px-8 py-4 rounded-full inline-flex items-center gap-2 shadow-xl shadow-green-500/25 transition-transform">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                <span>Panggil Teknisi WA (24 Jam)</span>
            </a>
            <a href="tel:081385404000" class="bg-rose-600 hover:bg-rose-700 active:scale-95 text-white font-black text-sm sm:text-base px-8 py-4 rounded-full inline-flex items-center gap-2 shadow-xl shadow-rose-500/25 transition-transform">
                <span>📞 Telepon Darurat (0813-8540-4000)</span>
            </a>
        </div>
    </div>
</section>
@endsection
