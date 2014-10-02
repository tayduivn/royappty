<?php
	/************************************************************
	* Royappty
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Modification: 10-02-2014
	* Version: 1.0
	* licensed through CC BY-NC 4.0
	************************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	* db_connection_error
	* no_brand
	* brand_not_valid
	* no_admin
	* admin_not_valid
	* admin_inactive
	*	post_no_payment_gateway_payment_data
	*
	*********************************************************/


	/*********************************************************
 	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
 	*********************************************************/

	define('PATH', str_replace('\\', '/','../../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
 	include(PATH."include/inbd.php");
	$page_path = "server/app/ajax/accounts/subscription/payment_gateway/update_subscription";
 	debug_log("[".$page_path."] START");
 	$response=array();




 	/*********************************************************
 	* DATA CHECK
 	*********************************************************/

	// SYSTEM CLOSED
if(!checkClosed()){echo json_encode($response);die();}

// BD CONNECTION
	if(!checkBDConnection()){echo json_encode($response);die();}

	// BRAND
	$brand=array();$brand["id_brand"]=$_SESSION["admin"]["id_brand"];
	if(!checkBrand($brand)){echo json_encode($response);die();}

	// ADMIN
	$admin=array();$admin["id_admin"]=$_SESSION["admin"]["id_admin"];
	if(!checkAdmin($admin)){echo json_encode($response);die();}

	// POST
	if(!@issetandnotempty($_POST["payment_data"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing payment_gateway_payment_data");
		$response["error_code"]="post_no_payment_gateway_payment_data";
		$response["error_code_str"]= $error_step_s["post_no_payment_gateway_payment_data"];
		echo json_encode($response);
		die();
	}

	/*********************************************************
 	* AJAX OPERATIONS
 	*********************************************************/

 	$response["result"]=true;

 	$table="brands";
	$filter=array();
 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
 	foreach($_POST as $key => $value){
		$data[$key]=$value;
	}
	updateInBD($table,$filter,$data);


 	/*********************************************************
 	* DATABASE REGISTRATION
 	*********************************************************/

 	$table="requests";
	$data=array();
	$data["id_brand"]=$_SESSION["admin"]["id_brand"];
	$data["code"]=strtoupper(dechex(strtotime(date("Y-m-d H:i:s")).$_SESSION["admin"]["id_brand"]));
	$data["type"]="standing_order_payment_confirmation";
	$data["status"]="in_process";
	$data["created"]=$timestamp;
	$request=array();
	$request["id_request"]=addInBD($table,$data);


 	/*********************************************************
 	* AJAX CALL RETURN
 	*********************************************************/

 	echo json_encode($response);
	debug_log("[".$page_path."] END");
	die();

?>
