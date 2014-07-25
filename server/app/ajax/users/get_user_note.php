<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
<<<<<<< HEAD
	* Last Edit: 23-06-2014
	* Version: 0.91
	*
	*********************************************************/
	
	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d 00:00:00"));

	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/users/get_user_note";
	debug_log("[".$page_path."] START");
	include(PATH."functions/check_session.php");
 	$response=array();

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

	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/users/get_user_note";
	debug_log("[".$page_path."] START");

 	$response=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	include(PATH."functions/check_session.php");
>>>>>>> FETCH_HEAD

 	// Data check START
	if(!issetandnotempty($_POST["id_user_note"])){
	 	$response["result"]=false;
		debug_log("[server/ajax/users/get_user_note] ERROR Data Missing id_user_note");
 		$response["error"]="ERROR Data Missing id_user_note";
 		echo json_encode($response);
 		die();
 	}
 	$table="user_notes";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$filter["id_user_note"]=array("operation"=>"=","value"=>$_POST["id_user_note"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR user Note (id_user=".$_SESSION["admin"]["id_admin"].",id_user_note=".$_POST["id_user_note"].") doesn't exist");
 		$response["error"]="ERROR user Note doesn't exist";
 		echo json_encode($response);
 		die();
	}
 	// Data check END

<<<<<<< HEAD
=======
	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/
>>>>>>> FETCH_HEAD

	$response["result"]=true;
 	$table="user_notes";
	$filter=array();
	$filter["id_user_note"]=array("operation"=>"=","value"=>$_POST["id_user_note"]);
	$user_note=getInBD($table,$filter);
	$response["data"]="
	<div class='modal-header'>
		<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
    	<br>
        <h4 class='semi-bold'><i class='fa fa-file-text-o'></i> ".$user_note["title"]."</h4>
	</div>
	<div class='modal-body'>
		".$user_note["content"]."
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
