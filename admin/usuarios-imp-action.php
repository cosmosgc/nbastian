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
    if(empty($nm_usuario) || empty($email_usuario) || empty($de_senha)  )
    {
        echo"<script language=javascript>alert('Favor preencher todos os campos.')</script>";
        echo"<script language=javascript>location.href='cadastro-usuarios-imprensa.php'</script>";
        exit;
    }
    else
    {

        $rs= mysql_query("SELECT COUNT(*) FROM imprensa_usuarios WHERE email_usuario='$email_usuario'");
        list($total) = mysql_fetch_array($rs);
        
        if($total > 0)
        {
            echo"<script language=javascript>alert('O e-mail digitado já se encontra cadastrado. Faça novamente o cadastro.')</script>";
            echo"<script language=javascript>location.href='cadastro-usuarios-imprensa.php'</script>";
            exit;
        }
            
        $rs = mysql_query("INSERT INTO imprensa_usuarios VALUES('','$nm_usuario','$email_usuario',AES_ENCRYPT('$de_senha','imprensa'),'0')");
        
        $assunto = "NBastian Fotografia e Comunicação - Cadastro na Área de Imprensa";

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Date: ". date('D, d M Y H:i:s O') ." \r\n";
        $headers .= "X-MSMail-Priority: Normal \r\n";
        $headers .= "Return-Path: nbastian@nbastian.com\r\n";
        $headers .= "From: NBastian Fotografia e Comunicação <nbastian@nbastian.com>\r\n";
        $headers .= "Reply-To : NBastian Fotografia e Comunicação <nbastian@nbastian.com> \r\n";
        $headers .= "Content-Type: text/html; charset=\"ISO-8859-1\"\r\n";

        $corpo = "Prezado(a) $nm_usuario,<BR>";
        $corpo .= "Você foi cadastrado na área de imprensa do nosso site.<BR>";
        $corpo .= "Você passa a ter acesso a fotos exclusivas para download.<BR>";
        $corpo .= "Acesse: <a href=\"http://www.nbastian.com\">www.nbastian.com</a><BR>";
        $corpo .= "No menu Imprensa use os seguintes dados:<BR>";
        $corpo .= "Usuário: $email_usuario<BR>";
        $corpo .= "Senha: $de_senha<BR><BR>";
        $corpo .= "Atenciosamente,<BR>";
        $corpo .= "Equipe <a href=\"http://www.nbastian.com\">Nbastian Fotografia e Comunicação </a><BR>";

        
        $para = "$nm_usuario <$email_usuario>";
        mail($para, $assunto, $corpo, $headers);
        

        //echo"<script language=javascript>alert('cadastro realizado com sucesso.')</script>";
        echo"<script language=javascript>location.href='cadastro-usuarios-imprensa.php'</script>";
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
        echo"<script language=javascript>location.href='cadastro-usuarios-imprensa.php?tipo=edit?cd=$cd'</script>";
        exit;
    }
    else
    {


        $rs= mysql_query("SELECT COUNT(*) FROM imprensa_usuarios WHERE email_usuario='$email_usuario' AND cd_usuario<>'$cd'");
        list($total) = mysql_fetch_array($rs);

        if($total > 0)
        {
            echo"<script language=javascript>alert('O e-mail digitado já se encontra cadastrado. Faça novamente o cadastro.')</script>";
            echo"<script language=javascript>location.href='cadastro-usuarios-imprensa.php?tipo=edit?cd=$cd'</script>";
            exit;
        }
        
        $up = "UPDATE imprensa_usuarios SET nm_usuario='$nm_usuario',email_usuario='$email_usuario'";
        
        if(isset($de_senha) && !empty($de_senha))
            $up.=", de_senha=AES_ENCRYPT('$de_senha','imprensa')";

        $rs = mysql_query($up." WHERE cd_usuario='$cd'");

        //$rs = mysql_query("UPDATE noticias SET de_titulo='$titulo', de_conteudo='$texto', dt_noticia='$dt_noticia' WHERE cd_noticia='$cd'");


        //echo"<script language=javascript>alert('Dadoa atualizados com sucesso.')</script>";
        echo"<script language=javascript>location.href='cadastro-usuarios-imprensa.php'</script>";
        exit;

        
            }
}
?>
