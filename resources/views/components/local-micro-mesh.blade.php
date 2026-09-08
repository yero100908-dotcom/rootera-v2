{{-- Dynamic Local Micro-Coverage & Kelurahan Mesh Component --}}
@props([
    'locationShort'   => 'Wilayah',
    'locationName'    => 'Wilayah Terkait',
    'estimatedArrival'=> 'Teknisi Siaga Hari Ini',
    'dispatchHub'     => 'Pos Hub Armada Utama',
    'landmarks'       => [],
    'districtName'    => '',
    'whatsappNumber'  => '6281385404000',
])

@if(!empty($landmarks) && is_array($landmarks))
@php
    $displayDistrict = $districtName ?: $locationShort;
    $waBase          = 'https://wa.me/' . ltrim($whatsappNumber, '+');
@endphp

<section class="bg-gradient-to-b from-emerald-50/40 via-white to-white py-14 px-4 sm:px-6 lg:px-8 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto">

        {{-- Section Header --}}
        <div class="text-center max-w-2xl mx-auto mb-9 md:mb-12">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-100 text-emerald-800 font-bold text-xs uppercase tracking-widest mb-3">
                📍 Jangkauan Mikro Kelurahan
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">
                Cakupan Kelurahan & Titik Layanan di {{ $displayDistrict }}
            </h2>
            <p class="text-sm sm:text-base text-slate-600 mt-3 leading-relaxed max-w-xl mx-auto">
                Armada teknisi Rootera disiagakan di pos siaga terdekat (<strong class="text-slate-800">{{ $dispatchHub }}</strong>), siap meluncur cepat memberikan penanganan pipa mampet ke seluruh kelurahan berikut:
            </p>
        </div>

        {{-- Kelurahan Card Grid --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
            @foreach($landmarks as $lm)
            @php
                $waText = urlencode('Halo Rootera, saya butuh teknisi saluran pipa mampet di Kelurahan ' . $lm . ', ' . $displayDistrict . '. Apakah teknisi bisa meluncur hari ini?');
            @endphp
            <a href="{{ $waBase }}?text={{ $waText }}"
               target="_blank"
               rel="noopener"
               class="group flex flex-col bg-white border border-slate-200 hover:border-emerald-500 rounded-2xl p-3.5 sm:p-4 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 text-left">

                {{-- Pulsing active dot + pin icon --}}
                <div class="flex items-center gap-2 mb-2.5">
                    <span class="relative flex h-2.5 w-2.5 shrink-0">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-60"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                    </span>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-600">Siaga Aktif</span>
                </div>

                {{-- Village Name --}}
                <div class="font-bold text-slate-900 group-hover:text-emerald-700 text-sm sm:text-base leading-snug transition-colors line-clamp-2">
                    {{ $lm }}
                </div>

                {{-- Micro CTA --}}
                <div class="mt-2.5 text-[11px] font-bold text-slate-400 group-hover:text-emerald-600 transition-colors flex items-center gap-1">
                    <span>Siaga Meluncur</span>
                    <span class="group-hover:translate-x-0.5 transition-transform duration-150">→</span>
                </div>

            </a>
            @endforeach
        </div>

        {{-- Callout Jaminan Cakupan Penuh --}}
        <div class="mt-7 md:mt-9 bg-white border border-slate-200 rounded-2xl px-5 sm:px-6 py-4 flex items-start sm:items-center gap-3 shadow-sm">
            <span class="text-emerald-500 text-xl shrink-0 mt-0.5 sm:mt-0">🌐</span>
            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                <strong class="text-slate-800">Rumah atau ruko Anda berada di luar titik kelurahan di atas?</strong>
                Jangan khawatir, seluruh area <strong class="text-slate-800">{{ $displayDistrict }}</strong> dan sekitarnya tetap kami jangkau tanpa biaya tambahan transport.
            </p>
        </div>

    </div>
</section>
@endif
