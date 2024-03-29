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
	*	post_no_coupon_name
	*	post_no_coupon_description
	*	post_no_coupon_title
	*	post_no_coupon_button_title
	*	post_no_coupon_coupons_number
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/campaigns/new/add_coupon";
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
		debug_log("[".$page_path."] ERROR Data Post Missing coupon_name");
		$response["error_code"]="post_no_coupon_name";
		$response["error_code_str"]= $error_step_s["post_no_coupon_name"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["description"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing coupon_description");
		$response["error_code"]="post_no_coupon_description";
		$response["error_code_str"]= $error_step_s["post_no_coupon_description"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["title"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing coupon_title");
		$response["error_code"]="post_no_coupon_title";
		$response["error_code_str"]= $error_step_s["post_no_coupon_title"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["button_title"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing coupon_button_title");
		$response["error_code"]="post_no_coupon_button_title";
		$response["error_code_str"]= $error_step_s["post_no_coupon_button_title"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["coupons_number"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing coupon_coupons_number");
		$response["error_code"]="post_no_coupon_coupons_number";
		$response["error_code_str"]= $error_step_s["post_no_coupon_coupons_number"];
		echo json_encode($response);
		die();
	}


	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/



 	$data=array();
	foreach($_POST as $key => $value){
		$data[$key]=$value;
		error_log("[".$key."]=".$value);
	}
	$data["id_brand"]=$_SESSION["admin"]["id_brand"];

	$table="groups";
	$filter=array();
	$filter["id_group"]=array("operation"=>"=","value"=>$data["id_group"]);
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	if(isInBD($table,$filter)){
		$group=getInBD($table,$filter);
		$data["group_name"]=$group["name"];
	}else{
		$data["id_group"]=0;
		$data["group_name"]="all_users";
	}

	$table="campaigns";


	if(@issetandnotempty($data["campaign_icon_path"])){
		copy(PATH."../../".$data["campaign_icon_path"],PATH."../../server/resources/campaign-icon/".$timestamp.".jpg");
		$data["campaign_icon_path"] = $timestamp.".jpg";
	}else{
		copy(PATH."../../server/app/assets/img/default-icon.jpg",PATH."../../server/resources/campaign-icon/".$timestamp.".jpg");
		$data["campaign_icon_path"] = $timestamp.".jpg";
	}
	if(@issetandnotempty($data["campaign_image_path"])){
		copy(PATH."../../".$data["campaign_image_path"],PATH."../../server/resources/campaign-image/".$timestamp.".jpg");
		$data["campaign_image_path"] = $timestamp.".jpg";
	}else{
		copy(PATH."../../server/app/assets/img/default-icon.jpg",PATH."../../server/resources/campaign-image/".$timestamp.".jpg");
		$data["campaign_image_path"] = $timestamp.".jpg";
	}

	$data["resume_block_1_display"] = 1;
	$data["resume_block_1_title"] = "campaign_usage_this_month";
	$data["resume_block_1_data"] = "0";
	$data["resume_block_1_link_content"] = "";
	$data["resume_block_1_link"] = "";

	$data["resume_block_2_display"] = 1;
	$data["resume_block_2_title"] = "campaign_usage_today";
	$data["resume_block_2_data"] = "0";
	$data["resume_block_2_link_content"] = "";
	$data["resume_block_2_link"] = "";

	$data["resume_block_3_display"] = 1;
	$data["resume_block_3_title"] = "campaign_usage_total";
	$data["resume_block_3_data"] = "0";
	$data["resume_block_3_link_content"] = "";
	$data["resume_block_3_link"] = "";

	$data["resume_block_4_display"] = 0;
	$data["resume_block_4_title"] = "";
	$data["resume_block_4_data"] = "";
	$data["resume_block_4_link_content"] = "";
	$data["resume_block_4_link"] = "";


	$response["data"]=addInBD($table,$data);

	$table='campaigns';
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$filter["status"]=array("operation"=>"=","value"=>1);
	$campaigns_count=countInBD($table,$filter);


	$table='brands';
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$data=array();
	$data["resume_block_1_data"]=$campaigns_count;
	updateInBD($table,$filter,$data);

	$response["result"]=true;

	/*********************************************************
	* DATABASE REGISTRATION
	*********************************************************/



	/*********************************************************
	* AJAX CALL RETURN
	*********************************************************/

 	echo json_encode($response);
 	debug_log("[".$page_path."] END");
	die();
?>
