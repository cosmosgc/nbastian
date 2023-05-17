<?php
session_name("site");
session_start();
?>
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

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
				//To switch directions up/down and left/right just place a "-" in front of the top/left attribute
				//Caption Sliding (Partially Hidden to Visible)
				$('.boxgrid.caption').hover(function(){
					$(".cover", this).stop().animate({top:'140px'},{queue:false,duration:200});
				}, function() {
					$(".cover", this).stop().animate({top:'165px'},{queue:false,duration:200});
				});
			});
</script>
<?php
require_once("admin/includes/conecta_bd.php");
?>
</head>

<body>

	<div id="geral"> <!-- in�cio div geral - engloba todo o site -->
    
    	<div id="topo"> <!-- in�cio div topo - marca + menu de navega��o -->
        
        	<ul>
                <li><a class="um" href="index.php">Home</a></li>
                <li><a class="dois" href="perfil.php">Perfil</a></li>
                <li><a class="tres" href="clientes.php">Clientes</a></li>
                <li><a class="quatro" href="galeria.php">Galerias</a></li>
                <li><a class="cinco" href="eventos.php">Eventos</a></li>
                <li><a class="sete" href="imprensa.php">Imprensa</a></li>
                <li><a class="oito" href="contato.php">Contato</a></li>
            </ul>
            
            <h1>NBastian Fotografia | Comunica&ccedil;&atilde;o</h1>
            
        
        </div> <!-- fim div topo -->
        
        <div class="galeria"> <!-- inicio div galeria -->
                    
            <h2 class="exposicoes">Exposi&ccedil;&otilde;es</h2>
            <div class="box">
            <?php
            $rs = mysqli_query($conn, "SELECT * FROM eventos WHERE tipo_evento='2' ORDER BY dt_evento DESC");
            while($evento = mysqli_fetch_array($rs, MYSQLI_BOTH))
            {
                $rs1 = mysqli_query($conn, "SELECT caminho_foto FROM fotos_eventos WHERE cd_evento='{$evento['cd_evento']}' ORDER BY cd_foto ASC LIMIT 1");
                list($foto) = mysqli_fetch_array($rs1, MYSQLI_BOTH);
            ?>
            	<div class="boxgrid caption">

				<img src="admin/includes/phpThumb/phpThumb.php?src=../../../<?php echo $foto;?>&w=280" />
				<div class="cover boxcaption">
                    <h3><a href="dados-evento.php?cd=<?php echo $evento['cd_evento'];?>" rel="shadowbox;height=750;width=600"><?php echo htmlentities($evento['nm_evento']);?></a></h3>
					<p><a href="dados-evento.php?cd=<?php echo $evento['cd_evento'];?>" rel="shadowbox;height=750;width=600" ><?php echo implode("/",array_reverse(explode("-",$evento['dt_evento'])));?></a></p>
				</div>
				</div>
           <?php
           }
           ?>
           <br clear="left" />
                
                
            
          </div><br clear="left" />
                        
        </div> <!-- fim div galeria -->
    
    </div> <!-- fim div geral -->
    
	<div id="rodape"> <!-- div rodape -->
    	
  		<div id="patrocinadores"> <!-- div patrocinadores -->
            
            <img src="imagens/patrocinadores/tupy.gif" />
            <img src="imagens/patrocinadores/prefeitura.gif" />
            <img src="imagens/patrocinadores/gabivel.gif" />
            <img src="imagens/patrocinadores/fundacao.gif" />
            <img src="imagens/patrocinadores/bolshoi.gif" />
            
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
