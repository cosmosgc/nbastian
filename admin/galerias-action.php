<?php
session_start();
session_name("admin");

require("includes/verifica_sessao.php");
require("includes/conecta_bd.php");
require("includes/anti_injection.php");
require("includes/reduz_imagem.php");
require("includes/dUnzip2.inc.php");


if(isset($_POST['acao']) && $_POST['acao'] == "cadastra")
{
    // Pega os campos enviados via POST
    foreach ($_POST as $campo => $valor) { $$campo = ($valor);}
    
    //verifica se algum dos campos est� vazio
    if(empty($nm_galeria) || empty($dt_galeria) || empty($cd_categoria) || $_FILES['arquivo']['error'] > 0 )
    {
        echo"<script language=javascript>alert('Favor preencher todos os campos.')</script>";
        echo"<script language=javascript>location.href='cadastro-galerias.php'</script>";
        exit;
    }
    else
    {
        if(!isset($dt_galeria) || empty($dt_galeria) )
            $dt_galeria = date("Y-m-d");
        else
            $dt_galeria = implode("-",array_reverse(explode("/",$dt_galeria)));
            
  //                             1.000,00
        $vl_foto = str_replace('.','',$vl_foto);
        $vl_foto = str_replace(',','.',$vl_foto);
        $vl_foto = floatval($vl_foto);

        $rs = mysql_query("INSERT INTO galerias VALUES('','$cd_categoria','$nm_galeria','$texto','$local','$dt_galeria','$tempo_duracao', '$vl_foto')") or die(mysql_error());
        $cd = mysql_insert_id();
        
        $dirLer = '../arquivos/temp/';//diret�rio que ser� varrido
        $dir = '../arquivos/temp/';//diret�rio que ser� varrido

        $arquivo = $_FILES['arquivo']['name'];
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $dirLer.$arquivo);

        
        $fotosNomes = array();

            $zip = new dUnzip2($dirLer.$arquivo);

            // Activate debug
            $zip->debug = false;

            // Unzip all the contents of the zipped file to a new folder called "uncompressed"
            $zip->getList();

            $zip->unzipAll($dir);
            
            //come�a a varrer o diret�rio com os arquivos estraidos.
            if (is_dir($dir))
            {
                if ($dh = opendir($dir))//se conseguir abrir o diret�rio continua o backup
                {
                    while (($file = readdir($dh)) !== false )//enquanto a leitura do diret�rio for bem sucedida
                    {
                        if( $file != "." && $file != "..")
                        {
                            $atributos = getimagesize($dir.$file);
                            if($atributos[2] == 1 || $atributos[2] == 2 || $atributos[2] == 3)
                            {
                                $fotosNomes[] = $dir.$file;
                            }
                        }
                    }
                closedir($dh);//fecha o diret�rio
                }//if opendir
            }//if is_dir


            //ordena pelo nome das fotos
            natcasesort($fotosNomes);
            
            @unlink($dirLer.$arquivo);
            
            $prim = time();
            $dir_dest = '../../arquivos/';
            foreach($fotosNomes as $arq)
            {
                $ext = end(explode('.',strtolower($arq)));

                $ft_grande = "../arquivos/foto_".$prim.".".$ext;
                $grandebd = "arquivos/foto_".$prim.".".$ext;

                $thumb = "../arquivos/mini_".$prim.".".$ext;
                $thumbbd = "arquivos/mini_".$prim.".".$ext;

                $original = "../arquivos/galeria_".$prim.".".$ext;
                $originalbd = "arquivos/galeria_".$prim.".".$ext;

                list($tam_x, $tam_y) = getimagesize($arq);

                    if($tam_x > $tam_y)
                    {
                        reduz_imagem($arq, 100, 75, $thumb);

                        reduz_imagem($arq, 600, 399, $ft_grande);
                    }
                    else
                    {
                        reduz_imagem($arq, 75, 57, $thumb);

                        reduz_imagem($arq, 399, 266, $ft_grande);
                    }

                    copy($arq, $original);


                    @chmod($ft_grande, 0766);


                    $res1 = mysql_query("INSERT INTO fotos_galeria VALUES('','$cd','$thumbbd','$grandebd','$originalbd','1')") or die(mysql_error());
                    $prim++;




                @unlink($arq);
            }//foreach fotos


        //echo"<script language=javascript>alert('cadastro realizado com sucesso.')</script>";
        echo"<script language=javascript>location.href='cadastro-galerias.php'</script>";
        exit;
            

    }


}
elseif(isset($_POST['acao']) && $_POST['acao'] == "edita")
{

    // Pega os campos enviados via POST
    foreach ($_POST as $campo => $valor) { $$campo = ($valor);}
    


    //verifica se algum dos campos est� vazio
    if(empty($nm_galeria) || empty($dt_galeria) || empty($cd_categoria)  )
    {
        echo"<script language=javascript>alert('Favor preencher todos os campos.')</script>";
        echo"<script language=javascript>location.href='cadastro-galerias.php?tipo=edit&cd=$cd'</script>";
        exit;
    }
    else
    {

        if(!isset($dt_galeria) || empty($dt_galeria) )
            $dt_galeria = date("Y-m-d");
        else
            $dt_galeria = implode("-",array_reverse(explode("/",$dt_galeria)));


        $vl_foto = str_replace('.','',$vl_foto);
        $vl_foto = str_replace(',','.',$vl_foto);
        $vl_foto = floatval($vl_foto);


        $rs = mysql_query("UPDATE galerias SET cd_categoria='$cd_categoria', nm_galeria='$nm_galeria',  descricao='$texto', local='$local',
        dt_galeria='$dt_galeria', tempo_duracao='$tempo_duracao', vl_foto='$vl_foto' WHERE cd_galeria='$cd'") or die(mysql_error());

        $dirLer = '../arquivos/temp/';//diret�rio que ser� varrido
        $dir = '../arquivos/temp/';//diret�rio que ser� varrido

        if($_FILES['arquivo']['error'] == 0)
        {

            //echo $_FILES['arquivo']['name'];exit;

            $arquivo = $_FILES['arquivo']['name'];
            move_uploaded_file($_FILES['arquivo']['tmp_name'], $dirLer.$arquivo);

            //echo $arquivo;

            $fotosNomes = array();

            $zip = new dUnzip2($dirLer.$arquivo);

            // Activate debug
            $zip->debug = false;

            // Unzip all the contents of the zipped file to a new folder called "uncompressed"
            $zip->getList();

            $zip->unzipAll($dir);

            //come�a a varrer o diret�rio com os arquivos estraidos.
            if (is_dir($dir))
            {
                if ($dh = opendir($dir))//se conseguir abrir o diret�rio continua o backup
                {
                    while (($file = readdir($dh)) !== false )//enquanto a leitura do diret�rio for bem sucedida
                    {
                        if( $file != "." && $file != "..")
                        {
                            $atributos = getimagesize($dir.$file);
                            if($atributos[2] == 1 || $atributos[2] == 2 || $atributos[2] == 3)
                            {
                                $fotosNomes[] = $dir.$file;
                            }
                        }
                    }
                closedir($dh);//fecha o diret�rio
                }//if opendir
            }//if is_dir


            //ordena pelo nome das fotos
            natcasesort($fotosNomes);
            
            //print_r($fotosNomes);
            //exit;

            @unlink($dirLer.$arquivo);

            $prim = time();
            $dir_dest = '../../arquivos/';
            foreach($fotosNomes as $arq)
            {
                $ext = end(explode('.',strtolower($arq)));

                $ft_grande = "../arquivos/foto_".$prim.".".$ext;
                $grandebd = "arquivos/foto_".$prim.".".$ext;

                $thumb = "../arquivos/mini_".$prim.".".$ext;
                $thumbbd = "arquivos/mini_".$prim.".".$ext;

                $original = "../arquivos/galeria_".$prim.".".$ext;
                $originalbd = "arquivos/galeria_".$prim.".".$ext;

                list($tam_x, $tam_y) = getimagesize($arq);

                    if($tam_x > $tam_y)
                    {
                        reduz_imagem($arq, 100, 75, $thumb);

                        reduz_imagem($arq, 600, 399, $ft_grande);
                    }
                    else
                    {
                        reduz_imagem($arq, 75, 57, $thumb);

                        reduz_imagem($arq, 399, 266, $ft_grande);
                    }

                    copy($arq, $original);


                    @chmod($ft_grande, 0766);


                    $res1 = mysql_query("INSERT INTO fotos_galeria VALUES('','$cd','$thumbbd','$grandebd','$originalbd','1')") or die(mysql_error());
                    $prim++;




                @unlink($arq);
            }//foreach fotos


        }


        //$rs = mysql_query("UPDATE noticias SET de_titulo='$titulo', de_conteudo='$texto', dt_noticia='$dt_noticia' WHERE cd_noticia='$cd'");


        //echo"<script language=javascript>alert('Dados atualizados com sucesso.')</script>";
        echo"<script language=javascript>location.href='cadastro-galerias.php'</script>";
        exit;

        
            }
}
elseif(isset($_POST['acao']) && $_POST['acao'] == "gerencia")
{
    //echo "<pre>";
    //print_r($_POST);
    //echo "</pre>";
    //exit;
    $cd = intval($_POST['cd']);


    foreach ($_POST as $campo => $valor) { $$campo = $valor;}
    
    $rs = mysql_query("SELECT * FROM fotos_galeria WHERE cd_galeria='$cd' ORDER BY cd_foto ASC");
    while($var = mysql_fetch_array($rs))
    {
        $valor = $var['cd_foto'];
        $rs1 = mysql_query("UPDATE fotos_galeria SET ativo='".$$valor."' WHERE cd_foto='".$valor."'");
    }


    $apagar = $_POST['apagar'];
    
    if(count($apagar))
    {
        foreach($apagar as $item)
        {

            $rs = mysql_query("SELECT * FROM fotos_galeria WHERE cd_foto='$item'");
            $ft = mysql_fetch_array($rs);
            @unlink("../".$ft['caminho_thumb']);
            @unlink("../".$ft['caminho_foto']);
            //@unlink("../".$ft['caminho_original']);
            
            $rs = mysql_query("DELETE FROM fotos_galeria WHERE cd_foto='$item'");

            //$rs = mysql_query("UPDATE fotos_galeria SET ativo='0' WHERE cd_foto='$item'");
        }

    }
    //echo"<script language=javascript>alert('Dados atualizados com sucesso.')</script>";
        echo"<script language=javascript>location.href='gerenciar-galerias.php?tipo=edit&cd=$cd'</script>";
        exit;
}
?>
