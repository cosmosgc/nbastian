<?php
session_name("admin");
session_start();

require("includes/verifica_sessao.php");
require("includes/conecta_bd.php");



//Carrega os dados para fazer a edi��o. Se for o caso
if(isset($_GET['tipo']) && $_GET['tipo'] == "edit")
{
    $codigo = intval($_GET['cd']);
    $rs = mysqli_query($conn, "SELECT P.*, C.* FROM pedido P
                                                LEFT JOIN cliente C ON P.cd_cliente=C.cd_cliente
                                                WHERE P.cd_pedido='$codigo'") or die(mysqli_error());

    $var = mysqli_fetch_array($rs, MYSQLI_BOTH) ;
    
    list($data, $hora) = explode(" ",$var['dt_pedido']);
                    $data = implode('/',array_reverse(explode('-',$data)));
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>NBastian Fotografia | Comunica&ccedil;&atilde;o - admin</title>

<script type="text/javascript" src="includes/mascara_data.js"></script>


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

			

			<h5><a href="principal.php" title="Voltar para p&aacute;gina principal">&raquo;  Principal</a> &raquo; Detalhes do Pedido Nr: <?php echo $codigo;?></h5>

			

			<div id="miolo">
			



                <table>

				<tbody>

                    <tr>
                        <td width="20%"><strong>Status do Pedido:</strong></td>
                        <td><?php echo $var['status_pedido'];?></td>
                    </tr>
                    
                    <tr>
                        <td width="20%"><strong>Forma de Pagamento:</strong></td>
                        <td><?php echo $var['forma_pagamento'];?></td>
                    </tr>
                    
                    <tr>
                        <td width="20%"><strong>Total (R$):</strong></td>
                        <td><?php echo number_format($var['vl_total'], 2, ',', '.');?></td>
                    </tr>
                    
                    <tr>
                        <td width="20%"><strong>ID da transa��o no PagSeguro:</strong></td>
                        <td><?php echo $var['transacao_id'];?></td>
                    </tr>
                    
                    <tr>
                        <td width="20%"><strong>Data do Pedido:</strong></td>
                        <td><?php echo $data.' '.$hora;?></td>
                    </tr>

                    <tr>
                        <td width="20%"><strong>Nome do Cliente</strong></td>
                        <td><?php echo $var['nm_cliente'];?></td>
                    </tr>
                    
                    <tr>
                        <td width="20%"><strong>CEP</strong></td>
                        <td><?php echo $var['nr_cep'];?></td>
                    </tr>
                    
                    <tr>
                        <td width="20%"><strong>Endere�o</strong></td>
                        <td><?php echo $var['endereco'];?></td>
                    </tr>
                    
                    <tr>
                        <td width="20%"><strong>N&uacute;mero</strong></td>
                        <td><?php echo $var['nr_endereco'];?></td>
                    </tr>
                    
                    <tr>
                        <td width="20%"><strong>Complemento</strong></td>
                        <td><?php echo $var['complemento'];?></td>
                    </tr>
                    

                    <tr>
                        <td width="20%"><strong>Bairro  </strong></td>
                        <td><?php echo $var['bairro'];?></td>
                    </tr>
                    
                    <tr>
                        <td width="20%"><strong>Cidade</strong></td>
                        <td><?php echo $var['cidade'];?></td>
                    </tr>
                    
                    <tr>
                        <td width="20%"><strong>Estado</strong></td>
                        <td><?php echo $var['estado'];?></td>
                    </tr>
                    
                    <tr>
                        <td width="20%"><strong>Telefone</strong></td>
                        <td><?php echo $var['telefone'];?></td>
                    </tr>
                    <tr>
                        <td width="20%"><strong>E-mail</strong></td>
                        <td><?php echo $var['email'];?></td>
                    </tr>
                    


                    <tr>
                        <td colspan="2"><strong>Fotos Encomendadas:</strong></td>

                    </tr>
                    

                     <?php
                     $rs1 = mysqli_query($conn, "SELECT I.* FROM pedido_itens I WHERE I.cd_pedido='$codigo'") or die(mysqli_error());
                     while($dados = mysqli_fetch_array($rs1, MYSQLI_BOTH))
                     {
                        list($tipo, $cd_foto) = explode('_', $dados['cd_foto']);
                        
                        if($tipo == 'gal')
                        {
                            $rs1 = mysqli_query($conn, "SELECT caminho_foto FROM fotos_galeria WHERE cd_foto='$cd_foto'");
                            list($caminho_foto) = mysqli_fetch_array($rs1, MYSQLI_BOTH);


                        }
                        else
                        {
                            $rs1 = mysqli_query($conn, "SELECT caminho_foto FROM fotos_eventos WHERE cd_foto='$cd_foto'");
                            list($caminho_foto) = mysqli_fetch_array($rs1, MYSQLI_BOTH);

                        }
                     ?>
                     <tr>
                        <td colspan="2"><img src="includes/phpThumb/phpThumb.php?src=../../../<?php echo $caminho_foto;?>&w=120&h=88&zc=1" alt="" /></td>
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



</body>

</html>
