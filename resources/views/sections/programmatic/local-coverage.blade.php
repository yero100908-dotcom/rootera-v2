{{-- Local Micro-Coverage & Kelurahan Mesh Grid --}}
<x-local-micro-mesh 
    :locationShort="$locationShort"
    :locationName="$locationName"
    estimatedArrival="Teknisi Siaga Hari Ini"
    :dispatchHub="$dispatchHub ?? 'Pos Armada Siaga'"
    :landmarks="$nearbyLandmarks ?? []"
    :districtName="$district->name ?? $locationShort"
    :whatsappNumber="$city->whatsapp_number ?? '6281385404000'"
/>
