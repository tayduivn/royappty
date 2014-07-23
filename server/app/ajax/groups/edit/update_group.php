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
	*	post_no_group_id_group
	*	post_no_group_name
	*	post_no_group_users_groups
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
	$page_path="server/app/ajax/groups/edit/update_group";
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
	if(!@issetandnotempty($_POST["id_group"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing group_id_group");
		$response["error_code"]="post_no_group_id_group";
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["name"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing group_name");
		$response["error_code"]="post_no_group_name";
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["users_groups"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing group_users_groups");
		$response["error_code"]="post_no_group_users_groups";
		echo json_encode($response);
		die();
	}

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$group["id_group"]=$_POST["id_group"];
 	unset($_POST["id_group"]);


 	$table="groups";
 	$filter=array();
 	$filter["id_group"]=array("operation"=>"=","value"=>$group["id_group"]);
 	$data=array();
	foreach($_POST as $key => $value){
		$data[$key]=$value;
	}


	$user_groups= explode("::", $data["users_groups"]);

	unset($data["users_groups"]);

	$data["created"]=$timestamp;

	updateInBD($table,$filter,$data);

 	$table="user_groups";
 	$filter=array();
 	$filter["id_group"]=array("operation"=>"=","value"=>$group["id_group"]);
 	deleteInBD($table,$filter);
 	$data=array();
 	$data["id_group"]=$group["id_group"];
 	$data["id_brand"]=$_SESSION["admin"]["id_brand"];
	foreach($user_groups as $key => $id_user){
	 	$data["id_user"]=$id_user;
	 	addInBD($table,$data);
 	}


	$response["result"]=true;
	$response["data"] = $group["id_group"];


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
