{{-- 
  Komponen Smart Interlinking Hub (Smart Service Matrix Switcher, Neighborhood District Mesh with ETA, & B2B Cross-Link)
  Style: Luxury, Modern, High-Trust (Deep Navy #0B192C, Emerald #10B981)
--}}
@props([
    'category' => null,
    'city' => null,
    'district' => null,
    'siblingDistricts' => null,
    'allCategories' => null,
    'locationShort' => 'Wilayah Terkait'
])

<?php
$currentCatSlug = is_object($category) && isset($category->slug) ? $category->slug : 'pipa-mampet';
$citySlug = is_object($city) && isset($city->slug) ? $city->slug : 'jakarta-selatan';
$districtSlug = is_object($district) && isset($district->slug) ? $district->slug : null;
$locShort = $locationShort ?? (is_object($district) ? $district->name : (is_object($city) ? $city->name : 'Wilayah Terkait'));

// Standard 6 Core Service Categories Mapping
$coreServices = [
    ['name' => 'Jasa Pipa Mampet', 'slug' => 'pipa-mampet', 'icon' => '🔧', 'desc' => 'Pelancaran pipa utama mampet'],
    ['name' => 'Wastafel Mampet', 'slug' => 'wastafel-mampet', 'icon' => '🥣', 'desc' => 'Bak cuci piring berlemak'],
    ['name' => 'Kamar Mandi Mampet', 'slug' => 'kamar-mandi-mampet', 'icon' => '🚿', 'desc' => 'Floor drain & rontokan rambut'],
    ['name' => 'WC / Kloset Mampet', 'slug' => 'wc-toilet-mampet', 'icon' => '🚽', 'desc' => 'Kloset duduk/jongkok meluap'],
    ['name' => 'Got & Pembuangan', 'slug' => 'got-saluran-pembuangan', 'icon' => '🌧️', 'desc' => 'Got rumah & talang hujan'],
    ['name' => 'Inspeksi Kamera CCTV', 'slug' => 'inspeksi-pipa-kamera', 'icon' => '📷', 'desc' => 'Deteksi visual titik pecah'],
];

// Fallback ETA calculation generator for sibling districts
$etaOptions = ['15-25 Menit', '20-30 Menit', '25-35 Menit', '30-40 Menit'];
?>

<div id="smart-interlinking-hub">
    
    <!-- 1. Smart Service Matrix Switcher (Pindah Layanan di Area yang Sama) -->
    <section style="background: #ffffff; padding: 4.5rem 1.5rem; border-top: 1px solid #E2E8F0;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 3rem;">
                <span style="color: #10B981; font-weight: 800; text-transform: uppercase; font-size: 0.85rem; tracking-wider">Pilihan Layanan Terkait</span>
                <h2 style="color: #0B192C; font-size: clamp(1.8rem, 3.5vw, 2.4rem); font-weight: 800; margin-top: 0.4rem;">
                    Solusi Plumbing Lainnya di Area {{ $locShort }}
                </h2>
                <p style="color: #64748B; font-size: 0.98rem; max-width: 700px; margin: 0.5rem auto 0;">
                    Pilih kategori layanan khusus lainnya yang Anda butuhkan di lokasi <strong>{{ $locShort }}</strong>:
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.25rem;">
                @foreach($coreServices as $index => $srv)
                <?php
                    $isActive = ($srv['slug'] === $currentCatSlug);
                    $targetUrl = url('/layanan-pipa-mampet/' . $srv['slug'] . '/' . $citySlug . ($districtSlug ? '/' . $districtSlug : ''));
                ?>
                <a href="{{ $targetUrl }}" style="background: {{ $isActive ? 'linear-gradient(135deg, #0B192C 0%, #1E3E62 100%)' : '#F8FAFC' }}; color: {{ $isActive ? '#ffffff' : '#0B192C' }}; border: 1px solid {{ $isActive ? '#10B981' : '#E2E8F0' }}; border-radius: 16px; padding: 1.35rem; text-decoration: none; display: block; box-shadow: {{ $isActive ? '0 10px 25px rgba(11,25,44,0.15)' : '0 2px 8px rgba(0,0,0,0.02)' }}; transition: all 0.25s ease;" class="hover:-translate-y-1.5 hover:shadow-lg hover:border-emerald-400">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem;">
                        <span style="font-size: 2rem;">{{ $srv['icon'] }}</span>
                        @if($isActive)
                            <span style="background: #10B981; color: #ffffff; font-size: 0.7rem; font-weight: 800; padding: 0.2rem 0.6rem; border-radius: 50px; text-transform: uppercase;">Aktif Dibuka</span>
                        @else
                            <span style="color: #10B981; font-size: 0.85rem; font-weight: 700;">Lihat Route →</span>
                        @endif
                    </div>
                    <h3 style="font-size: 1.1rem; font-weight: 800; color: {{ $isActive ? '#ffffff' : '#0B192C' }}; margin-bottom: 0.3rem;">
                        {{ $srv['name'] }} {{ $locShort }}
                    </h3>
                    <p style="font-size: 0.85rem; color: {{ $isActive ? 'rgba(255,255,255,0.8)' : '#64748B' }}; line-height: 1.4;">
                        {{ $srv['desc'] }}
                    </p>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 2. Neighborhood District Mesh (Kecamatan / Wilayah Sekitar dengan Badge ETA) -->
    @if(isset($siblingDistricts) && is_iterable($siblingDistricts) && count($siblingDistricts) > 0)
    <section style="background: #F8FAFC; padding: 4.5rem 1.5rem; border-top: 1px solid #E2E8F0; border-bottom: 1px solid #E2E8F0;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="margin-bottom: 2.25rem;">
                <div style="display: inline-flex; align-items: center; gap: 0.5rem; color: #059669; font-weight: 800; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em;">
                    <span>📍 Jangkauan Presisi Sekitar</span>
                </div>
                <h3 style="color: #0B192C; font-size: 1.8rem; font-weight: 800; margin-top: 0.4rem;">
                    Teknisi Kami Juga Menjangkau Area Sekitar {{ $locShort }}
                </h3>
                <p style="color: #64748B; font-size: 0.95rem;">
                    Pos responder terdekat siap siaga meluncur ke lokasi Anda dengan jaminan estimasi waktu tempuh (ETA) efisien:
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1rem;">
                @foreach($siblingDistricts as $idx => $sib)
                <?php
                    $sibName = is_object($sib) ? $sib->name : $sib['name'];
                    $sibSlug = is_object($sib) ? $sib->slug : $sib['slug'];
                    $eta = is_object($sib) && !empty($sib->estimated_arrival) ? $sib->estimated_arrival : $etaOptions[$idx % count($etaOptions)];
                    $targetUrl = url('/layanan-pipa-mampet/' . $currentCatSlug . '/' . $citySlug . '/' . $sibSlug);
                ?>
                <a href="{{ $targetUrl }}" style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 14px; padding: 0.9rem 1.1rem; text-decoration: none; color: #0B192C; font-weight: 700; font-size: 0.92rem; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 6px rgba(0,0,0,0.02); transition: all 0.2s ease;" class="hover:border-emerald-500 hover:text-emerald-600 hover:-translate-y-1">
                    <div style="display: flex; flex-direction: column;">
                        <span>📍 {{ $sibName }}</span>
                        <span style="font-size: 0.75rem; color: #059669; font-weight: 600;">⏱️ Response ~ {{ $eta }}</span>
                    </div>
                    <span style="color: #10B981; font-weight: 800; font-size: 0.9rem;">→</span>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- 3. Cross-Link ke Sektor B2B & Properti (Luxury Banner Card) -->
    <section style="padding: 4.5rem 1.5rem; background: #ffffff;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="background: linear-gradient(135deg, #0B192C 0%, #1E3E62 100%); color: #ffffff; border: 1px solid rgba(16, 185, 129, 0.4); border-radius: 24px; padding: 3rem 2rem; position: relative; overflow: hidden; box-shadow: 0 20px 40px rgba(11, 25, 44, 0.2);">
                
                <div style="position: absolute; top: -50px; right: -50px; width: 250px; height: 250px; border-radius: 50%; background: radial-gradient(circle, rgba(16, 185, 129, 0.2) 0%, rgba(11, 25, 44, 0) 70%); pointer-events: none;"></div>

                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 2rem; position: relative; z-index: 2;">
                    <div style="max-width: 720px;">
                        <span style="background: rgba(16, 185, 129, 0.2); color: #34D399; border: 1px solid rgba(16, 185, 129, 0.4); padding: 0.35rem 1.1rem; border-radius: 50px; font-size: 0.82rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em;">
                            🏢 Layanan Komersial, B2B &amp; Properti
                        </span>
                        <h2 style="font-size: clamp(1.6rem, 3vw, 2.2rem); font-weight: 800; color: #ffffff; margin: 0.8rem 0 0.5rem; line-height: 1.3;">
                            Membutuhkan Penanganan Skala Gedung, Restoran, atau Pabrik di {{ $locShort }}?
                        </h2>
                        <p style="color: rgba(255, 255, 255, 0.8); font-size: 1rem; line-height: 1.6;">
                            Divisi B2B Rootera (PT/CV J&amp;J Group) menyediakan layanan Hydro-Jetting skala besar, kontrak preventive maintenance bulanan, SLA respon cepat, serta Faktur Pajak PPN resmi.
                        </p>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 0.85rem; width: 100%; max-width: 300px;">
                        <a href="{{ url('/sektor-plumbing/restoran-cafe/' . $citySlug) }}" class="btn" style="background: #10B981; color: #ffffff; font-weight: 800; padding: 0.95rem 1.5rem; border-radius: 50px; text-decoration: none; text-align: center; font-size: 0.95rem; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);">
                            🍽️ Jasa Sektor Restoran &amp; F&amp;B
                        </a>
                        <a href="{{ url('/sektor-plumbing/hotel-apartemen/' . $citySlug) }}" class="btn" style="background: rgba(255,255,255,0.1); color: #ffffff; border: 1px solid rgba(255,255,255,0.25); font-weight: 700; padding: 0.85rem 1.5rem; border-radius: 50px; text-decoration: none; text-align: center; font-size: 0.9rem; backdrop-filter: blur(10px);">
                            🏨 Sektor Hotel &amp; Apartemen
                        </a>
                        <a href="{{ url('/layanan-b2b-komersial') }}" style="color: #38BDF8; font-size: 0.85rem; font-weight: 700; text-align: center; text-decoration: underline;">
                            Lihat Semua Sektor B2B Komersial →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Reverse Silo Hierarchy Card (PageRank Booster to City Pillar & Homepage) -->
    <section style="background: #F1F5F9; padding: 2.5rem 1.5rem; border-top: 1px solid #CBD5E1;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="background: #ffffff; border: 1px solid #CBD5E1; border-radius: 20px; padding: 1.75rem 2rem; box-shadow: 0 4px 15px rgba(0,0,0,0.03);">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1.25rem;">
                    <div>
                        <span style="font-size: 0.75rem; font-weight: 800; color: #059669; text-transform: uppercase; letter-spacing: 0.05em;">Pusat Layanan Wilayah</span>
                        <h4 style="font-size: 1.15rem; font-weight: 800; color: #0F172A; margin: 0.25rem 0 0;">
                            Spesialis Saluran Air Mampet di {{ $locShort }}
                        </h4>
                    </div>
                    
                    <div style="display: flex; flex-wrap: wrap; gap: 0.85rem; align-items: center;">
                        {{-- 1. Reverse Link ke Halaman Pilar Kota (Exact Match Anchor Target) --}}
                        @if(isset($city) && is_object($city))
                        <a href="{{ url('/jasa-saluran-mampet/' . $city->slug) }}" style="background: #0F172A; color: #ffffff; padding: 0.7rem 1.35rem; border-radius: 12px; font-weight: 700; font-size: 0.88rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem;" class="hover:bg-emerald-600 transition">
                            <span>🏢 Hub Utama: Jasa Saluran Mampet {{ $city->name }}</span>
                            <span>→</span>
                        </a>
                        @endif

                        {{-- 2. Reverse Link ke Homepage (Short-Tail Target Booster) --}}
                        <a href="{{ url('/') }}" style="background: #10B981; color: #ffffff; padding: 0.7rem 1.35rem; border-radius: 12px; font-weight: 800; font-size: 0.88rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem;" class="hover:bg-emerald-600 transition">
                            <span>🏠 Beranda Jasa Saluran Mampet Indonesia</span>
                            <span>→</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
