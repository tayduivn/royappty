<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 23-06-2014
	* Version: 0.91
	*
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:m:00"));

	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/accounts/signup/check_email_not_used";
	debug_log("[".$page_path."] START");

	$table="admins";
	$filter=array();
	$filter["email"]=array("operation"=>"=","value"=>$_GET["admin_email"]);

	if(isInBD($table,$filter)){
		echo "false";
	}else{
		echo "true";
	}

	debug_log("[".$page_path."] END");

?>
