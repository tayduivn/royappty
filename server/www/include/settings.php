<?php
$conf = array(
	'bdtype' => 'mysql',
	'bdserver' => 'localhost',
	'bdport' => '',
	'bd' => 'royappty2',
	'bduser' => 'royappty2',
	'bdpass' => 'royappty2',
	'bdprefix' => ''
);
$url_server = "http://royappty2/";

$campaign_bd_type[2]="discount";
$campaign_bd_type[1]="coupon";

if($_POST["lang"] == 'es'){
	$lang="ES_es";
	$lang_email = "es";
	$_SESSION["lang"]="ES_es";
	$_SESSION["lang_email"]="es";
}
else{
	$lang="EN_en";
	$lang_email = "en";
	$_SESSION["lang"]="ES_en";
	$_SESSION["lang_email"]="en";
}

include_once(PATH."lang/".$lang.".php");
?>
