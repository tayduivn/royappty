<?php
  /*********************************************************
  *
  * Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
  * Last Edit: 22-07-2014
  * Version: 0.93
  *
  *********************************************************/

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
	$page_path= "server/app/ajax/accounts/login/create_session";
 	debug_log("[".$page_path."] START");

 	$response=array();


  /*********************************************************
  * DATA CHECK
  *********************************************************/

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

 	$table="admins";
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
 	$admin=getInBD($table,$filter);

  	// BRAND
 	$brand=array();$brand["id_brand"]=$admin["id_brand"];
	if(!checkBrand($brand)){echo json_encode($response);die();}
 	// ADMIN
	if(!checkAdmin($admin)){echo json_encode($response);die();}


  /*********************************************************
  * AJAX OPERATIONS
  *********************************************************/

	$response["result"]=true;

  $_SESSION['admin']=array();
  $_SESSION['admin']["id_admin"] = $admin["id_admin"];
  $_SESSION['admin']["id_brand"] = $admin["id_brand"];

  error_log("------>>>>".$admin["id_admin"]);

	$response["data"]["id_admin"]=$admin["id_admin"];
	$response["data"]["id_brand"]=$admin["id_brand"];


 	$table="admins";
 	$filter=array();
 	$filter["id_admin"]=array("operation"=>"=","value"=>$admin["id_admin"]);
 	$data=array();
 	$data["last_connection"]=strtotime(date("Y-m-d H:i:00"));
 	updateInBD($table,$filter,$data);



	debug_log("[".$page_path."] Session Created user:{id_admin:".$_SESSION['admin']["id_admin"].",id_brand:".$_SESSION['admin']["id_brand"]."}");


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
