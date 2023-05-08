<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="generator" content="www.nbastian.com.br" />
<meta name="description" content="NBastian Fotografia e Comunica��o - Nilson Bastian - Fot�grafo Profissional" />
<meta name="keywords" content="fotografo, joinville, fot�grafo, festival de dan�a, danca, bolshoi, escola do ballet bolshoi, bal�, colunismo social, exposi��es, exposicoes, fotogr�ficas, fotografica, fotojornalismo, comunica��o, comunicacao, nilson bastian, bastian" />
<meta name="url" content="http://www.nbastian.com.br" />
<meta name="document-classification" content="Fotografia e Comunica��o" />
<meta name="language" content="pt-br" />
<meta name="rating" content="General" />
<meta name="revisit-after" content="daily" />
<meta name="author" content="EversonJP / Ag�ncia P4" />
<meta name="copyright" content="NBastian" />
<meta name="robots" content="index, follow" />
<meta http-equiv="reply-to" content="nbastian@nbastian.com" />

<title>NBastian Fotografia | Comunica&ccedil;&atilde;o</title>
<link href="geral.css" rel="stylesheet" type="text/css" />

<!--
<script type="text/javascript" src="js/mootools.js"></script>
<script type="text/javascript" src="js/imageMenu.js"></script>
<script type="text/javascript">
	window.addEvent('domready', function(){
		var myMenu = new ImageMenu($$('#imageMenu a'),{openWidth:310, border:2, onOpen:function(e,i){alert(e);}});
	});
</script>

-->

<!--[if IE 6]>
<script src="js/DD_belatedPNG.js" type="text/javascript"></script>
<script>
  /* Exemplo de utilizacao */
  DD_belatedPNG.fix('#topo, a, .eventos, .expo, h5, #patrocinadores');
</script>
<![endif]-->

<?php
require_once("admin/includes/conecta_bd.php");
?>
</head>

<body>

	<div id="geral"> <!-- in�cio div geral - engloba todo o site -->
    
    	<div id="topo"> <!-- in�cio div topo - marca + menu de navega��o -->
        
        	<ul>
                <li><a class="um" href="index.php">Home</a></li>
                <li><a class="dois on2" href="perfil.php">Perfil</a></li>
                <li><a class="tres" href="clientes.php">Clientes</a></li>
                <li><a class="quatro" href="galeria.php">Galerias</a></li>
                <li><a class="cinco" href="eventos.php">Eventos</a></li>
                <li><a class="sete" href="imprensa.php">Imprensa</a></li>
                <li><a class="oito" href="contato.php">Contato</a></li>
            </ul>
            
            <h1><a href="index.php">NBastian Fotografia | Comunica&ccedil;&atilde;o</a></h1>
            
        
        </div> <!-- fim div topo -->
        
        <div id="perfil"> <!-- inicio div perfil -->
                    
            <h2>Perfil</h2>
            <div class="box">
            
             <?php
             $rs = mysqli_query($conn,"SELECT * FROM perfil WHERE cd_perfil='1'");
             $perfil = mysqli_fetch_array($rs,MYSQLI_ASSOC);
             echo $perfil['de_conteudo'];
             ?>
            
            </div>
           <!--
            <h2 class="colaboradores">Colaboradores</h2>
            <div id="imageMenu">
                <ul>
                    <?php
                    $rs = mysql_query("SELECT * FROM perfil WHERE tipo_perfil='2' ORDER BY cd_perfil ASC");
                    while($perfil = mysql_fetch_array($rs))
                    {
                        echo '<li class="landscapes" >';
                        echo '<a href="#"><img src="'.$perfil['caminho_foto'].'" alt="" width="170" height="188" />';
                        echo $perfil['de_conteudo'];
                        echo '</a></li>';
                    }
                    ?>

                </ul>
			</div>
            -->
        </div> <!-- fim div perfil -->
        
        <hr />
    
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
