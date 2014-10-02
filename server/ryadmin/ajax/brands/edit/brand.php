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
	* no_ryadmin
	* ryadmin_not_valid
	* ryadmin_inactive
	*	post_no_brand
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/
	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/ryadmin/ajax/brands/edit/brand";
	debug_log("[".$page_path."] START");

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// SYSTEM CLOSED
	if(!checkClosed()){echo json_encode($response);die();}

	// BD CONNECTION
	if(!checkBDConnection()){echo json_encode($response);die();}

	// RYADMIN
	$ryadmin=array();$ryadmin["id_ryadmin"]=$_SESSION["ryadmin"]["id_ryadmin"];
	if(!checkRyadmin($ryadmin)){echo json_encode($response);die();}

	// Data check START
	if(!@issetandnotempty($_POST["id_brand"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing id_brand");
		$response["error_code"]="post_no_brand";
		echo json_encode($response);
		die();
	}

 	$table="brands";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_POST["id_brand"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		error_log("[".$page_path."] ERROR Brand (id_brand=".$_POST["id_brand"].",id_admin=".$_POST["id_admin"].") doesn't exist");
		$response["error_code"]="post_no_brand";
 		echo json_encode($response);
 		die();
	}

 	// Data check END

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/
	$response["result"]=true;

 	$table="brands";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_POST["id_brand"]);
	$fields=array();
	$brand=getInBD($table,$filter,$fields);

 	$response=array();
 	$response["result"]=true;

	$response["data"]["page-title"]="<a href='../../brands'>".htmlentities($s["brands"], ENT_QUOTES, "UTF-8")."</a> / <a href='#'>".htmlentities($s["edit_brand"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($brand["name"], ENT_QUOTES, "UTF-8");
	$response["data"]["page-options"]="";

	$response["data"]["new-brand-step-1"]="
			<h4 class='m-t-0'>".htmlentities($s["edit_brand"], ENT_QUOTES, "UTF-8")."</h4>
			<form id='form-step1'>
				<div id='form-warning'></div>
				<div class='row'>
					<div class='col-md-6'>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($s["brand_name"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'>".htmlentities($s["brand_name_help"], ENT_QUOTES, "UTF-8")."</span>
							<div class='controls'>
								<input type='text' id='name' name='name' value='".$brand["name"]."' class='form-control'>
							</div>
						</div>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($s["brand_cif"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'>".htmlentities($s["brand_cif_help"], ENT_QUOTES, "UTF-8")."</span>
							<div class='controls'>
								<input type='text' id='cif' cif='cif' value='".$brand["cif"]."' class='form-control'>
							</div>
						</div>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($s["brand_active"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'>".htmlentities($s["brand_active_help"], ENT_QUOTES, "UTF-8")."</span>
							<div class='controls'>
								<select  id='active' name='active'>";
		for($i=1;$i<=2;$i++){
			$response["data"]["new-brand-step-1"].="<option value='".$i."'";
			if($brand["active"]==$i){
				$response["data"]["new-brand-step-1"].="selected";
			}
			$response["data"]["new-brand-step-1"].=">".htmlentities($s["brands_active"][$i], ENT_QUOTES, "UTF-8")."</option>";
		}
		$response["data"]["new-brand-step-1"].="
								</select>
							</div>
						</div>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($s["brand_created"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'>".htmlentities($s["brand_created_help"], ENT_QUOTES, "UTF-8")."</span>
							<div class='controls'>
								<input type='text' id='created' created='created' value='".$brand["created"]."' class='form-control'>
							</div>
						</div>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($s["brand_payment_plan"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'>".htmlentities($s["brand_payment_plan_help"], ENT_QUOTES, "UTF-8")."</span>
							<div class='controls'>
								<input type='text' id='payment_plan' name='payment_plan' value='".$brand["payment_plan"]."' class='form-control'>
							</div>
						</div>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($s["brand_payment_method"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'>".htmlentities($s["brand_payment_method_help"], ENT_QUOTES, "UTF-8")."</span>
							<div class='controls'>
								<input type='text' id='payment_method' name='payment_method' value='".$brand["payment_method"]."' class='form-control'>
							</div>
						</div>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($s["brand_payment_data"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'>".htmlentities($s["brand_payment_data_help"], ENT_QUOTES, "UTF-8")."</span>
							<div class='controls'>
								<input type='text' id='payment_data' name='payment_data' value='".$brand["payment_data"]."' class='form-control'>
							</div>
						</div>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($s["brand_expiration_date"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'>".htmlentities($s["brand_expiration_date_help"], ENT_QUOTES, "UTF-8")."</span>
							<div class='controls'>
								<input type='text' id='expiration_date' name='expiration_date' value='".$brand["expiration_date"]."' class='form-control'>
							</div>
						</div>
					</div>
					<div class='col-md-6'>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($s["brand_contact_name"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'>".htmlentities($s["brand_contact_name_help"], ENT_QUOTES, "UTF-8")."</span>
							<div class='controls'>
								<input type='text' id='contact_name' name='contact_name' value='".$brand["contact_name"]."' class='form-control'>
							</div>
						</div>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($s["brand_contact_email"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'>".htmlentities($s["brand_contact_email_help"], ENT_QUOTES, "UTF-8")."</span>
							<div class='controls'>
								<input type='text' id='contact_email' name='contact_email' value='".$brand["contact_email"]."' class='form-control'>
							</div>
						</div>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($s["brand_contact_phone"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'>".htmlentities($s["brand_contact_phone_help"], ENT_QUOTES, "UTF-8")."</span>
							<div class='controls'>
								<input type='text' id='contact_phone' name='contact_phone' value='".$brand["contact_phone"]."' class='form-control'>
							</div>
						</div>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($s["brand_contact_address"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'>".htmlentities($s["brand_contact_address_help"], ENT_QUOTES, "UTF-8")."</span>
							<div class='controls'>
								<input type='text' id='contact_address' name='contact_address' value='".$brand["contact_address"]."' class='form-control'>
							</div>
						</div>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($s["brand_contact_postal_code"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'>".htmlentities($s["brand_contact_postal_code_help"], ENT_QUOTES, "UTF-8")."</span>
							<div class='controls'>
								<input type='text' id='contact_postal_code' name='contact_postal_code' value='".$brand["contact_postal_code"]."' class='form-control'>
							</div>
						</div>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($s["brand_contact_city"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'>".htmlentities($s["brand_contact_city_help"], ENT_QUOTES, "UTF-8")."</span>
							<div class='controls'>
								<input type='text' id='contact_city' name='contact_city' value='".$brand["contact_city"]."' class='form-control'>
							</div>
						</div>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($s["brand_contact_province"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'>".htmlentities($s["brand_contact_province_help"], ENT_QUOTES, "UTF-8")."</span>
							<div class='controls'>
								<input type='text' id='contact_province' name='contact_province' value='".$brand["contact_province"]."' class='form-control'>
							</div>
						</div>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($s["brand_contact_country"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'>".htmlentities($s["brand_contact_country_help"], ENT_QUOTES, "UTF-8")."</span>
							<div class='controls'>
								<input type='text' id='contact_country' name='contact_country' value='".$brand["contact_country"]."' class='form-control'>
							</div>
						</div>
					</div>
				</div>
				<h3>".htmlentities($s["brand_resume_blocks"], ENT_QUOTES, "UTF-8")."</h3>
				<div class='row'>";
		for($i=1;$i<=4;$i++){
			$response["data"]["new-brand-step-1"].="<div class='col-md-6'>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($s["brand_resume_block_".$i], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'>".htmlentities($s["brand_resume_block_".$i."_help"], ENT_QUOTES, "UTF-8")."</span>
							<div class='controls'>
								<input type='checkbox' id='resume_block_".$i."_display' name='resume_block_".$i."_display' ";
			if($brand["resume_block_".$i."_display"]==1){
				$response["data"]["new-brand-step-1"].="checked='checked'";
			}
			$response["data"]["new-brand-step-1"].="/> ".htmlentities($s["show_resume_block"], ENT_QUOTES, "UTF-8")."
								<select id='resume_block_".$i."_title' name='resume_block_".$i."_title'>";
			for($j=1;$j<=4;$j++){
				$response["data"]["new-brand-step-1"].="<option value='".$block_types["brand"][$j]."' ";
				if($brand["resume_block_".$i."_title"]==$block_types["brand"][$j]){
					$response["data"]["new-brand-step-1"].="selected";
				}
				$response["data"]["new-brand-step-1"].=">".htmlentities($block_types["brand"][$j], ENT_QUOTES, "UTF-8")."</option>";
			}
			$response["data"]["new-brand-step-1"].="
								</select>
							</div>
						</div>
					</div>";
		}
				$response["data"]["new-brand-step-1"].="
				</div>

				<h3>".htmlentities($s["brand_app_config"], ENT_QUOTES, "UTF-8")."</h3>

				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["brand_android_key"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["brand_android_key_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='android_key' android_key='android_key' value='".$brand["android_key"]."' class='form-control'>
					</div>
				</div>






				<div style='overflow:auto'>
					<div class='form-group'>
							<input type='submit' class='btn btn-white pull-right' value='".htmlentities($s["save"], ENT_QUOTES, "UTF-8")."' />
					</div>
				</div>
			</form>";

	$response["data"]["new-brand-step-end"]="
		<form id='form-end'>
			<input type='hidden' id='id_brand' value='".$_POST["id_brand"]."' />
			<input type='hidden' id='name' />
			<input type='hidden' id='cif' />
			<input type='hidden' id='active' />
			<input type='hidden' id='created' />
			<input type='hidden' id='android_key' />
			<input type='hidden' id='resume_block_1_display' />
			<input type='hidden' id='resume_block_1_title' />
			<input type='hidden' id='resume_block_2_display' />
			<input type='hidden' id='resume_block_2_title' />
			<input type='hidden' id='resume_block_3_display' />
			<input type='hidden' id='resume_block_3_title' />
			<input type='hidden' id='resume_block_4_display' />
			<input type='hidden' id='resume_block_4_title' />
			<input type='hidden' id='subscription_type' />
			<input type='hidden' id='contact_name' />
			<input type='hidden' id='contact_email' />
			<input type='hidden' id='contact_phone' />
			<input type='hidden' id='contact_address' />
			<input type='hidden' id='contact_postal_code' />
			<input type='hidden' id='contact_city' />
			<input type='hidden' id='contact_province' />
			<input type='hidden' id='contact_country' />
			<input type='hidden' id='payment_plan' />
			<input type='hidden' id='payment_method' />
			<input type='hidden' id='payment_data' />
		</form>
	";
	$response["data"]["new-brand-step-loading"]="
		<div class='text-center'>
			<div class='loader-activity'></div>
			<h3>".htmlentities($s["loading..."], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["this_may_take_several_seconds"], ENT_QUOTES, "UTF-8")."</div>
		</div>
	";
	$response["data"]["new-brand-step-error"]="
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-times'></i></h1>
			<h3 class='text-center'>".htmlentities($s["error"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["there_was_an_error_please_try_later"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='../../admins/' class='btn btn-white'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
			</div>
		</div>
	";
	$response["data"]["new-brand-step-success"]="
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-check'></i></h1>
			<h3 class='text-center'>".htmlentities($s["brand_success_title"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["brand_success_subtitle"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='../../brands/' class='btn btn-white'>".htmlentities($s["all_brands"], ENT_QUOTES, "UTF-8")."</a>
				<a id='brand-link' href='#' class='btn btn-white m-r-10 m-l-10'>".htmlentities($s["view_brand"], ENT_QUOTES, "UTF-8")."</a>
				<a href='./' class='btn btn-white m-r-10'>".htmlentities($s["new_brand"], ENT_QUOTES, "UTF-8")."</a>
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
