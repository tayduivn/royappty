<?php
  /*********************************************************
  *
  * Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
  * Last Edit: 23-06-2014
  * Version: 0.93
  *
  *********************************************************/
  
 	// Data check START
 	if(!@issetandnotempty($_SESSION["admin"]["id_brand"])){
	 	error_log("ERROR");
	 	$response["result"]=false;
		error_log("[".$page_path."] ERROR Data Missing Session Brand ID");
 		$response["error"]="ERROR Data Missing Session Brand ID";
 		echo json_encode($response);
 		die();
 	}
 	if(!@issetandnotempty($_SESSION["admin"]["id_admin"])){
	 	$response["result"]=false;
		error_log("[".$page_path."] ERROR Data Missing Session Admin ID");
 		$response["error"]="ERROR Data Missing Session Admin ID";
 		echo json_encode($response);
 		die();
 	}

  	$table="brands";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		error_log("[".$page_path."] ERROR Brand (".$_SESSION["admin"]["id_brand"].") doesn't exist");
 		$response["error"]="ERROR Brand doesn't exist";
 		echo json_encode($response);
 		die();
 	}

 	$table="admins";
 	$filter=array();
	$filter["id_admin"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_admin"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		error_log("[".$page_path."] ERROR Admin (".$_SESSION["admin"]["id_admin"].") doesn't exist");
 		$response["error"]="ERROR Admin doesn't exist";
 		echo json_encode($response);
 		die();
 	}
 	// Data check END

?>
