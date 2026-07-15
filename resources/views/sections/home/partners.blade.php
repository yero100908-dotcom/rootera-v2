<section aria-labelledby="partners-heading" style="background:linear-gradient(135deg,#0A2E78 0%,#169F81 100%);padding:4rem 0;position:relative;overflow:hidden;border-top:1px solid rgba(255,255,255,0.05);border-bottom:1px solid rgba(255,255,255,0.05)">
    <div style="position:absolute;inset:0;pointer-events:none" aria-hidden="true">
        <div style="position:absolute;width:400px;height:400px;border-radius:50%;background:rgba(255,255,255,.03);top:-100px;left:-100px"></div>
    </div>
    <div class="container text-center" style="position:relative;z-index:1;margin-bottom:2.5rem">
        <span class="badge" style="background:rgba(255,255,255,.15);color:#fff;margin-bottom:.5rem">Kerja Sama</span>
        <h2 id="partners-heading" style="color:#fff;font-size:clamp(1.5rem,3.5vw,2.2rem);font-weight:800;margin:0">Mitra & Klien <span style="color:#6ee7cc">Kepercayaan</span> Kami</h2>
    </div>

    @if($partners->count() > 0)
    @php
        // Pastikan minimal ada 30 item untuk Loop 1 agar tidak menyisakan ruang kosong pada layar monitor besar/4K
        $repeatedPartners = collect();
        while ($repeatedPartners->count() < 30) {
            $repeatedPartners = $repeatedPartners->concat($partners);
        }
    @endphp
    <div style="overflow:hidden;width:100%;position:relative;padding:1.5rem 0;background:rgba(255,255,255,0.02);backdrop-filter:blur(4px);border-top:1px solid rgba(255,255,255,0.04);border-bottom:1px solid rgba(255,255,255,0.04)">
        {{-- Edge fade gradients for beautiful premium look --}}
        <div style="position:absolute;left:0;top:0;bottom:0;width:150px;background:linear-gradient(to right, rgba(10,46,120,0.85), transparent);z-index:2;pointer-events:none"></div>
        <div style="position:absolute;right:0;top:0;bottom:0;width:150px;background:linear-gradient(to left, rgba(22,159,129,0.85), transparent);z-index:2;pointer-events:none"></div>

        <div style="display:flex;width:max-content">
            <div class="marquee-track" style="display:flex;gap:1.5rem;animation: marquee-scroll-loop 25s linear infinite;align-items:center">
                {{-- Loop 1 --}}
                @foreach($repeatedPartners as $partner)
                    <div class="partner-logo-wrapper">
                        <img src="{{ $partner->logo_url }}" alt="{{ $partner->nama_mitra }}" class="partner-logo-img" loading="lazy">
                    </div>
                @endforeach
                {{-- Loop 2 (Duplicate for seamless loop) --}}
                @foreach($repeatedPartners as $partner)
                    <div class="partner-logo-wrapper">
                        <img src="{{ $partner->logo_url }}" alt="{{ $partner->nama_mitra }}" class="partner-logo-img" loading="lazy">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @else
    <div class="text-center" style="color:rgba(255,255,255,.5);font-size:.95rem;padding:1rem 0">Belum ada data mitra terdaftar.</div>
    @endif
</section>

<style>
.partner-logo-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100px;
    height: 100px;
    flex-shrink: 0;
}
.partner-logo-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    border-radius: 12px; /* rounded-xl */
    background: #fff; /* bg-white */
    padding: 12px; /* p-3 */
    box-shadow: 0 1px 3px 0 rgba(0,0,0,0.1), 0 1px 2px -1px rgba(0,0,0,0.1); /* shadow-sm */
    transition: all 0.3s ease;
}
.partner-logo-img:hover {
    transform: scale(1.06);
    box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
}
@keyframes marquee-scroll-loop {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
.marquee-track {
    will-change: transform;
}
</style>
