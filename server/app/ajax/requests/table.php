<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
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
	@session_start();
	define('PATH', str_replace('\\', '/','../../'));
	$timestamp=strtotime(date("Y-m-d H:i:00"));

	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/requests/table";
	debug_log("[".$page_path."] START");

 	error_log($_GET["status"]);

	$response=array();
 	$response["aaData"]=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/
	include(PATH."functions/check_session.php");




	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$table="requests";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	if(issetandnotempty($_GET["status"])){
		$filter["status"]=array("operation"=>"=","value"=>$_GET["status"]);
 	}
	if(isInBD($table,$filter)){
 		$requests=listInBD($table,$filter);
 		foreach($requests as $key=>$request){
	 		$data_table[0] = "<div class='m-b-5'><a href='".$_GET["PATH"]."request/?id_request=".$request["id_request"]."' class='";
	 		if($request["status"]==2){
		 		$data_table[0].=" text-muted ";
	 		}
	 		$data_table[0].="'>#".$request["code"]." - ".htmlentities($s["requests_types"][$request["type"]], ENT_QUOTES, "UTF-8");
	 		$data_table[0].="</a></div><div class='hidden-options'><a href='".$_GET["PATH"]."request/?id_request=".$request["id_request"]."' class='btn btn-mini btn-white'>".htmlentities($s["view_request"], ENT_QUOTES, "UTF-8")."</a></div>";
	 		$response["aaData"][]=array(

	 			$data_table[0],
	 			htmlentities($s["requests_status"][$request["status"]], ENT_QUOTES, "UTF-8"),
	 			htmlentities(date("d/m/Y",$request["created"]), ENT_QUOTES, "UTF-8")
	 		);
	 	}

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
