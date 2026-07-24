@extends('layouts.app')

@section('schema-markup')
<?php
$areaSchema = [
  "@context" => "https://schema.org",
  "@type" => ["Plumber", "HomeAndConstructionBusiness"],
  "name" => "Rooterin Jasa Pipa Mampet " . $area->name,
  "description" => "Layanan profesional pelancar saluran air mampet, kran air tersumbat, cuci toren, dan instalasi pipa di wilayah " . $area->name . " dan sekitarnya.",
  "url" => url('/area-layanan/' . $area->slug),
  "telephone" => "+6281385404000",
  "logo" => asset('images/dark mode-notag.png'),
  "image" => $area->image ? asset('storage/' . $area->image) : asset('images/JnJ.jpeg'),
  "priceRange" => "Rp",
  "address" => [
    "@type" => "PostalAddress",
    "addressLocality" => $area->name,
    "addressRegion" => $area->province,
    "addressCountry" => "ID"
  ],
  "areaServed" => [
    "@type" => "AdministrativeArea",
    "name" => $area->name
  ],
  "openingHours" => "Mo-Su 00:00-23:59"
];

$faqSchema = [
  "@context" => "https://schema.org",
  "@type" => "FAQPage",
  "mainEntity" => [
    [
      "@type" => "Question",
      "name" => "Apakah Rooterin melayani area di luar pusat kota " . $area->name . "?",
      "acceptedAnswer" => [
        "@type" => "Answer",
        "text" => "Ya. Layanan kami menjangkau seluruh kecamatan dan kelurahan di wilayah " . $area->name . ", serta area perumahan, perkantoran, ruko, restoran, dan kawasan industri di sekitarnya."
      ]
    ],
    [
      "@type" => "Question",
      "name" => "Bagaimana cara memesan jasa pelancar pipa Rooterin di " . $area->name . "?",
      "acceptedAnswer" => [
        "@type" => "Answer",
        "text" => "Anda cukup menghubungi tim support kami melalui tombol WhatsApp yang tersedia di situs ini, atau mengisi formulir kontak. Tim teknisi terdekat di area " . $area->name . " akan langsung dijadwalkan menuju ke lokasi Anda."
      ]
    ],
    [
      "@type" => "Question",
      "name" => "Apakah ada biaya transport tambahan untuk pengerjaan di " . $area->name . "?",
      "acceptedAnswer" => [
        "@type" => "Answer",
        "text" => "Biaya yang kami tawarkan sangat transparan. Untuk wilayah jangkauan operasional " . $area->name . ", tarif jasa yang tertera sudah bersifat flat/all-in tanpa biaya transport tersembunyi tambahan."
      ]
    ]
  ]
];
?>
<script type="application/ld+json">
{!! json_encode($areaSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
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
        <span class="badge" style="background: rgba(255, 255, 255, 0.15); color: #fff; border: 1px solid rgba(255, 255, 255, 0.25); backdrop-filter: blur(8px); margin-bottom: 1rem; display: inline-block;">Layanan Wilayah</span>
        <h1 id="page-title" style="color:#fff;margin-bottom:.75rem; font-size: 2.2rem; font-weight: 800; line-height: 1.2;">
            Jasa Pipa Mampet {{ $area->name }} — Rooterin
        </h1>
        <p style="color:rgba(255,255,255,.8);font-size:1.05rem;max-width:650px;margin:0 auto">Hadir melayani pembersihan saluran air tersumbat dan pemeliharaan pipa profesional di wilayah {{ $area->name }} dan sekitarnya.</p>
    </div>
</div>

{{-- Detail Content Section --}}
<section class="section py-16 bg-white" aria-labelledby="local-heading">
    <div class="container">
        <div style="max-width: 900px; margin: 0 auto;">
            
            {{-- Direct Answer (GEO Optimization) --}}
            <div style="background: #f0fdf4; border-left: 5px solid #169F81; padding: 1.5rem; border-radius: 0 16px 16px 0; margin-bottom: 2.5rem; box-shadow: 0 4px 12px rgba(22,159,129,0.05)">
                <p style="font-size: 1.1rem; line-height: 1.6; color: #0f172a; margin: 0; font-weight: 500;">
                    <strong>Direct Answer:</strong> Jasa pelancar pipa mampet Rooterin di {{ $area->name }} melayani area residensial (hunian rumah) dan industri secara cepat menggunakan teknologi rotary cable spiral dan hydro-jetting modern 100% bebas dari bahan kimia asam korosif, membersihkan kerak lemak hingga 98% bergaransi tanpa bongkar lantai keramik maupun beton pondasi bangunan Anda.
                </p>
            </div>

            <div style="display: grid; grid-template-columns: 1fr; gap: 3rem;">
                
                {{-- Penjelasan Wilayah --}}
                <div>
                    <h2 id="local-heading" style="font-size: 1.75rem; font-weight: 700; color: #0A2E78; margin-bottom: 1.25rem;">
                        Solusi Penanganan Saluran Air Tersumbat di Area {{ $area->name }}
                    </h2>
                    <p style="font-size: 1.05rem; color: #475569; line-height: 1.75; margin-bottom: 1.5rem;">
                        {{ $area->description }} Kami memahami bahwa kontur tanah, kualitas air bersih, dan beban penggunaan saluran air di kota besar seperti {{ $area->name }} dapat menyebabkan endapan lumpur, pasir, hingga lemak rumah tangga yang mengeras dengan cepat di dalam pipa drainase. Untuk itu, tim Rooterin hadir dengan layanan respons cepat 24 jam sehari demi menyelamatkan kenyamanan hunian Anda dari banjir air kotor atau wastafel meluap.
                    </p>

                    <h3 style="font-size: 1.35rem; font-weight: 600; color: #0A2E78; margin-top: 2rem; margin-bottom: 1rem;">
                        Cakupan Layanan Kami di Wilayah {{ $area->name }}
                    </h3>
                    <p style="font-size: 1rem; color: #475569; line-height: 1.6; margin-bottom: 1.5rem;">
                        Kami melayani berbagai masalah saluran air dan sanitasi secara komprehensif, meliputi:
                    </p>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
                        <div style="background: #f8fafc; border-radius: 12px; padding: 1.25rem; border: 1px solid #edf2f7;">
                            <strong style="color: #0A2E78; display: block; margin-bottom: 0.25rem;">🚿 Jasa Pelancar Saluran Mampet</strong>
                            <span style="font-size: 0.9rem; color: #64748b;">Mengatasi wastafel dapur mampet lemak, pembuangan kamar mandi tersumbat rambut, bak kontrol luap, hingga talang air hujan.</span>
                        </div>
                        <div style="background: #f8fafc; border-radius: 12px; padding: 1.25rem; border: 1px solid #edf2f7;">
                            <strong style="color: #0A2E78; display: block; margin-bottom: 0.25rem;">🚰 Perbaikan Kran & Pipa Bocor</strong>
                            <span style="font-size: 0.9rem; color: #64748b;">Memperbaiki kran air tersumbat kerak pasir/karat, mendeteksi kebocoran pipa tersembunyi, dan merapikan instalasi air bersih.</span>
                        </div>
                        <div style="background: #f8fafc; border-radius: 12px; padding: 1.25rem; border: 1px solid #edf2f7;">
                            <strong style="color: #0A2E78; display: block; margin-bottom: 0.25rem;">🧼 Cuci Toren Tangki Air</strong>
                            <span style="font-size: 0.9rem; color: #64748b;">Pembersihan lumut, endapan lumpur, dan sterilisasi tangki air untuk menghasilkan kualitas air bersih yang higienis.</span>
                        </div>
                        <div style="background: #f8fafc; border-radius: 12px; padding: 1.25rem; border: 1px solid #edf2f7;">
                            <strong style="color: #0A2E78; display: block; margin-bottom: 0.25rem;">🏢 Skala Komersial & B2B</strong>
                            <span style="font-size: 0.9rem; color: #64748b;">Penanganan pipa lemak restoran (grease trap), instalasi drainase pabrik, ruko, hotel, perkantoran, dan gedung bertingkat.</span>
                        </div>
                    </div>
                </div>

                {{-- Tabel Spesifikasi Layanan untuk Wilayah (Structured Data) --}}
                <div>
                    <h3 style="font-size: 1.35rem; font-weight: 600; color: #0A2E78; margin-bottom: 1rem;">
                        Ketentuan Layanan di {{ $area->name }}
                    </h3>
                    
                    <div style="overflow-x: auto; border: 1px solid #e2e8f0; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 1rem;">
                            <thead>
                                <tr style="background: #169F81; color: #ffffff;">
                                    <th style="padding: 1rem 1.5rem; font-weight: 600;">Aspek Operasional</th>
                                    <th style="padding: 1rem 1.5rem; font-weight: 600;">Keterangan / Komitmen Rooterin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="border-bottom: 1px solid #e2e8f0;">
                                    <td style="padding: 1rem 1.5rem; font-weight: 600; color: #1e293b;">Area Jangkauan Wilayah</td>
                                    <td style="padding: 1rem 1.5rem; color: #475569;">Seluruh Kecamatan & Kelurahan di {{ $area->name }} (Flat Rate)</td>
                                </tr>
                                <tr style="border-bottom: 1px solid #e2e8f0; background: #f8fafc;">
                                    <td style="padding: 1rem 1.5rem; font-weight: 600; color: #1e293b;">Waktu Operasional</td>
                                    <td style="padding: 1rem 1.5rem; color: #475569;">Buka 24 Jam Sehari, 7 Hari Seminggu (Siaga Darurat)</td>
                                </tr>
                                <tr style="border-bottom: 1px solid #e2e8f0;">
                                    <td style="padding: 1rem 1.5rem; font-weight: 600; color: #1e293b;">Garansi Pekerjaan</td>
                                    <td style="padding: 1rem 1.5rem; color: #169F81; font-weight: 700;">Ya, Bergaransi Resmi Tanpa Syarat Tambahan</td>
                                </tr>
                                <tr style="background: #f8fafc;">
                                    <td style="padding: 1rem 1.5rem; font-weight: 600; color: #1e293b;">Estimasi Respon Tim</td>
                                    <td style="padding: 1rem 1.5rem; color: #1e293b; font-weight: 600;">Teknisi Berangkat ke Lokasi Rata-Rata 30-60 Menit</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- FAQ Section (Natural Questions) --}}
                <div style="border-top: 1px solid #e2e8f0; padding-top: 3rem;">
                    <h3 style="font-size: 1.5rem; font-weight: 700; color: #0A2E78; margin-bottom: 1.5rem; text-align: center;">
                        Pertanyaan Umum (FAQ) Jasa Pipa Mampet {{ $area->name }}
                    </h3>
                    
                    <div style="display: flex; flex-col: column; gap: 1.5rem; max-w: 800px; margin: 0 auto;">
                        <div style="background: #f8fafc; border: 1px solid #edf2f7; border-radius: 12px; padding: 1.5rem;">
                            <h4 style="font-size: 1.05rem; font-weight: 700; color: #1e293b; margin-bottom: 0.5rem; display: flex; gap: 0.5rem;">
                                <span>❓</span> Apakah Rooterin melayani area di luar pusat kota {{ $area->name }}?
                            </h4>
                            <p style="font-size: 0.95rem; color: #475569; line-height: 1.6; margin: 0; padding-left: 1.5rem;">
                                Ya. Layanan kami menjangkau seluruh kecamatan dan kelurahan di wilayah {{ $area->name }}, serta area perumahan, perkantoran, ruko, restoran, dan kawasan industri di sekitarnya.
                            </p>
                        </div>
                        
                        <div style="background: #f8fafc; border: 1px solid #edf2f7; border-radius: 12px; padding: 1.5rem;">
                            <h4 style="font-size: 1.05rem; font-weight: 700; color: #1e293b; margin-bottom: 0.5rem; display: flex; gap: 0.5rem;">
                                <span>❓</span> Bagaimana cara memesan jasa pelancar pipa Rooterin di {{ $area->name }}?
                            </h4>
                            <p style="font-size: 0.95rem; color: #475569; line-height: 1.6; margin: 0; padding-left: 1.5rem;">
                                Anda cukup menghubungi tim support kami melalui tombol WhatsApp yang tersedia di situs ini, atau mengisi formulir kontak. Tim teknisi terdekat di area {{ $area->name }} akan langsung dijadwalkan menuju ke lokasi Anda.
                            </p>
                        </div>

                        <div style="background: #f8fafc; border: 1px solid #edf2f7; border-radius: 12px; padding: 1.5rem;">
                            <h4 style="font-size: 1.05rem; font-weight: 700; color: #1e293b; margin-bottom: 0.5rem; display: flex; gap: 0.5rem;">
                                <span>❓</span> Apakah ada biaya transport tambahan untuk pengerjaan di {{ $area->name }}?
                            </h4>
                            <p style="font-size: 0.95rem; color: #475569; line-height: 1.6; margin: 0; padding-left: 1.5rem;">
                                Biaya yang kami tawarkan sangat transparan. Untuk wilayah jangkauan operasional {{ $area->name }}, tarif jasa yang tertera sudah bersifat flat/all-in tanpa biaya transport tersembunyi tambahan.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Call To Action --}}
                <div style="background: linear-gradient(135deg, #0A2E78 0%, #169F81 100%); border-radius: 24px; padding: 3rem; text-align: center; color: #ffffff; margin-top: 2rem;">
                    <h3 style="font-size: 1.75rem; font-weight: 800; color: #ffffff; margin-bottom: 0.75rem;">Butuh Bantuan Teknisi di {{ $area->name }}?</h3>
                    <p style="color: rgba(255,255,255,0.9); font-size: 1.05rem; max-width: 600px; margin: 0 auto 2rem;">Segera hubungi tim Rooterin untuk respon cepat darurat pipa mampet di rumah, ruko, restoran, atau kantor Anda.</p>
                    <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                        <a href="https://wa.me/6281385404000?text=Halo%20Rooterin%2C%20saya%20di%20area%20{{ urlencode($area->name) }}%20butuh%20layanan%20pipa%20mampet." class="btn btn-primary" style="background:#25D366; border-color:#25D366; font-size:1rem; padding: 0.85rem 2rem; color: #ffffff; font-weight: 700; border-radius: 50px; text-decoration: none;" target="_blank" rel="noopener">
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
