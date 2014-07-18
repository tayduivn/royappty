<?php
  /*********************************************************
  *
  * Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
  * Last Edit: 18-07-2014
  * Version: 0.93
  *
   *********************************************************/

  /*********************************************************
  * AJAX RETURNS
  *
  * ERROR CODES
  * no_brand
  * brand_not_valid
  *
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
