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
  * no_brand
  * brand_not_valid
  * no_admin
  * admin_not_valid
  * admin_inactive
  * post_create_no_brand
  * post_create_no_admin
  *
  *********************************************************/


  /*********************************************************
   * COMMON AJAX CALL DECLARATIONS AND INCLUDES
   *********************************************************/
 	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
 	include(PATH."include/inbd.php");
  $page_path = "server/ryadmin/ajax/session/create";
 	debug_log("[".$page_path."] START");
 	$response=array();


  /*********************************************************
  * DATA CHECK
  *********************************************************/

  // SYSTEM CLOSED
  if(!checkClosed()){echo json_encode($response);die();}

  // BD CONNECTION
  if(!checkBDConnection()){echo json_encode($response);die();}

 	// ADMIN
  $ryadmin=array();$ryadmin["id_ryadmin"]=$_POST["id_ryadmin"];
	if(!checkRyadmin($ryadmin)){echo json_encode($response);die();}

 /*********************************************************
 * AJAX OPERATIONS
 *********************************************************/

  $response["result"]=true;
  $_SESSION['ryadmin']=array();
  $_SESSION['ryadmin']["id_ryadmin"] = $_POST["id_ryadmin"];


 	$table="ryadmins";
 	$filter=array();
 	$filter["id_ryadmin"]=array("operation"=>"=","value"=>$_POST["id_ryadmin"]);
 	$data=array();
  $data["last_activity"]=$timestamp;
 	updateInBD($table,$filter,$data);

  /*********************************************************
  * DATABASE REGISTRATION
  *********************************************************/



  /*********************************************************
  * AJAX CALL RETURN
  *********************************************************/

  debug_log("[".$page_path."] Session Created user:{id_ryadmin:".$_SESSION['ryadmin']["id_ryadmin"]."}");
  debug_log("[".$page_path."] END");
 	echo json_encode($response);
  die();
?>
