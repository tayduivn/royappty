<?php
	/************************************************************
	* Royappty
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Modification: 10-02-2014
	* Version: 1.0
	* licensed through CC BY-NC 4.0
	************************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
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
	$page_path = "server/app/ajax/error/error";
	debug_log("[".$page_path."] START");
	$response=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/



	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/
// poner un manejador de errores
	$response["result"]=true;

	if(@issetandnotempty($_POST["error_code"])){
	$error_code= $_POST["error_code"];
	}else {
	$error_code="base";
	}


	$response["data"]["error-data"]="
		<div class='text-center' style='height:100%'>
			<img class='m-t-40 m-b-0' style='width:320px' src='".$url_server."server/app/assets/img/royappty-logo.png' />
			<h3>".htmlentities($error_s[$error_code]["title"], ENT_QUOTES, "UTF-8")."</h3>
			<p class='text-justify'>".htmlentities($error_s[$error_code]["content"], ENT_QUOTES, "UTF-8")."</p>
			<a href='../' class='btn btn-white btn-small'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
		</div>";

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
