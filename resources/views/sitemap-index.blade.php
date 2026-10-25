{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
{!! '<' . '?xml-stylesheet type="text/xsl" href="/sitemap.xsl"?' . '>' !!}
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ url('/sitemap-pages.xml') }}</loc>
        <lastmod>{{ $lastmodNow }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('/sitemap-services.xml') }}</loc>
        <lastmod>{{ $lastmodNow }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('/sitemap-cities.xml') }}</loc>
        <lastmod>{{ $lastmodCities ?? $lastmodNow }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('/sitemap-districts.xml') }}</loc>
        <lastmod>{{ $lastmodCities ?? $lastmodNow }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('/sitemap-blog.xml') }}</loc>
        <lastmod>{{ $lastmodBlog ?? $lastmodNow }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('/sitemap-gallery.xml') }}</loc>
        <lastmod>{{ $lastmodNow }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('/sitemap-videos.xml') }}</loc>
        <lastmod>{{ $lastmodNow }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('/sitemap-clusters.xml') }}</loc>
        <lastmod>{{ $lastmodClusters ?? $lastmodNow }}</lastmod>
    </sitemap>
</sitemapindex>
