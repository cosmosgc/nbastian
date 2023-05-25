<?php
session_name("site");
session_start();

require_once("admin/includes/conecta_bd.php");

$pgSize = 36;
$cd = isset($_GET['cd']) ? intval($_GET['cd']) : "";
$pg = isset($_GET['pg']) ? intval($_GET['pg']) : 1;

$rs1 = mysqli_query($conn,"SELECT cd_categoria FROM galerias WHERE cd_galeria='$cd'");
list($cat) = mysqli_fetch_array($rs1, MYSQLI_BOTH);

$rs = mysqli_query($conn,"SELECT COUNT(*) FROM fotos_galeria WHERE cd_galeria='$cd'");
list($total) = mysqli_fetch_array($rs, MYSQLI_BOTH);
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

<link rel="stylesheet" type="text/css" href="shadowbox-source-3.0b/shadowbox.css">
<script type="text/javascript" src="shadowbox-source-3.0b/adapter/shadowbox-jquery.js"></script>
<script type="text/javascript" src="shadowbox-source-3.0b/shadowbox.js"></script>

<script type="text/javascript">
Shadowbox.init({
language:   "pt-BR",
players:    ["iframe"],
page: <?php echo $pg ?>,
pageSize: <?php echo $pgSize ?>,
totalOfImages: <?php echo $total ?>
});

</script>

<script type="text/javascript">


function adicionaImagem(cdFoto)
{
    //alert(cdFoto);
    $.get('adiciona-foto.php',{tipo:"galeria", acao:"adiciona", cd_foto: cdFoto});

    return $.jGrowl('Foto adicionada com sucesso',{
                        header: 'Solicita&ccedil;&atilde;o de Fotos',
                        life: 1500,
                        position: 'top-right'
                    });

}
</script>

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
        
        <div class="galeria" id="apple"> <!-- inicio div galeria -->
                    
            <h2 class="galeria">Galerias</h2>
            <div class="box">

                <?php

                $rs = mysqli_query($conn,"SELECT nm_galeria FROM galerias WHERE cd_galeria='$cd'");
                list($nm_galeria) = mysqli_fetch_array($rs, MYSQLI_BOTH);
                ?>
            	<h4><a href="solicitacao.php" title="Visualizar carrinho de solicitações"><img src="imagens/bt+categorias.png" /></a><span>Galeria:</span><?php echo htmlentities(strtoupper($nm_galeria));?></h4>
            

            

                <?php

            $inicial = ($pg-1)*$pgSize;
            $rs = mysqli_query($conn, "SELECT * FROM fotos_galeria WHERE cd_galeria='$cd' AND ativo='1' ORDER BY cd_foto ASC LIMIT $inicial,$pgSize");
            while($evento = mysqli_fetch_array($rs, MYSQLI_BOTH))
            {


            ?>
            	<div class="boxgridFoto">
				    <a href="foto-galeria.php?cd=<?php echo $cd;?>&cd_foto=<?php echo $evento['cd_foto'];?>" rel="shadowbox[Mixed];height=500;width=640"><img src="admin/includes/phpThumb/phpThumb.php?src=../../../<?php echo $evento['caminho_foto'];?>&w=120&h=88&zc=1" rel="#photo<?php echo $evento['cd_foto'];?>"/></a>
				</div>
           <?php

           }//fim while
           ?>

               <div id="boxe"></div>
               <br clear="left" />
               


          </div>
          

          
          <a href="galeria+categoria.php?cat=<?php echo $cat;?>" title="Voltar para galerias"><img src="imagens/bot_voltargalerias.jpg" /></a>

          <?php
          $total = ceil($total/$pgSize);
          
          if(($pg+1) <= $total)
            echo '<a href="galeria+interna.php?cd='.$cd.'&pg='.($pg+1).'" title="Pr&oacute;xima P&aacute;gina" class="direitaPag"><img src="imagens/bot_proxima.jpg" /></a>';

          if($pg > 1)
            echo '<a href="galeria+interna.php?cd='.$cd.'&pg='.($pg-1).'" title="P&aacute;gina Anterior" class="direitaPag"><img src="imagens/bot_anterior.jpg" /></a>';

          ?>
          <br clear="all" />
                        
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
