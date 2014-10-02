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
	*	- no_brand
	*	- brand_not_valid
	*	- no_user
	*	- user_not_valid
	*	- user_inactive
	*
	*********************************************************/


	/*********************************************************
 	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
 	*********************************************************/
  define('PATH', str_replace('\\', '/','../../'));
  @session_start();
  $timestamp=strtotime(date("Y-m-d H:i:00"));
  include(PATH."include/inbd.php");
	$page_path = "server/mobile/ajax/campaigns/all_data";
 	debug_log("[".$page_path."] START");
 	$response=array();


 	/*********************************************************
 	* DATA CHECK
 	*********************************************************/

 	// BRAND
 	$brand=array();$brand["id_brand"]=$_SESSION["user"]["id_brand"];
	if(!checkBrand($brand)){echo "jsonCallback(".json_encode($response).")";die();}
 	// USER
 	$user=array();$user["id_user"]=$_SESSION["user"]["id_user"];
	if(!checkUser($user)){echo "jsonCallback(".json_encode($response).")";die();}

  $table="apps";
  $filter=array();
  $filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["user"]["id_brand"]);
  $app=getInBD($table,$filter);

  $table="campaigns";
  $filter=array();
  $filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["user"]["id_brand"]);
  $filter["status"]=array("operation"=>"=","value"=>1);
  $fields=array();
  if(!isInBD($table,$filter,$fields)){
  	debug_log("[".$page_path."] No campaigns to show");
	$img_file = PATH."../../server/resources/mobile-app/".$app["project_codename"]."/app_bg.png";
    $imgData = base64_encode(file_get_contents($img_file));
    $src = 'data: '.mime_content_type($img_file).';base64,'.$imgData;

    $response["result"]=true;


    $response["data"]["page"].="
       <div class='page center_mobile_page' id='index'>
         <img class='full-width full-height' src='".$src."'/>
       </div>
     ";
     echo "jsonCallback(".json_encode($response).")";
     die();
  }

 	/*********************************************************
 	* AJAX OPERATIONS
 	*********************************************************/


	$response["result"]=true;



	$response["data"]["page"]="";

	$table='users';
	$filter=array();
	$filter["id_user"]=array("operation"=>"=","value"=>$_SESSION["user"]["id_user"]);
	$user=getInBD($table,$filter);

    if($user["platform"]=="ios"){
	    $response["data"]["page"].="
	    <style type='text/css'>
	    	.header .navbar-inner {
			  padding-top:10px !important;
			}
			.navbar-inner td.text-left{
				padding-top:14px !important;
			}
			.navbar-inner td.text-right{
				padding-top:14px !important;
			}
		</style>
	    ";
    }

    $table="campaigns";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["user"]["id_brand"]);
	$filter["status"]=array("operation"=>"=","value"=>1);

	$campaigns=listInBD($table,$filter,$fields);
	$response["data"]["page"].="

	<div class='page center_mobile_page' id='index'>
		<div class='header navbar navbar-inverse'>
			<div class='navbar-inner'>
				<table style='width:100%'>
					<tr>
						<td class='text-center' style='width:100%'><h4 class='text-center'>".htmlentities($app["name"], ENT_QUOTES, "UTF-8")."</h4></td>
					</tr>
				</table>
	 		</div>
		</div>
		<div class='page-container row'>
			<div class='page-content bg-white page-mobile'>
				<div class='content'>


 	";
 	$campaign_pages="";
	foreach($campaigns as $key=>$campaign){
		$table="used_codes";
		$filter=array();
		$filter["id_campaign"]=array("operation"=>"=","value"=>$campaign["id_campaign"]);
		$filter["id_user"]=array("operation"=>"=","value"=>$_SESSION["user"]["id_user"]);
		$count_used_codes=countInBD($table,$filter);
		$is_promo_success=false;
		if($campaign["type"]==1){
			if($count_used_codes>0){
				$steps_completed=intval($count_used_codes/($campaign["coupons_number"]+1));
				$step_count_used_codes=$count_used_codes%($campaign["coupons_number"]+1);
			}
			if($step_count_used_codes==$campaign["coupons_number"]){
				$is_promo_success=true;
			}
		}else if($campaign["type"]==2){
			$steps_completed=$count_used_codes;
		}
		$is_usage_limit=false;
		if(($campaign["usage_limit"]>0)&&($steps_completed>=$campaign["usage_limit"])){
			$is_usage_limit=true;
		}
		if(!$is_usage_limit){


			$img_file = PATH."../../server/resources/campaign-icon/".$campaign["campaign_icon_path"];
			$imgData = base64_encode(file_get_contents($img_file));
			$src = 'data: '.mime_content_type($img_file).';base64,'.$imgData;

			$response["data"]["page"].="
      <div class='row'>
  			<div class='col-md-12'>
  				<a href='javascript:transition_left(\"index\",\"campaign-".$campaign["id_campaign"]."\")'>
  					<img class='full-width' src='".$src."'/>
  				</a>
  			</div>
      </div>
			";

			$img_file = PATH."../../server/resources/campaign-image/".$campaign["campaign_image_path"];
			$imgData = base64_encode(file_get_contents($img_file));
			$src = 'data: '.mime_content_type($img_file).';base64,'.$imgData;

			$campaign_pages.="
				<div class='page right_mobile_page' id='campaign-".$campaign["id_campaign"]."'>
					<div class='header navbar navbar-inverse'>
						<div class='navbar-inner'>
							<table style='width:100%'>
								<tr>
									<td class='text-left' style='width:25%'><a href='javascript:transition_right(\"campaign-".$campaign["id_campaign"]."\",\"index\")' class='m-l-10 h4' style=''><i class='fa fa-chevron-left'></i> ".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a></td>
									<td class='text-center' style='width:50%'><h4 class='text-center'>".htmlentities($campaign["title"], ENT_QUOTES, "UTF-8")."</h4></td>
									<td class='text-right' style='width:25%'></td>
								</tr>
							</table>
				 		</div>
					</div>
					<div class='page-container row'>
						<div class='page-content bg-white page-mobile'>
							<div class='content'>
								<div class='col-md-12'>
									<div>
										<img class='full-width' src='".$src."'/>
									</div>
									<h6 class='text-center m-t-40 m-b-40 m-l-30 m-r-30'>".htmlentities($campaign["content"], ENT_QUOTES, "UTF-8")."</h6>
								";
			if($campaign["type"]==1){

				$end="";
				for($i=0;$i<$campaign["coupons_number"];$i++){
					if($i%3==0){
						$campaign_pages.=$end."
									<div style='overflow:auto;' class='m-l-20 m-r-20'>
						";
						$end="</div>";
					}
					$campaign_pages.="
						<div style='width:33%;float:left;text-align:center'>
							<i style='font-size:60px' class='fa fa-check";
					if($step_count_used_codes>0){ $campaign_pages.=" text-success";$step_count_used_codes--;}
					$campaign_pages.="'></i>
						</div>
					";

				}
				if($i%3!=0){
					$campaign_pages.="
					</div>
					";
				}

				$campaign_pages.="

									<div class='text-center m-t-20 m-l-20 m-r-20'>
										";
				if($is_promo_success){
					$campaign_pages.="
										<a href='javascript:transition_left(\"campaign-".$campaign["id_campaign"]."\",\"validate-".$campaign["id_campaign"]."-1\")' class='btn btn-block btn-success'>".htmlentities($s["promo_success"], ENT_QUOTES, "UTF-8")."</a>
					";
				}else{
					$campaign_pages.="
										<a href='javascript:transition_left(\"campaign-".$campaign["id_campaign"]."\",\"validate-".$campaign["id_campaign"]."-1\")' class='btn btn-block'>".htmlentities($campaign["button_title"], ENT_QUOTES, "UTF-8")."</a>
					";
				}
				$campaign_pages.="
									</div>
				";
			}else if($campaign["type"]==2){
				$campaign_pages.="
									<div class='text-center m-t-20 m-l-20 m-r-20 m-b-40'>
										<a href='javascript:transition_left(\"campaign-".$campaign["id_campaign"]."\",\"validate-".$campaign["id_campaign"]."-1\")' class='btn btn-block btn-success'>".htmlentities($campaign["button_title"], ENT_QUOTES, "UTF-8")."11111</a>
									</div>
					";
			}
			$campaign_pages.="
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class='page right_mobile_page' id='validate-".$campaign["id_campaign"]."-1'>
					<div class='header navbar navbar-inverse'>
						<div class='navbar-inner'>
							<table style='width:100%'>
								<tr>
									<td class='text-left' style='width:25%'><a href='javascript:transition_right(\"validate-".$campaign["id_campaign"]."-1\",\"campaign-".$campaign["id_campaign"]."\")' class='m-l-10 h4' style=''><i class='fa fa-chevron-left'></i> ".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a></td>
									<td class='text-center' style='width:50%'><h4 class='text-center'>".htmlentities($campaign["title"], ENT_QUOTES, "UTF-8")."</h4></td>
									<td class='text-right' style='width:25%'></td>
								</tr>
							</table>
				 		</div>
					</div>
					<div class='page-container row'>
						<div class='page-content bg-white page-mobile'>
							<div class='content'>
								<div class='col-md-12'>
									<h2 class='text-center m-t-80'>".htmlentities($s["validate_code_title"], ENT_QUOTES, "UTF-8")."</h2>
									<h5 class='text-center m-t-40 m-l-30 m-r-30'>".htmlentities($s["validate_code_subtitle"], ENT_QUOTES, "UTF-8")."</h5>
									<!--<h5 class='text-center'>".htmlentities($s["promo_code"], ENT_QUOTES, "UTF-8")."</h5>-->
									<!--<h4 class='text-center'>".strtoupper(dec32($user["id_user"].$campaign["id_campaign"].$timestamp))."</h4>-->
									<div class='text-center m-t-40 m-l-20 m-r-20'>
										<a class='btn btn-block' href='javascript:transition_left(\"validate-".$campaign["id_campaign"]."-1\",\"validate-".$campaign["id_campaign"]."-2\")'>".htmlentities($s["next"], ENT_QUOTES, "UTF-8")."</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class='page right_mobile_page' id='validate-".$campaign["id_campaign"]."-2'>
					<div class='header navbar navbar-inverse'>
						<div class='navbar-inner'>
							<table style='width:100%'>
								<tr>
									<td class='text-left' style='width:25%'><a href='javascript:transition_right(\"validate-".$campaign["id_campaign"]."-2\",\"validate-".$campaign["id_campaign"]."-1\")' class='m-l-10 h4' style=''><i class='fa fa-chevron-left'></i> ".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a></td>
									<td class='text-center' style='width:50%'><h4 class='text-center'>".htmlentities($campaign["title"], ENT_QUOTES, "UTF-8")."</h4></td>
									<td class='text-right' style='width:25%'></td>
								</tr>
							</table>
				 		</div>
					</div>
					<div class='page-container row'>
						<div class='page-content bg-white page-mobile'>
							<div class='content'>
								<div class='col-md-12'>
									<h2 class='text-center m-t-80'>".htmlentities($s["validate_code_title"], ENT_QUOTES, "UTF-8")."</h2>
									<h5 class='text-center m-t-40 m-l-30 m-r-30'>".htmlentities($s["validate_code_subtitle"], ENT_QUOTES, "UTF-8")."</h5>
									<div class='text-center m-t-40 m-l-20 m-r-20'>
										<div class='form-group'>
											<div class='controls'>
												<input type='password' id='".$campaign["id_campaign"]."-promo-password' name='".$campaign["id_campaign"]."-promo-password' class='form-control' style='text-align:center'>
												<input type='hidden' id='".$campaign["id_campaign"]."-code' name='".$campaign["id_campaign"]."-code' value='".strtoupper(dec32($user["id_user"].$campaign["id_campaign"].$timestamp))."'>
											</div>
										</div>
										<a class='btn btn-block' href='javascript:validate_promo(\"".$campaign["id_campaign"]."\")'>".htmlentities($s["next"], ENT_QUOTES, "UTF-8")."</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class='page right_mobile_page' id='validate-".$campaign["id_campaign"]."-loading'>
					<div class='header navbar navbar-inverse'>
						<div class='navbar-inner'>
							<table style='width:100%'>
								<tr>
									<td class='text-left' style='width:25%'><a href='javascript:transition_right(\"validate-".$campaign["id_campaign"]."-loading\",\"validate-".$campaign["id_campaign"]."-1\")' class='m-l-10 h4' style=''><i class='fa fa-chevron-left'></i> ".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a></td>
									<td class='text-center' style='width:50%'><h4 class='text-center'>".htmlentities($campaign["title"], ENT_QUOTES, "UTF-8")."</h4></td>
									<td class='text-right' style='width:25%'></td>
								</tr>
							</table>
				 		</div>
					</div>
					<div class='page-container row'>
						<div class='page-content bg-white page-mobile'>
							<div class='content'>
								<div class='col-md-12'>
									<div class='text-center m-t-40 m-l-20 m-r-20'>
										<div class='loader-activity'></div>
										<h3>".htmlentities($s["loading..."], ENT_QUOTES, "UTF-8")."</h3>
										<h5 class='msg'>".htmlentities($s["this_may_take_several_seconds"], ENT_QUOTES, "UTF-8")."</h5>
										<div class='m-t-20'>
											<a href='javascript:transition_right(\"validate-".$campaign["id_campaign"]."-loading\",\"validate-".$campaign["id_campaign"]."-1\")' class='btn btn-block'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class='page right_mobile_page' id='validate-".$campaign["id_campaign"]."-error'>
					<div class='header navbar navbar-inverse'>
						<div class='navbar-inner'>
							<table style='width:100%'>
								<tr>
									<td class='text-left' style='width:25%'></td>
									<td class='text-center' style='width:50%'><h4 class='text-center'>".htmlentities($campaign["title"], ENT_QUOTES, "UTF-8")."</h4></td>
									<td class='text-right' style='width:25%'></td>
								</tr>
							</table>
				 		</div>
					</div>
					<div class='page-container row'>
						<div class='page-content bg-white page-mobile'>
							<div class='content'>
								<div class='col-md-12'>
									<div class='text-center m-t-20 m-l-20 m-r-20'>
										<h1 class='text-center'><i class='fa fa-times fa-4x'></i></h1>
										<h3 class='text-center'>".htmlentities($s["error"], ENT_QUOTES, "UTF-8")."</h3>
										<h5 class='msg'>".htmlentities($s["there_was_an_error_please_try_later"], ENT_QUOTES, "UTF-8")."</h5>
										<div class='m-t-20'>
											<a href='javascript:location.reload()' class='btn btn-block'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class='page right_mobile_page' id='validate-".$campaign["id_campaign"]."-success'>
					<div class='header navbar navbar-inverse'>
						<div class='navbar-inner'>
							<table style='width:100%'>
								<tr>
									<td class='text-left' style='width:25%'></td>
									<td class='text-center' style='width:50%'><h4 class='text-center'>".htmlentities($campaign["title"], ENT_QUOTES, "UTF-8")."</h4></td>
									<td class='text-right' style='width:25%'></td>
								</tr>
							</table>
				 		</div>
					</div>
					<div class='page-container row'>
						<div class='page-content bg-white page-mobile'>
							<div class='content'>
								<div class='col-md-12'>
									<div class='text-center m-t-20 m-l-20 m-r-20'>
										<h1 class='text-center'><i class='fa fa-check fa-4x'></i></h1>
										<h3 class='text-center'>".htmlentities($s["validate_code_success_title"], ENT_QUOTES, "UTF-8")."</h3>
										<h5 class='msg'>".htmlentities($s["validate_code_success_subtitle"], ENT_QUOTES, "UTF-8")."</h5>
										<div class='m-t-20 m-l-20 m-r-20'>
											<a href='javascript:location.reload()' class='btn btn-block'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			";

		}

	}
	$response["data"]["page"].="
				</div>
			</div>
		</div>
	</div>
	".$campaign_pages;


 	/*********************************************************
 	* DATABASE REGISTRATION
 	*********************************************************/




 	/*********************************************************
 	* AJAX CALL RETURN
 	*********************************************************/

 	echo "jsonCallback(".json_encode($response).")";
	debug_log("[".$page_path."] END");
	die();

?>
