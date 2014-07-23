<?php
  define('PATH', str_replace('\\','/','../../'));
  @session_start();
  $timestamp=strtotime(date("Y-m-d H:i:00"));



  include(PATH."include/inbd.php");
  $page_path="server/www/ajax/main/get_main";
  debug_log("[".$page_path."] START");

   $response=array();


  $response["result"]=true;

  $response["data"]["menu-data"]="
<div class='main-wrapper'>
      <header id='ha-header' class='ha-header ha-header-hide'>
        <div class='ha-header-perspective'>
        <div class='ha-header-front navbar navbar-default'>

            <div class='compressed'>
            <div class='navbar-header'>
              <button data-target='.navbar-collapse' data-toggle='collapse' class='navbar-toggle' type='button'>
              <span class='sr-only'>Toggle navigation</span>
              <span class='icon-bar'></span>
              <span class='icon-bar'></span>
              <span class='icon-bar'></span>
              </button>
              <a href='".PATH."./index.html' class='navbar-brand compressed'><img src='".PATH."assets/img/royappty-logo.png' alt='' data-src='".PATH."assets/img/royappty-logo.png' data-src-retina='".PATH."assets/img/royappty-logo.png' height='44'/></a>
            </div>
            <div class='navbar-collapse collapse'>
              <ul class='nav navbar-nav navbar-right'>
              <li><a href='".PATH."index.html'>".htmlentities($s["home"], ENT_QUOTES, "UTF-8")."</a></li>
              <li><a href='".PATH."tour.html'>".htmlentities($s["how_it_works"], ENT_QUOTES, "UTF-8")."</a></li>
              <li><a href='".PATH."pricing.html'>".htmlentities($s["prices"], ENT_QUOTES, "UTF-8")."</a></li>
              <li><a href='".PATH."contact.html'>".htmlentities($s["contact"], ENT_QUOTES, "UTF-8")."</a></li>
              <li><a href='".PATH."app/login/'>".htmlentities($s["access"], ENT_QUOTES, "UTF-8")."</a></li>
              </ul>
            </div><!--/.nav-collapse -->
            </div>

          </div>
        </div>
      </header>

<div class='section ha-waypoint' data-animate-down='ha-header-hide' data-animate-up='ha-header-hide'>
<div role='navigation' class='navbar navbar-transparent navbar-top'>
     <div class='container'>
    <div class='compressed'>
        <div class='navbar-header'>
       <button data-target='.navbar-collapse' data-toggle='collapse' class='navbar-toggle' type='button'>
            <span class='sr-only'>Toggle navigation</span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </button>
          <a href='".PATH."./index.html' class='navbar-brand'><img src='".PATH."assets/img/royappty-logo-white.png' data-src='".PATH."assets/img/royappty-logo-white.png' data-src-retina='".PATH."assets/img/royappty-logo-white.png' height='44' alt=''/></a>
        </div>
        <div class='navbar-collapse collapse'>
          <ul class='nav navbar-nav navbar-right'>
          <li><a href='".PATH."index.html'>".htmlentities($s["home"], ENT_QUOTES, "UTF-8")."</a></li>
          <li><a href='".PATH."tour.html'>".htmlentities($s["how_it_works"], ENT_QUOTES, "UTF-8")."</a></li>
          <li><a href='".PATH."pricing.html'>".htmlentities($s["prices"], ENT_QUOTES, "UTF-8")."</a></li>
          <li><a href='".PATH."contact.html'>".htmlentities($s["contact"], ENT_QUOTES, "UTF-8")."</a></li>
          <li><a href='".PATH."app/login/'>".htmlentities($s["access"], ENT_QUOTES, "UTF-8")."</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    </div>
</div>

  ";
  $response["data"]["page-data"]="
<!--BEGIN SLIDER -->
<div class='tp-banner-container'>
  <div class='tp-banner' id='home'>
    <ul>
      <!-- SLIDE  -->
      <li data-transition='fade' data-slotamount='5' data-masterspeed='700'>
        <!-- MAIN IMAGE -->
        <img src='".PATH."assets/img/bg/bg_1.jpg' alt='slidebg1' data-bgfit='cover' data-bgposition='center center' data-bgrepeat='no-repeat'>


        <!-- LAYERS -->
        <div class='tp-caption mediumlarge_light_white_center sft tp-resizeme slider'
            data-x='center' data-hoffset='0'
            data-y='60'
            data-speed='500'
            data-start='800'
            data-easing='Power4.easeOut'
            data-endspeed='300'
            data-endeasing='Power1.easeIn'
            data-captionhidden='off'
            style='z-index: 6'><h1 class='text-white custom-font title' style='font-size:60px;line-height:60px;'>".htmlentities($s["main_loyalty_app"], ENT_QUOTES, "UTF-8")."<br>".htmlentities($s["main_to_your_business"], ENT_QUOTES, "UTF-8")."</h1><h3 class='text-white'>".htmlentities($s["main_from_9_99_month"], ENT_QUOTES, "UTF-8")."</h3>

        </div>
        <div class='tp-caption sfb slider tp-resizeme slider'
          data-x='center'
          data-hoffset='0'
          data-y='300'
          data-speed='800'
          data-start='1000'
          data-easing='Power4.easeOut'
          data-endspeed='300'
          data-endeasing='Power1.easeIn'
          data-captionhidden='off'
          style='z-index: 6'>	<a href='".PATH."./pricing.html' class='btn btn-success btn-lg  btn-large m-r-10'>".htmlentities($s["main_start_creating_app"], ENT_QUOTES, "UTF-8")."</a>
        </div>

      </li>
    </ul>
    <div class='tp-bannertimer'></div>
  </div>
</div>

<!--END SLIDER-->

<div class='section'>
  <div class='container'>
    <div class='p-t-40 p-b-40'>
      <h2 class='text-center'>".htmlentities($s["main_create_your_own_app"], ENT_QUOTES, "UTF-8")." <span class='semi-bold'>".htmlentities($s["main_promote_loyalty2"], ENT_QUOTES, "UTF-8")."</span></h2>
      <h4 class='text-center'>".htmlentities($s["main_royappty_definition"], ENT_QUOTES, "UTF-8")."</h4>
    </div>
  </div>
</div>
<div class='section white ha-waypoint' data-animate-down='ha-header-color' data-animate-up='ha-header-hide'>
    <div class='container'>
      <div class='p-t-60'>
        <div class='row'>
          <div class='col-md-12 feature-list'>
            <div class='col-md-4' data-ride='animated' data-animation='fadeIn' data-delay='300'>
            <h3 class='title text-center'>".htmlentities($s["main_to_your_business"], ENT_QUOTES, "UTF-8")."</h3>
            <p class='text-center'>".htmlentities($s["main_importance_of_distinction"], ENT_QUOTES, "UTF-8")."</p>
            </div>
            <div class='col-md-4' data-ride='animated' data-animation='fadeIn' data-delay='600'>
            <h3 class='title text-center'>".htmlentities($s["main_promote_loyalty"], ENT_QUOTES, "UTF-8")."</h3>
            <p class='text-center'>".htmlentities($s["main_simple_campaign_creation"], ENT_QUOTES, "UTF-8")."</p>
            </div>
            <div class='col-md-4' data-ride='animated' data-animation='fadeIn' data-delay='900'>
            <h3 class='title text-center'>".htmlentities($s["main_on_the same_level"], ENT_QUOTES, "UTF-8")."</h3>
            <p class='text-center'>".htmlentities($s["main_direct_contact_with_clients"], ENT_QUOTES, "UTF-8")."</p>
            </div>
          </div>
        </div>
        <br>
        <div class='section relative'>
          <div class='row text-center'>

          <img src='".PATH."assets/img/citious-screenshot.jpg' alt='' class='resize p-t-60 hidden-xs full-width' style='' data-ride='animated' data-animation='fadeInUp' data-delay='300' data-bgfit='cover' data-bgposition='center center'>

        </div>
        </div>
        <div class='clearfix'></div>
      </div>
    </div>
  </div>


<div class='section grey'>
  <div class='container'>
    <div class='p-t-40 p-b-50'>
      <div class='row'>
        <div class='col-md-12 text-center'>
          <h2 class='p-b-10'><span class='normal'>".htmlentities($s["main_start_now"], ENT_QUOTES, "UTF-8")."</span><br>".htmlentities($s["main_boost_your_business"], ENT_QUOTES, "UTF-8")."</h2>
          <a href='".PATH."./pricing.html' class='btn btn-success btn-lg  btn-large m-r-10'>".htmlentities($s["main_start_creating_app"], ENT_QUOTES, "UTF-8")."</a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class='section white'>
    <div class='container'>
      <div class='p-t-40 p-b-40'>
        <div class='row feature-list'>
          <div class='col-md-4 text-center'>
            <h4 class='custom-font title'>".htmlentities($s["main_businesses"], ENT_QUOTES, "UTF-8")."</h4>
            <h1 class='custom-font'><span class='number-animator' data-value='250' data-animation-duration='100'>0</span></h1>
          </div>
          <div class='col-md-4 text-center'>
            <h4 class='custom-font title'>".htmlentities($s["main_campaigns"], ENT_QUOTES, "UTF-8")."</h4>
            <h1 class='custom-font'><span class='number-animator' data-value='1500' data-animation-duration='100'>0</span></h1>
          </div>
          <div class='col-md-4 text-center'>
            <h4 class='custom-font title'>".htmlentities($s["main_loyal_customer"], ENT_QUOTES, "UTF-8")."</h4>
            <h1 class='custom-font'><span class='number-animator' data-value='15478' data-animation-duration='100'>0</span></h1>
          </div>
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
                      <div class='col-md-6 col-md-offset-2 no-padding  col-sm-6 col-sm-offset-2 col-xs-10 col-xs-offset-1'>
                        <input name='form3Occupation' id='form3Occupation' type='text' class='form-control' placeholder='".htmlentities($s["insert_email_or phone"], ENT_QUOTES, "UTF-8")."'>
                      </div>
            <div class='col-md-4 col-sm-4 col-xs-4 xs-p-l-10'>
            <button type='button' class='btn btn-primary btn-cons'>".htmlentities($s["send"], ENT_QUOTES, "UTF-8")."</button>
            </div>
            </div>
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
          <img src='".PATH."assets/img/royappty-logo.png' alt='' data-src='".PATH."assets/img/royappty-logo.png' data-src-retina='".PATH."assets/img/royappty-logo.png' height='44'/>
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
          ".htmlentities($s["follow_us_in_social_networks"], ENT_QUOTES, "UTF-8")."
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

  ";

   echo json_encode($response);
  debug_log("[server/ajax/campaigns/get_campaign] END");

?>
