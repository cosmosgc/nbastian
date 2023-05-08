<?php
session_start();
session_name("admin");

require("includes/verifica_sessao.php");



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Tela Principal - NBastian</title>



<link href="estilos/usuario.css" rel="stylesheet" type="text/css" />





</head>



<body>

	

	<div id="geral"> <!-- geral -->

	

		<div id="topo"> <!-- topo -->

		

			<h3>NBastian - Admin</h3>

			

			<ul id="menu">

				

				<li><a href="logout.php" title="Sair da &aacute;rea restrita">Sair</a></li>

				<li><a href="principal.php" title="P&aacute;gina principal">Principal</a></li>



			</ul>

		

		</div> <!-- /topo -->

		

		

		<div id="conteudo"> <!-- conteudo -->

			

			<div id="local"> <!-- local -->

				

				<h6>Usu&aacute;rio: <?php echo $_SESSION['nm_usuario'];?></h6>

				

			</div> <!-- /local -->

			

			<h5>&raquo; Tela Principal</h5>

			

			

			<div id="menuNovo"> <!-- menu principal para navegação -->

			

				<ul>

					

					<li><a href="pedidos.php"><img src="img/icones/ico-apostila-virtual.gif" title="Pedidos" /><br />Pedidos</a></li>
					
					<li><a href="cadastro-patrocinadores.php"><img src="img/icones/ico-apostila-virtual.gif" title="Cadastro de patrocinadores" /><br />Patrocinadores</a></li>
					
					<li><a href="editar-perfil.php?cd=1&tipo=edit"><img src="img/icones/ico-apostila-virtual.gif" title="Perfil NBastian" /><br />Perfil NBastian</a></li>
					
					<li><a href="cadastro-perfil.php"><img src="img/icones/ico-mail.jpg" title="Cadastro de Perfil de Colaboradores" /><br />Perfil de Colaboradores</a></li>


                    <li><a href="cadastro-imagem.php"><img src="img/icones/ico-apostila-virtual.jpg" title="Cadastro de Imagem da Home" /><br />Imagem da Home</a></li>

                    
                    <li><a href="cadastro-clientes.php"><img src="img/icones/ico-mail.jpg" title="Cadastro de Clientes" /><br />Clientes</a></li>
                    
                    <li><a href="cadastro-noticias.php"><img src="img/icones/ico-mail.jpg" title="Cadastro de Not&iacute;cias" /><br />Not&iacute;cias</a></li>
                    
                    <li><a href="cadastro-categorias.php"><img src="img/icones/ico-apostila-virtual.jpg" title="Cadastro de Categorias" /><br />Categorias</a></li>

                    <li><a href="cadastro-galerias.php"><img src="img/icones/ico-apostila-virtual.jpg" title="Cadastro de Galerias" /><br />Galerias</a></li>
                    
                    <li><a href="cadastro-eventos.php"><img src="img/icones/ico-mail.jpg" title="Cadastro de Eventos" /><br />Eventos</a></li>
                    

                    
                    <li><a href="cadastro-usuarios-imprensa.php"><img src="img/icones/ico-mail.jpg" title="Cadastro de Usuário p/ Área da Imprensa" /><br />Usuário p/ Área da Imprensa</a></li>
                    
                    <li><a href="cadastro-fotos-imprensa.php"><img src="img/icones/ico-mail.jpg" title="Cadastro de Fotos p/ Área da Imprensa" /><br />Fotos p/ Área da Imprensa</a></li>
                    

                    <li><a href="cadastro-usuarios.php"><img src="img/icones/ico-mail.jpg" title="Cadastro de Usuários p/ Área Administrativa" /><br />Usuários p/ Área Administrativa</a></li>


				</ul>

				

				<br clear="left" />

			

			</div> <!-- fim do menu principal para navegação -->

			

			



						

		

		</div> <!-- /conteudo -->

		

	

	</div> <!-- /geral -->

	

	

	<div id="rodape"> <!-- rodape -->

			

		<address>

			

			<? include "includes/rodape.html"; ?>

			

		</address>

		

	</div> <!-- /rodape -->

	



</body>

</html>

