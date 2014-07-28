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
	* no_admin
	* admin_not_valid
	* admin_inactive
	* post_no_receipt
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/
	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/accounts/receipts/get_receipt";
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

	// POST
	if(!@issetandnotempty($_POST["id_receipt"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing id_receipt");
		$response["error_code"]="post_no_receipt";
		echo json_encode($response);
		die();
	}

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$response["result"]=true;


 	$table="receipts";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$filter["id_receipt"]=array("operation"=>"=","value"=>$_POST["id_receipt"]);
	$receipt=getInBD($table,$filter);


 	$response["data"]["page-title"] = "<a href='../../'>".htmlentities($s["my_account"], ENT_QUOTES, "UTF-8")."</a> / <a href='../'>".htmlentities($s["subscription"], ENT_QUOTES, "UTF-8")."</a> / <a href='../receipts/'>".htmlentities($s["receipts"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["receipt"], ENT_QUOTES, "UTF-8")." #".$receipt["id_receipt"];


	$response["data"]["subscription-data"]="
		<div class='pull-right'>
			<img style='width:200px' src='".$url_server."server/app/assets/img/royappty-logo.png'/>
		</div>
		<h3 class='m-t-0'>".htmlentities($s["receipt"], ENT_QUOTES, "UTF-8")." #".$receipt["id_receipt"]."</h3>
		<div class='m-b-20'>
			<table class='m-b-10'>
				<tr>
					<td><span class='text-sucess m-r-10'>".htmlentities($s["date"], ENT_QUOTES, "UTF-8")."</span></td>
					<td>".date("d-m-Y",$receipt["created"])."</td>
				</tr>
				<tr>
					<td><span class='text-sucess m-r-10'>".htmlentities($s["order_number"], ENT_QUOTES, "UTF-8")."</span></td>
					<td>#".$receipt["created"]."</td>
				</tr>
				<tr>
					<td><span class='text-sucess m-r-10'>".htmlentities($s["payment_method"], ENT_QUOTES, "UTF-8")."</span></td>
					<td>".$payment_method[$receipt["payment_method"]]."</td>
				</tr>
				<tr>
					<td><span class='text-sucess m-r-10'>".htmlentities($s["distributor"], ENT_QUOTES, "UTF-8")."</span></td>
					<td>".htmlentities($receipt["distributor_name"], ENT_QUOTES, "UTF-8")."</td>
				</tr>
				<tr>
					<td><span class='text-sucess m-r-10'>".htmlentities($s["company_id"], ENT_QUOTES, "UTF-8")."</span></td>
					<td>".htmlentities($receipt["distributor_id"], ENT_QUOTES, "UTF-8")."</td>
				</tr>
			</table>";

	$table='receipt_lines';
	$filter=array();
	$filter["id_receipt"]=array("operation"=>"=","value"=>$receipt["id_receipt"]);
	$receipt_lines = listInBD($table,$filter);


	foreach ($receipt_lines as $key => $receipt_line){
		$response["data"]["subscription-data"].="
			<div class='bg-grey padding-10'>
				<span class='pull-right'>".htmlentities($receipt_line["price_vat"], ENT_QUOTES, "UTF-8")."€</span>
				".htmlentities($receipt_line["content"], ENT_QUOTES, "UTF-8")."
			</div>
		";
	}

	$response["data"]["subscription-data"].="
		<div class='bg-grey padding-10'>
			<span class='pull-right'>".$receipt["vat"]."€</span>
			".htmlentities($s["VAT"], ENT_QUOTES, "UTF-8")."
		</div>
		<div class='bg-pink padding-10 text-white bold'>
			<span class='pull-right'>".$receipt["price_vat"]."€</span>
			".htmlentities($s["total"], ENT_QUOTES, "UTF-8")."
		</div>
	</div>
	<div class='m-b-20'>
		<a href='../receipts/' class='btn btn-white'>Volver al listado de recibos</a>
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
