<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 07-07-2014
	* Version: 0.91
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
	$page_path = "server/app/ajax/accounts/signup/add_acount";
	debug_log("[".$page_path."] START");
	$response=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/



	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/


	$response["result"]=true;

	$table="brands";
	$data=array();
	$data["name"]=$_POST["name"];
	$data["cif"]=$_POST["cif"];
	$data["active"]=1;
	$data["app_name"]=$_POST["app_name"];

	$data["resume_block_1_display"] = 1;
	$data["resume_block_1_title"] = "campaigns";
	$data["resume_block_1_data"] = "0";
	$data["resume_block_1_link_content"] = "view_more";
	$data["resume_block_1_link"] = "";

	$data["resume_block_2_display"] = 1;
	$data["resume_block_2_title"] = "usage_this_month";
	$data["resume_block_2_data"] = "0";
	$data["resume_block_2_link_content"] = "view_more";
	$data["resume_block_2_link"] = "";

	$data["resume_block_3_display"] = 1;
	$data["resume_block_3_title"] = "usage_this_today";
	$data["resume_block_3_data"] = "0";
	$data["resume_block_3_link_content"] = "view_more";
	$data["resume_block_3_link"] = "";

	$data["resume_block_4_display"] = 1;
	$data["resume_block_4_title"] = "users";
	$data["resume_block_4_data"] = "0";
	$data["resume_block_4_link_content"] = "view_more";
	$data["resume_block_4_link"] = "";


	$data["subscription_type"]=$_POST["subscription_type"];
	if($data["subscription_type"]=="welcome"){
		$data["expiration_date"]=strtotime("+3 month", $timestamp);
	}else if($data["subscription_type"]=="starter"){
		$data["expiration_date"]=-1;
	}
	$data["contact_address"]=$_POST["contact_address"];
	$data["contact_postal_code"]=$_POST["contact_postal_code"];
	$data["contact_city"]=$_POST["contact_city"];
	$data["contact_country"]=$_POST["contact_country"];
	$data["payment_method"]=$_POST["payment_method"];
	$data["payment_plan"]=$_POST["payment_plan"];

	$brand=array();
	$brand["id_brand"]=addInBD($table,$data);

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
	$data["can_validate_codes"]=1;
	$data["can_manage_campaigns"]=1;
	$data["can_manage_admins"]=1;
	$data["can_manage_users"]=1;
	$data["can_manage_app"]=1;
	$data["can_manage_brand"]=1;

 	$admin=array();
 	$admin["id_admin"]=addInBD($table,$data);

	$admin["verification_code"]=$data["verification_code"];
	$admin["email"]=$data["email"];


	$app=array();

	if(issetandnotempty($_POST["app_icon_path"])){
		copy(PATH."../../".$_POST["app_icon_path"],PATH."../../resources/app-icon/".$timestamp.".jpg");
		$app["app_icon_path"] = $timestamp.".jpg";
	}else{
		copy(PATH."../../server/app/assets/img/default-app-icon.jpg",PATH."../../resources/app-icon/".$timestamp.".jpg");
		$app["app_icon_path"] = $timestamp.".jpg";
	}
	if(issetandnotempty($_POST["app_bg_path"])){
		copy(PATH."../../".$_POST["app_bg_path"],PATH."../../resources/app-bg/".$timestamp.".jpg");
		$app["app_bg_path"] = $timestamp.".jpg";
	}else{
		copy(PATH."../../server/app/assets/img/default-app-background.jpg",PATH."../../resources/app-bg/".$timestamp.".jpg");
		$app["app_bg_path"] = $timestamp.".jpg";
	}

	$table="apps";
 	$data=array();

	$data["id_brand"]=$brand["id_brand"];
	$data["name"]=$_POST["app_name"];
	$data["app_title"]=$_POST["app_title"];
	$data["description"]=$_POST["app_description"];
	$data["app_icon_path"]=$app["app_icon_path"];
	$data["app_bg_path"]=$app["app_bg_path"];

	$app["id_app"]=addInBD($table,$data);

	$table="brand_user_fields";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$brand["id_brand"]);
	deleteInBD($table,$filter);
	$brand_user_fields=explode("::", $_POST["brand_user_fields"]);
	$table="brand_user_fields";
	$data=array();
	$data["id_brand"]=$brand["id_brand"];
	foreach($brand_user_fields as $key=>$id_user_field){
		$data["id_user_field"]=$id_user_field;
		$data["main_field"]=1;
		addInBD($table,$data);
	}

	$mail_for=$admin["email"];
	$mail_content=htmlentities($signup_s["mail_content_header"], ENT_QUOTES, "UTF-8")."<br/><br/><a href='".$url_server."app/verification/?code=".$admin["verification_code"]."'></a>".$url_server."app/verification/?code=".$admin["verification_code"]."<br/><br/>".htmlentities($signup_s["mail_content_footer"], ENT_QUOTES, "UTF-8");
	$mail_subject=htmlentities($signup_s["mail_subject"], ENT_QUOTES, "UTF-8");
	corporate_email($mail_for,$mail_subject,$mail_content);


	/*********************************************************
	* DATABASE REGISTRATION
	*********************************************************/

	$table="requests";
	$data=array();
	$data["code"]=strtoupper(dechex(strtotime(date("Y-m-d H:i:s")).$_SESSION["admin"]["id_brand"]));
	$data["id_brand"]=$brand["id_brand"];
	$data["type"]="app_creation";
	$data["status"]="in_process";
	$data["created"]=$timestamp;
	addInBD($table,$data);


	/*********************************************************
	* AJAX CALL RETURN
	*********************************************************/

	debug_log("[".$page_path."] END");
 	echo json_encode($response);

?>
