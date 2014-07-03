<?php
	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d 00:00:00"));

	
	
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/users/list";
	debug_log("[".$page_path."] START");
	include(PATH."functions/check_session.php");
	
 	$response=array();
 	

 	
	
	$response["result"]=true;
 	$response["data"]["page-title"] = "<a href='./'>".htmlentities($s["users"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["all_users"], ENT_QUOTES, "UTF-8");
 	$response["data"]["table-header"] = "
 		<th style='width:30%'>".htmlentities($s["name"], ENT_QUOTES, "UTF-8")."</th>
        <th style='width:20%' class='text-right'>".htmlentities($s["used_codes"], ENT_QUOTES, "UTF-8")."</th>
        <th style='width:20%' class='text-right'>".htmlentities($s["creation_date"], ENT_QUOTES, "UTF-8")."</th>
        <th style='width:30%;' class='text-right'>".htmlentities($s["last_connection"], ENT_QUOTES, "UTF-8")."</th>";
 	
 	$response["data"]["tabs"]="
        	<li class='active'><a href='?status=0'>".htmlentities($s["all_users"], ENT_QUOTES, "UTF-8")."</a></li>           
    ";
 	$response["data"]["modals"]=" 	
	
	";
	
	
	

 	echo json_encode($response);
	debug_log("[server/ajax/users/get_user] END");

?>