<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 18-07-2014
	* Version: 0.93
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	*
	*
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	@session_start();
	define('PATH', str_replace('\\', '/','../../'));
	$timestamp=strtotime(date("Y-m-d H:i:00"));

	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/users/table";
	debug_log("[".$page_path."] START");

	$response=array();
 	$response["aaData"]=array();


	/*********************************************************
	* DATA CHECK
	*********************************************************/


	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$table="users";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);

	if(isInBD($table,$filter)){
 		$users=listInBD($table,$filter);
 		foreach($users as $key=>$user){
 			$table="used_codes_user_summaries";
	  		$filter=array();
	 		$filter["id_user"]=array("operation"=>"=","value"=>$user["id_user"]);
	 		$sum_field="used_codes_amount";
	 		$used_codes_user_summary=sumInBD($table,$filter,$sum_field);
	 		if(!@issetandnotempty($used_codes_user_summary)){
		 		$used_codes_user_summary=0;
	 		}


	 		$data_table[0] = "<div class='m-b-5'><a href='".$_GET["PATH"]."user/?id_user=".$user["id_user"]."' class=''>";
	 		$table='brand_user_fields';
	 		$filter=array();
	 		$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	 		$filter["main_field"]=array("operation"=>"=","value"=>1);
	 		if(isInBD($table,$filter)){
		 		$brand_user_field=getInBD($table,$filter);
		 		$table='user_field_data';
			 	$filter=array();
			 	$filter["id_user"]=array("operation"=>"=","value"=>$user["id_user"]);
			 	$filter["id_user_field"]=array("operation"=>"=","value"=>$brand_user_field["id_user_field"]);
			 	$user_field=getInBD($table,$filter);
			 	$data_table[0] .= $user_field["field_value"];

	 		}else{
			 	$data_table[0] .= $user["id_user"];
	 		}

	 		$data_table[0] .= "</a></div><div class='hidden-options'><a href='".$_GET["PATH"]."user/?id_user=".$user["id_user"]."' class='btn btn-mini btn-white'>".htmlentities($s["view_report"], ENT_QUOTES, "UTF-8")."</a></div>";


	 		$response["aaData"][]=array(
	 			$data_table[0],
	 			"<span class='pull-right'>".$used_codes_user_summary."</span>",
	 			"<span class='pull-right'>".date("d/m/Y  H:m",$user["created"])."</span>",
	 			"<span class='pull-right'>".date("d/m/Y  H:m",$user["last_connection"])."</span>");
 		}

	}

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
