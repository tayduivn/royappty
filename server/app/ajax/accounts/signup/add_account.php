<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 20-08-2014
	* Version: 0.94
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	* db_connection_error
	*	post_no_account_name
	*	post_no_account_cif
	*	post_no_account_contact_address
	* post_no_account_contact_postal_code
	*	post_no_account_contact_city
	*	post_no_account_contact_country
	*	post_no_account_admin_name
	*	post_no_account_admin_email
	*	post_no_account_admin_password
	*	post_no_account_subscription_type
	*	post_no_account_payment_plan
	*	post_no_account_payment_method
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/
	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path = "server/app/ajax/accounts/signup/add_account";
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
		// poner el codigo del lang
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["cif"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing account_cif");
		$response["error_code"]="post_no_account_cif";
		$response["error_code_str"]= $error_step_s["post_no_account_cif"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["contact_address"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing account_contact_address");
		$response["error_code"]="post_no_account_contact_address";
		$response["error_code_str"]= $error_step_s["post_no_account_contact_address"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["contact_postal_code"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing account_contact_postal_code");
		$response["error_code"]="post_no_account_contact_postal_code";
		$response["error_code_str"]= $error_step_s["post_no_account_contact_postal_code"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["contact_city"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing account_contact_city");
		$response["error_code"]="post_no_account_contact_city";
		$response["error_code_str"]= $error_step_s[""];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["contact_country"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing account_contact_country");
		$response["error_code"]="post_no_account_contact_country";
		$response["error_code_str"]= $error_step_s["post_no_account_contact_country"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["admin_name"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing account_admin_name");
		$response["error_code"]="post_no_account_admin_name";
		$response["error_code_str"]= $error_step_s["post_no_account_admin_name"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["admin_email"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing account_admin_email");
		$response["error_code"]="post_no_account_admin_email";
		$response["error_code_str"]= $error_step_s["post_no_account_admin_email"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["admin_password"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing account_admin_password");
		$response["error_code"]="post_no_account_admin_password";
		$response["error_code_str"]= $error_step_s["post_no_account_admin_password"];
		echo json_encode($response);
		die();
	}

	if(!@issetandnotempty($_POST["subscription_type"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing account_subscription_type");
		$response["error_code"]="post_no_account_subscription_type";
		$response["error_code_str"]= $error_step_s["post_no_account_subscription_type"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["payment_plan"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing account_payment_plan");
		$response["error_code"]="post_no_account_payment_plan";
		$response["error_code_str"]= $error_step_s["post_no_account_payment_plan"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["payment_method"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing account_payment_method");
		$response["error_code"]="post_no_account_payment_method";
		$response["error_code_str"]= $error_step_s["post_no_account_payment_method"];
		echo json_encode($response);
		die();
	}


	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/


	$response["result"]=true;

	$table="brands";
	$data=array();
	$data["name"]=$_POST["name"];
	$data["cif"]=$_POST["cif"];
	$data["active"]=1;
	$data["created"]=$timestamp;



	$data["resume_block_1_display"] = 1;
	$data["resume_block_1_title"] = "campaigns";
	$data["resume_block_1_data"] = "0";
	$data["resume_block_1_link_content"] = "";
	$data["resume_block_1_link"] = "";

	$data["resume_block_2_display"] = 1;
	$data["resume_block_2_title"] = "usage_this_month";
	$data["resume_block_2_data"] = "0";
	$data["resume_block_2_link_content"] = "";
	$data["resume_block_2_link"] = "";

	$data["resume_block_3_display"] = 1;
	$data["resume_block_3_title"] = "usage_this_today";
	$data["resume_block_3_data"] = "0";
	$data["resume_block_3_link_content"] = "";
	$data["resume_block_3_link"] = "";

	$data["resume_block_4_display"] = 1;
	$data["resume_block_4_title"] = "users";
	$data["resume_block_4_data"] = "0";
	$data["resume_block_4_link_content"] = "";
	$data["resume_block_4_link"] = "";


	$data["subscription_type"]=$_POST["subscription_type"];
	$data["expiration_date"]=-1;
	if($data["subscription_type"]=="starter"){
		$data["expiration_date"]=strtotime("+3 month", $timestamp);
	}else if($data["subscription_type"]=="professional"){
		$data["expiration_date"]=strtotime("+3 month", $timestamp);
	}
	$data["contact_name"]=$_POST["name"];
	$data["contact_email"]=$_POST["email"];
	$data["contact_phone"]=$_POST["contact_phone"];
	$data["contact_address"]=$_POST["contact_address"];
	$data["contact_postal_code"]=$_POST["contact_postal_code"];
	$data["contact_city"]=$_POST["contact_city"];
	$data["contact_province"]=$_POST["contact_province"];
	$data["contact_country"]=$_POST["contact_country"];
	$data["payment_method"]=$_POST["payment_method"];
	$data["payment_plan"]=$_POST["payment_plan"];

	$brand=array();
	$brand["id_brand"]=addInBD($table,$data);

	$brand["num_code"] = str_pad($brand["id_brand"], 5, '0', STR_PAD_LEFT);

	copy(PATH."../resources/defaults/app_icon.png",PATH."../resources/app-icon/".$timestamp.".png");
	copy(PATH."../resources/defaults/app_bg.jpg",PATH."../resources/app-bg/".$timestamp.".jpg");

	$table="apps";
	$data=array();
	$data["id_brand"] =	$brand["id_brand"];
	$data["name"] = $_POST["app_name"];
	$data["project_codename"] = normalize_str(strtolower(str_replace(' ', '', $_POST["app_name"])));
	$data["apk_name"] = substr($data["project_codename"],0,10);
	$data["package_address"] = $CONFIG["component_url_prefix"].".".$data["apk_name"];
	$data["android_project_id"] = "ry-".$brand["num_code"]."-".$data["apk_name"];
	$data["description"] = $_POST["app_name"];
	$data["published_apple_store"] = 1;
	$data["published_google_play"] = 1;
	$data["app_title"] = $_POST["name"];
	
	$data["app_icon_path"] = $timestamp.".png";
	$data["app_bg_path"] = $timestamp.".jpg";
	$data["automatic_screenshots"] = 0;
	$data["app_screenshot_1_path"] = "";
	$data["app_screenshot_2_path"] = "";
	$data["app_screenshot_3_path"] = "";
	$data["app_screenshot_4_path"] = "";
	addInBD($table,$data);
	
	$table="user_fields";
	$filter=array();
	$filter["default_field"]=array("operation"=>"=","value"=>1);
	$default_user_field=getInBD($table,$filter);

	$table="brand_user_fields";
	$data=array();
	$data["id_brand"]=$brand["id_brand"];
	$data["id_user_field"]=$default_user_field["id_user_field"];
	$data["main_field"]=1;
	addInBD($table,$data);
	
	create_app_folder(PATH."../",$brand["project_codename"]);
	
	$table="admins";
	$data=array();
	$data["id_brand"]=$brand["id_brand"];
	$data["brand_admin"]=1;
	$data["email"]=$_POST["admin_email"];
	$data["name"]=$_POST["admin_name"];
	$data["password"]=md5($_POST["admin_password"]);
	$data["active"]=1;
	$data["verified"]=0;
	$data["verification_code"]=md5("verification".$_POST["admin_email"].$timestamp);
	$data["created"]=$timestamp;
	$data["last_connection"]=0;

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

	$data["can_login"]=1;
	$data["can_validate_codes"]=0;
	$data["can_manage_campaigns"]=1;
	$data["can_manage_admins"]=1;
	$data["can_manage_users"]=1;
	$data["can_manage_app"]=1;
	$data["can_manage_brand"]=1;

 	$admin=array();
 	$admin["id_admin"]=addInBD($table,$data);

	$admin["verification_code"]=$data["verification_code"];
	$admin["email"]=$data["email"];


	$mail_for=$admin["email"];
	$mail_content=htmlentities($signup_s["mail_content_header"], ENT_QUOTES, "UTF-8")."<br/><br/><a href='".$url_server."app/verification/?code=".$admin["verification_code"]."'></a>".$url_server."app/verification/?code=".$admin["verification_code"]."<br/><br/>".htmlentities($signup_s["mail_content_footer"], ENT_QUOTES, "UTF-8");
	$mail_subject=htmlentities($signup_s["mail_subject"], ENT_QUOTES, "UTF-8");
	corporate_email($mail_for,$mail_subject,$mail_content);


	/*********************************************************
	* DATABASE REGISTRATION
	*********************************************************/

	$table="requests";
	$data=array();
	$data["code"]=strtoupper(dechex(strtotime(date("Y-m-d H:i:s")).$brand["id_brand"]));
	$data["id_brand"]=$brand["id_brand"];
	$data["type"]="account_creation";
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
