<?php
session_name("admin");
session_start();

include "includes/verifica_sessao.php";

include("includes/conecta_bd.php");

$tipo = isset($_GET['tp']) ? $_GET['tp'] : "";
$cd = isset($_GET['cd']) ? intval($_GET['cd']) : "";


if($tipo == "ban")
{
    $rs1 = mysqli_query($conn, "SELECT * FROM imagens_home WHERE cd_imagem='$cd'");
    while($ft = mysqli_fetch_array($rs1, MYSQLI_BOTH))
    {
        @unlink("../".$ft['caminho_foto']);

    }
    $rs1 = mysqli_query($conn, "DELETE FROM imagens_home WHERE cd_imagem='$cd'");



    //$res = mysqli_query($conn, "DELETE FROM projetos WHERE cd_cliente='$cd'");
    if($rs1)
    {

        echo"<script language=javascript>location.href='cadastro-imagem.php'</script>";
        exit;
    }
    else
    {
        echo("<script language='javascript'>\n alert('Erro ao exluir dados!')\n</script>");
        echo"<script language=javascript>location.href='cadastro-imagem.php'</script>";
        exit;
    }
}
elseif($tipo == "pat")
{
    $rs1 = mysqli_query($conn, "SELECT * FROM patrocinadores WHERE cd_patrocinador='$cd'");
    while($ft = mysqli_fetch_array($rs1, MYSQLI_BOTH))
    {
        @unlink("../".$ft['caminho_foto']);

    }
    $rs1 = mysqli_query($conn, "DELETE FROM patrocinadores WHERE cd_patrocinador='$cd'");



    //$res = mysqli_query($conn, "DELETE FROM projetos WHERE cd_cliente='$cd'");
    if($rs1)
    {
        ///echo("<script language='javascript'>\n alert('Dados exclu�dos com sucesso!')\n</script>");
        echo"<script language=javascript>location.href='cadastro-patrocinadores.php'</script>";
        exit;
    }
    else
    {
        echo("<script language='javascript'>\n alert('Erro ao exluir dados!')\n</script>");
        echo"<script language=javascript>location.href='cadastro-patrocinadores.php'</script>";
        exit;
    }
}
elseif($tipo == "cat")
{
    $rs1 = mysqli_query($conn, "SELECT * FROM categorias WHERE cd_categoria='$cd'");
    while($ft = mysqli_fetch_array($rs1, MYSQLI_BOTH))
    {
        @unlink("../".$ft['caminho_foto']);

    }
    $rs1 = mysqli_query($conn, "DELETE FROM categorias WHERE cd_categoria='$cd'");



    //$res = mysqli_query($conn, "DELETE FROM projetos WHERE cd_cliente='$cd'");
    if($rs1)
    {
        //echo("<script language='javascript'>\n alert('Dados exclu�dos com sucesso!')\n</script>");
        echo"<script language=javascript>location.href='cadastro-categorias.php'</script>";
        exit;
    }
    else
    {
        echo("<script language='javascript'>\n alert('Erro ao exluir dados!')\n</script>");
        echo"<script language=javascript>location.href='cadastro-categorias.php'</script>";
        exit;
    }
}
elseif($tipo == "eve")
{
    $rs1 = mysqli_query($conn, "SELECT * FROM fotos_eventos WHERE cd_evento='$cd'");
    while($ft = mysqli_fetch_array($rs1, MYSQLI_BOTH))
    {
        @unlink("../".$ft['caminho_foto']);
        @unlink("../".$ft['caminho_thumb']);

    }
    $rs1 = mysqli_query($conn, "DELETE FROM fotos_eventos WHERE cd_evento='$cd'");
    $rs1 = mysqli_query($conn, "DELETE FROM eventos WHERE cd_evento='$cd'");



    //$res = mysqli_query($conn, "DELETE FROM projetos WHERE cd_cliente='$cd'");
    if($rs1)
    {
        //echo("<script language='javascript'>\n alert('Dados exclu�dos com sucesso!')\n</script>");
        echo"<script language=javascript>location.href='cadastro-eventos.php'</script>";
        exit;
    }
    else
    {
        echo("<script language='javascript'>\n alert('Erro ao exluir dados!')\n</script>");
        echo"<script language=javascript>location.href='cadastro-eventos.php'</script>";
        exit;
    }
}
elseif($tipo == "gal")
{
    $rs1 = mysqli_query($conn, "SELECT * FROM fotos_galeria WHERE cd_galeria='$cd'");
    while($ft = mysqli_fetch_array($rs1, MYSQLI_BOTH))
    {
        @unlink("../".$ft['caminho_foto']);
        @unlink("../".$ft['caminho_thumb']);

    }
    $rs1 = mysqli_query($conn, "DELETE FROM fotos_galeria WHERE cd_galeria='$cd'");
    $rs1 = mysqli_query($conn, "DELETE FROM galerias WHERE cd_galeria='$cd'");



    //$res = mysqli_query($conn, "DELETE FROM projetos WHERE cd_cliente='$cd'");
    if($rs1)
    {
        //echo("<script language='javascript'>\n alert('Dados exclu�dos com sucesso!')\n</script>");
        echo"<script language=javascript>location.href='cadastro-galerias.php'</script>";
        exit;
    }
    else
    {
        echo("<script language='javascript'>\n alert('Erro ao exluir dados!')\n</script>");
        echo"<script language=javascript>location.href='cadastro-galerias.php'</script>";
        exit;
    }
}
elseif($tipo == "cli")
{
    $rs1 = mysqli_query($conn, "SELECT * FROM clientes WHERE cd_cliente='$cd'");
    while($ft = mysqli_fetch_array($rs1, MYSQLI_BOTH))
    {
        @unlink("../".$ft['caminho_foto']);

    }
    $rs1 = mysqli_query($conn, "DELETE FROM clientes WHERE cd_cliente='$cd'");



    //$res = mysqli_query($conn, "DELETE FROM projetos WHERE cd_cliente='$cd'");
    if($rs1)
    {
        //echo("<script language='javascript'>\n alert('Dados exclu�dos com sucesso!')\n</script>");
        echo"<script language=javascript>location.href='cadastro-clientes.php'</script>";
        exit;
    }
    else
    {
        echo("<script language='javascript'>\n alert('Erro ao exluir dados!')\n</script>");
        echo"<script language=javascript>location.href='cadastro-clientes.php'</script>";
        exit;
    }
}
elseif($tipo == "usu")
{

    $rs1 = mysqli_query($conn, "DELETE FROM usuarios WHERE cd_usuario='$cd'");



    //$res = mysqli_query($conn, "DELETE FROM projetos WHERE cd_cliente='$cd'");
    if($rs1)
    {
        //echo("<script language='javascript'>\n alert('Dados exclu�dos com sucesso!')\n</script>");
        echo"<script language=javascript>location.href='cadastro-usuarios.php'</script>";
        exit;
    }
    else
    {
        echo("<script language='javascript'>\n alert('Erro ao exluir dados!')\n</script>");
        echo"<script language=javascript>location.href='cadastro-usuarios.php'</script>";
        exit;
    }
}
elseif($tipo == "usui")
{

    $rs1 = mysqli_query($conn, "DELETE FROM imprensa_usuarios WHERE cd_usuario='$cd'");



    //$res = mysqli_query($conn, "DELETE FROM projetos WHERE cd_cliente='$cd'");
    if($rs1)
    {
        //echo("<script language='javascript'>\n alert('Dados exclu�dos com sucesso!')\n</script>");
        echo"<script language=javascript>location.href='cadastro-usuarios-imprensa.php'</script>";
        exit;
    }
    else
    {
        echo("<script language='javascript'>\n alert('Erro ao exluir dados!')\n</script>");
        echo"<script language=javascript>location.href='cadastro-usuarios-imprensa.php'</script>";
        exit;
    }
}
elseif($tipo == "ftoi")
{
    $rs1 = mysqli_query($conn, "SELECT * FROM imprensa_fotos WHERE cd_foto='$cd'");
    while($ft = mysqli_fetch_array($rs1, MYSQLI_BOTH))
    {
        @unlink("../".$ft['caminho_foto']);

    }
    $rs1 = mysqli_query($conn, "DELETE FROM imprensa_fotos WHERE cd_foto='$cd'");



    //$res = mysqli_query($conn, "DELETE FROM projetos WHERE cd_cliente='$cd'");
    if($rs1)
    {
        //echo("<script language='javascript'>\n alert('Dados exclu�dos com sucesso!')\n</script>");
        echo"<script language=javascript>location.href='cadastro-fotos-imprensa.php'</script>";
        exit;
    }
    else
    {
        echo("<script language='javascript'>\n alert('Erro ao exluir dados!')\n</script>");
        echo"<script language=javascript>location.href='cadastro-fotos-imprensa.php'</script>";
        exit;
    }
}
elseif($tipo == "not")
{

    $rs1 = mysqli_query($conn, "DELETE FROM noticias WHERE cd_noticia='$cd'");



    //$res = mysqli_query($conn, "DELETE FROM projetos WHERE cd_cliente='$cd'");
    if($rs1)
    {
        //echo("<script language='javascript'>\n alert('Dados exclu�dos com sucesso!')\n</script>");
        echo"<script language=javascript>location.href='cadastro-noticias.php'</script>";
        exit;
    }
    else
    {
        echo("<script language='javascript'>\n alert('Erro ao exluir dados!')\n</script>");
        echo"<script language=javascript>location.href='cadastro-noticias.php'</script>";
        exit;
    }
}

echo"<script language=javascript>location.href='principal.php'</script>";
exit;
?>

