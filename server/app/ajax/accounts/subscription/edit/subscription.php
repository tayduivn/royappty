<?php
	/************************************************************
	* Royappty
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Modification: 10-02-2014
	* Version: 1.0
	* licensed through CC BY-NC 4.0
	************************************************************/

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
	$page_path="server/app/ajax/accounts/subscription/edit/subscription";
	debug_log("[".$page_path."] START");
 	$response=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// SYSTEM CLOSED
if(!checkClosed()){echo json_encode($response);die();}

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


	$response["data"]["page-title"]="<a href='../../'>".htmlentities($s["my_account"], ENT_QUOTES, "UTF-8")."</a> / <a href='../'>".htmlentities($s["subscription"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["change_subscription_type"], ENT_QUOTES, "UTF-8");




	$response["data"]["form-step-1"]="
			<h4 class='m-t-0'>".htmlentities($s["select_subscription_type"], ENT_QUOTES, "UTF-8")."</h4>
				<div id='form-warning'></div>
				<div class='form-group m-t-20'>
					<span class='help'></span>
					<div class='controls' style='border:1px solid #f4f4f4;padding:10px;'>
						<div class=''>
							<table>
								<tr>
									<td style='vertical-align:middle;padding:10px;padding-right:30px;'>
										<input id='subscription_type' type='radio' name='subscription_type' value='starter' ";
	if($brand["subscription_type"]=="starter"){
		$response["data"]["form-step-1"].="checked";
	}
	$response["data"]["form-step-1"].=">
									</td>
									<td  style='width:100%'>
										<h3>".htmlentities($royappty_plans["starter"]["title"], ENT_QUOTES, "UTF-8")."</h3>
										<p>".htmlentities($royappty_plans["starter"]["subtitle"], ENT_QUOTES, "UTF-8")."</p>
									</td>
									<td>
										<h4>".htmlentities($royappty_plans["starter"]["price"], ENT_QUOTES, "UTF-8")."</h4>
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
										<input id='subscription_type' type='radio' name='subscription_type' value='professional' ";
	if($brand["subscription_type"]=="professional"){
		$response["data"]["form-step-1"].="checked";
	}
	$response["data"]["form-step-1"].=">
									</td>
									<td  style='width:100%'>
										<h3>".htmlentities($royappty_plans["professional"]["title"], ENT_QUOTES, "UTF-8")."</h3>
										<p>".htmlentities($royappty_plans["professional"]["subtitle"], ENT_QUOTES, "UTF-8")."</p>
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
					<div class='controls' style='border:1px solid #f4f4f4;padding:10px;'>
						<div class=''>
							<table>
								<tr>
									<td style='vertical-align:middle;padding:10px;padding-right:30px;'>
										<input id='subscription_type' type='radio' name='subscription_type' value='unlimited' ";
	if($brand["subscription_type"]=="unlimited"){
		$response["data"]["form-step-1"].="checked";
	}
	$response["data"]["form-step-1"].=">
									</td>
									<td  style='width:100%'>
										<h3>".htmlentities($royappty_plans["unlimited"]["title"], ENT_QUOTES, "UTF-8")."</h3>
										<p>".htmlentities($royappty_plans["unlimited"]["subtitle"], ENT_QUOTES, "UTF-8")."</p>
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
						<a href='../' class='btn btn-white pull-left'>".htmlentities($s["cancel"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>";

	$response["data"]["form-step-loading"]="
		<div class='text-center'>
			<div class='loader-activity'></div>
			<h3>".htmlentities($s["loading..."], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["this_may_take_several_seconds"], ENT_QUOTES, "UTF-8")."</div>
		</div>
	";
	$response["data"]["form-step-error"]="
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-times'></i></h1>
			<h3 class='text-center'>".htmlentities($s["error"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["there_was_an_error_please_try_later"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='../../admins/' class='btn btn-white'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
			</div>
		</div>
	";
	$response["data"]["form-step-success"]="
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
