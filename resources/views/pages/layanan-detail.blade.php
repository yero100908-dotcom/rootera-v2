@extends('layouts.app')

@section('schema-markup')
<?php
$formattedPriceHome = is_numeric($category->price_home) 
    ? 'Rp ' . number_format((float) $category->price_home, 0, ',', '.') 
    : ($category->price_home ?: 'Hubungi CS');

$formattedPriceCorporate = is_numeric($category->price_corporate) 
    ? 'Rp ' . number_format((float) $category->price_corporate, 0, ',', '.') 
    : ($category->price_corporate ?: 'Hubungi CS');

$numericLowPrice = (int) preg_replace('/[^0-9]/', '', (string) ($category->price_home ?? '350000'));
if ($numericLowPrice <= 0) {
    $numericLowPrice = 350000;
}

$serviceSchema = [
  "@context" => "https://schema.org",
  "@type" => "Service",
  "name" => $category->name,
  "description" => $category->description,
  "provider" => [
    "@type" => "LocalBusiness",
    "@id" => url('/') . '#organization',
    "name" => "Rootera Plumbing"
  ],
  "areaServed" => [
    "Jabodetabek", "Lampung", "Bandung", "Yogyakarta", "Semarang", "Cirebon", "Solo"
  ],
  "offers" => [
    "@type" => "AggregateOffer",
    "priceCurrency" => "IDR",
    "lowPrice" => $numericLowPrice,
    "priceRange" => "$$",
    "description" => $category->price_description
  ]
];

$faqSchema = [
  "@context" => "https://schema.org",
  "@type" => "FAQPage",
  "mainEntity" => [
    [
      "@type" => "Question",
      "name" => "Berapa lama proses pengerjaan pelancar pipa mampet Rootera?",
      "acceptedAnswer" => [
        "@type" => "Answer",
        "text" => "Estimasi waktu pengerjaan pelancar pipa mampet berkisar antara 1 hingga 2 jam saja, tergantung tingkat kesulitan dan panjang saluran pipa. Berkat metode mekanis modern, masalah selesai dengan cepat tanpa harus membongkar struktur bangunan."
      ]
    ],
    [
      "@type" => "Question",
      "name" => "Apakah metode pembersihan Rootera aman untuk pipa paralon PVC?",
      "acceptedAnswer" => [
        "@type" => "Answer",
        "text" => "Sangat aman. Kami menggunakan teknologi spiral mekanis (rotary cable) dan hydro-jetting bertekanan air tinggi 100% bebas dari bahan kimia asam korosif. Metode ramah lingkungan ini menjaga integritas pipa paralon PVC Anda agar tidak bocor atau pecah."
      ]
    ],
    [
      "@type" => "Question",
      "name" => "Berapa biaya jasa pelancar pipa mampet tanpa bongkar di Rootera?",
      "acceptedAnswer" => [
        "@type" => "Answer",
        "text" => "Biaya jasa pelancar pipa berkisar mulai dari " . $formattedPriceHome . " untuk kategori residensial/hunian rumah tangga, dan " . $formattedPriceCorporate . " untuk kategori industri/korporat. Harga sangat transparan tanpa biaya tambahan tersembunyi."
      ]
    ]
  ]
];
?>
<script type="application/ld+json">
{!! json_encode($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
<script type="application/ld+json">
{!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
{{-- 1. HERO HEADER SECTION (Mobile-First with Safe Spacing & Ambient Glow) --}}
<div class="relative bg-gradient-to-b from-slate-900 via-[#070F1E] to-slate-900 text-white pt-20 pb-12 sm:pt-28 sm:pb-16 overflow-hidden border-b border-slate-800" aria-labelledby="page-title">
    {{-- Ambient Glow Orbs --}}
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[280px] sm:w-[500px] h-[180px] sm:h-[300px] bg-emerald-500/15 blur-[70px] sm:blur-[110px] rounded-full pointer-events-none"></div>
    <div class="absolute bottom-0 right-5 w-[200px] sm:w-[350px] h-[120px] sm:h-[200px] bg-cyan-500/10 blur-[60px] sm:blur-[90px] rounded-full pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        {{-- Breadcrumb Navigation --}}
        <nav class="flex justify-center items-center gap-2 text-xs sm:text-sm text-slate-300 mb-4 sm:mb-6 font-medium overflow-x-auto whitespace-nowrap" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <span class="text-slate-600">/</span>
            <a href="{{ route('layanan') }}" class="hover:text-emerald-400 transition-colors">Layanan</a>
            <span class="text-slate-600">/</span>
            <span class="text-emerald-400 font-semibold truncate max-w-[200px] sm:max-w-none">{{ $category->name }}</span>
        </nav>

        {{-- Badge Pill --}}
        <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs sm:text-sm font-bold tracking-wide mb-4 backdrop-blur-md shadow-xs">
            <span class="animate-pulse">🚰</span>
            <span>SOLUSI TUNTAS TANPA BONGKAR</span>
            <span class="text-emerald-500/50 hidden sm:inline">•</span>
            <span class="text-slate-300 hidden sm:inline">GARANSI 30 HARI</span>
        </div>

        {{-- Main Headline --}}
        <h1 id="page-title" class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight sm:leading-tight max-w-4xl mx-auto font-['Plus_Jakarta_Sans',sans-serif]">
            Jasa {{ $category->name }} <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">Profesional & Bergaransi</span>
        </h1>

        {{-- Subheadline --}}
        <p class="mt-3 sm:mt-4 text-xs sm:text-base text-slate-300 max-w-2xl mx-auto leading-relaxed font-normal px-2">
            Solusi cerdas melancarkan saluran mampet menggunakan alat mekanis non-destruktif tanpa merusak keramik atau struktur bangunan.
        </p>

        {{-- Trust Indicators Bar --}}
        <div class="mt-6 sm:mt-8 pt-5 sm:pt-6 border-t border-slate-800/80 max-w-3xl mx-auto grid grid-cols-2 sm:grid-cols-4 gap-2.5 sm:gap-4 text-center">
            <div class="p-2.5 sm:p-3 bg-slate-900/60 rounded-xl border border-slate-800/60">
                <span class="block text-emerald-400 font-extrabold text-sm sm:text-xl">100%</span>
                <span class="text-[10px] sm:text-xs text-slate-400 font-medium">Tanpa Bongkar Keramik</span>
            </div>
            <div class="p-2.5 sm:p-3 bg-slate-900/60 rounded-xl border border-slate-800/60">
                <span class="block text-cyan-400 font-extrabold text-sm sm:text-xl">30 Hari</span>
                <span class="text-[10px] sm:text-xs text-slate-400 font-medium">Garansi Resmi Written</span>
            </div>
            <div class="p-2.5 sm:p-3 bg-slate-900/60 rounded-xl border border-slate-800/60">
                <span class="block text-teal-400 font-extrabold text-sm sm:text-xl">1 - 2 Jam</span>
                <span class="text-[10px] sm:text-xs text-slate-400 font-medium">Proses Kerja Tuntas</span>
            </div>
            <div class="p-2.5 sm:p-3 bg-slate-900/60 rounded-xl border border-slate-800/60">
                <span class="block text-emerald-400 font-extrabold text-sm sm:text-xl">24 Jam</span>
                <span class="text-[10px] sm:text-xs text-slate-400 font-medium">Panggilan Darurat</span>
            </div>
        </div>
    </div>
</div>

{{-- 2. MAIN DETAIL CONTENT SECTION --}}
<section class="py-10 sm:py-16 bg-white overflow-hidden" aria-labelledby="detail-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto space-y-8 sm:space-y-12">
            
            {{-- Direct Answer (GEO & AI Overview Optimization) --}}
            <div class="bg-emerald-50/80 border-l-4 border-emerald-500 p-4 sm:p-6 rounded-r-2xl shadow-xs">
                <p class="text-xs sm:text-base text-slate-900 leading-relaxed font-medium">
                    <strong class="text-emerald-800 font-bold">Direct Answer:</strong> Jasa {{ $category->name }} dari Rootera menawarkan solusi pembersihan pipa mampet tanpa bongkar menggunakan teknologi spiral cable mekanis dan hydro-jetting ramah lingkungan (100% bebas asam kimia korosif) yang dijamin membersihkan lemak serta kerak pipa hingga 98% bersih total bergaransi di Jabodetabek, Bandung, Semarang, Yogyakarta, Lampung, Cirebon, dan Solo.
                </p>
            </div>

            {{-- 3. MENGAPA MEMILIH ROOTERA (4 Value Pillars) --}}
            <div>
                <h2 id="detail-heading" class="text-xl sm:text-3xl font-extrabold text-slate-900 tracking-tight font-['Plus_Jakarta_Sans',sans-serif] mb-3 sm:mb-4">
                    Solusi Pembersihan Saluran Air & Pipa Mampet yang Efektif
                </h2>
                <p class="text-xs sm:text-base text-slate-600 leading-relaxed mb-6 sm:mb-8">
                    Pipa air kotor dan saluran pembuangan yang tersumbat lemak sisa makanan, rambut, atau kotoran keras lainnya merupakan masalah pelik yang harus segera ditangani secara higienis. Rootera mengedepankan filosofi <strong class="text-slate-800">Eco-Friendly Plumbing</strong> — membuang sumbatan secara mekanis tanpa menyiramkan cairan asam berbahaya yang berisiko membuat sambungan pipa PVC Anda meleyot, bocor, atau hancur di dalam semen lantai.
                </p>

                <h3 class="text-lg sm:text-2xl font-bold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mb-4">
                    Mengapa Memilih Layanan {{ $category->name }} di Rootera?
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-slate-50/90 p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-lg mb-3 shrink-0">✓</div>
                        <h4 class="font-bold text-sm sm:text-base text-slate-900 mb-1">Metode Tanpa Bongkar</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">100% aman untuk keramik, semen, dan dinding rumah. Pipa bersih tanpa pekerjaan sipil.</p>
                    </div>

                    <div class="bg-slate-50/90 p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col">
                        <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-lg mb-3 shrink-0">⚙️</div>
                        <h4 class="font-bold text-sm sm:text-base text-slate-900 mb-1">Peralatan Modern</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">Menggunakan mesin rotasi fleksibel Ridgid dan kamera inspeksi CCTV presisi tinggi.</p>
                    </div>

                    <div class="bg-slate-50/90 p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col">
                        <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-lg mb-3 shrink-0">🛡️</div>
                        <h4 class="font-bold text-sm sm:text-base text-slate-900 mb-1">Garansi Layanan Nyata</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">Jaminan garansi tertulis. Jika mampet kembali dalam masa garansi, pengerjaan ulang gratis.</p>
                    </div>

                    <div class="bg-slate-50/90 p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col">
                        <div class="w-10 h-10 rounded-xl bg-cyan-100 text-cyan-700 flex items-center justify-center font-bold text-lg mb-3 shrink-0">⏱️</div>
                        <h4 class="font-bold text-sm sm:text-base text-slate-900 mb-1">Estimasi Cepat 1-2 Jam</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">Proses pembersihan rata-rata diselesaikan hanya dalam waktu 1 hingga 2 jam di lokasi.</p>
                    </div>
                </div>
            </div>

            {{-- 4. SUB-LAYANAN CARDS --}}
            <div class="bg-slate-50/90 border border-slate-200/80 rounded-3xl p-5 sm:p-8">
                <div class="flex items-center justify-between mb-4 sm:mb-6">
                    <div>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-600 block mb-1">Daftar Sub-Layanan</span>
                        <h3 class="text-lg sm:text-2xl font-bold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif]">
                            Sub-Layanan {{ $category->name }}
                        </h3>
                    </div>
                    <span class="text-xs bg-emerald-100 text-emerald-800 font-bold px-3 py-1 rounded-full hidden sm:inline-block">Penanganan Spesialis</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3.5 sm:gap-4">
                    @forelse($category->services as $service)
                    <div class="bg-white border border-slate-200/80 rounded-2xl p-4 sm:p-5 shadow-2xs hover:shadow-md transition-all flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs font-bold">🛠️</span>
                                <span class="text-[10px] font-bold bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full">Non-Bongkar</span>
                            </div>
                            <h4 class="text-sm sm:text-base font-bold text-slate-900 mb-1.5 line-clamp-1">{{ $service->name }}</h4>
                            <p class="text-xs text-slate-600 leading-relaxed line-clamp-3">{{ $service->short_description }}</p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center gap-1.5 text-xs text-emerald-700 font-semibold">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            <span>Garansi Tuntas 30 Hari</span>
                        </div>
                    </div>
                    @empty
                    <div class="bg-white border border-slate-200/80 rounded-2xl p-5 text-center text-xs sm:text-sm text-slate-500 col-span-full">
                        Seluruh variasi penanganan {{ $category->name }} dikerjakan langsung oleh teknisi bersertifikat Rootera (J&J Group).
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- 5. TABEL TARIF & PERBANDINGAN LAYANAN --}}
            <div>
                <div class="mb-4">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-600 block mb-1">Skema Transparan</span>
                    <h3 class="text-lg sm:text-2xl font-bold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif]">
                        Daftar Tarif & Perbandingan Layanan {{ $category->name }}
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 mt-1">Berikut adalah skema harga transparan layanan kami untuk hunian residensial dan corporate:</p>
                </div>

                {{-- Responsive Desktop Table / Mobile Cards --}}
                <div class="hidden sm:block overflow-hidden border border-slate-200/90 rounded-2xl shadow-xs">
                    <table class="w-full text-left text-xs sm:text-sm border-collapse">
                        <thead>
                            <tr class="bg-slate-900 text-white">
                                <th class="py-3.5 px-5 font-bold">Fitur & Spesifikasi</th>
                                <th class="py-3.5 px-5 font-bold">Kategori Hunian Rumah</th>
                                <th class="py-3.5 px-5 font-bold">Kategori Industri / Corporate</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            <tr>
                                <td class="py-3.5 px-5 font-bold text-slate-900">Tarif Mulai Dari</td>
                                <td class="py-3.5 px-5 font-extrabold text-emerald-600">{{ $formattedPriceHome }}</td>
                                <td class="py-3.5 px-5 font-extrabold text-blue-600">{{ $formattedPriceCorporate }}</td>
                            </tr>
                            <tr class="bg-slate-50/70">
                                <td class="py-3.5 px-5 font-bold text-slate-900">Metode Kerja</td>
                                <td class="py-3.5 px-5 text-slate-600">Rotary Cable / Spiral Cleaner</td>
                                <td class="py-3.5 px-5 text-slate-600">Rotary Cable & High-Pressure Hydro-Jetting</td>
                            </tr>
                            <tr>
                                <td class="py-3.5 px-5 font-bold text-slate-900">Garansi Pekerjaan</td>
                                <td class="py-3.5 px-5 text-slate-600">Garansi Standar (Berlaku)</td>
                                <td class="py-3.5 px-5 text-slate-600">Garansi Ekstra & Kontrak Maintenance</td>
                            </tr>
                            <tr class="bg-slate-50/70">
                                <td class="py-3.5 px-5 font-bold text-slate-900">Tingkat Keberhasilan</td>
                                <td class="py-3.5 px-5 font-bold text-emerald-600">Hingga 98%</td>
                                <td class="py-3.5 px-5 font-bold text-emerald-600">Hingga 98%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Mobile Stacked Cards View (Clean Layout for Viewport 375px) --}}
                <div class="sm:hidden space-y-3">
                    {{-- Card Residensial --}}
                    <div class="bg-white border-2 border-emerald-500/40 rounded-2xl p-4 shadow-2xs space-y-2">
                        <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                            <span class="text-xs font-bold text-slate-900">Kategori Hunian Rumah</span>
                            <span class="text-xs font-extrabold text-emerald-600">{{ $formattedPriceHome }}</span>
                        </div>
                        <div class="text-xs text-slate-600 space-y-1 pt-1">
                            <div class="flex justify-between"><span>Metode:</span> <strong class="text-slate-800">Rotary Cable Spiral</strong></div>
                            <div class="flex justify-between"><span>Garansi:</span> <strong class="text-slate-800">30 Hari Resmi</strong></div>
                            <div class="flex justify-between"><span>Tingkat Sukses:</span> <strong class="text-emerald-600">Hingga 98%</strong></div>
                        </div>
                    </div>

                    {{-- Card Corporate --}}
                    <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-2xs space-y-2">
                        <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                            <span class="text-xs font-bold text-slate-900">Kategori Industri / Corporate</span>
                            <span class="text-xs font-extrabold text-blue-600">{{ $formattedPriceCorporate }}</span>
                        </div>
                        <div class="text-xs text-slate-600 space-y-1 pt-1">
                            <div class="flex justify-between"><span>Metode:</span> <strong class="text-slate-800">Rotary + Hydro Jetting</strong></div>
                            <div class="flex justify-between"><span>Garansi:</span> <strong class="text-slate-800">Garansi Ekstra SLA</strong></div>
                            <div class="flex justify-between"><span>Tingkat Sukses:</span> <strong class="text-emerald-600">Hingga 98%</strong></div>
                        </div>
                    </div>
                </div>

                <p class="text-[11px] sm:text-xs text-slate-400 italic mt-2.5">*{{ $category->price_description }}</p>
            </div>

            {{-- 6. REAL DOKUMENTASI PEKERJAAN --}}
            @php
                $catSlug = strtolower($category->slug ?? '');
                $docItems = [];
                
                if (str_contains($catSlug, 'bio') || str_contains($catSlug, 'septic') || str_contains($catSlug, 'tank')) {
                    $docItems = [
                        ['title' => 'Pelancaran Saluran Bio Tank Bogor', 'img' => 'pelancaran-saluran-bio-tank-bogor-jabar.webp', 'desc' => 'Pembersihan penumpukan kerak dan sumbatan pipa outlet pembuangan bio tank di Bogor.'],
                        ['title' => 'Pelancaran Bak Kontrol Perumahan', 'img' => 'pelancar-bak-kontrol-perumahan-warga.webp', 'desc' => 'Pengurasan endapan lumpur dan pasir yang menyumbat saluran pembuangan utama bio tank.'],
                        ['title' => 'Pembersihan Grease Trap & Drainase', 'img' => 'pembersihan-grease-trap-restoran.webp', 'desc' => 'Penyedotan dan pengikatan sedimen padat pada sistem tangki peresapan.']
                    ];
                } elseif (str_contains($catSlug, 'wc') || str_contains($catSlug, 'kloset') || str_contains($catSlug, 'toilet')) {
                    $docItems = [
                        ['title' => 'Pelancaran Kloset Pabrik Industri', 'img' => 'pelancaran-kloset-mampet-pabrik-industri.webp', 'desc' => 'Penanganan kloset toilet karyawan pabrik mampet total tanpa bongkar dengan mesin Ridgid.'],
                        ['title' => 'Pelancaran Saluran Kloset Spiral Baja', 'img' => 'pelancar-saluran-kloset-toilet-mampet.webp', 'desc' => 'Teknisi menggunakan spiral baja fleksibel pendorong sumbatan leher angsa kloset.'],
                        ['title' => 'Inspeksi CCTV Dalam Kloset', 'img' => 'inspeksi-cctv-saluran-kloset-mampet.webp', 'desc' => 'Deteksi benda asing atau gumpalan keras di dalam pipa kloset dengan kamera CCTV.']
                    ];
                } elseif (str_contains($catSlug, 'kamar-mandi') || str_contains($catSlug, 'floor-drain')) {
                    $docItems = [
                        ['title' => 'Floor Drain Resto EM Gelato Blok M', 'img' => 'pelancaran-floor-drain-em-gelato-blok-m.webp', 'desc' => 'Penanganan rontokan rambut & endapan sabun pada floor drain area kuliner Blok M.'],
                        ['title' => 'Inspeksi CCTV Floor Drain Pertamina Sunter', 'img' => 'inspeksi-cctv-floor-drain-pertamina-sunter.webp', 'desc' => 'Pemeriksaan internal pipa floor drain kantor Pertamina Sunter Jakarta Utara.'],
                        ['title' => 'Pelancaran Floor Drain Rumah Tinggal', 'img' => 'pelancar-floor-drain-kamar-mandi-rumah.webp', 'desc' => 'Pembersihan pipa 2 inchi kamar mandi perumahan warga secara aman dan cepat.']
                    ];
                } elseif (str_contains($catSlug, 'wastafel') || str_contains($catSlug, 'dapur') || str_contains($catSlug, 'cuci-piring')) {
                    $docItems = [
                        ['title' => 'Pelancaran Wastafel Mampet Rumah Warga', 'img' => 'pelancaran-wastafel-mampet-rumah-warga.webp', 'desc' => 'Pembersihan pipa afur wastafel cuci piring rumah tangga yang tersumbat minyak makanan.'],
                        ['title' => 'Drainase Kitchen Soichiro Steakhouse', 'img' => 'pelancaran-drainase-kitchen-soichiro-steakhouse-jakarta.webp', 'desc' => 'Pengikatan lemak beku pada drainase kitchen resto Soichiro Steakhouse Jakarta.'],
                        ['title' => 'Teknisi APD Penanganan Sink Pabrik Makanan', 'img' => 'teknisi-apd-lengkap-sink-pabrik-makanan.webp', 'desc' => 'Standar steril APD K3 penanganan sink mampet fasilitas industri makanan ternama.']
                    ];
                } elseif (str_contains($catSlug, 'cctv') || str_contains($catSlug, 'deteksi') || str_contains($catSlug, 'inspeksi')) {
                    $docItems = [
                        ['title' => 'Kondisi Pipa Resto Mall Tersumbat Lemak', 'img' => 'kondisi-pipa-lemak-resto-mall-tersumbat.webp', 'desc' => 'Visual internal pipa resto mall yang penuh dengan endapan lemak pekat membatu.'],
                        ['title' => 'Inspeksi CCTV Saluran Kloset', 'img' => 'inspeksi-cctv-saluran-kloset-mampet.webp', 'desc' => 'Kamera endoskopi memetakan retakan atau sumbatan pipa paralon bawah lantai.'],
                        ['title' => 'Inspeksi CCTV Floor Drain Pertamina Sunter', 'img' => 'inspeksi-cctv-floor-drain-pertamina-sunter.webp', 'desc' => 'Pemeriksaan titik bocor & sumbatan pipa saluran kantor Pertamina Sunter.']
                    ];
                } elseif (str_contains($catSlug, 'talang') || str_contains($catSlug, 'gutter')) {
                    $docItems = [
                        ['title' => 'Before Pembersihan Talang Gutter', 'img' => 'before-pembersihan-talang-gutter.webp', 'desc' => 'Kondisi fisik talang air sebelum pembersihan total dari penumpukan lumpur hitam.'],
                        ['title' => 'After Pembersihan Gutter Restoran Clean', 'img' => 'after-pembersihan-talang-gutter-rootera.webp', 'desc' => 'Hasil akhir talang air gutter bersih total bebas genangan air setelah diservis.'],
                        ['title' => 'Pembersihan Talang Gutter Seporsi Mie Kari', 'img' => 'pelancaran-gutter-seporsi-mie-kari-jakarta.webp', 'desc' => 'Pembersihan serasah daun & minyak yang menyumbat talang gutter resto Mie Kari.']
                    ];
                } else {
                    $docItems = [
                        ['title' => 'Pembersihan Lemak Bak Kontrol Resto', 'img' => 'pembersihan-lemak-bak-kontrol-resto.webp', 'desc' => 'Pengangkatan gumpalan lemak padat dari saluran bak kontrol pembuangan resto.'],
                        ['title' => 'Pembersihan Grease Trap Restoran', 'img' => 'pembersihan-grease-trap-restoran.webp', 'desc' => 'Pembersihan box jebakan lemak resto agar operasional tetap higienis.'],
                        ['title' => 'Pelancaran Bak Kontrol Perumahan Warga', 'img' => 'pelancar-bak-kontrol-perumahan-warga.webp', 'desc' => 'Pembersihan sisa lumpur & sampah pada bak kontrol drainase pembuangan perumahan.']
                    ];
                }
            @endphp

            <div class="bg-slate-50/90 border border-slate-200/80 rounded-3xl p-5 sm:p-8">
                <div class="mb-4 sm:mb-6">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-600 block mb-1">Aksi Lapangan</span>
                    <h3 class="text-lg sm:text-2xl font-bold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif]">
                        📷 Dokumentasi Pekerjaan Real Layanan {{ $category->name }}
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 mt-1">Bukti aksi teknisi di lapangan menggunakan mesin modern &amp; kamera CCTV:</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($docItems as $doc)
                    <div class="bg-white border border-slate-200/80 rounded-2xl overflow-hidden shadow-2xs hover:shadow-md transition-all flex flex-col justify-between">
                        <div class="relative h-40 bg-slate-100 border-b border-slate-200/60 overflow-hidden">
                            <img src="{{ asset('images/dokumentasi/' . $doc['img']) }}" alt="{{ $doc['title'] }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('images/JnJ.jpeg') }}';">
                            <span class="absolute bottom-2 left-2 bg-slate-900/80 backdrop-blur-xs text-white text-[10px] font-bold px-2 py-0.5 rounded-md border border-white/20">
                                ✓ Real Documentation
                            </span>
                        </div>
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <h4 class="text-sm font-extrabold text-slate-900 mb-1 leading-snug">{{ $doc['title'] }}</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">{{ $doc['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- 7. SMART INTERLINKING: LOCAL AREA HUB --}}
            @if(isset($cities) && $cities->isNotEmpty())
            <div class="bg-slate-50/90 border border-slate-200/80 rounded-3xl p-5 sm:p-8">
                <div class="mb-4">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-600 block mb-1">Cakupan Layanan</span>
                    <h3 class="text-lg sm:text-2xl font-bold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif]">
                        📍 Panggil Teknisi Jasa {{ $category->name }} Terdekat di Kota Anda
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 mt-1">Layanan panggilan darurat 24 jam standby terdekat di kota-kota operasional berikut:</p>
                </div>

                <div class="flex flex-wrap gap-2 pt-1">
                    @foreach($cities as $c)
                        <a href="{{ url('/layanan-pipa-mampet/' . $category->slug . '/' . $c->slug) }}" class="bg-white border border-slate-200/90 hover:border-emerald-500 hover:text-emerald-700 text-slate-700 px-3.5 py-1.5 rounded-full text-xs font-semibold shadow-2xs transition-all flex items-center gap-1.5">
                            <span class="text-emerald-600">📍</span> {{ $category->name }} {{ $c->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- 8. SMART INTERLINKING: CROSS-SERVICE LINKS --}}
            @if(isset($allCategories) && $allCategories->isNotEmpty())
            <div class="bg-white border border-slate-200/80 rounded-3xl p-5 sm:p-8 shadow-xs">
                <div class="mb-4">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-600 block mb-1">Layanan Terkait</span>
                    <h3 class="text-lg sm:text-2xl font-bold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif]">
                        🔧 Layanan Pipa & Sanitasi Terkait Lainnya
                    </h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    @foreach($allCategories as $otherCat)
                        <a href="{{ route('layanan.show', $otherCat->slug) }}" class="bg-slate-50 hover:bg-emerald-50/60 border border-slate-200/80 hover:border-emerald-300 rounded-xl p-3.5 transition-all text-xs sm:text-sm font-bold text-slate-800 hover:text-emerald-700 flex items-center justify-between group">
                            <span class="flex items-center gap-2 truncate">
                                <span>🛠️</span> <span class="truncate">{{ $otherCat->name }}</span>
                            </span>
                            <span class="text-emerald-600 group-hover:translate-x-1 transition-transform shrink-0">&rarr;</span>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- 9. SMART INTERLINKING: TECHNICAL ARTICLES --}}
            @if(isset($relatedArticles) && $relatedArticles->isNotEmpty())
            <div class="bg-slate-50/90 border border-slate-200/80 rounded-3xl p-5 sm:p-8">
                <div class="mb-4">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-600 block mb-1">Panduan & Educations</span>
                    <h3 class="text-lg sm:text-2xl font-bold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif]">
                        📰 Pusat Edukasi & Artikel Perawatan Pipa
                    </h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($relatedArticles as $art)
                        <div class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-2xs hover:shadow-md transition-all flex flex-col justify-between">
                            <div>
                                <h4 class="text-xs sm:text-sm font-extrabold text-slate-900 mb-1.5 line-clamp-2 hover:text-emerald-600 transition-colors">
                                    <a href="{{ route('blog.show', $art->slug) }}">{{ $art->title }}</a>
                                </h4>
                                <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed mb-3">{{ Str::limit($art->excerpt, 90) }}</p>
                            </div>
                            <a href="{{ route('blog.show', $art->slug) }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 inline-flex items-center gap-1">
                                Baca Artikel &rarr;
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- 10. FAQ ACCORDION SECTION --}}
            <div class="pt-4 border-t border-slate-200">
                <div class="text-center mb-6 sm:mb-8">
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-600">Jawaban Pertanyaan</span>
                    <h3 class="text-lg sm:text-2xl font-extrabold text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] mt-1">
                        Pertanyaan Umum (FAQ) Layanan
                    </h3>
                </div>

                <div class="space-y-3 max-w-3xl mx-auto" x-data="{ activeFaq: 1 }">
                    {{-- FAQ Item 1 --}}
                    <div class="bg-slate-50 border border-slate-200/80 rounded-2xl overflow-hidden shadow-2xs">
                        <button type="button" @click="activeFaq = (activeFaq === 1 ? null : 1)" class="w-full p-4 sm:p-5 text-left font-bold text-slate-900 text-xs sm:text-sm flex justify-between items-center gap-3 hover:bg-slate-100 transition-colors min-h-[48px]">
                            <span class="flex items-center gap-2"><span>❓</span> Berapa lama proses pengerjaan pelancar pipa mampet Rootera?</span>
                            <span class="text-emerald-600 font-bold text-base shrink-0" x-text="activeFaq === 1 ? '−' : '+'">−</span>
                        </button>
                        <div x-show="activeFaq === 1" x-collapse class="px-4 pb-4 sm:px-5 sm:pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-200/60 pt-3">
                            Estimasi waktu pengerjaan pelancar pipa mampet berkisar antara 1 hingga 2 jam saja, tergantung tingkat kesulitan dan panjang saluran pipa. Berkat metode mekanis modern, masalah selesai dengan cepat tanpa harus membongkar struktur bangunan.
                        </div>
                    </div>

                    {{-- FAQ Item 2 --}}
                    <div class="bg-slate-50 border border-slate-200/80 rounded-2xl overflow-hidden shadow-2xs">
                        <button type="button" @click="activeFaq = (activeFaq === 2 ? null : 2)" class="w-full p-4 sm:p-5 text-left font-bold text-slate-900 text-xs sm:text-sm flex justify-between items-center gap-3 hover:bg-slate-100 transition-colors min-h-[48px]">
                            <span class="flex items-center gap-2"><span>❓</span> Apakah metode pembersihan Rootera aman untuk pipa paralon PVC?</span>
                            <span class="text-emerald-600 font-bold text-base shrink-0" x-text="activeFaq === 2 ? '−' : '+'">+</span>
                        </button>
                        <div x-show="activeFaq === 2" x-collapse class="px-4 pb-4 sm:px-5 sm:pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-200/60 pt-3">
                            Sangat aman. Kami menggunakan teknologi spiral mekanis (rotary cable) dan hydro-jetting bertekanan air tinggi 100% bebas dari bahan kimia asam korosif. Metode ramah lingkungan ini menjaga integritas pipa paralon PVC Anda agar tidak bocor atau pecah.
                        </div>
                    </div>

                    {{-- FAQ Item 3 --}}
                    <div class="bg-slate-50 border border-slate-200/80 rounded-2xl overflow-hidden shadow-2xs">
                        <button type="button" @click="activeFaq = (activeFaq === 3 ? null : 3)" class="w-full p-4 sm:p-5 text-left font-bold text-slate-900 text-xs sm:text-sm flex justify-between items-center gap-3 hover:bg-slate-100 transition-colors min-h-[48px]">
                            <span class="flex items-center gap-2"><span>❓</span> Berapa biaya jasa pelancar pipa mampet tanpa bongkar di Rootera?</span>
                            <span class="text-emerald-600 font-bold text-base shrink-0" x-text="activeFaq === 3 ? '−' : '+'">+</span>
                        </button>
                        <div x-show="activeFaq === 3" x-collapse class="px-4 pb-4 sm:px-5 sm:pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-200/60 pt-3">
                            Biaya jasa pelancar pipa berkisar mulai dari {{ $formattedPriceHome }} untuk kategori residensial/hunian rumah tangga, dan {{ $formattedPriceCorporate }} untuk kategori industri/korporat. Harga sangat transparan tanpa biaya tambahan tersembunyi.
                        </div>
                    </div>
                </div>
            </div>

            {{-- 11. HIGH-CONVERSION CTA BANNER --}}
            <div class="bg-gradient-to-br from-[#0A2E78] via-[#0d3a94] to-[#169F81] rounded-3xl p-6 sm:p-10 text-center text-white relative overflow-hidden shadow-xl mt-8">
                <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(#ffffff 1.5px, transparent 1.5px); background-size: 28px 28px;"></div>
                
                <div class="relative z-10 max-w-2xl mx-auto">
                    <span class="inline-block px-3 py-1 rounded-full bg-white/15 text-white text-[11px] font-bold uppercase tracking-wider mb-3 backdrop-blur-md">
                        ⚡ PENANGANAN DARURAT 24 JAM
                    </span>
                    <h3 class="text-xl sm:text-3xl font-extrabold text-white mb-2 sm:mb-3 font-['Plus_Jakarta_Sans',sans-serif] leading-tight">
                        Atasi Saluran Mampet Sekarang Juga!
                    </h3>
                    <p class="text-xs sm:text-base text-slate-100 max-w-xl mx-auto mb-6 leading-relaxed">
                        Konsultasikan secara gratis masalah pipa Anda dan dapatkan jadwal penanganan dari tim teknisi bersertifikat kami.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-3 w-full sm:w-auto">
                        <a href="https://wa.me/6281385404000?text=Halo%20Rootera%2C%20saya%20butuh%20layanan%20jasa%20{{ urlencode($category->name) }}." target="_blank" rel="noopener" class="w-full sm:w-auto min-h-[48px] bg-[#25D366] hover:bg-[#1EBE5A] active:bg-[#19a34d] text-white font-bold text-sm py-3.5 px-6 rounded-full flex items-center justify-center gap-2 shadow-lg shadow-emerald-900/40 transition-all hover:-translate-y-0.5">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            <span>Hubungi via WhatsApp</span>
                        </a>
                        <a href="{{ route('kontak') }}" class="w-full sm:w-auto min-h-[48px] bg-white/10 hover:bg-white/20 active:bg-white/30 text-white font-bold text-sm py-3.5 px-6 rounded-full border border-white/30 backdrop-blur-xs flex items-center justify-center gap-2 transition-all">
                            <span>Hubungi Kontak Kami</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
