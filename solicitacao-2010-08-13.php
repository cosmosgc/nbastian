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
    $("#fotinhos").load('adiciona-foto.php',{acao:"remove", cd_item: cdItem});
}

jQuery(function($){
   $("#fone").mask("(99) 9999-9999");
});
</script>
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
                <li><a class="seis" href="noticias.php">Noticias</a></li>
                <li><a class="sete" href="imprensa.php">Imprensa</a></li>
                <li><a class="oito on8" href="contato.php">Contato</a></li>
            </ul>
            
            <h1><a href="index.php">NBastian Fotografia | Comunica&ccedil;&atilde;o</a></h1>
            
        
        </div> <!-- fim div topo -->
        
        <div id="contato"> <!-- inicio div contato -->
                    
            <h2 class="solicitacao">Colicita&ccedil;&atilde;o de Fotos</h2>
            <div class="box">
            
            	<div id="engloba">
                <div id="solicita">
                
               	  <h6>Fotos selecionadas:</h6>
                  
                  <ul id="fotinhos">
                      <?php
                       $rs = mysql_query("SELECT COUNT(*) FROM carrinho_itens WHERE cd_carrinho='".$_SESSION['carrinho']."' ");
                        list($total) = mysql_fetch_array($rs);
                        if(!$total)
                            echo '<p>Nenhuma Foto Selecionada</p>';

                      

                      $rs = mysql_query("SELECT * FROM carrinho_itens WHERE cd_carrinho='".$_SESSION['carrinho']."' ORDER BY cd_item ASC");
                      while($var = mysql_fetch_array($rs))
                      {
                        if($var['tp_foto'] == "galeria")
                        {
                            $rs1 = mysql_query("SELECT caminho_foto FROM fotos_galeria WHERE cd_foto='{$var['cd_foto']}'");
                            list($foto) = mysql_fetch_array($rs1);
                        }
                        elseif($var['tp_foto'] == "evento")
                        {
                            $rs1 = mysql_query("SELECT caminho_foto FROM fotos_eventos WHERE cd_foto='{$var['cd_foto']}'");
                            list($foto) = mysql_fetch_array($rs1);
                        }
                        elseif($var['tp_foto'] == "expo")
                        {
                            $rs1 = mysql_query("SELECT caminho_foto FROM fotos_eventos WHERE cd_foto='{$var['cd_foto']}'");
                            list($foto) = mysql_fetch_array($rs1);
                        }

                      ?>
                        <li>
                    	   <img src="admin/includes/phpThumb/phpThumb.php?src=../../../<?php echo $foto;?>&w=67&h=67&zc=1" />
                            <a onclick="removeImagem('<?php echo $var['cd_item'];?>','');" href="javascript:void(0);">Remover</a>
                        </li>
                    <?php
                    }
                    ?>
                    

                  </ul>
                  
                  	<br clear="left" />
                  
                  </div>
                  
                  <div id="botao"><a href="#" onclick="history.back();"><img src="imagens/bot_contcomp.jpg" /></a></div>
                  
              </div>
                  
                
                <form name="form_solicitacao" id="form_solicitacao" action="solicitacao+ok.php" method="post" onsubmit="return validaSolicitacao();">
                
                	<p>Agradecemos seu interesse em adquirir nosso trabalho. Na caixa ao lado, voc&ecirc; visualiza todas as fotos  que foram adicionadas ao carrinho de solicita&ccedil;&otilde;es. </p>
                	<p>Para que possamos efetuar um or&ccedil;amento, precisamos que voc&ecirc; preencha o formul&aacute;rio a baixo com seus dados.</p>
<fieldset>                    
                        <label for="nome">
                        <span>Nome:</span>
                        <input type="text" name="nome" value="" id="nome">
                        </label>
                        
                        <label for="email">
                        <span>E-mail</span>
                        <input type="text" name="email" value="" id="email">
                        </label>
                        
                        <label for="fone">
                        <span>Telefone:</span>
                        <input type="text" name="fone" value="" id="fone">
                        </label>
                        
                        <label for="cidade">
                        <span>Cidade:</span>
                        <input type="text" name="cidade" value="" id="cidade">
                        </label>
                        
                        <label for="estado">
                        <span>Estado:</span>
                        <input type="text" name="estado" value="" id="estado">
                        </label>
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
        
        	<p class="direita">Desenvolvido por <a href="http://www.eversonjp.com.br/">EversonJP</a></p>
        
        	<p><strong>Copyright @ 2009 N Bastian Ag&ecirc;ncia Fotogr&aacute;fica. Todos os direitos reservados.</strong><br />
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
