<?php
/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 26-08-2014
* Version: 0.94
*
*********************************************************/

$server_option='server';

switch ($server_option){
	case "local":
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

		break;
	case "server":
		$conf = array(
			'bdtype' => 'mysql',
			'bdserver' => 'localhost',
			'bdport' => '',
			'bd' => 'royappty',
			'bduser' => 'root',
			'bdpass' => '2CuW2St9c',
			'bdprefix' => ''
		);
		$url_server = "http://www.royappty.com/";
		break;
}

$campaign_bd_type[2]="discount";
$campaign_bd_type[1]="coupon";

?>
