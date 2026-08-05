<?php
$src = __DIR__ . '/images/logo-hijau.png';
$dest = __DIR__ . '/images/logo-hijau-cropped.png';

$img = imagecreatefrompng($src);

// Attempt to crop transparent edges
$cropped = imagecropauto($img, IMG_CROP_TRANSPARENT);

if ($cropped === false) {
    // If not transparent, try to crop white edges
    $cropped = imagecropauto($img, IMG_CROP_WHITE);
}

if ($cropped !== false) {
    imagepng($cropped, $dest);
    imagedestroy($cropped);
    echo "Cropped successfully\n";
} else {
    echo "Crop failed or not needed\n";
}

imagedestroy($img);
