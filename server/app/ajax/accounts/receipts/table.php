<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 23-06-2014
	* Version: 0.91
	*
	*********************************************************/

	@session_start();
	define('PATH', str_replace('\\', '/','../../../'));
	$timestamp=strtotime(date("Y-m-d 00:00:00"));



	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/account/receipts/table";
	debug_log("[".$page_path."] START");
	include(PATH."functions/check_session.php");




	$response=array();
 	$response["aaData"]=array();

	$table="receipts";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	if(isInBD($table,$filter)){
 		$receipts=listInBD($table,$filter);
 		foreach($receipts as $key=>$receipt){
	 		$response["aaData"][]=array(

	 			"<div class='m-b-5'><a href='".$_GET["PATH"]."my-account/subscription/receipt/?id_receipt=".$receipt["id_receipt"]."'>".$s["receipt"]." #".$receipt["id_receipt"]."</a></div><a href='".$_GET["PATH"]."my-account/subscription/receipt/?id_receipt=".$receipt["id_receipt"]."' class='btn btn-mini btn-white'>".htmlentities($s["view_receipt"], ENT_QUOTES, "UTF-8")."</a>",
	 			"<span class='pull-right'>".date("Y/m/d",$receipt["created"])."</span>",
	 			"<span class='pull-right'>".$receipt["amount"]." €</span>");
 		}

	}
	debug_log("[".$page_path."] END");

 	echo json_encode($response);

?>
