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
						<input type='submit' class='btn btn-white pull-right' value='".htmlentities($s["next"], ENT_QUOTES, "UTF-8")."' />
						<a href='../' class='btn btn-white pull-left'>".htmlentities($s["cancel"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>
	";
	$response["data"]["signup-step-2"]="
				<div id='form-warning'></div>
				<h4 class='m-t-0'>".htmlentities($signup_s["brand_data"], ENT_QUOTES, "UTF-8")."</h4>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($signup_s["app_name"], ENT_QUOTES, "UTF-8")."<span class='text-success m-l-5'>*</span></label>
					<span class='help'>".htmlentities($signup_s["app_name_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='app_name' name='app_name' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($signup_s["name"], ENT_QUOTES, "UTF-8")."<span class='text-success m-l-5'>*</span></label>
					<span class='help'>".htmlentities($signup_s["name_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='name' name='name' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($signup_s["cif"], ENT_QUOTES, "UTF-8")."<span class='text-success m-l-5'>*</span></label>
					<span class='help'>".htmlentities($signup_s["cif_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='cif' name='cif' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($signup_s["contact_phone"], ENT_QUOTES, "UTF-8")."<span class='text-success m-l-5'>*</span></label>
					<span class='help'>".htmlentities($signup_s["contact_phone_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='contact_phone' name='contact_phone' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($signup_s["contact_address"], ENT_QUOTES, "UTF-8")."<span class='text-success m-l-5'>*</span></label>
					<span class='help'>".htmlentities($signup_s["contact_address_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='contact_address' name='contact_address' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($signup_s["contact_postal_code"], ENT_QUOTES, "UTF-8")."<span class='text-success m-l-5'>*</span></label>
					<span class='help'>".htmlentities($signup_s["contact_postal_code_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='contact_postal_code' name='contact_postal_code' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($signup_s["contact_city"], ENT_QUOTES, "UTF-8")."<span class='text-success m-l-5'>*</span></label>
					<span class='help'>".htmlentities($signup_s["contact_city_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='contact_city' name='contact_city' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($signup_s["contact_province"], ENT_QUOTES, "UTF-8")."<span class='text-success m-l-5'>*</span></label>
					<span class='help'>".htmlentities($signup_s["contact_province_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='contact_province' name='contact_province' class='form-control'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($signup_s["contact_country"], ENT_QUOTES, "UTF-8")."<span class='text-success m-l-5'>*</span></label>
					<span class='help'>".htmlentities($signup_s["contact_country_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='contact_country' name='contact_country' class='form-control'>
					</div>
				</div>
				<div style='overflow:auto'>
					<div class='form-group'>
							<input type='submit' class='btn btn-white pull-right' value='".htmlentities($s["next"], ENT_QUOTES, "UTF-8")."' />
						<a href='javascript:prevstep()' class='btn btn-white pull-left'>".htmlentities($s["previous"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>
	";
	$response["data"]["signup-step-3"]="

			<h4 class='m-t-0'>".htmlentities($s["select_subscription_type"], ENT_QUOTES, "UTF-8")."</h4>
				<div id='form-warning'></div>
				<div class='form-group m-t-20'>
					<span class='help'></span>
					<div class='controls box'>
						<div class=''>
							<table>
								<tr>
									<td style='vertical-align:middle;padding:10px;padding-right:30px;'>
										<input id='subscription_type' type='radio' name='subscription_type' value='starter' checked>
									</td>
									<td  style='width:100%'>
										<h3 class='' >".htmlentities($royappty_plans["starter"]["title"], ENT_QUOTES, "UTF-8")."</h3>
										<p class='m-b-0'>".htmlentities($royappty_plans["starter"]["subtitle"], ENT_QUOTES, "UTF-8")."</p>
										<p class=''>".htmlentities($royappty_plans["starter"]["help"], ENT_QUOTES, "UTF-8")."</p>
									</td>
									<td>
										<h4 class='' style='white-space: nowrap;'>".htmlentities($royappty_plans["starter"]["price"], ENT_QUOTES, "UTF-8")."</h4>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
<div class='form-group m-t-20'>
					<span class='help'></span>
					<div class='controls box'>
						<div class=''>
							<table>
								<tr>
									<td style='vertical-align:middle;padding:10px;padding-right:30px;'>
										<input id='subscription_type' type='radio' name='subscription_type' value='professional'>
									</td>
									<td  style='width:100%'>
										<h3>".htmlentities($royappty_plans["professional"]["title"], ENT_QUOTES, "UTF-8")."</h3>
										<p class='m-b-0'>".htmlentities($royappty_plans["professional"]["subtitle"], ENT_QUOTES, "UTF-8")."</p>
										<p>".htmlentities($royappty_plans["professional"]["help"], ENT_QUOTES, "UTF-8")."</p>
									</td>
									<td>
										<h4 style='white-space: nowrap;'>".htmlentities($royappty_plans["professional"]["price"], ENT_QUOTES, "UTF-8")."</h4>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div class='form-group m-t-20'>
					<span class='help'></span>
					<div class='controls box'>
						<div class=''>
							<table>
								<tr>
									<td style='vertical-align:middle;padding:10px;padding-right:30px;'>
										<input id='subscription_type' type='radio' name='subscription_type' value='unlimited'>
									</td>
									<td  style='width:100%'>
										<h3>".htmlentities($royappty_plans["unlimited"]["title"], ENT_QUOTES, "UTF-8")."</h3>
										<p class='m-b-0'>".htmlentities($royappty_plans["unlimited"]["subtitle"], ENT_QUOTES, "UTF-8")."</p>
										<p>".htmlentities($royappty_plans["unlimited"]["help"], ENT_QUOTES, "UTF-8")."</p>
									</td>
									<td>
										<h4 style='white-space: nowrap;'>".htmlentities($royappty_plans["unlimited"]["price"], ENT_QUOTES, "UTF-8")."</h4>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div style='overflow:auto'>
					<div class='form-group'>
							<input type='submit' class='btn btn-white pull-right' value='".htmlentities($s["next"], ENT_QUOTES, "UTF-8")."' />
						<a href='javascript:prevstep()' class='btn btn-white pull-left'>".htmlentities($s["previous"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>
	";


	$response["data"]["signup-step-end"]="
			<input type='hidden' id='app_name' />
			<input type='hidden' id='name' />
			<input type='hidden' id='cif' />
			<input type='hidden' id='contact_phone' />
			<input type='hidden' id='contact_address' />
			<input type='hidden' id='contact_postal_code' />
			<input type='hidden' id='contact_city' />
			<input type='hidden' id='contact_province' />
			<input type='hidden' id='contact_country' />
			<input type='hidden' id='end_date_hour' />
			<input type='hidden' id='admin_name' />
			<input type='hidden' id='admin_email' />
			<input type='hidden' id='admin_password' />
			<input type='hidden' id='subscription_type' />
			<input type='hidden' id='payment_plan' />
			<input type='hidden' id='payment_method' />
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
