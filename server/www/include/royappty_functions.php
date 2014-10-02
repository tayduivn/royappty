<?php

	/************************************************************
	* Royappty
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Modification: 10-02-2014
	* Version: 1.0
	* licensed through CC BY-NC 4.0
	************************************************************/

	function corporate_email($mail_for,$mail_subject,$content){
		global $url_server;
		global $CONFIG;
		global $lang_email;
		global $s;
		global $page_path;

		$mail_content ="
			<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
			<html  b:version='2' class='v2' expr:dir='data:blog.languageDirection' xmlns='http://www.w3.org/1999/xhtml' dir='ltr' lang='".$lang_email."' xml:lang='".$lang_email."' xmlns:b='http://www.google.com/2005/gml/b' xmlns:b='http://www.google.com/2005/gml/b' xmlns:data='http://www.google.com/2005/gml/data' xmlns:expr='http://www.google.com/2005/gml/expr' xmlns:og='http://opengraphprotocol.org/schema/'>
			<head>
				<meta http-equiv='content-type' content='text/html; charset=utf-8' />
			</head>
			<style type='text/css'>
				a{ color:color:#666; }
				a:hover{ color:#000; }
				b{ color:#000; font-weight:300 }
				.important{ color:#000; }
				.uppercase{ text-transform: uppercase; }
				.underline{ text-decoration:underline; }
				th{}
				td{ padding:5px 10px; }
				.preview img{ height:100px; }
				.right{ text-align:right; }
				.left{ text-align:left; }
				.semifooter{ padding-top:20px; font-size:10px; }
				h3{ font-size:14px; color:#000; font-weight:300}
			</style>
			<body style='font-family: \"Open Sans\", sans-serif;margin:0;padding:0'>
				<div style='display:block;margin:auto;margin:20px 0px 30px 0px;text-align:center'>
					<img style='margin:auto;min-width:300px;max-width:300px' src='".$url_server.$CONFIG["company_logo_path"]."'/>
				</div>
				<div class='content' style='margin:20px 20px 40px 20px;font-weight:100;font-size:14px;'>
				".$content."
				</div>

				<div style='display:block;margin:auto;padding:40px 0px;background-color:#f4f4f4;overflow:auto;color:#666 !important;font-size:10px;'>
					<div style='float:left;padding-left:20px;padding-bottom:10px;'>
						<div>
							<a href='http://www.okycoky.net/classics/'>
								<img style='min-height:30px;max-height:30px;padding-bottom:10px;' src='".$url_server.$CONFIG["company_logo_path"]."'/>
							</a>
						</div>
						".$CONFIG["company_street"]."<br/>
						".$CONFIG["company_town"]." ".$CONFIG["company_country"]."<br/>
						".$CONFIG["company_phone"]."<br/>
						".$CONFIG["company_info_mail"]."<br/>
					</div>
					<div style='float:right;padding-right:20px;text-align:right;width:300px;font-size:11px;padding-bottom:10px;'>
						<div style='font-weight:bold'>".htmlentities($s["follow_us"], ENT_QUOTES, "UTF-8")."</div>
						<div style='text-align:right;margin-top:5px;'>
							".htmlentities($s["follow_us_in_social_networks"], ENT_QUOTES, "UTF-8")."
						</div>
					</div>
				</div>
				<div style='text-align:center;background:#fff;padding:20px;font-weight:100;font-size:12px;'>
					<p>".date('Y').htmlentities(" © ".$CONFIG["company_name"], ENT_QUOTES, "UTF-8")."</p>
					<p>".$CONFIG["footer_mail"]."</p>
				</div>
			</body>
			</html>";
			$mail_header="Content-type: text/html\r\nFrom: ".$CONFIG["mail_header_email"];
			debug_log("[".$page_path."] Send corportate email (for:".$mail_for.",subject:".$mail_subject.") START");
			mail($mail_for,$mail_subject,$mail_content,$mail_header);
			debug_log("[".$page_path."] Send corportate email END");
			return true;
	}


	function create_block_data($block_data_code,$data1="",$data2=""){

		$block_data="?";
		switch ($block_data_code){
			case "campaigns":
				$table="campaigns";
				$filter=array();
				$filter["id_brand"]=array("operation"=>"=","value"=>$data1);
				$filter["status"]=array("operation"=>"=","value"=>1);
				$block_data=countInBD($table,$filter);
				if(!issetandnotempty($block_data)){$block_data=0;}
				break;

			case "usage_this_month":
				$month=strtotime(date("Y-m-d 00:00:00",strtotime("-1 month")));
				$table="used_codes_month_summaries";
				$filter=array();
				$filter["id_brand"]=array("operation"=>"=","value"=>$data1);
				$filter["start"]=array("operation"=>"=","value"=>$month);
				$sumfield="used_codes_amount";
				$block_data=sumInBD($table,$filter,$sumfield);
				if(!issetandnotempty($block_data)){$block_data=0;}
				break;
			case "usage_this_today":
				$day=strtotime(date("Y-m-d 00:00:00"));
				$table="used_codes_day_summaries";
				$filter=array();
				$filter["id_brand"]=array("operation"=>"=","value"=>$data1);
				$filter["start"]=array("operation"=>"=","value"=>$day);
				$sumfield="used_codes_amount";
				$block_data=sumInBD($table,$filter,$sumfield);
				if(!issetandnotempty($block_data)){$block_data=0;}
				break;
			case "users":
				$table="users";
				$filter=array();
				$filter["id_brand"]=array("operation"=>"=","value"=>$data1);
				$filter["active"]=array("operation"=>"=","value"=>1);
				$block_data=countInBD($table,$filter);
				if(!issetandnotempty($block_data)){$block_data=0;}
				break;

			case "admin_validated_this_month":
				$month=strtotime(date("Y-m-d 00:00:00",strtotime("-1 month")));
				$table="validated_codes_month_summaries";
				$filter=array();
				$filter["id_admin"]=array("operation"=>"=","value"=>$data1);
				$filter["start"]=array("operation"=>"=","value"=>$month);
				$tmp=getInBD($table,$filter);
				$block_data=$tmp["validated_codes_amount"];
				if(!issetandnotempty($block_data)){$block_data=0;}
				break;
			case "admin_validated_this_today":
				$day=strtotime(date("Y-m-d 00:00:00"));
				$table="validated_codes_day_summaries";
				$filter=array();
				$filter["id_admin"]=array("operation"=>"=","value"=>$data1);
				$filter["start"]=array("operation"=>"=","value"=>$day);
				$tmp=getInBD($table,$filter);
				$block_data=$tmp["validated_codes_amount"];
				if(!issetandnotempty($block_data)){$block_data=0;}
				break;
			case "admin_validated":
				$table="validated_codes_month_summaries";
				$filter=array();
				$filter["id_admin"]=array("operation"=>"=","value"=>$data1);
				$sumfield="validated_codes_amount";
				$block_data=countInBD($table,$filter);
				if(!issetandnotempty($block_data)){$block_data=0;}
				break;
			case "campaign_usage_this_month":
				$month=strtotime(date("Y-m-d 00:00:00",strtotime("-1 month")));
				$table="used_codes_day_summaries";
				$filter=array();
				$filter["id_campaign"]=array("operation"=>"=","value"=>$data1);
				$filter["start"]=array("operation"=>">","value"=>$month);
				$sumfield="used_codes_amount";
				$block_data=sumInBD($table,$filter,$sumfield);
				if(!issetandnotempty($block_data)){$block_data=0;}
				break;
			case "campaign_usage_today":
				$day=strtotime(date("Y-m-d 00:00:00"));
				$table="used_codes_day_summaries";
				$filter=array();
				$filter["id_campaign"]=array("operation"=>"=","value"=>$data1);
				$filter["start"]=array("operation"=>"=","value"=>$day);
				$tmp=getInBD($table,$filter);
				$block_data=$tmp["used_codes_amount"];
				if(!issetandnotempty($block_data)){$block_data=0;}
				break;
			case "campaign_usage_total":
				$table="used_codes_month_summaries";
				$filter=array();
				$filter["id_campaign"]=array("operation"=>"=","value"=>$data1);
				$sumfield="used_codes_amount";
				$block_data=sumInBD($table,$filter,$sumfield);
				if(!issetandnotempty($block_data)){$block_data=0;}
				break;

			case "group_usage_this_month":
				$month=strtotime(date("Y-m-d 00:00:00",strtotime("-1 month")));
				$table="user_groups";
				$filter=array();
				$filter["id_group"]=array("operation"=>"=","value"=>$data1);
				$block_data=0;
				if(isInBD($table,$filter)){
						$user_groups=listInBD($table,$filter);
						$table="used_codes_user_day_summaries";
						$filter=array();
						$filter["start"]=array("operation"=>">","value"=>$month);
						$filter["complex"]="";
						$or="";
						foreach($user_groups as $key => $user_group){
								$filter["complex"].=$or."id_user=".$user_group["id_user"];
								$or=" or ";
						}
						$sumfield="used_codes_amount";
						$block_data=sumInBD($table,$filter,$sumfield);
				}
				if(!issetandnotempty($block_data)){$block_data=0;}
				break;

			case "group_usage_today":
				$day=strtotime(date("Y-m-d 00:00:00"));
				$table="user_groups";
				$filter=array();
				$filter["id_group"]=array("operation"=>"=","value"=>$data1);
				$block_data=0;
				if(isInBD($table,$filter)){
						$user_groups=listInBD($table,$filter);
						$table="used_codes_user_day_summaries";
						$filter=array();
						$filter["start"]=array("operation"=>">","value"=>$day);
						$filter["complex"]="";
						$or="";
						foreach($user_groups as $key => $user_group){
								$filter["complex"].=$or."id_user=".$user_group["id_user"];
								$or=" or ";
						}
						$sumfield="used_codes_amount";
						$block_data=sumInBD($table,$filter,$sumfield);
				}
				if(!issetandnotempty($block_data)){$block_data=0;}
				break;

			case "group_users":
				$table="user_groups";
				$filter=array();
				$filter["id_group"]=array("operation"=>"=","value"=>$data1);
				$block_data=countInBD($table,$filter,$sumfield);
				if(!issetandnotempty($block_data)){$block_data=0;}
				break;

		}

		return $block_data;
	}

	function checkClosed(){
		global $page_path;
		global $response;
		global $CONFIG;

		if($CONFIG["close"]){
			$response["result"]=false;
			debug_log("[".$page_path."] ERROR System Closed");
			$response["error"]="ERROR System Closed";
			$response["error_code"]="system_closed";
			return false;
			die();
		}
		if($CONFIG["launch"]){
			$response["result"]=false;
			debug_log("[".$page_path."] ERROR System Launch");
			$response["error"]="ERROR System Launch";
			$response["error_code"]="system_launch";
			return false;
			die();
		}

		return true;
		die();
	}

	function checkBDConnection(){
		global $response;
		global $db_connection;

		if(!$db_connection["status"]){
			$response["result"]=false;
			debug_log("[".$page_path."] ERROR Can't connect with DataBase");
			$response["error"]="ERROR Can't connect with DataBase";
			$response["error_code"]="db_connection_error";
			return false;
			die();
		}

		return true;
		die();
	}


	function checkBrand($brand){
		global $page_path;
		global $response;

		if(!issetandnotempty($brand["id_brand"])){
		 	$response["result"]=false;
			debug_log("[".$page_path."] ERROR Data Missing id_brand");
	 		$response["error"]="ERROR Data Missing brand identificator";
	  		$response["error_code"]="no_brand";
	 		return false;
	 		die();
	 	}
	 	$table="brands";
	 	$filter=array();
	 	$filter["id_brand"]=array("operation"=>"=","value"=>$brand["id_brand"]);
	 	$filter["active"]=array("operation"=>"=","value"=>1);
	 	if(!isInBD($table,$filter)){
		 	$response["result"]=false;
			debug_log("[".$page_path."] ERROR Brand not exists or inactive (id_brand=".$brand["id_brand"]." | active=1)");
	 		$response["error"]="ERROR Data Missing not exists or inactive";
	 		$response["error_code"]="brand_not_valid";
	 		return false;
	 		die();
	 	}
	 	return true;
	 	die();

	}

	function checkAdmin($admin){
		global $page_path;
		global $response;

		if(!issetandnotempty($admin["id_admin"])){
		 	$response["result"]=false;
			debug_log("[".$page_path."] ERROR Data Missing id_admin");
	 		$response["error"]="ERROR Data Missing admin identificator";
	  		$response["error_code"]="no_admin";
			return false;
	 		die();
	 	}

	 	$table="admins";
	 	$filter=array();
	 	$filter["id_admin"]=array("operation"=>"=","value"=>$admin["id_admin"]);
	 	if(!isInBD($table,$filter)){
		 	$response["result"]=false;
			debug_log("[".$page_path."] ERROR User not exists (id_admin=".$admin["id_admin"].")");
	 		$response["error"]="ERROR User not in the system";
	 		$response["error_code"]="admin_not_valid";
	 		return false;
	 		die();
	 	}

	 	$table="admins";
	 	$filter=array();
	 	$filter["id_admin"]=array("operation"=>"=","value"=>$admin["id_admin"]);
	 	$filter["active"]=array("operation"=>"=","value"=>1);
	 	if(!isInBD($table,$filter)){
		 	$response["result"]=false;
			debug_log("[".$page_path."] ERROR User not exists (id_admin=".$admin["id_admin"].")");
	 		$response["error"]="ERROR User not in the system";
	  		$response["error_code"]="admin_inactive";
			echo json_encode($response);
	 		die();
	 	}
	 	return true;
	 	die();
	}

	function error_handler(){
		global $error_alert;
		global $_POST;
		global $error_s;

		if((isset($_POST["error"]))&&(!empty($_POST["error"]))&&($_POST["error"]!="undefined")){
			$error_alert=$error_s[$_POST["error"]];
		}
	}


?>
