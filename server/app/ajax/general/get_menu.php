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
	* post_no_path
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));

	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/general/get_menu";
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

	// POST
	if(!@issetandnotempty($_POST["path"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing path");
		$response["error_code"]="post_no_path";
		echo json_encode($response);
		die();
	}

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

 	$response["result"]=true;

 	$table="brands";
 	$filter=array();
 	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
 	$brand=getInBD($table,$filter);

	$table="apps";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$app=getInBD($table,$filter);

 	$response["data"]["header-menu"]="
 		<div class='navbar-inner'>
 			<div class='header-seperation'>
				<a href='".$_POST["path"]."'><img src='".$url_server."server/app/assets/img/royappty-logo-white.png' class='logo' alt=''  data-src='".$url_server."server/app/assets/img/royappty-logo-white.png' data-src-retina='".$url_server."server/app/assets/img/royappty-logo-white.png' height='30'/></a>
			</div>
			<div class='header-quick-nav' >
				<div class='pull-left'>
					<h3 class='m-t-10 m-l-10'>".$brand["name"]."</h3>
				</div>
				<div class='pull-right'>
 					<ul class='nav quick-section '>
 						<li class='quicklinks'>
 							<a data-toggle='dropdown' class='dropdown-toggle  pull-right btn btn-white' href='../#' id='user-options'><div class='' style='font-size:12px'><i class='fa fa-bars'></i></div></a>
 							<ul class='dropdown-menu  pull-right' role='menu' aria-labelledby='user-options'>
								<li><a href='".$_POST["path"]."my-app/'> ".htmlentities($s["my_app"], ENT_QUOTES, "UTF-8")."</a></li>
								<li><a href='".$_POST["path"]."my-account/'> ".htmlentities($s["my_account"], ENT_QUOTES, "UTF-8")."</a></li>
							 	<li class='divider'></li>
 								<li><a href='javascript:logout()'>".htmlentities($s["logout"], ENT_QUOTES, "UTF-8")."</a></li>
 							</ul>
 						</li>
 					</ul>
 				</div>
 			</div>
 		</div>";

 	$response["data"]["left-menu"]="
 		<ul>
		<li class=''> <a href='".$_POST["path"]."'> <i class='icon-custom-home'></i> <span class='title'>".htmlentities($s["dashboard"], ENT_QUOTES, "UTF-8")."</span> <span class='selected'></span></a> </li>
		<li class=''> <a href='javascript:;'> <i class='fa fa-bullhorn'></i> <span class='title'>".htmlentities($s["campaigns"], ENT_QUOTES, "UTF-8")."</span> <span class='arrow '></span> </a>
			<ul class='sub-menu'>
				<li > <a href='".$_POST["path"]."campaigns/'> ".htmlentities($s["all_campaigns"], ENT_QUOTES, "UTF-8")." </a> </li>
				<li > <a href='".$_POST["path"]."campaign/new/'>".htmlentities($s["new_campaign"], ENT_QUOTES, "UTF-8")."</a> </li>
			</ul>
		</li>
		<li class=''> <a href='javascript:;'> <i class='fa fa-bell-o'></i> <span class='title'>".htmlentities($s["notifications"], ENT_QUOTES, "UTF-8")."</span> <span class='arrow '></span> </a>
			<ul class='sub-menu'>
				<li > <a href='".$_POST["path"]."notifications/'> ".htmlentities($s["sended_notifications"], ENT_QUOTES, "UTF-8")." </a> </li>
				<li > <a href='".$_POST["path"]."notification/new/'>".htmlentities($s["new_notification"], ENT_QUOTES, "UTF-8")."</a> </li>
			</ul>
		</li>
		<li> <a href='javascript:;'> <i class='fa fa-sitemap'></i> <span class='title'>".htmlentities($s["admins"], ENT_QUOTES, "UTF-8")."</span> <span class='arrow '></span> </a>
			<ul class='sub-menu'>
				<li > <a href='".$_POST["path"]."admins/'>".htmlentities($s["all_admins"], ENT_QUOTES, "UTF-8")."</a> </li>
				<li > <a href='".$_POST["path"]."admin/new/'>".htmlentities($s["new_admin"], ENT_QUOTES, "UTF-8")."</a> </li>
			</ul>
		</li>
		<li> <a href='javascript:;'> <i class='fa fa-users'></i> <span class='title'>".htmlentities($s["users"], ENT_QUOTES, "UTF-8")."</span> <span class='arrow '></span> </a>
			<ul class='sub-menu'>
				<li > <a href='".$_POST["path"]."users/'>".htmlentities($s["all_users"], ENT_QUOTES, "UTF-8")."</a> </li>";

	if(($brand["subscription_type"]=="professional")||($brand["subscription_type"]=="unlimited")){
		$response["data"]["left-menu"].="
				<li > <a href='".$_POST["path"]."groups/'>".htmlentities($s["all_groups"], ENT_QUOTES, "UTF-8")."</a> </li>
				<li > <a href='".$_POST["path"]."group/new/'>".htmlentities($s["new_group"], ENT_QUOTES, "UTF-8")."</a> </li>";
	}else{
		$response["data"]["left-menu"].="
				<li class='disabled'> <a href='javascript:error_handler(\"need_subscription_professional\")'>".htmlentities($s["all_groups"], ENT_QUOTES, "UTF-8")."</a> </li>
				<li class='disabled'> <a href='javascript:error_handler(\"need_subscription_professional\")'>".htmlentities($s["new_group"], ENT_QUOTES, "UTF-8")."</a> </li>";

	}

	$response["data"]["left-menu"].="

			</ul>
		</li>
		<li class=''> <a href='javascript:;'> <i class='fa fa-cogs'></i> <span class='title'>".htmlentities($s["settings"], ENT_QUOTES, "UTF-8")."</span> <span class='arrow '></span> </a>
			<ul class='sub-menu'>
				<li > <a href='".$_POST["path"]."my-app/'>".htmlentities($s["my_app"], ENT_QUOTES, "UTF-8")."</a> </li>
				<li > <a href='".$_POST["path"]."requests/'>".htmlentities($s["all_requests"], ENT_QUOTES, "UTF-8")."</a> </li>
				<li > <a href='".$_POST["path"]."my-account/'>".htmlentities($s["my_account"], ENT_QUOTES, "UTF-8")."</a> </li>
			</ul>
		</li>
	</ul>";

	$response["data"]["modal-ajax-error-title"]="<i class='fa fa-times'></i> ".htmlentities($s["error"], ENT_QUOTES, "UTF-8");
	$response["data"]["modal-ajax-error-msg-1"]=htmlentities($s["ajax_error_1"], ENT_QUOTES, "UTF-8");
	$response["data"]["modal-ajax-error-msg-2"]=htmlentities($s["ajax_error_2"], ENT_QUOTES, "UTF-8");
	$response["data"]["modal-ajax-error-button"]="<button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>";

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
