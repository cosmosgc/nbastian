<?php
/************************************************************************
ARQUIVO .........: include de verificação de acesso
BY ..............: Reges B. Boegershausen  - regesbb@gmail.com
CRIADO EM .......: 26/10/2006
ÚLTIMA ALTERAÇÃO.: 26/10/2006
************************************************************************/


   //verifica se alguma das variáveis de sessão não está "setada"!!!
   if( (!isset($_SESSION["nm_usuario"]))||(!isset($_SESSION["de_login"])))
   {
	   unset ($_SESSION['nm_usuario']);
       unset ($_SESSION['de_login']);

       echo"<script language=javascript>location.href='index.php'</script>";   
   }//fecha if
?>

