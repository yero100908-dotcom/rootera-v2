{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
        <image:image>
            <image:loc>{{ asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp') }}</image:loc>
            <image:title>Rootera Plumbing - Jasa Saluran Pipa Mampet 24 Jam</image:title>
            <image:caption>Layanan jasa saluran pipa mampet tanpa bongkar oleh Rootera Plumbing</image:caption>
        </image:image>
    </url>
    <url>
        <loc>{{ route('layanan') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.95</priority>
        <image:image>
            <image:loc>{{ asset('images/JnJ.webp') }}</image:loc>
            <image:title>Katalog Layanan Rootera Plumbing</image:title>
        </image:image>
    </url>
    <url>
        <loc>{{ route('area-layanan') }}</loc>
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
        <image:image>
            <image:loc>{{ asset('images/dokumentasi/teknisi-rootera-stasiun-kai-jateng.webp') }}</image:loc>
            <image:title>Tim Teknisi Rootera Plumbing</image:title>
        </image:image>
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
        <image:image>
            <image:loc>{{ asset('images/dokumentasi/pelancar-saluran-kloset-toilet-mampet.webp') }}</image:loc>
            <image:title>Galeri Dokumentasi Pipa Mampet Rootera</image:title>
        </image:image>
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

    @if(isset($technologies))
    @foreach ($technologies as $tech)
    <url>
        <loc>{{ route('technologies.show', $tech->slug) }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.88</priority>
        <image:image>
            <image:loc>{{ $tech->image_url }}</image:loc>
            <image:title>{{ $tech->tool_name }} - Rootera Plumbing</image:title>
        </image:image>
    </url>
    @endforeach
    @endif
</urlset>
