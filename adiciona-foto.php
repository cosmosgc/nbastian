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
        $cd_carrinho = mysqli_insert_id($conn);

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
                        $calculatedTotal=0;

                      $fotos_galeria = array();
                      $fotos_evento = array();
                      $fotos_expo = array();
                      $rs = mysqli_query($conn, "SELECT * FROM carrinho_itens WHERE cd_carrinho='".$_SESSION['carrinho']."' ORDER BY cd_item ASC");
                      ?>
                      <h6>Fotos selecionadas:</h6>
                      <ul id="fotinhos">
                      <?php
                      while($var = mysqli_fetch_array($rs, MYSQLI_BOTH))
                      {
                        if ($var['tp_foto'] == "galeria") {
                            $table = "fotos_galeria";
                            $relatedTable = "galerias";
                            $relatedForeignKey = "cd_galeria";
                        } elseif ($var['tp_foto'] == "evento" || $var['tp_foto'] == "expo") {
                            $table = "fotos_eventos";
                            $relatedTable = "eventos";
                            $relatedForeignKey = "cd_evento";
                        }
                        
                        if (isset($table) && isset($relatedTable) && isset($relatedForeignKey)) {
                            $query = "SELECT $relatedTable.vl_foto, $table.caminho_foto
                                      FROM $table
                                      JOIN $relatedTable ON $table.$relatedForeignKey = $relatedTable.$relatedForeignKey
                                      WHERE $table.cd_foto='{$var['cd_foto']}'";
                            $rs1 = mysqli_query($conn, $query);
                            list($vl_foto, $foto) = mysqli_fetch_array($rs1, MYSQLI_BOTH);
                        } else {
                            // Handle the case when $table, $relatedTable, and $relatedForeignKey are not set
                            $vl_foto = 0; // Set a default value or take appropriate action
                            $foto = ""; // Set a default value for $foto
                        }

                      ?>
                      
                        <li>
                            <img src="admin/includes/phpThumb/phpThumb.php?src=../../../<?php echo $foto;?>&w=67&h=67&zc=1" />
                            <span>R$ <?php echo number_format($vl_foto, 2, ',','.'); $calculatedTotal+=$vl_foto;?></span>
                            <a onclick="removeImagem('<?php echo $var['cd_item'];?>','');" href="javascript:void(0);">Remover</a>
                            
                        </li>
                    <?php
                    }
                    ?>
                    </ul>
                    <br clear="left" />
                    <h6 class="total">Valor Total R$ <span id="valorTotal"><?php echo number_format($calculatedTotal, 2, ',','.');?></span> </h6>
                    <?php 
}
?>

