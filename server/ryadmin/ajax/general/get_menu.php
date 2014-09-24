<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 20-08-2014
	* Version: 0.94
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	* db_connection_error
	* no_ryadmin
	* ryadmin_not_valid
	* ryadmin_inactive
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
	$page_path="server/ryadmin/ajax/general/get_menu";
	debug_log("[".$page_path."] START");

 	$response=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// SYSTEM CLOSED
	if(!checkClosed()){echo json_encode($response);die();}

	// BD CONNECTION
	if(!checkBDConnection()){echo json_encode($response);die();}

	// RYADMIN
	$ryadmin=array();$ryadmin["id_ryadmin"]=$_SESSION["ryadmin"]["id_ryadmin"];
	if(!checkRyadmin($ryadmin)){echo json_encode($response);die();}

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

 	$response["data"]["header-menu"]="
 		<div class='navbar-inner'>
 			<div class='header-seperation'>
				<a href='".$_POST["path"]."'><img src='".$url_server."server/ryadmin/assets/img/royappty-logo-white.png' class='logo' alt=''  data-src='".$url_server."server/ryadmin/assets/img/royappty-logo-white.png' data-src-retina='".$url_server."server/ryadmin/assets/img/royappty-logo-white.png' height='30'/></a>
			</div>
			<div class='header-quick-nav' >
				<div class='pull-left'>
					<h3 class='m-t-10 m-l-10'>".htmlentities($s["ryadmin_login"], ENT_QUOTES, "UTF-8")."</h3>
				</div>
				<div class='pull-right'>
 					<ul class='nav quick-section '>
 						<li class='quicklinks'>
 							<a data-toggle='dropdown' class='dropdown-toggle  pull-right btn btn-white' href='../#' id='user-options'><div class='' style='font-size:12px'><i class='fa fa-bars'></i></div></a>
 							<ul class='dropdown-menu  pull-right' role='menu' aria-labelledby='user-options'>
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
		<li class=''> <a href='javascript:;'> <i class='fa fa-bullhorn'></i> <span class='title'>".htmlentities($s["brands"], ENT_QUOTES, "UTF-8")."</span> <span class='arrow '></span> </a>
			<ul class='sub-menu'>
				<li > <a href='".$_POST["path"]."brands/'> ".htmlentities($s["all_brands"], ENT_QUOTES, "UTF-8")." </a> </li>
				<li > <a href='".$_POST["path"]."brand/new/'>".htmlentities($s["new_brand"], ENT_QUOTES, "UTF-8")."</a> </li>
			</ul>
		</li>
		<li class=''> <a href='javascript:;'> <i class='fa fa-envelope-o'></i> <span class='title'>".htmlentities($s["requests"], ENT_QUOTES, "UTF-8")."</span> <span class='arrow '></span> </a>
			<ul class='sub-menu'>
				<li > <a href='".$_POST["path"]."requests/'> ".htmlentities($s["all_requests"], ENT_QUOTES, "UTF-8")." </a> </li>
				<li > <a href='".$_POST["path"]."request/new/'>".htmlentities($s["new_request"], ENT_QUOTES, "UTF-8")."</a> </li>
			</ul>
		</li>
		<li> <a href='javascript:;'> <i class='fa fa-file-text-o'></i> <span class='title'>".htmlentities($s["bills"], ENT_QUOTES, "UTF-8")."</span> <span class='arrow '></span> </a>
			<ul class='sub-menu'>
				<li > <a href='".$_POST["path"]."bills/'>".htmlentities($s["all_bills"], ENT_QUOTES, "UTF-8")."</a> </li>
				<li > <a href='".$_POST["path"]."bills/new/'>".htmlentities($s["new_bill"], ENT_QUOTES, "UTF-8")."</a> </li>
			</ul>
		</li>
		<li> <a href='javascript:;'> <i class='fa fa-users'></i> <span class='title'>".htmlentities($s["ryadmins"], ENT_QUOTES, "UTF-8")."</span> <span class='arrow '></span> </a>
			<ul class='sub-menu'>
				<li > <a href='".$_POST["path"]."ryadmins/'>".htmlentities($s["all_ryadmins"], ENT_QUOTES, "UTF-8")."</a> </li>
				<li > <a href='".$_POST["path"]."ryadmin/new/'>".htmlentities($s["new_ryadmin"], ENT_QUOTES, "UTF-8")."</a> </li>
			</ul>
		</li>
		<li class=''> <a href='javascript:;'> <i class='fa fa-cogs'></i> <span class='title'>".htmlentities($s["settings"], ENT_QUOTES, "UTF-8")."</span> <span class='arrow '></span> </a>
			<ul class='sub-menu'>
				<li > <a href='".$_POST["path"]."requests/'>".htmlentities($s["server"], ENT_QUOTES, "UTF-8")."</a> </li>
				<li > <a href='".$_POST["path"]."server/'>".htmlentities($s["my_account"], ENT_QUOTES, "UTF-8")."</a> </li>
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
