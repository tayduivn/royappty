<?php

function create_block_data($block_data_code,$data1,$data2){

	$block_data="?";
	switch ($block_data_code){
		case "campaigns":
			$table="campaigns";
			$filter=array();
			$filter["id_brand"]=array("operation"=>"=","value"=>$data1);
			$filter["status"]=array("operation"=>"=","value"=>1);
			$block_data=countInBD($table,$filter);
			if(!issetandnotempty($block_data)){$block_data=0;}
			break;

		case "usage_this_month":
			$mounth=strtotime(date("Y-m-1 00:00:00"));
			$table="used_codes_month_summaries";
			$filter=array();
			$filter["id_brand"]=array("operation"=>"=","value"=>$data1);
			$filter["start"]=array("operation"=>"=","value"=>$mounth);
			$sumfield="used_codes_amount";
			$block_data=sumInBD($table,$filter,$sumfield);
			if(!issetandnotempty($block_data)){$block_data=0;}
			break;
		case "usage_this_today":
			$day=strtotime(date("Y-m-d 00:00:00"));
			$table="used_codes_day_summaries";
			$filter=array();
			$filter["id_brand"]=array("operation"=>"=","value"=>$data1);
			$filter["start"]=array("operation"=>"=","value"=>$day);
			$sumfield="used_codes_amount";
			$block_data=sumInBD($table,$filter,$sumfield);
			if(!issetandnotempty($block_data)){$block_data=0;}
			break;
		case "users":
			$table="users";
			$filter=array();
			$filter["id_brand"]=array("operation"=>"=","value"=>$data1);
			$filter["active"]=array("operation"=>"=","value"=>1);
			$block_data=countInBD($table,$filter);
			if(!issetandnotempty($block_data)){$block_data=0;}
			break;

		case "admin_validated_this_month":
			$mounth=strtotime(date("Y-m-1 00:00:00"));
			$table="validated_codes_month_summaries";
			$filter=array();
			$filter["id_admin"]=array("operation"=>"=","value"=>$data1);
			$filter["start"]=array("operation"=>"=","value"=>$mounth);
			$tmp=getInBD($table,$filter);
			$block_data=$tmp["validated_codes_amount"];
			if(!issetandnotempty($block_data)){$block_data=0;}
			break;
		case "admin_validated_this_today":
			$day=strtotime(date("Y-m-d 00:00:00"));
			$table="validated_codes_day_summaries";
			$filter=array();
			$filter["id_admin"]=array("operation"=>"=","value"=>$data1);
			$filter["start"]=array("operation"=>"=","value"=>$day);
			$tmp=getInBD($table,$filter);
			$block_data=$tmp["validated_codes_amount"];
			if(!issetandnotempty($block_data)){$block_data=0;}
			break;
		case "admin_validated":
			$table="validated_codes_month_summaries";
			$filter=array();
			$filter["id_admin"]=array("operation"=>"=","value"=>$data1);
			$sumfield="validated_codes_amount";
			$block_data=countInBD($table,$filter);
			if(!issetandnotempty($block_data)){$block_data=0;}
			break;
		case "campaign_usage_this_month":
			$mounth=strtotime("Y-m-d 00:00:00","-1 month");
			$table="used_codes_day_summaries";
			$filter=array();
			$filter["id_campaign"]=array("operation"=>"=","value"=>$data1);
			$filter["start"]=array("operation"=>">","value"=>$mounth);
			$sumfield="used_codes_amount";
			$block_data=sumInBD($table,$filter,$sumfield);
			if(!issetandnotempty($block_data)){$block_data=0;}
			break;
		case "campaign_usage_today":
			$day=strtotime(date("Y-m-d 00:00:00"));
			$table="used_codes_day_summaries";
			$filter=array();
			$filter["id_campaign"]=array("operation"=>"=","value"=>$data1);
			$filter["start"]=array("operation"=>"=","value"=>$day);
			$tmp=getInBD($table,$filter);
			$block_data=$tmp["used_codes_amount"];
			if(!issetandnotempty($block_data)){$block_data=0;}
			break;
		case "campaign_usage_total":
			$table="used_codes_month_summaries";
			$filter=array();
			$filter["id_campaign"]=array("operation"=>"=","value"=>$data1);
			$sumfield="used_codes_amount";
			$block_data=sumInBD($table,$filter,$sumfield);
			if(!issetandnotempty($block_data)){$block_data=0;}
			break;

	}

	return $block_data;
}

function checkBrand($brand){
	global $page_path;
	global $response;

	if(!issetandnotempty($brand["id_brand"])){
	 	$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Missing id_brand");
 		$response["error"]="ERROR Data Missing brand identificator";
  		$response["error_code"]="no_brand";
 		return false;
 		die();
 	}
 	$table="brands";
 	$filter=array();
 	$filter["id_brand"]=array("operation"=>"=","value"=>$brand["id_brand"]);
 	$filter["active"]=array("operation"=>"=","value"=>1);
 	if(!isInBD($table,$filter)){
	 	$response["result"]=false;
		debug_log("[".$page_path."] ERROR Brand not exists or inactive (id_brand=".$brand["id_brand"]." | active=1)");
 		$response["error"]="ERROR Data Missing not exists or inactive";
 		$response["error_code"]="brand_not_valid";
 		return false;
 		die();
 	}
 	return true;
 	die();

}

function checkAdmin($admin){
	global $page_path;
	global $response;

	if(!issetandnotempty($admin["id_admin"])){
	 	$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Missing id_admin");
 		$response["error"]="ERROR Data Missing admin identificator";
  		$response["error_code"]="no_admin";
		return false;
 		die();
 	}

 	$table="admins";
 	$filter=array();
 	$filter["id_admin"]=array("operation"=>"=","value"=>$admin["id_admin"]);
 	if(!isInBD($table,$filter)){
	 	$response["result"]=false;
		debug_log("[".$page_path."] ERROR User not exists (id_admin=".$admin["id_admin"].")");
 		$response["error"]="ERROR User not in the system";
 		$response["error_code"]="admin_not_valid";
 		return false;
 		die();
 	}

 	$table="admins";
 	$filter=array();
 	$filter["id_admin"]=array("operation"=>"=","value"=>$admin["id_admin"]);
 	$filter["active"]=array("operation"=>"=","value"=>1);
 	if(!isInBD($table,$filter)){
	 	$response["result"]=false;
		debug_log("[".$page_path."] ERROR User not exists (id_admin=".$admin["id_admin"].")");
 		$response["error"]="ERROR User not in the system";
  		$response["error_code"]="admin_inactive";
		echo json_encode($response);
 		die();
 	}
 	return true;
 	die();
}

function error_handler(){
	global $error_alert;
	global $_POST;
	global $error_s;

	if((isset($_POST["error"]))&&(!empty($_POST["error"]))&&($_POST["error"]!="undefined")){
		$error_alert=$error_s[$_POST["error"]];
	}
}


?>
