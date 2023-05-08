<?php

include_once("admin/includes/conecta_bd.php");

$rs = mysqli_query($conn,"SELECT * FROM patrocinadores ORDER BY dt_cadastro ASC");
while($var = mysqli_fetch_array($rs, MYSQLI_ASSOC))
{
    echo '<img src="'.$var['caminho_foto'].'" height="40"/>';
    
}
?>

