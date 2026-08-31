@extends('layouts.app')

@section('schema-markup')
<?php
$directorySchema = [
  "@context" => "https://schema.org",
  "@graph" => [
    [
      "@type" => "BreadcrumbList",
      "itemListElement" => [
        [
          "@type" => "ListItem",
          "position" => 1,
          "name" => "Beranda",
          "item" => url('/')
        ],
        [
          "@type" => "ListItem",
          "position" => 2,
          "name" => "Jasa Saluran Mampet (Direktori Wilayah)",
          "item" => route('area-layanan')
        ]
      ]
    ],
    [
      "@type" => "CollectionPage",
      "name" => "Pusat Wilayah Operasional Jasa Saluran Pipa Mampet - Rootera Plumbing",
      "description" => "Direktori resmi wilayah operasional pelancaran pipa mampet di Jabodetabek, Banten, Jawa Barat, Jawa Tengah, DIY, Jawa Timur, dan Lampung.",
      "url" => route('area-layanan'),
      "provider" => [
        "@type" => "Plumber",
        "name" => "Rootera Plumbing (J&J Group)",
        "telephone" => "+6281385404000",
        "url" => url('/')
      ]
    ]
  ]
];
?>
<script type="application/ld+json">
{!! json_encode($directorySchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
<div class="w-full overflow-x-hidden bg-slate-50 font-['Plus_Jakarta_Sans',sans-serif]">

    {{-- 1. HERO SECTION (SIMPEL, BERSIH, RAMAH DI MATA) --}}
    <section class="bg-gradient-to-b from-[#0B3B60] to-[#06243D] text-white pt-20 pb-12 sm:pt-28 sm:pb-16 border-b-4 border-emerald-600" aria-labelledby="hero-title">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            
            {{-- Badge Pill Sederhana --}}
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-500/20 border border-emerald-400/40 text-emerald-300 text-xs font-bold mb-4">
                🗺️ Master Hub Direktori Wilayah &amp; Kecamatan Operasional
            </span>

            {{-- Judul H1 Jelas & Proporsional --}}
            <h1 id="hero-title" class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white leading-snug tracking-tight mb-3">
                Pusat Wilayah Operasional Jasa Saluran Pipa Mampet — Rootera Plumbing
            </h1>

            {{-- Deskripsi Ringkas --}}
            <p class="text-xs sm:text-base text-slate-200 max-w-2xl mx-auto leading-relaxed mb-6 sm:mb-8 font-normal">
                Temukan teknisi ahli pelancaran pipa mampet terdekat di kota dan kecamatan Anda. Respon cepat 30–90 menit, teknologi rotary spiral &amp; hydro-jetting tanpa bongkar, bergaransi 30 hari.
            </p>

            {{-- Input Search Bar Putih Solid High Contrast --}}
            <div class="max-w-xl mx-auto relative px-1">
                <div class="flex items-center bg-white rounded-full sm:rounded-xl p-1.5 sm:p-2 border border-slate-200 shadow-md">
                    <span class="pl-3.5 pr-1 text-slate-400 text-base sm:text-lg shrink-0">
                        🔍
                    </span>
                    <input type="text" 
                           id="directorySearchInput" 
                           onkeyup="filterDirectory()" 
                           placeholder="Cari nama kota atau kecamatan Anda..." 
                           class="w-full py-2.5 sm:py-3 pr-4 bg-white text-slate-900 placeholder:text-slate-500 text-xs sm:text-sm font-semibold outline-none rounded-full sm:rounded-xl">
                </div>
                <div id="searchCounter" class="mt-2 text-xs sm:text-sm text-emerald-300 font-semibold min-h-[20px]"></div>
            </div>

        </div>
    </section>

    {{-- 2. SILO DIRECTORY GRID SECTION --}}
    <?php
      $mediaService = app(\App\Services\MediaService::class);
    ?>
    <section class="py-10 sm:py-16 bg-slate-50 relative" aria-labelledby="network-heading">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Section Title --}}
            <div class="text-center max-w-2xl mx-auto mb-8 sm:mb-12">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-600">CAKUPAN WILAYAH NASIONAL</span>
                <h2 id="network-heading" class="text-xl sm:text-3xl font-bold text-[#0B3B60] tracking-tight mt-1">
                    Jaringan Cabang &amp; Teknisi Terdekat
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                    Pilih kota atau kecamatan Anda untuk respon kedatangan teknisi kilat 24 Jam:
                </p>
            </div>

            {{-- Loop Provinces & Cities --}}
            <div class="space-y-8 sm:space-y-12">
                @foreach($provinces as $provIdx => $prov)
                <?php
                    $provHeroImg = $mediaService->getRegionalImage($prov->slug, null, $provIdx);
                ?>
                <div class="province-card-block bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    
                    {{-- 1. Header Visual Banner Provinsi (Linear Mobile Layout) --}}
                    <div class="relative min-h-[140px] sm:min-h-[160px] bg-[#0B3B60] overflow-hidden p-4 sm:p-6 flex flex-col justify-center">
                        <img src="{{ $provHeroImg }}" alt="Jasa Saluran Pipa Mampet Provinsi {{ $prov->name }} - Rootera Plumbing" class="absolute inset-0 w-full h-full object-cover filter brightness-[0.35]" loading="lazy" decoding="async">
                        
                        <div class="relative z-10 text-white flex flex-col sm:flex-row sm:items-center justify-between gap-3 w-full">
                            <div class="space-y-1 max-w-xl">
                                <span class="inline-flex items-center gap-1 bg-emerald-500/25 border border-emerald-400/40 text-emerald-300 text-[10px] sm:text-xs font-bold px-3 py-0.5 rounded-full uppercase">
                                    📍 Wilayah Provinsi Operasional
                                </span>
                                <h3 class="text-lg sm:text-2xl font-bold text-white leading-tight">
                                    <a href="{{ route('area.region', $prov->slug) }}" class="hover:text-emerald-300 transition-colors">
                                        Jasa Saluran Pipa Mampet Provinsi {{ $prov->name }}
                                    </a>
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-200 font-medium">
                                    {{ $prov->cities->count() }} Kota &amp; Kabupaten Tercover SLA Respon 24 Jam
                                </p>
                            </div>

                            <div class="mt-1 sm:mt-0 shrink-0">
                                <a href="{{ route('area.region', $prov->slug) }}" class="w-full sm:w-auto min-h-[44px] bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs sm:text-sm px-5 py-2.5 rounded-full inline-flex items-center justify-center gap-1.5 transition-colors shadow-xs">
                                    <span>Lihat Hub {{ $prov->name }}</span>
                                    <span>&rarr;</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- 2. Grid Kota (1-Col Mobile, 2-Col Tablet, 3-Col Desktop) --}}
                    <div class="p-4 sm:p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5 bg-slate-50/50">
                        @foreach($prov->cities as $cIdx => $city)
                        <?php
                            $cityThumbImg = $mediaService->getRegionalImage($prov->slug, $city->slug, $cIdx + 1);
                        ?>
                        <div class="city-search-item bg-white rounded-xl border border-slate-200 overflow-hidden shadow-xs hover:border-emerald-500 transition-all flex flex-col justify-between"
                             data-city-name="{{ strtolower($city->name . ' ' . $city->full_name) }}" 
                             data-districts="{{ strtolower($city->districts->pluck('name')->implode(' ')) }}">
                            
                            {{-- Mini City Thumbnail --}}
                            <div class="relative h-36 sm:h-40 bg-slate-900 overflow-hidden">
                                <img src="{{ $cityThumbImg }}" alt="Jasa Saluran Pipa Mampet {{ $city->full_name }} - Rootera Plumbing" class="w-full h-full object-cover" loading="lazy" decoding="async">
                                
                                {{-- SLA Arrival Badge --}}
                                <span class="absolute top-2.5 right-2.5 bg-slate-900/85 text-emerald-400 border border-emerald-500/40 text-[10px] sm:text-xs font-bold px-2.5 py-0.5 rounded-full shadow-xs">
                                    ⏱️ {{ $city->estimated_arrival ?? '25-40 Mnt' }}
                                </span>

                                {{-- City Title Badge Overlay --}}
                                <div class="absolute bottom-2.5 left-3 right-3 text-white text-sm sm:text-base font-bold drop-shadow-md truncate">
                                    📍 {{ $city->full_name }}
                                </div>
                            </div>

                            {{-- City Content Details --}}
                            <div class="p-4 flex-1 flex flex-col justify-between space-y-3">
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Disiagakan di <strong class="text-slate-900">{{ $city->districts->count() }} Kecamatan</strong> untuk respon cepat tanpa bongkar pipa.
                                </p>

                                {{-- Accordion Collapsible for Districts --}}
                                <details class="group border-t border-slate-100 pt-2.5">
                                    <summary class="text-xs font-bold text-emerald-600 hover:text-emerald-700 cursor-pointer flex items-center justify-between select-none py-1 min-h-[40px] break-words pr-1">
                                        <span class="pr-2">Lihat {{ $city->districts->count() }} Kecamatan di {{ $city->name }}</span>
                                        <span class="group-open:rotate-180 transition-transform text-emerald-600 font-bold text-sm shrink-0">↓</span>
                                    </summary>

                                    <div class="flex flex-wrap gap-1.5 mt-2 pt-2 border-t border-slate-100 max-h-44 overflow-y-auto pr-1 scrollbar-thin">
                                        @forelse($city->districts as $dist)
                                            <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/' . $city->slug . '/' . $dist->slug) }}" 
                                               class="bg-slate-100 hover:bg-emerald-50 text-slate-700 hover:text-emerald-700 border border-slate-200 hover:border-emerald-300 rounded-lg px-2.5 py-1 text-[11px] font-semibold transition-all break-words max-w-full">
                                                {{ $dist->name }}
                                            </a>
                                        @empty
                                            <span class="text-[11px] text-slate-400 italic">Kecamatan Utama {{ $city->name }}</span>
                                        @endforelse
                                    </div>
                                </details>

                                {{-- Full Width City Action Button (Thumb Ergonomic) --}}
                                <a href="{{ route('area.city', $city->slug) }}" 
                                   class="w-full min-h-[48px] bg-[#0B3B60] hover:bg-emerald-600 active:bg-emerald-700 text-white font-bold text-xs sm:text-sm py-3 px-4 rounded-xl text-center flex items-center justify-center gap-1.5 transition-colors shadow-xs mt-2">
                                    <span>Landing Page {{ $city->name }}</span>
                                    <span>&rarr;</span>
                                </a>
                            </div>

                        </div>
                        @endforeach
                    </div>

                </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- 3. CATEGORIES DIRECTORY HUB --}}
    <section class="py-10 sm:py-16 bg-white border-t border-slate-200 overflow-hidden" aria-labelledby="categories-heading">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 sm:space-y-14">
            
            {{-- 7 Main Service Categories Grid --}}
            <div>
                <div class="mb-4 sm:mb-6">
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-600">KATEGORI PENGERJAAN</span>
                    <h3 id="categories-heading" class="text-lg sm:text-2xl font-bold text-[#0B3B60] mt-0.5">
                        Layanan Spesialis Pipa &amp; Drainase
                    </h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3.5 sm:gap-4">
                    @foreach($services as $srv)
                        <a href="{{ route('layanan.show', $srv->slug) }}" 
                           class="bg-slate-50 hover:bg-emerald-50/50 border border-slate-200 hover:border-emerald-400 rounded-xl p-4 transition-all text-slate-900 text-decoration-none flex items-center gap-3.5 group shadow-2xs">
                            <span class="text-2xl sm:text-3xl shrink-0">🛠️</span>
                            <div>
                                <h4 class="font-bold text-sm sm:text-base text-slate-900 group-hover:text-emerald-700 transition-colors">{{ $srv->name }}</h4>
                                <p class="text-xs text-slate-500 mt-0.5">Pengerjaan Tanpa Bongkar</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- 8 Property Types Visual Grid Showcase --}}
            @if(isset($propertyTypes) && $propertyTypes->isNotEmpty())
            <div>
                <div class="mb-4 sm:mb-6">
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-600">🏢 TIPE PROPERTI USAHA &amp; HUNIAN</span>
                    <h3 class="text-lg sm:text-2xl font-bold text-[#0B3B60] mt-0.5">
                        Solusi Pelancaran Pipa Berdasarkan Jenis Bangunan
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 mt-1">
                        Layanan penanganan pipa mampet terspesialisasi untuk hunian pribadi, tempat usaha, hingga fasilitas komersial.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($propertyTypes as $pIdx => $prop)
                    <?php
                        $propWebpImg = $mediaService->getPropertyImage($prop->slug, $pIdx);
                    ?>
                    <a href="{{ route('property.show', $prop->slug) }}" 
                       class="bg-slate-50 border border-slate-200 rounded-xl overflow-hidden shadow-2xs hover:border-emerald-500 transition-all flex flex-col justify-between group">
                        <div class="relative h-36 bg-slate-900 overflow-hidden">
                            <img src="{{ $propWebpImg }}" alt="Jasa Saluran Pipa Mampet {{ $prop->name }} - Rootera Plumbing" class="w-full h-full object-cover" loading="lazy" decoding="async">
                            <span class="absolute top-2.5 right-2.5 bg-slate-900/85 text-emerald-400 text-[10px] font-bold px-2 py-0.5 rounded-full">
                                ⏱️ 30-90 Mnt
                            </span>
                            <span class="absolute bottom-2.5 left-3 text-xl">
                                {{ $prop->icon }}
                            </span>
                        </div>
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <h4 class="font-bold text-sm text-slate-900 group-hover:text-emerald-600 transition-colors mb-1">
                                {{ $prop->name }}
                            </h4>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                Penanganan pipa tersumbat steril &amp; profesional garansi tuntas.
                            </p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </section>

    {{-- 4. EMERGENCY BOTTOM CTA BANNER (SAFE PADDING UNTUK FAB WHATSAPP) --}}
    <section class="bg-gradient-to-b from-[#0B3B60] to-[#06243D] text-white py-12 sm:py-16 pb-28 sm:pb-32 text-center relative overflow-hidden">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
            <h2 class="text-xl sm:text-3xl font-bold text-white leading-snug">
                Kota Anda Belum Terdaftar atau Butuh Panggilan Darurat?
            </h2>
            <p class="text-xs sm:text-base text-slate-200 max-w-2xl mx-auto leading-relaxed">
                Tim teknisi Rootera Plumbing (J&amp;J Group) siap meluncur 24 Jam nonstop ke lokasi tempat tinggal &amp; usaha Anda.
            </p>
            
            <div class="pt-2">
                <a href="https://wa.me/6281385404000?text={{ urlencode('Halo Rootera, saya ingin menanyakan jangkauan teknisi pipa mampet untuk lokasi saya.') }}" 
                   target="_blank" 
                   rel="noopener"
                   class="w-full sm:w-auto min-h-[48px] bg-[#25D366] hover:bg-[#1EBE5A] active:bg-[#19a34d] text-white font-bold text-sm sm:text-base py-3.5 px-8 rounded-full inline-flex items-center justify-center gap-2.5 shadow-md transition-all">
                    <svg class="w-5 h-5 fill-current shrink-0" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    <span>Hubungi Customer Service WhatsApp (24 Jam)</span>
                </a>
            </div>
        </div>
    </section>

</div>

{{-- Real-Time Search Vanilla JS --}}
<script>
function filterDirectory() {
    const input = document.getElementById('directorySearchInput');
    const filter = input.value.toLowerCase().trim();
    const items = document.querySelectorAll('.city-search-item');
    const provinceBlocks = document.querySelectorAll('.province-card-block');
    let visibleCount = 0;

    items.forEach(item => {
        const cityName = item.getAttribute('data-city-name') || '';
        const districts = item.getAttribute('data-districts') || '';

        if (cityName.includes(filter) || districts.includes(filter)) {
            item.style.display = 'flex';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });

    provinceBlocks.forEach(block => {
        const visibleItems = block.querySelectorAll('.city-search-item:not([style*="display: none"])');
        if (visibleItems.length === 0 && filter !== '') {
            block.style.display = 'none';
        } else {
            block.style.display = 'block';
        }
    });

    const counter = document.getElementById('searchCounter');
    if (filter !== '') {
        counter.textContent = `Menampilkan ${visibleCount} hasil pencarian untuk "${filter}"`;
    } else {
        counter.textContent = '';
    }
}
</script>
@endsection
