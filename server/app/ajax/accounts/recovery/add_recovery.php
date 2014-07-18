<?php
 	/*********************************************************
  *
  * Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
  * Last Edit: 017-07-2014
  * Version: 0.93
  *
  *********************************************************/

  /*********************************************************
  * AJAX RETURNS
  *
  * ERROR CODES
  *
  *********************************************************/

  /*********************************************************
  * COMMON AJAX CALL DECLARATIONS AND INCLUDES
  *********************************************************/

  define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
 	include(PATH."include/inbd.php");
	$page_path= "server/app/ajax/accounts/recovery/add_recovery";
 	debug_log("[".$page_path."] START");
 	$response=array();

  /*********************************************************
  * DATA CHECK
  *********************************************************/

  if(!@issetandnotempty($_POST["email"])){
    $response["result"]=false;
   debug_log("[".$page_path."] ERROR Data Missing email");
     $response["error_code"]="reload";
     echo json_encode($response);
    die();
  }

  $table="admins";
  $filter=array();
  $filter["email"]=array("operation"=>"=","value"=>$_POST["email"]);
  if(!isInBD($table,$filter)){
    $response["result"]=false;
   debug_log("[".$page_path."] ERROR Recovery error {email:'".$_POST["email"]."'}");
   $response["error_str"]=$error["recovery_not_email"];
   echo json_encode($response);
    die();
  }

  /*********************************************************
  * AJAX OPERATIONS
  *********************************************************/


  $response["result"]=true;

  $table="admins";
  $filter=array();
  $filter["email"]=array("operation"=>"=","value"=>$_POST["email"]);
  $admin=getInBD($table,$filter);

  $table="recovery_codes";
  $filter=array();
  $filter["email"]=array("operation"=>"=","value"=>$admin["email"]);
  if(isInBD($table,$filter)){
    deleteInBD($table,$filter);
  }
  $table="recovery_codes";
  $data=array();
  $data["email"]=$admin["email"];
  $data["code"]=md5("code".$admin["email"].$timestamp);
  addInBD($table,$data);
  $revery_code=array();
  $revery_code["code"]=$data["code"];

  $mail_for=$admin["email"];
  $mail_content=htmlentities($revocery_s["revocery_content_header"], ENT_QUOTES, "UTF-8")."<br/><br/><a href='".$url_server."app/recovery/set/?code=".$revery_code["code"]."'></a>".$url_server."app/recovery/set/?code=".$revery_code["code"]."<br/><br/>".htmlentities($revocery_s["revocery_content_footer"], ENT_QUOTES, "UTF-8");
  //when use htmlentities with mail_subject, send the subject without accute accent
  $mail_subject=$revocery_s["mail_subject"];
  corporate_email($mail_for,$mail_subject,$mail_content);


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
