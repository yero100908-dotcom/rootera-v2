@extends('layouts.app')

@section('schema-markup')
<?php
$locName = $locationLabel ?? ($city ? $city->full_name : "Jabodetabek & Indonesia");

$faqData = [
    [
        'question' => "Apakah penanganan {$sanitizedTitle} di {$locName} ini membongkar lantai keramik?",
        'answer' => "Sama sekali tidak. Teknisi Rootera Plumbing menggunakan teknologi mekanis spiral rotary Ridgid dan Hydro-Jetting tanpa bongkar, sehingga keramik dan dinding bangunan Anda tetap 100% utuh dan bersih."
    ],
    [
        'question' => "Berapa lama estimasi pengerjaan hingga pipa lancar kembali?",
        'answer' => "Pengerjaan rata-rata membutuhkan waktu 1 hingga 2 jam saja tergantung tingkat keparahan gumpalan lemak atau kotoran di dalam jaringan pipa."
    ],
    [
        'question' => "Apakah pengerjaan ini bergaransi resmi?",
        'answer' => "Ya, seluruh pengerjaan residensial bergaransi tuntas 100% selama 30 hari. Jika terjadi mampet kembali dalam masa garansi, teknisi kami akan datang melakukan pengerjaan ulang gratis!"
    ],
    [
        'question' => "Berapa estimasi biaya jasa pelancaran pipa di Rootera Plumbing?",
        'answer' => "Biaya sangat transparan mulai dari Rp 300.000 hingga Rp 450.000 untuk rumah tinggal. Tanpa biaya tersembunyi, pembayaran dilakukan setelah saluran pipa berfungsi lancar kembali."
    ]
];

$faqSchemaItems = [];
foreach ($faqData as $f) {
    $faqSchemaItems[] = [
        "@type" => "Question",
        "name" => $f['question'],
        "acceptedAnswer" => [
            "@type" => "Answer",
            "text" => $f['answer']
        ]
    ];
}

$graphSchema = [
    "@context" => "https://schema.org",
    "@graph" => [
        [
            "@type" => ["PlumbingService", "LocalBusiness", "EmergencyService"],
            "@id" => url()->current() . "#service",
            "name" => "Rootera Plumbing - Solusi " . $sanitizedTitle . " di " . $locName,
            "url" => url()->current(),
            "telephone" => "+6281385404000",
            "priceRange" => "Rp 300.000 - Rp 500.000",
            "image" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
            "logo" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
            "description" => "Layanan spesialis " . $sanitizedTitle . " terdekat di " . $locName . " 24 jam bergaransi tuntas tanpa bongkar ubin.",
            "address" => [
                "@type" => "PostalAddress",
                "addressLocality" => $city ? $city->name : "Jakarta Selatan",
                "addressRegion" => "DKI Jakarta / Jawa Barat",
                "addressCountry" => "ID"
            ],
            "areaServed" => [
                "@type" => "AdministrativeArea",
                "name" => $locName
            ],
            "parentOrganization" => [
                "@type" => "Organization",
                "name" => "J&J GROUP",
                "url" => "https://holding.jnj.co.id"
            ],
            "hasOfferCatalog" => [
                "@type" => "OfferCatalog",
                "name" => "Katalog Layanan Pelancaran Pipa Mampet",
                "itemListElement" => [
                    [
                        "@type" => "Offer",
                        "itemOffered" => [
                            "@type" => "Service",
                            "name" => $sanitizedTitle . " Residensial",
                            "description" => "Pelancaran pipa mampet rumah tinggal tanpa bongkar keramik."
                        ],
                        "priceCurrency" => "IDR",
                        "price" => $problemInfo['price_home'] ?? "300000"
                    ],
                    [
                        "@type" => "Offer",
                        "itemOffered" => [
                            "@type" => "Service",
                            "name" => $sanitizedTitle . " Komersial B2B",
                            "description" => "Hydro-jetting tekanan tinggi & kontrak maintenance gedung/resto."
                        ],
                        "priceCurrency" => "IDR",
                        "price" => "Custom Quote"
                    ]
                ]
            ]
        ],
        [
            "@type" => "FAQPage",
            "@id" => url()->current() . "#faq",
            "mainEntity" => $faqSchemaItems
        ]
    ]
];
?>
<script type="application/ld+json">
{!! json_encode($graphSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')

{{-- 1. HERO SECTION (Dark Modern Split & Value Proposition Badges) --}}
<section class="bg-gradient-to-br from-slate-950 via-slate-900 to-emerald-950 text-white relative overflow-hidden py-14 sm:py-20 lg:py-24 border-b border-slate-800" aria-labelledby="page-title">
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 relative z-10 text-center">
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur border border-white/15 text-emerald-400 text-xs font-extrabold uppercase tracking-widest mb-4 shadow-sm">
            <span>⚡ Respon Darurat 24 Jam Nonstop</span>
        </div>

        <h1 id="page-title" class="text-2xl sm:text-4xl lg:text-5xl font-black text-white leading-tight tracking-tight mb-4 max-w-4xl mx-auto">
            Solusi {{ $sanitizedTitle }} di <span class="text-emerald-400">{{ $districtName ? $districtName . ', ' : '' }}{{ $city ? $city->full_name : 'Jabodetabek' }}</span>
        </h1>

        <p class="text-slate-300 text-sm sm:text-base lg:text-lg max-w-2xl mx-auto leading-relaxed mb-6 font-medium">
            Penanganan spesialis saluran mampet menggunakan mesin rotasi kabel lentur & hydro-jetting tekanan tinggi tanpa membongkar keramik atau merusak dinding rumah Anda.
        </p>

        {{-- 4 Horizontal Value Proposition Badges --}}
        <div class="flex flex-wrap justify-center items-center gap-2 sm:gap-3 mb-8">
            <span class="bg-slate-900/80 backdrop-blur border border-emerald-500/30 text-emerald-300 text-xs sm:text-sm font-bold px-3.5 py-1.5 rounded-full shadow-sm flex items-center gap-1.5">
                <span>⚡</span> Tiba 30-45 Menit
            </span>
            <span class="bg-slate-900/80 backdrop-blur border border-emerald-500/30 text-emerald-300 text-xs sm:text-sm font-bold px-3.5 py-1.5 rounded-full shadow-sm flex items-center gap-1.5">
                <span>🛡️</span> Garansi 100% Tuntas
            </span>
            <span class="bg-slate-900/80 backdrop-blur border border-emerald-500/30 text-emerald-300 text-xs sm:text-sm font-bold px-3.5 py-1.5 rounded-full shadow-sm flex items-center gap-1.5">
                <span>🚫</span> Tanpa Bongkar Keramik
            </span>
            <span class="bg-slate-900/80 backdrop-blur border border-emerald-500/30 text-emerald-300 text-xs sm:text-sm font-bold px-3.5 py-1.5 rounded-full shadow-sm flex items-center gap-1.5">
                <span>💰</span> Biaya Transparan
            </span>
        </div>

        {{-- Direct CTA Buttons --}}
        <?php
            $waMsg = "Halo Rootera Plumbing, saya ingin konsultasi panggil teknisi untuk penanganan " . $sanitizedTitle . " di " . $locationLabel;
        ?>
        <div class="flex flex-col sm:flex-row justify-center items-center gap-3 max-w-md mx-auto">
            <a href="https://wa.me/6281385404000?text={{ urlencode($waMsg) }}" target="_blank" rel="noopener" class="w-full sm:w-auto bg-emerald-500 hover:bg-emerald-600 active:scale-95 text-white font-extrabold text-sm sm:text-base px-6 py-3.5 rounded-full shadow-lg shadow-emerald-500/25 transition flex items-center justify-center gap-2">
                <span>💬 Panggil Teknisi (WhatsApp 24 Jam)</span>
            </a>
            <a href="tel:081385404000" class="w-full sm:w-auto bg-white/10 hover:bg-white/20 active:scale-95 text-white border border-white/20 font-bold text-sm sm:text-base px-5 py-3.5 rounded-full transition flex items-center justify-center gap-2 backdrop-blur">
                <span>📞 Telepon Darurat</span>
            </a>
        </div>
    </div>
</section>

{{-- 2. GOOGLE DIRECT ANSWER / DIAGNOSTIC CARD --}}
<section class="py-10 sm:py-14 bg-slate-50 border-b border-slate-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="bg-emerald-50/90 border-l-4 border-emerald-500 rounded-r-2xl p-5 sm:p-6 shadow-sm border border-emerald-100/60">
            <div class="flex items-start gap-3.5">
                <span class="text-3xl shrink-0">💡</span>
                <div>
                    <h2 class="text-xs sm:text-sm font-extrabold text-emerald-800 uppercase tracking-wider mb-1">Direct Diagnostic Snippet</h2>
                    <p class="text-slate-800 text-sm sm:text-base leading-relaxed font-medium mb-3">
                        Masalah <strong>{{ $sanitizedTitle }}</strong> di <strong>{{ $locationLabel }}</strong> paling sering disebabkan oleh penumpukan bekuan minyak lemak dapur, rontokan rambut di floor drain, atau sedimen kapur di belokan paralon PVC.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5 pt-2 border-t border-emerald-200/60 text-xs font-bold text-emerald-900">
                        <div class="flex items-center gap-1.5">
                            <span>🔍 Metode:</span>
                            <span class="text-slate-700 font-semibold">Rotary & Hydro-Jetting</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span>⏱️ Waktu Pengerjaan:</span>
                            <span class="text-slate-700 font-semibold">1 – 2 Jam Tuntas</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span>🧪 Kimia Asam:</span>
                            <span class="text-slate-700 font-semibold">100% Bebas Asam Kimia</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 3. QUICK PROBLEM CARDS (Kategori Saluran Tersumbat) --}}
<section class="py-12 sm:py-16 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="text-emerald-600 font-extrabold text-xs uppercase tracking-widest">📋 Klasifikasi Masalah</span>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">Jenis Pipa Mampet yang Sering Kami Tangani</h2>
            <p class="text-slate-600 text-sm sm:text-base mt-2">Pilih kategori masalah yang sesuai dengan kendala saluran air di lokasi Anda.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            {{-- Card 1: Wastafel --}}
            <div class="bg-slate-50 hover:bg-white rounded-2xl p-5 border border-slate-200 hover:border-emerald-500 shadow-xs hover:shadow-md transition duration-300 flex flex-col justify-between group">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-2xl font-black mb-4 group-hover:scale-110 transition">
                        🥣
                    </div>
                    <h3 class="font-extrabold text-base text-slate-900 mb-1.5">Wastafel Dapur Berlemak</h3>
                    <p class="text-slate-600 text-xs leading-relaxed mb-4">Pengikisan kerak gumpalan minyak beku di leher angsa bak cuci piring tanpa membongkar meja dapur.</p>
                </div>
                <a href="{{ route('layanan.show', 'wastafel-mampet') }}" class="text-emerald-600 hover:text-emerald-700 font-extrabold text-xs flex items-center gap-1 transition">
                    <span>Lihat Solusi Wastafel</span>
                    <span>→</span>
                </a>
            </div>

            {{-- Card 2: Floor Drain --}}
            <div class="bg-slate-50 hover:bg-white rounded-2xl p-5 border border-slate-200 hover:border-emerald-500 shadow-xs hover:shadow-md transition duration-300 flex flex-col justify-between group">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-2xl font-black mb-4 group-hover:scale-110 transition">
                        🚿
                    </div>
                    <h3 class="font-extrabold text-base text-slate-900 mb-1.5">Floor Drain Kamar Mandi</h3>
                    <p class="text-slate-600 text-xs leading-relaxed mb-4">Pembersihan rontokan rambut, gumpalan sabun, & saringan drain menggenang di lantai mandi.</p>
                </div>
                <a href="{{ route('layanan.show', 'kamar-mandi-mampet') }}" class="text-emerald-600 hover:text-emerald-700 font-extrabold text-xs flex items-center gap-1 transition">
                    <span>Lihat Solusi Floor Drain</span>
                    <span>→</span>
                </a>
            </div>

            {{-- Card 3: WC Kloset --}}
            <div class="bg-slate-50 hover:bg-white rounded-2xl p-5 border border-slate-200 hover:border-emerald-500 shadow-xs hover:shadow-md transition duration-300 flex flex-col justify-between group">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center text-2xl font-black mb-4 group-hover:scale-110 transition">
                        🚽
                    </div>
                    <h3 class="font-extrabold text-base text-slate-900 mb-1.5">Kloset & WC Toilet Meluap</h3>
                    <p class="text-slate-600 text-xs leading-relaxed mb-4">Evakuasi pembalut, mainan anak, tisu basah, atau leher angsa WC meluap secara higienis.</p>
                </div>
                <a href="{{ route('layanan.show', 'wc-toilet-mampet') }}" class="text-emerald-600 hover:text-emerald-700 font-extrabold text-xs flex items-center gap-1 transition">
                    <span>Lihat Solusi Kloset WC</span>
                    <span>→</span>
                </a>
            </div>

            {{-- Card 4: Got & Talang --}}
            <div class="bg-slate-50 hover:bg-white rounded-2xl p-5 border border-slate-200 hover:border-emerald-500 shadow-xs hover:shadow-md transition duration-300 flex flex-col justify-between group">
                <div>
                    <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center text-2xl font-black mb-4 group-hover:scale-110 transition">
                        🌧️
                    </div>
                    <h3 class="font-extrabold text-base text-slate-900 mb-1.5">Got & Talang Pembuangan</h3>
                    <p class="text-slate-600 text-xs leading-relaxed mb-4">Pelancaran pipa induk pembuangan hujan, got perumahan, & pengerukan bak kontrol sedimen.</p>
                </div>
                <a href="{{ route('layanan.show', 'got-saluran-pembuangan') }}" class="text-emerald-600 hover:text-emerald-700 font-extrabold text-xs flex items-center gap-1 transition">
                    <span>Lihat Solusi Got & Talang</span>
                    <span>→</span>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- 4. ARMADA & PERALATAN KHUSUS (Modern Tool Grid) --}}
@if(isset($toolkitImages) && is_array($toolkitImages))
<section class="py-12 sm:py-16 bg-slate-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="text-emerald-600 font-extrabold text-xs uppercase tracking-widest">🛠️ Spesifikasi Alat Kerja</span>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">Armada Teknologi Pipa Bebas Bongkar</h2>
            <p class="text-slate-600 text-sm sm:text-base mt-2">Dukungan alat standar industri internasional untuk hasil pembersihan presisi 100% tuntas.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            {{-- Tool 1: Rotary --}}
            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="h-48 overflow-hidden bg-slate-950">
                        <img src="{{ $toolkitImages['heavy_duty']['url'] ?? asset('images/JnJ.jpeg') }}" alt="Mesin Cable Spiral Rotary Ridgid" class="w-full h-full object-cover hover:scale-105 transition duration-500" loading="lazy">
                    </div>
                    <div class="p-5">
                        <h3 class="font-extrabold text-lg text-slate-900 mb-1">Ridgid Cable Spiral Rotary</h3>
                        <p class="text-slate-600 text-xs leading-relaxed">Kabel baja spiral lentur berputar kecepatan tinggi menembus & memotong gumpalan kotoran di belokan pipa paralon.</p>
                    </div>
                </div>
                <div class="px-5 pb-5 pt-0">
                    <span class="inline-block bg-slate-100 text-slate-700 text-[11px] font-extrabold px-3 py-1 rounded-full">Residensial & Komersial</span>
                </div>
            </div>

            {{-- Tool 2: Hydro Jetter --}}
            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="h-48 overflow-hidden bg-slate-950">
                        <img src="{{ $toolkitImages['hydro_jetting']['url'] ?? asset('images/JnJ.jpeg') }}" alt="High-Pressure Hydro Jetting System" class="w-full h-full object-cover hover:scale-105 transition duration-500" loading="lazy">
                    </div>
                    <div class="p-5">
                        <h3 class="font-extrabold text-lg text-slate-900 mb-1">Hydro-Jetting High Pressure</h3>
                        <p class="text-slate-600 text-xs leading-relaxed">Penyemprotan air tekanan tinggi hingga 300 Bar untuk mengikis total kerak minyak beku restoran & industri.</p>
                    </div>
                </div>
                <div class="px-5 pb-5 pt-0">
                    <span class="inline-block bg-emerald-100 text-emerald-800 text-[11px] font-extrabold px-3 py-1 rounded-full">Kapasitas Industri B2B</span>
                </div>
            </div>

            {{-- Tool 3: CCTV Camera --}}
            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="h-48 overflow-hidden bg-slate-950">
                        <img src="{{ $toolkitImages['cctv_camera']['url'] ?? asset('images/JnJ.jpeg') }}" alt="Kamera CCTV Endoskop Inspeksi Pipa" class="w-full h-full object-cover hover:scale-105 transition duration-500" loading="lazy">
                    </div>
                    <div class="p-5">
                        <h3 class="font-extrabold text-lg text-slate-900 mb-1">Kamera CCTV Endoskop Pipa</h3>
                        <p class="text-slate-600 text-xs leading-relaxed">Deteksi visual langsung kondisi dalam dinding pipa untuk melacak titik pipa bocor/pecah tersembunyi.</p>
                    </div>
                </div>
                <div class="px-5 pb-5 pt-0">
                    <span class="inline-block bg-blue-100 text-blue-800 text-[11px] font-extrabold px-3 py-1 rounded-full">Inspeksi Visual HD</span>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- 5. GALERI DOKUMENTASI PENGERJAAN LAPANGAN (Specification Card Design & Mobile Horizontal Swipe) --}}
@if(isset($galleries) && $galleries->isNotEmpty())
<section class="py-12 md:py-16 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <span class="text-emerald-600 font-extrabold text-xs uppercase tracking-widest">📸 Dokumentasi Lapangan</span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">Bukti Aksi Pengerjaan Real di Lapangan</h2>
            </div>
            <a href="{{ route('galeri') }}" class="text-emerald-600 hover:text-emerald-700 font-bold text-xs flex items-center gap-1">
                <span>Lihat Semua Galeri</span>
                <span>→</span>
            </a>
        </div>

        {{-- Mobile: Horizontal Swipe / Desktop: Grid 4 Columns (2 Rows x 4 Cards = Max 8 Cards) --}}
        <div class="flex md:grid flex-nowrap overflow-x-auto md:overflow-x-visible sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5 pb-4 md:pb-0 snap-x snap-mandatory scrollbar-none -mx-4 px-4 md:mx-0 md:px-0">
            @foreach($galleries as $gal)
                <?php
                    $galTitle = $gal->title ?? ('Pengerjaan ' . $sanitizedTitle);
                    $galCategory = $gal->category_label ?? 'Komersial';
                    $galLoc = $gal->location_tag ?? ($districtName ?? ($city->name ?? 'Jabodetabek'));
                    $galDesc = $gal->description ?? 'Pelancaran saluran pipa tersumbat tanpa bongkar keramik menggunakan mesin rotary & hydro jetting.';
                    $galImg = $gal->display_thumbnail ?? ($gal->image_url ?? asset('images/JnJ.webp'));
                    $galDetailUrl = !empty($gal->slug) ? route('galeri.show', $gal->slug) : route('galeri');
                    $galWaText = "Halo Rootera, saya ingin konsultasi pengerjaan serupa: " . $galTitle . " di " . $galLoc;
                ?>
                <div class="flex-shrink-0 w-[82vw] sm:w-[280px] md:w-auto snap-center bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition group flex flex-col justify-between">
                    <div>
                        {{-- Image Container & Overlay Badges --}}
                        <div class="relative aspect-[4/3] bg-slate-900 overflow-hidden rounded-t-2xl">
                            <img src="{{ $galImg }}" alt="Dokumentasi Pengerjaan {{ $galTitle }} di {{ $galLoc }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" loading="lazy" decoding="async">
                            
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
                            <a href="https://wa.me/6281385404000?text={{ urlencode($galWaText) }}" target="_blank" rel="noopener" class="bg-emerald-500 hover:bg-emerald-600 active:scale-95 text-white font-extrabold text-[11px] px-3 py-1.5 rounded-full flex items-center gap-1 shadow-sm transition">
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

{{-- 6. PERBANDINGAN METODE (Rootera vs Konvensional) --}}
<section class="py-12 sm:py-16 bg-slate-50 border-b border-slate-200">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="text-emerald-600 font-extrabold text-xs uppercase tracking-widest">⚖️ Perbandingan Keamanan</span>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">Mengapa Harus Hindari Soda Api & Pembongkaran?</h2>
            <p class="text-slate-600 text-sm sm:text-base mt-2">Bandingkan efek metode konvensional dengan teknologi pelancaran mekanis modern Rootera.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Konvensional (Red Accent) --}}
            <div class="bg-white rounded-2xl border border-red-200 p-6 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-red-500 text-white font-extrabold text-[11px] px-3 py-1 rounded-bl-xl uppercase tracking-wider">
                    ❌ Cara Konvensional / Soda Api
                </div>
                <h3 class="text-lg font-black text-red-600 mb-4 pt-2">Metode Berisiko & Rusak Structure</h3>
                <ul class="space-y-3 text-xs sm:text-sm text-slate-700">
                    <li class="flex items-start gap-2.5">
                        <span class="text-red-500 font-bold shrink-0">✕</span>
                        <span><strong>Soda Api Melelehkan Pipa:</strong> Reaksi panas ekstrim membuat sambungan pipa PVC melengkung & bocor di dalam tanah.</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <span class="text-red-500 font-bold shrink-0">✕</span>
                        <span><strong>Pembongkaran Keramik Mahal:</strong> Membongkar ubin lantai membutuhkan biaya tukang besar dan membuat rumah berdebu.</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <span class="text-red-500 font-bold shrink-0">✕</span>
                        <span><strong>Mampet Kembali Dalam Hitungan Hari:</strong> Kotoran tidak terkikis habis hanya terdorong sementara ke belokan pipa.</span>
                    </li>
                </ul>
            </div>

            {{-- Rootera Modern (Emerald Accent) --}}
            <div class="bg-gradient-to-br from-slate-900 to-emerald-950 text-white rounded-2xl border border-emerald-500/40 p-6 shadow-md relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-emerald-500 text-white font-extrabold text-[11px] px-3 py-1 rounded-bl-xl uppercase tracking-wider">
                    ✅ Metode Rootera Plumbing
                </div>
                <h3 class="text-lg font-black text-emerald-400 mb-4 pt-2">Mekanis Spiral & Hydro-Jetting</h3>
                <ul class="space-y-3 text-xs sm:text-sm text-slate-200">
                    <li class="flex items-start gap-2.5">
                        <span class="text-emerald-400 font-bold shrink-0">✓</span>
                        <span><strong>100% Bebas Bongkar:</strong> Pipa dibersihkan langsung dari lubang afur/drain tanpa merusak ubin keramik.</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <span class="text-emerald-400 font-bold shrink-0">✓</span>
                        <span><strong>Dinding Pipa Bersih Tuntas:</strong> Kabel spiral rotary mengikis habis sisa lemak beku & rontokan rambut hingga meluncur.</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <span class="text-emerald-400 font-bold shrink-0">✓</span>
                        <span><strong>Garansi Residensial 30 Hari:</strong> Garansi tuntas 100% jaminan pengerjaan ulang gratis jika saluran mampet lagi.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- 7. PUSAT EDUKASI & ARTIKEL MASALAH PIPA (Blog Section) --}}
@if(isset($relatedArticles) && $relatedArticles->isNotEmpty())
<section class="py-12 sm:py-16 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
            <div>
                <span class="text-emerald-600 font-extrabold text-xs uppercase tracking-widest">📰 Pusat Edukasi</span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">Artikel & Panduan Perawatan Pipa</h2>
            </div>
            <a href="{{ route('blog') }}" class="text-emerald-600 hover:text-emerald-700 font-bold text-xs flex items-center gap-1">
                <span>Lihat Artikel Lainnya</span>
                <span>→</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            @foreach($relatedArticles as $art)
                <div class="bg-slate-50 rounded-2xl border border-slate-200 p-5 flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <span class="text-[11px] font-extrabold text-emerald-600 uppercase tracking-wider block mb-2">Artikel Edukasi</span>
                        <h3 class="font-extrabold text-sm sm:text-base text-slate-900 mb-2 line-clamp-2 hover:text-emerald-600 transition">
                            <a href="{{ route('blog.show', $art->slug) }}">{{ $art->title }}</a>
                        </h3>
                        <p class="text-slate-600 text-xs line-clamp-3 leading-relaxed mb-4">
                            {{ Str::limit($art->excerpt, 110) }}
                        </p>
                    </div>
                    <a href="{{ route('blog.show', $art->slug) }}" class="text-emerald-600 hover:text-emerald-700 font-extrabold text-xs flex items-center gap-1">
                        <span>Baca Selengkapnya</span>
                        <span>→</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- 8. SUB-DISTRICT GEO MESH / JANGKAUAN WILAYAH SEKITAR --}}
@if((isset($neighborDistricts) && $neighborDistricts->isNotEmpty()) || (isset($allCities) && $allCities->isNotEmpty()))
<section class="py-12 sm:py-16 bg-slate-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm">
            <h3 class="text-lg sm:text-xl font-extrabold text-slate-900 mb-1">
                📍 Jangkauan Area Teknisi di Sekitar {{ $locationLabel }}
            </h3>
            <p class="text-slate-500 text-xs sm:text-sm mb-6">Pos responder terdekat siap siaga meluncur ke lokasi Anda dengan jaminan estimasi waktu tempuh (ETA) efisien:</p>

            {{-- Neighbor Districts --}}
            @if(isset($neighborDistricts) && $neighborDistricts->isNotEmpty() && isset($city))
            <div class="mb-8">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-3">Kecamatan Terdekat di {{ $city->full_name }}</span>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                    @foreach($neighborDistricts as $sib)
                        <?php
                            $targetUrl = url('/layanan-pipa-mampet/pipa-mampet/' . $city->slug . '/' . $sib->slug);
                        ?>
                        <a href="{{ $targetUrl }}" class="bg-slate-50 hover:bg-emerald-50 border border-slate-200 hover:border-emerald-300 text-slate-800 hover:text-emerald-700 p-3 rounded-xl text-xs font-bold transition flex items-center justify-between group min-h-[44px]">
                            <div class="flex flex-col truncate">
                                <span class="truncate">📍 {{ $sib->name }}</span>
                                <span class="text-[10px] text-emerald-600 font-semibold">⏱️ Response ~ 20-30m</span>
                            </div>
                            <span class="text-emerald-500 group-hover:translate-x-0.5 transition shrink-0 ml-1">→</span>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- City Full Names --}}
            @if(isset($allCities) && $allCities->isNotEmpty())
            <div>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-3">Kota & Kabupaten Operasional Utama</span>
                <div class="flex flex-wrap gap-2">
                    @foreach($allCities as $c)
                        <a href="{{ url('/solusi/' . $problemSlug . '/' . $c->slug) }}" class="bg-slate-50 hover:bg-slate-100 border border-slate-200 hover:border-slate-300 text-slate-700 hover:text-slate-900 px-3.5 py-2 rounded-full text-xs font-semibold transition flex items-center gap-1 min-h-[36px]">
                            <span>📍</span>
                            <span>{{ $sanitizedTitle }} {{ $c->full_name }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endif

{{-- 9. FAQ AKORDEON INTERAKTIF --}}
<section class="py-12 sm:py-16 bg-white border-b border-slate-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="text-emerald-600 font-extrabold text-xs uppercase tracking-widest">❓ Pertanyaan Umum</span>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">FAQ Penanganan {{ $sanitizedTitle }}</h2>
            <p class="text-slate-600 text-sm sm:text-base mt-2">Jawaban resmi mengenai jaminan garansi, estimasi biaya, & metode pengerjaan tanpa bongkar.</p>
        </div>

        <div class="space-y-4">
            @foreach($faqData as $idx => $faq)
                <details class="group bg-slate-50 rounded-2xl border border-slate-200 p-5 [&_summary::-webkit-details-marker]:hidden" {{ $idx === 0 ? 'open' : '' }}>
                    <summary class="flex items-center justify-between cursor-pointer font-extrabold text-sm sm:text-base text-slate-900">
                        <span>{{ $faq['question'] }}</span>
                        <span class="ml-1.5 shrink-0 rounded-full bg-white p-1 text-slate-900 group-open:-rotate-180 transition duration-300 border border-slate-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </summary>
                    <p class="mt-3 text-slate-600 text-xs sm:text-sm leading-relaxed border-t border-slate-200/80 pt-3">
                        {{ $faq['answer'] }}
                    </p>
                </details>
            @endforeach
        </div>
    </div>
</section>

{{-- 10. STICKY FLOATING CTA BAR (KHUSUS MOBILE) --}}
<div class="fixed bottom-0 left-0 right-0 z-50 bg-slate-950/90 backdrop-blur-md border-t border-slate-800 p-3 sm:hidden flex items-center gap-2.5 shadow-2xl">
    <a href="tel:081385404000" class="flex-1 bg-slate-800 hover:bg-slate-700 active:scale-95 text-white font-extrabold text-xs py-2.5 px-3 rounded-full flex items-center justify-center gap-1.5 border border-slate-700 transition">
        <span>📞 Telepon</span>
    </a>
    <a href="https://wa.me/6281385404000?text={{ urlencode($waMsg) }}" target="_blank" rel="noopener" class="flex-[2] bg-emerald-500 hover:bg-emerald-600 active:scale-95 text-white font-extrabold text-xs py-2.5 px-4 rounded-full flex items-center justify-center gap-1.5 shadow-md transition">
        <span>💬 Konsultasi WA 24 Jam</span>
    </a>
</div>

@endsection
