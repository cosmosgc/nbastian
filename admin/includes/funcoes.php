<?php
header('Content-Type: text/html; charset=utf-8');
function accents($text)
{
   $decodedString = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
   return $decodedString;
}

function accents_mai($text)
{
   $decodedString = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
   return $decodedString;
}

function especiais($text)
{
    $search = array('=','+','-','_','*','&','#','@','!','%','{','[','}',']','?','/','|',';',':',' ');
    $replace = array('','','','','','','','','','','','','','','','','','','','');
    $exp = str_replace($search, $replace, $text);
    return $exp;
}


function dataBd2Tela($data)
{
    return implode('/',array_reverse(explode('-',$data)));
}

function dataTela2Bd($data)
{
    return implode('-',array_reverse(explode('/',$data)));
}

function mes_literal_curto($mes)
{
    switch($mes)
    {
        case '01':
            $literal = 'JAN';
        break;
        case '02':
            $literal = 'FEV';
        break;
        case '03':
            $literal = 'MAR';
        break;
        case '04':
            $literal = 'ABR';
        break;
        case '05':
            $literal = 'MAI';
        break;
        case '06':
            $literal = 'JUN';
        break;
        case '07':
            $literal = 'JUL';
        break;
        case '08':
            $literal = 'AGO';
        break;
        case '09':
            $literal = 'SET';
        break;
        case '10':
            $literal = 'OUT';
        break;
        case '11':
            $literal = 'NOV';
        break;
        case '12':
            $literal = 'DEZ';
        break;
    }
    return $literal;
}
?>
