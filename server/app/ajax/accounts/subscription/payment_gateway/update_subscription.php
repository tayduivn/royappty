<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 23-06-2014
	* Version: 0.91
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	*	- no_brand
	*	- brand_not_valid
	*	- no_user
	*	- user_not_valid
	*	- user_inactive
	*
	*********************************************************/


	/*********************************************************
 	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
 	*********************************************************/

	define('PATH', str_replace('\\', '/','../../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:m:00"));
 	include(PATH."include/inbd.php");
	$page_path = "server/app/ajax/accounts/subscription/payment_gateway/update_subscription";
 	debug_log("[".$page_path."] START");
 	$response=array();



 	/*********************************************************
 	* DATA CHECK
 	*********************************************************/


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



?>
