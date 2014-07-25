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
	*
	* set_password_no_code
	* set_password_code_not_valid
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/accounts/recovery/set/set";
	debug_log("[".$page_path."] START");
 	$response=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	if(!@issetandnotempty($_POST["code"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data missing code");
		$response["error_code"]="set_password_no_code";
		echo json_encode($response);
		die();
	}

	$table="recovery_codes";
	$filter=array();
	$filter["code"]=array("operation"=>"=","value"=>$_POST["code"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Code not valid");
		$response["error_code"]="set_password_code_not_valid";
		echo json_encode($response);
		die();
	}

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/


	$response["result"]=true;


	$response["data"]["set_password-title"]="
		<div class='text-center' style='height:100%'>
			<img style='width:320px' src='".$url_server."server/app/assets/img/royappty-logo.png' />
			<h3>".htmlentities($s["set_password"], ENT_QUOTES, "UTF-8")."</h3>
		</div>
	";



	$response["data"]["set_password-step-1"]="
				<div id='form-warning'></div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($set_password_s["password"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($set_password_s["password_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='password' id='password' name='password' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($set_password_s["password_repeat"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($set_password_s["password_repeat_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='password' id='password_repeat' name='password_repeat' class='form-control'>
					</div>
				</div>
				<div style='overflow:auto'>
					<div class='form-group text-center'>
						<a href='../' class='btn btn-white'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
						<input type='submit' class='btn btn-white' value='".htmlentities($s["accept"], ENT_QUOTES, "UTF-8")."' />
					</div>
				</div>
	";
	$response["data"]["set_password-step-end"]="
		<input type='hidden' id='password' />
		<input type='hidden' id='code' value='".$_POST["code"]."'/>
	";
	$response["data"]["set_password-step-loading"]="
		<div class='text-center'>
			<div class='loader-activity'></div>
			<h3>".htmlentities($s["loading..."], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["this_may_take_several_seconds"], ENT_QUOTES, "UTF-8")."</div>
		</div>
	";
	$response["data"]["set_password-step-error"]="
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-times'></i></h1>
			<h3 class='text-center'>".htmlentities($s["error"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["there_was_an_error_please_try_later"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='./' class='btn btn-white'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
			</div>
		</div>
	";
	$response["data"]["set_password-step-success"]="
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-check'></i></h1>
			<h3 class='text-center'>".htmlentities($set_password_s["success_title"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($set_password_s["success_subtitle"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='../../' class='btn btn-white m-r-10'>".htmlentities($s["login"], ENT_QUOTES, "UTF-8")."</a>
			</div>
		</div>
	";

	/*********************************************************
	* DATABASE REGISTRATION
	*********************************************************/

	/*********************************************************
	* AJAX CALL RETURN
	*********************************************************/

 	echo json_encode($response);
	debug_log("[".$page_path."] END");
	die();

?>
