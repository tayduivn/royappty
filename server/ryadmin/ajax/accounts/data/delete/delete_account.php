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
	*	post_no_delete_option
	*
	*********************************************************/


	/*********************************************************
 	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
 	*********************************************************/

	define('PATH', str_replace('\\', '/','../../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
 	include(PATH."include/inbd.php");
	$page_path = "server/app/ajax/accounts/data/delete/delete_account";
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


	//POST
	if(!@issetandnotempty($_POST["delete_option"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing delete_option");
		$response["error_code"]="post_no_delete_option";
		$response["error_code_str"]= $error_step_s["post_no_delete_option"];
		echo json_encode($response);
		die();
	}


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
	die();


?>
