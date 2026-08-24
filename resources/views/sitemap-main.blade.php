{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('layanan') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.95</priority>
    </url>
    <url>
        <loc>{{ route('area.index') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.95</priority>
    </url>
    <url>
        <loc>{{ route('b2b.index') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.92</priority>
    </url>
    <url>
        <loc>{{ route('property.index') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.92</priority>
    </url>
    <url>
        <loc>{{ route('tentang-kami') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.70</priority>
    </url>
    <url>
        <loc>{{ route('blog') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.85</priority>
    </url>
    <url>
        <loc>{{ route('galeri') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.70</priority>
    </url>
    <url>
        <loc>{{ route('kontak') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ route('faq.index') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.90</priority>
    </url>

    @foreach ($faqCategories as $cat)
    <url>
        <loc>{{ route('faq.category', $cat->slug) }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.85</priority>
    </url>
    @endforeach
</urlset>
