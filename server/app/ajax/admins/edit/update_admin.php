<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 23-06-2014
	* Version: 0.91
	*
	*********************************************************/
	
	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:m:i"));



	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/admins/edit/update_admin";
	debug_log("[".$page_path."] START");
	include(PATH."functions/check_session.php");


	$response=array();


 	$table="admins";
 	$filter=array();
 	$filter["id_admin"]=array("operation"=>"=","value"=>$_POST["id_admin"]);
	debug_log("[".$page_path."] Filter[id_admin]=".$_POST["id_admin"]);
	$response["data"]=$_POST["id_admin"];

 	unset($_POST["id_admin"]);
 	$data=array();

	foreach($_POST as $key => $value){
		debug_log("[".$page_path."] DATA[".$key."]=".$value);
		$data[$key]=$value;
	}
	$data["id_brand"]=$_SESSION["admin"]["id_brand"];

	if (issetandnotempty($data["password"])){$data["password"]=md5($data["password"]);}else{unset($data["password"]);}


	updateInBD($table,$filter,$data);


	$response["result"]=true;

 	echo json_encode($response);

 	debug_log("[".$page_path."] END");
?>
