@extends('layouts.app')

@section('schema-markup')
<?php
$formattedPriceHome = is_numeric($category->price_home) 
    ? 'Rp ' . number_format((float) $category->price_home, 0, ',', '.') 
    : ($category->price_home ?: 'Hubungi CS');

$formattedPriceCorporate = is_numeric($category->price_corporate) 
    ? 'Rp ' . number_format((float) $category->price_corporate, 0, ',', '.') 
    : ($category->price_corporate ?: 'Hubungi CS');

$serviceSchema = [
  "@context" => "https://schema.org",
  "@type" => "Service",
  "name" => $category->name,
  "description" => $category->description,
  "provider" => [
    "@type" => "Plumber",
    "name" => "Rootera",
    "telephone" => "+6281385404000",
    "url" => url('/'),
    "logo" => asset('images/brand/logo-hijau-rooteraplumbing-jasa-saluran-pipa-mampet.png'),
    "image" => asset('images/JnJ.jpeg')
  ],
  "areaServed" => [
    "Jabodetabek", "Lampung", "Bandung", "Yogyakarta", "Semarang", "Cirebon", "Solo"
  ],
  "offers" => [
    "@type" => "AggregateOffer",
    "priceCurrency" => "IDR",
    "lowPrice" => $formattedPriceHome,
    "priceRange" => "Rp",
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
{{-- Page Header --}}
<div style="background:linear-gradient(135deg,#0A2E78,#0d3a94);padding:5rem 0 5.5rem;position:relative;overflow:hidden" aria-labelledby="page-title">
    {{-- Wave decoration --}}
    <div style="position:absolute;bottom:0;left:0;width:100%;height:100px;pointer-events:none;z-index:1" aria-hidden="true">
        <svg viewBox="0 0 1440 120" preserveAspectRatio="none" style="width:100%;height:100%;display:block">
            <path d="M0,60 C320,120 720,10 1080,100 C1260,140 1360,90 1440,60 L1440,120 L0,120 Z" fill="#ffffff"></path>
        </svg>
    </div>

    <div class="container text-center" style="position:relative;z-index:2">
        <span class="badge" style="background: rgba(255, 255, 255, 0.15); color: #fff; border: 1px solid rgba(255, 255, 255, 0.25); backdrop-filter: blur(8px); margin-bottom: 1rem; display: inline-block;">Layanan Detail</span>
        <h1 id="page-title" style="color:#fff;margin-bottom:.75rem; font-size: 2.2rem; font-weight: 800; line-height: 1.2;">
            Jasa {{ $category->name }} Profesional — Rootera
        </h1>
        <p style="color:rgba(255,255,255,.8);font-size:1.05rem;max-width:650px;margin:0 auto">Solusi cerdas melancarkan saluran mampet menggunakan alat mekanis non-destruktif tanpa merusak struktur bangunan.</p>
    </div>
</div>

{{-- Detail Content Section --}}
<section class="section py-16 bg-white" aria-labelledby="detail-heading">
    <div class="container">
        <div style="max-width: 900px; margin: 0 auto;">
            
            {{-- Direct Answer (GEO Optimization) --}}
            <div style="background: #f0fdf4; border-left: 5px solid #169F81; padding: 1.5rem; border-radius: 0 16px 16px 0; margin-bottom: 2.5rem; box-shadow: 0 4px 12px rgba(22,159,129,0.05)">
                <p style="font-size: 1.1rem; line-height: 1.6; color: #0f172a; margin: 0; font-weight: 500;">
                    <strong>Direct Answer:</strong> Jasa {{ $category->name }} dari Rootera menawarkan solusi pembersihan pipa mampet tanpa bongkar menggunakan teknologi spiral cable mekanis dan hydro-jetting ramah lingkungan (100% bebas asam kimia korosif) yang dijamin membersihkan lemak serta kerak pipa hingga 98% bersih total bergaransi di Jabodetabek, Bandung, Semarang, Yogyakarta, Lampung, Cirebon, dan Solo.
                </p>
            </div>

            <div style="display: grid; grid-template-columns: 1fr; gap: 3rem;">
                
                {{-- Penjelasan Detail --}}
                <div>
                    <h2 id="detail-heading" style="font-size: 1.75rem; font-weight: 700; color: #0A2E78; margin-bottom: 1.25rem;">
                        Solusi Pembersihan Saluran Air & Pipa Mampet yang Efektif
                    </h2>
                    <p style="font-size: 1.05rem; color: #475569; line-height: 1.75; margin-bottom: 1.5rem;">
                        Pipa air kotor dan saluran pembuangan yang tersumbat lemak sisa makanan, rambut, atau kotoran keras lainnya merupakan masalah pelik yang harus segera ditangani secara higienis. Rootera mengedepankan filosofi <strong>Eco-Friendly Plumbing</strong> — membuang sumbatan secara mekanis tanpa menyiramkan cairan asam berbahaya yang berisiko membuat sambungan pipa PVC Anda meleyot, bocor, atau hancur di dalam semen lantai.
                    </p>

                    <h3 style="font-size: 1.35rem; font-weight: 600; color: #0A2E78; margin-top: 2rem; margin-bottom: 1rem;">
                        Mengapa Memilih Layanan {{ $category->name }} di Rootera?
                    </h3>
                    
                    <ul style="list-style-type: none; padding-left: 0; margin-bottom: 2rem;">
                        <li style="display: flex; gap: 0.75rem; margin-bottom: 0.75rem; align-items: flex-start; color: #475569; font-size: 1rem;">
                            <span style="color: #169F81; font-weight: bold;">✓</span> 
                            <span><strong>Metode Tanpa Bongkar:</strong> 100% aman untuk keramik, semen, dan dinding rumah Anda. Pipa bersih tanpa pengerjaan sipil tambahan.</span>
                        </li>
                        <li style="display: flex; gap: 0.75rem; margin-bottom: 0.75rem; align-items: flex-start; color: #475569; font-size: 1rem;">
                            <span style="color: #169F81; font-weight: bold;">✓</span> 
                            <span><strong>Peralatan Modern & Profesional:</strong> Menggunakan mesin pelancar pipa mekanis rotasi tinggi dan kamera inspeksi CCTV pipa untuk melihat kondisi sumbatan.</span>
                        </li>
                        <li style="display: flex; gap: 0.75rem; margin-bottom: 0.75rem; align-items: flex-start; color: #475569; font-size: 1rem;">
                            <span style="color: #169F81; font-weight: bold;">✓</span> 
                            <span><strong>Garansi Layanan Nyata:</strong> Jika saluran mampet kembali dalam masa garansi, tim teknisi kami akan datang dan mengerjakan ulang tanpa biaya tambahan sepeser pun.</span>
                        </li>
                        <li style="display: flex; gap: 0.75rem; margin-bottom: 0.75rem; align-items: flex-start; color: #475569; font-size: 1rem;">
                            <span style="color: #169F81; font-weight: bold;">✓</span> 
                            <span><strong>Estimasi Cepat:</strong> Proses pembersihan rata-rata diselesaikan hanya dalam waktu 1-2 jam saja di lokasi.</span>
                        </li>
                    </ul>
                </div>

                {{-- Sub-Layanan --}}
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 20px; padding: 2rem;">
                    <h3 style="font-size: 1.35rem; font-weight: 600; color: #0A2E78; margin-bottom: 1.25rem;">
                        Sub-Layanan {{ $category->name }}
                    </h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.25rem;">
                        @forelse($category->services as $service)
                        <div style="background: #ffffff; border: 1px solid #edf2f7; border-radius: 12px; padding: 1.25rem; box-shadow: 0 2px 6px rgba(0,0,0,0.02)">
                            <h4 style="font-size: 1.05rem; font-weight: 700; color: #1e293b; margin-bottom: 0.5rem;">{{ $service->name }}</h4>
                            <p style="font-size: 0.9rem; color: #64748b; line-height: 1.5; margin: 0;">{{ $service->short_description }}</p>
                        </div>
                        @empty
                        <div style="background: #ffffff; border: 1px solid #edf2f7; border-radius: 12px; padding: 1.25rem; text-align: center; color: #64748b;">
                            Seluruh variasi penanganan {{ $category->name }} dikerjakan langsung oleh teknisi bersertifikat Rootera (J&J Group).
                        </div>
                        @endforelse
                    </div>
                </div>

                {{-- Tabel Perbandingan Tarif Layanan (Quantitative & Structured Data) --}}
                <div>
                    <h3 style="font-size: 1.35rem; font-weight: 600; color: #0A2E78; margin-bottom: 1rem;">
                        Daftar Tarif & Perbandingan Layanan {{ $category->name }}
                    </h3>
                    <p style="font-size: 1rem; color: #64748b; margin-bottom: 1.25rem;">Berikut adalah skema harga transparan layanan kami untuk hunian residensial (rumah tinggal) dan corporate (industri, restoran, ruko):</p>
                    
                    <div style="overflow-x: auto; border: 1px solid #e2e8f0; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 1rem;">
                            <thead>
                                <tr style="background: #0A2E78; color: #ffffff;">
                                    <th style="padding: 1rem 1.5rem; font-weight: 600;">Fitur & Spesifikasi</th>
                                    <th style="padding: 1rem 1.5rem; font-weight: 600;">Kategori Hunian Rumah</th>
                                    <th style="padding: 1rem 1.5rem; font-weight: 600;">Kategori Industri / Corporate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border-bottom: 1px solid #e2e8f0;">
                                    <td style="padding: 1rem 1.5rem; font-weight: 600; color: #1e293b;">Tarif Mulai Dari</td>
                                    <td style="padding: 1rem 1.5rem; color: #169F81; font-weight: 700;">{{ $formattedPriceHome }}</td>
                                    <td style="padding: 1rem 1.5rem; color: #1E73D8; font-weight: 700;">{{ $formattedPriceCorporate }}</td>
                                </tr>
                                <tr style="border-bottom: 1px solid #e2e8f0; background: #f8fafc;">
                                    <td style="padding: 1rem 1.5rem; font-weight: 600; color: #1e293b;">Metode Kerja</td>
                                    <td style="padding: 1rem 1.5rem; color: #475569;">Rotary Cable / Spiral Cleaner</td>
                                    <td style="padding: 1rem 1.5rem; color: #475569;">Rotary Cable & High-Pressure Hydro-Jetting</td>
                                </tr>
                                <tr style="border-bottom: 1px solid #e2e8f0;">
                                    <td style="padding: 1rem 1.5rem; font-weight: 600; color: #1e293b;">Garansi Pekerjaan</td>
                                    <td style="padding: 1rem 1.5rem; color: #475569;">Garansi Standar (Berlaku)</td>
                                    <td style="padding: 1rem 1.5rem; color: #475569;">Garansi Ekstra & Kontrak Maintenance</td>
                                </tr>
                                <tr style="background: #f8fafc;">
                                    <td style="padding: 1rem 1.5rem; font-weight: 600; color: #1e293b;">Tingkat Keberhasilan</td>
                                    <td style="padding: 1rem 1.5rem; color: #169F81; font-weight: 700;">Hingga 98%</td>
                                    <td style="padding: 1rem 1.5rem; color: #169F81; font-weight: 700;">Hingga 98%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p style="font-size: 0.85rem; color: #94a3b8; margin-top: 0.75rem; font-style: italic;">*{{ $category->price_description }}</p>
                </div>

                {{-- Universal Smart Interlinking Block 1: Local Area Hub Grid --}}
                @if(isset($cities) && $cities->isNotEmpty())
                <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 20px; padding: 2rem;">
                    <h3 style="font-size: 1.35rem; font-weight: 700; color: #0A2E78; margin-bottom: 0.5rem;">
                        📍 Panggil Teknisi Jasa {{ $category->name }} Terdekat di Kota Anda
                    </h3>
                    <p style="font-size: 0.92rem; color: #64748B; margin-bottom: 1.25rem;">Layanan panggilan darurat 24 jam stanby terdekat di kota-kota operasional berikut:</p>

                    <div style="display: flex; flex-wrap: wrap; gap: 0.6rem;">
                        @foreach($cities as $c)
                            <a href="{{ url('/layanan-pipa-mampet/' . $category->slug . '/' . $c->slug) }}" style="background: #ffffff; border: 1px solid #CBD5E1; color: #0A2E78; padding: 0.45rem 1rem; border-radius: 50px; font-size: 0.88rem; font-weight: 600; text-decoration: none;">
                                📍 {{ $category->name }} {{ $c->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Universal Smart Interlinking Block 2: Cross-Service Links --}}
                @if(isset($allCategories) && $allCategories->isNotEmpty())
                <div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 20px; padding: 2rem;">
                    <h3 style="font-size: 1.35rem; font-weight: 700; color: #0A2E78; margin-bottom: 0.5rem;">
                        🔧 Layanan Pipa & Sanitasi Terkait Lainnya
                    </h3>
                    <p style="font-size: 0.92rem; color: #64748B; margin-bottom: 1.25rem;">Solusi komprehensif pelancaran saluran air untuk hunian dan tempat usaha:</p>

                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1rem;">
                        @foreach($allCategories as $otherCat)
                            <a href="{{ route('layanan.show', $otherCat->slug) }}" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 1rem; text-decoration: none; color: #0A2E78; font-weight: 700; font-size: 0.92rem; display: block;">
                                🛠️ {{ $otherCat->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Universal Smart Interlinking Block 3: Related Technical Articles --}}
                @if(isset($relatedArticles) && $relatedArticles->isNotEmpty())
                <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 20px; padding: 2rem;">
                    <h3 style="font-size: 1.35rem; font-weight: 700; color: #0A2E78; margin-bottom: 0.5rem;">
                        📰 Pusat Edukasi & Artikel Perawatan Pipa
                    </h3>
                    <p style="font-size: 0.92rem; color: #64748B; margin-bottom: 1.25rem;">Panduan teknis dan tips solusi saluran tersumbat dari tim ahli Rootera:</p>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem;">
                        @foreach($relatedArticles as $art)
                            <div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 12px; padding: 1.25rem;">
                                <h4 style="font-size: 1rem; font-weight: 700; color: #0A2E78; margin-bottom: 0.5rem;">
                                    <a href="{{ route('blog.show', $art->slug) }}" style="color: inherit; text-decoration: none;">{{ $art->title }}</a>
                                </h4>
                                <p style="font-size: 0.85rem; color: #64748B; margin-bottom: 0.75rem;">{{ Str::limit($art->excerpt, 90) }}</p>
                                <a href="{{ route('blog.show', $art->slug) }}" style="color: #169F81; font-weight: 700; font-size: 0.85rem; text-decoration: none;">Baca Selengkapnya →</a>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Service Specific Real Documentation Showcase --}}
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

                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 20px; padding: 2rem;">
                    <h3 style="font-size: 1.35rem; font-weight: 700; color: #0A2E78; margin-bottom: 0.5rem;">
                        📷 Dokumentasi Pekerjaan Real Layanan {{ $category->name }}
                    </h3>
                    <p style="font-size: 0.92rem; color: #64748B; margin-bottom: 1.25rem;">Bukti aksi teknisi di lapangan menggunakan mesin modern &amp; kamera CCTV:</p>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem;">
                        @foreach($docItems as $doc)
                        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                            <div style="position: relative; height: 160px; overflow: hidden; background: #0f172a;">
                                <img src="{{ asset('images/dokumentasi/' . $doc['img']) }}" alt="{{ $doc['title'] }}" style="width:100%; height:100%; object-fit:cover;" loading="lazy">
                                <span style="position: absolute; bottom: 0.5rem; left: 0.5rem; background: rgba(0,0,0,0.75); color: #fff; font-size: 0.7rem; font-weight: 700; padding: 0.2rem 0.5rem; border-radius: 4px; backdrop-filter: blur(4px);">
                                    ✓ Real Documentation
                                </span>
                            </div>
                            <div style="padding: 1rem;">
                                <h4 style="font-size: 0.95rem; font-weight: 800; color: #0A2E78; margin-bottom: 0.35rem;">{{ $doc['title'] }}</h4>
                                <p style="font-size: 0.82rem; color: #64748b; margin: 0; line-height: 1.4;">{{ $doc['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Universal Smart Interlinking Block 4: Project Showcase Gallery --}}
                @if(isset($projectShowcases) && $projectShowcases->isNotEmpty())
                <div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 20px; padding: 2rem;">
                    <h3 style="font-size: 1.35rem; font-weight: 700; color: #0A2E78; margin-bottom: 0.5rem;">
                        📸 Dokumentasi Pengerjaan Proyek Nyata
                    </h3>
                    <p style="font-size: 0.92rem; color: #64748B; margin-bottom: 1.25rem;">Bukti hasil pengerjaan tim teknisi profesional di lapangan:</p>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.25rem;">
                        @foreach($projectShowcases->take(3) as $proj)
                            <div style="background: #F8FAFC; border-radius: 12px; overflow: hidden; border: 1px solid #E2E8F0;">
                                <div style="height: 140px; background: #0A2E78; overflow: hidden;">
                                    <img src="{{ $proj->after_image_url }}" alt="{{ $proj->image_alt }}" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div style="padding: 1rem;">
                                    <h4 style="font-size: 0.95rem; font-weight: 700; color: #0A2E78; margin-bottom: 0.3rem;">{{ $proj->title }}</h4>
                                    <span style="font-size: 0.8rem; color: #169F81; font-weight: 600;">✓ {{ $proj->client_type }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- FAQ Section (Natural Questions) --}}
                <div style="border-top: 1px solid #e2e8f0; padding-top: 3rem;">
                    <h3 style="font-size: 1.5rem; font-weight: 700; color: #0A2E78; margin-bottom: 1.5rem; text-align: center;">
                        Pertanyaan Umum (FAQ) Layanan
                    </h3>
                    
                    <div style="display: flex; flex-direction: column; gap: 1.5rem; max-width: 800px; margin: 0 auto;">
                        <div style="background: #f8fafc; border: 1px solid #edf2f7; border-radius: 12px; padding: 1.5rem;">
                            <h4 style="font-size: 1.05rem; font-weight: 700; color: #1e293b; margin-bottom: 0.5rem; display: flex; gap: 0.5rem;">
                                <span>❓</span> Berapa lama proses pengerjaan pelancar pipa mampet Rootera?
                            </h4>
                            <p style="font-size: 0.95rem; color: #475569; line-height: 1.6; margin: 0; padding-left: 1.5rem;">
                                Estimasi waktu pengerjaan pelancar pipa mampet berkisar antara 1 hingga 2 jam saja, tergantung tingkat kesulitan dan panjang saluran pipa. Berkat metode mekanis modern, masalah selesai dengan cepat tanpa harus membongkar struktur bangunan.
                            </p>
                        </div>
                        
                        <div style="background: #f8fafc; border: 1px solid #edf2f7; border-radius: 12px; padding: 1.5rem;">
                            <h4 style="font-size: 1.05rem; font-weight: 700; color: #1e293b; margin-bottom: 0.5rem; display: flex; gap: 0.5rem;">
                                <span>❓</span> Apakah metode pembersihan Rootera aman untuk pipa paralon PVC?
                            </h4>
                            <p style="font-size: 0.95rem; color: #475569; line-height: 1.6; margin: 0; padding-left: 1.5rem;">
                                Sangat aman. Kami menggunakan teknologi spiral mekanis (rotary cable) dan hydro-jetting bertekanan air tinggi 100% bebas dari bahan kimia asam korosif. Metode ramah lingkungan ini menjaga integritas pipa paralon PVC Anda agar tidak bocor atau pecah.
                            </p>
                        </div>

                        <div style="background: #f8fafc; border: 1px solid #edf2f7; border-radius: 12px; padding: 1.5rem;">
                            <h4 style="font-size: 1.05rem; font-weight: 700; color: #1e293b; margin-bottom: 0.5rem; display: flex; gap: 0.5rem;">
                                <span>❓</span> Berapa biaya jasa pelancar pipa mampet tanpa bongkar di Rootera?
                            </h4>
                            <p style="font-size: 0.95rem; color: #475569; line-height: 1.6; margin: 0; padding-left: 1.5rem;">
                                Biaya jasa pelancar pipa berkisar mulai dari {{ $formattedPriceHome }} untuk kategori residensial/hunian rumah tangga, dan {{ $formattedPriceCorporate }} untuk kategori industri/korporat. Harga sangat transparan tanpa biaya tambahan tersembunyi.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Call To Action --}}
                <div style="background: linear-gradient(135deg, #0A2E78 0%, #169F81 100%); border-radius: 24px; padding: 3rem; text-align: center; color: #ffffff; margin-top: 2rem;">
                    <h3 style="font-size: 1.75rem; font-weight: 800; color: #ffffff; margin-bottom: 0.75rem;">Atasi Saluran Mampet Sekarang Juga!</h3>
                    <p style="color: rgba(255,255,255,0.9); font-size: 1.05rem; max-width: 600px; margin: 0 auto 2rem;">Konsultasikan secara gratis masalah pipa Anda dan dapatkan jadwal penanganan dari tim teknisi bersertifikat kami.</p>
                    <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                        <a href="https://wa.me/6281385404000?text=Halo%20Rootera%2C%20saya%20butuh%20layanan%20jasa%20{{ urlencode($category->name) }}." class="btn btn-primary" style="background:#25D366; border-color:#25D366; font-size:1rem; padding: 0.85rem 2rem; color: #ffffff; font-weight: 700; border-radius: 50px; text-decoration: none;" target="_blank" rel="noopener">
                            Hubungi via WhatsApp
                        </a>
                        <a href="{{ route('kontak') }}" class="btn btn-secondary" style="border: 2px solid #ffffff; color: #ffffff; background: transparent; font-size:1rem; padding: 0.85rem 2rem; font-weight: 700; border-radius: 50px; text-decoration: none;">
                            Hubungi Kontak Kami
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
