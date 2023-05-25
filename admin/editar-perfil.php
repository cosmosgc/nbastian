<?php
session_name("admin");
session_start();

require("includes/verifica_sessao.php");
require("includes/conecta_bd.php");



//Carrega os dados para fazer a edição. Se for o caso
if(isset($_GET['tipo']) && $_GET['tipo'] == "edit")
{
    $codigo = intval($_GET['cd']);
    $rs = mysqli_query($conn, "SELECT * FROM perfil WHERE cd_perfil='$codigo'");

    $var = mysqli_fetch_array($rs, MYSQLI_BOTH);
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Nbastian - Admin</title>

<style type="text/css">

<!--

	

-->

</style>

<script type="text/javascript" src="includes/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
	theme : "advanced",
	mode : "specific_textareas",
	elements : "texto",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	plugins : "filemanager,imagemanager,media,paste,directionality,table,advimage,advlink,searchreplace,preview",
	theme_advanced_resizing : true,
//	theme_advanced_buttons1_add_before : "insertfile,insertimage",
	theme_advanced_buttons1 : 'bold,italic,underline,strikethrough,|,justifyleft,justifyright,justifyfull,|,removeformat,search,replace,charmap, preview',
		theme_advanced_buttons2 : 'cut,copy,paste,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,|,forecolor,backcolor,|,code',
		theme_advanced_buttons3 : '',
		theme_advanced_buttons4 : '',
    //content_css : "<?php echo ROOT_DIR; ?>css/importa.css",
	//external_image_list_url : '<?php echo ROOT_DIR; ?>',
	relative_urls : false,
	//document_base_url : "<?php echo ROOT_DIR; ?>"
//	theme : "advanced",
//  invalid_elements : "strong,em"
//  cleanup_on_startup : true,
//  remove_trailing_nbsp : true,
//    forced_root_block : false,
//    force_br_newlines : true,
//    force_p_newlines : false,
////	convert_fonts_to_spans : true
});
</script>



<script type="text/javascript">
<!--
function excluir(aURL)
{
    if(confirm("Você tem certeza que deseja apagar esse registro?"))
    {
        location.href = aURL;
    }
}
-->
</script>

<link href="estilos/adm.css" rel="stylesheet" type="text/css" />
<link href="estilos/usuario.css" rel="stylesheet" type="text/css" />

</head>



<body>



	<div id="geral"> <!-- geral -->

	

		<div id="topo"> <!-- topo -->

		

			<h3>Nbastian - Admin</h3>

			

			<ul id="menu">

				

                 <li><a href="../includes/inc_logout.php" title="Sair da &aacute;rea de administra&ccedil;&atilde;o">Sair</a></li>

				 <li><a href="principal.php" title="Voltar a p&aacute;gina principal">Principal</a></li>


			</ul>

		

		</div> <!-- /topo -->

		

		

		<div id="conteudo"> <!-- conteudo -->

			

			<div id="local"> <!-- local -->

				<h6>Usu&aacute;rio: <?php echo $_SESSION['nm_usuario'];?></h6>

			</div> <!-- /local -->

			

			<h5><a href="principal.php" title="Voltar para p&aacute;gina principal">&raquo;  Principal</a> &raquo; Edi&ccedil;&atilde;o do perfil NBastian</h5>

			

			<div id="miolo">
			

				<h4>&raquo; Edi&ccedil;&atilde;o do perfil NBastian</h4>

				

				<form name="form1" id="form1" method="post" action="perfil-action.php" enctype="multipart/form-data">

					<fieldset>



                    
                    	<label for="texto">Texto:</label>


                        <textarea name="texto" id="texto" tabindex="7" rows="20" cols="40" class="txt" title="Corpo da Not&iacute;cia" ><?php echo $var['de_conteudo'];?></textarea>
					<br />


					
                    <?php
                    // "Define" o tipo da ação do formulário
                    if(isset($_GET['tipo']) && $_GET['tipo'] == "edit")
                    {
                        echo '<input type="hidden" id="acao" name="acao" value="edita">';
                        echo '<input type="hidden" name="cd" id="cd" value="'.$codigo.'"/>';
                    }
                    else
                    {
                        echo '<input type="hidden" id="acao" name="acao" value="cadastra">';
                    }
                    ?>

                    

					<input class="botao" type="submit" name="cadastrar" id="cadastrar" value="Salvar" tabindex="12" title="Salvar" />

						

                    <!--<input class="botaovoltar" type="submit" name="cadastrar" id="cadastrar" value="Voltar" tabindex="10" title="Voltar p&aacute;gina" />-->

					<input class="botaovoltar" type="button" name="cadastrasr" id="cadasstrar" value="Voltar" title="Voltar p&aacute;gina" tabindex="13" onClick="history.back();" />

					</fieldset>

				

				</form>

				
                <br />



			</div>

		

		</div> <!-- /conteudo -->

		

		<div id="rodape"> <!-- rodape -->

			

			<address>

				&reg; 2005-<?php echo date("Y");?> <a href="http://www.p4.inf.br" title="P4 Solu&ccedil;&otilde;es">P4 Solu&ccedil;&otilde;es Ltda</a>. Todos os direitos reservados.

			</address>

			

		</div> <!-- /rodape -->

	

	</div> <!-- /geral -->



</body>

</html>
