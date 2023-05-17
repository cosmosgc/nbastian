<?php
session_start();
session_name("admin");

require("includes/verifica_sessao.php");
require("includes/conecta_bd.php");

//Carrega os dados para fazer a edi��o. Se for o caso
if(isset($_GET['tipo']) && $_GET['tipo'] == "edit")
{
    $codigo = intval($_GET['cd']);
    $rs = mysqli_query($conn, "SELECT * FROM categorias WHERE cd_categoria='$codigo'");

    $var = mysqli_fetch_array($rs, MYSQLI_BOTH);
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>NBastian - Admin</title>

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

			

			<h5><a href="principal.php" title="Voltar para p&aacute;gina principal">&raquo;  Principal</a> &raquo; Cadastro de Categorias</h5>

			

			<div id="miolo">
			

				<h4>&raquo; Cadastro de Categorias</h4>

				

				<form name="form1" id="form1" method="post" action="categoria-action.php" enctype="multipart/form-data">

					<fieldset>


                        <label for="nm_categoria">Nome da Categoria:</label>

						<input class="txt" name="nm_categoria" type="text" id="nm_categoria"  maxlength="255" tabindex="5" title="Nome da Categoria" value="<?php echo $var['nm_categoria'];?>"/>


                    <br /><br />
                    
                       <label for="venda">Fotos Dispon&iacute;veis para venda:</label>

                       <select name="venda" id="venda">
                            <option value="1"<?php if($var['venda'] == 1) echo 'selected="true"';?>>Sim</option>
                            <option value="0" <?php if(isset($var['venda']) && $var['venda'] == 0) echo 'selected="true"';?>>N&atilde;o</option>
                       </select>


                    <br />
                    <br />
                    <br />

                    <?php
                    if(!empty($var['caminho_foto']) && file_exists('../'.$var['caminho_foto']))
                        echo '<img src="../'.$var['caminho_foto'].'" alt="" width="170"  /><br /><br />';
					?>

                    	<label for="arquivo">Imagem:</label>

						<input class="txt" name="arquivo" type="file" id="arquivo" size="43"  tabindex="8" title="Selecione a Imagem - Largura da imagem: 935 pixels" />

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

                <h4>&raquo; Listagem de Categorias</h4>

                <table>

				<thead>
					<tr>

						<th width="20%" scope="col">Cateogira</th>
						<th width="40%" scope="col">Imagem</th>
                        <th width="20%" scope="col">Fotos p/ Venda?</th>
						
                        <th width="10%" scope="col">Editar</th>
                        <th width="10%" scope="col">Excluir</th>

					</tr>
				</thead>

				<tbody>
                <?php
                //Listagem de Websites
                
                $rs1 = mysqli_query($conn, "SELECT * FROM categorias ORDER BY nm_categoria ASC");
                while($dados = mysqli_fetch_array($rs1, MYSQLI_BOTH))
                {
                
                    $linkExc = "excluir.php?tp=cat&cd=".$dados['cd_categoria'];
                ?>

					<tr>

                        <td class="top"><?php echo $dados['nm_categoria'];?></td>
                        <td class="top"><img src="../<?php echo $dados['caminho_foto'];?>" alt="" width="170" /></td>
                        <td class="top"><?php if($dados['venda']) echo "Sim"; else echo "N&atilde;o";?></td>
                        <td class="top"><a href="cadastro-categorias.php?tipo=edit&cd=<?php echo $dados['cd_categoria'];?>" ><img src="img/botoes/outro.gif" title="Editar?" /></a></td>
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
