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
 	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:m:00"));
 	include(PATH."mobile/include/inbd.php");
	$page_path = "server/mobile/ajax/session/create";
 	debug_log("[".$page_path."] START");
 	$response=array();
 	
 	
 	
 	/*********************************************************
 	* DATA CHECK
 	*********************************************************/
 	
 	// BRAND 
 	$brand=array();$brand["id_brand"]=$_POST["id_brand"];
	if(!checkBrand($brand)){echo json_encode($response);die();}	
 	// USER
  	$user=array();$user["id_user"]=($_POST["id_user"]-1);
	if(!checkUser($user)){echo json_encode($response);die();}	
 	
 	
 	
 	/*********************************************************
 	* AJAX OPERATIONS
 	*********************************************************/
 	
 	$response["result"]=true;
  	$_SESSION['user']=array();
    $_SESSION['user']["id_user"] = $_POST["id_user"];
    $_SESSION['user']["id_brand"] = $_POST["id_brand"];
	debug_log("[".$page_path."] Session Created user:{id_user:".$_SESSION['user']["id_user"].",id_brand:".$_SESSION['user']["id_brand"]."}");



 	/*********************************************************
 	* DATABASE REGISTRATION
 	*********************************************************/
 	
 	$table="users";
 	$filter=array();
 	$filter["id_user"]=array("operation"=>"=","value"=>$_POST["id_user"]);
 	$data=array();
 	$data["last_connection"] = strtotime(date("Y-m-d H:i:00"));
 	updateInBD($table,$filter,$data);
	debug_log("[".$page_path."] User (".$_SESSION['user']["id_user"].") Update last_connection:".$data["last_connection"]);
 	
 	
 	
 	/*********************************************************
 	* AJAX CALL RETURN
 	*********************************************************/
 	
 	debug_log("[".$page_path."] END");
 	echo json_encode($response);
 	
 	
?>