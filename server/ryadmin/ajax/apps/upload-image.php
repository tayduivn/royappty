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

	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/campaigns/upload_image";
	debug_log("[".$page_path."] START");


	/*********************************************************
	* DATA CHECK
	*********************************************************/

	include(PATH."functions/check_session.php");


	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	debug_log("UPDALOAD IMAGE");

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
	if ($_FILES['xfile']['type'] != "image/jpeg") {
		$res->error=true;
		echo json_encode($res);
			die();
	}


	$types = Array('image/png', 'image/gif', 'image/jpeg');

	$source = file_get_contents($_FILES["xfile"]["tmp_name"]);
	$folder="../../../../server/resources/tmp/";
	$filename = $folder . $timestamp . '.jpg';

	$width=0;
	if(isset($_GET["width"])&&(!empty($_GET["width"]))){
		$width=$_GET["width"];
	}
	$height=0;
	if(isset($_GET["height"])&&(!empty($_GET["height"]))){
		$height=$_GET["height"];
	}
	$crop=false;
	if(isset($_GET["crop"])&&(!empty($_GET["crop"]))){
		$crop=true;
	}

	imageresize($source, $filename,$width,$height,$crop);

	$path = str_replace('upload.php', '', $_SERVER['SCRIPT_NAME']);


	// Result data
	$res->filename = $url_server.'resources/tmp/'.$timestamp . '.jpg';
	$res->path = 'resources/tmp/'.$timestamp . '.jpg';
	$res->preview = $_GET["label"]."-preview";
	$res->label = $_GET["label"];
	$res->indice = "temp";
	$res->img = '<img src="'.$url_server.'resources/tmp/'.'temp'.'.jpg" alt="image" />';
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
