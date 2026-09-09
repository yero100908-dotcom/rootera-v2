{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
{!! '<' . '?xml-stylesheet type="text/xsl" href="' . url('/sitemap.xsl') . '"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>daily</changefreq>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>{{ url('/layanan') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>
    <url>
        <loc>{{ url('/cek-kondisi-pipa') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>
    <url>
        <loc>{{ url('/jasa-cuci-toren-air') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>
    <url>
        <loc>{{ url('/garansi') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ url('/tentang-kami/garansi-layanan') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ url('/layanan-b2b-komersial') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ url('/layanan-b2b/licensing') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ url('/layanan-b2b/faktur-pajak') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ url('/tentang-kami') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ url('/tentang-kami/holding-jj-group') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ url('/tentang-kami/sop-sanitasi-k3') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ url('/tentang-kami/profil') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ url('/tentang-kami/peralatan-teknologi') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ url('/tentang-kami/portofolio-klien') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ url('/pusat-bantuan') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ url('/faq') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    @if(isset($faqCategories))
    @foreach ($faqCategories as $cat)
    <url>
        <loc>{{ route('faq.category', $cat->slug) }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    @endforeach
    @endif
    @if(isset($technologies))
    @foreach ($technologies as $tech)
    <url>
        <loc>{{ route('technologies.show', $tech->slug) }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    @endforeach
    @endif
    <url>
        <loc>{{ url('/kontak') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>{{ url('/privacy-policy') }}</loc>
        <changefreq>yearly</changefreq>
        <priority>0.30</priority>
    </url>
    <url>
        <loc>{{ url('/terms-of-service') }}</loc>
        <changefreq>yearly</changefreq>
        <priority>0.30</priority>
    </url>
</urlset>
