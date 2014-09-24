<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 24-07-2014
	* Version: 0.93
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	* db_connection_error
	*	post_no_account_name
	*	post_no_account_email
	*	post_no_account_password
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/
	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path = "server/ryadmin/ajax/accounts/signup/add_account";
	debug_log("[".$page_path."] START");
	$response=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// SYSTEM CLOSED
if(!checkClosed()){echo json_encode($response);die();}

// BD CONNECTION
	if(!checkBDConnection()){echo json_encode($response);die();}

	//POST
	if(!@issetandnotempty($_POST["name"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing account_name");
		$response["error_code"]="post_no_account_name";
		$response["error_code_str"]= $error_step_s["post_no_account_name"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["email"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing account_email");
		$response["error_code"]="post_no_account_email";
		$response["error_code_str"]= $error_step_s["post_no_account_email"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["password"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing account_password");
		$response["error_code"]="post_no_account_password";
		$response["error_code_str"]= $error_step_s["post_no_account_password"];
		echo json_encode($response);
		die();
	}


	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/


	$response["result"]=true;

	$table="ryadmins";
	$data=array();
	$data["name"]=$_POST["name"];
	$data["email"]=$_POST["email"];
	$data["password"]=md5($_POST["password"]);
	$data["active"]=0;
	$data["created"]=$timestamp;
	$data["last_login"]=-1;
	$data["last_activity"]=-1;
	addInBD($table,$data);


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
