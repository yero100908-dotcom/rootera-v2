<?php

$basePath = 'public/assets';

// Helper to convert any string to clean ASCII slug
function slugify($text) {
    // Remove emojis / non-ascii characters
    $text = preg_replace('/[^\x20-\x7E]/u', '', $text);
    // Replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    // Transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // Remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    // Trim
    $text = trim($text, '-');
    // Remove duplicate -
    $text = preg_replace('~-+~', '-', $text);
    // Lowercase
    $text = strtolower($text);

    return empty($text) ? 'asset-file' : $text;
}

// Custom explicit renames for TOOLKIT files
$toolkitMap = [
    'kabel optik mesin kamera cctv.jpg' => 'inspeksi-cctv-kabel-optik-pipa.webp',
    'mesin kamera cctv (2).jpg' => 'inspeksi-cctv-monitor-saluran-pipa.webp',
    'mesin kamera cctv.jpg' => 'inspeksi-cctv-camera-head-pipa.webp',
    'mesin kamera lengkap.avif' => 'inspeksi-cctv-set-lengkap-rootera.webp',
    'mesin ridgid drain cleaner dan spiral baja.avif' => 'mesin-rooter-ridgid-k50-spiral-baja.webp',
    'mesin ridgid drain cleaner krisbow mesin besar.webp' => 'mesin-rooter-komersial-heavy-duty.webp',
    'mesin ridgid drain cleaner krisbow.jpg' => 'mesin-rooter-flexible-rotary-cable.webp',
    'mesin ridgid krisbow saluran mampet.jpg' => 'mesin-rooter-drain-cleaner-portable.webp',
    'mesin ridgid saluran mampet drain cleaner krisbow.avif' => 'mesin-rooter-compact-pelancar-pipa.webp',
    'selang air.jpg' => 'hydro-jetting-high-pressure-hose.webp',
    'selang air.webp' => 'hydro-jetting-hose-reel-heavy-duty.webp',
    'spiral baja dan mata spiral.jpg' => 'mata-pisau-cutter-head-spiral-baja.webp',
    'spiral baja.jpg' => 'kabel-spiral-baja-flexible-rotary.webp',
];

// Special relocate map: file in current folder -> move to target folder with new name
$relocateMap = [
    'public/assets/wilayah/jawa-timur/Golden Hour Glow in Kota Tua (Old Batavia), Jakarta.jpg' => 'public/assets/wilayah/jakarta/area-layanan-pipa-mampet-jakarta-kota-tua.webp',
    'public/assets/wilayah/jawa-timur/Jelajah Wisata Bandung - Keindahan yang Selaras.jpg' => 'public/assets/wilayah/jawa-barat/jasa-pipa-mampet-bandung.webp',
    'public/assets/wilayah/jawa-tengah/Situs sejarah di yogyakarta,Tamansari.jpg' => 'public/assets/wilayah/yogyakarta/situs-sejarah-tamansari-yogyakarta.webp',
    'public/assets/wilayah/jawa-tengah/Jogjakarta candi kalasan.jpg' => 'public/assets/wilayah/yogyakarta/candi-kalasan-yogyakarta.webp',
];

function convertImageToWebp($sourcePath, $targetPath) {
    $info = @getimagesize($sourcePath);
    if (!$info) {
        echo "   ❌ Cannot get image size: {$sourcePath}\n";
        return false;
    }

    $mime = $info['mime'];
    $image = null;

    switch ($mime) {
        case 'image/jpeg':
            $image = @imagecreatefromjpeg($sourcePath);
            break;
        case 'image/png':
            $image = @imagecreatefrompng($sourcePath);
            break;
        case 'image/webp':
            $image = @imagecreatefromwebp($sourcePath);
            break;
        case 'image/avif':
            if (function_exists('imagecreatefromavif')) {
                $image = @imagecreatefromavif($sourcePath);
            }
            break;
    }

    if (!$image) {
        echo "   ❌ Failed to create image object for: {$sourcePath} (mime: {$mime})\n";
        return false;
    }

    // Preserve transparency for PNG
    imagealphablending($image, true);
    imagesavealpha($image, true);

    // Save as WebP with 85% quality
    $success = @imagewebp($image, $targetPath, 85);
    imagedestroy($image);

    return $success;
}

echo "=======================================================\n";
echo "🚀 STARTING ASSET CONVERSION & RENAMING\n";
echo "=======================================================\n\n";

$convertedCount = 0;
$deletedCount = 0;

// 1. Process TOOLKIT Folder
echo "📁 Processing TOOLKIT Folder...\n";
$toolkitDir = "{$basePath}/TOOLKIT";
if (is_dir($toolkitDir)) {
    $files = scandir($toolkitDir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        $srcPath = "{$toolkitDir}/{$file}";

        if (isset($toolkitMap[$file])) {
            $newName = $toolkitMap[$file];
        } else {
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $nameWithoutExt = pathinfo($file, PATHINFO_FILENAME);
            $newName = slugify($nameWithoutExt) . '.webp';
        }

        $targetPath = "{$toolkitDir}/{$newName}";
        echo "   Processing: {$file} -> {$newName}\n";

        if (convertImageToWebp($srcPath, $targetPath)) {
            $convertedCount++;
            if (realpath($srcPath) !== realpath($targetPath)) {
                @unlink($srcPath);
                $deletedCount++;
            }
        }
    }
}

// 2. Process Relocations First
echo "\n🚚 Processing Relocations (Moving misallocated files)...\n";
foreach ($relocateMap as $srcPath => $targetPath) {
    if (file_exists($srcPath)) {
        echo "   Relocating: {$srcPath} -> {$targetPath}\n";
        if (convertImageToWebp($srcPath, $targetPath)) {
            $convertedCount++;
            @unlink($srcPath);
            $deletedCount++;
        }
    }
}

// 3. Process WILAYAH Subfolders
echo "\n🗺️ Processing WILAYAH Subfolders...\n";
$wilayahDir = "{$basePath}/wilayah";
if (is_dir($wilayahDir)) {
    $subfolders = scandir($wilayahDir);
    foreach ($subfolders as $sub) {
        if ($sub === '.' || $sub === '..') continue;
        $subPath = "{$wilayahDir}/{$sub}";
        if (!is_dir($subPath)) continue;

        echo "\n   --- Subfolder: {$sub} ---\n";
        $files = scandir($subPath);
        $numIndex = 1;

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;
            $srcPath = "{$subPath}/{$file}";

            // If already webp and cleanly named, check if needs cleanup
            $nameWithoutExt = pathinfo($file, PATHINFO_FILENAME);
            $slugged = slugify($nameWithoutExt);

            // Handle purely numeric filenames (like hashes)
            if (preg_match('/^\d+$/', $slugged)) {
                $slugged = "dokumentasi-area-{$sub}-{$numIndex}";
                $numIndex++;
            }

            $newName = "{$slugged}.webp";
            $targetPath = "{$subPath}/{$newName}";

            echo "   [{$sub}] {$file} -> {$newName}\n";

            if (convertImageToWebp($srcPath, $targetPath)) {
                $convertedCount++;
                if (realpath($srcPath) !== realpath($targetPath)) {
                    @unlink($srcPath);
                    $deletedCount++;
                }
            }
        }
    }
}

echo "\n=======================================================\n";
echo "✅ ASSET CONVERSION COMPLETED!\n";
echo "Converted: {$convertedCount} images\n";
echo "Cleaned raw files: {$deletedCount} files\n";
echo "=======================================================\n";
