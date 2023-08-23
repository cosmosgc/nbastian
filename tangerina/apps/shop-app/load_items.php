<?php
$itemsDirectory = 'items/';
$items = [];

foreach (scandir($itemsDirectory) as $file) {
    if ($file !== '.' && $file !== '..') {
        $filePath = $itemsDirectory . $file;
        $itemData = json_decode(file_get_contents($filePath), true);

        if ($itemData) {
            $items[] = $itemData;
        }
    }
}

header('Content-Type: application/json');
echo json_encode($items);
?>
