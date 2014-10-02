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
  $page_path="server/www/ajax/launch/get_launch";
  debug_log("[".$page_path."] START");
  $response=array();

  /*********************************************************
  * DATA CHECK
  *********************************************************/

  /*********************************************************
  * AJAX OPERATIONS
  *********************************************************/

  $response["result"]=true;

  $response["data"]["page-data"]="

    <div class='page-wrap'>
      <header class='header background-image' id='header'>
        <div class='overlay'>
          <div class='container'>
            <div class='row'>
              <div class='col-md-12'>
                <div class='intro text-centre'>
                  <div class='intro-inner'>
                    <div class='logo'>
                      <img src='images/logo.png' alt='Royappty Brand Logo'>
                    </div><!-- logo end -->
                    <h3>
                      La aplicación de fidelización para tu negocio
                    </h3>
                  </div><!-- intro-inner end -->
                </div><!-- intro end -->
              </div><!-- col end -->
            </div><!-- row end -->
          </div><!-- container end -->
        </div><!-- overlay end -->
      </header>
      <!-- header section end -->
    </div><!-- page-wrap end -->



  ";

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
