<!-- Clickable Local Tag Cloud Grid -->
<section style="background: #F8FAFC; padding: 3.5rem 1.5rem; border-top: 1px solid #E5E7EB;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h3 style="color: #0A2E78; font-size: 1.35rem; font-weight: 800; margin-bottom: 0.5rem;">🏷️ Pintasan Kata Kunci Pencarian Lokal di {{ $locationShort }}</h3>
        <p style="color: #6B7280; font-size: 0.92rem; margin-bottom: 1.25rem;">Kata kunci pencarian populer solusi pipa air &amp; saluran tersumbat:</p>

        <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
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
                <a href="{{ url('/solusi/' . \Illuminate\Support\Str::slug($tag) . ($city ? '/' . $city->slug : '')) }}" style="background: #ffffff; border: 1px solid #CBD5E1; color: #0A2E78; padding: 0.4rem 0.9rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600; text-decoration: none;" class="hover:border-[#169F81] hover:text-[#169F81]">
                    #{{ $tag }}
                </a>
            @endforeach
        </div>
    </div>
</section>
