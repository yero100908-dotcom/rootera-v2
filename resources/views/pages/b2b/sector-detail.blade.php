@extends('layouts.app')

@section('schema-markup')
<?php
$sectorSlug = (isset($sector) && is_object($sector) && isset($sector->slug)) ? $sector->slug : '';
$sectorName = (isset($sector) && is_object($sector) && isset($sector->sector_name)) ? $sector->sector_name : 'Komersial';
$sectorDesc = (isset($sector) && is_object($sector) && isset($sector->short_description)) ? $sector->short_description : 'Layanan B2B Plumbing & Maintenance Kontrak Industri';
$sectorCityName = (isset($city) && is_object($city)) ? (" di " . ($city->full_name ?? $city->name)) : "";
$sectorCanonical = url("/sektor-plumbing/{$sectorSlug}" . (isset($city) && is_object($city) && isset($city->slug) ? "/{$city->slug}" : ""));

$b2bOffers = [
    [
        "@type" => "Offer",
        "itemOffered" => [
            "@type" => "Service",
            "name" => "Kontrak Preventive Maintenance Plumbing Sektor " . $sectorName,
            "description" => "Pemeliharaan berkala sistem saluran pipa, riser vertikal, dan drainase gedung komersial."
        ]
    ],
    [
        "@type" => "Offer",
        "itemOffered" => [
            "@type" => "Service",
            "name" => "Pembersihan Hydro Jetting 300 Bar & Grease Trap Sektor " . $sectorName,
            "description" => "Pembersihan gumpalan lemak beku dan limbah cair restoran/kafe dengan tekanan tinggi."
        ]
    ],
    [
        "@type" => "Offer",
        "itemOffered" => [
            "@type" => "Service",
            "name" => "Layanan Plumbing Berbadan Hukum dengan Faktur Pajak PPN 11%",
            "description" => "Penyediaan invoice resmi PT/CV J&J Group legal komplit untuk kebutuhan finance korporat."
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

$mainB2BEntity = [
    "@type" => ["PlumbingService", "LocalBusiness"],
    "@id" => $sectorCanonical . "#b2b-service",
    "name" => "Rootera B2B Plumbing Sektor " . $sectorName . $sectorCityName,
    "serviceType" => "Commercial Plumbing & Maintenance",
    "description" => $sectorDesc,
    "url" => $sectorCanonical,
    "telephone" => "+6281385404000",
    "priceRange" => "Rp 500.000 - Rp 5.000.000",
    "image" => $sector->image_url ?? asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
    "logo" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
    "provider" => [
        "@type" => "Organization",
        "name" => "Rootera Plumbing (Divisi Plumbing Resmi J&J Group)",
        "url" => url('/'),
        "logo" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
        "telephone" => "+6281385404000"
    ],
    "areaServed" => $areaServedList,
    "hasOfferCatalog" => [
        "@type" => "OfferCatalog",
        "name" => "Katalog Layanan B2B Commercial Plumbing " . $sectorName,
        "itemListElement" => $b2bOffers
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
        "name" => "Layanan B2B Komersial",
        "item" => route('b2b.index')
    ],
    [
        "@type" => "ListItem",
        "position" => 3,
        "name" => "Sektor " . $sectorName,
        "item" => url("/sektor-plumbing/{$sectorSlug}")
    ]
];

if (isset($city) && is_object($city)) {
    if (isset($city->province)) {
        $breadcrumbItems[] = [
            "@type" => "ListItem",
            "position" => 4,
            "name" => $city->province->name,
            "item" => url("/sektor-plumbing/{$sectorSlug}")
        ];
        $breadcrumbItems[] = [
            "@type" => "ListItem",
            "position" => 5,
            "name" => $city->full_name ?? $city->name,
            "item" => $sectorCanonical
        ];
    } else {
        $breadcrumbItems[] = [
            "@type" => "ListItem",
            "position" => 4,
            "name" => $city->full_name ?? $city->name,
            "item" => $sectorCanonical
        ];
    }
}

$b2bGraph = [
    "@context" => "https://schema.org",
    "@graph" => [
        $mainB2BEntity,
        [
            "@type" => "BreadcrumbList",
            "@id" => $sectorCanonical . "#breadcrumb",
            "itemListElement" => $breadcrumbItems
        ],
        [
            "@type" => "FAQPage",
            "@id" => $sectorCanonical . "#faq",
            "mainEntity" => [
                [
                    "@type" => "Question",
                    "name" => "Apakah Rootera menyediakan Invoice Resmi dan e-Faktur PPN 11% untuk sektor " . $sectorName . "?",
                    "acceptedAnswer" => [
                        "@type" => "Answer",
                        "text" => "Ya, seluruh pengerjaan B2B untuk " . $sectorName . " dilengkapi invoice resmi berbadan hukum PT/CV J&J Group lengkap dengan e-Faktur Pajak PPN 11% untuk pembukuan finance Anda."
                    ]
                ],
                [
                    "@type" => "Question",
                    "name" => "Bagaimana mekanisme kontrak Preventive Maintenance saluran pipa di " . $sectorName . "?",
                    "acceptedAnswer" => [
                        "@type" => "Answer",
                        "text" => "Kami menyediakan paket maintenance berkala (bulanan/triwulan) mencakup Hydro Jetting gumpalan lemak, pembersihan grease trap, dan inspeksi CCTV pipa riser dengan jaminan SLA respon darurat 24 jam."
                    ]
                ]
            ]
        ]
    ]
];
?>
<script type="application/ld+json">
{!! json_encode($b2bGraph, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
{{-- Dynamic Breadcrumbs Bar --}}
<div class="bg-[#040D21] border-b border-white/10 py-3 px-4 text-xs text-slate-300">
    <div class="max-w-7xl mx-auto flex items-center gap-2 flex-wrap">
        <a href="{{ url('/') }}" class="text-slate-400 hover:text-white transition">Beranda</a>
        <span class="text-slate-600">/</span>
        <a href="{{ route('b2b.index') }}" class="text-slate-400 hover:text-white transition">Layanan B2B Komersial</a>
        <span class="text-slate-600">/</span>
        <a href="{{ url('/sektor-plumbing/' . $sectorSlug) }}" class="text-slate-400 hover:text-white transition">Sektor {{ $sectorName }}</a>
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

{{-- 1. Hero Section (Corporate B2B SLA & Industrial Authority) --}}
<section class="relative bg-gradient-to-br from-[#040D21] via-[#0B2545] to-[#061434] text-white pt-8 pb-14 md:pt-14 md:pb-20 overflow-hidden border-b-4 border-emerald-500">
    <div class="absolute top-0 right-0 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <div class="lg:col-span-8">
                <div class="inline-flex items-center gap-2 bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 px-3.5 py-1.5 rounded-full text-xs font-extrabold tracking-wide uppercase mb-4">
                    <span>🏢 Corporate B2B Solution</span>
                    <span>•</span>
                    <span>Sektor {{ $sectorName }}</span>
                    @if(isset($city))
                        <span>•</span>
                        <span class="text-white">📍 {{ $city->full_name }}</span>
                    @endif
                </div>

                <h1 class="text-2xl sm:text-4xl lg:text-5xl font-black text-white leading-tight tracking-tight mb-4">
                    @if(isset($city))
                        Jasa Plumbing & Kontrak Maintenance Sektor <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-200">{{ $sectorName }}</span> di {{ $city->full_name }}
                    @else
                        {{ $sector->hero_headline ?? ("Jasa Plumbing & Maintenance Sektor " . $sectorName) }}
                    @endif
                </h1>

                <p class="text-sm sm:text-base text-slate-300 leading-relaxed mb-6 max-w-3xl">
                    {{ $sector->short_description ?? 'Layanan khusus pengelola kawasan bisnis, ruko, restoran, dan gedung bertingkat.' }} Dikerjakan oleh teknisi ahli berlisensi <strong>Rootera Plumbing (J&J Group)</strong> menggunakan teknologi Hydro-Jetting 300 Bar & Rotary Cable tanpa perusak pipa.
                </p>

                <div class="flex flex-wrap gap-2 sm:gap-3 mb-8">
                    <div class="bg-white/10 backdrop-blur border border-white/15 text-white px-3 py-1.5 rounded-lg text-xs font-bold flex items-center gap-1.5">
                        <span>📄</span> Invoice Resmi PPN 11%
                    </div>
                    <div class="bg-white/10 backdrop-blur border border-white/15 text-white px-3 py-1.5 rounded-lg text-xs font-bold flex items-center gap-1.5">
                        <span>🌊</span> Hydro Jetting 300 Bar
                    </div>
                    <div class="bg-white/10 backdrop-blur border border-white/15 text-white px-3 py-1.5 rounded-lg text-xs font-bold flex items-center gap-1.5">
                        <span>🤝</span> Kontrak Maintenance SLA
                    </div>
                    <div class="bg-white/10 backdrop-blur border border-white/15 text-white px-3 py-1.5 rounded-lg text-xs font-bold flex items-center gap-1.5">
                        <span>🛡️</span> Legalitas PT/CV Lengkap
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Corporate Sales Rootera B2B, kami ingin konsultasi / panggil teknisi untuk sektor ' . $sectorName . (isset($city) ? ' di ' . $city->full_name : '')) }}" target="_blank" rel="noopener" class="bg-[#25D366] hover:bg-[#1EBE5A] active:scale-95 text-white font-extrabold text-sm sm:text-base px-6 py-3.5 rounded-xl text-center shadow-lg shadow-green-500/25 flex items-center justify-center gap-2 transition-all">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                        <span>Ajukan Proposal / Kontrak B2B (WA 24 Jam)</span>
                    </a>
                    <a href="{{ route('b2b.contract', $sectorSlug) }}" class="bg-emerald-600 hover:bg-emerald-700 active:scale-95 text-white font-bold text-sm sm:text-base px-6 py-3.5 rounded-xl text-center flex items-center justify-center gap-2 transition-all border border-emerald-400/30">
                        <span>📜 Pengajuan SLA & Maintenance</span>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-4">
                <div class="bg-slate-900/90 rounded-2xl p-4 border border-white/15 shadow-2xl relative overflow-hidden group">
                    <div class="relative h-56 sm:h-64 rounded-xl overflow-hidden mb-3">
                        <img src="{{ $sector->image_url ?? asset('images/JnJ.webp') }}" alt="Plumbing Sektor {{ $sectorName }} Rootera B2B" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="eager" decoding="async">
                        <div class="absolute top-3 left-3 bg-emerald-500 text-white font-black text-[10px] uppercase tracking-wider px-2.5 py-1 rounded-full shadow">
                            Verified B2B Unit
                        </div>
                        <div class="absolute bottom-3 left-3 right-3 bg-slate-950/80 backdrop-blur p-2.5 rounded-lg border border-white/10 text-xs font-bold text-white">
                            ⚙️ Hydro Jetter High Pressure 300 Bar
                        </div>
                    </div>
                    <div class="space-y-2 text-xs text-slate-300">
                        <div class="flex justify-between items-center py-1 border-b border-white/10">
                            <span class="text-slate-400">Pengelola & Client:</span>
                            <span class="font-bold text-white">Estate & Corporate B2B</span>
                        </div>
                        <div class="flex justify-between items-center py-1 border-b border-white/10">
                            <span class="text-slate-400">Kapasitas Pipa:</span>
                            <span class="font-bold text-emerald-400">Induk 4" s.d. 12" Inch</span>
                        </div>
                        <div class="flex justify-between items-center py-1">
                            <span class="text-slate-400">Legalitas Legal:</span>
                            <span class="font-bold text-white">PT / CV (PPN 11%)</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- 2. Interactive B2B Corporate Workflow / Timeline --}}
<section class="py-12 md:py-16 bg-slate-900 text-white border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="text-emerald-400 font-extrabold text-xs uppercase tracking-widest">SOP Kerjasama B2B</span>
            <h2 class="text-2xl sm:text-3xl font-black text-white mt-1">Alur Kerja Sama Korporat Sektor {{ $sectorName }}</h2>
            <p class="text-slate-400 text-sm sm:text-base mt-2">Sistematis, terstruktur, & bergaransi SLA resmi dari survey hingga penyerahan Berita Acara.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
            <div class="bg-slate-800/80 rounded-2xl p-6 border border-slate-700 relative">
                <div class="w-10 h-10 bg-emerald-500 text-slate-950 font-black text-base rounded-full flex items-center justify-center mb-4">1</div>
                <h3 class="font-bold text-white text-base mb-2">Konsultasi & Survey Lokasi</h3>
                <p class="text-slate-400 text-xs leading-relaxed">Tim teknis B2B melakukan audit pipa, pengukuran diameter, dan identifikasi titik mampet di kawasan Anda.</p>
            </div>

            <div class="bg-slate-800/80 rounded-2xl p-6 border border-slate-700 relative">
                <div class="w-10 h-10 bg-emerald-500 text-slate-950 font-black text-base rounded-full flex items-center justify-center mb-4">2</div>
                <h3 class="font-bold text-white text-base mb-2">Penawaran & Purchase Order (PO)</h3>
                <p class="text-slate-400 text-xs leading-relaxed">Penerbitan Surat Penawaran Harga (SPH) resmi PT/CV J&J Group beserta spesifikasi SLA kerja sama.</p>
            </div>

            <div class="bg-slate-800/80 rounded-2xl p-6 border border-slate-700 relative">
                <div class="w-10 h-10 bg-emerald-500 text-slate-950 font-black text-base rounded-full flex items-center justify-center mb-4">3</div>
                <h3 class="font-bold text-white text-base mb-2">Eksekusi & Berita Acara</h3>
                <p class="text-slate-400 text-xs leading-relaxed">Pengerjaan Hydro Jetting 300 Bar oleh teknisi ber-SOP, diakhiri dengan penerbitan Berita Acara Pengerjaan (BAP).</p>
            </div>

            <div class="bg-slate-800/80 rounded-2xl p-6 border border-slate-700 relative">
                <div class="w-10 h-10 bg-emerald-500 text-slate-950 font-black text-base rounded-full flex items-center justify-center mb-4">4</div>
                <h3 class="font-bold text-white text-base mb-2">Invoice PPN 11% & Garansi SLA</h3>
                <p class="text-slate-400 text-xs leading-relaxed">Penerbitan e-Faktur Pajak PPN 11% resmi untuk finance perusahaan disertai sertifikat garansi pemeliharaan.</p>
            </div>
        </div>
    </div>
</section>

{{-- 3. Commercial Project Documentation (Gallery Section - Specification Card Design & Mobile Horizontal Swipe) --}}
@if(isset($galleries) && $galleries->isNotEmpty())
<section class="py-12 md:py-16 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <span class="text-emerald-600 font-extrabold text-xs uppercase tracking-widest">📷 Dokumentasi Lapangan</span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">Galeri Pengerjaan Sektor Komersial</h2>
            </div>
            <a href="{{ route('galeri') }}" class="text-emerald-600 hover:text-emerald-700 font-bold text-xs flex items-center gap-1">
                <span>Lihat Semua Dokumentasi</span>
                <span>→</span>
            </a>
        </div>

        {{-- Mobile: Horizontal Swipe / Desktop: Grid 4 Columns (2 Rows x 4 Cards = Max 8 Cards) --}}
        <div class="flex md:grid flex-nowrap overflow-x-auto md:overflow-x-visible sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5 pb-4 md:pb-0 snap-x snap-mandatory scrollbar-none -mx-4 px-4 md:mx-0 md:px-0">
            @foreach($galleries as $gal)
                <?php
                    $galTitle = $gal->title ?? ('Pengerjaan Sektor ' . $sectorName);
                    $galCategory = $gal->category_label ?? (isset($sector) ? $sector->sector_name : 'Komersial');
                    $galLoc = $gal->location_tag ?? ($city->full_name ?? ($city->name ?? 'Jabodetabek'));
                    $galDesc = $gal->description ?? 'Pelancaran saluran pipa tersumbat tanpa bongkar keramik menggunakan mesin rotary & hydro jetting.';
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

{{-- 4. Industrial Heavy Equipment Showcase --}}
<?php
  $mediaService = app(\App\Services\MediaService::class);
  $toolkitImages = $mediaService->getToolkitImages();
  $sectorLoc = isset($city) ? $city->name : 'Indonesia';
?>
<section class="py-12 md:py-16 bg-slate-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="text-emerald-600 font-extrabold text-xs uppercase tracking-widest">🛠️ Peralatan Industri B2B</span>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">Armada Alat Berat Sektor {{ $sectorName }}</h2>
            <p class="text-slate-600 text-sm sm:text-base mt-2">Dukungan alat kapasitas industri untuk melancarkan saluran utama tanpa merusak bangunan.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm">
                <div class="h-48 overflow-hidden bg-slate-950">
                    <img src="{{ $toolkitImages['hydro_jetting']['url'] }}" alt="Hydro Jetting 300 Bar Sektor {{ $sectorName }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" loading="lazy" decoding="async">
                </div>
                <div class="p-5">
                    <h3 class="font-extrabold text-lg text-slate-900 mb-1">Hydro Jetting High Pressure 300 Bar</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">Pengikisan gumpalan lemak beku & limbah cair di pipa utama restoran, hotel, & pabrik.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm">
                <div class="h-48 overflow-hidden bg-slate-950">
                    <img src="{{ $toolkitImages['heavy_duty']['url'] }}" alt="Mesin Rooter Commercial Sektor {{ $sectorName }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" loading="lazy" decoding="async">
                </div>
                <div class="p-5">
                    <h3 class="font-extrabold text-lg text-slate-900 mb-1">Mesin Rooter Commercial Heavy-Duty</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">Penembus sumbatan keras, kain, & sampah di jaringan drainase gedung bertingkat & ruko.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm">
                <div class="h-48 overflow-hidden bg-slate-950">
                    <img src="{{ $toolkitImages['cctv_camera']['url'] }}" alt="Kamera CCTV Pipa Sektor {{ $sectorName }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" loading="lazy" decoding="async">
                </div>
                <div class="p-5">
                    <h3 class="font-extrabold text-lg text-slate-900 mb-1">Inspeksi Kamera Endoskop CCTV Pipa</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">Investigasi visual kondisi dalam pipa riser vertikal & jaringan drainase sebelum perawatan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 5. B2B Knowledge Base / Blog Articles Section --}}
@if(isset($relatedArticles) && $relatedArticles->isNotEmpty())
<section class="py-12 md:py-16 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <span class="text-emerald-600 font-extrabold text-xs uppercase tracking-widest">📚 B2B Knowledge Base</span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">Artikel Edukasi Sanitasi Komersial</h2>
            </div>
            <a href="{{ route('blog') }}" class="text-emerald-600 hover:text-emerald-700 font-bold text-xs flex items-center gap-1">
                <span>Lihat Semua Artikel</span>
                <span>→</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($relatedArticles as $art)
                <div class="bg-slate-50 border border-slate-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition flex flex-col">
                    <div class="h-48 bg-slate-900 overflow-hidden relative">
                        <img src="{{ $art->thumbnail_url ?? asset('images/JnJ.webp') }}" alt="{{ $art->title }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" loading="lazy" decoding="async">
                        <span class="absolute top-3 left-3 bg-emerald-600 text-white font-bold text-[10px] uppercase px-2.5 py-1 rounded-md shadow">
                            {{ $art->category ?? 'Edukasi B2B' }}
                        </span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="text-slate-400 text-[11px] font-semibold">{{ $art->published_at ? $art->published_at->format('d M Y') : 'Terbaru' }}</span>
                            <h3 class="font-bold text-base text-slate-900 mt-1 mb-2 line-clamp-2">{{ $art->title }}</h3>
                            <p class="text-slate-600 text-xs line-clamp-3 leading-relaxed mb-4">{{ Str::limit(strip_tags($art->content), 120) }}</p>
                        </div>
                        <a href="{{ route('blog.show', $art->slug) }}" class="text-emerald-600 hover:text-emerald-700 font-bold text-xs flex items-center gap-1 mt-auto">
                            <span>Baca Selengkapnya</span>
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
            <h3 class="text-xl sm:text-2xl font-black text-slate-900 mt-1">Cakupan Layanan Sektor {{ $sectorName }} di Kecamatan {{ $city->name }}</h3>
            <p class="text-slate-600 text-sm">Pilih lokasi kecamatan operasional bisnis Anda untuk respon cepat tim armada teknisi terdekat:</p>
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
@elseif(isset($allCities) && $allCities->isNotEmpty())
<section class="py-12 md:py-16 bg-slate-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="mb-6">
            <span class="text-emerald-600 font-extrabold text-xs uppercase tracking-widest">📍 Network Coverage</span>
            <h3 class="text-xl sm:text-2xl font-black text-slate-900 mt-1">Cakupan Layanan Sektor {{ $sectorName }} di Kota Lainnya</h3>
            <p class="text-slate-600 text-sm">Pilih kota lokasi properti bisnis Anda untuk penanganan cepat 24 Jam:</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
            @foreach($allCities as $c)
                <a href="{{ url('/sektor-plumbing/' . $sectorSlug . '/' . $c->slug) }}" class="bg-white border border-slate-200 hover:border-emerald-500 hover:text-emerald-700 text-slate-700 font-bold text-xs p-3.5 rounded-xl shadow-sm transition flex items-center justify-between group">
                    <span>📍 {{ $sectorName }} {{ $c->name }}</span>
                    <span class="text-slate-400 group-hover:text-emerald-500">→</span>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- 7. B2B Consultation Banner --}}
<section class="bg-gradient-to-r from-[#040D21] to-[#0B2545] text-white py-14 px-4 text-center border-t-4 border-emerald-500">
    <div class="max-w-4xl mx-auto space-y-4">
        <h2 class="text-2xl sm:text-4xl font-black">Butuh Penanganan Darurat atau Penawaran SLA Sektor {{ $sectorName }}?</h2>
        <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto">
            Tim corporate sales Rootera Plumbing (J&J Group) siap memproses survei lokasi, penawaran kontrak maintenance berkala, serta penerbitan invoice legal ber-PPN 11%.
        </p>
        <div class="pt-4">
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Corporate Sales Rootera (J&J Group), kami butuh panggil teknisi / kontrak B2B untuk sektor ' . $sectorName) }}" target="_blank" rel="noopener" class="bg-[#25D366] hover:bg-[#1EBE5A] active:scale-95 text-white font-black text-sm sm:text-base px-8 py-4 rounded-full inline-flex items-center gap-2 shadow-xl shadow-green-500/25 transition-transform">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                <span>Hubungi Corporate Sales B2B (WhatsApp 24 Jam)</span>
            </a>
        </div>
    </div>
</section>
@endsection
