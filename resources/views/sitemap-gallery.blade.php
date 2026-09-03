{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    @foreach($galleries as $gallery)
    <url>
        <loc>{{ route('galeri.show', $gallery->slug) }}</loc>
        <lastmod>{{ $gallery->updated_at ? $gallery->updated_at->tz('Asia/Jakarta')->toAtomString() : now()->tz('Asia/Jakarta')->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.85</priority>
        <image:image>
            <image:loc>{{ $gallery->display_thumbnail }}</image:loc>
            <image:title>{{ $gallery->title }} - Rootera Plumbing</image:title>
            <image:caption>{{ $gallery->description ?? 'Dokumentasi riil pengerjaan pelancaran pipa mampet ' . $gallery->title . ' oleh teknisi Rootera Plumbing.' }}</image:caption>
        </image:image>
        @if($gallery->display_before_image)
        <image:image>
            <image:loc>{{ $gallery->display_before_image }}</image:loc>
            <image:title>Kondisi Sebelum Pengerjaan - {{ $gallery->title }}</image:title>
            <image:caption>Kondisi awal saluran pipa tersumbat sebelum dilakukan pelancaran oleh Rootera Plumbing.</image:caption>
        </image:image>
        @endif
    </url>
    @endforeach
</urlset>
