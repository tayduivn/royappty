<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 21-07-2014
	* Version: 0.93
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
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
	$page_path="server/app/ajax/admins/list";
	debug_log("[".$page_path."] START");

 	$response=array();

 	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// BRAND
	$brand=array();$brand["id_brand"]=$_SESSION["admin"]["id_brand"];
	if(!checkBrand($brand)){echo json_encode($response);die();}

	// ADMIN
	$admin=array();$admin["id_admin"]=$_SESSION["admin"]["id_admin"];
	if(!checkAdmin($admin)){echo json_encode($response);die();}

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
        	<li ".$tab_active[0]."><a href='?active=0'>".htmlentities($s["all_admins"], ENT_QUOTES, "UTF-8")."</a></li>
            <li ".$tab_active[1]."><a href='?active=1'>".htmlentities($s["active_admins"], ENT_QUOTES, "UTF-8")."</a></li>
            <li ".$tab_active[2]."><a href='?active=2'>".htmlentities($s["inactive_admins"], ENT_QUOTES, "UTF-8")."</a></li>

    ";

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$response["result"]=true;
 	$response["data"]["page-title"] = "<a href='./'>".htmlentities($s["admins"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["all_admins"], ENT_QUOTES, "UTF-8")."<a href='../admin/new/' class='m-t--3 btn btn-white btn-mini pull-right'>".htmlentities($s["new_admin"], ENT_QUOTES, "UTF-8")."</a>";
 	$response["data"]["table-header"] = "
 		<th style='width:30%'>".htmlentities($s["name"], ENT_QUOTES, "UTF-8")."</th>
        <th style='width:20%'  class='text-center'>".htmlentities($s["can_login"], ENT_QUOTES, "UTF-8")."</th>
        <th style='width:20%;' class='text-center'>".htmlentities($s["can_manage_campaigns"], ENT_QUOTES, "UTF-8")."</th>
        <th style='width:20%;'>".htmlentities($s["last_action"], ENT_QUOTES, "UTF-8")."</th>
        <th style='width:10%;'>".htmlentities($s["validated_codes"], ENT_QUOTES, "UTF-8")."</th>";
 	$response["data"]["delete-modal"]="
		<div class='modal fade' id='delete_admin_alert' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>x</button>
						<br>
						<h4 id='myModalLabel' class='semi-bold'>".htmlentities($s["delete_admin"], ENT_QUOTES, "UTF-8")."</h4>
					</div>
					<div class='modal-body'>
						<p class='no-margin'>".htmlentities($s["warning"], ENT_QUOTES, "UTF-8")."</p>
						<p class='no-margin'>".htmlentities($s["delete_admin_alert"], ENT_QUOTES, "UTF-8")."</p>
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
