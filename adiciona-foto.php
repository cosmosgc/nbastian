<?php
session_start();
session_name("site");

include_once("admin/includes/conecta_bd.php");
include_once("admin/includes/anti_injection.php");

if($_REQUEST['acao'] == "adiciona")
{
//cria o carrinho caso este não exista
    if(!isset($_SESSION['carrinho']))
    {
        $rs = mysql_query("INSERT INTO carrinho VALUES('',NOW())");
        $cd_carrinho = mysql_insert_id();

        //adiciona o código do carrinho na sessão do usuário
        $_SESSION['carrinho'] = $cd_carrinho;
    }

    //verifica se a foto já existe no carrinho
    $rs = mysql_query("SELECT * FROM carrinho_itens  WHERE cd_carrinho='".$_SESSION['carrinho']."' AND tp_foto='".anti_injection($_GET['tipo'])."' AND cd_foto='".intval($_GET['cd_foto'])."'");
    if(mysql_num_rows($rs)== 0)
    {
        //adiciona a foto selecionada e o tipo: galeria ou exposicao/evento
        $rs = mysql_query("INSERT INTO carrinho_itens VALUES('','".$_SESSION['carrinho']."','".anti_injection($_GET['tipo'])."','".intval($_GET['cd_foto'])."')");
    }
}
elseif($_REQUEST['acao'] == "remove")
{

                      $rs = mysql_query("DELETE FROM carrinho_itens WHERE cd_item='".intval($_REQUEST['cd_item'])."'");


                      $fotos_galeria = array();
                      $fotos_evento = array();
                      $fotos_expo = array();
                      $rs = mysql_query("SELECT * FROM carrinho_itens WHERE cd_carrinho='".$_SESSION['carrinho']."' ORDER BY cd_item ASC");
                      while($var = mysql_fetch_array($rs))
                      {
                        if($var['tp_foto'] == "galeria")
                        {
                            $rs1 = mysql_query("SELECT caminho_foto FROM fotos_galeria WHERE cd_foto='{$var['cd_foto']}'");
                            list($foto) = mysql_fetch_array($rs1);
                        }
                        elseif($var['tp_foto'] == "evento")
                        {
                            $rs1 = mysql_query("SELECT caminho_foto FROM fotos_eventos WHERE cd_foto='{$var['cd_foto']}'");
                            list($foto) = mysql_fetch_array($rs1);
                        }
                        elseif($var['tp_foto'] == "expo")
                        {
                            $rs1 = mysql_query("SELECT caminho_foto FROM fotos_eventos WHERE cd_foto='{$var['cd_foto']}'");
                            list($foto) = mysql_fetch_array($rs1);
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

