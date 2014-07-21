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
	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));

	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/admins/new/admin";
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

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

 	$response["result"]=true;

	$response["data"]["page-title"]="<a href='../../admins'>".htmlentities($s["admins"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["new_admin"], ENT_QUOTES, "UTF-8");
	$response["data"]["page-options"]="";

	$response["data"]["new-admin-step-1"]="
			<h4 class='m-t-0'>".htmlentities($s["add_admin_title"], ENT_QUOTES, "UTF-8")."</h4>
			<form id='form-step1'>
				<div id='form-warning'></div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["admin_name"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["admin_name_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='name' name='name' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["promo_options"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["promo_options_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='row-fluid m-t-10'>
						<div class='checkbox check-default'>
							<input id='can_validate_codes' class='user_checkbox' type='checkbox' >
							<label for='can_validate_codes' class='p-l-30'>".htmlentities($s["admin_can_validate_codes"], ENT_QUOTES, "UTF-8")."</label>
						</div>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["admin_promo_password"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["admin_promo_password_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='promo_password' name='promo_password' class='form-control'/>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["manager_options"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["manager_options_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='row-fluid m-t-10'>
						<div class='checkbox check-default'>
							<input id='can_login' class='user_checkbox' type='checkbox' >
							<label for='can_login' class='p-l-30'>".htmlentities($s["admin_can_login"], ENT_QUOTES, "UTF-8")."</label>
						</div>
					</div>
					<div class='row-fluid m-l-20'>
						<div class='checkbox check-default'>
							<input id='can_manage_campaigns' class='user_checkbox' type='checkbox' >
							<label for='can_manage_campaigns' class='p-l-30'>".htmlentities($s["admin_can_manage_campaigns"], ENT_QUOTES, "UTF-8")."</label>
						</div>
					</div>
					<div class='row-fluid m-l-20'>
						<div class='checkbox check-default'>
							<input id='can_manage_admins' class='user_checkbox' type='checkbox' >
							<label for='can_manage_admins' class='p-l-30'>".htmlentities($s["admin_can_manage_admins"], ENT_QUOTES, "UTF-8")."</label>
						</div>
					</div>
					<div class='row-fluid m-l-20'>
						<div class='checkbox check-default'>
							<input id='can_manage_users' class='user_checkbox' type='checkbox' >
							<label for='can_manage_users' class='p-l-30'>".htmlentities($s["admin_can_manage_users"], ENT_QUOTES, "UTF-8")."</label>
						</div>
					</div>
					<div class='row-fluid m-l-20'>
						<div class='checkbox check-default'>
							<input id='can_manage_app' class='user_checkbox' type='checkbox' >
							<label for='can_manage_app' class='p-l-30'>".htmlentities($s["admin_can_manage_app"], ENT_QUOTES, "UTF-8")."</label>
						</div>
					</div>
					<div class='row-fluid m-l-20'>
						<div class='checkbox check-default'>
							<input id='can_manage_brand' class='user_checkbox' type='checkbox' >
							<label for='can_manage_brand' class='p-l-30'>".htmlentities($s["admin_can_manage_brand"], ENT_QUOTES, "UTF-8")."</label>
						</div>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["admin_email"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["admin_email_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='email' name='email' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["admin_password"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["admin_password_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='password' id='password' name='password' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["admin_status"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["admin_status_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<select id='active' name='active'>
							<option value='0'>Inactivo</option>
							<option value='1' selected>Activo</option>
						</select>
					</div>
				</div>
				<div style='overflow:auto'>
					<div class='form-group'>
							<input type='submit' class='btn btn-white pull-right' value='".htmlentities($s["save"], ENT_QUOTES, "UTF-8")."' />
						<a href='../../admins' class='btn btn-white pull-left'>".htmlentities($s["previous"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>
			</form>
						";

	$response["data"]["new-admin-step-end"]="
		<form id='form-end'>
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
