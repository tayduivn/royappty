<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 22-07-2014
	* Version: 0.93
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
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
	$page_path="server/app/ajax/accounts/login/login";
	debug_log("[".$page_path."] START");

 	$response=array();


	/*********************************************************
	* DATA CHECK
	*********************************************************/



	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$response["result"]=true;

	$response["data"]["login-title"]="
		<div class='text-center' style='height:100%'>
			<img style='width:320px' src='".$url_server."server/app/assets/img/royappty-logo.png' />
			<h3>".htmlentities($s["login"], ENT_QUOTES, "UTF-8")."</h3>
		</div>

	";

	//Form error handeler
	$error_alert="";
	@error_handeler($_POST["error"]);


	$response["data"]["login-step-1"]="
			<form id='form-step1'>
				<div id='form-warning'>".$error_alert."</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($login_s["email"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($login_s["email_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='email' name='email' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($login_s["password"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($login_s["password_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='password' id='password' name='password' class='form-control'>
					</div>
				</div>
				<p>
					<a href='../signup/'>".htmlentities($s["create_account"], ENT_QUOTES, "UTF-8")."</a>
					<a href='../recovery/' class='pull-right'>".htmlentities($s["did_you_lose_your_password"], ENT_QUOTES, "UTF-8")."</a>
				</p>
				<div style='overflow:auto'>
					<div class='form-group text-center'>
						<input type='submit' class='btn btn-white' value='".htmlentities($login_s["login_button"], ENT_QUOTES, "UTF-8")."' />
					</div>
				</div>
			</form>
	";

	$response["data"]["login-step-end"]="
		<form id='form-end'>
			<input type='hidden' id='email' />
			<input type='hidden' id='password' />
		</form>
	";
	$response["data"]["login-step-loading"]="
		<div class='text-center'>
			<div class='loader-activity'></div>
			<h3>".htmlentities($s["loading..."], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["this_may_take_several_seconds"], ENT_QUOTES, "UTF-8")."</div>
		</div>
	";
	$response["data"]["login-step-error"]="
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-times'></i></h1>
			<h3 class='text-center'>".htmlentities($s["error"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["there_was_an_error_please_try_later"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='./' class='btn btn-white'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
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
