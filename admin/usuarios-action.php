<?php
session_start();
session_name("admin");

require("includes/verifica_sessao.php");
require("includes/conecta_bd.php");
require("includes/anti_injection.php");


if(isset($_POST['acao']) && $_POST['acao'] == "cadastra")
{
    // Pega os campos enviados via POST
    foreach ($_POST as $campo => $valor) { $$campo = anti_injection($valor);}
    
    //verifica se algum dos campos está vazio
    if(empty($nm_usuario) || empty($email_usuario) || empty($de_senha)  )
    {
        echo"<script language=javascript>alert('Favor preencher todos os campos.')</script>";
        echo"<script language=javascript>location.href='cadastro-usuarios-imprensa.php'</script>";
        exit;
    }
    else
    {

        $rs= mysql_query("SELECT COUNT(*) FROM usuarios WHERE de_login='$email_usuario'");
        list($total) = mysql_fetch_array($rs);
        
        if($total > 0)
        {
            echo"<script language=javascript>alert('O e-mail digitado já se encontra cadastrado. Faça novamente o cadastro.')</script>";
            echo"<script language=javascript>location.href='cadastro-usuarios.php'</script>";
            exit;
        }
            
        $rs = mysql_query("INSERT INTO usuarios VALUES('','$nm_usuario','$email_usuario',AES_ENCRYPT('$de_senha','admin'),'0')");
        
        //echo"<script language=javascript>alert('cadastro realizado com sucesso.')</script>";
        echo"<script language=javascript>location.href='cadastro-usuarios.php'</script>";
        exit;
            

    }


}
elseif(isset($_POST['acao']) && $_POST['acao'] == "edita")
{

    // Pega os campos enviados via POST
    foreach ($_POST as $campo => $valor) { $$campo = ($valor);}
    


    //verifica se algum dos campos está vazio
    if(empty($nm_usuario) || empty($email_usuario)  )
    {
        echo"<script language=javascript>alert('Favor preencher nome e a corpo da noticia .')</script>";
        echo"<script language=javascript>location.href='cadastro-usuarios.php?tipo=edit&cd=$cd'</script>";
        exit;
    }
    else
    {


        $rs= mysql_query("SELECT COUNT(*) FROM usuarios WHERE de_login='$email_usuario' AND cd_usuario<>'$cd'");
        list($total) = mysql_fetch_array($rs);

        if($total > 0)
        {
            echo"<script language=javascript>alert('O e-mail digitado já se encontra cadastrado. Faça novamente o cadastro.')</script>";
            echo"<script language=javascript>location.href='cadastro-usuarios.php?tipo=edit&cd=$cd'</script>";
            exit;
        }
        
        $up = "UPDATE usuarios SET nm_usuario='$nm_usuario',de_login='$email_usuario'";
        
        if(isset($de_senha) && !empty($de_senha))
            $up.=", de_senha=AES_ENCRYPT('$de_senha','admin')";

        $rs = mysql_query($up." WHERE cd_usuario='$cd'");

        //$rs = mysql_query("UPDATE noticias SET de_titulo='$titulo', de_conteudo='$texto', dt_noticia='$dt_noticia' WHERE cd_noticia='$cd'");


        //echo"<script language=javascript>alert('Dadoa atualizados com sucesso.')</script>";
        echo"<script language=javascript>location.href='cadastro-usuarios.php'</script>";
        exit;

        
            }
}
?>
