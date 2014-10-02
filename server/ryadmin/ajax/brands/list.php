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
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/ryadmin/ajax/brands/list";
	debug_log("[".$page_path."] START");

 	$response=array();

 	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// SYSTEM CLOSED
	if(!checkClosed()){echo json_encode($response);die();}

	// BD CONNECTION
	if(!checkBDConnection()){echo json_encode($response);die();}

	// RYADMIN
	$ryadmin=array();$ryadmin["id_ryadmin"]=$_SESSION["ryadmin"]["id_ryadmin"];
	if(!checkRyadmin($ryadmin)){echo json_encode($response);die();}

 	if(!@issetandnotempty($_POST["active"])){
	 	$_POST["active"]=0;
 	}
 	for($i=0;$i<=2;$i++){
	 	$tab_active[$i]="";
	 	if($_POST["active"]==$i){
		 	$tab_active[$i]="class='active'";
	 	}
 	}


 	$response["data"]["tabs"]="
		<li ".$tab_active[0]."><a href='?active=0'>".htmlentities($s["all_brands"], ENT_QUOTES, "UTF-8")."</a></li>
    <li ".$tab_active[1]."><a href='?active=1'>".htmlentities($s["active_brands"], ENT_QUOTES, "UTF-8")."</a></li>
    <li ".$tab_active[2]."><a href='?active=2'>".htmlentities($s["blocked_brands"], ENT_QUOTES, "UTF-8")."</a></li>
    ";

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$response["result"]=true;
 	$response["data"]["page-title"] = "<a href='./'>".htmlentities($s["brands"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["all_brands"], ENT_QUOTES, "UTF-8")."<a href='../brand/new/' class='m-t--3 btn btn-white btn-mini pull-right'>".htmlentities($s["new_brand"], ENT_QUOTES, "UTF-8")."</a>";
 	$response["data"]["table-header"] = "
		<th style='width:6%'>".htmlentities($s["id"], ENT_QUOTES, "UTF-8")."</th>
		<th style='width:30%'>".htmlentities($s["name"], ENT_QUOTES, "UTF-8")."</th>
    <th style='width:15%'  class='text-center'>".htmlentities($s["campaigns"], ENT_QUOTES, "UTF-8")."</th>
		<th style='width:15%;' class='text-center'>".htmlentities($s["users"], ENT_QUOTES, "UTF-8")."</th>
		<th style='width:20%;' class='text-right'>".htmlentities($s["subscription_type"], ENT_QUOTES, "UTF-8")."</th>
    <th style='width:20%;' class='text-right'>".htmlentities($s["created"], ENT_QUOTES, "UTF-8")."</th>";
 	$response["data"]["delete-modal"]="
		<div class='modal fade' id='block_brand_alert' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>x</button>
						<br>
						<h4 id='myModalLabel' class='semi-bold'>".htmlentities($s["block_brand"], ENT_QUOTES, "UTF-8")."</h4>
					</div>
					<div class='modal-body'>
						<p class='no-margin'>".htmlentities($s["warning"], ENT_QUOTES, "UTF-8")."</p>
						<p class='no-margin'>".htmlentities($s["block_brand_alert"], ENT_QUOTES, "UTF-8")."</p>
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-default' data-dismiss='modal'>".htmlentities($s["cancel"], ENT_QUOTES, "UTF-8")."</button>
						<a href='' class='btn btn-primary accept_button'>".htmlentities($s["block"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>
			</div>
		</div>
		<div class='modal fade' id='unblock_brand_alert' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>x</button>
						<br>
						<h4 id='myModalLabel' class='semi-bold'>".htmlentities($s["unblock_brand"], ENT_QUOTES, "UTF-8")."</h4>
					</div>
					<div class='modal-body'>
						<p class='no-margin'>".htmlentities($s["warning"], ENT_QUOTES, "UTF-8")."</p>
						<p class='no-margin'>".htmlentities($s["unblock_brand_alert"], ENT_QUOTES, "UTF-8")."</p>
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-default' data-dismiss='modal'>".htmlentities($s["cancel"], ENT_QUOTES, "UTF-8")."</button>
						<a href='' class='btn btn-primary accept_button'>".htmlentities($s["unblock"], ENT_QUOTES, "UTF-8")."</a>
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
