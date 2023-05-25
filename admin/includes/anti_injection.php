<?php
header('Content-Type: text/html; charset=utf-8');
function anti_injection($txt)
{
//$txt = get_magic_quotes_gpc() == 0 ? addslashes($txt) : $txt;
//return preg_replace("@(--|\#|\*|;|=)@s", "", $txt);
    return $txt;
}

?>
