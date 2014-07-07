<?php
	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d 00:00:00"));



	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/apps/get_app";
	debug_log("[".$page_path."] START");
	include(PATH."functions/check_session.php");

 	$response=array();


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

	$response["result"]=true;


 	$table="apps";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$app=getInBD($table,$filter);

	$response["data"]["modals"]="

	";

	$response["data"]["page-title"]="<a href='#'>".htmlentities($s["my_app"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($app["name"], ENT_QUOTES, "UTF-8")."<a href='./edit/' class='m-l-10 pull-right m-t--3 btn btn-white btn-mini pull-right'>".htmlentities($s["edit_app"], ENT_QUOTES, "UTF-8")."</a>";
	$response["data"]["page-options"]="";


	$response["data"]["app-data"]="
		<div class='col-md-12'>
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
						<img class='full-width' src='".$url_server."resources/app-icon/".$app["app_icon_path"]."'/>
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
						<img class='full-width' src='".$url_server."resources/app-bg/".$app["app_bg_path"]."'/>
					</div>
					<div class='col-md-10'>
					<p>".htmlentities($s["app_bg_help_1"], ENT_QUOTES, "UTF-8")." <a class='text-success' href='../requests/'>".htmlentities($s["request_list"], ENT_QUOTES, "UTF-8")."</a> ".htmlentities($s["app_bg_help_2"], ENT_QUOTES, "UTF-8")."</p>
							<a class='btn btn-white' href='./edit/'>".htmlentities($s["edit_app"], ENT_QUOTES, "UTF-8")."</a>
				</div>
			</div>
		</div>";







 	echo json_encode($response);
	debug_log("[server/ajax/apps/get_app] END");

?>
