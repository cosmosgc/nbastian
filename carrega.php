<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);
$cep = isset($_REQUEST['cep']) ? ($_REQUEST['cep']) : "";

$resultado = @file_get_contents('http://republicavirtual.com.br/web_cep.php?cep='.urlencode($cep).'&formato=query_string');

            //$resultado = htmlentities($resultado);
            parse_str($resultado, $retorno);
            //$resp->addAlert(print_r($retorno, true));

            $listagem = 'endereco: "'.($retorno['tipo_logradouro']).' '.($retorno['logradouro']).'", ';
            $listagem .='bairro: "'.($retorno['bairro']).'", ';
            $listagem .='cidade: "'.($retorno['cidade']).'", ';
            $listagem .='estado: "'.$retorno['uf'].'"';
            //$resp->addAssign("de_endereco","value", $retorno['logradouro']);


$conteudo = "{sucess: true, ";
$conteudo .= "$listagem }";


echo $conteudo;
?>
