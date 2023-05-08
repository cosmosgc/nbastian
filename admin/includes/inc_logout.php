<?session_start();
/************************************************************************
SISTEMA .........: Projetar Engenharia
ARQUIVO .........: encerramento de sessão
BY ..............: Gean A. Pereira
CRIADO EM .......: 09/01/2006
ÚLTIMA ALTERAÇÃO.: 27/09/2007
ALTERADO POR ....: Geovani Gilberto Lampugnani
************************************************************************/

 unset ($_SESSION['nm_usuario']);
 unset ($_SESSION['de_login']);


echo"<script language=javascript>alert('Seção encerrada com sucesso!')</script>";
echo"<script language=javascript>location.href='../index.php'</script>";
?>
