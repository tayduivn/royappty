<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 18-07-2014
	* Version: 0.93
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	* db_connection_error
	* no_brand
	* brand_not_valid
	*	no_admin
	* admin_not_valid
	* admin_inactive
	*
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	@session_start();
	define('PATH', str_replace('\\', '/','../../../'));
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/accounts/receipts/table";
	debug_log("[".$page_path."] START");
	$response=array();
 	$response["aaData"]=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// BD CONNECTION
	if(!checkBDConnection()){echo json_encode($response);die();}

	// BRAND
	$brand=array();$brand["id_brand"]=$_SESSION["admin"]["id_brand"];
	if(!checkBrand($brand)){echo json_encode($response);die();}

	// ADMIN
	$admin=array();$admin["id_admin"]=$_SESSION["admin"]["id_admin"];
	if(!checkAdmin($admin)){echo json_encode($response);die();}


	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

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

	/*********************************************************
	* DATABASE REGISTRATION
	*********************************************************/



	/*********************************************************
	* AJAX CALL RETURN
	*********************************************************/

	debug_log("[".$page_path."] END");
	echo json_encode($response);
	die();

?>
