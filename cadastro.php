<?php
session_start();
session_name("site");

require_once("admin/includes/anti_injection.php");
require_once("admin/includes/conecta_bd.php");

if(isset($_POST['acao']) && $_POST['acao'] == "enviar")
{
    foreach ($_POST as $campo => $valor) { $$campo = $valor;}

    //Veri�vel auxiliar para detectar spamns. Inicialmente � setada como false.
    $spam = false;

    //echo "<pre>";
    //print_r($_POST);
    //exit;
    //Verifica se os campos s�o vazios ou est�o preenchidos com o conte�do padr�o.
    if(empty($nome) || empty($cep) || empty($endereco1) || empty($nr_endereco) || empty($bairro) || empty($cidade) || empty($estado) || empty($fone) || empty($email))
    {
        echo("<script language='javascript'>\n alert('Favor preencher todos os campos')\n</script>");
        echo("<script language='javascript'>location.href='solicitacao.php'</script>");
        exit;
    }
    else
    {
           $nome = ucwords($nome);
           $endereco = ucwords($endereco);
           $bairro = ucwords($bairro);
           $cidade = ucwords($cidade);
           $estado = strtoupper($estado);

           $total = 0;
           $cods = array();
           $rs = mysql_query("SELECT cd_foto FROM carrinho_itens WHERE cd_carrinho='".$_SESSION['carrinho']."'");
           while($var = mysql_fetch_array($rs))
                $cods[] = $var['cd_foto'];

           $cods = implode(',',$cods);
           
           if(!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho']) || empty($cods))
           {
                echo("<script language='javascript'>\n alert('Seu carrinho est� vazio, favor selecionar as fotos desejadas antes de finalizar sua compra!')\n</script>");
                echo("<script language='javascript'>location.href='solicitacao.php'</script>");
                exit;
           }
           else
           {
                $rs = mysql_query("INSERT INTO cliente_temp VALUES('','".$_SESSION['carrinho']."','$nome','$endereco1','$nr_endereco','$complemento','$cep',
                '$bairro','$cidade','$estado','$email','$fone')") or die(mysql_error());
            
                echo("<script language='javascript'>location.href='solicitacao-confere.php'</script>");
                exit;
           }
        echo("<script language='javascript'>location.href='./'</script>");
                exit;

    }
}
//fun��o que verifica se o email foi escrito do formato correto voce@provedor.com
function verificar_email($email)
{

   if (eregi("^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$", $eMailAddress, $check))
    {
        return true;
    }

    return false;
}
?>
