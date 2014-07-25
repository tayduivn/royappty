<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 23-06-2014
	* Version: 0.91
	*
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:m:00"));



	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/accounts/signup/signup";
	debug_log("[".$page_path."] START");

 	$response=array();


	$response["result"]=true;

	$response["data"]["signup-step-5"]="
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




 	echo json_encode($response);
	debug_log("[server/ajax/campaigns/get_campaign] END");

?>
