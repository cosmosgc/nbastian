<?php
session_name("admin");
session_start();

require("includes/verifica_sessao.php");
require("includes/conecta_bd.php");
require("includes/anti_injection.php");


if(isset($_POST['acao']) && $_POST['acao'] == "cadastra")
{
    // Pega os campos enviados via POST
    foreach ($_POST as $campo => $valor) { $$campo = ($valor);}
    
    //verifica se algum dos campos está vazio
    if(empty($texto) || empty($titulo) )
    {
        echo"<script language=javascript>alert('Favor preencher todos os campos.')</script>";
        echo"<script language=javascript>location.href='cadastro-noticias.php'</script>";
        exit;
    }
    else
    {
        if(!isset($dt_noticia) || empty($dt_noticia))
            $dt_noticia = date("Y-m-d");
        else
            $dt_noticia = implode("-",array_reverse(explode("/",$dt_noticia)));
            

        $x=0;
        if(!$_FILES['foto']['error'][$x])
        {
            $prim = time();
            if(!empty($_FILES['foto']['name'][$x]))
            {
                $ext = end(explode(".", strtolower($_FILES['foto']['name'][$x])));
                if($ext == "jpg" || $ext == "gif" || $ext = "png")
                {

                    $ft_grande = "../arquivos/img_".$prim.".".$ext;
                    $grandebd = "arquivos/img_".$prim.".".$ext;

                    move_uploaded_file($_FILES['foto']['tmp_name'][$x], $ft_grande);


                    @chmod($ft_grande, 0766);



                }
            }
        }


        $rs = mysqli_query($conn, "INSERT INTO noticias VALUES('','$titulo','$texto','$dt_noticia','$grandebd','".time()."')");
        
        
        //echo"<script language=javascript>alert('cadastro realizado com sucesso.')</script>";
        echo"<script language=javascript>location.href='cadastro-noticias.php'</script>";
        exit;
            

    }


}
elseif(isset($_POST['acao']) && $_POST['acao'] == "edita")
{

    // Pega os campos enviados via POST
    foreach ($_POST as $campo => $valor) { $$campo = ($valor);}
    


    //verifica se algum dos campos está vazio
    if(empty($texto) || empty($titulo) )
    {
        echo"<script language=javascript>alert('Favor preencher nome e a corpo da noticia .')</script>";
        echo"<script language=javascript>location.href='cadastro-noticias.php?tipo=edit?cd=$cd'</script>";
        exit;
    }
    else
    {
        if(!isset($dt_noticia) || empty($dt_noticia))
            $dt_noticia = date("Y-m-d");
        else
            $dt_noticia = implode("-",array_reverse(explode("/",$dt_noticia)));

        $up = "UPDATE noticias SET de_titulo='$titulo', conteudo='$texto', dt_noticia='$dt_noticia'";

        $x=0;
        if(!$_FILES['foto']['error'][$x])
        {
            $prim = time();
            if(!empty($_FILES['foto']['name'][$x]))
            {
                $ext = end(explode(".", strtolower($_FILES['foto']['name'][$x])));
                if($ext == "jpg" || $ext == "gif" || $ext = "png")
                {

                    $ft_grande = "../arquivos/img_".$prim.".".$ext;
                    $grandebd = "arquivos/img_".$prim.".".$ext;

                    move_uploaded_file($_FILES['foto']['tmp_name'][$x], $ft_grande);


                    @chmod($ft_grande, 0766);
                    $up.=", caminho_foto='$grandebd'";


                }
            }
        }


        $rs = mysqli_query($conn, $up." WHERE cd_noticia='$cd'") or die(mysqli_error());


        //echo"<script language=javascript>alert('Dados atualizados com sucesso.')</script>";
        echo"<script language=javascript>location.href='cadastro-noticias.php'</script>";
        exit;

        
            }
}
?>
