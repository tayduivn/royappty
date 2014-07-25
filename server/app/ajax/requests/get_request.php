<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
<<<<<<< HEAD
	* Last Edit: 23-06-2014
	* Version: 0.91
	*
	*********************************************************/
	
=======
	* Last Edit: 17-07-2014
	* Version: 0.93
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	*
	*
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/
>>>>>>> FETCH_HEAD
	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));

<<<<<<< HEAD


	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/requests/get_request";
	debug_log("[".$page_path."] START");
	include(PATH."functions/check_session.php");

 	$response=array();

=======
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/requests/get_request";
	debug_log("[".$page_path."] START");

 	$response=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/
	include(PATH."functions/check_session.php");
>>>>>>> FETCH_HEAD

 	// Data check START

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

<<<<<<< HEAD
	$response["result"]=true;


=======
	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$response["result"]=true;

>>>>>>> FETCH_HEAD
 	$table="requests";
	$filter=array();
	$filter["id_request"]=array("operation"=>"=","value"=>$_POST["id_request"]);
	$request=getInBD($table,$filter);


<<<<<<< HEAD

=======
>>>>>>> FETCH_HEAD
	$response["data"]["page-title"]="<a href='../requests/'>".htmlentities($s["requests"], ENT_QUOTES, "UTF-8")."</a> / #".$request["code"]." - ".htmlentities($s["requests_types"][$request["type"]], ENT_QUOTES, "UTF-8");


	$response["data"]["request-data"]="
		<h3 class='m-t-0'>#".$request["code"]." - ".htmlentities($s["requests_types"][$request["type"]], ENT_QUOTES, "UTF-8")."</h3>
		<h5>".$s["requests_status_icon"][$request["status"]]." ".htmlentities($s["requests_status"][$request["status"]], ENT_QUOTES, "UTF-8")."</h5>
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

	if ($request["usage_limit"]=="0"){
		$response["data"]["request-data"].=htmlentities($s["without_limit"], ENT_QUOTES, "UTF-8");
	}else{
		$response["data"]["request-data"].=$request["usage_limit"];
	}
	$response["data"]["request-data"].="</span></p>";

<<<<<<< HEAD







=======
>>>>>>> FETCH_HEAD


<<<<<<< HEAD
=======
	/*********************************************************
	* DATABASE REGISTRATION
	*********************************************************/



	/*********************************************************
	* AJAX CALL RETURN
	*********************************************************/

	debug_log("[".$page_path."] END");
	echo json_encode($response);
	die();

>>>>>>> FETCH_HEAD
?>
