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
	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));

<<<<<<< HEAD


	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/accounts/receipts/list";
	debug_log("[".$page_path."] START");
	include(PATH."functions/check_session.php");

 	$response=array();




=======
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/accounts/receipts/list";
	debug_log("[".$page_path."] START");

 	$response=array();

 	/*********************************************************
	* DATA CHECK
	*********************************************************/

	include(PATH."functions/check_session.php");


	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

>>>>>>> FETCH_HEAD
	$response["result"]=true;
 	$response["data"]["page-title"] = "<a href='../../'>".htmlentities($s["my_account"], ENT_QUOTES, "UTF-8")."</a> / <a href='../'>".htmlentities($s["subscription"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["receipts"], ENT_QUOTES, "UTF-8");
 	$response["data"]["table-header"] = "
 		<th style='width:43%'>".htmlentities($s["receipt_number"], ENT_QUOTES, "UTF-8")."</th>
        <th style='width:20%'>".htmlentities($s["date"], ENT_QUOTES, "UTF-8")."</th>
        <th style='width:10%'>".htmlentities($s["amount"], ENT_QUOTES, "UTF-8")."</th>";

 	$response["data"]["tabs"]="
        	<li class='active'><a href='?status=0'>".htmlentities($s["all_receipts"], ENT_QUOTES, "UTF-8")."</a></li>
    ";
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
