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
	* db_connection_error
	* no_brand
	* brand_not_valid
	* no_admin
	* admin_not_valid
	* admin_inactive
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));

	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/accounts/data/delete/data";
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


 	$table="brands";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$brand=getInBD($table,$filter);


	$response["data"]["page-title"]="<a href='../../'>".htmlentities($s["my_account"], ENT_QUOTES, "UTF-8")."</a> / <a href='../'>".htmlentities($s["account_data"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["delete_account"], ENT_QUOTES, "UTF-8");




	$response["data"]["form-step-1"]="
			<h4 class='m-t-0'>".htmlentities($s["delete_account"], ENT_QUOTES, "UTF-8")."</h4>
				<div id='form-warning'></div>
				<div class='box box-warning m-b-10'>
					<h5 class='text-warning'>".htmlentities($s["delete_account_warning_title"], ENT_QUOTES, "UTF-8")."</h5>
				</div>
				<p class='text-black'>".htmlentities($s["delete_account_warning"], ENT_QUOTES, "UTF-8")."</h5>
				<p class='text-black'>".htmlentities($s["lock_account_selection_warning"], ENT_QUOTES, "UTF-8")."</h5>
				<p class='text-black'>".htmlentities($s["delete_account_selection_warning"], ENT_QUOTES, "UTF-8")."</h5>
				<p class='text-danger'>".htmlentities($s["app_delete_account_warning"], ENT_QUOTES, "UTF-8")."</h5>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["select_delete_option"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["select_delete_option_help"], ENT_QUOTES, "UTF-8")."</span>
					<div id='delete_fields_alert'></div>
					<div class='controls'>
						<select id='delete_option' name='delete_option'>
							<option value='0'>".htmlentities($s["select_an_option"], ENT_QUOTES, "UTF-8")."</option>
							<option value='lock'>".htmlentities($s["lock"], ENT_QUOTES, "UTF-8")."</option>
							<option value='delete_now'>".htmlentities($s["delete_now"], ENT_QUOTES, "UTF-8")."</option>
						</select>
					</div>
				</div>

				<div style='overflow:auto'>
					<div class='form-group'>
						<input type='submit' class='btn btn-danger pull-right' value='".htmlentities($s["accept"], ENT_QUOTES, "UTF-8")."' />
						<a href='../' class='btn btn-white pull-left'>".htmlentities($s["cancel"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>";
	$response["data"]["form-step-end"]="
			<input type='hidden' id='delete_option'/>
	";
	$response["data"]["form-step-loading"]="
		<div class='text-center'>
			<div class='loader-activity'></div>
			<h3>".htmlentities($s["loading..."], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["this_may_take_several_seconds"], ENT_QUOTES, "UTF-8")."</div>
		</div>
	";
	$response["data"]["form-step-error"]="
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-times'></i></h1>
			<h3 class='text-center'>".htmlentities($s["error"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["there_was_an_error_please_try_later"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='../' class='btn btn-white'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
			</div>
		</div>
	";
	$response["data"]["form-step-success"]="

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
