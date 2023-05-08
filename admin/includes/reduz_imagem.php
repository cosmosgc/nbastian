<?php

function reduz_imagem($img, $max_x, $max_y, $nome_foto)
{

    $ext = end(explode(".",strtolower($nome_foto)));

    //pega o tamanho da imagem ($original_x, $original_y)
    list($width, $height, $tipo) = getimagesize($img);

    $original_x = $width;
    $original_y = $height;

    // se a largura for maior que altura
    if($original_x > $original_y)
    {
        //$porcentagem = (100 * $max_x) / $original_x;
        $tamanho_x = $max_x;
        $tamanho_y = $max_y;
    }
    else
    {
        //$porcentagem = (100 * $max_y) / $original_y;
        $tamanho_x = $max_y;
        $tamanho_y = $max_x;
    }

    //$tamanho_x = $original_x * ($porcentagem / 100);
    //$tamanho_y = $original_y * ($porcentagem / 100);

    if($ext == "jpg" || $ext == "jpeg")
    {
        $image_p = imagecreatetruecolor($tamanho_x, $tamanho_y);
        $image   = imagecreatefromjpeg($img);
        @imagecopyresampled($image_p, $image, 0, 0, 0, 0, $tamanho_x, $tamanho_y, $width, $height);


        return imagejpeg($image_p, $nome_foto, 100);
    }
    elseif($ext == "gif")
    {
        $image_p = imagecreatetruecolor($tamanho_x, $tamanho_y);
        $image   = imagecreatefromgif($img);
        @imagecopyresampled($image_p, $image, 0, 0, 0, 0, $tamanho_x, $tamanho_y, $width, $height);


        return imagegif($image_p, $nome_foto);
    }
    if($ext == "png")
    {
        $image_p = imagecreatetruecolor($tamanho_x, $tamanho_y);
        $image   = imagecreatefrompng($img);
        @imagecopyresampled($image_p, $image, 0, 0, 0, 0, $tamanho_x, $tamanho_y, $width, $height);


        return imagepng($image_p, $nome_foto);
    }

}

?>

