<footer class="footer bg-[#061434] text-slate-300 relative overflow-hidden" role="contentinfo">
    {{-- Wave SVG Top --}}
    <div class="footer-wave" aria-hidden="true">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80" preserveAspectRatio="none" style="display:block; width:100%; height:40px;">
            <path d="M0,40 C360,80 1080,0 1440,80 L1440,80 L0,80 Z" fill="#061434"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-12">
        
        {{-- BAGIAN 1: BRAND IDENTITY, TRUST BADGES & QUICK CONTACT --}}
        <div class="pb-10 mb-8 border-b border-slate-800/80 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
            {{-- Brand Info & Badges --}}
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                <a href="{{ route('home') }}" aria-label="Rootera Beranda" class="flex-shrink-0">
                    <img src="{{ asset('images/logo final.png') }}" alt="Rootera Plumbing Logo" loading="lazy" style="height: 75px; width: auto; object-fit: contain;">
                </a>
                <div>
                    <div class="flex items-center gap-2 mb-2 flex-wrap">
                        <span class="bg-[#169F81]/20 text-[#2dd4bf] border border-[#169F81]/40 px-3 py-0.5 rounded-full text-xs font-extrabold uppercase tracking-wider">
                            Divisi Plumbing Resmi J&amp;J GROUP
                        </span>
                        <span class="bg-emerald-500/20 text-emerald-300 border border-emerald-500/40 px-3 py-0.5 rounded-full text-xs font-bold">
                            Garansi Resmi 30 Hari Kerja
                        </span>
                        <span class="bg-amber-500/20 text-amber-300 border border-amber-500/40 px-3 py-0.5 rounded-full text-xs font-bold">
                            Layanan Darurat 24 Jam Nonstop
                        </span>
                        <span class="bg-blue-500/20 text-blue-300 border border-blue-500/40 px-3 py-0.5 rounded-full text-xs font-bold">
                            Teknisi Tersertifikasi &amp; Mesin Rotary
                        </span>
                    </div>
                    <p class="text-xs sm:text-sm text-slate-300 max-w-xl leading-relaxed">
                        <strong class="text-white">Rootera Plumbing</strong> — Solusi Pelancaran Pipa Mampet &amp; Hydro-Jetting Modern Tanpa Bongkar. Layanan profesional untuk hunian residensial, ruko, restoran, apartemen, serta kontrak preventive maintenance B2B perusahaan di seluruh Indonesia.
                    </p>
                </div>
            </div>

            {{-- Quick Action Callout & Social Links --}}
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <div class="flex flex-col gap-2">
                    <a href="https://wa.me/6281385404000?text=Halo%20Rootera%2C%20saya%20butuh%20bantuan%20pelancar%20pipa%20mampet." target="_blank" rel="noopener noreferrer" class="bg-[#25D366] hover:bg-[#1EBE5A] text-white font-bold text-xs sm:text-sm px-5 py-2.5 rounded-full flex items-center gap-2 transition-all shadow-lg hover:shadow-green-500/20 text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                        <span>WhatsApp CS 24 Jam: +62 813-8540-4000</span>
                    </a>
                    <a href="mailto:rootera.plumbing@gmail.com" class="text-xs text-slate-300 hover:text-white flex items-center gap-1.5 px-3 py-1 rounded bg-slate-800/60 hover:bg-slate-800 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        Email: rootera.plumbing@gmail.com
                    </a>
                </div>

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
        </div>

        {{-- BAGIAN 2: MULTI-COLUMN SEO SILO GRID (6 KOLOM) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 text-xs text-slate-300 py-4 pb-8">
            
            {{-- KOLOM 1: KANTOR PUSAT & WORKSHOP --}}
            <div class="space-y-3">
                <h4 class="font-bold text-white text-xs uppercase tracking-wider flex items-center gap-1.5 border-b border-blue-500/30 pb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#2dd4bf" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    KANTOR PUSAT &amp; WORKSHOP
                </h4>
                <p class="text-xs text-slate-300 leading-relaxed">
                    <strong class="text-white">Rootera Plumbing (J&amp;J GROUP)</strong><br>
                    Gg. Mawar No.6B.1, RT.7/RW.1, Cijantung, Kec. Pasar Rebo, Kota Jakarta Timur, DKI Jakarta 13770
                </p>
                <div class="text-[11px] text-amber-300 bg-amber-500/10 px-2.5 py-1 rounded border border-amber-500/20 font-medium">
                    🕒 Jam Operasional: Buka 24 Jam (Senin – Minggu)
                </div>
                <div class="w-full h-40 rounded-xl overflow-hidden border border-slate-700 shadow-md">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.5128341974773!2d106.8627791!3d-6.3275261!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed006e00b8b5%3A0xde36fb02cfc2b7a5!2sRootera%20Plumbing%20-%20Jasa%20Saluran%20Pipa%20Mampet!5e0!3m2!1sid!2sid!4v1787559252154!5m2!1sid!2sid" 
                        class="w-full h-full border-0" 
                        loading="lazy"
                        title="Peta Lokasi Resmi Rootera Plumbing Google Maps">
                    </iframe>
                </div>
            </div>

            {{-- KOLOM 2: LAYANAN RESIDENSIAL --}}
            <div class="space-y-3">
                <h4 class="font-bold text-white text-xs uppercase tracking-wider border-b border-blue-500/30 pb-2">
                    LAYANAN RESIDENSIAL
                </h4>
                <ul class="space-y-2 text-xs text-slate-300">
                    <li><a href="{{ url('/layanan/wastafel-mampet') }}" class="hover:text-white transition duration-150 inline-block">Jasa Pipa Wastafel Mampet</a></li>
                    <li><a href="{{ url('/layanan/wc-toilet-mampet') }}" class="hover:text-white transition duration-150 inline-block">Pelancaran Kloset &amp; Toilet</a></li>
                    <li><a href="{{ url('/layanan/wastafel-mampet') }}" class="hover:text-white transition duration-150 inline-block">Pipa Kitchen Sink Dapur</a></li>
                    <li><a href="{{ url('/layanan/kamar-mandi-mampet') }}" class="hover:text-white transition duration-150 inline-block">Floor Drain Kamar Mandi</a></li>
                    <li><a href="{{ url('/layanan/got-saluran-pembuangan') }}" class="hover:text-white transition duration-150 inline-block">Talang Hujan &amp; Pipa Rooftop</a></li>
                    <li><a href="{{ url('/layanan/got-saluran-pembuangan') }}" class="hover:text-white transition duration-150 inline-block">Bak Kontrol &amp; Got Utama</a></li>
                    <li><a href="{{ url('/sektor-plumbing/restoran-cafe') }}" class="hover:text-white transition duration-150 inline-block">Sedot Lemak (Grease Trap)</a></li>
                    <li><a href="{{ route('property.index') }}" class="text-amber-300 font-semibold hover:text-amber-200 transition duration-150 inline-block">Hub Solusi Properti →</a></li>
                </ul>
            </div>

            {{-- KOLOM 3: SOLUSI B2B & KOMERSIAL --}}
            <div class="space-y-3">
                <h4 class="font-bold text-white text-xs uppercase tracking-wider border-b border-blue-500/30 pb-2">
                    SOLUSI B2B &amp; KOMERSIAL
                </h4>
                <ul class="space-y-2 text-xs text-slate-300">
                    <li><a href="{{ url('/sektor-plumbing/restoran-cafe') }}" class="hover:text-white transition duration-150 inline-block">Maintenance Restoran &amp; Kafe</a></li>
                    <li><a href="{{ url('/sektor-plumbing/ruko-perkantoran') }}" class="hover:text-white transition duration-150 inline-block">Pembersihan Saluran Ruko</a></li>
                    <li><a href="{{ url('/sektor-plumbing/pabrik-industri') }}" class="hover:text-white transition duration-150 inline-block">Hydro-Jetting Kawasan Industri</a></li>
                    <li><a href="{{ url('/sektor-plumbing/hotel-apartemen') }}" class="hover:text-white transition duration-150 inline-block">Maintenance Apartemen &amp; Hotel</a></li>
                    <li><a href="{{ url('/sektor-plumbing/rumah-sakit-klinik') }}" class="hover:text-white transition duration-150 inline-block">Drainase Rumah Sakit &amp; Klinik</a></li>
                    <li><a href="{{ url('/sektor-plumbing/mall-shopping-center') }}" class="hover:text-white transition duration-150 inline-block">Saluran Pabrik &amp; Mall</a></li>
                    <li><a href="{{ route('b2b.index') }}" class="hover:text-white transition duration-150 inline-block">Audit CCTV Pipeline Inspection</a></li>
                    <li><a href="{{ route('b2b.index') }}" class="text-emerald-400 font-semibold hover:text-emerald-300 transition duration-150 inline-block">Hub Kontrak B2B →</a></li>
                </ul>
            </div>

            {{-- KOLOM 4: AREA JABODETABEK --}}
            <div class="space-y-3">
                <h4 class="font-bold text-white text-xs uppercase tracking-wider border-b border-blue-500/30 pb-2">
                    AREA JABODETABEK
                </h4>
                <ul class="space-y-2 text-xs text-slate-300">
                    <li><a href="{{ url('/jasa-saluran-mampet/jakarta-selatan') }}" class="hover:text-white transition duration-150 inline-block">Jaksel (Cilandak, Tebet, Kemang)</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/jakarta-timur') }}" class="hover:text-white transition duration-150 inline-block">Jaktim (Pasar Rebo, Cibubur, Cakung)</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/jakarta-barat') }}" class="hover:text-white transition duration-150 inline-block">Jakbar (Puri Indah, Kebon Jeruk)</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/jakarta-pusat') }}" class="hover:text-white transition duration-150 inline-block">Jakpus (Menteng, Tanah Abang)</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/jakarta-utara') }}" class="hover:text-white transition duration-150 inline-block">Jakut (Kelapa Gading, PIK, Pluit)</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/bogor') }}" class="hover:text-white transition duration-150 inline-block">Bogor &amp; Depok (Margonda, Sentul)</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/tangerang-selatan') }}" class="hover:text-white transition duration-150 inline-block">Tangsel &amp; Tangerang (BSD, Serpong)</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/bekasi') }}" class="hover:text-white transition duration-150 inline-block">Bekasi &amp; Cikarang Industri</a></li>
                </ul>
            </div>

            {{-- KOLOM 5: EKSPANSI LUAR JABODETABEK --}}
            <div class="space-y-3">
                <h4 class="font-bold text-white text-xs uppercase tracking-wider border-b border-blue-500/30 pb-2">
                    EKSPANSI KOTA LAIN
                </h4>
                <ul class="space-y-2 text-xs text-slate-300">
                    <li><a href="{{ url('/jasa-saluran-mampet/bandung') }}" class="hover:text-white transition duration-150 inline-block">Cabang Bandung &amp; Cimahi</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/cirebon') }}" class="hover:text-white transition duration-150 inline-block">Cabang Cirebon &amp; Majalengka</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/semarang') }}" class="hover:text-white transition duration-150 inline-block">Cabang Semarang &amp; Kendal</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/solo') }}" class="hover:text-white transition duration-150 inline-block">Cabang Solo / Surakarta Raya</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/yogyakarta') }}" class="hover:text-white transition duration-150 inline-block">Cabang D.I. Yogyakarta &amp; Sleman</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/surabaya') }}" class="hover:text-white transition duration-150 inline-block">Cabang Surabaya &amp; Sidoarjo</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/serang') }}" class="hover:text-white transition duration-150 inline-block">Cabang Serang &amp; Cilegon</a></li>
                    <li><a href="{{ url('/jasa-saluran-mampet/bandar-lampung') }}" class="hover:text-white transition duration-150 inline-block">Cabang Bandar Lampung</a></li>
                </ul>
            </div>

            {{-- KOLOM 6: PERUSAHAAN & LEGALITAS (E-E-A-T) --}}
            <div class="space-y-3">
                <h4 class="font-bold text-white text-xs uppercase tracking-wider border-b border-blue-500/30 pb-2">
                    PERUSAHAAN &amp; LEGALITAS
                </h4>
                <ul class="space-y-2 text-xs text-slate-300">
                    <li><a href="{{ route('tentang-kami') }}" class="hover:text-white transition duration-150 inline-block">Profil Holding J&amp;J Group</a></li>
                    <li><a href="{{ route('tentang-kami') }}" class="hover:text-white transition duration-150 inline-block">SOP &amp; Protokol Sanitasi</a></li>
                    <li><a href="{{ route('tentang-kami') }}" class="hover:text-white transition duration-150 inline-block">Ketentuan Garansi 30 Hari</a></li>
                    <li><a href="{{ route('galeri') }}" class="hover:text-white transition duration-150 inline-block">Portofolio &amp; Galeri Proyek</a></li>
                    <li><a href="{{ route('blog') }}" class="hover:text-white transition duration-150 inline-block">Blog &amp; Edukasi Plumbing</a></li>
                    <li><a href="{{ route('faq.index') }}" class="hover:text-white transition duration-150 inline-block">FAQ Seputar Pipa Mampet</a></li>
                    <li><a href="{{ route('kontak') }}" class="hover:text-white transition duration-150 inline-block">Syarat &amp; Kebijakan Privasi</a></li>
                    <li><a href="{{ route('kontak') }}" class="hover:text-white transition duration-150 inline-block">Permintaan Faktur Pajak</a></li>
                </ul>
            </div>

        </div>

        {{-- BAGIAN 3: BOTTOM BAR & LEGAL COPYRIGHT --}}
        <div class="border-t border-slate-800 pt-6 mt-4 flex flex-col md:flex-row items-center justify-between text-xs text-slate-400 gap-4">
            <p class="text-center md:text-left leading-relaxed">
                &copy; {{ date('Y') }} <strong class="text-white">Rootera Plumbing</strong> (J&amp;J Group). Hak Cipta Dilindungi Undang-Undang.<br>
                <span class="text-[11px] text-slate-500">Seluruh pengerjaan pelancaran pipa menggunakan peralatan bebas kimia ramah lingkungan &amp; sesuai standar sanitasi kesehatan.</span>
            </p>
            <div class="flex items-center gap-6 text-xs flex-wrap justify-center">
                <a href="{{ route('tentang-kami') }}" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="{{ route('kontak') }}" class="hover:text-white transition-colors">Terms of Service</a>
                <a href="{{ route('b2b.index') }}" class="hover:text-white transition-colors">B2B Licensing</a>
                <a href="{{ route('faq.index') }}" class="hover:text-white transition-colors">Help Center</a>
            </div>
        </div>

    </div>
</footer>
