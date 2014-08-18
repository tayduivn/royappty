<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 23-07-2014
	* Version: 0.93
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	* db_connection_error
	*	post_no_signup_subscription_type
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
	$page_path="server/app/ajax/accounts/signup/get_payment_plans";
	debug_log("[".$page_path."] START");

 	$response=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// SYSTEM CLOSED
if(!checkClosed()){echo json_encode($response);die();}

// BD CONNECTION
	if(!checkBDConnection()){echo json_encode($response);die();}

	if(!@issetandnotempty($_POST["subscription_type"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing signup_subscription_type");
		$response["error_code"]="post_no_signup_subscription_type";
		$response["error_code_str"]= $error_step_s["post_no_signup_subscription_type"];
		echo json_encode($response);
		die();
	}


	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/


	$response["result"]=true;

	$response["data"]["signup-step-4"]="
			<h4 class='m-t-0'>".htmlentities($s["select_payment_plan"], ENT_QUOTES, "UTF-8")."</h4>
				<div id='form-warning'></div>
				<div class='form-group m-t-20'>
					<span class='help'></span>
					<div class='controls' style='border:1px solid #f4f4f4;padding:10px;'>
						<div class=''>
							<table>
								<tr>
									<td style='vertical-align:middle;padding:10px;padding-right:30px;'>
										<input id='payment_plan' type='radio' name='payment_plan' value='monthly' checked >
									</td>
									<td  style='width:100%'>
										<h3>".htmlentities($payment_plans["monthly"]["title"], ENT_QUOTES, "UTF-8")."</h3>
										<p>".htmlentities($payment_plans["monthly"]["subtitle"], ENT_QUOTES, "UTF-8")."</p>
									</td>
									<td>
										<h4  style='white-space: nowrap;'>".htmlentities($payment_plans["monthly"]["price_".$_POST["subscription_type"]], ENT_QUOTES, "UTF-8")."</h4>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div class='form-group m-t-20'>
					<span class='help'></span>
					<div class='controls' style='border:1px solid #f4f4f4;padding:10px;'>
						<div class=''>
							<table>
								<tr>
									<td style='vertical-align:middle;padding:10px;padding-right:30px;'>
										<input id='payment_plan' type='radio' name='payment_plan' value='semiannual'>
									</td>
									<td  style='width:100%'>
										<h3>".htmlentities($payment_plans["semiannual"]["title"], ENT_QUOTES, "UTF-8")."</h3>
										<p>".htmlentities($payment_plans["semiannual"]["subtitle"], ENT_QUOTES, "UTF-8")."</p>
									</td>
									<td>
										<h4  style='white-space: nowrap;'>".htmlentities($payment_plans["semiannual"]["price_".$_POST["subscription_type"]], ENT_QUOTES, "UTF-8")."</h4>
									</td>
								</tr>
							</table>

						</div>
					</div>
				</div>
				<div class='form-group m-t-20'>
					<span class='help'></span>
					<div class='controls' style='border:1px solid #f4f4f4;padding:10px;'>
						<div class=''>
							<table>
								<tr>
									<td style='vertical-align:middle;padding:10px;padding-right:30px;'>
										<input id='payment_plan' type='radio' name='payment_plan' value='annual'>
									</td>
									<td  style='width:100%'>
										<h3>".htmlentities($payment_plans["annual"]["title"], ENT_QUOTES, "UTF-8")."</h3>
										<p>".htmlentities($payment_plans["annual"]["subtitle"], ENT_QUOTES, "UTF-8")."</p>
									</td>
									<td>
										<h4  style='white-space: nowrap;'>".htmlentities($payment_plans["annual"]["price_".$_POST["subscription_type"]], ENT_QUOTES, "UTF-8")."</h4>
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
	$response["data"]["signup-step-5"]="
			<h4 class='m-t-0'>".htmlentities($s["select_payment_method"], ENT_QUOTES, "UTF-8")."</h4>
				<div id='form-warning'></div>
				<div class='form-group m-t-20'>
					<span class='help'></span>
					<div class='controls' style='border:1px solid #f4f4f4;padding:10px;'>
						<div class=''>
							<table>
								<tr>
									<td style='vertical-align:middle;padding:10px;padding-right:30px;'>
										<input id='payment_method' type='radio' name='payment_method' value='paypal' checked >
									</td>
									<td  style='width:100%'>
										<h3>".htmlentities($payment_methods["paypal"]["title"], ENT_QUOTES, "UTF-8")."</h3>
										<p>".htmlentities($payment_methods["paypal"]["subtitle"], ENT_QUOTES, "UTF-8")."</p>
									</td>
									<td>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div class='form-group m-t-20'>
					<span class='help'></span>
					<div class='controls' style='border:1px solid #f4f4f4;padding:10px;'>
						<div class=''>
							<table>
								<tr>
									<td style='vertical-align:middle;padding:10px;padding-right:30px;'>
										<input id='payment_method' type='radio' name='payment_method' value='credit_card'>
									</td>
									<td  style='width:100%'>
										<h3>".htmlentities($payment_method["credit_card"]["title"], ENT_QUOTES, "UTF-8")."</h3>
										<p>".htmlentities($payment_methods["credit_card"]["subtitle"], ENT_QUOTES, "UTF-8")."</p>
									</td>
									<td>
									</td>
								</tr>
							</table>

						</div>
					</div>
				</div>
				<div class='form-group m-t-20'>
					<span class='help'></span>
					<div class='controls' style='border:1px solid #f4f4f4;padding:10px;'>
						<div class=''>
							<table>
								<tr>
									<td style='vertical-align:middle;padding:10px;padding-right:30px;'>
										<input id='payment_method' type='radio' name='payment_method' value='bank_transfer'>
									</td>
									<td  style='width:100%'>
										<h3>".htmlentities($payment_method["bank_transfer"]["title"], ENT_QUOTES, "UTF-8")."</h3>
										<p>".htmlentities($payment_methods["bank_transfer"]["subtitle"], ENT_QUOTES, "UTF-8")."</p>
									</td>
									<td>
									</td>
								</tr>
							</table>

						</div>
					</div>
				</div>
				<div class='form-group m-t-20'>
					<span class='help'></span>
					<div class='controls' style='border:1px solid #f4f4f4;padding:10px;'>
						<div class=''>
							<table>
								<tr>
									<td style='vertical-align:middle;padding:10px;padding-right:30px;'>
										<input id='standing_order_payment' type='radio' name='payment_method' value='standing_order_payment'>
									</td>
									<td  style='width:100%'>
										<h3>".htmlentities($payment_method["standing_order_payment"]["title"], ENT_QUOTES, "UTF-8")."</h3>
										<p>".htmlentities($payment_methods["standing_order_payment"]["subtitle"], ENT_QUOTES, "UTF-8")."</p>
									</td>
									<td>
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
