<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 23-06-2014
	* Version: 0.91
	*
	*********************************************************/
	
	define('PATH', str_replace('\\', '/','../../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d 00:00:00"));



	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/campaigns/get_campaign";
	debug_log("[".$page_path."] START");
	include(PATH."functions/check_session.php");

 	$response=array();


	$response["result"]=true;


 	$table="brands";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$brand=getInBD($table,$filter);


	$response["data"]["page-title"]="<a href='../../'>".htmlentities($s["my_account"], ENT_QUOTES, "UTF-8")."</a> / <a href='../'>".htmlentities($s["account_data"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["delete_account"], ENT_QUOTES, "UTF-8");




	$response["data"]["form-step-1"]="
			<h4 class='m-t-0'>".htmlentities($s["delete_account"], ENT_QUOTES, "UTF-8")."</h4>
				<div id='form-warning'></div>
				<div class='box box-warning m-b-10'>
					<h5 class='text-warning'>".htmlentities($s["delete_account_warning_title"], ENT_QUOTES, "UTF-8")."</h5>
				</div>
				<p class='text-black'>".htmlentities($s["delete_account_warning"], ENT_QUOTES, "UTF-8")."</h5>
				<p class='text-black'>".htmlentities($s["lock_account_selection_warning"], ENT_QUOTES, "UTF-8")."</h5>
				<p class='text-black'>".htmlentities($s["delete_account_selection_warning"], ENT_QUOTES, "UTF-8")."</h5>
				<p class='text-danger'>".htmlentities($s["app_delete_account_warning"], ENT_QUOTES, "UTF-8")."</h5>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["select_delete_option"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($brand_s["select_delete_option_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<select id='delete_option' name='delete_option'>
							<option value='0'>".htmlentities($s["select_an_option"], ENT_QUOTES, "UTF-8")."</option>
							<option value='lock'>".htmlentities($s["lock"], ENT_QUOTES, "UTF-8")."</option>
							<option value='delete_now'>".htmlentities($s["delete_now"], ENT_QUOTES, "UTF-8")."</option>
						</select>
					</div>
				</div>

				<div style='overflow:auto'>
					<div class='form-group'>
						<input type='submit' class='btn btn-danger pull-right' value='".htmlentities($s["accept"], ENT_QUOTES, "UTF-8")."' />
						<a href='../' class='btn btn-white pull-left'>".htmlentities($s["cancel"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>";
	$response["data"]["form-step-end"]="
			<input type='hidden' id='delete_option'/>
	";
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
				<a href='../' class='btn btn-white'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
			</div>
		</div>
	";
	$response["data"]["form-step-success"]="

	";

	 	echo json_encode($response);
	debug_log("[server/ajax/campaigns/get_campaign] END");

?>
