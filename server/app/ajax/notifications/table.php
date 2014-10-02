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
	*	no_admin
	* admin_not_valid
	* admin_inactive
	*
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/admins/table";
	debug_log("[".$page_path."] START");
	$response=array();
 	$response["aaData"]=array();

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


	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$table="notifications";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	if(isInBD($table,$filter)){
		$fields=array();
		$order="created asc";
		$notifications=listInBD($table,$filter,$fields,$order);


 		foreach($notifications as $key=>$notification){
 		 	$table_field="
				<div class='m-b-5'>
					<a href='".$_GET["PATH"]."notification/?id_notification=".$notification["id_notification"]."'>".$notification["content"]."</a>
				</div>
				<div class='hidden-options'>
					<a href='".$_GET["PATH"]."notification/?id_notification=".$notification["id_notification"]."' class='btn btn-mini btn-white'>".htmlentities($s["view_report"], ENT_QUOTES, "UTF-8")."</a>
					<a href='".$_GET["PATH"]."notification/new/?id_notification=".$notification["id_notification"]."' class='btn btn-mini btn-white'> ".htmlentities($s["resend_notification"], ENT_QUOTES, "UTF-8")."</a>
					<a href='javascript:show_modal(\"delete_notification_alert\",\"javascript:delete_notification(".$notification["id_notification"].")\")' class=' btn btn-mini btn-danger'> ".htmlentities($s["delete"], ENT_QUOTES, "UTF-8")."</a>
				";

			$response["aaData"][]=array(
	 			$table_field,
	 			"<div class='text-right'>".$notification["group_name"]."</div>",
	 			"<div class='text-right'><span style='display:none'>".$notification["created"]."</span>".date("d/m/Y H:i",$notification["created"])."</div>");
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
