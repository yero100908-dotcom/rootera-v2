{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
{!! '<' . '?xml-stylesheet type="text/xsl" href="' . url('/sitemap.xsl') . '"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    
    {{-- Main Blog Portal Hub --}}
    <url>
        <loc>{{ route('blog') }}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    {{-- Published Articles & Portfolios --}}
    @foreach($articles as $article)
    <url>
        <loc>{{ route('blog.show', $article->slug) }}</loc>
        @if($article->updated_at)
        <lastmod>{{ $article->updated_at->tz('Asia/Jakarta')->toAtomString() }}</lastmod>
        @endif
        <changefreq>weekly</changefreq>
        <priority>{{ ($article->is_headline || $article->post_type === 'promo') ? '0.9' : '0.8' }}</priority>
        @if($article->thumbnail_url)
        <image:image>
            <image:loc>{{ $article->thumbnail_url }}</image:loc>
            <image:title>{{ $article->clean_title }}</image:title>
            <image:caption>{{ $article->thumbnail_alt ?: $article->clean_title }}</image:caption>
        </image:image>
        @endif
    </url>
    @endforeach

</urlset>
