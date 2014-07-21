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
	*	post_no_campaign_note
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/campaigns/get_campaign_note";
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


 	// Data check START
	if(!@issetandnotempty($_POST["id_campaign_note"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Missing id_campaign_note");
		$response["error_code"]="post_no_campaign_note";
		echo json_encode($response);
		die();
	}

 	$table="campaign_notes";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$filter["id_campaign_note"]=array("operation"=>"=","value"=>$_POST["id_campaign_note"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Campaign Note (id_user=".$_SESSION["admin"]["id_admin"].",id_campaign_note=".$_POST["id_campaign_note"].") doesn't exist");
 		$response["error"]="ERROR Campaign Note doesn't exist";
 		echo json_encode($response);
 		die();
	}
 	// Data check END

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$response["result"]=true;
 	$table="campaign_notes";
	$filter=array();
	$filter["id_campaign_note"]=array("operation"=>"=","value"=>$_POST["id_campaign_note"]);
	$campaign_note=getInBD($table,$filter);
	$response["data"]="
	<div class='modal-header'>
		<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
    	<br>
        <h4 class='semi-bold'><i class='fa fa-file-text-o'></i> ".$campaign_note["title"]."</h4>
	</div>
	<div class='modal-body'>
		".$campaign_note["content"]."
	</div>
	";

	/*********************************************************
	* DATABASE REGISTRATION
	*********************************************************/



	/*********************************************************
	* AJAX CALL RETURN
	*********************************************************/

 	echo json_encode($response);
	debug_log("[".$page_path."] END");
	die();

?>
