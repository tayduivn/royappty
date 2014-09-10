<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 21-07-2014
	* Version: 0.93
	*
	*********************************************************/

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
	$page_path="server/app/ajax/apps/get_app";
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


 	// Data check START

 	$table="apps";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		error_log("[".$page_path."] ERROR App (id_brand=".$_SESSION["admin"]["id_brand"].",id_app=".$_POST["id_app"].") doesn't exist");
 		$response["error"]="ERROR App doesn't exist";
 		echo json_encode($response);
 		die();
	}

 	// Data check END

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$response["result"]=true;

 	$table="apps";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$app=getInBD($table,$filter);

	$request_waiting=false;
	$table="requests";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$filter["type"]=array("operation"=>"=","value"=>"app_update");
	$filter["status"]=array("operation"=>"=","value"=>"in_process");
	if(isInBD($table,$filter)){
		$request_waiting=true;
	}
	$response["data"]["modals"]="

	";

	$response["data"]["page-title"]="<a href='#'>".htmlentities($s["my_app"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($app["name"], ENT_QUOTES, "UTF-8")."<a href='./edit/' class='m-l-10 pull-right m-t--3 btn btn-white btn-mini pull-right'>".htmlentities($s["edit_app"], ENT_QUOTES, "UTF-8")."</a>";
	$response["data"]["page-options"]="";

	$response["data"]["app-data"]="
		<div class='col-md-12'>";
	if($request_waiting){
		$response["data"]["app-data"].="
			<div class='box box-warning m-b-10'>
				<h5 class='text-warning'>".$s["there_is_request_to_update_the_app"]."</h5>
			</div>
		";

	}
	$response["data"]["app-data"].="
			<div class='m-b-20'>
				<h4 class='m-t-0'>".htmlentities($s["app_name_description_and_sreenshots"], ENT_QUOTES, "UTF-8")."</h4>
				<h5 class=''>".htmlentities($s["name_and_description"], ENT_QUOTES, "UTF-8")."</h5>
				<p class='text-success'>".htmlentities($app["name"], ENT_QUOTES, "UTF-8")."</p>
				<p class='text-success'>".htmlentities($app["description"], ENT_QUOTES, "UTF-8")."</p>
				<h5 class=''>".htmlentities($s["screenshots"], ENT_QUOTES, "UTF-8")."</h5>
				<p>".htmlentities($s["app_name_description_and_sreenshots_help_1"], ENT_QUOTES, "UTF-8")." <a class='text-success' href='../requests/'>".htmlentities($s["request_list"], ENT_QUOTES, "UTF-8")."</a> ".htmlentities($s["app_name_description_and_sreenshots_help_2"], ENT_QUOTES, "UTF-8")."</p>
				<a class='btn btn-white' href='./edit/'>".htmlentities($s["edit_app"], ENT_QUOTES, "UTF-8")."</a>
			</div>
			<div class='m-b-20'>
				<h4 class='m-t-0'>".htmlentities($s["user_fields"], ENT_QUOTES, "UTF-8")."</h4>";
	$table="brand_user_fields";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	if(isInBD($table,$filter)){
		$brand_user_fields=listInBD($table,$filter);
		foreach($brand_user_fields as $key=>$brand_user_field){
			$table="user_fields";
			$filter=array();
			$filter["id_user_field"]=array("operation"=>"=","value"=>$brand_user_field["id_user_field"]);
			$user_field=getInBD($table,$filter);
			$response["data"]["app-data"].="
			<h5 class='m-l-20'><i class='fa fa-check'></i> ".htmlentities($user_field_title_s[$user_field["title"]], ENT_QUOTES, "UTF-8")."</h3>
			";
		}

	}else{
		$response["data"]["app-data"].="<p>".htmlentities($s["no_user_fields"], ENT_QUOTES, "UTF-8")."</p>";
	}

	$response["data"]["app-data"].="
				<a class='btn btn-white' href='./edit/'>".htmlentities($s["edit_app"], ENT_QUOTES, "UTF-8")."</a>
			</div>
			<div class='m-b-20'>
				<h4 class='m-t-0'>".htmlentities($s["app_icon"], ENT_QUOTES, "UTF-8")."</h4>
				<div class='row'>
					<div class='col-md-2'>
						<img class='full-width' src='".$url_server."server/resources/mobile-app/".$app["project_codename"]."/app_icon.png'/>
					</div>
					<div class='col-md-10'>
						<p>".htmlentities($s["app_icon_help_1"], ENT_QUOTES, "UTF-8")." <a class='text-success' href='../requests/'>".htmlentities($s["request_list"], ENT_QUOTES, "UTF-8")."</a> ".htmlentities($s["app_icon_help_1"], ENT_QUOTES, "UTF-8")."</p>
						<a class='btn btn-white' href='./edit/'>".htmlentities($s["edit_app"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>
			</div>
			<div class='m-b-20'>
				<h4 class='m-t-0'>".htmlentities($s["app_bg"], ENT_QUOTES, "UTF-8")."</h4>
				<div class='row'>
					<div class='col-md-2'>
						<img class='full-width' src='".$url_server."server/resources/mobile-app/".$app["project_codename"]."/app_bg.jpg'/>
					</div>
					<div class='col-md-10'>
					<p>".htmlentities($s["app_bg_help_1"], ENT_QUOTES, "UTF-8")." <a class='text-success' href='../requests/'>".htmlentities($s["request_list"], ENT_QUOTES, "UTF-8")."</a> ".htmlentities($s["app_bg_help_2"], ENT_QUOTES, "UTF-8")."</p>
							<a class='btn btn-white' href='./edit/'>".htmlentities($s["edit_app"], ENT_QUOTES, "UTF-8")."</a>
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
