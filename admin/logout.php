<?php
session_name("admin");
session_start();


 unset ($_SESSION['nm_usuario']);
 unset ($_SESSION['de_login']);


//echo"<script language=javascript>alert('Seção encerrada com sucesso!')</script>";
echo"<script language=javascript>location.href='index.php'</script>";
?>
