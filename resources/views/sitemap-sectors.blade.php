{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @if(isset($sectors))
    @foreach ($sectors as $sec)
    <url>
        <loc>{{ url("/sektor-plumbing/{$sec->slug}") }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.92</priority>
    </url>
        @foreach ($cities as $city)
        <url>
            <loc>{{ url("/sektor-plumbing/{$sec->slug}/{$city->slug}") }}</loc>
            <changefreq>weekly</changefreq>
            <priority>0.88</priority>
        </url>
        @endforeach
    @endforeach
    @endif
</urlset>
