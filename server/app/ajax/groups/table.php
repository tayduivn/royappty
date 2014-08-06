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
	* db_connection_error
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
	$page_path="server/app/ajax/groups/table";
	debug_log("[".$page_path."] START");
	$response=array();
 	$response["aaData"]=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// BD CONNECTION
	if(!checkBDConnection()){echo json_encode($response);die();}



	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$table="groups";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	if(@issetandnotempty($_GET["status"])){
		$filter["status"]=array("operation"=>"=","value"=>$_GET["status"]);
 	}
	if(isInBD($table,$filter)){
 		$groups=listInBD($table,$filter);
 		foreach($groups as $key=>$group){
 			$table="user_groups";
 			$filter=array();
 			$filter["id_group"]=array("operation"=>"=","value"=>$group["id_group"]);
 			$users_group_count=countInBD($table,$filter);

	 		$data_table[0]="<div class='m-b-5'><a href='".$_GET["PATH"]."group/?id_group=".$group["id_group"]."' class=''>".$group["name"]."</a></div><div class='hidden-options'><a href='".$_GET["PATH"]."group/?id_group=".$group["id_group"]."' class='btn btn-mini btn-white'>".htmlentities($s["view_report"], ENT_QUOTES, "UTF-8")."</a> <a href='".$_GET["PATH"]."group/edit/?id_group=".$group["id_group"]."' class='btn btn-mini btn-white'> ".htmlentities($s["edit"], ENT_QUOTES, "UTF-8")."</a> <a href='javascript:show_modal(\"delete_group_alert\",\"javascript:delete_group(".$group["id_group"].")\")' class=' btn btn-mini btn-danger'>".htmlentities($s["delete"], ENT_QUOTES, "UTF-8")."</a></div>";
	 		$response["aaData"][]=array(

	 			$data_table[0],
	 			"<span class='pull-right'>".$users_group_count." ".htmlentities($s["user(s)"], ENT_QUOTES, "UTF-8")."</span>");
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
