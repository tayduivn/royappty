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
	*
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));

	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/accounts/subscription/edit/payment_methods";
	debug_log("[".$page_path."] START");

 	$response=array();
 	
 	/*********************************************************
	* DATA CHECK
	*********************************************************/

	include(PATH."functions/check_session.php");



	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$response["result"]=true;


 	$table="brands";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$brand=getInBD($table,$filter);


	$response["data"]["page-title"]="<a href='../../'>".htmlentities($s["my_account"], ENT_QUOTES, "UTF-8")."</a> / <a href='../'>".htmlentities($s["subscription"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["change_subscription_type"], ENT_QUOTES, "UTF-8");



	$response["data"]["form-step-3"]="
			<h4 class='m-t-0'>".htmlentities($s["select_payment_method"], ENT_QUOTES, "UTF-8")."</h4>
				<div id='form-warning'></div>
				<div class='form-group m-t-20'>
					<span class='help'></span>
					<div class='controls' style='border:1px solid #f4f4f4;padding:10px;'>
						<div class=''>
							<table>
								<tr>
									<td style='vertical-align:middle;padding:10px;padding-right:30px;'>
										<input id='payment_method' type='radio' name='payment_method' value='paypal' ";
	if($brand["payment_method"]=="paypal"){
		$response["data"]["form-step-3"].="checked";
	}
	$response["data"]["form-step-3"].=">
									</td>
									<td  style='width:100%'>
										<h3>".htmlentities($payment_methods["paypal"]["title"], ENT_QUOTES, "UTF-8")."</h3>
										<p>".htmlentities($payment_methods["paypal"]["subtitle"], ENT_QUOTES, "UTF-8")."</p>
									</td>
									<td>
										<img style='height:40px;' src='".$url_server."server/app/assets/img/paypal.jpg' />
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
										<input id='payment_method' type='radio' name='payment_method' value='credit_card' ";
	if($brand["payment_method"]=="credit_card"){
		$response["data"]["form-step-3"].="checked";
	}
	$response["data"]["form-step-3"].=">
									</td>
									<td  style='width:100%'>
										<h3>".htmlentities($payment_methods["credit_card"]["title"], ENT_QUOTES, "UTF-8")."</h3>
										<p>".htmlentities($payment_methods["credit_card"]["subtitle"], ENT_QUOTES, "UTF-8")."</p>
									</td>
									<td>
										<img style='height:40px;' src='".$url_server."server/app/assets/img/credit_card.jpg' />
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
										<input id='payment_method' type='radio' name='payment_method' value='bank_transfer' ";
	if($brand["payment_method"]=="bank_transfer"){
		$response["data"]["form-step-3"].="checked";
	}
	$response["data"]["form-step-3"].=">
									</td>
									<td  style='width:100%'>
										<h3>".htmlentities($payment_methods["bank_transfer"]["title"], ENT_QUOTES, "UTF-8")."</h3>
										<p>".htmlentities($payment_methods["bank_transfer"]["subtitle"], ENT_QUOTES, "UTF-8")."</p>
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
										<input id='payment_method' type='radio' name='payment_method' value='standing_order_payment' ";
	if($brand["payment_method"]=="standing_order_payment"){
		$response["data"]["form-step-3"].="checked";
	}
	$response["data"]["form-step-3"].=">
									</td>
									<td  style='width:100%'>
										<h3>".htmlentities($payment_methods["standing_order_payment"]["title"], ENT_QUOTES, "UTF-8")."</h3>
										<p>".htmlentities($payment_methods["standing_order_payment"]["subtitle"], ENT_QUOTES, "UTF-8")."</p>
									</td>
								</tr>
							</table>

						</div>
					</div>
				</div>
				<div style='overflow:auto'>
					<div class='form-group'>
						<input type='submit' class='btn btn-white pull-right' value='".htmlentities($s["save"], ENT_QUOTES, "UTF-8")."' />
						<a href='javascript:prevstep()' class='btn btn-white pull-left'>".htmlentities($s["previous"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>";






	$response["data"]["form-step-end"]="
			<input type='hidden' id='subscription_type' value='".$_POST["subscription_type"]."'/>
			<input type='hidden' id='payment_plan' value='".$_POST["payment_plan"]."'/>
	";
	$response["data"]["subscription-step-loading"]="
		<div class='text-center'>
			<div class='loader-activity'></div>
			<h3>".htmlentities($s["loading..."], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["this_may_take_several_seconds"], ENT_QUOTES, "UTF-8")."</div>
		</div>
	";
	$response["data"]["subscription-step-error"]="
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-times'></i></h1>
			<h3 class='text-center'>".htmlentities($s["error"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["there_was_an_error_please_try_later"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='../../admins/' class='btn btn-white'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
			</div>
		</div>
	";
	$response["data"]["subscription-step-success"]="
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-check'></i></h1>
			<h3 class='text-center'>".htmlentities($s["subscription_success_title"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["subscription_success_subtitle"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='../../' class='btn btn-white'>".htmlentities($s["accept"], ENT_QUOTES, "UTF-8")."</a>
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
