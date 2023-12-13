<?php
session_name("site");
session_start();

if(isset($_SESSION['logado']) && $_SESSION['logado'] == true && isset($_SESSION['nm_usuario'])) {
    echo("<script language='javascript'>location.href='imprensa+interna.php'</script>");
    exit;
}

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


<script type="text/javascript" src="js/funcoes.js"></script>
<!--[if IE]>
<script src="js/DD_belatedPNG.js" type="text/javascript"></script>
<script>
  /* Exemplo de utilizacao */
  DD_belatedPNG.fix('#topo, a, .eventos, .expo, h5, #patrocinadores');
</script>

<style type="text/css">
#imprensa form{
	width: 400px;
}

.box{
    height: 280px;
}

#imprensa form fieldset label {
    display:block;
}

#imprensa form fieldset button {
    margin:0 80px 0 0;
}

#boxe{
    clear: both;
}

</style>
<![endif]-->
</head>

<body>

	<div id="geral"> <!-- início div geral - engloba todo o site -->
    
    <?php require_once("includes/menu_bar.php"); ?>
        
        <div id="imprensa"> <!-- inicio div imprensa -->
                    
            <h2 class="imprensa">Imprensa</h2>
            <div class="box">
            
               	  <ul>
                  
                  	  <p>Se voc&ecirc; faz parte da imprensa e deseja ter acesso a imagens de divulga&ccedil;&atilde;o, fa&ccedil;a seu cadastro enviando seus dado para o seguinte e-mail.</p>
                  
                      <li><strong>E-MAIL PARA CONTATO:</strong></li>
                      <li><span class="minusculo"><a href="mailto:nilsonbastian@me.com?Subject=Site: &Aacute;rea de Imprensa" title="E-mail para contato">nilsonbastian@me.com</a></span></li>
                  </ul>
                
          <form name="flogin" id="flogin" action="logar.php" method="post" onsubmit="return validaLogin();">
                
                	<p>Se voc&ecirc; j&aacute; possui um cadastro, entre com seu usu&aacute;rio e senha para acessar a &aacute;rea restrita e ter acesso as fotos disponibilizadas.</p>
                    
                    
<fieldset>                    
                        <label for="usuario">
                        <span>Usu&aacute;rio:</span>
                        <input type="text" name="usuario" value="" id="usuario">
                        </label>
                        
                        <label for="senha">
                        <span>Senha:</span>
                        <input type="password" name="senha" value="" id="senha">
                        </label>

                        <input type="hidden" name="acao" id="acao" value="logar" />
                        <button type="submit">Enviar</button>
                    </fieldset>
                
                </form>

                <div id="boxe"></div>
                <br clear="left" />

            </div>

      </div> <!-- fim div imprensa -->
    
    </div> <!-- fim div geral -->
    
	<div id="rodape"> <!-- div rodape -->
    	
  		<div id="patrocinadores"> <!-- div patrocinadores -->
            
            <?php
            require_once("patrocinadores.php");
            ?>
            
  		</div> <!-- fim div patrocinadores -->
        
        <div id="info"> <!-- div info -->
        
        	<p class="direita">Desenvolvido por <a href="http://nbastian.com/">Nbastian</a></p>
        
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
