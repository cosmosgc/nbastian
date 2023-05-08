<?php
session_start();
session_name("admin");

require("includes/verifica_sessao.php");
require("includes/conecta_bd.php");



//Carrega os dados para fazer a edição. Se for o caso
if(isset($_GET['tipo']) && $_GET['tipo'] == "edit")
{
    $codigo = intval($_GET['cd']);
    $rs = mysql_query("SELECT * FROM imprensa_usuarios WHERE cd_usuario='$codigo'");

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


<script type="text/javascript">
<!--
function excluir(aURL)
{
    if(confirm("Você tem certeza que deseja apagar esse registro?"))
    {
        location.href = aURL;
    }
}

function validaForm()
{
    if(document.getElementById("nm_usuario").value == "")
    {
        alert("Favor preencher todos os campos");
        document.getElementById("nm_usuario").focus();
        return false;
    }
    if(document.getElementById("email_usuario").value == ""  )
    {
        alert("Favor preencher todos os campos");
        document.getElementById("email_usuario").focus();
        return false;
    }
    if(!checkMail(document.getElementById("email_usuario").value))
    {
        alert("Favor preencher com um endereço de email válido");
        document.getElementById("email_usuario").value = "";
        document.getElementById("email_usuario").focus();
        return false;
    }
    <?php
    if(!isset($_GET['tipo']))
    {
    ?>
    if(document.getElementById("de_senha").value == "" )
    {
        alert("Favor preencher todos os campos");
        document.getElementById("de_senha").focus();
        return false;
    }
    <?php
    }
    ?>
    return true;
}

function checkMail(mail)
{
    var er = new RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
    if(typeof(mail) == "string"){
        if(er.test(mail)){ return true; }
    }else if(typeof(mail) == "object"){
        if(er.test(mail.value)){
                    return true;
                }
    }else{
        return false;
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

			

			<h5><a href="principal.php" title="Voltar para p&aacute;gina principal">&raquo;  Principal</a> &raquo; Cadastro de Usuário p/ Área da Imprensa</h5>

			

			<div id="miolo">
			

				<h4>&raquo; Cadastro de Usuário p/ Área da Imprensa</h4>

				

				<form name="form1" id="form1" method="post" action="usuarios-imp-action.php" enctype="multipart/form-data" onsubmit="return validaForm();">

					<fieldset>



                    <label for="nm_usuario">Nome do Usuário:</label>

						<input class="txt" name="nm_usuario" type="text" id="nm_usuario"  maxlength="255" tabindex="5" title="Nome do Usuário" value="<?php echo $var['nm_usuario'];?>"/>


                    <br />
                    
                    <label for="email_usuario">E-mail / Login:</label>

						<input class="txt" name="email_usuario" type="text" id="email_usuario"  maxlength="255" tabindex="5" title="E-mail do Usuário: (Login)" value="<?php echo $var['email_usuario'];?>"/>


                    <br />
                    
                    <label for="de_senha">Senha de Acesso:</label>

						<input class="txt" name="de_senha" type="password" id="de_senha"  maxlength="20" tabindex="5" title="SEnha de Acesso" value=""/>


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

                <h4>&raquo; Listagem de Usuário p/ Área da Imprensa</h4>

                <table>

				<thead>
					<tr>


                        <th width="20%" scope="col">Nome</th>
						<th width="20%" scope="col">E-mail / Login</th>
						<th width="10%" scope="col">&Uacute;timo Acesso</th>
						<th width="10%" scope="col">Editar</th>
                        <th width="10%" scope="col">Excluir</th>

					</tr>
				</thead>

				<tbody>
                <?php
                //Listagem de Websites
                
                $rs1 = mysql_query("SELECT * FROM imprensa_usuarios ORDER BY nm_usuario ASC");
                while($dados = mysql_fetch_array($rs1))
                {
                
                    $linkExc = "excluir.php?tp=usui&cd=".$dados['cd_usuario'];
                ?>

					<tr>

						<td class="top"><?php echo $dados['nm_usuario'];?></td>
						<td class="top"><?php echo $dados['email_usuario'];?></td>

						<td class="top"><?php if(!$dados['dt_ultimo_acesso']){echo'Nunca acessou';}else{ echo date("d/m/Y - H:i:s", $dados['dt_ultimo_acesso']);}?></td>


                        <td class="top"><a href="cadastro-usuarios-imprensa.php?tipo=edit&cd=<?php echo $dados['cd_usuario'];?>" ><img src="img/botoes/outro.gif" title="Editar?" /></a></td>
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
