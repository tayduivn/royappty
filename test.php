<?php
	define('PATH', str_replace('\\', '/','./'));
	create_android_config_file("vivalacloud","com.royappty.vivalacloud","Viva la Cloud","Descripci&oacute;n de la aplicaci&oacute;n","1.0.0","Royappty Corp","info@royappty.com","http://www.royappty.com");
	function create_android_config_file($app_project_codename,$app_android_project_id,$app_name,$app_description,$version,$author,$author_email,$author_web){

		if (!file_exists(PATH."resources/mobile-app/".$app_project_codename)) {
	    	mkdir(PATH."resources/mobile-app/".$app_project_codename, 0777, true);
		}
		if (!file_exists(PATH."resources/mobile-app/".$app_project_codename."/android_config.xml")) {
	    	touch(PATH."resources/mobile-app/".$app_project_codename."/android_config.xml");
		}
		$file = fopen(PATH."resources/mobile-app/".$app_project_codename."/android_config.xml", "w");
		$file_content="<?xml version='1.0' encoding='utf-8'?>\n";
		$file_content.="<widget id='".$app_android_project_id."' version='".$version."' xmlns='http://www.w3.org/ns/widgets' xmlns:gap='http://phonegap.com/ns/1.0'>\n";
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
		$file_content.="<icon src='icon.png' />\n";
		$file_content.="<icon gap:platform='android' gap:qualifier='ldpi' src='res/icon/android/icon-36-ldpi.png' />\n";
		$file_content.="<icon gap:platform='android' gap:qualifier='mdpi' src='res/icon/android/icon-48-mdpi.png' />\n";
		$file_content.="<icon gap:platform='android' gap:qualifier='hdpi' src='res/icon/android/icon-72-hdpi.png' />\n";
		$file_content.="<icon gap:platform='android' gap:qualifier='xhdpi' src='res/icon/android/icon-96-xhdpi.png' />\n";
		$file_content.="<gap:splash gap:platform='android' gap:qualifier='port-ldpi' src='res/screen/android/screen-ldpi-portrait.png' />\n";
		$file_content.="<gap:splash gap:platform='android' gap:qualifier='port-mdpi' src='res/screen/android/screen-mdpi-portrait.png' />\n";
		$file_content.="<gap:splash gap:platform='android' gap:qualifier='port-hdpi' src='res/screen/android/screen-hdpi-portrait.png' />\n";
		$file_content.="<gap:splash gap:platform='android' gap:qualifier='port-xhdpi' src='res/screen/android/screen-xhdpi-portrait.png' />\n";
		$file_content.="<access origin='*' />\n";
		$file_content.="</widget>";
		fwrite($file, $file_content);
		fclose($file);

	}
?>