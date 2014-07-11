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
	$page_path="server/app/ajax/groups/new/add_group";
	debug_log("[".$page_path."] START");
	include(PATH."functions/check_session.php");


	$response=array();


 	$table="groups";
 	$data=array();
	foreach($_POST as $key => $value){
		$data[$key]=$value;
	}
	$data["id_brand"]=$_SESSION["admin"]["id_brand"];


	$user_groups= explode("::", $data["users_groups"]);


	unset($data["users_groups"]);

	$data["resume_block_1_display"] = 1;
	$data["resume_block_1_title"] = "group_usage_this_month";
	$data["resume_block_1_data"] = "0";
	$data["resume_block_1_link_content"] = "";
	$data["resume_block_1_link"] = "";

	$data["resume_block_2_display"] = 1;
	$data["resume_block_2_title"] = "group_usage_today";
	$data["resume_block_2_data"] = "0";
	$data["resume_block_2_link_content"] = "";
	$data["resume_block_2_link"] = "";

	$data["resume_block_3_display"] = 1;
	$data["resume_block_3_title"] = "group_users";
	$data["resume_block_3_data"] = "0";
	$data["resume_block_3_link_content"] = "";
	$data["resume_block_3_link"] = "";

	$data["resume_block_4_display"] = 0;
	$data["resume_block_4_title"] = "";
	$data["resume_block_4_data"] = "";
	$data["resume_block_4_link_content"] = "";
	$data["resume_block_4_link"] = "";

	$data["created"]=$timestamp;

	$response["data"]=addInBD($table,$data);

 	$table="user_groups";
 	$data=array();
 	$data["id_group"]=$response["data"];
 	$data["id_brand"]=$_SESSION["admin"]["id_brand"];
	foreach($user_groups as $key => $id_user){
	 	$data["id_user"]=$id_user;
	 	addInBD($table,$data);
 	}


	$response["result"]=true;

 	echo json_encode($response);

 	debug_log("[".$page_path."] END");
?>
