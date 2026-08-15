<section class="section bg-slate-50" aria-labelledby="area-heading">
    <div class="container">
        <div class="text-center mb-12">
            <span class="badge badge-green">Jangkauan Wilayah</span>
            <h2 class="section-title" id="area-heading">
                Melayani <span>Kota-Kota Besar</span>
            </h2>
            <p class="section-sub">Tim teknisi Rootera siap melayani panggilan rumah, ruko, restoran, hingga gedung komersial di berbagai kota.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
            $areaColors = [
                ['#0A2E78','#169F81'],['#169F81','#1E73D8'],['#1E73D8','#0A2E78'],
                ['#0d3a94','#1dbf9e'],['#169F81','#0A2E78'],['#1E73D8','#169F81'],
            ];
            $areaEmojis = ['🏙️','🌊','🏛️','🌺','🌴','🏘️'];
            @endphp
            @foreach($serviceAreas->take(6) as $i => $area)
            <a href="{{ route('area-layanan.show', $area->slug) }}" class="area-card group rounded-2xl overflow-hidden shadow-md hover:shadow-xl relative aspect-[4/3] block transition-all duration-500" aria-label="Area {{ $area->name }}">
                @if($area->image)
                    <img src="{{ Storage::url($area->image) }}" alt="Area layanan {{ $area->name }}" class="area-card-img w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy" width="400" height="300">
                @else
                    <div class="area-card-img w-full h-full flex items-center justify-center text-4xl" style="background:linear-gradient(135deg,{{ $areaColors[$i % 6][0] }},{{ $areaColors[$i % 6][1] }})">
                        {{ $areaEmojis[$i % 6] }}
                    </div>
                @endif
                <div class="area-card-overlay absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-900/40 to-transparent p-6 flex flex-col justify-end transition-all duration-300 group-hover:from-teal-950/90">
                    <span class="inline-block text-xs font-bold text-teal-400 uppercase tracking-wider mb-1">Area Layanan Aktif</span>
                    <h3 class="text-white text-xl font-extrabold uppercase tracking-wide group-hover:text-teal-300 transition-colors">
                        {{ $area->name }}
                    </h3>
                    @if($area->province)
                    <p class="text-slate-300 text-xs font-medium mt-1 group-hover:text-white">
                        {{ $area->province }}
                    </p>
                    @endif
                </div>
            </a>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('area-layanan') }}" class="btn btn-secondary shadow-sm hover:shadow-md">
                <span>Lihat Seluruh Area Jangkauan</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>
