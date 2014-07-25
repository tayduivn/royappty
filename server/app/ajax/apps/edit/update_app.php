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
	include(PATH."functions/check_session.php");



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

	copy($data["app_icon_path"],PATH."../resources/app-icon/".$timestamp.".jpg");
	$data["app_icon_path"] = $timestamp.".jpg";
	unlink($data["app_icon_path"]);

	copy($data["app_bg_path"],PATH."../resources/app-bg/".$timestamp.".jpg");
	$data["app_bg_path"] = $timestamp.".jpg";
	unlink($data["app_icon_path"]);

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
