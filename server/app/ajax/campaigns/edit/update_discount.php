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
	* db_connection_error
	* no_brand
	* brand_not_valid
	* no_admin
	* admin_not_valid
	* admin_inactive
	*	post_no_discount_id_campaign
	*	post_no_discount_name
	*	post_no_discount_description
	*	post_no_discount_title
	*	post_no_discount_button_title
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

	// BD CONNECTION
	if(!checkBDConnection()){echo json_encode($response);die();}

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
		$response["error_code_str"]= $error_step_s["post_no_discount_id_campaign"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["name"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing discount_name");
		$response["error_code"]="post_no_discount_name";
		$response["error_code_str"]= $error_step_s["post_no_discount_name"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["description"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing discount_description");
		$response["error_code"]="post_no_discount_description";
		$response["error_code_str"]= $error_step_s["post_no_discount_description"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["title"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing discount_title");
		$response["error_code"]="post_no_discount_title";
		$response["error_code_str"]= $error_step_s["post_no_discount_title"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["button_title"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing discount_button_title");
		$response["error_code"]="post_no_discount_button_title";
		$response["error_code_str"]= $error_step_s["post_no_discount_button_title"];
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
