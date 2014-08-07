<?php
  /*********************************************************
  *
  * Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
  * Last Edit: 07-08-2014
  * Version: 0.94
  *
  *********************************************************/

  /*********************************************************
  * AJAX RETURNS
  *
  * ERROR CODES
  * db_connection_error
  *
  *********************************************************/

  /*********************************************************
  * COMMON AJAX CALL DECLARATIONS AND INCLUDES
  *********************************************************/

  define('PATH', str_replace('\\','/','../../'));
  @session_start();
  $timestamp=strtotime(date("Y-m-d H:i:00"));
  include(PATH."include/inbd.php");
  $page_path="server/www/ajax/contactinfo/add_contact_info";
  debug_log("[".$page_path."] START");
  $response=array();

  /*********************************************************
  * DATA CHECK
  *********************************************************/

  // BD CONNECTION
  if(!checkBDConnection()){echo json_encode($response);die();}


  /*********************************************************
  * AJAX OPERATIONS
  *********************************************************/

  $response["result"]=true;

  $subject="[Contact Form] [Date ".date("Y-m-d H:i")."] Request Information";
  error_log($subject);
  $content="<h3>Auto Contact Form email</h3><p><b>Language Selection:</b> ".$_POST["lang"]."</p><p><b>Contact Information:</b> ".htmlentities($_POST["contact_info"], ENT_QUOTES, "UTF-8")."</p>";

  corporate_email($CONFIG["company_info_mail"],$subject,$content);
  
  $response["data"]["modal_title"]=$s_modal["your_contact-info_was_sent"]["title"];
  $response["data"]["modal_content"]=$s_modal["your_contact-info_was_sent"]["content"];
  $response["data"]["modal_button"]=$s["close"];


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
