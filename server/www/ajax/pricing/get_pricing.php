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

  define('PATH', str_replace('\\','/','../../'));
  @session_start();
  $timestamp=strtotime(date("Y-m-d H:i:00"));
  include(PATH."include/inbd.php");
  $page_path="server/www/ajax/pricing/get_pricing";
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
          <a href='".$url_server."./index.html' class='navbar-brand compressed'><img src='".$url_server."assets/img/royappty-logo.png' data-src='".$url_server."assets/img/royappty-logo.png' data-src-retina='assets/img/royappty-logo.png' height='44' alt=''/></a>
        </div>
        <div class='navbar-collapse collapse'>
              <ul class='nav navbar-nav navbar-right'>
            <li><a href='".$url_server."index.html'>".htmlentities($s["home"], ENT_QUOTES, "UTF-8")."</a></li>
            <li><a href='".$url_server."tour/'>".htmlentities($s["how_it_works"], ENT_QUOTES, "UTF-8")."</a></li>
            <li><a href='".$url_server."pricing/'>".htmlentities($s["prices"], ENT_QUOTES, "UTF-8")."</a></li>
            <li><a href='".$url_server."contact/'>".htmlentities($s["contact"], ENT_QUOTES, "UTF-8")."</a></li>
            <li><a href='".$url_server."app/login/'>".htmlentities($s["access"], ENT_QUOTES, "UTF-8")."</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>

  ";

  $response["data"]["page-data"]="



  <div class='section first' id='pricing-section'>
    <div class='container p-t-10'>
    <div class='p-t-10'>
      <div class='row m-t-10 m-b-40'>
        <div class='col-md-4 m-b-30'>
        <div class='pricing-holder'>
            <div class='inner'>
              <div class='title text-center'>
                <img src='".$url_server."assets/img/royappty-logo.png' data-src='".$url_server."assets/img/royappty-logo.png' data-src-retina='".$url_server."assets/img/royappty-logo.png' height='44' alt=''/>
                <p class='text-success no-margin text-center text-medium'>".htmlentities($s["pricing_starter"], ENT_QUOTES, "UTF-8")."</p>
              </div>
              <ul class='items'>
                <li class='available'>
                  <div class='icon-holder'>
                    <i class='fa fa-check text-success'></i>
                  </div>
                  <div class='desc m-t-'>
                    <span class='text-black'>".htmlentities($s["pricing_starter_monthly_campaings"], ENT_QUOTES, "UTF-8")."</span>
                  </div>
                </li>
                <li class='available'>
                  <div class='icon-holder'>
                    <i class='fa fa-check text-success'></i>
                  </div>
                  <div class='desc m-t-'>
                    <span class='text-black'>".htmlentities($s["pricing_starter_iPhone_Android_available"], ENT_QUOTES, "UTF-8")."<span class='text-success'>*</span></span>
                  </div>
                </li>
                <li class='available'>
                  <div class='icon-holder'>
                    <i class='fa fa-check text-success'></i>
                  </div>
                  <div class='desc'>
                    <span class='text-black'>".htmlentities($s["pricing_starter_statistics"], ENT_QUOTES, "UTF-8")."</span>
                  </div>
                </li>
                <li class='available'>
                  <div class='icon-holder'>
                    <i class='fa fa-check text-success'></i>
                  </div>
                  <div class='desc'>
                    <span class='text-black'>".htmlentities($s["pricing_starter_marketing_pack"], ENT_QUOTES, "UTF-8")."</span>
                  </div>
                </li>
                <li class='available'>
                  <div class='icon-holder'>
                    <i class='fa fa-times text-muted'></i>
                  </div>
                  <div class='desc'>
                    <span class='text-muted'>".htmlentities($s["pricing_starter_customized_campaigns"], ENT_QUOTES, "UTF-8")."</span>
                  </div>
                </li>
              </ul>
              <p class='text-muted text-small m-l-10'>".htmlentities($s["pricing_starter_app_takes_10_days"], ENT_QUOTES, "UTF-8")."</p>
              <h3 class='text-success text-center m-b-20'>".htmlentities($s["pricing_starter_price"], ENT_QUOTES, "UTF-8")."</h3>
              <a href='".$url_server."app/signup/' class='btn btn-block btn-success'>".htmlentities($s["pricing_starter_btn_hire"], ENT_QUOTES, "UTF-8")."</a>

            </div>
          </div>
        </div>

        <div class='col-md-4 m-b-30'>
          <div class='pricing-holder'>
            <div class='inner'>
              <div class='title text-center'>
                <img src='".$url_server."assets/img/royappty-logo.png' data-src='".$url_server."assets/img/royappty-logo.png' data-src-retina='".$url_server."assets/img/royappty-logo.png' height='44' alt=''/>
                <p class='text-success no-margin text-center text-medium'>".htmlentities($s["pricing_professional"], ENT_QUOTES, "UTF-8")."</p>
              </div>
              <ul class='items'>
                <li class='available'>
                  <div class='icon-holder'>
                    <i class='fa fa-check text-success'></i>
                  </div>
                  <div class='desc m-t-''>
                    <span class='text-black'>".htmlentities($s["pricing_professional_monthly_campaigns"], ENT_QUOTES, "UTF-8")."</span>
                  </div>
                </li>
                <li class='available'>
                  <div class='icon-holder'>
                    <i class='fa fa-check text-success'></i>
                  </div>
                  <div class='desc m-t-'>
                    <span class='text-black'>".htmlentities($s["pricing_professional_iPhone_Android_available"], ENT_QUOTES, "UTF-8")."<span class='text-success'>*</span></span>
                  </div>
                </li>
                <li class='available'>
                  <div class='icon-holder'>
                    <i class='fa fa-check text-success'></i>
                  </div>
                  <div class='desc'>
                    <span class='text-black'>".htmlentities($s["pricing_professional_statistics"], ENT_QUOTES, "UTF-8")."</span>
                  </div>
                </li>
                <li class='available'>
                  <div class='icon-holder'>
                    <i class='fa fa-check text-success'></i>
                  </div>
                  <div class='desc'>
                    <span class='text-black'>".htmlentities($s["pricing_professional_marketing_pack"], ENT_QUOTES, "UTF-8")."</span>
                  </div>
                </li>
                <li class='available'>
                  <div class='icon-holder'>
                    <i class='fa fa-check text-success'></i>
                  </div>
                  <div class='desc'>
                    <span class='text-black'>".htmlentities($s["pricing_professional_customized_campaigns"], ENT_QUOTES, "UTF-8")."</span>
                  </div>
                </li>
              </ul>
              <p class='text-muted text-small m-l-10'>".htmlentities($s["pricing_professional_app_takes_10_days"], ENT_QUOTES, "UTF-8")."</p>
              <h3 class='text-success text-center m-b-20'>".htmlentities($s["pricing_professional_price"], ENT_QUOTES, "UTF-8")."</h3>
              <a href='".$url_server."app/signup/' class='btn btn-block btn-success'>".htmlentities($s["pricing_professional_btn_hire"], ENT_QUOTES, "UTF-8")."</a>

            </div>
          </div>
        </div>
        <div class='col-md-4 m-b-30'>
          <div class='pricing-holder'>
            <div class='inner'>
              <div class='title text-center'>
                <img src='".$url_server."assets/img/royappty-logo.png' data-src='".$url_server."assets/img/royappty-logo.png' data-src-retina='".$url_server."assets/img/royappty-logo.png' height='44' alt=''/>
                <p class='text-success no-margin text-center text-medium'>".htmlentities($s["pricing_unlimited"], ENT_QUOTES, "UTF-8")."</p>
              </div>
              <ul class='items'>
                <li class='available'>
                  <div class='icon-holder'>
                    <i class='fa fa-check text-success'></i>
                  </div>
                  <div class='desc m-t-'>
                    <span class='text-black'>".htmlentities($s["pricing_unlimited_campaigns"], ENT_QUOTES, "UTF-8")."</span>
                  </div>
                </li>
                <li class='available'>
                  <div class='icon-holder'>
                    <i class='fa fa-check text-success'></i>
                  </div>
                  <div class='desc m-t-''>
                    <span class='text-black'>".htmlentities($s["pricing_unlimited_iPhone_Android_available"], ENT_QUOTES, "UTF-8")."<span class='text-success'>*</span></span>
                  </div>
                </li>
                <li class='available'>
                  <div class='icon-holder'>
                    <i class='fa fa-check text-success'></i>
                  </div>
                  <div class='desc'>
                    <span class='text-black'>".htmlentities($s["pricing_unlimited_statistics"], ENT_QUOTES, "UTF-8")."</span>
                  </div>
                </li>
                <li class='available'>
                  <div class='icon-holder'>
                    <i class='fa fa-check text-success'></i>
                  </div>
                  <div class='desc'>
                    <span class='text-black'>".htmlentities($s["pricing_unlimited_marketing_pack"], ENT_QUOTES, "UTF-8")."</span>
                  </div>
                </li>
                <li class='available'>
                  <div class='icon-holder'>
                    <i class='fa fa-check text-success'></i>
                  </div>
                  <div class='desc'>
                    <span class='text-black'>".htmlentities($s["pricing_unlimited_focused_campaigns"], ENT_QUOTES, "UTF-8")."</span>
                  </div>
                </li>
              </ul>
              <p class='text-muted text-small m-l-10'>".htmlentities($s["pricing_unlimited_app_takes_10_days"], ENT_QUOTES, "UTF-8")."</p>
              <h3 class='text-success text-center m-b-20'>".htmlentities($s["pricing_unlimited_price"], ENT_QUOTES, "UTF-8")."</h3>
              <a href='".$url_server."app/signup/' class='btn btn-block btn-success' >".htmlentities($s["pricing_unlimited_btn_hire"], ENT_QUOTES, "UTF-8")."</a>

            </div>
          </div>
        </div>
        <div class='clearfix'></div>
      </div>
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
        <div class='p-t-30 p-b-5'>
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
