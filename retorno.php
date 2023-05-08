<?php
include('lib/log4php/Logger.php');
Logger::configure('log4php.xml');

require_once("admin/includes/conecta_bd.php");

// Aqui vai seu Token
define('TOKEN','E4033F99B5024F40B56201CC9BD3A053');

require "RetornoPagSeguro.php";

function send_mail($to, $assunto, $corpo){
    $headers = "From: NBastian Fotografia | Comunicacao  <nbastian@nbastian.com> \r\n";
    $headers .= "Reply-To : nbastian@nbastian.com \r\n";
    $headers .= "Return-Path: nbastian@nbastian.com \r\n";
    $headers .= "Date: ". date('D, d M Y H:i:s O')."\r\n";
    //$headers .= "Message-ID: <".md5(uniqid(microtime()))."@".$_SERVER['SERVER_NAME'].">\r\n";
    $headers .= "X-Mailer: PHP v".phpversion()."\r\n";
    $headers .= "X-MSMail-Priority: Normal\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

    mail($to, $assunto, $corpo, $headers);
}

function retorno_automatico($VendedorEmail, $TransacaoID,
  $Referencia, $TipoFrete, $ValorFrete, $Anotacao, $DataTransacao,
  $TipoPagamento, $StatusTransacao, $CliNome, $CliEmail,
  $CliEndereco, $CliNumero, $CliComplemento, $CliBairro, $CliCidade,
  $CliEstado, $CliCEP, $CliTelefone, $produtos, $NumItens){
    
	$logger = Logger::getLogger(basename(__FILE__));
	
	$logger->info("Iniciando retorno automatico - transacao " . $TransacaoID); 
	
	$pagSeguroRetorno = "Referencia: " . $Referencia . ", " .
						"DataTransacao: " . $DataTransacao . ", " .
						"TransacaoID: " . $TransacaoID . ", " .
						"StatusTransacao: " . $StatusTransacao . ", " .
						"TipoPagamento: " . $TipoPagamento . ", " .
						"TipoFrete: " . $TipoFrete . ", " .
						"ValorFrete: " . $ValorFrete . ", " .
						"Anotacao: " . $Anotacao . ", " .
						"VendedorEmail: " . $VendedorEmail . ", " .
						"Cliente Nome: " . $CliNome . ", " .
						"Cliente Email: " . $CliEmail . ", " .
						"Cliente Endereco: " . $CliEndereco . ", " .
						"Cliente Numero: " . $CliNumero . ", " .
						"Cliente Complemento: " . $CliComplemento . ", " .
						"Cliente Bairro: " . $CliBairro . ", " .
						"Cliente Cidade: " . $CliCidade . ", " .
						"Cliente Estado: " . $CliEstado . ", " .
						"Cliente CEP: " . $CliCEP . ", " .
						"Cliente Telefone: " . $CliTelefone . ", " .
						"Numero de Itens: " . $NumItens . ", " .
						"Produtos: " . print_r($produtos, true);
	
	$logger->info("Retorno do PagSeguro: {" . $pagSeguroRetorno . "}");

	$vl_total = 0;

    $sql = "SELECT * FROM pedido WHERE cd_pedido = " . $Referencia;
    $rs = mysql_query($sql);

    if(mysql_num_rows($rs) > 0)
    {
        $sql = "UPDATE pedido SET status_pedido='$StatusTransacao' WHERE cd_pedido = ". $Referencia;
        $rs1 = mysql_query($sql);

    }
    else
    {

        $sql = "INSERT INTO cliente 
                   (cd_cliente, nm_cliente, endereco, nr_endereco, complemento, nr_cep, bairro, cidade, estado, email, telefone)
                VALUES
                   (null,'$CliNome','$CliEndereco','$CliNumero','$CliComplemento','$CliCEP','$CliBairro','$CliCidade', '$CliEstado','$CliEmail','$CliTelefone')";

        $rs = mysql_query($sql);

        $cd_cliente = mysql_insert_id();

        list($data, $hora) = explode(" ",$DataTransacao);
        $data = implode('-',array_reverse(explode('/',$data)));

        $sql = "INSERT INTO pedido
                        (cd_pedido, dt_pedido, status_pedido, forma_pagamento, transacao_id, obs, vl_frete, cd_cliente)
                    VALUES
                        ('$Referencia','$data $hora','$StatusTransacao','$TipoPagamento','$TransacaoID','$Anotacao','$ValorFrete','$cd_cliente')";

        $rs = mysql_query($sql);

        for($x=1; $x<=$NumItens; $x++)
        {
            $cd_prod = 'ProdID_'.$x;
            $nm_prod = 'ProdDescricao_'.$x;
            $vl_prod = 'ProdValor_'.$x;
            $qtidade = 'ProdQuantidade_'.$x;

            $aux = $_POST[$cd_prod];

            list($tipo, $cd_foto) = explode('_', $aux);

            if($tipo == 'gal')
            {
                $rs1 = mysql_query("SELECT cd_galeria FROM fotos_galeria WHERE cd_foto='$cd_foto'");
                list($cd_galeria) = mysql_fetch_array($rs1);

                $rs1 = mysql_query("SELECT nm_galeria, vl_foto  FROM galerias WHERE cd_galeria='$cd_galeria'");
                list($nm_evento, $vl_foto) = mysql_fetch_array($rs1);
            }
            else
            {
                $rs1 = mysql_query("SELECT cd_evento FROM fotos_eventos WHERE cd_foto='$cd_foto'");
                list($cd_galeria) = mysql_fetch_array($rs1);

                $rs1 = mysql_query("SELECT nm_evento, vl_foto  FROM eventos WHERE cd_evento='$cd_galeria'");
                list($nm_evento, $vl_foto) = mysql_fetch_array($rs1);
            }


            $vl_total += ($vl_foto*1);
            
            $Executa = mysql_query("INSERT INTO pedido_itens VALUES('','$Referencia','".$_POST[$cd_prod]."','".$_POST[$qtidade]."','0')") or print(mysql_error());
       }

        $rs = mysql_query("UPDATE pedido SET vl_total='$vl_total' WHERE cd_pedido = ".$Referencia);
    }

    if(strtolower($StatusTransacao) == "aguardando pagto")
    {
        $corpo = "Prezado(a) $CliNome<BR>Recebemos o pedido numero: $Referencia que cont&eacute;m a(s) seguinte(s) fotos(s):<BR><BR>";

        for($x=1; $x<=$NumItens; $x++)
        {
            $cd_prod = 'ProdID_'.$x;

            $aux = $_POST[$cd_prod];

            list($tipo, $cd_foto) = explode('_', $aux);

            if($tipo == 'gal')
            {
                $rs1 = mysql_query("SELECT cd_galeria FROM fotos_galeria WHERE cd_foto='$cd_foto'");
                list($cd_galeria) = mysql_fetch_array($rs1);

                $rs1 = mysql_query("SELECT nm_galeria, vl_foto  FROM galerias WHERE cd_galeria='$cd_galeria'");
                list($nm_evento, $vl_foto) = mysql_fetch_array($rs1);
            }
            else
            {
                $rs1 = mysql_query("SELECT cd_evento FROM fotos_eventos WHERE cd_foto='$cd_foto'");
                list($cd_galeria) = mysql_fetch_array($rs1);

                $rs1 = mysql_query("SELECT nm_evento, vl_foto  FROM eventos WHERE cd_evento='$cd_galeria'");
                list($nm_evento, $vl_foto) = mysql_fetch_array($rs1);
            }

            $corpo .= $nm_evento." - Foto Nr. ".$cd_foto.'<BR><BR>';
        }

        $corpo .="Assim que confirmado o pagamento voc&ecirc; receber&aacute; um e-mail com as informa&ccedil;&otilde;es para download das suas fotos.";

        $corpo ."Agradecemos sua confian&ccedil;a,<BR> Equipe NBastian Fotografia | Comunica&ccedil;&atilde;o";

        send_mail($CliEmail, "Pedido recebido", $corpo);
     //   echo"<script language=javascript>location.href='obrigado.php?pedido=$Referencia'</script>";
       // exit;
    }

    if(strtolower($StatusTransacao) == 'aprovado')
        {
            $corpo = "Prezado(a) $CliNome<BR>Confirmamos seu pagamento do pedido n&uacute;mero: $Referencia<BR>Fa&ccedil;a o download da(s) sua(s) fotos(s), clicando:<BR><BR>";

            for($x=0; $x < $NumItens; $x++)
            {
                $n = ($x+1);
                $cd_prod = 'ProdID_'.$n;
                $nm_prod = 'ProdDescricao_'.$n;
                $vl_prod = 'ProdValor_'.$n;
                $qtidade = 'ProdQuantidade_'.$n;


                $aux = $_POST[$cd_prod];

                list($tipo, $cd_foto) = explode('_', $aux);

                if($tipo == 'gal')
                {
                    $rs1 = mysql_query("SELECT cd_galeria FROM fotos_galeria WHERE cd_foto='$cd_foto'");
                    list($cd_galeria) = mysql_fetch_array($rs1);

                    $rs1 = mysql_query("SELECT nm_galeria, vl_foto  FROM galerias WHERE cd_galeria='$cd_galeria'");
                    list($nm_evento, $vl_foto) = mysql_fetch_array($rs1);
                }
                else
                {
                    $rs1 = mysql_query("SELECT cd_evento FROM fotos_eventos WHERE cd_foto='$cd_foto'");
                    list($cd_galeria) = mysql_fetch_array($rs1);

                    $rs1 = mysql_query("SELECT nm_evento, vl_foto  FROM eventos WHERE cd_evento='$cd_galeria'");
                    list($nm_evento, $vl_foto) = mysql_fetch_array($rs1);
                }


                $vl_total += ($vl_foto*1);

                $rs = mysql_query("SELECT cd_item FROM pedido_itens WHERE cd_foto='".$_POST[$cd_prod]."' AND cd_pedido='$Referencia'");
                list($item) = mysql_fetch_array($rs);
                $corpo .= '<a href="http://www.nbastian.com/autorizar.php?pedido='.$Referencia.'&item='.$item.'&cod_aut='.$_POST[$cd_prod].'">'.$nm_evento.' - Foto Nr '.$cd_foto.'</a><BR><BR>';
                //$corpo .= '<a href="http://www.monografiadigital.com.br/autorizar.php?pedido='.$Referencia.'&item='.$n.'&cod_aut='.$_POST[$cd_prod].'">'.$var['titulo'].'</a><BR><BR>';
            }

            //$rs = mysql_query("UPDATE pedido SET vl_total='$vl_total' WHERE cd_pedido = ".$Referencia);

            $corpo .= "Gratos,<BR>Equipe NBastian Fotografia | Comunica&ccedil;&atilde;o";

            send_mail($CliEmail, "NBastian Fotografia | Comunicacao  -  Seu pedido foi liberado", $corpo);
        }
    // echo"<script language=javascript>location.href='obrigado.php?pedido=$Referencia'</script>";
    
	$logger->info("Finalizando retorno automatico - transacao " . $TransacaoID);
        
}

if ($_POST) {
  RetornoPagSeguro::verifica($_POST);
  die();
} else {
    header("Location: solicitacao+ok.php");
}
?>
