<?php

$basePath = 'c:/laragon/www/rooteraplumbing';
$viewsPath = $basePath . '/resources/views';

function scanDirectory($dir) {
    $files = [];
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        $path = $dir . '/' . $item;
        if (is_dir($path)) {
            $files = array_merge($files, scanDirectory($path));
        } else if (str_ends_with($item, '.blade.php')) {
            $files[] = $path;
        }
    }
    return $files;
}

$bladeFiles = scanDirectory($viewsPath);

$imgTags = [];
$bgImages = [];
$videoTags = [];

foreach ($bladeFiles as $filePath) {
    $content = file_get_contents($filePath);
    $relativePath = str_replace($basePath . '/', '', $filePath);

    // Multiline <img> tags
    preg_match_all('/<img\b[^>]*>/is', $content, $matches);
    foreach ($matches[0] as $tag) {
        // Extract src
        preg_match('/src=["\']([^"\']+)["\']/is', $tag, $srcMatch);
        $src = $srcMatch[1] ?? 'UNKNOWN';

        // Extract alt
        $hasAlt = (bool)preg_match('/alt\s*=\s*["\']([^"\']*)["\']/is', $tag, $altMatch);
        $alt = $hasAlt ? $altMatch[1] : null;

        // Extract loading
        preg_match('/loading\s*=\s*["\']([^"\']+)["\']/is', $tag, $loadingMatch);
        $loading = $loadingMatch[1] ?? null;

        // Extract width & height
        preg_match('/width\s*=\s*["\']([^"\']+)["\']/is', $tag, $wMatch);
        preg_match('/height\s*=\s*["\']([^"\']+)["\']/is', $tag, $hMatch);
        $width = $wMatch[1] ?? null;
        $height = $hMatch[1] ?? null;

        $imgTags[] = [
            'file' => $relativePath,
            'tag' => preg_replace('/\s+/', ' ', trim($tag)),
            'src' => $src,
            'hasAltAttr' => $hasAlt,
            'alt' => $alt,
            'loading' => $loading,
            'width' => $width,
            'height' => $height,
        ];
    }

    // CSS background url
    preg_match_all('/background(?:-image)?\s*:\s*[^;]*url\(["\']?([^"\'\)]+)["\']?\)/i', $content, $bgMatches);
    foreach ($bgMatches[1] as $bgSrc) {
        $bgImages[] = [
            'file' => $relativePath,
            'src' => $bgSrc,
        ];
    }

    // <video> tags
    preg_match_all('/<video\b[^>]*>(.*?)<\/video>/is', $content, $vMatches, PREG_SET_ORDER);
    foreach ($vMatches as $vMatch) {
        $vTag = $vMatch[0];
        preg_match('/poster=["\']([^"\']+)["\']/is', $vTag, $posterMatch);
        preg_match('/src=["\']([^"\']+)["\']/is', $vTag, $vSrcMatch);
        
        // check inside <source>
        preg_match_all('/<source\s+[^>]*src=["\']([^"\']+)["\']/is', $vTag, $sourceMatches);

        $videoTags[] = [
            'file' => $relativePath,
            'tag' => preg_replace('/\s+/', ' ', trim($vTag)),
            'poster' => $posterMatch[1] ?? null,
            'src' => $vSrcMatch[1] ?? ($sourceMatches[1][0] ?? null),
        ];
    }
}

$missingAltCount = 0;
$emptyAltCount = 0;
$hasLazyCount = 0;
$hasDimensionCount = 0;
$missingDimensionCount = 0;

foreach ($imgTags as $img) {
    if (!$img['hasAltAttr']) {
        $missingAltCount++;
    } else if (trim($img['alt']) === '') {
        $emptyAltCount++;
    }

    if ($img['loading'] === 'lazy') {
        $hasLazyCount++;
    }

    if ($img['width'] && $img['height']) {
        $hasDimensionCount++;
    } else {
        $missingDimensionCount++;
    }
}

echo "=== SUMMARY AUDIT METRICS ===\n";
echo "Total Blade Files Scanned: " . count($bladeFiles) . "\n";
echo "Total <img> Tags Found: " . count($imgTags) . "\n";
echo "Total CSS background-image References: " . count($bgImages) . "\n";
echo "Total Native <video> Tags: " . count($videoTags) . "\n";
echo "---------------------------------------------------------\n";
echo "Missing alt attribute entirely: {$missingAltCount} / " . count($imgTags) . "\n";
echo "Empty alt='' attribute: {$emptyAltCount} / " . count($imgTags) . "\n";
echo "Valid non-empty alt text: " . (count($imgTags) - $missingAltCount - $emptyAltCount) . " / " . count($imgTags) . "\n";
echo "With loading='lazy': {$hasLazyCount} / " . count($imgTags) . "\n";
echo "With explicit width & height: {$hasDimensionCount} / " . count($imgTags) . "\n";
echo "Missing width or height: {$missingDimensionCount} / " . count($imgTags) . "\n\n";

echo "=== ALL IMG TAGS BREAKDOWN ===\n";
foreach ($imgTags as $i => $img) {
    $altStatus = !$img['hasAltAttr'] ? '❌ MISSING ALT' : (trim($img['alt']) === '' ? '⚠️ EMPTY ALT' : '✅ ' . $img['alt']);
    $loadingStatus = $img['loading'] ? $img['loading'] : '❌ No loading attr';
    $dimStatus = ($img['width'] && $img['height']) ? "{$img['width']}x{$img['height']}" : '❌ No W/H';
    
    echo sprintf("[%02d] File: %s\n     Src: %s\n     Alt: %s\n     Loading: %s | Dimensions: %s\n     Tag: %s\n\n",
        $i + 1, $img['file'], $img['src'], $altStatus, $loadingStatus, $dimStatus, $img['tag']);
}

echo "=== ALL VIDEO TAGS BREAKDOWN ===\n";
foreach ($videoTags as $i => $vid) {
    echo sprintf("[%02d] File: %s\n     Poster: %s\n     Src: %s\n     Tag: %s\n\n",
        $i + 1, $vid['file'], $vid['poster'] ?? '❌ No poster', $vid['src'] ?? '❌ No static src (JS populated)', $vid['tag']);
}
