<?php
session_start();
session_name("admin");

require("includes/verifica_sessao.php");
require("includes/conecta_bd.php");



//Carrega os dados para fazer a edi��o. Se for o caso
if(isset($_GET['tipo']) && $_GET['tipo'] == "edit")
{
    $codigo = intval($_GET['cd']);
    $rs = mysqli_query($conn, "SELECT * FROM websites WHERE cd_website='$codigo'");

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

			

			<h5><a href="principal.php" title="Voltar para p&aacute;gina principal">&raquo;  Principal</a> &raquo; Cadastro de Websites</h5>

			

			<div id="miolo">
			

				<h4>&raquo; Cadastro de Websites</h4>

				

				<form name="form1" id="form1" method="post" action="websites-action.php" enctype="multipart/form-data">

					<fieldset>



                    <?php
                    if(!isset($var['ordem']))
                    {
                        $rs = mysqli_query($conn, "SELECT MAX(ordem) FROM websites");
                        list($ordem) = mysqli_fetch_array($rs, MYSQLI_BOTH);
                        $var['ordem'] = $ordem+1;
                    }
                    ?>
                    <label for="ordem">Ordem:</label>

						<input class="txt" name="ordem" type="text" id="ordem"  maxlength="4" tabindex="5" title="ordem" value="<?php echo $var['ordem'];?>"/>

					<br />


                    <label for="cliente">Cliente:</label>

						<input class="txt" name="cliente" type="text" id="cliente"  maxlength="100" tabindex="5" title="Cliente" value="<?php echo $var['nm_cliente'];?>"/>

					<br />
					
						<label for="descricao">Descri&ccedil;&atilde;o:</label>

						<input class="txt" name="descricao" type="text" id="descricao"  maxlength="255" tabindex="6" title="Descri&ccedil;&atilde;o" value="<?php echo $var['descricao'];?>" />

					<br />
					
						<label for="link">Link:</label>

						<input class="txt" name="link" type="text" id="link"  maxlength="255" tabindex="7" title="Link" value="<?php echo $var['link'];?>" />

					<br />
					
					    <label for="novidade">Novidade:</label>

						<input  name="novidade" type="checkbox" id="novidade"  tabindex="7" title="Novidade" value="1" <?php if($var['novidade'] == 1){ echo'checked="true"';}?> />

					<br /><br />
					
					<?php
                    if(!empty($var['caminho_thumb']) && file_exists('../'.$var['caminho_thumb']))
                        echo '<img src="../'.$var['caminho_thumb'].'" alt="" width="100" /><br /><br />';
					?>



                    	<label for="pequena">Imagem Pequena:</label>

						<input class="txt" name="pequena" type="file" id="pequena" size="43"  tabindex="8" title="Selecione a Imagem Pequena" />

					<br />
					
					<label for="arquivo">Imagem Grande:</label>

						<input class="txt" name="arquivo" type="file" id="arquivo" size="43"  tabindex="8" title="Selecione a Imagem Grande" />

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
                    ?>

                    

					<input class="botao" type="submit" name="cadastrar" id="cadastrar" value="Enviar" tabindex="12" title="Enviar cadastro" />

						

                    <!--<input class="botaovoltar" type="submit" name="cadastrar" id="cadastrar" value="Voltar" tabindex="10" title="Voltar p&aacute;gina" />-->

					<input class="botaovoltar" type="button" name="cadastrar" id="cadastrar" value="Voltar" title="Voltar p&aacute;gina" tabindex="13" onClick="history.back();" />

					</fieldset>

				

				</form>

				
                <br />

                <h4>&raquo; Listagem de Websites</h4>

                <table>

				<thead>
					<tr>
                        <th width="5%" scope="col">Ordem</th>
                        <th width="30%" scope="col">Cliente</th>
						<th width="20%" scope="col">Miniatura</th>
						<th width="20%" scope="col">Data &Uacute;ltima Atualiza&ccedil;&atilde;o</th>
						<th width="10%" scope="col">Editar</th>
                        <th width="10%" scope="col">Excluir</th>

					</tr>
				</thead>

				<tbody>
                <?php
                //Listagem de Websites
                
                $rs1 = mysqli_query($conn, "SELECT * FROM websites ORDER BY ordem ASC");
                while($dados = mysqli_fetch_array($rs1, MYSQLI_BOTH))
                {
                
                    $linkExc = "excluir.php?tp=web&cd=".$dados['cd_website'];
                ?>

					<tr>
						<td class="top"><?php echo $dados['ordem'];?></td>
						<td class="top"><?php echo $dados['nm_cliente'];?></td>
						<td class="top"><img src="../<?php echo $dados['caminho_thumb'];?>" alt="" width="130" /></td>
						<td class="top"><?php echo date("d/m/Y - H:i:s",$dados['dt_ultima']);?></td>


                        <td class="top"><a href="cadastro-websites.php?tipo=edit&cd=<?php echo $dados['cd_website'];?>" ><img src="img/botoes/outro.gif" title="Editar?" /></a></td>
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
