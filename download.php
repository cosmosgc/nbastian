<?php
include("admin/includes/conecta_bd.php");
$cd = isset($_GET['cd']) ? intval($_GET['cd']) : "";

if(empty($cd))
{
    echo("<script language='javascript'>location.href='./'</script>");
    exit;
}
else
{
    //incrementa o contador de downloads.
    $rs = mysqli_query($conn, "UPDATE imprensa_fotos SET nr_downloads=nr_downloads+1 WHERE cd_foto='$cd'") or die(mysqli_error());

    //pega informações
    $rs = mysqli_query($conn, "SELECT * FROM imprensa_fotos WHERE cd_foto='$cd'") or die(mysqli_error());

        
    $foto = mysqli_fetch_array($rs, MYSQLI_BOTH);
    
    $dados = getimagesize($foto['caminho_foto']);


    header("Content-Disposition: attachment; filename=".$foto['nm_original']);
    header("Content-length: ".filesize($foto['caminho_foto']));
    header("Content-type: ".$dados['mime']);
    readfile($foto['caminho_foto']);
    

}
?>
