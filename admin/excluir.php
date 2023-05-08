<?php
session_start();
session_name("admin");

include "includes/verifica_sessao.php";

include("includes/conecta_bd.php");

$tipo = isset($_GET['tp']) ? $_GET['tp'] : "";
$cd = isset($_GET['cd']) ? intval($_GET['cd']) : "";


if($tipo == "ban")
{
    $rs1 = mysql_query("SELECT * FROM imagens_home WHERE cd_imagem='$cd'");
    while($ft = mysql_fetch_array($rs1))
    {
        @unlink("../".$ft['caminho_foto']);

    }
    $rs1 = mysql_query("DELETE FROM imagens_home WHERE cd_imagem='$cd'");



    //$res = mysql_query("DELETE FROM projetos WHERE cd_cliente='$cd'");
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
    $rs1 = mysql_query("SELECT * FROM patrocinadores WHERE cd_patrocinador='$cd'");
    while($ft = mysql_fetch_array($rs1))
    {
        @unlink("../".$ft['caminho_foto']);

    }
    $rs1 = mysql_query("DELETE FROM patrocinadores WHERE cd_patrocinador='$cd'");



    //$res = mysql_query("DELETE FROM projetos WHERE cd_cliente='$cd'");
    if($rs1)
    {
        ///echo("<script language='javascript'>\n alert('Dados excluídos com sucesso!')\n</script>");
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
    $rs1 = mysql_query("SELECT * FROM categorias WHERE cd_categoria='$cd'");
    while($ft = mysql_fetch_array($rs1))
    {
        @unlink("../".$ft['caminho_foto']);

    }
    $rs1 = mysql_query("DELETE FROM categorias WHERE cd_categoria='$cd'");



    //$res = mysql_query("DELETE FROM projetos WHERE cd_cliente='$cd'");
    if($rs1)
    {
        //echo("<script language='javascript'>\n alert('Dados excluídos com sucesso!')\n</script>");
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
    $rs1 = mysql_query("SELECT * FROM fotos_eventos WHERE cd_evento='$cd'");
    while($ft = mysql_fetch_array($rs1))
    {
        @unlink("../".$ft['caminho_foto']);
        @unlink("../".$ft['caminho_thumb']);

    }
    $rs1 = mysql_query("DELETE FROM fotos_eventos WHERE cd_evento='$cd'");
    $rs1 = mysql_query("DELETE FROM eventos WHERE cd_evento='$cd'");



    //$res = mysql_query("DELETE FROM projetos WHERE cd_cliente='$cd'");
    if($rs1)
    {
        //echo("<script language='javascript'>\n alert('Dados excluídos com sucesso!')\n</script>");
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
    $rs1 = mysql_query("SELECT * FROM fotos_galeria WHERE cd_galeria='$cd'");
    while($ft = mysql_fetch_array($rs1))
    {
        @unlink("../".$ft['caminho_foto']);
        @unlink("../".$ft['caminho_thumb']);

    }
    $rs1 = mysql_query("DELETE FROM fotos_galeria WHERE cd_galeria='$cd'");
    $rs1 = mysql_query("DELETE FROM galerias WHERE cd_galeria='$cd'");



    //$res = mysql_query("DELETE FROM projetos WHERE cd_cliente='$cd'");
    if($rs1)
    {
        //echo("<script language='javascript'>\n alert('Dados excluídos com sucesso!')\n</script>");
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
    $rs1 = mysql_query("SELECT * FROM clientes WHERE cd_cliente='$cd'");
    while($ft = mysql_fetch_array($rs1))
    {
        @unlink("../".$ft['caminho_foto']);

    }
    $rs1 = mysql_query("DELETE FROM clientes WHERE cd_cliente='$cd'");



    //$res = mysql_query("DELETE FROM projetos WHERE cd_cliente='$cd'");
    if($rs1)
    {
        //echo("<script language='javascript'>\n alert('Dados excluídos com sucesso!')\n</script>");
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

    $rs1 = mysql_query("DELETE FROM usuarios WHERE cd_usuario='$cd'");



    //$res = mysql_query("DELETE FROM projetos WHERE cd_cliente='$cd'");
    if($rs1)
    {
        //echo("<script language='javascript'>\n alert('Dados excluídos com sucesso!')\n</script>");
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

    $rs1 = mysql_query("DELETE FROM imprensa_usuarios WHERE cd_usuario='$cd'");



    //$res = mysql_query("DELETE FROM projetos WHERE cd_cliente='$cd'");
    if($rs1)
    {
        //echo("<script language='javascript'>\n alert('Dados excluídos com sucesso!')\n</script>");
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
    $rs1 = mysql_query("SELECT * FROM imprensa_fotos WHERE cd_foto='$cd'");
    while($ft = mysql_fetch_array($rs1))
    {
        @unlink("../".$ft['caminho_foto']);

    }
    $rs1 = mysql_query("DELETE FROM imprensa_fotos WHERE cd_foto='$cd'");



    //$res = mysql_query("DELETE FROM projetos WHERE cd_cliente='$cd'");
    if($rs1)
    {
        //echo("<script language='javascript'>\n alert('Dados excluídos com sucesso!')\n</script>");
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

    $rs1 = mysql_query("DELETE FROM noticias WHERE cd_noticia='$cd'");



    //$res = mysql_query("DELETE FROM projetos WHERE cd_cliente='$cd'");
    if($rs1)
    {
        //echo("<script language='javascript'>\n alert('Dados excluídos com sucesso!')\n</script>");
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

