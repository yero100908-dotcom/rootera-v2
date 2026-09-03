<?php

require __DIR__ . '/../vendor/autoload.php';

$backupDir = __DIR__ . '/../public/images/originals-backup';
if (!file_exists($backupDir)) {
    mkdir($backupDir, 0755, true);
}

echo "=== IMAGE OPTIMIZATION & BACKUP SCRIPT ===\n\n";

$targetDirs = [
    __DIR__ . '/../public/images',
    __DIR__ . '/../public/images/dokumentasi',
];

$largeFiles = [];

foreach ($targetDirs as $dir) {
    $files = glob($dir . '/*.*');
    foreach ($files as $f) {
        if (is_file($f)) {
            $size = filesize($f);
            if ($size > 1000000) { // > 1MB
                $largeFiles[] = $f;
            }
        }
    }
}

echo "Found " . count($largeFiles) . " files larger than 1MB:\n";

foreach ($largeFiles as $filePath) {
    $baseName = basename($filePath);
    $sizeMB = round(filesize($filePath) / 1024 / 1024, 2);
    echo "Processing: {$baseName} ({$sizeMB} MB)...\n";

    // 1. Backup original file
    $backupPath = $backupDir . '/' . $baseName;
    if (!file_exists($backupPath)) {
        copy($filePath, $backupPath);
        echo "  - Backup created at public/images/originals-backup/{$baseName}\n";
    }

    // 2. Load image using GD
    $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    $img = null;

    if ($ext === 'jpg' || $ext === 'jpeg') {
        $img = @imagecreatefromjpeg($filePath);
    } elseif ($ext === 'png') {
        $img = @imagecreatefrompng($filePath);
    } elseif ($ext === 'webp') {
        $img = @imagecreatefromwebp($filePath);
    }

    if ($img) {
        $origWidth = imagesx($img);
        $origHeight = imagesy($img);

        // Max width 1600px
        $maxWidth = 1600;
        if ($origWidth > $maxWidth) {
            $newWidth = $maxWidth;
            $newHeight = (int)round(($origHeight / $origWidth) * $newWidth);
            $resized = imagecreatetruecolor($newWidth, $newHeight);
            
            // Preserve transparency if PNG/WebP
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
            
            imagecopyresampled($resized, $img, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
            imagedestroy($img);
            $img = $resized;
        }

        // Save back as optimized WebP if target is webp or convert jpg/png to compressed webp
        if ($ext === 'webp') {
            imagewebp($img, $filePath, 78);
        } else {
            // Save compressed version to same path or convert
            if ($ext === 'jpg' || $ext === 'jpeg') {
                imagejpeg($img, $filePath, 78);
            } elseif ($ext === 'png') {
                imagepng($img, $filePath, 8);
            }
        }

        imagedestroy($img);
        $newSizeMB = round(filesize($filePath) / 1024 / 1024, 2);
        echo "  - Optimized size: {$newSizeMB} MB (Saved " . round((1 - ($newSizeMB / $sizeMB)) * 100, 1) . "%!)\n";
    } else {
        echo "  - Could not process GD image for {$baseName}\n";
    }
}

echo "\nIMAGE OPTIMIZATION COMPLETE.\n";

