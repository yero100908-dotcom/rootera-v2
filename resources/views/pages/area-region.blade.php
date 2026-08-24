@extends('layouts.app')

@section('schema-markup')
<?php
$regionSchema = [
  "@context" => "https://schema.org",
  "@graph" => [
    [
      "@type" => "BreadcrumbList",
      "itemListElement" => [
        [
          "@type" => "ListItem",
          "position" => 1,
          "name" => "Beranda",
          "item" => url('/')
        ],
        [
          "@type" => "ListItem",
          "position" => 2,
          "name" => "Jasa Saluran Mampet",
          "item" => route('area-layanan')
        ],
        [
          "@type" => "ListItem",
          "position" => 3,
          "name" => "Provinsi " . $province->name,
          "item" => route('area.region', $province->slug)
        ]
      ]
    ],
    [
      "@type" => "AdministrativeArea",
      "name" => "Provinsi " . $province->name,
      "description" => "Regional Hub resmi jangkauan layanan pelancaran pipa mampet, wastafel, & toilet di wilayah Provinsi " . $province->name . ".",
      "url" => route('area.region', $province->slug),
      "provider" => [
        "@type" => "Plumber",
        "name" => "Rootera Plumbing (J&J Group)",
        "telephone" => "+6281385404000",
        "url" => url('/')
      ]
    ]
  ]
];
?>
<script type="application/ld+json">
{!! json_encode($regionSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
<!-- Regional Hero Header -->
<section style="background: linear-gradient(135deg, #0A2E78 0%, #04122C 100%); color: #ffffff; padding: 4.5rem 1.5rem; border-bottom: 4px solid #169F81;">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(22, 159, 129, 0.2); border: 1px solid rgba(22, 159, 129, 0.4); color: #2dd4bf; padding: 0.4rem 1.25rem; border-radius: 50px; font-size: 0.88rem; font-weight: 700; margin-bottom: 1.25rem;">
            <span>🗺️ Regional Hub Resmi J&amp;J Group — {{ $province->name }}</span>
        </div>

        <h1 style="font-size: clamp(2.1rem, 4vw, 3.25rem); font-weight: 800; line-height: 1.2; margin-bottom: 1.25rem; color: #ffffff;">
            Jasa Pipa Mampet Provinsi {{ $province->name }} — Rootera Plumbing
        </h1>

        <p style="font-size: 1.15rem; color: rgba(255,255,255,0.9); max-width: 850px; margin-bottom: 2.25rem; line-height: 1.6;">
            Daftar lengkap kota, kabupaten, dan kecamatan jangkauan pelancaran saluran pipa air mampet, wastafel, floor drain, dan kloset tanpa bongkar di wilayah <strong>{{ $province->name }}</strong> dan sekitarnya.
        </p>

        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya butuh panggil teknisi pipa mampet untuk wilayah ' . $province->name) }}" target="_blank" class="btn" style="background: #25D366; color: #ffffff; font-weight: 700; font-size: 1.05rem; padding: 0.9rem 2.25rem; border-radius: 50px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 10px 25px rgba(37, 211, 102, 0.25);">
                💬 Panggil Teknisi Regional {{ $province->name }} (WhatsApp 24 Jam)
            </a>
            <a href="#city-grid" class="btn" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.3); color: #ffffff; font-weight: 700; font-size: 1.05rem; padding: 0.9rem 2rem; border-radius: 50px; text-decoration: none;">
                Lihat {{ $province->cities->count() }} Kota / Kabupaten ↓
            </a>
        </div>

    </div>
</section>

<!-- Cities & Sub-Districts Mega Grid Section -->
<section id="city-grid" style="padding: 5rem 1.5rem; background: #F8FAFC;">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <div style="text-align: center; margin-bottom: 3.5rem;">
            <span style="color: #169F81; font-weight: 700; text-transform: uppercase; font-size: 0.85rem; tracking-wider">Cakupan Kota &amp; Kabupaten</span>
            <h2 style="color: #0A2E78; font-size: 2.2rem; font-weight: 800; margin-top: 0.3rem;">Pilih Kota / Kabupaten di {{ $province->name }}</h2>
            <p style="color: #64748B; font-size: 0.95rem;">Setiap wilayah kota tercover unit armada teknisi terdekat dengan garansi tiba 25-40 Menit:</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 1.75rem;">
            @foreach($province->cities as $city)
            <div style="background: #ffffff; border-radius: 20px; border: 1px solid #E2E8F0; padding: 1.75rem; box-shadow: 0 4px 20px rgba(0,0,0,0.03); display: flex; flex-direction: column; justify-content: space-between; transition: all 0.3s ease;" class="hover:border-[#169F81] hover:shadow-xl">
                <div>
                    {{-- City Title & Badge --}}
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                        <div>
                            <span style="font-size: 0.78rem; font-weight: 700; color: #169F81; text-transform: uppercase;">{{ $city->type }} {{ $city->name }}</span>
                            <h3 style="color: #0A2E78; font-size: 1.35rem; font-weight: 800; margin: 0.2rem 0 0;">
                                <a href="{{ route('area.city', $city->slug) }}" style="color: inherit; text-decoration: none;" class="hover:text-[#169F81]">
                                    📍 {{ $city->full_name }}
                                </a>
                            </h3>
                        </div>
                        <span style="background: #F0FDF4; color: #169F81; font-size: 0.78rem; font-weight: 700; padding: 0.3rem 0.7rem; border-radius: 50px;">
                            {{ $city->estimated_arrival ?? '25-40 Menit' }}
                        </span>
                    </div>

                    <p style="color: #64748B; font-size: 0.9rem; line-height: 1.5; margin-bottom: 1.25rem;">
                        Layanan panggil teknisi pipa tersumbat door-to-door &amp; komersial untuk <strong>{{ $city->districts->count() }} Kecamatan</strong> di {{ $city->name }}.
                    </p>

                    {{-- Kecamatan Accordion Dropdown --}}
                    <details style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 0.85rem 1rem; margin-bottom: 1.25rem;">
                        <summary style="font-size: 0.86rem; font-weight: 700; color: #0A2E78; cursor: pointer; user-select: none;">
                            Daftar {{ $city->districts->count() }} Kecamatan di {{ $city->name }} ↓
                        </summary>

                        <div style="display: flex; flex-wrap: wrap; gap: 0.4rem; margin-top: 0.85rem;">
                            @forelse($city->districts as $dist)
                                <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/' . $city->slug . '/' . $dist->slug) }}" style="background: #ffffff; border: 1px solid #CBD5E1; border-radius: 6px; padding: 0.25rem 0.6rem; color: #334155; font-size: 0.78rem; text-decoration: none; font-weight: 600;" class="hover:border-[#169F81] hover:text-[#169F81]">
                                    {{ $dist->name }}
                                </a>
                            @empty
                                <span style="font-size: 0.78rem; color: #94A3B8;">Kecamatan Utama {{ $city->name }}</span>
                            @endforelse
                        </div>
                    </details>
                </div>

                {{-- Direct Button --}}
                <a href="{{ route('area.city', $city->slug) }}" style="display: block; text-align: center; background: #0A2E78; color: #ffffff; font-weight: 700; font-size: 0.9rem; padding: 0.8rem; border-radius: 10px; text-decoration: none;" class="hover:bg-[#169F81]">
                    Area Layanan {{ $city->name }} →
                </a>

            </div>
            @endforeach
        </div>

    </div>
</section>

<!-- Main Service Categories Grid -->
@if(isset($allCategories) && $allCategories->isNotEmpty())
<section style="padding: 4.5rem 1.5rem; background: #ffffff; border-top: 1px solid #E2E8F0;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="margin-bottom: 2rem; text-align: center;">
            <span style="color: #169F81; font-weight: 700; text-transform: uppercase; font-size: 0.85rem;">Spesialisasi Pengerjaan</span>
            <h2 style="color: #0A2E78; font-size: 2rem; font-weight: 800; margin-top: 0.3rem;">7 Kategori Layanan Pipa di {{ $province->name }}</h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 1.25rem;">
            @foreach($allCategories as $cat)
                <a href="{{ route('layanan.show', $cat->slug) }}" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 14px; padding: 1.25rem; color: #0A2E78; text-decoration: none; display: flex; align-items: center; gap: 0.85rem;" class="hover:border-[#169F81] hover:shadow-md">
                    <span style="font-size: 2rem;">🛠️</span>
                    <div>
                        <div style="font-weight: 800; font-size: 1rem;">{{ $cat->name }}</div>
                        <div style="font-size: 0.8rem; color: #64748B;">Pengerjaan Tanpa Bongkar</div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Regional Property & Commercial Maintenance Segment -->
<section style="padding: 4.5rem 1.5rem; background: #F8FAFC; border-top: 1px solid #E2E8F0;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 3rem;">
            <span style="color: #169F81; font-weight: 700; text-transform: uppercase; font-size: 0.85rem;">Cakupan Sektor Properti</span>
            <h2 style="color: #0A2E78; font-size: 2rem; font-weight: 800; margin-top: 0.3rem;">Solusi Sanitasi untuk Berbagai Bangunan di {{ $province->name }}</h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.5rem;">
            <div style="background: #ffffff; border-radius: 16px; padding: 1.75rem; border: 1px solid #E2E8F0;">
                <div style="font-size: 2.2rem; margin-bottom: 0.5rem;">🏡</div>
                <h3 style="color: #0A2E78; font-size: 1.15rem; font-weight: 700; margin-bottom: 0.4rem;">Rumah Tinggal &amp; Cluster</h3>
                <p style="color: #64748B; font-size: 0.88rem; line-height: 1.5;">Pelancaran sink dapur, floor drain mandi, kloset &amp; got rumah tangga tanpa bongkar ubin keramik.</p>
            </div>
            <div style="background: #ffffff; border-radius: 16px; padding: 1.75rem; border: 1px solid #E2E8F0;">
                <div style="font-size: 2.2rem; margin-bottom: 0.5rem;">☕</div>
                <h3 style="color: #0A2E78; font-size: 1.15rem; font-weight: 700; margin-bottom: 0.4rem;">Cafe, Resto &amp; Culinary</h3>
                <p style="color: #64748B; font-size: 0.88rem; line-height: 1.5;">Descaling kerak lemak membandel pada grease trap &amp; floor sink dapur restoran secara steril &amp; cepat.</p>
            </div>
            <div style="background: #ffffff; border-radius: 16px; padding: 1.75rem; border: 1px solid #E2E8F0;">
                <div style="font-size: 2.2rem; margin-bottom: 0.5rem;">🏨</div>
                <h3 style="color: #0A2E78; font-size: 1.15rem; font-weight: 700; margin-bottom: 0.4rem;">Hotel, Homestay &amp; Kos</h3>
                <p style="color: #64748B; font-size: 0.88rem; line-height: 1.5;">Pembersihan pipa riser stack bertingkat &amp; kamar mandi tanpa kebisingan bising yang mengganggu tamu.</p>
            </div>
            <div style="background: #ffffff; border-radius: 16px; padding: 1.75rem; border: 1px solid #E2E8F0;">
                <div style="font-size: 2.2rem; margin-bottom: 0.5rem;">🏭</div>
                <h3 style="color: #0A2E78; font-size: 1.15rem; font-weight: 700; margin-bottom: 0.4rem;">Pabrik &amp; Kawasan Industri</h3>
                <p style="color: #64748B; font-size: 0.88rem; line-height: 1.5;">Pembersihan Hydro-Jetting tekanan tinggi (150-300 Bar) pipa limbah industri diameter besar.</p>
            </div>
        </div>
    </div>
</section>

<!-- Regional Emergency Banner -->
<section style="background: linear-gradient(135deg, #0A2E78, #0D3A94); color: #ffffff; padding: 4.5rem 1.5rem; text-align: center;">
    <div style="max-width: 800px; margin: 0 auto;">
        <h2 style="font-size: 2.2rem; font-weight: 800; margin-bottom: 1rem;">Butuh Teknisi Pipa Mampet di {{ $province->name }}?</h2>
        <p style="font-size: 1.1rem; color: rgba(255,255,255,0.85); margin-bottom: 2.25rem; line-height: 1.6;">Tim teknisi berpengalaman Rootera Plumbing (J&amp;J Group) siap meluncur ke lokasi Anda 24 Jam nonstop dengan garansi 30 hari.</p>
        
        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya ingin panggil teknisi pipa mampet untuk wilayah ' . $province->name) }}" target="_blank" class="btn" style="background: #25D366; color: #ffffff; font-size: 1.15rem; font-weight: 700; padding: 1.1rem 2.5rem; border-radius: 50px; text-decoration: none; box-shadow: 0 10px 30px rgba(37, 211, 102, 0.3);">
            Hubungi Customer Service WhatsApp (24 Jam)
        </a>
    </div>
</section>
@endsection
