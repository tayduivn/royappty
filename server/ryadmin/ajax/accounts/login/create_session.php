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
  * db_connection_error
  * reload
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
	$page_path= "server/ryadmin/ajax/accounts/login/create_session";
 	debug_log("[".$page_path."] START");

 	$response=array();


  /*********************************************************
  * DATA CHECK
  *********************************************************/

  // SYSTEM CLOSED
  if(!checkClosed()){echo json_encode($response);die();}

  // BD CONNECTION
  if(!checkBDConnection()){echo json_encode($response);die();}

 	if(!@issetandnotempty($_POST["email"])){
	 	$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Missing email");
  		$response["error_code"]="reload";
  		echo json_encode($response);
 		die();
 	}
 	if(!@issetandnotempty($_POST["password"])){
	 	$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Missing password");
  		$response["error_code"]="reload";
  		echo json_encode($response);
 		die();
 	}

 	$table="ryadmins";
 	$filter=array();
 	$filter["email"]=array("operation"=>"=","value"=>$_POST["email"]);
 	$filter["password"]=array("operation"=>"=","value"=>md5($_POST["password"]));
 	if(!isInBD($table,$filter)){
	 	$response["result"]=false;
		debug_log("[".$page_path."] ERROR Login error {email:'".$_POST["email"]."'}");
  		$response["error_code"]="reload";
  		echo json_encode($response);
 		die();
 	}
 	$ryadmin=getInBD($table,$filter);

  // ADMIN
	if(!checkRyadmin($ryadmin)){echo json_encode($response);die();}


  /*********************************************************
  * AJAX OPERATIONS
  *********************************************************/

	$response["result"]=true;

  $_SESSION['ryadmin']=array();
  $_SESSION['ryadmin']["id_ryadmin"] = $ryadmin["id_ryadmin"];

	$response["data"]["id_ryadmin"]=$ryadmin["id_ryadmin"];


 	$table="ryadmins";
 	$filter=array();
 	$filter["id_admin"]=array("operation"=>"=","value"=>$admin["id_admin"]);
 	$data=array();
  $data["last_login"]=$timestamp;
  $data["last_activity"]=$timestamp;
 	updateInBD($table,$filter,$data);



	debug_log("[".$page_path."] Session Created Ryadmin:{id_ryadmin:".$_SESSION['ryadmin']["id_ryadmin"]."}");


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
