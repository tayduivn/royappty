<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 18-07-2014
	* Version: 0.93
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	*
	*
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	@session_start();
	define('PATH', str_replace('\\', '/','../../'));
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/campaigns/table";
	debug_log("[".$page_path."] START");
	$response=array();
 	$response["aaData"]=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/




	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$table="campaigns";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	if(@issetandnotempty($_GET["status"])){
		$filter["status"]=array("operation"=>"=","value"=>$_GET["status"]);
 	}
	if(isInBD($table,$filter)){
 		$campaigns=listInBD($table,$filter);
 		foreach($campaigns as $key=>$campaign){
 			$table="used_codes_month_summaries";
	  		$filter=array();
	 		$filter["id_campaign"]=array("operation"=>"=","value"=>$campaign["id_campaign"]);
	 		$this_month_unix=strtotime(date("Y-m-1 00:00:00"));
	 		$filter["start"]=array("operation"=>"=","value"=>$this_month_unix);
	 		$used_codes_month_summary=getInBD($table,$filter);

	 		$data_table[0] = "<div class='m-b-5'><a href='".$_GET["PATH"]."campaign/?id_campaign=".$campaign["id_campaign"]."' class='";
	 		if($campaign["status"]==2){
		 		$data_table[0].=" text-muted ";
	 		}
	 		$data_table[0].="'>".substr_dots($campaign["name"],40);
	 		if($campaign["status"]!=1){
		 		$data_table[0].=" <span class='text-muted'>( ".htmlentities($s["campaigns_status"][$campaign["status"]], ENT_QUOTES, "UTF-8")." )</a>";
	 		}
	 		$data_table[0].="</a></div><div class='hidden-options'><a href='".$_GET["PATH"]."campaign/?id_campaign=".$campaign["id_campaign"]."' class='btn btn-mini btn-white'>".htmlentities($s["view_report"], ENT_QUOTES, "UTF-8")."</a> <a href='".$_GET["PATH"]."campaign/edit/".$campaign_bd_type[$campaign["type"]]."/?id_campaign=".$campaign["id_campaign"]."' class='btn btn-mini btn-white'>".htmlentities($s["edit"], ENT_QUOTES, "UTF-8")."</a> <a href='javascript:show_modal(\"delete_campaign_alert\",\"javascript:delete_campaign(".$campaign["id_campaign"].")\")' class=' btn btn-mini btn-danger'>".htmlentities($s["delete"], ENT_QUOTES, "UTF-8")."</a></div>";

	 		$month=strtotime(date("Y-m-1 00:00:00"));
	 		$table="used_codes_month_summaries";
	 		$filter=array();
	 		$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	 		$filter["id_campaign"]=array("operation"=>"=","value"=>$campaign["id_campaign"]);
	 		$filter["start"]=array("operation"=>"=","value"=>$month);
	 		$used_codes_month_summary=getInBD($table,$filter);

	 		$table="used_codes_summaries";
	 		$filter=array();
	 		$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	 		$filter["id_campaign"]=array("operation"=>"=","value"=>$campaign["id_campaign"]);
	 		$used_codes_summary=getInBD($table,$filter);

	 		if(!@issetandnotempty($used_codes_month_summary["used_codes_amount"])){$used_codes_month_summary["used_codes_amount"]=0;}
	 		if(!@issetandnotempty($used_codes_summary["used_codes_amount"])){$used_codes_summary["used_codes_amount"]=0;}

	 		$response["aaData"][]=array(

	 			$data_table[0],
	 			htmlentities($s["campaigns_types"][$campaign["type"]], ENT_QUOTES, "UTF-8"),
	 			htmlentities($s["campaigns_status"][$campaign["status"]], ENT_QUOTES, "UTF-8"),
	 			"<span class='pull-right'>".$used_codes_month_summary["used_codes_amount"]."</span>",
	 			"<span class='pull-right'>".$used_codes_summary["used_codes_amount"]."</span>");
 		}

	}

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
