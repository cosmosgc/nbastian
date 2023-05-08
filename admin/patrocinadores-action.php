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
    
    //verifica se algum dos campos está vazio
    if($_FILES['arquivo']['error'] > 0)
    {
        echo"<script language=javascript>alert('Favor preencher todos os campos.')</script>";
        echo"<script language=javascript>location.href='cadastro-patrocinadores.php'</script>";
        exit;
    }
    else
    {

        //pega as informações da imagem pequena
        $pequenaInfo = getimagesize($_FILES['arquivo']['tmp_name']);

        //verifica se o tipo de arquivo é um arquivo permitido
        if($pequenaInfo['mime'] == "image/jpeg" || $pequenaInfo['mime'] == "image/jpg" || $pequenaInfo['mime'] == "image/png" || $pequenaInfo['mime'] == "image/gif" || $pequenaInfo['mime'] == "image/x-png")        {

            //verifica se a altura e a largura da imagem estao corretas

                $ext = end(explode(".",strtolower($_FILES['arquivo']['name'])));
                $foto = "../arquivos/pat_".time().".".$ext;
                $fotobd = "arquivos/pat_".time().".".$ext;

                //se não conseguir copiar, já era.
                if(!move_uploaded_file($_FILES['arquivo']['tmp_name'],$foto))
                {
                    echo"<script language=javascript>alert('Erro ao copiar imagem .')</script>";
                    echo"<script language=javascript>location.href='cadastro-patrocinadores.php'</script>";
                    exit;
                }
                else
                {
                    $rs = mysql_query("INSERT INTO patrocinadores VALUES('','$fotobd','".time()."')") or die(mysql_error());

                    //echo"<script language=javascript>alert('Dados cadastrados com sucesso.')</script>";
                    echo"<script language=javascript>location.href='cadastro-patrocinadores.php'</script>";
                    exit;
                }

        }
        else
        {
            echo"<script language=javascript>alert('Tipo de arquivo não permitido. Favor enviar uma imagem jpg, gif ou png.')</script>";
            echo"<script language=javascript>location.href='cadastro-patrocinadores.php'</script>";
            exit;
        }


        //echo"<script language=javascript>alert('Dados cadastrados com sucesso.')</script>";
        echo"<script language=javascript>location.href='cadastro-patrocinadores.php'</script>";
        exit;

    }


}
elseif(isset($_POST['acao']) && $_POST['acao'] == "edita")
{

    // Pega os campos enviados via POST
    foreach ($_POST as $campo => $valor) { $$campo = ($valor);}

    //verifica se algum dos campos está vazio
    if(empty($cliente) )
    {
        echo"<script language=javascript>alert('Favor preencher nome e a descrição .')</script>";
        echo"<script language=javascript>location.href='cadastro-clientes.php?tipo=edit?cd=$cd'</script>";
        exit;
    }
    else
    {

        //SQL para atualizar.
        $update = "UPDATE clientes SET nm_cliente='$cliente', de_conteudo='$descricao'";


        if(!$_FILES['arquivo']['error'])
        {
            //pega as informações da imagem pequena
            $pequenaInfo = getimagesize($_FILES['arquivo']['tmp_name']);

            //verifica se o tipo de arquivo é um arquivo permitido
            if($pequenaInfo['mime'] == "image/jpeg" || $pequenaInfo['mime'] == "image/jpg" || $pequenaInfo['mime'] == "image/png" || $pequenaInfo['mime'] == "image/gif" || $pequenaInfo['mime'] == "image/x-png")
            {

            //verifica se a altura e a largura da imagem estao corretas

                $ext = end(explode(".",strtolower($_FILES['arquivo']['name'])));
                $foto = "../arquivos/cli_".time().".".$ext;
                $fotobd = "arquivos/cli_".time().".".$ext;

                //se não conseguir copiar, já era.
                if(!move_uploaded_file($_FILES['arquivo']['tmp_name'],$foto))
                {
                    echo"<script language=javascript>alert('Erro ao copiar imagem .')</script>";
                    echo"<script language=javascript>location.href='cadastro-clientes.php'</script>";
                    exit;
                }
                else
                {
                  $update .=",caminho_foto='$fotobd'";
                }

            }
            else
            {
                echo"<script language=javascript>alert('Tipo de arquivo não permitido. Favor enviar uma imagem jpg, gif ou png.')</script>";
                echo"<script language=javascript>location.href='cadastro-clientes.php'</script>";
                exit;
            }
        }
        
        

        
        $rs = mysql_query($update." WHERE cd_cliente='$cd'") or die(mysql_error());

        echo"<script language=javascript>alert('Dados atualizados com sucesso.')</script>";
		echo"<script language=javascript>location.href='cadastro-clientes.php'</script>";
		exit;
    }
}
?>
