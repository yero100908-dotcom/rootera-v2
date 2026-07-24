<section class="section bg-offwhite" aria-labelledby="area-heading">
    <div class="container">
        <div class="text-center" style="margin-bottom:3rem">
            <span class="badge badge-green">Jangkauan Kami</span>
            <h2 class="section-title" id="area-heading" style="margin-top:.75rem">
                Melayani <span>Seluruh Kota</span>
            </h2>
            <p class="section-sub">Tim profesional Rooterin siap melayani berbagai kota besar di Indonesia.</p>
        </div>
        <div class="area-grid">
            @php
            $areaColors = [
                ['#0A2E78','#169F81'],['#169F81','#1E73D8'],['#1E73D8','#0A2E78'],
                ['#0d3a94','#1dbf9e'],['#169F81','#0A2E78'],['#1E73D8','#169F81'],
            ];
            $areaEmojis = ['🏙️','🌊','🏛️','🌺','🌴','🏘️'];
            @endphp
            @foreach($serviceAreas->take(6) as $i => $area)
            <article class="area-card fade-in" style="animation-delay:{{ $i * 0.08 }}s" aria-label="{{ $area->name }}">
                @if($area->image)
                    <img src="{{ Storage::url($area->image) }}" alt="Area layanan {{ $area->name }}" class="area-card-img" loading="lazy" width="400" height="300">
                @else
                    <div class="area-card-img" style="background:linear-gradient(135deg,{{ $areaColors[$i % 6][0] }},{{ $areaColors[$i % 6][1] }});display:flex;align-items:center;justify-content:center;font-size:3rem;height:100%;min-height:160px">
                        {{ $areaEmojis[$i % 6] }}
                    </div>
                @endif
                <div class="area-card-overlay">
                    <div class="area-card-name">{{ $area->name }}</div>
                    @if($area->province)
                    <div class="area-card-province">{{ $area->province }}</div>
                    @endif
                </div>
            </article>
            @endforeach
        </div>
        <div class="text-center" style="margin-top:2rem">
            <a href="{{ route('area-layanan') }}" class="btn btn-secondary">Lihat Semua Area</a>
        </div>
    </div>
</section>
