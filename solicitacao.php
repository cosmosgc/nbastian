<?php

session_name("site");
session_start();

include_once("admin/includes/conecta_bd.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="generator" content="www.nbastian.com.br" />
<meta name="description" content="NBastian Fotografia e Comunicação - Nilson Bastian - fotógrafo Profissional" />
<meta name="keywords" content="fotografo, joinville, fotógrafo, festival de dança, danca, bolshoi, escola do ballet bolshoi, balé, colunismo social, exposições, exposicoes, fotográficas, fotografica, fotojornalismo, Comunicação, comunicacao, nilson bastian, bastian" />
<meta name="url" content="http://www.nbastian.com.br" />
<meta name="document-classification" content="Fotografia e Comunicação" />
<meta name="language" content="pt-br" />
<meta name="rating" content="General" />
<meta name="revisit-after" content="daily" />
<meta name="author" content="Nbastian Fotografia comunicação" />
<meta name="copyright" content="NBastian" />
<meta name="robots" content="index, follow" />
<meta http-equiv="reply-to" content="nilsonbastian@me.com" />

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
    height: 615px;

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
                       $rs = mysqli_query($conn, "SELECT COUNT(*) FROM carrinho_itens WHERE cd_carrinho='".$_SESSION['carrinho']."' ");
                        list($total) = mysqli_fetch_array($rs, MYSQLI_BOTH);
                        if(!$total)
                            echo '<p>Nenhuma Foto Selecionada</p>';

                      

                      $rs = mysqli_query($conn, "SELECT * FROM carrinho_itens WHERE cd_carrinho='".$_SESSION['carrinho']."' ORDER BY cd_item ASC");
                      while($var = mysqli_fetch_array($rs, MYSQLI_BOTH))
                      {
                        if($var['tp_foto'] == "galeria")
                        {
                            $rs1 = mysqli_query($conn, "SELECT caminho_foto, cd_galeria FROM fotos_galeria WHERE cd_foto='{$var['cd_foto']}'");
                            list($foto, $galeria) = mysqli_fetch_array($rs1, MYSQLI_BOTH);
                            
                            $rs1 = mysqli_query($conn, "SELECT vl_foto FROM galerias WHERE cd_galeria='$galeria'");
                            list($vl_foto) = mysqli_fetch_array($rs1, MYSQLI_BOTH);
                        }
                        elseif($var['tp_foto'] == "evento")
                        {
                            $rs1 = mysqli_query($conn, "SELECT caminho_foto, cd_evento FROM fotos_eventos WHERE cd_foto='{$var['cd_foto']}'");
                            list($foto, $galeria) = mysqli_fetch_array($rs1, MYSQLI_BOTH);
                            
                            $rs1 = mysqli_query($conn, "SELECT vl_foto FROM eventos WHERE cd_evento='$galeria'");
                            list($vl_foto) = mysqli_fetch_array($rs1, MYSQLI_BOTH);
                        }
                        elseif($var['tp_foto'] == "expo")
                        {
                            $rs1 = mysqli_query($conn, "SELECT caminho_foto, cd_evento FROM fotos_eventos WHERE cd_foto='{$var['cd_foto']}'");
                            list($foto, $galeria) = mysqli_fetch_array($rs1, MYSQLI_BOTH);
                            
                            $rs1 = mysqli_query($conn, "SELECT vl_foto FROM eventos WHERE cd_evento='$galeria'");
                            list($vl_foto) = mysqli_fetch_array($rs1, MYSQLI_BOTH);
                        }
                        
                        $vl_total += $vl_foto;

                      ?>
                        <li>
                    	   <img src="admin/includes/phpThumb/phpThumb.php?src=../../../<?php echo $foto;?>&w=67&h=67&zc=1" />
                            <span>R$ <?php echo number_format($vl_foto, 2, ',','.');?></span>
                            <a onclick="removeImagem('<?php echo $var['cd_item'];?>','');" href="javascript:void(0);">Remover</a>
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
                  
                
                <form name="form_solicitacao" id="form_solicitacao" action="cadastro.php" method="post" onsubmit="return validaSolicitacao();">


                    <p>Agradecemos seu interesse em adquirir nosso trabalho. Na caixa ao lado, voc&ecirc; visualiza todas as fotos  que foram adicionadas ao carrinho de compras. </p>
                	<p>Precisamos que voc&ecirc; preencha o formul&aacute;rio abaixo com seus dados para que possamos finalizar a compra, ap&oacute;s a confirma&ccedil;&atilde;o dos dados voc&ecirc; ser&aacute; redirecionado para o PagSeguro.</p>
<fieldset>                    
                        <label for="nome">
                        <span>Nome:</span>
                        <input type="text" name="nome" value="" id="nome">
                        </label>
                        
                        <label for="email">
                        <span>E-mail</span>
                        <input type="text" name="email" value="" id="email">
                        </label>
                        
                        <label for="cep">
                        <span>CEP:</span>
                        <input type="text" name="cep" value="" id="cep">
                        </label>
                        
                        <label for="endereco1">
                        <span>Endere&ccedil;o:</span>
                        <input type="text" name="endereco1" value="" id="endereco1">
                        </label>
                        
                        <label for="nr_endereco">
                        <span>N&uacute;mero:</span>
                        <input type="text" name="nr_endereco" value="" id="nr_endereco">
                        </label>
                        
                        <label for="complemento">
                        <span>Complemento:</span>
                        <input type="text" name="complemento" value="" id="complemento">
                        </label>
                        
                        <label for="bairro">
                        <span>Bairro:</span>
                        <input type="text" name="bairro" value="" id="bairro">
                        </label>
                        
                        <label for="cidade">
                        <span>Cidade:</span>
                        <input type="text" name="cidade" value="" id="cidade">
                        </label>

                        <label for="estado">
                        <span>Estado:</span>
                        <input type="text" name="estado" value="" id="estado" maxlength="2">
                        </label>

                        <label for="fone">
                        <span>Telefone:</span>
                        <input type="text" name="fone" value="" id="fone">
                        </label>
                        
                        <?php
                        
                        ?>
                        <input type="hidden" name="acao" id="acao" value="enviar" />
                        
                        <button type="submit">Enviar</button>
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
        
        	<p class="direita">Desenvolvido por <a href="http://nbastian.com/">Nbastian</a></p>
        
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
