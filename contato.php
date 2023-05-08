<?php
session_start();
session_name("site");
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
<script type="text/javascript" src="js/DD_belated.js"></script>
	<link rel="stylesheet" href="js/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
	<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			$("a[rel^='prettyPhoto']").prettyPhoto({
				animationSpeed: 'normal',
				padding: 40,
				opacity: 0.85,
				showTitle: false,
				allowresize: true,
				counter_separator_label: '/',
				theme: 'light_rounded'

			});
		});

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
	width: 480px;
}


#contato form fieldset label {
    display:block;
}

#contato form fieldset button {
    margin: -10px 45px 0 0;
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
                    
            <h2 class="contato">Fale Conosco</h2>
            <div class="box">
            
            	<div id="endereco">
                
               	  <ul>
                  	  <li><strong>Endere&ccedil;o:</strong></li>
                      <li><span>RUA CA&Ccedil;ADOR, 320 - ANITA GARIBALDI<br />
                    CEP 89203-610 - JOINVILLE / SC</span></li>
                      
                    <li><strong>Fone para contato:</strong></li>
                      <li><span>(47) 3025-6114 / (47) 9964-0920</span></li>
                      
                      <li><strong>E-MAIL PARA CONTATO:</strong></li>
                      <li><span class="minusculo"><a href="mailto:nbastian@nbastian.com?Subject=Contato via site" title="E-mail para contato">nbastian@nbastian.com</a></span></li>
                  </ul>
                  
                  <!--<a href=""><img src="imagens/mapa.jpg" /></a>-->
                  <a href="contato+mapa.php&iframe=true&amp;width=850&amp;height=530" rel="prettyPhoto"><img src="imagens/mapa.jpg" /></a>
                
              	</div>
                
                <form name="form_contato" id="form_contato" action="enviar.php" method="post" onsubmit="return validaContato();">
                
                	<p>Se voc&ecirc; deseja alguma solicita&ccedil;&atilde;o de servi&ccedil;os, or&ccedil;amentos ou qualquer outra informa&ccedil;&atilde;o, preencha todos os campos do formul&aacute;rio abaixo que retornarmos o mais breve poss&iacute;vel.</p>
                    
                    
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
                        
                        <label for="assunto">
                        <span>Assunto:</span>
                        <input type="text" name="assunto" value="" id="assunto">
                        </label>
                        
                        <label for="mensagem">
                        <span>Mensagem:</span>
                        <textarea name="mensagem" id="mensagem" cols="" rows=""></textarea>
                        </label>
                        
                        <input type="hidden" name="acao" id="acao" value="enviar" />
                        <button type="submit">Enviar</button>
                    </fieldset>
                
                </form>
                <div id="boxe"></div>
                <br clear="left" />
            
            </div>
            <br clear="left" />

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
