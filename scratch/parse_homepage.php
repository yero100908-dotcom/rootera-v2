<?php
$html = file_get_contents(__DIR__ . '/live_homepage.html');

libxml_use_internal_errors(true);
$dom = new DOMDocument();
$dom->loadHTML($html);

// Title
$titles = $dom->getElementsByTagName('title');
$titleText = $titles->length > 0 ? $titles->item(0)->textContent : 'N/A';

// Metas
$metas = $dom->getElementsByTagName('meta');
$description = 'N/A';
$robots = 'N/A';
$keywords = 'N/A';
foreach ($metas as $meta) {
    if (strtolower($meta->getAttribute('name')) === 'description') {
        $description = $meta->getAttribute('content');
    }
    if (strtolower($meta->getAttribute('name')) === 'robots') {
        $robots = $meta->getAttribute('content');
    }
    if (strtolower($meta->getAttribute('name')) === 'keywords') {
        $keywords = $meta->getAttribute('content');
    }
}

// Canonical
$links = $dom->getElementsByTagName('link');
$canonical = 'N/A';
foreach ($links as $link) {
    if (strtolower($link->getAttribute('rel')) === 'canonical') {
        $canonical = $link->getAttribute('href');
    }
}

echo "=== METADATA & INDEXING ===\n";
echo "TITLE: " . $titleText . "\n";
echo "TITLE LENGTH: " . mb_strlen($titleText) . " chars\n";
echo "META DESC: " . $description . "\n";
echo "DESC LENGTH: " . mb_strlen($description) . " chars\n";
echo "KEYWORDS: " . $keywords . "\n";
echo "ROBOTS: " . $robots . "\n";
echo "CANONICAL: " . $canonical . "\n\n";

echo "=== HEADINGS HIERARCHY ===\n";
foreach (['h1', 'h2', 'h3', 'h4'] as $tag) {
    $nodes = $dom->getElementsByTagName($tag);
    echo strtoupper($tag) . " Count: " . $nodes->length . "\n";
    foreach ($nodes as $i => $node) {
        $txt = trim(preg_replace('/\s+/', ' ', $node->textContent));
        echo "  [" . strtoupper($tag) . " #" . ($i+1) . "] " . $txt . "\n";
    }
}

echo "\n=== INTERNAL LINKS & ANCHOR TEXT ===\n";
$anchors = $dom->getElementsByTagName('a');
$internalLinks = [];
$bandarLampungLinks = [];
$servicesLinks = [];

foreach ($anchors as $a) {
    $href = $a->getAttribute('href');
    $anchorText = trim(preg_replace('/\s+/', ' ', $a->textContent));
    
    if (strpos($href, 'rooteraplumbing.id') !== false || strpos($href, '/') === 0) {
        $internalLinks[] = [
            'href' => $href,
            'text' => $anchorText
        ];
        if (stripos($href, 'bandar-lampung') !== false || stripos($anchorText, 'lampung') !== false) {
            $bandarLampungLinks[] = [
                'href' => $href,
                'text' => $anchorText
            ];
        }
        if (stripos($href, 'layanan') !== false || stripos($href, 'jasa-saluran-mampet') !== false) {
            $servicesLinks[] = [
                'href' => $href,
                'text' => $anchorText
            ];
        }
    }
}

echo "Total Internal Links: " . count($internalLinks) . "\n";
echo "Bandar Lampung / Lampung related links count: " . count($bandarLampungLinks) . "\n";
foreach ($bandarLampungLinks as $link) {
    echo "  - Link: " . $link['href'] . " | Text: '" . $link['text'] . "'\n";
}

echo "\nSample Service / Category Internal Links (first 15):\n";
foreach (array_slice($servicesLinks, 0, 15) as $link) {
    echo "  - Link: " . $link['href'] . " | Text: '" . $link['text'] . "'\n";
}

echo "\n=== STRUCTURED DATA (JSON-LD) ===\n";
$scripts = $dom->getElementsByTagName('script');
$jsonLdCount = 0;
foreach ($scripts as $script) {
    if ($script->getAttribute('type') === 'application/ld+json') {
        $jsonLdCount++;
        echo "Schema #" . $jsonLdCount . ":\n";
        echo $script->textContent . "\n-----------------------------------\n";
    }
}

// Text & Keyword density analysis
$bodyText = strip_tags($html);
$bodyTextClean = preg_replace('/\s+/', ' ', $bodyText);
$totalWords = str_word_count(strtolower($bodyTextClean));

echo "\n=== KEYWORD ANALYSIS ===\n";
echo "Total Word Count: " . $totalWords . "\n";

$keywordsToTest = [
    'jasa saluran pipa mampet',
    'jasa saluran mampet',
    'jasa pipa mampet',
    'saluran mampet',
    'pipa mampet',
    'pelancar pipa mampet',
    'bandar lampung',
    'lampung',
    'tanpa bongkar',
    'hydro-jetting',
    'cctv',
    'wastafel mampet',
    'wc mampet'
];

foreach ($keywordsToTest as $kw) {
    $count = substr_count(strtolower($bodyTextClean), $kw);
    $density = $totalWords > 0 ? round(($count * str_word_count($kw) / $totalWords) * 100, 2) : 0;
    echo "  - '$kw': $count times (Approx Density: $density%)\n";
}
