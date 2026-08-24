{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Halaman Utama & Statis --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('layanan') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ route('area-layanan') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ route('tentang-kami') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ route('blog') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('galeri') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ route('kontak') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>

    {{-- Categories / Layanan Detail --}}
    @foreach ($categories as $category)
    <url>
        <loc>{{ route('layanan.show', $category->slug) }}</loc>
        @if($category->updated_at)
        <lastmod>{{ $category->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        @endif
        <changefreq>weekly</changefreq>
        <priority>0.95</priority>
    </url>
    @endforeach

    {{-- Service Areas --}}
    @foreach ($areas as $area)
    <url>
        <loc>{{ url('/jasa-saluran-mampet/' . $area->slug) }}</loc>
        @if($area->updated_at)
        <lastmod>{{ $area->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        @endif
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>
    @endforeach

    {{-- Articles / Blog Detail --}}
    @foreach ($articles as $article)
    <url>
        <loc>{{ route('blog.show', $article->slug) }}</loc>
        @if($article->updated_at)
        <lastmod>{{ $article->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        @endif
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    @endforeach
</urlset>
