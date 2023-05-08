<?php

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "nbastian_site";

/*
$host = "mysql.nbastian.com";
$usuario = "nbastian";
$senha = "bdsite2009";
$banco = "nbastian_site";
*/


$conn = mysqli_connect($host, $usuario, $senha)
    or die(mysqli_connect_error());

mysqli_set_charset($conn,'latin1');

$db = mysqli_select_db($conn,$banco)
      or die (mysqli_connect_error());

?>
