<?php
<<<<<<< HEAD
/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 23-06-2014
* Version: 0.91
*
*********************************************************/

=======
error_log("settings");
>>>>>>> FETCH_HEAD
$conf = array(
	'bdtype' => 'mysql',
	'bdserver' => 'localhost',
	'bdport' => '3306',
	'bd' => 'royappty2',
	'bduser' => 'royappty3',
	'bdpass' => 'royappty3',
	'bdprefix' => ''
);
$url_server = "http://royappty2/";

$campaign_bd_type[2]="discount";
$campaign_bd_type[1]="coupon";

$lang = "ES_es";
$lang_email = "es";
include_once(PATH."lang/".$lang.".php");
error_log("settings end");
?>
