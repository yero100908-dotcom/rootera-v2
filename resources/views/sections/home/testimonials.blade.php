<style>
    /* Custom Styling untuk Merapikan Internal Widget Elfsight */
    .elfsight-app-d736a051-79f5-4dc0-847d-0633b20dc8f5 [class*="Header__Title"],
    .elfsight-app-d736a051-79f5-4dc0-847d-0633b20dc8f5 [class*="WidgetTitle__WidgetTitleComponent"],
    .elfsight-app-d736a051-79f5-4dc0-847d-0633b20dc8f5 [class*="HeaderContainer"] {
        display: none !important;
    }
    /* Sembunyikan badge watermark Elfsight */
    a[href*="elfsight.com/google-reviews-widget"],
    a[href*="elfsight.com"] {
        display: none !important;
        opacity: 0 !important;
        pointer-events: none !important;
        visibility: hidden !important;
        height: 0 !important;
        width: 0 !important;
    }
</style>

<section id="ulasan-pelanggan" class="w-full relative py-14 sm:py-20 bg-slate-900 text-white overflow-hidden scroll-margin-top-[100px] border-b border-slate-800/80">
    
    {{-- Ambient Glow Filter Layer --}}
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none overflow-hidden">
        <div class="w-[650px] h-[350px] bg-emerald-500/10 blur-[120px] rounded-full"></div>
        <div class="w-[450px] h-[250px] bg-cyan-500/10 blur-[100px] rounded-full -translate-y-20"></div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 relative z-10">
        
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-12">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-bold uppercase tracking-wider mb-4 shadow-sm backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                ULASAN REAL CUSTOMERS GOOGLE MAPS
            </span>
            
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight mb-4">
                Apa Kata <span class="bg-gradient-to-r from-emerald-400 via-teal-300 to-cyan-400 bg-clip-text text-transparent">Pelanggan Asli Kami?</span>
            </h2>
            
            <p class="text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl mx-auto mb-6">
                Testimoni riil dan transparansi hasil pengerjaan Rootera Plumbing yang terverifikasi secara publik di Google Maps.
            </p>

            {{-- Trust Indicators Bar --}}
            <div class="flex flex-wrap items-center justify-center gap-2.5 sm:gap-4 text-xs sm:text-sm font-semibold text-slate-200">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-800/80 border border-slate-700/80 backdrop-blur-md">
                    <span class="text-amber-400">⭐ 5.0</span> Rating Tertinggi
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-800/80 border border-slate-700/80 backdrop-blur-md">
                    <span class="text-cyan-400">📍</span> Terverifikasi Google Maps
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-800/80 border border-slate-700/80 backdrop-blur-md">
                    <span class="text-emerald-400">🛡️</span> 100% Ulasan Riil
                </span>
            </div>
        </div>

        {{-- Elfsight Live Widget Component --}}
        <div class="w-full">
            <!-- Elfsight Google Reviews -->
            <script src="https://elfsightcdn.com/platform.js" async></script>
            <div class="elfsight-app-d736a051-79f5-4dc0-847d-0633b20dc8f5"></div>
        </div>

    </div>
</section>
