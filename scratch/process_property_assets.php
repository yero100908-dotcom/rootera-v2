<?php

$sourceBase = 'public/assets/Tipe Properti Usaha & Hunian Solusi Berdasarkan Jenis Bangunan';
$targetBase = 'public/assets/properti';

$folderMap = [
    'Cafe, Restoran & Cloud Kitchen' => 'cafe-restoran',
    'Gudang Logistik, Workshop & Bengkel' => 'gudang-logistik',
    'Kantor Ruko, Coworking & Studio Kerja' => 'kantor-ruko',
    'Kawasan Ruko, Toko & Kompleks Niaga' => 'kompleks-niaga',
    'Kos-Kosan, Homestay, Apartemen & Hotel' => 'apartemen-hotel',
    'Rumah Tinggal & Cluster Perumahan' => 'rumah-tinggal',
    'Sekolah, Yayasan, Klinik Pribadi & Tempat Ibadah' => 'fasilitas-publik',
    'Tenant Mall & Kios Foodcourt' => 'mall-foodcourt',
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

    imagealphablending($image, true);
    imagesavealpha($image, true);

    $success = @imagewebp($image, $targetPath, 85);
    imagedestroy($image);

    return $success;
}

function deleteDirectoryRecursive($dir) {
    if (!is_dir($dir)) return;
    $files = array_diff(scandir($dir), ['.', '..']);
    foreach ($files as $file) {
        $path = $dir . '/' . $file;
        is_dir($path) ? deleteDirectoryRecursive($path) : unlink($path);
    }
    rmdir($dir);
}

echo "=======================================================\n";
echo "🚀 STARTING PROPERTY ASSETS CONVERSION & RE-STRUCTURING\n";
echo "=======================================================\n\n";

if (!is_dir($targetBase)) {
    mkdir($targetBase, 0755, true);
}

$convertedCount = 0;

foreach ($folderMap as $srcFolder => $targetSlug) {
    $srcDirPath = "{$sourceBase}/{$srcFolder}";
    $targetDirPath = "{$targetBase}/{$targetSlug}";

    if (!is_dir($targetDirPath)) {
        mkdir($targetDirPath, 0755, true);
    }

    echo "📁 Processing: {$srcFolder} -> properti/{$targetSlug}\n";

    if (is_dir($srcDirPath)) {
        $files = scandir($srcDirPath);
        $idx = 1;

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;
            $srcFilePath = "{$srcDirPath}/{$file}";

            if (is_dir($srcFilePath)) continue;

            $newFilename = "jasa-saluran-pipa-mampet-{$targetSlug}-rootera-plumbing-{$idx}.webp";
            $targetFilePath = "{$targetDirPath}/{$newFilename}";

            echo "   ✓ {$file} -> {$newFilename}\n";

            if (convertImageToWebp($srcFilePath, $targetFilePath)) {
                $convertedCount++;
            }

            $idx++;
        }
    }
    echo "\n";
}

echo "=======================================================\n";
echo "✅ CONVERSION COMPLETED! Total property WebP images: {$convertedCount}\n";
echo "=======================================================\n";

// Cleanup source folder
if (is_dir($sourceBase)) {
    echo "🧹 Cleaning up source directory: {$sourceBase}...\n";
    deleteDirectoryRecursive($sourceBase);
    echo "✅ Cleaned up raw source directory!\n";
}
