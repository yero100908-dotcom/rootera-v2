{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
{!! '<' . '?xml-stylesheet type="text/xsl" href="/sitemap.xsl"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
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
