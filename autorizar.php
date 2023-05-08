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
                $rs1 = mysql_query("SELECT cd_galeria, caminho_original FROM fotos_galeria WHERE cd_foto='$cd_foto'");
                list($cd_galeria, $foto) = mysql_fetch_array($rs1);
                
                $rs1 = mysql_query("SELECT nm_galeria, vl_foto  FROM galerias WHERE cd_galeria='$cd_galeria'");
                list($nm_evento, $vl_foto) = mysql_fetch_array($rs1);

            }
            else
            {
                $rs1 = mysql_query("SELECT cd_evento, caminho_original  FROM fotos_eventos WHERE cd_foto='$cd_foto'");
                list($cd_galeria, $foto) = mysql_fetch_array($rs1);

                $rs1 = mysql_query("SELECT nm_evento  FROM eventos WHERE cd_evento='$cd_galeria'");
                list($nm_evento) = mysql_fetch_array($rs1);
            }

        
        $ext = end(explode(".",$foto));

        $nm_evento = accents(strtolower($nm_evento));
        $nm_evento = especiais($nm_evento);
        
        $nome = "Foto_".$nm_evento."_".$cd_foto.".".$ext;
        
        $info = getimagesize($foto);
        $tipo = $info['mime'];
        $size = filesize($foto);
        
        //list($nome, $caminho, $tipo, $size) = mysql_fetch_array($rs);


        header("Content-Disposition: attachment; filename=$nome");
        header("Content-length: $size");
        header("Content-type: $tipo");
        readfile($foto);


}
?>
