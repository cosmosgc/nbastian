<?php
$zip = new ZipArchive;
if ($zip->open('Pictures.rar') === TRUE) {
    $zip->extractTo('../arquivos/temp/');
    $zip->close();
    echo 'ok';
} else {
    echo 'failed';
}
?>