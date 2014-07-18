<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 18-07-2014
	* Version: 0.93
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	* no_brand
	* brand_not_valid
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
	$page_path="server/app/ajax/accounts/subscription/edit/payment_plans";
	debug_log("[".$page_path."] START");


 	$response=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// BRAND
	$brand=array();$brand["id_brand"]=$_SESSION["admin"]["id_brand"];
	if(!checkBrand($brand)){echo json_encode($response);die();}


	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$response["result"]=true;


 	$table="brands";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$brand=getInBD($table,$filter);


	$response["data"]["page-title"]="<a href='../../'>".htmlentities($s["my_account"], ENT_QUOTES, "UTF-8")."</a> / <a href='../'>".htmlentities($s["subscription"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["change_subscription_type"], ENT_QUOTES, "UTF-8");



	$response["data"]["form-step-2"]="
			<h4 class='m-t-0'>".htmlentities($s["select_payment_plan"], ENT_QUOTES, "UTF-8")."</h4>
				<div id='form-warning'></div>
				<div class='form-group m-t-20'>
					<span class='help'></span>
					<div class='controls' style='border:1px solid #f4f4f4;padding:10px;'>
						<div class=''>
							<table>
								<tr>
									<td style='vertical-align:middle;padding:10px;padding-right:30px;'>
										<input id='payment_plan' type='radio' name='payment_plan' value='monthly' ";
	if($brand["payment_plan"]=="monthly"){
		$response["data"]["form-step-2"].="checked";
	}
	$response["data"]["form-step-2"].=">
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
										<input id='payment_plan' type='radio' name='payment_plan' value='semiannual' ";
	if($brand["payment_plan"]=="semiannual"){
		$response["data"]["form-step-2"].="checked";
	}
	$response["data"]["form-step-2"].=">
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
										<input id='payment_plan' type='radio' name='payment_plan' value='annual' ";
	if($brand["payment_plan"]=="annual"){
		$response["data"]["form-step-2"].="checked";
	}
	$response["data"]["form-step-2"].=">
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
