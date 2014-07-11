<?php
  /*********************************************************
  *
  * Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
  * Last Edit: 23-06-2014
  * Version: 0.91
  *
  *********************************************************/
  
 	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d 00:00:00"));
 	include(PATH."include/inbd.php");

 	debug_log("[server/app/ajax/session/create] START");

 	$response=array();


 	// BRAND
 	$brand=array();$brand["id_brand"]=$_POST["id_brand"];
	if(!checkBrand($brand)){echo json_encode($response);die();}
 	// ADMIN
  	$admin=array();$admin["id_admin"]=$_POST["id_admin"];
	if(!checkAdmin($admin)){echo json_encode($response);die();}


  	$response["result"]=true;
  	$_SESSION['admin']=array();
    $_SESSION['admin']["id_admin"] = $_POST["id_admin"];
    $_SESSION['admin']["id_brand"] = $_POST["id_brand"];

	debug_log("[server/app/ajax/session/create] Session Created user:{id_admin:".$_SESSION['admin']["id_admin"].",id_brand:".$_SESSION['admin']["id_brand"]."}");
 	debug_log("[server/app/ajax/session/create] END");

 	$table="admins";
 	$filter=array();
 	$filter["id_admin"]=array("operation"=>"=","value"=>$_POST["id_admin"]);
 	$data=array();
 	$data["last_connection"]=strtotime(date("Y-m-d H:i:00"));
 	updateInBD($table,$filter,$data);

 	echo json_encode($response);
?>
