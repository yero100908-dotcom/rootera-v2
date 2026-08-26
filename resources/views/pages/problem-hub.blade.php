@extends('layouts.app')

@section('schema-markup')
<?php
$serviceSchema = [
  "@context" => "https://schema.org",
  "@type" => "Service",
  "name" => $problemInfo['name'],
  "description" => $problemInfo['description'],
  "provider" => [
    "@type" => "Plumber",
    "name" => "Rootera Plumbing",
    "parentOrganization" => [
      "@type" => "Organization",
      "name" => "J&J GROUP"
    ],
    "telephone" => "+6281385404000",
    "url" => url('/'),
    "logo" => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp')
  ],
  "areaServed" => $city ? $city->name : "Jabodetabek & Indonesia",
  "offers" => [
    "@type" => "Offer",
    "priceCurrency" => "IDR",
    "price" => $problemInfo['price_home'],
    "description" => "Garansi tuntas 100% tanpa bongkar lantai"
  ]
];
?>
<script type="application/ld+json">
{!! json_encode($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
{{-- Hero Section --}}
<div style="background:linear-gradient(135deg,#0A2E78,#0d3a94);padding:5rem 0 5.5rem;position:relative;overflow:hidden" aria-labelledby="page-title">
    <div style="position:absolute;bottom:0;left:0;width:100%;height:100px;pointer-events:none;z-index:1" aria-hidden="true">
        <svg viewBox="0 0 1440 120" preserveAspectRatio="none" style="width:100%;height:100%;display:block">
            <path d="M0,60 C320,120 720,10 1080,100 C1260,140 1360,90 1440,60 L1440,120 L0,120 Z" fill="#ffffff"></path>
        </svg>
    </div>

    <div class="container text-center" style="position:relative;z-index:2">
        <span class="badge" style="background: rgba(255, 255, 255, 0.15); color: #fff; border: 1px solid rgba(255, 255, 255, 0.25); backdrop-filter: blur(8px); margin-bottom: 1rem; display: inline-block;">Pintasan Solusi Masalah Teknis</span>
        <h1 id="page-title" style="color:#fff;margin-bottom:.75rem; font-size: 2.2rem; font-weight: 800; line-height: 1.2;">
            Solusi {{ $problemInfo['name'] }} {{ $city ? 'di ' . $city->full_name : '' }}
        </h1>
        <p style="color:rgba(255,255,255,.85);font-size:1.05rem;max-width:700px;margin:0 auto">Penanganan darurat cepat 24 jam menggunakan mesin rotasi spiral modern &amp; hydro-jetting tanpa merusak struktur bangunan Anda.</p>
    </div>
</div>

{{-- Main Content Section --}}
<section class="section py-16 bg-white" aria-labelledby="detail-heading">
    <div class="container">
        <div style="max-width: 900px; margin: 0 auto;" class="space-y-12">
            
            {{-- Direct Answer (GEO Optimization) --}}
            <div style="background: #f0fdf4; border-left: 5px solid #169F81; padding: 1.5rem; border-radius: 0 16px 16px 0; box-shadow: 0 4px 12px rgba(22,159,129,0.05)">
                <p style="font-size: 1.1rem; line-height: 1.6; color: #0f172a; margin: 0; font-weight: 500;">
                    <strong>Direct Answer:</strong> Masalah {{ $problemInfo['name'] }} {{ $city ? 'di area ' . $city->name : '' }} diselesaikan oleh teknisi bersertifikat Rootera (J&J Group) menggunakan alat mekanis bebas bahan kimia asam korosif. Garansi tuntas 100% dengan estimasi waktu pengerjaan 1–2 jam saja.
                </p>
            </div>

            {{-- Description & Details --}}
            <div>
                <h2 id="detail-heading" style="font-size: 1.75rem; font-weight: 700; color: #0A2E78; margin-bottom: 1.25rem;">
                    Mengapa Memilih Teknisi Rootera untuk {{ $problemInfo['name'] }}?
                </h2>
                <p style="font-size: 1.05rem; color: #475569; line-height: 1.75; margin-bottom: 1.5rem;">
                    {{ $problemInfo['description'] }} Kami memahami betapa mengganggunya genangan air kotor dan bau tidak sedap akibat saluran tersumbat. Teknisi kami datang lengkap membawa peralatan standar industri tanpa perlu membongkar ubin atau tembok rumah Anda.
                </p>

                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 20px; padding: 2rem;">
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: #0A2E78; margin-bottom: 1rem;">
                        Metode Penanganan Bergaransi
                    </h3>
                    <ul style="list-style-type: none; padding-left: 0; margin-bottom: 0;" class="space-y-3">
                        <li style="display: flex; gap: 0.75rem; color: #475569; font-size: 1rem;">
                            <span style="color: #169F81; font-weight: bold;">✓</span>
                            <span><strong>Peralatan Rotasi Cables Modern:</strong> Menghancurkan kerak minyak &amp; gumpalan kotoran hingga meluncur tuntas.</span>
                        </li>
                        <li style="display: flex; gap: 0.75rem; color: #475569; font-size: 1rem;">
                            <span style="color: #169F81; font-weight: bold;">✓</span>
                            <span><strong>Bebas Asam Kimia:</strong> Menjaga pipa paralon PVC tidak meleleh, bocor, atau rapuh di kemudian hari.</span>
                        </li>
                        <li style="display: flex; gap: 0.75rem; color: #475569; font-size: 1rem;">
                            <span style="color: #169F81; font-weight: bold;">✓</span>
                            <span><strong>Respon Cepat 24 Jam:</strong> Teknisi stanby terdekat di kota Anda siap datang sewaktu-waktu.</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Pricing Table --}}
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                <h3 style="font-size: 1.35rem; font-weight: 700; color: #0A2E78; margin-bottom: 1rem;">
                    Skema Tarif {{ $problemInfo['name'] }}
                </h3>
                <div style="overflow-x: auto; border: 1px solid #e2e8f0; border-radius: 12px;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.95rem;">
                        <thead>
                            <tr style="background: #0A2E78; color: #ffffff;">
                                <th style="padding: 0.85rem 1.25rem;">Kategori Pelanggan</th>
                                <th style="padding: 0.85rem 1.25rem;">Estimasi Biaya</th>
                                <th style="padding: 0.85rem 1.25rem;">Garansi &amp; Layanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td style="padding: 0.85rem 1.25rem; font-weight: 600;">Hunian Rumah / Residensial</td>
                                <td style="padding: 0.85rem 1.25rem; color: #169F81; font-weight: 700;">{{ $problemInfo['price_home'] }}</td>
                                <td style="padding: 0.85rem 1.25rem; color: #475569;">Bergaransi Tuntas 100%</td>
                            </tr>
                            <tr style="background: #f8fafc;">
                                <td style="padding: 0.85rem 1.25rem; font-weight: 600;">Pabrik / Restoran / Gedung</td>
                                <td style="padding: 0.85rem 1.25rem; color: #1E73D8; font-weight: 700;">{{ $problemInfo['price_corporate'] }}</td>
                                <td style="padding: 0.85rem 1.25rem; color: #475569;">Invoice &amp; SPK Resmi J&amp;J Group</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Universal Mesh Interlinking Block 1: Local Area Hub Grid --}}
            @if(isset($allCities) && $allCities->isNotEmpty())
            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 20px; padding: 2rem;">
                <h3 style="font-size: 1.35rem; font-weight: 700; color: #0A2E78; margin-bottom: 0.5rem;">
                    📍 Pilih Kota Terdekat untuk Solusi {{ $problemInfo['name'] }}
                </h3>
                <p style="font-size: 0.92rem; color: #64748B; margin-bottom: 1.25rem;">Klik kota operasional Anda untuk memanggil teknisi stanby terdekat:</p>

                <div style="display: flex; flex-wrap: wrap; gap: 0.6rem;">
                    @foreach($allCities as $c)
                        <a href="{{ url('/solusi/' . $problemSlug . '/' . $c->slug) }}" style="background: #ffffff; border: 1px solid #CBD5E1; color: #0A2E78; padding: 0.45rem 1rem; border-radius: 50px; font-size: 0.88rem; font-weight: 600; text-decoration: none;" class="hover:border-[#169F81] hover:text-[#169F81]">
                            📍 {{ $problemInfo['name'] }} {{ $c->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Universal Mesh Interlinking Block 2: Cross-Service Links --}}
            @if(isset($allCategories) && $allCategories->isNotEmpty())
            <div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 20px; padding: 2rem;">
                <h3 style="font-size: 1.35rem; font-weight: 700; color: #0A2E78; margin-bottom: 0.5rem;">
                    🔧 Solusi Pipa &amp; Sanitasi Terkait Lainnya
                </h3>
                <p style="font-size: 0.92rem; color: #64748B; margin-bottom: 1.25rem;">Jelajahi kategori penanganan masalah pipa lainnya dari Rootera Plumbing:</p>

                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1rem;">
                    @foreach($allCategories as $otherCat)
                        <a href="{{ route('layanan.show', $otherCat->slug) }}" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 1rem; text-decoration: none; color: #0A2E78; font-weight: 700; font-size: 0.92rem; display: block;">
                            🛠️ {{ $otherCat->name }}
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Universal Mesh Interlinking Block 3: Related Technical Articles --}}
            @if(isset($articles) && $articles->isNotEmpty())
            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 20px; padding: 2rem;">
                <h3 style="font-size: 1.35rem; font-weight: 700; color: #0A2E78; margin-bottom: 0.5rem;">
                    📰 Panduan &amp; Artikel Edukasi Perawatan Pipa
                </h3>
                <p style="font-size: 0.92rem; color: #64748B; margin-bottom: 1.25rem;">Tips praktis pencegahan pipa tersumbat dari tim spesialis Rootera:</p>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem;">
                    @foreach($articles as $art)
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

            {{-- Call To Action --}}
            <div style="background: linear-gradient(135deg, #0A2E78 0%, #169F81 100%); border-radius: 24px; padding: 3rem; text-align: center; color: #ffffff; margin-top: 2rem;">
                <h3 style="font-size: 1.75rem; font-weight: 800; color: #ffffff; margin-bottom: 0.75rem;">Konsultasikan Problem Pipa Anda Sekarang!</h3>
                <p style="color: rgba(255,255,255,0.9); font-size: 1.05rem; max-width: 600px; margin: 0 auto 2rem;">Respon darurat 24 jam. Teknisi bersertifikat kami siap meluncur ke lokasi Anda.</p>
                <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                    <a href="https://wa.me/6281385404000?text=Halo%20Rootera%2C%20saya%20butuh%20bantuan%20solusi%20{{ urlencode($problemInfo['name']) }}." class="btn btn-primary" style="background:#25D366; border-color:#25D366; font-size:1rem; padding: 0.85rem 2rem; color: #ffffff; font-weight: 700; border-radius: 50px; text-decoration: none;" target="_blank" rel="noopener">
                        Hubungi via WhatsApp 24 Jam
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
