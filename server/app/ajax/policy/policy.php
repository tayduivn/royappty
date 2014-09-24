<?php

	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 23-07-2014
	* Version: 0.93
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	* db_connection_error
	*	post_no_policy_type
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/
	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path = "server/app/ajax/policy/policy";
	debug_log("[".$page_path."] START");
	$response=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// SYSTEM CLOSED
if(!checkClosed()){echo json_encode($response);die();}

// BD CONNECTION
	if(!checkBDConnection()){echo json_encode($response);die();}

	if(!@issetandnotempty($_POST["policy_type"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing policy_type");
		$response["error_code"]="post_no_policy_type";
		echo json_encode($response);
		die();
	}

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$response["result"]=true;

	$response["data"]["policy-data"]="
		<div class='text-center' style='height:100%'>
			<img class='m-t-40 m-b-0' style='width:320px' src='".$url_server."server/app/assets/img/royappty-logo.png' />
			<h3>".htmlentities($policy_s[$_POST["policy_type"]]["title"], ENT_QUOTES, "UTF-8")."</h3>
			";
	if(@issetandnotempty($policy_s[$_POST["policy_type"]]["content"])){
			foreach ($policy_s[$_POST["policy_type"]]["content"] as $key=>$policy_paragraph){
				$response["data"]["policy-data"].="
					<p class='text-justify'>".htmlentities($policy_paragraph, ENT_QUOTES, "UTF-8")."</p>
				";
			}
	}


	$response["data"]["policy-data"].="
			<a href='../' class='btn btn-white'>".htmlentities($s["policy_exit"], ENT_QUOTES, "UTF-8")."</a>
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
