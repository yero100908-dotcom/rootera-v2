<!-- Hub Kawasan Terpopuler -->
<section style="background: #ffffff; padding: 4rem 1.5rem; border-top: 1px solid #E5E7EB;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <h3 style="color: #0A2E78; font-size: 1.5rem; font-weight: 800; margin-bottom: 0.5rem;">🔥 Hotspot Kawasan {{ $city->province->name ?? $city->name }} Terpopuler</h3>
        <p style="color: #6B7280; font-size: 0.95rem; margin-bottom: 1.5rem;">Pintasan ke pusat pemukiman residensial &amp; kawasan bisnis di {{ $city->province->name ?? $city->name }}:</p>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 0.85rem;">
            @if(isset($siblingDistricts) && $siblingDistricts->isNotEmpty())
                @foreach($siblingDistricts->take(8) as $sd)
                    <a href="{{ url('/layanan-pipa-mampet/' . $category->slug . '/' . $city->slug . '/' . $sd->slug) }}" class="spoke-link">📍 {{ $sd->name }}</a>
                @endforeach
            @elseif(isset($siblingCities) && $siblingCities->isNotEmpty())
                @foreach($siblingCities->take(8) as $sc)
                    <a href="{{ url('/layanan-pipa-mampet/' . $category->slug . '/' . $sc->slug) }}" class="spoke-link">📍 {{ $sc->name }}</a>
                @endforeach
            @else
                <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/jakarta-utara/pantai-indah-kapuk-pik') }}" class="spoke-link">📍 PIK Pantai Indah Kapuk</a>
                <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/tangerang-selatan/pondok-aren-bintaro-jaya') }}" class="spoke-link">📍 Bintaro Jaya Tangsel</a>
                <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/tangerang-selatan/serpong-bsd-city') }}" class="spoke-link">📍 BSD City Serpong</a>
                <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/kabupaten-bogor/sentul-city') }}" class="spoke-link">📍 Sentul City Bogor</a>
                <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/depok/tapos-margonda-gdc') }}" class="spoke-link">📍 Margonda Depok</a>
                <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/bekasi/rawalumbu-grand-galaxy-jatiwaringin-jatiwarna-summarecon') }}" class="spoke-link">📍 Grand Galaxy Bekasi</a>
                <a href="{{ url('/layanan-pipa-mampet/pipa-mampet/kabupaten-bekasi/cikarang-selatan-kawasan-mm2100-jababeka-ejip-delta-silicon') }}" class="spoke-link">📍 Cikarang Industri</a>
            @endif
        </div>
    </div>
</section>
