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
	* post_no_name
	* post_no_can_validate_codes
	* post_no_promo_password
	* post_no_can_login
	* post_no_can_manage_campaigns
	* post_no_can_manage_users
	* post_no_can_manage_app
	* post_no_can_manage_brand
	* post_no_email
	* post_no_password
	* post_no_active
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
	$page_path="server/app/ajax/admins/new/add_admin";
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
	if(!@issetandnotempty($_POST["name"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing name");
		$response["error_code"]="post_no_name";
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["can_validate_codes"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing can_validate_codes");
		$response["error_code"]="post_no_can_validate_codes";
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["promo_password"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing promo_password");
		$response["error_code"]="post_no_promo_password";
		echo json_encode($response);
		die();
	}

	if(!@issetandnotempty($_POST["can_login"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing can_login");
		$response["error_code"]="post_no_can_login";
		echo json_encode($response);
		die();
	}

	if(!@issetandnotempty($_POST["can_manage_campaigns"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing can_manage_campaigns");
		$response["error_code"]="post_no_can_manage_campaigns";
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["can_manage_admins"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing can_manage_admins");
		$response["error_code"]="post_no_can_manage_admins";
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["can_manage_users"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing can_manage_users");
		$response["error_code"]="post_no_can_manage_users";
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["can_manage_app"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing can_manage_app");
		$response["error_code"]="post_no_can_manage_app";
		echo json_encode($response);
		die();
	}

	if(!@issetandnotempty($_POST["can_manage_brand"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing can_manage_brand");
		$response["error_code"]="post_no_can_manage_brand";
		echo json_encode($response);
		die();
	}

	if(!@issetandnotempty($_POST["email"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing email");
		$response["error_code"]="post_no_email";
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["password"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing password");
		$response["error_code"]="post_no_password";
		echo json_encode($response);
		die();
	}

	if(!@issetandnotempty($_POST["active"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing active");
		$response["error_code"]="post_no_active";
		echo json_encode($response);
		die();
	}

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

 	$table="admins";
 	$data=array();
	foreach($_POST as $key => $value){
		$data[$key]=$value;
		error_log("[".$key."]=".$value);
	}
	$data["id_brand"]=$_SESSION["admin"]["id_brand"];



	$data["resume_block_1_display"] = 1;
	$data["resume_block_1_title"] = "admin_validated_this_month";
	$data["resume_block_1_data"] = "0";
	$data["resume_block_1_link_content"] = "view_more";
	$data["resume_block_1_link"] = "";

	$data["resume_block_2_display"] = 1;
	$data["resume_block_2_title"] = "admin_validated_this_today";
	$data["resume_block_2_data"] = "0";
	$data["resume_block_2_link_content"] = "view_more";
	$data["resume_block_2_link"] = "";

	$data["resume_block_3_display"] = 1;
	$data["resume_block_3_title"] = "admin_validated";
	$data["resume_block_3_data"] = "0";
	$data["resume_block_3_link_content"] = "view_more";
	$data["resume_block_3_link"] = "";


	$data["password"]=md5($data["password"]);
	$data["created"]=$timestamp;

	$response["data"]=addInBD($table,$data);



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
