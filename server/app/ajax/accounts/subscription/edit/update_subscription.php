<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
<<<<<<< HEAD
<<<<<<< HEAD
	* Last Edit: 23-06-2014
	* Version: 0.91
	*
	*********************************************************/
=======
	* Last Edit: 17-07-2014
=======
	* Last Edit: 23-07-2014
>>>>>>> 709238bf3bbd33e8717121209baf54ef0fbe0e24
	* Version: 0.93
	*
 	*********************************************************/
>>>>>>> FETCH_HEAD

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	* no_brand
	* brand_not_valid
	* no_admin
	* admin_not_valid
	* admin_inactive
	*	post_no_update_subscription_type
	*
	*
	*********************************************************/


	/*********************************************************
 	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
 	*********************************************************/

	define('PATH', str_replace('\\', '/','../../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
 	include(PATH."include/inbd.php");
	$page_path = "server/app/ajax/accounts/subscription/edit/update_subscription";
 	debug_log("[".$page_path."] START");
 	$response=array();



 	/*********************************************************
 	* DATA CHECK
 	*********************************************************/

	// BRAND
	$brand=array();$brand["id_brand"]=$_SESSION["admin"]["id_brand"];
	if(!checkBrand($brand)){echo json_encode($response);die();}

	// ADMIN
	$admin=array();$admin["id_admin"]=$_SESSION["admin"]["id_admin"];
	if(!checkAdmin($admin)){echo json_encode($response);die();}

	// POST
	if(!@issetandnotempty($_POST["subscription_type"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing update_subscription_type");
		$response["error_code"]="post_no_update_subscription_type";
		$response["error_code_str"]= $error_step_s["post_no_update_subscription_type"];
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
	die();


<<<<<<< HEAD


=======
>>>>>>> FETCH_HEAD
?>
