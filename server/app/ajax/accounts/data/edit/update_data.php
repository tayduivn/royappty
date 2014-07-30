<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 24-07-2014
	* Version: 0.93
	*
 	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	* no_brand
	* brand_not_valid
	* no_admin
	* admin_not_valid
	* admin_inactive
	*	post_no_update_data_name
	*	post_no_update_data_cif
	*	post_no_update_data_contact_email
	*	post_no_update_data_contact_address
	*	post_no_update_data_contact_postal_code
	*	post_no_update_data_contact_city
	*	post_no_update_data_contact_country
	*
	*********************************************************/


	/*********************************************************
 	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
 	*********************************************************/

	define('PATH', str_replace('\\', '/','../../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
 	include(PATH."include/inbd.php");
	$page_path = "server/app/ajax/accounts/data/edit/update_data";
 	debug_log("[".$page_path."] START");
 	$response=array();



 	/*********************************************************
 	* DATA CHECK
 	*********************************************************/

	// BRAND
	$brand=array();$brand["id_brand"]=$_SESSION["admin"]["id_brand"];
	if(!checkBrand($brand)){echo json_encode($response);die();}

	// ADMIN
	$admin=array();$admin["id_admin"]=$_SESSION["admin"]["id_admin"];
	if(!checkAdmin($admin)){echo json_encode($response);die();}

	// POST
	if(!@issetandnotempty($_POST["name"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing update_data_name");
		$response["error_code"]="post_no_update_data_name";
		$response["error_code_str"]= $error_step_s["post_no_update_data_name"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["cif"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing update_data_cif");
		$response["error_code"]="post_no_update_data_cif";
		$response["error_code_str"]= $error_step_s["post_no_update_data_cif"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["contact_email"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing update_data_contact_email");
		$response["error_code"]="post_no_update_data_contact_email";
		$response["error_code_str"]= $error_step_s["post_no_update_data_contact_email"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["contact_address"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing update_data_contact_address");
		$response["error_code"]="post_no_update_data_contact_address";
		$response["error_code_str"]= $error_step_s["post_no_update_data_contact_address"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["contact_postal_code"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing update_data_contact_postal_code");
		$response["error_code"]="post_no_update_data_contact_postal_code";
		$response["error_code_str"]= $error_step_s["post_no_update_data_contact_postal_code"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["contact_city"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing update_data_contact_city");
		$response["error_code"]="post_no_update_data_contact_city";
		$response["error_code_str"]= $error_step_s["post_no_update_data_contact_city"];
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["contact_country"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing update_data_contact_country");
		$response["error_code"]="post_no_update_data_contact_country";
		$response["error_code_str"]= $error_step_s["post_no_update_data_contact_country"];
		echo json_encode($response);
		die();
	}


	/*********************************************************
 	* AJAX OPERATIONS
 	*********************************************************/

 	$response["result"]=true;

 	$table="brands";
	$filter=array();
 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
 	foreach($_POST as $key => $value){
		$data[$key]=$value;
	}
	updateInBD($table,$filter,$data);



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
