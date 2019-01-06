<?php
require_once("config.php");
$link = "https://www.google.com.br/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png";
$teste = new FileClass($link);
$nome = $teste->download();
$teste->upload();
?>
<img src="<?=$nome?>">
