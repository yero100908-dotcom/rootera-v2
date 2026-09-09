{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
{!! '<' . '?xml-stylesheet type="text/xsl" href="' . url('/sitemap.xsl') . '"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Service Category Landing Pages --}}
    @foreach ($categories as $category)
    <url>
        <loc>{{ route('layanan.show', $category->slug) }}</loc>
        @if($category->updated_at)
        <lastmod>{{ $category->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        @endif
        <changefreq>weekly</changefreq>
        <priority>0.95</priority>
    </url>

        {{-- Programmatic Category x City Landing Pages --}}
        @foreach ($cities as $city)
        <url>
            <loc>{{ $category->slug === 'pipa-mampet' ? url("/jasa-saluran-mampet/{$city->slug}") : url("/layanan-pipa-mampet/{$category->slug}/{$city->slug}") }}</loc>
            <changefreq>weekly</changefreq>
            <priority>0.90</priority>
        </url>
        @endforeach
    @endforeach

    {{-- B2B Commercial Sector Landing Pages --}}
    @if(isset($sectors))
    @foreach ($sectors as $sec)
    <url>
        <loc>{{ url("/sektor-plumbing/{$sec->slug}") }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>
        @foreach ($cities as $city)
        <url>
            <loc>{{ url("/sektor-plumbing/{$sec->slug}/{$city->slug}") }}</loc>
            <changefreq>weekly</changefreq>
            <priority>0.85</priority>
        </url>
        @endforeach
    @endforeach
    @endif
</urlset>
