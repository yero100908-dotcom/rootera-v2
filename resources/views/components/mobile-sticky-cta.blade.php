{{-- Mobile Sticky CTA Bar Component (Optimized for CRO & Contextual Tracking) --}}
<?php
$rawPhone = isset($city) && !empty($city->branch_phone) 
    ? $city->branch_phone 
    : (isset($city) && !empty($city->whatsapp_number) ? $city->whatsapp_number : "6281385404000");

$waPhone = preg_replace('/[^0-9]/', '', $rawPhone);
$telPhone = "0" . preg_replace('/^62/', '', $waPhone);

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

$waLink = "https://wa.me/{$waPhone}?text=" . rawurlencode($waText);
$telLink = "tel:{$telPhone}";
$areaLabel = isset($district) ? $district->name : (isset($city) ? $city->name : 'Jabodetabek');
?>

<div id="mobile-sticky-cta-bar" class="fixed bottom-0 inset-x-0 w-full z-[9990] md:hidden bg-[#061434]/95 border-t border-emerald-500/30 backdrop-blur-md shadow-[0_-8px_25px_rgba(0,0,0,0.5)] px-3 py-2 transition-all duration-300 transform-gpu">
    {{-- Status Header Bar --}}
    <div class="flex items-center justify-between gap-2 w-full max-w-md mx-auto mb-1.5 px-0.5">
        <div class="flex items-center gap-1.5 min-w-0">
            <span class="relative flex h-2.5 w-2.5 shrink-0">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
            </span>
            <span class="text-[11px] font-bold text-white tracking-tight">
                Teknisi Siaga <span class="text-emerald-400 font-extrabold">24 Jam</span>
            </span>
        </div>
        <div class="text-[10px] text-slate-300 font-medium truncate">
            📍 Area {{ $areaLabel }}
        </div>
    </div>

    {{-- Dual CTA Buttons (Side-by-Side) --}}
    <div class="grid grid-cols-2 gap-2 w-full max-w-md mx-auto">
        {{-- Direct Call Button --}}
        <a href="{{ $telLink }}" 
           class="bg-slate-800 hover:bg-slate-700 active:scale-95 text-white font-extrabold text-xs py-2.5 px-3 rounded-xl flex items-center justify-center gap-1.5 border border-slate-700 shadow-md text-decoration-none transition-all">
            <svg class="w-4 h-4 fill-none stroke-current stroke-2 shrink-0 text-blue-400" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
            </svg>
            <span>Telepon Langsung</span>
        </a>

        {{-- WhatsApp Chat Button --}}
        <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" 
           class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 active:scale-95 text-white font-extrabold text-xs py-2.5 px-3 rounded-xl flex items-center justify-center gap-1.5 shadow-lg shadow-emerald-500/30 text-decoration-none transition-all">
            <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
            <span>Chat WhatsApp</span>
        </a>
    </div>
</div>
