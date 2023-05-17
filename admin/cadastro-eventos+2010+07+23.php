<?php
session_start();
session_name("admin");

require("includes/verifica_sessao.php");
require("includes/conecta_bd.php");



//Carrega os dados para fazer a edi��o. Se for o caso
if(isset($_GET['tipo']) && $_GET['tipo'] == "edit")
{
    $codigo = intval($_GET['cd']);
    $rs = mysqli_query($conn, "SELECT * FROM eventos WHERE cd_evento='$codigo'");

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

			

			<h5><a href="principal.php" title="Voltar para p&aacute;gina principal">&raquo;  Principal</a> &raquo; Cadastro de Eventos/Exposi&ccedil;&otilde;es</h5>

			

			<div id="miolo">
			

				<h4>&raquo; Cadastro de Eventos/Exposi&ccedil;&otilde;es</h4>

				

				<form name="form1" id="form1" method="post" action="eventos-action.php" enctype="multipart/form-data">

					<fieldset>

                   <!--
                    <label for="tipo_trabalho">Tipo do Trabalho:</label>

                        <select name="tipo_trabalho" id="tipo_trabalho" title="Tipo do Trabalho" class="txt" tabindex="5">
                            <?php
                            $rs1 = mysqli_query($conn, "SELECT * FROM tipo_trabalho ORDER BY cd_tipo ASC");
                            while($tipo = mysqli_fetch_array($rs1, MYSQLI_BOTH))
                            {
                                if($var['tipo_evento'] == $tipo['cd_tipo'])
                                echo '<option value="'.$tipo['cd_tipo'].'" selected="true">'.$tipo['nm_tipo'].'</option>';
                                else
                                    echo '<option value="'.$tipo['cd_tipo'].'">'.$tipo['nm_tipo'].'</option>';
                            }
                            ?>
                        </select>

					<br />
					-->

                    <label for="nm_evento">Nome do Evento:</label>

						<input class="txt" name="nm_evento" type="text" id="nm_evento"  maxlength="255" tabindex="5" title="Nome do evento" value="<?php echo $var['nm_evento'];?>"/>


                    <br />
                    
                    <label for="dt_evento">Data do Evento:</label>

						<input class="txt" name="dt_evento" type="text" id="dt_evento"  maxlength="10" onblur="validaData(this, '1');" tabindex="5" title="Data do Evento" value="<?php echo implode("/",array_reverse(explode("-",$var['dt_evento'])));?>"/>


                    <br />
                    
                    <label for="tempo_duracao">Dura��o do Evento:</label>

						<input class="txt" name="tempo_duracao" type="text" id="tempo_duracao"  maxlength="100" tabindex="5" title="Dura��o do Evento" value="<?php echo $var['tempo_duracao'];?>"/>


                    <br />
                    
                    <label for="de_local">Local do Evento:</label>

						<input class="txt" name="local" type="text" id="de_local"  maxlength="255" tabindex="5" title="Local do evento" value="<?php echo $var['local'];?>"/>


                    <br />
                    
                    	<label for="texto">Texto Sobre o Evento:</label>


                        <textarea name="texto" id="texto" tabindex="7" rows="20" cols="40" class="txt" title="" ><?php echo $var['descricao'];?></textarea>
					<br />


					
                    <?php
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



                    for($x=1; $x<=10; $x++)
                    {
                    
                        echo '
                        <label for="foto'.$x.'">Foto '.$x.':</label>

						<input class="txt" name="foto[]" type="file" id="foto'.$x.'" size="43"  tabindex="8" title="Selecione a Foto" />

					    <br />
					    ';
                    }

                    ?>

                    




					<input class="botao" type="submit" name="cadastrar" id="cadastrar" value="Enviar" tabindex="12" title="Enviar cadastro" />

						

                    <!--<input class="botaovoltar" type="submit" name="cadastrar" id="cadastrar" value="Voltar" tabindex="10" title="Voltar p&aacute;gina" />-->

					<input class="botaovoltar" type="button" name="cadastrar" id="cadastrar" value="Voltar" title="Voltar p&aacute;gina" tabindex="13" onClick="history.back();" />

					</fieldset>

				

				</form>

				
                <br />

                <h4>&raquo; Listagem de Eventos/Exposi&ccedil;&otilde;es</h4>

                <table>

				<thead>
					<tr>

                        <th width="10%" scope="col">Tipo</th>
                        <th width="15%" scope="col">Nome</th>
						<th width="30%" scope="col">Texto</th>
						<th width="10%" scope="col">Data</th>
						<th width="10%" scope="col" >Gerenciar Fotos</th>
						<th width="10%" scope="col">Editar</th>
                        <th width="10%" scope="col">Excluir</th>

					</tr>
				</thead>

				<tbody>
                <?php
                //Listagem de Websites
                
                $rs1 = mysqli_query($conn, "SELECT E.*, T.nm_tipo FROM eventos E INNER JOIN tipo_trabalho T ON T.cd_tipo=E.tipo_evento ORDER BY E.dt_evento DESC");
                while($dados = mysqli_fetch_array($rs1, MYSQLI_BOTH))
                {
                
                    $linkExc = "excluir.php?tp=eve&cd=".$dados['cd_evento'];
                ?>

					<tr>

						<td class="top"><?php echo $dados['nm_tipo'];?></td>
						<td class="top"><?php echo $dados['nm_evento'];?></td>
						<td class="top"><?php echo substr(strip_tags($dados['descricao']),0, 110).' ...';?></td>
						<td class="top"><?php echo implode("/",array_reverse(explode("-",$dados['dt_evento'])));?></td>

                        <td class="top"><a href="gerenciar-eventos.php?tipo=edit&cd=<?php echo $dados['cd_evento'];?>" ><img src="img/botoes/pps1.gif" title="Gerenciar Fotos" /></a></td>
                        <td class="top"><a href="cadastro-eventos.php?tipo=edit&cd=<?php echo $dados['cd_evento'];?>" ><img src="img/botoes/outro.gif" title="Editar?" /></a></td>
                        <td class="top"><a href="#" onclick="excluir('<?php echo $linkExc;?>')" ><img src="img/botoes/bt_excluir.gif" title="Excluir ?" /></a></td>

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
