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
	$page_path="server/app/ajax/accounts/data/edit/data";
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


	$response["data"]["page-title"]="<a href='../../'>".htmlentities($s["my_account"], ENT_QUOTES, "UTF-8")."</a> / <a href='../'>".htmlentities($s["account_data"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["update_account_data"], ENT_QUOTES, "UTF-8");




	$response["data"]["form-step-1"]="
			<h4 class='m-t-0'>".htmlentities($s["account_data"], ENT_QUOTES, "UTF-8")."</h4>
				<div id='form-warning'></div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($brand_s["name"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($brand_s["name_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='name' name='name' class='form-control' value='".htmlentities($brand["name"], ENT_QUOTES, "UTF-8")."'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($brand_s["cif"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($brand_s["cif_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='cif' name='cif' class='form-control' value='".htmlentities($brand["cif"], ENT_QUOTES, "UTF-8")."'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($brand_s["contact_name"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($brand_s["contact_name_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='contact_name' name='contact_name' class='form-control' value='".htmlentities($brand["contact_name"], ENT_QUOTES, "UTF-8")."'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($brand_s["contact_email"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($brand_s["contact_email_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='contact_email' name='contact_email' class='form-control' value='".htmlentities($brand["contact_email"], ENT_QUOTES, "UTF-8")."'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($brand_s["contact_phone"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($brand_s["contact_phone_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='contact_phone' name='contact_phone' class='form-control' value='".htmlentities($brand["contact_phone"], ENT_QUOTES, "UTF-8")."'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($brand_s["contact_address"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($brand_s["contact_address_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='contact_address' name='contact_address' class='form-control' value='".htmlentities($brand["contact_address"], ENT_QUOTES, "UTF-8")."'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($brand_s["contact_postal_code"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($brand_s["contact_postal_code_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='contact_postal_code' name='contact_postal_code' class='form-control' value='".htmlentities($brand["contact_postal_code"], ENT_QUOTES, "UTF-8")."'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($brand_s["contact_city"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($brand_s["contact_city_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='contact_city' name='contact_city' class='form-control' value='".htmlentities($brand["contact_city"], ENT_QUOTES, "UTF-8")."'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($brand_s["contact_country"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($brand_s["contact_country_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='contact_country' name='contact_country' class='form-control' value='".htmlentities($brand["contact_country"], ENT_QUOTES, "UTF-8")."'>
					</div>
				</div>
				<div style='overflow:auto'>
					<div class='form-group'>
						<input type='submit' class='btn btn-white pull-right' value='".htmlentities($s["accept"], ENT_QUOTES, "UTF-8")."' />
						<a href='../' class='btn btn-white pull-left'>".htmlentities($s["cancel"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>";
	$response["data"]["form-step-end"]="
			<input type='hidden' id='name' value='".htmlentities($brand["name"], ENT_QUOTES, "UTF-8")."' />
			<input type='hidden' id='cif' value='".htmlentities($brand["cif"], ENT_QUOTES, "UTF-8")."'/>
			<input type='hidden' id='contact_name' value='".htmlentities($brand["contact_name"], ENT_QUOTES, "UTF-8")."'/>
			<input type='hidden' id='contact_email' value='".htmlentities($brand["contact_email"], ENT_QUOTES, "UTF-8")."' />
			<input type='hidden' id='contact_phone' value='".htmlentities($brand["contact_phone"], ENT_QUOTES, "UTF-8")."' />
			<input type='hidden' id='contact_address' value='".htmlentities($brand["contact_address"], ENT_QUOTES, "UTF-8")."' />
			<input type='hidden' id='contact_postal_code' value='".htmlentities($brand["contact_postal_code"], ENT_QUOTES, "UTF-8")."' />
			<input type='hidden' id='contact_city' value='".htmlentities($brand["contact_city"], ENT_QUOTES, "UTF-8")."' />
			<input type='hidden' id='contact_country' value='".htmlentities($brand["contact_country"], ENT_QUOTES, "UTF-8")."' />
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
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-check'></i></h1>
			<h3 class='text-center'>".htmlentities($s["account_data_success_title"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["account_data_success_subtitle"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='../' class='btn btn-white'>".htmlentities($s["accept"], ENT_QUOTES, "UTF-8")."</a>
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
