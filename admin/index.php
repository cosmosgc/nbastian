<?php
session_start();
session_name("admin");

require("includes/conecta_bd.php");
require("includes/anti_injection.php");

if(isset($_POST['acao']) && $_POST['acao'] == "login")
{
    $login = anti_injection($_POST['txtusuario']);
    $senha = anti_injection($_POST['txfsenha']);
    
    //seleciona o usu�rio
    $rs = mysqli_query($conn, "SELECT cd_usuario, nm_usuario, AES_DECRYPT(de_senha,'admin') AS de_senha FROM usuarios WHERE de_login='$login'") or die(mysqli_error());

    //caso encontre um usu�rio
    if(mysqli_num_rows($rs) > 0)
    {
        $dados = mysqli_fetch_array($rs, MYSQLI_BOTH);
        if($dados['de_senha'] == $senha)//verifica se a senha est� correta
        {
            $_SESSION['nm_usuario'] = $dados['nm_usuario'];
            $_SESSION['cd_usuario'] = $dados['cd_usuario'];
            $_SESSION['de_login'] = $login;
            
            $rs1 = mysqli_query($conn, "UPDATE usuarios SET dt_ultimo_acesso='".time()."' WHERE cd_usuario='{$dados['cd_usuario']}'");
            
            echo"<script language=javascript>location.href='principal.php'</script>";
            exit;
        }
        else
        {
            echo"<script language=javascript>alert('Senha incorreta.')</script>";
            echo"<script language=javascript>location.href='index.php'</script>";
            exit;
        }
    }
    else // caso n�o encontre
    {
        echo"<script language=javascript>alert('Usu�rio n�o encontrado.')</script>";
        echo"<script language=javascript>location.href='index.php'</script>";
        exit;
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>NBastian - Admin</title>

<link href="estilos/usuario.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--

	
	form{
		border: 1px solid #ccc;
		margin: 10px auto;
		margin-bottom: 25px;
		padding: 10px;
		width: 230px;
		height: 120px;
	}
	
.centro{ text-align: center;}
	
-->
</style>

</head>

<body>
	
	<div id="geral"> <!-- geral -->
	
		<div id="topo"> <!-- topo -->
		
			<h3>NBastian - Admin</h3>
			
		</div> <!-- /topo -->
		
		
		<div id="conteudo"> <!-- conteudo -->
			

			<fieldset>
		   
		   		<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
				
					<label for="txtusuario">Usu&aacute;rio:</label>   
						<input class="txtLogin" name="txtusuario" type="text" id="txtusuario"  maxlength="50" tabindex="8" title="Usu&aacute;rio" />
						
					
					
					<label for="txfsenha">Senha:</label>
						<input class="txtLogin" name="txfsenha" type="password" id="txfsenha"  maxlength="20" tabindex="9" title="Senha" />
					
						<input type="hidden" name="acao" id="acao" value="login" />
					
					
					
					<input class="botaoEntrar" type="submit" name="imageField" id="imageField" value="Entrar" title="Entrar" />
				
				</form>
		   
		   	</fieldset>
			
			

			
		
		</div> <!-- /conteudo -->
		
	
	</div> <!-- /geral -->
	
	
	<div id="rodape"> <!-- rodape -->
			
		<address>
			
			<? include "includes/rodape.html"; ?>
			
		</address>
		
	</div> <!-- /rodape -->


</body>
</html>
