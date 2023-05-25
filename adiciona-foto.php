<?php
session_name("site");
session_start();

include_once("admin/includes/conecta_bd.php");
include_once("admin/includes/anti_injection.php");

if($_REQUEST['acao'] == "adiciona")
{
//cria o carrinho caso este não exista
    if(!isset($_SESSION['carrinho']))
    {
        $rs = mysqli_query($conn, "INSERT INTO carrinho VALUES('',NOW())");
        $cd_carrinho = mysqli_insert_id();

        //adiciona o código do carrinho na sessão do Usuário
        $_SESSION['carrinho'] = $cd_carrinho;
    }

    //verifica se a foto já existe no carrinho
    $rs = mysqli_query($conn, "SELECT * FROM carrinho_itens  WHERE cd_carrinho='".$_SESSION['carrinho']."' AND tp_foto='".anti_injection($_GET['tipo'])."' AND cd_foto='".intval($_GET['cd_foto'])."'");
    if(mysqli_num_rows($rs)== 0)
    {
        //adiciona a foto selecionada e o tipo: galeria ou exposicao/evento
        $rs = mysqli_query($conn, "INSERT INTO carrinho_itens VALUES('','".$_SESSION['carrinho']."','".anti_injection($_GET['tipo'])."','".intval($_GET['cd_foto'])."')");
    }
}
elseif($_REQUEST['acao'] == "remove")
{

                      $rs = mysqli_query($conn, "DELETE FROM carrinho_itens WHERE cd_item='".intval($_REQUEST['cd_item'])."'");


                      $fotos_galeria = array();
                      $fotos_evento = array();
                      $fotos_expo = array();
                      $rs = mysqli_query($conn, "SELECT * FROM carrinho_itens WHERE cd_carrinho='".$_SESSION['carrinho']."' ORDER BY cd_item ASC");
                      while($var = mysqli_fetch_array($rs, MYSQLI_BOTH))
                      {
                        if($var['tp_foto'] == "galeria")
                        {
                            $rs1 = mysqli_query($conn, "SELECT caminho_foto FROM fotos_galeria WHERE cd_foto='{$var['cd_foto']}'");
                            list($foto) = mysqli_fetch_array($rs1, MYSQLI_BOTH);
                        }
                        elseif($var['tp_foto'] == "evento")
                        {
                            $rs1 = mysqli_query($conn, "SELECT caminho_foto FROM fotos_eventos WHERE cd_foto='{$var['cd_foto']}'");
                            list($foto) = mysqli_fetch_array($rs1, MYSQLI_BOTH);
                        }
                        elseif($var['tp_foto'] == "expo")
                        {
                            $rs1 = mysqli_query($conn, "SELECT caminho_foto FROM fotos_eventos WHERE cd_foto='{$var['cd_foto']}'");
                            list($foto) = mysqli_fetch_array($rs1, MYSQLI_BOTH);
                        }

                      ?>
                        <li>
                    	   <img src="admin/includes/phpThumb/phpThumb.php?src=../../../<?php echo $foto;?>&w=67&h=67&zc=1" />
                            <a onclick="removeImagem('<?php echo $var['cd_item'];?>','');" href="javascript:void(0);">Remover</a>
                        </li>
                    <?php
                    }

}
?>

