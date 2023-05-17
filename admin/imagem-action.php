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
    if($_FILES['arquivo']['error'] > 0)
    {
        echo"<script language=javascript>alert('Favor preencher todos os campos.')</script>";
        echo"<script language=javascript>location.href='cadastro-imagem.php'</script>";
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
            if($infoImg[0] == "935")
            {
                $ext = end(explode(".",strtolower($_FILES['arquivo']['name'])));
                $foto = "../arquivos/ban_".time().".".$ext;
                $fotobd = "arquivos/ban_".time().".".$ext;
                
                //se n�o conseguir copiar, j� era.
                if(!move_uploaded_file($_FILES['arquivo']['tmp_name'],$foto))
                {
                    echo"<script language=javascript>alert('Erro ao copiar imagem.')</script>";
                    echo"<script language=javascript>location.href='cadastro-imagem.php'</script>";
                    exit;
                }
                else
                {
                    $rs = mysqli_query($conn, "INSERT INTO imagens_home VALUES('','$fotobd','".time()."')") or die(mysqli_error());

                    //echo"<script language=javascript>alert('Dados cadastrados com sucesso.')</script>";
                    echo"<script language=javascript>location.href='cadastro-imagem.php'</script>";
                    exit;
                }
            }
            else
            {
                echo"<script language=javascript>alert('A largura  da imagem deve ser 935 pixels.')</script>";
                echo"<script language=javascript>location.href='cadastro-imagem.php'</script>";
                exit;
            }
        }
        else
        {
            echo"<script language=javascript>alert('Tipo de arquivo n�o permitido. Favor enviar uma imagem jpg, gif ou png.')</script>";
            echo"<script language=javascript>location.href='cadastro-imagem.php'</script>";
            exit;
        }
    }


}

?>
