<?php
session_start();
session_name("site");

include_once("admin/includes/conecta_bd.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="generator" content="www.nbastian.com.br" />
<meta name="description" content="NBastian Fotografia e Comunicação - Nilson Bastian - Fotógrafo Profissional" />
<meta name="keywords" content="fotografo, joinville, fotógrafo, festival de dança, danca, bolshoi, escola do ballet bolshoi, balé, colunismo social, exposições, exposicoes, fotográficas, fotografica, fotojornalismo, comunicação, comunicacao, nilson bastian, bastian" />
<meta name="url" content="http://www.nbastian.com.br" />
<meta name="document-classification" content="Fotografia e Comunicação" />
<meta name="language" content="pt-br" />
<meta name="rating" content="General" />
<meta name="revisit-after" content="daily" />
<meta name="author" content="EversonJP / Agência P4" />
<meta name="copyright" content="NBastian" />
<meta name="robots" content="index, follow" />
<meta http-equiv="reply-to" content="nbastian@nbastian.com" />

<title>NBastian Fotografia | Comunica&ccedil;&atilde;o</title>
<link href="geral.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput-1.2.2.js"></script>

<script type="text/javascript">

function removeImagem(cdItem)
{
    //alert(cdFoto);
    $("#solicita").load('adiciona-foto.php',{acao:"remove", cd_item: cdItem});
}

jQuery(function($){
   $("#fone").mask("(99) 9999-9999");
   $("#cep").mask("99999-999");
   
   $('#cep').blur(function() {
        //$('#listaAgenda').ajaxStart(function(){});

                //alert(this.value);
                $.post('carrega.php',
                {cep: this.value},
                    function(data){

                        //alert(data.endereco);
                        if(data.sucess == true)
                        {
                            $('#endereco1').val(data.endereco);
                            $('#bairro').val(data.bairro);
                            $('#cidade').val(data.cidade);
                            $('#estado').val(data.estado);

                        }
                    }
                ,"json");


                return false;
    });
});
</script>
<style type="text/css">
#contato form{
    height: 630px;

}
</style>

<script type="text/javascript" src="js/funcoes.js"></script>

<!--[if IE]>
<script src="js/DD_belatedPNG.js" type="text/javascript"></script>
<script>
  /* Exemplo de utilizacao */
  DD_belatedPNG.fix('#topo, a, .eventos, .expo, h5, #patrocinadores, img');
</script>

<style type="text/css">
#contato form{
	width: 460px;

}


#contato form fieldset label {
    display:block;
}

#contato form fieldset button {
    margin: -10px 30px 0 0;
}

#boxe{
    clear: both;
}


</style>
<![endif]-->

</head>

<body>

	<div id="geral"> <!-- início div geral - engloba todo o site -->
    
    	<div id="topo"> <!-- início div topo - marca + menu de navegação -->
        
        	<ul>
                <li><a class="um" href="index.php">Home</a></li>
                <li><a class="dois" href="perfil.php">Perfil</a></li>
                <li><a class="tres" href="clientes.php">Clientes</a></li>
                <li><a class="quatro" href="galeria.php">Galerias</a></li>
                <li><a class="cinco" href="eventos.php">Eventos</a></li>
                <li><a class="sete" href="imprensa.php">Imprensa</a></li>
                <li><a class="oito on8" href="contato.php">Contato</a></li>
            </ul>
            
            <h1><a href="index.php">NBastian Fotografia | Comunica&ccedil;&atilde;o</a></h1>
            
        
        </div> <!-- fim div topo -->
        
        <div id="contato"> <!-- inicio div contato -->
                    
            <h2 class="solicitacao">Compra de Fotos</h2>
            <div class="box">
            
            	<div id="engloba">
                <div id="solicita">
                
               	  <h6>Fotos selecionadas:</h6>
                  
                  <ul id="fotinhos">
                      <?php
                       $vl_total = 0;
                       $rs = mysql_query("SELECT COUNT(*) FROM carrinho_itens WHERE cd_carrinho='".$_SESSION['carrinho']."' ");
                        list($total) = mysql_fetch_array($rs);
                        if(!$total)
                            echo '<p>Nenhuma Foto Selecionada</p>';

                      

                      $rs = mysql_query("SELECT * FROM carrinho_itens WHERE cd_carrinho='".$_SESSION['carrinho']."' ORDER BY cd_item ASC");
                      while($var = mysql_fetch_array($rs))
                      {
                        if($var['tp_foto'] == "galeria")
                        {
                            $rs1 = mysql_query("SELECT caminho_foto, cd_galeria FROM fotos_galeria WHERE cd_foto='{$var['cd_foto']}'");
                            list($foto, $galeria) = mysql_fetch_array($rs1);
                            
                            $rs1 = mysql_query("SELECT vl_foto FROM galerias WHERE cd_galeria='$galeria'");
                            list($vl_foto) = mysql_fetch_array($rs1);
                        }
                        elseif($var['tp_foto'] == "evento")
                        {
                            $rs1 = mysql_query("SELECT caminho_foto, cd_evento FROM fotos_eventos WHERE cd_foto='{$var['cd_foto']}'");
                            list($foto, $galeria) = mysql_fetch_array($rs1);
                            
                            $rs1 = mysql_query("SELECT vl_foto FROM eventos WHERE cd_evento='$galeria'");
                            list($vl_foto) = mysql_fetch_array($rs1);
                        }
                        elseif($var['tp_foto'] == "expo")
                        {
                            $rs1 = mysql_query("SELECT caminho_foto, cd_evento FROM fotos_eventos WHERE cd_foto='{$var['cd_foto']}'");
                            list($foto, $galeria) = mysql_fetch_array($rs1);
                            
                            $rs1 = mysql_query("SELECT vl_foto FROM eventos WHERE cd_evento='$galeria'");
                            list($vl_foto) = mysql_fetch_array($rs1);
                        }
                        
                        $vl_total += $vl_foto;

                      ?>
                        <li>
                    	   <img src="admin/includes/phpThumb/phpThumb.php?src=../../../<?php echo $foto;?>&w=67&h=67&zc=1" />
                            <span>R$ <?php echo number_format($vl_foto, 2, ',','.');?></span>
                        </li>
                    <?php
                    }
                    ?>


                  </ul>
                    <?php
                    if($total)
                    {
                    ?>
                     <br clear="left" />
                    <h6 class="total">Valor Total R$ <?php echo number_format($vl_total, 2, ',','.');?></h6>
                    <?php
                    }
                    else
                    {
                    ?>
                  	<br clear="left" />
                  	<?php
                    }
                    ?>
                  
                  </div>
                  
                  <div id="botao"><a href="#" onclick="history.back();"><img src="imagens/bot_contcomp.jpg" /></a></div>
                  
              </div>
                  
                
                <form name="form_contato" id="form_contato" action="https://pagseguro.uol.com.br/checkout/checkout.jhtml" method="post" >
                
                <?php
                     $rs = mysql_query("SELECT * FROM cliente_temp WHERE cd_carrinho='".$_SESSION['carrinho']."' ORDER BY cd_cliente DESC LIMIT 1");
                     $cliente = mysql_fetch_array($rs);
                     //print_r($cliente);
                     ?>
                
                	<p>Agradecemos seu interesse em adquirir nosso trabalho. Na caixa ao lado, voc&ecirc; visualiza todas as fotos  que foram adicionadas ao carrinho de compras. </p>
                	<p>Precisamos que voc&ecirc; preencha o formul&aacute;rio abaixo com seus dados para que possamos finalizar a compra, ap&oacute;s a confirma&ccedil;&atilde;o dos dados voc&ecirc; ser&aacute; redirecionado para o PagSeguro.</p>
<fieldset>                    
                        <input type="hidden" name="email_cobranca" value="nbastian@nbastian.com">
                            <input type="hidden" name="tipo" value="CP">
                            <input type="hidden" name="moeda" value="BRL">

                            <label for="cliente_nome">
                                <span>Seu Nome:</span>
                                <input type="text" name="cliente_nome" value="<?php echo ($cliente['nm_cliente']);?>" readonly="readonly" id="cliente_nome" />
                            </label>

                            <label for="cliente_cep">
                                <span>Seu CEP:</span>
                                <input type="text" name="cliente_cep" value="<?php echo str_replace("-", "", $cliente['nr_cep']);?>" readonly="readonly" id="cliente_cep" />
                            </label>

                            <label for="cliente_end">
                                <span>Seu Endereço:</span>
                                <input type="text" name="cliente_end" value="<?php echo $cliente['endereco'];?>" readonly="readonly" id="cliente_end" />
                            </label>

                            <label for="cliente_num">
                                <span>N&uacute;mero:</span>
                                <input type="text" name="cliente_num" value="<?php echo $cliente['nr_endereco'];?>" readonly="readonly" id="cliente_num" />
                            </label>

                            <label for="cliente_compl">
                                <span>Complemento:</span>
                                <input type="text" name="cliente_compl" value="<?php echo $cliente['complemento'];?>" readonly="readonly" id="cliente_compl" />
                            </label>



                            <label for="cliente_bairro">
                                <span>Seu Bairro:</span>
                                <input type="text" name="cliente_bairro" value="<?php echo htmlentities($cliente['bairro']);?>" readonly="readonly" id="cliente_bairro" />
                            </label>

                            <label for="cliente_cidade">
                                <span>Sua Cidade:</span>
                                <input type="text" name="cliente_cidade" value="<?php echo htmlentities($cliente['cidade']);?>" readonly="readonly" id="cliente_cidade" />
                            </label>

                            <label for="cliente_uf">
                                <span>Seu Estado:</span>
                                <input type="text" name="cliente_uf" value="<?php echo htmlentities($cliente['estado']);?>" readonly="readonly" id="cliente_uf" />
                            </label>


                            <input type="hidden" name="cliente_pais" value="BRA" />

                            <?php
                            list($ddd, $tel) = explode(")", $cliente['telefone']);

                            $ddd = str_replace("(","", $ddd);

                            $tel = str_replace("-","", $tel);
                            ?>

                            <label for="cliente_ddd">
                                <span>Seu DDD:</span>
                                <input type="text" name="cliente_ddd" value="<?php echo $ddd;?>" readonly="readonly" id="cliente_ddd" />
                            </label>

                            <label for="cliente_tel">
                                <span>Seu Telefone:</span>
                                <input type="text" name="cliente_tel" value="<?php echo $tel;?>" readonly="readonly" id="cliente_tel" />
                            </label>

                            <label for="cliente_email">
                                <span>Seu E-mail:</span>
                                <input type="text" name="cliente_email" value="<?php echo $cliente['email'];?>" readonly="readonly" id="cliente_email" />
                            </label>
                        
                        <?php
                         $total = 0;
                         $cods = array();
                         $rs = mysql_query("SELECT cd_foto FROM carrinho_itens WHERE cd_carrinho='".$_SESSION['carrinho']."'");
                         while($var = mysql_fetch_array($rs))
                            $cods[] = $var['cd_foto'];

                         $cods = implode(',',$cods);

                        if(isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho']) && !empty($cods))
                        {
                        ?>
                            <input type="hidden" name="ref_transacao" value="<?php echo $_SESSION['carrinho'];?>">
                            <?php
                            $cont = 1;

                            $rs = mysql_query("SELECT C.* FROM carrinho_itens C WHERE C.cd_carrinho='".$_SESSION['carrinho']."' AND C.tp_foto='evento'");
                            while($var = mysql_fetch_array($rs))
                            {

                                $rs1 = mysql_query("SELECT cd_evento FROM fotos_eventos WHERE cd_foto='{$var['cd_foto']}'");
                                list($cd_galeria) = mysql_fetch_array($rs1);

                                $rs1 = mysql_query("SELECT nm_evento, vl_foto  FROM eventos WHERE cd_evento='$cd_galeria'");
                                list($nm_evento, $vl_foto) = mysql_fetch_array($rs1);

                                $valor = str_replace(".","",$vl_foto);
                            ?>
                                <input type="hidden" name="item_id_<?php echo $cont;?>" value="eve_<?php echo $var['cd_foto'];?>">
                                <input type="hidden" name="item_descr_<?php echo $cont;?>" value="Evento: <?php echo $nm_evento;?> - Foto Nr <?php echo $var['cd_foto'];?>"">
                                <input type="hidden" name="item_quant_<?php echo $cont;?>" value="1">
                                <input type="hidden" name="item_valor_<?php echo $cont;?>" value="<?php echo $valor;?>">
                                <input type="hidden" name="item_frete_<?php echo $cont;?>" value="0">
                            <?php
                                $cont++;
                            }//while

                            
                            $rs = mysql_query("SELECT C.*  FROM carrinho_itens C WHERE C.cd_carrinho='".$_SESSION['carrinho']."' AND C.tp_foto='galeria'");
                            while($var = mysql_fetch_array($rs))
                            {
                                $rs1 = mysql_query("SELECT cd_galeria FROM fotos_galeria WHERE cd_foto='{$var['cd_foto']}'");
                                list($cd_galeria) = mysql_fetch_array($rs1);
                                
                                $rs1 = mysql_query("SELECT nm_galeria, vl_foto  FROM galerias WHERE cd_galeria='$cd_galeria'");
                                list($nm_galeria, $vl_foto) = mysql_fetch_array($rs1);

                                $valor = str_replace(".","",$vl_foto);
                            ?>
                                <input type="hidden" name="item_id_<?php echo $cont;?>" value="gal_<?php echo $var['cd_foto'];?>">
                                <input type="hidden" name="item_descr_<?php echo $cont;?>" value="Galeria <?php echo $nm_galeria;?> - Foto nr <?php echo $var['cd_foto'];?>">
                                <input type="hidden" name="item_quant_<?php echo $cont;?>" value="1">
                                <input type="hidden" name="item_valor_<?php echo $cont;?>" value="<?php echo $valor;?>">
                                <input type="hidden" name="item_frete_<?php echo $cont;?>" value="0">
                            <?php
                                $cont++;
                            }//while
                            ?>

                            <button type="submit">Enviar</button>
                        <?php
                        }
                        ?>


                        

                    </fieldset>
                
                </form>
                <div id="boxe"></div>
                <br clear="left" />
            
            </div><br clear="left" />
                        
        </div> <!-- fim div contato -->
    
    </div> <!-- fim div geral -->
    
	<div id="rodape"> <!-- div rodape -->
    	
  		<div id="patrocinadores"> <!-- div patrocinadores -->
            
            <?php
            require_once("patrocinadores.php");
            ?>
            
  		</div> <!-- fim div patrocinadores -->
        
        <div id="info"> <!-- div info -->
        
        	<p class="direita">Desenvolvido por <a href="http://www.eversonjp.com.br/">EversonJP</a></p>
        
        	<p><strong>Copyright @ <?php echo date("Y");?> N Bastian Ag&ecirc;ncia Fotogr&aacute;fica. Todos os direitos reservados.</strong><br />
       	    O conte&uacute;do deste website n&atilde;o pode ser distribuido, copiado ou divulgado sem o conhecimento da empresa.</p>
        
  		</div> <!-- fim div info -->
        
	</div> <!-- fim div rodape -->
    
    <script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
	try {
	var pageTracker = _gat._getTracker("UA-185146-22");
	pageTracker._trackPageview();
	} catch(err) {}</script>

</body>
</html>
