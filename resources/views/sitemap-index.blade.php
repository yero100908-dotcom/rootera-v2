{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
{!! '<' . '?xml-stylesheet type="text/xsl" href="' . url('/sitemap.xsl') . '"?' . '>' !!}
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ url('/sitemap-pages.xml') }}</loc>
        <lastmod>{{ $lastmodNow ?? now()->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('/sitemap-services.xml') }}</loc>
        <lastmod>{{ $lastmodNow ?? now()->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('/sitemap-cities.xml') }}</loc>
        <lastmod>{{ $lastmodNow ?? now()->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('/sitemap-districts.xml') }}</loc>
        <lastmod>{{ $lastmodNow ?? now()->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('/sitemap-blog.xml') }}</loc>
        <lastmod>{{ $lastmodBlog ?? now()->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('/sitemap-gallery.xml') }}</loc>
        <lastmod>{{ $lastmodNow ?? now()->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>{{ url('/sitemap-videos.xml') }}</loc>
        <lastmod>{{ $lastmodNow ?? now()->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
</sitemapindex>
