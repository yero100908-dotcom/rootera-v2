{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
    @foreach($videos as $video)
    <url>
        <loc>{{ $video['page_url'] }}</loc>
        <video:video>
            <video:thumbnail_loc>{{ $video['thumbnail'] }}</video:thumbnail_loc>
            <video:title>{{ $video['title'] }}</video:title>
            <video:description>{{ $video['description'] }}</video:description>
            <video:content_loc>{{ $video['content'] }}</video:content_loc>
            <video:publication_date>{{ $video['pub_date'] }}</video:publication_date>
            <video:family_friendly>yes</video:family_friendly>
            <video:requires_subscription>no</video:requires_subscription>
            <video:live>no</video:live>
        </video:video>
    </url>
    @endforeach
</urlset>
