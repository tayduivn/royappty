<?php
/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 08-08-2014
* Version: 0.94
*
*********************************************************/

function create_android_icons($path,$original_image_path,$app_project_codename){
	global $page_path;
	
	debug_log("[".$page_path."] Create Android icons START");
	$imgdata=(base64_decode(base64_encode(file_get_contents($path."resources/mobile-app/".$app_project_codename."/app_icon.png"))));
	imageresize($imgdata,$path."resources/mobile-app/".$app_project_codename."/icon-36-ldpi.png",36,36);
	imageresize($imgdata,$path."resources/mobile-app/".$app_project_codename."/icon-48-mdpi.png",48,48);
	imageresize($imgdata,$path."resources/mobile-app/".$app_project_codename."/icon-72-hdpi.png",72,72);
	imageresize($imgdata,$path."resources/mobile-app/".$app_project_codename."/icon-96-xhdpi.png",96,96);
	debug_log("[".$page_path."] Create Android icons END");

}

function create_android_config_file($path,$brand_id,$app_project_codename,$app_package_address,$app_name,$app_description,$app_android_project_number,$version,$author,$author_email,$author_web){
	global $page_path;
	
	debug_log("[".$page_path."] [resources/mobile-app/".$app_project_codename."] Check Folder");
	if (!file_exists($path."resources/mobile-app/".$app_project_codename)) {
		debug_log("[".$page_path."] [resources/mobile-app/".$app_project_codename."] Folder not exits");
	   	mkdir($path."resources/mobile-app/".$app_project_codename, 0777, true);
	   	debug_log("[".$page_path."] [resources/mobile-app/".$app_project_codename."] Folder created");
	}else{
		debug_log("[".$page_path."] [resources/mobile-app/".$app_project_codename."] Folder exits");
	}

	debug_log("[".$page_path."] [resources/mobile-app/".$app_project_codename."/android_config.xml] Check File");
	if (!file_exists($path."resources/mobile-app/".$app_project_codename."/android_config.xml")) {
		debug_log("[".$page_path."] [resources/mobile-app/".$app_project_codename."/android_config.xml] File not exits");
	   	touch($path."resources/mobile-app/".$app_project_codename."/android_config.xml");
	   	debug_log("[".$page_path."] [resources/mobile-app/".$app_project_codename."/android_config.xml] File created");
	}else{
		debug_log("[".$page_path."] [resources/mobile-app/".$app_project_codename."/android_config.xml] File exits");
	}
	
	$file = fopen($path."resources/mobile-app/".$app_project_codename."/android_config.xml", "w");
	debug_log("[".$page_path."] [resources/mobile-app/".$app_project_codename."/android_config.xml] File open");
	$file_content="<?xml version='1.0' encoding='utf-8'?>\n";
	$file_content.="<widget id='".$app_package_address."' version='".$version."' xmlns='http://www.w3.org/ns/widgets' xmlns:gap='http://phonegap.com/ns/1.0'>\n";
	$file_content.="<name>".$app_name."</name>\n";
	$file_content.="<description>\n";
	$file_content.=$app_description."\n";
	$file_content.="</description>\n";
	$file_content.="<author email='".$author_email."' href='".$author_web."'>\n";
	$file_content.=$author."\n";
	$file_content.="</author>\n";
	$file_content.="<preference name='permissions' value='none' />\n";
	$file_content.="<preference name='phonegap-version' value='3.5.0' />\n";
	$file_content.="<preference name='orientation' value='default' />\n";
	$file_content.="<preference name='target-device' value='universal' />\n";
	$file_content.="<preference name='fullscreen' value='true' />\n";
	$file_content.="<preference name='webviewbounce' value='true' />\n";
	$file_content.="<preference name='prerendered-icon' value='true' />\n";
	$file_content.="<preference name='stay-in-webview' value='false' />\n";
	$file_content.="<preference name='ios-statusbarstyle' value='black-opaque' />\n";
	$file_content.="<preference name='detect-data-types' value='true' />\n";
	$file_content.="<preference name='exit-on-suspend' value='false' />\n";
	$file_content.="<preference name='show-splash-screen-spinner' value='true' />\n";
	$file_content.="<preference name='auto-hide-splash-screen' value='true' />\n";
	$file_content.="<preference name='disable-cursor' value='false' />\n";
	$file_content.="<preference name='android-minSdkVersion' value='7' />\n";
	$file_content.="<preference name='android-installLocation' value='auto' />\n";
	$file_content.="<gap:plugin name='org.apache.cordova.battery-status' />\n";
	$file_content.="<gap:plugin name='org.apache.cordova.camera' />\n";
	$file_content.="<gap:plugin name='org.apache.cordova.media-capture' />\n";
	$file_content.="<gap:plugin name='org.apache.cordova.console' />\n";
	$file_content.="<gap:plugin name='org.apache.cordova.contacts' />\n";
	$file_content.="<gap:plugin name='org.apache.cordova.device' />\n";
	$file_content.="<gap:plugin name='org.apache.cordova.device-motion' />\n";
	$file_content.="<gap:plugin name='org.apache.cordova.device-orientation' />\n";
	$file_content.="<gap:plugin name='org.apache.cordova.dialogs' />\n";
	$file_content.="<gap:plugin name='org.apache.cordova.file' />\n";
	$file_content.="<gap:plugin name='org.apache.cordova.file-transfer' />\n";
	$file_content.="<gap:plugin name='org.apache.cordova.geolocation' />\n";
	$file_content.="<gap:plugin name='org.apache.cordova.globalization' />\n";
	$file_content.="<gap:plugin name='org.apache.cordova.inappbrowser' />\n";
	$file_content.="<gap:plugin name='org.apache.cordova.media' />\n";
	$file_content.="<gap:plugin name='org.apache.cordova.network-information' />\n";
	$file_content.="<gap:plugin name='org.apache.cordova.splashscreen' />\n";
	$file_content.="<gap:plugin name='org.apache.cordova.vibration' />\n";
	$file_content.="<icon src='www/icon.png' />\n";
	$file_content.="<icon gap:platform='android' gap:qualifier='ldpi' src='www/res/icon/android/icon-36-ldpi.png' />\n";
	$file_content.="<icon gap:platform='android' gap:qualifier='mdpi' src='www/res/icon/android/icon-48-mdpi.png' />\n";
	$file_content.="<icon gap:platform='android' gap:qualifier='hdpi' src='www/res/icon/android/icon-72-hdpi.png' />\n";
	$file_content.="<icon gap:platform='android' gap:qualifier='xhdpi' src='www/res/icon/android/icon-96-xhdpi.png' />\n";
	$file_content.="<gap:splash gap:platform='android' gap:qualifier='port-ldpi' src='www/res/screen/android/screen-ldpi-portrait.png' />\n";
	$file_content.="<gap:splash gap:platform='android' gap:qualifier='port-mdpi' src='www/res/screen/android/screen-mdpi-portrait.png' />\n";
	$file_content.="<gap:splash gap:platform='android' gap:qualifier='port-hdpi' src='www/res/screen/android/screen-hdpi-portrait.png' />\n";
	$file_content.="<gap:splash gap:platform='android' gap:qualifier='port-xhdpi' src='www/res/screen/android/screen-xhdpi-portrait.png' />\n";
	$file_content.="<access origin='*' />\n";
	$file_content.="</widget>";
	fwrite($file, $file_content);
	debug_log("[".$page_path."] [resources/mobile-app/".$app_project_codename."/android_config.xml] File wrote");
	fclose($file);
	debug_log("[".$page_path."] [resources/mobile-app/".$app_project_codename."/android_config.xml] File closed");
	if (!file_exists($path."resources/mobile-app/".$app_project_codename."/brand.json")) {
	   	touch($path."resources/mobile-app/".$app_project_codename."/brand.json");
	}
	$file = fopen($path."resources/mobile-app/".$app_project_codename."/brand.json", "w");
	$file_content='{"result" : true,"data" :{"id_brand" : '.$brand_id.',"android_senderID": "'.$app_android_project_number.'"}}';
	fwrite($file, $file_content);
	debug_log("[".$page_path."] [resources/mobile-app/".$app_project_codename."/brand.json.xml] File wrote");
	fclose($file);
	debug_log("[".$page_path."] [resources/mobile-app/".$app_project_codename."/brand.json.xml] File closed");
	
	create_android_icons($path,"resources/mobile-app/".$app_project_codename."/app_icon.png",$app_project_codename);
}

function sendMessageToPhone($deviceToken, $collapseKey, $messageText, $messageTitle, $yourKey) {

		$headers = array('Authorization:key=' . $yourKey);
		$data = array(
				'registration_id' => $deviceToken,
				'collapse_key' => $collapseKey,
				'data.msgcnt' => 2,
				'data.title' => $messageTitle,
				'data.message' => $messageText);
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send");
		if ($headers)
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		$response = curl_exec($ch);
		var_dump($response);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if (curl_errno($ch)) {
				return false;
		}
		if ($httpCode != 200) {
				return false;
		}
		curl_close($ch);
		return $response;
}

// Image resize function with php + gd2 lib
function imageresize($source, $destination, $width = 0, $height = 0, $crop = false, $quality = 100) {
	$quality = $quality ? $quality : 80;
	$image = imagecreatefromstring($source);
	if ($image) {
			// Get dimensions
			$w = imagesx($image);
			$h = imagesy($image);
			if (($width && $w > $width) || ($height && $h > $height)) {
					$ratio = $w / $h;
					if (($ratio >= 1 || $height == 0) && $width && !$crop) {
							$new_height = $width / $ratio;
							$new_width = $width;
					} elseif ($crop && $ratio <= ($width / $height)) {
							$new_height = $width / $ratio;
							$new_width = $width;
					} else {
							$new_width = $height * $ratio;
							$new_height = $height;
					}
			} else {
					$new_width = $w;
					$new_height = $h;
			}
			$x_mid = $new_width * .5;  //horizontal middle
			$y_mid = $new_height * .5; //vertical middle
			// Resample
			$new = imagecreatetruecolor(round($new_width), round($new_height));
			imagecopyresampled($new, $image, 0, 0, 0, 0, $new_width, $new_height, $w, $h);
			// Crop
			if ($crop) {
					$crop = imagecreatetruecolor($width ? $width : $new_width, $height ? $height : $new_height);
					imagecopyresampled($crop, $new, 0, 0, ($x_mid - ($width * .5)), 0, $width, $height, $width, $height);
					//($y_mid - ($height * .5))
			}
			// Output
			// Enable interlancing [for progressive JPEG]
			imageinterlace($crop ? $crop : $new, true);

			$dext = strtolower(pathinfo($destination, PATHINFO_EXTENSION));
			if ($dext == '') {
					$dext = $ext;
					$destination .= '.' . $ext;
			}
			switch ($dext) {
					case 'jpeg':
					case 'jpg':
							imagejpeg($crop ? $crop : $new, $destination, $quality);
							break;
					case 'png':
							$pngQuality = ($quality - 100) / 11.111111;
							$pngQuality = round(abs($pngQuality));
							imagepng($crop ? $crop : $new, $destination, $pngQuality);
							break;
					case 'gif':
							imagegif($crop ? $crop : $new, $destination);
							break;
			}
			@imagedestroy($image);
			@imagedestroy($new);
			@imagedestroy($crop);
	}
}

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

function create_block_unit($block_data_code){
	$block_unit="";
	switch ($block_data_code){
		case "total_campaigns":
			$block_unit="";
			break;

		case "total_brands":
			$block_unit="";
			break;

		case "total_users":
			$block_unit="";
			break;

		case "total_monthly_revenue":
			$block_unit="€";
			break;


	}

	return $block_unit;
}
function create_block_data($block_data_code,$data1="",$data2=""){

	$block_data="?";
	switch ($block_data_code){
		case "total_campaigns":
			$table="campaigns";
			$filter=array();
			$filter["status"]=array("operation"=>"=","value"=>1);
			$block_data=countInBD($table,$filter);
			if(!@issetandnotempty($block_data)){$block_data=0;}
			break;

		case "total_brands":
			$table="brands";
			$filter=array();
			$filter["active"]=array("operation"=>"=","value"=>1);
			$block_data=countInBD($table,$filter);
			if(!@issetandnotempty($block_data)){$block_data=0;}
			break;

		case "total_users":
			$table="users";
			$filter=array();
			$filter["active"]=array("operation"=>"=","value"=>1);
			$block_data=countInBD($table,$filter);
			if(!@issetandnotempty($block_data)){$block_data=0;}
			break;

		case "total_monthly_revenue":
			$table="receipts";
			$filter=array();
			$filter["created"]=array("operation"=>">","value"=>strtotime("-1 month"));
			$sum_field="price_vat";
			$block_data=sumInBD($table,$filter,$sum_field);
			if(!@issetandnotempty($block_data)){$block_data=0;}
			break;

		case "campaigns":
			$table="campaigns";
			$filter=array();
			$filter["id_brand"]=array("operation"=>"=","value"=>$data1);
			$filter["status"]=array("operation"=>"=","value"=>1);
			$block_data=countInBD($table,$filter);
			if(!@issetandnotempty($block_data)){$block_data=0;}
			break;

		case "usage_this_month":
			$month=strtotime(date("Y-m-d 00:00:00",strtotime("-1 month")));
			$table="used_codes_month_summaries";
			$filter=array();
			$filter["id_brand"]=array("operation"=>"=","value"=>$data1);
			$filter["start"]=array("operation"=>"=","value"=>$month);
			$sumfield="used_codes_amount";
			$block_data=sumInBD($table,$filter,$sumfield);
			if(!@issetandnotempty($block_data)){$block_data=0;}
			break;
		case "usage_this_today":
			$day=strtotime(date("Y-m-d 00:00:00"));
			$table="used_codes_day_summaries";
			$filter=array();
			$filter["id_brand"]=array("operation"=>"=","value"=>$data1);
			$filter["start"]=array("operation"=>"=","value"=>$day);
			$sumfield="used_codes_amount";
			$block_data=sumInBD($table,$filter,$sumfield);
			if(!@issetandnotempty($block_data)){$block_data=0;}
			break;
		case "users":
			$table="users";
			$filter=array();
			$filter["id_brand"]=array("operation"=>"=","value"=>$data1);
			$filter["active"]=array("operation"=>"=","value"=>1);
			$block_data=countInBD($table,$filter);
			if(!@issetandnotempty($block_data)){$block_data=0;}
			break;

		case "admin_validated_this_month":
			$month=strtotime(date("Y-m-d 00:00:00",strtotime("-1 month")));
			$table="validated_codes_month_summaries";
			$filter=array();
			$filter["id_admin"]=array("operation"=>"=","value"=>$data1);
			$filter["start"]=array("operation"=>"=","value"=>$month);
			$tmp=getInBD($table,$filter);
			$block_data=$tmp["validated_codes_amount"];
			if(!@issetandnotempty($block_data)){$block_data=0;}
			break;
		case "admin_validated_this_today":
			$day=strtotime(date("Y-m-d 00:00:00"));
			$table="validated_codes_day_summaries";
			$filter=array();
			$filter["id_admin"]=array("operation"=>"=","value"=>$data1);
			$filter["start"]=array("operation"=>"=","value"=>$day);
			$tmp=getInBD($table,$filter);
			$block_data=$tmp["validated_codes_amount"];
			if(!@issetandnotempty($block_data)){$block_data=0;}
			break;
		case "admin_validated":
			$table="validated_codes_month_summaries";
			$filter=array();
			$filter["id_admin"]=array("operation"=>"=","value"=>$data1);
			$sumfield="validated_codes_amount";
			$block_data=countInBD($table,$filter);
			if(!@issetandnotempty($block_data)){$block_data=0;}
			break;
		case "campaign_usage_this_month":
			$month=strtotime(date("Y-m-d 00:00:00",strtotime("-1 month")));
			$table="used_codes_day_summaries";
			$filter=array();
			$filter["id_campaign"]=array("operation"=>"=","value"=>$data1);
			$filter["start"]=array("operation"=>">","value"=>$month);
			$sumfield="used_codes_amount";
			$block_data=sumInBD($table,$filter,$sumfield);
			if(!@issetandnotempty($block_data)){$block_data=0;}
			break;
		case "campaign_usage_today":
			$day=strtotime(date("Y-m-d 00:00:00"));
			$table="used_codes_day_summaries";
			$filter=array();
			$filter["id_campaign"]=array("operation"=>"=","value"=>$data1);
			$filter["start"]=array("operation"=>"=","value"=>$day);
			$tmp=getInBD($table,$filter);
			$block_data=$tmp["used_codes_amount"];
			if(!@issetandnotempty($block_data)){$block_data=0;}
			break;
		case "campaign_usage_total":
			$table="used_codes_month_summaries";
			$filter=array();
			$filter["id_campaign"]=array("operation"=>"=","value"=>$data1);
			$sumfield="used_codes_amount";
			$block_data=sumInBD($table,$filter,$sumfield);
			if(!@issetandnotempty($block_data)){$block_data=0;}
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
			if(!@issetandnotempty($block_data)){$block_data=0;}
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
			if(!@issetandnotempty($block_data)){$block_data=0;}
			break;

		case "group_users":
			$table="user_groups";
			$filter=array();
			$filter["id_group"]=array("operation"=>"=","value"=>$data1);
			$block_data=countInBD($table,$filter);
			if(!@issetandnotempty($block_data)){$block_data=0;}
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

	return true;
	die();
}

function checkBrand($brand){
	global $page_path;
	global $response;

	if(!@issetandnotempty($brand["id_brand"])){
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

function checkBDConnection(){
	global $response;
	global $db_connection;

	if(!$db_connection["status"]){
		error_log("FALSE");
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

function checkRyadmin($ryadmin){
	global $page_path;
	global $response;

	if(!@issetandnotempty($ryadmin["id_ryadmin"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Missing id_ryadmin");
		$response["error"]="ERROR Data Missing ryadmin identificator";
		$response["error_code"]="no_ryadmin";
		return false;
		die();
	}

	$table="ryadmins";
	$filter=array();
	$filter["id_ryadmin"]=array("operation"=>"=","value"=>$ryadmin["id_ryadmin"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Ryadmin not exists (id_ryadmin=".$ryadmin["id_ryadmin"].")");
		$response["error"]="ERROR Ryadmin not in the system";
		$response["error_code"]="ryadmin_not_valid";
		return false;
		die();
	}

	$table="ryadmins";
	$filter=array();
	$filter["id_ryadmin"]=array("operation"=>"=","value"=>$ryadmin["id_ryadmin"]);
	$filter["active"]=array("operation"=>"=","value"=>1);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Ryadmin inactive (id_admin=".$ryadmin["id_admin"].")");
		$response["error"]="ERROR Ryadmin inactive";
			$response["error_code"]="ryadmin_inactive";
		echo json_encode($response);
		die();
	}
	return true;
	die();
}

function error_handler($error_code){
	global $error_alert;
	global $error_s;

	if((isset($error_code))&&(!empty($error_code))&&($error_code!="undefined")){
		$error_alert=$error_s[$error_code];
	}
}


?>
