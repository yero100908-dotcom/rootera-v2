{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
{!! '<' . '?xml-stylesheet type="text/xsl" href="/sitemap.xsl"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    
    {{-- Main Blog Portal Hub --}}
    <url>
        <loc>{{ route('blog') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.90</priority>
    </url>

    {{-- Industry Category Pillars --}}
    @if(isset($categories))
    @foreach ($categories as $catKey => $catLabel)
    <url>
        <loc>{{ route('blog', ['category' => $catKey]) }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.85</priority>
    </url>
    @endforeach
    @endif

    {{-- Articles & News Items --}}
    @foreach ($articles as $article)
    <url>
        <loc>{{ route('blog.show', $article->slug) }}</loc>
        @if($article->updated_at)
        <lastmod>{{ $article->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        @endif
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
        @if($article->thumbnail_url)
        <image:image>
            <image:loc>{{ $article->thumbnail_url }}</image:loc>
            <image:title>{{ $article->clean_title }}</image:title>
        </image:image>
        @endif
    </url>
    @endforeach
</urlset>
