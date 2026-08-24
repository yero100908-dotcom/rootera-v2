@extends('layouts.app')

@section('schema-markup')
<?php
$propertySchema = [
  "@context" => "https://schema.org",
  "@type" => "Service",
  "serviceType" => "Plumbing & Drain Cleaning Service",
  "name" => "Jasa Pelancaran Saluran Mampet " . $property->name . (isset($city) ? " di " . $city->full_name : ""),
  "description" => $property->meta_description ?? "Jasa pelancaran pipa mampet profesional untuk " . $property->name . " tanpa bongkar keramik.",
  "provider" => [
    "@type" => "Plumber",
    "name" => "Rootera Plumbing",
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
  "offers" => [
    "@type" => "Offer",
    "price" => preg_replace('/[^0-9]/', '', $property->price_starting_from) ?: "350000",
    "priceCurrency" => "IDR",
    "availability" => "https://schema.org/InStock",
    "seller" => [
      "@type" => "Organization",
      "name" => "Rootera Plumbing (J&J Group)"
    ]
  ]
];
?>
<script type="application/ld+json">
{!! json_encode($propertySchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
<!-- Public Property Hero Section -->
<section style="background: linear-gradient(135deg, #0A2E78 0%, #06183B 100%); color: #ffffff; padding: 4.5rem 1.5rem; border-bottom: 4px solid #169F81;">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <div style="display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap; margin-bottom: 1.25rem;">
            <span style="background: rgba(22, 159, 129, 0.2); border: 1px solid rgba(22, 159, 129, 0.4); color: #2dd4bf; padding: 0.35rem 1.1rem; border-radius: 50px; font-size: 0.85rem; font-weight: 700;">
                {{ $property->icon }} Kategori Properti: {{ $property->name }}
            </span>
            @if(isset($city))
            <span style="background: rgba(255, 255, 255, 0.15); color: #ffffff; padding: 0.35rem 1.1rem; border-radius: 50px; font-size: 0.85rem; font-weight: 700;">
                📍 Area {{ $city->full_name }}
            </span>
            @endif
        </div>

        <h1 style="font-size: clamp(2rem, 4vw, 3.25rem); font-weight: 800; line-height: 1.25; margin-bottom: 1.25rem; color: #ffffff;">
            Jasa Pelancaran Saluran Mampet {{ $property->name }} @if(isset($city)) di {{ $city->full_name }} @endif
        </h1>
        <p style="font-size: 1.15rem; color: rgba(255,255,255,0.9); max-width: 820px; margin-bottom: 2rem; line-height: 1.6;">
            Pengerjaan cepat {{ $property->estimated_time ?? '1-2 Jam Selesai' }} langsung tuntas tanpa bongkar keramik. Bergaransi {{ $property->guarantee_days ?? 30 }} hari &amp; teknisi siap datang 24 jam nonstop ke lokasi Anda.
        </p>

        {{-- Highlight Key Benefits Pills --}}
        <div style="display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 2.25rem;">
            <div style="background: rgba(255,255,255,0.1); border-radius: 12px; padding: 0.6rem 1.2rem; font-size: 0.9rem; font-weight: 700; display: flex; align-items: center; gap: 0.4rem;">
                <span>⏱️ Estimasi:</span>
                <span style="color: #2dd4bf;">{{ $property->estimated_time ?? '1-2 Jam Selesai' }}</span>
            </div>
            <div style="background: rgba(255,255,255,0.1); border-radius: 12px; padding: 0.6rem 1.2rem; font-size: 0.9rem; font-weight: 700; display: flex; align-items: center; gap: 0.4rem;">
                <span>💰 Harga Mulai:</span>
                <span style="color: #2dd4bf;">{{ $property->price_starting_from ?? 'Rp 350.000' }}</span>
            </div>
            <div style="background: rgba(255,255,255,0.1); border-radius: 12px; padding: 0.6rem 1.2rem; font-size: 0.9rem; font-weight: 700; display: flex; align-items: center; gap: 0.4rem;">
                <span>🛡️ Garansi:</span>
                <span style="color: #2dd4bf;">{{ $property->guarantee_days ?? 30 }} Hari Resmi</span>
            </div>
        </div>

        {{-- Primary Direct CTAs --}}
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya butuh panggil teknisi pipa mampet untuk ' . $property->name . (isset($city) ? ' di ' . $city->full_name : '')) }}" target="_blank" class="btn" style="background: #25D366; color: #ffffff; font-weight: 700; font-size: 1.1rem; padding: 0.95rem 2.25rem; border-radius: 50px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 10px 25px rgba(37, 211, 102, 0.25);">
                💬 Panggil Teknisi Sekarang (WhatsApp 24 Jam)
            </a>
            <a href="tel:081385404000" class="btn" style="background: #EF4444; color: #ffffff; font-weight: 700; font-size: 1.05rem; padding: 0.95rem 2rem; border-radius: 50px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem;">
                📞 Telepon Darurat (0813-8540-4000)
            </a>
        </div>
    </div>
</section>

<!-- Common Issues & Fast Solutions Section -->
<section style="padding: 4.5rem 1.5rem; background: #ffffff;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 2.5rem;">
            
            {{-- Masalah yang Paling Sering Terjadi --}}
            <div style="background: #FFF5F5; border-radius: 20px; padding: 2.25rem; border: 1px solid #FECDD3;">
                <span style="color: #E11D48; font-weight: 800; text-transform: uppercase; font-size: 0.85rem;">Identifikasi Kendala</span>
                <h2 style="color: #9F1239; font-size: 1.7rem; font-weight: 800; margin: 0.4rem 0 1.25rem;">Masalah Sering Terjadi di {{ $property->name }}</h2>
                <ul style="padding-left: 1.25rem; margin: 0; color: #475569; font-size: 0.98rem; line-height: 1.8;">
                    @if(!empty($property->common_issues))
                        @foreach($property->common_issues as $issue)
                            <li style="margin-bottom: 0.75rem;"><strong>⚠️ {{ $issue }}</strong></li>
                        @endforeach
                    @endif
                </ul>
            </div>

            {{-- Solusi Cepat & Garansi Rootera --}}
            <div style="background: #F0FDF4; border-radius: 20px; padding: 2.25rem; border: 1px solid #BBF7D0;">
                <span style="color: #169F81; font-weight: 800; text-transform: uppercase; font-size: 0.85rem;">Keunggulan Layanan</span>
                <h2 style="color: #065F46; font-size: 1.7rem; font-weight: 800; margin: 0.4rem 0 1.25rem;">Solusi Praktis &amp; Cepat Rootera</h2>
                <ul style="padding-left: 1.25rem; margin: 0; color: #334155; font-size: 0.98rem; line-height: 1.8;">
                    @if(!empty($property->fast_solutions))
                        @foreach($property->fast_solutions as $sol)
                            <li style="margin-bottom: 0.75rem;"><strong>✅ {{ $sol }}</strong></li>
                        @endforeach
                    @endif
                </ul>
            </div>

        </div>
    </div>
</section>

<!-- Simple 3-Step Ordering Flow -->
<section style="padding: 4.5rem 1.5rem; background: #F8FAFC; border-top: 1px solid #E2E8F0; border-bottom: 1px solid #E2E8F0;">
    <div style="max-width: 1100px; margin: 0 auto; text-align: center;">
        <span style="color: #169F81; font-weight: 700; text-transform: uppercase; font-size: 0.85rem;">Prosedur Pemesanan Cepat</span>
        <h2 style="color: #0A2E78; font-size: 2.2rem; font-weight: 800; margin: 0.3rem 0 3rem;">3 Langkah Mudah Panggil Teknisi Terdekat</h2>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 2rem;">
            <div style="background: #ffffff; border-radius: 20px; padding: 2.25rem 1.5rem; border: 1px solid #E2E8F0; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                <div style="width: 50px; height: 50px; background: #0A2E78; color: #ffffff; font-weight: 800; font-size: 1.3rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem;">1</div>
                <h3 style="color: #0A2E78; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem;">Kirim Foto / Lokasi via WA</h3>
                <p style="color: #64748B; font-size: 0.92rem; line-height: 1.6;">CS kami siap merespon dalam hitungan detik untuk konfirmasi jadwal kedatangan teknisi.</p>
            </div>
            <div style="background: #ffffff; border-radius: 20px; padding: 2.25rem 1.5rem; border: 1px solid #E2E8F0; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                <div style="width: 50px; height: 50px; background: #169F81; color: #ffffff; font-weight: 800; font-size: 1.3rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem;">2</div>
                <h3 style="color: #0A2E78; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem;">Teknisi Datang &amp; Kerjakan</h3>
                <p style="color: #64748B; font-size: 0.92rem; line-height: 1.6;">Teknisi profesional meluncur membawa peralatan Spiral Rotary tanpa merusak keramik.</p>
            </div>
            <div style="background: #ffffff; border-radius: 20px; padding: 2.25rem 1.5rem; border: 1px solid #E2E8F0; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                <div style="width: 50px; height: 50px; background: #25D366; color: #ffffff; font-weight: 800; font-size: 1.3rem; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem;">3</div>
                <h3 style="color: #0A2E78; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem;">Bayar &amp; Terima Garansi</h3>
                <p style="color: #64748B; font-size: 0.92rem; line-height: 1.6;">Pembayaran dilakukan setelah pengerjaan lancar tuntas disertai nota garansi resmi 30 Hari.</p>
            </div>
        </div>
    </div>
</section>

<!-- Regional Spoke Grid for Property Type -->
@if(isset($cities) && $cities->isNotEmpty())
<section style="padding: 4.5rem 1.5rem; background: #ffffff;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="margin-bottom: 2rem;">
            <h3 style="color: #0A2E78; font-size: 1.5rem; font-weight: 800; margin-bottom: 0.4rem;">📍 Layanan {{ $property->name }} di Kota Terdekat</h3>
            <p style="color: #64748B; font-size: 0.95rem;">Pilih kota Anda untuk kedatangan teknisi darurat 25-40 Menit:</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 0.85rem;">
            @foreach($cities as $c)
                <a href="{{ url('/solusi-properti/' . $property->slug . '/' . $c->slug) }}" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 0.85rem 1.1rem; color: #0A2E78; font-weight: 700; font-size: 0.9rem; text-decoration: none; display: flex; justify-content: space-between; align-items: center;" class="hover:border-[#169F81] hover:text-[#169F81]">
                    <span>📍 {{ $property->name }} {{ $c->name }}</span>
                    <span>→</span>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Other Property Types Cross-Linking Grid -->
@if(isset($allProperties) && $allProperties->isNotEmpty())
<section style="padding: 4rem 1.5rem; background: #F8FAFC; border-top: 1px solid #E2E8F0;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="margin-bottom: 1.75rem;">
            <h3 style="color: #0A2E78; font-size: 1.4rem; font-weight: 800; margin-bottom: 0.3rem;">🏢 Kategori Properti Lainnya</h3>
            <p style="color: #64748B; font-size: 0.92rem;">Temukan solusi pipa mampet untuk jenis bangunan lainnya:</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 1rem;">
            @foreach($allProperties as $otherProp)
                <a href="{{ route('property.show', $otherProp->slug) }}" style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 12px; padding: 1rem; color: #0A2E78; font-weight: 700; font-size: 0.9rem; text-decoration: none; display: flex; align-items: center; gap: 0.6rem;" class="hover:border-[#169F81] hover:shadow-md">
                    <span style="font-size: 1.5rem;">{{ $otherProp->icon }}</span>
                    <span>{{ $otherProp->name }}</span>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Emergency Callout CTA Banner -->
<section style="background: linear-gradient(135deg, #0A2E78, #0D3A94); color: #ffffff; padding: 4.5rem 1.5rem; text-align: center;">
    <div style="max-width: 800px; margin: 0 auto;">
        <h2 style="font-size: 2.2rem; font-weight: 800; margin-bottom: 1rem;">Butuh Panggil Teknisi Sekarang?</h2>
        <p style="font-size: 1.1rem; color: rgba(255,255,255,0.85); margin-bottom: 2.25rem; line-height: 1.6;">Tim teknisi berpengalaman Rootera siap meluncur ke {{ $property->name }} @if(isset($city)) di {{ $city->full_name }} @endif dengan jaminan garansi 30 hari.</p>
        
        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saluran mampet di ' . $property->name . (isset($city) ? ' di ' . $city->full_name : '') . ' butuh penanganan sekarang.') }}" target="_blank" class="btn" style="background: #25D366; color: #ffffff; font-size: 1.15rem; font-weight: 700; padding: 1.1rem 2.5rem; border-radius: 50px; text-decoration: none; box-shadow: 0 10px 30px rgba(37, 211, 102, 0.3);">
            Hubungi Customer Service WhatsApp (24 Jam)
        </a>
    </div>
</section>
@endsection
