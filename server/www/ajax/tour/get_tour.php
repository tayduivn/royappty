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
  $page_path="server/www/ajax/tour/get_tour";
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
  <div class='section first  text-center p-t-40 p-b-40' id='banner-footer'>
     <div class='container'>
	   <h2 class='normal m-b-10'>".htmlentities($s["tour_how_does_it_work"], ENT_QUOTES, "UTF-8")."</h2>
	    <p>".htmlentities($s["tour_we_teach_you"], ENT_QUOTES, "UTF-8")."</p>
	   </div>
  </div>
  <div class='section white text-center p-t-40 p-b-40'>
       <div class='container'>
	<div class='row padding-20 p-t-50'>
  		<div class='col-md-6 text-center'>
              <img class='full-width' src='".$url_server."assets/img/tour/royappty-createaccount.png' alt='img01'>
  		</div>
  		<div class='col-md-6 text-center'>
              <img src='".$url_server."assets/img/retina_icon.png' alt='' class='normal'>
                  <h1 class='m-b-20'>".htmlentities($s["tour_creating_your_own"], ENT_QUOTES, "UTF-8")."<span class='semi-bold'>".htmlentities($s["tour_APP"], ENT_QUOTES, "UTF-8")."</span></h1>
                  <p>".htmlentities($s["tour_singup_create_your_app"], ENT_QUOTES, "UTF-8")."</p>
                  <a href='".$url_server."tour/build/' class='btn btn-primary btn-small m-t-20'>".htmlentities($s["tour_learn_more"], ENT_QUOTES, "UTF-8")."</a>
  		</div>
  	</div>
  	<div class='row padding-20 p-t-50'>
  		<div class='col-md-6 text-center'>
              <img src='".$url_server."assets/img/Stressfree_icon.png' alt='' class='norma'>
                <h1 class='m-b-20'>".htmlentities($s["tour_managing"], ENT_QUOTES, "UTF-8")."<span class='semi-bold'>".htmlentities($s["tour_your_users"], ENT_QUOTES, "UTF-8")."</span></h1>
                <p>".htmlentities($s["tour_simple_app_for_users"], ENT_QUOTES, "UTF-8")."</p>
                <a href='".$url_server."tour/promos/' class='btn btn-primary btn-small m-t-20'>".htmlentities($s["tour_learn_more"], ENT_QUOTES, "UTF-8")."</a>
  		</div>
  		<div class='col-md-6 text-center'>
        	<img class='full-width' src='".$url_server."assets/img/tour/promos/promos_1_image.png' alt='img01'>

  		</div>
  	</div>
  	<div class='row padding-20 p-t-50'>
  		<div class='col-md-6 text-center'>
        	<!--<img src='".$url_server."assets/img/Front.png' alt='img01'>-->
  		</div>
  		<div class='col-md-6 text-center'>
        	<img src='".$url_server."assets/img/frontend_icon.png' alt='' class='normal'>
                <h1 class='m-b-20'>".htmlentities($s["tour_use_of"], ENT_QUOTES, "UTF-8")."<span class='semi-bold'>".htmlentities($s["tour_app"], ENT_QUOTES, "UTF-8")."</span></h1>
                <p>".htmlentities($s["tour_what_users_should_do"], ENT_QUOTES, "UTF-8")."</p>
                <a href='".$url_server."tour/opportunities/' class='btn btn-primary btn-small m-t-20'>".htmlentities($s["tour_learn_more"], ENT_QUOTES, "UTF-8")."</a>
  		</div>
  	</div>
  	<div class='row padding-20 p-t-50'>
  		<div class='col-md-6 text-center'>
        	 <img src='".$url_server."assets/img/condensed_icon.png' alt='' class='normal'>
                <h1 class='m-b-20'>".htmlentities($s["tour_find_out"], ENT_QUOTES, "UTF-8")."<span class='semi-bold'>".htmlentities($s["tour_your_customers"], ENT_QUOTES, "UTF-8")."</span></h1>
                <p>".htmlentities($s["tour_get_your_customer_information"], ENT_QUOTES, "UTF-8")."</p>
                <a href='".$url_server."tour/validation/' class='btn btn-primary btn-small m-t-20'>".htmlentities($s["tour_learn_more"], ENT_QUOTES, "UTF-8")."</a>
  		</div>
  		<div class='col-md-6 text-center'>
        	              <!--<img src='".$url_server."assets/img/condensed.png' alt='img01'>-->

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
