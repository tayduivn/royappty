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
	*	no_admin
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
	$page_path="server/app/ajax/accounts/subscription/payment_gateway/get_payment_gateway";
	debug_log("[".$page_path."] START");
 	$response=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/

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

	$table="subscription_method_plans";
	$filter=array();
	$filter["subscription_type"]=array("operation"=>"=","value"=>$brand["subscription_type"]);
	$filter["payment_plan"]=array("operation"=>"=","value"=>$brand["payment_plan"]);
	$subscription_method_plans=getInBD($table,$filter);

	$table="orders";
	$data=array();
	$data["id_brand"]=$_SESSION["admin"]["id_brand"];
	$data["created"]=$timestamp;
	$data["subscription_type"]=$brand["subscription_type"];
	$data["payment_plan"]=$brand["payment_plan"];
	$data["payment_method"]=$brand["payment_method"];
	$data["amount"]=$subscription_method_plans["price"];
	$order=array();
	$order["id_order"]=addInBD($table,$data);

	$table="config";
	$filter=array();
	$filter["used"]=array("operation"=>"=","value"=>1);
	$fields=array("bank_name","bank_swift","bank_iban","bank_account_number","bank_transfer_beneficiary");
	$royappty_bank=getInBD($table,$filter,$fields);
	$royappty_bank["bank_transfer_concept"]="ROYA-".str_pad($order["id_order"], 5, "0", STR_PAD_LEFT);
	$royappty_bank["bank_transfer_amount"]=number_format($subscription_method_plans["price"],2);

	$response["data"]["page-title"]="<a href='../../'>".htmlentities($s["my_account"], ENT_QUOTES, "UTF-8")."</a> / <a href='../'>".htmlentities($s["subscription"], ENT_QUOTES, "UTF-8")." </a>/ ".htmlentities($s["payment_gateway"], ENT_QUOTES, "UTF-8");

	switch ($brand["payment_method"]){
		case "paypal":
			$response["data"]["payment-gateway"]="
				<h3 class='m-t-0'>".htmlentities($payment_method["paypal"], ENT_QUOTES, "UTF-8")."</h3>
				<div class='text-center'>
					<div class='loader-activity'></div>
					<h4>".htmlentities($s["redirecting_to_paypal"], ENT_QUOTES, "UTF-8")."</h4>
					<div class='msg'>".htmlentities($s["this_may_take_several_seconds"], ENT_QUOTES, "UTF-8")."</div>
				</div>
			";
			break;
		case "credit_card":
			$response["data"]["payment-gateway"]="
				<h3 class='m-t-0'>".htmlentities($payment_method["credit_card"], ENT_QUOTES, "UTF-8")."</h3>
				<div class='text-center'>
					<div class='loader-activity'></div>
					<h4>".htmlentities($s["redirecting_to_gateway"], ENT_QUOTES, "UTF-8")."</h4>
					<div class='msg'>".htmlentities($s["this_may_take_several_seconds"], ENT_QUOTES, "UTF-8")."</div>
				</div>
			";
			break;
		case "bank_transfer":

			$table="requests";
			$data=array();
			$data["id_brand"]=$_SESSION["admin"]["id_brand"];
			$data["code"]=strtoupper(dechex(strtotime(date("Y-m-d H:i:s")).$_SESSION["admin"]["id_brand"]));
			$data["type"]="bank_transfer_confirmation";
			$data["status"]="in_process";
			$data["created"]=$timestamp;
			$data["data"]=$order["id_order"];
			$request=array();
			$request["id_request"]=addInBD($table,$data);


			$response["data"]["payment-gateway"]="
				<h3 class='m-t-0'>".htmlentities($payment_method["bank_transfer"], ENT_QUOTES, "UTF-8")."</h3>
				<div class='m-t-20' id='printable'>
					<div class='text-center only_printable'>
						<img style='width:200px' src='".$url_server."assets/img/royappty-logo.png' />
					</div>
					<h4 class='text-center'>".htmlentities($s["bank_transfer_title"], ENT_QUOTES, "UTF-8")."</h4>
					<div class='box box-warning' style='width:75%;margin:20px auto ;'>
						<p class='text-warning m-b-0'>".htmlentities($s["bank_transfer_subtitle"], ENT_QUOTES, "UTF-8")."</p>
					</div>
					<table class='box box-muted m-t-30' style='width:75%;margin:auto;'>
						<tr>
							<td class='text-right p-r-10' style='width:50%'>
								<h5 class='text-success'>".htmlentities($s["bank_name"], ENT_QUOTES, "UTF-8")."</h5>
							</td>
							<td class='text-left p-l-10' style='width:50%'>
								<h5>".htmlentities($royappty_bank["bank_name"], ENT_QUOTES, "UTF-8")."</h5>

							</td>
						</tr>
						<tr>
							<td class='text-right p-r-10' style='width:50%'>
								<h5 class='text-success'>".htmlentities($s["bank_swift"], ENT_QUOTES, "UTF-8")."</h5>
							</td>
							<td class='text-left p-l-10' style='width:50%'>
								<h5>".htmlentities($royappty_bank["bank_swift"], ENT_QUOTES, "UTF-8")."</h5>

							</td>
						</tr>
						<tr>
							<td class='text-right p-r-10' style='width:50%'>
								<h5 class='text-success'>".htmlentities($s["bank_iban"], ENT_QUOTES, "UTF-8")."</h5>
							</td>
							<td class='text-left p-l-10' style='width:50%'>
								<h5>".htmlentities($royappty_bank["bank_iban"], ENT_QUOTES, "UTF-8")."</h5>

							</td>
						</tr>
						<tr>
							<td class='text-right p-r-10' style='width:50%'>
								<h5 class='text-success'>".htmlentities($s["bank_account_number"], ENT_QUOTES, "UTF-8")."</h5>
							</td>
							<td class='text-left p-l-10' style='width:50%'>
								<h5>".htmlentities($royappty_bank["bank_account_number"], ENT_QUOTES, "UTF-8")."</h5>

							</td>
						</tr>
						<tr>
							<td class='text-right p-r-10' style='width:50%'>
								<h5 class='text-success'>".htmlentities($s["bank_transfer_beneficiary"], ENT_QUOTES, "UTF-8")."</h5>
							</td>
							<td class='text-left p-l-10' style='width:50%'>
								<h5>".htmlentities($royappty_bank["bank_transfer_beneficiary"], ENT_QUOTES, "UTF-8")."</h5>

							</td>
						</tr>
						<tr>
							<td class='text-right p-r-10' style='width:50%'>
								<h5 class='text-success'>".htmlentities($s["bank_transfer_concept"], ENT_QUOTES, "UTF-8")."</h5>
							</td>
							<td class='text-left p-l-10' style='width:50%'>
								<h5>".htmlentities($royappty_bank["bank_transfer_concept"], ENT_QUOTES, "UTF-8")."</h5>

							</td>
						</tr>
						<tr>
							<td class='text-right p-r-10' style='width:50%'>
								<h5 class='text-success'>".htmlentities($s["bank_transfer_amount"], ENT_QUOTES, "UTF-8")."</h5>
							</td>
							<td class='text-left p-l-10' style='width:50%'>
								<h5>".htmlentities($royappty_bank["bank_transfer_amount"], ENT_QUOTES, "UTF-8")." ".htmlentities($s["euros_symbol"], ENT_QUOTES, "UTF-8")."</h5>

							</td>
						</tr>
					</table>

				</div>
				<div class='text-center m-t-20 m-b-20'>
					<a href='javascript:print_area()' class='btn btn-white'>".htmlentities($s["print"], ENT_QUOTES, "UTF-8")."</a>
					<a href='../../../request/?id_request=".$request["id_request"]."' class='btn btn-white'>".htmlentities($s["view_request"], ENT_QUOTES, "UTF-8")."</a>
					<a href='../' class='btn btn-white'>".htmlentities($s["accept"], ENT_QUOTES, "UTF-8")."</a>
				</div>
			";
			break;
		case "standing_order_payment":
			$response["data"]["payment-gateway"]="
				<div id='form-wizard'>
					<div id='form-content'>
						<div id='step-1' class='ajax-loader-new-discount-step-1'>
							<h3 class='m-t-0'>".htmlentities($payment_method["standing_order_payment"], ENT_QUOTES, "UTF-8")."</h3>

							<div class='box box-warning m-b-10'>
								<p class='text-warning m-b-0'>".htmlentities($s["standing_order_payment_data_helper"], ENT_QUOTES, "UTF-8")."</p>
							</div>
							<form id='form-step1'>
								<div id='form-warning'></div>
								<div class='form-group'>
									<div class='form-group'>
										<label class='form-label'>".htmlentities($s["bank_account_number"], ENT_QUOTES, "UTF-8")."</label>
										<span class='help'>".htmlentities($s["bank_account_number_helper"], ENT_QUOTES, "UTF-8")."</span>
										<div class='controls'>
											<div style='overflow:auto;'>
												<div class='text-center pull-left m-r-10'>
													<input type='text' id='number_bank' name='number_bank' class='form-control' maxlength='4' minlength='4' style='width:70px;text-align:center'>
													<label class='text-small text-muted'>".htmlentities($s["bank_account_number_bank"], ENT_QUOTES, "UTF-8")."</label>
												</div>
												<div class='text-center pull-left m-r-10'>
													<input type='text' id='number_office' name='number_office' class='form-control' maxlength='4' minlength='4' style='width:70px;text-align:center'>
													<label class='text-small text-muted'>".htmlentities($s["bank_account_number_office"], ENT_QUOTES, "UTF-8")."</label>
												</div>
												<div class='text-center pull-left m-r-10'>
													<input type='text' id='control_digit' name='control_digit' class='form-control' maxlength='2' minlength='2'  style='width:50px;text-align:center'>
													<label class='text-small text-muted'>".htmlentities($s["bank_account_number_control_digit"], ENT_QUOTES, "UTF-8")."</label>
												</div>
												<div class='text-center pull-left m-r-10'>
													<input type='text' id='account_number' name='account_number' class='form-control' maxlength='10' minlength='10'  style='width:120px;text-align:center'>
													<label class='text-small text-muted'>".htmlentities($s["bank_account_number_account_number"], ENT_QUOTES, "UTF-8")."</label>
												</div>
											</div>
										</div>

									</div>
								</div>
								<div class='form-group text-center'>
									<input type='submit' class='btn btn-white' value='".htmlentities($s["accept"], ENT_QUOTES, "UTF-8")."' />
								</div>
							</form>
						</div>
						<div id='step-end' class='ajax-loader-new-discount-step-end' style='display:none'>
							<form id='form-end'>
								<input type='hidden' name='payment_data' id='payment_data' />
							</form>
						</div>
					</div>
					<div id='form-loading' class='ajax-loader-new-discount-step-loading' style='display:none'>
						<div class='text-center'>
							<div class='loader-activity'></div>
							<h3>".htmlentities($s["loading..."], ENT_QUOTES, "UTF-8")."</h3>
							<div class='msg'>".htmlentities($s["this_may_take_several_seconds"], ENT_QUOTES, "UTF-8")."</div>
						</div>
					</div>
					<div id='form-error' class='ajax-loader-new-discount-step-error' style='display:none'>
						<div class='text-center'>
							<h1 class='text-center'><i class='fa fa-times'></i></h1>
							<h3 class='text-center'>".htmlentities($s["error"], ENT_QUOTES, "UTF-8")."</h3>
							<div class='msg'>".htmlentities($s["there_was_an_error_please_try_later"], ENT_QUOTES, "UTF-8")."</div>
							<div class='m-t-20'>
								<a href='../' class='btn btn-white'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
							</div>
						</div>
					</div>
					<div id='form-success' class='ajax-loader-new-discount-step-success' style='display:none'>
						<div class='text-center'>
							<h1 class='text-center'><i class='fa fa-check'></i></h1>
							<h3 class='text-center'>".htmlentities($payment_gateway_s["success_title"], ENT_QUOTES, "UTF-8")."</h3>
							<div class='msg'>".htmlentities($payment_gateway_s["success_subtitle"], ENT_QUOTES, "UTF-8")."</div>
							<div class='m-t-20'>
								<a href='../' class='btn btn-white m-r-10'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			";
			break;
	}


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
