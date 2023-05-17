<?php
session_start();
session_name("admin");

require("includes/verifica_sessao.php");
require("includes/conecta_bd.php");
require("includes/anti_injection.php");


if(isset($_POST['acao']) && $_POST['acao'] == "cadastra")
{
    // Pega os campos enviados via POST
    foreach ($_POST as $campo => $valor) { $$campo = ($valor);}


    //verifica se algum dos campos est� vazio
    if(empty($nm_categoria) || $_FILES['arquivo']['error'] > 0)
    {
        echo"<script language=javascript>alert('Favor preencher todos os campos.')</script>";
        echo"<script language=javascript>location.href='cadastro-categorias.php'</script>";
        exit;
    }
    else
    {
        //pega as informa��es da imagem
        $infoImg = getimagesize($_FILES['arquivo']['tmp_name']);

        //verifica se o tipo de arquivo � um arquivo permitido
        if($infoImg['mime'] == "image/jpeg" || $infoImg['mime'] == "image/jpg" || $infoImg['mime'] == "image/png" || $infoImg['mime'] == "image/gif")
        {
            //verifica se a altura e a largura da imagem estao corretas

                $ext = end(explode(".",strtolower($_FILES['arquivo']['name'])));
                $foto = "../arquivos/cat_".time().".".$ext;
                $fotobd = "arquivos/cat_".time().".".$ext;

                //se n�o conseguir copiar, j� era.
                if(!move_uploaded_file($_FILES['arquivo']['tmp_name'],$foto))
                {
                    echo"<script language=javascript>alert('Erro ao copiar imagem.')</script>";
                    echo"<script language=javascript>location.href='cadastro-categorias.php'</script>";
                    exit;
                }
                else
                {
                    $rs = mysqli_query($conn, "INSERT INTO categorias VALUES('','$nm_categoria','$fotobd','$venda')") or die(mysqli_error());

                   // echo"<script language=javascript>alert('Dados cadastrados com sucesso.')</script>";
                    echo"<script language=javascript>location.href='cadastro-categorias.php'</script>";
                    exit;
                }

        }
        else
        {
            echo"<script language=javascript>alert('Tipo de arquivo n�o permitido. Favor enviar uma imagem jpg, gif ou png.')</script>";
            echo"<script language=javascript>location.href='cadastro-categorias.php'</script>";
            exit;
        }
    }


}
if(isset($_POST['acao']) && $_POST['acao'] == "edita")
{
    // Pega os campos enviados via POST
    foreach ($_POST as $campo => $valor) { $$campo = ($valor);}


    //verifica se algum dos campos est� vazio
    if(empty($nm_categoria))
    {
        echo"<script language=javascript>alert('Favor preencher todos os campos.')</script>";
        echo"<script language=javascript>location.href='cadastro-categorias.php?tipo=edit&cd=$cd'</script>";
        exit;
    }
    else
    {

        $up = "UPDATE categorias SET nm_categoria='$nm_categoria', venda='$venda'";

        if(!$_FILES['arquivo']['error'])
        {

            //pega as informa��es da imagem
            $infoImg = getimagesize($_FILES['arquivo']['tmp_name']);

            //verifica se o tipo de arquivo � um arquivo permitido
            if($infoImg['mime'] == "image/jpeg" || $infoImg['mime'] == "image/jpg" || $infoImg['mime'] == "image/png" || $infoImg['mime'] == "image/gif")
            {
            //verifica se a altura e a largura da imagem estao corretas

                $ext = end(explode(".",strtolower($_FILES['arquivo']['name'])));
                $foto = "../arquivos/cat_".time().".".$ext;
                $fotobd = "arquivos/cat_".time().".".$ext;

                //se n�o conseguir copiar, j� era.
                if(!move_uploaded_file($_FILES['arquivo']['tmp_name'],$foto))
                {
                    echo"<script language=javascript>alert('Erro ao copiar imagem.')</script>";
                    echo"<script language=javascript>location.href='cadastro-categorias.php?tipo=edit&cd=$cd'</script>";
                    exit;
                }
                else
                {
                    $up.= ",caminho_foto='$fotobd'";


                }

            }
            else
            {
                echo"<script language=javascript>alert('Tipo de arquivo n�o permitido. Favor enviar uma imagem jpg, gif ou png.')</script>";
                echo"<script language=javascript>location.href='cadastro-categorias.php?tipo=edit&cd=$cd'</script>";
                exit;
            }
        }
        
        $rs = mysqli_query($conn, $up." WHERE cd_categoria='$cd'") or die(mysqli_error());
       //echo"<script language=javascript>alert('Dados atualizados com sucesso!')</script>";
            echo"<script language=javascript>location.href='cadastro-categorias.php'</script>";
            exit;
        
    }


}

?>
