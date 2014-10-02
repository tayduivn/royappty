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

	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/notifications/new/notification";
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

	$placeholder=array();
	$placeholder["content"]="";
	$placeholder["user_group"]="";


	if(@issetandnotempty($_POST["id_notification"])){
		error_log("...");
		$table="notifications";
		$filter=array();
		$filter["id_notification"]=array("operation"=>"=","value"=>$_POST["id_notification"]);
		$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		$placeholder=getInBD($table,$filter);
	}

	$response["data"]["page-title"]="<a href='../../notifications'>".htmlentities($s["notifications"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["new_notification"], ENT_QUOTES, "UTF-8");
	$response["data"]["page-options"]="";

	$response["data"]["new-notification-step-1"]="
			<h4 class='m-t-0'>".htmlentities($s["send_notification_title"], ENT_QUOTES, "UTF-8")."</h4>
			<form id='form-step1'>
				<div id='form-warning'></div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["notification_content"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["notification_content_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='content' name='content' class='form-control' value='".$placeholder["content"]."'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["user_group"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["user_group_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<select name='id_group' id='id_group'>
							<option value='0' ";
		if($placeholder["id_group"]==0){
			$response["data"]["new-notification-step-1"].=" selected";
		}
		$response["data"]["new-notification-step-1"].=">".htmlentities($s["all_users"], ENT_QUOTES, "UTF-8")."</option>";

		$table="groups";
		$filter=array();
		$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		if(isInBD($table,$filter)){
			$groups=listInBD($table,$filter);
			foreach($groups as $key => $group) {
				$response["data"]["new-notification-step-1"].="<option value='".$group["id_group"]."' ";
				if($placeholder["id_group"]==$group["id_group"]){
					$response["data"]["new-notification-step-1"].="selected";
				}
				$response["data"]["new-notification-step-1"].=">".$group["name"]."</option>";
			}
		}


		$response["data"]["new-notification-step-1"].="
						</select>
					</div>
				</div>
				<div style='overflow:auto'>
					<div class='form-group'>
							<input type='submit' class='btn btn-white pull-right' value='".htmlentities($s["send_notification"], ENT_QUOTES, "UTF-8")."' />
						<a href='../../notifications' class='btn btn-white pull-left'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>
			</form>
						";

	$response["data"]["new-notification-step-end"]="
		<form id='form-end'>
			<input type='hidden' id='content' />
			<input type='hidden' id='id_group' />
		</form>
	";
	$response["data"]["new-notification-step-loading"]="
		<div class='text-center'>
			<div class='loader-activity'></div>
			<h3>".htmlentities($s["loading..."], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["this_may_take_several_seconds"], ENT_QUOTES, "UTF-8")."</div>
		</div>
	";
	$response["data"]["new-notification-step-error"]="
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-times'></i></h1>
			<h3 class='text-center'>".htmlentities($s["error"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["there_was_an_error_please_try_later"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='../../notifications/' class='btn btn-white'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
			</div>
		</div>
	";
	$response["data"]["new-notification-step-success"]="
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-check'></i></h1>
			<h3 class='text-center'>".htmlentities($s["notification_success_title"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["notification_success_subtitle"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='../../notifications/' class='btn btn-white'>".htmlentities($s["sended_notifications"], ENT_QUOTES, "UTF-8")."</a>
				<a href='./' class='btn btn-white m-r-10'>".htmlentities($s["send_notification"], ENT_QUOTES, "UTF-8")."</a>
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
