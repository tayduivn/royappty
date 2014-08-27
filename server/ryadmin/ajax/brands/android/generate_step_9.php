<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 21-08-2014
	* Version: 0.94
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	* db_connection_error
	* no_ryadmin
	* ryadmin_not_valid
	* ryadmin_inactive
	*	post_no_brand
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:s"));
	include(PATH."include/inbd.php");
	$page_path="server/ryadmin/ajax/brands/android/generate_step_9";
	debug_log("[".$page_path."] START");

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// SYSTEM CLOSED
	if(!checkClosed()){echo json_encode($response);die();}

	// BD CONNECTION
	if(!checkBDConnection()){echo json_encode($response);die();}

	// RYADMIN
	$ryadmin=array();$ryadmin["id_ryadmin"]=$_SESSION["ryadmin"]["id_ryadmin"];
	if(!checkRyadmin($ryadmin)){echo json_encode($response);die();}


	// Data check START
	if(!@issetandnotempty($_POST["id_brand"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing id_brand");
		$response["error_code"]="post_no_brand";
		echo json_encode($response);
		die();
	}

 	$table="brands";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_POST["id_brand"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		error_log("[".$page_path."] ERROR Brand (id_brand=".$_POST["id_brand"].") doesn't exist");
		$response["error_code"]="post_no_brand";
 		echo json_encode($response);
 		die();
	}

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/
	$response["result"]=true;

	$table="brands";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_POST["id_brand"]);
	$brand=getInBD($table,$filter);

	$message=shell_exec("./generator_step_9.sh ".$brand["android_project_name"]." com.royappty.".$brand["android_project_name"]." ".$brand["android_project_name"]."");
	$message=str_replace("[36m","<span style='color:blue'>",$message);
	$message=str_replace("[35m","<span style='color:purple'>",$message);
	$message=str_replace("[31m","<span style='color:red'>",$message);
	$message=str_replace("[39m","</span>",$message);

	$response["data"]="<pre style='color:#666'>".$message."</pre>";


	//$response["result"]=true;


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
