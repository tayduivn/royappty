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
	* no_brand
	* brand_not_valid
	*	no_admin
	* admin_not_valid
	* admin_inactive
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/campaigns/new";
	debug_log("[".$page_path."] START");

	$response=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// SYSTEM CLOSED
if(!checkClosed()){echo json_encode($response);die();}

// BD CONNECTION
	if(!checkBDConnection()){echo json_encode($response);die();}

	// BRAND
	$brand=array();$brand["id_brand"]=$_SESSION["admin"]["id_brand"];
	if(!checkBrand($brand)){echo json_encode($response);die();}

	// ADMIN
	$admin=array();$admin["id_admin"]=$_SESSION["admin"]["id_admin"];
	if(!checkAdmin($admin)){echo json_encode($response);die();}


	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

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
