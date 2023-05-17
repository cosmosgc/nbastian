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

#contato #ok{
    width: 460px;
}


</style>
<![endif]-->
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
                <li><a class="oito on8" href="contato.php">Contato</a></li>
            </ul>
            
            <h1><a href="index.php">NBastian Fotografia | Comunica&ccedil;&atilde;o</a></h1>
            
        
        </div> <!-- fim div topo -->
        
        <div id="contato"> <!-- inicio div contato -->
                    
            <h2 class="solicitacao">Colicita&ccedil;&atilde;o de Fotos</h2>
            <div class="box">
            
            	<div id="engloba">
                <div id="solicita">
                
               	  <h6>Fotos selecionadas:</h6>
                  
                  <ul>
                   <?php
                      $rs = mysqli_query($conn, "SELECT COUNT(*) FROM carrinho_itens WHERE cd_carrinho='".$_SESSION['carrinho']."' ");
                        list($total) = mysqli_fetch_array($rs, MYSQLI_BOTH);
                        if(!$total)
                            echo '<p>Nenhuma Foto Selecionada</p>';
                            
                            
                      $rs = mysqli_query($conn, "SELECT * FROM carrinho_itens WHERE cd_carrinho='".$_SESSION['carrinho']."' ORDER BY cd_item ASC");
                      while($var = mysqli_fetch_array($rs, MYSQLI_BOTH))
                      {
                        if($var['tp_foto'] == "galeria")
                        {
                            $rs1 = mysqli_query($conn, "SELECT caminho_foto FROM fotos_galeria WHERE cd_foto='{$var['cd_foto']}'");
                            list($foto) = mysqli_fetch_array($rs1, MYSQLI_BOTH);
                        }
                        elseif($var['tp_foto'] == "evento")
                        {
                            $rs1 = mysqli_query($conn, "SELECT caminho_foto FROM fotos_eventos WHERE cd_foto='{$var['cd_foto']}'");
                            list($foto) = mysqli_fetch_array($rs1, MYSQLI_BOTH);
                        }
                        elseif($var['tp_foto'] == "expo")
                        {
                            $rs1 = mysqli_query($conn, "SELECT caminho_foto FROM fotos_eventos WHERE cd_foto='{$var['cd_foto']}'");
                            list($foto) = mysqli_fetch_array($rs1, MYSQLI_BOTH);
                        }

                      ?>
                        <li>
                    	   <img src="admin/includes/phpThumb/phpThumb.php?src=../../../<?php echo $foto;?>&w=67&h=67&zc=1" />
                            <a onclick="removeImagem('<?php echo $var['cd_item'];?>','');" href="javascript:void(0);">Remover</a>
                        </li>
                    <?php
                    }
                    ?>
                  </ul><br clear="left" />
                  
                  </div>
                  </div>
                
                <div id="ok">
                
                	<img src="imagens/bt+ok.gif" />
                    
                    <h6>SEU PEDIDO DE FOTOS FOI<span>REALIZADO COM SUCESSO!</span></h6>
                
                	<p>Aguarde nosso contato em breve, onde informaremos como realizar o download das fotos em alta resolu&ccedil;&atilde;o.</p>
                	<p>Agradecemos desde j&aacute; seu interesse e estamos a disposi&ccedil;&atilde;o para mais esclarecimentos.</p>
           	  </div>
                 <div id="boxe"></div>
                 <br clear="left" />

            </div>
				
            <hr />    
                                        
        </div> <!-- fim div contato -->
    
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
<?php
unset($_SESSION['carrinho']);
?>
