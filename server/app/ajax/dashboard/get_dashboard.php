<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 11-08-2014
	* Version: 0.94
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
	$page_path="server/app/ajax/dashboard/get_dashboard";
	debug_log("[".$page_path."] START");

	$response=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/

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

		$table="brands";
		$filter=array();
		$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		$fields = array("resume_block_1_display","resume_block_2_display","resume_block_3_display","resume_block_4_display");
 		$response["data"]["page-title"]="<a href='./index.html'>".htmlentities($s["home"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["dashboard"], ENT_QUOTES, "UTF-8");
 		$brand=getInBD($table,$filter,$fields);

 		for($i=1;$i<=4;$i++){
			$response["data"]["resume-block-".$i]="";
			if($brand["resume_block_".$i."_display"]==1){
				$table="brands";
				$filter=array();
				$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
				$fields=array("resume_block_".$i."_title","resume_block_".$i."_data","resume_block_".$i."_link","resume_block_".$i."_link_content");
				$resume_block=getInBD($table,$filter,$fields);

				$response["data"]["resume-block-".$i]="
				<div class='tiles pink'>
					<div class='tiles-body'>
						<h6 class='text-white all-caps no-margin'>
							".htmlentities($resume_block_s[$resume_block["resume_block_".$i."_title"]], ENT_QUOTES, "UTF-8")."
						</h6>
						<div class='heading'>";
				$block_data=create_block_data($resume_block["resume_block_".$i."_title"],$_SESSION["admin"]["id_brand"]);
				$response["data"]["resume-block-".$i].="
							<h1><span class='animate-number text-white' data-value='".$block_data."' data-animation-duration='1200'>0</h1>
						</div>
						<div class='description'>
							<a href='".$resume_block["resume_block_".$i."_link"]."' class='text-white'>".htmlentities($resume_block_s[$resume_block["resume_block_".$i."_link_content"]], ENT_QUOTES, "UTF-8")."</a>
						</div>
					</div>
				</div>";
			}
		}

  	$table="campaigns";
 		$filter=array();
 		$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
 		$filter["status"]=array("operation"=>"=","value"=>1);
 		$response["data"]["campaigns-list"]="
	 			<h4 class='m-t-0'>".htmlentities($s["active_campaigns"], ENT_QUOTES, "UTF-8")."</h4>
	 			<div class='text-center text-muted'>
	 				<p class='m-t-40'><i class='fa fa-bullhorn fa-4x'></i></p>
	 				<h6>".htmlentities($s["there_is_not_campaigns"], ENT_QUOTES, "UTF-8")."</h6>
	 				<p><a href='campaign/new/' class='btn btn-white'>".htmlentities($s["create_your_first_campaign"], ENT_QUOTES, "UTF-8")."</a></p>
	 			</div>
 		";
 		if(countInBD($table,$filter)>0){
 			$fields=array("id_campaign","name","campaign_usage_last_month");
 			$order = "campaign_usage_last_month desc, campaign_usage desc, id_campaign desc";
	 		$campaigns=listInBD($table,$filter,$fields,$order);

	 		$response["data"]["campaigns-list"]="
	 			<h4 class='m-t-0'>".htmlentities($s["active_campaigns"], ENT_QUOTES, "UTF-8")."</h4>
				<table class='full-width'>
					<thead>
						<tr>
							<th style='width:80%'>".htmlentities($s["campaign"], ENT_QUOTES, "UTF-8")."</th>
							<th style='width:20%' class='text-right'>".htmlentities($s["usage"], ENT_QUOTES, "UTF-8")."</th>
						</tr>
					</thead>
				<tbody class='ajax-loader-active-campaigns-list'>";
	 		foreach($campaigns as $key=>$campaign){
		 		$response["data"]["campaigns-list"].="
		 		<tr>
			 		<td>
		 				<a href='./campaign/?id_campaign=".$campaign["id_campaign"]."' class='m-r-10 text-success'>".htmlentities(substr_dots($campaign["name"],24), ENT_QUOTES, "UTF-8")."</a>
		 			</td>
		 			<td class='text-right'>";
		 		$month=strtotime(date("Y-m-1 00:00:00"));
		 		$table="used_codes_month_summaries";
		 		$filter=array();
		 		$filter["id_campaign"]=array("operation"=>"=","value"=>$campaign["id_campaign"]);
		 		$filter["start"]=array("operation"=>"=","value"=>$month);
		 		$used_code_month_summary=array();
		 		$used_code_month_summary["used_codes_amount"]=0;
		 		if(isInBD($table,$filter)){
			 		$used_code_month_summary=getInBD($table,$filter);
		 		}

		 		$response["data"]["campaigns-list"].="
		 				".$used_code_month_summary["used_codes_amount"]."
		 			</td>
		 		</tr>";
	 		}
	 		$response["data"]["campaigns-list"].="</tbody>
									</table>";
 		}
 		$response["data"]["graph-title"]="<h4 class='m-t-0'>".htmlentities($s["last_15_days"], ENT_QUOTES, "UTF-8")."</h4>";
		$table="used_codes_day_summaries";
		$filter=array();
		$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		$usage_count=0;
		for($i=0;$i<=14;$i++){
			$filter["start"]=array("operation"=>"=","value"=>$timestamp-((14-$i)*86400));
			$response["data"]["graph-label-".$i]=date("d/m",$timestamp-((14-$i)*86400));
			$response["data"]["graph-value-".$i]=0;
			if(isInBD($table,$filter)){
				$sum_field="used_codes_amount";
				$sum_used_codes_day_summary=sumInBD($table,$filter,$sum_field);
				$usage_count+=$sum_used_codes_day_summary;
				$response["data"]["graph-value-".$i]=$sum_used_codes_day_summary;
			}
		}
		if($usage_count==0){
			$response["data"]["graph-empty"]="
				<div class='ajax-loader-graph-title'>
					<h4 class='m-t-0'>".htmlentities($s["last_15_days"], ENT_QUOTES, "UTF-8")."</h4>
				</div>
				<div class='text-center text-muted'>
					<p class='m-t-40'><i class='fa fa-bar-chart-o fa-4x'></i></p>
					<h6>".htmlentities($s["there_is_not_graph_data"], ENT_QUOTES, "UTF-8")."</h6>
				</div>
			";
			$response["cssdisplay"]["graph-empty"] = 1;
			$response["cssdisplay"]["graph"] = 0;
		}


 		$table="software_news";
 		$filter=array();
 		$software_news=listInBD($table,$filter);
 		$response["data"]["software-news"]="<h4 class='m-t-0'>Royappty News</h4>";
 		foreach ($software_news as $key=>$software_new){
	 		$response["data"]["software-news"].="
	 		<div>
				<p><a href='".$software_new["link"]."'>Lorem ipsum dolor sit amet</a> <span class='text-muted'>".gmdate("d-m-Y", $software_new["created"])."</span></p>
				<p>".$software_new["content"];
				if(strlen($software_new["content"])==255){
					$response["data"]["software-news"].="[...]";
				}
	 		$response["data"]["software-news"].="</p>
								</div>";
 		}




	/*********************************************************
	* DATABASE REGISTRATION
	*********************************************************/



	/*********************************************************
	* AJAX CALL RETURN
	*********************************************************/
 	echo json_encode($response);
	debug_log("[".$page_path."] END");
	die();

?>
