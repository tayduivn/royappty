<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 23-06-2014
	* Version: 0.93
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	*	- no_brand
	*	- brand_not_valid
	*
	*********************************************************/


	/*********************************************************
 	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
 	*********************************************************/
 	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
 	include(PATH."include/inbd.php");
	$page_path = "server/mobile/ajax/users/add_user";
 	debug_log("[".$page_path."] START");
 	$response=array();



 	/*********************************************************
 	* DATA CHECK
 	*********************************************************/

 	// BRAND
 	$brand=array();$brand["id_brand"]=$_GET["id_brand"];
	if(!checkBrand($brand)){echo "jsonCallback(".json_encode($response).")";die();}



 	/*********************************************************
 	* AJAX OPERATIONS
 	*********************************************************/

 	$response["result"]=true;

 	$table="users";
 	$data=array();
 	$data["id_brand"]=$_GET["id_brand"];
 	$data["active"]=1;
 	$data["created"]=$timestamp;
 	$data["last_connection"]=$timestamp;
 	$data["resume_block_1_display"]=0;
 	$data["resume_block_1_title"]=0;
 	$data["resume_block_1_data"]=0;
 	$data["resume_block_1_link_content"]=0;
 	$data["resume_block_1_link"]=0;
  $data["resume_block_2_display"]=0;
 	$data["resume_block_2_title"]=0;
 	$data["resume_block_2_data"]=0;
 	$data["resume_block_2_link_content"]=0;
 	$data["resume_block_2_link"]=0;
	$data["resume_block_3_display"]=0;
 	$data["resume_block_3_title"]=0;
 	$data["resume_block_3_data"]=0;
 	$data["resume_block_3_link_content"]=0;
 	$data["resume_block_3_link"]=0;
 	$data["resume_block_4_display"]=0;
 	$data["resume_block_4_title"]=0;
 	$data["resume_block_4_data"]=0;
 	$data["resume_block_4_link_content"]=0;
 	$data["resume_block_4_link"]=0;
 	$user=array();
 	$user["id_user"]=addInBD($table,$data);

 	$signup_datas=explode("&",$_GET["signup_data"]);
	foreach ($signup_datas as $key=>$signup_data){
		$signup_field=explode("=",$signup_data);
		$table="user_fields";
		$filter=array();
		error_log("--------".$signup_field[0]);
		$filter["title"]=array("operation"=>"=","value"=>htmlentities($signup_field[0], ENT_QUOTES,'UTF-8'));
		$user_field=getInBD($table,$filter);

		$table="user_field_data";
		$data=array();
		$data["id_user"]=$user["id_user"];
		$data["id_user_field"]=$user_field["id_user_field"];
		$data["field_value"]=$signup_field[1];
		addInBD($table,$data);
	}
	$response["data"]=array();
	$response["data"]["id_user"]=$user["id_user"];

 	/*********************************************************
 	* DATABASE REGISTRATION
 	*********************************************************/



 	/*********************************************************
 	* AJAX CALL RETURN
 	*********************************************************/

 	debug_log("[".$page_path."] END");
 	echo "jsonCallback(".json_encode($response).")";
 	die();

?>
