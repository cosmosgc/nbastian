<?php
session_name("admin");
session_start();

require("includes/verifica_sessao.php");
require("includes/conecta_bd.php");
require("includes/anti_injection.php");


if(isset($_POST['acao']) && $_POST['acao'] == "edita")
{

    // Pega os campos enviados via POST
    foreach ($_POST as $campo => $valor) { $$campo = $valor;}
    


    //verifica se algum dos campos está vazio
    if(empty($texto) )
    {
        echo"<script language=javascript>alert('Favor preencher o texto .')</script>";
        echo"<script language=javascript>location.href='editar-perfil.php?tipo=edit?cd=$cd'</script>";
        exit;
    }
    else
    {

        $rs = mysqli_query($conn, "UPDATE perfil SET de_conteudo='$texto', dt_ultima='".time()."' WHERE cd_perfil='$cd'");


        //echo"<script language=javascript>alert('cadastro atualizado com sucesso.')</script>";
        echo"<script language=javascript>location.href='principal.php'</script>";
        exit;

        
            }
}
?>
