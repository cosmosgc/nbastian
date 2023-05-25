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
<meta name="author" content="EversonJP / Agência P4" />
<meta name="copyright" content="NBastian" />
<meta name="robots" content="index, follow" />
<meta http-equiv="reply-to" content="nbastian@nbastian.com" />

<title>NBastian Fotografia | Comunica&ccedil;&atilde;o</title>
<link href="geral.css" rel="stylesheet" type="text/css" />



<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
<?php
if($_REQUEST['cat'] == 8)
{
?>

$(document).ready(function(){
				//To switch directions up/down and left/right just place a "-" in front of the top/left attribute
				//Caption Sliding (Partially Hidden to Visible)
				$('.boxgrid.caption').hover(function(){
					$(".cover", this).stop().animate({top:'110px'},{queue:false,duration:200});
				}, function() {
					$(".cover", this).stop().animate({top:'165px'},{queue:false,duration:200});
				});
			});

<?php
}
else
{
?>

$(document).ready(function(){
				//To switch directions up/down and left/right just place a "-" in front of the top/left attribute
				//Caption Sliding (Partially Hidden to Visible)
				$('.boxgrid.caption').hover(function(){
					$(".cover", this).stop().animate({top:'140px'},{queue:false,duration:200});
				}, function() {
					$(".cover", this).stop().animate({top:'165px'},{queue:false,duration:200});
				});
			});

<?php
}
?>


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

.box h4{
	padding: 10px;
	height: 48px;
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
                <li><a class="quatro on4" href="galeria.php">Galerias</a></li>
                <li><a class="cinco" href="eventos.php">Eventos</a></li>
                <li><a class="sete" href="imprensa.php">Imprensa</a></li>
                <li><a class="oito" href="contato.php">Contato</a></li>
            </ul>
            
            <h1><a href="index.php">NBastian Fotografia | Comunica&ccedil;&atilde;o</a></h1>
            
        
        </div> <!-- fim div topo -->
        
        <div id="galerias" class="galeria"> <!-- inicio div galeria -->
                    
            <h2 class="galeria">Galerias</h2>
            <div class="box">

                <?php
                $cat = isset($_GET['cat']) ? intval($_GET['cat']) : "";
                $rs = mysqli_query($conn, "SELECT nm_categoria FROM categorias WHERE cd_categoria='$cat'");
                list($categoria) = mysqli_fetch_array($rs, MYSQLI_BOTH);
                ?>
            	<h4><a href="solicitacao.php" title="Visualizar carrinho de solicitações"><img src="imagens/bt+categorias.png" /></a><span>Categoria:</span><?php echo htmlentities(strtoupper($categoria));?></h4>
            

            

                <?php
                $rs = mysqli_query($conn, "SELECT COUNT(*) FROM galerias WHERE cd_categoria='$cat'");
                list($total) = mysqli_fetch_array($rs, MYSQLI_BOTH);
                if(!$total)
                    echo '<p>Nenhuma Galeria Cadastrada</p>';
                
                
            $rs = mysqli_query($conn, "SELECT * FROM galerias WHERE cd_categoria='$cat' ORDER BY dt_galeria DESC, nm_galeria ASC");
            while($evento = mysqli_fetch_array($rs, MYSQLI_ASSOC))
            {
                //conta as fotos
                $rs1 = mysqli_query($conn, "SELECT COUNT(*) FROM fotos_galeria WHERE cd_galeria='{$evento['cd_galeria']}'");
                list($total) = mysqli_fetch_array($rs1, MYSQLI_BOTH);
                
                //conta as fotos inativas
                $rs1 = mysqli_query($conn, "SELECT COUNT(*) FROM fotos_galeria WHERE cd_galeria='{$evento['cd_galeria']}' AND ativo='0'");
                list($inativas) = mysqli_fetch_array($rs1, MYSQLI_BOTH);
                
                //mostra a galeria que tiver mais fotos ativas do que ativas
                if($total > $inativas)
                {
                    $rs1 = mysqli_query($conn, "SELECT caminho_foto FROM fotos_galeria WHERE cd_galeria='{$evento['cd_galeria']}' AND ativo='1' ORDER BY cd_foto ASC LIMIT 1");
                    list($foto) = mysqli_fetch_array($rs1, MYSQLI_BOTH);
            ?>
            	<div class="boxgrid caption">
				<img src="admin/includes/phpThumb/phpThumb.php?src=../../../<?php echo $foto;?>&w=280&h=200&zc=1" />
                <a href="galeria+interna.php?cd=<?php echo $evento['cd_galeria'];?>" >
                <div class="cover boxcaption">
					<h3><?php echo htmlentities($evento['nm_galeria']);?></h3>
                    <?php
                    if($evento['cd_categoria'] == 8)
                    {
                    ?>
                    <p><?php echo implode("/",array_reverse(explode("-",$evento['dt_galeria'])));?><br />
                     Local: <?php echo $evento['local'];?><br /><?php if(empty($evento['tempo_duracao'])) echo'<br />'; else echo 'Duração: '.$evento['tempo_duracao'];?>
                    </p>
                    <?php
                    }
                    else
                    {
                    ?>
                    <p><?php echo implode("/",array_reverse(explode("-",$evento['dt_galeria'])));?></p>
                    <?php
                    }
                    ?>

				</div>
				</a>
				</div>
           <?php
                }//fim if
           }//fim while
           ?>

               <div id="boxe"></div>
               <br clear="left" />
          </div>
          <a href="galeria.php" title="Voltar para galerias"><img src="imagens/bot_voltargalerias.jpg" /></a>
          <br clear="left" />
                        
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
