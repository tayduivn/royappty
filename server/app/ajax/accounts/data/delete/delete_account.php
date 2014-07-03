<?php
	/*********************************************************
	*	
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 22-06-2014
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
	
	define('PATH', str_replace('\\', '/','../../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:m:00"));
 	include(PATH."include/inbd.php");
	$page_path = "server/app/ajax/accounts/subscription/edit/update_subscription";
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
	$filter=array();
 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
 	
 	switch ($_POST["delete_option"]){
	 	case "lock":
 			$response["result"]=true;
 			
 			$table="brands";
			$filter=array();
		 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		 	$data=array();
		 	$data["active"]=0;
		 	$data["lock_date"]=$timestamp;
		 	updateInBD($table,$filter,$data);
	 
	 		break;
	 	case "delete_now":
 			$response["result"]=true;
 			
 			$response["result"]=true;
 			
 			$table="brands";
			$filter=array();
		 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		 	$data=array();
		 	$data["active"]=2;
		 	$data["lock_date"]=$timestamp;
		 	updateInBD($table,$filter,$data);
 			
		 	$table="admins";
			$filter=array();
		 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		 	deleteInBD($table,$filter);
		 	
		 	$table="apps";
			$filter=array();
		 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		 	deleteInBD($table,$filter);
		 	
		 	$table="brand_user_fields";
			$filter=array();
		 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		 	deleteInBD($table,$filter);
		 	
		 	$table="campaigns";
			$filter=array();
		 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		 	deleteInBD($table,$filter);
		 	
		 	$table="campaign_notes";
			$filter=array();
		 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		 	deleteInBD($table,$filter);
		 	
		 	$table="groups";
			$filter=array();
		 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		 	deleteInBD($table,$filter);
		 	
		 	$table="group_notes";
			$filter=array();
		 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		 	deleteInBD($table,$filter);
		 	
		 	$table="used_codes";
			$filter=array();
		 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		 	deleteInBD($table,$filter);
		 	
		 	$table="used_codes_day_summaries";
			$filter=array();
		 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		 	deleteInBD($table,$filter);
		 	
		 	$table="used_codes_month_summaries";
			$filter=array();
		 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		 	deleteInBD($table,$filter);
		 	
		 	$table="used_codes_summaries";
			$filter=array();
		 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		 	deleteInBD($table,$filter);
		 	
		 	$table="used_codes_user_day_summaries";
			$filter=array();
		 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		 	deleteInBD($table,$filter);
		 	
		 	$table="used_codes_user_summaries";
			$filter=array();
		 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		 	deleteInBD($table,$filter);
		 	
		 	$table="users";
			$filter=array();
		 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		 	deleteInBD($table,$filter);
		 	
		 	$table="user_field_data";
			$filter=array();
		 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		 	deleteInBD($table,$filter);
		 	
		 	$table="user_groups";
			$filter=array();
		 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		 	deleteInBD($table,$filter);
		 	
		 	$table="user_notes";
			$filter=array();
		 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		 	deleteInBD($table,$filter);
		 	
		 	$table="validated_codes_day_summaries";
			$filter=array();
		 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		 	deleteInBD($table,$filter);
		 	
		 	$table="validated_codes_month_summaries";
			$filter=array();
		 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		 	deleteInBD($table,$filter);
		 	
		 	
		 	
	 
	 		break;
	 	default:
 			$response["result"]=false;
	 		break;
 	}
 	

 	/*********************************************************
 	* DATABASE REGISTRATION
 	*********************************************************/



 	/*********************************************************
 	* AJAX CALL RETURN
 	*********************************************************/
	
 	echo json_encode($response);
	debug_log("[".$page_path."] END");

 		
 	
?>