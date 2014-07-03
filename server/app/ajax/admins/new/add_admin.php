<?php

	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:m:i"));

	
	
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/admins/new/add_admin";
	debug_log("[".$page_path."] START");
	include(PATH."functions/check_session.php");
	
		 
	$response=array();

 		
 	$table="admins";
 	$data=array();
	foreach($_POST as $key => $value){
		$data[$key]=$value;
		error_log("[".$key."]=".$value);
	}
	$data["id_brand"]=$_SESSION["admin"]["id_brand"];
	

	
	$data["resume_block_1_display"] = 1;
	$data["resume_block_1_title"] = "admin_validated_this_month";
	$data["resume_block_1_data"] = "0";
	$data["resume_block_1_link_content"] = "view_more";
	$data["resume_block_1_link"] = "";

	$data["resume_block_2_display"] = 1;
	$data["resume_block_2_title"] = "admin_validated_this_today";
	$data["resume_block_2_data"] = "0";
	$data["resume_block_2_link_content"] = "view_more";
	$data["resume_block_2_link"] = "";

	$data["resume_block_3_display"] = 1;
	$data["resume_block_3_title"] = "admin_validated";
	$data["resume_block_3_data"] = "0";
	$data["resume_block_3_link_content"] = "view_more";
	$data["resume_block_3_link"] = "";

	
	$data["password"]=md5($data["password"]);
	$data["created"]=$timestamp;

	$response["data"]=addInBD($table,$data);



	$response["result"]=true;

 	echo json_encode($response);

 	debug_log("[".$page_path."] END");
?>