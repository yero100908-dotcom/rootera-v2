<?php
/**
 * Append serveStaticFile() to SitemapController.
 */
$file = __DIR__ . '/../app/Http/Controllers/SitemapController.php';
$src  = file_get_contents($file);

$method = <<<'PHPCODE'

    /**
     * Serve an artisan-generated static sitemap XML file from public/.
     * Works for: /sitemap-static.xml, /sitemap-pseo.xml, /sitemap-articles.xml
     * Falls back to a 503 with an XML error body if the file hasn't been generated yet.
     */
    public function serveStaticFile(\Illuminate\Http\Request $request): Response
    {
        // Derive filename from request path: /sitemap-static.xml -> sitemap-static.xml
        $filename = ltrim($request->path(), '/');
        $filepath = public_path($filename);

        if (!file_exists($filepath) || filesize($filepath) === 0) {
            $xml = '<?xml version="1.0" encoding="UTF-8"?>'
                 . '<error>Sitemap not yet generated. Run: php artisan sitemap:generate</error>';
            return response($xml, 503)->header('Content-Type', 'text/xml; charset=utf-8');
        }

        $content = file_get_contents($filepath);
        return response($content, 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }
PHPCODE;

// Insert before the last closing brace of the class
$lastBrace = strrpos($src, '}');
if ($lastBrace === false) {
    echo "ERROR: Could not find class closing brace\n"; exit(1);
}

$patched = substr($src, 0, $lastBrace) . $method . "\n" . substr($src, $lastBrace);
file_put_contents($file, $patched);
echo "serveStaticFile() added to SitemapController.\n";
