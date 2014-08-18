<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 17-07-2014
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
	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));

	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/accounts/signup/signup";
	debug_log("[".$page_path."] START");

 	$response=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// SYSTEM CLOSED
if(!checkClosed()){echo json_encode($response);die();}

// BD CONNECTION
	if(!checkBDConnection()){echo json_encode($response);die();}



	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$response["result"]=true;

	$response["data"]["signup-title"]="
		<div class='text-center m-b-20'>
			<img class='' style='width:200px' src='".$url_server."server/app/assets/img/royappty-logo.png' />
			<h3>".htmlentities($s["create_account"], ENT_QUOTES, "UTF-8")."</h3>
		</div>";

	$response["data"]["signup-step-1"]="
			<h4 class='m-t-0'>".htmlentities($signup_s["admin_data"], ENT_QUOTES, "UTF-8")."</h4>
				<div id='form-warning'></div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($signup_s["admin_name"], ENT_QUOTES, "UTF-8")."<span class='text-success m-l-5'>*</span></label>
					<span class='help'>".htmlentities($signup_s["admin_name_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='admin_name' name='admin_name' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($signup_s["admin_email"], ENT_QUOTES, "UTF-8")."<span class='text-success m-l-5'>*</span></label>
					<span class='help'>".htmlentities($signup_s["admin_email_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='admin_email' name='admin_email' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($signup_s["admin_password"], ENT_QUOTES, "UTF-8")."<span class='text-success m-l-5'>*</span></label>
					<span class='help'>".htmlentities($signup_s["admin_password_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='password' id='admin_password' name='admin_password' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($signup_s["admin_password_repeat"], ENT_QUOTES, "UTF-8")."<span class='text-success m-l-5'>*</span></label>
					<span class='help'>".htmlentities($signup_s["admin_password_repeat_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='password' id='admin_password_repeat' name='admin_password_repeat' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'><a target='_blank' class='m-r-5' href='".$url_server."app/policy/?policy_type=security'><i class='fa fa-external-link'></i></a>".htmlentities($signup_s["accept_policy"], ENT_QUOTES, "UTF-8")."</label>
					<input id='accept_policy' name='accept_policy' type='checkbox'>
				</div>
				<div style='overflow:auto'>
					<div class='form-group'>
						<input type='submit' class='btn btn-white pull-right' value='".htmlentities($s["accept"], ENT_QUOTES, "UTF-8")."' />
						<a href='../' class='btn btn-white pull-left'>".htmlentities($s["cancel"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>
	";

	$response["data"]["signup-step-end"]="
			<input type='hidden' id='name' />
			<input type='hidden' id='email' />
			<input type='hidden' id='password' />
	";
	$response["data"]["signup-step-loading"]="
		<div class='text-center'>
			<div class='loader-activity'></div>
			<h3>".htmlentities($s["loading..."], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["this_may_take_several_seconds"], ENT_QUOTES, "UTF-8")."</div>
		</div>
	";
	$response["data"]["signup-step-error"]="
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-times'></i></h1>
			<h3 class='text-center'>".htmlentities($s["error"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["there_was_an_error_please_try_later"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='../../app/' class='btn btn-white'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
			</div>
		</div>
	";
$response["data"]["signup-step-success"]="
	<div class='text-center'>
		<h1 class='text-center'><i class='fa fa-check'></i></h1>
		<h3 class='text-center'>".htmlentities($signup_s["success_title"], ENT_QUOTES, "UTF-8")."</h3>
		<div class='msg'>".htmlentities($signup_s["success_subtitle"], ENT_QUOTES, "UTF-8")."</div>
		<div class='m-t-20'>
			<a href='../' class='btn btn-white m-r-10'>".htmlentities($s["login"], ENT_QUOTES, "UTF-8")."</a>
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
