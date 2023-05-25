<?php

session_name("site");
session_start();
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta charset="utf-8">
<meta name="generator" content="www.nbastian.com.br" />
<meta name="description" content="NBastian Fotografia e Comunicação - Nilson Bastian - Fotógrafo Profissional" />
<meta name="keywords" content="fotografo, joinville, fotógrafo, festival de dança, danca, bolshoi, escola do ballet bolshoi, balé, colunismo social, exposições, exposicoes, fotográficas, fotografica, fotojornalismo, Comunicação, comunicacao, nilson bastian, bastian" />
<meta name="url" content="http://www.nbastian.com.br" />
<meta name="document-classification" content="Fotografia e Comunicação" />
<meta name="language" content="pt-br" />
<meta name="rating" content="General" />
<meta name="revisit-after" content="daily" />
<meta name="author" content="EversonJP.com.br / Agéncia P4" />
<meta name="copyright" content="NBastian" />
<meta name="robots" content="index, follow" />
<meta http-equiv="reply-to" content="nbastian@nbastian.com" />
<meta name="google-site-verification" content="0ZqB4dqU8D7om5nQEzTiI76tPx0CK43xhYNp6bVRLFY" />

<title>NBastian Fotografia | Comunica&ccedil;&atilde;o</title>
<link href="geral.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.cycle.js"></script>

<script type="text/javascript">  
$(document).ready(function() {  
    $('#banner').cycle({
        fx:     'fade',
        speed:  'slow',
        timeout: 4000,
        next:   '#next2',
        prev:   '#prev2'
    });
});  
</script>

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

	<div id="geral"> <!-- início div geral - engloba todo o site -->
    
    	<div id="topo"> <!-- início div topo - marca + menu de navegação -->
        
        	<ul>
                <li><a class="dois" href="perfil.php">Perfil</a></li>
                <li><a class="tres" href="clientes.php">Clientes</a></li>
                <li><a class="quatro" href="galeria.php">Galerias</a></li>
                <li><a class="cinco" href="eventos.php">Eventos</a></li>
                <li><a class="sete" href="imprensa.php">Imprensa</a></li>
                <li><a class="oito" href="contato.php">Contato</a></li>
            </ul>
            
            <h1>NBastian Fotografia | Comunica&ccedil;&atilde;o</h1>
            
        </div> <!-- fim div topo -->
        
        <div id="principal"> <!-- inicio div principal -->
        
        	<div class="setaEsquerda"><a id="prev2" href="#"><img src="imagens/banner/seta+esquerda.png" /></a></div>
            <div class="setaDireita"><a id="next2" href="#"><img src="imagens/banner/seta+direita.png" /></a></div>
        
        	<div id="banner"> <!-- inicio div banner -->
            <?php
            $rs1 = mysqli_query($conn,"SELECT * FROM imagens_home ORDER BY dt_cadastro ASC");
            while($dados = mysqli_fetch_array($rs1,MYSQLI_ASSOC))
            {
            
                echo '<img src="'.$dados['caminho_foto'].'" />';
            }
            ?>

            </div> <!-- fim div banner -->     
            
            <div id="destaque"> <!-- inicio div destaque --><? include 'jquery-galleryview-1.1//includes.php'; ?>
            
            	<ul>
                
                	<li class="eventos">
                    

                       <?php
                       $rs = mysqli_query($conn,"SELECT * FROM eventos WHERE tipo_evento='1' ORDER BY dt_evento DESC LIMIT 1");
                       $evento = mysqli_fetch_array($rs,MYSQLI_ASSOC);
                       
                       $rs1 = mysqli_query($conn,"SELECT caminho_foto FROM fotos_eventos WHERE cd_evento='{$evento['cd_evento']}' ORDER BY cd_foto ASC LIMIT 1");
                       list($foto) = mysqli_fetch_array($rs1);
                       
                       if(empty($foto))
                        $foto = 'imagens/eventos/index1.jpg';
                       ?>
                       <img src="admin/includes/phpThumb/phpThumb.php?src=../../../<?php echo $foto;?>&w=86&h=123&zc=1" />

                        <h5><?php echo htmlentities($evento['nm_evento']);?></h5>
                        <p><?php echo substr(strip_tags($evento['descricao']),0, 75);?>...</p>
                        <p>Data:  <?php echo implode("/",array_reverse(explode("-",$evento['dt_evento'])));?><br />Local: <?php echo $evento['local'];?><br /><?php if(empty($evento['tempo_duracao'])) echo'<br />'; else echo 'Duração: '.$evento['tempo_duracao'];?></p>
                        <p><a href="eventos.php">Veja todos os eventos</a></p>
                    
                    </li>
                    <li class="expo">
                    
                     <?php
                       $rs = mysqli_query($conn,"SELECT * FROM galerias WHERE cd_categoria='8' ORDER BY dt_galeria DESC LIMIT 1") or die(mysqli_connect_error());
                       $evento = mysqli_fetch_array($rs,MYSQLI_ASSOC);

                       $rs1 = mysqli_query($conn,"SELECT caminho_foto FROM fotos_galeria WHERE cd_galeria='{$evento['cd_galeria']}' ORDER BY cd_foto ASC LIMIT 1");
                       list($foto) = mysqli_fetch_array($rs1);
                       
                       if(empty($foto))
                        $foto = 'imagens/eventos/index1.jpg';
                       ?>
                       <img src="admin/includes/phpThumb/phpThumb.php?src=../../../<?php echo $foto;?>&w=86&h=123&zc=1" />
                        
                        <h5><?php echo htmlentities($evento['nm_galeria']);?></h5>

                        <p><?php echo substr(strip_tags($evento['descricao']),0, 75);?>...</p>
                        <p>Data:  <?php echo implode("/",array_reverse(explode("-",$evento['dt_galeria'])));?><br />Local: <?php echo $evento['local'];?><br /><?php if(empty($evento['tempo_duracao'])) echo'<br />'; else echo 'Duração: '.$evento['tempo_duracao'];?></p>
                        <p><a href="galeria+categoria.php?cat=8">Veja todas as exposições</a></p>
                    
                    </li>
                
                </ul>
            
            </div> <!-- fim div destaque -->
            
        </div> <!-- fim div principal -->
    
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
