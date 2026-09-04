<section style="padding: 5.5rem 0; background: linear-gradient(180deg, #0b132b 0%, #061434 50%, #081b42 100%); color: #ffffff; position: relative; overflow: hidden;" id="area-jangkauan" aria-labelledby="area-heading">

    {{-- Subtle Ambient Glows --}}
    <div style="position: absolute; top: 0; left: 50%; transform: translateX(-50%); width: 800px; height: 350px; background: radial-gradient(circle, rgba(16, 185, 129, 0.12) 0%, rgba(6, 20, 52, 0) 70%); pointer-events: none;"></div>
    <div style="position: absolute; bottom: 0; right: -100px; width: 500px; height: 500px; background: radial-gradient(circle, rgba(6, 182, 212, 0.1) 0%, rgba(6, 20, 52, 0) 70%); pointer-events: none;"></div>

    <div class="container relative z-10">

        {{-- SECTION HEADER --}}
        <div class="text-center" style="max-width: 820px; margin: 0 auto 3.5rem;">
            
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(16, 185, 129, 0.12); border: 1px solid rgba(16, 185, 129, 0.35); color: #34d399; font-size: 0.8rem; font-weight: 800; padding: 0.4rem 1.2rem; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 1.25rem; backdrop-filter: blur(8px);">
                <span style="width: 7px; height: 7px; border-radius: 50%; background: #10b981; box-shadow: 0 0 10px #10b981;" class="animate-pulse"></span>
                📍 COVERAGE HUBS &amp; CABANG OPERASIONAL
            </div>

            <h2 id="area-heading" style="font-size: clamp(2rem, 4vw, 2.75rem); font-weight: 800; color: #ffffff; margin-bottom: 1rem; line-height: 1.2; letter-spacing: -0.02em;">
                Area Jangkauan Layanan Jasa Saluran Pipa Mampet <span style="background: linear-gradient(90deg, #34d399, #22d3ee, #38bdf8); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Rootera</span>
            </h2>

            <p style="color: rgba(255, 255, 255, 0.82); font-size: 1.05rem; line-height: 1.65; margin: 0 auto; max-width: 720px;">
                Teknisi profesional kami disiagakan di <strong>7 Hub Utama Nasional</strong> (Jabodetabek, Banten, Jawa Barat, Jawa Tengah, D.I. Yogyakarta, Jawa Timur, &amp; Sumatera/Lampung) siap datang cepat tanpa membongkar keramik.
            </p>

            {{-- Quick Stats Summary Pills --}}
            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 0.85rem; margin-top: 2rem;">
                <div style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.12); padding: 0.5rem 1rem; border-radius: 12px; font-size: 0.82rem; font-weight: 700; color: #e2e8f0; display: flex; align-items: center; gap: 0.4rem;">
                    <span>🏛️</span> 7 Hub Regional Utama
                </div>
                <div style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.12); padding: 0.5rem 1rem; border-radius: 12px; font-size: 0.82rem; font-weight: 700; color: #e2e8f0; display: flex; align-items: center; gap: 0.4rem;">
                    <span>📍</span> 150+ Kecamatan Tercover
                </div>
                <div style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(16, 185, 129, 0.25); padding: 0.5rem 1rem; border-radius: 12px; font-size: 0.82rem; font-weight: 700; color: #34d399; display: flex; align-items: center; gap: 0.4rem;">
                    <span>⏱️</span> Standby 24 Jam Nonstop
                </div>
                <div style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(6, 182, 212, 0.25); padding: 0.5rem 1rem; border-radius: 12px; font-size: 0.82rem; font-weight: 700; color: #38bdf8; display: flex; align-items: center; gap: 0.4rem;">
                    <span>🚚</span> Bebas Transportasi
                </div>
            </div>

        </div>

        @php
            $coverageHubs = [
                [
                    'province'    => 'DKI Jakarta',
                    'cities'      => 'Jakarta Pusat, Selatan, Barat, Timur, & Utara',
                    'status'      => 'Standby 24 Jam',
                    'badge_theme' => 'emerald',
                    'image'       => asset('assets/wilayah/jakarta/jasa-saluran-pipa-mampet-jakarta-indonesia-city-jakarta-rootera-plumbing-6.webp'),
                    'highlights'  => ['Menteng', 'Kebayoran', 'PIK', 'Kelapa Gading', 'Puri Indah', 'Sudirman'],
                    'service'     => 'Tim standby 24 jam untuk perumahan, apartemen, mall, resto, & perkantoran.',
                    'slug'        => 'jakarta-selatan',
                    'cta'         => 'Cabang DKI Jakarta'
                ],
                [
                    'province'    => 'Banten',
                    'cities'      => 'Tangerang Raya, Tangsel, BSD, Serang, Cilegon',
                    'status'      => 'Hub Aktif 24 Jam',
                    'badge_theme' => 'teal',
                    'image'       => asset('assets/wilayah/banten/jasa-saluran-pipa-mampet-kota-serang-banten-indonesia-wallpaper-aesthetics-banten-rootera-plumbing-4.webp'),
                    'highlights'  => ['BSD City', 'Bintaro Jaya', 'Alam Sutera', 'Gading Serpong', 'Karawaci'],
                    'service'     => 'Penanganan cepat saluran mampet cluster residensial & komersial.',
                    'slug'        => 'tangerang-selatan',
                    'cta'         => 'Cabang Banten'
                ],
                [
                    'province'    => 'Jawa Barat',
                    'cities'      => 'Bogor, Depok, Bekasi, Cikarang, Bandung Raya, Karawang',
                    'status'      => 'Residensial & Industri',
                    'badge_theme' => 'cyan',
                    'image'       => asset('assets/wilayah/jawa-barat/jasa-saluran-pipa-mampet-alun-alun-kota-bandung-jawa-barat-rootera-plumbing-1.webp'),
                    'highlights'  => ['Sentul', 'Margonda', 'Cikarang MM2100', 'Bandung Kota', 'Karawang KIIC'],
                    'service'     => 'Residensial, villa, kuliner/kosan, hingga Hydro-jetting pipa industri (MM2100, EJIP, Jababeka).',
                    'slug'        => 'bekasi',
                    'cta'         => 'Cabang Jawa Barat'
                ],
                [
                    'province'    => 'Jawa Tengah',
                    'cities'      => 'Semarang, Solo, Magelang, Kudus, Purwokerto',
                    'status'      => 'Cabang Operasional',
                    'badge_theme' => 'blue',
                    'image'       => asset('assets/wilayah/jawa-tengah/jasa-saluran-pipa-mampet-kota-lama-semarang-jawa-tengah-rootera-plumbing-16.webp'),
                    'highlights'  => ['Simpang Lima', 'Solo Baru', 'KI Kendal', 'KI Candi', 'Kudus Kota'],
                    'service'     => 'Rooter drain cleaner & maintenance plumbing pabrik, hotel, & rumah tinggal.',
                    'slug'        => 'semarang',
                    'cta'         => 'Cabang Jawa Tengah'
                ],
                [
                    'province'    => 'D.I. Yogyakarta',
                    'cities'      => 'Yogyakarta Kota, Sleman, Bantul, Kulon Progo',
                    'status'      => 'Fast Response 24 Jam',
                    'badge_theme' => 'indigo',
                    'image'       => asset('assets/wilayah/yogyakarta/jasa-saluran-pipa-mampet-malioboro-yogyakarta-indonesia-yogyakarta-rootera-plumbing-9.webp'),
                    'highlights'  => ['Malioboro', 'Kaliurang', 'Seturan', 'Gejayan', 'Condongcatur'],
                    'service'     => 'Solusi mampet cepat untuk cafe, homestay/hotel, kos eksklusif, & hunian.',
                    'slug'        => 'yogyakarta',
                    'cta'         => 'Cabang DIY Jogja'
                ],
                [
                    'province'    => 'Jawa Timur',
                    'cities'      => 'Surabaya, Sidoarjo, Gresik, Malang',
                    'status'      => 'Hub Jawa Timur',
                    'badge_theme' => 'amber',
                    'image'       => asset('assets/wilayah/jawa-timur/jasa-saluran-pipa-mampet-jawa-timur-rootera-plumbing-5.webp'),
                    'highlights'  => ['Surabaya Barat', 'Surabaya Timur', 'Waru', 'Rungkut', 'Malang Kota'],
                    'service'     => 'Layanan pipa mampet heavy duty & residensial cepat bergaransi.',
                    'slug'        => 'surabaya',
                    'cta'         => 'Cabang Jawa Timur'
                ],
                [
                    'province'    => 'Lampung (Sumatera)',
                    'cities'      => 'Bandar Lampung, Metro, Natar',
                    'status'      => 'Cabang Resmi Sumatera',
                    'badge_theme' => 'emerald',
                    'image'       => asset('assets/wilayah/lampung/jasa-saluran-pipa-mampet-menara-siger-lampung-selatan-lampung-rootera-plumbing-6.webp'),
                    'highlights'  => ['Teluk Betung', 'Tanjung Karang', 'Kedaton', 'Way Halim'],
                    'service'     => 'Cabang resmi Sumatera untuk hunian, ruko, & instansi.',
                    'slug'        => 'bandar-lampung',
                    'cta'         => 'Cabang Lampung'
                ],
            ];
        @endphp

        {{-- MOBILE HORIZONTAL SWIPE HINT (DISPLAYED ON MOBILE ONLY) --}}
        <div class="flex items-center justify-between sm:hidden mb-3 px-1">
            <span style="font-size: 0.78rem; font-weight: 700; color: #34d399; display: flex; align-items: center; gap: 0.35rem;">
                <svg class="w-4 h-4 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                Geser kesamping untuk wilayah lain (7 Hub)
            </span>
            <span style="font-size: 0.72rem; color: #94a3b8; font-weight: 600;">Swipe ➔</span>
        </div>

        {{-- MAIN CARDS CONTAINER: GRID ON DESKTOP/TABLET, HORIZONTAL SNAP CAROUSEL ON MOBILE --}}
        <div class="flex sm:grid sm:grid-cols-2 lg:grid-cols-3 gap-6 overflow-x-auto sm:overflow-visible snap-x snap-mandatory scrollbar-none pb-4 sm:pb-0 -mx-4 px-4 sm:mx-0 sm:px-0" id="coverage-hub-slider">
            
            @foreach($coverageHubs as $index => $hub)
            @php
                $isLast = ($index === count($coverageHubs) - 1);
            @endphp

            <div class="w-[88vw] max-w-[340px] sm:w-auto flex-shrink-0 snap-center sm:snap-align-none flex flex-col {{ $isLast ? 'sm:col-span-2 lg:col-span-3' : '' }}">
                
                <div style="background: linear-gradient(145deg, rgba(15, 23, 42, 0.95) 0%, rgba(6, 20, 52, 0.98) 100%); border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 24px; overflow: hidden; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4); display: flex; flex-direction: column; height: 100%; transition: all 0.3s ease;" class="hover:-translate-y-2 hover:border-emerald-400/60 hover:shadow-2xl hover:shadow-emerald-950/40 group">
                    
                    {{-- CARD COVER IMAGE HEADER --}}
                    <div style="position: relative; overflow: hidden;" class="{{ $isLast ? 'h-48 sm:h-52 lg:h-60' : 'h-48 sm:h-52' }}">
                        <img src="{{ $hub['image'] }}" alt="Jasa Saluran Pipa Mampet Cabang {{ $hub['province'] }} Rootera Plumbing" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;" class="group-hover:scale-105" loading="lazy" decoding="async">
                        
                        {{-- Dark Gradient Overlay --}}
                        <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(6, 20, 52, 0.95) 0%, rgba(6, 20, 52, 0.4) 60%, rgba(0,0,0,0.15) 100%);"></div>

                        {{-- Top Badges Overlay --}}
                        <div style="position: absolute; top: 1rem; left: 1rem; right: 1rem; display: flex; justify-content: space-between; align-items: center; gap: 0.5rem;">
                            {{-- Region Tag Pill --}}
                            <span style="background: rgba(6, 20, 52, 0.85); border: 1px solid rgba(52, 211, 153, 0.5); color: #34d399; font-size: 0.72rem; font-weight: 800; padding: 0.3rem 0.75rem; border-radius: 9999px; text-transform: uppercase; backdrop-filter: blur(8px); display: inline-flex; align-items: center; gap: 0.3rem;">
                                📍 {{ $hub['province'] }}
                            </span>

                            {{-- Status Badge --}}
                            <span style="background: rgba(16, 185, 129, 0.2); border: 1px solid rgba(16, 185, 129, 0.4); color: #6ee7cc; font-size: 0.7rem; font-weight: 700; padding: 0.3rem 0.65rem; border-radius: 9999px; backdrop-filter: blur(8px); display: inline-flex; align-items: center; gap: 0.35rem;">
                                <span style="width: 6px; height: 6px; border-radius: 50%; background: #10b981;" class="animate-ping"></span>
                                {{ $hub['status'] }}
                            </span>
                        </div>

                        {{-- Floating Headline on Image Bottom --}}
                        <div style="position: absolute; bottom: 0.85rem; left: 1.25rem; right: 1.25rem;">
                            <h3 style="font-size: 1.25rem; font-weight: 800; color: #ffffff; margin: 0; line-height: 1.2; text-shadow: 0 2px 6px rgba(0,0,0,0.7);" class="group-hover:text-emerald-300 transition-colors">
                                {{ $hub['province'] }}
                            </h3>
                            <p style="color: rgba(255, 255, 255, 0.8); font-size: 0.78rem; margin: 0.2rem 0 0; font-weight: 500; text-shadow: 0 1px 4px rgba(0,0,0,0.8);">
                                {{ $hub['cities'] }}
                            </p>
                        </div>
                    </div>

                    {{-- CARD BODY CONTENT --}}
                    <div style="padding: 1.25rem 1.25rem 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">
                        
                        {{-- Highlights Micro-Badges / Area Chips --}}
                        <div style="margin-bottom: 1rem;">
                            <div style="font-size: 0.7rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 0.4rem;">
                                Area Layanan Utama:
                            </div>
                            <div style="display: flex; flex-wrap: wrap; gap: 0.35rem;">
                                @foreach($hub['highlights'] as $chip)
                                    <span style="background: rgba(255, 255, 255, 0.06); border: 1px solid rgba(255, 255, 255, 0.12); color: #cbd5e1; font-size: 0.72rem; font-weight: 600; padding: 0.2rem 0.55rem; border-radius: 6px; transition: all 0.2s;" class="hover:border-emerald-400/50 hover:text-emerald-300">
                                        {{ $chip }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        {{-- Service Description --}}
                        <p style="color: rgba(255, 255, 255, 0.75); font-size: 0.84rem; line-height: 1.55; margin: 0 0 1.25rem;">
                            {{ $hub['service'] }}
                        </p>

                        {{-- BOTTOM DUAL CTA ACTION BUTTONS --}}
                        <div style="margin-top: auto; padding-top: 1rem; border-top: 1px solid rgba(255, 255, 255, 0.1); display: flex; align-items: center; gap: 0.6rem;">
                            {{-- Primary CTA Button --}}
                            <a href="{{ url('/jasa-saluran-mampet/' . $hub['slug']) }}" style="flex: 1; background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(6, 182, 212, 0.2) 100%); border: 1px solid rgba(16, 185, 129, 0.4); color: #34d399; text-decoration: none; padding: 0.65rem 0.85rem; border-radius: 12px; font-weight: 700; font-size: 0.82rem; display: flex; align-items: center; justify-content: center; gap: 0.35rem; transition: all 0.2s ease;" class="hover:bg-emerald-500 hover:text-white hover:border-emerald-500 min-h-[40px]">
                                <span>{{ $hub['cta'] }}</span>
                                <span class="group-hover:translate-x-1 transition-transform">→</span>
                            </a>

                            {{-- Direct WhatsApp Technician Button --}}
                            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya butuh panggil teknisi untuk wilayah ' . $hub['province']) }}" target="_blank" rel="noopener noreferrer" style="background: rgba(37, 211, 102, 0.15); border: 1px solid rgba(37, 211, 102, 0.35); color: #4ade80; text-decoration: none; padding: 0.65rem 0.75rem; border-radius: 12px; font-weight: 700; font-size: 0.78rem; display: flex; align-items: center; justify-content: center; gap: 0.3rem; transition: all 0.2s ease;" class="hover:bg-emerald-600 hover:text-white min-h-[40px]" title="Panggil Teknisi WA {{ $hub['province'] }}">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.669-.699c.969.53 1.951.815 2.791.815 3.182 0 5.768-2.587 5.768-5.767 0-3.18-2.586-5.766-5.768-5.766z"/></svg>
                                <span>Panggil</span>
                            </a>
                        </div>

                    </div>

                </div>

            </div>
            @endforeach

        </div>

        {{-- MOBILE DOTS INDICATOR --}}
        <div class="flex justify-center items-center gap-1.5 sm:hidden mt-4">
            @foreach($coverageHubs as $idx => $h)
                <div style="width: {{ $idx === 0 ? '20px' : '6px' }}; height: 6px; border-radius: 9999px; background: {{ $idx === 0 ? '#10b981' : 'rgba(255,255,255,0.2)' }}; transition: all 0.3s ease;"></div>
            @endforeach
        </div>

        {{-- MASTER DIRECTORY BOTTOM CTA BUTTON --}}
        <div class="text-center" style="margin-top: 3.5rem;">
            <a href="{{ route('area-layanan') }}" style="background: rgba(255, 255, 255, 0.06); border: 1px solid rgba(255, 255, 255, 0.18); color: #ffffff; text-decoration: none; padding: 0.9rem 2.25rem; border-radius: 50px; font-weight: 800; font-size: 0.95rem; display: inline-flex; items-center: center; gap: 0.5rem; backdrop-filter: blur(10px); transition: all 0.25s ease; box-shadow: 0 10px 25px rgba(0,0,0,0.2);" class="hover:bg-white hover:text-slate-900 hover:scale-105">
                <span>🗺️ Eksplorasi Seluruh Direktori Wilayah &amp; Kecamatan Terdekat</span>
                <span>→</span>
            </a>
        </div>

    </div>
</section>
