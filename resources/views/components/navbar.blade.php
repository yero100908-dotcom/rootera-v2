<style>
    /* Logo scaling & layout resets */
    .nav-logo-img { 
        height: 75px; 
        width: auto; 
        object-fit: contain; 
        transform-origin: left center; 
        transform: scale(2.8); 
        transition: transform 0.3s ease; 
    }
    @media (max-width: 1024px) {
        .nav-logo-img { transform: scale(2.2); }
    }
    @media (max-width: 768px) {
        .nav-logo-img { transform: scale(2.0); }
        .nav-cta { display: none !important; }
    }
    @media (max-width: 480px) {
        .nav-logo-img { transform: scale(1.7); }
    }

    /* Dropdown Core & Alignment Styles */
    .nav-item-dropdown { position: relative; }
    
    @media (min-width: 1024px) {
        .dropdown-menu-box {
            position: absolute;
            top: calc(100% + 10px);
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity 0.22s ease, transform 0.22s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.22s ease;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(226, 232, 240, 0.9);
            box-shadow: 0 25px 60px -15px rgba(15, 23, 42, 0.18), 0 10px 25px -5px rgba(15, 23, 42, 0.04);
            border-radius: 1.25rem;
            padding: 1.5rem;
            z-index: 100;
        }

        /* Hover bridge to bridge gap between button and dropdown box */
        .dropdown-menu-box::before {
            content: '';
            position: absolute;
            top: -18px;
            left: 0;
            right: 0;
            height: 20px;
        }

        /* Specific Dropdown Widths & Alignments */
        .dropdown-menu-layanan {
            left: 50%;
            transform: translateX(-50%) translateY(10px);
            width: 740px;
        }
        
        .dropdown-menu-tentang {
            left: 50%;
            transform: translateX(-50%) translateY(10px);
            width: 360px;
        }

        .dropdown-menu-area {
            right: -20px;
            left: auto;
            transform: translateY(10px);
            width: 820px;
        }

        /* Hover & Active States */
        .nav-item-dropdown:hover .dropdown-menu-box,
        .nav-item-dropdown:focus-within .dropdown-menu-box {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        .nav-item-dropdown:hover .dropdown-menu-layanan,
        .nav-item-dropdown:focus-within .dropdown-menu-layanan,
        .nav-item-dropdown:hover .dropdown-menu-tentang,
        .nav-item-dropdown:focus-within .dropdown-menu-tentang {
            transform: translateX(-50%) translateY(0);
        }

        .nav-item-dropdown:hover .dropdown-menu-area,
        .nav-item-dropdown:focus-within .dropdown-menu-area {
            transform: translateY(0);
        }

        .nav-item-dropdown:hover .dropdown-chevron,
        .nav-item-dropdown:focus-within .dropdown-chevron {
            transform: rotate(180deg);
            color: #169F81;
        }
    }

    /* Mobile Accordion Styles */
    .mobile-accordion-content {
        max-height: 0;
        opacity: 0;
        overflow: hidden;
        transition: max-height 0.35s cubic-bezier(0, 1, 0, 1), opacity 0.25s ease-out;
    }
    .mobile-accordion-content.open {
        max-height: 1000px;
        opacity: 1;
        transition: max-height 0.35s ease-in-out, opacity 0.25s ease-in;
    }
</style>

<nav id="navbar" class="navbar relative z-[999]" role="navigation" aria-label="Navigasi utama">
    <div class="nav-container w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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

            {{-- Dropdown: Layanan --}}
            <li class="nav-item-dropdown group">
                <a href="{{ route('layanan') }}" class="nav-link inline-flex items-center gap-1.5 px-3 py-2 text-sm font-semibold text-slate-700 hover:text-emerald-600 rounded-lg transition-colors {{ request()->routeIs('layanan*') || request()->routeIs('b2b*') ? 'active text-emerald-600' : '' }}" aria-expanded="false">
                    <span>Layanan</span>
                    <svg class="dropdown-chevron w-4 h-4 text-slate-400 transition-transform duration-200 ease-out group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </a>

                {{-- Mega Menu Dropdown Layanan --}}
                <div class="dropdown-menu-box dropdown-menu-layanan text-slate-800">
                    <div class="grid grid-cols-12 gap-6">
                        {{-- Col 1: Kategori Utama --}}
                        <div class="col-span-7">
                            <div class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3 px-2">Kategori Utama Jasa Pipa</div>
                            <div class="grid grid-cols-1 gap-1">
                                <a href="{{ url('/layanan/wastafel-mampet') }}" class="group/item flex items-start gap-3 p-2.5 rounded-xl hover:bg-emerald-50/60 hover:translate-x-1 transition-all duration-150">
                                    <div class="w-9 h-9 rounded-lg bg-emerald-100/70 text-emerald-700 flex items-center justify-center font-bold text-lg group-hover/item:bg-emerald-600 group-hover/item:text-white transition-colors shrink-0">🚰</div>
                                    <div>
                                        <div class="font-bold text-sm text-slate-900 group-hover/item:text-emerald-600 transition-colors flex items-center gap-1.5">
                                            Wastafel & Sink Mampet
                                            <span class="text-[10px] font-extrabold px-1.5 py-0.5 bg-emerald-100 text-emerald-700 rounded-md">Populer</span>
                                        </div>
                                        <div class="text-xs text-slate-500 line-clamp-1">Pelancaran leher angsa & kerak lemak dapur</div>
                                    </div>
                                </a>

                                <a href="{{ url('/layanan/kamar-mandi-mampet') }}" class="group/item flex items-start gap-3 p-2.5 rounded-xl hover:bg-emerald-50/60 hover:translate-x-1 transition-all duration-150">
                                    <div class="w-9 h-9 rounded-lg bg-blue-100/70 text-blue-700 flex items-center justify-center font-bold text-lg group-hover/item:bg-blue-600 group-hover/item:text-white transition-colors shrink-0">🚿</div>
                                    <div>
                                        <div class="font-bold text-sm text-slate-900 group-hover/item:text-emerald-600 transition-colors">Kamar Mandi & Floor Drain</div>
                                        <div class="text-xs text-slate-500 line-clamp-1">Pembersihan saringan rontokan rambut & sabun</div>
                                    </div>
                                </a>

                                <a href="{{ url('/layanan/wc-toilet-mampet') }}" class="group/item flex items-start gap-3 p-2.5 rounded-xl hover:bg-emerald-50/60 hover:translate-x-1 transition-all duration-150">
                                    <div class="w-9 h-9 rounded-lg bg-amber-100/70 text-amber-700 flex items-center justify-center font-bold text-lg group-hover/item:bg-amber-600 group-hover/item:text-white transition-colors shrink-0">🚽</div>
                                    <div>
                                        <div class="font-bold text-sm text-slate-900 group-hover/item:text-emerald-600 transition-colors">WC & Kloset Toilet</div>
                                        <div class="text-xs text-slate-500 line-clamp-1">Evakuasi tisu/benda asing tanpa bongkar kloset</div>
                                    </div>
                                </a>

                                <a href="{{ url('/layanan/got-saluran-pembuangan') }}" class="group/item flex items-start gap-3 p-2.5 rounded-xl hover:bg-emerald-50/60 hover:translate-x-1 transition-all duration-150">
                                    <div class="w-9 h-9 rounded-lg bg-indigo-100/70 text-indigo-700 flex items-center justify-center font-bold text-lg group-hover/item:bg-indigo-600 group-hover/item:text-white transition-colors shrink-0">🌧️</div>
                                    <div>
                                        <div class="font-bold text-sm text-slate-900 group-hover/item:text-emerald-600 transition-colors">Got & Saluran Pembuangan</div>
                                        <div class="text-xs text-slate-500 line-clamp-1">Pelancaran talang hujan & bak kontrol meluap</div>
                                    </div>
                                </a>

                                <a href="{{ url('/layanan/inspeksi-pipa-kamera') }}" class="group/item flex items-start gap-3 p-2.5 rounded-xl hover:bg-emerald-50/60 hover:translate-x-1 transition-all duration-150">
                                    <div class="w-9 h-9 rounded-lg bg-rose-100/70 text-rose-700 flex items-center justify-center font-bold text-lg group-hover/item:bg-rose-600 group-hover/item:text-white transition-colors shrink-0">📷</div>
                                    <div>
                                        <div class="font-bold text-sm text-slate-900 group-hover/item:text-emerald-600 transition-colors">Inspeksi Kamera CCTV Pipa</div>
                                        <div class="text-xs text-slate-500 line-clamp-1">Deteksi kebocoran & posisi mampet di dalam dinding</div>
                                    </div>
                                </a>

                                <a href="{{ route('services.cuci-toren') }}" class="group/item flex items-start gap-3 p-2.5 rounded-xl hover:bg-emerald-50/60 hover:translate-x-1 transition-all duration-150">
                                    <div class="w-9 h-9 rounded-lg bg-teal-100/70 text-teal-700 flex items-center justify-center font-bold text-lg group-hover/item:bg-teal-600 group-hover/item:text-white transition-colors shrink-0">🚰</div>
                                    <div>
                                        <div class="font-bold text-sm text-slate-900 group-hover/item:text-emerald-600 transition-colors">Cuci Toren & Tandon Air</div>
                                        <div class="text-xs text-slate-500 line-clamp-1">Pengurasan lumut & lumpur food-grade safety</div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        {{-- Col 2: Komersial & B2B Box --}}
                        <div class="col-span-5 bg-gradient-to-br from-slate-900 via-slate-850 to-blue-950 p-4 rounded-xl text-white flex flex-col justify-between shadow-lg">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-400">Sektor B2B Komersial</span>
                                    <span class="text-[10px] bg-emerald-500/20 text-emerald-300 px-2 py-0.5 rounded-full font-bold border border-emerald-500/30">Kontrak SLA</span>
                                </div>
                                <p class="text-xs text-slate-300 mb-3">Layanan pelancaran pipa industri, restoran, hotel & gedung bertingkat dengan invoice & faktur PPN.</p>
                                
                                <div class="space-y-1 text-xs">
                                    <a href="{{ url('/sektor-plumbing/restoran-cafe') }}" class="flex items-center gap-2 p-2 rounded-lg hover:bg-white/10 text-slate-200 hover:text-white transition-colors">
                                        <span>🍽️</span> <span>Restoran, Cafe & Food Court</span>
                                    </a>
                                    <a href="{{ url('/sektor-plumbing/hotel-apartemen') }}" class="flex items-center gap-2 p-2 rounded-lg hover:bg-white/10 text-slate-200 hover:text-white transition-colors">
                                        <span>🏨</span> <span>Hotel, Apartemen & Kos</span>
                                    </a>
                                    <a href="{{ url('/sektor-plumbing/pabrik-industri') }}" class="flex items-center gap-2 p-2 rounded-lg hover:bg-white/10 text-slate-200 hover:text-white transition-colors">
                                        <span>🏭</span> <span>Pabrik & Kawasan Industri</span>
                                    </a>
                                </div>
                            </div>

                            <a href="{{ route('b2b.index') }}" class="mt-4 inline-flex items-center justify-center gap-1.5 w-full py-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs rounded-lg transition-colors text-center shadow-md">
                                Lihat Layanan B2B & Komersial &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </li>

            {{-- Dropdown: Tentang Kami --}}
            <li class="nav-item-dropdown group">
                <a href="{{ route('tentang-kami') }}" class="nav-link inline-flex items-center gap-1.5 px-3 py-2 text-sm font-semibold text-slate-700 hover:text-emerald-600 rounded-lg transition-colors {{ request()->routeIs('tentang-kami*') ? 'active text-emerald-600' : '' }}" aria-expanded="false">
                    <span>Tentang Kami</span>
                    <svg class="dropdown-chevron w-4 h-4 text-slate-400 transition-transform duration-200 ease-out group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </a>

                {{-- Dropdown Menu Tentang Kami --}}
                <div class="dropdown-menu-box dropdown-menu-tentang text-slate-800">
                    <div class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2 px-2">Informasi & Kredibilitas</div>
                    <div class="space-y-1">
                        <a href="{{ route('tentang-kami.profil') }}" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-emerald-50/60 hover:translate-x-1 transition-all duration-150 text-sm font-semibold text-slate-800 hover:text-emerald-600">
                            <span class="text-base">🏢</span>
                            <div>
                                <div>Profil Perusahaan & K3</div>
                                <div class="text-xs font-normal text-slate-500">Legalitas & komitmen keselamatan</div>
                            </div>
                        </a>
                        <a href="{{ route('tentang-kami.peralatan-teknologi') }}" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-emerald-50/60 hover:translate-x-1 transition-all duration-150 text-sm font-semibold text-slate-800 hover:text-emerald-600">
                            <span class="text-base">⚙️</span>
                            <div>
                                <div>Peralatan & Teknologi</div>
                                <div class="text-xs font-normal text-slate-500">Mesin Ridgid & Hydro Jetting</div>
                            </div>
                        </a>
                        <a href="{{ route('tentang-kami.portofolio-klien') }}" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-emerald-50/60 hover:translate-x-1 transition-all duration-150 text-sm font-semibold text-slate-800 hover:text-emerald-600">
                            <span class="text-base">📁</span>
                            <div>
                                <div>Klien & Portofolio B2B</div>
                                <div class="text-xs font-normal text-slate-500">Proyek gedung & industri</div>
                            </div>
                        </a>
                        <a href="{{ route('tentang-kami.garansi-layanan') }}" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-emerald-50/60 hover:translate-x-1 transition-all duration-150 text-sm font-semibold text-slate-800 hover:text-emerald-600">
                            <span class="text-base">🛡️</span>
                            <div>
                                <div>Garansi Pengerjaan</div>
                                <div class="text-xs font-normal text-slate-500">Jaminan tuntas 30 hari</div>
                            </div>
                        </a>
                        <a href="{{ route('faq.index') }}" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-emerald-50/60 hover:translate-x-1 transition-all duration-150 text-sm font-semibold text-slate-800 hover:text-emerald-600">
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

            {{-- Dropdown: Area Layanan --}}
            <li class="nav-item-dropdown group">
                <a href="{{ route('area-layanan') }}" class="nav-link inline-flex items-center gap-1.5 px-3 py-2 text-sm font-semibold text-slate-700 hover:text-emerald-600 rounded-lg transition-colors {{ request()->routeIs('area*') || request()->is('jasa-saluran-mampet*') ? 'active text-emerald-600' : '' }}" aria-expanded="false">
                    <span>Area Layanan</span>
                    <svg class="dropdown-chevron w-4 h-4 text-slate-400 transition-transform duration-200 ease-out group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </a>

                {{-- Mega Menu Dropdown Area Layanan --}}
                <div class="dropdown-menu-box dropdown-menu-area text-slate-800">
                    <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-100">
                        <div>
                            <div class="text-sm font-bold text-slate-900">Jangkauan Wilayah Operasional Rootera</div>
                            <div class="text-xs text-slate-500">Teknisi siaga 24 jam dengan waktu tiba cepat ke lokasi</div>
                        </div>
                        <a href="{{ route('area-layanan') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 hover:underline flex items-center gap-1">Lihat 50+ Kota & Kecamatan &rarr;</a>
                    </div>

                    <div class="grid grid-cols-4 gap-6">
                        {{-- DKI Jakarta --}}
                        <div>
                            <div class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-2 flex items-center gap-1">
                                <span class="text-emerald-600">📍</span> DKI Jakarta
                            </div>
                            <ul class="space-y-1 text-xs">
                                <li><a href="{{ url('/jasa-saluran-mampet/jakarta-barat') }}" class="hover:text-emerald-600 hover:translate-x-0.5 transition-all text-slate-600 block py-0.5">Jakarta Barat</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/jakarta-selatan') }}" class="hover:text-emerald-600 hover:translate-x-0.5 transition-all text-slate-600 block py-0.5">Jakarta Selatan</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/jakarta-pusat') }}" class="hover:text-emerald-600 hover:translate-x-0.5 transition-all text-slate-600 block py-0.5">Jakarta Pusat</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/jakarta-timur') }}" class="hover:text-emerald-600 hover:translate-x-0.5 transition-all text-slate-600 block py-0.5">Jakarta Timur</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/jakarta-utara') }}" class="hover:text-emerald-600 hover:translate-x-0.5 transition-all text-slate-600 block py-0.5">Jakarta Utara</a></li>
                            </ul>
                        </div>

                        {{-- Banten & Jawa Barat --}}
                        <div>
                            <div class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-2 flex items-center gap-1">
                                <span class="text-emerald-600">📍</span> Banten & Jabar
                            </div>
                            <ul class="space-y-1 text-xs">
                                <li><a href="{{ url('/jasa-saluran-mampet/tangerang') }}" class="hover:text-emerald-600 hover:translate-x-0.5 transition-all text-slate-600 block py-0.5">Tangerang Kota / BSD</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/tangerang-selatan') }}" class="hover:text-emerald-600 hover:translate-x-0.5 transition-all text-slate-600 block py-0.5">Tangerang Selatan</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/bekasi') }}" class="hover:text-emerald-600 hover:translate-x-0.5 transition-all text-slate-600 block py-0.5">Bekasi & Cikarang</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/depok') }}" class="hover:text-emerald-600 hover:translate-x-0.5 transition-all text-slate-600 block py-0.5">Depok & Cinere</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/bogor') }}" class="hover:text-emerald-600 hover:translate-x-0.5 transition-all text-slate-600 block py-0.5">Bogor & Cibubur</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/bandung') }}" class="hover:text-emerald-600 hover:translate-x-0.5 transition-all text-slate-600 block py-0.5">Bandung Raya</a></li>
                            </ul>
                        </div>

                        {{-- Jawa Tengah & DIY --}}
                        <div>
                            <div class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-2 flex items-center gap-1">
                                <span class="text-emerald-600">📍</span> Jateng & DIY
                            </div>
                            <ul class="space-y-1 text-xs">
                                <li><a href="{{ url('/jasa-saluran-mampet/semarang') }}" class="hover:text-emerald-600 hover:translate-x-0.5 transition-all text-slate-600 block py-0.5">Semarang</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/surakarta') }}" class="hover:text-emerald-600 hover:translate-x-0.5 transition-all text-slate-600 block py-0.5">Solo / Surakarta</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/yogyakarta') }}" class="hover:text-emerald-600 hover:translate-x-0.5 transition-all text-slate-600 block py-0.5">Yogyakarta</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/kabupaten-sleman') }}" class="hover:text-emerald-600 hover:translate-x-0.5 transition-all text-slate-600 block py-0.5">Sleman & Bantul</a></li>
                            </ul>
                        </div>

                        {{-- Jatim & Sumatra --}}
                        <div>
                            <div class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-2 flex items-center gap-1">
                                <span class="text-emerald-600">📍</span> Jatim & Sumatra
                            </div>
                            <ul class="space-y-1 text-xs">
                                <li><a href="{{ url('/jasa-saluran-mampet/surabaya') }}" class="hover:text-emerald-600 hover:translate-x-0.5 transition-all text-slate-600 block py-0.5">Surabaya</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/kabupaten-sidoarjo') }}" class="hover:text-emerald-600 hover:translate-x-0.5 transition-all text-slate-600 block py-0.5">Sidoarjo & Gresik</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/malang') }}" class="hover:text-emerald-600 hover:translate-x-0.5 transition-all text-slate-600 block py-0.5">Malang Raya</a></li>
                                <li><a href="{{ url('/jasa-saluran-mampet/bandar-lampung') }}" class="hover:text-emerald-600 hover:translate-x-0.5 transition-all text-slate-600 block py-0.5">Bandar Lampung</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

        {{-- Desktop CTA Button --}}
        <a href="{{ route('kontak') }}" class="nav-cta" id="nav-cta-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.65 3.42 2 2 0 0 1 3.62 1.24h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.82a16 16 0 0 0 6.29 6.29l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7a2 2 0 0 1 1.72 2.01z"/></svg>
            Hubungi Kami
        </a>

        {{-- Mobile Hamburger Button --}}
        <button class="nav-hamburger lg:hidden" id="hamburger-btn" aria-label="Buka menu navigasi" aria-expanded="false" aria-controls="mobile-drawer">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

{{-- Mobile Drawer Backdrop Overlay --}}
<div id="mobile-backdrop" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[9998] transition-opacity duration-300 opacity-0 pointer-events-none lg:hidden" aria-hidden="true"></div>

{{-- Mobile Off-Canvas Drawer Component --}}
<div id="mobile-drawer" class="fixed top-0 right-0 bottom-0 w-[88%] max-w-[380px] bg-white shadow-2xl z-[9999] transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col overflow-hidden lg:hidden" role="dialog" aria-modal="true" aria-label="Menu mobile">
    {{-- Header Drawer --}}
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100 bg-white">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <img src="{{ asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp') }}" alt="Logo Rootera" class="h-9 w-auto object-contain">
        </a>
        <button type="button" id="drawer-close-btn" class="p-2 rounded-xl text-slate-500 hover:text-slate-900 hover:bg-slate-100 transition-colors" aria-label="Tutup menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Body Drawer: Nav Links with Accordions --}}
    <div class="flex-1 overflow-y-auto px-4 py-5 space-y-1.5">
        {{-- Beranda --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl font-semibold text-slate-800 hover:bg-emerald-50/80 hover:text-emerald-600 transition-colors {{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-600 font-bold' : '' }}">
            <span class="text-lg">🏠</span>
            <span>Beranda</span>
        </a>

        {{-- Accordion 1: Layanan --}}
        <div class="rounded-xl overflow-hidden">
            <button type="button" class="mobile-accordion-toggle w-full flex items-center justify-between px-3.5 py-3 rounded-xl font-semibold text-slate-800 hover:bg-slate-50 transition-colors text-left" data-target="mobile-accordion-layanan">
                <div class="flex items-center gap-3">
                    <span class="text-lg">🛠️</span>
                    <span>Layanan</span>
                </div>
                <svg class="mobile-chevron w-4 h-4 text-slate-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div id="mobile-accordion-layanan" class="mobile-accordion-content pl-4 pr-2 space-y-1 bg-slate-50/80 rounded-xl my-1">
                <div class="py-2 space-y-1">
                    <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider px-3 mb-1">Layanan Utama</div>
                    <a href="{{ url('/layanan/wastafel-mampet') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-lg text-sm text-slate-700 hover:text-emerald-600 hover:bg-white transition-colors font-medium">
                        <span>🚰</span> Wastafel & Sink Mampet
                    </a>
                    <a href="{{ url('/layanan/kamar-mandi-mampet') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-lg text-sm text-slate-700 hover:text-emerald-600 hover:bg-white transition-colors font-medium">
                        <span>🚿</span> Kamar Mandi & Floor Drain
                    </a>
                    <a href="{{ url('/layanan/wc-toilet-mampet') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-lg text-sm text-slate-700 hover:text-emerald-600 hover:bg-white transition-colors font-medium">
                        <span>🚽</span> WC & Kloset Toilet
                    </a>
                    <a href="{{ url('/layanan/got-saluran-pembuangan') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-lg text-sm text-slate-700 hover:text-emerald-600 hover:bg-white transition-colors font-medium">
                        <span>🌧️</span> Got & Saluran Pembuangan
                    </a>
                    <a href="{{ url('/layanan/inspeksi-pipa-kamera') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-lg text-sm text-slate-700 hover:text-emerald-600 hover:bg-white transition-colors font-medium">
                        <span>📷</span> Inspeksi Kamera CCTV Pipa
                    </a>
                    <a href="{{ route('services.cuci-toren') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-lg text-sm text-slate-700 hover:text-emerald-600 hover:bg-white transition-colors font-medium">
                        <span>🚰</span> Jasa Cuci Toren &amp; Tandon Air
                    </a>

                    <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider px-3 mt-3 mb-1">Komersial & B2B</div>
                    <a href="{{ url('/sektor-plumbing/restoran-cafe') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-lg text-sm text-slate-700 hover:text-emerald-600 hover:bg-white transition-colors font-medium">
                        <span>🍽️</span> Restoran & Cafe
                    </a>
                    <a href="{{ url('/sektor-plumbing/hotel-apartemen') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-lg text-sm text-slate-700 hover:text-emerald-600 hover:bg-white transition-colors font-medium">
                        <span>🏨</span> Hotel & Apartemen
                    </a>
                    <a href="{{ url('/sektor-plumbing/pabrik-industri') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-lg text-sm text-slate-700 hover:text-emerald-600 hover:bg-white transition-colors font-medium">
                        <span>🏭</span> Pabrik & Industri
                    </a>
                    <a href="{{ route('b2b.index') }}" class="flex items-center justify-between py-2.5 px-3 rounded-lg text-xs font-bold text-emerald-700 bg-emerald-100/80 hover:bg-emerald-100 transition-colors mt-2">
                        <span>Lihat Layanan B2B & Komersial</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Accordion 2: Tentang Kami --}}
        <div class="rounded-xl overflow-hidden">
            <button type="button" class="mobile-accordion-toggle w-full flex items-center justify-between px-3.5 py-3 rounded-xl font-semibold text-slate-800 hover:bg-slate-50 transition-colors text-left" data-target="mobile-accordion-tentang">
                <div class="flex items-center gap-3">
                    <span class="text-lg">🏢</span>
                    <span>Tentang Kami</span>
                </div>
                <svg class="mobile-chevron w-4 h-4 text-slate-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div id="mobile-accordion-tentang" class="mobile-accordion-content pl-4 pr-2 space-y-1 bg-slate-50/80 rounded-xl my-1">
                <div class="py-2 space-y-1">
                    <a href="{{ route('tentang-kami.profil') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-lg text-sm text-slate-700 hover:text-emerald-600 hover:bg-white transition-colors font-medium">
                        <span>🏢</span> Profil Perusahaan & K3
                    </a>
                    <a href="{{ route('tentang-kami.peralatan-teknologi') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-lg text-sm text-slate-700 hover:text-emerald-600 hover:bg-white transition-colors font-medium">
                        <span>⚙️</span> Peralatan & Teknologi
                    </a>
                    <a href="{{ route('tentang-kami.portofolio-klien') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-lg text-sm text-slate-700 hover:text-emerald-600 hover:bg-white transition-colors font-medium">
                        <span>📁</span> Klien & Portofolio B2B
                    </a>
                    <a href="{{ route('tentang-kami.garansi-layanan') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-lg text-sm text-slate-700 hover:text-emerald-600 hover:bg-white transition-colors font-medium">
                        <span>🛡️</span> Garansi Pengerjaan
                    </a>
                    <a href="{{ route('faq.index') }}" class="flex items-center gap-2.5 py-2.5 px-3 rounded-lg text-sm text-slate-700 hover:text-emerald-600 hover:bg-white transition-colors font-medium">
                        <span>❓</span> FAQ / Pusat Bantuan
                    </a>
                </div>
            </div>
        </div>

        {{-- Galeri & Dokumentasi --}}
        <a href="{{ route('galeri') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl font-semibold text-slate-800 hover:bg-emerald-50/80 hover:text-emerald-600 transition-colors {{ request()->routeIs('galeri*') ? 'bg-emerald-50 text-emerald-600 font-bold' : '' }}">
            <span class="text-lg">📸</span>
            <span>Galeri & Dokumentasi</span>
        </a>

        {{-- Pengetahuan --}}
        <a href="{{ route('blog') }}" class="flex items-center gap-3 px-3.5 py-3 rounded-xl font-semibold text-slate-800 hover:bg-emerald-50/80 hover:text-emerald-600 transition-colors {{ request()->routeIs('blog*') ? 'bg-emerald-50 text-emerald-600 font-bold' : '' }}">
            <span class="text-lg">📚</span>
            <span>Pengetahuan</span>
        </a>

        {{-- Accordion 3: Area Layanan --}}
        <div class="rounded-xl overflow-hidden">
            <button type="button" class="mobile-accordion-toggle w-full flex items-center justify-between px-3.5 py-3 rounded-xl font-semibold text-slate-800 hover:bg-slate-50 transition-colors text-left" data-target="mobile-accordion-area">
                <div class="flex items-center gap-3">
                    <span class="text-lg">📍</span>
                    <span>Area Layanan</span>
                </div>
                <svg class="mobile-chevron w-4 h-4 text-slate-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div id="mobile-accordion-area" class="mobile-accordion-content pl-4 pr-2 space-y-1 bg-slate-50/80 rounded-xl my-1">
                <div class="py-2 space-y-1 text-sm">
                    <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider px-3 mb-1">DKI Jakarta</div>
                    <a href="{{ url('/jasa-saluran-mampet/jakarta-barat') }}" class="block py-1.5 px-3 text-slate-700 hover:text-emerald-600 font-medium">Jakarta Barat</a>
                    <a href="{{ url('/jasa-saluran-mampet/jakarta-selatan') }}" class="block py-1.5 px-3 text-slate-700 hover:text-emerald-600 font-medium">Jakarta Selatan</a>
                    <a href="{{ url('/jasa-saluran-mampet/jakarta-pusat') }}" class="block py-1.5 px-3 text-slate-700 hover:text-emerald-600 font-medium">Jakarta Pusat</a>

                    <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider px-3 mt-3 mb-1">Banten & Jawa Barat</div>
                    <a href="{{ url('/jasa-saluran-mampet/tangerang') }}" class="block py-1.5 px-3 text-slate-700 hover:text-emerald-600 font-medium">Tangerang & BSD</a>
                    <a href="{{ url('/jasa-saluran-mampet/bekasi') }}" class="block py-1.5 px-3 text-slate-700 hover:text-emerald-600 font-medium">Bekasi & Cikarang</a>
                    <a href="{{ url('/jasa-saluran-mampet/bandung') }}" class="block py-1.5 px-3 text-slate-700 hover:text-emerald-600 font-medium">Bandung Raya</a>

                    <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider px-3 mt-3 mb-1">Jateng, DIY & Jatim</div>
                    <a href="{{ url('/jasa-saluran-mampet/semarang') }}" class="block py-1.5 px-3 text-slate-700 hover:text-emerald-600 font-medium">Semarang</a>
                    <a href="{{ url('/jasa-saluran-mampet/yogyakarta') }}" class="block py-1.5 px-3 text-slate-700 hover:text-emerald-600 font-medium">Yogyakarta</a>
                    <a href="{{ url('/jasa-saluran-mampet/surabaya') }}" class="block py-1.5 px-3 text-slate-700 hover:text-emerald-600 font-medium">Surabaya & Sidoarjo</a>

                    <a href="{{ route('area-layanan') }}" class="flex items-center justify-between py-2.5 px-3 rounded-lg text-xs font-bold text-emerald-700 bg-emerald-100/80 hover:bg-emerald-100 transition-colors mt-3">
                        <span>Lihat Semua 50+ Kota</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer Drawer: Quick CTA --}}
    <div class="p-4 border-t border-slate-100 bg-slate-50/90 flex flex-col gap-2.5">
        <div class="flex items-center justify-between px-1 text-[11px] text-slate-500 font-semibold">
            <span class="flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Teknisi Siaga 24 Jam
            </span>
            <span class="text-emerald-600 font-bold">Respon Cepat</span>
        </div>
        <a href="https://wa.me/6281385404000?text=Halo%20Rootera,%20saya%20butuh%20bantuan%20saluran%20pipa%20mampet" target="_blank" rel="noopener" class="flex items-center justify-center gap-2.5 w-full py-3.5 px-4 bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-emerald-600/30 transition-all text-center">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
            </svg>
            <span>Hubungi Kami (WhatsApp)</span>
        </a>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const drawerCloseBtn = document.getElementById('drawer-close-btn');
    const mobileDrawer = document.getElementById('mobile-drawer');
    const mobileBackdrop = document.getElementById('mobile-backdrop');
    const accordionToggles = document.querySelectorAll('.mobile-accordion-toggle');

    function openMobileMenu() {
        if (!mobileDrawer || !mobileBackdrop || !hamburgerBtn) return;
        mobileDrawer.classList.remove('translate-x-full');
        mobileDrawer.classList.add('translate-x-0');
        mobileBackdrop.classList.remove('opacity-0', 'pointer-events-none');
        mobileBackdrop.classList.add('opacity-100', 'pointer-events-auto');
        hamburgerBtn.classList.add('open');
        hamburgerBtn.setAttribute('aria-expanded', 'true');
        document.body.classList.add('overflow-hidden');
    }

    function closeMobileMenu() {
        if (!mobileDrawer || !mobileBackdrop || !hamburgerBtn) return;
        mobileDrawer.classList.remove('translate-x-0');
        mobileDrawer.classList.add('translate-x-full');
        mobileBackdrop.classList.remove('opacity-100', 'pointer-events-auto');
        mobileBackdrop.classList.add('opacity-0', 'pointer-events-none');
        hamburgerBtn.classList.remove('open');
        hamburgerBtn.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('overflow-hidden');
    }

    if (hamburgerBtn) {
        hamburgerBtn.addEventListener('click', function () {
            const isOpen = mobileDrawer.classList.contains('translate-x-0');
            if (isOpen) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });
    }

    if (drawerCloseBtn) {
        drawerCloseBtn.addEventListener('click', closeMobileMenu);
    }

    if (mobileBackdrop) {
        mobileBackdrop.addEventListener('click', closeMobileMenu);
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && mobileDrawer && mobileDrawer.classList.contains('translate-x-0')) {
            closeMobileMenu();
        }
    });

    accordionToggles.forEach(toggle => {
        toggle.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const targetContent = document.getElementById(targetId);
            const chevron = this.querySelector('.mobile-chevron');

            if (targetContent) {
                const isOpen = targetContent.classList.contains('open');

                // Accordion behavior: close other open accordions
                document.querySelectorAll('.mobile-accordion-content').forEach(el => {
                    if (el.id !== targetId) {
                        el.classList.remove('open');
                    }
                });
                document.querySelectorAll('.mobile-chevron').forEach(el => {
                    if (el !== chevron) {
                        el.classList.remove('rotate-180');
                    }
                });

                if (isOpen) {
                    targetContent.classList.remove('open');
                    if (chevron) chevron.classList.remove('rotate-180');
                } else {
                    targetContent.classList.add('open');
                    if (chevron) chevron.classList.add('rotate-180');
                }
            }
        });
    });
});
</script>
