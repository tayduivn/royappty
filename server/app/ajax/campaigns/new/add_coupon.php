<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 23-06-2014
	* Version: 0.91
	*
	*********************************************************/
	
	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:m:i"));



	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/campaigns/new/add_coupon";
	debug_log("[".$page_path."] START");
	include(PATH."functions/check_session.php");


	$response=array();


 	$table="campaigns";
 	$data=array();
	foreach($_POST as $key => $value){
		$data[$key]=$value;
		error_log("[".$key."]=".$value);
	}
	$data["id_brand"]=$_SESSION["admin"]["id_brand"];




	if(issetandnotempty($data["campaign_icon_path"])){
		copy(PATH."../../".$data["campaign_icon_path"],PATH."../../resources/campaign-icon/".$timestamp.".jpg");
		$data["campaign_icon_path"] = $timestamp.".jpg";
	}else{
		copy(PATH."../../server/app/assets/img/default-icon.jpg",PATH."../../resources/campaign-icon/".$timestamp.".jpg");
		$data["campaign_icon_path"] = $timestamp.".jpg";
	}
	if(issetandnotempty($data["campaign_image_path"])){
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

 	echo json_encode($response);

 	debug_log("[".$page_path."] END");
?>
