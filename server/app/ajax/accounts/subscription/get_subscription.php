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
	*	no_admin
	* admin_not_valid
	* admin_inactive
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/
	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/accounts/subscription/get_subscription";
	debug_log("[".$page_path."] START");
 	$response=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/

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


	$response["data"]["page-title"]="<a href='../'>".htmlentities($s["my_account"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["subscription"], ENT_QUOTES, "UTF-8");


	$response["data"]["subscription-data"]="
		<h3 class='m-t-0'>".htmlentities($s["your_subscription_type_is"], ENT_QUOTES, "UTF-8")." <span class='text-success'>".htmlentities($subscription_type_name[$brand["subscription_type"]], ENT_QUOTES, "UTF-8")."</span></h3>
		<p>".htmlentities($subscription_type_name_helper[$brand["subscription_type"]], ENT_QUOTES, "UTF-8")."</p>
		<p>".htmlentities($payment_plan_helper[$brand["payment_plan"]], ENT_QUOTES, "UTF-8")." ".htmlentities($payment_method_helper[$brand["payment_method"]], ENT_QUOTES, "UTF-8")." </p>
		<p><a href='./edit/' class='btn btn-white'>".htmlentities($s["change_subscription_type"], ENT_QUOTES, "UTF-8")."</a></p>";
	if($brand["expiration_date"]>-1){
		if($brand["expiration_date"]-$timestamp<0){
			$response["data"]["subscription-data"].="
			<div class='box box-danger'>
				<p class='text-danger'>".htmlentities($s["account_expiration_date"], ENT_QUOTES, "UTF-8")." ".date("d-m-Y",$brand["expiration_date"])."</p>
				<p class='text-danger'>".htmlentities($s["expired_plan"], ENT_QUOTES, "UTF-8")."</p>
				<a href='./payment_gateway/' class='btn btn-danger'>".htmlentities($s["renew_subscription"], ENT_QUOTES, "UTF-8")."</a>
			</div>

		";

		}else if($brand["expiration_date"]-$timestamp<21600){
			$response["data"]["subscription-data"].="
			<div class='box box-warning'>
				<p class='text-warning'>".htmlentities($s["account_expiration_date"], ENT_QUOTES, "UTF-8")." ".date("d-m-Y",$brand["expiration_date"])."</p>
				<p class='text-warning'>".htmlentities($s["expiration_date_warning"], ENT_QUOTES, "UTF-8")."</p>
				<a href='./payment_gateway/' class='btn btn-warning'>".htmlentities($s["renew_subscription"], ENT_QUOTES, "UTF-8")."</a>
			</div>
			";
		}else{
			$response["data"]["subscription-data"].="
				<p>".htmlentities($s["account_expiration_date"], ENT_QUOTES, "UTF-8")." ".date("d-m-Y",$brand["expiration_date"])."</p>
			";
		}
	}

	$response["data"]["subscription-data"].="
		";

	$response["data"]["subscription-data"].="
		<h4 class='m-t-20'>".htmlentities($s["payments"], ENT_QUOTES, "UTF-8")."</h4>
		<p>".htmlentities($s["payments_helper"], ENT_QUOTES, "UTF-8")."</p>
		<a href='./receipts/' class='btn btn-white'>".htmlentities($s["view_payments_list"], ENT_QUOTES, "UTF-8")."</a>
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
