<?php
session_start();
session_name("site");

if(isset($_POST['acao']) && $_POST['acao'] == "enviar")
{
    foreach ($_POST as $campo => $valor) { $$campo = utf8_decode($valor);}

    //Veri�vel auxiliar para detectar spamns. Inicialmente � setada como false.
    $spam = false;

    //print_r($_POST);
    //exit;
    //Verifica se os campos s�o vazios ou est�o preenchidos com o conte�do padr�o.
    if(empty($nome) || empty($email) || empty($mensagem) || empty($fone) || empty($assunto))
    {
        echo"<script language=javascript>alert('Favor preencher todos os campos.')</script>";
        echo"<script language=javascript>location.href='contato.php'</script>";
        exit;
    }
    else
    {
        //verifica oe endere�o de email
        if(verificar_email($email) == 2)
        {
            echo("<script language='javascript'>\n alert('Favor digitar em endere�o de e-mail v�lido!')\n</script>");
            echo("<script language='javascript'>location.href='contato.php'</script>");
            exit;
        }
        else
        {

            /*O campo validar � um campo auxiliar escondido do formul�rio, utilizado para detectar spambots, se este campo for preeenchido
            n�o foi uma pessoa que enviou o formul�rio
            if(!empty($validar))
                $spam = true;
            */

            /*O c�digo a seguir faz a verifica��o se a 'page referrer' (incorretamente denominada de �referer� nas especifica��es para HTTP e em PHP)
            existe e caso exista se ela encontra-se no mesmo Web Site do script de processamento. Para navegadores e spambots que n�o enviam informa��es
            'referrer' a mensagem nunca ser� setada como spam.
            */
            if(!stristr($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']))
                $spam=true;

            $destinatario = "nbastian@nbastian.com";


            //$assunto = "NBastian - Contato via formul�rio do site";

            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Date: ". date('D, d M Y H:i:s O') ." \r\n";
            $headers .= "X-MSMail-Priority: Normal \r\n";
            $headers .= "Return-Path: nbastian@nbastian.com\r\n";
            $headers .= "From: $nome <$email>\r\n";
            $headers .= "Reply-To : $nome <$email> \r\n";

            $corpo = "\t\tContato via formul�rio do site\n\n\n";
            $corpo .= "Nome: " . $nome ."\n";
            $corpo .= "E-mail: " . $email . "\n";
            $corpo .= "Telefone: " . $fone . "\n";
            $corpo .= "Assunto: " . $assunto . "\n";

            $corpo .= "Mensagem:\n " . $mensagem . "\n";

            //echo $headers;
            //exit;

            if(!$spam)
            {
                mail($destinatario,$assunto,$corpo,$headers);
                echo("<script language='javascript'>\n alert('E-mail Enviado com Sucesso! Aguarde Nosso Retorno')\n</script>");
                echo("<script language='javascript'>location.href='contato.php'</script>");
                exit;
            }
            else
            {
                echo("<script language='javascript'>location.href='contato.php'</script>");
                exit;
            }
        }
    }
}
//fun��o que verifica se o email foi escrito do formato correto voce@provedor.com
function verificar_email($email)
{

   $mail_correcto = 0;
   //verifico umas coisas
   if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@"))
   {
      if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," ")))
      {
         //vejo se tem caracter .
         if (substr_count($email,".")>= 1)
         {
            //obtenho a termina��o do dominio
            $term_dom = substr(strrchr ($email, '.'),1);
            //verifico que a termina��o do dominio seja correcta
            if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) )
            {
              //verifico que o de antes do dominio seja correcto
              $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
              $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
              if($caracter_ult != "@" && $caracter_ult != ".")
              {
                 $mail_correcto = 1;
              }
            }
         }
      }
   }
   if ($mail_correcto)
     return 1;
   else
     return 0;
}
?>
