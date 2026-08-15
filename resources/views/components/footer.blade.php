<footer class="bg-slate-950 text-white pt-16 pb-12 border-t border-slate-800" role="contentinfo">
    <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 pb-12 border-b border-slate-800">
            
            {{-- Col 1: Brand & Tagline (4 cols) --}}
            <div class="lg:col-span-4 flex flex-col justify-between">
                <div>
                    <a href="{{ route('home') }}" class="inline-block mb-4" aria-label="Rootera Beranda">
                        <img src="{{ asset('images/logo-hijau.png') }}" alt="Rootera Logo" class="h-12 w-auto object-contain" width="180" height="48" loading="lazy">
                    </a>
                    <p class="text-slate-400 text-sm leading-relaxed mb-6 max-w-sm">
                        Layanan profesional pelancar pipa, saluran mampet, cuci toren, dan instalasi sanitasi tanpa membongkar struktur bangunan. Cepat, bersih, dan bergaransi resmi.
                    </p>
                </div>

                {{-- Social Icons --}}
                <div class="flex items-center gap-3">
                    <a href="https://www.instagram.com/Rootera_plumbing?igsh=c2NkbXA1b3h6MTVy" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-300 hover:bg-teal-600 hover:text-white hover:border-teal-500 transition-all" aria-label="Instagram Rootera">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                    <a href="https://facebook.com/Rootera.id" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-300 hover:bg-teal-600 hover:text-white hover:border-teal-500 transition-all" aria-label="Facebook Rootera">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <a href="https://www.tiktok.com/@Rootera_plumbing?_r=1&_t=ZS-97nM89aiu5h" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-300 hover:bg-teal-600 hover:text-white hover:border-teal-500 transition-all" aria-label="TikTok Rootera">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.69a8.18 8.18 0 0 0 4.78 1.52V6.76a4.84 4.84 0 0 1-1.01-.07z"/></svg>
                    </a>
                    <a href="https://wa.me/6281385404000" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-300 hover:bg-emerald-600 hover:text-white hover:border-emerald-500 transition-all" aria-label="WhatsApp Rootera">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Col 2: Layanan Utama (3 cols) --}}
            <div class="lg:col-span-3">
                <h3 class="text-white text-base font-bold mb-4 uppercase tracking-wider">Layanan Utama</h3>
                <ul class="space-y-2.5 text-sm text-slate-400">
                    <li><a href="{{ route('layanan') }}" class="hover:text-teal-400 transition-colors">Pelancar Wastafel & Sink</a></li>
                    <li><a href="{{ route('layanan') }}" class="hover:text-teal-400 transition-colors">Pembersihan Saluran Kamar Mandi</a></li>
                    <li><a href="{{ route('layanan') }}" class="hover:text-teal-400 transition-colors">Deteksi & Pelancar Kran Mampet</a></li>
                    <li><a href="{{ route('layanan') }}" class="hover:text-teal-400 transition-colors">Jasa Cuci Toren & Tangki Air</a></li>
                    <li><a href="{{ route('layanan') }}" class="hover:text-teal-400 transition-colors">Pembersihan Floor Drain & Talang</a></li>
                    <li><a href="{{ route('layanan') }}" class="hover:text-teal-400 transition-colors">Instalasi Pipa Air Bersih/Kotor</a></li>
                </ul>
            </div>

            {{-- Col 3: Area Jangkauan (2 cols) --}}
            <div class="lg:col-span-2">
                <h3 class="text-white text-base font-bold mb-4 uppercase tracking-wider">Area Utama</h3>
                <ul class="space-y-2.5 text-sm text-slate-400">
                    <li><a href="{{ route('area-layanan') }}" class="hover:text-teal-400 transition-colors">Jabodetabek</a></li>
                    <li><a href="{{ route('area-layanan') }}" class="hover:text-teal-400 transition-colors">Bandung</a></li>
                    <li><a href="{{ route('area-layanan') }}" class="hover:text-teal-400 transition-colors">Semarang</a></li>
                    <li><a href="{{ route('area-layanan') }}" class="hover:text-teal-400 transition-colors">Yogyakarta</a></li>
                    <li><a href="{{ route('area-layanan') }}" class="hover:text-teal-400 transition-colors">Lampung</a></li>
                    <li><a href="{{ route('area-layanan') }}" class="hover:text-teal-400 transition-colors">Cirebon</a></li>
                </ul>
            </div>

            {{-- Col 4: Kontak Resmi & Jam Operasional (3 cols) --}}
            <div class="lg:col-span-3">
                <h3 class="text-white text-base font-bold mb-4 uppercase tracking-wider">Kontak Resmi 24h</h3>
                <div class="space-y-3 text-sm text-slate-400">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-teal-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.65 3.42 2 2 0 0 1 3.62 1.24h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.82a16 16 0 0 0 6.29 6.29l.96-.96a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7a2 2 0 0 1 1.72 2.01z"/></svg>
                        <a href="tel:+6281385404000" class="hover:text-white transition-colors font-semibold text-white">0813-8540-4000</a>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-teal-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <a href="mailto:info@Rootera.id" class="hover:text-white transition-colors">info@Rootera.id</a>
                    </div>
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-teal-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span>Gg. Mawar No.6B.1, Cijantung, Pasar Rebo, Jakarta Timur</span>
                    </div>
                    <div class="flex items-center gap-2 mt-4 pt-4 border-t border-slate-800 text-xs text-emerald-400 font-bold">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>Layanan Siaga 24 Jam Nonstop</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- Bottom Copyright --}}
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <p>&copy; {{ date('Y') }} <strong class="text-slate-300">Rootera Plumbing</strong>. Hak Cipta Dilindungi Undang-Undang.</p>
            <p class="text-slate-400">Developed by <span class="text-slate-200 font-medium">Desty Mikayla Ariana & Yero Virdhan Akifan</span></p>
        </div>
    </div>
</footer>
