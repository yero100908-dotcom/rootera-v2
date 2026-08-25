<?php

$basePath = 'public/assets';

function scanDirRecursive($dir) {
    $result = [];
    if (!is_dir($dir)) return $result;

    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        $fullPath = $dir . '/' . $item;
        if (is_dir($fullPath)) {
            $result[$item] = scanDirRecursive($fullPath);
        } else {
            $result[] = [
                'filename' => $item,
                'path' => str_replace('\\', '/', $fullPath),
                'size' => filesize($fullPath),
                'extension' => strtolower(pathinfo($fullPath, PATHINFO_EXTENSION))
            ];
        }
    }
    return $result;
}

$inventory = scanDirRecursive($basePath);

file_put_contents('scratch/inventory_result.json', json_encode($inventory, JSON_PRETTY_PRINT));
echo "Inventory scan complete. Total folders & files scanned.\n";
