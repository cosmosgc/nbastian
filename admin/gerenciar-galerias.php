<?php
session_name("admin");
session_start();

require("includes/verifica_sessao.php");
require("includes/conecta_bd.php");



//Carrega os dados para fazer a edição. Se for o caso
if(isset($_GET['tipo']) && $_GET['tipo'] == "edit")
{
    $codigo = intval($_GET['cd']);
    $rs = mysqli_query($conn, "SELECT * FROM galerias WHERE cd_galeria='$codigo'");

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
.center{
    text-align: center;
}
	

-->

</style>


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

			

			<h5><a href="principal.php" title="Voltar para p&aacute;gina principal">&raquo;  Principal</a> &raquo; Gerenciamento de Fotos das Galerias </h5>

			

			<div id="miolo">
			

				<h4>&raquo; <?php echo implode("/",array_reverse(explode("-",$var['dt_galeria'])));?> <?php echo $var['nm_galeria'];?></h4>

				

				<form name="form1" id="form1" method="post" action="galerias-action.php" enctype="multipart/form-data">

					<fieldset>

                    <table>

    				    <tbody>
                        <?php
                        $rs = mysqli_query($conn, "SELECT COUNT(*) FROM fotos_galeria WHERE cd_galeria='$codigo'");
                        list($total) = mysqli_fetch_array($rs, MYSQLI_BOTH);
                        
                        $total = ceil($total/4);
                        for($x=1; $x<=$total; $x++)
                        {
                            $inicial = ($x-1)*4;
                            echo '<tr>';
                            $rs1 = mysqli_query($conn, "SELECT * FROM fotos_galeria WHERE cd_galeria='$codigo' ORDER BY cd_foto ASC LIMIT $inicial,4");
                            while($var = mysqli_fetch_array($rs1, MYSQLI_BOTH))
                            {
                                echo '<td width="25%" class="center">
                                <img src="../'.$var['caminho_thumb'].'" alt="" /><br /><br />
                                <select name="'.$var['cd_foto'].'" id="'.$var['cd_foto'].'">';
                                if($var['ativo'] == 0)
                                    echo '<option value="0" selected="true">Inativo</option>';
                                else
                                    echo '<option value="0">Inativo</option>';

                                if($var['ativo'] == 1)
                                    echo '<option value="1" selected="true">Ativo</option>';
                                else
                                    echo '<option value="1">Ativo</option>';


                                echo'
                                </select>
                                <br />
                                Apagar? <input type="checkbox" name="apagar[]" id="'.$var['cd_foto'].'" value="'.$var['cd_foto'].'" />
                                </td>';
                            }
                            
                            echo '</tr>';
                        }
                        
                        ?>

				        </tbody>
				    </table>

					
                    <?php
                    // "Define" o tipo da ação do formulário
                    if(isset($_GET['tipo']) && $_GET['tipo'] == "edit")
                    {
                        echo '<input type="hidden" id="acao" name="acao" value="gerencia">';
                        echo '<input type="hidden" name="cd" id="cd" value="'.$codigo.'"/>';
                    }





                    ?>

                    




					<input class="botao" type="submit" name="cadastrar" id="cadastrar" value="Atualizar" tabindex="12" title="Atualizar" />

						

                    <input class="botaovoltar" type="submit" name="cadastrar" id="cadastrar" value="Voltar" tabindex="10" title="Voltar p&aacute;gina" onClick="history.back(); return false;" />



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
