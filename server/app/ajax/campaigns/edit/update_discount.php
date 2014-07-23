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
	*	post_no_discount_id_campaign
	*	post_no_discount_name
	*	post_no_discount_description
	*	post_no_discount_type
	*	post_no_discount_status
	*	post_no_discount_campaign_icon_path
	*	post_no_discount_title
	*	post_no_discount_campaign_image_path
	*	post_no_discount_content
	*	post_no_discount_button_title
	*	post_no_discount_usage_limit
	*	post_no_discount_cost
	*	post_no_discount_profit
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
	$page_path="server/app/ajax/campaigns/edit/update_discount";
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
	if(!@issetandnotempty($_POST["id_campaign"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing discount_id_campaign");
		$response["error_code"]="post_no_discount_id_campaign";
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["name"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing discount_name");
		$response["error_code"]="post_no_discount_name";
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["description"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing discount_description");
		$response["error_code"]="post_no_discount_description";
		echo json_encode($response);
		die();
	}

	if(!@issetandnotempty($_POST["type"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing discount_type");
		$response["error_code"]="post_no_discount_type";
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["status"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing discount_status");
		$response["error_code"]="post_no_discount_status";
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["campaign_icon_path"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing discount_campaign_icon_path");
		$response["error_code"]="post_no_discount_campaign_icon_path";
		echo json_encode($response);
		die();
	}

	if(!@issetandnotempty($_POST["title"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing discount_title");
		$response["error_code"]="post_no_discount_title";
		echo json_encode($response);
		die();
	}

		if(!@issetandnotempty($_POST["campaign_image_path"])){
			$response["result"]=false;
			debug_log("[".$page_path."] ERROR Data Post Missing discount_campaign_image_path");
			$response["error_code"]="post_no_discount_campaign_image_path";
			echo json_encode($response);
			die();
		}

	if(!@issetandnotempty($_POST["content"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing discount_content");
		$response["error_code"]="post_no_discount_content";
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["button_title"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing discount_button_title");
		$response["error_code"]="post_no_discount_button_title";
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["usage_limit"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing discount_usage_limit");
		$response["error_code"]="post_no_discount_usage_limit";
		echo json_encode($response);
		die();
	}

	if(!@issetandnotempty($_POST["cost"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing discount_cost");
		$response["error_code"]="post_no_discount_cost";
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["profit"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing discount_profit");
		$response["error_code"]="post_no_discount_profit";
		echo json_encode($response);
		die();
	}

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

 	$table="campaigns";

 	$filter=array();
 	$filter["id_campaign"]=array("operation"=>"=","value"=>$_POST["id_campaign"]);

 	$data=array();
	foreach($_POST as $key => $value){
		$data[$key]=$value;
	}
	unset($data["id_campaign"]);




	//Transformar fechas a tipo Unix
	if(isset($data["ini_date_day"])&&(!empty($data["ini_date_day"]))){
		$data["ini_date"]=strtotime($data["ini_date_day"]." ".$data["ini_date_hour"]);
	}
	if(isset($data["end_date_day"])&&(!empty($data["end_date_day"]))){
	 	$data["end_date"]=strtotime($data["end_date_day"]." ".$data["end_date_hour"]);
	}


	if(@issetandnotempty($data["campaign_icon_path"])){
		copy(PATH."../../".$data["campaign_icon_path"],PATH."../../resources/campaign-icon/".$timestamp.".jpg");
		$data["campaign_icon_path"] = $timestamp.".jpg";
	}else{
		unset($data["campaign_icon_path"]);
	}
	if(@issetandnotempty($data["campaign_image_path"])){
		copy(PATH."../../".$data["campaign_image_path"],PATH."../../resources/campaign-image/".$timestamp.".jpg");
		$data["campaign_image_path"] = $timestamp.".jpg";
	}else{
		unset($data["campaign_image_path"]);
	}

	unset($data["ini_date_day"]);
	unset($data["ini_date_hour"]);
	unset($data["end_date_day"]);
	unset($data["end_date_hour"]);


	updateInBD($table,$filter,$data);

	$response["result"]=true;
	$response["data"]=$_POST["id_campaign"];


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
