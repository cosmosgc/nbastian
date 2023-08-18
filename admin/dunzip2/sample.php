<?php
$zip = new ZipArchive;
if ($zip->open('Pictures.zip') === TRUE) {
    $zip->extractTo('.');
    $zip->close();
    echo 'ok';
} else {
    echo 'failed';
}
?>