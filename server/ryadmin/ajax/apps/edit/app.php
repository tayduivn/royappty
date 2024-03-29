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

	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/apps/edit/app";
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

	$table="apps";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$app=getInBD($table,$filter);


	$response["data"]["page-title"]="<a href='../'>".htmlentities($s["my_app"], ENT_QUOTES, "UTF-8")."</a> / <a href='#'>".htmlentities($s["edit_app"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($app["name"], ENT_QUOTES, "UTF-8");
	$response["data"]["page-options"]="";

	$response["data"]["new-discount-step-1"]="
			<h4 class='m-t-0'>".htmlentities($app_s["step_1_title"], ENT_QUOTES, "UTF-8")." <span class='pull-right text-muted'>".htmlentities($s["step_"], ENT_QUOTES, "UTF-8")." 1 ".htmlentities($s["_of"], ENT_QUOTES, "UTF-8")." 4</span></h4>
			<form id='form-step1'>
				<div id='form-warning'></div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($app_s["app_name"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($app_s["app_name_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='name' name='name' class='form-control' value='".htmlentities($app["name"], ENT_QUOTES, "UTF-8")."'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($app_s["description"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($app_s["description_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<textarea class='form-control' rows=4 id='description' name='description'>".$app["description"]."</textarea>
					</div>
				</div>
				<div style='overflow:auto'>
					<div class='form-group'>
							<input type='submit' class='btn btn-white pull-right' value='".htmlentities($s["next"], ENT_QUOTES, "UTF-8")."' />
						<a id='prev_step' href='../' class='btn btn-white pull-left'>".htmlentities($s["previous"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>
			</form>
						";
	$response["data"]["new-discount-step-2"]="
		<h4 class='m-t-0'>".htmlentities($app_s["step_2_title"], ENT_QUOTES, "UTF-8")."<span class='pull-right text-muted'>".htmlentities($s["step_"], ENT_QUOTES, "UTF-8")." 2 ".htmlentities($s["_of"], ENT_QUOTES, "UTF-8")." 4</span></h4>
		<form id='form-step2'>
		<div id='form-warning'></div>
			<div class='row'>
				<div class='col-md-8'>
					<div class='form-group'>
						<label class='form-label'>".htmlentities($app_s["icon"], ENT_QUOTES, "UTF-8")."</label>
						<span class='help'>".htmlentities($app_s["icon_help"], ENT_QUOTES, "UTF-8")."</span>
						<div class='controls'>
							<input type='file' id='xfile' value='default' class='droparea spot' name='xfile' data-post='".$url_server."server/app/ajax/apps/upload-image.php?type=icon&width=500&height=500&crop=1&label=app_icon_path' />
						</div>
					</div>
				</div>
				<div class='col-md-4'>
					<div class='grid simple'>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($app_s["icon_preview"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'></span>
							<div class='controls'>
								<img id='app_icon_path-preview' class='full-width' src='".$url_server."resources/app-icon/".$app["app_icon_path"]."'/>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div style='overflow:auto'>
			<div class='form-group'>
				<input type='submit' class='btn btn-white pull-right' value='".htmlentities($s["next"], ENT_QUOTES, "UTF-8")."' />
					<a href='javascript:prevstep()' class='btn btn-white pull-left'>".htmlentities($s["previous"], ENT_QUOTES, "UTF-8")."</a>
				</div>
			</div>
		</form>
	";
	$response["data"]["new-discount-step-3"]="
		<h4 class='m-t-0'>".htmlentities($app_s["step_3_title"], ENT_QUOTES, "UTF-8")."<span class='pull-right text-muted'>".htmlentities($s["step_"], ENT_QUOTES, "UTF-8")." 3 ".htmlentities($s["_of"], ENT_QUOTES, "UTF-8")." 4</span></h4>
		<form id='form-step3'>
		<div id='form-warning'></div>
			<div class='row'>
				<div class='col-md-8'>
					<div class='form-group'>
						<label class='form-label'>".htmlentities($app_s["app_bg"], ENT_QUOTES, "UTF-8")."</label>
						<span class='help'>".htmlentities($app_s["app_bg_help"], ENT_QUOTES, "UTF-8")."</span>
						<div class='controls'>
							<input type='file' id='xfile' value='default' class='droparea spot' name='xfile' data-post='".$url_server."server/app/ajax/apps/upload-image.php?type=icon&width=500&height=500&crop=1&label=app_bg_path' />
						</div>
					</div>
				</div>
				<div class='col-md-4'>
					<div class='grid simple'>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($app_s["icon_preview"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'></span>
							<div class='controls'>
								<img id='app_bg_path-preview' class='full-width' src='".$url_server."resources/app-bg/".$app["app_bg_path"]."'/>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div style='overflow:auto'>
			<div class='form-group'>
				<input type='submit' class='btn btn-white pull-right' value='".htmlentities($s["next"], ENT_QUOTES, "UTF-8")."' />
					<a href='javascript:prevstep()' class='btn btn-white pull-left'>".htmlentities($s["previous"], ENT_QUOTES, "UTF-8")."</a>
				</div>
			</div>
		</form>
	";


	$response["data"]["new-discount-step-4"]="
		<h4 class='m-t-0'>".htmlentities($app_s["step_4_title"], ENT_QUOTES, "UTF-8")."<span class='pull-right text-muted'>".htmlentities($s["step_"], ENT_QUOTES, "UTF-8")." 4 ".htmlentities($s["_of"], ENT_QUOTES, "UTF-8")." 4</span></h4>
		<form id='form-step4'>
			<div id='form-warning'></div>
			<div class='row'>
				<div class='col-md-12'>
					<div class='form-group'>
						<label class='form-label'>".htmlentities($app_s["publish_plataforms"], ENT_QUOTES, "UTF-8")."</label>
						<span class='help'>".htmlentities($app_s["publish_plataforms_help"], ENT_QUOTES, "UTF-8")."</span>
						<div class='m-t-10'>
							<div class='row-fluid'>
								<div class='checkbox check-default'>
									<input id='published_apple_store' class='user_checkbox' type='checkbox' ";
	if($app["published_apple_store"]==1){
		$response["data"]["new-discount-step-4"].="checked";
	}
	$response["data"]["new-discount-step-4"].=" >
									<label for='published_apple_store' class='p-l-30'>".htmlentities($app_s["publish_in_app_store"], ENT_QUOTES, "UTF-8")."</label>
								</div>
							</div>
							<div class='row-fluid'>
								<div class='checkbox check-default'>
									<input id='published_google_play' class='user_checkbox' type='checkbox' ";
	if($app["published_google_play"]==1){
		$response["data"]["new-discount-step-4"].="checked";
	}
	$response["data"]["new-discount-step-4"].=" >
									<label for='published_google_play' class='p-l-30'>".htmlentities($app_s["publish_in_google_play"], ENT_QUOTES, "UTF-8")."</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class='row'>
				<div class='col-md-12'>
					<div class='form-group'>
						<label class='form-label'>".htmlentities($app_s["user_fields"], ENT_QUOTES, "UTF-8")."</label>
						<span class='help'>".htmlentities($app_s["user_fields_help"], ENT_QUOTES, "UTF-8")."</span>
						<div id='user_fields_alert'></div>
						<div class='m-t-10'>";
	$table="user_fields";
	$user_fields=listInBD($table);
	$table="brand_user_fields";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$brand_user_fields=listInBD($table,$filter);
	$app["brand_user_fields"]="";
	$coma="";
	foreach($user_fields as $key=>$user_field){

		$is_in_list=false;
		foreach ($brand_user_fields as $key=>$brand_user_field){
			if($user_field["id_user_field"]==$brand_user_field["id_user_field"]){
				$is_in_list=true;
				$app["brand_user_fields"]=$coma.$user_field["id_user_field"];
				$coma="::";
			}
		}
		$response["data"]["new-discount-step-4"].="
							<div class='row-fluid'>
								<div class='checkbox check-default'>
									<input id='".$user_field["id_user_field"]."' class='user_field_checkbox' name='user_field_checkbox_".$user_field["id_user_field"]."' type='checkbox' ";
		if($is_in_list){
			$response["data"]["new-discount-step-4"].="checked";
		}
		$response["data"]["new-discount-step-4"].=" >
									<label for='".$user_field["id_user_field"]."' class='p-l-30'>".htmlentities($user_field_title_s[$user_field["title"]], ENT_QUOTES, "UTF-8")."</label>
								</div>
							</div>";
	}
	$response["data"]["new-discount-step-4"].="
						</div>
					</div>
				</div>
			</div>
			<div style='overflow:auto'>
				<div class='form-group'>
					<input type='submit' class='btn btn-white pull-right' value='".htmlentities($s["next"], ENT_QUOTES, "UTF-8")."' />
					<a href='javascript:prevstep()' class='btn btn-white pull-left'>".htmlentities($s["previous"], ENT_QUOTES, "UTF-8")."</a>
				</div>
			</div>
		</form>

	";
	$response["data"]["new-discount-step-end"]="
		<form id='form-end'>
			<input type='hidden' id='name' value='".$app["name"]."'/>
			<input type='hidden' id='description' value='".$app["description"]."'/>
			<input type='hidden' id='app_icon_path' value=''/>
			<input type='hidden' id='app_bg_path' value=''/>
			<input type='hidden' id='published_apple_store' value='".$app["published_apple_store"]."'/>
			<input type='hidden' id='published_google_play' value='".$app["published_google_play"]."'/>
			<input type='hidden' id='brand_user_fields' value='".$app["brand_user_fields"]."'/>
		</form>
	";
	$response["data"]["new-discount-step-loading"]="
		<div class='text-center'>
			<div class='loader-activity'></div>
			<h3>".htmlentities($s["loading..."], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["this_may_take_several_seconds"], ENT_QUOTES, "UTF-8")."</div>
		</div>
	";
	$response["data"]["new-discount-step-error"]="
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-times'></i></h1>
			<h3 class='text-center'>".htmlentities($s["error"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["there_was_an_error_please_try_later"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='../../my-app/' class='btn btn-white'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
			</div>
		</div>
	";
	$response["data"]["new-discount-step-success"]="
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-check'></i></h1>
			<h3 class='text-center'>".htmlentities($app_s["success_title"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($app_s["success_subtitle_1"], ENT_QUOTES, "UTF-8")." <a class='text-success' href='../../requests/'>".htmlentities($s["request_list"], ENT_QUOTES, "UTF-8")."</a> ".htmlentities($app_s["success_subtitle_2"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='../' class='btn btn-white m-r-10'>".htmlentities($s["my_app"], ENT_QUOTES, "UTF-8")."</a>
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
