<?php

	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:m:00"));



	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/admins/new/add_admin";
	debug_log("[".$page_path."] START");


	$response=array();


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
	$data["contact_name"]=$_POST["contact_name"];
	$data["contact_email"]=$_POST["contact_email"];
	$data["contact_phone"]=$_POST["contact_phone"];
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

 	$table="apps";
 	$data=array();

	$data["id_brand"]=$brand["id_brand"];
	$data["name"]=$_POST["app_name"];

	$app=array();
	$app["id_app"]=addInBD($table,$data);



 	echo json_encode($response);

 	debug_log("[".$page_path."] END");
?>
