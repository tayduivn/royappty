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
	*	- no_brand
	*	- brand_not_valid
	*
	*********************************************************/


	/*********************************************************
 	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
 	*********************************************************/
 	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
 	include(PATH."include/inbd.php");
	$page_path = "server/mobile/ajax/session/signup_key";
 	debug_log("[".$page_path."] START");
 	$response=array();



 	/*********************************************************
 	* DATA CHECK
 	*********************************************************/


	if(!@issetandnotempty($_GET["phone_key"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Missing phone_key");
		$response["error"]="ERROR Data Missing Phone Key";
		$response["error_code"]="missing_phone_key";
		echo "jsonCallback(".json_encode($response).")";
		die();
	}

	$table='users';
 	$filter=array();
 	$filter["phone_key"]=array("operation"=>"=","value"=>$_GET["phone_key"]);

 	if(!isInBD($table,$filter)){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR No Phone key");
		$response["error"]="ERROR No Phone key";
		$response["error_code"]="no_phone_key";
		echo "jsonCallback(".json_encode($response).")";
		die();
 	}

 	/*********************************************************
 	* AJAX OPERATIONS
 	*********************************************************/



 	$response["result"]=true;

	$table='users';
 	$filter=array();
 	$filter["phone_key"]=array("operation"=>"=","value"=>$_GET["phone_key"]);

 	$user=getInBD($table,$filter);
 	$response["data"]=$user["id_user"];

  	$_SESSION['user']=array();
    $_SESSION['user']["id_user"] = $user["id_user"];
    $_SESSION['user']["id_brand"] = $_GET["id_brand"];

 	/*********************************************************
 	* DATABASE REGISTRATION
 	*********************************************************/



 	/*********************************************************
 	* AJAX CALL RETURN
 	*********************************************************/

 	debug_log("[".$page_path."] END");
 	echo "jsonCallback(".json_encode($response).")";
 	die();

?>
