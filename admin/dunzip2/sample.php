<?php
$zip = new ZipArchive;
if ($zip->open('Pictures.zip') === TRUE) {
    $zip->extractTo('../arquivos/temp/');
    $zip->close();
    echo 'ok';
} else {
    echo 'failed';
}
?>