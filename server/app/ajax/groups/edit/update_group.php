<?php

	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:m:i"));

	
	
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/groups/new/add_group";
	debug_log("[".$page_path."] START");
	include(PATH."functions/check_session.php");
	
		 
	$response=array();

	$group["id_group"]=$_POST["id_group"];
 	unset($_POST["id_group"]);
	
 		
 	$table="groups";
 	$filter=array();
 	$filter["id_group"]=array("operation"=>"=","value"=>$group["id_group"]);
 	$data=array();
	foreach($_POST as $key => $value){
		$data[$key]=$value;
	}
	
	
	$user_groups= explode("::", $data["users_groups"]);
	
	unset($data["users_groups"]);

	$data["resume_block_1_display"] = 1;
	$data["resume_block_1_title"] = "campaigns";
	$data["resume_block_1_data"] = "<h1><span class='animate-number text-white' data-value='0' data-animation-duration='1200'>0</h1>";
	$data["resume_block_1_link_content"] = "view_more";
	$data["resume_block_1_link"] = "#";

	$data["resume_block_2_display"] = 1;
	$data["resume_block_2_title"] = "usage_this_month";
	$data["resume_block_2_data"] = "<h1><span class='animate-number text-white' data-value='0' data-animation-duration='1200'>0</h1>";
	$data["resume_block_2_link_content"] = "view_more";
	$data["resume_block_2_link"] = "#";

	$data["resume_block_3_display"] = 1;
	$data["resume_block_3_title"] = "usage_this_today";
	$data["resume_block_3_data"] = "<h1><span class='animate-number text-white' data-value='0' data-animation-duration='1200'>0</h1>";
	$data["resume_block_3_link_content"] = "view_more";
	$data["resume_block_3_link"] = "#";
	
	$data["resume_block_4_display"] = 1;
	$data["resume_block_4_title"] = "users";
	$data["resume_block_4_data"] = "<h1><span class='animate-number text-white' data-value='0' data-animation-duration='1200'>0</h1>";
	$data["resume_block_4_link_content"] = "view_more";
	$data["resume_block_4_link"] = "#";
	
	$data["created"]=$timestamp;

	updateInBD($table,$filter,$data);

 	$table="user_groups";
 	$filter=array();
 	$filter["id_group"]=array("operation"=>"=","value"=>$group["id_group"]);
 	deleteInBD($table,$filter);
 	$data=array();
 	$data["id_group"]=$group["id_group"];
 	$data["id_brand"]=$_SESSION["admin"]["id_brand"];
	foreach($user_groups as $key => $id_user){
	 	$data["id_user"]=$id_user;
	 	addInBD($table,$data);
 	}
	

	$response["result"]=true;
	$response["data"] = $group["id_group"];
 	echo json_encode($response);

 	debug_log("[".$page_path."] END");
?>