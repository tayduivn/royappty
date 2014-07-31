<?php
$conf = array(
	'bdtype' => 'mysql',
	'bdserver' => 'localhost',
<<<<<<< HEAD
	'bdport' => '3306',
	'bd' => 'royappty3',
	'bduser' => 'royappty3',
	'bdpass' => 'royappty3',
	'bdprefix' => ''
);
$url_server = "http://royappty3/";
=======
	'bdport' => '',
	'bd' => 'royappty2',
	'bduser' => 'royappty2',
	'bdpass' => 'royappty2',
	'bdprefix' => ''
);
$url_server = "http://royappty2/";
>>>>>>> 2f19903fc7e29b61f9fa6ebb7ddb079a1d81adc1

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
