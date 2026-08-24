<footer class="footer bg-[#061434] text-slate-300 relative overflow-hidden" role="contentinfo">
    {{-- Wave SVG Top --}}
    <div class="footer-wave" aria-hidden="true">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80" preserveAspectRatio="none" style="display:block; width:100%; height:40px;">
            <path d="M0,40 C360,80 1080,0 1440,80 L1440,80 L0,80 Z" fill="#061434"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-12">
        {{-- Top Section: Brand Identity, Badges & Emergency Callout --}}
        <div class="pb-8 mb-8 border-b border-slate-800/80 grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
            {{-- Brand Info & Badges --}}
            <div class="lg:col-span-7 flex flex-col sm:flex-row items-start sm:items-center gap-5">
                <a href="{{ route('home') }}" aria-label="Rootera Beranda" class="flex-shrink-0">
                    <img src="{{ asset('images/logo final.png') }}" alt="Rootera Plumbing Logo" loading="lazy" style="height: 80px; width: auto; object-fit: contain;">
                </a>
                <div>
                    <div class="flex items-center gap-2 mb-2 flex-wrap">
                        <span class="bg-[#169F81]/20 text-[#2dd4bf] border border-[#169F81]/40 px-3 py-0.5 rounded-full text-xs font-extrabold uppercase tracking-wider">
                            Divisi Plumbing Resmi J&amp;J GROUP
                        </span>
                        <span class="bg-blue-500/20 text-blue-300 border border-blue-500/40 px-3 py-0.5 rounded-full text-xs font-bold">
                            Garansi Resmi 30 Hari
                        </span>
                        <span class="bg-amber-500/20 text-amber-300 border border-amber-500/40 px-3 py-0.5 rounded-full text-xs font-bold">
                            Layanan Darurat 24 Jam Nonstop
                        </span>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-300 max-w-xl leading-relaxed">
                        Layanan profesional pelancaran pipa mampet tanpa bongkar menggunakan mesin spiral rotary &amp; hydro-jetting modern untuk hunian residensial, ruko, restoran, apartemen, serta kontrak preventive maintenance B2B perusahaan di seluruh Indonesia.
                    </p>
                </div>
            </div>

            {{-- Quick Action Callout & Social Links --}}
            <div class="lg:col-span-5 flex flex-col sm:flex-row items-start sm:items-center lg:justify-end gap-4">
                <a href="https://wa.me/6281385404000?text=Halo%20Rootera%2C%20saya%20butuh%20bantuan%20pelancar%20pipa%20mampet." target="_blank" rel="noopener noreferrer" class="bg-[#25D366] hover:bg-[#1EBE5A] text-white font-bold text-xs sm:text-sm px-5 py-2.5 rounded-full flex items-center gap-2 transition-all shadow-lg hover:shadow-green-500/20 text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                    <span>CS WhatsApp 24 Jam (+62 813-8540-4000)</span>
                </a>
                
                {{-- Social Media Links --}}
                <div class="flex items-center gap-2.5">
                    <a href="https://www.instagram.com/Rootera_plumbing?igsh=c2NkbXA1b3h6MTVy" target="_blank" rel="noopener noreferrer" aria-label="Instagram Rootera" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-[#169F81] text-slate-300 hover:text-white flex items-center justify-center transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                    <a href="https://facebook.com/Rootera.id" target="_blank" rel="noopener noreferrer" aria-label="Facebook Rootera" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-[#1E73D8] text-slate-300 hover:text-white flex items-center justify-center transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <a href="https://tiktok.com/@rootera_plumbing" target="_blank" rel="noopener noreferrer" aria-label="TikTok Rootera" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white flex items-center justify-center transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 3 15.68a6.34 6.34 0 0 0 10.86 4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1.04-.13z"/></svg>
                    </a>
            </div>
        </div>

        {{-- Official Google Business Profile Map --}}
        <div class="pb-8 mb-8 border-b border-slate-800/80">
            <div class="flex items-center justify-between mb-3 flex-wrap gap-2">
                <h3 class="text-white font-bold text-xs md:text-sm uppercase tracking-wider flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2dd4bf" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Lokasi Kantor Pusat Operasional (Verified Google Business Profile)
                </h3>
                <span class="text-xs text-slate-400">Gg. Mawar No.6B.1, Cijantung, Pasar Rebo, Jakarta Timur</span>
            </div>
            <x-google-map-embed />
        </div>

        {{-- Mega Link Directory (6-Column Grid Layout) --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 lg:gap-8 pt-4 pb-8">
            
            {{-- KOLOM 1: LAYANAN RESIDENSIAL & PROPERTI --}}
            <div>
                <h3 class="text-white font-bold text-xs md:text-sm uppercase tracking-wider mb-4 border-b border-blue-500/30 pb-2">
                    Layanan Residensial
                </h3>
                <ul class="space-y-2 text-xs text-slate-300">
                    <li><a href="{{ route('property.index') }}" class="text-amber-300 font-bold hover:text-amber-200 hover:translate-x-0.5 transition duration-150 inline-block">Hub Kategori Properti →</a></li>
                    <li><a href="{{ url('/solusi-properti/rumah-tinggal') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Rumah Tinggal &amp; Cluster</a></li>
                    <li><a href="{{ url('/solusi-properti/cafe-restoran') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Cafe, Resto &amp; Foodcourt</a></li>
                    <li><a href="{{ url('/solusi-properti/hotel-apartemen') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Kos-Kosan &amp; Apartemen</a></li>
                    <li><a href="{{ url('/layanan/wastafel-mampet') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Wastafel &amp; Kitchen Sink Dapur</a></li>
                    <li><a href="{{ url('/layanan/kamar-mandi-mampet') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Floor Drain Kamar Mandi</a></li>
                    <li><a href="{{ url('/layanan/wc-toilet-mampet') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Kloset &amp; Toilet Meluap</a></li>
                    <li><a href="{{ url('/layanan/got-saluran-pembuangan') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Saluran Got &amp; Bak Kontrol</a></li>
                </ul>
            </div>

            {{-- KOLOM 2: KOMERSIAL, B2B & INDUSTRI --}}
            <div>
                <h3 class="text-white font-bold text-xs md:text-sm uppercase tracking-wider mb-4 border-b border-blue-500/30 pb-2">
                    Komersial &amp; B2B
                </h3>
                <ul class="space-y-2 text-xs text-slate-300">
                    <li><a href="{{ route('b2b.index') }}" class="text-amber-300 font-bold hover:text-amber-200 hover:translate-x-0.5 transition duration-150 inline-block">Hub B2B Komersial →</a></li>
                    <li><a href="{{ url('/sektor-plumbing/restoran-cafe') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Grease Trap Cafe &amp; Resto</a></li>
                    <li><a href="{{ url('/sektor-plumbing/hotel-apartemen') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Riser Stack Hotel &amp; Apartemen</a></li>
                    <li><a href="{{ url('/sektor-plumbing/pabrik-industri') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Hydro Jetting Pabrik &amp; Gudang</a></li>
                    <li><a href="{{ url('/sektor-plumbing/rumah-sakit-klinik') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Drainase Rumah Sakit &amp; Klinik</a></li>
                    <li><a href="{{ url('/sektor-plumbing/instansi-kampus') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Tender Instansi &amp; Kampus</a></li>
                    <li><a href="{{ url('/sektor-plumbing/mall-shopping-center') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Food Court Mall &amp; Shopping Center</a></li>
                    <li><a href="{{ url('/kontrak-maintenance-saluran/restoran-cafe') }}" class="text-emerald-400 font-semibold hover:text-emerald-300 transition duration-150 inline-block">Kontrak Maintenance B2B →</a></li>
                </ul>
            </div>

            {{-- KOLOM 3: AREA JAKARTA & BOGOR --}}
            <div>
                <h3 class="text-white font-bold text-xs md:text-sm uppercase tracking-wider mb-4 border-b border-blue-500/30 pb-2">
                    Jakarta &amp; Bogor
                </h3>
                <ul class="space-y-2 text-xs text-slate-300">
                    <li><a href="{{ url('/jasa-saluran-mampet/jakarta-selatan') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Jaksel (Tebet, Cilandak, Kemang)</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/jakarta-timur') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Jaktim (Cijantung, Cibubur, Cakung)</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/jakarta-barat') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Jakbar (Puri Indah, Meruya, Kebon Jeruk)</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/jakarta-pusat') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Jakpus (Menteng, Tanah Abang)</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/jakarta-utara') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Jakut (Kelapa Gading, PIK, Pluit)</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/bogor') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Kota Bogor (Pajajaran, Baranangsiang)</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/kabupaten-bogor') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Kab. Bogor (Cibinong, Sentul City)</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/kabupaten-bogor') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Puncak Bogor (Cisarua, Megamendung)</a></li>
                </ul>
            </div>

            {{-- KOLOM 4: AREA DEPOK, TANGERANG & BEKASI --}}
            <div>
                <h3 class="text-white font-bold text-xs md:text-sm uppercase tracking-wider mb-4 border-b border-blue-500/30 pb-2">
                    Depok, Tangerang &amp; Bekasi
                </h3>
                <ul class="space-y-2 text-xs text-slate-300">
                    <li><a href="{{ url('/jasa-saluran-mampet/depok') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Depok (Margonda, Sawangan, Cinere)</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/tangerang-selatan') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Tangsel (Bintaro Jaya, BSD City, Serpong)</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/tangerang') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Kota Tangerang (Ciledug, Karawaci)</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/kabupaten-tangerang') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Kab. Tangerang (Citra Raya, Cikupa)</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/bekasi') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Kota Bekasi (Grand Galaxy, Jatiasih)</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/bekasi') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Bekasi Barat, Timur &amp; Pondok Gede</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/kabupaten-bekasi') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Cikarang Industri (MM2100 &amp; Jababeka)</a></li>
                </ul>
            </div>

            {{-- KOLOM 5: AREA BANTEN, JABAR, JATENG, DIY & LAINNYA --}}
            <div>
                <h3 class="text-white font-bold text-xs md:text-sm uppercase tracking-wider mb-4 border-b border-blue-500/30 pb-2">
                    Banten, Jabar, Jateng &amp; DIY
                </h3>
                <ul class="space-y-2 text-xs text-slate-300">
                    <li><a href="{{ url('/jasa-saluran-mampet/serang') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Serang Kota, Cipocok &amp; Jawilan</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/serang') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Kawasan Industri Cikande &amp; Balaraja</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/bandung') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Bandung Raya &amp; Cimahi</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/cirebon') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Cirebon &amp; Sekitarnya</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/semarang') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Kota Semarang (16 Kecamatan)</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/yogyakarta') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">D.I. Yogyakarta (Kraton &amp; Sleman)</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/solo') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Solo / Surakarta Raya</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/surabaya') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Surabaya, Sidoarjo &amp; Malang</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/bandar-lampung') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Bandar Lampung &amp; Sekitarnya</a></li>
                </ul>
            </div>

            {{-- KOLOM 6: PERUSAHAAN, EDUKASI & LEGAL --}}
            <div>
                <h3 class="text-white font-bold text-xs md:text-sm uppercase tracking-wider mb-4 border-b border-blue-500/30 pb-2">
                    Perusahaan &amp; Info Legal
                </h3>
                <ul class="space-y-2 text-xs text-slate-300">
                    <li><a href="{{ route('tentang-kami') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Tentang Rootera Plumbing</a></li>
                    <li><a href="{{ route('tentang-kami') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Profil Holding J&amp;J GROUP</a></li>
                    <li><a href="{{ route('blog') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Pusat Edukasi &amp; Artikel Blog</a></li>
                    <li><a href="{{ route('galeri') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Galeri Proyek (Before/After)</a></li>
                    <li><a href="{{ route('tentang-kami') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Ketentuan Garansi 30 Hari</a></li>
                    <li><a href="{{ route('kontak') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Hubungi CS &amp; Sales B2B</a></li>
                    <li><a href="{{ route('kontak') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Permintaan Invoice &amp; Faktur Pajak</a></li>
                    <li><a href="{{ route('kontak') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Syarat &amp; Ketentuan Layanan</a></li>
                    <li><a href="{{ route('tentang-kami') }}" class="hover:text-blue-400 hover:translate-x-0.5 transition duration-150 inline-block">Kebijakan Privasi (Privacy Policy)</a></li>
                </ul>
            </div>

        </div>

        {{-- Bottom Copyright Bar --}}
        <div class="border-t border-slate-800 pt-6 mt-4 flex flex-col md:flex-row items-center justify-between text-xs text-slate-400 gap-4">
            <p class="text-center md:text-left">
                &copy; {{ date('Y') }} <strong class="text-white">Rootera Plumbing</strong> — Divisi Plumbing Resmi <strong class="text-white">J&amp;J GROUP</strong>. Hak Cipta Dilindungi Undang-Undang.
            </p>
            <div class="flex items-center gap-6">
                <a href="{{ route('tentang-kami') }}" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="{{ route('kontak') }}" class="hover:text-white transition-colors">Terms of Service</a>
                <a href="{{ route('kontak') }}" class="hover:text-white transition-colors">B2B Corporate Licensing</a>
            </div>
        </div>
    </div>
</footer>
