<section aria-labelledby="cta-heading" style="background:linear-gradient(135deg,#0A2E78 0%,#169F81 100%);padding:5rem 0;position:relative;overflow:hidden">
    <div style="position:absolute;inset:0;pointer-events:none;z-index:1" aria-hidden="true">
        {{-- Top Waves --}}
        <div style="position:absolute;top:0;left:0;width:100%;height:120px;overflow:hidden;transform:scaleY(-1)" aria-hidden="true">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none" style="width:100%;height:100%">
                <path d="M0,32 C240,96 480,16 720,80 C960,144 1200,64 1440,32 L1440,120 L0,120 Z" fill="rgba(110,231,204,0.18)"></path>
                <path d="M0,64 C360,16 720,112 1080,64 C1260,40 1350,48 1440,64 L1440,120 L0,120 Z" fill="rgba(255,255,255,0.08)"></path>
                <path d="M0,96 C300,64 600,96 900,80 C1200,64 1320,80 1440,96 L1440,120 L0,120 Z" fill="rgba(255,255,255,0.12)"></path>
            </svg>
        </div>

        {{-- Bottom Waves --}}
        <div style="position:absolute;bottom:0;left:0;width:100%;height:140px;overflow:hidden" aria-hidden="true">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none" style="width:100%;height:100%">
                <path d="M0,32 C240,96 480,16 720,80 C960,144 1200,64 1440,32 L1440,120 L0,120 Z" fill="rgba(110,231,204,0.22)"></path>
                <path d="M0,64 C360,16 720,112 1080,64 C1260,40 1350,48 1440,64 L1440,120 L0,120 Z" fill="rgba(255,255,255,0.12)"></path>
                <path d="M0,96 C300,64 600,96 900,80 C1200,64 1320,80 1440,96 L1440,120 L0,120 Z" fill="rgba(255,255,255,0.06)"></path>
            </svg>
        </div>
    </div>
    <div class="container text-center" style="position:relative;z-index:2">
        <span class="badge" style="background:rgba(255,255,255,.2);color:#fff;margin-bottom:1rem">Siap Membantu</span>
        <h2 id="cta-heading" style="color:#fff;font-size:clamp(1.6rem,4vw,2.6rem);margin-bottom:1rem">
            Saluran Mampet? Hubungi Kami <em style="font-style:normal;color:#6ee7cc">Sekarang!</em>
        </h2>
        <p style="color:rgba(255,255,255,.85);font-size:1.05rem;max-width:520px;margin:0 auto 2.5rem">
            Tim ROOTERA siap merespon dalam hitungan menit. Konsultasi pertama gratis!
        </p>
        <div style="display:flex;justify-content:center;gap:1rem;flex-wrap:wrap">
            <a href="https://wa.me/6281385404000?text=Halo%20ROOTERA%2C%20saya%20butuh%20konsultasi." class="btn btn-white" target="_blank" rel="noopener">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                Chat WhatsApp
            </a>
            <a href="{{ route('kontak') }}" class="btn" style="background:transparent;color:#fff;border:2px solid rgba(255,255,255,.5)">
                Formulir Kontak
            </a>
        </div>
    </div>
</section>
