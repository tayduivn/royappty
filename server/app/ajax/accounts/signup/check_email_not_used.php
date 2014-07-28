<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 17-07-2014
	* Version: 0.93
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	*
	*
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));

	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/accounts/signup/check_email_not_used";
	debug_log("[".$page_path."] START");

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	$table="admins";
	$filter=array();
	$filter["email"]=array("operation"=>"=","value"=>$_GET["admin_email"]);

	if(isInBD($table,$filter)){
		echo "false";
	}else{
		echo "true";
	}

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	/*********************************************************
	* DATABASE REGISTRATION
	*********************************************************/

	/*********************************************************
	* AJAX CALL RETURN
	*********************************************************/



	debug_log("[".$page_path."] END");
	die();



?>
