<?php
 	/*********************************************************
  *
  * Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
  * Last Edit: 08-07-2014
  * Version: 0.91
  *
  *********************************************************/

  /*********************************************************
  * AJAX RETURNS
  *
  * ERROR CODES
  *
  * reload -> If there is not password to set
  * set_password_no_code -> If there is not code
  * set_password_code_not_valid -> If the code is not valid
  * set_password_code_not_valid -> If there is no admin to change the password
  *
  *********************************************************/

  /*********************************************************
  * COMMON AJAX CALL DECLARATIONS AND INCLUDES
  *********************************************************/

  define('PATH', str_replace('\\', '/','../../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
 	include(PATH."include/inbd.php");
	$page_path= "server/app/ajax/accounts/recovery/set/set_password";
 	debug_log("[".$page_path."] START");
 	$response=array();

  /*********************************************************
  * DATA CHECK
  *********************************************************/

  if(!issetandnotempty($_POST["password"])){
    $response["result"]=false;
    debug_log("[".$page_path."] ERROR Data Missing password");
     $response["error_code"]="reload";
     echo json_encode($response);
    die();
  }

  if(!issetandnotempty($_POST["code"])){
    $response["result"]=false;
    debug_log("[".$page_path."] ERROR Data Missing code");
    $response["error_code"]="set_password_no_code";
    echo json_encode($response);
    die();
  }

  $table="recovery_codes";
  $filter=array();
  $filter["code"]=array("operation"=>"=","value"=>$_POST["code"]);
  if(!isInBD($table,$filter)){
    $response["result"]=false;
    debug_log("[".$page_path."] ERROR Code not valid");
    $response["error_code"]="set_password_code_not_valid";
    echo json_encode($response);
    die();
  }

  $table="recovery_codes";
  $filter=array();
  $filter["code"]=array("operation"=>"=","value"=>$_POST["code"]);
  $recovery_code=getInBD($table,$filter);

  $table="admins";
  $filter=array();
  $filter["email"]=array("operation"=>"=","value"=>$recovery_code["email"]);
  if(!isInBD($table,$filter)){
    $response["result"]=false;
    debug_log("[".$page_path."] ERROR No admin to change password");
    $response["error_code"]="set_password_code_not_valid";
    echo json_encode($response);
    die();
  }

  /*********************************************************
  * AJAX OPERATIONS
  *********************************************************/


  $response["result"]=true;

  $table="admins";
  $filter=array();
  $filter["email"]=array("operation"=>"=","value"=>$recovery_code["email"]);
  $data=array();
  $data["password"]=md5($_POST["password"]);
  updateInBD($table,$filter,$data);

  $table="recovery_codes";
  $filter=array();
  $filter["code"]=array("operation"=>"=","value"=>$_POST["code"]);
  deleteInBD($table,$filter);


  /*********************************************************
  * DATABASE REGISTRATION
  *********************************************************/

  $table="admins";
  $filter=array();
  $filter["email"]=array("operation"=>"=","value"=>$recovery_code["email"]);
  $data=array();
  $data["last_connection"]=$timestamp;
  updateInBD($table,$filter,$data);


  /*********************************************************
  * AJAX CALL RETURN
  *********************************************************/

 	echo json_encode($response);
  debug_log("[".$page_path."] END");

?>
