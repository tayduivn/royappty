<?php
  /*********************************************************
  *
  * Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
  * Last Edit: 08-08-2014
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

  define('PATH', str_replace('\\','/','../../../'));
  @session_start();
  $timestamp=strtotime(date("Y-m-d H:i:00"));
  include(PATH."include/inbd.php");
  $page_path="server/www/ajax/tour/opportunities/get_opportunities";
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

  $response["data"]["menu-data"]="
  <div class='main-wrapper'>
  <div role='navigation' class='navbar navbar-default navbar-static-top'>
    <div class='container'>
      <div class='compressed'>
        <div class='navbar-header'>
          <button data-target='.navbar-collapse' data-toggle='collapse' class='navbar-toggle' type='button'>
            <span class='sr-only'>Toggle navigation</span>
                  <span class='icon-bar'></span>
                  <span class='icon-bar'></span>
                  <span class='icon-bar'></span>
          </button>
          <a href='".$url_server."index.html' class='navbar-brand compressed'><img src='".$url_server."assets/img/royappty-logo.png' data-src='".$url_server."assets/img/royappty-logo.png' data-src-retina='".$url_server."assets/img/royappty-logo.png' height='44' alt=''/></a>
        </div>
        <div class='navbar-collapse collapse'>
              <ul class='nav navbar-nav navbar-right'>
            <li><a href='".$url_server."index.html'>".htmlentities($s["home"], ENT_QUOTES, "UTF-8")."</a></li>
            <li><a href='".$url_server."tour/'>".htmlentities($s["how_it_works"], ENT_QUOTES, "UTF-8")."</a></li>
            <li><a href='".$url_server."pricing/'>".htmlentities($s["prices"], ENT_QUOTES, "UTF-8")."</a></li>
            <li><a href='".$url_server."contact/'>".htmlentities($s["contact"], ENT_QUOTES, "UTF-8")."</a></li>
            <li><a href='".$url_server."app/login'>".htmlentities($s["access"], ENT_QUOTES, "UTF-8")."</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>


  ";

  $response["data"]["page-data"]="
  <div class='section first'>
    <div class='container'>
      <div class='row p-t-20'>
        <div class='col-md-1'>
        </div>
        <div class='col-md-10 text-center'>
          <h1 class='normal m-b-10'>".htmlentities($s["opportunities_1_title"], ENT_QUOTES, "UTF-8")."</h1>
          <h4>".htmlentities($s["opportunities_1_content_1"], ENT_QUOTES, "UTF-8")."</h4>
          <h4>".htmlentities($s["opportunities_1_content_2"], ENT_QUOTES, "UTF-8")."</h4>
        </div>
        <div class='col-md-1'>
        </div>
      </div>
      <div class='p-b-60 text-center'>
          <div class='m-t-40 m-b-20'>
            <img src='".$url_server."assets/img/tour/opportunities/opportunities_1_image.png' alt='img01'>
          </div>
      </div>
      <div class='row p-t-20'>
        <div class='col-md-1'>
        </div>
        <div class='col-md-10 text-center'>
          <h1 class='normal m-b-10'>".htmlentities($s["opportunities_2_title"], ENT_QUOTES, "UTF-8")."</h1>
          <h4>".htmlentities($s["opportunities_2_content_1"], ENT_QUOTES, "UTF-8")."</h4>
          <h4>".htmlentities($s["opportunities_2_content_2"], ENT_QUOTES, "UTF-8")."</h4>
        </div>
        <div class='col-md-1'>
        </div>
      </div>
      <div class='p-b-60 text-center'>
          <div class='m-t-40 m-b-20'>
            <img src='".$url_server."assets/img/tour/opportunities/opportunities_2_image.png' alt='img01'>
          </div>
      </div>
      <div class='row p-t-20'>
        <div class='col-md-1'>
        </div>
        <div class='col-md-10 text-center'>
          <h1 class='normal m-b-10'>".htmlentities($s["promos_3_title"], ENT_QUOTES, "UTF-8")."</h1>
          <h4>".htmlentities($s["opportunities_3_content_1"], ENT_QUOTES, "UTF-8")."</h4>
          <h4>".htmlentities($s["opportunities_3_content_2"], ENT_QUOTES, "UTF-8")."</h4>
        </div>
        <div class='col-md-1'>
        </div>
      </div>
      <div class='p-b-60 text-center'>
          <div class='m-t-40 m-b-20'>
            <img src='".$url_server."assets/img/tour/opportunities/opportunities_3_image.png' alt='img01'>
          </div>
      </div>
      <div class='row p-t-20'>
        <div class='col-md-1'>
        </div>
        <div class='col-md-10 text-center'>
          <h1 class='normal m-b-10'>".htmlentities($s["opportunities_4_title"], ENT_QUOTES, "UTF-8")."</h1>
          <h4>".htmlentities($s["opportunities_4_content_1"], ENT_QUOTES, "UTF-8")."</h4>
          <h4>".htmlentities($s["opportunities_4_content_2"], ENT_QUOTES, "UTF-8")."</h4>
        </div>
        <div class='col-md-1'>
        </div>
      </div>
      <div class='p-b-60 text-center'>
          <div class='m-t-40 m-b-20'>
            <img src='".$url_server."assets/img/tour/opportunities/opportunities_4_image.png' alt='img01'>
          </div>
      </div>
      <div class='p-b-60 p-t-20 text-center'>
          <p>
            <a href='".$url_server."tour/' class='btn btn-primary'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
          </p>
      </div>
    </div>
  </div>

  <div class='section black'>
      <div class='container'>
        <div class='p-t-60 p-b-60'>
          <div class='row'>
            <div class='col-md-8 col-md-offset-2'>

              <h2 class='text-center text-white'>".htmlentities($s["need_more_info"], ENT_QUOTES, "UTF-8")."</h2>
              <h3 class='text-center text-muted m-b-30'>".htmlentities($s["contact_to_answer_doubts"], ENT_QUOTES, "UTF-8")."</h3>
            <div class='row form-row'>
              <form id='form-contact-info'>
                <div class='col-md-6 col-md-offset-2 no-padding  col-sm-6 col-sm-offset-2 col-xs-10 col-xs-offset-1'>
                  <input name='contact_info' id='contact_info' type='text' class='form-control' placeholder='".htmlentities($s["insert_email_or_phone"], ENT_QUOTES, "UTF-8")."'>
                </div>
                <div class='col-md-4 col-sm-4 col-xs-4 xs-p-l-10'>
                  <button type='submit' class='btn btn-primary btn-cons'>".htmlentities($s["send"], ENT_QUOTES, "UTF-8")."</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class='section white footer'>
      <div class='container'>
        <div class='p-t-30 p-b-50'>
          <div class='row'>
            <div class='col-md-4'>
            <img src='".$url_server."assets/img/royappty-logo.png' alt='' data-src='".$url_server."assets/img/royappty-logo.png' data-src-retina='".$url_server."assets/img/royappty-logo.png' height='44'/>
            <address class='p-t-20'>
                ".htmlentities($s["product_VivaLaCLoud_SL"], ENT_QUOTES, "UTF-8")."<br>
                ".htmlentities($s["address"], ENT_QUOTES, "UTF-8")."<br>
                ".htmlentities($s["city_country"], ENT_QUOTES, "UTF-8")."<br>
                ".htmlentities($s["phone"], ENT_QUOTES, "UTF-8")."<br>
                ".htmlentities($s["email"], ENT_QUOTES, "UTF-8")."
              </address>
            </div>


            <div class='col-md-4'>
            <div class='bold'>".htmlentities($s["work_with us"], ENT_QUOTES, "UTF-8")."</div>
            ".htmlentities($s["looking_for_talent"], ENT_QUOTES, "UTF-8")."
            </div>
            <div class='col-md-4'>
            <div class='bold'>".htmlentities($s["follow_us"], ENT_QUOTES, "UTF-8")."</div>
            ".htmlentities($s["follow_us_in_social_networks"], ENT_QUOTES, "UTF-8")."<br>
            <div class='bold m-t-10'>".htmlentities($s["language"], ENT_QUOTES, "UTF-8")."</div>
            <a href='#' onclick='changelang(\"es\");'>".htmlentities($s["lang_spanish"], ENT_QUOTES, "UTF-8")."</a><br>
			<!--<a href='#' onclick='changelang(\"en\");'>".htmlentities($s["lang_english"], ENT_QUOTES, "UTF-8")."</a>-->
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class='section grey footer'>
      <div class='container'>
        <div class='p-t-10 p-b-10'>
          <div class='row text-center'>
              ".htmlentities($s["VivaLaCloud_SL_2014"], ENT_QUOTES, "UTF-8")."
          </div>
        </div>
      </div>
  </div>
  </div>




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
