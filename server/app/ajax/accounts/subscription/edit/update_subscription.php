<?php
	/*********************************************************
	*	
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 22-06-2014
	* Version: 1.01
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
	$page_path = "server/app/ajax/accounts/subscription/edit/update_subscription";
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
	if($data["subscription_type"]=="starter"){
		$data["expiration_date"]=-1;
	}
	updateInBD($table,$filter,$data);
	
	$response["data"]["location"]="payment_gateway/".$data["payment_method"]."/";

	

 	/*********************************************************
 	* DATABASE REGISTRATION
 	*********************************************************/



 	/*********************************************************
 	* AJAX CALL RETURN
 	*********************************************************/
	
 	echo json_encode($response);
	debug_log("[".$page_path."] END");

 		
 	
?>