{{-- Dynamic Local Micro-Coverage & Kelurahan Mesh Component --}}
@props([
    'locationShort' => 'Wilayah',
    'locationName' => 'Wilayah Terkait',
    'estimatedArrival' => '25–40 Menit',
    'dispatchHub' => 'Pos Hub Armada Utama',
    'landmarks' => []
])

@if(!empty($landmarks) && is_array($landmarks))
<section class="local-mesh-section" style="background: #F8FAFC; padding: 4rem 1.5rem; border-top: 1px solid #E2E8F0; border-bottom: 1px solid #E2E8F0;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <span style="color: #169F81; font-weight: 800; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.05em;">📍 Presisi Jangkauan Mikro</span>
            <h2 style="color: #0A2E78; font-size: clamp(1.6rem, 3vw, 2.2rem); font-weight: 800; margin-top: 0.4rem;">Cakupan Area Kelurahan &amp; Titik Lokasi di {{ $locationShort }}</h2>
            <p style="color: #64748B; font-size: 0.95rem; max-width: 780px; margin: 0.5rem auto 0; line-height: 1.6;">
                Tim teknisi Rootera disiagakan di <strong>{{ $dispatchHub }}</strong> dengan estimasi waktu tempuh <strong>{{ $estimatedArrival }}</strong> ke kelurahan &amp; perumahan berikut:
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 1rem;">
            @foreach($landmarks as $lm)
                <div style="background: #ffffff; border: 1px solid #E2E8F0; border-radius: 14px; padding: 1.1rem 1.25rem; display: flex; align-items: center; justify-content: space-between; gap: 0.75rem; box-shadow: 0 2px 8px rgba(0,0,0,0.02); transition: all 0.2s ease;" class="hover:border-emerald-500 hover:shadow-md">
                    <div style="display: flex; align-items: center; gap: 0.65rem;">
                        <span style="width: 32px; height: 32px; border-radius: 8px; background: rgba(22, 159, 129, 0.1); color: #169F81; display: flex; align-items: center; justify-content: center; font-size: 1rem; shrink-0;">📍</span>
                        <div>
                            <div style="font-weight: 700; color: #0A2E78; font-size: 0.93rem;">{{ $lm }}</div>
                            <div style="font-size: 0.75rem; color: #10B981; font-weight: 600;">Teknisi Standby</div>
                        </div>
                    </div>
                    <span style="font-size: 0.75rem; font-weight: 700; color: #64748B; background: #F1F5F9; padding: 0.25rem 0.6rem; border-radius: 6px;">
                        {{ $estimatedArrival }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
