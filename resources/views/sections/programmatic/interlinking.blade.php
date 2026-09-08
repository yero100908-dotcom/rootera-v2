{{-- Smart Interlinking Hub (Service Matrix, District Mesh with ETA, & B2B Cross-Link) --}}
@include('components.smart-interlinking', [
    'category'        => $category,
    'city'            => $city,
    'district'        => $district,
    'siblingDistricts'=> $siblingDistricts ?? collect(),
    'allCategories'   => $allCategories ?? collect(),
    'locationShort'   => $locationShort
])

{{-- Clickable Local Tag Cloud (merged here to avoid a standalone section above footer) --}}
<div class="bg-white border-t border-slate-200/80 px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-7xl mx-auto">
        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-3">🏷️ Kata Kunci Pencarian Lokal di {{ $locationShort }}</p>
        <div class="flex flex-wrap gap-2">
            @php
                $localTags = [
                    "Jasa Pipa Mampet {$locationShort}",
                    "Tukang Saluran Mampet {$locationShort}",
                    "Pelancar Wastafel Berlemak {$locationShort}",
                    "Ahli Floor Drain Kamar Mandi {$locationShort}",
                    "Kloset WC Meluap 24 Jam {$locationShort}",
                    "Service Got & Talang Hujan {$locationShort}",
                    "Emergency Plumber {$locationShort}",
                    "Inspeksi Pipa Kamera CCTV {$locationShort}",
                    "Hydro Jetting Industri {$locationShort}",
                    "Sedot Pipa Tersumbat Tanpa Bongkar {$locationShort}"
                ];
            @endphp
            @foreach($localTags as $tag)
                <a href="{{ url('/solusi/' . \Illuminate\Support\Str::slug($tag) . ($city ? '/' . $city->slug : '')) }}"
                   class="inline-block bg-white border border-slate-200 hover:border-emerald-500 hover:text-emerald-700 text-slate-600 px-3 py-1 rounded-full text-xs font-semibold transition-colors duration-150">
                    #{{ $tag }}
                </a>
            @endforeach
        </div>
    </div>
</div>
