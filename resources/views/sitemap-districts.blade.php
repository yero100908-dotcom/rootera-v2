{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
{!! '<' . '?xml-stylesheet type="text/xsl" href="' . url('/sitemap.xsl') . '"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($cities as $city)
        @foreach ($city->districts as $district)
            @if ($district->is_active ?? true)
                <url>
                    <loc>{{ url("/jasa-saluran-mampet/{$city->slug}/{$district->slug}") }}</loc>
                    <lastmod>{{ ($district->updated_at ?? $city->updated_at ?? now())->tz('UTC')->toAtomString() }}</lastmod>
                    <changefreq>weekly</changefreq>
                    <priority>0.70</priority>
                </url>
            @endif
        @endforeach
    @endforeach
</urlset>

