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
<script type="text/javascript">
$(document).ready(function(){
				//To switch directions up/down and left/right just place a "-" in front of the top/left attribute
				//Caption Sliding (Partially Hidden to Visible)
				$('.boxgrid.caption').hover(function(){
					$(".cover", this).stop().animate({top:'110px'},{queue:false,duration:200});
				}, function() {
					$(".cover", this).stop().animate({top:'165px'},{queue:false,duration:200});
				});
			});
</script>

<link rel="stylesheet" type="text/css" href="shadowbox-source-3.0b/shadowbox.css">
<script type="text/javascript" src="shadowbox-source-3.0b/adapter/shadowbox-jquery.js"></script>
<script type="text/javascript" src="shadowbox-source-3.0b/shadowbox.js"></script>
<script type="text/javascript">
Shadowbox.init({
language:   "pt-BR",
players:    ["iframe"]

});

</script>

<!--[if IE]>
<script src="js/DD_belatedPNG.js" type="text/javascript"></script>
<script>
  /* Exemplo de utilizacao */
  DD_belatedPNG.fix('#topo, a, .eventos, .expo, h5, #patrocinadores, img');
</script>

<style type="text/css">
#boxe{
    clear: both;
}

</style>

<![endif]-->

<?php
require_once("admin/includes/conecta_bd.php");
?>
</head>

<body>

	<div id="geral"> <!-- início div geral - engloba todo o site -->
    
    	<div id="topo"> <!-- início div topo - marca + menu de navegação -->
        
        	<ul>
                <li><a class="um" href="index.php">Home</a></li>
                <li><a class="dois" href="perfil.php">Perfil</a></li>
                <li><a class="tres" href="clientes.php">Clientes</a></li>
                <li><a class="quatro" href="galeria.php">Galerias</a></li>
                <li><a class="cinco on5" href="eventos.php">Eventos</a></li>
                <li><a class="seis" href="noticias.php">Noticias</a></li>
                <li><a class="sete" href="imprensa.php">Imprensa</a></li>
                <li><a class="oito" href="contato.php">Contato</a></li>
            </ul>
            
            <h1><a href="index.php">NBastian Fotografia | Comunica&ccedil;&atilde;o</a></h1>
            
        
        </div> <!-- fim div topo -->
        
        <div class="galeria"> <!-- inicio div galeria -->
                    
            <h2 class="eventos">eventos</h2>
            <div class="box">
            <?php
            $rs = mysql_query("SELECT COUNT(*) FROM eventos ");
            list($total) = mysql_fetch_array($rs);
            if(!$total)
                echo '<p>Nenhum Evento Cadastrado</p>';



            $rs = mysql_query("SELECT * FROM eventos ORDER BY dt_evento DESC, nm_evento ASC");
            while($evento = mysql_fetch_array($rs))
            {
                $rs1 = mysql_query("SELECT caminho_foto FROM fotos_eventos WHERE cd_evento='{$evento['cd_evento']}' ORDER BY cd_foto ASC LIMIT 1");
                list($foto) = mysql_fetch_array($rs1);
                
                $rs1 = mysql_query("SELECT COUNT(*) FROM fotos_eventos WHERE cd_evento='{$evento['cd_evento']}'");
                list($total) = mysql_fetch_array($rs1);

                //conta as fotos inativas
                $rs1 = mysql_query("SELECT COUNT(*) FROM fotos_eventos WHERE cd_evento='{$evento['cd_evento']}' AND ativo='0'");
                list($inativas) = mysql_fetch_array($rs1);

                //mostra a galeria que tiver mais fotos ativas do que ativas
                if($total > $inativas)
                {
                
            ?>
            	<div class="boxgrid caption">

				<img src="admin/includes/phpThumb/phpThumb.php?src=../../../<?php echo $foto;?>&w=280&h=200&zc=1" />

                <a href="dados-evento.php?cd=<?php echo $evento['cd_evento'];?>" rel="shadowbox;height=505;width=640">
                <div class="cover boxcaption">
					<h3><?php echo htmlentities($evento['nm_evento']);?></h3>
                    <p><?php echo implode("/",array_reverse(explode("-",$evento['dt_evento'])));?><br />
                     Local: <?php echo $evento['local'];?><br /><?php if(empty($evento['tempo_duracao'])) echo'<br />'; else echo 'Duração: '.$evento['tempo_duracao'];?></p>
				</div></a>
				</div>
           <?php
                }//if
           }//while
           ?>
           <div id="boxe"></div>
           <br clear="left" />
                
                
            
          </div><br clear="left" />
                        
        </div> <!-- fim div galeria -->
    
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
