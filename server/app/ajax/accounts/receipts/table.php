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
	@session_start();
	define('PATH', str_replace('\\', '/','../../../'));
	$timestamp=strtotime(date("Y-m-d H:i:00"));

<<<<<<< HEAD

=======
>>>>>>> FETCH_HEAD
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/accounts/receipts/table";
	debug_log("[".$page_path."] START");

<<<<<<< HEAD



	$response=array();
 	$response["aaData"]=array();

=======
	$response=array();
 	$response["aaData"]=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	include(PATH."functions/check_session.php");


	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

>>>>>>> FETCH_HEAD
	$table="receipts";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	if(isInBD($table,$filter)){
 		$receipts=listInBD($table,$filter);
 		foreach($receipts as $key=>$receipt){
	 		$response["aaData"][]=array(

	 			"<div class='m-b-5'><a href='".$_GET["PATH"]."my-account/subscription/receipt/?id_receipt=".$receipt["id_receipt"]."'>".$s["receipt"]." #".$receipt["id_receipt"]."</a></div><a href='".$_GET["PATH"]."my-account/subscription/receipt/?id_receipt=".$receipt["id_receipt"]."' class='btn btn-mini btn-white'>".htmlentities($s["view_receipt"], ENT_QUOTES, "UTF-8")."</a>",
	 			"<span class='pull-right'>".date("Y/m/d",$receipt["created"])."</span>",
	 			"<span class='pull-right'>".$receipt["amount"]." €</span>");
 		}

	}

	/*********************************************************
	* DATABASE REGISTRATION
	*********************************************************/



	/*********************************************************
	* AJAX CALL RETURN
	*********************************************************/

	debug_log("[".$page_path."] END");
<<<<<<< HEAD

 	echo json_encode($response);
=======
	echo json_encode($response);
	die();
>>>>>>> FETCH_HEAD

?>
