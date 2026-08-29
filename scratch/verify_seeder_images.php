<?php

$basePath = 'c:/laragon/www/rooteraplumbing';

$seederImages = [
    'images/dokumentasi/pelancar-floor-drain-kamar-mandi-rumah.webp',
    'images/dokumentasi/mesin-drain-cleaner-pelancar-pipa.webp',
    'images/dokumentasi/teknisi-rootera-stasiun-kai-jateng.webp',
    'images/dokumentasi/pelancaran-wastafel-mampet-rumah-warga.webp',
    'images/dokumentasi/pembersihan-grease-trap-restoran.webp',
    'images/dokumentasi/kondisi-pipa-lemak-resto-mall-tersumbat.webp',
];

echo "=== CHECKING UPDATED SEEDER IMAGES ON DISK ===\n";
foreach ($seederImages as $relImg) {
    $publicPath = $basePath . '/public/' . $relImg;
    $exists = file_exists($publicPath);
    $status = $exists ? "✅ EXISTS" : "❌ BROKEN";
    echo "Image: public/{$relImg} => {$status}\n";
}
