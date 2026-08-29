{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($cities as $city)
        @foreach($city->districts as $district)
        <url>
            <loc>{{ url("/layanan-cuci-toren/{$city->slug}/{$district->slug}") }}</loc>
            <lastmod>{{ $district->updated_at ? $district->updated_at->tz('UTC')->toAtomString() : now()->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.75</priority>
        </url>
        @endforeach
    @endforeach
</urlset>
