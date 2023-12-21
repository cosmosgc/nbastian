<?php
session_name("site");
session_start();
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

<script type='text/javascript' src='js/jquery.tipsy.js'></script>
<link rel="stylesheet" href="stylesheets/tipsy.css" type="text/css" />


<script type="text/javascript">
$(function() {

       $('div.box ul li').tipsy({gravity: 'n',fade: true});

  });

</script>

<!--[if IE]>
<script src="js/DD_belatedPNG.js" type="text/javascript"></script>
<script>
  /* Exemplo de utilizacao */
  DD_belatedPNG.fix('#topo, a, .eventos, .expo, h5, #patrocinadores');
</script>

<style type="text/css">
#clientes ul li{
	float: left;
	margin: 5px 10px;
}

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
    
    <?php require_once("includes/menu_bar.php"); ?>
        
        <div id="clientes"> <!-- inicio div clientes -->
                    
            <h2 class="title">Clientes</h2>
            <div class="box">
                <?php
                $rs1 = mysqli_query($conn, "SELECT * FROM clientes ORDER BY nm_cliente ASC") or die(mysqli_connect_error());
                while ($clientes = mysqli_fetch_array($rs1, MYSQLI_ASSOC)) {
                ?>
                    <div class="client-box" title="<?php echo $clientes['de_conteudo'];?>">
                        <img src="<?php echo $clientes['caminho_foto'];?>" alt="<?php echo $clientes['nm_cliente'];?>" width="160" height="130" />
                    </div>
                <?php
                }
                ?>
                <div id="boxe"></div>
                <br clear="left" />
            </div>

            <br clear="left" />
                        
        </div> <!-- fim div clientes -->
    
    </div> <!-- fim div geral -->
    
	<?php require_once("includes/rodape.php"); ?>
    
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
