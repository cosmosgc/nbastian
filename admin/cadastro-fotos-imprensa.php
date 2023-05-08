<?php
session_start();
session_name("admin");

require("includes/verifica_sessao.php");
require("includes/conecta_bd.php");



//Carrega os dados para fazer a edição. Se for o caso
if(isset($_GET['tipo']) && $_GET['tipo'] == "edit")
{
    $codigo = intval($_GET['cd']);
    $rs = mysql_query("SELECT * FROM imprensa_fotos WHERE cd_foto='$codigo'");

    $var = mysql_fetch_array($rs);
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


<script type="text/javascript" src="includes/mascara_data.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>

<script type="text/javascript" src="../js/jquery.maskedinput-1.2.2.js"></script>

<script type="text/javascript" charset="utf-8">

jQuery(function($){
   $("#dt_foto").mask("99/99/9999");
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

			

			<h5><a href="principal.php" title="Voltar para p&aacute;gina principal">&raquo;  Principal</a> &raquo; Cadastro de Fotos p/ Área da Imprensa</h5>

			

			<div id="miolo">
			

				<h4>&raquo; Cadastro de Fotos p/ Área da Imprensa</h4>

				

				<form name="form1" id="form1" method="post" action="fotos-imp-action.php" enctype="multipart/form-data">

					<fieldset>


                   <label for="de_legenda">Legenda da Foto:</label>

						<input class="txt" name="de_legenda" type="text" id="de_legenda"  maxlength="255" tabindex="5" title="Legenda da Foto" value="<?php echo $var['de_legenda'];?>"/>


                    <br />
                    
                    <label for="dt_foto">Data da Foto:</label>

						<input class="txt" name="dt_foto" type="text" id="dt_foto"  maxlength="10" tabindex="5" title="Data da Foto" value="<?php echo implode("/",array_reverse(explode("-",$var['dt_foto'])));?>"/>


                    <br />

					
                  <?php
                    if(!empty($var['caminho_foto']) && file_exists('../'.$var['caminho_foto']))
                        echo '<img src="../'.$var['caminho_foto'].'" alt="" width="170" /><br /><br />';
					?>

                        <label for="foto1">Foto :</label>

						<input class="txt" name="foto[]" type="file" id="foto1" size="43"  tabindex="8" title="Selecione a Foto" />

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

					<input class="botao" type="submit" name="cadastrar" id="cadastrar" value="Enviar" tabindex="12" title="Enviar cadastro" />

						

                    <!--<input class="botaovoltar" type="submit" name="cadastrar" id="cadastrar" value="Voltar" tabindex="10" title="Voltar p&aacute;gina" />-->

					<input class="botaovoltar" type="button" name="cadastrar" id="cadastrar" value="Voltar" title="Voltar p&aacute;gina" tabindex="13" onClick="history.back();" />



                	</fieldset>

				

				</form>

				
                <br />

                <h4>&raquo; Listagem de Fotos p/ Área da Imprensa</h4>

                <table>

				<thead>
					<tr>


						<th width="20%" scope="col">Legenda</th>
						<th width="15%" scope="col">Data da Foto</th>
						<th width="15%" scope="col">Nr de Downloads</th>
						<th width="30%" scope="col">Foto</th>
						<th width="15%" scope="col">Editar</th>
                        <th width="15%" scope="col">Excluir</th>

					</tr>
				</thead>

				<tbody>
                <?php
                //Listagem de Websites
                
                $rs1 = mysql_query("SELECT * FROM imprensa_fotos ORDER BY dt_foto ASC");
                while($dados = mysql_fetch_array($rs1))
                {
                
                    $linkExc = "excluir.php?tp=ftoi&cd=".$dados['cd_foto'];
                ?>

					<tr>


						<td class="top"><?php echo $dados['de_legenda']?></td>
						<td class="top"><?php echo implode("/",array_reverse(explode("-",$dados['dt_foto'])));?></td>
                        <td class="top"><?php echo $dados['nr_downloads']?></td>
                        <td class="top"><?php echo '<img src="../'.$dados['caminho_foto'].'" alt="" width="170"  />';?></td>

                        <td class="top"><a href="cadastro-fotos-imprensa.php?tipo=edit&cd=<?php echo $dados['cd_foto'];?>" ><img src="img/botoes/outro.gif" title="Editar?" /></a></td>
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
