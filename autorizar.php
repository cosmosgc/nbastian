<?php
include("admin/includes/conecta_bd.php");
include("admin/includes/funcoes.php");

//http://www.agenciap4.com/nbastian/autorizar.php?pedido=214&item=51&cod_aut=eve_705

$item = isset($_GET['item']) ? intval($_GET['item']) : "";
$pedido = isset($_GET['pedido']) ? intval($_GET['pedido']) : "";
$cd = isset($_GET['cod_aut']) ? ($_GET['cod_aut']) : "";

if(empty($cd) || empty($item) || empty($pedido) )
{
    echo("<script language='javascript'>location.href='index.php'</script>");
    exit;
}
else
{


        list($tipo, $cd_foto) = explode('_', $cd);

            if($tipo == 'gal')
            {
                $rs1 = mysqli_query($conn, "SELECT cd_galeria, caminho_original FROM fotos_galeria WHERE cd_foto='$cd_foto'");
                list($cd_galeria, $foto) = mysqli_fetch_array($rs1, MYSQLI_BOTH);
                
                $rs1 = mysqli_query($conn, "SELECT nm_galeria, vl_foto  FROM galerias WHERE cd_galeria='$cd_galeria'");
                list($nm_evento, $vl_foto) = mysqli_fetch_array($rs1, MYSQLI_BOTH);

            }
            else
            {
                $rs1 = mysqli_query($conn, "SELECT cd_evento, caminho_original  FROM fotos_eventos WHERE cd_foto='$cd_foto'");
                list($cd_galeria, $foto) = mysqli_fetch_array($rs1, MYSQLI_BOTH);

                $rs1 = mysqli_query($conn, "SELECT nm_evento  FROM eventos WHERE cd_evento='$cd_galeria'");
                list($nm_evento) = mysqli_fetch_array($rs1, MYSQLI_BOTH);
            }

        
        $ext = end(explode(".",$foto));

        $nm_evento = accents(strtolower($nm_evento));
        $nm_evento = especiais($nm_evento);
        
        $nome = "Foto_".$nm_evento."_".$cd_foto.".".$ext;
        
        $info = getimagesize($foto);
        $tipo = $info['mime'];
        $size = filesize($foto);
        
        //list($nome, $caminho, $tipo, $size) = mysqli_fetch_array($rs, MYSQLI_BOTH);


        header("Content-Disposition: attachment; filename=$nome");
        header("Content-length: $size");
        header("Content-type: $tipo");
        readfile($foto);


}
?>
