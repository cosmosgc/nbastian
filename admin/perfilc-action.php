<?php
session_name("admin");
session_start();

require("includes/verifica_sessao.php");
require("includes/conecta_bd.php");
require("includes/anti_injection.php");


if(isset($_POST['acao']) && $_POST['acao'] == "edita")
{

    // Pega os campos enviados via POST
    foreach ($_POST as $campo => $valor) { $$campo = ($valor);}


    //verifica se algum dos campos está vazio
    if(empty($texto)  )
    {
        echo"<script language=javascript>alert('Favor preencher o texto .')</script>";
        echo"<script language=javascript>location.href='cadastro-perfil.php?tipo=edit?cd=$cd'</script>";
        exit;
    }
    else
    {
        $x=0;
        if(!$_FILES['foto']['error'][$x])
        {
            $prim = time();
            if(!empty($_FILES['foto']['name'][$x]))
            {
                $ext = end(explode(".", strtolower($_FILES['foto']['name'][$x])));
                if($ext == "jpg" || $ext == "gif" || $ext = "png")
                {

                    $ft_grande = "../arquivos/foto_".$prim.".".$ext;
                    $grandebd = "arquivos/foto_".$prim.".".$ext;

                    move_uploaded_file($_FILES['foto']['tmp_name'][$x], $ft_grande);


                    @chmod($ft_grande, 0766);



                }
            }
        }

        $rs = mysqli_query($conn, "UPDATE perfil SET de_conteudo='$texto', caminho_foto='$grandebd', dt_ultima='".time()."' WHERE cd_perfil='$cd'");


        //echo"<script language=javascript>alert('cadastro atualizado com sucesso.')</script>";
        echo"<script language=javascript>location.href='cadastro-perfil.php'</script>";
        exit;

        
            }
}
?>
