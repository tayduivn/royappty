<?php
/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 23-06-2014
* Version: 0.93
*
*********************************************************/

$conf = array(
	'bdtype' => 'mysql',
	'bdserver' => 'localhost',
	'bdport' => '',
	'bd' => 'royappty',
	'bduser' => 'root',
	'bdpass' => 'root',
	'bdprefix' => ''
);
$url_server = "http://localhost:8888/royappty/";

$campaign_bd_type[2]="discount";
$campaign_bd_type[1]="coupon";

$lang = "ES_es";
$lang_email = "es";
include_once(PATH."lang/".$lang.".php");
?>
