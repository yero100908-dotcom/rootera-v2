<style>
    .nav-logo-img { height: 80px; width: auto; object-fit: contain; transform-origin: left center; transform: scale(3.2); transition: transform 0.3s ease; }
    @media (max-width: 768px) {
        .nav-logo-img { transform: scale(2.2); }
        .nav-cta { display: none !important; }
    }
    @media (max-width: 480px) {
        .nav-logo-img { transform: scale(1.8); }
    }

    /* Dropdown & Mega Menu Core Styles */
    .nav-item-dropdown { position: relative; }
    
    /* Desktop Dropdown Container */
    @media (min-width: 1024px) {
        .dropdown-menu-box {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%) translateY(12px);
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 20px 50px -10px rgba(15, 23, 42, 0.15), 0 10px 20px -5px rgba(15, 23, 42, 0.04);
            border-radius: 1.25rem;
            padding: 1.5rem;
            z-index: 99999;
        }

        .nav-item-dropdown:hover .dropdown-menu-box,
        .nav-item-dropdown:focus-within .dropdown-menu-box {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
            transform: translateX(-50%) translateY(0);
        }

        .nav-item-dropdown:hover .dropdown-chevron {
            transform: rotate(180deg);
            color: #169F81;
        }
        
        .mega-menu-layanan { width: 720px; }
        .mega-menu-area { width: 840px; }
        .dropdown-menu-tentang { width: 340px; left: 0; transform: translateX(0) translateY(12px); }
        .nav-item-dropdown:hover .dropdown-menu-tentang { transform: translateX(0) translateY(0); }
    }

    /* Mobile Accordion Styles */
    .mobile-accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.35s ease-out, opacity 0.25s ease;
        opacity: 0;
    }
    .mobile-accordion-content.open {
        max-height: 1200px;
        opacity: 1;
    }
    .mobile-chevron {
        transition: transform 0.3s ease;
    }
    .mobile-chevron.open {
        transform: rotate(180deg);
    }
</style>

<nav id="navbar" class="navbar relative z-[9999]" role="navigation" aria-label="Navigasi utama">
    <div class="nav-container">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="nav-logo" aria-label="Rootera - Beranda">
            <img src="{{ asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp') }}" alt="Logo Rootera Jasa Pipa Mampet" class="nav-logo-img" width="180" height="80" decoding="async" loading="eager">
        </a>

        {{-- Desktop Menu --}}
        <ul class="nav-menu hidden lg:flex items-center gap-1 xl:gap-2 ml-auto" role="list">
            <li>
                <a href="{{ route('home') }}" class="nav-link px-3 py-2 text-sm font-semibold text-slate-700 hover:text-emerald-600 rounded-lg transition-colors {{ request()->routeIs('home') ? 'active text-emerald-600' : '' }}">
                    Beranda
                </a>
            </li>

            {{-- Mega Menu: Layanan --}}
            <li class="nav-item-dropdown">
                <a href="{{ route('layanan') }}" class="nav-link inline-flex items-center gap-1.5 px-3 py-2 text-sm font-semibold text-slate-700 hover:text-emerald-600 rounded-lg transition-colors {{ request()->routeIs('layanan*') || request()->routeIs('b2b*') ? 'active text-emerald-600' : '' }}" aria-expanded="false">
                    <span>Layanan</span>
                    <svg class="dropdown-chevron w-4 h-4 text-slate-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </a>

                {{-- Mega Menu Dropdown Layanan --}}
                <div class="dropdown-menu-box mega-menu-layanan text-slate-800">
                    <div class="grid grid-cols-12 gap-6">
                        {{-- Col 1: Kategori Utama --}}
                        <div class="col-span-7">
                            <div class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3 px-2">Kategori Utama Jasa Pipa</div>
                            <div class="grid grid-cols-1 gap-1">
                                <a href="{{ url('/layanan/wastafel-mampet') }}" class="group flex items-start gap-3 p-2.5 rounded-xl hover:bg-slate-50 transition-all">
                                    <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-lg group-hover:bg-emerald-600 group-hover:text-white transition-colors shrink-0">🚰</div>
                                    <div>
                                        <div class="font-bold text-sm text-slate-900 group-hover:text-emerald-600 transition-colors flex items-center gap-1.5">
                                            Wastafel & Sink Mampet
                                            <span class="text-[10px] font-extrabold px-1.5 py-0.5 bg-emerald-100 text-emerald-700 rounded-md">Populer</span>
                                        </div>
                                        <div class="text-xs text-slate-500 line-clamp-1">Pelancaran leher angsa & kerak lemak dapur</div>
                                    </div>
                                </a>

                                <a href="{{ url('/layanan/kamar-mandi-mampet') }}" class="group flex items-start gap-3 p-2.5 rounded-xl hover:bg-slate-50 transition-all">
                                    <div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-lg group-hover:bg-blue-600 group-hover:text-white transition-colors shrink-0">🚿</div>
                                    <div>
                                        <div class="font-bold text-sm text-slate-900 group-hover:text-emerald-600 transition-colors">Kamar Mandi & Floor Drain</div>
                                        <div class="text-xs text-slate-500 line-clamp-1">Pembersihan saringan rontokan rambut & sabun</div>
                                    </div>
                                </a>

                                <a href="{{ url('/layanan/wc-toilet-mampet') }}" class="group flex items-start gap-3 p-2.5 rounded-xl hover:bg-slate-50 transition-all">
                                    <div class="w-9 h-9 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-lg group-hover:bg-amber-600 group-hover:text-white transition-colors shrink-0">🚽</div>
                                    <div>
                                        <div class="font-bold text-sm text-slate-900 group-hover:text-emerald-600 transition-colors">WC & Kloset Toilet</div>
                                        <div class="text-xs text-slate-500 line-clamp-1">Evakuasi tisu/benda asing tanpa bongkar kloset</div>
                                    </div>
                                </a>

                                <a href="{{ url('/layanan/got-saluran-pembuangan') }}" class="group flex items-start gap-3 p-2.5 rounded-xl hover:bg-slate-50 transition-all">
                                    <div class="w-9 h-9 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-lg group-hover:bg-indigo-600 group-hover:text-white transition-colors shrink-0">🌧️</div>
                                    <div>
                                        <div class="font-bold text-sm text-slate-900 group-hover:text-emerald-600 transition-colors">Got & Saluran Pembuangan</div>
                                        <div class="text-xs text-slate-500 line-clamp-1">Pelancaran talang hujan & bak kontrol meluap</div>
                                    </div>
                                </a>

                                <a href="{{ url('/layanan/inspeksi-pipa-kamera') }}" class="group flex items-start gap-3 p-2.5 rounded-xl hover:bg-slate-50 transition-all">
                                    <div class="w-9 h-9 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center font-bold text-lg group-hover:bg-rose-600 group-hover:text-white transition-colors shrink-0">📷</div>
                                    <div>
                                        <div class="font-bold text-sm text-slate-900 group-hover:text-emerald-600 transition-colors">Inspeksi Kamera CCTV Pipa</div>
                                        <div class="text-xs text-slate-500 line-clamp-1">Deteksi kebocoran & posisi mampet di dalam dinding</div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        {{-- Col 2: Komersial & B2B Box --}}
                        <div class="col-span-5 bg-gradient-to-br from-slate-900 to-blue-950 p-4 rounded-xl text-white flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-400">Sektor B2B Komersial</span>
                                    <span class="text-[10px] bg-emerald-500/20 text-emerald-300 px-2 py-0.5 rounded-full font-bold border border-emerald-500/30">Kontrak SLA</span>
                                </div>
                                <p class="text-xs text-slate-300 mb-3">Layanan pelancaran pipa industri, restoran, hotel & gedung bertingkat dengan invoice & faktur PPN.</p>
                                
                                <div class="space-y-1.5 text-xs">
                                    <a href="{{ url('/sektor-plumbing/restoran-cafe') }}" class="flex items-center gap-2 p-2 rounded-lg hover:bg-white/10 text-slate-200 transition-colors">
                                        <span>🍽️</span> <span>Restoran, Cafe & Food Court</span>
                                    </a>
                                    <a href="{{ url('/sektor-plumbing/hotel-apartemen') }}" class="flex items-center gap-2 p-2 rounded-lg hover:bg-white/10 text-slate-200 transition-colors">
                                        <span>🏨</span> <span>Hotel, Apartemen & Kos</span>
                                    </a>
                                    <a href="{{ url('/sektor-plumbing/pabrik-industri') }}" class="flex items-center gap-2 p-2 rounded-lg hover:bg-white/10 text-slate-200 transition-colors">
                                        <span>🏭</span> <span>Pabrik & Kawasan Industri</span>
                                    </a>
                                </div>
                            </div>

                            <a href="{{ route('b2b.index') }}" class="mt-4 inline-flex items-center justify-center gap-1.5 w-full py-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs rounded-lg transition-colors text-center">
                                Lihat Layanan B2B & Komersial &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </li>

            {{-- Dropdown: Tentang Kami --}}
            <li class="nav-item-dropdown">
                <a href="{{ route('tentang-kami') }}" class="nav-link inline-flex items-center gap-1.5 px-3 py-2 text-sm font-semibold text-slate-700 hover:text-emerald-600 rounded-lg transition-colors {{ request()->routeIs('tentang-kami*') ? 'active text-emerald-600' : '' }}" aria-expanded="false">
                    <span>Tentang Kami</span>
                    <svg class="dropdown-chevron w-4 h-4 text-slate-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </a>

                {{-- Dropdown Menu Tentang Kami --}}
                <div class="dropdown-menu-box dropdown-menu-tentang">
                    <div class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2 px-2">Informasi & Kredibilitas</div>
                    <div class="space-y-1">
                        <a href="{{ route('tentang-kami.profil') }}" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-slate-50 transition-colors text-sm font-semibold text-slate-800 hover:text-emerald-600">
                            <span class="text-base">🏢</span>
                            <div>
                                <div>Profil Perusahaan & K3</div>
                                <div class="text-xs font-normal text-slate-500">Legalitas & komitmen keselamatan</div>
                            </div>
                        </a>
                        <a href="{{ route('tentang-kami.peralatan-teknologi') }}" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-slate-50 transition-colors text-sm font-semibold text-slate-800 hover:text-emerald-600">
                            <span class="text-base">⚙️</span>
                            <div>
                                <div>Peralatan & Teknologi</div>
                                <div class="text-xs font-normal text-slate-500">Mesin Ridgid & Hydro Jetting</div>
                            </div>
                        </a>
                        <a href="{{ route('tentang-kami.portofolio-klien') }}" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-slate-50 transition-colors text-sm font-semibold text-slate-800 hover:text-emerald-600">
                            <span class="text-base">📁</span>
                            <div>
                                <div>Klien & Portofolio B2B</div>
                                <div class="text-xs font-normal text-slate-500">Proyek gedung & industri</div>
                            </div>
                        </a>
                        <a href="{{ route('tentang-kami.garansi-layanan') }}" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-slate-50 transition-colors text-sm font-semibold text-slate-800 hover:text-emerald-600">
                            <span class="text-base">🛡️</span>
                            <div>
                                <div>Garansi Pengerjaan</div>
                                <div class="text-xs font-normal text-slate-500">Jaminan tuntas 30 hari</div>
                            </div>
                        </a>
                        <a href="{{ route('faq.index') }}" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-slate-50 transition-colors text-sm font-semibold text-slate-800 hover:text-emerald-600">
                            <span class="text-base">❓</span>
                            <div>
                                <div>FAQ / Pusat Bantuan</div>
                                <div class="text-xs font-normal text-slate-500">Pertanyaan umum & estimasi biaya</div>
                            </div>
                        </a>
                    </div>
                </div>
            </li>

            <li>
                <a href="{{ route('galeri') }}" class="nav-link px-3 py-2 text-sm font-semibold text-slate-700 hover:text-emerald-600 rounded-lg transition-colors {{ request()->routeIs('galeri*') ? 'active text-emerald-600' : '' }}">
                    Galeri & Dokumentasi
                </a>
            </li>

            <li>
                <a href="{{ route('blog') }}" class="nav-link px-3 py-2 text-sm font-semibold text-slate-700 hover:text-emerald-600 rounded-lg transition-colors {{ request()->routeIs('blog*') ? 'active text-emerald-600' : '' }}">
                    Pengetahuan
                </a>
            </li>

            {{-- Mega Menu: Area Layanan --}}
            <li class="nav-item-dropdown">
                <a href="{{ route('area-layanan') }}" class="nav-link inline-flex items-center gap-1.5 px-3 py-2 text-sm font-semibold text-slate-700 hover:text-emerald-600 rounded-lg transition-colors {{ request()->routeIs('area*') || request()->is('jasa-saluran-mampet*') ? 'active text-emerald-600' : '' }}" aria-expanded="false">
                    <span>Area Layanan</span>
                    <svg class="dropdown-chevron w-4 h-4 text-slate-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </a>

                {{-- Mega Menu Dropdown Area Layanan --}}
                <div class="dropdown-menu-box mega-menu-area text-slate-800">
                    <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-100">
                        <div>
                            <div class="text-sm font-bold text-slate-900">Jangkauan Wilayah Operasional Rootera</div>
                            <div class="text-xs text-slate-500">Teknisi siaga 24 jam dengan waktu tiba cepat ke lokasi</div>
                        </div>
                        <a href="{{ route('area-layanan') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 hover:underline">Lihat 50+ Kota & Kecamatan &rarr;</a>
                    </div>

                    <div class="grid grid-cols-4 gap-6">
                        {{-- DKI Jakarta --}}
                        <div>
                            <div class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-2 flex items-center gap-1">
                                <span class="text-emerald-600">📍</span> DKI Jakarta
                            </div>
                            <ul class="space-y-1 text-xs">
                                <li><a href="{{ url('/jasa-saluran-mampet/jakarta-barat') }}" class="hover:text-emerald-600 text-slate-600 block py-0.5">Jakarta Barat</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/jakarta-selatan') }}" class="hover:text-emerald-600 text-slate-600 block py-0.5">Jakarta Selatan</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/jakarta-pusat') }}" class="hover:text-emerald-600 text-slate-600 block py-0.5">Jakarta Pusat</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/jakarta-timur') }}" class="hover:text-emerald-600 text-slate-600 block py-0.5">Jakarta Timur</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/jakarta-utara') }}" class="hover:text-emerald-600 text-slate-600 block py-0.5">Jakarta Utara</a></li>
                            </ul>
                        </div>

                        {{-- Banten & Jawa Barat --}}
                        <div>
                            <div class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-2 flex items-center gap-1">
                                <span class="text-emerald-600">📍</span> Banten & Jabar
                            </div>
                            <ul class="space-y-1 text-xs">
                                <li><a href="{{ url('/jasa-saluran-mampet/tangerang') }}" class="hover:text-emerald-600 text-slate-600 block py-0.5">Tangerang Kota / BSD</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/tangerang-selatan') }}" class="hover:text-emerald-600 text-slate-600 block py-0.5">Tangerang Selatan</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/bekasi') }}" class="hover:text-emerald-600 text-slate-600 block py-0.5">Bekasi & Cikarang</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/depok') }}" class="hover:text-emerald-600 text-slate-600 block py-0.5">Depok & Cinere</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/bogor') }}" class="hover:text-emerald-600 text-slate-600 block py-0.5">Bogor & Cibubur</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/bandung') }}" class="hover:text-emerald-600 text-slate-600 block py-0.5">Bandung Raya</a></li>
                            </ul>
                        </div>

                        {{-- Jawa Tengah & DIY --}}
                        <div>
                            <div class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-2 flex items-center gap-1">
                                <span class="text-emerald-600">📍</span> Jateng & DIY
                            </div>
                            <ul class="space-y-1 text-xs">
                                <li><a href="{{ url('/jasa-saluran-mampet/semarang') }}" class="hover:text-emerald-600 text-slate-600 block py-0.5">Semarang</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/surakarta') }}" class="hover:text-emerald-600 text-slate-600 block py-0.5">Solo / Surakarta</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/yogyakarta') }}" class="hover:text-emerald-600 text-slate-600 block py-0.5">Yogyakarta</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/kabupaten-sleman') }}" class="hover:text-emerald-600 text-slate-600 block py-0.5">Sleman & Bantul</a></li>
                            </ul>
                        </div>

                        {{-- Jatim & Sumatra --}}
                        <div>
                            <div class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-2 flex items-center gap-1">
                                <span class="text-emerald-600">📍</span> Jatim & Sumatra
                            </div>
                            <ul class="space-y-1 text-xs">
                                <li><a href="{{ url('/jasa-saluran-mampet/surabaya') }}" class="hover:text-emerald-600 text-slate-600 block py-0.5">Surabaya</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/kabupaten-sidoarjo') }}" class="hover:text-emerald-600 text-slate-600 block py-0.5">Sidoarjo & Gresik</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/malang') }}" class="hover:text-emerald-600 text-slate-600 block py-0.5">Malang Raya</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/bandar-lampung') }}" class="hover:text-emerald-600 text-slate-600 block py-0.5">Bandar Lampung</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

        {{-- CTA Button --}}
        <a href="{{ route('kontak') }}" class="nav-cta" id="nav-cta-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.65 3.42 2 2 0 0 1 3.62 1.24h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.82a16 16 0 0 0 6.29 6.29l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7a2 2 0 0 1 1.72 2.01z"/></svg>
            Hubungi Kami
        </a>

        {{-- Mobile Hamburger --}}
        <button class="nav-hamburger lg:hidden" id="hamburger-btn" aria-label="Buka menu" aria-expanded="false" aria-controls="mobile-menu">
            <span></span><span></span><span></span>
        </button>
    </div>

    {{-- Mobile Menu & Accordions --}}
    <div class="mobile-menu" id="mobile-menu" role="dialog" aria-label="Menu mobile">
        <ul role="list" class="space-y-1">
            <li>
                <a href="{{ route('home') }}" class="mobile-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
            </li>

            {{-- Mobile Accordion 1: Layanan --}}
            <li>
                <button type="button" class="mobile-accordion-toggle w-full flex items-center justify-between mobile-link text-left" data-target="mobile-layanan">
                    <span>Layanan</span>
                    <svg class="mobile-chevron w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div id="mobile-layanan" class="mobile-accordion-content pl-4 pr-2 py-1 space-y-1 text-sm bg-slate-50/80 rounded-xl my-1">
                    <a href="{{ url('/layanan/wastafel-mampet') }}" class="block py-2 px-3 rounded-lg text-slate-700 hover:text-emerald-600 hover:bg-slate-100 font-medium">🚰 Wastafel & Sink Mampet</a>
                    <a href="{{ url('/layanan/kamar-mandi-mampet') }}" class="block py-2 px-3 rounded-lg text-slate-700 hover:text-emerald-600 hover:bg-slate-100 font-medium">🚿 Kamar Mandi & Floor Drain</a>
                    <a href="{{ url('/layanan/wc-toilet-mampet') }}" class="block py-2 px-3 rounded-lg text-slate-700 hover:text-emerald-600 hover:bg-slate-100 font-medium">🚽 WC & Kloset Toilet</a>
                    <a href="{{ url('/layanan/got-saluran-pembuangan') }}" class="block py-2 px-3 rounded-lg text-slate-700 hover:text-emerald-600 hover:bg-slate-100 font-medium">🌧️ Got & Saluran Pembuangan</a>
                    <a href="{{ url('/layanan/inspeksi-pipa-kamera') }}" class="block py-2 px-3 rounded-lg text-slate-700 hover:text-emerald-600 hover:bg-slate-100 font-medium">📷 Inspeksi Kamera CCTV Pipa</a>
                    <a href="{{ route('b2b.index') }}" class="block py-2 px-3 rounded-lg text-emerald-700 bg-emerald-100/60 font-bold mt-1">🏢 Layanan B2B & Komersial &rarr;</a>
                </div>
            </li>

            {{-- Mobile Accordion 2: Tentang Kami --}}
            <li>
                <button type="button" class="mobile-accordion-toggle w-full flex items-center justify-between mobile-link text-left" data-target="mobile-about">
                    <span>Tentang Kami</span>
                    <svg class="mobile-chevron w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div id="mobile-about" class="mobile-accordion-content pl-4 pr-2 py-1 space-y-1 text-sm bg-slate-50/80 rounded-xl my-1">
                    <a href="{{ route('tentang-kami.profil') }}" class="block py-2 px-3 rounded-lg text-slate-700 hover:text-emerald-600 hover:bg-slate-100 font-medium">🏢 Profil Perusahaan & K3</a>
                    <a href="{{ route('tentang-kami.peralatan-teknologi') }}" class="block py-2 px-3 rounded-lg text-slate-700 hover:text-emerald-600 hover:bg-slate-100 font-medium">⚙️ Peralatan & Teknologi</a>
                    <a href="{{ route('tentang-kami.portofolio-klien') }}" class="block py-2 px-3 rounded-lg text-slate-700 hover:text-emerald-600 hover:bg-slate-100 font-medium">📁 Klien & Portofolio B2B</a>
                    <a href="{{ route('tentang-kami.garansi-layanan') }}" class="block py-2 px-3 rounded-lg text-slate-700 hover:text-emerald-600 hover:bg-slate-100 font-medium">🛡️ Garansi Pengerjaan</a>
                    <a href="{{ route('faq.index') }}" class="block py-2 px-3 rounded-lg text-slate-700 hover:text-emerald-600 hover:bg-slate-100 font-medium">❓ FAQ / Pusat Bantuan</a>
                </div>
            </li>

            <li>
                <a href="{{ route('galeri') }}" class="mobile-link {{ request()->routeIs('galeri*') ? 'active' : '' }}">Galeri & Dokumentasi</a>
            </li>

            <li>
                <a href="{{ route('blog') }}" class="mobile-link {{ request()->routeIs('blog*') ? 'active' : '' }}">Pengetahuan</a>
            </li>

            {{-- Mobile Accordion 3: Area Layanan --}}
            <li>
                <button type="button" class="mobile-accordion-toggle w-full flex items-center justify-between mobile-link text-left" data-target="mobile-area">
                    <span>Area Layanan</span>
                    <svg class="mobile-chevron w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div id="mobile-area" class="mobile-accordion-content pl-4 pr-2 py-1 space-y-1 text-sm bg-slate-50/80 rounded-xl my-1">
                    <a href="{{ url('/jasa-saluran-mampet/jakarta-barat') }}" class="block py-1.5 px-3 text-slate-700 hover:text-emerald-600">📍 Jakarta Barat</a>
                    <a href="{{ url('/jasa-saluran-mampet/jakarta-selatan') }}" class="block py-1.5 px-3 text-slate-700 hover:text-emerald-600">📍 Jakarta Selatan</a>
                    <a href="{{ url('/jasa-saluran-mampet/tangerang') }}" class="block py-1.5 px-3 text-slate-700 hover:text-emerald-600">📍 Tangerang / BSD</a>
                    <a href="{{ url('/jasa-saluran-mampet/bekasi') }}" class="block py-1.5 px-3 text-slate-700 hover:text-emerald-600">📍 Bekasi & Cikarang</a>
                    <a href="{{ url('/jasa-saluran-mampet/bandung') }}" class="block py-1.5 px-3 text-slate-700 hover:text-emerald-600">📍 Bandung Raya</a>
                    <a href="{{ url('/jasa-saluran-mampet/surabaya') }}" class="block py-1.5 px-3 text-slate-700 hover:text-emerald-600">📍 Surabaya & Sidoarjo</a>
                    <a href="{{ route('area-layanan') }}" class="block py-2 px-3 rounded-lg text-emerald-700 bg-emerald-100/60 font-bold mt-1">🗺️ Lihat Semua 50+ Wilayah &rarr;</a>
                </div>
            </li>

            <li>
                <a href="{{ route('kontak') }}" class="mobile-link mobile-cta font-bold">Hubungi Kami (24 Jam)</a>
            </li>
        </ul>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const accordionToggles = document.querySelectorAll('.mobile-accordion-toggle');

    if (hamburgerBtn && mobileMenu) {
        hamburgerBtn.addEventListener('click', function () {
            const isOpen = mobileMenu.classList.contains('open');
            if (isOpen) {
                mobileMenu.classList.remove('open');
                hamburgerBtn.classList.remove('open');
                hamburgerBtn.setAttribute('aria-expanded', 'false');
            } else {
                mobileMenu.classList.add('open');
                hamburgerBtn.classList.add('open');
                hamburgerBtn.setAttribute('aria-expanded', 'true');
            }
        });
    }

    accordionToggles.forEach(toggle => {
        toggle.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const targetContent = document.getElementById(targetId);
            const chevron = this.querySelector('.mobile-chevron');

            if (targetContent) {
                const isOpen = targetContent.classList.contains('open');
                // Close other open accordions
                document.querySelectorAll('.mobile-accordion-content').forEach(el => {
                    if (el.id !== targetId) {
                        el.classList.remove('open');
                    }
                });
                document.querySelectorAll('.mobile-chevron').forEach(el => {
                    if (el !== chevron) {
                        el.classList.remove('open');
                    }
                });

                if (isOpen) {
                    targetContent.classList.remove('open');
                    if (chevron) chevron.classList.remove('open');
                } else {
                    targetContent.classList.add('open');
                    if (chevron) chevron.classList.add('open');
                }
            }
        });
    });
});
</script>
