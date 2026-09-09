{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<xsl:stylesheet version="1.0"
                xmlns:html="http://www.w3.org/TR/REC-html40"
                xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9"
                xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" version="1.0" encoding="UTF-8" indent="yes"/>

    <xsl:template match="/">
        <html xmlns="http://www.w3.org/1999/xhtml" lang="id">
            <head>
                <title>XML Sitemap Engine — Rootera Plumbing</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <link rel="preconnect" href="https://fonts.googleapis.com" />
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="crossorigin" />
                <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet" />
                <style type="text/css">
                    * { margin: 0; padding: 0; box-sizing: border-box; }
                    body {
                        font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                        background-color: #F8FAFC;
                        color: #1E293B;
                        font-size: 14px;
                        line-height: 1.6;
                    }
                    /* Navbar Header */
                    .navbar {
                        background: linear-gradient(135deg, #0A2E78 0%, #061E52 100%);
                        color: #FFFFFF;
                        padding: 16px 32px;
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        box-shadow: 0 4px 20px rgba(10, 46, 120, 0.15);
                    }
                    .brand {
                        display: flex;
                        align-items: center;
                        gap: 12px;
                        text-decoration: none;
                        color: #FFFFFF;
                    }
                    .brand-icon {
                        width: 38px;
                        height: 38px;
                        background: rgba(22, 159, 129, 0.2);
                        border: 1px solid rgba(22, 159, 129, 0.4);
                        border-radius: 10px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 20px;
                    }
                    .brand-title {
                        font-size: 20px;
                        font-weight: 800;
                        letter-spacing: -0.5px;
                    }
                    .brand-title span.highlight {
                        color: #169F81;
                    }
                    .brand-tagline {
                        font-size: 11px;
                        color: #94A3B8;
                        font-weight: 500;
                        margin-top: -2px;
                    }
                    .btn-home {
                        display: inline-flex;
                        align-items: center;
                        gap: 6px;
                        padding: 8px 18px;
                        background: rgba(255, 255, 255, 0.1);
                        border: 1px solid rgba(255, 255, 255, 0.2);
                        border-radius: 9999px;
                        color: #FFFFFF;
                        text-decoration: none;
                        font-size: 12px;
                        font-weight: 600;
                        transition: all 0.2s ease;
                    }
                    .btn-home:hover {
                        background: #169F81;
                        border-color: #169F81;
                        color: #FFFFFF;
                    }

                    /* Container */
                    .container {
                        max-width: 1200px;
                        margin: 32px auto;
                        padding: 0 24px;
                    }

                    /* Callout Card */
                    .callout-card {
                        background: #FFFFFF;
                        border-left: 4px solid #169F81;
                        border-radius: 12px;
                        padding: 20px 24px;
                        margin-bottom: 24px;
                        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0, 0, 0, 0.03);
                    }
                    .callout-title {
                        font-size: 15px;
                        font-weight: 700;
                        color: #0F172A;
                        margin-bottom: 6px;
                        display: flex;
                        align-items: center;
                        gap: 8px;
                    }
                    .callout-desc {
                        font-size: 13px;
                        color: #475569;
                    }
                    .callout-desc a {
                        color: #1E73D8;
                        text-decoration: none;
                        font-weight: 600;
                    }
                    .callout-desc a:hover { text-decoration: underline; }

                    /* Info Summary Bar */
                    .summary-bar {
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        background: #FFFFFF;
                        border: 1px solid #E2E8F0;
                        border-radius: 12px;
                        padding: 16px 24px;
                        margin-bottom: 24px;
                    }
                    .summary-info {
                        display: flex;
                        align-items: center;
                        gap: 12px;
                    }
                    .summary-label {
                        font-size: 14px;
                        font-weight: 700;
                        color: #0F172A;
                    }
                    .badge-count {
                        background: #E0F2FE;
                        color: #0369A1;
                        font-weight: 700;
                        font-size: 12px;
                        padding: 3px 10px;
                        border-radius: 9999px;
                        border: 1px solid #BAE6FD;
                    }
                    .badge-schema {
                        background: #F1F5F9;
                        color: #475569;
                        font-size: 11px;
                        font-weight: 600;
                        padding: 4px 10px;
                        border-radius: 6px;
                        border: 1px solid #E2E8F0;
                    }

                    /* Table Styling */
                    .table-wrapper {
                        background: #FFFFFF;
                        border: 1px solid #E2E8F0;
                        border-radius: 12px;
                        overflow: hidden;
                        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        text-align: left;
                    }
                    th {
                        background: #F1F5F9;
                        color: #334155;
                        font-size: 12px;
                        font-weight: 700;
                        text-transform: uppercase;
                        letter-spacing: 0.5px;
                        padding: 14px 20px;
                        border-bottom: 1px solid #E2E8F0;
                    }
                    td {
                        padding: 14px 20px;
                        border-bottom: 1px solid #F1F5F9;
                        font-size: 13px;
                        color: #334155;
                    }
                    tr:last-child td { border-bottom: none; }
                    tr:nth-child(even) { background-color: #FAFAFA; }
                    tr:hover { background-color: #F8FAFC; }

                    .link-url {
                        color: #1E73D8;
                        text-decoration: none;
                        font-weight: 600;
                        word-break: break-all;
                        transition: color 0.15s ease;
                    }
                    .link-url:hover {
                        color: #0A2E78;
                        text-decoration: underline;
                    }
                    .freq-tag {
                        display: inline-block;
                        padding: 2px 8px;
                        border-radius: 4px;
                        font-size: 11px;
                        font-weight: 600;
                        background: #ECFDF5;
                        color: #047857;
                        border: 1px solid #A7F3D0;
                        text-transform: lowercase;
                    }
                    .priority-tag {
                        font-weight: 700;
                        color: #0F172A;
                    }

                    /* Footer */
                    .footer {
                        text-align: center;
                        margin-top: 40px;
                        margin-bottom: 40px;
                        font-size: 12px;
                        color: #94A3B8;
                    }
                    .footer strong { color: #64748B; }
                </style>
            </head>
            <body>
                <!-- Header Bar -->
                <div class="navbar">
                    <a href="{{ url('/') }}" class="brand">
                        <div class="brand-icon">🔧</div>
                        <div>
                            <div class="brand-title">ROOTERA <span class="highlight">PLUMBING</span></div>
                            <div class="brand-tagline">XML Sitemap Engine — Professional Plumbing Services</div>
                        </div>
                    </a>
                    <a href="{{ url('/') }}" class="btn-home">← Beranda Rootera.id</a>
                </div>

                <div class="container">
                    <!-- Callout Card -->
                    <div class="callout-card">
                        <div class="callout-title">
                            <span>🤖</span> Petunjuk Visualisasi XML Sitemap Engine
                        </div>
                        <div class="callout-desc">
                            Ini adalah berkas XML Sitemap berstandar <a href="https://www.sitemaps.org/" target="_blank" rel="noopener">sitemap.org 0.9</a> yang dibuat secara otomatis oleh sistem Rootera Plumbing untuk membantu crawler Googlebot &amp; Bingbot mengindeks seluruh rute dan konten resmi. Klik tautan biru di bawah ini untuk menelusuri sub-sitemap atau rute publik.
                        </div>
                    </div>

                    <!-- Master Index View -->
                    <xsl:if test="sitemap:sitemapindex">
                        <div class="summary-bar">
                            <div class="summary-info">
                                <span class="summary-label">🗺️ Master Index Sitemap</span>
                                <span class="badge-count">
                                    <xsl:value-of select="count(sitemap:sitemapindex/sitemap:sitemap)"/> Sub-Sitemap
                                </span>
                            </div>
                            <div class="badge-schema">Googlebot Protocol v0.9 (XML Sitemap Index)</div>
                        </div>

                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 65%;">Sub-Sitemap XML (Location)</th>
                                        <th style="width: 35%;">Waktu Pembaruan Terakhir (UTC / ISO 8601)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <xsl:for-each select="sitemap:sitemapindex/sitemap:sitemap">
                                        <tr>
                                            <td>
                                                <a class="link-url" href="{sitemap:loc}">
                                                    <xsl:value-of select="sitemap:loc"/>
                                                </a>
                                            </td>
                                            <td>
                                                <xsl:value-of select="sitemap:lastmod"/>
                                            </td>
                                        </tr>
                                    </xsl:for-each>
                                </tbody>
                            </table>
                        </div>
                    </xsl:if>

                    <!-- Sub-Sitemap URLSet View -->
                    <xsl:if test="sitemap:urlset">
                        <div class="summary-bar">
                            <div class="summary-info">
                                <span class="summary-label">📄 Sub-Sitemap Urlset</span>
                                <span class="badge-count">
                                    <xsl:value-of select="count(sitemap:urlset/sitemap:url)"/> Total URLs
                                </span>
                            </div>
                            <div class="badge-schema">Googlebot Protocol v0.9 (Urlset)</div>
                        </div>

                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 50%;">URL Transaksional / Halaman (Loc)</th>
                                        <th style="width: 15%;">Frekuensi</th>
                                        <th style="width: 12%;">Prioritas</th>
                                        <th style="width: 23%;">Pembaruan Terakhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <xsl:for-each select="sitemap:urlset/sitemap:url">
                                        <tr>
                                            <td>
                                                <a class="link-url" href="{sitemap:loc}">
                                                    <xsl:value-of select="sitemap:loc"/>
                                                </a>
                                            </td>
                                            <td>
                                                <span class="freq-tag">
                                                    <xsl:value-of select="sitemap:changefreq"/>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="priority-tag">
                                                    <xsl:value-of select="sitemap:priority"/>
                                                </span>
                                            </td>
                                            <td>
                                                <xsl:value-of select="sitemap:lastmod"/>
                                            </td>
                                        </tr>
                                    </xsl:for-each>
                                </tbody>
                            </table>
                        </div>
                    </xsl:if>

                    <!-- Footer -->
                    <div class="footer">
                        Generated for <strong>Googlebot / Search Engine</strong> consumption by <strong>Rootera Plumbing SEO Engine</strong> &amp; Holding J&amp;J Group.
                    </div>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
