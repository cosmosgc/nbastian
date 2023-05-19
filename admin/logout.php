<?php
session_name("admin");
session_start();


 unset ($_SESSION['nm_usuario']);
 unset ($_SESSION['de_login']);


//echo"<script language=javascript>alert('Se��o encerrada com sucesso!')</script>";
echo"<script language=javascript>location.href='index.php'</script>";
?>
