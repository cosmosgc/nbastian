<?php
session_name("admin");
session_start();

require("includes/verifica_sessao.php");
require("includes/conecta_bd.php");



//Carrega os dados para fazer a edição. Se for o caso
if(isset($_GET['tipo']) && $_GET['tipo'] == "edit")
{
    $codigo = intval($_GET['cd']);
    $rs = mysqli_query($conn, "SELECT * FROM clientes WHERE cd_cliente='$codigo'");

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

			

			<h5><a href="principal.php" title="Voltar para p&aacute;gina principal">&raquo;  Principal</a> &raquo; Cadastro de ClienteS</h5>

			

			<div id="miolo">
			

				<h4>&raquo; Cadastro de Clientes</h4>

				

				<form name="form1" id="form1" method="post" action="clientes-action.php" enctype="multipart/form-data">

					<fieldset>


					<label for="cliente">Cliente:</label>

						<input class="txt" name="cliente" type="text" id="cliente"  maxlength="250" tabindex="5" title="Cliente" value="<?php echo $var['nm_cliente'];?>"/>


                    <br />
                    
                    <label for="descricao">Texto sobre o cliente:</label>


                        <textarea name="descricao" id="descricao" tabindex="7" rows="4" cols="40" class="txt" title="Texto sobre o cliente" ><?php echo $var['de_conteudo'];?></textarea>
					<br />
                    
                   	<?php
                    if(!empty($var['caminho_foto']) && file_exists('../'.$var['caminho_foto']))
                        echo '<img src="../'.$var['caminho_foto'].'" alt="" width="160" height="130" /><br /><br />';
					?>


	               <label for="arquivo">Logo do Cliente:</label>

						<input class="txt" name="arquivo" type="file" id="arquivo" size="43"  tabindex="8" title="Selecione a Logo do Cliente" />

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

                <h4>&raquo; Listagem de Clientes</h4>

                <table>

				<thead>
					<tr>
						<th width="15%" scope="col">Cliente</th>
						<th width="30%" scope="col">Logo</th>
						<th width="15%" scope="col">Texto</th>

						<th width="20%" scope="col">Data de Cadastro</th>
						<th width="10%" scope="col">Editar</th>
                        <th width="10%" scope="col">Excluir</th>

					</tr>
				</thead>

				<tbody>
                <?php
                //Listagem de Websites
                
                $rs1 = mysqli_query($conn, "SELECT * FROM clientes ORDER BY nm_cliente ASC") or die(mysqli_error());
                while($dados = mysqli_fetch_array($rs1, MYSQLI_BOTH))
                {
                
                    $linkExc = "excluir.php?tp=cli&cd=".$dados['cd_cliente'];
                ?>

					<tr>
						<td class="top"><?php echo $dados['nm_cliente'];?></td>
						<td class="top"><img src="../<?php echo $dados['caminho_foto'];?>" alt="" width="160" height="130" /></td>
						<td class="top"><?php echo $dados['de_conteudo'];?></td>

						<td class="top"><?php echo date("d/m/Y - H:i:s",$dados['dt_cadastro']);?></td>


                        <td class="top"><a href="cadastro-clientes.php?tipo=edit&cd=<?php echo $dados['cd_cliente'];?>" ><img src="img/botoes/outro.gif" title="Editar?" /></a></td>
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
