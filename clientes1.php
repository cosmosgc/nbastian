<?php
session_start();
session_name("site");
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
<script type="text/javascript" src="js/jquery.qtip-1.0.0-rc3.min.js"></script>

<script type="text/javascript">
$(document).ready(function()
{
   $('div.box ul li[title]').qtip({
      position: {
         corner: {
            target: 'bottomMiddle',
            tooltip: 'topMiddle'
         }
      },
      style: {
         name: 'dark',
         padding: '3px 7px',
         background: '#444444',
         font: '12px Arial',
         width: {
            max: 210,
            min: 0
         },
         border: {
            width: 3,
            radius: 8,
            color: '#444444'
        },
         tip: true
      }

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
                <li><a class="tres on" href="clientes.php">Clientes</a></li>
                <li><a class="quatro" href="galeria.php">Galerias</a></li>
                <li><a class="cinco" href="eventos.php">Eventos</a></li>
                <li><a class="seis" href="noticias.php">Noticias</a></li>
                <li><a class="sete" href="imprensa.php">Imprensa</a></li>
                <li><a class="oito" href="contato.php">Contato</a></li>
            </ul>
            
            <h1>NBastian Fotografia | Comunica&ccedil;&atilde;o</h1>
            
        
        </div> <!-- fim div topo -->
        
        <div id="clientes"> <!-- inicio div clientes -->
                    
            <h2 class="clientes">Clientes</h2>
            <div class="box">
            
            	<ul>
                    <?php
                    $rs1 = mysql_query("SELECT * FROM clientes ORDER BY nm_cliente ASC") or die(mysql_error());
                    while($clientes = mysql_fetch_array($rs1))
                    {
                    ?>
                    <li title="<?php echo $clientes['de_conteudo'];?>"><img src="<?php echo $clientes['caminho_foto'];?>" alt="<?php echo $clientes['nm_cliente'];?>" width="160" height="130" /></li>
                    <?php
                    }
                    ?>

                </ul><br clear="left" />
            
            </div><br clear="left" />
                        
        </div> <!-- fim div clientes -->
    
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

</body>
</html>
