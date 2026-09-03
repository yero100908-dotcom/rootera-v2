<section style="padding: 5rem 0; background: #0f172a; color: #ffffff;" id="layanan" aria-labelledby="layanan-heading" class="relative overflow-hidden">
    {{-- Background Glow --}}
    <div style="position: absolute; top: 0; right: 0; width: 400px; height: 400px; background: radial-gradient(circle, rgba(16, 185, 129, 0.08) 0%, transparent 70%); pointer-events: none;"></div>

    <div class="container relative z-10">
        
        {{-- SECTION HEADER --}}
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #10b981; padding: 0.35rem 1rem; border-radius: 9999px; font-size: 0.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block; margin-bottom: 1rem;">
                🛠️ SOLUSI SPESIALIS PIPA TANPA BONGKAR
            </span>
            <h2 class="section-title" id="layanan-heading" style="font-size: clamp(1.8rem, 3.5vw, 2.5rem); font-weight: 800; color: #ffffff; margin-bottom: 0.75rem;">
                Katalog Layanan <span style="background: linear-gradient(90deg, #10b981, #06b6d4); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Rootera Plumbing</span>
            </h2>
            <p style="color: #94a3b8; font-size: 1.02rem; line-height: 1.6; margin: 0;">
                Penanganan cepat pipa tersumbat menggunakan <strong>Mesin Spiral Drain Cleaner Modern</strong> &amp; <strong>Kamera CCTV Inspeksi Digital</strong> untuk rumah tangga, restoran, kantor, dan fasilitas publik.
            </p>
        </div>

        {{-- INTERACTIVE CARDS GRID / MOBILE HORIZONTAL SCROLL CAROUSEL --}}
        <div class="flex overflow-x-auto snap-x snap-mandatory gap-6 pb-6 no-scrollbar md:grid md:grid-cols-2 lg:grid-cols-3 md:pb-0">
            @php
                $serviceItems = [
                    [
                        'icon' => '🚰',
                        'title' => 'Wastafel & Kitchen Sink',
                        'badge' => '⚡ Paling Sering Tersumbat',
                        'desc' => 'Pembersihan endapan lemak padat, sisa minyak makanan, & saringan berkerak pada bak cuci piring dapur.',
                        'tags' => ['Mesin Drain Cleaner', 'Spiral Rotary K-50', 'Bebas Bau'],
                        'url' => '/layanan/wastafel-mampet',
                        'image' => 'assets/services/wastafel-rooteraplumbing.jpg',
                    ],
                    [
                        'icon' => '🚽',
                        'title' => 'Kloset & Toilet Meluap',
                        'badge' => '🛡️ Garansi 30 Hari',
                        'desc' => 'Pelancaran WC tersumbat benda asing, tisu padat, atau leher angsa mampet tanpa membongkar porselen.',
                        'tags' => ['Spiral Steel Auger', 'Higienis K3', 'Tanpa Bongkar'],
                        'url' => '/layanan/wc-toilet-mampet',
                        'image' => 'assets/services/kloset-rootera-plumbing.jpg',
                    ],
                    [
                        'icon' => '🚿',
                        'title' => 'Floor Drain Kamar Mandi',
                        'badge' => '💧 Bebas Genangan',
                        'desc' => 'Pembersihan tumpukan rontokan rambut, sisa sabun membeku, & pasir yang membuat air kamar mandi meluap.',
                        'tags' => ['Mesin Ridgid Rotary', 'Pipa PVC Safe', 'Lancar Total'],
                        'url' => '/layanan/kamar-mandi-mampet',
                        'image' => 'assets/services/floor-drain-kamarmandi-rooteraplumbing.jpg',
                    ],
                    [
                        'icon' => '🚰',
                        'title' => 'Cuci Toren & Kuras Tandon Air',
                        'badge' => '✨ Perawatan Higienis',
                        'desc' => 'Pembersihan kerak lumut membandel, endapan lumpur, dan sterilisasi tangki air bersih rumah tangga & komersial tanpa bahan kimia berbahaya.',
                        'tags' => ['High-Pressure Jet Cleaner', '100% Bebas Kimia Korosif', 'Cek Pelampung Otomatis', 'Air Bersih & Higienis'],
                        'url' => route('services.cuci-toren'),
                        'direct_link' => true,
                        'image' => 'assets/services/saluran-komersial-mall-industri-pabrik-perkantoran-gedung-rootera-plumbing.jpg',
                    ],
                    [
                        'icon' => '🌊',
                        'title' => 'Hydro-Jetting Pelengkap B2B',
                        'badge' => '🔥 Kerak Lemak Ekstrem',
                        'desc' => 'Metode pelengkap semprotan air bertekanan 300 Bar untuk pembilas jaringan pipa restoran & pabrik skala besar.',
                        'tags' => ['Tekanan 300 Bar', 'Pipa Resto & Pabrik', 'Pembersih Kerak'],
                        'url' => '/layanan-b2b-komersial',
                        'image' => 'assets/services/instalasi-saluran-pipa-area-komersial-industri-mall-perkantoran-gedung-rooteraplumbing.jpg',
                    ],
                    [
                        'icon' => '🏬',
                        'title' => 'Got Utama & Bak Kontrol',
                        'badge' => '🧱 Pengurasan Sedimen',
                        'desc' => 'Pembersihan got luar, bak penampungan, & pipa pembuangan utama perumahan agar air lancar saat hujan deras.',
                        'tags' => ['Ridgid Heavy Duty', 'Got Perumahan', 'Bebas Banjir'],
                        'url' => '/layanan/got-saluran-pembuangan',
                        'image' => 'assets/services/saluran-pembuangan-got-rumahan-dan-industri-rootera-rooteraplumbing_.jpg',
                    ],
                    [
                        'icon' => '🎥',
                        'title' => 'Inspeksi Kamera CCTV Pipa',
                        'badge' => '🔍 Deteksi Presisi HD',
                        'desc' => 'Audit jaringan pipa vertikal/horisontal menggunakan kamera crawler 30M untuk melacak lokasi retakan & sumbatan.',
                        'tags' => ['CCTV 30M HD', 'Laporan Digital', 'Deteksi Presisi'],
                        'url' => '/tentang-kami',
                        'image' => 'images/dokumentasi/inspeksi-cctv-floor-drain-pertamina-sunter.webp',
                    ],
                ];
            @endphp

            @foreach($serviceItems as $item)
            <div style="background: rgba(30, 41, 59, 0.7); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1); backdrop-filter: blur(10px); display: flex; flex-direction: column;" class="w-[300px] sm:w-[340px] md:w-auto shrink-0 snap-start hover:border-emerald-500/50 hover:bg-slate-800/80 transition-all duration-300 group overflow-hidden">
                
                {{-- Card Image Banner --}}
                @if(isset($item['image']))
                <div class="relative h-40 sm:h-44 w-full bg-slate-900 overflow-hidden">
                    <img src="{{ asset($item['image']) }}" 
                         alt="{{ $item['title'] }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         loading="lazy"
                         onerror="this.onerror=null;this.src='{{ asset('images/JnJ.webp') }}';">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/30 to-transparent"></div>
                    <span style="position: absolute; top: 0.75rem; right: 0.75rem; background: rgba(15, 23, 42, 0.85); border: 1px solid rgba(16, 185, 129, 0.4); color: #2dd4bf; font-size: 0.72rem; font-weight: 800; padding: 0.3rem 0.75rem; border-radius: 9999px; backdrop-filter: blur(4px);">
                        {{ $item['badge'] }}
                    </span>
                    <div style="position: absolute; bottom: 0.75rem; left: 1rem; width: 44px; height: 44px; border-radius: 12px; background: rgba(16, 185, 129, 0.25); border: 1px solid rgba(16, 185, 129, 0.4); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; backdrop-filter: blur(4px);" class="group-hover:scale-110 transition-transform">
                        {{ $item['icon'] }}
                    </div>
                </div>
                @endif

                <div style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">

                <h3 style="font-size: 1.2rem; font-weight: 800; color: #ffffff; margin-bottom: 0.5rem;" class="group-hover:text-emerald-400 transition-colors">
                    {{ $item['title'] }}
                </h3>

                <p style="color: #94a3b8; font-size: 0.88rem; line-height: 1.6; margin-bottom: 1.25rem;">
                    {{ $item['desc'] }}
                </p>

                <div style="display: flex; flex-wrap: wrap; gap: 0.4rem; margin-bottom: 1.5rem; margin-top: auto;">
                    @foreach($item['tags'] as $tag)
                        <span style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255,255,255,0.1); color: #cbd5e1; font-size: 0.72rem; font-weight: 600; padding: 0.25rem 0.6rem; border-radius: 6px;">
                            ✓ {{ $tag }}
                        </span>
                    @endforeach
                </div>

                <div style="padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.1);">
                    @if(isset($item['direct_link']) && $item['direct_link'])
                        <a href="{{ $item['url'] }}" style="color: #06b6d4; font-weight: 800; font-size: 0.88rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem;" class="hover:text-cyan-300 min-h-[44px]">
                            <span>Lihat Layanan Cuci Toren →</span>
                        </a>
                    @else
                        <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya butuh jasa pelancaran: ' . $item['title']) }}" target="_blank" rel="noopener noreferrer" style="color: #10b981; font-weight: 800; font-size: 0.88rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem;" class="hover:text-emerald-300 min-h-[44px]">
                            <span>Panggil Teknisi untuk Masalah Ini →</span>
                        </a>
                    @endif
                </div>

            </div>
            @endforeach
        </div>

        {{-- CROSS-SELLING MINI HIGHLIGHT BANNER --}}
        <div class="mt-8 bg-slate-800/80 border border-slate-700/80 rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row items-center justify-between gap-4 backdrop-blur-md max-w-4xl mx-auto">
            <div class="flex items-center gap-3 text-left">
                <span class="text-2xl shrink-0">💡</span>
                <p class="text-xs sm:text-sm text-slate-300">
                    <strong class="text-white">Sekalian Perawatan Toren Air?</strong> Kami sediakan layanan kuras &amp; sterilisasi toren bertekanan tinggi saat teknisi standby di lokasi Anda.
                </p>
            </div>
            <a href="{{ route('services.cuci-toren') }}" class="shrink-0 bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold text-xs px-5 py-2.5 rounded-full transition-all hover:scale-105 min-h-[44px] flex items-center justify-center">
                Pelajari Jasa Cuci Toren →
            </a>
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('layanan') }}" style="background: linear-gradient(90deg, #10b981, #06b6d4); color: #ffffff; text-decoration: none; padding: 0.95rem 2.25rem; border-radius: 12px; font-weight: 800; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.5rem; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.25);" class="hover:scale-105 transition-all min-h-[48px]">
                Lihat Katalog Lengkap &amp; Estimasi Harga →
            </a>
        </div>

    </div>
</section>
