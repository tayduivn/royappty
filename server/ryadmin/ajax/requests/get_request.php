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
	*	post_no_request
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/
	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/requests/get_request";
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

 	// Data check START
	if(!@issetandnotempty($_POST["id_request"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing id_request");
		$response["error_code"]="post_no_request";
		echo json_encode($response);
		die();
	}

 	$table="requests";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$filter["id_request"]=array("operation"=>"=","value"=>$_POST["id_request"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		error_log("[".$page_path."] ERROR Request (id_brand=".$_SESSION["admin"]["id_brand"].",id_request=".$_POST["id_request"].") doesn't exist");
 		$response["error"]="ERROR Request doesn't exist";
 		echo json_encode($response);
 		die();
	}

 	// Data check END

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$response["result"]=true;

 	$table="requests";
	$filter=array();
	$filter["id_request"]=array("operation"=>"=","value"=>$_POST["id_request"]);
	$request=getInBD($table,$filter);

	$response["data"]["page-title"]="<a href='../requests/'>".htmlentities($s["requests"], ENT_QUOTES, "UTF-8")."</a> / #".$request["code"]." - ".htmlentities($s["requests_types"][$request["type"]], ENT_QUOTES, "UTF-8");

	$response["data"]["request-data"]="
		<h3 class='m-t-0'>#".$request["code"]." - ".htmlentities($s["requests_types"][$request["type"]], ENT_QUOTES, "UTF-8")."</h3>
		<h5>".htmlentities($s["requests_status"][$request["status"]], ENT_QUOTES, "UTF-8")."</h5>
		<p>".htmlentities($s["requests_status_help"][$request["status"]][$request["type"]], ENT_QUOTES, "UTF-8")."</p>
		<h5>".htmlentities($s["requests_types"][$request["type"]], ENT_QUOTES, "UTF-8")."</h5>
		<h5>".htmlentities($s["created"], ENT_QUOTES, "UTF-8")." ".date("d-m-Y",$request["created"])."</h5>";

	if($request["type"]=="bank_transfer_confirmation"){

		$table="orders";
		$filter=array();
		$filter["id_order"]=array("operation"=>"=","value"=>$request["data"]);
		$order=getInBD($table,$filter);

		$table="config";
		$filter=array();
		$filter["used"]=array("operation"=>"=","value"=>1);
		$fields=array("bank_name","bank_swift","bank_iban","bank_account_number","bank_transfer_beneficiary");
		$royappty_bank=getInBD($table,$filter,$fields);
		$royappty_bank["bank_transfer_concept"]="ROYA-".str_pad($order["id_order"], 5, "0", STR_PAD_LEFT);
		$royappty_bank["bank_transfer_amount"]=number_format($order["amount"],2);


		$response["data"]["request-data"].="
			<div class='m-t-20' id='printable'>
					<div class='text-center only_printable'>
						<img style='width:200px' src='".$url_server."assets/img/royappty-logo.png' />
					</div>
					<h4 class='text-center'>".htmlentities($s["bank_transfer_title"], ENT_QUOTES, "UTF-8")."</h4>

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
				</div>

		";
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
