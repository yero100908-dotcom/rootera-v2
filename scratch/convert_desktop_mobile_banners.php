<?php

$bannersDir = __DIR__ . '/../public/assets/banners';

$filesToConvert = [
    'desktop.png' => 'rootera-plumbing-jasa-saluran-mampet-profesional-desktop.webp',
    'mobile.png' => 'rootera-plumbing-jasa-saluran-mampet-profesional-mobile.webp',
];

foreach ($filesToConvert as $srcName => $destName) {
    $srcPath = $bannersDir . '/' . $srcName;
    $destPath = $bannersDir . '/' . $destName;

    if (file_exists($srcPath)) {
        echo "Converting $srcName to $destName...\n";
        $img = @imagecreatefrompng($srcPath);
        if ($img) {
            imagealphablending($img, false);
            imagesavealpha($img, true);
            imagewebp($img, $destPath, 85);
            imagedestroy($img);

            $oldSize = filesize($srcPath);
            $newSize = filesize($destPath);
            echo "Success! $srcName (" . number_format($oldSize) . " bytes) -> $destName (" . number_format($newSize) . " bytes)\n";

            unlink($srcPath);
            echo "Deleted $srcName\n";
        } else {
            echo "Error converting $srcName: Image resource creation failed.\n";
        }
    } else {
        echo "Source file $srcName not found in $bannersDir\n";
    }
}

// Clean up old single webp if present
$oldWebp = $bannersDir . '/rootera-plumbing-jasa-saluran-mampet-profesional.webp';
if (file_exists($oldWebp)) {
    unlink($oldWebp);
    echo "Cleaned up old single banner webp: rootera-plumbing-jasa-saluran-mampet-profesional.webp\n";
}

echo "Conversion complete!\n";
