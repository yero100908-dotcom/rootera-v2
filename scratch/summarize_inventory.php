<?php

$data = json_decode(file_get_contents('scratch/inventory_result.json'), true);

function printSection($title, $items, $folderName = '') {
    echo "=======================================================\n";
    echo "📁 " . strtoupper($title) . "\n";
    echo "=======================================================\n";
    $count = 0;
    foreach ($items as $key => $val) {
        if (is_array($val) && isset($val['filename'])) {
            $count++;
            $sizeKb = round($val['size'] / 1024, 1);
            echo sprintf("%2d. [%s | %s KB] %s\n", $count, strtoupper($val['extension']), $sizeKb, $val['filename']);
        } elseif (is_array($val)) {
            echo "\n--- Subfolder: {$key} ---\n";
            printSubFolder($val, $key);
        }
    }
    echo "\n";
}

function printSubFolder($items, $subName) {
    $count = 0;
    foreach ($items as $item) {
        if (is_array($item) && isset($item['filename'])) {
            $count++;
            $sizeKb = round($item['size'] / 1024, 1);
            echo sprintf("   %2d. [%s | %s KB] %s\n", $count, strtoupper($item['extension']), $sizeKb, $item['filename']);
        }
    }
}

foreach ($data as $folder => $content) {
    printSection($folder, $content);
}
