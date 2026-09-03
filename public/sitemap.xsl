<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" 
    xmlns:html="http://www.w3.org/TR/REC-html40"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:output method="html" version="1.0" encoding="UTF-8" indent="yes"/>

    <xsl:template match="/">
        <html lang="id">
        <head>
            <title>XML Sitemap | Rootera Plumbing</title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <style type="text/css">
                body {
                    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
                    color: #1e293b;
                    background-color: #f8fafc;
                    margin: 0;
                    padding: 0;
                    line-height: 1.5;
                }
                .header {
                    background: linear-gradient(135deg, #0A2E78 0%, #060B14 100%);
                    color: #ffffff;
                    padding: 2.25rem 1.5rem;
                    border-bottom: 4px solid #169F81;
                }
                .header-container {
                    max-width: 1100px;
                    margin: 0 auto;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    flex-wrap: wrap;
                    gap: 1rem;
                }
                .logo-title {
                    display: flex;
                    align-items: center;
                    gap: 0.75rem;
                }
                .logo-title h1 {
                    font-size: 1.5rem;
                    margin: 0;
                    font-weight: 800;
                    letter-spacing: -0.02em;
                }
                .logo-title h1 span {
                    color: #169F81;
                }
                .subtitle {
                    font-size: 0.85rem;
                    color: #94a3b8;
                    margin-top: 0.25rem;
                }
                .btn-home {
                    display: inline-flex;
                    align-items: center;
                    gap: 0.4rem;
                    background: rgba(22, 159, 129, 0.2);
                    border: 1px solid rgba(22, 159, 129, 0.5);
                    color: #a3f0c2;
                    padding: 0.5rem 1.25rem;
                    border-radius: 50px;
                    font-size: 0.85rem;
                    font-weight: 700;
                    text-decoration: none;
                }
                .btn-home:hover {
                    background: #169F81;
                    color: #ffffff;
                }
                .container {
                    max-width: 1100px;
                    margin: 2rem auto;
                    padding: 0 1.5rem;
                }
                .intro-desc {
                    background: #ffffff;
                    border-radius: 12px;
                    padding: 1rem 1.25rem;
                    border: 1px solid #e2e8f0;
                    border-left: 4px solid #169F81;
                    margin-bottom: 1.25rem;
                    color: #475569;
                    font-size: 0.875rem;
                    line-height: 1.6;
                    box-shadow: 0 1px 3px rgba(0,0,0,0.04);
                }
                .stats-card {
                    background: #ffffff;
                    border-radius: 12px;
                    padding: 1.25rem 1.5rem;
                    border: 1px solid #e2e8f0;
                    margin-bottom: 1.5rem;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
                }
                .stats-count {
                    font-weight: 700;
                    font-size: 0.95rem;
                    color: #0A2E78;
                }
                .table-card {
                    background: #ffffff;
                    border-radius: 12px;
                    border: 1px solid #e2e8f0;
                    overflow: hidden;
                    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    text-align: left;
                    font-size: 0.875rem;
                }
                th {
                    background: #f1f5f9;
                    color: #334155;
                    font-weight: 700;
                    padding: 0.875rem 1.25rem;
                    border-bottom: 1px solid #e2e8f0;
                    text-transform: uppercase;
                    font-size: 0.75rem;
                    letter-spacing: 0.05em;
                }
                td {
                    padding: 0.875rem 1.25rem;
                    border-bottom: 1px solid #f1f5f9;
                    word-break: break-all;
                }
                tr:nth-child(even) td {
                    background-color: #f8fafc;
                }
                tr:hover td {
                    background-color: #f0fdf4;
                }
                a {
                    color: #0A2E78;
                    text-decoration: none;
                    font-weight: 600;
                }
                a:hover {
                    color: #169F81;
                    text-decoration: underline;
                }
                .badge-priority {
                    display: inline-block;
                    padding: 0.2rem 0.6rem;
                    border-radius: 50px;
                    font-weight: 700;
                    font-size: 0.75rem;
                    background: #e0f2fe;
                    color: #0369a1;
                }
                .badge-priority-high {
                    background: #dcfce7;
                    color: #15803d;
                }
                .badge-freq {
                    text-transform: capitalize;
                    color: #64748b;
                    font-size: 0.8rem;
                }
                .footer {
                    text-align: center;
                    margin: 3rem 0 2rem;
                    font-size: 0.8rem;
                    color: #94a3b8;
                }
            </style>
        </head>
        <body>
            <div class="header">
                <div class="header-container">
                    <div>
                        <div class="logo-title">
                            <span style="font-size: 1.8rem;">🔧</span>
                            <h1>ROOTERA <span>PLUMBING</span></h1>
                        </div>
                        <div class="subtitle">XML Sitemap Engine — Professional Plumbing Services</div>
                    </div>
                    <a href="https://rooteraplumbing.id" class="btn-home">← Beranda Rootera.id</a>
                </div>
            </div>

            <div class="container">
                <!-- INTRODUCTORY DESCRIPTION FOR USERS & WEBMASTERS -->
                <div class="intro-desc">
                    💡 <strong>Petunjuk Peta Situs:</strong> Peta Situs XML ini dibuat secara otomatis oleh <strong>Rootera Plumbing SEO Engine</strong> untuk memfasilitasi perayapan mesin pencari (seperti Googlebot) dalam mengindeks seluruh struktur layanan, artikel edukasi, cakupan wilayah, dan dokumentasi proyek secara cepat dan akurat.
                </div>

                <!-- SITEMAP INDEX TEMPLATE -->
                <xsl:if test="*[local-name()='sitemapindex']">
                    <div class="stats-card">
                        <div class="stats-count">
                            📁 Master Index Sitemap — Total Sub-Sitemap: <xsl:value-of select="count(*[local-name()='sitemapindex']/*[local-name()='sitemap'])"/>
                        </div>
                        <div style="font-size: 0.8rem; color: #64748b;">
                            Format Standar Googlebot Sitemaps 0.9
                        </div>
                    </div>

                    <div class="table-card">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 65%;">Sub-Sitemap XML</th>
                                    <th style="width: 35%;">Waktu Pembaruan Terakhir (UTC)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <xsl:for-each select="*[local-name()='sitemapindex']/*[local-name()='sitemap']">
                                    <tr>
                                        <td>
                                            <a href="{*[local-name()='loc']}">
                                                <xsl:value-of select="*[local-name()='loc']"/>
                                            </a>
                                        </td>
                                        <td style="color: #64748b; font-size: 0.8rem;">
                                            <xsl:value-of select="*[local-name()='lastmod']"/>
                                        </td>
                                    </tr>
                                </xsl:for-each>
                            </tbody>
                        </table>
                    </div>
                </xsl:if>

                <!-- URLSET TEMPLATE -->
                <xsl:if test="*[local-name()='urlset']">
                    <div class="stats-card">
                        <div class="stats-count">
                            📄 Daftar URL Terindeks — Total Halaman: <xsl:value-of select="count(*[local-name()='urlset']/*[local-name()='url'])"/>
                        </div>
                        <div>
                            <a href="/sitemap.xml" style="font-size: 0.85rem;">← Kembali ke Index Sitemap Utama</a>
                        </div>
                    </div>

                    <div class="table-card">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 55%;">Alamat URL (Location)</th>
                                    <th style="width: 15%;">Priority</th>
                                    <th style="width: 15%;">Frequency</th>
                                    <th style="width: 15%;">Last Modified</th>
                                </tr>
                            </thead>
                            <tbody>
                                <xsl:for-each select="*[local-name()='urlset']/*[local-name()='url']">
                                    <tr>
                                        <td>
                                            <a href="{*[local-name()='loc']}" target="_blank">
                                                <xsl:value-of select="*[local-name()='loc']"/>
                                            </a>
                                        </td>
                                        <td>
                                            <xsl:variable name="p" select="*[local-name()='priority']"/>
                                            <span class="badge-priority">
                                                <xsl:if test="$p &gt;= 0.9">
                                                    <xsl:attribute name="class">badge-priority badge-priority-high</xsl:attribute>
                                                </xsl:if>
                                                <xsl:value-of select="*[local-name()='priority']"/>
                                            </span>
                                        </td>
                                        <td class="badge-freq">
                                            <xsl:value-of select="*[local-name()='changefreq']"/>
                                        </td>
                                        <td style="color: #64748b; font-size: 0.8rem;">
                                            <xsl:value-of select="*[local-name()='lastmod']"/>
                                        </td>
                                    </tr>
                                </xsl:for-each>
                            </tbody>
                        </table>
                    </div>
                </xsl:if>

                <div class="footer">
                    Generated for Googlebot / Search Engine consumption by <strong>Rootera Plumbing SEO Engine</strong>.
                </div>
            </div>
        </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
