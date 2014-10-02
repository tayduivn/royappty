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
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:s"));
	include(PATH."include/inbd.php");
	$page_path="server/ryadmin/ajax/brands/ios/upload_certificate";
	debug_log("[".$page_path."] START");


	/*********************************************************
	* DATA CHECK
	*********************************************************/



	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	debug_log("Upload Certificate");

	$res = new stdClass();
	// Result content type
	header('content-type: application/json');

	// Maximum file size
	$maxsize = 10; //Mb
	// File size control
	if ($_FILES['xfile']['size'] > ($maxsize * 1048576)) {
		$res->error=true;
		echo json_encode($res);
	    die();
	}

	if(!@issetandnotempty($_GET["project_codename"])){
		$res->error=true;
		echo json_encode($res);
	    die();
	}
	$source = file_get_contents($_FILES["xfile"]["tmp_name"]);
	$filename=PATH."../resources/mobile-app/".$_GET["project_codename"]."/apns-cert.pem";


	if (!file_exists($filename)) {
		debug_log("[".$page_path."] Certificate not exits");
		touch($filename);
		debug_log("[".$page_path."] Certificate created");
	}else{
		debug_log("[".$page_path."] Certificate exits");
	}
	$file = fopen($filename, "w");

	fwrite($file, $source);
	debug_log("[".$page_path."] Certificate wrote");
	fclose($file);
	debug_log("[".$page_path."] Certificate closed");


	// Result data
	$res->result_box_html = "<i class='fa fa-check'></i> El certificado se ha subido correctamente";
	$res->id_result_box = $_GET["id_result_box"];
	$res->error =false;



	/*********************************************************
	* DATABASE REGISTRATION
	*********************************************************/



	/*********************************************************
	* AJAX CALL RETURN
	*********************************************************/
	// Return to JSON
	echo json_encode($res);
	debug_log("[".$page_path."] END");
	die();

?>
