@props([
    'title' => '🛠️ Peralatan & Teknologi Modern Digunakan',
    'subtitle' => 'Kombinasi unit mekanis & kamera digital berstandar internasional untuk efisiensi pengerjaan 100% tanpa bongkar.',
    'selectedTools' => null, // Optional array of keys e.g. ['ridgid_k50', 'cctv_camera', 'hydro_jetting']
    'compact' => false
])

@php
    $mediaService = app(\App\Services\MediaService::class);
    $allToolkit = $mediaService->getToolkitImages();

    // Map specification chips for each tool
    $specChips = [
        'ridgid_k50' => ['⚡ Tanpa Bongkar Keramik', '🔄 Putaran High Torque'],
        'cctv_camera' => ['📹 Endoskopi Waterproof', '🔎 Deteksi Visual HD'],
        'hydro_jetting' => ['🌊 Tekanan 250 Bar', '🧪 Bebas Bahan Kimia'],
        'cutter_heads' => ['🔪 Pemotong Kerak & Lemak', '💪 Spiral Baja Tahan Karat'],
        'rotary_cable' => ['🌀 Tembus P-Trap/S-Trap', '📐 Jangkauan 30 Meter'],
        'heavy_duty' => ['🏢 Skala Gedung & Pabrik', '⛓️ Pipa Diameter 4-12 Inci'],
    ];

    // Filter tools if specific tools are requested
    if ($selectedTools && is_array($selectedTools)) {
        $tools = array_intersect_key($allToolkit, array_flip($selectedTools));
    } else {
        $tools = $allToolkit;
    }
@endphp

<div {{ $attributes->merge(['class' => 'equipment-showcase-section bg-white p-4 sm:p-8 rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-sm']) }}>
    @if($title || $subtitle)
    <div class="text-center max-w-2xl mx-auto mb-6 sm:mb-8">
        @if($title)
        <h3 class="text-lg sm:text-2xl font-extrabold text-slate-900 mb-1.5 tracking-tight">
            {{ $title }}
        </h3>
        @endif
        @if($subtitle)
        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
            {{ $subtitle }}
        </p>
        @endif
    </div>
    @endif

    {{-- 2-COLUMN COMPACT GRID ON MOBILE, 3-COLUMN ON TABLET & DESKTOP --}}
    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 sm:gap-6">
        @foreach($tools as $key => $tool)
        <div class="group bg-white rounded-xl sm:rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">
            
            {{-- IMAGE CONTAINER WITH ASPECT RATIO & BADGE --}}
            <div class="relative aspect-[4/3] bg-slate-900 overflow-hidden">
                <img src="{{ $tool['url'] }}" alt="{{ $tool['alt'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                
                {{-- BADGE ALAT RESMI --}}
                <div class="absolute top-2 left-2 z-10">
                    <span class="bg-emerald-600/95 backdrop-blur-md text-white text-[10px] sm:text-xs font-bold px-2 sm:px-2.5 py-0.5 sm:py-1 rounded-full shadow-md inline-flex items-center gap-1">
                        ✓ ALAT RESMI
                    </span>
                </div>
            </div>

            {{-- CONTENT AREA --}}
            <div class="p-3 sm:p-5 flex flex-col flex-grow justify-between bg-white">
                <div>
                    <h4 class="text-xs sm:text-base font-bold text-slate-900 leading-snug group-hover:text-blue-600 transition-colors mb-1.5 line-clamp-2">
                        {{ $tool['title'] }}
                    </h4>
                    <p class="text-[11px] sm:text-xs text-slate-500 leading-relaxed mb-3 line-clamp-2 sm:line-clamp-3">
                        {{ $tool['desc'] }}
                    </p>
                </div>

                {{-- SPECIFICATION CHIPS --}}
                @if(isset($specChips[$key]))
                <div class="pt-2 border-t border-slate-100 flex flex-wrap gap-1 mt-auto">
                    @foreach($specChips[$key] as $chip)
                    <span class="bg-slate-100 text-slate-700 text-[9px] sm:text-[11px] font-semibold px-2 py-0.5 rounded-md">
                        {{ $chip }}
                    </span>
                    @endforeach
                </div>
                @endif
            </div>

        </div>
        @endforeach
    </div>
</div>
