<?php
//$host = "localhost";$usuario = "root";$senha = "";$banco = "nbastian_site";

$host = "localhost";$usuario = "nbasti78_nbastian";$senha = "Noslin@72";$banco = "nbasti78_nbastian.com";
//




$conn = mysqli_connect($host, $usuario, $senha)
    or die(mysqli_connect_error());

mysqli_set_charset($conn,'utf8');

$db = mysqli_select_db($conn,$banco)
      or die (mysqli_connect_error());

?>
