<?php
  /*********************************************************
  *
  * Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
  * Last Edit: 21-07-2014
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
  $page_path = "server/app/ajax/session/create";
 	debug_log("[".$page_path."] START");
 	$response=array();


  /*********************************************************
  * DATA CHECK
  *********************************************************/

  // BD CONNECTION
  if(!checkBDConnection()){echo json_encode($response);die();}

 	// BRAND
 	$brand=array();$brand["id_brand"]=$_POST["id_brand"];
	if(!checkBrand($brand)){echo json_encode($response);die();}

 	// ADMIN
  $admin=array();$admin["id_admin"]=$_POST["id_admin"];
	if(!checkAdmin($admin)){echo json_encode($response);die();}

 /*********************************************************
 * AJAX OPERATIONS
 *********************************************************/

  $response["result"]=true;
  $_SESSION['admin']=array();
  $_SESSION['admin']["id_admin"] = $_POST["id_admin"];
  $_SESSION['admin']["id_brand"] = $_POST["id_brand"];

 	$table="admins";
 	$filter=array();
 	$filter["id_admin"]=array("operation"=>"=","value"=>$_POST["id_admin"]);
 	$data=array();
 	$data["last_connection"]=strtotime(date("Y-m-d H:i:00"));
 	updateInBD($table,$filter,$data);

  /*********************************************************
  * DATABASE REGISTRATION
  *********************************************************/



  /*********************************************************
  * AJAX CALL RETURN
  *********************************************************/

  debug_log("[".$page_path."] Session Created user:{id_admin:".$_SESSION['admin']["id_admin"].",id_brand:".$_SESSION['admin']["id_brand"]."}");
  debug_log("[".$page_path."] END");
 	echo json_encode($response);
  die();
?>
