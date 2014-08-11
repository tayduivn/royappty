<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 11-08-2014
	* Version: 0.94
	*
	*********************************************************/

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
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/notifications/list";
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


	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$response["result"]=true;

	$_POST["active"]=0;
	$tab_active[0]="class='active'";
	$response["data"]["tabs"]="
		<li ".$tab_active[0]."><a href='?active=0'>".htmlentities($s["sended_notifications"], ENT_QUOTES, "UTF-8")."</a></li>
	";

	$response["data"]["page-title"] = "<a href='./'>".htmlentities($s["notifications"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["sended_notifications"], ENT_QUOTES, "UTF-8")."<a href='../notification/new/' class='m-t--3 btn btn-white btn-mini pull-right'>".htmlentities($s["new_notification"], ENT_QUOTES, "UTF-8")."</a>";
 	$response["data"]["table-header"] = "
	 	<th style='width:60%'>".htmlentities($s["content"], ENT_QUOTES, "UTF-8")."</th>
		<th style='width:20%' class='text-right'>".htmlentities($s["users"], ENT_QUOTES, "UTF-8")."</th>
    <th style='width:20%' class='text-right'>".htmlentities($s["date"], ENT_QUOTES, "UTF-8")."</th>";

 	$response["data"]["delete-modal"]="
		<div class='modal fade' id='delete_notification_alert' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>x</button>
						<br>
						<h4 id='myModalLabel' class='semi-bold'>".htmlentities($s["delete_notification"], ENT_QUOTES, "UTF-8")."</h4>
					</div>
					<div class='modal-body'>
						<p class='no-margin'>".htmlentities($s["warning"], ENT_QUOTES, "UTF-8")."</p>
						<p class='no-margin'>".htmlentities($s["delete_notification_alert"], ENT_QUOTES, "UTF-8")."</p>
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-default' data-dismiss='modal'>".htmlentities($s["cancel"], ENT_QUOTES, "UTF-8")."</button>
						<a href='' class='btn btn-primary accept_button'>".htmlentities($s["delete"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>
			</div>
		</div>
 	";

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
