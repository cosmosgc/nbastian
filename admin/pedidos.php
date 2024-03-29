<?php
session_name("admin");
session_start();

require("includes/verifica_sessao.php");
require("includes/conecta_bd.php");
require("includes/standard_html.php");
?>

<meta name="viewport" content="width=device-width, initial-scale=1">

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>NBastian Fotografia | Comunica&ccedil;&atilde;o - admin</title>

<script type="text/javascript" src="includes/mascara_data.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

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

		

			<h3>NBastian - admin</h3>

			

			<ul id="menu">

				

                 <li><a href="logout.php" title="Sair da &aacute;rea de administra&ccedil;&atilde;o">Sair</a></li>

				 <li><a href="principal.php" title="Voltar a p&aacute;gina principal">Principal</a></li>


			</ul>

		

		</div> <!-- /topo -->

		

		

		<div id="conteudo"> <!-- conteudo -->

			

			<div id="local"> <!-- local -->

				<h6>Usu&aacute;rio: <?php echo $_SESSION['nm_usuario'];?></h6>

			</div> <!-- /local -->

			

			<h5><a href="principal.php" title="Voltar para p&aacute;gina principal">&raquo;  Principal</a> &raquo; Listagem de Pedidos</h5>

			

			<div id="miolo">
			

                <table id="DataTable">

				<thead>
					<tr>


                        <th width="5%" scope="col">NR do Ped</th>
                        <th width="20%" scope="col">Data do Pedido</th>
						<th width="20%" scope="col">Cliente</th>
						<th width="10%" scope="col">Status</th>
						<th width="10%" scope="col">Forma de Pagamento</th>
                        <th width="10%" scope="col">PagSeguro</th>
                        <th width="10%" scope="col">Total(R$)</th>
                        <th width="10%" scope="col">Nr de &Iacute;tens</th>

						<th width="10%" scope="col">View</th>
                        <!--<th width="10%" scope="col">Excluir</th>-->

					</tr>
				</thead>

				<tbody>
                <?php
                //Listagem de Websites

                $rs1 = mysqli_query($conn, "SELECT P.*, C.nm_cliente FROM pedido P LEFT JOIN cliente C ON P.cd_cliente=C.cd_cliente ORDER BY P.dt_pedido DESC") or die(mysqli_error());
                while($dados = mysqli_fetch_array($rs1, MYSQLI_BOTH))
                {

                    $linkExc = "excluir.php?tp=jur&cd=".$dados['cd_pedido'];
                    
                    list($data, $hora) = explode(" ",$dados['dt_pedido']);
                    $data = implode('/',array_reverse(explode('-',$data)));
                    
                    $rs = mysqli_query($conn, "SELECT COUNT(*) FROM pedido_itens WHERE cd_pedido='".$dados['cd_pedido']."'");
                    list($num_itens) = mysqli_fetch_array($rs, MYSQLI_BOTH);
                ?>

					<tr>

                        <td class="top"><?php echo $dados['cd_pedido'];?></td>
                        <td class="top"><?php echo $data.' '.$hora;?></td>
						<td class="top"><?php echo $dados['nm_cliente'];?></td>
						<td class="top"><?php echo $dados['status_pedido'];?></td>
						<td class="top"><?php echo $dados['forma_pagamento'];?></td>
						<td class="top pointerCopy" onclick="copyTextToClipboard('<?php echo $dados['transacao_id']; ?> ')"><?php echo '<img  src="https://www.svgrepo.com/show/372323/copy-to-clipboard.svg" style="height:30px">';?></td>
						<td class="top"><?php echo number_format($dados['vl_total'], 2, ',', '.');?></td>
						<td class="top"><?php echo $num_itens;?></td>




                        <td class="top"><a href="detalhes-pedido.php?tipo=edit&cd=<?php echo $dados['cd_pedido'];?>" ><img src="img/botoes/outro.gif" title="Visualizar cadastro completo" /></a></td>
                        <!--<td class="top">

                           <a href="#" onclick="excluir('<?php echo $linkExc;?>')" ><img src="img/botoes/bt_excluir.gif" title="Excluir ?" /></a>

                        </td>
                        -->

					</tr>
                <?php
                }
                ?>
				</tbody>
				</table>

			</div>

		

		</div> <!-- /conteudo -->

<div id="rodape"> <!-- rodape -->

		<address><? include "includes/rodape.html"; ?></address>

	</div> <!-- /rodape -->	

	</div> <!-- /geral -->


<script>
	const table = new DataTable('#DataTable');
	function copyTextToClipboard(text) {
            var textArea = document.createElement("textarea");
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand("copy");
            document.body.removeChild(textArea);
            //alert("Copied to clipboard: " + text);
        }
</script>
</body>

</html>
