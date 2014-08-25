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
	* no_brand
	* brand_not_valid
	* no_admin
	* admin_not_valid
	* admin_inactive
	* post_no_name
	*
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/notifications/new/add_notification";
	debug_log("[".$page_path."] START");
	$response=array();


	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// SYSTEM CLOSED
if(!checkClosed()){echo json_encode($response);die();}

// BD CONNECTION
	if(!checkBDConnection()){echo json_encode($response);die();}

	// BRAND
	$brand=array();$brand["id_brand"]=$_SESSION["admin"]["id_brand"];
	if(!checkBrand($brand)){echo json_encode($response);die();}

	// ADMIN
	$admin=array();$admin["id_admin"]=$_SESSION["admin"]["id_admin"];
	if(!checkAdmin($admin)){echo json_encode($response);die();}

	// POST
	if(!@issetandnotempty($_POST["content"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing content");
		$response["error_code"]="post_no_content";
		$response["error_code_str"]= $error_step_s["post_no_content"];
		echo json_encode($response);
		die();
	}

	$table="groups";
	if(@$_POST["id_group"]!=0){
			$filter=array();
			$filter["id_group"]=array("operation"=>"=","value"=>$_POST["id_group"]);
			if(!isInBD($table,$filter)){
				$response["result"]=false;
				debug_log("[".$page_path."] ERROR Data Post Group doen't exists");
				$response["error_code"]="post_notification_no_group";
				$response["error_code_str"]= $error_step_s["post_notification_no_group"];
				echo json_encode($response);
				die();
			}
	}



	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$response["result"]=true;



	$data=array();
	$data["content"] = $_POST["content"];
	$data["id_brand"] = $_SESSION["admin"]["id_brand"];
	$data["id_group"] = $_POST["id_group"];

	if($_POST["id_group"]!=0){
		$table="groups";
		$filter=array();
		$filter["id_group"]=array("operation"=>"=","value"=>$_POST["id_group"]);
		$group=getInBD($table,$filter);
		$data["group_name"] = $group["name"];
	}else{
		$data["group_name"] = $s["all_users"];
	}

	$data["created"] = $timestamp;

	$table="notifications";
	$response["data"]=addInBD($table,$data);

	/*



$yourKey = "AIzaSyDQcoYEESB8oixQ6Y8y_GVMfbolv2fcK_0";
$deviceToken = "APA91bFox4rk0970xKg--S609cqudG8sjv_o4vObd6OKD8M2LMYltZFVpmHkaUQPtytOEP_cLEuF0Uo-UMamqZNOwBe3VJ0fSVcsNbxCXOeKaJDRuzlsHwx-fVrbIHKMtiX-_MgN8MpbcJ_qfvZREQ_4qrLYGJVoDg";
$collapseKey = "739888372020";
$messageTitle = "Royappty";
$messageText = "Antes iba ahora no...";
echo sendMessageToPhone($deviceToken, $collapseKey, $messageText, $messageTitle, $yourKey);
*/

	/*********************************************************
	* DATABASE REGISTRATION
	*********************************************************/



	/*********************************************************
	* AJAX CALL RETURN
	*********************************************************/

	debug_log("[".$page_path."] END");
	echo json_encode($response);
	die();

?>