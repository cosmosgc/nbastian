<?php
session_name("site");
session_start();


require_once("admin/includes/conecta_bd.php");
require_once("admin/includes/anti_injection.php");

if(isset($_POST['acao']) && $_POST['acao'] == "logar")
{
    foreach ($_POST as $campo => $valor) { $$campo = anti_injection($valor);}


    //print_r($_POST);
    //exit;
    //Verifica se os campos s�o vazios ou est�o preenchidos com o conte�do padr�o.
    if(empty($senha) || empty($usuario))
    {
        echo"<script language=javascript>alert('Favor preencher todos os campos')</script>";
        echo"<script language=javascript>location.href='imprensa.php'</script>";
        exit;
    }
    else
    {
        //verifica oe endere�o de email
        if(!verificar_email($usuario) == 2)
        {
            echo("<script language='javascript'>\n alert('Favor digitar em endere�o de e-mail v�lido!')\n</script>");
            echo("<script language='javascript'>location.href='imprensa.php'</script>");
            exit;
        }
        else
        {
            $rs = mysqli_query($conn, "SELECT cd_usuario, nm_usuario, AES_DECRYPT(de_senha,'imprensa') AS de_senha FROM imprensa_usuarios WHERE email_usuario='$usuario'");
            if(mysqli_num_rows($rs) > 0)
            {
                $var = mysqli_fetch_array($rs, MYSQLI_BOTH);
                if($var['de_senha'] == $senha)
                {
                    $rs1 = mysqli_query($conn, "UPDATE imprensa_usuarios SET dt_ultimo_acesso='".time()."' WHERE cd_usuario='{$var['cd_usuario']}'");

                    $_SESSION['logado'] = true;
                    $_SESSION['nm_usuario'] = $var['nm_usuario'];
                    echo("<script language='javascript'>location.href='imprensa+interna.php'</script>");
                    exit;
                    
                }
                else
                {
                    echo("<script language='javascript'>\n alert('Senha incorreta!')\n</script>");
                    echo("<script language='javascript'>location.href='imprensa.php'</script>");
                    exit;
                }
            }
            else
            {
                echo("<script language='javascript'>\n alert('Usu�rio n�o cadastrado!')\n</script>");
                echo("<script language='javascript'>location.href='imprensa.php'</script>");
                exit;
            }
        }
    }

}


if(isset($_GET['acao']) && $_GET['acao'] == "sair")
{
    unset($_SESSION['logado']);
    unset($_SESSION['nm_usuario']);
    echo("<script language='javascript'>location.href='imprensa.php'</script>");
    exit;
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
