<?php

$baseDir = 'public/assets/wilayah';

function slugifyClean($text) {
    $text = preg_replace('/[^\x20-\x7E]/u', '', $text);
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    return strtolower($text);
}

if (!is_dir($baseDir)) {
    die("Directory {$baseDir} not found.\n");
}

$subfolders = scandir($baseDir);
$totalRenamed = 0;

echo "=======================================================\n";
echo "🏷️ RE-NAMING REGIONAL ASSETS WITH SEO & BRAND INJECTION\n";
echo "=======================================================\n\n";

foreach ($subfolders as $sub) {
    if ($sub === '.' || $sub === '..') continue;
    $subPath = "{$baseDir}/{$sub}";
    if (!is_dir($subPath)) continue;

    echo "📁 Subfolder: {$sub}\n";
    $files = scandir($subPath);
    $idx = 1;

    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        $filePath = "{$subPath}/{$file}";
        if (is_dir($filePath)) continue;

        $nameWithoutExt = pathinfo($file, PATHINFO_FILENAME);
        $cleanLandmark = slugifyClean($nameWithoutExt);

        // Remove redundant words if already present
        $cleanLandmark = str_replace([
            'jasa-saluran-pipa-mampet-',
            '-rootera-plumbing',
            'rootera-plumbing-',
            'rootera-plumbing',
            'dokumentasi-area-',
            'jasa-pipa-mampet-'
        ], '', $cleanLandmark);

        $cleanLandmark = trim($cleanLandmark, '-');

        if (empty($cleanLandmark)) {
            $cleanLandmark = 'area';
        }

        // Build target SEO brand filename
        $newFilename = "jasa-saluran-pipa-mampet-{$cleanLandmark}-{$sub}-rootera-plumbing-{$idx}.webp";
        // Clean double subfolder references if landmark already has subfolder name
        $newFilename = str_replace("-{$sub}-{$sub}-", "-{$sub}-", $newFilename);
        $newFilename = preg_replace('/-+/', '-', $newFilename);

        $newPath = "{$subPath}/{$newFilename}";

        if (realpath($filePath) !== realpath($newPath)) {
            if (file_exists($newPath)) {
                @unlink($newPath);
            }
            if (@rename($filePath, $newPath)) {
                echo "   ✓ {$file} -> {$newFilename}\n";
                $totalRenamed++;
            } else {
                echo "   ❌ Failed to rename: {$file}\n";
            }
        } else {
            echo "   ℹ️ Already formatted: {$file}\n";
        }

        $idx++;
    }
    echo "\n";
}

echo "=======================================================\n";
echo "✅ RE-NAMING COMPLETED! Total files renamed: {$totalRenamed}\n";
echo "=======================================================\n";
