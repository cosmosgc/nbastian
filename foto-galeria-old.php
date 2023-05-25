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
<meta name="author" content="EversonJP / Agência P4" />
<meta name="copyright" content="NBastian" />
<meta name="robots" content="index, follow" />
<meta http-equiv="reply-to" content="nbastian@nbastian.com" />

<title>NBastian Fotografia | Comunica&ccedil;&atilde;o</title>

<style type="text/css">
<!--
*{
    border: none;
}

body{
    background: #000 url(imagens/ajax-loader.gif) center center no-repeat;
}

p{
    color:#ccc;
	font: 11px Arial, Helvetica, sans-serif;
	margin: 5px;
	padding: 2px 0;
}

p strong{
	color: #ccc;
	font: bold 14px Arial, Helvetica, sans-serif;
}

p span.left{
    width: 300px;
    float: left;
    margin-top: 10px;
}

p span.right{
    float:right;
    margin-top: 5px;
}
-->
</style>

<link rel="stylesheet" href="js/jquery.jgrowl.css" type="text/css"/>

<link rel="stylesheet" href="js/galleryview.css" type="text/css"/>



<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="jquery-galleryview-1.1/jquery.galleryview-1.11.js"></script>
<script type="text/javascript" src="jquery-galleryview-1.1/jquery.timers-1.1.2.js"></script>

<script type="text/javascript" src="js/jquery.jgrowl.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#photos').galleryView({
            panel_width: 600,
			panel_height: 400,
			frame_width: 100,
			frame_height: 75,
			filmstrip_size: 5,
			transition_interval: 0,
			transition_speed: 1200,
			background_color: 'transparent',
			border: 'none',
			easing: 'easeInOutBack',
			nav_theme: 'light',
			pause_on_hover: true,
			overlay_height: 80

		});
	});

function adicionaImagem(cdFoto)
{
    //alert(cdFoto);
    $.get('adiciona-foto.php',{tipo:"galeria", acao:"adiciona", cd_foto: cdFoto});

    return $.jGrowl('Foto adicionada com sucesso',{
                        header: 'Solicita&ccedil;&atilde;o de Fotos',
                        life: 1500
                    });

}
</script>



</head>

<body>
<div id="gallery_wrap" style="margin: 0 20px;" >
<div id="polaroid_overlay" style="height:10px;">&nbsp;</div>
<div id="photos" class="galleryview">
<div id="photoStrip">
    <img src="imagens/foto.gif" alt="" width="600" height="320" />
</div>
<?php
$cd = isset($_GET['cd']) ? intval($_GET['cd']) : "";
$cd_foto = isset($_GET['cd_foto']) ? intval($_GET['cd_foto']) : "";
$rs1 = mysqli_query($conn, "SELECT cd_categoria FROM galerias WHERE cd_galeria='$cd'");
list($cd_cat) = mysqli_fetch_array($rs1, MYSQLI_BOTH);

$rs1 = mysqli_query($conn, "SELECT venda FROM categorias WHERE cd_categoria='$cd_cat'");
list($pode_vender) = mysqli_fetch_array($rs1, MYSQLI_BOTH);


$rs = mysqli_query($conn, "SELECT * FROM fotos_galeria WHERE cd_foto='$cd_foto' AND ativo='1' ORDER BY cd_foto ASC");
while($foto1 = mysqli_fetch_array($rs, MYSQLI_BOTH))
{

    echo '<div class="panel" style="text-align: center; "><img src="'.$foto1['caminho_foto'].'" alt="" />
        <div class="panel-overlay">
  		<p style="text-align: left; ">

          <span class="left">
          <strong>Voc&ecirc; pode solicitar a compra dessa foto.</strong> <br />Adicione-a ao carrinho ou clique para ver  todas as solicita&ccedil;&otilde;es j&aacute; feitas.
          </span>

           <span class="right">';


      if($pode_vender)
      {
            echo '<a onclick="adicionaImagem(\''.$foto1['cd_foto'].'\');" href="javascript:void(0);">
                <img src="imagens/adicionar_carrinho.gif" alt="" />
            </a>
            <br /><br />';
      }
      echo '
            <a href="solicitacao.php" target="_parent">
                <img src="imagens/ver_carrinho.gif" alt="" />
            </a>
          </span>


          </p>
	</div>
</div>';

}
?>




<!--
<ul class="filmstrip">
<?php
/*
$rs = mysqli_query($conn, "SELECT * FROM fotos_galeria WHERE cd_galeria='$cd' AND ativo='1' ORDER BY cd_foto ASC");
while($foto1 = mysqli_fetch_array($rs, MYSQLI_BOTH))
{

    echo '<li><img src="admin/includes/phpThumb/phpThumb.php?src=../../../'.$foto1['caminho_foto'].'&w=100&h=75&zc=1" alt="" /></li>';

}
*/
?>

</ul>
-->

</div>
</div>
</body>
</html>

