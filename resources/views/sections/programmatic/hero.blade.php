<!-- Hero Section -->
<section class="relative overflow-hidden bg-slate-950 text-white pt-10 pb-16 lg:pt-14 lg:pb-20">
    <!-- Background Image with Picture Tag for Responsive LCP Optimization -->
    <div class="absolute inset-0 z-0 overflow-hidden">
        <picture>
            <source media="(max-width: 767px)" srcset="{{ asset('assets/banners/rootera-plumbing-jasa-saluran-mampet-profesional-mobile.webp') }}">
            <img src="{{ asset('assets/banners/rootera-plumbing-jasa-saluran-mampet-profesional-desktop.webp') }}"
                 alt="Rootera Plumbing Jasa Saluran Pipa Mampet {{ $locationName }}"
                 class="w-full h-full object-cover object-center"
                 fetchpriority="high"
                 loading="eager"
                 width="1920"
                 height="1080">
        </picture>
        <!-- Balanced dark overlay: readable text yet background photo visible -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/80 via-slate-900/65 to-slate-950/75"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>
    </div>

    <!-- Content Container -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumbs -->
        <nav class="flex items-center flex-wrap gap-2 text-xs sm:text-sm text-slate-300 mb-6 font-medium" aria-label="Breadcrumb">
            <a href="{{ url('/') }}" class="hover:text-emerald-400 transition-colors">Beranda</a>
            <span class="text-slate-500">›</span>
            <a href="{{ url('/jasa-saluran-mampet/' . $city->slug) }}" class="hover:text-emerald-400 transition-colors">Jasa Saluran Mampet {{ $city->name }}</a>
            @if($district)
                <span class="text-slate-500">›</span>
                <span class="text-white font-bold">{{ $district->name }}</span>
            @endif
        </nav>

        <!-- Main Content Area -->
        <div class="max-w-3xl space-y-5 sm:space-y-6 text-left">
            
            <!-- Live SLA Badge with Pulsing Indicator -->
            <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 sm:px-4 sm:py-2 rounded-full bg-emerald-950/70 border border-emerald-500/40 backdrop-blur-md text-xs sm:text-sm text-emerald-300 font-semibold shadow-inner">
                <span class="relative flex h-2.5 w-2.5 shrink-0">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                </span>
                <span>Armada Siaga di <strong class="text-white">{{ $district->name ?? $locationShort }}</strong> · <strong class="text-emerald-400">Respon Cepat Langsung Meluncur</strong></span>
            </div>

            <!-- H1 Headline -->
            <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight sm:leading-tight">
                {!! $heroHeadline ?? "Jasa {$category->name} di {$locationName}" !!}
            </h1>

            <!-- Subtitle Paragraph -->
            <p class="text-sm sm:text-base lg:text-lg text-slate-200/90 leading-relaxed max-w-2xl">
                {!! $heroSubtitle ?? "Solusi profesional terpercaya untuk masalah pipa mampet, wastafel tersumbat, kran air, dan saluran mampet di area <strong class=\"text-white font-semibold\">{$locationName}</strong>. Berpengalaman, dikerjakan tanpa bongkar pipa paksa, dan bergaransi resmi tuntas 100%." !!}
            </p>

            <!-- CTA Action Buttons -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5 pt-2">
                <a href="https://wa.me/{{ $city->whatsapp_number }}?text={{ urlencode('Halo Rootera, saya butuh jasa ' . $category->name . ' di area ' . $locationName . '. Bisa bantu?') }}" 
                   target="_blank" 
                   class="inline-flex items-center justify-center gap-3 px-6 py-3.5 sm:px-8 sm:py-4 rounded-full bg-emerald-500 hover:bg-emerald-400 text-white font-bold text-base sm:text-lg shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 hover:-translate-y-0.5 transition-all duration-200 group">
                    <svg class="w-6 h-6 fill-current text-white shrink-0" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                    <span>Panggil Teknisi (24 Jam)</span>
                </a>
                
                <a href="{{ route('diagnostic.index') }}"
                   class="inline-flex items-center justify-center gap-2 px-6 py-3.5 sm:px-7 sm:py-4 rounded-full bg-white/10 hover:bg-white/20 text-white font-semibold text-base border border-white/25 backdrop-blur-sm transition-all duration-200">
                    <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h4a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H3M7 8h10M17 8h1a3 3 0 0 1 0 6h-1M7 16h10"/>
                        <circle cx="19.5" cy="11" r="1" fill="currentColor" class="text-emerald-400"/>
                    </svg>
                    <span>Cek Kondisi Pipa</span>
                </a>
            </div>

        </div>

        <!-- Bottom Hero: Dynamic Local Context Dispatch Box / Pos Hub Siaga Terdekat -->
        @if(isset($dispatchHub))
        <div class="mt-8 lg:mt-10 rounded-2xl bg-slate-900/80 border border-emerald-500/30 p-4 sm:p-5 backdrop-blur-md flex flex-col md:flex-row items-start md:items-center justify-between gap-4 shadow-xl">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/20 border border-emerald-500/40 flex items-center justify-center text-emerald-400 text-lg shrink-0">
                    📍
                </div>
                <div>
                    <div class="text-[11px] font-bold uppercase tracking-wider text-emerald-400">Pos Hub Siaga Terdekat</div>
                    <div class="text-sm sm:text-base font-extrabold text-white">{{ $dispatchHub }}</div>
                    @if($district)
                    <div class="text-xs text-slate-300 mt-0.5">
                        Posko teknisi {{ $district->name }} merupakan bagian resmi dari armada Rootera Plumbing Regional {{ $city->name }}.
                    </div>
                    @endif
                </div>
            </div>
            @if($district)
            <a href="{{ url('/jasa-saluran-mampet/' . $city->slug) }}" class="shrink-0 inline-flex items-center gap-1.5 text-xs font-bold text-emerald-400 hover:text-emerald-300 hover:underline bg-white/10 px-3.5 py-2 rounded-xl border border-white/15 backdrop-blur-sm transition-all">
                <span>Lihat ringkasan posko &amp; layanan Rootera se-{{ $city->name }} →</span>
            </a>
            @elseif(!empty($nearbyLandmarks))
            <div class="text-xs sm:text-sm text-slate-300 flex flex-wrap items-center gap-1.5">
                <span class="font-bold text-sky-400 shrink-0">Cakupan Sekitar:</span>
                @foreach($nearbyLandmarks as $lm)
                    <span class="bg-white/10 border border-white/15 px-2.5 py-0.5 rounded-md text-slate-200 text-xs font-medium">{{ $lm }}</span>
                @endforeach
            </div>
            @endif
        </div>
        @endif

    </div>
</section>
