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
	* no_brand
	* brand_not_valid
	* no_admin
	* admin_not_valid
	* admin_inactive
	*	post_no_app_name
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
	$page_path = "server/app/ajax/apps/edit/update_app";
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
	if(!@issetandnotempty($_POST["name"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing app_name");
		$response["error_code"]="post_no_app_name";
		$response["error_code_str"]= $error_step_s["post_no_app_name"];
		echo json_encode($response);
		die();
	}


 	/*********************************************************
 	* AJAX OPERATIONS
 	*********************************************************/

	$response["result"]=true;

	$table="brand_user_fields";
	$filter=array();
 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
 	deleteInBD($table,$filter);
 	$brand_user_fields=explode("::", $_POST["brand_user_fields"]);
	$table="brand_user_fields";
	$data=array();
	$data["id_brand"]=$_SESSION["admin"]["id_brand"];
 	foreach($brand_user_fields as $key=>$id_user_field){
	 	$data["id_user_field"]=$id_user_field;
	 	addInBD($table,$data);
 	}
  	unset($_POST["brand_user_fields"]);

 	$table="apps";
  	$filter=array();
 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);

 	$data=array();
	foreach($_POST as $key => $value){
		$data[$key]=$value;
	}
	unset($data["id_app"]);

	if(@issetandnotempty($data["app_icon_path"])){
		copy(PATH."../../".$data["app_icon_path"],PATH."../../server/resources/app-icon/".$timestamp.".jpg");
		$data["app_icon_path"] = $timestamp.".jpg";
	}else{
		unset($data["app_icon_path"]);
	}
	if(@issetandnotempty($data["app_bg_path"])){
		copy(PATH."../../".$data["app_bg_path"],PATH."../../server/resources/app-bg/".$timestamp.".jpg");
		$data["app_bg_path"] = $timestamp.".jpg";
	}else{
		unset($data["app_bg_path"]);
	}

	updateInBD($table,$filter,$data);




 	/*********************************************************
 	* DATABASE REGISTRATION
 	*********************************************************/

	$table="requests";
	$data=array();
	$data["code"]=strtoupper(dechex(strtotime(date("Y-m-d H:i:s")).$_SESSION["admin"]["id_brand"]));
	$data["id_brand"]=$_SESSION["admin"]["id_brand"];
	$data["type"]="app_update";
	$data["status"]="in_process";
	$data["created"]=$timestamp;
	addInBD($table,$data);


 	/*********************************************************
 	* AJAX CALL RETURN
 	*********************************************************/

 	debug_log("[".$page_path."] END");
 	echo json_encode($response);
	die();

?>
