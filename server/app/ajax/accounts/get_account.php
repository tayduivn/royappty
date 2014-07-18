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
	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));

	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/accounts/get_account";
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


	$response["data"]["page-title"]="<a href='#'>".htmlentities($s["my_account"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["details"], ENT_QUOTES, "UTF-8");


	$response["data"]["account-data"]="
		<h3 class='m-t-0'>".htmlentities($s["personal_info"], ENT_QUOTES, "UTF-8")."</h3>
		<table class='m-b-10'>
			<tr>
				<td><span class='text-success m-r-10'>".htmlentities($s["name"], ENT_QUOTES, "UTF-8")."</span></td>
				<td>".htmlentities($brand["name"], ENT_QUOTES, "UTF-8")."</td>
			</tr>
			<tr>
				<td><span class='text-success m-r-10'>".htmlentities($s["cif"], ENT_QUOTES, "UTF-8")."</span></td>
				<td>".htmlentities($brand["cif"], ENT_QUOTES, "UTF-8")."</td>
			</tr>
			<tr>
				<td><span class='text-success m-r-10'>".htmlentities($s["contact_name"], ENT_QUOTES, "UTF-8")."</span></td>
				<td>".htmlentities($brand["contact_name"], ENT_QUOTES, "UTF-8")."</td>
			</tr>
			<tr>
				<td><span class='text-success m-r-10'>".htmlentities($s["email"], ENT_QUOTES, "UTF-8")."</span></td>
				<td>".htmlentities($brand["contact_email"], ENT_QUOTES, "UTF-8")."</td>
			</tr>
			<tr>
				<td><span class='text-success m-r-10'>".htmlentities($s["phone"], ENT_QUOTES, "UTF-8")."</span></td>
				<td>".htmlentities($brand["contact_phone"], ENT_QUOTES, "UTF-8")."</td>
			</tr>
			<tr>
				<td><span class='text-success m-r-10'>".htmlentities($s["address"], ENT_QUOTES, "UTF-8")."</span></td>
				<td>".htmlentities($brand["contact_address"], ENT_QUOTES, "UTF-8")."</td>
			</tr>
			<tr>
				<td><span class='text-success m-r-10'>".htmlentities($s["postal_code"], ENT_QUOTES, "UTF-8")."</span></td>
				<td>".htmlentities($brand["contact_postal_code"], ENT_QUOTES, "UTF-8")."</td>
			</tr>
			<tr>
				<td><span class='text-success m-r-10'>".htmlentities($s["city"], ENT_QUOTES, "UTF-8")."</span></td>
				<td>".htmlentities($brand["contact_city"], ENT_QUOTES, "UTF-8")."</td>
			</tr>
			<tr>
				<td><span class='text-success m-r-10'>".htmlentities($s["country"], ENT_QUOTES, "UTF-8")."</span></td>
				<td>".htmlentities($brand["contact_country"], ENT_QUOTES, "UTF-8")."</td>
			</tr>
		</table>
		<p><a href='./data/edit/' class='btn btn-white'>".htmlentities($s["edit_personal_info"], ENT_QUOTES, "UTF-8")."</a></p>
		<p>".htmlentities($s["delete_your_account_help"], ENT_QUOTES, "UTF-8")." <a href='./data/delete/'>".htmlentities($s["here"], ENT_QUOTES, "UTF-8")."</a></p>


		<h4 class='m-t-20'>".htmlentities($s["subscription_type"], ENT_QUOTES, "UTF-8")."</h4>
		<p>".htmlentities($subscription_type_helper[$brand["subscription_type"]], ENT_QUOTES, "UTF-8")."</p>";

	if($brand["expiration_date"]>-1){
		if($brand["expiration_date"]-$timestamp<0){
			$response["data"]["account-data"].="
			<div class='box box-danger m-b-10'>
				<p class='text-danger m-b-0'>".htmlentities($s["expired_plan"], ENT_QUOTES, "UTF-8")."</p>
			</div>

		";

		}else if($brand["expiration_date"]-$timestamp<21600){
			$response["data"]["account-data"].="
			<div class='box box-warning m-b-10'>
				<p class='text-warning m-b-0'>".htmlentities($s["expiration_date_warning"], ENT_QUOTES, "UTF-8")."</p>
			</div>
			";
		}else{
			$response["data"]["account-data"].="
				<p>".htmlentities($s["account_expiration_date"], ENT_QUOTES, "UTF-8")." ".date("d-m-Y",$brand["expiration_date"])."</p>
			";
		}
	}


	$response["data"]["account-data"].="
		<p>
			<a href='./subscription/' class='btn btn-white'>".htmlentities($s["manage_subscription_and_payments"], ENT_QUOTES, "UTF-8")."</a>
		</p>
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
