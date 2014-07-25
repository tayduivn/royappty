<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 23-07-2014
	* Version: 0.93
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	* no_brand
	* brand_not_valid
	* no_admin
	* admin_not_valid
	* admin_inactive
	*	post_no_id_admin
	* post_no_name
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
	$page_path="server/app/ajax/admins/edit/update_admin";
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
	if(!@issetandnotempty($_POST["id_admin"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing id_admin");
		$response["error_code"]="post_no_id_admin";
		$response["error_code_str"]= $error_step_s["post_no_id_admin"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["name"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing name");
		$response["error_code"]="post_no_name";
		$response["error_code_str"]= $error_step_s["post_no_name"];
		echo json_encode($response);
		die();
	}




	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

 	$table="admins";
 	$filter=array();
 	$filter["id_admin"]=array("operation"=>"=","value"=>$_POST["id_admin"]);
	debug_log("[".$page_path."] Filter[id_admin]=".$_POST["id_admin"]);
	$response["data"]=$_POST["id_admin"];

 	unset($_POST["id_admin"]);
 	$data=array();

	foreach($_POST as $key => $value){
		debug_log("[".$page_path."] DATA[".$key."]=".$value);
		$data[$key]=$value;
	}
	$data["id_brand"]=$_SESSION["admin"]["id_brand"];

	if (@issetandnotempty($data["password"])){$data["password"]=md5($data["password"]);}else{unset($data["password"]);}


	updateInBD($table,$filter,$data);


	$response["result"]=true;

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
