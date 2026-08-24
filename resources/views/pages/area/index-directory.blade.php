@extends('layouts.app')

@section('schema-markup')
<?php
$directorySchema = [
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
          "name" => "Jasa Saluran Mampet (Direktori Wilayah)",
          "item" => route('area-layanan')
        ]
      ]
    ],
    [
      "@type" => "CollectionPage",
      "name" => "Pusat Wilayah Operasional Jasa Saluran Pipa Mampet - Rootera Plumbing",
      "description" => "Direktori resmi wilayah operasional pelancaran pipa mampet di Jabodetabek, Banten, Jawa Barat, Jawa Tengah, DIY, Jawa Timur, dan Lampung.",
      "url" => route('area-layanan'),
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
{!! json_encode($directorySchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
<!-- Directory Hero Header -->
<section style="background: linear-gradient(135deg, #0A2E78 0%, #04122C 100%); color: #ffffff; padding: 4.5rem 1.5rem; border-bottom: 4px solid #169F81;">
    <div style="max-width: 1200px; margin: 0 auto; text-align: center;">
        
        <span style="background: rgba(22, 159, 129, 0.2); border: 1px solid rgba(22, 159, 129, 0.4); color: #2dd4bf; padding: 0.4rem 1.25rem; border-radius: 50px; font-size: 0.88rem; font-weight: 700; display: inline-block; margin-bottom: 1.25rem;">
            🗺️ Master Hub Direktori Wilayah &amp; Kecamatan Operasional
        </span>

        <h1 style="font-size: clamp(2.1rem, 4vw, 3.25rem); font-weight: 800; line-height: 1.2; margin-bottom: 1.25rem; color: #ffffff;">
            Pusat Wilayah Operasional Jasa Saluran Pipa Mampet — Rootera Plumbing
        </h1>

        <p style="font-size: 1.15rem; color: rgba(255,255,255,0.9); max-width: 850px; margin: 0 auto 2.25rem; line-height: 1.6;">
            Temukan teknisi ahli pelancaran pipa mampet terdekat di kota dan kecamatan Anda. Respon cepat 30–90 menit, teknologi rotary spiral &amp; hydro-jetting tanpa bongkar, bergaransi 30 hari.
        </p>

        <!-- Real-Time Search / Filter Input (Vanilla JS) -->
        <div style="max-width: 650px; margin: 0 auto; position: relative;">
            <input type="text" id="directorySearchInput" onkeyup="filterDirectory()" placeholder="🔍 Ketik nama Kota atau Kecamatan (misal: Tebet, Semarang, Serpong, Bandung)..." style="width: 100%; padding: 1.1rem 1.5rem; border-radius: 50px; border: 2px solid #169F81; font-size: 1.05rem; color: #0F172A; outline: none; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
            <div id="searchCounter" style="margin-top: 0.75rem; font-size: 0.88rem; color: #2dd4bf; font-weight: 600;"></div>
        </div>

    </div>
</section>

<!-- Mega Directory Silo Grid Section -->
<section style="padding: 5rem 1.5rem; background: #F8FAFC;">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <div style="text-align: center; margin-bottom: 3.5rem;">
            <span style="color: #169F81; font-weight: 700; text-transform: uppercase; font-size: 0.85rem; tracking-wider">Cakupan Wilayah Nasional</span>
            <h2 style="color: #0A2E78; font-size: 2.2rem; font-weight: 800; margin-top: 0.3rem;">Jaringan Cabang &amp; Teknisi Terdekat</h2>
            <p style="color: #64748B; font-size: 0.95rem;">Pilih kota atau kecamatan Anda untuk respon kedatangan teknisi kilat 24 Jam:</p>
        </div>

        <!-- Loop Provinces & Cities -->
        <div style="display: flex; flex-direction: column; gap: 3rem;">
            @foreach($provinces as $prov)
            <div class="province-card-block" style="background: #ffffff; border-radius: 20px; border: 1px solid #E2E8F0; padding: 2.25rem; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                
                {{-- Header Provinsi --}}
                <div style="display: flex; align-items: center; gap: 0.75rem; border-bottom: 2px solid #F1F5F9; padding-bottom: 1.25rem; margin-bottom: 2rem;">
                    <span style="font-size: 2rem;">📍</span>
                    <div>
                        <h3 style="color: #0A2E78; font-size: 1.6rem; font-weight: 800; margin: 0;">
                            <a href="{{ route('area.region', $prov->slug) }}" style="color: inherit; text-decoration: none;" class="hover:text-[#169F81]">
                                Provinsi {{ $prov->name }}
                            </a>
                        </h3>
                        <span style="color: #64748B; font-size: 0.88rem;">{{ $prov->cities->count() }} Kota &amp; Kabupaten Tercover SLA 24 Jam</span>
                    </div>
                </div>

                {{-- Grid Kota di Provinsi --}}
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem;">
                    @foreach($prov->cities as $city)
                    <div class="city-search-item" data-city-name="{{ strtolower($city->name . ' ' . $city->full_name) }}" data-districts="{{ strtolower($city->districts->pluck('name')->implode(' ')) }}" style="background: #F8FAFC; border-radius: 16px; border: 1px solid #E2E8F0; padding: 1.5rem; transition: all 0.2s ease;">
                        
                        {{-- City Link Header --}}
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <h4 style="color: #0A2E78; font-size: 1.2rem; font-weight: 800; margin: 0;">
                                <a href="{{ route('area.city', $city->slug) }}" style="color: inherit; text-decoration: none;" class="hover:text-[#169F81]">
                                    📍 {{ $city->full_name }}
                                </a>
                            </h4>
                            <span style="background: rgba(22, 159, 129, 0.1); color: #169F81; font-size: 0.75rem; font-weight: 700; padding: 0.25rem 0.65rem; border-radius: 50px;">
                                {{ $city->estimated_arrival ?? '25-40 Mnt' }}
                            </span>
                        </div>

                        <p style="color: #64748B; font-size: 0.86rem; margin-bottom: 1rem; line-height: 1.5;">
                            {{ $city->districts->count() }} Kecamatan Operasional dengan teknisi siap meluncur.
                        </p>

                        {{-- Accordion Collapsible for Districts --}}
                        <details style="border-top: 1px border-dashed #CBD5E1; padding-top: 0.75rem;">
                            <summary style="font-size: 0.85rem; font-weight: 700; color: #169F81; cursor: pointer; user-select: none;">
                                Lihat {{ $city->districts->count() }} Kecamatan di {{ $city->name }} ↓
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

                        <a href="{{ route('area.city', $city->slug) }}" style="display: block; text-align: center; background: #0A2E78; color: #ffffff; font-weight: 700; font-size: 0.85rem; padding: 0.6rem; border-radius: 8px; text-decoration: none; margin-top: 1rem;" class="hover:bg-[#169F81]">
                            Landing Page {{ $city->name }} →
                        </a>

                    </div>
                    @endforeach
                </div>

            </div>
            @endforeach
        </div>

    </div>
</section>

<!-- Categories & Property Types Directory Hub -->
<section style="padding: 4.5rem 1.5rem; background: #ffffff; border-top: 1px solid #E2E8F0;">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <!-- 7 Main Service Categories Grid -->
        <div style="margin-bottom: 4rem;">
            <div style="margin-bottom: 1.75rem;">
                <span style="color: #169F81; font-weight: 700; text-transform: uppercase; font-size: 0.85rem;">Kategori Pengerjaan</span>
                <h3 style="color: #0A2E78; font-size: 1.8rem; font-weight: 800; margin-top: 0.2rem;">Layanan Spesialis Pipa &amp; Drainase</h3>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1.25rem;">
                @foreach($services as $srv)
                    <a href="{{ route('layanan.show', $srv->slug) }}" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 14px; padding: 1.25rem; color: #0A2E78; text-decoration: none; display: flex; align-items: center; gap: 0.85rem;" class="hover:border-[#169F81] hover:shadow-md">
                        <span style="font-size: 2rem;">🛠️</span>
                        <div>
                            <div style="font-weight: 800; font-size: 1rem;">{{ $srv->name }}</div>
                            <div style="font-size: 0.8rem; color: #64748B;">Pengerjaan Tanpa Bongkar</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- 8 Property Types Grid -->
        @if(isset($propertyTypes) && $propertyTypes->isNotEmpty())
        <div>
            <div style="margin-bottom: 1.75rem;">
                <span style="color: #169F81; font-weight: 700; text-transform: uppercase; font-size: 0.85rem;">Tipe Properti Usaha &amp; Hunian</span>
                <h3 style="color: #0A2E78; font-size: 1.8rem; font-weight: 800; margin-top: 0.2rem;">Solusi Berdasarkan Jenis Bangunan</h3>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1.25rem;">
                @foreach($propertyTypes as $prop)
                    <a href="{{ route('property.show', $prop->slug) }}" style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 14px; padding: 1.25rem; color: #0A2E78; text-decoration: none; display: flex; align-items: center; gap: 0.85rem;" class="hover:border-[#169F81] hover:shadow-md">
                        <span style="font-size: 2rem;">{{ $prop->icon }}</span>
                        <div>
                            <div style="font-weight: 800; font-size: 1rem;">{{ $prop->name }}</div>
                            <div style="font-size: 0.8rem; color: #64748B;">Respon 30-90 Menit</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>

<!-- Emergency CTA Banner -->
<section style="background: linear-gradient(135deg, #0A2E78, #0D3A94); color: #ffffff; padding: 4.5rem 1.5rem; text-align: center;">
    <div style="max-width: 800px; margin: 0 auto;">
        <h2 style="font-size: 2.2rem; font-weight: 800; margin-bottom: 1rem;">Kota Anda Belum Terdaftar atau Butuh Panggilan Darurat?</h2>
        <p style="font-size: 1.1rem; color: rgba(255,255,255,0.85); margin-bottom: 2.25rem; line-height: 1.6;">Tim teknisi Rootera Plumbing (J&amp;J Group) siap meluncur 24 Jam nonstop ke lokasi tempat tinggal &amp; usaha Anda.</p>
        
        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya ingin menanyakan jangkauan teknisi pipa mampet untuk lokasi saya.') }}" target="_blank" class="btn" style="background: #25D366; color: #ffffff; font-size: 1.15rem; font-weight: 700; padding: 1.1rem 2.5rem; border-radius: 50px; text-decoration: none; box-shadow: 0 10px 30px rgba(37, 211, 102, 0.3);">
            Hubungi Customer Service WhatsApp (24 Jam)
        </a>
    </div>
</section>

<!-- Vanilla JS Real-Time Search Filter -->
<script>
function filterDirectory() {
    const input = document.getElementById('directorySearchInput');
    const filter = input.value.toLowerCase().trim();
    const items = document.querySelectorAll('.city-search-item');
    const provinceBlocks = document.querySelectorAll('.province-card-block');
    let visibleCount = 0;

    items.forEach(item => {
        const cityName = item.getAttribute('data-city-name') || '';
        const districts = item.getAttribute('data-districts') || '';

        if (cityName.includes(filter) || districts.includes(filter)) {
            item.style.display = 'block';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });

    provinceBlocks.forEach(block => {
        const visibleItems = block.querySelectorAll('.city-search-item[style*="display: block"]');
        if (visibleItems.length === 0 && filter !== '') {
            block.style.display = 'none';
        } else {
            block.style.display = 'block';
        }
    });

    const counter = document.getElementById('searchCounter');
    if (filter !== '') {
        counter.textContent = `Menampilkan ${visibleCount} hasil pencarian untuk "${filter}"`;
    } else {
        counter.textContent = '';
    }
}
</script>
@endsection
