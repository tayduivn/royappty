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
	$page_path="server/app/ajax/campaigns/new/update_discount";
	debug_log("[".$page_path."] START");
	include(PATH."functions/check_session.php");


	$response=array();


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


	if(issetandnotempty($data["campaign_icon_path"])){
		copy(PATH."../../".$data["campaign_icon_path"],PATH."../../resources/campaign-icon/".$timestamp.".jpg");
		$data["campaign_icon_path"] = $timestamp.".jpg";
	}else{
		unset($data["campaign_icon_path"]);
	}
	if(issetandnotempty($data["campaign_image_path"])){
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
 	echo json_encode($response);

 	debug_log("[".$page_path."] END");
?>
