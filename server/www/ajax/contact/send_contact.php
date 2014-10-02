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
  *
  *********************************************************/

  /*********************************************************
  * COMMON AJAX CALL DECLARATIONS AND INCLUDES
  *********************************************************/

  define('PATH', str_replace('\\','/','../../'));
  @session_start();
  $timestamp=strtotime(date("Y-m-d H:i:00"));
  include(PATH."include/inbd.php");
  $page_path="server/www/ajax/contact/send_contact";
  debug_log("[".$page_path."] START");
  $response=array();

  /*********************************************************
  * DATA CHECK
  *********************************************************/

  // SYSTEM CLOSED
if(!checkClosed()){echo json_encode($response);die();}

// BD CONNECTION
  if(!checkBDConnection()){echo json_encode($response);die();}


  /*********************************************************
  * AJAX OPERATIONS
  *********************************************************/

  $response["result"]=true;

  $subject="[Contact Form] [Date ".date("Y-m-d H:i")."] Contact Form (".htmlentities($_POST["email"], ENT_QUOTES, "UTF-8").")";
  $content="
    <h3>Contact Form email</h3>
      <p><b>Language Selection:</b> ".$_POST["lang"]."</p>
      <p><b>Name:</b> ".htmlentities($_POST["name"], ENT_QUOTES, "UTF-8")."</p>
      <p><b>Email:</b> ".htmlentities($_POST["email"], ENT_QUOTES, "UTF-8")."</p>
      <p><b>Content:</b><br/>
        ".htmlentities($_POST["content"], ENT_QUOTES, "UTF-8")."</p>";

  corporate_email($CONFIG["company_info_mail"],$subject,$content);

  $response["data"]["modal_title"]=$s_modal["your_contact_was_sent"]["title"];
  $response["data"]["modal_content"]=$s_modal["your_contact_was_sent"]["content"];
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
