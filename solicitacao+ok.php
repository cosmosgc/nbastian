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
<meta name="author" content="Nbastian Fotografia comunicação" />
<meta name="copyright" content="NBastian" />
<meta name="robots" content="index, follow" />
<meta http-equiv="reply-to" content="nilsonbastian@me.com" />

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

	<div id="geral"> <!-- início div geral - engloba todo o site -->
    
    	<?php require_once("includes/menu_bar.php"); ?>
        
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
    
	<?php require_once("includes/rodape.php"); ?>

</body>
</html>
<?php
unset($_SESSION['carrinho']);
?>
