{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
{!! '<' . '?xml-stylesheet type="text/xsl" href="' . url('/sitemap.xsl') . '"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/jasa-saluran-mampet') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.95</priority>
    </url>
    <url>
        <loc>{{ url('/kategori-properti') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>

    {{-- City Hub Pages --}}
    @foreach ($cities as $city)
    <url>
        <loc>{{ url("/jasa-saluran-mampet/{$city->slug}") }}</loc>
        <lastmod>{{ ($city->updated_at ?? now())->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.90</priority>
    </url>
    @endforeach

    {{-- Property Types Landing Pages --}}
    @if(isset($propertyTypes))
    @foreach ($propertyTypes as $prop)
    <url>
        <loc>{{ url("/solusi-properti/{$prop->slug}") }}</loc>
        <lastmod>{{ ($prop->updated_at ?? now())->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.85</priority>
    </url>
        @foreach ($cities as $city)
        <url>
            <loc>{{ url("/solusi-properti/{$prop->slug}/{$city->slug}") }}</loc>
            <lastmod>{{ ($city->updated_at ?? now())->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.80</priority>
        </url>
        @endforeach
    @endforeach
    @endif
</urlset>
