{{-- 
  Komponen Media Dokumentasi Lapangan & Video Knowledge Showcase
  Style: Luxury, Modern, High-Trust (Deep Navy #0B192C, Emerald #10B981)
--}}
@props([
    'projectShowcases' => null,
    'relatedArticles' => null,
    'locationName' => 'Jabodetabek',
    'locationShort' => 'Area Terkait'
])

<?php
$locName = $locationName ?? $locationShort ?? 'Jabodetabek';
$locShort = $locationShort ?? 'Wilayah Terkait';

// Curated Fallback Showcases for Before-After Photos
$fallbackShowcases = [
    [
        'title' => 'Pelancaran Pipa Wastafel Restoran & Kitchen Dapur',
        'category' => 'Wastafel & Sink',
        'before_img' => asset('images/was-mampet.jpg'),
        'after_img' => asset('images/JnJ.webp'),
        'issue' => 'Gumpalan Lemak Keras & Kerak Beku 5 Meter',
        'tool' => 'High-Pressure Hydro Jet 250 Bar & Ridgid K-50',
        'time' => '35 Menit - Tanpa Bongkar Lantai',
        'client_type' => 'Komersial Resto',
    ],
    [
        'title' => 'Pembersihan Floor Drain Kamar Mandi & Kerak Sabun',
        'category' => 'Kamar Mandi',
        'before_img' => asset('images/wc-mampet.jpg'),
        'after_img' => asset('images/JnJ.webp'),
        'issue' => 'Rontokan Rambut, Kerak Sabun & Endapan Kapur',
        'tool' => 'Mesin Spiral Flexible Rotary Cables Ridgid',
        'time' => '25 Menit - Bergaransi Tuntas 100%',
        'client_type' => 'Rumah Tangga',
    ],
    [
        'title' => 'Evakuasi Kloset WC Meluap & Inspeksi Pipa CCTV',
        'category' => 'WC / Kloset',
        'before_img' => asset('images/wastafel-mampet.jpg'),
        'after_img' => asset('images/JnJ.webp'),
        'issue' => 'Sumbatan Benda Asing & Leher Angsa Meluap',
        'tool' => 'Kamera Inspeksi CCTV & Heavy Duty Spiral',
        'time' => '40 Menit - Steril Bebas Bau',
        'client_type' => 'Hunian Apartemen',
    ]
];

$itemsToDisplay = (isset($projectShowcases) && is_iterable($projectShowcases) && count($projectShowcases) > 0)
    ? $projectShowcases
    : $fallbackShowcases;

// Fallback Video / Article Cards if $relatedArticles is empty
$fallbackArticles = [
    [
        'title' => 'Cara Mengatasi Wastafel Mampet Akibat Lemak Membeku',
        'slug' => 'cara-mengatasi-bak-cuci-piring-mampet-akibat-lemak-membeku',
        'category' => 'Wastafel & Sink',
        'thumbnail' => asset('images/was-mampet.jpg'),
        'duration' => '0:45 Sec',
        'youtube_id' => '5O63iR_8NIs'
    ],
    [
        'title' => 'Solusi Saluran Pembuangan Kamar Mandi Mampet Tanpa Bongkar',
        'slug' => 'solusi-saluran-pembuangan-kamar-mandi-mampet-tanpa-bongkar-lantai',
        'category' => 'Floor Drain',
        'thumbnail' => asset('images/wc-mampet.jpg'),
        'duration' => '1:12 Min',
        'youtube_id' => '5O63iR_8NIs'
    ],
    [
        'title' => 'Manfaat Inspection Camera (CCTV Pipe) untuk Deteksi Kebocoran Pipa',
        'slug' => 'manfaat-inspection-camera-cctv-pipe-untuk-deteksi-kebocoran-pipa',
        'category' => 'Inspeksi CCTV',
        'thumbnail' => asset('images/JnJ.webp'),
        'duration' => '0:55 Sec',
        'youtube_id' => '5O63iR_8NIs'
    ]
];

$articlesToDisplay = (isset($relatedArticles) && is_iterable($relatedArticles) && count($relatedArticles) > 0)
    ? $relatedArticles
    : $fallbackArticles;
?>

<!-- Section 1: Interactive Before-After Photo Showcase -->
<section style="background: linear-gradient(180deg, #F8FAFC 0%, #EFF6FF 100%); padding: 4.5rem 1.5rem; border-top: 1px solid #E2E8F0; border-bottom: 1px solid #E2E8F0;" id="dokumentasi-lapangan">
    <div style="max-width: 1200px; margin: 0 auto;">
        
        <!-- Section Header -->
        <div style="text-align: center; margin-bottom: 3.5rem;">
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #059669; padding: 0.4rem 1.2rem; border-radius: 50px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.75rem;">
                <span style="display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: #10B981; box-shadow: 0 0 10px #10B981;"></span>
                Dokumentasi Pengerjaan Nyata Lapangan
            </div>
            <h2 style="color: #0B192C; font-size: clamp(1.8rem, 3.5vw, 2.5rem); font-weight: 800; margin-top: 0.4rem; letter-spacing: -0.02em;">
                Bukti Hasil Kerja Perbaikan Saluran di {{ $locShort }}
            </h2>
            <p style="color: #64748B; max-width: 760px; margin: 0.6rem auto 0; font-size: 1.05rem; line-height: 1.6;">
                Bukti fisik kualitas penanganan tim teknisi Rootera (J&amp;J Group) menggunakan alat mekanis rotary spiral &amp; Hydro Jetting modern tanpa membongkar keramik.
            </p>
        </div>

        <!-- Before-After Showcase Cards Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem;">
            @foreach($itemsToDisplay as $index => $item)
            <?php
                $title = is_object($item) ? $item->title : $item['title'];
                $issue = is_object($item) ? ($item->description ?? $item->title) : $item['issue'];
                $tool = is_object($item) ? ($item->equipment_used ?? 'Mesin Spiral Ridgid & Hydro Jetting') : $item['tool'];
                $time = is_object($item) ? ($item->completion_time ?? '30-45 Menit') : $item['time'];
                $clientType = is_object($item) ? ($item->client_type ?? 'Proyek Terverifikasi') : $item['client_type'];
                $beforeImg = is_object($item) ? ($item->before_image_url ?? asset('images/was-mampet.jpg')) : $item['before_img'];
                $afterImg = is_object($item) ? ($item->after_image_url ?? asset('images/JnJ.webp')) : $item['after_img'];
            ?>
            <div style="background: #ffffff; border-radius: 20px; border: 1px solid #E2E8F0; overflow: hidden; box-shadow: 0 10px 30px rgba(11, 25, 44, 0.05); transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s ease;" class="hover:-translate-y-1.5 hover:shadow-2xl hover:border-emerald-400/40 group">
                
                <!-- Dual Image Split / Before vs After -->
                <div style="position: relative; height: 220px; background: #0B192C; overflow: hidden; display: flex;">
                    
                    <!-- Before Section -->
                    <div style="position: relative; width: 50%; height: 100%; border-right: 2px solid #ffffff; overflow: hidden;">
                        <img src="{{ $beforeImg }}" alt="Sebelum Pengerjaan Rootera di {{ $locShort }}" style="width: 100%; height: 100%; object-fit: cover; filter: brightness(0.85);" loading="lazy" decoding="async">
                        <span style="position: absolute; top: 10px; left: 10px; background: rgba(225, 29, 72, 0.95); color: #ffffff; font-size: 0.72rem; font-weight: 800; padding: 0.25rem 0.65rem; border-radius: 50px; text-transform: uppercase; backdrop-filter: blur(4px);">
                            ⚠️ SEBELUM
                        </span>
                    </div>

                    <!-- After Section -->
                    <div style="position: relative; width: 50%; height: 100%; overflow: hidden;">
                        <img src="{{ $afterImg }}" alt="Hasil Pengerjaan Rootera di {{ $locShort }}" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy" decoding="async">
                        <span style="position: absolute; top: 10px; right: 10px; background: rgba(16, 185, 129, 0.95); color: #ffffff; font-size: 0.72rem; font-weight: 800; padding: 0.25rem 0.65rem; border-radius: 50px; text-transform: uppercase; backdrop-filter: blur(4px);">
                            ✓ SESUDAH (100% LANCAR)
                        </span>
                    </div>

                    <!-- Client Type Floating Badge -->
                    <div style="position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%); background: rgba(11, 25, 44, 0.85); color: #38BDF8; border: 1px solid rgba(56, 189, 248, 0.4); font-size: 0.75rem; font-weight: 700; padding: 0.25rem 0.85rem; border-radius: 50px; backdrop-filter: blur(6px); white-space: nowrap;">
                        🏷️ {{ $clientType }}
                    </div>
                </div>

                <!-- Showcase Metadata Details -->
                <div style="padding: 1.5rem;">
                    <h3 style="font-size: 1.15rem; font-weight: 800; color: #0B192C; margin-bottom: 0.75rem; line-height: 1.4;">
                        {{ $title }}
                    </h3>

                    <div style="display: flex; flex-direction: column; gap: 0.5rem; font-size: 0.88rem; color: #475569; margin-bottom: 1.25rem; background: #F8FAFC; padding: 0.85rem 1rem; border-radius: 12px; border: 1px solid #F1F5F9;">
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span style="color: #EF4444; font-weight: 700;">📌 Masalah:</span>
                            <span style="font-weight: 600; color: #1E293B;">{{ $issue }}</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span style="color: #0284C7; font-weight: 700;">🛠️ Alat Digunakan:</span>
                            <span style="font-weight: 600; color: #1E293B;">{{ $tool }}</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span style="color: #059669; font-weight: 700;">⏱️ Waktu Pengerjaan:</span>
                            <span style="font-weight: 600; color: #10B981;">{{ $time }}</span>
                        </div>
                    </div>

                    <!-- Location Footer -->
                    <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #F1F5F9; padding-top: 0.85rem; font-size: 0.82rem; color: #64748B;">
                        <span style="display: inline-flex; align-items: center; gap: 0.3rem; font-weight: 700; color: #0B192C;">
                            📍 Area {{ $locName }}
                        </span>
                        <span style="color: #10B981; font-weight: 800; display: inline-flex; align-items: center; gap: 0.25rem;">
                            ✓ Garansi Resmi 30 Hari
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Section 2: Video Reels & Knowledge Guide Showcase (Interactive Blog Card Integration) -->
<section style="background: #0B192C; color: #ffffff; padding: 4.5rem 1.5rem; position: relative; overflow: hidden;" id="video-dokumentasi">
    <div style="position: absolute; top: -100px; right: -100px; width: 350px; height: 350px; border-radius: 50%; background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, rgba(11, 25, 44, 0) 70%); pointer-events: none;"></div>
    
    <div style="max-width: 1200px; margin: 0 auto; position: relative; z-index: 2;">
        
        <!-- Header Video Showcase -->
        <div style="display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 1.5rem; margin-bottom: 3rem;">
            <div>
                <span style="background: rgba(16, 185, 129, 0.15); color: #34D399; border: 1px solid rgba(16, 185, 129, 0.3); padding: 0.35rem 1.1rem; border-radius: 50px; font-size: 0.82rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em;">
                    🎬 Video Rekaman Lapangan (Bukti Nyata)
                </span>
                <h2 style="font-size: clamp(1.8rem, 3.5vw, 2.4rem); font-weight: 800; color: #ffffff; margin-top: 0.6rem;">
                    Lihat Aksi Teknisi Rootera Melancarkan Pipa
                </h2>
                <p style="color: rgba(255, 255, 255, 0.75); max-width: 650px; margin-top: 0.4rem; font-size: 0.98rem; line-height: 1.6;">
                    Video penanganan pengerjaan pipa tersumbat lemak beku &amp; kerak menggunakan mesin fleksibel Ridgid &amp; Hydro Jetting di area {{ $locShort }}.
                </p>
            </div>
            <div>
                <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya ingin pesan layanan pipa mampet untuk area ' . $locName) }}" target="_blank" class="btn" style="background: #10B981; color: #ffffff; font-weight: 800; padding: 0.85rem 1.8rem; border-radius: 50px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);">
                    📞 Panggil Teknisi Sekarang (24 Jam)
                </a>
            </div>
        </div>

        <!-- Interactive Video Cards Grid (Linked to Blog Detail Articles) -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.75rem;">
            @foreach($articlesToDisplay as $artIdx => $art)
            <?php
                $artTitle = is_object($art) ? $art->title : $art['title'];
                $artSlug = is_object($art) ? $art->slug : $art['slug'];
                $artCategory = is_object($art) ? ($art->category ?? 'Edukasi Plumbing') : ($art['category'] ?? 'Edukasi Plumbing');
                $artUrl = route('blog.show', $artSlug);
                
                // Secure Thumbnail Resolver with Fallbacks
                if (is_object($art)) {
                    $artThumb = $art->thumbnail_url ?: asset('images/JnJ.webp');
                } else {
                    $artThumb = $art['thumbnail'] ?? asset('images/JnJ.webp');
                }

                $badgeColors = ['#10B981', '#38BDF8', '#F59E0B'];
                $badgeColor = $badgeColors[$artIdx % count($badgeColors)];
            ?>
            <a href="{{ $artUrl }}" style="display: block; text-decoration: none; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 20px; overflow: hidden; backdrop-filter: blur(10px); transition: all 0.3s ease;" class="hover:-translate-y-2 hover:border-emerald-500/50 hover:shadow-2xl group">
                <div style="position: relative; height: 240px; background: #1E3E62; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                    <!-- Zooming Thumbnail Cover Image -->
                    <img src="{{ $artThumb }}" alt="{{ $artTitle }}" style="width: 100%; height: 100%; object-fit: cover; opacity: 0.8; transition: transform 0.5s ease;" class="group-hover:scale-105" loading="lazy" decoding="async">
                    
                    <!-- Play Button Overlay with Hover Scale -->
                    <div style="position: absolute; width: 60px; height: 60px; border-radius: 50%; background: #10B981; color: #ffffff; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 25px rgba(16, 185, 129, 0.8); transition: transform 0.3s ease;" class="group-hover:scale-110">
                        <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                    </div>

                    <!-- Category Badge -->
                    <span style="position: absolute; top: 12px; right: 12px; background: {{ $badgeColor }}; color: #ffffff; font-size: 0.7rem; font-weight: 800; padding: 0.25rem 0.75rem; border-radius: 50px; text-transform: uppercase;">
                        {{ $artCategory }}
                    </span>

                    <span style="position: absolute; bottom: 12px; left: 12px; background: rgba(11, 25, 44, 0.85); color: #ffffff; font-size: 0.75rem; font-weight: 700; padding: 0.25rem 0.65rem; border-radius: 6px; backdrop-filter: blur(4px);">
                        📖 Baca &amp; Tonton Panduan →
                    </span>
                </div>
                <div style="padding: 1.35rem;">
                    <span style="color: #34D399; font-size: 0.78rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em;">Panduan Teknisi Rootera</span>
                    <h3 style="font-size: 1.05rem; font-weight: 800; color: #ffffff; margin: 0.4rem 0 0.4rem; line-height: 1.4;" class="group-hover:text-emerald-400 transition">
                        {{ $artTitle }}
                    </h3>
                    <p style="color: rgba(255,255,255,0.7); font-size: 0.85rem; line-height: 1.5; margin: 0;">
                        Klik untuk melihat panduan teknis lengkap &amp; rekaman video penanganan pipa mampet di lapangan.
                    </p>
                </div>
            </a>
            @endforeach
        </div>

        <!-- 2. PENAMBAHAN TOMBOL CTA ARTIKEL / VIDEO LENGKAP -->
        <div style="text-align: center; margin-top: 3.5rem;">
            <a href="{{ route('blog') }}" class="btn" style="display: inline-flex; align-items: center; gap: 0.6rem; border: 1.5px solid rgba(16, 185, 129, 0.6); color: #34D399; background: rgba(16, 185, 129, 0.08); padding: 0.9rem 2.2rem; border-radius: 50px; font-weight: 800; font-size: 0.98rem; text-decoration: none; backdrop-filter: blur(8px); box-shadow: 0 10px 25px rgba(0,0,0,0.2); transition: all 0.3s ease;" class="hover:bg-emerald-500 hover:text-white hover:border-emerald-500 hover:scale-105">
                <span>Lihat Semua Video &amp; Panduan Pengetahuan Lengkap →</span>
            </a>
        </div>

    </div>
</section>
