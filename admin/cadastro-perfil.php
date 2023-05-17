<?php
session_start();
session_name("admin");

require("includes/verifica_sessao.php");
require("includes/conecta_bd.php");



//Carrega os dados para fazer a edi��o. Se for o caso
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

<title>NBastian Fotografia | Comunica&ccedil;&atilde;o - Admin</title>

<style type="text/css">

<!--

	

-->

</style>

<script type="text/javascript" src="includes/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
	theme : "advanced",
	mode : "textareas",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	plugins : "paste,directionality,table,advimage,advlink,searchreplace,preview,layer,contextmenu",
	theme_advanced_resizing : true,

	theme_advanced_buttons1 : '|,bold,italic,underline,strikethrough,|,justifyleft,justifyright,justifyfull,|,table,ltr,rtl,|,removeformat,search,replace,charmap, preview',
		theme_advanced_buttons2 : 'cut,copy,paste,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,|,forecolor,backcolor,|,code',
		theme_advanced_buttons3 : '',
		theme_advanced_buttons4 : '',

	relative_urls : false,

    imagemanager_insert_template : '<img src="{$url}" />'

});
</script>

<script type="text/javascript" src="includes/mascara_data.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>

<script type="text/javascript" src="../js/jquery.maskedinput-1.2.2.js"></script>

<script type="text/javascript" charset="utf-8">

jQuery(function($){
   $("#dt_evento").mask("99/99/9999");
});
</script>

<script type="text/javascript">
<!--
function excluir(aURL)
{
    if(confirm("Voc� tem certeza que deseja apagar esse registro?"))
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

		

			<h3>NBastian - Admin</h3>

			

			<ul id="menu">

				

                 <li><a href="../includes/inc_logout.php" title="Sair da &aacute;rea de administra&ccedil;&atilde;o">Sair</a></li>

				 <li><a href="principal.php" title="Voltar a p&aacute;gina principal">Principal</a></li>


			</ul>

		

		</div> <!-- /topo -->

		

		

		<div id="conteudo"> <!-- conteudo -->

			

			<div id="local"> <!-- local -->

				<h6>Usu&aacute;rio: <?php echo $_SESSION['nm_usuario'];?></h6>

			</div> <!-- /local -->

			

			<h5><a href="principal.php" title="Voltar para p&aacute;gina principal">&raquo;  Principal</a> &raquo; Cadastro de Perfil de Colaboradores</h5>

			

			<div id="miolo">
			

				<h4>&raquo; Cadastro de Perfil de Colaboradores</h4>

				

				<form name="form1" id="form1" method="post" action="perfilc-action.php" enctype="multipart/form-data">

					<fieldset>

                 <?php
                 if(isset($_GET['tipo']) && $_GET['tipo'] == "edit")
                 {
                 ?>
                    
                    	<label for="texto">Texto:</label>


                        <textarea name="texto" id="texto" tabindex="7" rows="20" cols="40" class="txt" title="" ><?php echo $var['de_conteudo'];?></textarea>
					<br />


					
                  <?php
                    if(!empty($var['caminho_foto']) && file_exists('../'.$var['caminho_foto']))
                        echo '<img src="../'.$var['caminho_foto'].'" alt="" width="170" height="188" /><br /><br />';
					?>

                        <label for="foto1">Foto :</label>

						<input class="txt" name="foto[]" type="file" id="foto1" size="43"  tabindex="8" title="Selecione a Foto" />

					    <br />

                   <?
                   }


                    // "Define" o tipo da a��o do formul�rio
                    if(isset($_GET['tipo']) && $_GET['tipo'] == "edit")
                    {
                        echo '<input type="hidden" id="acao" name="acao" value="edita">';
                        echo '<input type="hidden" name="cd" id="cd" value="'.$codigo.'"/>';
                    }
                    else
                    {
                        echo '<input type="hidden" id="acao" name="acao" value="cadastra">';
                    }



                 if(isset($_GET['tipo']) && $_GET['tipo'] == "edit")
                 {
                 ?>


					<input class="botao" type="submit" name="cadastrar" id="cadastrar" value="Enviar" tabindex="12" title="Enviar cadastro" />

						

                    <!--<input class="botaovoltar" type="submit" name="cadastrar" id="cadastrar" value="Voltar" tabindex="10" title="Voltar p&aacute;gina" />-->

					<input class="botaovoltar" type="button" name="cadastrar" id="cadastrar" value="Voltar" title="Voltar p&aacute;gina" tabindex="13" onClick="history.back();" />

                <?php
                }
                ?>

                	</fieldset>

				

				</form>

				
                <br />

                <h4>&raquo; Listagem de Perfil de Colaboradores</h4>

                <table>

				<thead>
					<tr>


						<th width="50%" scope="col">Texto</th>
						<th width="15%" scope="col">Data �ltima Atualza��o</th>
						<th width="15%" scope="col">Editar</th>
                       <!-- <th width="15%" scope="col">Excluir</th>-->

					</tr>
				</thead>

				<tbody>
                <?php
                //Listagem de Websites
                
                $rs1 = mysqli_query($conn, "SELECT * FROM perfil WHERE tipo_perfil='2' ORDER BY cd_perfil ASC");
                while($dados = mysqli_fetch_array($rs1, MYSQLI_BOTH))
                {
                
                    //$linkExc = "excluir.php?tp=eve&cd=".$dados['cd_evento'];
                ?>

					<tr>


						<td class="top"><?php echo substr(strip_tags($dados['de_conteudo']),0, 110).' ...';?></td>
						<td class="top"><?php echo date("d/m/Y - H:i:s",$dados['dt_ultima']);?></td>


                        <td class="top"><a href="cadastro-perfil.php?tipo=edit&cd=<?php echo $dados['cd_perfil'];?>" ><img src="img/botoes/outro.gif" title="Editar?" /></a></td>
                        <!--<td class="top"><a href="#" onclick="excluir('<?php echo $linkExc;?>')" ><img src="img/botoes/bt_excluir.gif" title="Excluir ?" /></a></td>-->

					</tr>
                <?php
                }
                ?>
				</tbody>
				</table>

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
