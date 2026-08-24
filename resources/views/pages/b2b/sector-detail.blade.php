@extends('layouts.app')

@section('schema-markup')
<?php
$sectorSchema = [
  "@context" => "https://schema.org",
  "@type" => "Service",
  "serviceType" => "Commercial Plumbing & Drain Maintenance",
  "name" => "Rootera B2B Plumbing " . $sector->sector_name . (isset($city) ? " di " . $city->full_name : ""),
  "description" => $sector->short_description,
  "provider" => [
    "@type" => "Plumber",
    "name" => "Rootera Plumbing (Divisi Plumbing Resmi J&J Group)",
    "url" => url('/'),
    "telephone" => "+6281385404000",
    "logo" => asset('images/logo final.png'),
  ],
  "areaServed" => isset($city) ? [
    "@type" => "City",
    "name" => $city->name
  ] : [
    "@type" => "Country",
    "name" => "Indonesia"
  ],
  "hasOfferCatalog" => [
    "@type" => "OfferCatalog",
    "name" => "B2B Commercial Plumbing Services",
    "itemListElement" => array_map(function($sol) {
        return [
          "@type" => "Offer",
          "itemOffered" => [
            "@type" => "Service",
            "name" => $sol
          ]
        ];
    }, $sector->solutions_offered ?? [$sector->sector_name])
  ]
];
?>
<script type="application/ld+json">
{!! json_encode($sectorSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
<!-- Sector Landing Hero -->
<section style="background: linear-gradient(135deg, #0A2E78 0%, #061434 100%); color: #ffffff; padding: 5rem 1.5rem; border-bottom: 4px solid #169F81;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(22, 159, 129, 0.2); border: 1px solid rgba(22, 159, 129, 0.4); color: #2dd4bf; padding: 0.4rem 1.2rem; border-radius: 50px; font-size: 0.88rem; font-weight: 700; margin-bottom: 1.5rem;">
            <span>{{ $sector->icon }} Spesialis B2B Sektor {{ $sector->sector_name }}</span>
            @if(isset($city))
                <span>•</span>
                <span>📍 Area {{ $city->full_name }}</span>
            @endif
        </div>

        <h1 style="font-size: clamp(2rem, 4vw, 3.25rem); font-weight: 800; line-height: 1.2; margin-bottom: 1.25rem; color: #ffffff;">
            {{ $sector->hero_headline }} @if(isset($city)) di {{ $city->full_name }} @endif
        </h1>
        <p style="font-size: 1.15rem; color: rgba(255,255,255,0.9); max-width: 850px; margin-bottom: 2.25rem; line-height: 1.6;">
            {{ $sector->short_description }} Dikerjakan oleh teknisi bersertifikat <strong>Rootera Plumbing (J&amp;J Group)</strong> menggunakan metode mekanis rotary spiral &amp; hydro-jetting modern 100% bebas dari soda api korosif.
        </p>

        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera B2B, kami ingin konsultasi / panggil teknisi untuk sektor ' . $sector->sector_name . (isset($city) ? ' di ' . $city->full_name : '')) }}" target="_blank" class="btn" style="background: #25D366; color: #ffffff; font-weight: 700; font-size: 1.05rem; padding: 0.9rem 2.25rem; border-radius: 50px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 10px 25px rgba(37, 211, 102, 0.25);">
                💬 Hubungi Corporate Sales WhatsApp (24 Jam)
            </a>
            <a href="{{ route('b2b.contract', $sector->slug) }}" class="btn" style="background: #169F81; color: #ffffff; font-weight: 700; font-size: 1.05rem; padding: 0.9rem 2rem; border-radius: 50px; text-decoration: none;">
                📜 Pengajuan Kontrak Maintenance B2B
            </a>
        </div>
    </div>
</section>

<!-- Pain Points & Solutions Grid -->
<section style="padding: 5rem 1.5rem; background: #ffffff;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 2.5rem;">
            
            {{-- Tantangan Spesifik Sektor --}}
            <div style="background: #FFF5F5; border-radius: 20px; padding: 2.25rem; border: 1px solid #FECDD3;">
                <span style="color: #E11D48; font-weight: 800; text-transform: uppercase; font-size: 0.85rem; tracking-wider">Permasalahan Khas</span>
                <h2 style="color: #9F1239; font-size: 1.75rem; font-weight: 800; margin: 0.4rem 0 1.25rem;">Tantangan Sanitasi {{ $sector->sector_name }}</h2>
                <ul style="padding-left: 1.25rem; margin: 0; color: #475569; font-size: 0.98rem; line-height: 1.8;">
                    @if(!empty($sector->pain_points))
                        @foreach($sector->pain_points as $point)
                            <li style="margin-bottom: 0.75rem;"><strong>❌ {{ $point }}</strong></li>
                        @endforeach
                    @endif
                </ul>
            </div>

            {{-- Solusi Profesional Rootera --}}
            <div style="background: #F0FDF4; border-radius: 20px; padding: 2.25rem; border: 1px solid #BBF7D0;">
                <span style="color: #169F81; font-weight: 800; text-transform: uppercase; font-size: 0.85rem; tracking-wider">Solusi Presisi Rootera</span>
                <h2 style="color: #065F46; font-size: 1.75rem; font-weight: 800; margin: 0.4rem 0 1.25rem;">Layanan Unggulan J&amp;J Group</h2>
                <ul style="padding-left: 1.25rem; margin: 0; color: #334155; font-size: 0.98rem; line-height: 1.8;">
                    @if(!empty($sector->solutions_offered))
                        @foreach($sector->solutions_offered as $sol)
                            <li style="margin-bottom: 0.75rem;"><strong>✅ {{ $sol }}</strong></li>
                        @endforeach
                    @endif
                </ul>
            </div>

        </div>
    </div>
</section>

<!-- Technical Methods & Equipment Showcase -->
<section style="padding: 4.5rem 1.5rem; background: #F8FAFC; border-top: 1px solid #E2E8F0; border-bottom: 1px solid #E2E8F0;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 3rem;">
            <span style="color: #169F81; font-weight: 700; text-transform: uppercase; font-size: 0.85rem;">Teknologi Modern</span>
            <h2 style="color: #0A2E78; font-size: 2.2rem; font-weight: 800; margin-top: 0.4rem;">Metode Pengerjaan Rekomendasi di Sektor {{ $sector->sector_name }}</h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
            @if(!empty($sector->recommended_methods))
                @foreach($sector->recommended_methods as $method)
                <div style="background: #ffffff; border-radius: 16px; padding: 1.75rem; border: 1px solid #E2E8F0; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                    <div style="font-size: 2.2rem; margin-bottom: 0.75rem;">🌀</div>
                    <h3 style="color: #0A2E78; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $method }}</h3>
                    <p style="color: #64748B; font-size: 0.92rem; line-height: 1.5;">Rekomendasi metode paling efisien untuk melancarkan blokade tanpa merusak konstruksi lantai maupun pipa PVC/besi.</p>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

<!-- Regional Spoke Grid for B2B (If City Context or All Cities) -->
@if(isset($allCities) && $allCities->isNotEmpty())
<section style="padding: 4.5rem 1.5rem; background: #ffffff;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="margin-bottom: 2rem;">
            <h3 style="color: #0A2E78; font-size: 1.5rem; font-weight: 800; margin-bottom: 0.4rem;">📍 Cakupan Layanan {{ $sector->sector_name }} di Berbagai Kota</h3>
            <p style="color: #64748B; font-size: 0.95rem;">Pilih kota operasional bisnis Anda untuk penanganan cepat 24 Jam:</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 0.85rem;">
            @foreach($allCities as $c)
                <a href="{{ url('/sektor-plumbing/' . $sector->slug . '/' . $c->slug) }}" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 0.85rem 1.1rem; color: #0A2E78; font-weight: 700; font-size: 0.9rem; text-decoration: none; display: flex; justify-content: space-between; align-items: center;" class="hover:border-[#169F81] hover:text-[#169F81]">
                    <span>📍 {{ $sector->sector_name }} {{ $c->name }}</span>
                    <span>→</span>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- B2B Emergency Callout Banner -->
<section style="background: linear-gradient(135deg, #0A2E78, #0D3A94); color: #ffffff; padding: 4.5rem 1.5rem; text-align: center;">
    <div style="max-width: 800px; margin: 0 auto;">
        <h2 style="font-size: 2.2rem; font-weight: 800; margin-bottom: 1rem;">Butuh Penanganan Darurat atau Audit Lokasi Sektor {{ $sector->sector_name }}?</h2>
        <p style="font-size: 1.1rem; color: rgba(255,255,255,0.85); margin-bottom: 2.25rem; line-height: 1.6;">Tim teknisi berpengalaman Rootera siap meluncur dengan peralatan lengkap &amp; jaminan invoice legal PT/CV J&amp;J Group.</p>
        
        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Corporate Sales Rootera (J&J Group), kami butuh panggil teknisi B2B untuk sektor ' . $sector->sector_name) }}" target="_blank" class="btn" style="background: #25D366; color: #ffffff; font-size: 1.15rem; font-weight: 700; padding: 1.1rem 2.5rem; border-radius: 50px; text-decoration: none; box-shadow: 0 10px 30px rgba(37, 211, 102, 0.3);">
            Hubungi Customer Service B2B WhatsApp (24 Jam)
        </a>
    </div>
</section>
@endsection
