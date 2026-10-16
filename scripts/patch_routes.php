<?php
$file = __DIR__ . '/../routes/web.php';
$src  = file_get_contents($file);

$marker = "Route::redirect('/sitemap-cuci-toren-cities.xml'";
$pos    = strpos($src, $marker);
if ($pos === false) {
    echo "ERROR: marker not found\n"; exit(1);
}

$insert  = "Route::get('/sitemap-static.xml',   [SitemapController::class, 'serveStaticFile'])->name('sitemap.static');\n";
$insert .= "Route::get('/sitemap-pseo.xml',     [SitemapController::class, 'serveStaticFile'])->name('sitemap.pseo');\n";
$insert .= "Route::get('/sitemap-articles.xml', [SitemapController::class, 'serveStaticFile'])->name('sitemap.articles');\n";

$patched = substr($src, 0, $pos) . $insert . substr($src, $pos);
file_put_contents($file, $patched);
echo "Routes inserted successfully.\n";
