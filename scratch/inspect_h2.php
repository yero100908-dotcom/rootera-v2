<?php
$html = file_get_contents(__DIR__ . '/live_homepage.html');
libxml_use_internal_errors(true);
$dom = new DOMDocument();
$dom->loadHTML($html);

echo "=== ALL H2 HEADINGS ===\n";
foreach ($dom->getElementsByTagName('h2') as $i => $h2) {
    echo ($i+1) . ". " . trim(preg_replace('/\s+/', ' ', $h2->textContent)) . "\n";
}
