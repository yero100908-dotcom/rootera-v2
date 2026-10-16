{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
{!! '<' . '?xml-stylesheet type="text/xsl" href="' . url('/sitemap.xsl') . '"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    {{-- ── Cluster landing pages (/area-perumahan/{slug}) ── --}}
    @foreach($clusters as $cluster)
    <url>
        <loc>{{ url("/area-perumahan/{$cluster->slug}") }}</loc>
        <lastmod>{{ ($cluster->updated_at ?? now())->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach

    {{-- ── Cluster × Category intersection pages ─────────── --}}
    @foreach($clusters as $cluster)
        @foreach($categories as $cat)
        <url>
            <loc>{{ url("/area-perumahan/{$cluster->slug}/{$cat->slug}") }}</loc>
            <lastmod>{{ ($cluster->updated_at ?? now())->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.55</priority>
        </url>
        @endforeach
    @endforeach

</urlset>
