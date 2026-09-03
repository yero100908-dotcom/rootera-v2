{{-- Mobile Sticky CTA Bar Component (Visible on mobile screens < 768px) --}}
<?php
$waPhone = isset($city) && !empty($city->whatsapp_number) ? preg_replace('/[^0-9]/', '', $city->whatsapp_number) : "6281385404000";

if (isset($district) && isset($category)) {
    $waText = "Halo Rootera Plumbing, saya butuh teknisi darurat untuk jasa {$category->name} di area Kecamatan {$district->name}, {$city->name}. Bisa datang segera?";
} elseif (isset($category) && isset($city)) {
    $cityName = $city->full_name ?? $city->name;
    $waText = "Halo Rootera Plumbing, saya butuh panggilan teknisi pelancar {$category->name} di area {$cityName}. Mohon info jadwal teknisi.";
} elseif (isset($category)) {
    $waText = "Halo Rootera Plumbing, saya butuh info & konsultasi gratis jasa {$category->name}. Mohon info ketersediaan teknisi.";
} elseif (isset($city)) {
    $cityName = $city->full_name ?? $city->name;
    $waText = "Halo Rootera Plumbing, saya butuh teknisi darurat pipa mampet untuk wilayah {$cityName}. Bisakah datang hari ini?";
} else {
    $waText = "Halo Rootera Plumbing, saya butuh bantuan darurat pelancar saluran pipa mampet 24 Jam.";
}

$waLink = "https://wa.me/{$waPhone}?text=" . urlencode($waText);
$etaText = isset($district) ? ($district->estimated_arrival ?? '25-40 Menit') : (isset($city) ? ($city->estimated_arrival ?? '30-45 Menit') : '24 Jam');
$areaLabel = isset($district) ? $district->name : (isset($city) ? $city->name : 'Lokasi Anda');
?>

<div id="mobile-sticky-cta-bar" class="fixed bottom-0 left-0 right-0 z-[9990] md:hidden bg-slate-900/95 backdrop-blur-md border-t border-slate-800 px-3 py-2.5 shadow-2xl transition-transform duration-300">
    <div class="flex items-center justify-between gap-2 max-w-lg mx-auto">
        <div class="flex items-center gap-2">
            <span class="relative flex h-3 w-3 shrink-0">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
            </span>
            <div class="leading-tight">
                <div class="text-[11px] font-bold text-white flex items-center gap-1">
                    <span>Teknisi Siaga</span>
                    <span class="text-emerald-400 font-extrabold">{{ $etaText }}</span>
                </div>
                <div class="text-[10px] text-slate-400 truncate max-w-[130px]">
                    📍 Area {{ $areaLabel }}
                </div>
            </div>
        </div>

        <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" class="bg-[#25D366] hover:bg-[#1EBE5A] active:bg-[#169F81] text-white font-extrabold text-xs px-4 py-2.5 rounded-full flex items-center gap-1.5 shadow-lg shadow-green-500/20 text-decoration-none transition-transform active:scale-95 shrink-0">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
            <span>Panggil Teknisi WA (24 Jam)</span>
        </a>
    </div>
</div>
