<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 12-08-2014
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
	$page_path="server/app/ajax/campaigns/list";
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

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$response["result"]=true;
 	$response["data"]["page-title"] = "<a href='./'>".htmlentities($s["campaigns"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["all_campaigns"], ENT_QUOTES, "UTF-8")."<a href='../campaign/new/' class='pull-right m-t--3 btn btn-white btn-mini pull-right'>".htmlentities($s["new_campaign"], ENT_QUOTES, "UTF-8")."</a>";
 	$response["data"]["table-header"] = "
 		<th style='width:40%'>".htmlentities($s["name"], ENT_QUOTES, "UTF-8")."</th>
    <th style='width:15%'>".htmlentities($s["type"], ENT_QUOTES, "UTF-8")."</th>
		<th style='width:15%'>".htmlentities($s["users"], ENT_QUOTES, "UTF-8")."</th>
    <th style='width:10%'>".htmlentities($s["status"], ENT_QUOTES, "UTF-8")."</th>
    <th style='width:10%;' class='text-right'>".htmlentities($s["total"], ENT_QUOTES, "UTF-8")."</th>
    <th style='width:10%;' class='text-right'>".htmlentities($s["last_month"], ENT_QUOTES, "UTF-8")."</th>";

	if(!@issetandnotempty($_POST["status"])){
	 	$_POST["status"]=0;
 	}

 	for($i=0;$i<=3;$i++){
	 	$tab_active[$i]="";
	 	if($_POST["status"]==$i){
		 	$tab_active[$i]="class='active'";
	 	}
 	}

 	$response["data"]["tabs"]="
        	<li ".$tab_active[0]."><a href='?status=0'>".htmlentities($s["all_campaigns"], ENT_QUOTES, "UTF-8")."</a></li>
            <li ".$tab_active[1]."><a href='?status=1'>".htmlentities($s["active_campaigns"], ENT_QUOTES, "UTF-8")."</a></li>
            <li ".$tab_active[2]."><a href='?status=2'>".htmlentities($s["inactive_campaigns"], ENT_QUOTES, "UTF-8")."</a></li>

    ";

 	$response["data"]["modals"]="
		<div class='modal fade' id='delete_campaign_alert' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>x</button>
						<br>
						<h4 id='myModalLabel' class='semi-bold'>".htmlentities($s["delete_campaign"], ENT_QUOTES, "UTF-8")."</h4>
					</div>
					<div class='modal-body'>
						<p class='no-margin'>".htmlentities($s["warning"], ENT_QUOTES, "UTF-8")."</p>
						<p class='no-margin'>".htmlentities($s["delete_campaign_alert"], ENT_QUOTES, "UTF-8")."</p>
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-default' data-dismiss='modal'>".htmlentities($s["cancel"], ENT_QUOTES, "UTF-8")."</button>
						<a href='' class='btn btn-primary accept_button'>".htmlentities($s["delete"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>
			</div>
		</div>
		<div class='modal fade' id='deleted_campaign_success_alert' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-hidden='true'></button>
						<br>
						<h4 id='myModalLabel' class='semi-bold text-center'><i class='fa fa-check fa-4x'></i></h4>
					</div>
					<div class='modal-body text-center'>
						<h6 class='no-margin'>".htmlentities($s["campaign_deleted"], ENT_QUOTES, "UTF-8")."</p>
					</div>
					<div class='modal-footer'>
						<a href='' class='btn btn-primary accept_button'>".htmlentities($s["accept"], ENT_QUOTES, "UTF-8")."</a>
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
