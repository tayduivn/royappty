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
	* db_connection_error
	* no_brand
	* brand_not_valid
	* no_admin
	* admin_not_valid
	* admin_inactive
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
	$page_path="server/app/ajax/notifications/new/add_notification";
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
	if(!@issetandnotempty($_POST["content"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing content");
		$response["error_code"]="post_no_content";
		$response["error_code_str"]= $error_step_s["post_no_content"];
		echo json_encode($response);
		die();
	}

	$table="groups";
	if(@$_POST["id_group"]!=0){
			$filter=array();
			$filter["id_group"]=array("operation"=>"=","value"=>$_POST["id_group"]);
			if(!isInBD($table,$filter)){
				$response["result"]=false;
				debug_log("[".$page_path."] ERROR Data Post Group doen't exists");
				$response["error_code"]="post_notification_no_group";
				$response["error_code_str"]= $error_step_s["post_notification_no_group"];
				echo json_encode($response);
				die();
			}
	}



	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$response["result"]=true;

	$table="brands";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$brand["id_brand"]);
	$brand=getInBD($table,$filter);

	$table="apps";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$brand["id_brand"]);
	$app=getInBD($table,$filter);


	$data=array();
	$data["content"] = $_POST["content"];
	$data["id_brand"] = $_SESSION["admin"]["id_brand"];
	$data["id_group"] = $_POST["id_group"];

	if($_POST["id_group"]!=0){
		$table="groups";
		$filter=array();
		$filter["id_group"]=array("operation"=>"=","value"=>$_POST["id_group"]);
		$group=getInBD($table,$filter);
		$data["group_name"] = $group["name"];

		$table="user_groups";
		$filter=array();
		$filter["id_group"]=array("operation"=>"=","value"=>$group["id_group"]);
		$user_groups=listInBD($table,$filter);
		foreach($user_groups as $key => $user_group){
			$table="user";
			$filter=array();
			$filter["id_user"]=array("operation"=>"=","value"=>$user_group["id_user"]);
			$user=getInBD($table,$filter);
			if($user["platform"]=="android"){
				sendMessageToAndroid($user["phone_key"], $brand["android_project_number"], $data["content"], $app["name"], $brand["android_server_key"]);
			}
			if($user["platform"]=="ios"){
				sendMessageToiOS($user["phone_key"], $brand["android_project_number"], $data["content"], $app["name"], PATH."../resources/mobile-app/".$app["project_codename"]."/apns-cert.pem");
			}
		}

	}else{
		$data["group_name"] = $s["all_users"];
		$table="users";
		$filter=array();
		$filter["id_brand"]=array("operation"=>"=","value"=>$brand["id_brand"]);
		$users=listInBD($table,$filter);
		foreach($users as $key => $user){
			debug_log("[".$page_path."] Send Notification (User:".$user["id_user"].") START");
			if($user["platform"]=="android"){
				sendMessageToAndroid($user["phone_key"], $brand["android_project_number"], $data["content"], $app["name"], $brand["android_server_key"]);
			}
			if($user["platform"]=="ios"){
				sendMessageToiOS($user["phone_key"], $brand["android_project_number"], $data["content"], $app["name"], PATH."../resources/mobile-app/".$app["project_codename"]."/apns-cert.pem");
			}
			debug_log("[".$page_path."] Send Notification (User:".$user["id_user"].") END");
		}
	}

	$data["created"] = $timestamp;
	$table="notifications";
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
