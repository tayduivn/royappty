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
	$page_path="server/ryadmin/ajax/brands/ios/get_ios";
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
				<a href='../../brands'>".htmlentities($s["brands"], ENT_QUOTES, "UTF-8")."</a> / <a href='../../brand/?id_brand=".$brand["id_brand"]."'>".htmlentities($brand["name"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["generate_iphone_app"], ENT_QUOTES, "UTF-8")."
			</div>
			<div class='row'>
				<div class='col-md-12'>
					<div class='grid simple'>
						<div class='grid-body'>
							<div class='row'>
								<div class='col-md-12'>
									<h3>".htmlentities($s["generate_iphone_app"], ENT_QUOTES, "UTF-8")."</h3>
									<h4>".htmlentities($generate_ios_app_steps[1]["title"], ENT_QUOTES, "UTF-8")."</h4>
									<p>".$generate_ios_app_steps[1]["content"]."</p>
									<div class='box m-b-20'>
										<h6><b>".htmlentities($s["project_id"], ENT_QUOTES, "UTF-8").":</b> ".htmlentities($app["project_id"], ENT_QUOTES, "UTF-8")."</h6>
										<h6><b>".htmlentities($s["package_address"], ENT_QUOTES, "UTF-8").":</b> ".htmlentities($app["package_address"], ENT_QUOTES, "UTF-8")."</h6>
									</div>
									<h4>".htmlentities($generate_ios_app_steps[2]["title"], ENT_QUOTES, "UTF-8")."</h4>
									<p>".$generate_ios_app_steps[2]["content"]."</p>
									<h4>".htmlentities($generate_ios_app_steps[3]["title"], ENT_QUOTES, "UTF-8")."</h4>
									<p>".$generate_ios_app_steps[3]["content"]."</p>
									<h4>".htmlentities($generate_ios_app_steps[4]["title"], ENT_QUOTES, "UTF-8")."</h4>
									<p>".$generate_ios_app_steps[4]["content"]."</p>
									<h4>".htmlentities($generate_ios_app_steps[5]["title"], ENT_QUOTES, "UTF-8")."</h4>
									<p>".$generate_ios_app_steps[5]["content"]."</p>
									<div class='box m-b-20'>

										<div class='terminal-box m-t-20 m-b-20' id='generate_ios_app_terminal'>
										</div>
										<div id='generate_ios_app_terminal_bar' class='progress progress-striped active progress-large'>
											<div style='width: 0%;'  class='progress-bar progress-bar-success' role='progressbar' aria-valuemin='0' aria-valuemax='100'></div>
											<p id='text-success' class='text-success'>".htmlentities($s["completed"], ENT_QUOTES, "UTF-8")."</p>
										</div>
										<a href='javascript:generate_ios_app();' class='btn btn-white'>".htmlentities($s["generate_iphone_app"], ENT_QUOTES, "UTF-8")."</a>
										<a href='".$url_server."server/resources/mobile-app/".$app["project_codename"]."/".$app["project_codename"]."-ios.tar.gz' class='btn btn-white'>".htmlentities($s["download_ios_app"], ENT_QUOTES, "UTF-8")."</a>

									</div>
									<h4>".htmlentities($generate_ios_app_steps[6]["title"], ENT_QUOTES, "UTF-8")."</h4>
									<p>".$generate_ios_app_steps[6]["content"]."</p>
									<h4>".htmlentities($generate_ios_app_steps[7]["title"], ENT_QUOTES, "UTF-8")."</h4>
									<p>".$generate_ios_app_steps[7]["content"]."</p>
									<div class='terminal-box m-t-20 m-b-20' style='height:100px'>
										".$generate_ios_app_steps[7]["commands"]."

									</div>
									<h4>".htmlentities($generate_ios_app_steps[8]["title"], ENT_QUOTES, "UTF-8")."</h4>
									<p>".$generate_ios_app_steps[8]["content"]."</p>
									<div id='result_box' style='display:none' class='box box-success-muted result_box m-b-10'>

									</div>
									<input type='file' id='xfile' value='default' class='droparea spot' name='xfile' data-post='".$url_server."server/ryadmin/ajax/brands/ios/upload-certificate.php?project_codename=".$app["project_codename"]."&id_result_box=result_box' />

									<div>

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
