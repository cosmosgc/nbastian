<?php
session_name("site");
session_start();

require_once("admin/includes/anti_injection.php");
require_once("admin/includes/conecta_bd.php");

if(isset($_POST['acao']) && $_POST['acao'] == "enviar")
{
    foreach ($_POST as $campo => $valor) { $$campo = $valor;}

    //Veriável auxiliar para detectar spamns. Inicialmente é setada como false.
    $spam = false;

    //echo "<pre>";
    //print_r($_POST);
    //exit;
    //Verifica se os campos são vazios ou estáo preenchidos com o conteúdo padrão.
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
           $rs = mysqli_query($conn, "SELECT cd_foto FROM carrinho_itens WHERE cd_carrinho='".$_SESSION['carrinho']."'");
           while($var = mysqli_fetch_array($rs, MYSQLI_ASSOC))
                $cods[] = $var['cd_foto'];

           $cods = implode(',',$cods);
           
           if(!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho']) || empty($cods))
           {
                echo("<script language='javascript'>\n alert('Seu carrinho está vazio, favor selecionar as fotos desejadas antes de finalizar sua compra!')\n</script>");
                echo("<script language='javascript'>location.href='solicitacao.php'</script>");
                exit;
           }
           else
           {
                $rs = mysqli_query($conn, "INSERT INTO cliente_temp VALUES('','".$_SESSION['carrinho']."','$nome','$endereco1','$nr_endereco','$complemento','$cep',
                '$bairro','$cidade','$estado','$email','$fone')") or die(mysqli_error());
            
                echo("<script language='javascript'>location.href='solicitacao-confere.php'</script>");
                exit;
           }
        echo("<script language='javascript'>location.href='./'</script>");
                exit;

    }
}
//função que verifica se o email foi escrito do formato correto voce@provedor.com
function verificar_email($email)
{

   if (eregi("^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$", $eMailAddress, $check))
    {
        return true;
    }

    return false;
}
?>
