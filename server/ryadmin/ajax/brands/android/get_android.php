<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 06-08-2014
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
	*	post_no_brand
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/
	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/ryadmin/ajax/brands/android/get_android";
	debug_log("[".$page_path."] START");

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

	// Data check START
	if(!@issetandnotempty($_POST["id_brand"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing id_brand");
		$response["error_code"]="post_no_brand";
		echo json_encode($response);
		die();
	}

 	$table="brands";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_POST["id_brand"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		error_log("[".$page_path."] ERROR Brand (id_brand=".$_POST["id_brand"].",id_admin=".$_POST["id_admin"].") doesn't exist");
		$response["error_code"]="post_no_brand";
 		echo json_encode($response);
 		die();
	}

 	// Data check END

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/
	$response["result"]=true;

 	$table="brands";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_POST["id_brand"]);
	$fields=array();
	$brand=getInBD($table,$filter,$fields);
	
	$table="apps";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_POST["id_brand"]);
	$fields=array();
	$app=getInBD($table,$filter,$fields);

 	$response=array();
 	$response["result"]=true;

	$response["data"]["page"]="
		<div class='content'>
			<div class='page-title'>
				<a href='../../brands'>".htmlentities($s["brands"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["generate_android_app"], ENT_QUOTES, "UTF-8")."
			</div>
			<div class='row'>
				<div class='col-md-12'>
					<div class='grid simple'>
						<div class='grid-body'>
							<div class='row'>
								<div class='col-md-12'>
									<h3>".htmlentities($s["generate_android_app"], ENT_QUOTES, "UTF-8")."</h3>
									<h4>".htmlentities($generate_android_app_steps[1]["title"], ENT_QUOTES, "UTF-8")."</h4>
									<p>".$generate_android_app_steps[1]["content"]."</p>
									<div class='box m-b-20'>
										<h6><b>Nombre del Proyecto:</b> ".htmlentities($app["project_codename"], ENT_QUOTES, "UTF-8")."</h6>
										<h6><b>ID del Proyecto:</b> ".htmlentities($app["android_project_id"], ENT_QUOTES, "UTF-8")."</h6>
									</div>
									<h4>".htmlentities($generate_android_app_steps[2]["title"], ENT_QUOTES, "UTF-8")."</h4>
									<p>".$generate_android_app_steps[2]["content"]."</p>
									<div class='box m-b-20'>
										<form id='android_project_number_form'>
											<h6 class='pull-left m-r-10'><b>".htmlentities($s["android_project_number"], ENT_QUOTES, "UTF-8")."</b></h6>
											<input type='text' id='android_project_number' name='android_project_number' value='".$brand["android_project_number"]."'>
											<input type='submit' class='btn btn-white' value='".$s["update"]."'>
										</form>
									</div>
									<h4>".htmlentities($generate_android_app_steps[3]["title"], ENT_QUOTES, "UTF-8")."</h4>
									<p>".$generate_android_app_steps[3]["content"]."</p>
									<div class='box m-b-20'>
										<h6><b>".htmlentities($s["server_ip"], ENT_QUOTES, "UTF-8")." </b> ".$_SERVER['SERVER_ADDR']."</h6>
										<form id='android_server_key_form'>
											<h6 class='pull-left m-r-10'><b>".htmlentities($s["android_server_key"], ENT_QUOTES, "UTF-8")."</b></h6>
											<input type='text' id='android_server_key' name='android_server_key' value='".$brand["android_server_key"]."'>
											<input type='submit' class='btn btn-white' value='".$s["update"]."'>
										</form>
									</div>
									<h4>".htmlentities($generate_android_app_steps[4]["title"], ENT_QUOTES, "UTF-8")."</h4>
									<p>".$generate_android_app_steps[4]["content"]."</p>

									<div class='box m-b-20'>
										<div class='terminal-box m-t-20 m-b-20' id='generate_android_app_terminal'>
										</div>
										<a href='javascript:generate_android_app();' class='btn btn-white'>".htmlentities($s["generate_android_app"], ENT_QUOTES, "UTF-8")."</a>
										<a href='".$url_server."server/ryadmin/mobile_apps/".$app["project_codename"]."-debug.apk' class='btn btn-white'>".htmlentities($s["download_android_app"], ENT_QUOTES, "UTF-8")."</a>

									</div>
									<p class='text-center'>
										<a href='../?id_brand=".$_POST["id_brand"]."' class='btn btn-white'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
									</p>
								</div>
							</div>
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
