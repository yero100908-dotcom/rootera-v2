{{-- Technical Context & Category Specific Solution Section --}}
<section class="py-12 sm:py-16 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-12">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-100 text-emerald-800 font-bold text-xs uppercase tracking-wider mb-2.5">
                🔬 Analisis Teknis &amp; Solusi Spesifik {{ $locationShort }}
            </span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight">
                Penyebab &amp; Metodologi Penanganan {{ $category->name }}
            </h2>
            <p class="text-sm sm:text-base text-slate-600 mt-3 leading-relaxed">
                Pahami faktor utama penyebab penyumbatan dan bagaimana teknisi Rootera melancarkan saluran di <strong class="text-slate-900">{{ $locationName }}</strong> tanpa merusak lantai.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-stretch">
            
            <!-- Left Card: Akar Penyebab Mampet -->
            <div class="bg-amber-50/60 border border-amber-200/80 rounded-2xl p-6 sm:p-8 flex flex-col justify-between shadow-sm">
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-amber-500/20 text-amber-700 flex items-center justify-center font-bold text-xl shrink-0">
                            ⚠️
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">3 Akar Utama Penyumbatan</h3>
                            <p class="text-xs text-amber-800 font-medium">Berdasarkan temuan data lapangan teknisi di area {{ $locationShort }}</p>
                        </div>
                    </div>

                    <ul class="space-y-4">
                        @if(isset($technicalContext['problem_causes']) && is_array($technicalContext['problem_causes']))
                            @foreach($technicalContext['problem_causes'] as $cause)
                            <li class="flex items-start gap-3 text-xs sm:text-sm text-slate-700">
                                <span class="w-5 h-5 rounded-full bg-amber-200 text-amber-900 font-extrabold flex items-center justify-center text-[11px] shrink-0 mt-0.5">•</span>
                                <span class="leading-relaxed">{!! $cause !!}</span>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                @if(isset($technicalContext['risk_warning']))
                <div class="mt-6 pt-5 border-t border-amber-200/80 flex items-start gap-3 bg-amber-100/50 p-3.5 rounded-xl">
                    <span class="text-amber-700 font-bold text-base shrink-0">🚫</span>
                    <p class="text-xs text-amber-950 leading-relaxed">
                        <strong>Peringatan Risiko:</strong> {{ $technicalContext['risk_warning'] }}
                    </p>
                </div>
                @endif
            </div>

            <!-- Right Card: Metodologi & Alat Canggih -->
            <div class="bg-emerald-50/60 border border-emerald-200/80 rounded-2xl p-6 sm:p-8 flex flex-col justify-between shadow-sm">
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-700 flex items-center justify-center font-bold text-xl shrink-0">
                            ⚙️
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">Metodologi &amp; Alat Pelancar</h3>
                            <p class="text-xs text-emerald-800 font-medium">Standard Operating Procedure (SOP) Sanitasi Rootera</p>
                        </div>
                    </div>

                    <ul class="space-y-4">
                        @if(isset($technicalContext['methodology']) && is_array($technicalContext['methodology']))
                            @foreach($technicalContext['methodology'] as $method)
                            <li class="flex items-start gap-3 text-xs sm:text-sm text-slate-700">
                                <span class="w-5 h-5 rounded-full bg-emerald-200 text-emerald-900 font-extrabold flex items-center justify-center text-[11px] shrink-0 mt-0.5">✓</span>
                                <span class="leading-relaxed">{!! $method !!}</span>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                @if(isset($technicalContext['preventative_tip']))
                <div class="mt-6 pt-5 border-t border-emerald-200/80 flex items-start gap-3 bg-emerald-100/50 p-3.5 rounded-xl">
                    <span class="text-emerald-700 font-bold text-base shrink-0">💡</span>
                    <p class="text-xs text-emerald-950 leading-relaxed">
                        <strong>Tips Perawatan:</strong> {{ $technicalContext['preventative_tip'] }}
                    </p>
                </div>
                @endif
            </div>

        </div>

        <!-- Technical Description Banner -->
        <div class="mt-8 bg-slate-900 text-white rounded-2xl p-5 sm:p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="text-xs sm:text-sm text-slate-300 leading-relaxed max-w-4xl">
                {!! $areaTechnicalIntro ?? "Layanan pelancaran pipa mampet profesional untuk kawasan <strong>{$locationName}</strong> dengan jaminan garansi 30 hari pasca pengerjaan." !!}
            </div>
            <a href="https://wa.me/{{ $city->whatsapp_number }}?text={{ urlencode('Halo Rootera, saya butuh konsultasi teknis ' . $category->name . ' di area ' . $locationName) }}" 
               target="_blank"
               class="shrink-0 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-white font-bold text-xs sm:text-sm transition-all shadow-md">
                <span>Konsultasi Teknis Gratis</span>
                <span>→</span>
            </a>
        </div>

    </div>
</section>
