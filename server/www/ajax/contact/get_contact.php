<?php
  /*********************************************************
  *
  * Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
  * Last Edit: 25-07-2014
  * Version: 0.93.1
  *
  *********************************************************/

  /*********************************************************
  * AJAX RETURNS
  *
  * ERROR CODES
  * db_connection_error
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
  $page_path="server/www/ajax/contact/get_contact";
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
          <a href='".$url_server."./index.html' class='navbar-brand compressed'><img src='".$url_server."assets/img/royappty-logo.png' data-src='".$url_server."assets/img/royappty-logo.png' data-src-retina='".$url_server."assets/img/royappty-logo.png' height='44' alt=''/></a>
        </div>
        <div class='navbar-collapse collapse'>
              <ul class='nav navbar-nav navbar-right' >
            <li><a href='".$url_server."index.html'>".htmlentities($s["home"], ENT_QUOTES, "UTF-8")."</a></li>
            <li><a href='".$url_server."tour.html'>".htmlentities($s["how_it_works"], ENT_QUOTES, "UTF-8")."</a></li>
            <li><a href='".$url_server."pricing.html'>".htmlentities($s["prices"], ENT_QUOTES, "UTF-8")."</a></li>
            <li><a href='".$url_server."contact.html'>".htmlentities($s["contact"], ENT_QUOTES, "UTF-8")."</a></li>
            <li><a href='".$url_server."app/login/'>".htmlentities($s["access"], ENT_QUOTES, "UTF-8")."</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>
  ";

  $response["data"]["page-data"]="
  <div class='section first'>
    <div class='container'>
    <div class='p-b-60'>
      <div class='row'>
      <div class='col-md-6 col-sm-6'>

      </div>
      </div>
      <div class='row p-t-30'>
        <div class='col-md-6 col-sm-6'>
        <h2 class=''>".htmlentities($s["contact_with"], ENT_QUOTES, "UTF-8")."<span class='text-success semi-bold'>".htmlentities($s["contact_us"], ENT_QUOTES, "UTF-8")."</span></h2>
        <p class='p-b-20'>".htmlentities($s["contact_complete_form"], ENT_QUOTES, "UTF-8")."</p>
        <div class='row form-row'>
                        <div class='col-md-10'>
                          <input name='textFirstName' id='textFirstName' type='text' class='form-control' placeholder='".htmlentities($s["contact_name"], ENT_QUOTES, "UTF-8")."'>
                        </div>
              </div>
        <div class='row form-row'>
                        <div class='col-md-10'>
                          <input name='txtEmailAddress' id='txtEmailAddress' type='text' class='form-control' placeholder='".htmlentities($s["contact_email_or_phone"], ENT_QUOTES, "UTF-8")."'>
                        </div>
              </div>
        <div class='row form-row'>
                        <div class='col-md-10'>
              <textarea id='txtDesc' type='text' class='form-control' placeholder='".htmlentities($s["contact_write_here_questions"], ENT_QUOTES, "UTF-8")."' rows='8'></textarea>
                        </div>
              </div>
        <div class='row form-row'>
           <div class='col-md-10'>
          <button type='button' class='btn btn-primary'>".htmlentities($s["contact_send"], ENT_QUOTES, "UTF-8")."</button>
          </div>
        </div>
        </div>
        <div class='col-md-6 feature-list p-t-20'>
          <h4 class='title custom-font text-black no-margin p-b-10 all-caps'>".htmlentities($s["contact_phone_title"], ENT_QUOTES, "UTF-8")."</h4>
          <h3 class='custom-font text-black no-margin'><i class='fa fa-phone fa-lg p-r-10'></i>".htmlentities($s["contact_phone"], ENT_QUOTES, "UTF-8")."</h3>
          <section class='p-t-20 p-b-20'>
            <h4 class='title custom-font text-black all-caps'>".htmlentities($s["contact_address_title"], ENT_QUOTES, "UTF-8")."</h4>
            <address>
              ".htmlentities($s["contact_address"], ENT_QUOTES, "UTF-8")."<br>
              ".htmlentities($s["contact_city_country"], ENT_QUOTES, "UTF-8")."<br>
              ".htmlentities($s["contact_post_code"], ENT_QUOTES, "UTF-8")."
            </address>
          </section>
          <section>
            <h4 class='title custom-font text-black all-caps'>".htmlentities($s["contact_timetable"], ENT_QUOTES, "UTF-8")."</h4>
            <p>".htmlentities($s["contact_open_from_to"], ENT_QUOTES, "UTF-8")."<br></p>
          </section>
        </div>
      </div>
    </div>
    </div>

  </div>
  <div class='section white' style='height:350px' id='map'>

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
            <a href='#' onclick='changelang(\"es\");'>".htmlentities($s["lang_spanish"], ENT_QUOTES, "UTF-8")."</a><br>
            <a href='#' onclick='changelang(\"en\");'>".htmlentities($s["lang_english"], ENT_QUOTES, "UTF-8")."</a>
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
