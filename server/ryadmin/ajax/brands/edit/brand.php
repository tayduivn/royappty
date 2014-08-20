<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 06-08-2014
	* Version: 0.94
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	* db_connection_error
	* no_ryadmin
	* ryadmin_not_valid
	* ryadmin_inactive
	*	post_no_brand
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/
	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/ryadmin/ajax/brands/edit/brand";
	debug_log("[".$page_path."] START");

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

	// Data check START
	if(!@issetandnotempty($_POST["id_brand"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing id_brand");
		$response["error_code"]="post_no_brand";
		echo json_encode($response);
		die();
	}

 	$table="brands";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_POST["id_brand"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		error_log("[".$page_path."] ERROR Brand (id_brand=".$_POST["id_brand"].",id_admin=".$_POST["id_admin"].") doesn't exist");
		$response["error_code"]="post_no_brand";
 		echo json_encode($response);
 		die();
	}

 	// Data check END

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/
	$response["result"]=true;

 	$table="brands";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_POST["id_brand"]);
	$fields=array();
	$brand=getInBD($table,$filter,$fields);

 	$response=array();
 	$response["result"]=true;

	$response["data"]["page-title"]="<a href='../../brands'>".htmlentities($s["brands"], ENT_QUOTES, "UTF-8")."</a> / <a href='#'>".htmlentities($s["edit_brand"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($brand["name"], ENT_QUOTES, "UTF-8");
	$response["data"]["page-options"]="";

	$response["data"]["new-brand-step-1"]="
			<h4 class='m-t-0'>".htmlentities($s["edit_brand"], ENT_QUOTES, "UTF-8")."</h4>
			<form id='form-step1'>
				<div id='form-warning'></div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["brand_name"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["brand_name_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='name' name='name' value='".$brand["name"]."' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["brand_cif"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["brand_cif_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='cif' cif='cif' value='".$brand["cif"]."' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["brand_active"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["brand_active_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='active' active='active' value='".$brand["active"]."' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["brand_created"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["brand_created_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='created' created='created' value='".$brand["created"]."' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["brand_android_key"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["brand_android_key_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='android_key' android_key='android_key' value='".$brand["android_key"]."' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["brand_resume_block_1"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["brand_resume_block_1_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='resume_block_1_display' name='resume_block_1_display' value='".$brand["resume_block_1_display"]."' class='form-control'>
						<input type='text' id='resume_block_1_title' name='resume_block_1_title' value='".$brand["resume_block_1_title"]."' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["brand_resume_block_2"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["brand_resume_block_2_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='resume_block_2_display' name='resume_block_2_display' value='".$brand["resume_block_2_display"]."' class='form-control'>
						<input type='text' id='resume_block_2_title' name='resume_block_2_title' value='".$brand["resume_block_2_title"]."' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["brand_resume_block_3"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["brand_resume_block_3_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='resume_block_3_display' name='resume_block_3_display' value='".$brand["resume_block_3_display"]."' class='form-control'>
						<input type='text' id='resume_block_3_title' name='resume_block_3_title' value='".$brand["resume_block_3_title"]."' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["brand_resume_block_4"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["brand_resume_block_4_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='resume_block_4_display' name='resume_block_4_display' value='".$brand["resume_block_4_display"]."' class='form-control'>
						<input type='text' id='resume_block_4_title' name='resume_block_4_title' value='".$brand["resume_block_4_title"]."' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["brand_contact_name"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["brand_contact_name_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='contact_name' name='contact_name' value='".$brand["contact_name"]."' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["brand_contact_email"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["brand_contact_email_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='contact_email' name='contact_email' value='".$brand["contact_email"]."' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["brand_contact_phone"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["brand_contact_phone_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='contact_phone' name='contact_phone' value='".$brand["contact_phone"]."' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["brand_contact_address"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["brand_contact_address_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='contact_address' name='contact_address' value='".$brand["contact_address"]."' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["brand_contact_postal_code"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["brand_contact_postal_code_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='contact_postal_code' name='contact_postal_code' value='".$brand["contact_postal_code"]."' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["brand_contact_city"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["brand_contact_city_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='contact_city' name='contact_city' value='".$brand["contact_city"]."' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["brand_contact_province"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["brand_contact_province_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='contact_province' name='contact_province' value='".$brand["contact_province"]."' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["brand_contact_country"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["brand_contact_country_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='contact_country' name='contact_country' value='".$brand["contact_country"]."' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["brand_payment_plan"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["brand_payment_plan_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='payment_plan' name='payment_plan' value='".$brand["payment_plan"]."' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["brand_payment_method"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["brand_payment_method_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='payment_method' name='payment_method' value='".$brand["payment_method"]."' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["brand_payment_data"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["brand_payment_data_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='payment_data' name='payment_data' value='".$brand["payment_data"]."' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["brand_expiration_date"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["brand_expiration_date_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='expiration_date' name='expiration_date' value='".$brand["expiration_date"]."' class='form-control'>
					</div>
				</div>



				<div style='overflow:auto'>
					<div class='form-group'>
							<input type='submit' class='btn btn-white pull-right' value='".htmlentities($s["save"], ENT_QUOTES, "UTF-8")."' />
					</div>
				</div>
			</form>";

	$response["data"]["new-admin-step-end"]="
		<form id='form-end'>
			<input type='hidden' id='id_admin' value='".$_POST["id_admin"]."' />
			<input type='hidden' id='name' />
			<input type='hidden' id='can_validate_codes' />
			<input type='hidden' id='promo_password' />
			<input type='hidden' id='can_login' />
			<input type='hidden' id='can_manage_campaigns' />
			<input type='hidden' id='can_manage_admins' />
			<input type='hidden' id='can_manage_users' />
			<input type='hidden' id='can_manage_app' />
			<input type='hidden' id='can_manage_brand' />
			<input type='hidden' id='end_date_hour' />
			<input type='hidden' id='email' />
			<input type='hidden' id='password' />
			<input type='hidden' id='active' />
		</form>
	";
	$response["data"]["new-admin-step-loading"]="
		<div class='text-center'>
			<div class='loader-activity'></div>
			<h3>".htmlentities($s["loading..."], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["this_may_take_several_seconds"], ENT_QUOTES, "UTF-8")."</div>
		</div>
	";
	$response["data"]["new-admin-step-error"]="
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-times'></i></h1>
			<h3 class='text-center'>".htmlentities($s["error"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["there_was_an_error_please_try_later"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='../../admins/' class='btn btn-white'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
			</div>
		</div>
	";
	$response["data"]["new-admin-step-success"]="
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-check'></i></h1>
			<h3 class='text-center'>".htmlentities($s["admin_success_title"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["admin_success_subtitle"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='../../admins/' class='btn btn-white'>".htmlentities($s["all_admins"], ENT_QUOTES, "UTF-8")."</a>
				<a id='admin-link' href='#' class='btn btn-white m-r-10 m-l-10'>".htmlentities($s["view_admin"], ENT_QUOTES, "UTF-8")."</a>
				<a href='./' class='btn btn-white m-r-10'>".htmlentities($s["new_admin"], ENT_QUOTES, "UTF-8")."</a>
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
