<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 23-06-2014
	* Version: 0.91
	*
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d 00:00:00"));



	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/accounts/receipts/list";
	debug_log("[".$page_path."] START");
	include(PATH."functions/check_session.php");

 	$response=array();




	$response["result"]=true;
 	$response["data"]["page-title"] = "<a href='../../'>".htmlentities($s["my_account"], ENT_QUOTES, "UTF-8")."</a> / <a href='../'>".htmlentities($s["subscription"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["receipts"], ENT_QUOTES, "UTF-8");
 	$response["data"]["table-header"] = "
 		<th style='width:43%'>".htmlentities($s["receipt_number"], ENT_QUOTES, "UTF-8")."</th>
        <th style='width:20%'>".htmlentities($s["date"], ENT_QUOTES, "UTF-8")."</th>
        <th style='width:10%'>".htmlentities($s["amount"], ENT_QUOTES, "UTF-8")."</th>";

 	$response["data"]["tabs"]="
        	<li class='active'><a href='?status=0'>".htmlentities($s["all_receipts"], ENT_QUOTES, "UTF-8")."</a></li>
    ";



 	echo json_encode($response);
	debug_log("[server/ajax/accounts/receipts/list] END");

?>
