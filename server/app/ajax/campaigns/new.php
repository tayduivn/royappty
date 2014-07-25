<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
<<<<<<< HEAD
	* Last Edit: 23-06-2014
	* Version: 0.91
	*
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d 00:00:00"));



=======
	* Last Edit: 14-07-2014
	* Version: 0.93
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	*
	*
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
>>>>>>> FETCH_HEAD
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/campaigns/new";
	debug_log("[".$page_path."] START");

	$response=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	include(PATH."functions/check_session.php");

<<<<<<< HEAD
 	$response=array();
=======

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/
>>>>>>> FETCH_HEAD

 	$response["result"]=true;

	$response["data"]["page-title"]="<a href='../../campaigns/'>".htmlentities($s["campaigns"], ENT_QUOTES, "UTF-8")."</a> / <span class='text-black'>".htmlentities($s["new_campaign"], ENT_QUOTES, "UTF-8")."</span>";
	$response["data"]["page-options"]="";

	$response["data"]["new-campaign-options"]="
		<h4 class='m-t-0'>
			".htmlentities($s["select_campaign_type"], ENT_QUOTES, "UTF-8")."
		</h4>
		<div class='row m-t-40'>
			<div class='col-md-6 text-center'>
				<a href='./discount/'>
					<img src='".$url_server."server/app/assets/img/campaign_types_direct.png'/>
				</a>
				<div class='m-t-20'>
					<a href='./discount/' class='btn btn-white'>".htmlentities($s["add_discount_promo"], ENT_QUOTES, "UTF-8")."</a>
				</div>
			</div>
			<div class='col-md-6 text-center'>
				<a href='./coupon/'>
					<img src='".$url_server."server/app/assets/img/campaign_types_coupon.png'/>
				</a>
				<div class='m-t-20'>
					<a href='./coupon/' class='btn btn-white'>".htmlentities($s["add_coupon_promo"], ENT_QUOTES, "UTF-8")."</a>
				</div>
			</div>
		</div>";
<<<<<<< HEAD

 	echo json_encode($response);
	debug_log("[server/ajax/campaigns/get_campaign] END");

=======


 	/*********************************************************
	* DATABASE REGISTRATION
	*********************************************************/



	/*********************************************************
	* AJAX CALL RETURN
	*********************************************************/

	debug_log("[".$page_path."] END");
	echo json_encode($response);
	die();

>>>>>>> FETCH_HEAD
?>
