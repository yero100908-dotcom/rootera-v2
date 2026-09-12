@props([
    'city' => null,
    'district' => null
])

<?php
$cityName = (isset($city) && is_object($city)) ? ($city->name ?? 'Bandar Lampung') : 'Bandar Lampung';
$districtName = (isset($district) && is_object($district)) ? $district->name : null;
$lat = -5.388639;
$lng = 105.265417;
$mapsNavUrl = "https://www.google.com/maps?q={$lat},{$lng}";
$waPhone = (isset($city) && is_object($city) && !empty($city->whatsapp_number)) ? $city->whatsapp_number : "6281385404000";
?>

<section class="py-12 sm:py-16 bg-slate-900 text-white relative overflow-hidden border-t-4 border-[#169F81] my-8 rounded-3xl mx-4 sm:mx-6 lg:mx-8 shadow-2xl">
    {{-- Glow background --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-[#169F81]/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            {{-- Left Column: NAP Details & Badges --}}
            <div class="lg:col-span-7">
                <div class="inline-flex items-center gap-2 bg-[#169F81]/20 border border-[#169F81]/40 text-emerald-300 px-4 py-1.5 rounded-full text-xs font-bold mb-4 shadow-sm">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>📍 WORKSHOP & POSKO OPERASIONAL RESMI BANDAR LAMPUNG</span>
                </div>

                <h3 class="text-2xl sm:text-3xl font-extrabold text-white mb-3 font-['Plus_Jakarta_Sans',sans-serif]">
                    Rootera Plumbing Bandar Lampung
                </h3>

                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed mb-6">
                    Pusat komando teknisi armada siaga 24 jam untuk melayani pelancaran saluran pipa mampet tanpa bongkar di seluruh wilayah {{ $districtName ? "Kecamatan {$districtName}, " : "" }}Kota Bandar Lampung &amp; Kabupaten Lampung Selatan.
                </p>

                {{-- NAP Info Cards --}}
                <div class="space-y-3.5 mb-8">
                    {{-- Alamat Fisik --}}
                    <div class="flex items-start gap-3 bg-slate-800/80 border border-slate-700/80 p-3.5 rounded-2xl">
                        <div class="w-9 h-9 rounded-xl bg-[#169F81]/20 border border-[#169F81]/40 text-emerald-400 flex items-center justify-center shrink-0 text-base">
                            🏢
                        </div>
                        <div>
                            <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Alamat Fisik Resmi / Workshop</div>
                            <div class="text-xs sm:text-sm font-semibold text-white mt-0.5">
                                Jl. Danau Towuti, Surabaya, Kec. Kedaton No 9, Kota Bandar Lampung, Lampung 35148
                            </div>
                        </div>
                    </div>

                    {{-- Koordinat GPS & Jam Operasional --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="flex items-start gap-3 bg-slate-800/80 border border-slate-700/80 p-3.5 rounded-2xl">
                            <div class="w-9 h-9 rounded-xl bg-blue-500/20 border border-blue-500/40 text-blue-400 flex items-center justify-center shrink-0 text-base">
                                🌐
                            </div>
                            <div>
                                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Koordinat GPS Presisi</div>
                                <div class="text-xs font-mono font-semibold text-emerald-300 mt-0.5">
                                    -5.388639, 105.265417
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 bg-slate-800/80 border border-slate-700/80 p-3.5 rounded-2xl">
                            <div class="w-9 h-9 rounded-xl bg-amber-500/20 border border-amber-500/40 text-amber-400 flex items-center justify-center shrink-0 text-base">
                                ⏱️
                            </div>
                            <div>
                                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Jam Operasional &amp; SLA</div>
                                <div class="text-xs font-semibold text-amber-300 mt-0.5">
                                    Buka 24 Jam • Respon 20-35 Mnt
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ $mapsNavUrl }}" target="_blank" rel="noopener noreferrer" 
                       class="inline-flex items-center gap-2 bg-[#169F81] hover:bg-emerald-600 text-white font-bold text-xs sm:text-sm px-6 py-3.5 rounded-xl shadow-lg shadow-emerald-950/40 transition-all text-decoration-none">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        <span>Petunjuk Arah Google Maps</span>
                    </a>

                    <a href="https://wa.me/{{ $waPhone }}?text={{ urlencode('Halo Rootera Plumbing Bandar Lampung, saya mau panggil teknisi ke lokasi saya.') }}" 
                       target="_blank" rel="noopener noreferrer" 
                       class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-700 text-white border border-slate-700 font-bold text-xs sm:text-sm px-5 py-3.5 rounded-xl transition-all text-decoration-none">
                        <span>Panggil CS Bandar Lampung (24 Jam)</span>
                    </a>
                </div>
            </div>

            {{-- Right Column: Interactive Embedded Google Maps --}}
            <div class="lg:col-span-5">
                <div class="rounded-2xl overflow-hidden border-2 border-slate-700 shadow-2xl h-[320px] sm:h-[360px] relative group">
                    <iframe 
                        src="https://maps.google.com/maps?q={{ $lat }},{{ $lng }}&z=16&output=embed" 
                        class="w-full h-full border-0 group-hover:scale-105 transition-transform duration-500" 
                        loading="lazy" 
                        allowfullscreen=""
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Google Maps Lokasi Workshop Rootera Plumbing Bandar Lampung">
                    </iframe>
                    <div class="absolute bottom-3 left-3 bg-slate-900/90 border border-slate-700/80 px-3 py-1.5 rounded-xl text-[11px] font-semibold text-emerald-300 backdrop-blur-md">
                        📍 Pin Point: Jl. Danau Towuti No. 9, Kedaton
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
