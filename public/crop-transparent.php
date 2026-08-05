<?php
$src = __DIR__ . '/images/LOGO W NO BG.png';
$dest = __DIR__ . '/images/favicon-cropped.png';

$img = imagecreatefrompng($src);
imagealphablending($img, false);
imagesavealpha($img, true);

// Get image dimensions
$width = imagesx($img);
$height = imagesy($img);

$min_x = $width;
$min_y = $height;
$max_x = 0;
$max_y = 0;

// Find bounding box for non-transparent pixels
for ($x = 0; $x < $width; $x++) {
    for ($y = 0; $y < $height; $y++) {
        $color = imagecolorat($img, $x, $y);
        $alpha = ($color >> 24) & 0xFF;
        // If not completely transparent (alpha 127 is fully transparent in GD)
        if ($alpha < 127) {
            if ($x < $min_x) $min_x = $x;
            if ($y < $min_y) $min_y = $y;
            if ($x > $max_x) $max_x = $x;
            if ($y > $max_y) $max_y = $y;
        }
    }
}

if ($min_x < $max_x && $min_y < $max_y) {
    // Add small padding (e.g. 10px) to not cut exactly at the edge
    $pad = 10;
    $min_x = max(0, $min_x - $pad);
    $min_y = max(0, $min_y - $pad);
    $max_x = min($width - 1, $max_x + $pad);
    $max_y = min($height - 1, $max_y + $pad);

    $new_width = $max_x - $min_x + 1;
    $new_height = $max_y - $min_y + 1;
    
    // Make it square for favicon
    $size = max($new_width, $new_height);
    $cropped = imagecreatetruecolor($size, $size);
    
    // Set background transparent
    imagealphablending($cropped, false);
    $transparent = imagecolorallocatealpha($cropped, 0, 0, 0, 127);
    imagefill($cropped, 0, 0, $transparent);
    imagesavealpha($cropped, true);
    
    // Center the cropped logo in the square
    $dst_x = ($size - $new_width) / 2;
    $dst_y = ($size - $new_height) / 2;
    
    imagecopy($cropped, $img, $dst_x, $dst_y, $min_x, $min_y, $new_width, $new_height);
    imagepng($cropped, $dest);
    imagedestroy($cropped);
    echo "Cropped and squared successfully";
} else {
    echo "Image is entirely transparent or crop failed";
}

imagedestroy($img);
