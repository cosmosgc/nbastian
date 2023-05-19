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


    //verifica se algum dos campos est� vazio
    if(empty($de_legenda) || empty($dt_foto) || $_FILES['foto']['error'][0] > 0)
    {
        echo"<script language=javascript>alert('Favor todos os campos')</script>";
        echo"<script language=javascript>location.href='cadastro-fotos-imprensa.php'</script>";
        exit;
    }
    else
    {
        $dt_foto = implode("-",array_reverse(explode("/",$dt_foto)));

        $x=0;
        if(!$_FILES['foto']['error'][$x])
        {
            $prim = time();
            if(!empty($_FILES['foto']['name'][$x]))
            {
                $ext = end(explode(".", strtolower($_FILES['foto']['name'][$x])));
                if($ext == "jpg" || $ext == "gif" || $ext = "png")
                {

                    $ft_grande = "../arquivos/foto_".$prim.".".$ext;
                    $grandebd = "arquivos/foto_".$prim.".".$ext;

                    move_uploaded_file($_FILES['foto']['tmp_name'][$x], $ft_grande);


                    @chmod($ft_grande, 0766);



                }
            }
        }

        $rs = mysqli_query($conn, "INSERT INTO imprensa_fotos VALUES('','".$_FILES['foto']['name'][$x]."','$grandebd','$de_legenda','$dt_foto','0')") or die(mysqli_error());


        //echo"<script language=javascript>alert('cadastro atualizado com sucesso.')</script>";
        echo"<script language=javascript>location.href='cadastro-fotos-imprensa.php'</script>";
        exit;

        
            }
}
if(isset($_POST['acao']) && $_POST['acao'] == "edita")
{

    // Pega os campos enviados via POST
    foreach ($_POST as $campo => $valor) { $$campo = ($valor);}


    //verifica se algum dos campos est� vazio
    if(empty($de_legenda) || empty($dt_foto) )
    {
        echo"<script language=javascript>alert('Favor todos os campos')</script>";
        echo"<script language=javascript>location.href='cadastro-fotos-imprensa.php?tipo=edit&cd=$cd'</script>";
        exit;
    }
    else
    {
        $dt_foto = implode("-",array_reverse(explode("/",$dt_foto)));
        
        $up ="UPDATE imprensa_fotos SET de_legenda='$de_legenda', dt_foto='$dt_foto'";

        $x=0;
        if(!$_FILES['foto']['error'][$x])
        {
            $prim = time();
            if(!empty($_FILES['foto']['name'][$x]))
            {
                $ext = end(explode(".", strtolower($_FILES['foto']['name'][$x])));
                if($ext == "jpg" || $ext == "gif" || $ext = "png")
                {

                    $ft_grande = "../arquivos/foto_".$prim.".".$ext;
                    $grandebd = "arquivos/foto_".$prim.".".$ext;

                    move_uploaded_file($_FILES['foto']['tmp_name'][$x], $ft_grande);


                    @chmod($ft_grande, 0766);
                    $up .= " nm_original='".$_FILES['foto']['name'][$x]."', caminho_foto'$grandebd'";


                }
            }
        }

        $rs = mysqli_query($conn, $up." WHERE cd_foto='$cd'");


        //echo"<script language=javascript>alert('cadastro atualizado com sucesso.')</script>";
        echo"<script language=javascript>location.href='cadastro-fotos-imprensa.php'</script>";
        exit;


            }
}
?>
