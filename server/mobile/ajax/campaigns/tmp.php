<?php
	/*********************************************************
	*	
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 23-06-2014
	* Version: 1.01
	*
 	*********************************************************/
	
	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	*	- no_brand
	*	- brand_not_valid
	*	- no_user
	*	- user_not_valid
	*	- user_inactive
	*
	*********************************************************/

	
	/*********************************************************
 	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
 	*********************************************************/
 	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
 	include(PATH."mobile/include/inbd.php");
	$page_path = "server/mobile/ajax/session/create";
 	debug_log("[".$page_path."] START");
 	$response=array();
 	
 	
 	
 	/*********************************************************
 	* DATA CHECK
 	*********************************************************/
 	
 	$_SESSION["user"]["id_brand"]=1;
 	$_SESSION["user"]["id_user"]=$_GET["id_user"];
 	
 	$_POST["promo_password"]="123456";
 	$timestamp=$_GET["time"];

 	
 	/*********************************************************
 	* AJAX OPERATIONS
 	*********************************************************/
 	
 	$response["result"]=true;

 	$table="admins";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["user"]["id_brand"]);
	$filter["promo_password"]=array("operation"=>"=","value"=>$_POST["promo_password"]);
 	$admin=getInBD($table,$filter);
 	
 	$table="used_codes";
 	$data=array();
 	$data["id_user"] = $_SESSION["user"]["id_user"];
 	$data["id_campaign"] = $_GET["id_campaign"];
 	$data["id_brand"] = $_SESSION["user"]["id_brand"];
 	$data["id_admin"] = $admin["id_admin"];
 	$data["created"] = $timestamp;
 	$data["code"] = $_POST["code"];
 	addInBD($table,$data);
 	



 	/*********************************************************
 	* DATABASE REGISTRATION
 	*********************************************************/
	$table='admins';
	$filter=array();
	$filter["id_admin"]=array("operation"=>"=","value"=>$admin["id_admin"]);
	$data=array();
	$data["last_connection"]=$timestamp;
	updateInBD($table,$filter,$data);
	
	
	$day=strtotime(date("Y-m-d 00:00:00",$timestamp));
	$month=strtotime(date("Y-m-1 00:00:00",$timestamp));

	$table='used_codes_summaries';
	$filter=array();
	$filter["id_campaign"]=array("operation"=>"=","value"=>$_GET["id_campaign"]);
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["user"]["id_brand"]);
	if(isInBD($table,$filter)){
	
		$used_codes_amount=getInBD($table,$filter);
		$data=array();
		$data["used_codes_amount"]=$used_codes_amount["used_codes_amount"]+1;
		updateInBD($table,$filter,$data);
	}else{
		$data=array();
		$data["id_campaign"]=$_GET["id_campaign"];
		$data["id_brand"]=$_SESSION["user"]["id_brand"];
		$data["used_codes_amount"]=1;
		addInBD($table,$data);
	}
	
	$table='used_codes_day_summaries';
	$filter=array();
	$filter["id_campaign"]=array("operation"=>"=","value"=>$_GET["id_campaign"]);
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["user"]["id_brand"]);
	$filter["start"]=array("operation"=>"=","value"=>$day);
	if(isInBD($table,$filter)){
		$used_codes_amount=getInBD($table,$filter);
		$data=array();
		$data["used_codes_amount"]=$used_codes_amount["used_codes_amount"]+1;
		updateInBD($table,$filter,$data);
	}else{
		$data=array();
		$data["id_campaign"]=$_GET["id_campaign"];
		$data["id_brand"]=$_SESSION["user"]["id_brand"];
		$data["start"]=$day;
		$data["used_codes_amount"]=1;
		addInBD($table,$data);
	}
	
	
	$table='used_codes_month_summaries';
	$filter=array();
	$filter["id_campaign"]=array("operation"=>"=","value"=>$_GET["id_campaign"]);
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["user"]["id_brand"]);
	$filter["start"]=array("operation"=>"=","value"=>$month);
	if(isInBD($table,$filter)){
		$used_codes_amount=getInBD($table,$filter);
		$data=array();
		$data["used_codes_amount"]=$used_codes_amount["used_codes_amount"]+1;
		updateInBD($table,$filter,$data);
	}else{
		$data=array();
		$data["id_campaign"]=$_GET["id_campaign"];
		$data["id_brand"]=$_SESSION["user"]["id_brand"];
		$data["start"]=$month;
		$data["used_codes_amount"]=1;
		addInBD($table,$data);
	}
	
	$table='used_codes_user_day_summaries';
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["user"]["id_brand"]);
	$filter["id_user"]=array("operation"=>"=","value"=>$_SESSION["user"]["id_user"]);
	$filter["start"]=array("operation"=>"=","value"=>$day);
	if(isInBD($table,$filter)){
		$used_codes_amount=getInBD($table,$filter);
		$data=array();
		$data["used_codes_amount"]=$used_codes_amount["used_codes_amount"]+1;
		updateInBD($table,$filter,$data);
	}else{
		$data=array();
		$data["id_brand"]=$_SESSION["user"]["id_brand"];
		$data["id_user"]=$_SESSION["user"]["id_user"];
		$data["start"]=$day;
		$data["used_codes_amount"]=1;
		addInBD($table,$data);
	}
	
	$table='used_codes_user_summaries';
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["user"]["id_brand"]);
	$filter["id_user"]=array("operation"=>"=","value"=>$_SESSION["user"]["id_user"]);
	if(isInBD($table,$filter)){
		$used_codes_amount=getInBD($table,$filter);
		$data=array();
		$data["used_codes_amount"]=$used_codes_amount["used_codes_amount"]+1;
		updateInBD($table,$filter,$data);
	}else{
		$data=array();
		$data["id_brand"]=$_SESSION["user"]["id_brand"];
		$data["id_user"]=$_SESSION["user"]["id_user"];
		$data["used_codes_amount"]=1;
		addInBD($table,$data);
	}
	
 	$table="validated_codes_month_summaries";
 	$filter=array();
	$filter["id_admin"]=array("operation"=>"=","value"=>$admin["id_admin"]);
	$filter["start"]=array("operation"=>"=","value"=>$month);
	if(isInBD($table,$filter)){
		$validate_codes=getInBD($table,$filter);
		$data=array();
		$data["validated_codes_amount"]=$validate_codes["validated_codes_amount"]+1;
		updateInBD($table,$filter,$data);
	}else{
		$data=array();
		$data["id_admin"]=$admin["id_admin"];
		$data["start"]=$month;
		$data["validated_codes_amount"]=1;
		addInBD($table,$data);
	}
	
	$table="validated_codes_day_summaries";
 	$filter=array();
	$filter["id_admin"]=array("operation"=>"=","value"=>$admin["id_admin"]);
	$filter["start"]=array("operation"=>"=","value"=>$day);
	if(isInBD($table,$filter)){
		$validate_codes=getInBD($table,$filter);
		$data=array();
		$data["validated_codes_amount"]=$validate_codes["validated_codes_amount"]+1;
		updateInBD($table,$filter,$data);
	}else{
		$data=array();
		$data["id_admin"]=$admin["id_admin"];
		$data["start"]=$day;
		$data["validated_codes_amount"]=1;
		addInBD($table,$data);
	}
 	
 	
 	/*********************************************************
 	* AJAX CALL RETURN
 	*********************************************************/
 	
 	echo "INSERTADO";



 	

?>