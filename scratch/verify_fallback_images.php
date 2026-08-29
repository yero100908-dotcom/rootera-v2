<?php

$basePath = 'c:/laragon/www/rooteraplumbing';

$fallbackImages = [
    'images/placeholder.jpg',
    'images/area-placeholder.jpg',
    'images/og-kontak.jpg',
    'images/ridgid.jpeg',
    'images/JnJ.jpeg',
    'images/JnJ.webp',
    'images/logo-final.webp',
    'images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp',
];

echo "=== CHECKING FALLBACK IMAGES ON DISK ===\n";
foreach ($fallbackImages as $relImg) {
    $publicPath = $basePath . '/public/' . $relImg;
    $exists = file_exists($publicPath);
    $status = $exists ? "✅ EXISTS" : "❌ BROKEN FALLBACK (404 FILE NOT FOUND)";
    echo "Path: public/{$relImg} => {$status}\n";
}
