<?php
function anti_injection($txt)
{
$txt = get_magic_quotes_gpc() == 0 ? addslashes($txt) : $txt;
return preg_replace("@(--|\#|\*|;|=)@s", "", $txt);
}

?>
