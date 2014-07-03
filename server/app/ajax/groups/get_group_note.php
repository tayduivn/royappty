<?php
	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d 00:00:00"));
	
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/groups/get_group_note";
	debug_log("[".$page_path."] START");
	include(PATH."functions/check_session.php");	
 	$response=array();
 	
 	
 	// Data check START
	if(!issetandnotempty($_POST["id_group_note"])){
	 	$response["result"]=false;
		debug_log("[server/ajax/groups/get_group_note] ERROR Data Missing id_group_note");
 		$response["error"]="ERROR Data Missing id_group_note";
 		echo json_encode($response);
 		die();
 	}
 	$table="group_notes";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$filter["id_group_note"]=array("operation"=>"=","value"=>$_POST["id_group_note"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR group Note (id_user=".$_SESSION["admin"]["id_admin"].",id_group_note=".$_POST["id_group_note"].") doesn't exist");
 		$response["error"]="ERROR group Note doesn't exist";
 		echo json_encode($response);
 		die();
	}
 	// Data check END
 	
 	
	$response["result"]=true;
 	$table="group_notes";
	$filter=array();
	$filter["id_group_note"]=array("operation"=>"=","value"=>$_POST["id_group_note"]);
	$group_note=getInBD($table,$filter);
	$response["data"]="
	<div class='modal-header'>
		<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
    	<br>
        <h4 class='semi-bold'><i class='fa fa-file-text-o'></i> ".$group_note["title"]."</h4>
	</div>
	<div class='modal-body'>
		".$group_note["content"]."			
	</div>
	";

 	echo json_encode($response);
	debug_log("[".$page_path."] END");

?>