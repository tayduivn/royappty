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
	*	post_no_coupon_name
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
	$page_path="server/app/ajax/campaigns/new/add_coupon";
	debug_log("[".$page_path."] START");
	$response=array();
	if(@issetandnotempty($_POST["lang"])){$lang=$_POST["lang"];unset($_POST["lang"]);}

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
		debug_log("[".$page_path."] ERROR Data Post Missing coupon_name");
		$response["error_code"]="post_no_coupon_name";
		$response["error_code_str"]= $error_step_s["post_no_coupon_name"];
		echo json_encode($response);
		die();
	}


	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/



 	$table="campaigns";
 	$data=array();
	foreach($_POST as $key => $value){
		$data[$key]=$value;
		error_log("[".$key."]=".$value);
	}
	$data["id_brand"]=$_SESSION["admin"]["id_brand"];




	if(@issetandnotempty($data["campaign_icon_path"])){
		copy(PATH."../../".$data["campaign_icon_path"],PATH."../../resources/campaign-icon/".$timestamp.".jpg");
		$data["campaign_icon_path"] = $timestamp.".jpg";
	}else{
		copy(PATH."../../server/app/assets/img/default-icon.jpg",PATH."../../resources/campaign-icon/".$timestamp.".jpg");
		$data["campaign_icon_path"] = $timestamp.".jpg";
	}
	if(@issetandnotempty($data["campaign_image_path"])){
		copy(PATH."../../".$data["campaign_image_path"],PATH."../../resources/campaign-image/".$timestamp.".jpg");
		$data["campaign_image_path"] = $timestamp.".jpg";
	}else{
		copy(PATH."../../server/app/assets/img/default-icon.jpg",PATH."../../resources/campaign-image/".$timestamp.".jpg");
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
