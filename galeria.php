<?php
session_name("site");
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="generator" content="www.nbastian.com.br" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="url" content="http://www.nbastian.com.br" />
<meta name="document-classification" content="Fotografia e Comunicação" />
<meta name="language" content="pt-br" />
<meta name="rating" content="General" />
<meta name="revisit-after" content="daily" />
<meta name="author" content="Nbastian Fotografia comunicação" />
<meta name="copyright" content="NBastian" />
<meta name="robots" content="index, follow" />
<meta http-equiv="reply-to" content="nilsonbastian@mac.com" />

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
</head>

<body>

	<div id="geral"> <!-- início div geral - engloba todo o site -->
    
    <?php require_once("includes/menu_bar.php"); ?>
        
        <div id="galerias" class="galeria"> <!-- inicio div galeria -->
                    
            <h2 class="galeria">Galerias</h2>
            <div class="box">
                <div id="boxe"></div>
                <?php
                $rs = mysqli_query($conn, "SELECT * FROM categorias ORDER BY nm_categoria ASC");
                while($var = mysqli_fetch_array($rs, MYSQLI_ASSOC))
                {
                ?>
                <div class="boxgrid caption">
                <img src="admin/includes/phpThumb/phpThumb.php?src=../../../<?php echo $var['caminho_foto'];?>&w=280" />
				<a href="galeria+categoria.php?cat=<?php echo $var['cd_categoria'];?>">
                <div class="cover boxcaption">
					<h3><?php echo htmlentities(strtoupper($var['nm_categoria']));?></h3>
					<p>CLIQUE PARA VER OS EVENTOS</p>
				</div></a>
				</div>
                <?php
                }
                ?>
                <div id="boxe"></div>
                <br clear="left" />
                
                
            
          </div><br clear="left" />
                        
        </div> <!-- fim div galeria -->
    
    </div> <!-- fim div geral -->
    
	<?php require_once("includes/rodape.php"); ?>

</body>
</html>
