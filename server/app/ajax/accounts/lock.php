<?php
	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d 00:00:00"));

	
	
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/accounts/lock";
	debug_log("[".$page_path."] START");
	
 	$response=array();
 	
 	
	$response["result"]=true;
	
	$response["data"]["lock-data"]="
		<div class='text-center' style='height:100%'>	
			<img class='m-t-40 m-b-0' style='width:320px' src='".$url_server."server/app/assets/img/lock-logo.png' />
			<h3>".htmlentities($s["lock_account_title"], ENT_QUOTES, "UTF-8")."</h3>
			<h5 class='p-b-20'>".htmlentities($s["lock_account_subtitle"], ENT_QUOTES, "UTF-8")."</h5>
			<a href='../../' class='btn btn-white'>Salir</a> <a href='../active/' class='btn btn-white'>Activar</a>
		</div>
		
	";
	

 	echo json_encode($response);
	debug_log("[server/ajax/campaigns/get_campaign] END");

?>