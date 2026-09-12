{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
{!! '<' . '?xml-stylesheet type="text/xsl" href="' . url('/sitemap.xsl') . '"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($cities as $city)
        @foreach ($city->districts as $district)
            {{-- Primary Pipa Mampet District Landing Page --}}
            <url>
                <loc>{{ url("/layanan-pipa-mampet/pipa-mampet/{$city->slug}/{$district->slug}") }}</loc>
                <changefreq>weekly</changefreq>
                <priority>0.70</priority>
            </url>

            {{-- Other Active Service Category District Pages --}}
            @if(isset($categories))
                @foreach($categories as $category)
                    @if($category->slug !== 'pipa-mampet')
                    <url>
                        <loc>{{ url("/layanan-pipa-mampet/{$category->slug}/{$city->slug}/{$district->slug}") }}</loc>
                        <changefreq>weekly</changefreq>
                        <priority>0.70</priority>
                    </url>
                    @endif
                @endforeach
            @endif
        @endforeach
    @endforeach
</urlset>
