<?php

session_name("site");
session_start();
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta charset="utf-8">
<meta name="generator" content="www.nbastian.com.br" />
<meta name="description" content="NBastian Fotografia e Comunicação - Nilson Bastian - Fotógrafo Profissional" />
<meta name="keywords" content="fotografo, joinville, fotógrafo, festival de dança, danca, bolshoi, escola do ballet bolshoi, balé, colunismo social, exposições, exposicoes, fotográficas, fotografica, fotojornalismo, Comunicação, comunicacao, nilson bastian, bastian" />
<meta name="url" content="http://www.nbastian.com.br" />
<meta name="document-classification" content="Fotografia e Comunicação" />
<meta name="language" content="pt-br" />
<meta name="rating" content="General" />
<meta name="revisit-after" content="daily" />
<meta name="author" content="Nbastian.com.br / Agéncia P4" />
<meta name="copyright" content="NBastian" />
<meta name="robots" content="index, follow" />
<meta http-equiv="reply-to" content="nilsonbastian@me.com" />
<meta name="google-site-verification" content="0ZqB4dqU8D7om5nQEzTiI76tPx0CK43xhYNp6bVRLFY" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>NBastian Fotografia | Comunica&ccedil;&atilde;o</title>
<link href="geral.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery.js"></script>

<!--[if IE 6]>
<script src="js/DD_belatedPNG.js" type="text/javascript"></script>
<script>
  /* Exemplo de utilizacao */
  DD_belatedPNG.fix('#topo, a, .eventos, .expo, h5, #patrocinadores');
</script>
<![endif]-->
  
<?php
require_once("admin/includes/conecta_bd.php");
?>
</head>

<body>

	<div id="geral"> <!-- início div geral - engloba todo o site -->
  
    	<?php require_once("includes/menu_bar.php"); ?>
        <link rel="stylesheet" href="css/swiper-bundle.min.css">
        <style>
            .swiper-container {
            width: 100%;
            height: 100%;
            max-height: 600px;
            }
            .swiper-slide {
            width: 90%;
            height: 100%;
            }
            .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            }
            @media (max-width: 767px) {
                /* Styles for screens with a maximum width of 767px (typical for mobile devices) */

                .swiper-container {
                    /* width: 100%; */
                    /* margin: 0 auto;*/
                }
            }
        </style>
        <div id="principal"> <!-- inicio div principal -->
        
        <div class="swiper-container" style="overflow: hidden;">
            <div class="swiper-wrapper" >
            <?php
            $rs1 = mysqli_query($conn, "SELECT * FROM imagens_home ORDER BY dt_cadastro ASC");
            while ($dados = mysqli_fetch_array($rs1, MYSQLI_ASSOC)) {
                echo '<div class="swiper-slide"><img src="' . $dados['caminho_foto'] . '" alt="Banner Image" /></div>
                ';
            }
            ?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <script src="js/swiper-bundle.min.js"></script>
        <script>
            var swiper = new Swiper('.swiper-container', {
                effect: "cube",
                grabCursor: true,
                cubeEffect: {
                    shadow: true,
                    slideShadows: true,
                    shadowOffset: 20,
                    shadowScale: 0.94,
                },
                centeredSlides: true,
                slidesPerView: "1",
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            keyboard: {
                enabled: true,
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            zoom: true,
            });
        </script>
            
            
            
        </div> <!-- fim div principal -->
        <div id="destaque"> <!-- inicio div destaque -->
            <? include 'jquery-galleryview-1.1//includes.php'; ?>
            
            	<ul class="destaques">
                
                    <li class="eventos">
                        <p class="title_p">EVENTOS</p>
                        <div>
                            <?php
                            $rs = mysqli_query($conn, "SELECT * FROM eventos WHERE tipo_evento='1' ORDER BY dt_evento DESC LIMIT 1");
                            $evento = mysqli_fetch_array($rs, MYSQLI_ASSOC);

                            if (!empty($evento)) {
                                $rs1 = mysqli_query($conn, "SELECT caminho_foto FROM fotos_eventos WHERE cd_evento='{$evento['cd_evento']}' ORDER BY cd_foto ASC LIMIT 1");
                                list($foto) = mysqli_fetch_array($rs1);

                                if (empty($foto)) {
                                    $foto = 'imagens/eventos/index1.jpg';
                                }
                                ?>
                                <img src="admin/includes/phpThumb/phpThumb.php?src=../../../<?php echo $foto; ?>&w=86&h=123&zc=1" />
                                <div>
                                    <h5><?php echo htmlentities($evento['nm_evento']); ?></h5>
                                    <p><?php echo substr(strip_tags($evento['descricao']), 0, 75); ?>...</p>
                                    <p>Data: <?php echo implode("/", array_reverse(explode("-", $evento['dt_evento']))); ?><br />Local: <?php echo $evento['local']; ?><br /><?php if (empty($evento['tempo_duracao'])) echo '<br />'; else echo 'Duração: ' . $evento['tempo_duracao']; ?></p>
                                    <p><a href="eventos.php">Veja todos os eventos</a></p>
                                </div>
                                
                            <?php
                            } else {
                                // Handle the case when the query result is empty
                                echo '<p>Sem eventos no momento.</p>';
                            }
                            ?>
                        </div>
                        
                    </li>

                    <li class="expo">
                        <p class="title_p">EXPOSIÇÕES</p>
                        <div>
                            <?php
                            $rs = mysqli_query($conn, "SELECT * FROM galerias WHERE cd_categoria='8' ORDER BY dt_galeria DESC LIMIT 1") or die(mysqli_connect_error());
                            $evento = mysqli_fetch_array($rs, MYSQLI_ASSOC);

                            if (!empty($evento)) {
                                $rs1 = mysqli_query($conn, "SELECT caminho_foto FROM fotos_galeria WHERE cd_galeria='{$evento['cd_galeria']}' ORDER BY cd_foto ASC LIMIT 1");
                                list($foto) = mysqli_fetch_array($rs1);

                                if (empty($foto)) {
                                    $foto = 'imagens/eventos/index1.jpg';
                                }
                                ?>
                                <img src="admin/includes/phpThumb/phpThumb.php?src=../../../<?php echo $foto; ?>&w=86&h=123&zc=1" />
                                <div>
                                    <h5><?php echo htmlentities($evento['nm_galeria']); ?></h5>
                                    <p><?php echo substr(strip_tags($evento['descricao']), 0, 75); ?>...</p>
                                    <p>Data: <?php echo implode("/", array_reverse(explode("-", $evento['dt_galeria']))); ?><br />Local: <?php echo $evento['local']; ?><br /><?php if (empty($evento['tempo_duracao'])) echo '<br />'; else echo 'Duração: ' . $evento['tempo_duracao']; ?></p>
                                    <p><a href="galeria+categoria.php?cat=8">Veja todas as exposições</a></p>
                                </div>
                            <?php
                            } else {
                                // Handle the case when the query result is empty
                                echo '<p>Sem exibições no momento.</p>';
                            }
                            ?>
                        </div>
                        
                    </li>

                
                </ul>
            
            </div> <!-- fim div destaque -->
    
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
