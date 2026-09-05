<section id="area-jangkauan" aria-labelledby="area-heading" class="relative overflow-hidden bg-slate-50/50 text-slate-900 py-8 sm:py-10 md:py-16 lg:py-20 border-t border-b border-slate-200/60">


    {{-- Subtle Ambient Radial Glow Orbs --}}
    <div class="absolute top-10 left-1/2 -translate-x-1/2 w-[700px] h-[300px] bg-cyan-400/10 blur-[100px] rounded-full pointer-events-none z-0" aria-hidden="true"></div>

    <div class="container relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- SECTION HEADER --}}
        <div class="text-center max-w-[820px] mx-auto mb-6 sm:mb-8 md:mb-14">
            
            <div class="inline-flex items-center gap-1.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-[10px] sm:text-xs font-extrabold uppercase tracking-wider py-1 px-3 sm:px-4 rounded-full mb-2 md:mb-4 backdrop-blur-md whitespace-nowrap shadow-2xs">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 shadow-[0_0_8px_#10b981] animate-pulse"></span>
                📍 COVERAGE HUBS &amp; CABANG OPERASIONAL
            </div>

            <h2 id="area-heading" class="text-xl sm:text-2xl md:text-[clamp(2rem,4vw,2.75rem)] font-extrabold text-slate-900 leading-tight md:leading-tight mb-2 md:mb-4 tracking-tight">
                Area Jangkauan Layanan Jasa Saluran Pipa Mampet <span class="text-emerald-600">Rootera</span>
            </h2>

            <p class="text-xs sm:text-sm md:text-[1.05rem] text-slate-600 leading-relaxed max-w-2xl mx-auto mb-4 md:mb-8">
                Teknisi profesional kami disiagakan di <strong>7 Hub Utama Nasional</strong> (Jabodetabek, Banten, Jawa Barat, Jawa Tengah, D.I. Yogyakarta, Jawa Timur, &amp; Sumatera/Lampung) siap datang cepat tanpa membongkar keramik.
            </p>

            {{-- Quick Stats Summary Pills (Light Theme 2-Column Grid on Mobile, Flex on Desktop) --}}
            <div class="grid grid-cols-2 sm:flex sm:flex-wrap justify-center gap-2 sm:gap-3.5 mt-3 md:mt-8 max-w-lg sm:max-w-none mx-auto">
                <div class="bg-white border border-slate-200 shadow-2xs py-1.5 px-2.5 sm:py-2 sm:px-4 rounded-xl text-[11px] sm:text-xs md:text-[0.82rem] font-bold text-slate-700 flex items-center justify-center sm:justify-start gap-1.5">
                    <span>🏛️</span> 7 Hub Regional
                </div>
                <div class="bg-white border border-slate-200 shadow-2xs py-1.5 px-2.5 sm:py-2 sm:px-4 rounded-xl text-[11px] sm:text-xs md:text-[0.82rem] font-bold text-slate-700 flex items-center justify-center sm:justify-start gap-1.5">
                    <span>📍</span> 150+ Kecamatan
                </div>
                <div class="bg-emerald-50 border border-emerald-200 shadow-2xs py-1.5 px-2.5 sm:py-2 sm:px-4 rounded-xl text-[11px] sm:text-xs md:text-[0.82rem] font-bold text-emerald-700 flex items-center justify-center sm:justify-start gap-1.5">
                    <span>⏱️</span> Standby 24 Jam
                </div>
                <div class="bg-sky-50 border border-sky-200 shadow-2xs py-1.5 px-2.5 sm:py-2 sm:px-4 rounded-xl text-[11px] sm:text-xs md:text-[0.82rem] font-bold text-sky-700 flex items-center justify-center sm:justify-start gap-1.5">
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

        {{-- MOBILE HORIZONTAL SWIPE HINT --}}
        <div class="flex items-center justify-between sm:hidden mb-2 px-1">
            <span class="text-[11px] font-bold text-emerald-700 flex items-center gap-1">
                <svg class="w-3.5 h-3.5 animate-bounce text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                Geser kesamping untuk wilayah lain (7 Hub)
            </span>
            <span class="text-[10px] text-slate-500 font-semibold">Swipe ➔</span>
        </div>

        {{-- MAIN CARDS CONTAINER: GRID ON DESKTOP/TABLET, HORIZONTAL SNAP CAROUSEL ON MOBILE --}}
        <div class="flex sm:grid sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6 overflow-x-auto sm:overflow-visible snap-x snap-mandatory mobile-scrollbar touch-pan-x pb-3 sm:pb-0 -mx-4 px-4 sm:mx-0 sm:px-0" id="coverage-hub-slider">
            
            @foreach($coverageHubs as $index => $hub)
            @php
                $isLast = ($index === count($coverageHubs) - 1);
            @endphp

            <div class="w-[82vw] min-w-[82vw] sm:min-w-0 max-w-[320px] sm:w-auto shrink-0 snap-center sm:snap-align-none flex flex-col {{ $isLast ? 'sm:col-span-2 lg:col-span-3' : '' }}">
                
                <div class="bg-white border border-slate-200/90 rounded-2xl sm:rounded-3xl overflow-hidden shadow-sm hover:shadow-xl hover:border-emerald-400/60 transition-all duration-300 flex flex-col h-full group">
                    
                    {{-- CARD COVER IMAGE HEADER --}}
                    <div class="relative overflow-hidden {{ $isLast ? 'h-36 sm:h-52 lg:h-60' : 'h-32 sm:h-52' }}">
                        <img src="{{ $hub['image'] }}" alt="Jasa Saluran Pipa Mampet Cabang {{ $hub['province'] }} Rootera Plumbing" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" decoding="async">
                        
                        {{-- Dark Gradient Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/40 to-black/15"></div>

                        {{-- Top Badges Overlay --}}
                        <div class="absolute top-2.5 left-2.5 right-2.5 sm:top-4 sm:left-4 sm:right-4 flex justify-between items-center gap-1.5">
                            {{-- Region Tag Pill --}}
                            <span class="bg-slate-900/80 border border-emerald-400/50 text-emerald-300 text-[10px] sm:text-[0.72rem] font-extrabold py-0.5 px-2 sm:py-1 sm:px-3 rounded-full uppercase backdrop-blur-md flex items-center gap-1">
                                📍 {{ $hub['province'] }}
                            </span>

                            {{-- Status Badge --}}
                            <span class="bg-emerald-500/20 border border-emerald-400/40 text-emerald-300 text-[9px] sm:text-[0.7rem] font-bold py-0.5 px-2 sm:py-1 sm:px-2.5 rounded-full backdrop-blur-md flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                                {{ $hub['status'] }}
                            </span>
                        </div>

                        {{-- Floating Headline on Image Bottom --}}
                        <div class="absolute bottom-2 left-3 right-3 sm:bottom-3.5 sm:left-5 sm:right-5">
                            <h3 class="text-sm sm:text-xl font-extrabold text-white mb-0.5 leading-tight group-hover:text-emerald-300 transition-colors drop-shadow-md">
                                {{ $hub['province'] }}
                            </h3>
                            <p class="text-[11px] sm:text-[0.78rem] text-slate-200/90 mb-0 font-medium drop-shadow-sm line-clamp-1">
                                {{ $hub['cities'] }}
                            </p>
                        </div>
                    </div>

                    {{-- CARD BODY CONTENT --}}
                    <div class="p-3.5 sm:p-5 flex flex-col flex-grow bg-white">
                        
                        {{-- Highlights Micro-Badges / Area Chips --}}
                        <div class="mb-2 sm:mb-4">
                            <div class="text-[10px] sm:text-[0.7rem] font-bold text-slate-400 uppercase tracking-wider mb-1 sm:mb-1.5">
                                Area Layanan Utama:
                            </div>
                            <div class="flex flex-wrap gap-1 sm:gap-1.5">
                                @foreach($hub['highlights'] as $chip)
                                    <span class="bg-slate-100 border border-slate-200/70 text-slate-700 text-[10px] sm:text-[0.72rem] font-semibold py-0.5 px-1.5 sm:py-1 sm:px-2.5 rounded-md hover:border-emerald-400/50 hover:text-emerald-700 transition-colors">
                                        {{ $chip }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        {{-- Service Description --}}
                        <p class="text-xs sm:text-[0.84rem] text-slate-600 leading-relaxed mb-3 sm:mb-5 line-clamp-2 md:line-clamp-none">
                            {{ $hub['service'] }}
                        </p>

                        {{-- BOTTOM DUAL CTA ACTION BUTTONS --}}
                        <div class="mt-auto pt-2.5 sm:pt-4 border-t border-slate-100 flex items-center gap-2">
                            {{-- Primary CTA Button --}}
                            <a href="{{ url('/jasa-saluran-mampet/' . $hub['slug']) }}" class="flex-1 bg-emerald-50 border border-emerald-200 text-emerald-700 hover:bg-emerald-600 hover:text-white text-xs sm:text-[0.82rem] font-bold py-2 px-2.5 sm:py-2.5 sm:px-3.5 rounded-xl flex items-center justify-center gap-1 transition-all min-h-[36px] sm:min-h-[40px] text-decoration-none">
                                <span>{{ $hub['cta'] }}</span>
                                <span class="group-hover:translate-x-1 transition-transform">→</span>
                            </a>

                            {{-- Direct WhatsApp Technician Button --}}
                            <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera Plumbing, saya butuh panggil teknisi untuk wilayah ' . $hub['province']) }}" target="_blank" rel="noopener noreferrer" class="bg-emerald-600 text-white hover:bg-emerald-700 text-xs sm:text-[0.78rem] font-bold py-2 px-2.5 sm:py-2.5 sm:px-3 rounded-xl flex items-center justify-center gap-1 transition-all min-h-[36px] sm:min-h-[40px] text-decoration-none" title="Panggil Teknisi WA {{ $hub['province'] }}">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.598 2.669-.699c.969.53 1.951.815 2.791.815 3.182 0 5.768-2.587 5.768-5.767 0-3.18-2.586-5.766-5.768-5.766z"/></svg>
                                <span>Panggil</span>
                            </a>
                        </div>

                    </div>

                </div>

            </div>
            @endforeach

        </div>

        {{-- MOBILE DOTS INDICATOR --}}
        <div class="flex justify-center items-center gap-1.5 sm:hidden mt-3 mb-2">
            @foreach($coverageHubs as $idx => $h)
                <div class="{{ $idx === 0 ? 'w-5 bg-emerald-500' : 'w-1.5 bg-slate-300' }} h-1.5 rounded-full transition-all duration-300"></div>
            @endforeach
        </div>

        {{-- MASTER DIRECTORY BOTTOM CTA BUTTON --}}
        <div class="text-center mt-6 sm:mt-14">
            <a href="{{ route('area-layanan') }}" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-emerald-600 text-white font-extrabold text-xs sm:text-sm px-6 py-3.5 rounded-full text-decoration-none shadow-md transition-all duration-300 hover:scale-105">
                <span>🗺️ Eksplorasi Seluruh Direktori Wilayah &amp; Kecamatan Terdekat</span>
                <span>→</span>
            </a>
        </div>

    </div>
</section>
